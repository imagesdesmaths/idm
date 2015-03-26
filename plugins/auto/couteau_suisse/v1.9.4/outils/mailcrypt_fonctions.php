<?php

function mailcrypt_init() {
	static $ok = NULL;
	if(is_null($ok)) {
		$ok = true;
		// pour _cs_liens_AUTORISE
		include_spip('outils/inc_cs_liens');
		// tip visible onMouseOver (title)
		// jQuery replacera ensuite le '@' comme ceci : title.replace(/\.\..t\.\./,'[\x40]')
		@define('_mailcrypt_AROBASE_JS', '..&aring;t..');
		@define('_mailcrypt_AROBASE_JSQ', preg_quote(_mailcrypt_AROBASE_JS,','));
		// span ayant l'arobase en background
		@define('_mailcrypt_AROBASE', '<span class=\'mcrypt\'>&nbsp;</span>');
//		@define('_mailcrypt_REGEXPR1', ',\b['._cs_liens_AUTORISE.']*@[a-zA-Z][a-zA-Z0-9-.]*\.[a-zA-Z]+(\?['._cs_liens_AUTORISE.']*)?,');
		@define('_mailcrypt_REGEXPR2', ',\b(['._cs_liens_AUTORISE.']+)@([a-zA-Z][a-zA-Z0-9-.]*\.[a-zA-Z]+(\?['._cs_liens_AUTORISE.']*)?),'); 
	}
}

// filtre surchargeable pour la balise #EMAIL protegee en public mais pas en prive
function mailcrypt_email_dist($texte) {
	if(!defined('_MAILCRYPT_TRAITE_EMAIL') || strpos($texte, '@')===false) return $texte;
	if(function_exists('mailcrypt_email')) return mailcrypt_email($texte);
	return test_espace_prive()?$texte:mailcrypt($texte);
}

function mailcrypt_crypt_callback($matches) {
	$i = uniqid();
	return cs_code_echappement('"#" title="' 
		. attribut_html(str_replace('@' ,_mailcrypt_AROBASE_JS, urldecode($matches[1]))) 
		. '" onclick="location.href=lancerlien(\''
		. str_replace('@', ','.$i.',', $matches[1]).'\',\','.$i.',\'); return false;"', 'LIENS');
}

function mailcrypt_decrypt_callback($matches) {
	return $matches[1].' href="mailto:'.str_replace($matches[3], '@', $matches[2]).'"';
}

function mailcrypt($texte) {
	if(strpos($texte, '@')===false) return $texte;
	mailcrypt_init();

	// echappement des 'input' au cas ou le serveur y injecte des mails persos
	if (strpos($texte, '<in')!==false) 
		$texte = preg_replace_callback(',<input [^<]+/>,Umsi', 'cs_liens_echappe_callback', $texte);
	// echappement des 'protoc://login:mdp@site.ici' afin ne pas les confondre avec un mail
	if(strpos($texte, '://')!==false) 
		$texte = preg_replace_callback(',[a-z0-9]+://['._cs_liens_AUTORISE.']+:['._cs_liens_AUTORISE.']+@,Umsi', 'cs_liens_echappe_callback', $texte);
	// echappement des domaines .htm/.html : ce ne sont pas des mails
	if(strpos($texte, '.htm')!==false)
		$texte = preg_replace_callback(',href=(["\'])[^>]*@[^>]*\.html?\\1,', 'cs_liens_echappe_callback', $texte);

	// protection des liens HTML
	$texte = preg_replace_callback(",[\"\']mailto:([^\"\']+)[\"\'],", 'mailcrypt_crypt_callback', $texte);
	// retrait des titles en doublon... un peu sale, mais en attendant mieux ?
	$texte = preg_replace(',title="[^"]+'._mailcrypt_AROBASE_JSQ.'[^"]+"([^>]+title=[\"\']),', '$1', $texte);

	if(strpos($texte, '@')===false) return echappe_retour($texte, 'LIENS');
	// protection de tout le reste...
	$texte = preg_replace(_mailcrypt_REGEXPR2, '$1'._mailcrypt_AROBASE.'$2', $texte);
	return echappe_retour($texte, 'LIENS');
}

function maildecrypt($texte) {
	if(strpos($texte, 'mcrypt')===false) return $texte;
	mailcrypt_init();

	// traiter les <span class='mcrypt'>chez</span>
	// \s+ est pour le compresseur HTML qui ajoute des CR partout !
	$texte = preg_replace(',<span\s+class=[\'"]mcrypt[\'"]>(.*)</span>,Umsi','@',$texte);
	// traiter les liens
	$texte = preg_replace_callback(
		',href="#" (title=["\'].*?["\']) onclick="location.href=lancerlien\(\'(\S*?)\'\,\'(\S*?)\'\); return false;",',
		'mailcrypt_decrypt_callback', $texte);
	// traiter les title
	return str_replace(attribut_html(_mailcrypt_AROBASE_JS), '@', $texte);
}

// pipeline recuperer_fond
function mailcrypt_recuperer_fond($flux) {
	static $fonds;
	if(defined('_MAILCRYPT_FONDS_DEMAILCRYPT')) {
		if(!isset($fonds)) $fonds = array_map('trim', explode(':', trim(_MAILCRYPT_FONDS_DEMAILCRYPT,':')));
		if(in_array($flux['args']['fond'], $fonds)) $flux['data']['texte'] = maildecrypt($flux['data']['texte']);
	}
	return $flux;
}

?>