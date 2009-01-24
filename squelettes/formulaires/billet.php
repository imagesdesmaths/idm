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
  
  $previous = sql_getfetsel ("UNIX_TIMESTAMP(date)",
    "spip_auteurs_articles,spip_articles",
    "(spip_articles.id_article=spip_auteurs_articles.id_article) AND (id_auteur=$id_auteur) AND (statut='publie')",
    array(), "date DESC", "1");

  $when = max (time(), $previous + 7*24*3600);

  sql_updateq ("spip_articles",
    array ("statut" => "publie", "date" => date("Y-m-d H:i:s", $when)),
    "id_article = $id_article");

  return array('message_ok' => "done");
}

?>
