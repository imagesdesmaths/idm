<?php

// Super-administrateur :

define ('_ID_WEBMESTRES', '1');

// Afficher les messages d'erreurs de PHP (en cours de développement, 
// mettre à 0 en production !)

//ini_set('display_errors', '1');

// Activation des URL propres 
// (http://images.math.cnrs.fr/Titre-de-l-article.html)

$type_urls = "propres2";

// Perdre le cookie d'admin à la déconnection :

include_spip('inc/cookie');

function prenom_nom ($texte) {
  $texte = preg_replace ('/([^,]+), ([^,]+)/s', '\2 \1', $texte);
  return $texte;
}

$table_des_traitements['TITRE'][]= 'supprimer_numero(typo(%s))';
$table_des_traitements['NOM'][]= 'prenom_nom(%s)';

function action_logout()
{
  global $auteur_session, $ignore_auth_http;
  $logout =_request('logout');
  $url = _request('url');
  spip_log("logout $logout $url" . $auteur_session['id_auteur']);
  // cas particulier, logout dans l'espace public
  if ($logout == 'public' AND !$url)
    $url = url_de_base();

  // seul le loge peut se deloger (mais id_auteur peut valoir 0 apres une restauration avortee)
  if (is_numeric($auteur_session['id_auteur'])) {
    spip_query("UPDATE spip_auteurs SET en_ligne = DATE_SUB(NOW(),INTERVAL 15 MINUTE) WHERE id_auteur = ".$auteur_session['id_auteur']);
    // le logout explicite vaut destruction de toutes les sessions
    if ($_COOKIE['spip_session']) {
      $session = charger_fonction('session', 'inc');
      $session($auteur_session['id_auteur']);
      preg_match(',^[^/]*//[^/]*(.*)/$,',
        url_de_base(),
        $r);
      spip_setcookie('spip_session', '', -1,$r[1]);
      spip_setcookie('spip_session', '', -1);
      spip_setcookie('spip_admin', '', time() - 3600 * 24);
    }
    if ($_SERVER['PHP_AUTH_USER'] AND !$ignore_auth_http) {
      include_spip('inc/actions');
      if (verifier_php_auth()) {
        ask_php_auth(_T('login_deconnexion_ok'),
          _T('login_verifiez_navigateur'),
          _T('login_retour_public'),
          "redirect=". _DIR_RESTREINT_ABS, 
          _T('login_test_navigateur'),
          true);
        exit;
      }
    }
  }
  redirige_par_entete(url_de_base());
}

?>
