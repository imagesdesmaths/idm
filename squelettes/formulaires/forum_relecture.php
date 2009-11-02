<?php

function formulaires_forum_relecture_charger ($id_article, $id_parent) {
  $id_article = intval ($id_article);
  $valeurs = array('titre'      => sql_getfetsel ('titre', 'spip_articles', "id_article = $id_article"),
                   'texte'      => '',
                   'id_article' => $id_article,
                   'id_parent'  => $id_parent);
  return $valeurs;
}

function formulaires_forum_relecture_verifier ($id_article, $id_parent) {
  $erreurs = array();

  foreach(array('titre','texte') as $o)
    if (!_request($o)) $erreurs[$o] = "Le champ '$o' est obligatoire !";

  if ((count($erreurs)==0) && (!_request("ok"))) $erreurs["preview"] = "preview";

  return $erreurs;
}

function formulaires_forum_relecture_traiter ($id_article, $id_parent) {
  $id_article = intval ($id_article);
  $id_parent  = intval ($id_parent);
  $id_auteur = intval ($GLOBALS['auteur_session']['id_auteur']);
  $auteur = sql_getfetsel ('nom', 'spip_auteurs', "id_auteur = $id_auteur");

  sql_insertq ('spip_forum', array (
    'id_parent'  => $id_parent,
    'id_article' => $id_article,
    'date_heure' => 'NOW()',
    'titre'      => _request("titre"),
    'texte'      => _request("texte"),
    'auteur'     => $auteur,
    'id_auteur'  => $id_auteur,
    'statut'     => 'relmod'
    ));

  return array ('message_ok' => "done");
}

?>
