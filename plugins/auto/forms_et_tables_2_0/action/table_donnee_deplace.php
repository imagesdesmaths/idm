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

function action_table_donnee_deplace(){
	global $auteur_session;
	$args = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = urldecode(_request('redirect'));
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("table_donnee_deplace-$args",$hash,$id_auteur)==TRUE) {
		$args = explode("-",$args);
		$id_form = $args[0];
		$id_donnee = $args[1];
		$ordre = _request('ordre');
		$rang_nouv = 0;
		if ($ordre){
			$table_sort = explode("&",$ordre);
			$last_rang = 0;
			foreach($table_sort as $item){
				$item = explode("=",$item);
				$item = explode("-",end($item));
				$donnees[] = reset($item);
				$rangs[] = end($item);
				if (($n = count($rangs))>=2){
					if ($rangs[$n-1]<$rangs[$n-2]){ // irregularite
						if ($n>=3){
							if ($rangs[$n-1]<$rangs[$n-3]) 
								{$id_donnee = $donnees[$n-1];$rang_nouv = $rangs[$n-2];}
							else
								{$id_donnee = $donnees[$n-2];$rang_nouv = $rangs[$n-1];}
						}
						else
							{$id_donnee = $donnees[$n-2];$rang_nouv = $rangs[$n-1];}
						continue;
					}
				}
			}
			if ($rang_nouv)
				if (autoriser('modifier','donnee',$id_donnee,NULL,array('id_form'=>$id_form)))
					Forms_rang_update($id_donnee,$rang_nouv);
		}
		else {
			if (autoriser('modifier','donnee',$id_donnee,NULL,array('id_form'=>$id_form))){
				$rang_nouv = _request('rang_nouv');
				Forms_rang_update($id_donnee,$rang_nouv);
			}
		}
	}
	redirige_par_entete(str_replace("&amp;","&",$redirect));
}

?>