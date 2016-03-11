<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Un code postal francais est compose de 5 chiffres
 * http://fr.wikipedia.org/wiki/Code_postal_en_France
 * a completer pour d'autre pays
 * 
 * cf : http://fr.wikipedia.org/wiki/Codes_postaux
 * 
 * La regexp par défaut doit valider toutes les possibilités
 * -* combinaisons de chiffres et de lettres et aussi tiret
 * -* notations internationales cf : http://en.wikipedia.org/wiki/List_of_postal_codes#On_the_use_of_country_codes
 * 
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   pays => code pays
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_code_postal_dist($valeur, $options=array()){
	$erreur = _T('verifier:erreur_code_postal');
	if (!is_string($valeur))
		return $erreur;

	$ok = '';
	switch ($options['pays']){
		case 'FR':
			if (!preg_match(",^((0[1-9])|([1-8][0-9])|(9[0-8]))[0-9]{3}$,", $valeur))
				return $erreur;
			break;
		case 'DZ':// Algérie
		case 'DE':// Allemagne
		case 'BY':// Bielorussie
		case 'BA':// Bosnie Herzégovine
		case 'HR':// Croatie
		case 'ES':// Espagne
		case 'FI':// Finlande
		case 'GT':// Guatemala
		case 'IT':// Italie
		case 'LT':// Lituanie
		case 'MY':// Malaisie
		case 'MA':// Maroc
		case 'MX':// Mexique
		case 'ME':// Montenegro
		case 'LK':// Sri lanka
		case 'MX':// Mexique
		case 'UA':// Ukraine
			// 5 chiffres
			if (!preg_match(",^[0-9]{5}$,", $valeur))
				return $erreur;
			break;
		default:
			if (!preg_match('/^[A-Z]{1,2}[-|\s][0-9]{3,6}$|^[0-9]{3,6}$|^[0-9|A-Z]{2,5}[-|\s][0-9|A-Z]{2,4}$|^[A-Z]{1,2} [0-9|A-Z]{2,5}[-|\s][0-9|A-Z]{2,4}/i',$valeur))
				return $erreur;
			break;
	}

	return $ok;
}
