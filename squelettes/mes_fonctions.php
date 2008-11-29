<?php

global $tables_principales;
$tables_principales['spip_auteurs']['field']['billettiste'] =
  "enum('oui','non') NOT NULL DEFAULT 'non'";

include_spip('inc/envoyer_mail');

// Patch sur la fonction envoyer_mail par dÃ©faut pour ajouter l'option 
// '-f' Ã  l'appel de sendmail. Pour que les mails puissent entrer Ã  
// l'ENS Lyon ...

function inc_envoyer_mail($email, $sujet, $texte, $from = "", $headers = "") {
  global $hebergeur, $queue_mails;
  include_spip('inc/charsets');

  if (!email_valide($email)) return false;
  if ($email == _T('info_mail_fournisseur')) return false; // tres fort

  // Ajouter au besoin le \n final dans les $headers passes en argument
  if ($headers = trim($headers)) $headers .= "\n";

  if (!$from) {
    $email_envoi = $GLOBALS['meta']["email_envoi"];
    $from = email_valide($email_envoi) ? $email_envoi : $email;
  } else {
    // pour les sites qui colle d'office From: serveur-http
    $headers .= "Reply-To: $from\n";
  }
  spip_log("mail ($email): $sujet". ($from ?", from <$from>":''));

  $charset = $GLOBALS['meta']['charset'];

  // Ajouter le Content-Type s'il n'y est pas deja
  if (strpos($headers, "Content-Type: ") === false)
    $headers .=
      "MIME-Version: 1.0\n".
      "Content-Type: text/plain; charset=$charset\n".
      "Content-Transfer-Encoding: 8bit\n";

  // Et maintenant le champ From:
  $headers .= "From: $from\n";

  // nettoyer les &eacute; &#8217, &emdash; etc...
  $texte = nettoyer_caracteres_mail($texte);
  $sujet = nettoyer_caracteres_mail($sujet);

  // encoder le sujet si possible selon la RFC
  if (init_mb_string()) {
    # un bug de mb_string casse mb_encode_mimeheader si l'encoding interne
    # est UTF-8 et le charset iso-8859-1 (constate php5-mac ; php4.3-debian)
    mb_internal_encoding($charset);
    $sujet = mb_encode_mimeheader($sujet, $charset, 'Q', "\n");
    mb_internal_encoding('utf-8');
  }

  if (function_exists('wordwrap'))
    $texte = wordwrap($texte);

  if (os_serveur == 'windows') {
    $texte = ereg_replace ("\r*\n","\r\n", $texte);
    $headers = ereg_replace ("\r*\n","\r\n", $headers);
    $sujet = ereg_replace ("\r*\n","\r\n", $sujet);
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
  case 'online':
    return @email('webmaster', $email, $sujet, $texte);
  default:
    return @mail($email, $sujet, $texte, $headers, "-f $from");
  }
}

function lettrine ($texte) {
  $lines = explode ("\n", $texte);
  for ($i=0; $i<count($lines); $i++) {
    if (preg_match ('/(.*)<p class="spip">([A-Za-z])([A-Za-zç]*)/', $lines[$i], $matches)) {
      $lettrine = $matches[1] . '<p class="spip lettrine"><span class="lettrine"><span class="lettrine_first">' . $matches[2] . '</span>' . $matches[3] . '</span>';
      $lines[$i] = str_replace ($matches[0], $lettrine, $lines[$i]);
      break;
    } 
  }
  return implode ("\n", $lines);
}

function prenom_nom ($texte) {
  $texte = preg_replace ('/([^,]+), ([^,]+)/s', '\2 \1', $texte);
  return $texte;
}

function billettistes_effect_change ($target='', $caller='admin') {
  if (!$target) $target = str_replace('&amp;','&',self());

  if (!empty($_POST)) {
    foreach($_POST as $key=>$value) {
      if (preg_match('/^form_billettistes_bless_([0-9]*)$/', $key, $matches)) {
        $id = $matches[1];
        sql_updateq ('spip_auteurs', array('billettiste'=>'oui'), "id_auteur = $id");
        $reload = true;
      }

      if (preg_match('/^form_billettistes_demote_([0-9]*)$/', $key, $matches)) {
        $id = $matches[1];
        sql_updateq ('spip_auteurs', array('billettiste'=>'non'), "id_auteur = $id");
        $reload = true;
      }
    }

    if ($reload) {
      $_POST = array();
      @header ("Location: $target");
    }
  }
}
?>
