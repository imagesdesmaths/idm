<?php
/*
 * Plugin Facteur 2
 * (c) 2009-2011 Collectif SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function facteur_ieconfig_metas($table){
	$table['facteur']['titre'] = _T('facteur:configuration_facteur');
	$table['facteur']['icone'] = 'facteur-16.png';
	$table['facteur']['metas_brutes'] = 'facteur_adresse_envoi,facteur_adresse_envoi_nom,facteur_adresse_envoi_email,facteur_smtp,facteur_smtp_host,facteur_smtp_port,facteur_smtp_auth,facteur_smtp_username,facteur_smtp_password,facteur_smtp_secure,facteur_smtp_sender,facteur_filtre_images,facteur_filtre_css,facteur_filtre_iso_8859';
	return $table;
}

?>