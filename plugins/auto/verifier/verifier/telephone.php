<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Vérifie un numéro de téléphone. Pour l'instant seulement avec le schéma français.
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   [INUTILISE].
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_telephone_dist($valeur, $options=array()){
	$erreur = _T('verifier:erreur_telephone');
	if (!is_string($valeur))
		return $erreur;
	$ok = '';

	// On accepte differentes notations, les points, les tirets, les espaces, les slashes
	$tel = preg_replace("#\.|/|-| #i",'',$valeur);
	
	if (preg_match("/^\+33/", $tel)) {
		$options['pays'] = 'FR';
		$tel = preg_replace('/^\+33/','0',$valeur);
	}
	if (preg_match("/^\+34/", $tel)) {
		$options['pays'] = 'ES';
		$tel = preg_replace('/^\+34/','',$valeur);
	}
	if (preg_match("/^\+41/", $tel)) {
		$options['pays'] = 'CH';
		$tel = preg_replace('/^\+41/','0',$valeur);
	}

	switch($options['pays']){
		case 'CH':
			if (!preg_match("/^0[1-9]{9}$/",$tel)) return $erreur;
			break;
		case 'ES':
			if (!preg_match("/^[69][0-9]{8}$/",$tel)) return $erreur;
			break;
		case 'FR':
			if (!preg_match("/^0[1-9][0-9]{8}$/",$tel)) return $erreur;
		default:
			// On interdit les 000 etc. mais je pense qu'on peut faire plus malin
			// TODO finaliser les numéros à la con
			if($tel == '0000000000') return $erreur;
			break;
	}
	
	return $ok;
}
