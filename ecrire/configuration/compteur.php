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

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/presentation');
include_spip('inc/config');

function configuration_compteur_dist()
{
	global $spip_lang_right;

	$res = "<div class='verdana2'>"
	. _T('info_question_gerer_statistiques')
	. "</div>"
	. "<div class='verdana2'>"
	.  afficher_choix('activer_statistiques', 
			  $GLOBALS['meta']["activer_statistiques"],
			  array('oui' => _T('item_gerer_statistiques'),
				'non' => _T('item_non_gerer_statistiques')), ' &nbsp; ')
	  . "</div>";
	if ($GLOBALS['meta']["activer_statistiques"]=='oui'){
		$res .= "<br /><div class='verdana2' id='captures_voir'>"
		. _T('info_question_vignettes_referer')
		. "</div>"
		. "<div class='verdana2'>"
		.  afficher_choix('activer_captures_referers', 
				  $GLOBALS['meta']["activer_captures_referers"],
				  array('oui' => _T('info_question_vignettes_referer_oui'),
					'non' => _T('info_question_vignettes_referer_non')))
		  . "</div>";
	}


	$res = debut_cadre_trait_couleur("statistiques-24.gif", true, "", _T('info_forum_statistiques').aide ("confstat"))
	.  ajax_action_post('configurer', 'compteur', 'config_fonctions', '', $res)
	.  fin_cadre_trait_couleur(true);

	return ajax_action_greffe("configurer-compteur", '', $res);
}

?>
