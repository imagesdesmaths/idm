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

include_spip("inc/presentation");
include_spip("inc/layer");
include_spip("base/forms");
include_spip("inc/forms");

function inc_forms_lier_donnees($type, $id, $script, $deplie=false, $type_table = NULL){
  global $spip_lang_left, $spip_lang_right, $options;
	global $connect_statut, $options,$connect_id_auteur, $couleur_claire ;

	if ($type_table===NULL)
		$type_table = forms_type_table_lier($type, $id);
	$prefixi18n = forms_prefixi18n($type_table);
	$lesdonnees = array();
	//
	// Afficher les donnees liees, rangees par tables
	//
	list($s,$les_donnees, $nombre_donnees) = Forms_formulaire_objet_afficher_donnees($type,$id,$script,$type_table);
	$form .= Forms_formulaire_objet_chercher_donnee($type,$id,$les_donnees, $script, $type_table);
	
	$out = "";
	$out .= "<a name='tables'></a>";
	if (_request('cherche_donnee') || _request('ajouter') || $deplie){
		//adaptation SPIP 2
		//$bouton = bouton_block_visible("tables_$type_$id");
		$bouton = bouton_block_depliable(true,"tables_$type_$id");
		//$debut_block = 'debut_block_visible';
		$debut_block = 'debut_block_depliable';
	}
	else{
		//adpatation SPIP2
		//$bouton = bouton_block_invisible("tables_$type_$id");
		$bouton = bouton_block_depliable(false,"tables_$type_$id");
		//$debut_block = 'debut_block_invisible';
		$debut_block = 'bouton_block_depliable';
	}

	$icone = find_in_path("img_pack/$type_table-24.gif");
	if (!$icone)
		$icone = find_in_path("img_pack/$type_table-24.png");
	if (!$icone)
		$icone = find_in_path("img_pack/table-24.gif");
	$out .= debut_cadre_enfonce($icone, true, "", $bouton._T("$prefixi18n:type_des_tables")."($nombre_donnees)");

	$out .= $s;
	
	$out .= $debut_block(false,"tables_$type_$id");
	
	//
	// Afficher le formulaire de recherche des donnees des tables
	//

	$out .= $form;
	$out .= fin_block(true);
	
	$out .= fin_cadre_enfonce(true);
	return _request('var_ajaxcharset')?$out:("<div id='forms_lier_donnees-$id'>".$out."</div>");
}

function Forms_formulaire_objet_chercher_donnee($type,$id,$les_donnees, $script, $type_table){
  global $spip_lang_right,$spip_lang_left,$couleur_claire,$couleur_foncee;
	$out = "";
	$recherche = _request('cherche_donnee');
	$iid = intval($id);
	
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	$redirect = ancre_url(generer_url_ecrire($script,"type=$type&id_$type=$iid"),'tables');
	if ($type == 'donnee'){
		$redirect = parametre_url($redirect,'id_form',_request('id_form'));
		$redirect = parametre_url($redirect,'retour',urlencode(_request('retour')));
	}
	$action = generer_action_auteur("forms_lier_donnees","$id,$type,ajouter");
	
	$out .= "<form action='$action' method='post' class='ajaxAction' >";
	$out .= form_hidden($action);
	$out .= "<input type='hidden' name='redirect' value='$redirect' />";
	$out .= "<input type='hidden' name='idtarget' value='forms_lier_donnees-$id' />";
	$out .= "<input type='hidden' name='redirectajax' value='".generer_url_ecrire('forms_lier_donnees',"type=$type&id_$type=$id")."' />";
	$out .= "<div style='text-align:$spip_lang_left;width:100%;'>";
	$out .= "<input id ='autocompleteMe' type='text' name='cherche_donnee' value='$recherche' class='forml' style='width:90%;' />";

	if ($type == 'donnee')
		$les_donnees .= (strlen($les_donnees)?",":"").$iid;
	$out .= Forms_boite_selection_donnees($recherche?$recherche:((_request('ajouter')!==NULL)?"":$recherche),$les_donnees, $type, $type_table);
	
	$script_rech = generer_url_ecrire("recherche_donnees","type=$type&id_$type=$id",true);
	$out .= "<input type='hidden' name='autocompleteUrl' value='$script_rech' />";

	$out .= "<style type='text/css' media='all'>
.autocompleter
{
	border: 1px solid $couleur_foncee;
	width: 350px;
	background-color: $couleur_claire;
}
.autocompleter ul li
{
	padding: 2px 10px;
	white-space: nowrap;
	font-size: 11px;
}
.selectAutocompleter
{
	background-color: $couleur_foncee;
}</style>";
	
	$out .= "</div>";
	$out .= "<div class='spip_bouton' style='text-align:$spip_lang_right'>";
	$out .= "<input type='submit' name='ajouter' value='"._T('bouton_ajouter')."' />";
	$out .= "</div>";
	$out .= "</form>";
	return $out;
}

