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



function configuration_porte_plume_dist()
{

	if (!$val =  $GLOBALS['meta']["barre_outils_public"]) {
		$val = 'oui';
	}
	$res = propre(_T("barre_outils:explication_barre_outils_public"));
	$res .= propre(_T("barre_outils:explication_barre_outils_public_2"));
	
	$res .= afficher_choix('barre_outils_public', $val,
		array(
			'oui' => _T("barre_outils:label_barre_outils_public_oui"),
			'non' => _T("barre_outils:label_barre_outils_public_non")
		), 
		" <br /> ");
	
	
	$res = debut_cadre_trait_couleur(find_in_path("images/porte-plume-24.png"), true, "", _T("barre_outils:info_porte_plume_titre"))
	. ajax_action_post('configurer', 'porte_plume', 'configuration','',$res)
	. fin_cadre_trait_couleur(true);

	return ajax_action_greffe('configurer-porte_plume', '', $res);

}
?>
