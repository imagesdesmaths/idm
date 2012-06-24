<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Ecrire la balise javascript pour inserer le fichier compresse
 * C'est cette fonction qui decide ou il est le plus pertinent
 * d'inserer le fichier, et dans quelle forme d'ecriture
 *
 * @param string $flux
 *   contenu du head nettoye des fichiers qui ont ete compresse
 * @param int $pos
 *   position initiale du premier fichier inclu dans le fichier compresse
 * @param string $src
 *   nom du fichier compresse
 * @param string $comments
 *   commentaires a inserer devant
 * @return string
 */
function compresseur_ecrire_balise_js_dist(&$flux, $pos, $src, $comments = ""){
	$comments .= "<script type='text/javascript' src='$src'></script>";
  $flux = substr_replace($flux,$comments,$pos,0);
  return $flux;
}

/**
 * Ecrire la balise css pour inserer le fichier compresse
 * C'est cette fonction qui decide ou il est le plus pertinent
 * d'inserer le fichier, et dans quelle forme d'ecriture
 *
 * @param string $flux
 *   contenu du head nettoye des fichiers qui ont ete compresse
 * @param int $pos
 *   position initiale du premier fichier inclu dans le fichier compresse
 * @param string $src
 *   nom du fichier compresse
 * @param string $comments
 *   commentaires a inserer devant
 * @param string $media
 * @return string
 */
function compresseur_ecrire_balise_css_dist(&$flux, $pos, $src, $comments = "", $media=""){
	$comments .= "<link rel='stylesheet'".($media?" media='$media'":"")." href='$src' type='text/css' />";
  $flux = substr_replace($flux,$comments,$pos,0);
	return $flux;
}

/**
 * Extraire les balises CSS a compacter et retourner un tableau
 * balise => src
 *
 * @param  $flux
 * @param  $url_base
 * @return array
 */
function compresseur_extraire_balises_css_dist($flux, $url_base){
	$balises = extraire_balises($flux,'link');
	$files = array();
	foreach ($balises as $s){
		if (extraire_attribut($s, 'rel') === 'stylesheet'
			AND (!($type = extraire_attribut($s, 'type'))
				OR $type == 'text/css')
			AND is_null(extraire_attribut($s, 'name')) # css nommee : pas touche
			AND is_null(extraire_attribut($s, 'id'))   # idem
			AND !strlen(strip_tags($s))
			AND $src = preg_replace(",^$url_base,",_DIR_RACINE,extraire_attribut($s, 'href')))
			$files[$s] = $src;
	}
	return $files;
}

/**
 * Extraire les balises JS a compacter et retoruner un tableau
 * balise => src
 * @param  $flux
 * @param  $url_base
 * @return array
 */
function compresseur_extraire_balises_js_dist($flux, $url_base){
	$balises = extraire_balises($flux,'script');
	$files = array();
	foreach ($balises as $s){
		if (extraire_attribut($s, 'type') === 'text/javascript'
			AND is_null(extraire_attribut($s, 'id')) # script avec un id : pas touche
			AND $src = extraire_attribut($s, 'src')
			AND !strlen(strip_tags($s)))
			$files[$s] = $src;
	}
	return $files;
}

/**
 * Compacter (concatener+minifier) les fichiers format css ou js
 * du head. Reperer fichiers statiques vs url squelettes
 * Compacte le tout dans un fichier statique pose dans local/
 *
 * @param string $flux
 *  contenu du <head> de la page html
 * @param string $format
 *  css ou js
 * @return string
 */
