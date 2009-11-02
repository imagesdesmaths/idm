<?php

function formulaires_moderation_charger ($id_forum) {
  return array ('id_forum' => $id_forum);
}

function formulaires_moderation_verifier ($id_forum) {
  return array ();
}

function formulaires_moderation_traiter ($id_forum) {
  $id_forum = intval ($id_forum);
  $statut = (_request("refuse") ? "relref" : "rel");

  sql_updateq ('spip_forum', array ('statut' => $statut), "id_forum = $id_forum");

  return array ('message_ok' => "done");
}

?>
