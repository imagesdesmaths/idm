<?php

function formulaires_idm_projet_orphelin_charger ($id_article) {
  return array ("id_article"=> $id_article);
}

function formulaires_idm_projet_orphelin_verifier ($id_article) {
  return array();
}

function formulaires_idm_projet_orphelin_traiter ($id_article) {
  $article    = sql_fetsel ('*', 'spip_articles', "id_article = $id_article");
  $id_auteur  = sql_getfetsel ('id_auteur', 'spip_auteurs_articles', "id_article = $id_article");
  $nom_auteur = sql_getfetsel ('nom', 'spip_auteurs', "id_auteur = $id_auteur");

  sql_insertq ("spip_idm_projets", array(
    "id_editeur"  => $GLOBALS['auteur_session']['id_auteur'],
    "id_auteur"   => $id_auteur,
    "id_article"  => $id_article,
    "id_rubrique" => $article["id_rubrique"],
    "auteur"      => $nom_auteur,
    "sujet"       => $article["titre"],
    "modif"       => 'NOW()',
    "comment"     => '',
    "statut"      => 'redaction',
  ));

  return array ("message_ok" => "Projet cr&eacute;&eacute;.");
}

?>
