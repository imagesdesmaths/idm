<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function construire_configuration_saisie($saisie, $avec_nom='non'){
	include_spip('inc/yaml');
	$configuration_saisie = yaml_decode_file(find_in_path('saisies/'.$saisie.'.yaml'));
	
	if (is_array($configuration_saisie)){
		$configuration_saisie = $configuration_saisie['options'];
		// On ne met le premier champ permettant de configurer le "name" seulement si on le demande explicitement
		if ($avec_nom == 'oui')
			array_unshift($configuration_saisie[0]['contenu'],
				array(
					'saisie' => 'input',
					'options' => array(
						'nom' => 'nom',
						'label' => '<:saisies:option_nom_label:>',
						'explication' => '<:saisies:option_nom_explication:>',
						'obligatoire' => 'oui'
					),
					'verifier' => array(
						'type' => 'regex',
						'options' => array(
							'modele' => '/^[\w]+$/'
						)
					)
				)
			);
	}
	else
		$configuration_saisie = array();
	
	return $configuration_saisie;
}

