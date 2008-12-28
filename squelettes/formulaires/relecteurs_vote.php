<?php

include_spip('base/abstract_sql');

function formulaires_relecteurs_vote_charger ($id_article) {
  $id_auteur = $GLOBALS['auteur_session']['id_auteur'];
  $status = sql_getfetsel ('status','spip_relecteurs_articles',"id_auteur=$id_auteur AND id_article=$id_article");
  $avis = sql_getfetsel ('avis','spip_relecteurs_articles',"id_auteur=$id_auteur AND id_article=$id_article");
 
  if ($status == 'pas_vu') {
    sql_updateq ('spip_relecteurs_articles', array('status'=>'vu'), "id_auteur=$id_auteur AND id_article=$id_article");
    $status = "vu";
  }

  $valeurs = array('id_article'=>$id_article, 'avis'=>$avis, 'status'=>$status);
  return $valeurs;
}

function formulaires_relecteurs_vote_verifier ($id_article) {
  $erreurs = array();
  if (!_request('avis')) $erreurs['avis'] = "Merci de donner aussi votre avis en quelques mots ...";
  return $erreurs;
}

function formulaires_relecteurs_vote_traiter ($id_article) {
  $id_auteur = $GLOBALS['auteur_session']['id_auteur'];
  sql_updateq ('spip_relecteurs_articles',
    array('status'=>_request('vote'), 'avis'=>_request('avis')),
    "id_auteur=$id_auteur AND id_article=$id_article");
}

?>
