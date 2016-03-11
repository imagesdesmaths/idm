<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Vérifie la validité d'un code couleur
 * 
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   type => hexa,...
 *   normaliser => oui ou rien
 * @param null $valeur_normalisee
 *   Si normalisation a faire, la variable sera rempli par la couleur normalisee.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_couleur_dist($valeur, $options=array(), &$valeur_normalisee=null){
	$erreur = _T('verifier:erreur_couleur');
	if (!is_string($valeur))
		return $erreur;

	$ok = '';
	switch ($options['type']){
		case 'hexa':
		default:
			if (!preg_match(",^#[a-f0-9]{6}$,i", $valeur))
				if (isset($options['normaliser']) and preg_match(",^[a-f0-9]{6}$,i", $valeur))
					$valeur_normalisee = "#".$valeur ;
				else
					return $erreur;
			break;
	}

	return $ok;
}

?>