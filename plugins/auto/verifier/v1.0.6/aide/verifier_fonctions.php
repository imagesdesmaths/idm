<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/verifier');
include_spip('inc/saisies');

/*
 * Génère une page d'aide listant toutes les saisies et leurs options
 */
function verifier_generer_aide(){
	// On a déjà la liste par saisie
	$verifications = verifier_lister_disponibles();
	
	// On construit une liste par options
	$options = array();
	foreach ($verifications as $type_verif=>$verification){
		$options_verification = saisies_lister_par_nom($verification['options'], false);
		foreach ($options_verification as $nom=>$option){
			// Si l'option n'existe pas encore
			if (!isset($options[$nom])){
				$options[$nom] = _T_ou_typo($option['options']);
			}
			// On ajoute toujours par qui c'est utilisé
			$options[$nom]['utilisee_par'][] = $type_verif;
		}
		ksort($options_verification);
		$verifications[$type_verif]['options'] = $options_verification;
	}
	ksort($options);
	
	return array(
		'verifications' => $verifications,
		'options' => $options
	);
}

?>
