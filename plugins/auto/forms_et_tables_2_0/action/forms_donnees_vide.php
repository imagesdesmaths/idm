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

function action_forms_donnees_vide(){
	global $auteur_session;
	$arg = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = _request('redirect');
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_donnees_vide-$arg",$hash,$id_auteur)==TRUE) {
		$id_form = intval($arg);
		Forms_donnees_vide($id_form);
	}
	if ($redirect)
		redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
}

?>