<?php
/**
 * Plugin Portfolio/Gestion des documents
 * Licence GPL (c) 2006-2008 Cedric Morin, romy.tetue.net
 *
 */

function gestdoc_declarer_tables_interfaces($interface){
	$interface['exceptions_des_tables']['documents']['media']=array('types_documents', 'media');
	return $interface;
}

function gestdoc_declarer_tables_principales($tables_principales){
	
	$tables_principales['spip_documents']['field']['fichier'] = "text NOT NULL DEFAULT ''";
	$tables_principales['spip_types_documents']['field']['media'] = "varchar(10) DEFAULT 'file' NOT NULL";
	$tables_principales['spip_documents']['field']['statut'] = "varchar(10) DEFAULT '0' NOT NULL";
	$tables_principales['spip_documents']['field']['credits'] = "varchar(255) DEFAULT '' NOT NULL";	
	$tables_principales['spip_documents']['field']['date_publication'] = "datetime DEFAULT '0000-00-00 00:00:00' NOT NULL";
	$tables_principales['spip_documents']['field']['brise'] = "tinyint DEFAULT 0";
	return $tables_principales;
}

function gestdoc_declarer_tables_auxiliaires($tables_auxiliaires){


	return $tables_auxiliaires;
}

function gestdoc_upgrade($nom_meta_base_version,$version_cible){
	$current_version = 0.0;
	if (   (!isset($GLOBALS['meta'][$nom_meta_base_version]) )
			|| (($current_version = $GLOBALS['meta'][$nom_meta_base_version])!=$version_cible)){
		if (version_compare($current_version,'0.2','<')){
			include_spip('base/abstract_sql');
			sql_alter("TABLE spip_types_documents ADD media varchar(10) DEFAULT 'file' NOT NULL");
			gestdoc_check_type_media();
			sql_alter("TABLE spip_documents ADD statut varchar(10) DEFAULT '0' NOT NULL");
			ecrire_meta($nom_meta_base_version,$current_version="0.2",'non');
		}
		if (version_compare($current_version,'0.3','<')){
			include_spip('base/abstract_sql');
			// ajouter un champ
			sql_alter("TABLE spip_documents ADD date_publication datetime DEFAULT '0000-00-00 00:00:00' NOT NULL");
			// vider le cache des descriptions de tables
			$trouver_table = charger_fonction('trouver_table','base');
			$trouver_table(false);
			// reinit les statuts pour ceux qui avaient subi une version 0.2 bugguee
			sql_updateq('spip_documents',array('statut'=>'0'));
			// ecrire la version pour ne plus passer la
			ecrire_meta($nom_meta_base_version,$current_version="0.3",'non');
		}			
		if (version_compare($current_version,'0.4','<')){
			// recalculer tous les statuts en tenant compte de la date de publi des articles...
			$res = sql_select('id_document','spip_documents',"statut='0'");
			include_spip('action/editer_document');
			while ($row = sql_fetch($res))
				instituer_document($row['id_document']);
			ecrire_meta($nom_meta_base_version,$current_version="0.4",'non');
		}
		if (version_compare($current_version,'0.5','<')){
			include_spip('base/abstract_sql');
			// ajouter un champ
			sql_alter("TABLE spip_documents ADD brise tinyint DEFAULT 0");
			// vider le cache des descriptions de tables
			$trouver_table = charger_fonction('trouver_table','base');
			$trouver_table(false);
			ecrire_meta($nom_meta_base_version,$current_version="0.5",'non');
		}
		if (version_compare($current_version,'0.6','<')){
			include_spip('base/abstract_sql');
			sql_alter("TABLE spip_types_documents ADD media varchar(10) DEFAULT 'file' NOT NULL");
			gestdoc_check_type_media();
			ecrire_meta($nom_meta_base_version,$current_version="0.6",'non');
		}
		if (version_compare($current_version,'0.7','<')){
			include_spip('base/abstract_sql');
			sql_alter("TABLE spip_documents ADD credits varchar(255) DEFAULT '' NOT NULL");
			ecrire_meta($nom_meta_base_version,$current_version="0.7",'non');
		}
		if (version_compare($current_version,'0.8','<')){
			// reset des statut='0' pour forcer un recalcul de tous les statuts
			include_spip('base/abstract_sql');
			sql_updateq('spip_documents',array("statut"=>'0'));
			ecrire_meta($nom_meta_base_version,$current_version="0.8",'non');
		}
		// version 0.9 n'avait pas DEFAULT '' sur le champ fichier
		if (version_compare($current_version,'0.10','<')){
			// Augmentation de la taille du champ fichier pour permettre les URL longues
			include_spip('base/abstract_sql');
			sql_alter("TABLE spip_documents CHANGE fichier fichier TEXT NOT NULL DEFAULT ''");
			ecrire_meta($nom_meta_base_version,$current_version="0.10",'non');
		}
	}
	gestdoc_check_statuts();
	gestdoc_check_type_media();
}

function gestdoc_check_type_media(){
	include_spip('base/abstract_sql');
	// mettre a jour les bonnes valeurs
	// les cas evidents
	sql_updateq('spip_types_documents',array('media'=>'image'),"mime_type REGEXP '^image/'");
	sql_updateq('spip_types_documents',array('media'=>'audio'),"mime_type REGEXP '^audio/'");
	sql_updateq('spip_types_documents',array('media'=>'video'),"mime_type REGEXP '^video/'");
	// les cas particuliers ...
	sql_updateq('spip_types_documents',array('media'=>'video'),"mime_type='application/ogg' OR mime_type='application/x-shockwave-flash'");
	sql_updateq('spip_types_documents',array('media'=>'image'),"mime_type='application/illustrator'");
	sql_updateq('spip_types_documents',array('media'=>'video'),"mime_type='application/mp4'");
}
function gestdoc_check_statuts(){
	$trouver_table = charger_fonction('trouver_table','base');
	$desc = $trouver_table('documents');
	if (!isset($desc['field']['statut']))
		return;

	$docs = array_map('reset',sql_allfetsel('id_document','spip_documents',"statut='0'"));
	if (count($docs)){
		include_spip('action/editer_document');
		foreach($docs as $id_document)
			// mettre a jour le statut si necessaire
			instituer_document($id_document);
	}
}

function gestdoc_install($action,$prefix,$version_cible){
	$version_base = $GLOBALS[$prefix."_base_version"];
	switch ($action){
		case 'test':
			gestdoc_check_statuts();
			gestdoc_check_type_media();
			return (isset($GLOBALS['meta'][$prefix."_base_version"])
				AND version_compare($GLOBALS['meta'][$prefix."_base_version"],$version_cible,">="));
			break;
		case 'install':
			gestdoc_upgrade('gestdoc_base_version',$version_cible);
			break;
		case 'uninstall':
			//gestdoc_vider_tables();
			break;
	}
}

?>
