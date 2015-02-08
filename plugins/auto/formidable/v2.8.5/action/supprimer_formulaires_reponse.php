<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Action de suppression d'une réponse
 * @param int $arg
 * @return unknown_type
 */
function action_supprimer_formulaires_reponse_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}

	// si id_formulaires_reponse n'est pas un nombre, on ne fait rien
	if ($id_formulaires_reponse = intval($arg)) {

		include_spip("action/editer_objet");
		$set = array('statut'=>'refuse');
		objet_modifier('formulaires_reponse',$id_formulaires_reponse,$set);

	}
	
}

?>
