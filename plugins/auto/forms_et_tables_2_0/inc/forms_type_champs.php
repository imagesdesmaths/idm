<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 *  2005,2006 - Distribue sous licence GNU/GPL
 *
 */
	
	
	
	$GLOBALS['forms_types_champs_etendus']=array();
	Forms_importe_types_etendus();

	function Forms_importe_types_etendus(){
		// dans l'espace public on evite un find_in_path a chaque hit
		if (_DIR_RESTREINT) {
			if (isset($GLOBALS['meta']['forms_types_champs']))
				$t = unserialize($GLOBALS['meta']['forms_types_champs']);
			if (isset($t['types']) && is_array($t['types']))
				$GLOBALS['forms_types_champs_etendus'] = $t['types'];
		}
		else {
			if ($f = find_in_path('etc/forms_types_champs.xml')){
				$date = filemtime($f);
				if (isset($GLOBALS['meta']['forms_types_champs']))
					$t = unserialize($GLOBALS['meta']['forms_types_champs']);
				if (isset($t['date'])&& ($t['date']==$date) && isset($t['types']) && is_array($t['types']))
					$GLOBALS['forms_types_champs_etendus'] = $t['types'];
				else {
					include_spip('inc/plugin');
					$contenu = "";
					lire_fichier ($f, $contenu);
					$GLOBALS['forms_types_champs_etendus']=array();
					/* adaptation SPIP2 */
					/*$data = parse_plugin_xml($contenu);*/
					$data = spip_xml_parse($contenu);
					/* fin adaptation SPIP2 */
					if (isset($data['types']))
						foreach($data['types'] as $types)
							if (isset($types['type'])) 
								foreach($types['type'] as $type){
									if (isset($type['field'])){
										$champ = end($type['field']);
										// adapation SPIP2
										/*$libelle = isset($type['label'])?trim(applatit_arbre($type['label'])):$champ;*/
										$libelle = isset($type['label'])?trim(spip_xml_aplatit($type['label'])):$champ;
										$match = isset($type['match'])?trim(end($type['match'])):"";
										$format = array();
										if (isset($type['formate'])){
											foreach($type['formate'] as $fmt){
												$matchr = isset($fmt['match'])?trim(end($fmt['match'])):"";
												$replace = isset($fmt['replace'])?trim(end($fmt['replace'])):"";
												if ($matchr&&$replace)
													$format[] = array('match'=>$matchr,'replace'=>$replace);
											}
										}
										if (!in_array($champ,Forms_liste_types_champs()))
											$GLOBALS['forms_types_champs_etendus'][$champ]=array('label'=>$libelle,'match'=>$match,'formate'=>$format);
									}
								}
					ecrire_meta('forms_types_champs',serialize(array("date"=>$date,"types"=>$GLOBALS['forms_types_champs_etendus'])));
					ecrire_metas();
				}
			}
		}
	}


	function Forms_liste_types_champs(){
		$liste = array_diff(array_keys(Forms_nom_type_champ()),array(''));
		return $liste;
	}
	function Forms_type_champ_autorise($type) {
		static $t;
		if (!$t) {
			$t = Forms_nom_type_champ();
		}
		return (strlen($type)&&isset($t[$type]));
	}
	function Forms_nom_type_champ($type='') {
		static $noms;
		if (!$noms) {
			$noms = array(
				'ligne' => _T("forms:champ_type_ligne"),
				'texte' => _T("forms:champ_type_texte"),
				'select' => _T("forms:champ_type_select"),
				'multiple' => _T("forms:champ_type_multiple"),
				'date' => _T("forms:champ_type_date"),
				'num' => _T("forms:champ_type_numerique"),
				'monnaie' => _T("forms:champ_type_monnaie"),
				'email' => _T("forms:champ_type_email"),
				'url' => _T("forms:champ_type_url"),
				'fichier' => _T("forms:champ_type_fichier"),
				'password' => _T("forms:champ_type_password"),
				'mot' => _T("forms:champ_type_mot"),
				'joint' => _T("forms:champ_type_joint"),
				'separateur' => _T("forms:champ_type_separateur"),
				'textestatique' => _T("forms:champ_type_textestatique")
			);
			foreach($GLOBALS['forms_types_champs_etendus'] as $t=>$champ)
				$noms[$t] = $champ['label'];
			$noms = pipeline('forms_types_champs',$noms);
		}
		if (!strlen($type))
			return $noms;
		else return ($s = $noms[$type]) ? $s : $type;
	}

	function Forms_valide_champs_reponse_post($id_form, $id_donnee, $c = NULL, $structure = NULL){
		$erreur = array();
		if (!$structure){
			include_spip("inc/forms");
			$structure = Forms_structure($id_form);
		}
		foreach($structure as $champ=>$infos){
			$type = $infos['type'];
			if ($GLOBALS['spip_version_code']<1.92)
				$val = _request($champ);
			else
				$val = _request($champ, $c);
			if ($type == 'fichier') $val = $_FILES[$champ]['tmp_name'];
			// verifier la presence des champs obligatoires	dont la saisie n'est pas desactivee
			if (($val===NULL || (!is_array($val) && !strlen($val)) || (is_array($val) && (count($val)<2))) 
				&& ($infos['obligatoire'] == 'oui') 
				&& ($infos['saisie'] != 'non'))
				// Cas particulier de l'upload de fichier : on ne force pas à uploader à nouveau un fichier si celui-ci est existant
				// Cas particulier des password : on ne force pas a donner un nouveau mot de passe si existe deja
				if (( (in_array($type,array('fichier','password'))) && ($val==NULL) && (Forms_valeurs($id_donnee,$id_form,$champ)!=NULL) ));
					else $erreur[$champ] = _T("forms:champ_necessaire");
		}

		$erreur = array_merge($erreur,
			Forms_valide_conformite_champs_reponse_post($id_form, $id_donnee, $c, $structure));

		return $erreur;
	}


	function Forms_valide_conformite_champs_reponse_post($id_form, $id_donnee, $c = NULL, $structure = NULL){
		$erreur = array();
		if (!$structure){
			include_spip("inc/forms");
			$structure = Forms_structure($id_form);
		}

		foreach($structure as $champ=>$infos){
			$type = $infos['type'];
			if ($GLOBALS['spip_version_code']<1.92)
				$val = _request($champ);
			else
				$val = _request($champ, $c);
			if ( $val!=NULL && strlen($val) ) {

				// Verifier la conformite des donnees entrees
				switch ($type){
					case 'date':
						if (!preg_match("#^\s*([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})\s*$#",$val,$regs)) {
						$erreur[$champ] = _T("forms:date_invalide");
						}
						else 
							if (!checkdate($regs[2],$regs[1],$regs[3]))
								$erreur[$champ] = _T("forms:date_invalide");
						break;
					case 'num':
						if (!preg_match(",^\s*-?(([0-9]+([.][0-9]*)?)|([.][0-9]+))$,",$val))
							$erreur[$champ] = _T("forms:numerique_invalide");
						break;
					case 'monnaie':
						if (!preg_match(",^\s*-?(([0-9]+([.][0-9]*)?)|([.][0-9]+))$,",$val))
							$erreur[$champ] = _T("forms:monetaire_invalide");
						break;
					case 'email':
						include_spip('inc/filtres');
						if (!strpos($val, '@') || !email_valide($val)) {
							$erreur[$champ] = _T("forms:adresse_invalide");
						}
						break;
					case 'url':
						if ($infos['extra_info'] == 'oui') {
							include_spip("inc/sites");
							if (!recuperer_page($val)) {
								$erreur[$champ] = _T("forms:site_introuvable");
							}
						}
						break;
					case 'fichier':
						if (!$taille = $_FILES[$champ]['size']) {
							$erreur[$champ] = _T("forms:echec_upload");
						}
						else if ($infos['extra_info'] && $taille > ($infos['extra_info'] * 1024)) {
						$erreur[$champ] = _T("forms:fichier_trop_gros");
						}
						else if (!Forms_type_fichier_autorise($_FILES[$champ]['name'])) {
							$erreur[$champ] = _T("fichier_type_interdit");
						}
						if ($erreur[$champ]) {
							supprimer_fichier($_FILES[$champ]['tmp_name']);
						}
						break;
					case 'multiple':
					case 'select':
					case 'mot':
						if (!is_array($val)) $val = array($val);
						foreach($val as $v)
							if (strlen($v) && !isset($infos['choix'][$v])) // le formulaire renvoie toujours au moins une reponse vide sur les multiple
								$erreur[$champ] = _T("forms:donnee_inattendue");
						break;
					case 'password':
						if (strlen($infos['extra_info'])){
							if ($GLOBALS['spip_version_code']<1.92)
								$val_confirm = _request("{$champ}_confirm");
							else
								$val_confirm = _request("{$champ}_confirm", $c);
							if ($val!=$val_confirm)
								$erreur[$champ] = _T("info_passes_identiques");
						}
						if (strlen($val)<6 and strlen($val))
							$erreur[$champ] = _T("info_passe_trop_court");
						break;
				}			
				if (isset($GLOBALS['forms_types_champs_etendus'][$type])){
					$match = $GLOBALS['forms_types_champs_etendus'][$type]['match'];
					if (strlen($match) && !preg_match($match,$val))
						$erreur[$champ] = _T("forms:champs_perso_invalide");
				}
				$erreur = pipeline('forms_valide_conformite_champ',array(
					'args'=>array(
						'id_form'=>$id_form,
						'id_donnee'=>$id_donnee,
						'champ'=>$champ,
						'type'=>$type,
						'infos'=>$infos,
						'val'=>$val
					),
					'data'=>$erreur)
				);
			}
		}
		return $erreur;
	}


?>
