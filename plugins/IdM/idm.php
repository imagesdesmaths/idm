<?php

include_spip('inc/envoyer_mail');

global $tables_principales;
global $tables_auxiliaires;
global $table_des_tables;

$tables_principales['spip_idm_projets'] = array (
  'field' => array (
    'id_projet'   => 'BIGINT(21) NOT NULL',
    'id_editeur'  => 'BIGINT(21) NOT NULL',
    'id_auteur'   => 'BIGINT(21) NOT NULL default 0',
    'id_article'  => 'BIGINT(21) NOT NULL default 0',
    'id_rubrique' => 'BIGINT(21) NOT NULL',
    'auteur'      => 'TINYTEXT NOT NULL',
    'sujet'       => 'TINYTEXT NOT NULL',
    'modif'       => 'TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP',
    'comment'     => 'TEXT NOT NULL',
    'statut'      => "ENUM ('contact', 'redaction', 'relecture', 'publie', 'refus') NOT NULL DEFAULT 'contact'"),
  'key' => array (
    'PRIMARY KEY' => 'id_projet'));

$tables_principales['spip_idm_relecteurs'] = array (
  'field' => array (
    'id_auteur'   => "BIGINT(21) NOT NULL",
    'role'        => "ENUM ('visiteur', 'candidat', 'relecteur', 'occasionnel') NOT NULL DEFAULT 'visiteur'",
    'math'        => "TEXT NOT NULL",
    'combien'     => "INT NOT NULL DEFAULT 0",
    'lus'         => "INT NOT NULL DEFAULT 0",
    'comments'    => "INT NOT NULL DEFAULT 0",
    'quand'       => "TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP",
    'comment'     => "TEXT NOT NULL",
    'categorie'   => "ENUM ('nouveau', 'chercheur', 'enseignant', 'etudiant', 'autre', 'candidat', 'non_classe') NOT NULL DEFAULT 'nouveau'"),
  'key' => array(
    'PRIMARY KEY' => "id_auteur"));

$tables_principales['spip_idm_sujets'] = array ('field' => array ('id_sujet' => "BIGINT(21) NOT NULL",
                                                                  'id_parent' => "BIGINT(21) NOT NULL DEFAULT 0",
                                                                  'intitule' => "TINYTEXT NOT NULL",
                                                                  'description' => "TEXT NOT NULL"),
                                                'key' => array ('PRIMARY KEY' => "id_sujet"));

$tables_auxiliaires['spip_relecteurs_articles'] = array (
  'field' => array (
    'id_article'  => 'BIGINT(21) NOT NULL',
    'id_auteur'   => 'BIGINT(21) NOT NULL',
    'date_change' => 'TIMESTAMP NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP',
    'status'      => "ENUM('pas_vu','vu','non','moyen','oui') NOT NULL DEFAULT 'pas_vu'",
    'avis'        => "TINYTEXT"),
  'key' => array());

$tables_auxiliaires['spip_idm_sujets_articles'] = array ('field' => array ('id_sujet' => "BIGINT(21) NOT NULL",
                                                                           'id_article' => "BIGINT(21) NOT NULL"),
                                                         'key' => array ());

$table_des_tables['idm_projets']         = 'idm_projets';
$table_des_tables['idm_relecteurs']      = 'idm_relecteurs';
$table_des_tables['idm_sujets']          = 'idm_sujets';
$table_des_tables['relecteurs_articles'] = 'relecteurs_articles';
$table_des_tables['idm_sujets_articles'] = 'idm_sujets_articles';

function idm_install ($action) {
  switch ($action) {
  case 'test':
    $desc = sql_showtable ('spip_idm_sujets');
    if ($desc AND $desc['field']['description']) return true; else return false;
    break;

  case 'install':
    include_spip ('base/create');
    creer_base();
    maj_tables(array('spip_idm_projets',
                     'spip_idm_relecteurs',
                     'spip_idm_sujets',
                     'spip_relecteurs_articles',
                     'spip_idm_sujets_articles'));
    break;

  case 'uninstall':
    // bad idea to drop the table ...
    break;
  }
}

function idm_boite_infos (&$flux) {
  if ($flux['args']['type'] == 'article'
    AND $id_article = intval($flux['args']['id'])
    AND $statut = $flux['args']['row']['statut']
    AND $statut == 'prop') {

      $message = 'G&eacute;rer la relecture';
      $url     = generer_url_public ("propose", array("id_article" => $id_article));
      $previsu = icone_horizontale ($message, $url, find_in_path("img/relecteurs.gif"), "rien.gif", false);

      if ($p = strpos ($flux['data'], '</ul>')) {
        while ($q = strpos ($flux['data'],'</ul>',$p+5))
          $p=$q;
        $flux['data'] = substr($flux['data'],0,$p+5) . $previsu . substr($flux['data'],$p+5);
      }
      else $flux['data'] .= $previsu;
    }

  return $flux;
}

function idm_autoriser() {}

function autoriser_article_relire_dist ($faire, $type, $id, $qui, $opt) {
  if ($qui['id_auteur'] == 0) return false;
  if ($qui['statut'] == '0minirezo') return true;

  $id_auteur = $qui['id_auteur'];
  if (sql_countsel('spip_auteurs_articles', "id_article = $id AND id_auteur = $id_auteur")) return true;
  if (sql_countsel('spip_relecteurs_articles', "id_article = $id AND id_auteur = $id_auteur")) return true;

  return false;
}

function autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt) {
  if ($qui['statut'] == '0minirezo') return true;
  return false;
}

function autoriser_idm_projets_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function autoriser_idm_relecteurs_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function autoriser_idm_relecture_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function autoriser_idm_moderation_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function autoriser_idm_billettistes_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function idm_notify ($id, $message, $subject = "Un message du site \"Images des Maths\"") {
  $email   = sql_getfetsel ("email", "spip_auteurs", "id_auteur = $id");
  $message = "Bonjour !\n\n" . $message . "\n\n-- \nLe robot du site http://images.math.cnrs.fr/\n";

  $envoyer_mail = charger_fonction ('envoyer_mail', 'inc');
  $envoyer_mail ($email, $subject, $message);
}

function idm_jquery_plugins ($scripts) {
  $scripts[] = 'javascript/jquery-ui.min.js';
  $scripts[] = 'javascript/jquery.checkboxtree.js';
  $scripts[] = 'javascript/jquery.tablesorter.min.js';
  return $scripts;
}

function idm_import_sujets () {
  $raw = file_get_contents(find_in_path("Dewey.org"));

  preg_match_all ('/\| ([0-9\.]*) *\| ([0-9\.]*) *\| ([^\|]*[^ ]) *\|/',
                  $raw, $out, PREG_SET_ORDER);

  foreach ($out as $r)
    sql_insertq ("spip_idm_sujets",
                 array("id_sujet" => $r[1],
                       "id_parent" => $r[2],
                       "intitule" => $r[3]));
}

function idm_dewey ($cote) {
  return preg_replace ('/([0-9][0-9][0-9])([0-9]+)/', '$1.$2', $cote);
}

?>
