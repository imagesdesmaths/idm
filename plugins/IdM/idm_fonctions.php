<?php

function idm_boite_infos (&$flux) {
  if ($flux['args']['type'] == 'article') {
    $id_article  = $flux['args']['id'];
    $id_rubrique = sql_getfetsel ('id_rubrique', 'spip_articles', "id_article = $id_article");
    $statut      = sql_getfetsel ('statut',      'spip_articles', "id_article = $id_article");

    if ($statut == "prop") {
      $message = "G&eacute;rer la relecture";
      $url = generer_url_public ("propose", array('id_article' => $id_article));
      $flux['data'] .= icone_horizontale ($message, $url, "relecteurs-24.png");
    }

    if (($id_rubrique == 6) && (($statut=="prepa")||($statut=="prop"))) {
      $moi = $GLOBALS['auteur_session']['id_auteur'];
      $billettiste = sql_getfetsel ('billettiste', 'spip_auteurs', "id_auteur = $moi");
      $validable = false;

      if (($billettiste=="oui") &&
          (sql_countsel ('spip_auteurs_liens', "objet = \"article\" AND id_objet = $id_article AND id_auteur = $moi") > 0))
        $validable = true;
      if (sql_countsel ('spip_idm_teams',     "team = \"billets\" AND id_auteur = $moi") > 0)
        $validable = true;

      if ($validable) {
        $message = "Valider ce billet";
        $url = generer_url_action ("idm_validate", "id_article=$id_article");
        $flux['data'] .= icone_horizontale ($message, $url, "billet-24.png");
      }
    }
  }

  return $flux;
}

function idm_autoriser() {}

function autoriser_article_relire_dist ($faire, $type, $id, $qui, $opt) {
  if ($qui['id_auteur'] == 0) return false;
  if ($qui['statut'] == '0minirezo') return true;

  $id_auteur = $qui['id_auteur'];
  if (sql_countsel('spip_auteurs_liens', "objet = 'article' AND id_objet = $id AND id_auteur = $id_auteur")) return true;
  if (sql_countsel('spip_relecteurs_articles', "id_article = $id AND id_auteur = $id_auteur")) return true;

  return false;
}

function autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt) {
  if ($qui['statut'] == '0minirezo') return true;
  return false;
}

function autoriser_idm_relecteurs_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function autoriser_idm_relecture_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function autoriser_idm_moderation_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function autoriser_idm_billettistes_bouton_dist ($faire, $type, $id, $qui, $opt) {
  return autoriser_idm_bouton_dist ($faire, $type, $id, $qui, $opt);
}

function idm_notify ($ids, $message, $subject = "Un message du site \"Images des Maths\"") {
  $message = "Bonjour !\n\n" . $message . "\n\n-- \nLe robot du site http://images.math.cnrs.fr/\n";
  $emails = array();

  foreach ((array)$ids as $id) {
    if (is_numeric($id)) {
      if ($id>0) $emails[] = sql_getfetsel ("email", "spip_auteurs", "id_auteur = $id");
      else       $emails[] = "comite@images.math.cnrs.fr";
    } else foreach (sql_allfetsel ("*", "spip_idm_teams", "team = '$id'") as $e)
                 $emails[] = sql_getfetsel ("email", "spip_auteurs", "id_auteur = ".$e['id_auteur']);
  }

  $envoyer_mail = charger_fonction ('envoyer_mail', 'inc');
  foreach ($emails as $email) $envoyer_mail ($email, $subject, $message);
}

function idm_jquery_plugins ($scripts) {
  $scripts[] = 'javascript/jquery-ui.min.js';
  $scripts[] = 'javascript/jquery.tablesorter.min.js';
  $scripts[] = 'mediaelement/mediaelement-and-player.min.js';
  return $scripts;
}

