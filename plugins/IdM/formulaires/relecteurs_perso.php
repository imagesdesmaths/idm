<?php

include_spip('base/abstract_sql');
include_spip('inc/envoyer_mail');
include_spip('inc/filtres');

function notify_franz ($id_auteur) {
  $email = "fridde2728@neuf.fr";
  $qui = sql_getfetsel ("nom", "spip_auteurs", "id_auteur = $id_auteur");
  $qui = utf8_decode ($qui);

  $subject = "Un nouveau relecteur pour Images des Maths";

  $texte = "Bonjour !\n" .
    "\n" .
    "Un nouveau visiteur vient de proposer ses services pour relire des\n" .
    "articles pour Images des maths. Il s'appelle\n" .
    "\n" .
    "  $qui\n" .
    "\n" .
    "-- \n" .
    "Le comité de rédaction de \"Images des Mathématiques\".";

  inc_envoyer_mail_dist ($email, $subject, utf8_encode($texte));
}

function formulaires_relecteurs_perso_charger () {
  $valeurs = array('qui'=>'');
  return $valeurs;
}

function formulaires_relecteurs_perso_verifier () {
  $erreurs = array();

  if (_request('inscription') AND !_request('qui')) 
    $erreurs['qui'] = "Dites-nous d'abord qui vous êtes !";

  return $erreurs;
}

function formulaires_relecteurs_perso_traiter () {
  $id_auteur = $GLOBALS['auteur_session']['id_auteur'];

  if (_request('inscription')) {
    sql_updateq ('spip_auteurs',
      array ('role' => 'candidat', 'math' => supprimer_tags(_request('qui'))),
      "id_auteur = $id_auteur");
    notify_franz ($id_auteur);
  } else {
    sql_updateq ('spip_auteurs',
      array ('role' => 'visiteur', 'math' => ''),
      "id_auteur = $id_auteur");
  }
}

?>
