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

function action_forms_duplique(){
	global $auteur_session;
	$id_form = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = _request('redirect');
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_duplique-$id_form",$hash,$id_auteur)==TRUE) {
		Forms_duplique_form($id_form);
	}
	redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
}

function Forms_duplique_form($duplique){
	include_spip('base/abstract_sql');
	// creation
	$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($duplique));
	$names = "";
	$values = "";
	if ($row = spip_fetch_array($result)) {
		foreach($row as $nom=>$valeur){
			if ($nom=='titre') $valeur = _T("forms:formulaires_copie",array('nom'=>$valeur));
			if ($nom!='id_form'){
				$names .= "$nom,";
				$values .= _q($valeur).",";
			}
		}
		$names = substr($names,0,strlen($names)-1);
		$values = substr($values,0,strlen($values)-1);
		// ADAPTATION SPIP 2
		//spip_abstract_insert('spip_forms',"($names)","($values)");
		$id_form = sql_insert('spip_forms',"($names)","($values)");
		//$id_form = spip_insert_id();
		//$id_form = sql_insertq( 'spip_forms',array());
		if ($id_form){
			$res = spip_query("SELECT * FROM spip_forms_champs WHERE id_form="._q($duplique));
			while($row = spip_fetch_array($res)) {
				$names = "id_form,";
				$values = "$id_form,";
				foreach($row as $nom=>$valeur){
					if ($nom!='id_form'){
						$names .= "$nom,";
						$values .= _q($valeur).",";
					}
				}
				$names = substr($names,0,strlen($names)-1);
				$values = substr($values,0,strlen($values)-1);
				spip_query("REPLACE INTO spip_forms_champs ($names) VALUES ($values)");
			}
			$res = spip_query("SELECT * FROM spip_forms_champs_choix WHERE id_form="._q($duplique));
			while($row = spip_fetch_array($res)) {
				$names = "id_form,";
				$values = "$id_form,";
				foreach($row as $nom=>$valeur){
					if ($nom!='id_form'){
						$names .= "$nom,";
						$values .= _q($valeur).",";
					}
				}
				$names = substr($names,0,strlen($names)-1);
				$values = substr($values,0,strlen($values)-1);
				spip_query("REPLACE INTO spip_forms_champs_choix ($names) VALUES ($values)");
			}
		}
	}
}
?>