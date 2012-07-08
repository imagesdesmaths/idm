<?php
/*
 * Plugin Notifications
 * (c) 2009 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

// Fonction appelee par divers pipelines
// http://doc.spip.org/@notifications_instituerbreve_dist
function notifications_instituerbreve_dist($quoi, $id_breve, $options) {

	// ne devrait jamais se produire
	if ($options['statut'] == $options['statut_ancien']) {
		spip_log("statut inchange",'notifications');
		return;
	}

	include_spip('inc/texte');

	$modele = "";
	if ($options['statut'] == 'publie') {
		$modele = "notifications/breve_publie";
	}

	if ($options['statut'] == 'prop' AND $options['statut_ancien'] != 'publie')
		$modele = "notifications/breve_propose";

	if ($modele){
		$destinataires = array();
		if ($GLOBALS['meta']["suivi_edito"] == "oui")
			$destinataires = explode(',',$GLOBALS['meta']["adresse_suivi"]);


		$destinataires = pipeline('notifications_destinataires',
			array(
				'args'=>array('quoi'=>$quoi,'id'=>$id_breve,'options'=>$options)
			,
				'data'=>$destinataires)
		);

		$texte = email_notification_objet($id_breve, "breve", $modele);
		notifications_envoyer_mails($destinataires, $texte);
	}
}

?>