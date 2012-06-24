<?php

function formulaires_idm_gerer_charger ($id_article) {
  if ($GLOBALS['auteur_session']['statut'] != "0minirezo") return false;

  $article = sql_fetsel ("*", "spip_articles", "id_article=$id_article");

  $editeurs = array();
  foreach (sql_allfetsel ("*", "spip_auteurs", "statut = '0minirezo'") as $e) {
    $editeurs [$e["id_auteur"]] = idm_prenom_nom($e["nom"]);
  }

  $ouinon = array();
  $ouinon['oui']='oui';
  $ouinon['non']='non';

  $params = array(
                  "id_article"   => $id_article,
                  "id_editeur"   => $article["id_editeur"],
                  "prevu"        => $article["prevu"],
                  "ouinon"       => $ouinon,
                  "date_prevue"  => $article["date_prevue"],
                  "commentaires" => $article["commentaires"],
                  "editeurs"     => $editeurs,
                  );

  return $params;
}

function formulaires_idm_gerer_verifier ($id_article) {}

function formulaires_idm_gerer_traiter ($id_article) {
  $mysqldate = preg_replace ('/([0-9]*).([0-9]*).([0-9]*)/', '$3-$2-$1', _request("date_prevue"));

  $modif = array(
                 "id_editeur"   => intval(_request("id_editeur")),
                 "prevu"        => _request("prevu"),
                 "date_prevue"  => $mysqldate,
                 "commentaires" => _request("commentaires"),
                 );

  sql_updateq ("spip_articles", $modif, "id_article = $id_article");

  return array(
               "message_ok" => "Modification effectu&eacute;e.",
               "redirect"   => generer_url_ecrire("idm_tableau"),
               );
}

?>