function idm_import_sujets () {
  $raw = file_get_contents(find_in_path("Dewey.org"));

  preg_match_all ('/\| ([0-9\.]*) *\| ([0-9\.]*) *\| ([^\|]*[^ ]) *\|/',
                  $raw, $out, PREG_SET_ORDER);

  foreach ($out as $r)
    sql_insertq ("spip_idm_sujets",
                 array("id_sujet" => $r[1],
                       "id_parent" => $r[2],
                       "intitule" => $r[3]));
}

function idm_dewey ($cote) {
  return preg_replace ('/([0-9][0-9][0-9])([0-9]+)/', '$1.$2', $cote);
}

function idm_clean_TeX ($texte) {
  $acc_tex = array(); $acc_html = array();

  $acc_tex[] = '\`a'; $acc_html[] = '&agrave;';
  $acc_tex[] = '\`e'; $acc_html[] = '&egrave;';
  $acc_tex[] = '\`i'; $acc_html[] = '&igrave;';
  $acc_tex[] = '\`o'; $acc_html[] = '&ograve;';
  $acc_tex[] = '\`u'; $acc_html[] = '&ugrave;';
  $acc_tex[] = '\`y'; $acc_html[] = '&ygrave;';

  $acc_tex[] = '\\\'a'; $acc_html[] = '&aacute;';
  $acc_tex[] = '\\\'e'; $acc_html[] = '&eacute;';
  $acc_tex[] = '\\\'i'; $acc_html[] = '&iacute;';
  $acc_tex[] = '\\\'o'; $acc_html[] = '&oacute;';
  $acc_tex[] = '\\\'u'; $acc_html[] = '&uacute;';
  $acc_tex[] = '\\\'y'; $acc_html[] = '&yacute;';

  $acc_tex[] = '\^a'; $acc_html[] = '&acirc;';
  $acc_tex[] = '\^e'; $acc_html[] = '&ecirc;';
  $acc_tex[] = '\^i'; $acc_html[] = '&icirc;';
  $acc_tex[] = '\^o'; $acc_html[] = '&ocirc;';
  $acc_tex[] = '\^u'; $acc_html[] = '&ucirc;';
  $acc_tex[] = '\^y'; $acc_html[] = '&ycirc;';

  $acc_tex[] = '\"a'; $acc_html[] = '&auml;';
  $acc_tex[] = '\"e'; $acc_html[] = '&euml;';
  $acc_tex[] = '\"i'; $acc_html[] = '&iuml;';
  $acc_tex[] = '\"o'; $acc_html[] = '&ouml;';
  $acc_tex[] = '\"u'; $acc_html[] = '&uuml;';
  $acc_tex[] = '\"y'; $acc_html[] = '&yuml;';

  $acc_tex[] = '\`A'; $acc_html[] = '&Agrave;';
  $acc_tex[] = '\`E'; $acc_html[] = '&Egrave;';
  $acc_tex[] = '\`I'; $acc_html[] = '&Igrave;';
  $acc_tex[] = '\`O'; $acc_html[] = '&Ograve;';
  $acc_tex[] = '\`U'; $acc_html[] = '&Ugrave;';
  $acc_tex[] = '\`Y'; $acc_html[] = '&Ygrave;';

  $acc_tex[] = '\\\'A'; $acc_html[] = '&Aacute;';
  $acc_tex[] = '\\\'E'; $acc_html[] = '&Eacute;';
  $acc_tex[] = '\\\'I'; $acc_html[] = '&Iacute;';
  $acc_tex[] = '\\\'O'; $acc_html[] = '&Oacute;';
  $acc_tex[] = '\\\'U'; $acc_html[] = '&Uacute;';
  $acc_tex[] = '\\\'Y'; $acc_html[] = '&Yacute;';

  $acc_tex[] = '\^A'; $acc_html[] = '&Acirc;';
  $acc_tex[] = '\^E'; $acc_html[] = '&Ecirc;';
  $acc_tex[] = '\^I'; $acc_html[] = '&Icirc;';
  $acc_tex[] = '\^O'; $acc_html[] = '&Ocirc;';
  $acc_tex[] = '\^U'; $acc_html[] = '&Ucirc;';
  $acc_tex[] = '\^Y'; $acc_html[] = '&Ycirc;';

  $acc_tex[] = '\"A'; $acc_html[] = '&Auml;';
  $acc_tex[] = '\"E'; $acc_html[] = '&Euml;';
  $acc_tex[] = '\"I'; $acc_html[] = '&Iuml;';
  $acc_tex[] = '\"O'; $acc_html[] = '&Ouml;';
  $acc_tex[] = '\"U'; $acc_html[] = '&Uuml;';
  $acc_tex[] = '\"Y'; $acc_html[] = '&Yuml;';

  $acc_tex[] = '\`{\i}';   $acc_html[] = '&igrave;';
  $acc_tex[] = '\\\'{\i}'; $acc_html[] = '&iacute;';
  $acc_tex[] = '\^{\i}';   $acc_html[] = '&icirc;';
  $acc_tex[] = '\"{\i}';   $acc_html[] = '&iuml;';

  $acc_tex[] = '\c{c}';    $acc_html[] = '&ccedil;';
  $acc_tex[] = '\c c';     $acc_html[] = '&ccedil;';
  $acc_tex[] = '\c{C}';    $acc_html[] = '&Ccedil;';
  $acc_tex[] = '\c C';     $acc_html[] = '&Ccedil;';

  $texte = str_replace ($acc_tex, $acc_html, $texte);

  $texte = preg_replace ('/\\\head\{([^{}]+)\}/s',    '{{{\1}}}', $texte);
  $texte = preg_replace ('/\\\textbf\{([^{}]+)\}/s',  '{{\1}}',   $texte);
  $texte = preg_replace ('/\\\section\{([^{}]+)\}/s', '{{{\1}}}', $texte);

  $texte = str_replace ('\ldots',    '...', $texte);
  $texte = str_replace ('\medskip',  '',    $texte);
  $texte = str_replace ('\newblock', '',    $texte);
  $texte = str_replace ('\noindent', '',    $texte);
  $texte = str_replace ('\emph',     '',    $texte);
  $texte = str_replace ('\em',       '',    $texte);
  $texte = str_replace ('\it',       '',    $texte);

  return $texte;
}

