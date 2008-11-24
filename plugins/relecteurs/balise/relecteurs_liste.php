<?php

if (!defined("_ECRIRE_INC_VERSION")) return; #securite

function balise_RELECTEURS_LISTE ($p) {
  return calculer_balise_dynamique ($p,'RELECTEURS_LISTE',array());
}

function balise_RELECTEURS_LISTE_stat ($args,$filtres) {
  return $args;
}

function balise_RELECTEURS_LISTE_dyn () {
  return array ('formulaires/relecteurs_liste',0,array());
}
