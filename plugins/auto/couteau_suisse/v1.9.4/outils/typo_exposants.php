<?php
// Filtre typographique exposants pour langue francaise
// serieuse refonte 2006 : Patrice Vanneufville
// Toutes les infos sur : http://contrib.spip.net/?article1564

// TODO : raccourci pour les exposants et indices (Pouce^2 ou Pouce^2^, H_2O ou H_2_O ou H,,2,,O
// exemple : http://zone.spip.org/trac/spip-zone/wiki/WikiFormatting

include_spip('inc/charsets');
@define('_TYPO_class', '<sup class="typo_exposants">');
define('_TYPO_sup', _TYPO_class.'\\1</sup>');
define('_TYPO_sup2', '\\1'._TYPO_class.'\\2</sup>');

// fonction simplifiee, equivalent numerique de unicode2charset($texte)
function caractere_charset($num) {
	if($GLOBALS['meta']['charset']=='utf-8')
		return caractere_utf_8($num);
	$charset = load_charset($GLOBALS['meta']['charset']);
	static $CHARSET_REVERSE;
	if(!is_array($CHARSET_REVERSE))
		$CHARSET_REVERSE = array_flip($GLOBALS['CHARSET'][$charset]);
	return isset($CHARSET_REVERSE[$num])?chr($CHARSET_REVERSE[$num]):chr($num);
}

// cette fonction appelee automatiquement a chaque affichage de la page privee du Couteau Suisse renvoie un tableau
function typo_exposants_installe_dist() {
	// en principe, pas besoin de : caractere_utf_8(232)
	$carre = caractere_charset(178).'|&(?:#178|sup2);';
	$egrave = caractere_charset(232).'|&(?:#232|egrave);';
	$eaigu1 = caractere_charset(233).'|&(?:#233|eacute);';
	$eaigu2 = caractere_charset(201).'|&(?:#201|Eacute);';
	// $accents = unicode2charset('&#224;&#225;&#226;&#228;&#229;&#230;&#232;&#233;&#234;&#235;&#236;&#237;&#238;&#239;&#242;&#243;&#244;&#246;&#249;&#250;&#251;&#252;');
	$accents = join('', array_map('caractere_charset', array(224,225,226,228,229,230,232,233,234,235,236,237,238,239,242,243,244,246,249,250,251,252)));
	$typo = array( array(
		'/(?<=\bM)e?(lles?)\b/',		// Mlle(s), Mme(s) et erreurs Melle(s)
		'/(?<=\bM)(gr|mes?)\b/',	// Mme(s) et Mgr
		'/(?<=\b[DP])(r)(?=[\s\.-])/',	// Dr, Pr suivis d'un espace d'un point ou d'un tiret

		"/m(?:$carre)/", '/(?<=\bm)([23])\b/',	 // m2, m3, m²
		'/(?<=\bM)(ios?|r?ds?)\b/',	// millions, milliards
		'/(?<=\bV)(ve)\b/', '/(?<=\bC)(ies?)\b/',	// Vve et Cie(s)
		"/(?<=\bS)(t(?:$eaigu1)s?)(?=\W)/", "/(?<=\W)(?:E|$eaigu2)ts\b/",	 // Societes(s), Etablissements

		'/(?<=\b[1I])i?(ers?)\b/',	// 1er(s), Erreurs 1(i)er(s), I(i)er(s)
		"/(?<=\b[1I])i?(?:e|$egrave)(res?)\b/",	// Erreurs 1(i)ere(s) + accents
		'/(?<=\b1)(r?es?)\b/', // 1e(s), 1re(s)
		'/(?<=\b2)(nde?s?)\b/',	// 2nd(e)(s)

		"/(\b[0-9IVX]+)i?(?:e|$egrave)?me(s?)\b/", // Erreurs (i)(e)me(s) + accents
		'/\b([0-9IVX]+)(es?)\b/', // 2e(s), IIIe(s)... (les 1(e?r?s?) ont deja ete remplaces)
		"/(?<![;$accents])\b(\d+|r|v)o(?=(?:&nbsp;|[\s,;:!\/\?\.-]))/", // recto, verso, primo, secondo, etc.
		'/(?<=\bM)(e)(?= [A-Z])/', // Maitre (suivi d'un espace et d'une majuscule)
	), array(
		_TYPO_sup, _TYPO_sup,		// Mlle(s), Mme(s), Mgr
		_TYPO_sup,		// Dr, Pr, 

		'm'._TYPO_class.'2</sup>',	_TYPO_sup,	// m2, m3, m²
		_TYPO_sup, _TYPO_sup, _TYPO_sup,	// Vve, Mn(s), Md(s), Bd(s), Cie(s)
		_TYPO_sup, '&#201;'._TYPO_class.'ts</sup>',	// Sté(s), Ets

		_TYPO_sup, _TYPO_sup, _TYPO_sup, // 1er et Cie
		_TYPO_sup,	// 2nd(e)(s)

		'$1'._TYPO_class.'e$2</sup>', // Erreurs me, eme, ème, ième + pluriels
		_TYPO_sup2, // 2e(s), IIIe(s)...
		'$1'._TYPO_class.'o</sup>', // ro, vo, 1o, 2o, etc.
		_TYPO_sup,	// Me
	// remplacements en str_replace()
	), array('<sup>'), array(_TYPO_class));

	if(defined('_CS_EXPO_BOFBOF')) {
		$typo[0] = array_merge($typo[0], array(
			'/(?<=\bS)(te?s?)(?=[\s\.-])/',  // St(e)(s) suivis d'un espace d'un point ou d'un tiret
			'/(?<=\bB)(x|se|ses)(?=[\s\.-])/',  // Bx, Bse(s) suivis d'un espace d'un point ou d'un tiret
			'/(?<=\b[Bb])(ds?)\b/',	 '/(?<=\b[Ff])(gs?)\b/', // boulevard(s) et faubourgs(s)
		));
		$typo[1] = array_merge($typo[1], array(
			_TYPO_sup, _TYPO_sup,	// St(e)(s), Bx, Bse(s)
			_TYPO_sup, _TYPO_sup,	// Bd(s) et Fg(s)
		));
	}
	// renvoie les tableaux de remplacement
	return array(
		// anglais
		'en'=> array( array(
			',(?<=1)(st)\b,',
			',(?<=2)(nd)\b,',
			',(?<=3)(rd)\b,',
			',(?<=\d)(th)\b,',
		), array(
			_TYPO_sup, _TYPO_sup, _TYPO_sup, _TYPO_sup,
		), array('<sup>'), array(_TYPO_class)), 
		// francais
		'fr' => $typo,
	);
}


