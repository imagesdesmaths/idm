<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2007                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');
include_spip('inc/mail');
include_spip('inc/config');

function configuration_notifications_forum_dist()
{
	global $spip_lang_left;

	$res = "<div class='verdana2'>"
		. "<a href='".generer_url_ecrire('cfg', 'cfg=notifications')."'>"._T('notifications:message_voir_configuration')."</a>\n";
	$res .= "</div>\n";

	$res = debut_cadre_trait_couleur("", true, "", _L('Notifications'))
	. $res
	. fin_cadre_trait_couleur(true);

	return $res;
}

?>