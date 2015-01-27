<?php

function formulaires_relecteurs_mail_charger ($id_article) {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;

  $titre      = sql_getfetsel ("titre", "spip_articles", "id_article = $id_article");

  $params = array (
    "id_article" => $id_article,
    "titre"      => $titre,
    "texte"      => ""
  );
  return $params;
}

function formulaires_relecteurs_mail_verifier ($id_article) {
  $erreurs = array();
  if (strlen(_request("texte")) < 20)
    $erreurs["texte"] = "Texte trop court !";
  return $erreurs;
}

function formulaires_relecteurs_mail_traiter ($id_article) {
  $titre   = sql_getfetsel ("titre", "spip_articles", "id_article = $id_article");
  $subject = "IdM - Relecture de l'article \"$titre\"";
  $message = _request("texte");

  $ids = array();
  foreach (sql_allfetsel ("*", "spip_relecteurs_articles", "id_article = $id_article") as $e)
    $ids[] = intval($e["id_auteur"]);

  include_spip ('idm');
  idm_notify ($ids,$message,$subject);

  return array ('message_ok' => "done");
}

?>
