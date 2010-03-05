<?php

function formulaires_idm_projet_edit_charger ($id_projet) {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;

  $params = array ("id_projet"=>$id_projet, "step"=>"display");

  $params["id_auteur"]  = sql_getfetsel ("id_auteur",  "spip_idm_projets", "id_projet=$id_projet");
  $params["id_article"] = sql_getfetsel ("id_article", "spip_idm_projets", "id_projet=$id_projet");
  $params["comment"]    = sql_getfetsel ("comment",    "spip_idm_projets", "id_projet=$id_projet");

  return $params;
}

function formulaires_idm_projet_edit_verifier ($id_projet) {
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
