<?php

if (!defined("_ECRIRE_INC_VERSION")) return; // Sécurité

function balise_RELECTEURS_DESAFFECTER ($p) {
  $p = calculer_balise_dynamique($p, 'RELECTEURS_DESAFFECTER', array('id_article'));
  return $p;
}

function balise_RELECTEURS_DESAFFECTER_stat ($args, $filtres) {
  return $args;
}

function balise_RELECTEURS_DESAFFECTER_dyn ($id_article) {
  return array('formulaires/relecteurs_desaffecter', 0,
    array( 'id_article' => $id_article ));
}
?>
