<?php

include_spip('inc/envoyer_mail');

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

  $id_article = sql_getfetsel ('id_article', 'spip_forum', "id_forum = $id_forum");
  $id_auteur  = sql_getfetsel ('id_auteur',  'spip_forum', "id_forum = $id_forum");
  $title      = sql_getfetsel ('titre', 'spip_articles', "id_article = $id_article");

  $mail_subject = "Un nouveau message de relecture sur IdM";
  $mail_text    = <<< END
Bonjour !

Un nouveau message a été déposé sur le forum de relecture de votre article

  « $title »

proposé pour publication dans Images des Maths. Vous pouvez suivre le forum
de relecture de cet article à cette adresse :

  http://images.math.cnrs.fr/spip.php?page=propose&amp;id_article=$id_article

Merci !

-- 
Le robot de "Images des maths"
END;

  $auteurs = sql_select ('*', 'spip_auteurs_articles', "id_article = $id_article");
  while ($r = sql_fetch($auteurs)) {
    $id = $r['id_auteur'];
    if ($id != $id_auteur) {
      $mail_to = sql_getfetsel ('email', 'spip_auteurs', "id_auteur = $id");
      inc_envoyer_mail_dist ($mail_to, $mail_subject, utf8_encode($mail_text));
    }
  }

  return array ('message_ok' => "done");
}

?>
