<?php
// integration 2007 : Patrice Vanneufville
// Toutes les infos sur : http://contrib.spip.net/?article1592

/*
Fichier de formatage typographique des guillemets, par Vincent Ramos
<www-lansargues AD kailaasa POINT net>, sous licence GNU/GPL.

Ne sont touchees que les paires de guillemets.

Le formatage des guillemets est tire de
<http://en.wikipedia.org/wiki/Quotation_mark%2C_non-English_usage>
Certains des usages indiques ne correspondent pas a ceux que la
barre d'insertion de caracteres speciaux de SPIP propose.

Les variables suivies du commentaire LRTEUIN sont confirmees par le
_Lexique des regles typographiques en usage a l'Imprimerie nationale_.

Les variables entierement commentees sont celles pour lesquelles
aucune information n'a ete trouvee. Par defaut, les guillements sont alors
de la forme &ldquo;mot&rdquo;, sauf si la barre d'insertion de SPIP proposait
deja une autre forme.
*/

// voir aussi : http://trac.rezo.net/trac/spip/changeset/9429

// definitions des chaines de remplacement
define('_GUILLEMETS_defaut', '&ldquo;$1&rdquo;');
define('_GUILLEMETS_fr', '&laquo;&nbsp;$1&nbsp;&raquo;'); //LRTEUIN
//define('_GUILLEMETS_ar', '');
define('_GUILLEMETS_bg', '&bdquo;$1&ldquo;');
//define('_GUILLEMETS_br', '');
//define('_GUILLEMETS_bs', '');
define('_GUILLEMETS_ca', '&laquo;$1&raquo;');
define('_GUILLEMETS_cpf', '&laquo;&nbsp;$1&nbsp;&raquo;');
//define('_GUILLEMETS_cpf_hat', '');
define('_GUILLEMETS_cs', '&bdquo;$1&ldquo;');
define('_GUILLEMETS_da', '&raquo;$1&laquo;');
define('_GUILLEMETS_de', '&bdquo;$1&ldquo;'); //ou "&raquo;$1&laquo;" // LRTEUIN
define('_GUILLEMETS_en', '&ldquo;$1&rdquo;'); //LRTEUIN
define('_GUILLEMETS_eo', '&laquo;$1&raquo;');
define('_GUILLEMETS_es', '&laquo;$1&raquo;');
//define('_GUILLEMETS_eu', '');
//define('_GUILLEMETS_fa', '');
//define('_GUILLEMETS_fon', '');
//define('_GUILLEMETS_gl', '');
define('_GUILLEMETS_hu', '&bdquo;$1&rdquo;');
define('_GUILLEMETS_it', '&laquo;$1&raquo;');
define('_GUILLEMETS_it_fem', '&laquo;$1&raquo;');
define('_GUILLEMETS_ja', '&#12300;$1&#12301;');
//define('_GUILLEMETS_lb', '');
define('_GUILLEMETS_nl', '&bdquo;$1&rdquo;');
//define('_GUILLEMETS_oc_auv', '');
//define('_GUILLEMETS_oc_gsc', '');
//define('_GUILLEMETS_oc_lms', '');
//define('_GUILLEMETS_oc_lnc', '');
//define('_GUILLEMETS_oc_ni', '');
//define('_GUILLEMETS_oc_ni_la', '');
//define('_GUILLEMETS_oc_prv', '');
//define('_GUILLEMETS_oc_va', '');
define('_GUILLEMETS_pl', '&bdquo;$1&rdquo;');
define('_GUILLEMETS_pt', '&laquo;$1&raquo;');
define('_GUILLEMETS_pt_br', '&laquo;$1&raquo;');
define('_GUILLEMETS_ro', '&bdquo;$1&rdquo;');
define('_GUILLEMETS_ru', '&laquo;$1&raquo;');
define('_GUILLEMETS_tr', '&laquo;$1&raquo;');
//define('_GUILLEMETS_vi', '');
define('_GUILLEMETS_zh', '&#12300;$1&#12301;'); // ou "&ldquo;$1&rdquo;" en chinois simplifie

function typo_guillemets_echappe_balises_callback($matches) {
 return cs_code_echappement($matches[1], 'GUILL');
}

function typo_guillemets_rempl($texte){
	// on s'en va si pas de guillemets...
	if (strpos($texte, '"')===false) return $texte;
	// prudence : on protege TOUTES les balises contenant des doubles guillemets droits
	if (strpos($texte, '<')!==false) 
		$texte = preg_replace_callback('/(<[^>]+"[^>]*>)/Ums', 'typo_guillemets_echappe_balises_callback', $texte);
//		$texte = preg_replace('/(<[^>]+"[^>]*>)/Umse', 'cs_code_echappement("\\1", "GUILL")', $texte);
		;
	// choix de la langue, de la constante et de la chaine de remplacement
	$lang = isset($GLOBALS['lang_objet'])?$GLOBALS['lang_objet']:$GLOBALS['spip_lang'];
	$constante = '_GUILLEMETS_'.$lang;
	$guilles = defined($constante)?constant($constante):_GUILLEMETS_defaut;
	
	// Remplacement des autres paires de guillemets (et suppression des espaces apres/avant)
	// Et retour des balises contenant des doubles guillemets droits
	return echappe_retour(preg_replace('/"\s*(.*?)\s*"/', $guilles, $texte), 'GUILL');
}

function typo_guillemets($texte){
	if (strpos($texte, '"')===false) return $texte;
	return cs_echappe_balises('html|code|cadre|frame|script|acronym|cite', 'typo_guillemets_rempl', $texte);
}

?>