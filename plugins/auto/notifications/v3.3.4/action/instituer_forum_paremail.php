<?php
/*
 * Plugin Notifications
 * (c) 2009-2012 SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

// http://doc.spip.org/@action_instituer_forum_dist
function action_instituer_forum_paremail_dist() {

	// verification manuelle de la signature : cas particulier de cette action signee par email
	$arg = _request('arg');
	$hash = _request('hash');

	include_spip("inc/securiser_action");
	$action = 'instituer_forum_paremail';
	$pass = secret_du_site();

	$verif = _action_auteur("$action-$arg", '', $pass, 'alea_ephemere');

	$ae = explode("-",$arg);
	$id_forum = array_shift($ae);
	$statut = array_shift($ae);
	$statut_init = array_shift($ae);
	// l'email est ce qui reste
	$email = implode("-",$ae);
	$message = null;
	$erreur_auteur = _T('notifications:info_moderation_interdite');

	include_spip("inc/filtres");
	$lien_moderation = lien_ou_expose(url_absolue(generer_url_entite($id_forum,'forum',"","forum$id_forum",false)),_T('notifications:info_moderation_lien_titre'));
	$erreur = _T('notifications:info_moderation_url_perimee')."<br />$lien_moderation";

	if ($hash==_action_auteur("$action-$arg", '', $pass, 'alea_ephemere')
	  OR $hash==_action_auteur("$action-$arg", '', $pass, 'alea_ephemere_ancien'))
		$erreur = "";
	else {
		// le hash est invalide, mais peut-etre est-on loge avec cet email ?
		// auquel cas on peut utiliser les liens, meme perimes (confort)
		if (isset($GLOBALS['visiteur_session'])
			AND isset($GLOBALS['visiteur_session']['id_auteur'])
			AND $GLOBALS['visiteur_session']['id_auteur']
			AND isset($GLOBALS['visiteur_session']['email'])
			AND $GLOBALS['visiteur_session']['email']==$email){
			$message = sql_fetsel("id_objet,objet,statut","spip_forum","id_forum=".intval($id_forum));
			if (autoriser("modererforum",$message['objet'],$message['id_objet'])){
				$erreur_auteur = "";
				$erreur = "";
			}
		}
		else
			spip_log("Signature incorrecte pour $arg","moderationparemail"._LOG_INFO_IMPORTANTE);
	}

	// si hash est ok, verifier si l'email correspond a un auteur qui a le droit de faire cette action
	if (!$erreur){
		// reconstituer l'arg pour l'action standard
		$arg = "$id_forum-$statut";

		if (!$message)
			$message = sql_fetsel("id_objet,objet,statut","spip_forum","id_forum=".intval($id_forum));

		// on recherche le message en verifiant qu'il a bien le statut
		if ($message){
			if ($message['statut']!=$statut_init){
				$erreur = _T("notifications:info_moderation_deja_faite",array('id_forum'=>$id_forum,'statut'=>$message['statut']))
					."<br />$lien_moderation";
			}
			else {
				// trouver le(s) auteur(s) et verifier leur autorisation si besoin
				if ($erreur_auteur){
					$res = sql_select("*","spip_auteurs","email=".sql_quote($email,'','text'));
					while ($auteur = sql_fetch($res)){
						if (autoriser("modererforum",$message['objet'],$message['id_objet'],$auteur)){
							$erreur_auteur = "";
							// on ajoute l'exception car on est pas identifie avec cet id_auteur
							autoriser_exception("modererforum",$message['objet'],$message['id_objet']);
							break;
						}
					}
				}
				if ($erreur_auteur){
					$erreur = $erreur_auteur 
					  . "<br /><small>"
					  . _L("(aucun auteur avec l'email $email n'a de droit suffisant)")
					  . "</small>";
					spip_log("Aucun auteur pour $email autorise a moderer $id_forum","moderationparemail"._LOG_INFO_IMPORTANTE);
				}
			}
		}
		else {
			spip_log("Message forum $id_forum introuvable","moderationparemail"._LOG_INFO_IMPORTANTE);
			$erreur = "Message forum $id_forum introuvable"; // improbable ?
		}
	}

	if (!$erreur){
		spip_log("Moderation message $id_forum $statut par $email","moderationparemail"._LOG_INFO_IMPORTANTE);
		$instituer_forum = charger_fonction("instituer_forum","action");
		$instituer_forum($arg);
	}

	// Dans tous les cas on finit sur un minipres qui dit si ok ou echec
	$titre = (!$erreur ? _T("notifications:info_moderation_confirmee_$statut",array('id_forum'=>$id_forum)) : $erreur);
	include_spip('inc/minipres');
	echo minipres($titre,"","",true);

}
