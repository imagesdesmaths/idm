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

function formulaires_configurer_compresseur_charger_dist(){

	$valeurs = array();

	$valeurs['_editer_auto_compress_http'] = function_exists('ob_gzhandler');
	$valeurs['auto_compress_http'] = $GLOBALS['meta']['auto_compress_http'];
	$valeurs['auto_compress_js'] = $GLOBALS['meta']['auto_compress_js'];
	$valeurs['auto_compress_css'] = $GLOBALS['meta']['auto_compress_css'];
	$valeurs['auto_compress_closure'] = $GLOBALS['meta']['auto_compress_closure'];
	
	return $valeurs;
	
}

function formulaires_configurer_compresseur_verifier_dist(){
	$erreurs = array();
	
	// les checkbox
	foreach(array('auto_compress_http','auto_compress_js','auto_compress_css', 'auto_compress_closure') as $champ)
		if (_request($champ)!='oui')
			set_request($champ,'non');
			
	return $erreurs;
}

function formulaires_configurer_compresseur_traiter_dist(){
	include_spip('inc/config');
	appliquer_modifs_config();
		
	return array('message_ok'=>_T('config_info_enregistree'));
}

?>