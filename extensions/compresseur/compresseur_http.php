<?php

//
// Reglage de l'output buffering : si possible, generer une sortie
// compressee pour economiser de la bande passante
//

// si un buffer est deja ouvert, stop
if ($GLOBALS['flag_ob']
AND $GLOBALS['meta']['auto_compress_http'] == 'oui'
AND strlen(ob_get_contents())==0
AND !headers_sent()) {
	if (
	// special bug de proxy
	!(isset($_SERVER['HTTP_VIA']) AND preg_match(",NetCache|Hasd_proxy,i", $_SERVER['HTTP_VIA']))
	// special bug Netscape Win 4.0x
	AND (strpos($_SERVER['HTTP_USER_AGENT'], 'Mozilla/4.0') === false)
	// special bug Apache2x
	#&& !preg_match(",Apache(-[^ ]+)?/2,i", $_SERVER['SERVER_SOFTWARE'])
	// test suspendu: http://article.gmane.org/gmane.comp.web.spip.devel/32038/
	#&& !($GLOBALS['flag_sapi_name'] AND preg_match(",^apache2,", @php_sapi_name()))
	// si la compression est deja commencee, stop
	# && !@ini_get("zlib.output_compression")
	AND !@ini_get("output_handler")
	AND !isset($_GET['var_mode']) # bug avec le debugueur qui appelle ob_end_clean()
	)
		ob_start('ob_gzhandler');
}
