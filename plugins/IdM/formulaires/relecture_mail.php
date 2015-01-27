<?php

include_spip('base/abstract_sql');

function formulaires_relecture_mail_charger ($id_article) {
  $valeurs = array('id_article'=>$id_article);
  return $valeurs;
}

function formulaires_relecture_mail_verifier ($id_article) {
  $erreurs = array();
  return $erreurs;
}

function formulaires_relecture_mail_traiter ($id_article) {
  if(isset($_POST['send_mail'])) {
    $ids = array_map('intval', explode(';', trim($_POST['send_mail_billettistes'], ';')));
    $message = $_POST['send_mail_message'];
    $subject = "Relecture d'un article pour Images des Maths";
    idm_notify($ids, $message, $subject);
  }
}

?>