<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/editer');

// http://doc.spip.org/@inc_editer_article_dist
function formulaires_editer_depot_charger_dist($id_depot, $redirect){
	$valeurs = formulaires_editer_objet_charger('depot', $id_depot, 0, 0, $redirect, 'depots_edit_config');
	return $valeurs;
}

function formulaires_editer_depot_verifier_dist($id_depot, $redirect){
	$erreurs = formulaires_editer_objet_verifier('depot', $id_depot, array('titre'));
	return $erreurs;
}

// http://doc.spip.org/@inc_editer_article_dist
function formulaires_editer_depot_traiter_dist($id_depot, $redirect){
	return formulaires_editer_objet_traiter('depot', $id_depot, 0, 0, $redirect);
}

function depots_edit_config($row)
{
	global $spip_ecran, $spip_lang;

	$config = $GLOBALS['meta'];
	$config['lignes'] = ($spip_ecran == "large") ? 8 : 5;
	$config['langue'] = $spip_lang;
	return $config;
}

?>