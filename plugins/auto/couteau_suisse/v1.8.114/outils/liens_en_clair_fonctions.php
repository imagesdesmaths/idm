<?php

function liens_en_clair_callback($matches) {
	if (preg_match(',^(mailto:|news:)(.*)$,', $lien = $matches[2], $matches2)) $lien = $matches2[2];
	// si mailcrypt est actif, on decode le lien cache dans "title"
	if (defined('_mailcrypt_AROBASE_JS') && preg_match(',title="([^"]+)'.preg_quote(_mailcrypt_AROBASE_JS).'([^"]+)",', $matches[0], $matches2)) 
		$lien = $matches2[1]._mailcrypt_AROBASE.$matches2[2];
	// doit-on afficher le lien en clair ?
	$ajouter_lien = 
		$lien!=$matches[3]
			// ni les ancres, ni les blocs
			&& $lien[0]!='#'
			&& strpos($lien, 'javascript:')===false
			// ni les liens internes, ni le glossaire SPIP...
			&& !preg_match(',(["\'])spip_(in|glossaire)\1,', $matches[0]);
	if ($ajouter_lien) return $matches[0] . " [$lien]";
	return $matches[0];
}

// filtre utilisable sur les balises SPIP
function liens_en_clair($texte) {
	if (strpos($texte, 'href')===false) return $texte;
	// recherche de tous les liens : <a href="??">
	$texte = preg_replace_callback(',<a.* href=(["\'])(.*)\1.*>(.*)</a>,Umsi', 'liens_en_clair_callback', $texte);
	return $texte;
}

?>