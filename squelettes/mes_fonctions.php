<?php

global $tables_principales;
$tables_principales['spip_auteurs']['field']['billettiste'] = "enum('oui','non') NOT NULL DEFAULT 'non'";

$tables_principales['spip_auteurs']['field']['role'] = "ENUM ('visiteur','candidat','relecteur') NOT NULL DEFAULT 'visiteur'";
$tables_principales['spip_auteurs']['field']['math'] = "TINYTEXT";
$tables_principales['spip_auteurs']['field']['relecteur_combien'] = "INT NOT NULL DEFAULT 0";
$tables_principales['spip_auteurs']['field']['relecteur_quand'] = "TIMESTAMP";

global $tables_auxiliaires;
$tables_auxiliaires['spip_relecteurs_articles'] = array (
  'field' => array (
    'id_article' => 'BIGINT(21) NOT NULL',
    'id_auteur' => 'BIGINT(21) NOT NULL',
    'date_change' => 'TIMESTAMP',
    'status' => "ENUM('pas_vu','vu','non','moyen','oui')",
    'avis' => "TINYTEXT"),
  'key' => array());

global $table_des_tables;
$table_des_tables['relecteurs_articles'] = 'relecteurs_articles';

function lettrine ($texte) {
  $lines = explode ("\n", $texte);
  for ($i=0; $i<count($lines); $i++) {
    if (preg_match ('/(.*)<p>[\\s]*([A-Za-z]|&#171;)([A-Za-zç]*)/', $lines[$i], $matches)) {
      $lettrine = $matches[1] . '<p class="spip lettrine"><span class="lettrine"><span class="lettrine_first">' . $matches[2] . '</span>' . $matches[3] . '</span>';
      $lines[$i] = str_replace ($matches[0], $lettrine, $lines[$i]);
      break;
    } 
  }
  return implode ("\n", $lines);
}

function initiale ($mot) {
  return strtoupper($mot[0]);
}

function billettistes_effect_change ($target='', $caller='admin') {
  if (!$target) $target = str_replace('&amp;','&',self());

  if (!empty($_POST)) {
    foreach($_POST as $key=>$value) {
      if (preg_match('/^form_billettistes_bless_([0-9]*)$/', $key, $matches)) {
        $id = $matches[1];
        sql_updateq ('spip_auteurs', array('billettiste'=>'oui'), "id_auteur = $id");
        $reload = true;
      }

      if (preg_match('/^form_billettistes_demote_([0-9]*)$/', $key, $matches)) {
        $id = intval($matches[1]);
        sql_updateq ('spip_auteurs', array('billettiste'=>'non'), "id_auteur = $id");
        $reload = true;
      }

      if (preg_match('/^form_billettistes_salvage_([0-9]*)$/', $key, $matches)) {
        $id = intval($matches[1]);
        sql_updateq ('spip_articles', array('statut'=>'prepa'), "(id_article = $id) and (statut = 'tmp')");
        $reload = true;
      }

      if (preg_match('/^form_billettistes_erase_([0-9]*)$/', $key, $matches)) {
        $id = intval($matches[1]);
        sql_delete ('spip_articles', "id_article = $id");
        sql_delete ('spip_auteurs_articles', "(id_article = $id) and (statut = 'tmp')");
        $reload = true;
      }
    }

    if ($reload) {
      $_POST = array();
      @header ("Location: $target");
    }
  }
}
?>
