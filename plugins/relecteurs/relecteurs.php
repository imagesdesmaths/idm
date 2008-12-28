<?php
include_spip ('base/serial.php');
include_spip ('inc/envoyer_mail');

function relecteurs_install ($action) {
  switch ($action) {
  case 'test':
    $desc = sql_showtable ('spip_relecteurs_articles');
    if ($desc) return true; else return false;
    break;

  case 'install':
    sql_alter ("TABLE spip_auteurs ADD `role` enum('visiteur','candidat','relecteur') NOT NULL DEFAULT 'visiteur'");
    sql_create ("spip_relecteurs_articles", array (
      'id_article' => 'BIGINT(21) NOT NULL',
      'id_auteur' => 'BIGINT(21) NOT NULL',
      'date_change' => 'TIMESTAMP',
      'status' => "ENUM('pas_vu','vu','non','moyen','oui') NOT NULL DEFAULT 'pas_vu'") );
    break;

  case 'uninstall':
    // bad idea to drop the table ...
  }
}	
?>
