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
 * @param string|array $valeur
 *   La valeur à vérifier, en chaîne pour une date seule, en tableau contenant deux entrées "date" et "heure" si on veut aussi l'heure
 * @param array $options
 *   tableau d'options.
 * @param null $valeur_normalisee
 *   Si normalisation a faire, la variable sera rempli par la date normalisee.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_date_dist($valeur, $options=array(), &$valeur_normalisee=null){
	$erreur = _T('verifier:erreur_date_format');
	$horaire = false; // par défaut on ne teste qu'une date
	
	// Si ce n'est ni une chaîne ni un tableau : pas le bon format
	if (!is_string($valeur) and !is_array($valeur))
		return $erreur;
	
	// Si c'est un tableau
	if (is_array($valeur)) {
		// S'il y a les bonnes infos on les garde aux bons endroits
		if (
			isset($valeur['date']) and is_string($valeur['date'])
			and isset($valeur['heure']) and is_string($valeur['heure'])
		) {
			$options['heure'] = $valeur['heure']; // l'heure pour la fonction de normalisation
			$valeur = $valeur['date']; // valeur principale pour la date
			$horaire = true; // on détecte une vérif avec horaire uniquement dans ce cas
		}
		// Sinon : pas le bon format
		else {
			return $erreur;
		}
	}
	
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

		// Validité de la date
		$erreur = _T('verifier:erreur_date');
		if (!checkdate($mois, $jour, $annee)) return $erreur;
	
	if($horaire) {
		// Format de l'heure
		$options['heure'] = str_replace(array('h','m','min'), array(':','',''), $options['heure']);
		if (!preg_match('#^([0-9]{1,2}):([0-9]{1,2})$#', $options['heure'], $hetm)) {
			return _T('verifier:erreur_heure_format');
		}
		// Si c'est le bon format, on teste si les nombres donnés peuvent exister
		else {
			$heures = intval($hetm[1]);
			$minutes = intval($hetm[2]);
			if ($heures < 0 or $heures > 23 or $minutes < 0 or $minutes > 59){
				return _T('verifier:erreur_heure');
			}
			// Si tout est bon pour l'heure, on recompose en ajoutant des 0 si besoin
			else {
				$options['heure'] = sprintf('%02d:%02d', $heures, $minutes);
			}
		}
	}
	// normaliser si demandé
	if ($options['normaliser'] and $options['normaliser'] == 'datetime') {
		$valeur_normalisee = normaliser_date_datetime_dist($valeur, $options, $ok);
	}

	return $ok;
}




/**
 * Convertir une date en datetime 
 *
**/
function normaliser_date_datetime_dist($valeur, $options, &$erreur) {
	$defaut = '0000-00-00 00:00:00';

	if (!$valeur) {
		return $defaut;
	}

	$date = str_replace('-', '/', $valeur); // formater en jj/mm/aaaa

	if (isset($options['heure'])) {
		$date .= (' ' . $options['heure'] . ':00');
	} else {
		$date .= ' 00:00:00';
	}

	include_spip('inc/filtres');
	if (!$date = recup_date($date)) {
		$erreur = "Impossible d'extraire la date de $date";
		return false;
	}

	if (!($date = mktime($date[3], $date[4], 0, (int)$date[1], (int)$date[2], (int)$date[0]))) {
		// mauvais format de date
		$erreur = "Impossible de normaliser la date...";
		return false;
	}

	$date = date("Y-m-d H:i:s", $date);
	$date = vider_date($date); // enlever les valeurs considerees comme nulles (1 1 1970, etc...)

	if (!$date) {
		$date = $defaut;
	}

	return $date;
}

