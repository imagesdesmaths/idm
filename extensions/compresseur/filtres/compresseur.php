<?php

// Si la source est un chemin, on retourne un chemin avec le contenu compacte
// dans _DIR_VAR/cache_$format/
// Si c'est un flux on le renvoit compacte
// Si on ne sait pas compacter, on renvoie ce qu'on a recu
// http://doc.spip.org/@compacte
function compacte($source, $format = null) {
	if (!$format AND preg_match(',\.(js|css)$,', $source, $r))
		$format = $r[1];
	include_spip('inc/compresseur');
	if (!function_exists($compacte = 'compacte_'.$format))
		return $source;

	// Si on n'importe pas, est-ce un fichier ?
	if (!preg_match(',[\s{}],', $source)
	AND preg_match(',\.'.$format.'$,i', $source, $r)
	AND file_exists($source)) {
		// si c'est une css, il faut reecrire les url en absolu
  	if ($format=='css')
  		$source = url_absolue_css($source);

		$f = basename($source,'.'.$format);
		$f = sous_repertoire (_DIR_VAR, 'cache-'.$format)
		. preg_replace(",(.*?)(_rtl|_ltr)?$,","\\1-compacte-"
		. substr(md5("$source-compacte"), 0,4) . "\\2", $f, 1)
		. '.' . $format;

		if ((@filemtime($f) > @filemtime($source))
		AND ($GLOBALS['var_mode'] != 'recalcul'))
			return $f;

		if (!lire_fichier($source, $contenu))
			return $source;

		// traiter le contenu
		$contenu = $compacte($contenu);

		// ecrire le fichier destination, en cas d'echec renvoyer la source
		if (ecrire_fichier($f, $contenu, true))
			return $f;
		else
			return $source;
	}

	// Sinon simple compactage de contenu
	return $compacte($source);
}

// Cette fonction verifie les reglages du site et traite le compactage
// des css et/ou js d'un <head>
// un fichier .gz est cree pour chaque, qui peut etre utilise par apache
// et lui eviter de recompresser a chaque hit, avec les directives suivantes :
//<IfModule mod_gzip.c>
//mod_gzip_on                   Yes
//mod_gzip_can_negotiate        Yes
//mod_gzip_static_suffix        .gz
//AddEncoding              gzip .gz
//mod_gzip_item_include         file       \.(js|css)$
//</IfModule>
// http://doc.spip.org/@compacte_head
function compacte_head($flux){
	include_spip('inc/compresseur');
	if (!defined('_INTERDIRE_COMPACTE_HEAD')){
		// dans l'espace prive on compacte toujours, c'est concu pour
		if ($GLOBALS['meta']['auto_compress_css'] == 'oui' OR (test_espace_prive() AND !defined('_INTERDIRE_COMPACTE_HEAD_ECRIRE')))
			$flux = compacte_head_css($flux);
		if ($GLOBALS['meta']['auto_compress_js'] == 'oui' OR (test_espace_prive() AND !defined('_INTERDIRE_COMPACTE_HEAD_ECRIRE')))
			$flux = compacte_head_js($flux);
	}
	return $flux;
}

/**
 * Embarquer sous forme URI Scheme
 * data:xxx/yyy;base64,....
 * un fichier
 *
 * Experimental
 *
 * @staticvar array $mime
 * @param string $src
 *   chemin du fichier
 * @param string $base
 *   le chemin de base a partir duquel chercher $src
 * @param int $maxsize
 * @return string
 */
function filtre_embarque_fichier ($src, $base="", $maxsize = 4096) {
	static $mime = array();
	$extension = substr(strrchr($src,'.'),1);
	$filename = $base . $src;
	#var_dump("$base:$src:$filename");

	if (!file_exists($filename)
		OR filesize($filename)>$maxsize
		OR !lire_fichier($filename, $contenu))
		return $src;

	if (!isset($mime[$extension]))
		$mime[$extension] = sql_getfetsel('mime_type','spip_types_documents','extension='.sql_quote($extension));

	$base64 = base64_encode($contenu);
	$encoded = 'data:'.$mime[$extension].';base64,'.$base64;
	#var_dump($encoded);

	return $encoded;
}

/**
 * Embarquer le 'src' d'une balise html en URI Scheme
 *
 * Experimental
 *
 * @param string $img
 * @param int $maxsize
 * @return string
 */
function filtre_embarque_src ($img, $maxsize = 4096){
	$src = extraire_attribut($img,'src');
	if ($src2=filtre_embarque_fichier($src) AND $src2!= $src) {
		$img = inserer_attribut($img, 'src', $src2);
	}
	return $img;
}
?>