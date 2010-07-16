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

function inc_envoyer_mail ($email, $sujet, $texte, $from = "", $headers = "") {
  global $hebergeur, $queue_mails;

  if (!email_valide($email)) return false;
  if ($email == _T('info_mail_fournisseur')) return false; // tres fort

  // Traiter les headers existants
  if (strlen($headers)) $headers = trim($headers)."\n";

  // Fournir si possible un Message-Id: conforme au RFC1036,
  // sinon SpamAssassin denoncera un MSGID_FROM_MTA_HEADER

  $email_envoi = $GLOBALS['meta']["email_envoi"];
  if (email_valide($email_envoi)) {
    preg_match('/(@\S+)/', $email_envoi, $domain);
    $mid = 'Message-Id: <' . time() . '_' . rand() . '_' . md5($email . $texte) . $domain[1] . ">\n";
  } else {
    spip_log("Meta email_envoi invalide. Le mail sera probablement vu comme spam.");
    $email_envoi = $email;
    $mid = '';
  }
  if (!$from) $from = $email_envoi;

  // ceci est la RegExp NO_REAL_NAME faisant hurler SpamAssassin
  if (preg_match('/^["\s]*\<?\S+\@\S+\>?\s*$/', $from))
    $from .= ' (' . str_replace(')','', translitteration(str_replace('@', ' at ', $from))) . ')';

  // Et maintenant le champ From:
  $headers .= "From: $from\n";

  // indispensable pour les sites qui colle d'office From: serveur-http
  // sauf si deja mis par l'envoyeur
  if (strpos($headers,"Reply-To:")===FALSE)
    $headers .= "Reply-To: $from\n";

  $charset = $GLOBALS['meta']['charset'];

  // Ajouter le Content-Type et consort s'il n'y est pas deja
  if (strpos($headers, "Content-Type: ") === false)
    $headers .=
    "Content-Type: text/plain; charset=$charset\n".
    "Content-Transfer-Encoding: 8bit\n" .
    "MIME-Version: 1.0\n";

  $headers .= $mid;

  // nettoyer les &eacute; &#8217, &emdash; etc...
  // les 'cliquer ici' etc sont a eviter;  voir:
  // http://mta.org.ua/spamassassin-2.55/stuff/wiki.CustomRulesets/20050914/rules/french_rules.cf

  spip_log ('--MARK--','mails');
  $texte = nettoyer_caracteres_mail($texte);
  spip_log ('--MARK--','mails');
  $sujet = nettoyer_caracteres_mail($sujet);
  spip_log ('--MARK--','mails');

  // encoder le sujet si possible selon la RFC
  if (init_mb_string()) {
    # un bug de mb_string casse mb_encode_mimeheader si l'encoding interne
    # est UTF-8 et le charset iso-8859-1 (constate php5-mac ; php4.3-debian)
    mb_internal_encoding($charset);
    $sujet = mb_encode_mimeheader($sujet, $charset, 'Q', "\n");
    mb_internal_encoding('utf-8');
  }

  spip_log ('--MARK--','mails');
  spip_log("mail mes_options $email\n$sujet\n$headers",'mails');

  // Ajouter le \n final
  if ($headers = trim($headers)) $headers .= "\n";
  if (function_exists('wordwrap') && (preg_match('/multipart\/mixed/',$headers) == 0))
    $texte = wordwrap($texte);

  if (_OS_SERVEUR == 'windows') {
    $texte = preg_replace ("@\r*\n@","\r\n", $texte);
    $headers = preg_replace ("@\r*\n@","\r\n", $headers);
    $sujet = preg_replace ("@\r*\n@","\r\n", $sujet);
  }

  switch($hebergeur) {
  case 'lycos':
    $queue_mails[] = array(
      'email' => $email,
      'sujet' => $sujet,
      'texte' => $texte,
      'headers' => $headers);
    return true;
  case 'free':
    return false;
  default:
    return @mail($email, $sujet, $texte, $headers, "-f noreply@images.math.cnrs.fr");
  }
}
?>
