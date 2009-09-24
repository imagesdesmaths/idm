<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

function cextras_declarer_tables_principales($tables_principales){
	// pouvoir utiliser la class ChampExtra
	include_spip('inc/cextras');
	
	// lors du renouvellement de l'alea, au demarrage de SPIP
	// les chemins de plugins ne sont pas encore connus.
	// il faut se mefier et charger tout de meme la fonction, sinon page blanche.
	if (!function_exists('declarer_champs_extras')) {
		include_once(dirname(__file__).'/../inc/cextras.php');
	}
	
	// recuperer les champs crees par les plugins
	$champs = pipeline('declarer_champs_extras', array());
	// ajouter les champs au tableau spip
	return declarer_champs_extras($champs, $tables_principales);
}
?>
