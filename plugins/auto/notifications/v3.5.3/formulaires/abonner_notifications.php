<?php
/*
 * Plugin Notifications
 * (c) 2009-2012 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Charger()
 *
 * @param string $email
 *   email dont on veut gerer les abonnements
 * @param string $key
 *   cle de signature de l'email
 * @param null $id_auteur
 *   id_auteur dont on veut gerer les abonnements (si pas d'email fourni)
 * @return array|string
 */
function formulaires_abonner_notifications_charger_dist($email, $key, $id_auteur=null){

	list($email, $id_auteur) = notifications_email_auteur($email, $key, $id_auteur);

	if (!$email AND !$id_auteur)
		return "<p><strong>"._T('abonnernotifications:message_acces_interdit')."</strong><br />"._T('abonnernotifications:message_acces_interdit_explication')."</p>";

	$valeurs = array(
		"id_threads" => array(),
		"_all_threads" => array(),
		"_email" => $email,
		"notification_email" => '',
	);

	// trouver tous les threads
	$rows = sql_allfetsel("id_thread,notification","spip_forum",notifications_where_abo($email, $id_auteur));

	if (!$rows)
		return "<p>"._T('abonnernotifications:message_aucun_abonnement_a_modifier')."</p>";

	$valeurs['_all_threads'] = array_map('reset',$rows);
	$valeurs['_all_threads'] = array_unique($valeurs['_all_threads']);

	foreach ($rows as $row){
		if ($row['notification'])
			$valeurs['id_threads'][] = $row['id_thread'];
	}

	return $valeurs;
}

/**
 * Verifier()
 *
 * @param string $email
 *   email dont on veut gerer les abonnements
 * @param string $key
 *   cle de signature de l'email
 * @param null $id_auteur
 *   id_auteur dont on veut gerer les abonnements (si pas d'email fourni)
 * @return array|string
 */
function formulaires_abonner_notifications_verifier_dist($email, $key, $id_auteur=null){

	$erreurs = array();

	if (_request('modifemail')){
		include_spip("inc/filtres");
		if (!$email = _request('notification_email'))
			$erreurs['notification_email'] = _T('info_obligatoire');
		elseif (!email_valide($email))
			$erreurs['notification_email'] = _T('form_prop_indiquer_email');
	}

	return $erreurs;
}


/**
 * Traiter()
 *
 * @param string $email
 *   email dont on veut gerer les abonnements
 * @param string $key
 *   cle de signature de l'email
 * @param null $id_auteur
 *   id_auteur dont on veut gerer les abonnements (si pas d'email fourni)
 * @return array|string
 */
function formulaires_abonner_notifications_traiter_dist($email, $key, $id_auteur=null){

	$res = array();
	list($email, $id_auteur) = notifications_email_auteur($email, $key, $id_auteur);

	if (_request('modifabo')){


		$id_threads = _request('id_threads');
		if (!is_array($id_threads))
			$id_threads = array();
		$id_threads = array_map('intval',$id_threads);
		$where_abo = notifications_where_abo($email, $id_auteur);
		// desabonner ceux qui ne sont pas coches
		sql_updateq("spip_forum",array('notification'=>0),"notification=1 AND $where_abo AND ".sql_in('id_thread',$id_threads,"NOT"));
		// abonner ceux qui sont coches
		sql_updateq("spip_forum",array('notification'=>1),"notification=0 AND $where_abo AND ".sql_in('id_thread',$id_threads));
		$res = array("message_ok"=>_T('abonnernotifications:message_abonnements_modifies'));
		// vider la saisie pour provoquer l'affichage de ce qui est en base
		set_request('id_threads');
	}
	elseif (_request('modifemail')){

	}

	// ne devrait jamais...
	if (!$res)
		$res = array('message_erreur' => 'Erreur');

	return $res;
}



/**
 * Verifier la signature de l'email
 * et retrouver l'id_auteur correspondant si possible (ou retrouver l'email de l'id_auteur si possible)
 *
 * @param string $email
 *   email dont on veut gerer les abonnements
 * @param string $key
 *   cle de signature de l'email
 * @param null $id_auteur
 *   id_auteur dont on veut gerer les abonnements (si pas d'email fourni)
 * @return array|string
 */
function notifications_email_auteur($email, $key, $id_auteur=null){
	// si un email fourni, il doit etre signe par une cle valide
	if ($email){
		include_spip("inc/securiser_action");
		if (!$key
			OR !verifier_cle_action("abonner_notifications $email",$key))
			return array('','');
	}

	// retrouver l'id_auteur correspondant a ce mail
	if ($email AND !$id_auteur){
		$id_auteur = sql_allfetsel("id_auteur","spip_auteurs","email=".sql_quote($email));
		if ($id_auteur)
			$id_auteur = array_map('reset',$id_auteur);
		if (count($id_auteur)==1)
			$id_auteur = reset($id_auteur);
	}
	// si pas d'email mais un id_auteur, prendre l'email de l'auteur
	if (!$email AND $id_auteur){
		$email = sql_getfetsel("email","spip_auteurs","id_auteur=".intval($id_auteur));
	}

	return array($email,$id_auteur);
}

/**
 * Condition where pour retrouver tous les abonnements de l'email/id_auteur
 * @param string $email
 * @param int|null $id_auteur
 * @return string
 */
function notifications_where_abo($email, $id_auteur=null){

	if (!$email AND !$id_auteur){
		return "(0=1)"; // rien a chercher
	}

	$where = array();
	if ($email)
		$where[] = "(notification_email=".sql_quote($email)
					  ." OR (notification_email=".sql_quote('')." AND email_auteur=".sql_quote($email)."))";
	if ($id_auteur)
		$where[] = "(notification_email=".sql_quote('')." AND email_auteur=".sql_quote('')." AND id_auteur=".intval($id_auteur).")";

	return "(".implode(" OR ",$where).")";
}