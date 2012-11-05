<?php
/*
 - ToutMulti -
 Introduit le raccourci <:texte:> pour utiliser librement des
 blocs multi dans un flux de texte (via typo ou propre)
 Accepte egalement les arguments. Exemple :
  <:chaine{argument1=un texte, argument2=un autre texte}:>
*/


function ToutMulti_rempl($texte) {
	// expression tiree du code de SPIP 2.0 et 3.0 : ecrire/public/phraser_html.php
	// les filtres ont ete retires
	if (!defined('CS_BALISE_IDIOMES'))
		define('CS_BALISE_IDIOMES',',<:(([a-z0-9_]+):)?([a-z0-9_:]+)({([^=>]*=[^>]*)})?:>,iS');
	// separateur des listes de modules a consulter (MODULES_IDIOMES est une constante definie sous SPIP 3.0)
	if (!defined('MODULES_IDIOMES'))
			define('MODULES_IDIOMES', defined('_SPIP30000')?'public|spip|ecrire':'spip/ecrire/public');
	if (preg_match_all(CS_BALISE_IDIOMES, $texte, $matches, PREG_SET_ORDER)) {
		foreach ($matches as $m) {
			// Stocker les arguments de la balise de traduction
			$args = array();
			foreach(explode(',',$m[5]) as $val) {
				$arg = explode('=', $val);
				if (strlen($key = trim($arg[0]))) $args[$key] = trim($arg[1]);	
			}
			$texte = str_replace($m[0], _T((strlen($m[1])?$m[1]:(MODULES_IDIOMES.':')).$m[3], $args), $texte);
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