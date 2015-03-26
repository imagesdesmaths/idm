<?php

// module inclu dans la description de l'outil en page de configuration

//include_spip('inc/actions');
//include_spip('inc/actions_compat');

function corbeille_action_rapide($actif) {
	if(!$actif) return str_replace(':','',_T('couteauprive:corbeille_vider'));
	foreach(cs_corbeille_table_infos() as $_table=>$obj) {
		list($nb, $nb_lies, $ids, $statut) = cs_corbeille_gerer($_table, -1);
		$table = isset($obj['table'])?$obj['table']:$_table;
		$objet = objet_type($table);
		$lib = ($nb && defined('_SPIP30000'))
			?cs_lien(generer_url_ecrire('action_rapide',"arg=corbeille|liste_objets&script=foo&objet=$objet&statut=$statut"),$obj['libelle'])
			:$obj['libelle'];
		$ids = join(',', $ids);
		$infos =
			($nb?_T('couteauprive:corbeille_objets', array('nb'=>$nb)):_T('couteauprive:corbeille_objets_vide'))
			.($nb_lies>0?' '._T('couteauprive:corbeille_objets_lies', array('nb_lies'=>$nb_lies)):'');
		$objets[] = "<label><input type='checkbox' value='$_table:$ids'".(($statut!=='spam' && $nb)?" checked='checked'":"")." name='$_table'/>$lib.
<span class='ar_edit_info'>$infos</span></label>";
	}
	return ajax_action_rapide_simple('purge_corbeille', join("<br/>\n",$objets), 'couteauprive:corbeille_objets_vider', 'couteauprive:corbeille_vider')
		. bouton_actualiser_action_rapide();
}

// pour ajouter des tables dans la corbeille, utiliser le tableau : global $corbeille_params['nvelle_table_SPIP'];
/*
	"statut" => statut de mise a la corbeille,
	"table" => nom eventuel de la table, pour definir plusieurs noisettes avec une meme table mais des statuts differents,
	"libelle" => libelle court,
	"tableliee"  => tableau des tables spip a vider en meme temps
*/
function cs_corbeille_table_infos($table=false) {
	static $params = NULL;
	if(is_null($params)) {
		global $corbeille_params;
		if(defined('_SPIP30000')) {
			foreach (lister_tables_objets_sql() as $sql => $o) {
				$t = $o['table_objet'];
				if (!isset($params[$t]) && isset($o['field']['statut']) && $o['principale'] /*&& $o['editable']*/
					&& $t!=''
					&& ( ($t=='auteurs' && $p='5poubelle') || ($t=='messages' && $p='poub')
						|| ($t=='signatures' && $p='poubelle') || ($t=='petitions' && $p='poubelle') // 2 objets non editables
						|| $o['statut_titres'][$p='poubelle'] || $o['statut_textes_instituer'][$p='poubelle'] // articles
						|| $o['statut_titres'][$p='refuse'] || $o['statut_textes_instituer'][$p='refuse'] // breves, sites
					)//	|| ($o['editable'] && $t!='rubriques' && $t!='documents' && $p='?poubelle')) // et les autres objets editables ?
				) {
					$params[$t] = array(
						"statut" => $p,
						"libelle" => $o['texte_objets'],
					);
					if (count($o['tables_jointures']))
						$params[$t]["tableliee"] = $o['tables_jointures'];
				}
				//texte_objets
			}
			// particularites
			$params = array_merge($params, array(
				"forums_publics" => array( "statut" => "off",
					"table"=>"forum",
					"libelle" => 'forum:titre_forum',
				),
				"forums_internes" => array( "statut" => "privoff",
					"table"=>"forum",
					"libelle" => 'forum:titre_cadre_forum_interne',
				),
				"forums_spam" => array( "statut" => "spam",
					"table"=>"forum",
					"libelle" => 'forum:messages_spam',
				),
			));
		} else {
			$params = array(
				"articles" => array( "statut" => "poubelle",
					"tableliee"=> array("spip_auteurs_articles","spip_documents_liens","spip_mots_articles","spip_signatures","spip_versions","spip_versions_fragments","spip_forum"),
					"libelle" => 'icone_articles',
				),
				"auteurs" => array( "statut" => "5poubelle",
					"libelle" => 'icone_auteurs',
				),
				"breves" => array( "statut" => "refuse",
					"libelle" => defined('_SPIP30000')?'breves:icone_breves':'icone_breves',
				),
				"sites" => array( "statut" => "refuse",
					"tableliee"=> array("spip_syndic_articles","spip_mots_syndic"),
					"libelle" => 'couteau:objet_syndics',
				),
				"signatures" => array( "statut" => "poubelle",
					"libelle" => 'couteau:objet_petitions',
				),
				"forums_publics" => array( "statut" => "off",
					"table"=>"forum",
					"libelle" => 'spip:titre_forum',
				),
				"forums_prives" => array( "statut" => "privoff",
					"table"=>"forum",
					"libelle" => 'spip:icone_forum_administrateur',
				),
				"forums_spam" => array( "statut" => "spam",
					"table"=>"forum",
					"libelle" => 'public:spam',
				),
			);
		}
		if(is_array($corbeille_params)) $params = array_merge($params, $corbeille_params);
		array_walk($params, create_function('&$val', '$val["libelle"] = _T($val["libelle"]);'));
		uasort($params, create_function ('$a, $b', 'return strcmp(strtolower($a["libelle"]), strtolower($b["libelle"]));'));
	}
	if(!$table) return $params;
	if(isset($params[$table])) return $params[$table];
	return false;
}

