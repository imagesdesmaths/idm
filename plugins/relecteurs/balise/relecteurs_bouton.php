<?php

if (!defined("_ECRIRE_INC_VERSION")) return; #securite

function balise_RELECTEURS_BOUTON ($p) {
  return calculer_balise_dynamique ($p,'RELECTEURS_BOUTON',array());
}

function balise_RELECTEURS_BOUTON_stat ($args,$filtres) {
  return $args;
}

function balise_RELECTEURS_BOUTON_dyn () {
  return array ('formulaires/relecteurs_bouton',0,array());
}
