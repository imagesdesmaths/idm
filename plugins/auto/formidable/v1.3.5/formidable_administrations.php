<?php

/**
 * Fichier gérant l'installation et désinstallation du plugin
 *
 * @package SPIP\Formidable\Installation
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Installation/maj des tables de formidable...
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
 */
function formidable_upgrade($nom_meta_base_version, $version_cible){
	// Création des tables
	include_spip('base/create');
	include_spip('base/abstract_sql');

	$maj = array();
	$maj['create'] = array(
		array('maj_tables',array(
			'spip_formulaires',
			'spip_formulaires_reponses',
			'spip_formulaires_reponses_champs',
			'spip_formulaires_liens')),
	);
	// Ajout du choix de ce qu'on affiche à la fin des traitements
	$maj['0.4.0'] = array(array('maj_tables',array('spip_formulaires')));
	// Ajout d'une URL de redirection
	$maj['0.5.0'] = array(array('maj_tables',array('spip_formulaires')));
	// Modif du type du message de retour pour pouvoir mettre plus de chose
	$maj['0.5.1'] = array(array('sql_alter','TABLE spip_formulaires CHANGE message_retour message_retour text NOT NULL default ""'));

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

/**
 * Désinstallation/suppression des tables de formidable
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
 */
function formidable_vider_tables($nom_meta_base_version){

	include_spip('inc/meta');
	include_spip('base/abstract_sql');

	// On efface les tables du plugin
	sql_drop_table('spip_formulaires');
	sql_drop_table('spip_formulaires_reponses');
	sql_drop_table('spip_formulaires_reponses_champs');
	sql_drop_table('spip_formulaires_liens');

	// On efface la version entregistrée
	effacer_meta($nom_meta_base_version);
}

?>
