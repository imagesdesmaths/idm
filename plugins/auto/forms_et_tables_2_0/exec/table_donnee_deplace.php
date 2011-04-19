<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2006                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/


if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');
include_spip('inc/autoriser');
include_spip('inc/forms');  // ajax_retour compatibilite 1.9.1

function exec_table_donnee_deplace_dist()
{
	$id_donnee = _request('id_donnee');
	$id_form = _request('id_form');
	$table_donnee_deplace = charger_fonction('table_donnee_deplace','inc');
	$res = $table_donnee_deplace($id_donnee,$id_form);
	ajax_retour($res);
}

?>