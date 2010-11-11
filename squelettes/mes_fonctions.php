<?php

global $tables_principales;
$tables_principales['spip_auteurs']['field']['billettiste'] = "enum('oui','non') NOT NULL DEFAULT 'non'";

function lettrine ($texte) {
  $lines = explode ("\n", $texte);
  for ($i=0; $i<count($lines); $i++) {
    if (preg_match ('/(.*)<p>[\\s]*((&#171;|.)(’)?)([^\\s]*)([\\s])/', $lines[$i], $matches)) {
      $lettrine = $matches[1] . '<p class="spip lettrine"><span class="lettrine"><span class="lettrine_first">' . $matches[2] . '</span>' . $matches[5] . '</span>' . $matches[6];
      $lines[$i] = str_replace ($matches[0], $lettrine, $lines[$i]);
      break;
    } 
  }
  return implode ("\n", $lines);
}

function initiale ($mot) {
  return strtoupper($mot[0]);
}

?>
