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

function idm_pre_typo ($texte) {
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

?>
