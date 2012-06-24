<?php

include_spip('base/abstract_sql');

function notify_user ($id_auteur, $id_article) {
  $titre = sql_getfetsel ("titre", "spip_articles", "id_article = $id_article");

  $subject = "Relecture d'un article pour Images des Maths";

  $texte = _T('idm:mail_rel_article', array('titre'      => $titre,
                                        'id_article' => $id_article));

  idm_notify ($id_auteur, $texte, $subject);
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
