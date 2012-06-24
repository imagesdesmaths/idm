<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Une date au format JJ/MM/AAAA (avec séparateurs souples : espace / - .)
 * Options :
 * - format : permet de préciser le format de la date  jma pour jour/mois/année (par défaut), mja (pour mois / jour / année), amj (année/mois/jour)
 * TODO : compléter les formats 
 * On pourrait faire mieux, genre vérifier les jours en fonction du mois
 * Mais c'est pas très important, on reste simple
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   tableau d'options [NON UTILISE].
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_date_dist($valeur, $options=array()){
	$erreur = _T('verifier:erreur_date_format');
	if (!is_string($valeur))
		return $erreur;

	$ok = '';
	// On tolère différents séparateurs
	$valeur = preg_replace("#\.|/| #i",'-',$valeur);
	
	// On vérifie la validité du format
	$format = isset($options['format']) ? $options['format'] : 'jma'; 
	
	if ($format=='mja') {
		if(!preg_match('#^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$#',$valeur)) return $erreur;
		list($mois,$jour,$annee) = explode('-',$valeur);
	} elseif ($format=='amj') {
		if(!preg_match('#^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$#',$valeur)) return $erreur;
		list($annee,$mois,$jour) = explode('-',$valeur);
	} else {
	// Format jma par défaut
		if(!preg_match('#^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$#',$valeur)) return $erreur;
		list($jour,$mois,$annee) = explode('-',$valeur);
	}

	// validité de la date
	$erreur = _T('verifier:erreur_date');
	if (!checkdate($mois, $jour, $annee)) return $erreur;
	
	return $ok;
}
