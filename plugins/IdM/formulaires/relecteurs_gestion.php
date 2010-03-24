<?php

include_spip('base/abstract_sql');
include_spip('inc/filtres');

function formulaires_relecteurs_gestion_charger () {
  $valeurs = array();
  
  $candidats = sql_allfetsel (array("id_auteur","math"), "spip_idm_relecteurs", "role = 'candidat' OR role = 'relecteur'");
  foreach ($candidats as $row) {
    $id = $row["id_auteur"];
    $valeurs["decision_$id"] = "oui";
    $valeurs["math_$id"] = $row["math"];
  }

  return $valeurs;
}

function formulaires_relecteurs_gestion_verifier () {
  $erreurs = array();
  return $erreurs;
}

function formulaires_relecteurs_gestion_traiter () {
  $candidats = sql_allfetsel (array("id_auteur","math","role"), "spip_idm_relecteurs", "role = 'candidat' OR role = 'relecteur'");
  foreach ($candidats as $row) {
    $id = $row["id_auteur"];
    if ($row["role"] == "candidat") {
      $decision = _request("decision_$id");
      if ($decision == "oui") sql_updateq ("spip_idm_relecteurs", array("role"=>"relecteur", "math" => supprimer_tags(_request("math_$id"))), "id_auteur=$id");
      if ($decision == "non") sql_updateq ("spip_idm_relecteurs", array("role"=>"visiteur", "math" => supprimer_tags(_request("math_$id"))), "id_auteur=$id");
    } else {
      if (_request("math_$id") != $row["math"]) sql_updateq ("spip_idm_relecteurs", array("math"=>supprimer_tags(_request("math_$id"))), "id_auteur=$id");
      if (_request("exterminate_$id"))          sql_updateq ("spip_idm_relecteurs", array("role"=>"visiteur"), "id_auteur=$id");
    }
  }
}

?>
