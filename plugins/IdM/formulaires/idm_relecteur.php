<?php

function formulaires_idm_relecteur_charger ($id_auteur) {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;

  $id_auteur = intval($id_auteur);
  $gars      = sql_fetsel ("*", "spip_idm_relecteurs", "id_auteur = $id_auteur");

  $params = array (
    "id_auteur" => $id_auteur,
    "math"      => $gars["math"],
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

  if (_request("submit") != "Appliquer") return;

  if (_request("math") != $gars["math"]) {
    $gars["math"] = _request("math");
    $modif = true;
  }

  if ($modif) {
    sql_updateq ("spip_idm_relecteurs", $gars, "id_auteur = $id_auteur");
    return array ("message_ok" => "Modification effectu&eacute;e.");
  }
}

function formulaires_idm_projet_edit_traiter ($id_projet) {
  if (_request("submit") == "Modifier") return;

  $modif  = false;
  $projet = sql_fetsel (array("id_auteur","id_article","comment","statut"), "spip_idm_projets", "id_projet=$id_projet");

  if (intval($projet["id_auteur"]) != intval(_request("id_auteur"))) {
    $projet["id_auteur"] = _request("id_auteur");
    $modif = true;
  }

  if (intval($projet["id_article"]) != intval(_request("id_article"))) {
    $projet["id_article"] = _request("id_article");
    $modif = true;
  }

  if ($projet["comment"] != _request("comment")) {
    $projet["comment"] = _request("comment");
    $modif = true;
  }

  if ($projet["id_article"] AND $projet["id_auteur"] AND ($projet["statut"]=="contact")) {
    $projet["statut"] = "redaction";
    $modif = true;
  }

  if (_request("submit") == "Mettre en relecture") {
    $projet["statut"] = "relecture";
    $modif = true;
  }

  if (_request("submit") == "Supprimer") {
    $projet["statut"] = "refus";
    $modif = true;
  }

  if ($modif) sql_updateq ("spip_idm_projets", $projet, "id_projet=$id_projet");

  return array();
}

?>
