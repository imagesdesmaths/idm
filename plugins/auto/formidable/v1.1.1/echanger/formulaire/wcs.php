<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function echanger_formulaire_wcs_importer_dist($fichier){
	include_spip('inc/xml');
	include_spip('inc/filtres');
	include_spip('inc/saisies');
	$arbre = spip_xml_load($fichier, false);
	
	if ($arbre and is_array($arbre) and isset($arbre['formdef'])){
		foreach($arbre['formdef'] as $form){
			$formulaire = array();
			
			// Le titre
			$titre = filtrer_entites(trim(spip_xml_aplatit($form['name'])));
			$formulaire['titre'] = $titre ? $titre : _T('info_sans_titre');
			
			// On vérifie que l'identifiant n'existe pas déjà
				$formulaire['identifiant'] = str_replace('-', '_', trim(spip_xml_aplatit($form['url_name'])));
				$deja = sql_getfetsel(
					'id_formulaire',
					'spip_formulaires',
					'identifiant = '.sql_quote($formulaire['identifiant'])
				);
				if ($deja)
					$formulaire['identifiant'] = $formulaire['identifiant'].'_'.time();
			
			// Les champs
			$formulaire['saisies'] = array();
			// Par défaut le conteneur c'est le formulaire
			$conteneur =& $formulaire;
			foreach($form['fields'] as $fields){
				foreach($fields['field'] as $field){
					$changer_conteneur = false;
					
					// Le truc par défaut
					$saisie = array(
						'saisie' => 'input',
						'options' => array('size'=>40)
					);
					
					// Le label
					$saisie['options']['label'] = filtrer_entites(trim(spip_xml_aplatit($field['label'])));
					
					// On essaye de traduire tous les types de champs
					$type = trim(spip_xml_aplatit($field['type']));
					switch ($type){
						case 'string':
							if ($size = intval(trim(spip_xml_aplatit($field['size'])))){
								$saisie['options']['maxlength'] = $size;
								$saisie['verifier'] = array(
									'type' => 'taille',
									'options' => array('max'=>$size)
								);
							}
							break;
						case 'text':
							$saisie['saisie'] = 'textarea';
							unset($saisie['options']['size']);
							$saisie['options']['rows'] = 5;
							$saisie['options']['cols'] = 40;
							if ($rows = intval(trim(spip_xml_aplatit($field['rows'])))){
								$saisie['options']['rows'] = $rows;
							}
							if ($cols = intval(trim(spip_xml_aplatit($field['cols'])))){
								$saisie['options']['cols'] = $cols;
							}
							break;
						case 'date':
							$saisie['verifier'] = array(
								'type' => 'date'
							);
							break;
						case 'email':
							$saisie['verifier'] = array(
								'type' => 'email'
							);
							break;
						case 'item':
							unset($saisie['options']['size']);
							$saisie['saisie'] = 'selection';
							$saisie['options']['cacher_option_intro'] = 'on';
							break;
						case 'bool':
							unset($saisie['options']['size']);
							$saisie['saisie'] = 'case';
							$saisie['options']['label_case'] = $saisie['options']['label'];
							unset($saisie['options']['label']);
							break;
						case 'multiple':
							$saisie['saisie'] = 'checkbox';
							unset($saisie['options']['size']);
							break;
						case 'comment':
							$saisie['saisie'] = 'explication';
							$saisie['options']['texte'] = $saisie['options']['label'];
							unset($saisie['options']['label']);
							break;
						case 'page':
							$saisie['saisie'] = 'fieldset';
							unset($saisie['options']['size']);
							$saisie['saisies'] = array();
							$changer_conteneur = true;
							// On remet le conteneur au niveau du formulaire
							$conteneur =& $formulaire;
							break;
						case 'subtitle':
						case 'file':
							$saisie = null;
					}
					
					// On continue seulement si on a toujours une saisie
					if ($saisie){
						// Les choix pour les types select
						if(isset($field['items']) and is_array($field['items'])){
							$saisie['options']['datas'] = array();
							foreach($field['items'] as $items){
								foreach($items['item'] as $cle=>$item){
									$titre = filtrer_entites(trim($item));
									$saisie['options']['datas']['choix_'.$cle] = $titre;
								}
							}
						}
					
						// Le nom
						$saisie['options']['nom'] = saisies_generer_nom($formulaire['saisies'], $saisie['saisie']);
					
						// Obligatoire
						if (trim(spip_xml_aplatit($field['required'])) == 'True')
							$saisie['options']['obligatoire'] = 'on';
					
						// Explication éventuelle
						if ($explication = trim(spip_xml_aplatit($field['hint'])))
							$saisie['options']['explication'] = $explication;
					
						// On ajoute enfin la saisie
						$conteneur['saisies'][] = $saisie;
						
						// Faut-il changer de conteneur ?
						if ($changer_conteneur){
							$conteneur =& $conteneur['saisies'][count($conteneur['saisies'])-1];
						}
					}
				}
			}
			
			include_spip('action/editer_formulaire');
			// On insère un nouveau formulaire
			$id_formulaire = insert_formulaire();
			// Si ça a marché on modifie les champs de base
			if ($id_formulaire > 0 and !($erreur = formulaire_set($id_formulaire, $formulaire))){
				// Et ensuite les saisies et les traitements
				$ok = sql_updateq(
					'spip_formulaires',
					array(
						'saisies' => serialize($formulaire['saisies']),
						'traitements' => serialize($formulaire['traitements'])
					),
					'id_formulaire = '.$id_formulaire
				);
			}
		}
	}
	
	if ($id_formulaire and $ok){
		return $id_formulaire;
	}
	else{
		return _T('formidable:erreur_importer_wcs');
	}
}

?>
