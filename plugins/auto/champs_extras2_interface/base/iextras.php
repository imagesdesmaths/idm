<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

function iextras_declarer_champs_extras($champs=array()) {
	include_spip('inc/iextras');
	
	// lors du renouvellement de l'alea, au demarrage de SPIP
	// les chemins de plugins ne sont pas encore connus.
	// il faut se mefier et charger tout de meme la fonction, sinon page blanche.
	if (!function_exists('iextras_get_extras')) {
		include_once(dirname(__file__).'/../inc/iextras.php');
	}
	
	// recuperer le tableau de champ et les ajouter.
	$extras = iextras_get_extras();
	$champs = array_merge($champs, $extras);
	return $champs;
}
?>
