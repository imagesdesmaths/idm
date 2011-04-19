<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato Formato
 * (c) 2005-2007 - Distribue sous licence GNU/GPL
 *
 */

/* Operation sur les tables -------------------------------*/
// creation d'une table a partir de sa structure xml
// le type est surcharge par $type
// $unique : ne pas creer la table si une du meme type existe deja
function Forms_creer_table($structure_xml,$type=NULL, $unique = true, $c=NULL){
	include_spip('inc/xml');

	$xml = spip_xml_load($structure_xml);
	foreach($xml as $k1=>$forms)
		foreach($forms as $k2=>$formscont)
			foreach($formscont as $k3=>$form)
				foreach($form as $k4=>$formcont)
					foreach($formcont as $prop=>$datas)
					if ($prop=='type_form'){
						if ($type)
							$xml[$k1][$k2][$k3][$k4][$prop] = array($type);
						else 
							$type = trim(spip_xml_aplatit($datas));
							/*$type = trim(applatit_arbre($datas));*/
							// ADAPTATION SPIP2
					}

	if (!$type) return;
	if ($unique){
		$res = spip_query("SELECT id_form FROM spip_forms WHERE type_form="._q($type));
		//adaptation SPIP2
		//if (spip_num_rows($res))
		if (sql_count($res))
			return;
	}
	// ok on peut creer la table
	$snippets_forms_importer = charger_fonction('importer','snippets/forms');
	$id_form = $snippets_forms_importer(0,$xml);
	if ($c!==NULL){
		include_spip('forms_crayons');
		form_revision($id_form,$c);
	}
	return $id_form;
}

function Forms_liste_tables($type){
	static $liste = array();
	if (is_array($type) && count($type)) {
		$l = array();
		foreach($type as $t)
			$l = array_merge($l,Forms_liste_tables($t));
		return $l;
	}
	if (!isset($liste[$type])){
		$liste[$type] = array();
		$res = spip_query("SELECT id_form FROM spip_forms WHERE type_form="._q($type));
		while ($row = spip_fetch_array($res)){
			$liste[$type][] = $row['id_form'];
		}
	}
	return $liste[$type];
}

