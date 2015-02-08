<?php
/*
 * Plugin Notifications
 * (c) 2009-2012 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * cette notification s'execute quand un message est poste,
 *
 * @param string $quoi
 * @param int $id_forum
 */
function notifications_forumposte_dist($quoi, $id_forum, $options) {
	$t = sql_fetsel("*", "spip_forum", "id_forum=".intval($id_forum));
	if (!$t)
		return;

	// plugin notification si present
	$prevenir_auteurs = isset($GLOBALS['notifications']['prevenir_auteurs']) AND $GLOBALS['notifications']['prevenir_auteurs'];
	// sinon voie normale
	if ($t['objet']=='article' AND $t['id_objet'] AND !$prevenir_auteurs){
		$s = sql_getfetsel('accepter_forum','spip_articles',"id_article=" . $t['id_objet']);
		if (!$s)  $s = substr($GLOBALS['meta']["forums_publics"],0,3);

		$prevenir_auteurs = (strpos(@$GLOBALS['meta']['prevenir_auteurs'],",$s,")!==false
			OR @$GLOBALS['meta']['prevenir_auteurs'] === 'oui'); // compat
	}

	include_spip('inc/texte');
	include_spip('inc/filtres');
	include_spip('inc/autoriser');

	// Qui va-t-on prevenir ?
	$tous = array();

	// 1. Les auteurs de l'objet lie au forum
	// seulement s'ils ont le droit de le moderer (les autres seront
	// avertis par la notifications_forumvalide).
	if ($prevenir_auteurs) {
		$result = sql_select("auteurs.*","spip_auteurs AS auteurs JOIN spip_auteurs_liens AS lien","lien.objet=".sql_quote($t['objet'])." AND lien.id_objet=".intval($t['id_objet'])." AND auteurs.id_auteur=lien.id_auteur");

		while ($qui = sql_fetch($result)) {
			if ($qui['email'] AND autoriser('modererforum', $t['objet'], $t['id_objet'], $qui['id_auteur']))
				$tous[] = $qui['email'];
		}
	}

	$options['forum'] = $t;
	$destinataires = pipeline('notifications_destinataires',
		array(
			'args'=>array('quoi'=>$quoi,'id'=>$id_forum,'options'=>$options)
		,
			'data'=>$tous)
	);

	// Nettoyer le tableau
	// Ne pas ecrire au posteur du message !
	notifications_nettoyer_emails($destinataires,array($t['email_auteur']));

	//
	// Envoyer les emails
	//

	// preparer le calcul des liens de moderation
	$moderations = array();
	foreach(array('publie','spam','off') as $statut){
		if ($statut!==$t['statut']){
			$moderations["url_moderer_$statut"] = "$id_forum-$statut-".$t['statut'];
		}
	}
	include_spip("inc/securiser_action");
	$action = 'instituer_forum_paremail';
	$pass = secret_du_site();


	$email_notification_forum = charger_fonction('email_notification_forum','inc');
	foreach ($destinataires as $email) {
		// ajouter les liens de moderation par statut
		$contexte = array('notification_email'=>$email);
		foreach($moderations as $k=>$arg){
			$arg = "$arg-$email";
			$hash = _action_auteur("$action-$arg", '', $pass, 'alea_ephemere');
			$contexte[$k] = generer_url_action($action, "arg=$arg&hash=$hash", true, true);
		}

		$texte = $email_notification_forum($t, $email, $contexte);
		notifications_envoyer_mails_texte_ou_html($email, $texte);
	}

	// Notifier les autres si le forum est valide
	// est-ce que cet appel devrait bien etre la ?
	if ($t['statut'] == 'publie') {
		$notifications = charger_fonction('notifications', 'inc');
		$notifications('forumvalide', $id_forum);
	}
}
?>