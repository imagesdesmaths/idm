<?php
/*
 Liens orphelins - Code & integration 2007 : Patrice Vanneufville
 Toutes les infos sur : http://contrib.spip.net/?article2443
*/

include_spip('outils/inc_cs_liens');

// Traitement de la balise #EMAIL
function liens_orphelins_email($email){
	return test_espace_prive()?$email:expanser_liens(liens_orphelins($email));
}

function liens_orphelins($texte){
	// deja, on s'en va si pas de point...
	if ($GLOBALS["liens_orphelins"]<0 || strpos($texte, '.')===false) return $texte;
	// prudence 1 : on protege TOUTES les balises <a></a> pour eviter les doublons
	if (strpos($texte, '<a')!==false) 
		$texte = preg_replace_callback(',<a\s*[^<]+</a>,Ums', 'cs_liens_echappe_callback', $texte);
	// prudence 2 : on protege TOUS les raccourcis de liens Spip, au cas ou...
	if (strpos($texte, '[')!==false) 
		$texte = preg_replace_callback(',\[([^][]*)->(>?)([^]]*)\],msS', 'cs_liens_echappe_callback', $texte);
	// prudence 3 : on protege TOUTES les balises contenant des points et <form/>, histoire de voir plus clair
	if (strpos($texte, '<')!==false) 
		$texte = preg_replace_callback(',<(?:form|[^>]+\.)[^>]*>,Ums', 'cs_liens_echappe_callback', $texte);
	// encore ici, on s'en va si pas de point...
	if (strpos($texte, '.')===false) return echappe_retour($texte, 'LIENS');

	// trouve et protege : protocole://qqchose
	$texte = preg_replace_callback(_cs_liens_HTTP, 'cs_liens_raccourcis_callback', $texte);
	// trouve et protege : www.lieu.qqchose ou ftp.lieu.qqchose
	$texte = preg_replace_callback(_cs_liens_WWW, 'cs_liens_raccourcis_callback', $texte);
	// trouve : mailto:qqchose ou news:qqchose
	if($GLOBALS['liens_orphelins']>0) {
	   $texte = preg_replace_callback(_cs_liens_NEWS, 'cs_liens_raccourcis_callback', $texte);
	   $texte = preg_replace_callback(_cs_liens_MAILS, 'cs_liens_email_callback', $texte);
	}
	return echappe_retour($texte, 'LIENS');
}

?>