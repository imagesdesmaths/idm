<?php
/**
 * Complete the automated treatment by NoSPAM to kill non-spam messages 
 * by cranks and the like.
 *
 * @param array $flux
 * @return array
 */

function idm_pre_edition ($flux) {
  if ($flux['args']['table']=='spip_forum' AND $flux['args']['action']=='instituer' AND $flux['data']['statut']=='publie') {
    $id_auteur   = intval($GLOBALS['visiteur_session']['id_auteur']);
    $nb_forums   = sql_countsel ('spip_forum',            "id_auteur=$id_auteur AND statut='publie'");
    $nb_refuses  = sql_countsel ('spip_forum',            "id_auteur=$id_auteur AND statut='off'");
    $nb_articles = sql_countsel ('spip_auteurs_articles', "id_auteur=$id_auteur");

    if ($nb_refuses>0) {
      spip_log ("IdM: visitor $id_auteur has a comment in the trash, moderating.");
      $flux['data']['statut']='prop';
    }

    if (($nb_forums<1) AND ($nb_articles<1)) {
      spip_log ("IdM: visitor $id_auteur has no article and too few comments, moderating.");
      $flux['data']['statut']='prop';
    }

    if (strlen ($flux['data']['texte']) > 1500) {
      spip_log ("IdM: visitor $id_auteur posted a very long comment, moderating.");
      $flux['data']['statut']='prop';
    };
  }
  return $flux;
}
?>
