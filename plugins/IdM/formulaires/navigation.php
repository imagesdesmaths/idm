<?php

include_spip('base/abstract_sql');
include_spip('inc/filtres');

function formulaires_navigation_charger () {
  $pistes = array();
  foreach (sql_allfetsel ("*", "spip_mots", "id_groupe=5") as $p) {
    $pistes [$p["id_mot"]] = $p["titre"];
  }

  $sujets = array();
  foreach (sql_allfetsel ("*", "spip_mots", "id_groupe=1") as $p) {
    $sujets [$p["id_mot"]] = $p["titre"];
  }

  $auteurs = array();
  foreach (sql_allfetsel ("*", "spip_auteurs", "", "", "nom") as $p) {
    $id = intval($p["id_auteur"]);
    if (sql_getfetsel ("id_article", "spip_auteurs_articles", "id_auteur=$id"))
      $auteurs [$p["id_auteur"]] = $p["nom"];
  }

  return array("recherche" => "",
               "sujet"     => "", "sujets"    => $sujets,
               "piste"     => "", "pistes"    => $pistes,
               "auteur"    => "", "auteurs"   => $auteurs,
               "depuis"    => "");
}

function formulaires_navigation_verifier () {
  return array();
}

function formulaires_navigation_traiter () {
  return array();
}

?>
