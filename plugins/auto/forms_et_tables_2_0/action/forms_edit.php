<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * 2005,2006 - Distribue sous licence GNU/GPL
 *
 */
include_spip('inc/forms');
include_spip('inc/forms_edit');
include_spip('inc/forms_type_champs');
if (!include_spip('inc/autoriser'))
	include_spip('inc/autoriser_compat');
// TODO : charger la bonne langue !
function Forms_ordonne_champs($id_form){
	if (strlen($ordre = _request('ordre'))){
		$ordre = explode("&",$ordre);
		$rang = 1;$ok = true;
		$replace = "";
		foreach($ordre as $item){
			$item = explode("=",$item);
			$item = explode("-",$item[1]);
			array_shift($item);
			if (($c=array_shift($item))!=$id_form) $ok=false;
			$champ = implode("-",$item);
			$update[]="UPDATE spip_forms_champs SET rang="._q($rang++)." WHERE id_form="._q($id_form)." AND champ="._q($champ);
		}
		if ($ok)
			foreach($update as $q)
				spip_query($q);
	}
}

function Forms_update_edition_champ($id_form,$champ) {
	$res = spip_query("SELECT * FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ="._q($champ));
	if ($row = spip_fetch_array($res)){
		$type = $row['type'];
		$extra_info = "";
		if ($type == 'texte')
			if ($champ_barre_typo=_request('champ_barre_typo')) $extra_info = $champ_barre_typo;
		if ($type == 'monnaie')
			if ($unite=_request('unite_monetaire')!==NULL) $extra_info = $unite;
		if ($type == 'url')
			if ($champ_verif=_request('champ_verif')) $extra_info = $champ_verif;
		if ($type == 'mot') {
			if ($id_groupe = intval(_request("groupe_$champ")))
				$extra_info = $id_groupe;
		}
		if ($type == 'joint') {
			if ($type_table = _request('type_table'))
				$extra_info = $type_table;
		}
		if ($type == 'fichier') {
			$extra_info = intval(_request('taille_champ'));
		}
		if ($type=='select'){
			$extra_info = _request('format_liste');
		}
		if ($type == 'password')
			if ($champ_confirmer_pass=_request('champ_confirmer_pass')) $extra_info = $champ_confirmer_pass;
		$extra_info = pipeline('forms_update_edition_champ',array('args'=>array('row'=>$row),'data'=>$extra_info));
		spip_query("UPDATE spip_forms_champs SET extra_info="._q($extra_info)." WHERE id_form="._q($id_form)." AND champ="._q($champ));
		if ($type == 'select' || $type == 'multiple') {
			$res2 = spip_query("SELECT choix FROM spip_forms_champs_choix WHERE id_form="._q($id_form)." AND champ="._q($champ));
			while ($row2 = spip_fetch_array($res2)){
				if (($titre = _request($row2['choix'])) !== FALSE)
					spip_query("UPDATE spip_forms_champs_choix SET titre="._q($titre)." WHERE id_form="._q($id_form)." AND champ="._q($champ)." AND choix="._q($row2['choix']));
			}
			if (strlen($ordre = _request('ordre'))){
				$ordre = explode("&",$ordre);
				$rang = 1;$ok = true;
				$replace = "";
				foreach($ordre as $item){
					$item = explode("=",$item);
					$item = explode("-",$item[1]);
					if (($c=array_shift($item))!=$champ) $ok=false;
					$choix = implode("-",$item);
					$update[]="UPDATE spip_forms_champs_choix SET rang="._q($rang++)." WHERE id_form="._q($id_form)." AND champ="._q($champ)." AND choix="._q($choix);
				}
				if ($ok)
					foreach($update as $q)
						spip_query($q);
			}
		}
	}
}

