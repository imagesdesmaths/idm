<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Tetue
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

function previsu_verifier_cle_temporaire($cle){
	$validite = 12; // validite de 12h maxi
	$old = 0;
	do {
		$date = date('Y-m-d H',strtotime("-$old hour"));
		if ($cle==previsu_cle_temporaire($date))
			return true;
	} while ($old++<$validite);
	return false;
}
function previsu_cle_temporaire($date=null){
	include_spip('inc/securiser_action');
	if (!$date) $date = date('Y-m-d H');
	$url = self();
	$cle = md5($url.$date.secret_du_site());
	return $cle;
}

?>
