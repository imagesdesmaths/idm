<?php
/*
 * Plugin Facteur 2
 * (c) 2009-2011 Collectif SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function formulaires_configurer_facteur_charger_dist(){
	$valeurs = array(
		'facteur_adresse_envoi' => $GLOBALS['meta']['facteur_adresse_envoi'],
		'facteur_adresse_envoi_nom' => $GLOBALS['meta']['facteur_adresse_envoi_nom'],
		'facteur_adresse_envoi_email' => $GLOBALS['meta']['facteur_adresse_envoi_email'],
		'facteur_smtp' => $GLOBALS['meta']['facteur_smtp'],
		'facteur_smtp_host' => $GLOBALS['meta']['facteur_smtp_host'],
		'facteur_smtp_port' => $GLOBALS['meta']['facteur_smtp_port']?$GLOBALS['meta']['facteur_smtp_port']:'25',
		'facteur_smtp_auth' => $GLOBALS['meta']['facteur_smtp_auth'],
		'facteur_smtp_username' => $GLOBALS['meta']['facteur_smtp_username'],
		'facteur_smtp_password' => $GLOBALS['meta']['facteur_smtp_password'],
		'facteur_smtp_secure' => $GLOBALS['meta']['facteur_smtp_secure'],
		'facteur_smtp_sender' => $GLOBALS['meta']['facteur_smtp_sender'],
		'facteur_filtre_images' => $GLOBALS['meta']['facteur_filtre_images'],
		'facteur_filtre_iso_8859' => $GLOBALS['meta']['facteur_filtre_iso_8859'],
		'_enable_smtp_secure' => (intval(phpversion()) == 5)?' ':'',
		'facteur_cc' => $GLOBALS['meta']['facteur_cc'],
		'facteur_bcc' => $GLOBALS['meta']['facteur_bcc'],
	'tester' => '',
	);

	return $valeurs;
}

function formulaires_configurer_facteur_verifier_dist(){
	$erreurs = array();
	if ($email = _request('facteur_adresse_envoi_email')
	  AND !email_valide($email)) {
		$erreurs['facteur_adresse_envoi_email'] = _T('form_email_non_valide');
		set_request('facteur_adresse_envoi','oui');
	}
	if (_request('facteur_smtp')=='oui'){
		if (!($h=_request('facteur_smtp_host')))
			$erreurs['facteur_smtp_host'] = _T('info_obligatoire');
		else {
			$regexp_ip_valide = '#^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))|((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))$#'; 
			// Source : http://www.d-sites.com/2008/10/09/regex-ipv4-et-ipv6/
			if (!preg_match($regexp_ip_valide,$h)){ // ce n'est pas une IP
				if(!preg_match(';^([^.\s/?:]+[.]){0,2}[^.\s/?:]+$;',$h)
				  OR gethostbyname($h)==$h)
					$erreurs['facteur_smtp_host'] = _T('facteur:erreur_invalid_host');
			}
			else {
				if (gethostbyaddr($h)==$h)
					$erreurs['facteur_smtp_host'] = _T('facteur:erreur_invalid_host');				
			}
		}
		if (!($p=_request('facteur_smtp_port')))
			$erreurs['facteur_smtp_port'] = _T('info_obligatoire');
		elseif(!preg_match(';^[0-9]+$;',$p) OR !intval($p))
			$erreurs['facteur_smtp_port'] = _T('facteur:erreur_invalid_port');

		if (!_request('facteur_smtp_auth'))
			$erreurs['facteur_smtp_auth'] = _T('info_obligatoire');

		if (_request('facteur_smtp_auth')=='oui'){
			if (!_request('facteur_smtp_username'))
				$erreurs['facteur_smtp_username'] = _T('info_obligatoire');
			if (!_request('facteur_smtp_password'))
				$erreurs['facteur_smtp_password'] = _T('info_obligatoire');
		}
	}
	if ($emailcc = _request('facteur_cc')
	  AND !email_valide($emailcc)) {
		$erreurs['facteur_cc'] = _T('form_email_non_valide');
	}
	if ($emailbcc = _request('facteur_bcc')
	  AND !email_valide($emailbcc)) {
		$erreurs['facteur_bcc'] = _T('form_email_non_valide');
	}
	
	if(count($erreurs)>0){
		$erreurs['message_erreur'] = _T('facteur:erreur_generale');
	}
	return $erreurs;
}

function formulaires_configurer_facteur_traiter_dist(){
	include_spip('inc/meta');

	$facteur_adresse_envoi = _request('facteur_adresse_envoi');
	ecrire_meta('facteur_adresse_envoi', ($facteur_adresse_envoi=='oui')?'oui':'non');

	$facteur_adresse_envoi_nom = _request('facteur_adresse_envoi_nom');
	ecrire_meta('facteur_adresse_envoi_nom', $facteur_adresse_envoi_nom?$facteur_adresse_envoi_nom:'');

	$facteur_adresse_envoi_email = _request('facteur_adresse_envoi_email');
	ecrire_meta('facteur_adresse_envoi_email', $facteur_adresse_envoi_email?$facteur_adresse_envoi_email:'');

	$facteur_smtp = _request('facteur_smtp');
	ecrire_meta('facteur_smtp', ($facteur_smtp=='oui')?'oui':'non');

	$facteur_smtp_host = _request('facteur_smtp_host');
	ecrire_meta('facteur_smtp_host', $facteur_smtp_host?$facteur_smtp_host:'');

	$facteur_smtp_port = _request('facteur_smtp_port');
	ecrire_meta('facteur_smtp_port', strlen($facteur_smtp_port)?intval($facteur_smtp_port):'');

	$facteur_smtp_auth = _request('facteur_smtp_auth');
	ecrire_meta('facteur_smtp_auth', ($facteur_smtp_auth=='oui')?'oui':'non');

	$facteur_smtp_username = _request('facteur_smtp_username');
	ecrire_meta('facteur_smtp_username', $facteur_smtp_username);

	$facteur_smtp_password = _request('facteur_smtp_password');
	ecrire_meta('facteur_smtp_password', $facteur_smtp_password);

	if (intval(phpversion()) == 5) {
		$facteur_smtp_secure = _request('facteur_smtp_secure');
		ecrire_meta('facteur_smtp_secure', in_array($facteur_smtp_secure,array('non','ssl','tls'))?$facteur_smtp_secure:'non');
	}

	$facteur_smtp_sender = _request('facteur_smtp_sender');
	ecrire_meta('facteur_smtp_sender', $facteur_smtp_sender);

	ecrire_meta('facteur_filtre_images', intval(_request('facteur_filtre_images')));
	ecrire_meta('facteur_filtre_iso_8859', intval(_request('facteur_filtre_iso_8859')));

	$facteur_cc = _request('facteur_cc');
	ecrire_meta('facteur_cc', $facteur_cc?$facteur_cc:'');

	$facteur_bcc = _request('facteur_bcc');
	ecrire_meta('facteur_bcc', $facteur_bcc?$facteur_bcc:'');
	
	
	$res = array('message_ok'=>_T('facteur:config_info_enregistree'));

	// faut-il envoyer un message de test ?
	if (_request('tester')){

		if ($GLOBALS['meta']['facteur_adresse_envoi'] == 'oui'
		  AND $GLOBALS['meta']['facteur_adresse_envoi_email'])
			$destinataire = $GLOBALS['meta']['facteur_adresse_envoi_email'];
		else
			$destinataire = $GLOBALS['meta']['email_webmaster'];

		if ((facteur_envoyer_mail_test($destinataire,_T('facteur:corps_email_de_test')))===true){
			// OK
			$res = array('message_ok'=>_T('facteur:email_test_envoye'));
		}
		else {
			// erreur
			$res = array('message_erreur'=>_T('facteur:erreur')._T('facteur:erreur_dans_log'));
		}
	}
	
	return $res;
}

function facteur_envoyer_mail_test($destinataire,$titre){
	include_spip('classes/facteur');
	$message_html	= recuperer_fond('emails/test_email_html', array());
	$message_texte	= recuperer_fond('emails/test_email_texte', array());

	// passer par envoyer_mail pour bien passer par les pipeline et avoir tous les logs
	$envoyer_mail = charger_fonction('envoyer_mail','inc');
	$retour = $envoyer_mail($destinataire, $titre, array('html'=>$message_html,'texte'=>$message_texte));

	return $retour?true:false;
}
?>
