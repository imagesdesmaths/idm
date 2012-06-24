<?php
/*
 * Plugin Notifications
 * (c) 2009 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * 
 * Declarer la tache cron de notification lente (messagerie de l'espace prive)
 * @param array $taches_generales
 * @return array 
 */
function notifications_taches_generales_cron($taches_generales){
	$taches_generales['notifications'] = 60 * 10; // toutes les 10 minutes
	return $taches_generales;
}

$GLOBALS['notifications_post_edition']['spip_signatures'] = "petitionsignee";

// Initialise les reglages sous forme de tableau
function notifications_go($x) {
	if (!is_array($GLOBALS['notifications']	= @unserialize($GLOBALS['meta']['notifications'])))
		$GLOBALS['notifications'] = array();
	return $x;
}


/**
 * Pipeline post-edition
 * pour permettre de se pluger sur une modification en base non notifiee par defaut
 *
 * @param array $x
 * @return array
 */
function notifications_post_edition($x) {
	#spip_log($x,'notifications');
	if (isset($x['args']['table'])
		AND $quoi=$GLOBALS['notifications_post_edition'][$x['args']['table']]) {
			// repasser par l'entree principale
			$notifications = charger_fonction('notifications','inc');
			$notifications($quoi,$x['args']['id_objet'],array());
	}

	return $x;
}

/**
 * Ajouter des destinataires dans une notification en lot
 *
 * @param array $flux
 * @return array
 */
function notifications_notifications_destinataires($flux) {
	static $sent = array();
	$quoi = $flux['args']['quoi'];
	$options = $flux['args']['options'];

	// proposition d'article prevenir les admins restreints
	if ($quoi=='instituerarticle' AND $GLOBALS['notifications']['prevenir_admins_restreints']
		AND $options['statut'] == 'prop' AND $options['statut_ancien'] != 'publie' // ligne a commenter si vous voulez prevenir de la publication
		){ 
	
		$id_article = $flux['args']['id']; 
		include_spip('base/abstract_sql'); 
		$t = sql_fetsel("id_rubrique", "spip_articles", "id_article=".intval($id_article));
		$id_rubrique=$t['id_rubrique'];
		 
	while ($id_rubrique) { 
		$hierarchie[]=$id_rubrique;
		$res = sql_fetsel("id_parent", "spip_rubriques", "id_rubrique=".intval($id_rubrique));
		if (!$res){  // rubrique inexistante
			$id_rubrique = 0;
			break;
		} 
		$id_parent = $res['id_parent']; 
		$id_rubrique = $id_parent;
	}
	spip_log("Prop article > admin restreint de ".join(',', $hierarchie),'notifications');
 
		//les admins de la rub et de ses parents 
		$result_email = sql_select("auteurs.email,auteurs.id_auteur,lien.id_rubrique", "spip_auteurs AS auteurs, spip_auteurs_rubriques AS lien", "lien.id_rubrique IN (" . join(',', $hierarchie) . ") AND auteurs.id_auteur=lien.id_auteur AND auteurs.statut='0minirezo'");

		while ($qui = sql_fetch($result_email)) {
			spip_log($options['statut']." article > admin restreint ".$qui['id_auteur']." de la rubrique".$qui['id_rubrique']." prevenu",'notifications');
			$flux['data'][] = $qui['email'];
		}

	}
	
	// publication d'article : prevenir les auteurs
	if ($quoi=='instituerarticle'
	  AND $GLOBALS['notifications']['prevenir_auteurs_articles']){
		$id_article = $flux['args']['id'];
		 

		include_spip('base/abstract_sql');

		// Qui va-t-on prevenir en plus ?
		$result_email = sql_select("auteurs.email", "spip_auteurs AS auteurs, spip_auteurs_articles AS lien", "lien.id_article=".intval($id_article)." AND auteurs.id_auteur=lien.id_auteur");

		while ($qui = sql_fetch($result_email)) {
			$flux['data'][] = $qui['email'];
		}

	}

	// forum valide ou prive : prevenir les autres contributeurs du thread
	if (($quoi=='forumprive' AND $GLOBALS['notifications']['thread_forum_prive'])
		OR ($quoi=='forumvalide' AND $GLOBALS['notifications']['thread_forum'])
	  ){

		$id_forum = $flux['args']['id'];
		
		if ($t = $options['forum']
			OR $t = sql_fetsel("*", "spip_forum", "id_forum=".intval($id_forum))){

			// Tous les participants a ce *thread*
			// TODO: proposer une case a cocher ou un lien dans le message
			// pour se retirer d'un troll (hack: replacer @ par % dans l'email)
			$s = sql_select("DISTINCT(email_auteur)","spip_forum","id_thread=".intval($t['id_thread'])." AND email_auteur != ''");
			while ($r = sql_fetch($s))
				$flux['data'][] = $r['email_auteur'];

			/*
			// 3. Tous les auteurs des messages qui precedent (desactive egalement)
			// (possibilite exclusive de la possibilite precedente)
			// TODO: est-ce utile, par rapport au thread ?
			else if (defined('_SUIVI_FORUMS_REPONSES')
			AND _SUIVI_FORUMS_REPONSES) {
				$id_parent = $id_forum;
				while ($r = spip_fetch_array(spip_query("SELECT email_auteur, id_parent FROM spip_forum WHERE id_forum=$id_parent AND statut='publie'"))) {
					$tous[] = $r['email_auteur'];
					$id_parent = $r['id_parent'];
				}
			}
			*/
		}
	}

	// Les moderateurs de forums public
	if ($quoi=='forumposte' AND $GLOBALS['notifications']['moderateurs_forum']){
		foreach (explode(',', $GLOBALS['notifications']['moderateurs_forum']) as $m) {
			$flux['data'][] = $m;
		}
	}
	
	// noter les envois de ce forum pour ne pas doublonner
	if (in_array($quoi,array('forumposte','forumvalide','forumprive'))
		AND $id = $flux['args']['id']){
		if (isset($sent[$id])){
			$flux['data'] = array_diff($flux['data'],$sent[$id]);
		} else {
			$sent[$id] = array();
		}
		$sent[$id] = array_merge($sent[$id],$flux['data']);
	}

	return $flux;
}


