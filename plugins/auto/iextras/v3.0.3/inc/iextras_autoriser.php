<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

// fonction pour le pipeline, n'a rien a effectuer
function iextras_autoriser(){}

// declarations d'autorisations
function autoriser_iextras_onglet_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('configurer', 'iextras', $id, $qui, $opt);
}

function autoriser_iextras_configurer_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('webmestre', $type, $id, $qui, $opt);
}
?>
