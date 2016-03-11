<?php

/**
 * Gestion de l'action déplacer saisie.
 *
 * @package SPIP\Saisies\Action
 */
 
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Action de déplacement de saisies dans le constructeur de formulaires
 *
 * @return void
**/
function action_deplacer_saisie_dist() {
	include_spip('inc/session');

	$session 	 = _request('session');
	$identifiant = _request('saisie');
	$ou          = _request('ou');

	// On récupère le formulaire à son état actuel
	$formulaire_actuel = session_get($session);

	if (!$formulaire_actuel) {
		return "";
	}

	include_spip('inc/saisies');
	
	$saisies_actuelles = saisies_lister_par_identifiant($formulaire_actuel);
	if (!isset($saisies_actuelles[$identifiant])) {
		return "";
	}

	// tester @id et [@id] (fieldset)
	if ($ou and !isset($saisies_actuelles[$ou]) and !isset($saisies_actuelles[ substr($ou,1,-1) ])) {
		return "";
	}

	// on deplace ou c'est demande...
	$formulaire_actuel = saisies_deplacer($formulaire_actuel, $identifiant, $ou);

	// On sauve tout ca
	$formulaire_actuel = session_set($session, $formulaire_actuel);
}

