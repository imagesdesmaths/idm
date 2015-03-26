<?php

// traitement anti-spam uniquement si $_POST est rempli et si l'espace n'est pas prive
if ( count($_POST) 
	// espace prive en clair dans l'url
	&& (strpos($_SERVER['PHP_SELF'],'/ecrire') === false) 
	// cas des actions
	&& !isset($_POST['action'])
	) {

	// champs du formulaire a visiter
	//	un message en forum : texte, titre, auteur
	//	un message a un auteur : texte_message_auteur_XX, sujet_message_auteur_XX, email_message_auteur_XX
	//	inscription : nom_inscription, mail_inscription
	//	login : session_*
	$spam_POST_reg = ',^(?:texte|titre|sujet|auteur|nom|e?mail|session),i';
	// on compile $spam_POST en fonction des variables $_POST trouvees
	$spam_POST_compile = array();
	foreach (array_keys($_POST) as $key)
		if (preg_match($spam_POST_reg, $key) && strpos($key, 'password')===false)
			$spam_POST_compile[] = $key;

	include_spip('cout_lancement');
	$spam_mots = cs_lire_data_outil('spam');
	// test IP compatible avec l'outil 'no_IP'
	$test = $spam_mots[3]?preg_match($spam_mots[3], $ip_):false;
	foreach ($spam_POST_compile as $var) if(!$test)
		if(cs_test_spam($spam_mots, $_POST[$var], $test)) $_GET['var'] = $var;
	if($test) $_GET['action'] = "cs_spam";
	// nettoyage
	unset($test, $spam_mots, $spam_POST_reg, $spam_POST_compile);

	function action_cs_spam(){
		include_spip('inc/minipres');
		echo minipres(
			_T('couteau:lutte_spam'),
			'<pre>'.$_POST[$_GET['var']].'</pre><div>'._T('couteau:explique_spam').'</div>'
		);
		exit;
	}
}
unset($ip_);

function cs_test_spam(&$spam, &$texte, &$test) {
	foreach($spam[0] as $m) 
		if($test |= strpos($texte, $m)!==false) 
			{ spip_log("Strpos. '$m' present dans : $texte", "_cs_spams"); return true; }
	if($spam[1]) 
		if($test = preg_match($spam[1], $texte))
			{ spip_log("Match. $spam[1] positif sur : $texte", "_cs_spams"); return true; }
	if($spam[2]) {
		include_spip('inc/charsets');
		if($test = preg_match($spam[2], charset2unicode($texte)))
			{ spip_log("UMatch. $spam[2] positif sur : $texte", "_cs_spams"); return true; }
	}
	if($spam[4]) foreach($spam[4] as $m) 
		if($test = preg_match($m, $texte)) 
			{ spip_log("Match. $m positif sur : $texte", "_cs_spams"); return true; }
	return $test;
}

?>