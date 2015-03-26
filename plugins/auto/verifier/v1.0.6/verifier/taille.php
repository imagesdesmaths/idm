<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Vérifier une taille minimale/maximale, pour un mot de passe par exemple
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   Les éléments à vérifier (min, max, egal).
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */

function verifier_taille_dist($valeur, $options=array()){
	$ok = true;
	if (!is_string($valeur))
		return _T('erreur_inconnue_generique');
	
	include_spip('inc/charsets');
	$erreur = '';
	$taille = spip_strlen($valeur);
	
	if (isset($options['min']))
		$ok = ($ok and ($taille >= $options['min']));
	
	if (isset($options['max'])){
		$ok = ($ok and ($taille <= $options['max']));
	}
	if (isset($options['egal'])){
		$ok = ($ok and ($taille == $options['egal']));
	}
	
	if (!$ok){
		// On ajoute la taille actuelle aux valeurs de remplacement
		$options['nb'] = $taille;
		if (isset($options['min']) and isset($options['max']))
			$erreur = _T('verifier:erreur_taille_entre', $options);
		elseif (isset($options['max']))
			$erreur = _T('verifier:erreur_taille_max', $options);
		elseif (isset($options['egal']))
			$erreur = _T('verifier:erreur_taille_egal', $options);
		else
			$erreur = _T('verifier:erreur_taille_min', $options);
	}
	
	return $erreur;
}
