<?php
/*
 * Plugin Notifications
 * (c) 2009-2012 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * inscription d'un nouvel auteur => mail aux admins
 *
 * @param string $quoi
 * @param int $id_auteur
 * @options array $options
 */
function notifications_inscription_dist($quoi, $id_auteur, $options) {
	if (!isset($GLOBALS['notifications']['inscription'])
	  OR !$GLOBALS['notifications']['inscription'])
		return;
	
	$modele = "notifications/inscription";

	$destinataires = array();
	
	$query = sql_select("email","spip_auteurs","statut = '0minirezo'");

	// notifier uniquement les webmestres ?
	if ($GLOBALS['notifications']['inscription'] == 'webmestres') {
		$query = sql_select("email","spip_auteurs","statut = '0minirezo' AND webmestre = 'oui'");
	}

	while ($row = sql_fetch($query)) {
		$destinataires[] = $row["email"];
	}

	$destinataires = pipeline('notifications_destinataires',
		array(
			'args'=>array('quoi'=>$quoi,'id'=>$id_auteur,'options'=>$options)
		,
			'data'=>$destinataires)
	);

	$envoyer_mail = charger_fonction('envoyer_mail','inc'); // pour nettoyer_titre_email
	$texte = recuperer_fond($modele,array('id_auteur'=>$id_auteur));
	
	notifications_envoyer_mails($destinataires, $texte);

}

?>