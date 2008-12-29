<?php

include_spip('base/abstract_sql');
include_spip('inc/filtres');

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
  } else {
    sql_updateq ('spip_auteurs',
      array ('role' => 'visiteur', 'math' => ''),
      "id_auteur = $id_auteur");
  }
}

?>