/**
 * Pipeline notifications_envoyer_mails
 * appele a chaque envoi de mails
 * permet de gerer les contributeurs :
 *  - inscription auto si activee
 *  - url de suivi des forums
 * 
 * @param <type> $flux
 * @return <type> 
 */
function notifications_notifications_envoyer_mails($flux){
	if ($GLOBALS['notifications']['suivi']) {

		// ajouter un acces a la page de suivi
		$url = url_absolue(generer_url_public('suivi','email='.$flux['email']));
		$flux['texte'] .= "\n\n" . _L('Gerer mes abonnements : ') . $url;

		// ajouter les auteurs en base ?
		// ici ou dans la page de suivi lorsqu'ils essayent vraiment de gerer
		// leurs abonnements ?
		// $a = notifications_creer_auteur($email);
	}
	
	return $flux;
}


// Regarder si l'auteur est dans la base de donnees, sinon l'ajouter
// comme s'il avait demande a s'inscrire comme visiteur
// Pour l'historique il faut retrouver le nom de la personne,
// pour ca on va regarder dans les forums existants
// Si c'est la personne connectee, c'est plus facile
function notifications_creer_auteur($email) {

	include_spip('base/abstract_sql');
	if (!$a = sql_fetsel('*', 'spip_auteurs', 'email='.sql_quote($email))) {
		if ($GLOBALS['visiteur_session']['session_email'] === $email
		AND isset($GLOBALS['visiteur_session']['session_nom'])) {
			$nom = $GLOBALS['visiteur_session']['session_nom'];
		} else {
			if ($b = sql_fetsel('auteur', 'spip_forum',
				'email_auteur='.sql_quote($email).' AND auteur!=""',
				/* groupby */'', /* orderby */ array('date_heure DESC'),
				/* limit */ '1')
			) {
				$nom = $b['auteur'];
			} else {
				$nom = $email;
			}
		}
		// charger message_inscription()
		if ($traiter = charger_fonction('traiter','formulaires/inscription',true)) {
			// "pirater" les globals
			$_GET['nom_inscription'] = $nom;
			$_GET['email_inscription'] = $email;
			$a = $traiter('6forum', null);
		}
		if (!is_array($a)) {
			spip_log("erreur sur la creation d'auteur: $a",'notifications');
			next;
		}
	}

	// lui donner un cookie_oubli s'il n'en a pas deja un
	if (!isset($a['cookie_oubli'])) {
		include_spip('inc/acces'); # pour creer_uniqid
		$a['cookie_oubli'] = creer_uniqid();
		sql_updateq('spip_auteurs',
			array('cookie_oubli' => $a['cookie_oubli']),
			'id_auteur='.$a['id_auteur']
		);
	}

	return $a;
}

/* TODO
	// Envoyer un message de bienvenue/connexion au posteur du forum,
	// dans le cas ou il ne s'est pas authentifie
	// Souci : ne pas notifier comme ca si on est deja present dans le thread
	// (eviter d'avoir deux notificaitons pour ce message qu'on a, dans 99,99%
	// des cas, poste nous-memes !)
	if (strlen(trim($t['email_auteur']))
	AND email_valide($t['email_auteur'])
	AND !$GLOBALS['visiteur_session']['id_auteur']) {
		$msg = Notifications_jeuneposteur($t, $email);
		if ($t['email_auteur'] == 'fil@rezo.net')
			notifications_envoyer_mails($t['email_auteur'], $msg['body'],$msg['subject'])
	}
*/


/*
// Creer un mail pour les forums envoyes par quelqu'un qui n'est pas authentifie
// en lui souhaitant la bienvenue et avec un lien suivi&p= de connexion au site
function Notifications_jeuneposteur($t, $email) {
	return array('test', 'coucou');
}
*/

?>
