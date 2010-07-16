<?php

include_spip('base/abstract_sql');
include_spip('inc/envoyer_mail');

function notify_user ($id_auteur, $id_article) {
  $email = sql_getfetsel ("email", "spip_auteurs", "id_auteur = $id_auteur");
  $titre = sql_getfetsel ("titre", "spip_articles", "id_article = $id_article");
  $titre = utf8_decode ($titre);

  $subject = "Relecture d'un article pour Images des Maths";

  $texte = "Bonjour !\n" .
    "\n" .
    "Un article vient d'être proposé pour publication dans \"Images des\n" .
    "Mathématiques\". Il s'intitule :\n" .
    "\n" .
    "  « $titre »\n" .
    "\n" .
    "Comme vous avez manifesté votre intérêt à participer à notre\n" .
    "processus éditorial, nous vous invitons à en être un des relecteurs,\n" .
    "et à nous faire part de vos commentaires. Pour ce faire, après vous\n" .
    "être identifié(e) sur le site, il vous suffit de vous rendre à\n" .
    "l'adresse suivante :\n" .
    "\n" .
    "  http://images.math.cnrs.fr/spip.php?page=propose&id_article=$id_article\n" .
    "\n" .
    "Vous y trouverez l'article dans son état actuel, un forum de discussion\n" .
    "vous permettant de déposer vos commentaires et de dialoguer avec les\n" .
    "autres relecteurs ainsi qu'avec l'auteur de l'article, et enfin un\n" .
    "formulaire de vote pour donner votre avis sur sa publication.\n" .
    "\n" .
    "Nous souhaiterions pouvoir publier cet article dans les 15 jours qui\n" .
    "viennent. Si vous n'avez pas le temps de le relire d'ici là, ça n'est\n" .
    "pas grave - mais nous le publierons peut-être sans vous attendre ...\n".
    "\n" .
    "Merci pour votre aide !\n\n" .
    "-- \n" .
    "Le comité de rédaction de \"Images des Mathématiques\".";

  $envoyer_mail = charger_fonction ('envoyer_mail', 'inc');
  $envoyer_mail ($email, $subject, utf8_encode($texte));
}

function nettoie () {
  $affectes = sql_allfetsel ( array("id_auteur","id_article"), "spip_relecteurs_articles" );
  foreach ($affectes as $line) {
    $id_auteur = $line["id_auteur"];
    $id_article = $line["id_article"];
    $statut = sql_getfetsel ("statut", "spip_articles", "id_article = $id_article");
    $role = sql_getfetsel ("role", "spip_idm_relecteurs", "id_auteur = $id_auteur");
    if (($statut != "prop") OR ($role != "relecteur"))
      sql_delete ("spip_relecteurs_articles", "id_auteur = $id_auteur");
  }
}

function formulaires_relecteurs_article_charger ($id_article) {
  nettoie();
  $valeurs = array('id_article'=>$id_article);
  return $valeurs;
}

function formulaires_relecteurs_article_verifier ($id_article) {
  $erreurs = array();
  return $erreurs;
}

function formulaires_relecteurs_article_traiter ($id_article) {
  $relecteurs = sql_allfetsel ('id_auteur', 'spip_idm_relecteurs', "role = 'relecteur'");
  foreach ($relecteurs as $row) {
    $id_auteur = $row['id_auteur'];
    if (_request("unassign_$id_auteur")) {
      sql_delete ("spip_relecteurs_articles", "id_auteur = $id_auteur AND id_article = $id_article");
    }
    if (_request("assign_$id_auteur")) {
      sql_insertq ("spip_relecteurs_articles", array("id_auteur"=>$id_auteur, "id_article"=>$id_article));
      sql_update ("spip_idm_relecteurs", array("combien"=>"combien+1"), "id_auteur = $id_auteur");
      notify_user ($id_auteur, $id_article);
    }
  }
}

?>