/**
 * supprime/compte les elements listes d'un type donne
 *
 * @param nom $table
 * @param tableau $ids (si $id==-1, on vide/compte tout)
 * @param booleen $compter
 * @return array(nb objets, nb objets lies, ids trouves)
 */
function cs_corbeille_gerer($table, $ids=array(), $vider=false) {
	$params = cs_corbeille_table_infos($table);
	if(isset($params['table'])) $table = $params['table'];
	include_spip('base/abstract_sql');
	$type = objet_type($table);
	$table_sql = table_objet_sql($type);
	$id_table = id_table_objet($type);
	if (!$params['statut']) return false;
//echo "<hr>$table - $type - $table_sql - $id_table";
	// determine les index des elements a supprimer
	$ids = $ids===-1
		?array_map('reset',sql_allfetsel($id_table,$table_sql,'statut='.sql_quote($params['statut'])))
		:array_map('reset',sql_allfetsel($id_table,$table_sql,sql_in($id_table,$ids).' AND statut='.sql_quote($params['statut'])));
	if (!count($ids)) return array(0, 0, array());
	// compte/supprime les elements definis par la liste des index
	if($vider) sql_delete($table_sql, sql_in($id_table, $ids));
	$nb = count($ids);
	// compte/supprime des elements lies
	$nb_lies = 0;
	$f = $vider?'sql_delete':'sql_countsel';
	if ($table_liee=$params['tableliee']) {
		$trouver_table = charger_fonction('trouver_table','base');
		foreach($table_liee as $k=>$unetable) {
			$desc = $trouver_table($unetable);
//echo "<hr>$table/$unetable/",table_objet_sql($unetable),'/';print_r(array_keys($desc['field']));
			if(isset($desc['field'][$id_table]))
				$nb_lies += $f($desc['table'], sql_in($id_table, $ids));
			elseif(isset($desc['field']['id_objet']) AND isset($desc['field']['objet']))
				$nb_lies += $f($desc['table'], sql_in('id_objet', $ids)." AND objet=".sql_quote($type));
		}
	}
	return array($nb, $vider?'-1':$nb_lies, $ids, $params['statut']);
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function corbeille_purge_corbeille_action() {
	// purger la corbeille
	foreach(cs_corbeille_table_infos() as $table=>$objet)
		if(preg_match(',^(.*?):(.*)$,', _request($table), $regs)) {
			$ids = explode(',', $regs[2]);
			// purger !
			cs_corbeille_gerer($regs[1], $ids, true);
		}
}

// Fonction appelee par exec/action_rapide : ?exec=action_rapide&arg=corbeille|liste_objets (pipe obligatoire)
// Renvoie la liste des objets mis a la poubelle (SPIP >= 3.0)
function corbeille_liste_objets_exec() {
	global $type_urls;
	$res = $id = '';
	include_spip('base/abstract_sql');
	if($s=_request('suppr')) {
		$table_sql = table_objet_sql(_request('objet'));
		$id_table = id_table_objet(_request('objet'));
		sql_delete($table_sql, $x="$id_table=$s");
		include_spip('inc/headers');
		redirige_par_entete(parametre_url(self(),'suppr','','&'));
	}
	include_spip('inc/texte');
	include_spip('inc/presentation');
	include_spip('public/assembler');
	include_spip('inc/pipelines');
	include_spip('inc/commencer_page');
	$f = defined('_SPIP30000')?'init_head':'envoi_link';
	echo '<html><head>'.f_jQuery($f(_T('couteau:urls_propres_titre')))
		.'<meta http-equiv="Content-Type" content="text/html; charset='.$GLOBALS['meta']['charset'].'" /></head><body style="text-align:center">'
		.(recuperer_fond('fonds/corbeille', array('objet'=>_request('objet'),'statut'=>_request('statut'))))
		.'</body></html>';
}

?>
