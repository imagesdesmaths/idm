<?php

#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2008               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if (!defined("_ECRIRE_INC_VERSION")) return; // securiser

function redirige_vers_exec($params=array()) {
	$url = urldecode(_request('redirect'));
	foreach($params as $p=>$v) $url = parametre_url($url, $p, $v, '&');
	redirige_par_entete($url);
}

function action_action_rapide_dist() {
	$arg = _request('arg');
cs_log("INIT : action_action_rapide_dist() - Une action rapide '$arg' a ete demandee !");
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();
	$redirect = _request('redirect');
	if(!defined('_SPIP19300')) $redirect = urldecode($redirect);
	$outil = (
		preg_match(',&arg=([\w_]+)\|[\w_]+,', $redirect, $regs)
		|| preg_match(',&outil=([\w_]+),', $redirect, $regs)
		|| preg_match(',&cmd=([\w_]+),', $redirect, $regs)
	)?$regs[1]:false;

	// au cas ou, pour redirige_par_entete()
	include_spip('inc/headers');
	spip_log("action 'action_rapide' du Couteau suisse : $outil|$arg");
//cs_log($_POST, 'action POST='); cs_log($_GET, 'action GET=');

	switch($arg) {

		case 'fichiers_distants':
			// mettre a jour les fichiers distants d'un outil...
			// rien a faire :-)
			break;

		default: if($outil) {
			// fonction mon_outil_argument_action() suite a l'appel de ?action=action_rapide&arg=mon_outil|argument
			$fct = $outil.'_'.$arg.'_action';
cs_log("FIN : action_action_rapide_dist() - Appel de $fct()");
			include_spip('outils/'.$outil.'_action_rapide');
			if(function_exists($fct)) $fct();
				else cs_log(" -- Erreur : fonction $fct() introuvable !");
		} else	cs_log(" -- Erreur : outil non renseigne !");
		break;
	}

}

?>