<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

function iextras_declarer_champs_extras($saisies_tables=array()) {
	include_spip('inc/iextras');
	
	// lors du renouvellement de l'alea, au demarrage de SPIP
	// les chemins de plugins ne sont pas encore connus.
	// il faut se mefier et charger tout de meme la fonction, sinon page blanche.
	if (!function_exists('iextras_champs_extras_definis')) {
		spip_log("ERREUR : inclusion inc/iextras non executee", 'iextras');
		include_once(dirname(__file__).'/../inc/iextras.php');
	}
	
	// recuperer le tableau de champ et les ajouter.
	$extras = iextras_champs_extras_definis();
	$saisies_tables = array_merge_recursive($saisies_tables, $extras);
	return $saisies_tables;
}