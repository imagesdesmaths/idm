<?php

// anti-spam un peu brutal : 
//	1. une liste de mots interdits est consultee
//	2. si le mot existe dans un des textes d'un formulaire, on avertit !

// cette fonction appelee automatiquement a chaque affichage de la page privee du Couteau Suisse renvoie un tableau
function spam_installe_dist() {
	// tableau des mots interdits
	$t = array(
		// des liens en dur ou simili...
		array('<a href=', '</a>', '[url=', '[/url]', '[link=', '[/link]',),
		// des regexpr ou ips (sans delimiteurs)
		array(), array(), array(), array()
	);
	// essai de mouliner correctement les bordures de mot en utf-8
	if($GLOBALS['meta']['charset'] == 'utf-8') { $b1 = '(^|[\P{L}])'; $b2='([\P{L}]|$)'; $b3='u'; }
		else { $b1 = '\\b'; $b2='\\b'; $b3=''; }
	// repere les mots entiers entre parentheses, les regexpr entre slashes et les caracteres unicodes
	$spam_mots = defined('_spam_MOTS')?spam_liste_mots(_spam_MOTS):array();
	foreach($spam_mots as $v) {
		if(preg_match(',^\((.+)\)$,', $v, $reg))
			$t[1][] = $b1.preg_quote($reg[1], '/').$b2;
		elseif(preg_match(',^\/(&#)?(.*?)(;?)\/$,', $v, $reg))
			$t[($reg[2] && $reg[3])?2:1][]=$reg[2];
		elseif(preg_match(',^(\/.*\/)([a-z]+)$,i'.$b3, $v, $reg))
			$t[4][] = $reg[1].preg_replace(',[^imsxeAESUXu],','',$reg[2]);
		else $t[0][] = $v;
	}
	$t[1] = count($t[1])?'/'.join('|',$t[1]).'/i'.$b3:'';
	$t[2] = count($t[2])?'/&#(?:'.join('|',$t[2]).');/i'.$b3:'';
	$spam_mots = defined('_spam_IPS')?spam_liste_mots(_spam_IPS):array();
	array_walk($spam_mots, 'spam_walk');
	$t[3] = count($spam_mots)?'/^(?:' . join('|', $spam_mots) . ')$/':'';
	return array($t);
}

function spam_walk(&$item) {
	$item = preg_replace(',[^\d\.\*\?\[\]\-],', '', $item);
	if(preg_match(',^\/(.+)\/$,', $item, $reg))
		$item = '('.$reg[1].')';
	else $item = str_replace(array('\*','\?','\[','\]','\-'), array('\d+','\d','[',']','-'), preg_quote($item, '/'));
}

// retourne un tableau de mots ou d'expressions a partir d'un texte
function spam_liste_mots($texte) {
	include_spip('inc/filtres');
	$texte = filtrer_entites(trim($texte));
	$split = explode('"', $texte);
	$c = count($split);
	$split2 = array();
	for($i=0; $i<$c; $i++) if (($s = trim($split[$i])) != ""){
		if (($i & 1) && ($i != $c-1)) {
			// on touche pas au texte entre deux ""
			$split2[] = $split[$i];
		} else {
			// on rassemble tous les separateurs : \s\t\n
			$temp = preg_replace("/[\s\t\n\r]+/", "\t", $s);
			$temp = str_replace("+"," ", $temp);
			$split2 = array_merge($split2, explode("\t", $temp));
		}
	}
	return array_unique($split2);
}

?>