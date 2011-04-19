<?php
/**
 * Plugin Corbeille 2.0
 * La corbeille pour Spip 2.0
 * Collectif
 * Licence GPL
 */

/**
 * Pas d'optimisation auto avec le plugin corbeille !
 *
 * @param unknown_type $t
 * @return unknown
 */
function genie_optimiser($t){
	include_spip('optimiser','genie');

	optimiser_base_une_table();

	// la date souhaitee pour le tour suivant = apres-demain a 4h du mat ;
	// sachant qu'on a un delai de 48h, on renvoie aujourd'hui a 4h du mat
	// avec une periode de flou entre 2h et 6h pour ne pas saturer un hebergeur
	// qui aurait beaucoup de sites SPIP
	return -(mktime(2,0,0) + rand(0, 3600*4));
}

// Déclaration du pipeline pour ajouter de nouveaux objets
$GLOBALS['spip_pipeline']['corbeille_table_infos'] = '';

?>
