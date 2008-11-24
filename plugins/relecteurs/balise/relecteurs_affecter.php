<?php

if (!defined("_ECRIRE_INC_VERSION")) return; // Sécurité

function balise_RELECTEURS_AFFECTER ($p) {
  $p = calculer_balise_dynamique($p, 'RELECTEURS_AFFECTER', array('id_article'));
  return $p;
}

function balise_RELECTEURS_AFFECTER_stat ($args, $filtres) {
  return $args;
}

function balise_RELECTEURS_AFFECTER_dyn ($id_article) {
  return array('formulaires/relecteurs_affecter', 0,
    array( 'id_article' => $id_article ));
}
?>
