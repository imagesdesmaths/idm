<?php

// Sécurité :
if (!defined("_ECRIRE_INC_VERSION")) return;

// On hérite du formulaire standard.
include_spip('balise/formulaire_forum');

// La balise #FORMULAIRE_FORUM_PRIVE, équivalente à #FORMULAIRE_FORUM 
// (avec quelques champs en moins, parce qu'on suppose que l'auteur est 
// déjà authentifié etc.) mais restreinte aux forums privés pour les 
// articles proposés. Donc, les discussions dans propose?id_article=XX 
// apparaissent aussi sous l'article dans l'espace privé.

function balise_FORMULAIRE_FORUM_PRIVE ($p) {
  $p = calculer_balise_dynamique($p, 'FORMULAIRE_FORUM_PRIVE', array('id_forum', 'id_article', 'afficher_texte'));
  return $p;
}

function balise_FORMULAIRE_FORUM_PRIVE_stat ($args, $filtres) {
  list ($idf, $ida, $af) = $args;
  $idf = intval($idf);
  $ida = intval($ida);

  if (!$r = sql_recherche_donnees_forum_prive ($idf, $ida)) return '';

  list ($titre, $table, $forums_publics) = $r;

  return array ($titre, '', $forums_publics, self(), $idf, $ida, $af, self());
}

function balise_FORMULAIRE_FORUM_PRIVE_dyn ($titre, $table, $type, $script, $id_forum, $id_article, $afficher_texte, $url_param_retour) {
  $auteur = $GLOBALS['auteur_session']['nom'];
  $email_auteur = $GLOBALS['auteur_session']['email'];

  $ids = array();
  foreach (array('id_article', 'id_forum') as $o) {
    $ids[$o] = ($x = intval($$o)) ? $x : '';
  }

  $previsu = ' ';

  if (!$retour_forum = rawurldecode(_request('retour_forum'))) {
    if ($retour_forum = rawurldecode(_request('retour')))
      $retour_forum = str_replace('&var_mode=recalcul','',$retour_forum);
    else {
      $retour_forum = "!";
      if ($url_param_retour)
        $retour_forum = str_replace('&amp;', '&', $url_param_retour);
    }

    if (isset($_COOKIE['spip_forum_user'])
      AND is_array($cookie_user = unserialize($_COOKIE['spip_forum_user']))) {
        $auteur = $cookie_user['nom'];
        $email_auteur = $cookie_user['email'];
      } else {
        $auteur = $GLOBALS['auteur_session']['nom'];
        $email_auteur = $GLOBALS['auteur_session']['email'];
      }

  } else { // appels ulterieurs
    $titre = _request('titre');
    $texte = _request('texte');
    $auteur = _request('auteur');
    $email_auteur = _request('email_auteur');
    $nom_site = _request('nom_site');
    $url_site = _request('url_site');

    if ($afficher_texte != 'non') 
      $previsu = inclure_previsu_prive ($texte, $titre, $email_auteur, $auteur, $url_site, $nom_site);

    $arg = forum_fichier_tmp(join('', $ids));

    $securiser_action = charger_fonction('securiser_action', 'inc');
    $hash = calculer_action_auteur("ajout_forum-$arg");

    // Poser un cookie pour ne pas retaper les infos invariables
    include_spip('inc/cookie');
    spip_setcookie('spip_forum_user',
      serialize(array('nom' => $auteur,
      'email' => $email_auteur)));
  }

  $script_hidden = $script = str_replace('&amp;', '&', $script);
  foreach ($ids as $id => $v)
    $script_hidden = parametre_url($script_hidden, $id, $v, '&');

  return array('formulaires/forum_prive', 0,
    array(
      'auteur' => $auteur,
      'readonly' => ($type == "abo")? "readonly" : '',
      'email_auteur' => $email_auteur,
      'modere' => (($type != 'pri') ? '' : ' '),
      'nom_site' => $nom_site,
      'retour_forum' => $retour_forum,
      'afficher_texte' => $afficher_texte,
      'previsu' => $previsu,
      'table' => $table,
      'texte' => $texte,
      'titre' => extraire_multi($titre),
      'url' => $script, # ce sur quoi on fait le action='...'
      'url_post' => $script_hidden, # pour les variables hidden
      'url_site' => ($url_site ? $url_site : "http://"),
      'arg' => $arg,
      'hash' => $hash,
      'nobot' => _request('nobot'),
    ));
}

function sql_recherche_donnees_forum_prive ($idf, $ida) {
  $titre = spip_abstract_fetsel('titre', 'spip_articles', "statut = 'prop' AND id_article = $ida");

  if ($idf)
    $titre = spip_abstract_fetsel('titre', 'spip_forum', "statut = 'prive' AND id_forum = $idf");

  $titre = supprimer_numero($titre['titre']);

  return array ($titre, 'articles', 'abo');
}

function inclure_previsu_prive ($texte,$titre, $email_auteur, $auteur, $url_site, $nom_site)
{
  $erreur = $bouton = '';

  if (strlen($texte) < 10)
    $erreur = _T('forum_attention_dix_caracteres');
  else if (strlen($titre) < 3)
    $erreur = _T('forum_attention_trois_caracteres');
  else if (defined('_FORUM_LONGUEUR_MAXI')
    AND _FORUM_LONGUEUR_MAXI > 0
      AND strlen($texte) > _FORUM_LONGUEUR_MAXI)
      $erreur = _T('forum_attention_trop_caracteres',
        array(
          'compte' => strlen($texte),
          'max' => _FORUM_LONGUEUR_MAXI
        ));
  else
    $bouton = _T('forum_message_definitif');

  // supprimer les <form> de la previsualisation
  // (sinon on ne peut pas faire <cadre>...</cadre> dans les forums)
  return preg_replace("@<(/?)f(orm[>[:space:]])@ism",
    "<\\1no-f\\2",
    inclure_balise_dynamique(array('formulaires/forum_previsu_prive',
    0,
    array(
      'titre' => safehtml(typo($titre)),
      'auteur' => safehtml(typo($auteur)),
      'texte' => safehtml(propre($texte)),
      'erreur' => $erreur,
      'bouton' => $bouton
    )
  ),
  false));
}
?>
