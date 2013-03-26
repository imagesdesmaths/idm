<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

// Importation d'un formulaire forms&table

function echanger_formulaire_forms_importer_dist($fichier){
	include_spip('inc/xml');
	$arbre = spip_xml_load($fichier, false);
	
	if ($arbre and is_array($arbre) and isset($arbre['forms'])){
		foreach($arbre['forms'] as $forms){
			foreach ($forms['form'] as $form){
				$formulaire = array();
				
				// Le titre
				$titre = trim(spip_xml_aplatit($form['titre']));
				$formulaire['titre'] = $titre ? $titre : _T('info_sans_titre');
				
				// L'identifiant il faut le générer
				$formulaire['identifiant'] = 'form_'.time();
				
				// Le descriptif
				$descriptif = trim(spip_xml_aplatit($form['descriptif']));
				$formulaire['descriptif'] = $descriptif ? $descriptif : '';
				
				// Le message de retour si ok
				$message_retour = trim(spip_xml_aplatit($form['texte']));
				$formulaire['message_retour'] = $message_retour ? $message_retour : '';

				// Les champs
				$formulaire['saisies'] = array();
				foreach($form['fields'] as $fields){
					foreach($fields['field'] as $field){
						// Le truc par défaut
						$saisie = array(
							'saisie' => 'input',
							'options' => array('size'=>40)
						);
						
						// On essaye de traduire tous les types de champs
						$type = trim(spip_xml_aplatit($field['type']));
						switch ($type){
							case 'texte':
								$saisie['saisie'] = 'textarea';
								unset($saisie['options']['size']);
								$saisie['options']['rows'] = 5;
								$saisie['options']['cols'] = 40;
								break;
							case 'password':
								$saisie['options']['type'] = 'password';
								break;
							case 'date':
								$saisie['saisie'] = 'date';
								$saisie['verifier'] = array(
									'type' => 'date'
								);
								break;
							case 'num':
							case 'monnaie':
								$saisie['verifier'] = array(
									'type' => 'entier'
								);
								if ($taille = trim(spip_xml_aplatit($field['taille'])))
									$saisie['verifier']['options'] = array('max' => (pow(10, $taille)-1));
								break;
							case 'email':
								$saisie['verifier'] = array(
									'type' => 'email'
								);
								break;
							case 'telephone':
								$saisie['verifier'] = array(
									'type' => 'telephone'
								);
								break;
							case 'select':
								unset($saisie['options']['size']);
								$liste = trim(spip_xml_aplatit($field['extra_info']));
								if ($liste == 'radio')
									$saisie['saisie'] = 'radio';
								else
									$saisie['saisie'] = 'selection';
								break;
							case 'multiple':
								$saisie['saisie'] = 'checkbox';
								unset($saisie['options']['size']);
								break;
							case 'fichier':
							case 'separateur':
								$saisie = null;
						}
						
						// On continue seulement si on a toujours une saisie
						if ($saisie){
							// Les choix pour les types select et multiple
							if(isset($field['les_choix']) and is_array($field['les_choix'])){
								$saisie['options']['datas'] = array();
								foreach($field['les_choix'] as $les_choix){
									foreach($les_choix['un_choix'] as $un_choix){
										$choix = trim(spip_xml_aplatit($un_choix['choix']));
										$titre = trim(spip_xml_aplatit($un_choix['titre']));
										$saisie['options']['datas'][$choix] = $titre;
									}
								}
							}
						
							// Le nom
							$saisie['options']['nom'] = trim(spip_xml_aplatit($field['champ']));
						
							// Le label
							$saisie['options']['label'] = trim(spip_xml_aplatit($field['titre']));
						
							// Obligatoire
							if (trim(spip_xml_aplatit($field['obligatoire'])) == 'oui')
								$saisie['options']['obligatoire'] = 'on';
						
							// Explication éventuelle
							if ($explication = trim(spip_xml_aplatit($field['aide'])))
								$saisie['options']['explication'] = $explication;
						
							// On ajoute enfin la saisie
							$formulaire['saisies'][] = $saisie;
						}
					}
				}
				
				// Les traitements
				$formulaire['traitements'] = array();
				
				// Le traitement email
				$config_email = unserialize(trim(spip_xml_aplatit($form['email'])));
				if (is_array($config_email)){
					if ($email_defaut = $config_email['defaut'])
						$formulaire['traitements']['email'] = array(
							'destinataires_plus' => $email_defaut
						);
				}
				
				// Le traitement enregistrement
				$formulaire['traitements']['enregistrement'] = array(
					'moderation' => (trim(spip_xml_aplatit($form['moderation'])) == 'priori') ? 'priori' : 'posteriori',
					'modifiable' => (trim(spip_xml_aplatit($form['modifiable'])) == 'oui') ? 'on' : '',
					'multiple' => (trim(spip_xml_aplatit($form['multiple'])) == 'non') ? '' : 'on'
				);
				
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
	}
	
	if ($id_formulaire and $ok){
		return $id_formulaire;
	}
	else{
		return _T('formidable:erreur_importer_forms');
	}
}

?>
