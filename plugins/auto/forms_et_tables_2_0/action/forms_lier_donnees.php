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

function action_forms_lier_donnees(){
	global $auteur_session;
	$args = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = urldecode(_request('redirect'));
	$cherche_donnee = _request('cherche_donnee');
	$id_donnee_liee = _request('id_donnee_liee'); // peut etre un tableau du fait d'un select multiple
	if (!$id_donnee_liee) $id_donnee_liee = intval(_request('_id_donnee_liee'));
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_lier_donnees-$args",$hash,$id_auteur)==TRUE) {
		$args = explode(",",$args);
		$id = intval($args[0]);
		$type = $args[1];
		if (!preg_match(',[\w]+,',$type))
			$type = 'article';
		$faire = $args[2];
		if ($faire=='ajouter'){
			if ($id!=0 && $id_donnee_liee && ($id<0 OR autoriser('modifier',$type,$id))){
				$champ_donnee = 'id_donnee';
				if ($type=='donnee') 
					$champ_donnee = 'id_donnee_liee';
				if (!is_array($id_donnee_liee)) $id_donnee_liee = array($id_donnee_liee);
				foreach($id_donnee_liee as $id_liee) {
					if ($id_liee = intval($id_liee)) {
						$res = spip_query("SELECT * FROM spip_forms_donnees_{$type}s WHERE id_$type="._q($id)." AND $champ_donnee="._q($id_liee));
						if (!$row = spip_fetch_array($res))
							spip_query("INSERT INTO spip_forms_donnees_{$type}s (id_$type,$champ_donnee) VALUES ("._q($id).","._q($id_liee).")");
					}
				}
				$redirect = parametre_url($redirect,'cherche_donnee','');
			}
			if (!$id_donnee_liee){
				if ($cherche_donnee)
					$redirect = parametre_url($redirect,'cherche_donnee',$cherche_donnee);
				$redirect = parametre_url($redirect,'ajouter','1');
			}
		}
		if ($faire=='retirer'){
			$id_donnee_liee = intval($args[3]);
			if ($id && $id_donnee_liee && autoriser('modifier',$type,$id)){
				$champ_donnee = 'id_donnee';
				if ($type=='donnee') 
					$champ_donnee = 'id_donnee_liee';
				spip_query("DELETE FROM spip_forms_donnees_{$type}s WHERE id_$type="._q($id)." AND $champ_donnee="._q($id_donnee_liee));
			}
		}
	}
	include_spip('inc/headers');
	redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
}

?>