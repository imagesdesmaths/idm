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

if (!defined("_ECRIRE_INC_VERSION")) return;

function formulaires_configurer_revisions_objets_charger_dist(){
	if (!$objets = unserialize($GLOBALS['meta']['objets_versions']))
		$objets = array();
	$valeurs = array(
		'objets_versions'=>$objets,
	);

	return $valeurs;
}

function formulaires_configurer_revisions_objets_traiter_dist(){

	include_spip('inc/meta');
	$tables = serialize(_request('objets_versions'));
	ecrire_meta('objets_versions',$tables);

	return array('message_ok'=>_T('config_info_enregistree'));
}

?>