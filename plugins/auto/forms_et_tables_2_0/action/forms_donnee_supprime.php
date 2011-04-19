<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * © 2005,2006 - Distribue sous licence GNU/GPL
 *
 */
include_spip('inc/forms');

function action_forms_donnee_supprime(){
	global $auteur_session;
	$arg = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = _request('redirect');
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_donnee_supprime-$arg",$hash,$id_auteur)==TRUE) {
		list($id_form,$id_donnee) = explode(':',$arg);
		if (!include_spip('inc/autoriser'))
			include_spip('inc/autoriser_compat');
		if (autoriser('supprimer','donnee',$id_donnee,NULL,array('id_form'=>$id_form))){
			if ($result = spip_query("DELETE FROM spip_forms_donnees WHERE id_form="._q($id_form)." AND id_donnee="._q($id_donnee)))
				$result = spip_query("DELETE FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee));
		}
	}
	if ($redirect)
		redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
}

?>