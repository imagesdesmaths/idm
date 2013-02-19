<?php
/*
 liens :
	http://fr.wikipedia.org/wiki/Wikip%C3%A9dia:AutoWikiBrowser/Typos/Aide
*/

// cette fonction appelee automatiquement a chaque affichage de la page privee du Couteau Suisse renvoie un tableau
function insertions_installe_dist() {
	if(!function_exists('_insertions_LISTE')) return NULL;
cs_log('insertions_installe_dist()');
	// on decode la liste entree dans la config
	$liste = preg_split("/[\r\n]+/", _insertions_LISTE());
	$str = $preg = array(array(), array());
	foreach ($liste as $l) {
		list($a, $b) = explode("=", $l, 2);
		$a = trim($a); $b = trim($b);
		if (!strlen($a) || preg_match('/^(#|\/\/)/', $a)) {
			// remarques ou vide
		} elseif (preg_match('/^\((.+)\)$/', $a, $reg)) {
			// les mots seuls
			$preg[0][] = '/\b'.$reg[1].'\b/'; $preg[1][] = $b;
		} elseif (preg_match('/^(\/.+\/[imsxuADSUX]*)$/', $a)) {
			// expressions regulieres
			$preg[0][] = $a; $preg[1][] = $b;
		} elseif (strlen($a)) {
			// simples remplacements
			$str[0][] = $a; $str[1][] = $b;
		}
	}
	return array(array($str, $preg));
}

?>