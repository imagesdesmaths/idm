<?php

function jsMath_accents ($texte) {
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

  return str_replace ($acc_tex, $acc_html, $texte);
}

function jsMath_typo ($texte) {
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

function jsMath_protect_TeX ($texte) {
  $texte = echappe_html ($texte); // To make example code easier.

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

  $texte = str_replace ('<html>$$', '<html><div class="math">', $texte);
  $texte = str_replace ('$$</html>', '</div></html>', $texte);
  $texte = str_replace ('<html>$', '<html><span class="math">', $texte);
  $texte = str_replace ('$</html>', '</span></html>', $texte);

  return echappe_html ($texte);
}

function jsMath_pre_typo ($texte) {
  $texte = jsMath_protect_TeX ($texte);
  $texte = jsMath_accents ($texte);
  $texte = jsMath_typo ($texte);

  return $texte;
}

function jsMath_insert_head ($texte) {
  $texte .= "\n" . '<script type="text/javascript" src="' . generer_url_public('jsMath_easy_load.js') . "\">\n</script>\n";
  return $texte;
}

function jsMath_header_prive ($texte) {
  return jsMath_insert_head ($texte);
}

?>
