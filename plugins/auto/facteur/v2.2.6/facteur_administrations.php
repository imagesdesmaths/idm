<?php
/*
 * Plugin Facteur 2
 * (c) 2009-2011 Collectif SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function facteur_upgrade($nom_meta_base_version, $version_cible){

	$maj = array();

	$maj['create'] = array(
		array('ecrire_meta','facteur_smtp', 'non'),
		array('ecrire_meta','facteur_smtp_auth', 'non'),
		array('ecrire_meta','facteur_smtp_secure', 'non'),
		array('ecrire_meta','facteur_smtp_sender', ''),
		array('ecrire_meta','facteur_filtre_images', 1),
		array('ecrire_meta','facteur_filtre_css', 0),
		array('ecrire_meta','facteur_filtre_iso_8859', 0),
		array('ecrire_meta','facteur_adresse_envoi', 'non'),
		array('facteur_vieil_upgrade'),
	);

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

function facteur_vieil_upgrade(){
	// migration depuis tres ancienne version, a la main
	if (isset($GLOBALS['meta']['spip_notifications_version'])) {
		ecrire_meta('facteur_smtp', $GLOBALS['meta']['spip_notifications_smtp']);
		ecrire_meta('facteur_smtp_auth', $GLOBALS['meta']['spip_notifications_smtp_auth']);
		ecrire_meta('facteur_smtp_secure', $GLOBALS['meta']['spip_notifications_smtp_secure']);
		ecrire_meta('facteur_smtp_sender', $GLOBALS['meta']['spip_notifications_smtp_sender']);
		ecrire_meta('facteur_filtre_images', $GLOBALS['meta']['spip_notifications_filtre_images']);
		ecrire_meta('facteur_filtre_css', $GLOBALS['meta']['spip_notifications_filtre_css']);
		ecrire_meta('facteur_filtre_iso_8859', $GLOBALS['meta']['spip_notifications_filtre_iso_8859']);
		ecrire_meta('facteur_adresse_envoi', $GLOBALS['meta']['spip_notifications_adresse_envoi']);
		ecrire_meta('facteur_adresse_envoi_nom', $GLOBALS['meta']['spip_notifications_adresse_envoi_nom']);
		ecrire_meta('facteur_adresse_envoi_email', $GLOBALS['meta']['spip_notifications_adresse_envoi_email']);
		// supprimer l'ancien nommage
		effacer_meta('spip_notifications_smtp');
		effacer_meta('spip_notifications_smtp_auth');
		effacer_meta('spip_notifications_smtp_secure');
		effacer_meta('spip_notifications_smtp_sender');
		effacer_meta('spip_notifications_filtre_images');
		effacer_meta('spip_notifications_filtre_css');
		effacer_meta('spip_notifications_filtre_iso_8859');
		effacer_meta('spip_notifications_adresse_envoi');
		effacer_meta('spip_notifications_adresse_envoi_nom');
		effacer_meta('spip_notifications_adresse_envoi_email');
		effacer_meta('spip_notifications_version');
		// KEZAKO ?
		include_spip('base/abstract_sql');
		sql_drop_table('spip_notifications', true);
	}
}


function facteur_vider_tables($nom_meta_base_version) {
	// cfg la dessus, ca serait mieux !
	effacer_meta('facteur_version');
	effacer_meta('facteur_smtp');
	effacer_meta('facteur_smtp_auth');
	effacer_meta('facteur_smtp_secure');
	effacer_meta('facteur_smtp_sender');
	effacer_meta('facteur_filtre_images');
	effacer_meta('facteur_filtre_css');
	effacer_meta('facteur_filtre_iso_8859');
	effacer_meta('facteur_adresse_envoi');
	effacer_meta('facteur_adresse_envoi_nom');
	effacer_meta('facteur_adresse_envoi_email');
	effacer_meta('facteur_cc');
	effacer_meta('facteur_bcc');
	effacer_meta($nom_meta_base_version);
}



?>
