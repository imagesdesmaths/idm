<?php

function mj_protect_TeX ($texte) {
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

  //$texte = str_replace ('<html>$$', '<html><div class="math">', $texte);
  //$texte = str_replace ('$$</html>', '</div></html>', $texte);
  //$texte = str_replace ('<html>$', '<html><span class="math">', $texte);
  //$texte = str_replace ('$</html>', '</span></html>', $texte);

  return echappe_html ($texte);
}

function mj_pre_typo ($texte) {
  $texte = mj_protect_TeX ($texte);

  return $texte;
}

function mj_insert_head ($texte) {
  $mj_file = find_in_path ('MathJax/MathJax.js');
  $mj_insert = <<<END
    <script type="text/javascript" src="$mj_file">
      MathJax.Hub.Config({
        extensions: ["tex2jax.js", "jsMath2jax.js", "TeX/noErrors.js"],
        jax:        ["input/TeX",  "output/HTML-CSS"],
        tex2jax: {
          inlineMath:          [ ['$','$'],   ["\\\\(","\\\\)"] ],
          processEnvironments: false,
        }
      });
    </script>
END;
  return $texte . $mj_insert;
}

function mj_header_prive ($texte) {
  //return jsMath_insert_head ($texte);
  return $texte;
}

?>
