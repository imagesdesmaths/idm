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

// http://doc.spip.org/@action_instituer_forum_dist
function action_instituer_forum_paremail_dist() {

	// verification manuelle de la signature : cas particulier de cette action signee par email
	$arg = _request('arg');
	$hash = _request('hash');

	include_spip("inc/securiser_action");
	$action = 'instituer_forum_paremail';
	$pass = secret_du_site();

	$verif = _action_auteur("$action-$arg", '', $pass, 'alea_ephemere');

	$erreur = _T('notifications:info_moderation_interdite');

	if ($hash==_action_auteur("$action-$arg", '', $pass, 'alea_ephemere')
	  OR $hash==_action_auteur("$action-$arg", '', $pass, 'alea_ephemere_ancien'))
		$erreur = "";
	else
		spip_log("Signature incorrecte pour $arg","moderationparemail"._LOG_INFO_IMPORTANTE);

	// si hash est ok, verifier si l'email correspond a un auteur qui a le droit de faire cette action
	if (!$erreur){
		$arg = explode("-",$arg);
		$id_forum = array_shift($arg);
		$statut = array_shift($arg);
		$statut_init = array_shift($arg);
		// l'email est ce qui reste
		$email = implode("-",$arg);
		// reconstituer l'arg pour l'action standard
		$arg = "$id_forum-$statut";

		// on recherche le message en verifiant qu'il a bien le statut
		if ($message = sql_fetsel("id_objet,objet,statut","spip_forum","id_forum=".intval($id_forum))){
			if ($message['statut']!=$statut_init){
				$erreur = _T("notifications:info_moderation_deja_faite",array('id_forum'=>$id_forum,'statut'=>$message['statut']));
			}
			else {
				// trouver le(s) auteur(s) et verifier leur autorisation
				$res = sql_select("*","spip_auteurs","email=".sql_quote($email,'','text'));
				while ($auteur = sql_fetch($res)){
					if (autoriser("modererforum",$message['objet'],$message['id_objet'],$auteur)){
						$erreur = "";
						// on ajoute l'exception car on est pas identifie avec cet id_auteur
						autoriser_exception("modererforum",$message['objet'],$message['id_objet']);
						break;
					}
				}
				if ($erreur){
					spip_log("Aucun auteur pour $email autorise a moderer $id_forum","moderationparemail"._LOG_INFO_IMPORTANTE);
				}
			}
		}
		else {
			spip_log("Message forum $id_forum introuvable","moderationparemail"._LOG_INFO_IMPORTANTE);
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
