<?php
/*
 * Plugin Notifications
 * (c) 2009-2012 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * cette notification s'execute quand on valide un message 'prop'ose,
 * dans ecrire/inc/forum_insert.php ; ici on va notifier ceux qui ne l'ont
 * pas ete a la notification forumposte (sachant que les deux peuvent se
 * suivre si le forum est valide directement ('pos' ou 'abo')
 * http://doc.spip.org/@notifications_forumvalide_dist
 *
 * @param string $quoi
 * @param int $id_forum
 */
function notifications_forumvalide_dist($quoi, $id_forum, $options) {

	$t = sql_fetsel("*", "spip_forum", "id_forum=".intval($id_forum));
	if (!$t
		// forum sur un message prive : pas de notification ici (cron)
		OR @$t['statut'] == 'perso')
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
	// Ne pas ecrire au posteur du message, ni au moderateur qui valide le forum,
	$pasmoi = array($t['email_auteur'],$GLOBALS['visiteur_session']['email']);

	// 1. Les auteurs de l'objet lie au forum
	// seulement ceux qui n'ont
	// pas le droit de le moderer (les autres l'ont recu plus tot)
	if ($prevenir_auteurs) {
		$result = sql_select("auteurs.*","spip_auteurs AS auteurs, spip_auteurs_liens AS lien","lien.objet=".sql_quote($t['objet'])." AND lien.id_objet=".intval($t['id_objet'])." AND auteurs.id_auteur=lien.id_auteur");

		while ($qui = sql_fetch($result)) {
			if ($qui['email']) {
				if (!autoriser('modererforum', $t['objet'], $t['id_objet'], $qui['id_auteur']))
					$tous[] = $qui['email'];
				else
					// Ne pas ecrire aux auteurs deja notifies precedemment
					$pasmoi[] = $qui['email'];
			}
		}
	}


// Prevenir les admins restreints de la rubrique et des parentes  lors de messages de forum d'article ou de rubrique
// c'est ici because dans notifications_pipelines la fonction de dédoublonnage le fait sauter (?)

if ($GLOBALS['notifications']['forums_admins_restreints']) {
         if ($t['objet']=='rubrique'){
         $id_rubrique = $t['id_objet'];
         }
         if ($t['objet']=='article'){
         include_spip('base/abstract_sql');
         $t = sql_fetsel("id_rubrique", "spip_articles", "id_article=" . intval($t['id_objet']));
         $id_rubrique = $t['id_rubrique'];
         }
         if ($GLOBALS['notifications']['forums_limiter_rubriques']){
             $limites = $GLOBALS['notifications']['forums_limiter_rubriques'];
             $forums_limiter_rubriques = explode(",",$limites);
     } else {
             $forums_limiter_rubriques = array($id_rubrique);
         }
         if (in_array($id_rubrique,$forums_limiter_rubriques)){
             while ($id_rubrique){
                 $hierarchie[] = $id_rubrique;
                 $res = sql_fetsel("id_parent", "spip_rubriques", "id_rubrique=" . intval($id_rubrique));
                 if (!$res){ // rubrique inexistante
                     $id_rubrique = 0;
                     break;
                 }
                 $id_parent = $res['id_parent'];
                 $id_rubrique = $id_parent;
             }
             //les admins de la rub et de ses parents
             $result = sql_select(
                 "auteurs.email,auteurs.id_auteur,lien.id_objet as id_rubrique",
                 "spip_auteurs AS auteurs JOIN spip_auteurs_liens AS lien ON auteurs.id_auteur=lien.id_auteur ",
                 "lien.objet='rubrique' AND ".sql_in('lien.id_objet',sql_quote($hierarchie))." AND auteurs.statut='0minirezo'");
         while ($qui = sql_fetch($result)) {
                     $tous[] = $qui['email'];
             }
         }
     }
/////////////////////////////

	$options['forum'] = $t;
	$destinataires = pipeline('notifications_destinataires',
		array(
			'args'=>array('quoi'=>$quoi,'id'=>$id_forum,'options'=>$options)
		,
			'data'=>$tous)
	);

	// Nettoyer le tableau
	// en enlevant les exclus
	notifications_nettoyer_emails($destinataires,$pasmoi);

	//
	// Envoyer les emails
	//
	$email_notification_forum = charger_fonction('email_notification_forum','inc');
	foreach ($destinataires as $email) {
		$contexte = array('notification_email'=>$email,'indiquer_email_auteur'=>'non');
		$texte = $email_notification_forum($t, $email, $contexte);
		notifications_envoyer_mails_texte_ou_html($email, $texte);
	}

// une liste d'adresses renseignées dans config possiblement liste de diffusion
	if ($GLOBALS['notifications']['forums_liste']){

	//construction du mail  pour envoyer_mail
	$titre="$t[titre]";
	$sujet=""._T('forum:info_1_message_forum')." '$titre'";
	$charset = lire_meta('charset');

	if ($GLOBALS['meta']['facteur_adresse_envoi'] == 'oui' AND $GLOBALS['meta']['facteur_adresse_envoi_email'])
			$from_email = $GLOBALS['meta']['facteur_adresse_envoi_email'];
		else
			$from_email = $email_webmaster;
		// nom denvoi depuis config facteur
		if ($GLOBALS['meta']['facteur_adresse_envoi'] == 'oui' AND $GLOBALS['meta']['facteur_adresse_envoi_nom'])
		$from_nom = $GLOBALS['meta']['facteur_adresse_envoi_nom'];

	foreach (explode(',', $GLOBALS['notifications']['forums_liste']) as $to_email) {
		$email_notification_forum = charger_fonction('email_notification_forum','inc');
		$body = $email_notification_forum($t, $to_email);
		include_spip('classes/facteur');
		$body = Facteur::html2text($body);
		$envoyer_mail = charger_fonction('envoyer_mail','inc/');
		$envoyer_mail($to_email, $sujet, $body, $from_email, $headers);
		}
	} 
///////////////////////////


}

?>
