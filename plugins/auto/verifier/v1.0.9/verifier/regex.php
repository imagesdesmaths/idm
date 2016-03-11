<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Vérifié une valeur suivant une expression régulière.
 * Options :
 * - modele : chaine représentant l'expression
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   Contient une chaine représentant l'expression.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_regex_dist($valeur, $options=array()){
	$erreur = _T('verifier:erreur_regex');
	if (!is_string($valeur))
		return $erreur;

	if (preg_match($options['modele'], $valeur))
		return '';

	return $erreur;
}

?>
