<?php
/*
 * Plugin Notifications
 * (c) 2009 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

// 20 minutes de repit avant notification (+0 a 10 minutes de cron)
define('_DELAI_NOTIFICATION_MESSAGERIE', 60 * 20);

// Les notifications de la messagerie privee et de son forum se font par cron
// base sur le champ 'vu' de spip_auteurs_messages
// L'idee est
// 1) de ne pas spammer les gens qui sont en ligne
// 2) de ne pas notifier un auteur qu'on vient d'ajouter a une discussion,
//    alors qu'on va peut-etre le supprimer (erreur de choix de destinataire)
function genie_notifications_dist($time) {
	if (!is_array($GLOBALS['notifications'] = @unserialize($GLOBALS['meta']['notifications'])))
		$GLOBALS['notifications'] = array();

	if (!$GLOBALS['notifications']['messagerie'])
		return;
	include_spip('base/abstract_sql');
	$envoyer_mail = charger_fonction('envoyer_mail','inc');

	$s = sql_select("lien.id_auteur,lien.id_message, message.titre, message.texte, message.date_heure as date, auteur.nom, auteur.email, auteur.en_ligne","spip_auteurs_messages AS lien, spip_messages AS message, spip_auteurs AS auteur","lien.id_message = message.id_message AND lien.id_auteur = auteur.id_auteur AND lien.`vu`='non'");
	while ($t = sql_fetch($s)) {
		// si le message est tout nouveau (ou n'a pas de date), on l'ignore
		if (!$d = strtotime($t['date'])
		OR $d > time() - _DELAI_NOTIFICATION_MESSAGERIE)
			continue;

		// Si l'auteur est en ligne (ou ne l'a jamais ete), on l'ignore aussi
		if (!$d = strtotime($t['en_ligne'])
		OR $d > time() - _DELAI_NOTIFICATION_MESSAGERIE)
			continue;

		// Si l'auteur n'a pas de mail ou est a la poubelle, on l'ignore
		if (!$t['email'] OR $t['statut'] == '5poubelle')
			continue;

		// OK on peut lui envoyer le mail
		include_spip('inc/notifications');
		include_spip('inc/texte');

		// Chercher les forums les plus recents de ce message, pour afficher
		// des extraits
		$body =  _T('form_forum_message_auto')."\n\n";
		$body .= "* " . textebrut(propre(couper(
				$t['titre']."<p>".$t['texte'], 700)))."\n\n";

		$f = sql_select("titre,texte","spip_forum","id_message = " .intval($t['id_message'])
			." AND UNIX_TIMESTAMP(date_heure) > "._q($time));
		while ($ff = sql_fetch($f)) {
			$body .= "----\n"
				.textebrut(propre(couper(
					"** ".$ff['titre']."<p>".$ff['texte'], 700)))."\n\n";
		}

		$u = generer_url_ecrire('message', 'id_message='.$t['id_message'],'&');
		$body .= "$u\n";

		$subject = "[" .
	  entites_html(textebrut(typo($GLOBALS['meta']["nom_site"]))) .
	  "] ["._T('onglet_messagerie')."] ".typo($t['titre']);

		// Ne pas recommencer la prochaine, meme en cas de plantage du mail :)
		sql_updateq("spip_auteurs_messages",array('vu'=>'oui'),"id_auteur=".intval($t['id_auteur'])." AND id_message=".intval($t['id_message']));
		$envoyer_mail($t['email'], $subject, $body);
	}

	if ($t)
		return 1;
}

?>