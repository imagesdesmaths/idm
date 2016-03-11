<?php

/**
 * Déclaration de fonctions pour les squelettes
 *
 * @package SPIP\Saisies\Fonctions
**/

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/saisies');
include_spip('balise/saisie');
// picker_selected (spip 3)
include_spip('formulaires/selecteur/generique_fonctions');

/**
 * A partir de SPIP 3.1
 * - ul.editer-groupe deviennent des div.editer-groupe
 * - li.editer devient div.editer
 * @param $tag
 *   ul ou li
 * @return string
 *   $tag initial ou div
 */
function saisie_balise_structure_formulaire($tag){
	static $is_div=null;
	if (is_null($is_div)){
		$version = explode(".",$GLOBALS['spip_version_branche']);
		if ($version[0]>3 OR ($version[0]==3 AND $version[1]>0))
			$is_div = true;
	}
	if ($is_div) return "div";
	return $tag;
}
// variante plus simple a ecrire dans les squelettes
// [(#DIV|sinon{ul})]
if (!function_exists('balise_DIV_dist')
  and $version = explode(".",$GLOBALS['spip_version_branche'])
  and ($version[0]>3 OR ($version[0]==3 AND $version[1]>0))){
	function balise_DIV_dist($p){
		$p->code = "'div'";
		$p->interdire_scripts = false;
		return $p;
	}
}

/**
 * Traiter la valeur de la vue en fonction du env
 * si un traitement a ete fait en amont (champs extra) ne rien faire
 * si pas de traitement defini (formidable) passer typo ou propre selon le type du champ
 *
 * @param string $valeur
 * @param string|array $env
 * @return string
 */
function saisie_traitement_vue($valeur,$env){
	if (is_string($env))
		$env = unserialize($env);
	if (!function_exists('propre'))
		include_spip('inc/texte');

	$valeur = trim($valeur);

	// si traitement est renseigne, alors le champ est deja mis en forme
	// (saisies)
	// sinon on fait une mise en forme smart
	if ($valeur and !isset($env['traitements'])) {
		if (in_array($env['type_saisie'], array('textarea'))) {
			$valeur = propre($valeur);
		}
		else {
			$valeur = "<p>" . typo($valeur) . "</p>";
		}
	}

	return $valeur;
}

/**
 * Passer un nom en une valeur compatible avec une classe css
 * 
 * - toto => toto,
 * - toto/truc => toto_truc,
 * - toto[truc] => toto_truc
 *
 * @param string $nom
 * return string
**/
function saisie_nom2classe($nom) {
	return str_replace(array('/', '[', ']', '&#91;', '&#93;'), array('_', '_', '', '_', ''), $nom);
}

/**
 * Passer un nom en une valeur compatible avec un `name` de formulaire
 * 
 * - toto => toto,
 * - toto/truc => toto[truc],
 * - toto[truc] => toto[truc]
 *
 * @param string $nom
 * return string
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
 * Compile la balise `#GLOBALS{xxx}` qui retourne la valeur d'une vilaine variable globale de même nom si elle existe
 *
 * @example
 *     ```
 *     #GLOBALS{debut_intertitre}
 *     ```
 * 
 * @param Champ $p
 *     Pile au niveau de la balise
 * @return Champ
 *     Pile complétée du code php de la balise.
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


/**
 * Lister les objets qui ont une url_edit renseignée et qui sont éditables.
 *
 * @return array Liste des objets :
 *               index : nom de la table (spip_articles, spip_breves, etc.)
 *               'type' : le type de l'objet ;
 *               'url_edit' : l'url d'édition de l'objet ;
 *               'texte_objets' : le nom humain de l'objet éditorial.
 */
function lister_tables_objets_edit()
{
    include_spip('base/abstract_sql');

    $objets = lister_tables_objets_sql();
    $objets_edit = array();

    foreach ($objets as $objet => $definition) {
        if (isset($definition['editable']) and isset($definition['url_edit']) and $definition['url_edit'] != '') {
            $objets_edit[$objet] = array('type' => $definition['type'], 'url_edit' => $definition['url_edit'], 'texte_objets' => $definition['texte_objets']);
        }
    }
    $objets_edit = array_filter($objets_edit);

    return $objets_edit;
}
