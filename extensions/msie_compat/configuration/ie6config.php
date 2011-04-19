<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2010                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');
include_spip('inc/config');



function configuration_ie6config()
{
	$iecompat = $GLOBALS['meta']["iecompat"];
	if (!$iecompat) $iecompat = "non";

	$res = _T("msiecompat:choix_explication");
	
	$res .= afficher_choix('iecompat', $iecompat,
		array('non' => _T("msiecompat:choix_non"),
			'ifixpng' => _L('iFixPng'),
			'IE7' => _L("IE7.js"),
			'IE7squish' => _L("IE7.js + ie7-squish.js"),
			'IE8' => _L('IE8.js'),
			'IE8squish' => _L('IE8.js + ie7-squish.js')
			/*,
			'IE9' => _L('IE9.js'),
			'IE9squish' => _L('IE9.js + ie7-squish.js')
			*/
		), 
		" <br /> ");
	
	
	$res = debut_cadre_trait_couleur(find_in_path("imgs/ie6-logo24.png"), true, "", _T("msiecompat:choix_titre"))
	. ajax_action_post('configurer', 'ie6config', 'configuration','',$res)
	. fin_cadre_trait_couleur(true);

	return ajax_action_greffe('configurer-ie6config', '', $res);

}
?>
