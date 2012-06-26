<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/meta');

// Installation et mise à jour
function formidable_upgrade($nom_meta_version_base, $version_cible){

	$version_actuelle = '0.0';
	if (
		(!isset($GLOBALS['meta'][$nom_meta_version_base]))
		|| (($version_actuelle = $GLOBALS['meta'][$nom_meta_version_base]) != $version_cible)
	){
		
		if (version_compare($version_actuelle,'0.0','=')){
			// Création des tables
			include_spip('base/create');
			include_spip('base/abstract_sql');
			creer_base();
			
			echo "Installation du plugin formidable<br/>";
			ecrire_meta($nom_meta_version_base, $version_actuelle=$version_cible, 'non');
		}
		
		// Ajout du choix de ce qu'on affiche à la fin des traitements
		if (version_compare($version_actuelle,$version_cible='0.4.0','<')){	
			include_spip('base/create');
			maj_tables('spip_formulaires');

			echo "Mise à jour du plugin formidable en version 0.4.0<br/>";
			ecrire_meta($nom_meta_version_base, $version_actuelle=$version_cible, 'non');
		}
		
		// Ajout d'une URL de redirection
		if (version_compare($version_actuelle,$version_cible='0.5.0','<')){	
			include_spip('base/create');
			maj_tables('spip_formulaires');
			
			echo "Mise à jour du plugin formidable en version 0.5.0<br/>";
			ecrire_meta($nom_meta_version_base, $version_actuelle=$version_cible, 'non');
		}
		
		// Modif du type du message de retour pour pouvoir mettre plus de chose
		if (version_compare($version_actuelle,$version_cible='0.5.1','<')){	
			include_spip('base/abstract_sql');
			sql_alter('TABLE spip_formulaires CHANGE message_retour message_retour text NOT NULL default ""');
			
			echo "Mise à jour du plugin formidable en version 0.5.1<br/>";
			ecrire_meta($nom_meta_version_base, $version_actuelle=$version_cible, 'non');
		}
	}
	
}

// Désinstallation
function formidable_vider_tables($nom_meta_version_base){

	include_spip('base/abstract_sql');
	
	// On efface les tables du plugin
	sql_drop_table('spip_formulaires');
	sql_drop_table('spip_formulaires_reponses');
	sql_drop_table('spip_formulaires_reponses_champs');
	sql_drop_table('spip_formulaires_liens');
		
	// On efface la version entregistrée
	effacer_meta($nom_meta_version_base);

}

?>
