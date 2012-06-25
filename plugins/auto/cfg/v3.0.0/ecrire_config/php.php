<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('lire_config/php');

function ecrire_config_php_dist($lieu, $stockage) {
	
	list ($fichier, $casier) = cfg_php_extraire_infos($lieu);

	$contenu = array();
	cfg_php_lire_fichier($fichier, $contenu);

	if (!cfg_php_inserer_demande($casier, $contenu, $stockage)) {
		return false;
	}
		
	if (!cfg_php_enregistrer_fichier($fichier, $contenu)) {
		return false;
	}

	return true;

}




function cfg_php_inserer_demande($casier, &$contenu, $demande) {
	
	$casier = explode('/', $casier);
	if (!$casier) {
		$contenu = $demande;
		return true;
	}
	
	$pointeurs = array();
	$st = &$contenu;
	$sc = &$st;
	$c = $casier;
	while (count($c) AND $cc = array_shift($c)) {
		// creer l'entree si elle n'existe pas
		if (!isset($sc[$cc])) {
			// si on essaye d'effacer une config qui n'existe pas
			// ne rien creer mais sortir
			if (is_null($demande))
				return false;
				
			$sc[$cc] = array();
		}
		$pointeurs[$cc] = &$sc;
		$sc = &$sc[$cc];
	}
	
	// si c'est une demande d'effacement
	if (is_null($demande)){
		$c = $casier;
		$sous = array_pop($c);
		// effacer, et remonter pour effacer les parents vides
		do {
			unset($pointeurs[$sous][$sous]);
		} while ($sous = array_pop($c) AND !count($pointeurs[$sous][$sous]));
		
		// si on a vide tous les sous casiers,
		// et que le casier est vide
		// vider aussi la meta
		if (!$sous AND !count($st))
			$st = null;
	}
	else
		$sc = $demande;

	// Maintenant que $st est modifiee
	// reprenons la comme valeur a stocker dans le casier principal
	$contenu = $st;
	
	return true;

}


function cfg_php_enregistrer_fichier($fichier, $contenu) {
	if (is_null($contenu)) {
		return supprimer_fichier($fichier);
	}

$contenu = '<?php
/**************
* Config ecrite par CFG le ' . date('r') . '
* 
* NE PAS EDITER MANUELLEMENT !
***************/

$cfg = ' . var_export($contenu, true) . ';
?>
';

	return ecrire_fichier($fichier, $contenu);
}

?>
