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
	return str_replace(array('/', '[', ']', '&#91;', '&#93;'), array('_', '_', '', '_', ''), $nom);
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

/**
 * Liste les éléments du sélecteur générique triés
 *
 * Les éléments sont triés par objets puis par identifiants
 * 
 * @example
 *     L'entrée :
 *     'rubrique|3,rubrique|5,article|2'
 *     Retourne :
 *     array(
 *        0 => array('objet'=>'article', 'id_objet' => 2),
 *        1 => array('objet'=>'rubrique', 'id_objet' => 3),
 *        2 => array('objet'=>'rubrique', 'id_objet' => 5),
 *     )
 *
 * @param string $selected
 *     Liste des objets sélectionnés
 * @return array
 *     Liste des objets triés
**/
function picker_selected_par_objet($selected) {
	$res = array();
	$liste = picker_selected($selected);
	// $liste : la sortie dans le désordre
	if (!$liste) {
		return $res;
	}

	foreach ($liste as $l) {
		if (!isset($res[ $l['objet'] ])) {
			$res[ $l['objet'] ] = array();
		}
		$res[$l['objet']][] = $l['id_objet'];
	}
	// $res est trié par objet, puis par identifiant
	ksort($res);
	foreach ($res as $objet => $ids) {
		sort($res[$objet]);
	}

	// on remet tout en file
	$liste = array();
	foreach ($res as $objet=>$ids) {
		foreach ($ids as $id) {
			$liste[] = array('objet' => $objet, 'id_objet' => $id);
		}
	}

	return $liste;
}
?>
