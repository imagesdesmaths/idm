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

      if (preg_match('/^form_relecteurs_vote_([0-9]*)_([0-9]*)$/', $key, $matches)) {
        $id_auteur = $matches[1];
        $id_article = $matches[2];
        if ( ($caller==$id_auteur) && (($value=='vu')||($value=='oui')||($value=='moyen')||($value=='non'))) {
          sql_updateq ("spip_relecteurs_articles", array("status"=>$value), "id_auteur = $id_auteur AND id_article = $id_article");
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
?>
