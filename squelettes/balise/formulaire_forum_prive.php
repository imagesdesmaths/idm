<?php

// Sécurité :
if (!defined("_ECRIRE_INC_VERSION")) return;

// On hérite du formulaire standard.
include_spip('balise/formulaire_forum');
include_spip('inc/envoyer_mail');

function notify_authors ($id_article) {
  $titre = sql_getfetsel ("titre", "spip_articles", "id_article = $id_article");
  $titre = utf8_decode ($titre);

  $subject = "Un message sur votre article pour Images des Maths";

  $texte = "Bonjour !\n" .
    "\n" .
    "Un message vient d'être déposé sur l'interface de relecture de votre\n" .
    "article pour \"Images des mathématiques\" intitulé :\n" .
    "\n" .
    "  « $titre »\n" .
    "\n" .
    "Vous pouvez accéder a cette interface pour le lire et éventuellement\n" .
    "y répondre a l'URL suivante (une fois identifié sur le site) :\n" .
    "\n" .
    "  http://images.math.cnrs.fr/spip.php?page=propose&id_article=$id_article\n" .
    "\n" .
    "Merci pour votre aide !\n\n" .
    "-- \n" .
    "Le comité de rédaction de \"Images des Mathématiques\".";

  $auteurs = sql_allfetsel ( "id_auteur", "spip_auteurs_articles", "id_article = $id_article" );
  foreach ($auteurs as $line) {
    $id_auteur = $line["id_auteur"];
    $email = sql_getfetsel ("email","spip_auteurs","id_auteur=$id_auteur");
    inc_envoyer_mail_dist ($email, $subject, utf8_encode($texte));
  }
}


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

  if (_request('confirmer_forum')) {
    if ($id_forum) $id_thread = sql_getfetsel ('id_thread', 'spip_forum', "id_forum = $id_forum");
    else $id_thread = $id_message;

    $id_message = sql_insertq ('spip_forum', array(
      'date_heure' => 'NOW()',
      'id_parent' => $id_forum,
      'id_rubrique' => $id_rubrique,
      'id_article' => $id_article,
      'id_thread' => $id_thread,
      'statut' => 'prive',
      'titre' => $titre,
      'texte' => $texte,
      'id_auteur' => $GLOBALS['auteur_session']['id_auteur'],
      'auteur' => $auteur));

    notify_authors ($id_article);
    @header ("Location: spip.php?page=propose&id_article=$id_article");
    return "Message enregistr&eacute, rechargement de la page.";
  }

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
    $titre = sql_getfetsel('titre', 'spip_articles', "statut = 'prop' AND id_article = $ida");
    if ($idf) $titre = sql_getfetsel('titre', 'spip_forum', "statut = 'prive' AND id_forum = $idf");

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

  function forum_fichier_tmp($arg)
  {
    # astuce : mt_rand pour autoriser les hits simultanes
    while (($alea = time() + @mt_rand()) + intval($arg)
      AND @file_exists($f = _DIR_TMP."forum_$alea.lck"))
    {};
    spip_touch ($f);

    # et maintenant on purge les locks de forums ouverts depuis > 4 h

    if ($dh = @opendir(_DIR_TMP))
      while (($file = @readdir($dh)) !== false)
        if (preg_match('/^forum_([0-9]+)\.lck$/', $file)
          AND (time()-@filemtime(_DIR_TMP.$file) > 4*3600))
          spip_unlink(_DIR_TMP.$file);
    return $alea;
  }
?>
