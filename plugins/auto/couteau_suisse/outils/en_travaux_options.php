<?php
// affiche un fond travaux si on n'est pas en zone ecrire ni admin

// compatibilite pour SPIP 1.9.2
if (!function_exists('test_espace_prive')) {
	function test_espace_prive() {
		return defined('_DIR_RESTREINT') ? !_DIR_RESTREINT : false;
	}
}

if($tr_prive = test_espace_prive()) {
	// prive : les admins passent, les redac passent si '!Tous'
	$tr_acces = ($GLOBALS['auteur_session']['statut']=='0minirezo') || !defined('_en_travaux_PRIVE');
} else {
	// public : les admins passent si 'SaufAdmin'
	if (defined('_en_travaux_PUBLIC')) {
		switch (_en_travaux_PUBLIC) {
			case 1:
				$tr_acces = ($GLOBALS['auteur_session']['statut']=='0minirezo');
				break;
			case 2:
				$tr_acces = ($GLOBALS['auteur_session']['statut']=='0minirezo') || ($GLOBALS['auteur_session']['statut']=='1comite');
				break;
			case 3:
				$tr_acces = ($GLOBALS['auteur_session']['statut']=='0minirezo') || ($GLOBALS['auteur_session']['statut']=='1comite') || ($GLOBALS['auteur_session']['statut']=='6forum');
				break;
		}
	}
	// tentative pour prendre en compte les autres cas possibles d'exception
	$tr_acces |=
		isset($_GET['action']) || isset($_POST['action'])
	//	|| ($_POST['formulaire_action']=='login') // TODO : formulaire SPIP 2.0
		|| in_array($_GET['page'], array('login',
			'style_prive',       // filtrage de la feuille de style admin mise en squelette
			'style_prive_ie'))   // idem IE
		|| (strpos($_GET['page'],'.js') !== false) // filtrage de jquery.js par exemple qui sert pour la partie admin
		|| (strpos($_GET['page'],'.css') !== false); // on sait jamais...
}

// si aucune exception, on bloque le site pour travaux
if (!$tr_acces) {
	// $tr_message est defini dans config_outils.php par la variable 'message_travaux'
	@define('_en_travaux_MESSAGE', $tr_message);
	if($tr_prive) {
		// les actions ne fonctionnent pas ici
		action_cs_travaux(true);
		exit;
	}
	$_GET['action'] = "cs_travaux";
}

// nettoyage
unset($tr_acces, $tr_prive, $tr_message);

function action_cs_travaux($prive=false){
	include_spip('public/assembler');
//	echo recuperer_fond('fonds/en_travaux'.(defined('_SPIP19300')?'2':''), array(
	echo recuperer_fond('fonds/en_travaux', array(
		'titre'=>defined('_en_travaux_TITRE')?_T('info_travaux_titre'):$GLOBALS['meta']['nom_site'],
		// SPIP 2.0 : suppression pour l'instant de la possibilite de se logger directement pour un admin
		// car les redacteurs pourraient acceder qd meme au site (1 seule page, mais 1 page de trop)
		// 'login'=>defined('_en_travaux_ADMIN')?'oui':'',
		'form_login'=>defined('_SPIP19300')?'non':(defined('_en_travaux_ADMIN') || $prive?'oui':'non'),
		'prive'=>$prive?'oui':'non',
	));
	return true;
}

function en_travaux_affichage_final($flux){
	if(defined('_en_travaux_SANSMSG') || !$GLOBALS['html']) return $flux;
	include_spip('inc/minipres'); // pour http_img_pack
	$res = '<div id="en_travaux" style="padding:6px; position:absolute; left:12px; top:22px; border-color:#CECECE #CECECE #4A4A4A; background-color:#FFEEEE; opacity:0.8; font-size:12px; border-style:solid; border-width:3px; font-weight:bold;">'
	. http_img_pack('warning-24.gif', _T('info_travaux_titre'), 'align="absmiddle"')
	. ' &nbsp;'. _T('info_travaux_titre') . '</div>';
	if (!$pos = stripos($flux, '</body>')) $pos = strlen($flux);
	return substr_replace($flux, $res, $pos, 0);
}

?>