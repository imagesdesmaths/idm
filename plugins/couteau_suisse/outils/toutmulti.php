<?php
/*
 - ToutMulti -
 Introduit le raccourci <:texte:> pour utiliser librement des
 blocs multi dans un flux de texte (via typo ou propre)
 Accepte egalement les arguments. Exemple :
  <:chaine{argument1=un texte, argument2=un autre texte}:>
*/

// expression tiree du code de SPIP 2.0 : ecrire/public/phraser_html.php
define('CS_BALISE_IDIOMES',',<:([a-z0-9_]+)({([^=>]*=[^>]*)})?:>,iS');

function ToutMulti_rempl($texte) {
	if (preg_match_all(CS_BALISE_IDIOMES, $texte, $matches, PREG_SET_ORDER)) {
		foreach ($matches as $m) {
			// Stocker les arguments de la balise de traduction
			$args = array();
			foreach(explode(',',$m[3]) as $val) {
				$arg = explode('=', $val);
				if (strlen($key = trim($arg[0]))) $args[$key] = trim($arg[1]);	
			}
			$texte = str_replace($m[0], _T('spip/ecrire/public:'.$m[1], $args), $texte);
		}
	}
	return $texte;
}

// fonction principale (pipeline pre_typo)
function ToutMulti_pre_typo($texte) {
	if (strpos($texte, '<:')===false) return $texte;
	// appeler ToutMulti_rempl() une fois que certaines balises ont ete protegees
	return cs_echappe_balises('', 'ToutMulti_rempl', $texte);
}

?>