function idm_protect_TeX ($texte) {
  $texte = str_replace ('\[', '$$', $texte);
  $texte = str_replace ('\]', '$$', $texte);
  $texte = str_replace ('\(', '$', $texte);
  $texte = str_replace ('\)', '$', $texte);

  $texte = preg_replace ('/\$\$([^$]+)\$\$/s', '<html>\[\1\]</html>', $texte);
  $texte = preg_replace ('/\$([^$]+)\$/s', '<html>$\1$</html>', $texte);
  $texte = str_replace ('\[', '$$', $texte);
  $texte = str_replace ('\]', '$$', $texte);

  while (preg_match ('/<html>[$]+[^$]+</s', $texte)) {
    $texte = preg_replace ('/(<html>[$]+[^$]+)</s', '\1&lt;', $texte);
  }

  return echappe_html ($texte);
}

function idm_pre_typo ($texte) {
  $texte = idm_protect_TeX ($texte);
  $texte = idm_clean_TeX ($texte);

  return $texte;
}

function idm_insert_head ($texte) {
  $mj_insert = <<<END
    <script type="text/javascript" src="/mathjax/MathJax.js">
      MathJax.Hub.Config({
        jax: [ "input/TeX", "output/HTML-CSS" ],
        extensions: [ "tex2jax.js", "jsMath2jax.js" ],
        tex2jax: { inlineMath: [ ['$','$'], ["\\\\(","\\\\)"] ], processEnvironments: false },
        TeX: {
          extensions: ["AMSmath.js", "AMSsymbols.js"],
          equationNumbers: { autoNumber: "AMS" },
        }
      });
    </script>
END;
  return $texte . $mj_insert;
}