// cette fonction n'est pas appelee dans les balises html : html|code|cadre|frame|script|acronym|cite
function typo_exposants_rempl($texte){
	if(defined('_SPIP19300')) $lang = lang_typo();
	else {
		// compat avec SPIP 1.92
		if (!$lang = $GLOBALS['lang_objet']) $lang = $GLOBALS['spip_lang'];
		$lang = lang_typo($lang);
	}
	// TODO : des blocs multi ?
	// if (strpos($texte, '<span lang=')!==false) {
	// }
	// suite du texte
	$typo = cs_lire_data_outil('typo_exposants', $lang);
	if($typo===NULL) return $texte;
	$texte = str_replace($typo[2], $typo[3], $texte);
	return preg_replace($typo[0], $typo[1], $texte);
}

function typo_exposants_echappe_balises_callback($matches) {
 return cs_code_echappement($matches[1], 'EXPO');
}

// ici on est en pipeline post_typo
function typo_exposants($texte){
	// prudence : on protege les balises <a> et <img>
	if (strpos($texte, '<')!==false)
		$texte = preg_replace_callback('/(<(a|img) [^>]+>)/Ums', 'typo_exposants_echappe_balises_callback', $texte);
	$texte = cs_echappe_balises('html|code|cadre|frame|script|acronym|cite', 'typo_exposants_rempl', $texte);
	return echappe_retour($texte, 'EXPO');
}
?>