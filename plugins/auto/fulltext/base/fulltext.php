<?php
/**
 * Plugin Fulltext
 */

function fulltext_declarer_tables_principales($tables_principales) {
	$tables_principales['spip_documents']['field']['contenu'] = "TEXT DEFAULT '' NOT NULL";
	$tables_principales['spip_documents']['field']['extrait'] = "VARCHAR(3) NOT NULL default 'non'";

	return $tables_principales;
}

function fulltext_upgrade($nom_meta_base_version, $version_cible) {
  $current_version = 0.0;
  if ((!isset($GLOBALS['meta'][$nom_meta_base_version]))
      || (($current_version = $GLOBALS['meta'][$nom_meta_base_version])!=$version_cible)){
    if (version_compare($current_version,'0.1','<')) {
     	include_spip('base/abstract_sql');
			sql_alter("TABLE spip_documents ADD contenu TEXT DEFAULT '' NOT NULL");
			sql_alter("TABLE spip_documents ADD indexe VARCHAR(3) NOT NULL default 'non'");
			// vider le cache des descriptions de tables
			$trouver_table = charger_fonction('trouver_table','base');
			$trouver_table(false);
			ecrire_meta($nom_meta_base_version,$current_version="0.1",'non');
    }
    if (version_compare($current_version,'0.2','<')) {
      include_spip('base/abstract_sql');
      sql_alter("TABLE spip_documents CHANGE indexe extrait VARCHAR(3) NOT NULL default 'non'");
      // vider le cache des descriptions de tables
      $trouver_table = charger_fonction('trouver_table', 'base');
      $trouver_table(false);
      ecrire_meta($nom_meta_base_version,$current_version="0.2",'non');
    }
  }
}

?>