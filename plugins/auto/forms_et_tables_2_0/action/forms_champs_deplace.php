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
if (!include_spip('inc/autoriser'))
	include_spip('inc/autoriser_compat');

function action_forms_champs_deplace(){
	global $auteur_session;
	$args = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = _request('redirect');
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_champs_deplace-$args",$hash,$id_auteur)==TRUE) {
			$args = explode("-",$args);
			$id_form = $args[0];
			$champ = $args[1];
			$action = $args[2];
			if (autoriser('modifier','form',$id_form)){
				// Monter / descendre un champ
				if (($action == 'monter') OR ($action == 'descendre')) {
					if ($row = spip_fetch_array(spip_query("SELECT rang FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ="._q($champ)))) {
						$rang1 = intval($row['rang']);
						if ($action == 'monter') $order = "rang<$rang1 ORDER BY rang DESC";
						else $order = "rang>$rang1 ORDER BY rang";
						if (($row = spip_fetch_array(spip_query("SELECT rang FROM spip_forms_champs WHERE id_form="._q($id_form)." AND $order LIMIT 0,1")))){
							$rang2 = intval($row['rang']);
							spip_query("UPDATE spip_forms_champs SET rang=$rang1+$rang2-rang WHERE id_form="._q($id_form)." AND rang IN ($rang1,$rang2)");
						}
					}
				}
			}
	}
	redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
}

?>