function idm_header_prive ($texte) {
  $texte = idm_insert_head ($texte);
  $texte .= "<script type=\"text/javascript\">\$(document).ready(function(){\$('video,audio').mediaelementplayer();});</script>\n";
  $texte .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"" . find_in_path("mediaelement/mediaelementplayer.min.css") . "\"/>\n";
  return $texte;
}

function idm_initiale ($mot) {
  return strtoupper($mot[0]);
}

function idm_texify ($texte) {
  include_spip ('inc/documents');

  $texte = preg_replace ('/{{{(.*?)}}}/', '\section*{\1}', $texte);
  $texte = preg_replace ('/\[\[(.*?)\]\]/', '\footnote{\1}', $texte);
  $texte = preg_replace ('/\[([^]]*)->([^]]*)\]/', '\href{\2}{\1}', $texte);

  preg_match_all ('/<(doc|img)([0-9]*).*?>/', $texte, $matches, PREG_SET_ORDER);
  foreach ($matches as $m) {
    $f = generer_url_document_dist(intval($m[2]));
    $f = preg_replace ('/.*\//', '', $f);
    $texte = str_replace ($m[0], '\centerline{\includegraphics[width=.5\hsize]{'.$f.'}}', $texte);
  }

  $texte = preg_replace ('/\\\\href{([0-9]*)}/', '\href{http://images.math.cnrs.fr/?article\1}', $texte);
  return $texte;
}

function idm_prenom_nom ($texte) {
  $texte = preg_replace ('/([^,]+), ([^,]+)/s', '\2 \1', $texte);
  return $texte;
}

function idm_validate_billet ($id_auteur, $id_article) {
  $today = time(); $today -= $today % (24*3600); // Midnight this morning

  $previous = sql_getfetsel ("UNIX_TIMESTAMP(date)",
    "spip_auteurs_liens,spip_articles",
    "(spip_auteurs_liens.objet='article') AND (spip_articles.id_article=spip_auteurs_liens.id_objet) AND (id_auteur=$id_auteur) AND (statut='publie')",
    array(), "date DESC", "1");
  $previous -= $previous % (24*3600); // Their last contribution to the site

  $when = max ($today + 2*24*3600, $previous + 7*24*3600); // Publish the day after tomorrow, with one week minimum for the same contributor.
  $when += 7*3600; // Publish at 7:00 AM

  $threshold = 2;
  while (true) {
    $sqldate = date("Y-m-d H:i:s", $when);
    $howmany = sql_countsel('spip_articles', "(id_rubrique=6) AND (statut='publie') AND (date='$sqldate')");
    if ($howmany<$threshold) break;
    $when += 24*3600;
    $threshold += 1;
  }

  $date = date("Y-m-d H:i:s", $when);

  sql_updateq ("spip_articles", array ("statut" => "publie", "date" => $date), "id_article = $id_article");

  $idm_team_billets = array();
  foreach (sql_allfetsel ("*", "spip_idm_teams", "team = 'billets'") as $e) $idm_team_billets[] = $e['id_auteur'];

  $today = ($today/(24*3600)) % count($idm_team_billets);
  $gars = $idm_team_billets [$today];

  $qui   = sql_getfetsel ("nom",   "spip_auteurs",  "id_auteur = $id_auteur");
  $titre = sql_getfetsel ("titre", "spip_articles", "id_article = $id_article");

  $subject = "Un nouveau billet pour Images des Maths";

  $texte = _T('idm:mail_billet_valide', array('auteur'     => $qui,
                                              'titre'      => $titre,
                                              'date'       => $date,
                                              'id_article' => $id_article));

  idm_notify (array(0,$gars), $texte, $subject);
}

// VB: patches for notifications.

function email_notification_objet($id_objet, $type_objet, $modele) {
  $envoyer_mail = charger_fonction('envoyer_mail','inc'); // pour nettoyer_titre_email
  $id_type = id_table_objet($type_objet);
  return recuperer_fond($modele,array($id_type=>$id_objet,"id"=>$id_objet));
}

?>
