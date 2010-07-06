<?php

include_spip('idm');

function formulaires_relecteurs_moderation_charger ($id_forum) {
  return array ('id_forum' => $id_forum);
}

function formulaires_relecteurs_moderation_verifier ($id_forum) {
  return array ();
}

function formulaires_relecteurs_moderation_traiter ($id_forum) {
  $id_forum = intval ($id_forum);
  $statut = (_request("refuse") ? "relref" : "rel");

  sql_updateq ('spip_forum', array ('statut' => $statut), "id_forum = $id_forum");

  if ($statut == "rel") {
    $id_article = sql_getfetsel ('id_article', 'spip_forum', "id_forum = $id_forum");
    $id_auteur  = sql_getfetsel ('id_auteur',  'spip_forum', "id_forum = $id_forum");
    $title      = sql_getfetsel ('titre', 'spip_articles', "id_article = $id_article");

    $title = utf8_decode($title);

    $subject = "Un nouveau message de relecture sur \"Images des Maths\"";
    $text    = <<< END
Un nouveau message a été déposé sur le forum de relecture de :

  « $title »

proposé pour publication dans Images des Maths. Vous pouvez suivre le
forum de relecture de cet article à cette adresse :

  http://images.math.cnrs.fr/spip.php?page=propose&amp;id_article=$id_article
END;

    $id_recipients = array ( 1, 327, 637 ); // Vincent and Christine and Julien

    $auteurs = sql_select ('*', 'spip_auteurs_articles', "id_article = $id_article");
    while ($r = sql_fetch($auteurs)) {
      $id = $r['id_auteur'];
      if (!in_array($id, $id_recipients)) $id_recipients[] = $id;
    }

    $relecteurs = sql_select ('*', 'spip_relecteurs_articles', "id_article = $id_article");
    while ($r = sql_fetch($relecteurs)) {
      $id = $r['id_auteur'];
      if (!in_array($id, $id_recipients)) $id_recipients[] = $id;
    }

    foreach ($id_recipients as $id) idm_notify ($id, utf8_encode($text), $subject);
  }

  return array ('message_ok' => "done");
}

?>
