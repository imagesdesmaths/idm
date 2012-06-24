<?php
/*
 * Plugin Notifications
 * (c) 2009 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Supprimer une signature
 */
function action_supprimer_signature_dist(){

	$securiser_action = charger_fonction('securiser_action','inc');
	$id_signature = $securiser_action();

	if ($id_signature=intval($id_signature)
		AND autoriser('supprimer','signature',$id_signature)){
		sql_updateq("spip_signatures", array("statut" => 'poubelle'), "id_signature=".intval($id_signature));
	}

}

?>