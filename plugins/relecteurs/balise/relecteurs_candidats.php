<?php

if (!defined("_ECRIRE_INC_VERSION")) return; #securite

function balise_RELECTEURS_CANDIDATS ($p) {
  return calculer_balise_dynamique ($p,'RELECTEURS_CANDIDATS',array());
}

function balise_RELECTEURS_CANDIDATS_stat ($args,$filtres) {
  return $args;
}

function balise_RELECTEURS_CANDIDATS_dyn () {
  return array ('formulaires/relecteurs_candidats',0,array());
}
