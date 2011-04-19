<?php
/**
 * Plugin Corbeille 2.0
 * La corbeille pour Spip 2.0
 * Collectif
 * Licence GPL
 */
/* public static */

 
/**
 *Corbeille_icone_poubelle() affiche l'icone poubelle (vide ou pleine)
 * @param $total_table nb d'elments supprimable pour un objet donn
 */
function corbeille_icone_poubelle($total_table) {
	if (empty($total_table)) {
		return "<img src='"._DIR_PLUGIN_CORBEILLE."/img_pack/trash-empty-24.png' alt='trash empty'/>";
	} else {
		return "<img src='"._DIR_PLUGIN_CORBEILLE."/img_pack/trash-full-24.png'  alt='trash full'/>";
	}
}

/**
 * Afficher un message "une truc"/"N trucs"
 *
 * @param int $nb
 * @return string
 */
function corbeille_affiche_un_ou_plusieurs($nb,$chaine_un,$chaine_plusieurs,$var='nb'){
	if (!$nb=intval($nb)) return "";
	if ($nb>1) return _T($chaine_plusieurs, array($var => $nb));
	else return _T($chaine_un);
}

?>
