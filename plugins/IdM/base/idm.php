<?php

function idm_declarer_tables_interfaces ($interfaces) {
  $interfaces['table_des_tables']['idm_relecteurs']      = 'idm_relecteurs';
  $interfaces['table_des_tables']['idm_teams']           = 'idm_teams';
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

  return $tables;
}

function idm_declarer_tables_auxiliaires ($tables) {
  $tables['spip_relecteurs_articles'] = array ('field' => array ('id_article'  => 'BIGINT(21) NOT NULL',
                                                                 'id_auteur'   => 'BIGINT(21) NOT NULL',
                                                                 'date_change' => 'TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP',
                                                                 'status'      => "ENUM('pas_vu','vu','non','moyen','oui') NOT NULL DEFAULT 'pas_vu'",
                                                                 'avis'        => "TINYTEXT"),
                                               'key' => array());

  $tables['spip_idm_relecteurs'] = array ('field' => array ('id_auteur'   => "BIGINT(21) NOT NULL",
                                                            'role'        => "ENUM ('visiteur', 'candidat', 'relecteur', 'occasionnel') NOT NULL DEFAULT 'visiteur'",
                                                            'math'        => "TEXT NOT NULL",
                                                            'combien'     => "INT NOT NULL DEFAULT 0",
                                                            'lus'         => "INT NOT NULL DEFAULT 0",
                                                            'comments'    => "INT NOT NULL DEFAULT 0",
                                                            'quand'       => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP",
                                                            'comment'     => "TEXT NOT NULL",
                                                            'categorie'   => "ENUM ('nouveau', 'chercheur', 'enseignant', 'etudiant', 'autre', 'candidat', 'non_classe') NOT NULL DEFAULT 'nouveau'"),
                                          'key' => array ('PRIMARY KEY' => "id_auteur"));

  $tables['spip_idm_teams'] = array ('field' => array ('team'      => "TINYTEXT",
                                                       'id_auteur' => "BIGINT(21) NOT NULL",
                                                       'id_member' => "BIGINT(21) NOT NULL"),
                                     'key' => array ('PRIMARY KEY' => "id_member",
                                                     'KEY id_auteur' => 'id_auteur'));

  return $tables;
}

?>
