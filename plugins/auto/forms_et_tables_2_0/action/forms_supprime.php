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

function action_forms_supprime(){
	global $auteur_session;
	$id_form = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = _request('redirect');
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_supprime-$id_form",$hash,$id_auteur)==TRUE) {
		if (!include_spip('inc/autoriser'))
			include_spip('inc/autoriser_compat');
		if (autoriser('supprimer','form',$id_form)){
			$result = spip_query("DELETE FROM spip_forms WHERE id_form="._q($id_form));
			$result = spip_query("DELETE FROM spip_forms_champs WHERE id_form="._q($id_form));
			$result = spip_query("DELETE FROM spip_forms_champs_choix WHERE id_form="._q($id_form));
		}
	}
	redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
}

?>