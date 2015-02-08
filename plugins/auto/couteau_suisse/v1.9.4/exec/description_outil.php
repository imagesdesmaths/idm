<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if (!defined("_ECRIRE_INC_VERSION")) return;

function exec_description_outil_dist() {
cs_log("INIT : exec_description_outil_dist() - Preparation du retour par Ajax (donnees transmises par GET)");
	$script = _request('script');
	$outil = _request('outil');
cs_log(" -- outil = $outil - script = $script");
	cs_minipres(!preg_match('/^\w+$/', $script));
	// ici on commence l'initialisation de tous les outils
	global $outils, $metas_vars, $metas_outils;
	include_spip('cout_utils');
	// remplir $outils (et aussi $cs_variables qu'on n'utilise pas ici);
	include_spip('config_outils');
cs_log(" -- exec_description_outil_dist() - Appel de config_outils.php : nb_outils = ".count($outils));
	// installer les outils
	cs_installe_outils();

cs_log(" -- appel de charger_fonction('description_outil', 'inc') et de description_outil($outil, $script) :");
	include_spip('inc/cs_outils');
	$description_outil = charger_fonction('description_outil', 'inc');
	$descrip = cs_initialisation_d_un_outil($outil, $description_outil, true);
	cs_init_plugins();

cs_log(" FIN : exec_description_outil_dist() - Appel maintenant de ajax_retour() pour afficher la ligne de configuration de l'outil");	
	include_spip('inc/texte');
	include_spip('couteau_suisse_fonctions'); // fonctions pour les pipelines
	ajax_retour(propre($descrip));
}
?>