function Forms_update($id_form){
	$titre = _request('titre');
	$descriptif = _request('descriptif');
	$email = _request('email');
	$champconfirm = _request('champconfirm');
	$texte = _request('texte');
	$type_form = _request('type_form');
	$modifiable = _request('modifiable');
	$multiple = _request('multiple');
	$forms_obligatoires = _request('forms_obligatoires');
	$moderation = _request('moderation');
	$public = _request('public');
	$linkable = _request('linkable');
	$documents = _request('documents');
	$documents_mail = _request('documents_mail');
	$html_wrap = _request('html_wrap');

	$modif_champ = _request('modif_champ');
	$ajout_champ = _request('ajout_champ');
	$nom_champ = _request('nom_champ');
	$champ_obligatoire = _request('champ_obligatoire');
	$champ_public = _request('champ_public');
	$champ_specifiant = _request('champ_specifiant');
	$champ_listable_admin = _request('champ_listable_admin');
	$champ_listable = _request('champ_listable');
	$champ_saisie = _request('champ_saisie');
	$taille_champ = _request('taille_champ');
	$aide_champ = _request('aide_champ');
	$wrap_champ = _request('wrap_champ');
	$supp_choix = _request('supp_choix');
	$supp_champ = _request('supp_champ');
	$ordonne_champs = _request('ordonne_champs');

	//
	// Modifications des donnees de base du formulaire
	//

	$nouveau_champ = $champ_visible = $ajout_choix = NULL;
	// creation
	if ($id_form == 'new' && $titre) {
		//adapatation SPIP2
		//spip_query("INSERT INTO spip_forms (titre) VALUES ("._q($titre).")");
		//$id_form = spip_insert_id();

		$id_form = sql_insertq('spip_forms',array('titre'=>_q($titre)));
	}
	// maj
	if (intval($id_form) && $titre) {
		$query = "UPDATE spip_forms SET ".
			"titre="._q($titre).", ".
			"descriptif="._q($descriptif).", ".
			"type_form="._q($type_form).", ".
			"modifiable="._q($modifiable).", ".
			"multiple="._q($multiple).", ".
			"forms_obligatoires="._q($forms_obligatoires).", ".
			"email="._q(serialize($email)).", ".
			"champconfirm="._q($champconfirm).", ".
			"texte="._q($texte).", ".
			"moderation="._q($moderation).", ".
			"public="._q($public).", ".
			"linkable="._q($linkable?$linkable:'non').", ".
			"documents="._q($documents?$documents:'non').", ".
			"documents_mail="._q($documents_mail?$documents_mail:'non').", ".
			"html_wrap="._q($html_wrap)." ".
			"WHERE id_form="._q($id_form);
		$result = spip_query($query);
	}
	// lecture
	$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form));
	if ($row = spip_fetch_array($result)) {
		$id_form = $row['id_form'];
		$titre = $row['titre'];
		$descriptif = $row['descriptif'];
		$type_form = $row['type_form'];
		$modifiable = $row['modifiable'];
		$multiple = $row['multiple'];
		$forms_obligatoires = $row['forms_obligatoires'];
		$moderation = $row['moderation'];
		$public = $row['public'];
		$linkable = $row['linkable'];
		$documents = $row['documents'];
		$documents_mail = $row['documents_mail'];
		$email = unserialize($row['email']);
		$champconfirm = $row['champconfirm'];
		$html_wrap = $row['html_wrap'];
		$texte = $row['texte'];
	}

	if ($id_form) {
		$champ_visible = NULL;
		// Ajout d'un champ
		if (($type = $ajout_champ) && Forms_type_champ_autorise($type)) {
			$titre = _T("forms:nouveau_champ");
			include_spip('inc/charsets');
			$titre = unicode2charset(html2unicode($titre));
			$champ = Forms_insere_nouveau_champ($id_form,$type,$titre);
			$champ_visible = $nouveau_champ = $champ;
		}
		// Modif d'un champ
		if ($champ = $modif_champ) {
			if ($row = spip_fetch_array(spip_query("SELECT * FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ="._q($champ)))) {
				if (_request('switch_select_multi')){
					if ($row['type']=='select') $newtype = 'multiple';
					if ($row['type']=='multiple') $newtype = 'select';
					$newchamp = Forms_nouveau_champ($id_form,$newtype);
					spip_query("UPDATE spip_forms_champs SET type="._q($newtype).", champ="._q($newchamp)." WHERE id_form="._q($id_form)." AND champ="._q($champ));
					spip_query("UPDATE spip_forms_champs_choix SET champ="._q($newchamp)." WHERE id_form="._q($id_form)." AND champ="._q($champ));
					$champ = $newchamp;
					$champ_visible = $champ;
				}
				else {
					spip_query("UPDATE spip_forms_champs SET titre="._q($nom_champ).", obligatoire="._q($champ_saisie=='non'?'non':$champ_obligatoire)
						.", specifiant="._q($champ_specifiant)
						.", listable="._q($champ_listable).", listable_admin="._q($champ_listable_admin)
						.", public="._q($champ_public).", saisie="._q($champ_saisie=='non'?'non':'oui')
						.($taille_champ!==NULL?", taille="._q($taille_champ):"")
						.", aide="._q($aide_champ).", html_wrap="._q($wrap_champ)." WHERE id_form="._q($id_form)." AND champ="._q($champ));
					Forms_update_edition_champ($id_form, $champ);
					// switch select to multi ou inversement, apres avoir fait les mises a jour
				}
				if (_request('ajout_choix')) {
					$titre = _T("forms:nouveau_choix");
					include_spip('inc/charsets');
					$titre = unicode2charset(html2unicode($titre));
					$ajout_choix = Forms_insere_nouveau_choix($id_form,$champ,$titre);
				}
			}
		}
		// Cas particulier : suppression d'un choix
		// hum (id_form,choix) est il unique ? oui
		if ($choix = $supp_choix){
			if ($row = spip_fetch_array(spip_query("SELECT champ FROM spip_forms_champs_choix WHERE id_form="._q($id_form)." AND choix="._q($choix)))) {
				spip_query("DELETE FROM spip_forms_champs_choix WHERE choix="._q($choix)." AND id_form="._q($id_form)." AND champ="._q($row['champ']));
			}
		}
		// Suppression d'un champ
		if ($champ = $supp_champ) {
			spip_query("DELETE FROM spip_forms_champs_choix WHERE id_form="._q($id_form)." AND champ="._q($champ));
			spip_query("DELETE FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ="._q($champ));
		}
		if ($id_form==intval($ordonne_champs)){
			Forms_ordonne_champs($id_form);
		}
	}
	return array($id_form,$champ_visible,$nouveau_champ,$ajout_choix);
}

