<?php

/*
 code & integration 2007 : Patrice Vanneufville
 Toutes les infos sur : http://contrib.spip.net/?article2443
*/
include_spip('outils/inc_cs_liens');

// liens_orphelins() est dans liens_orphelins_fonctions.php pour permettre les traitements
function liens_orphelins_pipeline($texte){
	if ($GLOBALS["liens_orphelins"]<0 || strpos($texte, '.')===false) return $texte;
	return cs_echappe_balises('html|code|cadre|frame|script|acronym|cite', 'liens_orphelins', $texte);
}

function liens_orphelins_recuperer_fond($flux) {
	// verification des balises #EMAIL devenue cliquables mais utilisees comme ceci : <a href='mailto:(#EMAIL)'>
	// (cas rare en principe)
	if((strpos($texte = &$flux['data']['texte'], 'mailto:<a')!==false)) 
		$texte = preg_replace(',mailto:<a[^>]+>(.*)</a>,Ums', 'mailto:$1', $texte);
	return $flux;
}

function interro_liens_callback($matches) {
 return cs_code_echappement(echappe_interro_amp($matches[0]), 'LIENS');
}

// Fonction de remplacement
function interro_rempl($texte) {
	// prudence 1 : on protege TOUTES les balises contenant des "?", "!" ou "-", histoire de voir plus clair
	if (strpos($texte, '<')!==false) 
		$texte = preg_replace_callback(',(<[^>]+[?!-][^>]*>),Ums', 'cs_liens_echappe_callback', $texte);
	// prudence 2 : on protege TOUS les liens de raccourcis de liens Spip, au cas ou...
	if (strpos($texte, '[')!==false) 
		$texte = preg_replace_callback(',\[[^][]*->>?([^]]*)\],msS', 'cs_liens_echappe_callback', $texte);

	// ici, on traite si on trouve des "?", "!" ou "--"
	if (strpos($texte, '?')!==false || strpos($texte, '!')!==false || strpos($texte, '--')!==false) {
		// trouve et protege : protocole://qqchose
		$texte = preg_replace_callback(_cs_liens_HTTP, 'interro_liens_callback', $texte);
		// trouve et protege : www.lieu.qqchose ou ftp.lieu.qqchose
		$texte = preg_replace_callback(_cs_liens_WWW, 'interro_liens_callback', $texte);
	}
	return echappe_retour($texte, 'LIENS');
}
 
// Fonctions de pipeline
function interro_pre_typo($texte) {
 	if ($GLOBALS["liens_interrogation"] 
			&& (strpos($texte, '?')!==false || strpos($texte, '!')!==false || strpos($texte, '--')!==false))
	 	// appeler interro_rempl() une fois que certaines balises ont ete protegees
		return cs_echappe_balises('', 'interro_rempl', $texte);
 	return $texte;
}

function interro_post_propre($texte) {
 	return retour_interro_amp($texte);
}

?>