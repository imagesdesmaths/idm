<?php
include_spip ('base/serial.php');
include_spip ('inc/envoyer_mail');

global $tables_principales;
$tables_principales['spip_auteurs']['field']['role'] = "ENUM ('visiteur','candidat','relecteur') NOT NULL DEFAULT 'visiteur'";

global $tables_auxiliaires;
$tables_auxiliaires['spip_relecteurs_articles'] = array (
  'field' => array (
    'id_article' => 'BIGINT(21) NOT NULL',
    'id_auteur' => 'BIGINT(21) NOT NULL',
    'date_change' => 'TIMESTAMP',
    'status' => "ENUM('pas_vu','vu','non','moyen','oui')" ),
  'key' => array());

global $table_des_tables;
$table_des_tables['relecteurs_articles'] = 'relecteurs_articles';

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

function relecteurs_update_referee ($id, $status) {
  if (($status == 'visiteur') || ($status == 'candidat') || ($status == 'relecteur')) {
    sql_updateq ("spip_auteurs", array("role"=>$status), "id_auteur = $id");
  }
  if ($status == "visiteur") {
    sql_delete ("spip_relecteurs_articles", "id_auteur = $id");
  }
}

function relecteurs_nettoie () {
  $reload = false;

  $affectes = sql_allfetsel ( array("id_auteur","id_article"), "spip_relecteurs_articles" );
  foreach ($affectes as $line) {
    $id_auteur = $line["id_auteur"];
    $id_article = $line["id_article"];
    $statut = sql_getfetsel ("statut", "spip_articles", "id_article = $id_article");
    if ($statut != "prop") {
      sql_delete ("spip_relecteurs_articles", "id_auteur = $id_auteur");
      $reload = true;
    }
  }

  return $reload;
}

function relecteurs_effect_change ($target='', $caller='admin') {
  if (!$target) $target = str_replace('&amp;','&',self());

  $reload = relecteurs_nettoie();

  if (!empty($_POST)) {
    foreach($_POST as $key=>$value) {
      if (preg_match('/^form_relecteur_statut_([0-9]*)$/', $key, $matches)) {
        $id = $matches[1];
        if ( ($caller == 'admin') || (($matches[1] == $caller) && ($value != 'relecteur')) ) {
          relecteurs_update_referee ($matches[1],$value);
          $reload = true;
        }
      }

      if (preg_match('/^form_relecteur_exterminate_([0-9]*)$/', $key, $matches)) {
        if ( ($value == 'on') && (($caller == 'admin') || ($caller == $matches[1])) ) {
          $id_auteur = $matches[1];
          relecteurs_update_referee ($id_auteur,'visiteur');
          $reload = true;
        }
      }

      if (preg_match('/^form_relecteurs_vote_([0-9]*)_([0-9]*)$/', $key, $matches)) {
        $id_auteur = $matches[1];
        $id_article = $matches[2];
        if ( ($caller==$id_auteur) && (($value=='vu')||($value=='oui')||($value=='moyen')||($value=='non'))) {
          sql_updateq ("spip_relecteurs_articles", array("status"=>$value), "id_auteur = $id_auteur AND id_article = $id_article");
          $reload = true;
        }
      }

      if (preg_match('/^form_relecteurs_unassign_([0-9]*)_([0-9]*)$/', $key, $matches)) {
        if ($caller == 'admin') {
          $id_auteur = $matches[1];
          $id_article = $matches[2];
          sql_delete ("spip_relecteurs_articles", "id_auteur = $id_auteur AND id_article = $id_article");
          $reload = true;
        }
      }

      if (preg_match('/^form_relecteurs_assign_([0-9]*)_([0-9]*)$/', $key, $matches)) {
        if ($caller == 'admin') {
          $id_auteur = $matches[1];
          $id_article = $matches[2];
          sql_insertq ("spip_relecteurs_articles", array("id_auteur"=>$id_auteur, "id_article"=>$id_article));
          relecteurs_notify_user ($id_auteur, $id_article);
          $reload = true;
        }
      }
    }
  }

  // Si on a fait quelque chose, on recharge la page après avoir vidé 
  // $_POST (pour pouvoir lancer cette fonction plusieurs fois sur une 
  // même page sans risque - c'est sans doute inutile, en fait).

  if ($reload) {
    $_POST = array();
    @header ("Location: $target");
  }
}

function relecteurs_insert_head ($texte) {
  $texte .= "\n";
  $texte .= '<script type="text/javascript" src="' . find_in_path('javascript/jquery.tablesorter.min.js') . "\"></script>\n";
  $texte .= '<script type="text/javascript">' . "\n";
  $texte .= '  $(document).ready(function() { $(".sortable").tablesorter( {sortList : [[0,0]]} ); } ); ' . "\n";
  $texte .= '</script>' . "\n";
  return $texte;
}
?>
