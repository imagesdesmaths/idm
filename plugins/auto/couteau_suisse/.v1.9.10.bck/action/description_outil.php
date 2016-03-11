<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/filtres');

function action_description_outil_dist() {
cs_log("INIT : action_description_outil_dist() - Une modification de variable(s) a ete demandee !");
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();
	spip_log("action_description_outil du Couteau suisse : $arg / "._request('submit'));
//	spip_log($_POST);

//cs_log(" -- arg = $arg (index de l'outil appelant)");
	if (preg_match(",^\W*(\d+)$,", $arg, $r))
		action_description_outil_post($r[1]);
	else spip_log("action_description_outil_dist $arg pas compris");
cs_log(" FIN : action_description_outil_dist($arg)");
}

function action_description_outil_post($index) {
	global $metas_vars;
	if(defined('_SPIP19300')) $connect_id_auteur = $GLOBALS['auteur_session']['id_auteur'];
		else global $connect_id_auteur;
cs_log("Debut : action_description_outil_post($index) - On modifie la(les) variable(s) dans la base");

	// on recupere dans le POST le nom des variables a modifier et le nom de l'outil correspondant
	$variables = unserialize(urldecode(corriger_caracteres(_request('variables'))));
	$outil = corriger_caracteres(_request('outil'));
//cs_log($variables, '$variables = ');
cs_log($metas_vars, 'metas_vars :');
	// besoin des outils pour l'autorisation de modifier les variables
	include_spip('cout_utils');
	include_spip('config_outils');
	global $outils, $cs_variables;
	// on traite chaque variable
	foreach($variables as $var) if(autoriser('configurer', 'variable', 0, NULL, array('nom'=>$var, 'outil'=>$outils[$outil]))) {
		// on recupere dans le POST la nouvelle valeur de la variable
		$final = corriger_caracteres(_request($var));
		if (in_array($var, $metas_vars['_nombres'])) $final = intval($final);
		spip_log("Outil du Couteau Suisse ($outil). Demande de modification sur une variable par l'auteur id=$connect_id_auteur : %$var% = $final");
		// pas de modification de variable si l'outil utilise une variable externe
		$ok_modif = !isset($cs_variables[$var]['externe']);
		// action eventuelle apres validation
		if(isset($cs_variables[$var]['action'])) {
			$action = '$_CS_DATA = '.var_export($final, 1)."; ";
			$action = ($ok_modif?$action:"/* Variable non modifiable : $action */ ")
				. str_replace('%s', '$_CS_DATA', $cs_variables[$var]['action']);
			spip_log("Outil du Couteau Suisse ($outil). Demande d'action sur cette variable : ".$action);
			eval($action);
			$final = $_CS_DATA;
		}
		// et on modifie les metas !
		if($ok_modif) $metas_vars[$var] = $final;
			
	} else 
		spip_log("Outil du Couteau Suisse #$index. Modification interdite de la variable %$var% par l'auteur id=$connect_id_auteur !!");
//cs_log($metas_vars, " -- metas_vars = ");
	ecrire_meta('tweaks_variables', serialize($metas_vars));
	ecrire_metas();

cs_log(" -- donc, reinitialisation forcee !");
	// on reinitialise tout, au cas ou ...
	include_spip('inc/invalideur');
	suivre_invalideur("1"); # tout effacer
	purger_repertoire(_DIR_SKELS);
	purger_repertoire(_DIR_CACHE);
	include_spip('cout_utils');
	cs_initialisation(true);
cs_log(" FIN : action_description_outil_post(Array($index)) - Reinitialisation forcee terminee.");
}
?>