function action_forms_edit(){
	global $auteur_session;
	$arg = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = str_replace("&amp;","&",urldecode(_request('redirect')));
	//$redirect = parametre_url($redirect,'var_ajaxcharset',''); // si le redirect sert, pas d'ajax !
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_edit-$arg",$hash,$id_auteur)==TRUE) {
		$arg=explode("-",$arg);
		$id_form = $arg[0];
		if ((intval($id_form) && autoriser('modifier','form',$id_form))
			|| (($id_form=='new') && (autoriser('creer','form'))) ) {
			list($id_form,$champ_visible,$nouveau_champ,$ajout_choix) = Forms_update($id_form);
			if ($redirect) $redirect = parametre_url($redirect,"id_form",$id_form);
			if ($redirect && $champ_visible) $redirect = parametre_url($redirect,"champ_visible",$champ_visible);
			if ($redirect && $nouveau_champ) $redirect = parametre_url($redirect,"nouveau_champ",$nouveau_champ);
			if ($redirect && $ajout_choix) $redirect = parametre_url($redirect,"ajout_choix",$ajout_choix);
		}
	}

	// JES adaptation du plugin à SPIP2, suppression de la fonction urldecode sur le parametre 'redirect'

	if ($redirect)
		redirige_par_entete(str_replace("&amp;","&",$redirect));
}

?>