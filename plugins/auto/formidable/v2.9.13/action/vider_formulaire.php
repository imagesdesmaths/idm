<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/*
 * Action de suppression des réponses à un formulaire
 * @param int $arg
 * @return unknown_type
 */
function action_vider_formulaire_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}



	include_spip('inc/autoriser');
	// si id_formulaires_reponse n'est pas un nombre, on ne fait rien
	if ($id_formulaire = intval($arg)
	  AND autoriser('instituer','formulairesreponse',$id_formulaire)) {

		// On supprime les réponse (statut => refuse)
		$ok = sql_updateq('spip_formulaires_reponses', array('statut' => 'refuse'),
			'id_formulaire=' . intval($id_formulaire));

		if ($ok) {
			/* on n'a plus de réponses à montrer, retour vers la page du formulaire */
			if (!$redirect = _request('redirect')) {
				$GLOBALS['redirect'] = parametre_url(generer_url_ecrire('formulaire'), 'id_formulaire', $id_formulaire);
			}
		}
	}
}

?>
