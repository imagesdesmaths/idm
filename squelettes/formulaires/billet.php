<?php

include_spip('base/abstract_sql');
include_spip('inc/envoyer_mail');

function notify_comite ($id_auteur, $titre, $date) {
  $email = "comite@images.math.cnrs.fr";
  $qui = sql_getfetsel ("nom", "spip_auteurs", "id_auteur = $id_auteur");
  $qui = utf8_decode ($qui);
  $titre = utf8_decode ($titre);

  $subject = "Un nouveau billet pour Images des Maths";

  $texte = "Bonjour !\n" .
    "\n" .
    "Un nouveau billet vient d'être validé pour Images des Maths.\n" .
    "\n" .
    "  Auteur : $qui\n" .
    "\n" .
    "  Titre : « $titre »\n" .
    "\n" .
    "Sans action de la part du comité éditorial, il sera publié à\n" .
    "la date suivante :\n" .
    "\n" .
    "  $date\n" .
    "\n" .
    "-- \n" .
    "Le comité de rédaction de \"Images des Mathématiques\".";

  inc_envoyer_mail_dist ($email, $subject, utf8_encode($texte));
}

function formulaires_billet_charger () {
  $valeurs = array('titre'=>'', 'texte'=>'', 'id_article'=>false);

  return $valeurs;
}

function formulaires_billet_verifier () {
  $erreurs = array();

  foreach(array('titre','texte') as $obligatoire)
    if (!_request($obligatoire))
      $erreurs[$obligatoire] = "Le champ '$obligatoire' est obligatoire !";

  if (!count($erreurs)) {
    if (!$id_article = _request("id_article")) {
      $id_article = sql_insertq ("spip_articles", array (
        "id_rubrique" => 6,
        "statut" => "tmp",
        "accepter_forum" => "abo",
        "date" => "NOW()"));

      sql_insertq ("spip_auteurs_articles",
        array ("id_article" => $id_article,
               "id_auteur" => $GLOBALS['auteur_session']['id_auteur']));
    }

    $id_article = intval($id_article);
    sql_updateq ('spip_articles',
                 array ("titre" => _request("titre"), "texte" => _request("texte")),
                 "id_article = $id_article");

    if (!_request("ok")) $erreurs['id_article'] = $id_article;
  }

  return $erreurs;
}

function formulaires_billet_traiter () {
  $id_article = intval(_request("id_article"));
  $id_auteur = $GLOBALS['auteur_session']['id_auteur'];
  
  $today = time();
  $today -= $today % (24*3600); // Midnight this morning

  $previous = sql_getfetsel ("UNIX_TIMESTAMP(date)",
    "spip_auteurs_articles,spip_articles",
    "(spip_articles.id_article=spip_auteurs_articles.id_article) AND (id_auteur=$id_auteur) AND (statut='publie')",
    array(), "date DESC", "1");
  $previous -= $previous % (24*3600); // Their last contribution to the site

  $when = max ($today + 2*24*3600, $previous + 7*24*3600); // Publish the day after tomorrow, with one week minimum for the same contributor.
  $when += 7*3600; // Publish at 7:00 AM

  $threshold = 2;

  while (true) {
    $sqldate = date("Y-m-d H:i:s", $when);
    $howmany = sql_countsel('spip_articles', "(id_rubrique=6) AND (statut='publie') AND (date='$sqldate')");
    if ($howmany<$threshold) break;
    $when += 24*3600;
    $threshold += 1;
  }

  sql_updateq ("spip_articles",
    array ("statut" => "publie", "date" => date("Y-m-d H:i:s", $when)),
    "id_article = $id_article");

  notify_comite ($id_auteur, _request("titre"), date("d/m/Y, H:i:s", $when));
  return array('message_ok' => "done");
}

?>
