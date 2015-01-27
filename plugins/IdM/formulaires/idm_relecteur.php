<?php

function formulaires_idm_relecteur_charger ($id_auteur) {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;

  $id_auteur = intval($id_auteur);
  $gars      = sql_fetsel ("*", "spip_idm_relecteurs", "id_auteur = $id_auteur");

  $params = array (
    "id_auteur" => $id_auteur,
    "categorie" => $gars["categorie"],
    "math"      => $gars["math"],
    "comment"   => $gars["comment"],
    "step"      => "display"
  );
  return $params;
}

function formulaires_idm_relecteur_verifier ($id_auteur) {
  $erreurs = array();
  //if (_request("step") == "display") $erreurs["step"] = "TEST ERROR CONDITION";
  //if (count($erreurs)) $erreurs['message_erreur'] = "Il y a une erreur !";
  return $erreurs;
}

function formulaires_idm_relecteur_traiter ($id_auteur) {
  $modif     = false;
  $id_auteur = intval($id_auteur);
  $gars      = sql_fetsel ("*", "spip_idm_relecteurs", "id_auteur = $id_auteur");

  if (_request("submit") == "Appliquer") {
    if (_request("math")      != $gars["math"])      { $gars["math"]      = _request("math");      $modif = true; }
    if (_request("comment")   != $gars["comment"])   { $gars["comment"]   = _request("comment");   $modif = true; }
    if (_request("categorie") != $gars["categorie"]) { $gars["categorie"] = _request("categorie"); $modif = true; }

    if ($modif) {
      sql_updateq ("spip_idm_relecteurs", $gars, "id_auteur = $id_auteur");
      return array ("message_ok" => "Modification effectu&eacute;e.");
    }
  }

  if (_request("submit") == "Desinscrire") {
    sql_updateq ("spip_idm_relecteurs", array("role"=>"visiteur"), "id_auteur = $id_auteur");
  }
}

?>
