<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

// Mise a jour automatique des depots (CRON)
// - Flag de declenchement
if (!defined('_SVP_CRON_ACTUALISATION_DEPOTS')) {
	define('_SVP_CRON_ACTUALISATION_DEPOTS', true);
}

// - Periode d'actualisation en nombre d'heures (de 1 a 24)
if (!defined('_SVP_PERIODE_ACTUALISATION_DEPOTS')) {
	define('_SVP_PERIODE_ACTUALISATION_DEPOTS', 6);
}



function svp_taches_generales_cron($taches_generales) {

	// Ajout de la tache CRON de mise a jour reguliere de tous les depots de la base
	// Par defaut, toutes les 6h
	// Conditionnee a la variable de configuration
	if (_SVP_CRON_ACTUALISATION_DEPOTS)
		$taches_generales['svp_actualiser_depots'] = _SVP_PERIODE_ACTUALISATION_DEPOTS*3600;

	return $taches_generales;
}

?>
