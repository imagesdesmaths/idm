<?php
if (!defined('_ECRIRE_INC_VERSION')) return;

// installation : migrer depuis Champs Extras 2
function iextras_upgrade($nom_meta_base_version, $version_cible){

	$maj = array();
	$maj['create'] = array(
		array('iextras_upgrade_to_saisies'),
	);
	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

// on ne supprime aucun champ lorsqu'on desinstalle le plugin
// trop risqué !
function iextras_vider_tables($nom_meta_base_version) {
	effacer_meta($nom_meta_base_version);
}



// ======================================================================
//
//   Migration Champs Extras 2 (Spip 2.1) -> Champs Extras 3 (SPIP 3 +)
//
//

/**
 * Migration vers le plugin saisie
 * On épluche l'ancienne meta stockee
 * si elle existe, et si c'est le cas, on tente de migrer
 * ses donnees dans la nouvelle structure
 *
**/
function iextras_upgrade_to_saisies() {
	include_spip('inc/config');
	$old_extras = lire_config('iextras', '');
	if (!$old_extras) {
		// rien a faire
		return true; 
	}
	
	// juste pour pouvoir deserializer...
	if (!class_exists('ChampExtra')) {
		class ChampExtra{};
	}

	// logiquement, c'est bon du premier coup...
	if (is_array($old_extras)) {
		$oextras = $old_extras;
	} else {
		// autrement c'est encore sérializé ?
		if (!$oextras = unserialize($old_extras)) {
			// mais parfois, en cas d'import hasardeux...
			
			// tentative avec uniquement des \n
			$o = str_replace(array("\r\n","\r"), "\n", $old_extras);
			if (!$oextras = unserialize($o)) {
				
				// tentative avec des \r\n
				$o = str_replace("\n", "\r\n", $o);
				if (!$oextras = unserialize($o)) {
					// c'est foutu !
					spip_log("Erreur de mise à jour : deserialisation ratée...", "iextras");
					echo _L("L'installation n'a pas réussi à restaurer les informations de la version 2.
							 Il vous faudra réassocier vous-même les champs extras.");
				}
			}
		}
	}

	if (!$oextras) {
		return false;
	}
	
	unset ($old_extras, $o);

	$extras = array();
	
	// pour chaque extra, on va l'ajouter tranquilou dans la base.
	foreach ($oextras as $e) {
		// on passe la classe en tableau
		$te = array();
		foreach ($e as $c=>$v) {
			$te[$c] = $v;
		}
		
		// on ne garde pas ce qui est à false, à NULL ou ''.
		foreach ($te as $c=>$v) {
			if (is_array($v)) {
				foreach ($v as $n=>$m) {
					if (!$m) unset($v[$n]);
				}
			}
			if (!$v) unset($te[$c]);
		}

		// regroupement par table sql.
		$table = $te['_table_sql'] ? $te['_table_sql'] : table_objet_sql($te['table']);
		if (!isset($extras[$table]) OR !is_array($extras[$table])) {
			$extras[$table] = array();
		}

		$extras[$table][ $te['champ'] ] = $te;
	}

	unset ($oextras);

	$nsaisie = array(
		'bloc'       => 'textarea',
		'ligne'      => 'input',
		'auteur'     => 'auteurs', // ! multiple=''
		'auteurs'    => 'auteurs', // ! multiple='on'
		'oui-non'    => 'oui_non',
		'menu-radio' => 'radio',
		'menu-enum'  => 'selection',
		'menu-cases' => 'checkbox',
	);

	include_spip('inc/saisies');
	include_spip('inc/config');

	// stocker les extras qui n'ont pas été importés totalement
	$reste = array();
	
	// pour chaque table sql
	foreach ($extras as $table => $champs) {
		// on recupere les champs extras declares pour la nouvelle version
		$ici = isset($GLOBALS['meta']['champs_extras_' . $table]) ? unserialize($GLOBALS['meta']['champs_extras_' . $table]) : array();
		$desc = sql_showtable($table);

		#var_dump($table, $ici);
#		var_dump($champs);
		
		// pour chaque champs extras decrits
		foreach ($champs as $champ=>$extra) {
		
			// si la colonne SQL n'existe pas, on passe
			if (!isset($desc['field'][$champ])) {
				unset($champs[$champ]);
				continue;
			}
			
			// si le champs est deja decrit dans la nouvelle structure, on passe
			foreach ($ici as $c) {
				if ($c['options']['nom'] == $champ) {
					unset($champs[$champ]);
					continue 2;
				}
			}

			// nous sommes face a un champs extras ancien, non encore
			// pris en compte dans la nouvelle version
			
			
			// selon les anciennes saisies, on redirige sur les nouvelles
			if (!isset($nsaisie[$extra['type']])) {
				// saisie inconnue
				echo "- Type de saisie non trouvé : $extra[type]. Passage en textarea.<br />\n";
				$extra['type'] = 'bloc';
			}

			$nouveau = saisie_identifier(array());
			$nouveau['saisie'] = $nsaisie[$extra['type']];
			$nouveau['options'] = array('nom' => $champ);

			// cas particulier des auteurs
			if ($extra['type'] == 'auteurs') {
				$nouveau['options']['multiple'] = 'on';
			}
			
			foreach (array(
				'champ'       => 'nom',
				'label'       => 'label',
				'sql'         => 'sql',
				'explication' => 'explication',
				'attention'   => 'attention',
				'obligatoire' => 'obligatoire',
				'traitements' => 'traitements',
				'rechercher'  => 'rechercher',
				'enum'        => 'datas',
				'type'        => '',
				'table'       => '',
				'_id'         => '',
				'_type'       => '',
				'_objet'      => '',
				'_table_sql'  => '',
				'saisie_parametres/class'       => 'class',
				'saisie_parametres/li_class'    => 'conteneur_class',
				'saisie_parametres/explication' => 'explication',
				'saisie_parametres/attention'   => 'attention',
				'__PHP_Incomplete_Class_Name'   => '', // interne à unserialize PHP s'il ne trouve pas la classe
			) as $old => $new) {
				// si $new est vide : on utilise pas.
				// si le contenu de $old est vide, on ne prend pas.
				// si iextras_upgrade_to_saisies_$old() existe,
				// on l'utilise pour calculer la nouvelle valeur
				if (!function_exists($f = 'iextras_upgrade_to_saisies_' . str_replace('/', '_', $old))) {
					$f = 'iextras_upgrade_to_saisies_all';
				}
				
				$old = explode('/', $old);
				$cle = array_pop($old);
				if ($rep = array_pop($old)) {
					if (array_key_exists($rep, $extra)) {
						if (array_key_exists($cle, $extra[$rep])) {
							if ($new and $val = $f($extra[$rep][$cle])) {
								$nouveau['options'][$new] = $val;
							}
							unset($extra[$rep][$cle]);
						}
						if (!$extra[$rep]) unset($extra[$rep]);
					}
				} else {
					if (isset($extra[$cle])) {
						if ($new and $val = $f($extra[$cle])) {
							$nouveau['options'][$new] = $val;
						}
						unset($extra[$cle]);
					}
				}
			}

			// cas particuliers des classes
			if (isset($nouveau['options']['class']) and $c = $nouveau['options']['class']) {
				if (in_array('inserer_barre_edition', explode(' ', $c))) {
					$nouveau['options']['inserer_barre'] = 'edition';
					$c = trim(str_replace('inserer_barre_edition', '', $c));
				}
				if (in_array('inserer_barre_forum', explode(' ', $c))) {
					$nouveau['options']['inserer_barre'] = 'forum';
					$c = trim(str_replace('inserer_barre_forum', '', $c));
					$nouveau['options']['class'] = $c;
				}
				if (in_array('inserer_previsualisation', explode(' ', $c))) {
					$nouveau['options']['previsualisation'] = 'on';
					$c = trim(str_replace('inserer_previsualisation', '', $c));
				}
				if ($c) {
					$nouveau['options']['class'] = $c;
				} else {
					unset($nouveau['options']['class']);
				}
			}
			

			// s'il en reste, c'est que y a des choses dont on ne sait pas
			// quoi en faire...
			if ($extra) {
				echo "------------------------------<br />";
				echo "Les attributs suivants ont etes ignores pour le champ
					$champ de type $extra[type].<br />";

				var_dump($extra);
				
				echo "----- Données conservées : <br />";
				var_dump($nouveau);

				$reste[] = $extra;
			}

			// on ajoute le nouvel extra
			$ici[] = $nouveau;
		}

		// on sauve
#		var_dump($ici);
		ecrire_config('champs_extras_' . $table, serialize($ici));
	}
	
	if (!$reste) {
		effacer_config('iextras');
	}
		
	return true;
}


function iextras_upgrade_to_saisies_all($val) {
	return $val;
}


// enum => datas
function iextras_upgrade_to_saisies_enum($val) {
	// le vide par defaut...
	// ,-vide-\r\n1,Valeur 1....
	if (md5($val) == '56517a44e77b255f38728c8625643a15') {
		return '';
	}
	return str_replace(',','|',$val);
}
