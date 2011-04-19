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
include_spip('inc/instituer_forms_donnee');  // ajax_retour compatibilite 1.9.1

function exec_puce_statut_forms_donnee_dist()
{
	$id = _request('id');
	$s = spip_query(
	"SELECT id_form,statut FROM spip_forms_donnees WHERE id_donnee="._q($id));
	$r = spip_fetch_array($s);

	ajax_retour(puce_statut_donnee($id,$r['statut'],$r['id_form'],true));
}

?>