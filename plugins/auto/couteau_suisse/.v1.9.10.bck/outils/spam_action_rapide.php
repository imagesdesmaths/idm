<?php

// module inclu dans la description de l'outil en page de configuration

include_spip('inc/actions');

function spam_filtre_de_test($texte) {
	if (!strlen($texte)) return '';
	$spam = cs_lire_data_outil('spam');
	$test = false;
	return cs_test_spam($spam, $texte, $test)?'ko':'ok';
}

function spam_filtre_de_test_array($textes) {
	$spam = cs_lire_data_outil('spam');
	$test = false;
	foreach($textes as $texte) if(cs_test_spam($spam, $texte, $test)) return 'ko';
	return 'ok';
}

function spam_filtre_de_test_ip($texte, $liste=false) {
	if (!strlen($texte)) return '';
	if(!preg_match_all(',\d+\.\d+\.\d+\.\d+,', $texte, $regs, PREG_PATTERN_ORDER)) return '';
	$res = array();
	$spam = cs_lire_data_outil('spam');
	foreach($regs[0] as $r) {
		$test = $spam[3]?preg_match($spam[3], "$r"):false;
		if(!$liste) { if($test) return 'ko'; }
		else $res[] = _T('couteauprive:spam_ip', array('ip'=>$r)).' '.strtolower(_T($test?'item_oui':'item_non'));
	}
	return $liste?join('<br />', $res):'ok';
}

function spam_action_rapide($actif) {
	include_spip('public/assembler'); // pour recuperer_fond()
	$fd = recuperer_fond('fonds/test_spam', array(
		'ar_message' => _request('ar_message'),
		'test_bd' => _request('test_bd'),
		'statut' =>_request('statut'),
		'debut_msg' => _request('debut_msg'),
	));
	// au cas ou il y aurait plusieurs actions, on fabrique plusieurs <form>
	$fd = explode('@@CS_FORM@@', $fd);
	$res = "";
	foreach($fd as $i=>$f) {
		// syntaxe : ajax_action_auteur($action, $id, $script, $args='', $corps=false, $args_ajax='', $fct_ajax='')
		$res .= ajax_action_auteur('action_rapide', 'test_'.$i, 'admin_couteau_suisse', "arg=spam|description_outil&modif=oui&cmd=descrip#cs_action_rapide", $f)."\n";
	}
	return $res;
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function spam_test_0_action() {
	// lancer le test de l'anti-spam
	// aucune action, le test est pris en charge par ?exec=action_rapide
	redirige_vers_exec(array('ar_message' =>_request('ar_message')));
}

function spam_test_1_action() {
	// lancer le test sur les messages de la base
	redirige_vers_exec(array('test_bd'=>1, 'statut' =>_request('statut'), 'debut_msg' =>_request('debut_msg')));
}


?>