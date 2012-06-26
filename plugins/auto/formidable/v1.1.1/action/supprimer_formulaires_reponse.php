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
		// On récupère l'id_formulaire pour la redirection
		$id_formulaire = intval(sql_getfetsel(
			'id_formulaire',
			'spip_formulaires_reponses',
			'id_formulaires_reponse = '.$id_formulaires_reponse
		));
		
		// On supprime la réponse
		$ok = sql_delete(
			'spip_formulaires_reponses',
			'id_formulaires_reponse = '.$id_formulaires_reponse
		);
		
		// Si c'est bon, on supprime les champs des réponses
		if ($ok){
			$ok = sql_delete(
				'spip_formulaires_reponses_champs',
				'id_formulaires_reponse = '.$id_formulaires_reponse
			);
		}
	}
	
	if ($ok){
		if (!$redirect = _request('redirect'))
			$redirect = parametre_url(generer_url_ecrire('formulaires_reponses'), 'id_formulaire', $id_formulaire);
		
		include_spip('inc/headers');
		redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
	}
}

?>
