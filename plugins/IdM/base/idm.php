<?php

function idm_declarer_tables_interfaces ($interfaces) {
  $interfaces['table_des_tables']['idm_relecteurs']      = 'idm_relecteurs';
  $interfaces['table_des_tables']['idm_relecture']      = 'idm_relecture';
  $interfaces['table_des_tables']['idm_teams']           = 'idm_teams';
  $interfaces['table_des_tables']['idm_abonnements']     = 'idm_abonnements';
  $interfaces['table_des_tables']['relecteurs_articles'] = 'relecteurs_articles';
  $interfaces['table_des_traitements']['NOM'][0] = str_replace ('%s', 'idm_prenom_nom(%s)', $interfaces['table_des_traitements']['NOM'][0]);

  return $interfaces;
}

function idm_declarer_tables_objets_sql ($tables) {
  $tables['spip_auteurs']['field']['billettiste']   = "ENUM('oui','non') DEFAULT 'non' NOT NULL";
  $tables['spip_articles']['field']['id_editeur']   = "BIGINT(21) NOT NULL";
  $tables['spip_articles']['field']['date_prevue']  = "DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL";
  $tables['spip_articles']['field']['commentaires'] = "TEXT NOT NULL";
  $tables['spip_articles']['field']['prevu']        = "ENUM('oui','non') DEFAULT 'non' NOT NULL";
  $tables['spip_articles']['field']['statut_textes_instituer'] = array(
    'idee'     => 'texte_statut_idee',
    'prepa'    => 'texte_statut_en_cours_redaction',
    'prop'     => 'texte_statut_propose_evaluation',
    'publie'   => 'texte_statut_publie',
    'refuse'   => 'texte_statut_refuse',
    'poubelle' => 'texte_statut_poubelle'
  );

  return $tables;
}

function idm_declarer_tables_auxiliaires ($tables) {
  $tables['spip_relecteurs_articles'] = array (
    'field' => array (
      'id_article'  => 'BIGINT(21) NOT NULL',
      'id_auteur'   => 'BIGINT(21) NOT NULL',
      'date_change' => 'TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP',
      'status'      => "ENUM('pas_vu','vu','non','moyen','oui') NOT NULL DEFAULT 'pas_vu'",
      'avis'        => "TINYTEXT"
    ),
    'key' => array()
  );

  $tables['spip_idm_relecteurs'] = array (
    'field' => array (
      'id_auteur'   => "BIGINT(21) NOT NULL",
      'role'        => "ENUM ('visiteur', 'candidat', 'relecteur', 'occasionnel') NOT NULL DEFAULT 'visiteur'",
      'math'        => "TEXT NOT NULL",
      'combien'     => "INT NOT NULL DEFAULT 0",
      'lus'         => "INT NOT NULL DEFAULT 0",
      'comments'    => "INT NOT NULL DEFAULT 0",
      'quand'       => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP",
      'comment'     => "TEXT NOT NULL",
      'categorie'   => "ENUM ('nouveau', 'chercheur', 'enseignant', 'etudiant', 'lyceen', 'autre', 'candidat', 'non_classe', 'inactif') NOT NULL DEFAULT 'nouveau'"
    ),
    'key' => array (
      'PRIMARY KEY' => "id_auteur"
    )
  );

  $tables['spip_idm_relecture'] = array (
    'field' => array (
      'date'       => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
      'id_auteur'  => "BIGINT(21) NOT NULL",
      'action'     => "ENUM ('born', 'affected', 'read', 'comment', 'complete', 'lazy', 'silent')",
      'id_article' => "BIGINT(21) NOT NULL",
      'id_forum'   => "BIGINT(21) NOT NULL",
      'active'     => "ENUM ('no', 'yes') DEFAULT 'yes'"
    ),
    'key' => array()
  );

  $tables['spip_idm_teams'] = array (
    'field' => array (
      'team'      => "TINYTEXT",
      'id_auteur' => "BIGINT(21) NOT NULL",
      'id_member' => "BIGINT(21) NOT NULL"
    ),
    'key' => array (
      'PRIMARY KEY' => "id_member",
      'KEY id_auteur' => 'id_auteur'
    )
  );

  $tables['spip_idm_abonnements'] = array (
    'field' => array (
      'id_abonnement'       => "BIGINT(21) NOT NULL",
      'email'               => "VARCHAR(50) NOT NULL",
      'date_inscription'    => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP",
      'date_desinscription' => "TIMESTAMP NULL default NULL"
    ),
    'key' => array (
      'PRIMARY KEY' => "id_abonnement"
    )
  );

  return $tables;
}

?>
