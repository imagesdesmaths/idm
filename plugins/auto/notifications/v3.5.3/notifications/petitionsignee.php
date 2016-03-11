<?php
/*
 * Plugin Notifications
 * (c) 2009-2012 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * insertion d'une nouvelle signature => mail aux moderateurs
 *
 * @param string $quoi
 * @param int $id_forum
 */
function notifications_petitionsignee_dist($quoi, $id_signature, $options) {
	if (!isset($GLOBALS['notifications']['moderateurs_signatures'])
	  OR !$GLOBALS['notifications']['moderateurs_signatures'])
		return;

	// creer la cle de suppression de la signature
	// old style ...
	// il faudrait passer par une action et une redirection
	// ce qui necessite de pouvoir generer une action pour un autre auteur que celui connecte
	// grml
	include_spip('inc/securiser_action');
	$cle = _action_auteur("supprimer signature $id_signature", '', '', 'alea_ephemere');

	$envoyer_mail = charger_fonction('envoyer_mail','inc'); // pour nettoyer_titre_email
	$texte = recuperer_fond("notifications/petition_signee",array('id_signature'=>$id_signature,'cle'=>$cle));
	
	notifications_envoyer_mails($GLOBALS['notifications']['moderateurs_signatures'],$texte);
}
?>