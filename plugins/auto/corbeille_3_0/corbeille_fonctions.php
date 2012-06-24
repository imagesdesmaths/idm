<?php
/**
 * Plugin Corbeille 3.0
 * La corbeille pour Spip 3.0
 * Collectif
 * Licence GPL
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

 
/**
 * Corbeille_icone_poubelle() affiche l'icone poubelle (vide ou pleine)
 * @param $total_table nb d'elments supprimable pour un objet donn
 */
function corbeille_icone_poubelle($total_table) {
	if (empty($total_table)) {
		return "<img src='".chemin_image('trash-empty-32.png')."' alt='trash empty'/>";
	} else {
		return "<img src='".chemin_image('trash-full-32.png')."'  alt='trash full'/>";
	}
}


?>
