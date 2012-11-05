<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Romy Tetue
 * Licence GPL
 * 
 */

if (!defined('_ECRIRE_INC_VERSION')) return;
include_spip('public/spip_bonux_criteres');
include_spip('public/spip_bonux_balises');

/**
 * une fonction pour generer une balise img a partir d'un nom de fichier
 *
 * @param string $img
 * @param string $alt
 * @param string $class
 * @return string
 */
function tag_img($img,$alt="",$class=""){
	$balise_img = chercher_filtre('balise_img');
	return $balise_img($img,$alt,$class);
}


?>
