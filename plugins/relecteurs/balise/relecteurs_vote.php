<?php

if (!defined("_ECRIRE_INC_VERSION")) return; // Sécurité

function balise_RELECTEURS_VOTE ($p) {
  $p = calculer_balise_dynamique($p, 'RELECTEURS_VOTE', array('id_article'));
  return $p;
}

function balise_RELECTEURS_VOTE_stat ($args, $filtres) {
  return $args;
}

function balise_RELECTEURS_VOTE_dyn ($id_article) {
  return array('formulaires/relecteurs_vote', 0,
    array( 'id_article' => $id_article ));
}
?>
