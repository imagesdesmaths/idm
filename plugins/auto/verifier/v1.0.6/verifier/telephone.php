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

	// Pour les prefixes, on accepte les notations +33 et 0033
	$prefixe_FR = "/^(\+|00)33/";
	$prefixe_ES = "/^(\+|00)34/";
	$prefixe_CH = "/^(\+|00)41/";
	if (preg_match($prefixe_FR, $tel)) {
		$options['pays'] = 'FR';
		$tel = preg_replace($prefixe_FR,'0',$tel);
	}
	if (preg_match($prefixe_ES, $tel)) {
		$options['pays'] = 'ES';
		$tel = preg_replace($prefixe_ES,'',$tel);
	}
	if (preg_match($prefixe_CH, $tel)) {
		$options['pays'] = 'CH';
		$tel = preg_replace($prefixe_CH,'0',$tel);
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
			// On interdit egalement les "numéros" tout en lettres
			// TODO finaliser les numéros à la con
			if(intval($tel) == 0) return $erreur;
			break;
	}
	
	return $ok;
}
