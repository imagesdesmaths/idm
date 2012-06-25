<?php

if (!defined('_ECRIRE_INC_VERSION')) return;


function lire_config_php_dist($lieu, $defaut=null, $unserialize=true ) {

	list ($fichier, $casier) = cfg_php_extraire_infos($lieu);

	$contenu = array();
	if (!cfg_php_lire_fichier($fichier, $contenu)) {
		return $unserialize ? $defaut : serialize($defaut);
	}

	$demande = '';
	if (!cfg_php_extraire_demande($casier, $contenu, $demande)) {
		return $unserialize ? $defaut : serialize($defaut);
	}

	return $unserialize ? $demande : serialize($demande);
}


// calcule l'emplacement du fichier
function cfg_php_extraire_infos($lieu) {
	list ($fichier, $casier) = explode(':', $lieu);
	if (!$casier) {
		$casier = $fichier;
		$fichier = '';
	}
	
	if ($fichier) {
		sous_repertoire(dirname($f));
		$fichier = _DIR_RACINE . $fichier;
	} else {
		// le premier element du casier est le nom de base du fichier. on l'enleve
		$nom = array_shift($casier = explode('/', $casier));
		$casier = implode('/', $casier);
		sous_repertoire( _DIR_VAR . 'cfg');
		$fichier = _DIR_VAR . 'cfg/' . $nom . '.php';	
	}

	return array($fichier, $casier);
}


function cfg_php_lire_fichier($fichier, &$contenu) {
	if (!file_exists($fichier)) {
		return false;
	}
	
	// inclut une variable $cfg
	if (!@include $fichier) {
		return false;
	}

	if (!$cfg OR !is_array($cfg)) {
		$contenu = array();
	} else {
		$contenu = $cfg;	
	}
	
	return true;
}


function cfg_php_extraire_demande($casier, $contenu, &$demande) {
	$casier = explode('/', $casier);
	$pos = &$contenu;
	while ($cran = array_shift($casier)) {
		if (!is_array($pos)) {
			return false;
		}
		if (!array_key_exists($cran, $pos)) {
			return false;
		}
		$pos = &$pos[$cran];
	}
	
	$demande = $pos;
	return true;
}


?>
