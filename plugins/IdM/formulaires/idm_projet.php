<?php

function formulaires_idm_projet_charger () {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;
  return array (
    "auteur"   => "",
    "sujet"    => "",
    "editable" => true,
  );
}

function formulaires_idm_projet_verifier () {
  $erreurs = array();

  foreach (array("auteur","sujet") as $champ) {
    if (!_request($champ)) $erreurs[$champ] = "Ce champ est obligatoire !";
  }

  if (count($erreurs)) $erreurs['message_erreur'] = "Tous les champs doivent &ecirc;tre remplis !";

  return $erreurs;
}

function formulaires_idm_projet_traiter () {
  sql_insertq ("spip_idm_projets", array(
    "id_editeur" => $GLOBALS['auteur_session']['id_auteur'],
    "auteur"     => _request("auteur"),
    "sujet"      => _request("sujet")));

  return array (
    "message_ok" => "Projet cr&eacute;&eacute; !",
    "editable"   => false,
  );
}

?>