function compacte_head_files($flux,$format) {
	$url_base = url_de_base();
	$url_page = substr(generer_url_public('A'), 0, -1);
	$dir = preg_quote($url_page,',').'|'.preg_quote(preg_replace(",^$url_base,",_DIR_RACINE,$url_page),',');

	if (!$extraire_balises = charger_fonction("compresseur_extraire_balises_$format",'',true))
		return $flux;

	$files = array();
	$flux_nocomment = preg_replace(",<!--.*-->,Uims","",$flux);
	foreach ($extraire_balises($flux_nocomment, $url_base) as $s=>$src) {
		if (
			preg_match(',^('.$dir.')(.*)$,', $src, $r)
			OR (
				// ou si c'est un fichier
				$src = preg_replace(',^'.preg_quote(url_de_base(),',').',', '', $src)
				// enlever un timestamp eventuel derriere un nom de fichier statique
				AND $src2 = preg_replace(",[.]{$format}[?].+$,",".$format",$src)
				// verifier qu'il n'y a pas de ../ ni / au debut (securite)
				AND !preg_match(',(^/|\.\.),', substr($src,strlen(_DIR_RACINE)))
				// et si il est lisible
				AND @is_readable($src2)
			)
		) {
			if ($r)
				$files[$s] = explode('&', str_replace('&amp;', '&', $r[2]), 2);
			else
				$files[$s] = $src;
		}
	}

	$callbacks = array('each_min'=>'callback_minifier_'.$format.'_file');

	if ($format=="css"){
		$callbacks['each_pre'] = 'compresseur_callback_prepare_css';
		// ce n'est pas une callback, mais en injectant l'url de base ici
		// on differencie les caches quand l'url de base change
		// puisque la css compresse inclue l'url courante du site (en url absolue)
		// on exclue le protocole car la compression se fait en url relative au protocole
		$callbacks[] = protocole_implicite($url_base);
	}
	if ($format=='js' AND $GLOBALS['meta']['auto_compress_closure']=='oui'){
		$callbacks['all_min'] = 'minifier_encore_js';
	}

	include_spip('inc/compresseur_concatener');
	include_spip('inc/compresseur_minifier');
	if (list($src,$comms) = concatener_fichiers($files, $format, $callbacks)
		AND $src){
		$compacte_ecrire_balise = charger_fonction("compresseur_ecrire_balise_$format",'');
		$files = array_keys($files);
		// retrouver la position du premier fichier compacte
		$pos = strpos($flux,reset($files));
		// supprimer tous les fichiers compactes du flux
		$flux = str_replace($files,"",$flux);
		// inserer la balise (deleguer a la fonction, en lui donnant le necessaire)
		$flux = $compacte_ecrire_balise($flux, $pos, $src, $comms);
	}

	return $flux;
}


/**
 * lister les fonctions de preparation des feuilles css
 * avant minification
 * 
 * @return array
 */
function compresseur_liste_fonctions_prepare_css(){
	static $fonctions = null;

	if (is_null($fonctions)){
		$fonctions = array('urls_absolues_css');
		// les fonctions de preparation aux CSS peuvent etre personalisees
		// via la globale $compresseur_filtres_css sous forme de tableau de fonctions ordonnees
		if (isset($GLOBALS['compresseur_filtres_css']) AND is_array($GLOBALS['compresseur_filtres_css']))
			$fonctions = $GLOBALS['compresseur_filtres_css'] + $fonctions;
	}
  return $fonctions;
}


/**
 * Preparer un fichier CSS avant sa minification
 * @param string $css
 * @param bool|string $is_inline
 * @param string $fonctions
 * @return bool|int|null|string
 */
function &compresseur_callback_prepare_css(&$css, $is_inline = false, $fonctions=null) {
	if ($is_inline) return compresseur_callback_prepare_css_inline($css,$is_inline);
	if (!preg_match(',\.css$,i', $css, $r)) return $css;

	$url_absolue_css = url_absolue($css);

	if (!$fonctions) $fonctions = compresseur_liste_fonctions_prepare_css();
	elseif (is_string($fonctions)) $fonctions = array($fonctions);

	$sign = implode(",",$fonctions);
	$sign = substr(md5("$css-$sign"), 0,8);

	$file = basename($css,'.css');
	$file = sous_repertoire (_DIR_VAR, 'cache-css')
		. preg_replace(",(.*?)(_rtl|_ltr)?$,","\\1-f-" . $sign . "\\2",$file)
		. '.css';

	if ((@filemtime($file) > @filemtime($css))
		AND (!defined('_VAR_MODE') OR _VAR_MODE != 'recalcul'))
		return $file;

	if ($url_absolue_css==$css){
		if (strncmp($GLOBALS['meta']['adresse_site'],$css,$l=strlen($GLOBALS['meta']['adresse_site']))!=0
		 OR !lire_fichier(_DIR_RACINE . substr($css,$l), $contenu)){
		 		include_spip('inc/distant');
		 		if (!$contenu = recuperer_page($css))
					return $css;
		}
	}
	elseif (!lire_fichier($css, $contenu))
		return $css;

	// retirer le protocole de $url_absolue_css
	$url_absolue_css = protocole_implicite($url_absolue_css);
	$contenu = compresseur_callback_prepare_css_inline($contenu, $url_absolue_css, $fonctions);

	// ecrire la css
	if (!ecrire_fichier($file, $contenu))
		return $css;

	return $file;
}

/**
 * Preparer du contenu CSS inline avant minification
 * 
 * @param string $contenu
 * @param string $url_base
 * @param array $fonctions
 * @return string
 */
function &compresseur_callback_prepare_css_inline(&$contenu, $url_base, $fonctions=null) {
	if (!$fonctions) $fonctions = compresseur_liste_fonctions_prepare_css();
	elseif (is_string($fonctions)) $fonctions = array($fonctions);

	// retirer le protocole de $url_base
	$url_base = protocole_implicite(url_absolue($url_base));

	foreach($fonctions as $f)
		if (function_exists($f))
			$contenu = $f($contenu, $url_base);
	
	return $contenu;
}