function Forms_supprimer_tables($type_ou_id){
	if (!$id_form = intval($type_ou_id) OR !is_numeric($type_ou_id)){
		$liste = Forms_liste_tables($type_ou_id);
		foreach($liste as $id)
			Forms_supprimer_tables($id);
		return;
	}
	$res = spip_query("SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form));
	while ($row = spip_fetch_array($res)){
		spip_query("DELETE FROM spip_forms_donnees_champs WHERE id_donnee="._q($row['id_donnee']));
		spip_query("DELETE FROM spip_forms_donnees_articles WHERE id_donnee="._q($row['id_donnee']));
		spip_query("DELETE FROM spip_forms_donnees_rubriques WHERE id_donnee="._q($row['id_donnee']));
	}
	spip_query("DELETE FROM spip_forms_donnees WHERE id_form="._q($id_form));
	spip_query("DELETE FROM spip_forms_champs_choix WHERE id_form="._q($id_form));
	spip_query("DELETE FROM spip_forms_champs WHERE id_form="._q($id_form));
	spip_query("DELETE FROM spip_forms WHERE id_form="._q($id_form));
	spip_query("DELETE FROM spip_forms_articles WHERE id_form="._q($id_form));
}

include_spip('forms_fonctions');
function Forms_les_valeurs($id_form, $id_donnee, $champ, $separateur=",",$etoile=false, $traduit=true){
	if (is_array($champ))
		foreach($champ as $k=>$ch)
			$champ[$k] = forms_calcule_les_valeurs('forms_donnees_champs', $id_donnee, $ch, $id_form, $separateur,$etoile,$traduit);
	else
		$champ = forms_calcule_les_valeurs('forms_donnees_champs', $id_donnee, $champ, $id_form, $separateur,$etoile,$traduit);
	return $champ;
}
function Forms_creer_champ($id_form,$type,$titre,$c=NULL,$champ=""){
	include_spip('inc/forms_edit');
	$champ = Forms_insere_nouveau_champ($id_form,$type,$titre,$champ);
	if ($c!==NULL){
		include_spip('forms_crayons');
		forms_champ_revision("$id_form-$champ",$c);
	}
	return $champ;
}

/* Operation sur les donnees -------------------------------*/

function Forms_creer_donnee($id_form,$c = NULL, $rang=NULL){
	include_spip('inc/autoriser');
	if (!autoriser('creer','donnee',0,NULL,array('id_form'=>$id_form)))
		return array(0,_L("droits insuffisants pour creer une donnee dans table $id_form"));
	include_spip('inc/forms');
	$new = 0;
	$erreur = array();
	Forms_enregistrer_reponse_formulaire($id_form, $new, $erreur, $reponse, '', '' , $c, $rang);
	return array($new,$erreur);
}
function Forms_supprimer_donnee($id_form,$id_donnee){
	include_spip('inc/autoriser');
	if (!autoriser('supprimer','donnee',$id_donnee,NULL,array('id_form'=>$id_form)))
		return _L("droits insuffisants pour supprimer la donnee $id_donnee");
	spip_query("UPDATE spip_forms_donnees SET statut='poubelle',bgch=0,bdte=0,niveau=0 WHERE id_donnee="._q($id_donnee));
	return true;
}
function Forms_modifier_donnee($id_donnee,$c = NULL){
	include_spip('inc/forms');
	return Forms_revision_donnee($id_donnee,$c);
}

function Forms_instituer_donnee($id_donnee,$statut){
		spip_query("UPDATE spip_forms_donnees SET statut="._q($statut)." WHERE id_donnee="._q($id_donnee));
}
function Forms_ordonner_donnee($id_donnee,$rang){
		include_spip("inc/forms");
		Forms_rang_update($id_donnee,$rang);
}

function Forms_rechercher_donnee($recherche,$id_form=0,$champ=NULL,$sous_ensemble=NULL){
	$liste = array();
	$in = "";
	if (is_array($sous_ensemble)){
		include_spip('base/abstract_sql');
		$in = calcul_mysql_in('dc.id_donnee',implode(',',$sous_ensemble));
	}
	$res = spip_query(
	    "SELECT dc.id_donnee FROM spip_forms_donnees_champs AS dc"
	  . ($id_form?" LEFT JOIN spip_forms_donnees AS d ON dc.id_donnee=d.id_donnee":"")
	  . " WHERE dc.valeur LIKE "._q($recherche)
	  . ($id_form?" AND d.id_form="._q($id_form):"")
	  . ($in?" AND $in":"")
	  . ($champ?" AND dc.champ="._q($champ):"")
	);
	while ($row = spip_fetch_array($res))
		$liste[] = $row['id_donnee'];
	return $liste;
}

function Forms_infos_donnee($id_donnee,$specifiant=true,$linkable=false){
	list($id_form,$titreform,$type_form,$t) = Forms_liste_decrit_donnee($id_donnee,$specifiant,$linkable);
	if (!count($t) && $specifiant)
		list($id_form,$titreform,$type_form,$t) = Forms_liste_decrit_donnee($id_donnee, false,$linkable);
	if (!count($t) && !$id_form) { 
		// verifier qu'une donnee vide n'existe pas suite a enregistrement errone..
		$res2 = spip_query("SELECT f.titre AS titreform,f.id_form,f.type_form FROM spip_forms_donnees AS d
		JOIN spip_forms AS f ON f.id_form=d.id_form
		WHERE d.id_donnee="._q($id_donnee));
		if ($row2 = spip_fetch_array($res2)){
			$titreform = $row2['titreform'];
			$id_form = $row2['id_form'];
			$type_form = $row2['type_form'];
		}
	}
	return array($id_form,$titreform,$type_form,$t);
}
function Forms_decrit_donnee($id_donnee,$specifiant=true,$linkable=false){
	list($id_form,$titreform,$type_form,$t) = Forms_infos_donnee($id_donnee,$specifiant,$linkable);
	return $t;
}

function Forms_donnees_liees($id_donnee,$type_form_lie){
	include_spip('base/abstract_sql');
	$liste = Forms_liste_tables($type_form_lie);
	$in_liste = calcul_mysql_in('id_form',implode(',',$liste));
	$res = spip_query("SELECT * FROM spip_forms_donnees_donnees WHERE id_donnee="._q($id_donnee)." OR id_donnee_liee="._q($id_donnee));
	$valeurs = array();
	while ($row = spip_fetch_array($res)){
		$liee = $row['id_donnee']+$row['id_donnee_liee']-$id_donnee;
		$res2 = spip_query("SELECT * FROM spip_forms_donnees WHERE id_donnee="._q($liee)." AND $in_liste");
		if ($row2 = spip_fetch_array($res2))
			$valeurs[] = $liee;
	}
	return $valeurs;
}
function Forms_delier_donnee($id_donnee,$id_donnee_liee=0,$type_form_lie = ""){
	if ($id_donnee_liee!=0){
		spip_query("DELETE FROM spip_forms_donnees_donnees WHERE id_donnee="._q($id_donnee)." AND id_donnee_liee="._q($id_donnee_liee));
		spip_query("DELETE FROM spip_forms_donnees_donnees WHERE id_donnee_liee="._q($id_donnee)." AND id_donnee="._q($id_donnee_liee));
	}
	else {
		include_spip('base/abstract_sql');
		$liste = Forms_liste_tables($type_form_lie);
		$in_liste = calcul_mysql_in('id_form',implode(',',$liste));
		$res = spip_query("SELECT * FROM spip_forms_donnees_donnees WHERE id_donnee="._q($id_donnee)." OR id_donnee_liee="._q($id_donnee));
		while ($row = spip_fetch_array($res)){
			$liee = $row['id_donnee']+$row['id_donnee_liee']-$id_donnee;
			$res2 = spip_query("SELECT * FROM spip_forms_donnees WHERE id_donnee="._q($liee)." AND $in_liste");
			if ($row2 = spip_fetch_array($res2))
				spip_query("DELETE FROM spip_forms_donnees_donnees WHERE id_donnee=".$row['id_donnee']." AND id_donnee_liee=".$row['id_donnee_liee']);
		}
	}
}


/* Operation sur les donnees arborescentes -------------------------------*/
/* 
 * $id_form : la table
 * $id_parent : la donnee 'parente'
 * position : la relation avec le parent
 *   fils_cadet, fils_aine, grand_frere, petit_frere, pere
 * retourne un array($id_donnee,$erreur)
 */
function Forms_arbre_inserer_donnee($id_form,$id_parent,$position="fils_cadet",$c=NULL){
	if (!$id_parent>0){
		if ($res = spip_query("SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form)." AND statut!='poubelle' LIMIT 0,1")
		  //adapation SPIP2
		  //AND spip_num_rows($res)==0){
		  AND sql_count($res)==0){
		  // pas d'elements existants, c'est la racine, on l'insere toujours
			if ($position=='fils_aine' OR $position=='fils_cadet'){
				spip_log("Insertion impossible dans un arbre pour un fils sans pere dans table $id_form");
				return array(0,_L("Insertion impossible dans un arbre pour un fils sans pere dans table $id_form"));
			}
			// premiere insertion
				return Forms_creer_donnee($id_form,$c,array('niveau'=>0,'bgch'=>1,'bdte'=>2));
		}
		else {
			// Insertion d'un collateral : il faut preciser le 'parent' !
			spip_log("Insertion impossible dans un arbre pour un collatŽral sans precision du parent dans table $id_form");
			return array(0,_L("Insertion impossible dans un arbre pour un collatŽral sans precision du parent dans table $id_form"));
		}
	}
	// Le parent existe toujours ?
	$res = spip_query("SELECT * FROM spip_forms_donnees WHERE id_form="._q($id_form)." AND id_donnee="._q($id_parent)." AND statut!='poubelle'");
	if (!($rowp = spip_fetch_array($res))){
		spip_log("Insertion impossible, le parent $id_parent n'existe plus dans table $id_form");
		return array(0,_L("Insertion impossible, le parent $id_parent n'existe plus dans table $id_form"));
	}
	
	// insertion d'un pere
	if ($position == 'pere'){
		if (
		  // Decalage de l'ensemble colateral droit
		  spip_query("UPDATE spip_forms_donnees SET bdte=bdte+2 WHERE id_form="._q($id_form)." AND bdte>"._q($rowp['bdte'])." AND bgch<="._q($rowp['bdte']))
		  AND spip_query("UPDATE spip_forms_donnees SET bgch=bgch+2,bdte=bdte+2 WHERE id_form="._q($id_form)." AND bgch>"._q($rowp['bdte']))
			// Decalalage ensemble vise vers le bas
		  AND spip_query("UPDATE spip_forms_donnees SET bgch=bgch+1,bdte=bdte+1,niveau=niveau+1 WHERE id_form="._q($id_form)." AND bgch>="._q($rowp['bgch'])." AND bdte<="._q($rowp['bdte']))
		)
			// Insertion du nouveau pere
			return Forms_creer_donnee($id_form,$c,array('niveau'=>$rowp['niveau'],'bgch'=>$rowp['bgch'],'bdte'=>$rowp['bdte']+2));
	}
	// Insertion d'un grand frere
	elseif ($position == 'grand_frere'){
		if (
		  // Decalage de l'ensemble colateral droit
		  spip_query("UPDATE spip_forms_donnees SET bdte=bdte+2 WHERE id_form="._q($id_form)." AND bdte>"._q($rowp['bgch'])." AND bgch<"._q($rowp['bgch']))
		  AND spip_query("UPDATE spip_forms_donnees SET id_form="._q($id_form)." AND bgch=bgch+2,bdte=bdte+2 WHERE bgch>="._q($rowp['bgch']))
		  )
			return Forms_creer_donnee($id_form,$c,array('niveau'=>$rowp['niveau'],'bgch'=>$rowp['bgch'],'bdte'=>$rowp['bgch']+1));
	}
	// Insertion d'un petit frere
	elseif ($position == 'petit_frere'){
		if (
		  // Decalage de l'ensemble colateral droit
		  spip_query("UPDATE spip_forms_donnees SET bdte=bdte+2 WHERE id_form="._q($id_form)." AND bdte>"._q($rowp['bdte'])." AND bgch<"._q($rowp['bdte']))
		  AND spip_query("UPDATE spip_forms_donnees SET bgch=bgch+2,bdte=bdte+2 WHERE id_form="._q($id_form)." AND bgch>="._q($rowp['bdte']))
		  )
			return Forms_creer_donnee($id_form,$c,array('niveau'=>$rowp['niveau'],'bgch'=>$rowp['bdte']+1,'bdte'=>$rowp['bdte']+2));
	}
	// Insertion d'un fils aine
	elseif ($position == 'fils_aine'){
		if (
		  // Decalage de l'ensemble colateral droit
		  spip_query("UPDATE spip_forms_donnees SET bdte=bdte+2 WHERE id_form="._q($id_form)." AND bdte>"._q($rowp['bgch'])." AND bgch<="._q($rowp['bgch']))
		  AND spip_query("UPDATE spip_forms_donnees SET bgch=bgch+2,bdte=bdte+2 WHERE id_form="._q($id_form)." AND bgch>"._q($rowp['bgch']))
		  )
			return Forms_creer_donnee($id_form,$c,array('niveau'=>$rowp['niveau']+1,'bgch'=>$rowp['bgch']+1,'bdte'=>$rowp['bgch']+2));
	}
	// Insertion d'un fils aine
	elseif ($position == 'fils_cadet'){
		if (
		  // Decalage de l'ensemble colateral droit
		  spip_query("UPDATE spip_forms_donnees SET bdte=bdte+2 WHERE id_form="._q($id_form)." AND bdte>="._q($rowp['bdte'])." AND bgch<="._q($rowp['bdte']))
		  AND spip_query("UPDATE spip_forms_donnees SET bgch=bgch+2,bdte=bdte+2 WHERE id_form="._q($id_form)." AND bgch>"._q($rowp['bdte']))
		  )
			return Forms_creer_donnee($id_form,$c,array('niveau'=>$rowp['niveau']+1,'bgch'=>$rowp['bdte'],'bdte'=>$rowp['bdte']+1));
	}
	spip_log("Operation inconnue insertion en position $position dans table $id_form");
	return array(0,_L("Operation inconnue insertion en position $position dans table $id_form"));
}
function Forms_arbre_supprimer_donnee($id_form,$id_donnee,$recursif=true){
	$res = spip_query("SELECT * FROM spip_forms_donnees WHERE id_form="._q($id_form)." AND id_donnee="._q($id_donnee));
	if (!($row = spip_fetch_array($res)))
		return false;
	if ($recursif){
		// OUI ! tout le sous arbre doit etre supprime
		$delta = $row['bdte']-$row['bgch']+1;
		$res2 = spip_query("SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form)." AND bgch>="._q($row['bgch'])." AND bdte<="._q($row['bdte']));
		$ok = true;
		while ($row2 = spip_fetch_array($res2))
			$ok = $ok && Forms_supprimer_donnee($id_form,$row2['id_donnee']);
		
		if (
			spip_query("UPDATE spip_forms_donnees SET bgch=bgch-$delta,bdte=bdte-$delta WHERE id_form="._q($id_form)." AND bgch>"._q($row['bdte']))
			AND spip_query("UPDATE spip_forms_donnees SET bdte=bdte-$delta WHERE id_form="._q($id_form)." AND bdte>"._q($row['bdte'])." AND bgch<="._q($row['bdte']))
			)
			return true;
		return false;
	}
	else {
		// NON ! on ne supprime que l'element
		if (
		  Forms_supprimer_donnee($id_form,$id_donnee)
		  AND spip_query("UPDATE spip_forms_donnees SET bgch=bgch-1,bdte=bdte-1,niveau=niveau-1 WHERE id_form="._q($id_form)." AND bdte<"._q($row['bdte'])." AND bgch>"._q($row['bgch']))
		  AND spip_query("UPDATE spip_forms_donnees SET bgch=bgch-2,bdte=bdte-2 WHERE id_form="._q($id_form)." AND bgch>"._q($row['bdte']))
		  AND spip_query("UPDATE spip_forms_donnees SET bdte=bdte-2 WHERE id_form="._q($id_form)." AND bdte>"._q($row['bdte'])." AND bgch<="._q($row['bdte']))
		  )
			return true;
		return false;
	}
}
function Forms_arbre_liste_relations($id_form,$id_parent,$position="enfant"){
	$liste = array();
	if ($id_parent){
		$res = spip_query("SELECT id_donnee,niveau,bgch,bdte FROM spip_forms_donnees WHERE id_donnee="._q($id_parent)." AND id_form="._q($id_form));
		if (!$row = spip_fetch_array($res)) return $liste;
		$niveau = $row['niveau'];
		$bgch = $row['bgch'];
		$bdte = $row['bdte'];
		
		if ($position=='enfant' || $position=='branche') {
			$res = spip_query( 
			  "SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form)
			  . " AND bgch>"._q($bgch)." AND bdte<"._q($bdte)
			  . ($position=='enfant'?" AND niveau="._q($niveau+1):"")
			  . " ORDER BY bgch"
			);
		}
		elseif ($position=='grand_frere') {
			$res = spip_query(
			  "SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form)
			  . " AND bdte<"._q($bgch)
			  . " AND niveau="._q($niveau)
			  . " ORDER BY bgch"
			);
		}
		elseif ($position=='petit_frere') {
			$res = spip_query(
			  "SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form)
			  . " AND bgch>"._q($bdte)
			  . " AND niveau="._q($niveau)
			  . " ORDER BY bgch"
			);
		}
		elseif ($position=='parent' || position=='hierarchie') {
			$res = spip_query(
			  "SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form)
			  . " AND bgch<"._q($bgch)." AND bdte>"._q($bdte)
			  . ($position=='parent'?" AND niveau="._q($niveau-1):"")
			  . " ORDER BY bgch"
			);
		}

	}
	else {
		if ($position!='enfant' && $position!='branche') return $liste;
		$res = spip_query(
		  "SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form)
		  . ($position=='enfant'?" AND niveau=1":"")
		  . " ORDER BY bgch"
		);
	}
	while ($row = spip_fetch_array($res))
		$liste[] = $row['id_donnee'];
	return $liste;
}

?>