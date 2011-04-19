<?php
/**
 * 
 * Autorisations spécifiques à Fulltext
 * 
 */

 
/**
 * Fonction pour le pipeline, n'a rien a effectuer
 *
 * @return
 */
function fulltext_autoriser(){}

function autoriser_fulltext_fulltext_bouton_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('configurer');
}
?>
