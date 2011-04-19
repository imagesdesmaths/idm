<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2009                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/ajouter_documents'); // a enlever apres nettoyage du core

/**
 * recuperer les infos distantes d'une url,
 * et renseigner pour une insertion en base
 * utilise une variable static car appellee plusieurs fois au cours du meme hit
 * (verification puis traitement)
 *
 * @param unknown_type $source
 */
function renseigner_source_distante($source){
	static $infos = array();
	if (isset($infos[$source]))
		return $infos[$source];
	
	include_spip('inc/distant');
	if ($a = recuperer_infos_distantes($source)) {

		# NB: dans les bonnes conditions (fichier autorise et pas trop gros)
		# $a['fichier'] est une copie locale du fichier
		unset($a['body']);

		$a['distant'] = 'oui';
		$a['mode'] = 'document';
		$a['fichier'] = set_spip_doc($source);
		$infos[$source] = $a;
		return $infos[$source];
	}

	return _T('medias:erreur_chemin_distant',array('nom'=>$source));
}

/**
 * Renseigner les informations de taille et dimenssion d'une image
 *
 * @param <type> $fichier
 * @param <type> $ext
 * @return <type>
 */
function renseigner_taille_dimension_image($fichier,$ext){
	$infos = array();
	
	$infos['type_image'] = false;

	// Quelques infos sur le fichier
	if (
	    !$fichier
	 OR !@file_exists($fichier)
	 OR !$infos['taille'] = @intval(filesize($fichier))) {
		spip_log ("Echec copie du fichier $fichier");
		return _T('medias:erreur_copie_fichier',array('nom'=> $fichier));
	}

	// VIDEOS : Prevoir traitement specifique ?
	// (http://www.getid3.org/ peut-etre)
	if ($ext == "mov") {
		$infos['largeur'] = 0;
		$infos['hauteur'] = 0;
	}
	
	// SVG : recuperer les dimensions et supprimer les scripts
	elseif ($ext == "svg") {
		list($infos['largeur'],$infos['hauteur'])= traite_svg($fichier);
	}
	
	// image ?
	else {
		
		// Si c'est une image, recuperer sa taille et son type (detecte aussi swf)
		$size_image = @getimagesize($fichier);
		$infos['largeur'] = intval($size_image[0]);
		$infos['hauteur'] = intval($size_image[1]);
		$infos['type_image'] = decoder_type_image($size_image[2]);
	}

	return $infos;
}

if (!function_exists('traite_svg')){
/**
 * Determiner les dimensions d'un svg, et enlever ses scripts si necessaire
 *
 * @param string $file
 * @return array
 */
// http://doc.spip.org/@traite_svg
function traite_svg($file)
{
	$texte = spip_file_get_contents($file);

	// Securite si pas admin : virer les scripts et les references externes
	// sauf si on est en mode javascript 'ok' (1), cf. inc_version
	if ($GLOBALS['filtrer_javascript'] < 1
	AND $GLOBALS['visiteur_session']['statut'] != '0minirezo') {
		include_spip('inc/texte');
		$new = trim(safehtml($texte));
		// petit bug safehtml
		if (substr($new,0,2) == ']>') $new = ltrim(substr($new,2));
		if ($new != $texte) ecrire_fichier($file, $texte = $new);
	}

	$width = $height = 150;
	if (preg_match(',<svg[^>]+>,', $texte, $s)) {
		$s = $s[0];
		if (preg_match(',\WviewBox\s*=\s*.\s*(\d+)\s+(\d+)\s+(\d+)\s+(\d+),i', $s, $r)){
			$width = $r[3];
                	$height = $r[4];
		} else {
	// si la taille est en centimetre, estimer le pixel a 1/64 de cm
		if (preg_match(',\Wwidth\s*=\s*.(\d+)([^"\']*),i', $s, $r)){
			if ($r[2] != '%') {
				$width = $r[1];
				if ($r[2] == 'cm') $width <<=6;
			}	
		}
		if (preg_match(',\Wheight\s*=\s*.(\d+)([^"\']*),i', $s, $r)){
			if ($r[2] != '%') {
	                	$height = $r[1];
				if ($r[2] == 'cm') $height <<=6;
			}
		}
	   }
	}
	return array($width, $height);
}
}

if (!function_exists('decoder_type_image')){
/**
 * Convertit le type numerique retourne par getimagesize() en extension fichier
 *
 * @param int $type
 * @param bool $strict
 * @return string
 */
// http://doc.spip.org/@decoder_type_image
function decoder_type_image($type, $strict = false) {
	switch ($type) {
		case 1:
			return "gif";
		case 2:
			return "jpg";
		case 3:
			return "png";
		case 4:
			return $strict ? "" : "swf";
		case 5:
			return "psd";
		case 6:
			return "bmp";
		case 7:
		case 8:
			return "tif";
		default:
			return "";
	}
}
}

?>