<?php

function formulaires_idm_projet_edit_charger ($id_projet) {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;

  $params = array ("id_projet"=>$id_projet, "step"=>"display");

  $params["id_auteur"] = sql_getfetsel ("id_auteur","spip_idm_projets","id_projet=$id_projet");

  return $params;
}

function formulaires_idm_projet_edit_verifier ($id_projet) {
}

function formulaires_idm_projet_edit_traiter ($id_projet) {
  if (_request("step") != "display") return;

  $old_id_auteur = intval (sql_getfetsel ("id_auteur","spip_idm_projets","id_projet=$id_projet"));
  $new_id_auteur = intval (_request("id_auteur"));

  if ($new_id_auteur != $old_id_auteur) {
    sql_updateq ("spip_idm_projets", array("id_auteur"=>$new_id_auteur), "id_projet=$id_projet");
  }
  //sql_insertq ("spip_idm_projets", array(
    //"id_editeur"  => $GLOBALS['auteur_session']['id_auteur'],
    //"id_rubrique" => _request("id_rubrique"),
    //"auteur"      => _request("auteur"),
    //"sujet"       => _request("sujet"),
    //"comment"     => _request("comment")));
  //return array ("message_ok" => "Projet cr&eacute;&eacute;.");
}

?>
