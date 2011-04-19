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
include_spip('inc/actions');

// http://doc.spip.org/@inc_virtualiser_dist
function inc_virtualiser_dist($id_article, $virtuel, $script, $args){
	global $spip_lang_right;

	$res = "<input type='text' name='virtuel' id ='virtuel$id_article' class='formo spip_xx-small' value='"
	. ($virtuel ? "" : "http://")
	. $virtuel
	. "' size='40' /><br />\n"
	. "<span class='verdana1 spip_x-small'>(<label for='virtuel$id_article'><b>"
	. _T('texte_article_virtuel')
	. (!$virtuel ? '' : " $virtuel")
	. "&nbsp;:</b></label> "
	.  _T('texte_reference_mais_redirige')
	. ")</span><br />";

	$res = ajax_action_post('virtualiser', $id_article, $script, $args, $res, _T('bouton_changer'), " style='float: $spip_lang_right'")
	  . "<div class='nettoyeur'></div>";

	return ajax_action_greffe("virtualiser", $id_article, $res);
}
?>
