<?php

define ('_ID_WEBMESTRES', '1');
#define ('_SPIP_LOCK_MODE', 0);
#define ('_LOG_FILTRE_GRAVITE', 7);

// ini_set('display_errors', '1');

$type_urls = "propres2";

function inc_envoyer_mail ($destinataire, $sujet, $corps, $from = "", $headers = "") {
  include_spip ("inc/filtres");
  if (!email_valide($destinataire)) return false;
  if ($destinataire == _T('info_mail_fournisseur')) return false; // tres fort

  // Fournir si possible un Message-Id: conforme au RFC1036,
  // sinon SpamAssassin denoncera un MSGID_FROM_MTA_HEADER

  $email_envoi = $GLOBALS['meta']["email_envoi"];
  if (!email_valide($email_envoi)) {
    spip_log("Meta email_envoi invalide. Le mail sera probablement vu comme spam.");
    $email_envoi = $destinataire;
  }

  if (is_array($corps)){
    $texte = $corps['texte'];
    $from = (isset($corps['from'])?$corps['from']:$from);
    $headers = (isset($corps['headers'])?$corps['headers']:$headers);
    if (is_array($headers))
      $headers = implode("\n",$headers);
    $parts = "";
    if ($corps['pieces_jointes'] AND function_exists('mail_embarquer_pieces_jointes'))
      $parts = mail_embarquer_pieces_jointes($corps['pieces_jointes']);
  } else
    $texte = $corps;

  if (!$from) $from = $email_envoi;

  // ceci est la RegExp NO_REAL_NAME faisant hurler SpamAssassin
  if (preg_match('/^["\s]*\<?\S+\@\S+\>?\s*$/', $from))
    $from .= ' (' . str_replace(')','', translitteration(str_replace('@', ' at ', $from))) . ')';

  // nettoyer les &eacute; &#8217, &emdash; etc...
  // les 'cliquer ici' etc sont a eviter;  voir:
  // http://mta.org.ua/spamassassin-2.55/stuff/wiki.CustomRulesets/20050914/rules/french_rules.cf

  include_spip ('inc/envoyer_mail');
  $texte = nettoyer_caracteres_mail($texte);
  $sujet = nettoyer_caracteres_mail($sujet);

  // encoder le sujet si possible selon la RFC
  if (init_mb_string()) {
    # un bug de mb_string casse mb_encode_mimeheader si l'encoding interne
    # est UTF-8 et le charset iso-8859-1 (constate php5-mac ; php4.3-debian)
    $charset = $GLOBALS['meta']['charset'];
    mb_internal_encoding($charset);
    $sujet = mb_encode_mimeheader($sujet, $charset, 'Q', "\n");
    mb_internal_encoding('utf-8');
  }

  if (function_exists('wordwrap') && (preg_match(',multipart/mixed,',$headers) == 0))
    $texte = wordwrap($texte);

  list($headers, $texte) = mail_normaliser_headers($headers, $from, $destinataire, $texte, $parts);

  if (_OS_SERVEUR == 'windows') {
    $texte = preg_replace ("@\r*\n@","\r\n", $texte);
    $headers = preg_replace ("@\r*\n@","\r\n", $headers);
    $sujet = preg_replace ("@\r*\n@","\r\n", $sujet);
  }

  spip_log("mail (override) $destinataire\n$sujet\n$headers",'mails.5');
  // mode TEST : forcer l'email
  if (defined('_TEST_EMAIL_DEST')) {
    if (!_TEST_EMAIL_DEST)
      return false;
    else
      $destinataire = _TEST_EMAIL_DEST;
  }

  return @mail($destinataire, $sujet, $texte, $headers, "-f noreply@images.math.cnrs.fr");
}
?>
