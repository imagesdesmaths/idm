<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Action de suppression d'un formulaire
 * @param int $arg
 * @return unknown_type
 */
function action_supprimer_formulaire_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}

	// si id_formulaire n'est pas un nombre, on ne fait rien
	if ($id_formulaire = intval($arg)) {

		$set = array('statut'=>'poubelle');
		include_spip("action/editer_formulaire");
		formulaire_modifier($id_formulaire,$set);

	}

}

?>
