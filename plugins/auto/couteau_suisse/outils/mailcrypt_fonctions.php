<?php

function mailcrypt($texte) {
	static $ok = NULL;
	if (strpos($texte, '@')===false) return $texte;

	if(is_null($ok)) {
		$ok = true;
		// pour _cs_liens_AUTORISE
		include_spip('outils/inc_cs_liens');
		// tip visible onMouseOver (title)
		// jQuery replacera ensuite le '@' comme ceci : title.replace(/\.\..t\.\./,'[\x40]')
		@define('_mailcrypt_AROBASE_JS', '..&aring;t..');
		@define('_mailcrypt_AROBASE_JSQ', preg_quote(_mailcrypt_AROBASE_JS,','));
		// span ayant l'arobase en background
		@define('_mailcrypt_AROBASE', '<span class=\'spancrypt\'>&nbsp;</span>');
//		@define('_mailcrypt_REGEXPR1', ',\b['._cs_liens_AUTORISE.']*@[a-zA-Z][a-zA-Z0-9-.]*\.[a-zA-Z]+(\?['._cs_liens_AUTORISE.']*)?,');
		@define('_mailcrypt_REGEXPR2', ',\b(['._cs_liens_AUTORISE.']+)@([a-zA-Z][a-zA-Z0-9-.]*\.[a-zA-Z]+(\?['._cs_liens_AUTORISE.']*)?),');
	}

	// echappement des 'input' au cas ou le serveur y injecte des mails persos
	if (strpos($texte, '<in')!==false) 
		$texte = preg_replace_callback(',<input [^<]+/>,Umsi', 'cs_liens_echappe_callback', $texte);
	// echappement des 'protoc://login:mdp@site.ici' afin ne pas les confondre avec un mail
	if (strpos($texte, '://')!==false) 
		$texte = preg_replace_callback(',[a-z0-9]+://['._cs_liens_AUTORISE.']+:['._cs_liens_AUTORISE.']+@,Umsi', 'cs_liens_echappe_callback', $texte);
	// echappement des domaines .htm/.html : ce ne sont pas des mails
	if (strpos($texte, '.htm')!==false)
		$texte = preg_replace_callback(',href=(["\'])[^>]*@[^>]*\.html?\\1,', 'cs_liens_echappe_callback', $texte);

	// protection des liens HTML
	$texte = preg_replace(",[\"\']mailto:([^@\"']+)@([^\"']+)[\"\'],", 
		'"#" title="$1' . _mailcrypt_AROBASE_JS . '$2" onclick="location.href=lancerlien(\'$1\',\'$2\'); return false;"', $texte);
	// retrait des titles en doublon... un peu sale, mais en attendant mieux ?
	$texte = preg_replace(',title="[^"]+'._mailcrypt_AROBASE_JSQ.'[^"]+"([^>]+title=[\"\']),', '$1', $texte);

	if (strpos($texte, '@')===false) return echappe_retour($texte, 'LIENS');
	// protection de tout le reste...
	$texte = preg_replace(_mailcrypt_REGEXPR2, '$1'._mailcrypt_AROBASE.'$2', $texte);
	return echappe_retour($texte, 'LIENS');
}

?>