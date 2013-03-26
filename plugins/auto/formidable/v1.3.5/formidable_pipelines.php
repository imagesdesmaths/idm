<?php

/**
 * Utilisation de pipelines
 * 
 * @package SPIP\Formidable\Pipelines
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * Optimiser la base de donnée en enlevant les liens de formulaires supprimés
 * 
 * @pipeline optimiser_base_disparus
 * @param array $flux
 *     Données du pipeline
 * @return array
 *     Données du pipeline
 */
function formidable_optimiser_base_disparus($flux){
	// Les réponses qui sont à la poubelle
	$res = sql_select(
		'id_formulaires_reponse AS id',
		'spip_formulaires_reponses',
		'statut = '.sql_quote('poubelle')
	);
	
	// On génère la suppression
	$flux['data'] += optimiser_sansref('spip_formulaires_reponses', 'id_formulaires_reponse', $res);
	return $flux;
}

?>
