<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Construitre l'email personalise de notification d'un forum
 *
 * @param array $t
 * @param string $email
 * @return string
 */
function inc_email_notification_forum_dist ($t, $email) {
	static $contexte = array();

	if(!isset($contexte[$t['id_forum']])){
		$url = '';
		$id_forum = $t['id_forum'];

		if ($t['statut'] == 'prive') # forum prive
		{
			if ($t['id_objet'])
				$url = generer_url_entite($t['id_objet'], $t['objet'], '', '#id'.$id_forum, false);
		}
		else if ($t['statut'] == 'privrac') # forum general
		{
			$url = generer_url_ecrire('forum').'#id'.$id_forum;
		}
		else if ($t['statut'] == 'privadm') # forum des admins
		{
			$url = generer_url_ecrire('forum_admin').'#id'.$id_forum;
		}
		else if ($t['statut'] == 'publie') # forum publie
		{
			$url = generer_url_entite($id_forum, 'forum');
		}
		else #  forum modere, spam, poubelle direct ....
		{
			$url = generer_url_ecrire('controler_forum', "debut_id_forum=".$id_forum);
		}

		if (!$url) {
			spip_log("forum $id_forum sans referent",'notifications');
			$url = './';
		}
		if ($t['id_objet']) {
			include_spip('inc/filtres');
			$t['titre_source'] = generer_info_entite($t['id_objet'], $t['objet'], 'titre');
		}

		$t['url'] = $url;

		// detecter les url des liens du forum
		// pour la moderation (permet de reperer les SPAMS avec des liens caches)
		$links = array();
		foreach ($t as $champ)
			$links = $links + extraire_balises($champ,'a');
		$links = extraire_attribut($links,'href');
		$links = implode("\n",$links);
		$t['liens'] = $links;

		$contexte[$t['id_forum']] = $t;
	}

	$t = $contexte[$t['id_forum']];
		// Rechercher eventuellement la langue du destinataire
	if (NULL !== ($l = sql_getfetsel('lang', 'spip_auteurs', "email=" . sql_quote($email))))
		$l = lang_select($l);

	$parauteur = (strlen($t['auteur']) <= 2) ? '' :
		(" " ._T('forum_par_auteur', array(
			'auteur' => $t['auteur'])
		) .
		 ($t['email_auteur'] ? ' <' . $t['email_auteur'] . '>' : ''));

	$titre = textebrut(typo($t['titre_source']));
	$forum_poste_par = ($t['id_article']
		? _T('forum:forum_poste_par', array(
			'parauteur' => $parauteur, 'titre' => $titre))
		: $parauteur . ' (' . $titre . ')');

	$t['par_auteur'] = $forum_poste_par;

	$envoyer_mail = charger_fonction('envoyer_mail','inc'); // pour nettoyer_titre_email
	$corps = recuperer_fond("notifications/forum_poste",$t);

	if ($l)
		lang_select();

	return $corps;
}