function Forms_formulaire_objet_afficher_donnees($type,$id, $script, $type_table='table'){
	return Forms_afficher_liste_donnees_liees(
		$type, 
		$id, 
		strncmp($type,"donnee",6)==0?"donnee_liee":"donnee",
		$type_table,
		'forms_lier_donnees', 
		"forms_lier_donnees-$id", 
		"type=$type&id_$type=$id",
		self());
}

function Forms_boite_selection_donnees($recherche, $les_donnees, $type, $type_table){
	$out = "";
	$liste_res = Forms_liste_recherche_donnees($recherche,$les_donnees,$type,$type_table);
	if (count($liste_res)){
		$nb_ligne = 0;
		foreach($liste_res as $titre=>$donnees){
			$out .= "<option value=''>$titre</option>";
			foreach($donnees as $id_donnee=>$champs){
				$nb_ligne++;
				$out .= "<option value='$id_donnee'>&nbsp;&nbsp;&nbsp;";
				$out .= implode (", ",$champs);
				$out .= "</option>";
			}
		}
		$nb_ligne = min(50,max(10,round($nb_ligne/4)));
		$out = "<select name='id_donnee_liee[]' multiple='multiple' class='fondl' style='width:100%' size='$nb_ligne'>"
		  .$out .= "</select>";
	}
	$out .= "<input id='_id_donnee_liee' type='hidden' name='_id_donnee_liee' value='' />";
	return $out;
}

function Forms_liste_recherche_donnees($recherche,$les_donnees,$type,$type_table,$max_items=-1){
	if (strncmp($type,'donnees',6)==0)
		$linkable = false;
	else 	
		$linkable = true;
	$table = array();
	if ($recherche===NULL && $max_items==-1)
		$max_items = 200;
	//if ($recherche!==NULL){
		include_spip('base/abstract_sql');
		$in = calcul_mysql_in('d.id_donnee',$les_donnees,'NOT');
		$limit = "";
		if ($max_items>0)
			$limit = "LIMIT 0,".intval($max_items);
		if (!strlen($recherche)){
			$res = spip_query($r="SELECT d.id_donnee FROM spip_forms_donnees AS d
			  JOIN spip_forms AS f ON f.id_form=d.id_form
			  WHERE d.statut!='poubelle' AND f.type_form="._q($type_table)
			  . ($linkable?" AND f.linkable='oui'":"")
			  . " AND $in GROUP BY d.id_donnee ORDER BY f.id_form,d.id_donnee $limit");
		}
		else {
			$res = spip_query($s = "SELECT c.id_donnee FROM spip_forms_donnees_champs AS c
			JOIN spip_forms_donnees AS d ON d.id_donnee = c.id_donnee
			JOIN spip_forms AS f ON d.id_form = f.id_form
			WHERE d.statut!='poubelle' AND f.type_form="._q($type_table)
			. ($linkable?" AND f.linkable='oui'":"")
			." AND $in AND valeur LIKE "._q("$recherche%")." GROUP BY c.id_donnee ORDER BY f.id_form,d.id_donnee $limit");
			//adapation SPIP2
			//if (spip_num_rows($res)<10){
			if (sql_count($res)<10){
				$res = spip_query($s = "SELECT c.id_donnee FROM spip_forms_donnees_champs AS c
				JOIN spip_forms_donnees AS d ON d.id_donnee = c.id_donnee
				JOIN spip_forms AS f ON d.id_form = f.id_form
				WHERE d.statut!='poubelle' AND f.type_form="
				._q($type_table)
				. ($linkable?" AND f.linkable='oui'":"")
				." AND $in AND valeur LIKE "._q("%$recherche%")." GROUP BY c.id_donnee ORDER BY f.id_form,d.id_donnee $limit");
			}
		}
		while ($row = spip_fetch_array($res)){
			list($id_form,$titreform,$type_form,$t) = Forms_liste_decrit_donnee($row['id_donnee'],true, $linkable);
			if (!count($t))
				list($id_form,$titreform,$type_form,$t) = Forms_liste_decrit_donnee($row['id_donnee'],false, $linkable);
			if (count($t))
				$table[$titreform][$row['id_donnee']]=$t;
		}
	//}
	return $table;
}

?>
