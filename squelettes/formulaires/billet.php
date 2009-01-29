<?php

include_spip('base/abstract_sql');

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

  // TODO : here, check for backlog and the like, while (more than 2) 
  // add 24 hours.

  $when += 7*3600; // Publish at 7:00 AM

  sql_updateq ("spip_articles",
    array ("statut" => "publie", "date" => date("Y-m-d H:i:s", $when)),
    "id_article = $id_article");

  return array('message_ok' => "done");
}

?>
