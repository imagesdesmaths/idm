<?php
/*
 * Plugin Notifications
 * (c) 2009-2012 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * Declarer le champ notification_email sur la table forum
 *
 * @param array $tables
 * @return array
 */
function notifications_declarer_tables_objets_sql($tables){

	// champ notification (editable via le form de forum) :
	// 0/1 (non abonne/abonne) defaut 1
	$tables['spip_forum']['field']['notification'] = "tinyint NOT NULL default 1";
	$tables['spip_forum']['champs_editables'][] = 'notification';

	// champ notification_email :
	// vide -> notification par le champ id_auteur ou email_auteur
	// email -> notification sur cet email (permet de maj l'email de notif sans modifier l'email de signature)
	$tables['spip_forum']['field']['notification_email'] = "text DEFAULT '' NOT NULL";

	return $tables;
}


/**
 * maj de table forum
 *
 * @param string $nom_meta_base_version
 * @param string $version_cible
 */
function notifications_upgrade($nom_meta_base_version,$version_cible){

	$maj = array();
	$maj['create'] = array(
		array('maj_tables',array('spip_forum')),
	);

	$maj['0.1.3'] = array(
		array('sql_alter',"TABLE spip_forum CHANGE notification notification_email text DEFAULT '' NOT NULL"),
		array('maj_tables',array('spip_forum')),
	);

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

function notifications_vider_tables($nom_meta_base_version) {
	#on ne drop pas pour ne pas perdre les reglages.. a voir
	#sql_alter("TABLE spip_forum DROP COLUMN notification");
	effacer_meta($nom_meta_base_version);
}
