<?php

/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * © 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

	if ($GLOBALS['spip_version_code']<1.92)
		include_spip('inc/forms_compat_191');
	include_spip('forms_filtres');
	function forms_calcule_les_valeurs($type, $id_donnee, $champ, $id_form, $separateur=" ",$etoile=false,$traduit=true){
		static $raw_vals,$raw_id=0;
		$lesvaleurs = array();
		if (strncmp($champ,'joint_',6)!=0){
			if ($raw_id!=$id_donnee){
				$raw_vals = array();
				$res = spip_query("SELECT champ,valeur FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee));
				while ($row = spip_fetch_array($res)) $raw_vals[$row['champ']][] = $row['valeur'];
				$raw_id = $id_donnee;
			}
			if (isset($raw_vals[$champ]))
				foreach($raw_vals[$champ] as $val)
					$lesvaleurs[] = (!$traduit)?$val:forms_calcule_valeur_en_clair($type, $id_donnee, $champ, $val, $id_form, $etoile);
			return implode($separateur,$lesvaleurs);
		}
		else 
			return forms_calcule_valeur_jointure($type, $id_donnee, $champ, $id_form, $separateur,$etoile);
	}
	function forms_calcule_valeur_jointure($type, $id_donnee, $champ, $id_form,$separateur,$etoile=false){
		static $type_joint = array();
		static $prefixi18n = array();
		static $liste_table = array();
		if (!isset($type_joint[$id_form][$champ])){
			$res = spip_query("SELECT extra_info FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ="._q($champ));
			if ($row = spip_fetch_array($res))
				$type_joint[$id_form][$champ] = $row["extra_info"];
			else return "";
		}
		$type = $type_joint[$id_form][$champ];
		if (!isset($prefixi18n[$type]))
			$prefixi18n[$type] = forms_prefixi18n($type);
		if (!isset($liste_table[$type])){
			include_spip("base/forms_base_api");
			$liste_table[$type] = implode(",",Forms_liste_tables($type));
		}
		include_spip("base/abstract_sql");
		$in = calcul_mysql_in("d.id_form",$liste_table[$type]); 
		$pre = $prefixi18n[$type];
		$res = spip_query(
		  "SELECT id_donnee_liee 
		  FROM spip_forms_donnees_donnees AS l
		  JOIN spip_forms_donnees AS d ON d.id_donnee=l.id_donnee_liee
		  WHERE $in AND l.id_donnee="._q($id_donnee));
		//adapatation SPIP2
		//$cpt = spip_num_rows($res);
		$cpt =  sql_count($res);
		$out = "";
		if (!$etoile){
			if ($cpt==0) $out .= "";//_T("$pre:aucune_reponse");
			elseif ($cpt>5) $out .= _T("$pre:nombre_reponses",array('nombre'=>$cpt));
			//else if ($cpt==1) $out .= _T("$pre:une_reponse");
			else {
				while ($row = spip_fetch_array($res))
					$out .= implode(" ",Forms_decrit_donnee($row['id_donnee_liee'])).$separateur;
			}
		}
		else {
			$out .="0";
			while ($row = spip_fetch_array($res))
				$out .= $separateur.$row['id_donnee_liee'];
		}
		return $out;
	}
	
	function forms_format_monnaie($valeur,$decimales,$unite=true){
		return sprintf("%.{$decimales}f",$valeur).($unite?"~EUR":"");
	}
	
	function forms_calcule_valeur_en_clair($type, $id_donnee, $champ, $valeur, $id_form, $etoile=false){
		static $structure=array();
		// s'assurer que l'on est bien sur une boucle forms, sinon retourner $valeur
		$ok = $id_donnee && $champ;
		$ok = $ok && in_array($type, array('forms_donnees_champs','forms_champs','forms_donnees'));
		// on recupere la valeur du champ si pas deja la
		if ($ok && !$valeur){
			$res = spip_query("SELECT valeur FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($champ));
			if ($row = spip_fetch_array($res))
				$valeur = $row['valeur'];
			else
				$ok = false;
		}
		// on recupere le type du champ si pas deja fait (une seule requete par table et par champ)
		if ($ok && !isset($structure[$id_form]))
			$structure[$id_form] = Forms_structure($id_form, false);
		$rendu = 'typo';
		if ($ok) {
			$t = $structure[$id_form][$champ]['type'];

			switch ($t) {
				case 'select':
				case 'multiple':
					if (!isset($structure[$id_form][$champ]['choix'][$valeur])){
						$res = spip_query("SELECT choix,titre FROM spip_forms_champs_choix WHERE id_form="._q($id_form)." AND champ="._q($champ));
						while ($row = spip_fetch_array($res))
							$structure[$id_form][$champ]['choix'][$row['choix']] = $row['titre'];
					}
					if (isset($structure[$id_form][$champ]['choix'][$valeur]))
						$valeur = $structure[$id_form][$champ]['choix'][$valeur];
					break;
				case 'mot':
					if (!isset($mots_s[$valeur])){
						$res = spip_query("SELECT titre FROM spip_mots WHERE id_mot="._q($valeur));
						if ($row = spip_fetch_array($res)) $mots_s[$valeur] = $row['titre'];
						else $mots_s[$valeur] = $valeur;
					}
					$valeur = $mots_s[$valeur];
					break;
				case 'password':
					$rendu = "";
					$valeur="******"; # ne jamais afficher en clair un password, si on veut vraiment le faire on utilise l'etoile sur le champ
					break;
				case 'url':
					$rendu = "calculer_url";
					break;
				case 'num':
				case 'monnaie':
					if (!$etoile) {
						$valeur = forms_format_monnaie($valeur,$structure[$id_form][$champ]['taille'],$t=='monnaie');
						$valeur = "<span class='numerique'>$valeur</span>";
					}
					break;
				case 'texte':
					$rendu = 'propre';
					break;
				case 'ligne':
				case 'separateur':
				case 'textestatique':
					break;
				default :
					if (!isset($GLOBALS['forms_types_champs_etendus']))
						include_spip('inc/forms_type_champs');
					if (isset($GLOBALS['forms_types_champs_etendus'][$t])
					  && isset($GLOBALS['forms_types_champs_etendus'][$t]['formate'])
					)
						foreach($GLOBALS['forms_types_champs_etendus'][$t]['formate'] as $formate)
							$valeur = preg_replace($formate['match'],$formate['replace'],$valeur);
					break;
			}

			if (!$etoile AND $rendu)
				include_spip('inc/texte');
			$valeur = pipeline('forms_calcule_valeur_en_clair',
				array('args'=>array(
					'valeur'=>$valeur,
					'rendu'=>$rendu,
					'wrap'=>$wrap_champ[$id_form][$champ],
					'type'=>$type,
					'id_donnee'=>$id_donnee,
					'champ'=>$champ,
					'id_form'=>$id_form,
					'type_champ'=>$t,
					'etoile'=>$etoile),'data'=>wrap_champ((!$etoile AND $rendu)?$rendu($valeur):$valeur,$structure[$id_form][$champ]['html_wrap']))
				);
		}
		return $valeur;
	}
	function forms_boite_jointure($id_donnee,$champ,$id_form){
		if (!_DIR_RESTREINT && in_array(_request('exec'),$GLOBALS['forms_actif_exec'])){
			$forms_lier_donnees = charger_fonction('forms_lier_donnees','inc');
			$out = $forms_lier_donnees('donnee',"$id_donnee-$champ-$id_form",_request('exec'));
		}
		return $out;
	}

		
	//
	// Afficher le diagramme de resultats d'un sondage
	//

	function Forms_afficher_reponses_sondage($id_form) {
		$r = '';
		$id_form = intval($id_form);
	
		$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form));
		if (!$row = spip_fetch_array($result)) return '';
		$type_form = $row['type_form'];
	
		$r .= "<div class='spip_sondage'>\n";
		
		$res2 = spip_query("SELECT * FROM spip_forms_champs AS champs
		WHERE id_form="._q($id_form)." AND type IN ('select','multiple','mot') ORDER BY champ");
		while ($row2 = spip_fetch_array($res2)) {
			// On recompte le nombre total de reponses reelles 
			// car les champs ne sont pas forcement obligatoires
			$row3=spip_fetch_array(spip_query("SELECT COUNT(DISTINCT c.id_donnee) AS num ".
				"FROM spip_forms_donnees AS r LEFT JOIN spip_forms_donnees_champs AS c USING (id_donnee) ".
				"WHERE r.id_form="._q($id_form)." AND r.confirmation='valide' AND r.statut='publie' AND c.champ="._q($row2['champ'])));
			if (!$row3 OR !($total_reponses=$row3['num']))
				continue;
	
			// Construire la liste des valeurs autorisees pour le champ
			$liste = array();
			if ($row2['type'] != 'mot'){
				$res3 = spip_query("SELECT * FROM spip_forms_champs_choix WHERE id_form="._q($id_form)." AND champ="._q($row2['champ']));
				while ($row3=spip_fetch_array($res3))
					$liste[$row3['choix']] = $row3['titre'];
			}
			else {
				$id_groupe = intval($row2['extra_info']);
				$res3 = spip_query("SELECT id_mot, titre FROM spip_mots WHERE id_groupe=$id_groupe ORDER BY titre");
				while ($row3 = spip_fetch_array($res3))
					$liste[$row3['id_mot']] = $row3['titre'];
			}
	
			// Nombre de reponses pour chaque valeur autorisee
			$query = "SELECT c.valeur, COUNT(*) AS num ".
				"FROM spip_forms_donnees AS r LEFT JOIN spip_forms_donnees_champs AS c USING (id_donnee) ".
				"WHERE r.id_form="._q($id_form)." AND r.confirmation='valide' AND r.statut='publie' ".
				"AND c.champ="._q($row2['champ'])." GROUP BY c.valeur";
			$result = spip_query($query);
			$chiffres = array();
			// Stocker pour regurgiter dans l'ordre
			while ($row = spip_fetch_array($result)) {
				$chiffres[$row['valeur']] = $row['num'];
			}
			
			// Afficher les resultats
			$r .= ($t=typo($row2['titre']))?"<strong>$t :</strong>":"";
			$r .= "<br />\n";
			$r .= "<div class='sondage_table'>";
			foreach ($liste as $valeur => $nom) {
				$r .= "<div class='sondage_ligne'>";
				$n = $chiffres[$valeur];
				$taux = floor($n * 100.0 / $total_reponses);
				$r .= "<div class='ligne_nom'>".typo($nom)." </div>";
				$r .= "<div style='width: 60%;'><div class='ligne_barre' style='width: $taux%;'></div></div>";
				$r .= "<div class='ligne_chiffres'>$n ($taux&nbsp;%)</div>";
				$r .= "</div>\n";
			}
			$r .= "</div>\n";
			$r .= "<br />\n";
		}
	
		$query = "SELECT COUNT(*) AS num FROM spip_forms_donnees ".
			"WHERE id_form="._q($id_form)." AND confirmation='valide' AND statut='publie'";
		$result = spip_query($query);
		list($num) = spip_fetch_array($result,SPIP_NUM);
		$r .= "<strong>"._T("forms:total_votes")." : $num</strong>";
	
		$r .= "</div>\n";
		
		return $r;
	}


	// construit une balise textarea avec la barre de raccourcis std de Spip.
	// ATTENTION: cette barre injecte un script JS que le squelette doit accepter
	// donc ce filtre doit IMPERATIVEMENT assurer la securite a sa place
	
	// http://doc.spip.org/@barre_textarea
	function forms_textarea($texte, $rows, $cols, $name, $id='', $class='forml', $lang='', $active='') {
		static $num_textarea = 0;
		if ($active=='oui')
			include_spip('inc/layer'); // definit browser_barre
		if ($id=='') {$id="textarea_$num_textarea";$num_textarea++;}
	
		$texte = entites_html($texte);
		if (($active!='oui') || (!$GLOBALS['browser_barre']))
			return "<textarea name='$name' rows='$rows' class='$class' cols='$cols' id='$id'>$texte</textarea>";
	
		include_spip ('inc/barre');
		return afficher_barre("document.getElementById('$id')", true, $lang) .
		  "
	<textarea name='$name' rows='$rows' class='$class' cols='$cols'
	id='$id'
	onselect='storeCaret(this);'
	onclick='storeCaret(this);'
	onkeyup='storeCaret(this);'
	ondblclick='storeCaret(this);'>$texte</textarea>";
	}
	
	function forms_label_details($type){
		$out = "";
		if ($type=='email') $out = _T("forms:champ_email_details");
		if ($type=='url') $out = _T("forms:champ_url_details");
		return pipeline('forms_label_details',array('args'=>array('type'=>$type),'data'=>$out));
	}
	function forms_input_champs($texte,$id_form,$type,$champ,$extra_info,$obligatoire,$env){
		return pipeline('forms_input_champs',
			array(
				'args'=>array(
					'type'=>$type,
					'id_form'=>$id_form,
					'champ'=>$champ,
					'extra_info'=>$extra_info,
					'obligatoire'=>$obligatoire,
					'env'=>$env
					),
				'data'=>$texte
			)
		);
	}
	function forms_ajoute_styles($texte){
		return pipeline('forms_ajoute_styles',$texte);
	}

?>