<?php

include_spip('idm');

function notify_franz ($id_auteur) {
  $qui = sql_getfetsel ("nom", "spip_auteurs", "id_auteur = $id_auteur");

  $subject = "Un nouveau relecteur pour Images des Maths";

  $texte = "Un nouveau visiteur vient de proposer ses services pour relire des\n" .
           "articles pour Images des maths. Il s'appelle\n" .
           "\n" .
           "  $qui";

  idm_notify (327, $texte, $subject); // Christine Noot-Huyghe
  idm_notify (637, $texte, $subject); // Julien Melleray
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

  if (!sql_countsel ('spip_idm_relecteurs', "id_auteur = $id_auteur"))
    sql_insertq ('spip_idm_relecteurs', array("id_auteur" => $id_auteur));

  if (_request('inscription')) {
    sql_updateq ('spip_idm_relecteurs',
      array ('role' => 'candidat', 'math' => supprimer_tags(_request('qui'))),
      "id_auteur = $id_auteur");
    notify_franz ($id_auteur);
  } else {
    sql_updateq ('spip_idm_relecteurs',
      array ('role' => 'visiteur', 'math' => ''),
      "id_auteur = $id_auteur");
  }
}

?>
