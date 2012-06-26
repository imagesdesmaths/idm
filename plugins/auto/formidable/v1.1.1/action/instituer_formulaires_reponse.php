<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Action de création / Modification d'un truc
 * @param unknown_type $arg
 * @return unknown_type
 */
function action_instituer_formulaires_reponse_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}

	list($id_formulaires_reponse, $statut) = preg_split('/\W/', $arg);
	if (!$statut) return; // impossible mais sait-on jamais
	
	$id_formulaires_reponse = intval($id_formulaires_reponse);
	
	$ok = sql_updateq(
		'spip_formulaires_reponses',
		array(
			'statut' => $statut
		),
		'id_formulaires_reponse = '.$id_formulaires_reponse
	);
	if (!$ok) $err = 'erreur';
	
	return array($id_formulaires_reponse, $err);
}

?>
