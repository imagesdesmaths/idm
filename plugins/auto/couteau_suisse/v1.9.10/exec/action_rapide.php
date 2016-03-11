<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2008               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/actions');

// fonction generique appelee par ?exec=action_rapide&arg=mon_outil|argument (pipe obligatoire)
// la fonction mon_outil_argument_action_rapide() est apellee apres un include_spip('outils/mon_outil_action_rapide')
function exec_action_rapide_dist() {
	global $type_urls;
cs_log("INIT : exec_action_rapide_dist() - Preparation par Ajax (donnees transmises par GET)");
	// droits du Couteau Suisse
	cs_minipres();
	list($outil, $arg) = explode('|',_request('arg'),2);
	$script = _request('script');
cs_log(" -- script = $script - outil = $outil - arg = $arg");
	// verification du format de l'argument
	cs_minipres(!isset($arg));
	if(!strlen($arg)) $arg = 'retour_nul';
	cs_minipres(!preg_match('/^\w+$/', $script));

	switch ($arg) {
		// retour normal des actions rapides du couteau suisse : affichage du bloc au sein de la description d'un outil
		case 'description_outil':
cs_log(" -- Preparation de l'affichage de la description de l'outil");
			include_spip('inc/cs_outils');
			$res = cs_action_rapide($outil);
cs_log(" FIN : exec_action_rapide_dist() - Appel maintenant de ajax_retour() pour afficher le formulaire de '$outil'");	
			ajax_retour($res);
			break;

		// mettre a jour les fichiers distants d'un outil...
		case 'fichiers_distants':
			global $outils;
			include_spip('cout_utils');
			include_spip('config_outils');
			if(autoriser('configurer', 'outil', 0, NULL, $outil)) {
				include_spip('inc/cs_outils');
				cs_initialisation_d_un_outil($outil, charger_fonction('description_outil', 'inc'), false);
				// mise a jour forcee
				$res = cs_action_fichiers_distants($outils[$outil], true);
			}
cs_log(" FIN : exec_action_rapide_dist() - Appel maintenant de ajax_retour() pour afficher le formulaire de '$outil'");	
			ajax_retour($res);
			break;

		// pour le reste (ex : 'sauve_pack' en mode non ajax), rien a faire.
		case 'retour_nul':
cs_log("FIN : exec_action_rapide_dist() - Retour nul");
			break;

		default:
			// fonction mon_outil_argument_exec() suite a l'appel de ?exec=action_rapide&arg=mon_outil|argument
cs_log("FIN : exec_action_rapide_dist() - Appel de {$outil}_{$arg}_exec()");
			include_spip('outils/'.$outil.'_action_rapide');
			if(function_exists($fct = $outil.'_'.$arg.'_exec')) $fct();
			break;
	}
}

?>