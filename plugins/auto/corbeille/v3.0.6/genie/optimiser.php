<?php
/**
 * Plugin Corbeille 3.0
 * La corbeille pour Spip 3.0
 * Collectif
 * Licence GPL
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

include_once _DIR_RESTREINT."genie/optimiser.php";

/**
 * Pas d'optimisation auto avec le plugin corbeille !
 *
 * @param unknown_type $t
 * @return unknown
 */
function genie_optimiser($t){

	optimiser_base_une_table();

	// la date souhaitee pour le tour suivant = apres-demain a 4h du mat ;
	// sachant qu'on a un delai de 48h, on renvoie aujourd'hui a 4h du mat
	// avec une periode de flou entre 2h et 6h pour ne pas saturer un hebergeur
	// qui aurait beaucoup de sites SPIP
	return -(mktime(2,0,0) + rand(0, 3600*4));
}


?>