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
		// On supprime le formulaire lui-même
		$ok = sql_delete(
			'spip_formulaires',
			'id_formulaire = '.$id_formulaire
		);
		
		if ($ok){
			// Si c'est bon, on récupère les réponses pour les supprimer
			$reponses = sql_allfetsel(
				'id_formulaires_reponse',
				'spip_formulaires_reponses',
				'id_formulaire = '.$id_formulaire
			);
			$reponses = $reponses ? array_map('reset', $reponses) : false;
		
			// On supprime les réponses s'il y en a
			if ($reponses){
				$ok = sql_delete(
					'spip_formulaires_reponses',
					sql_in('id_formulaires_reponse', $reponses)
				);
			
				// Si c'est bon, on supprime les champs des réponses
				if ($ok){
					$ok = sql_delete(
						'spip_formulaires_reponses_champs',
						sql_in('id_formulaires_reponse', $reponses)
					);
				}
			}
		}
	}
	
	if ($ok){
		if (!$redirect = _request('redirect'))
			$redirect = generer_url_ecrire('formulaires');
		
		include_spip('inc/headers');
		redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
	}
}

?>
