<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato Formato
 * (c) 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

// Crayons sur les donnes
function forms_donnee_valeur_colonne_table($table,$champs,$id_donnee){
	include_spip("inc/forms");

	$vals = array();
	foreach($champs as $champ){
		$valeur = Forms_valeurs($id_donnee,NULL,$champ);
		if (!count($valeur))
			$valeur = array($champ => '');
		$vals = array_merge($vals,$valeur);
	}
	return $vals;
}
function forms_donnee_revision($id_donnee,$c=NULL){
	include_spip('inc/forms');
	return Forms_revision_donnee($id_donnee,$c);
}
function forms_champ_valeur_colonne_table($table,$champ,$id){
	$id = explode('-',$id);
	$id_form = $id[0];
	$form_champ = $id[1];
	
	if (!preg_match(',^\w+$,',$champ)
	OR !$res = spip_query("SELECT $champ FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ IN (".implode(',',array_map('_q',$form_champ)).")")
	OR !$row = spip_fetch_array($res))
		return false;

	return $row;
}

// Crayons sur les champs
function forms_champ_revision($id,$c=NULL){
	$id = explode('-',$id);
	$id_form = $id[0];
	$form_champ = $id[1];

	$set = "";
	foreach(array('titre','obligatoire','specifiant','public','aide','html_wrap') as $champ){
		if ($v = _request($champ,$c)){
			$set .= ",$champ="._q($v);
		}
	}

	if (strlen($set)){
		$set = substr($set,1);
		spip_query("UPDATE spip_forms_champs SET $set WHERE id_form="._q($id_form)." AND champ="._q($form_champ));
	}
	return true;
}

// Crayons sur le form
function form_revision($id,$c=NULL){
	$id = explode('-',$id);
	$id_form = $id[0];
	$set = "";
	foreach(array('titre','descriptif','texte','html_wrap') as $champ){
		if ($v = _request($champ,$c)){
			$set .= ",$champ="._q($v);
		}
	}

	if (strlen($set)){
		$set = substr($set,1);
		spip_query("UPDATE spip_forms SET $set WHERE id_form="._q($id_form));
	}
	return true;
}

//
// VUE
//
function vues_forms_donnee($type, $champ, $id_donnee, $content){
	$res = spip_query("SELECT d.id_form,f.type_form FROM spip_forms_donnees AS d JOIN spip_forms AS f ON f.id_form=d.id_form WHERE d.id_donnee="._q($id_donnee));
	if( !$row = spip_fetch_array($res))
		return "";
	$type_form = $row['type_form'];
	$id_form = $row['id_form'];

  // chercher vues/article_toto.html
  // sinon vues/toto.html
  if (find_in_path( ($fond = 'vues/' . $type_form . '_donnee_' . $champ) . '.html')
  OR find_in_path( ($fond = 'vues/forms_donnee_' . $champ) .'.html')
  OR find_in_path( ($fond = 'vues/' . $type_form . '_donnee') .'.html')
  OR $fond = 'vues/forms_donnee') {
		$contexte = array(
		    'id_form' => $id_form,
		    'id_donnee' => $id_donnee,
		    'champ' => $champ,
		    'lang' => $GLOBALS['spip_lang']
		);
		$contexte = array_merge($contexte, $content);
		include_spip('public/assembler');
		return recuperer_fond($fond, $contexte);
  }
}
?>
