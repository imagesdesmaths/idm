<?php
// Filtre typographique exposants pour langue francaise
// serieuse refonte 2006 : Patrice Vanneufville
// Toutes les infos sur : http://www.spip-contrib.net/?article1564

// TODO : raccourci pour les exposants et indices (Pouce^2 ou Pouce^2^, H_2O ou H_2_O ou H,,2,,O
// exemple : http://zone.spip.org/trac/spip-zone/wiki/WikiFormatting

include_spip('inc/charsets');
@define('_TYPO_sup', '<sup class="typo_exposants">\\1</sup>');
@define('_TYPO_sup2', '\\1<sup class="typo_exposants">\\2</sup>');

// cette fonction ne fonctionne que pour l'anglais
// elle n'est pas appelee dans les balises html : html|code|cadre|frame|script|acronym|cite
function typo_exposants_en($texte){
	static $typo;
	if(!$typo) $typo = array( array(
		',(?<=1)(st)\b,',
		',(?<=2)(nd)\b,',
		',(?<=3)(rd)\b,',
		',(?<=\d)(th)\b,',
	), array(
		_TYPO_sup, _TYPO_sup, _TYPO_sup, _TYPO_sup,
	));
	return preg_replace($typo[0], $typo[1], $texte);
}

// cette fonction ne fonctionne que pour le francais
// elle n'est pas appelee dans les balises html : html|code|cadre|frame|script|acronym|cite
function typo_exposants_fr($texte){
	static $typo = NULL;
	static $egrave; static $eaigu1; static $eaigu2; static $accents;
	if (is_null($typo)) {
		// en principe, pas besoin de : caractere_utf_8(232)
		$egrave = unicode2charset('&#232;').'|&#232;|&egrave;';
		$eaigu1 = unicode2charset('&#233;').'|&#233;|&eacute;';
		$eaigu2 = unicode2charset('&#201;').'|&#201;|&Eacute;';
		$accents = unicode2charset('&#224;&#225;&#226;&#228;&#229;&#230;&#232;&#233;&#234;&#235;&#236;&#237;&#238;&#239;&#242;&#243;&#244;&#246;&#249;&#250;&#251;&#252;');
		$typo = array( array(
			'/(?<=\bM)e?(lles?)\b/',		// Mlle(s), Mme(s) et erreurs Melle(s)
			'/(?<=\bM)(gr|mes?)\b/',	// Mme(s) et Mgr
			'/(?<=\b[DP])(r)(?=[\s\.-])/',	// Dr, Pr suivis d'un espace d'un point ou d'un tiret

			'/\bm²\b/', '/(?<=\bm)([23])\b/',	 // m2, m3, m²
			'/(?<=\b[Mm])([nd]s?)\b/',	// millions, milliards
			'/(?<=\bV)(ve)\b/', '/(?<=\bC)(ies?)\b/',	// Vve et Cie(s)
			"/(?<=\bS)(t(?:$eaigu1)s?)(?=\W)/", "/(?<=\W)(?:E|$eaigu2)ts\b/",	 // Societes(s), Etablissements

			'/(?<=\b[1I])i?(ers?)\b/',	// 1er(s), Erreurs 1ier(s), 1ier(s)
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

			'm<sup class="typo_exposants">2</sup>',	_TYPO_sup,	// m2, m3, m²
			_TYPO_sup, _TYPO_sup, _TYPO_sup,	// Vve, Mn(s), Md(s), Bd(s), Cie(s)
			_TYPO_sup, '&#201;<sup class="typo_exposants">ts</sup>',	// Sté(s), Ets

			_TYPO_sup, _TYPO_sup, _TYPO_sup, // 1er et Cie
			_TYPO_sup,	// 2nd(e)(s)

			'$1<sup class="typo_exposants">e$2</sup>', // Erreurs me, eme, ème, ième + pluriels
			_TYPO_sup2, // 2e(s), IIIe(s)...
			'$1<sup class="typo_exposants">o</sup>', // ro, vo, 1o, 2o, etc.
			_TYPO_sup,	// Me
		));

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
	}
	return preg_replace($typo[0], $typo[1], $texte);
}

function typo_exposants_echappe_balises_callback($matches) {
 return cs_code_echappement($matches[1], 'EXPO');
}

// ici on est en pipeline post_typo
function typo_exposants($texte){
	if (!$lang = $GLOBALS['lang_objet']) $lang = $GLOBALS['spip_lang'];
	if(!function_exists($fonction = 'typo_exposants_'.lang_typo($lang))) return $texte;
	// prudence : on protege les balises <a> et <img>
	if (strpos($texte, '<')!==false)
		$texte = preg_replace_callback('/(<(a|img) [^>]+>)/Ums', 'typo_exposants_echappe_balises_callback', $texte);
	$texte = cs_echappe_balises('html|code|cadre|frame|script|acronym|cite', $fonction, $texte);
	return echappe_retour($texte, 'EXPO');
}
?>