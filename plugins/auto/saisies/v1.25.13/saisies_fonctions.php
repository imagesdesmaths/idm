<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/saisies');
include_spip('balise/saisie');
// picker_selected (spip 3)
include_spip('formulaires/selecteur/generique_fonctions');


/**
 * Passer un nom en une valeur compatible avec une classe css
 * toto => toto,
 * toto/truc => toto_truc,
 * toto[truc] => toto_truc,
**/
function saisie_nom2classe($nom) {
	return str_replace(array('/', '[', ']'), array('_', '_', ''), $nom);
}

/**
 * Passer un nom en une valeur compatible avec un name de formulaire
 * toto => toto,
 * toto/truc => toto[truc],
 * toto[truc] => toto[truc],
**/
function saisie_nom2name($nom) {
	if (false === strpos($nom, '/')) {
		return $nom;
	}
	$nom = explode('/', $nom);
	$premier = array_shift($nom);
	$nom = implode('][', $nom);
	return $premier . '[' . $nom . ']';
}

/**
 * Balise beurk #GLOBALS{debut_intertitre}
 * qui retourne la globale PHP du même nom si elle existe
 *
 * @param array $p
 * 		Pile au niveau de la balise
 * @return array
 * 		Pile complétée du code php de la balise.
**/
function balise_GLOBALS_dist($p) {
	if (function_exists('balise_ENV'))
		return balise_ENV($p, '$GLOBALS');
	else
		return balise_ENV_dist($p, '$GLOBALS');
}

?>
