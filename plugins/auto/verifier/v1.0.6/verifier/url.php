<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Vérification d'une URL
 * 
 * Si auncune option n'est définie, vérifie uniquement si un protocole de type web est défini
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 * 	 mode : protocole_seul, php_filter, complet
 *		 type_protocole : tous, web (http ou https), mail (imap, pop3, smtp), ftp (ftp ou sftp), exact
 *     protocole : nom du protocole (si type_protocole=exact)
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_url_dist($valeur, $options=array()){
	if (!is_string($valeur))
		return _T('erreur_inconnue_generique');

	// Choix du mode de verification de la syntaxe des url
	if (!$options['mode'] or !in_array($options['mode'], array('protocole_seul','php_filter','complet'))){
		$mode = 'protocole_seul';
	}
	else{
		$mode = $options['mode'];
	}
		
	// Choix du type de protocole à vérifier
	if (!$options['type_protocole'] or !in_array($options['type_protocole'], array('tous','web','mail','ftp','exact'))){
		$type_protocole = 'web';
	}
	else{
		$type_protocole = $options['type_protocole'];
		$protocole = '' ;
		if ($type_protocole=='exact' && $options['protocole']){
			$protocole = $options['protocole'];
		}
	}
		
	$fonctions_disponibles = array('protocole_seul' => 'verifier_url_protocole', 'php_filter' => 'verifier_php_filter', 'complet' => 'verifier_url_complet');
	$fonction_verif = $fonctions_disponibles[$mode];
	
	return $fonction_verif($valeur,$type_protocole,$protocole) ;

}

/**
 * Vérifier uniquement la présence d'un protocole
 *
 * @param string $valeur La valeur à vérifier
 * @param string $type_protocole : tous, web (http ou https), mail (imap, pop3, smtp), ftp (ftp ou sftp), exact
 * @param string $protocole : nom du protocole (si type_protocole=exact)
 * @return boolean Retourne true uniquement lorsque l'url est valide
 */
function verifier_url_protocole($url,$type_protocole,$protocole){

	$urlregex = array('tous' => "#^([a-z0-9]*)\:\/\/.*$# i",
						 'web' => "#^(https?)\:\/\/.*$# i",
						 'ftp' => "#^(s?ftp)\:\/\/.*$# i",
						 'mail' => "#^(pop3|smtp|imap)\:\/\/.*$# i",
						 'exact' => "#^(".$protocole.")\:\/\/.*$# i");
	
	$msg_erreur = array('tous' => "",
							 'web' => "http://, https://",
							 'ftp' => "^ftp://, sftp://",
							 'mail' => "pop3://, smtp://, imap://",
							 'exact' => $protocole."://" );
	

	if (!preg_match($urlregex[$type_protocole], $url)) {
		if($type_protocole=="tous") {
			return _T('verifier:erreur_url_protocole_exact', array('url' => echapper_tags($url)));
		} else {
			return _T('verifier:erreur_url_protocole', array('url' => echapper_tags($url),'protocole' => $msg_erreur[$type_protocole]));
		}
	}
	return '';
}

/**
 * Vérifier uniquement la présence d'un protocole
 *
 * @param string $valeur La valeur à vérifier
 * @param string $type_protocole : tous, web (http ou https), mail (imap, pop3, smtp), ftp (ftp ou sftp), exact
 * @param string $protocole : nom du protocole (si type_protocole=exact)
 * @return boolean Retourne true uniquement lorsque l'url est valide
 */
function verifier_php_filter($url,$type_protocole,$protocole){

	if (!filter_var($url, FILTER_VALIDATE_URL))
		return _T('verifier:erreur_url', array('url' => echapper_tags($valeur)));
	return '';
}

/**
 * Vérifier la présence d'un protocole et de la bonne syntaxe du reste de l'url
 *
 * http://phpcentral.com/208-url-validation-in-php.html
 * <http[s]|ftp> :// [user[:pass]@] hostname [port] [/path] [?getquery] [anchor]
 *
 * @param string $valeur La valeur à vérifier
 * @param string $type_protocole : web (http ou https), mail (imap, pop3, smtp), ftp (ftp ou sftp), exact
 * @param string $protocole : nom du protocole (si type_protocole=exact)
 * @return boolean Retourne true uniquement lorsque l'url est valide
 */
function verifier_url_complet($url,$type_protocole,$protocole){
	
	if($msg=verifier_url_protocole($url,$type_protocole,$protocole)!=''){
		return $msg;
	}
	// SCHEME
	$urlregex = "#^(.*)\:\/\/";
	
	// USER AND PASS (optional)
	$urlregex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
	
	// HOSTNAME OR IP
	$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*"; // http://x = allowed (ex. http://localhost, http://routerlogin)
	//$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)+"; // http://x.x = minimum
	//$urlregex .= "([a-z0-9+\$_-]+\.)*[a-z0-9+\$_-]{2,3}"; // http://x.xx(x) = minimum
	//use only one of the above
	
	// PORT (optional)
	$urlregex .= "(\:[0-9]{2,5})?";
	// PATH (optional)
	$urlregex .= "(\/([a-z0-9+\$_%,-]\.?)+)*\/?";
	// GET Query (optional)
	$urlregex .= "(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?";
	// ANCHOR (optional)
	$urlregex .= "(\#[a-z_.-][a-z0-9+\$_.-]*)?\$# i";
	
	if (!preg_match($urlregex, $url))
		return _T('verifier:erreur_url', array('url' => echapper_tags($valeur)));
	return '';
}