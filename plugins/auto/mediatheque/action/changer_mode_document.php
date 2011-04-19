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


// Cette action permet de basculer du mode image au mode document et vice versa

// http://doc.spip.org/@action_changer_mode_document_dist
function action_changer_mode_document_dist()
{
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	if (!preg_match(",^(\d+)\W(\w+)$,", $arg, $r))
		spip_log("action_changer_mode_document $arg pas compris");
	else action_changer_mode_document_post($r[1],$r[2]);
}

// http://doc.spip.org/@action_changer_mode_document_post
function action_changer_mode_document_post($id_document, $mode)
{
	// - id_document le doc a modifier
	// - mode le mode a lui donner
	if ($id_document = intval($id_document)
	AND in_array($mode, array('vignette', 'image', 'document'))) {
		sql_updateq('spip_documents', array('mode'=>$mode), 'id_document='.$id_document);
	}
}
?>
