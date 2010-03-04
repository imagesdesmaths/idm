<?php

function formulaires_idm_projet_edit_charger ($id_projet) {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;

  $params = array ("id_projet"=>$id_projet, "step"=>"display");

  $params["id_auteur"]  = sql_getfetsel ("id_auteur",  "spip_idm_projets", "id_projet=$id_projet");
  $params["id_article"] = sql_getfetsel ("id_article", "spip_idm_projets", "id_projet=$id_projet");

  return $params;
}

function formulaires_idm_projet_edit_verifier ($id_projet) {
}

function formulaires_idm_projet_edit_traiter ($id_projet) {
  if (_request("step") != "display") return;
  $modif = false;

  $old_id_auteur = intval (sql_getfetsel ("id_auteur","spip_idm_projets","id_projet=$id_projet"));
  $new_id_auteur = intval (_request("id_auteur"));

  if ($new_id_auteur != $old_id_auteur) {
    sql_updateq ("spip_idm_projets", array("id_auteur"=>$new_id_auteur), "id_projet=$id_projet");
    $modif = true;
  }

  $old_id_article = intval (sql_getfetsel ("id_article","spip_idm_projets","id_projet=$id_projet"));
  $new_id_article = intval (_request("id_article"));

  if ($new_id_article != $old_id_article) {
    sql_updateq ("spip_idm_projets", array("id_article"=>$new_id_article), "id_projet=$id_projet");
    $modif = true;
  }

  $output = array();
  if ($modif) $output["message_ok"] =  "Modification(s) effectu&eacute;e(s).";
  return $output;
}

?>
