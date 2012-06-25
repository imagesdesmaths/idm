<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Un code postal francais est compose de 5 chiffres
 * http://fr.wikipedia.org/wiki/Code_postal_en_France
 * a completer pour d'autre pays
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
		default:
			if (!preg_match(",^((0[1-9])|([1-8][0-9])|(9[0-8]))[0-9]{3}$,", $valeur))
				return $erreur;
			break;
	}

	return $ok;
}
