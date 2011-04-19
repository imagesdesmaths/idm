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
	
	
	if ($GLOBALS['spip_version_code']<1.92)
		include_spip('inc/forms_compat_191');
	/* adaptation SPIP2 */
	elseif ($GLOBALS['spip_version_code']>2)	
		include_spip("inc/xml");
  /* fin adaptation SPIP2 */

	function _Forms_install(){
		if ($GLOBALS['spip_version_code']<1.9204){
			include_spip('base/forms_upgrade');
			Forms_upgrade();
		}
	}
	
	function Forms_structure($id_form, $complete = true){
		include_spip('inc/texte'); # typo et textebrut
		// Preparer la table de traduction code->valeur & mise en table de la structure pour eviter des requettes
		// a chaque ligne
		$structure = array();
		$res = spip_query("SELECT * FROM spip_forms_champs WHERE id_form="._q($id_form)." ORDER BY rang");
		while ($row = spip_fetch_array($res)){
			$type = $row['type'];
			$champ = $row['champ'];
			foreach ($row as $k=>$v)
				$structure[$champ][$k] = $v;
			if ($complete){
				if (($type == 'select') OR ($type == 'multiple')){
					$res2 = spip_query("SELECT * FROM spip_forms_champs_choix WHERE id_form="._q($id_form)." AND champ="._q($champ)." ORDER BY rang");
					while ($row2 = spip_fetch_array($res2)){
						$structure[$champ]['choix'][$row2['choix']] = $c = trim(textebrut(typo($row2['titre'])));
						$structure[$champ]['choixrev'][$c] = $row2['choix'];
					}
				}
				else if ($type == 'mot') {
					$id_groupe = intval($row['extra_info']);
					$res2 = spip_query("SELECT id_mot, titre FROM spip_mots WHERE id_groupe="._q($id_groupe));
					while ($row2 = spip_fetch_array($res2)) {
						$structure[$champ]['choix'][$row2['id_mot']] = $c = trim(textebrut(typo($row2['titre'])));
						$structure[$champ]['choixrev'][$c] = $row2['id_mot'];
					}
				}
			}
		}
		return $structure;
	}
	function Forms_valeurs($id_donnee,$id_form = NULL,$champ=NULL){
		static $unseul = array();
		$valeurs = array();
		if ($id_form===NULL){
			$res = spip_query("SELECT id_form FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
			if( !$row = spip_fetch_array($res)) return $valeurs;
			$id_form = $row['id_form'];
		}
		$selchamp = "";
		if ($champ!==NULL) $selchamp = "d.champ="._q($champ)." AND";
		$res = spip_query("SELECT * FROM spip_forms_donnees_champs AS d JOIN spip_forms_champs AS c ON c.champ=d.champ AND c.id_form="._q($id_form)." WHERE $selchamp d.id_donnee="._q($id_donnee));
		while ($row = spip_fetch_array($res)){
			if ($row['type']=='multiple')
				$valeurs[$row['champ']][]= $row['valeur'];
			elseif ($row['type']=='mot'){
				$id_groupe = intval($row['extra_info']);
				if (!isset($unseul[$id_groupe])){
					$res2 = spip_query("SELECT unseul FROM spip_groupes_mots WHERE id_groupe="._q($id_groupe));
					$row2=spip_fetch_array($res2);
					$unseul[$id_groupe] = $row2['unseul'];
				}
				if ($unseul[$id_groupe]=='oui')
					$valeurs[$row['champ']]= $row['valeur'];
				else
					$valeurs[$row['champ']][]= $row['valeur'];
			}
			else
				$valeurs[$row['champ']]= $row['valeur'];
		}
		return $valeurs;
	}

	function Forms_donnees_vide($id_form){
		if (!include_spip('inc/autoriser'))
			include_spip('inc/autoriser_compat');
		// on teste si autorisation en masse
		if (autoriser('supprimer','donnee',0,NULL,array('id_form'=>$id_form)))
			spip_query("UPDATE spip_forms_donnees SET statut='poubelle' WHERE id_form="._q($id_form));
		// sinon, on teste une par une
		else {
			$res = spip_query("SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form));
			while ($row = spip_fetch_array($res)){
				if (autoriser('supprimer','donnee',$row['id_donnee'],NULL,array('id_form'=>$id_form)))
					spip_query("UPDATE spip_forms_donnees SET statut='poubelle' WHERE id_donnee="._q($row['id_donnee']));
			}
		}
	}

	function forms_type_table_lier($type,$id){
		$type_table = 'table';
		if ($type == 'donnee' AND preg_match(",^(-?[0-9]+)-([a-z_0-9]+)-([0-9]+)$,",$id,$reg)){
			$id_donnee_source = $reg[1];
			$champ = $reg[2];
			$id_form = $reg[3];
			$res = spip_query("SELECT extra_info FROM spip_forms_champs WHERE id_form="._q($id_form)." AND champ="._q($champ));
			if($row = spip_fetch_array($res))
				$type_table = $row['extra_info'];
		}
		return $type_table;
	}
	function forms_prefixi18n($type_table){
		$prefixi18n = in_array($type_table,array('sondage',''))?'form':$type_table;
		return $prefixi18n = str_replace("_","",strtolower($prefixi18n));
	}
	function Forms_csvimport_ajoute_table_csv($data, $id_form, $assoc_field, &$erreur, $simu = false){
		include_spip('inc/forms_type_champs');
		$assoc = array_flip($assoc_field);
		$res = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form)." AND type_form NOT IN ('','sondage')");
		if (!$row = spip_fetch_array($res)) {
			$erreur[0][] = _L("Table introuvable");
			return;
		}

		$structure = Forms_structure($id_form);
		$cle = (isset($assoc_field['id_donnee']) AND ($assoc_field['id_donnee']!='-1'))?$assoc_field['id_donnee']:false;
		$output = "";
		if ($data!=false){
			$count_lignes = 0;
			foreach($data as $key=>$ligne) {
	      $count_lignes ++;
				// creation de la donnee si necessaire
				$creation = true;
				$cle_libre = true;
				$id_donnee = 0;
				// verifier la validite de l'import
				$c = array();
				foreach($structure as $champ=>$infos){
					if ($infos['type'] != 'multiple'){
						$c[$champ] = "";
					  if ((isset($assoc[$champ]))&&(isset($ligne[$assoc[$champ]]))){
					  	$c[$champ] = $ligne[$assoc[$champ]];
					  	if (isset($infos['choix']) && !isset($infos['choix'][$c[$champ]]) && isset($infos['choixrev'][$c[$champ]]))
					  		$c[$champ] = $infos['choixrev'][$c[$champ]];
					  }
					}
					else {
						$c[$champ] = array();
						foreach($infos['choix'] as $choix=>$t)
						  if ((isset($assoc[$choix]))&&(isset($ligne[$assoc[$choix]])))
						  	if (strlen($ligne[$assoc[$choix]]))
						  		$c[$champ][] = $choix;
					}
		 		}
		 		$err = Forms_valide_champs_reponse_post($id_auteur, $id_donnee, $c , $structure);
		 		if (is_array($err) && count($err)) $erreur[$count_lignes] = $err;
		 		else if (!$simu) {
					if ($cle) {
						$id_donnee = $ligne[$cle];
						$res = spip_query("SELECT id_form,statut FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
						if ($row = spip_fetch_array($res) AND ($cle_libre = ($row['id_form']==$id_form))){
							$creation = false;
							$set = "";
							foreach(array('date','url','ip','id_auteur') as $champ)
								if (isset($assoc_field[$champ])) $set .= "$champ="._q($ligne[$assoc_field['date']]).", ";
							$set.=" maj=NOW()";
							if ($row['statut']=='poubelle')
								$set .= ", statut = 'publie'";
							spip_query("UPDATE spip_forms_donnees SET $set WHERE id_donnee="._q($id_donnee)." AND id_form="._q($id_form));
						}
					}
					if ($creation){
						$id_auteur = $GLOBALS['auteur_session'] ? intval($GLOBALS['auteur_session']['id_auteur']) : 0;
						$ip = $GLOBALS['REMOTE_ADDR'];
						$url = _DIR_RESTREINT_ABS;
						if ($cle AND $cle_libre){
							if (intval($id_donnee))
								//adapatation SPIP2
								//spip_abstract_insert("spip_forms_donnees","(id_donnee,id_form,date,ip,id_auteur,url,confirmation,statut,maj)","("._q($id_donnee).","._q($id_form).", NOW(),"._q($ip).","._q($id_auteur).","._q($url).", 'valide', 'publie', NOW() )");
								$id_donnee = sql_insert("spip_forms_donnees","(id_donnee,id_form,date,ip,id_auteur,url,confirmation,statut,maj)","("._q($id_donnee).","._q($id_form).", NOW(),"._q($ip).","._q($id_auteur).","._q($url).", 'valide', 'publie', NOW() )");
						}
						else
						{
							//adaptation SPIP2
							//spip_abstract_insert("spip_forms_donnees","(id_form,date,ip,id_auteur,url,confirmation,statut,maj)","("._q($id_form).", NOW(),"._q($ip).","._q($id_auteur).","._q($url).", 'valide', 'publie', NOW() )");
							$id_donnee = sql_insert("spip_forms_donnees","(id_form,date,ip,id_auteur,url,confirmation,statut,maj)","("._q($id_form).", NOW(),"._q($ip).","._q($id_auteur).","._q($url).", 'valide', 'publie', NOW() )");
						}
						//$id_donnee = spip_insert_id();
					}
					if ($id_donnee){
						foreach($c as $champ=>$values){
						  	if (!$creation)
						  		spip_query("DELETE FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($champ));
						  	if (!is_array($values)) $values = array($values);
						  	foreach($values as $v)
						  		if (strlen($v))
						  			spip_query("INSERT INTO spip_forms_donnees_champs (id_donnee,champ,valeur,maj) VALUES ("._q($id_donnee).","._q($champ).","._q($v).", NOW() )");
				 		}
					}
					else
					  $erreur[$count_lignes][] = "ajout impossible ::id_donnee nul::<br />";
		 		}
			}
		}
	}

	function Forms_deplacer_fichier_form($source, $dest) {
		/* le core interdit l'upload depuis l'espace prive... pourquoi tant de haine ?
		include_spip('inc/getdocument');
		if ($ok = deplacer_fichier_upload($source, $dest, true))
			if (file_exists($source)) // argument move pas pris en compte avant spip 1.9.2
				@unlink($source);*/
		$ok = @rename($source, $dest);
		if (!$ok) $ok = @move_uploaded_file($source, $dest);
		if ($ok)
			@chmod($dest, _SPIP_CHMOD & ~0111);
		else {
			$f = @fopen($dest,'w');
			if ($f) {
				fclose ($f);
			} else {
				include_spip('inc/headers');
				redirige_par_entete(generer_url_action("test_dirs", "test_dir=". dirname($dest), true));
			}
			@unlink($dest);
		}
		return $ok;
	}

	function Forms_nommer_fichier_form($orig, $dir) {
		include_spip("inc/charsets");
		include_spip("inc/filtres");
		if (preg_match(",^(.*)\.([^.]+)$,", $orig, $match)) {
			$ext = strtolower($match[2]);
			$orig = $match[1];
		}
		// pas de . dans le nom du fichier pour eviter .php.txt
		$base = preg_replace(",[^a-zA-Z0-9_=-]+,", "_",
			translitteration(supprimer_tags(basename($orig))));
		$n = 0;
		$fichier = $base.'.'.$ext;
		while (@file_exists($dir . $fichier)) {
			$fichier = $base.'-'.(++$n).'.'.$ext;
		}
		return $fichier;
	}

	function Forms_type_fichier_autorise($nom_fichier) {
		if (preg_match(",\.([^.]+)$,", $nom_fichier, $match)) {
			$ext = addslashes(strtolower($match[1]));
			switch ($ext) {
			case 'htm':
				$ext = 'html';
				break;
			case 'jpeg':
				$ext = 'jpg';
				break;
			case 'tiff':
				$ext = 'tif';
				break;
			}
			$query = "SELECT * FROM spip_types_documents WHERE extension='".addslashes($ext)."' AND upload='oui'";
			$result = spip_query($query);
			/*return (spip_num_rows($result) > 0);*/
			return (sql_count($result) > 0);
		}
		return false;
	}

	// Fonction utilitaires
	function Forms_nom_cookie_form($id_form) {
		return $GLOBALS['cookie_prefix'].'cookie_form_'.$id_form;
	}

	function Forms_verif_cookie_sondage_utilise($id_form) {
		global $auteur_session;
		$id_auteur = $auteur_session ? intval($auteur_session['id_auteur']) : 0;
		$cookie = $_COOKIE[Forms_nom_cookie_form($id_form)];
		$q="SELECT id_donnee FROM spip_forms_donnees " .
			"WHERE statut='publie' AND id_form=".intval($id_form)." ";
		$q .= "AND (";
		if ($cookie) {
			$q.="cookie="._q($cookie). ($id_auteur?" OR id_auteur="._q($id_auteur):"");
		}
		else if ($id_auteur)
				$q.="id_auteur="._q($id_auteur);
			else
				return false;
		$q .= ')';
		//On retourne le tableau des id_donnee de l'auteur ou false
		$res = spip_query($q);
		//adapation SPIP2
		//if ($res && spip_num_rows($res)>0) {
		if ($res && sql_count($res)>0) {
			while ($row=spip_fetch_array($res))
				$tab[]=$row['id_donnee'];
			return $tab;
		}
		else return false;
	}

	function Forms_extraire_reponse($id_donnee){
		// Lire les valeurs entrees
		//adaptation SPIP2
		//if (substr(spip_mysql_version(), 0, 1) == 3) {
		if (substr(sql_version(), 0, 1) == 3) {
			$result = spip_query("SELECT * FROM spip_forms_donnees_champs  AS r, spip_forms_champs AS ch, spip_forms_donnees AS d
			WHERE ch.champ=r.champ AND d.id_donnee = r.id_donnee AND d.id_form = ch.id_form AND r.id_donnee="._q($id_donnee)." ORDER BY ch.rang");
		}
		else {
			$result = spip_query("SELECT * FROM spip_forms_donnees_champs AS r
				JOIN spip_forms_champs AS ch ON ch.champ=r.champ
				JOIN spip_forms_donnees AS d ON d.id_donnee = r.id_donnee
				WHERE d.id_form = ch.id_form AND r.id_donnee="._q($id_donnee)." ORDER BY ch.rang");
		}
		$valeurs = array();
		$retour = urlencode(self());
		$libelles = array();
		$values = array();
		$url = array();
		while ($row = spip_fetch_array($result)) {
			$rang = $row['rang'];
			$champ = $row['champ'];
			$libelles[$champ]=$row['titre'];
			$type = $row['type'];
			if ($type == 'fichier') {
				$values[$champ][] = $row['valeur'];
				$url[$champ][] = generer_url_ecrire("forms_telecharger","id_donnee=$id_donnee&champ=$champ&retour=$retour");
			}
			else if (in_array($type,array('select','multiple'))) {
				if ($row3=spip_fetch_array(spip_query("SELECT titre FROM spip_forms_champs_choix WHERE id_form="._q($row['id_form'])." AND champ="._q($champ)." AND choix="._q($row['valeur']))))
					$values[$champ][]=$row3['titre'];
				else
					$values[$champ][]= $row['valeur'];
				$url[$champ][] = '';
			}
			else if ($type == 'mot') {
				$id_groupe = intval($row['extra_info']);
				$id_mot = intval($row['valeur']);
				if ($row3 = spip_fetch_array(spip_query("SELECT id_mot, titre FROM spip_mots WHERE id_groupe="._q($id_groupe)." AND id_mot="._q($id_mot)))){
					$values[$champ][]=$row3['titre'];
					$url[$champ][]= generer_url_ecrire("mots_edit","id_mot=$id_mot");
				}
				else {
					$values[$champ][]= $row['valeur'];
					$url[$champ][] = '';
				}
			}
			else {
				$values[$champ][] = $row['valeur'];
				$url[$champ][] = '';
			}
		}
		return array($libelles,$values,$url);
	}

	//
	// Afficher un pave formulaires dans la colonne de gauche
	// (edition des articles)

	function Forms_afficher_insertion_formulaire($id_article) {
		global $connect_id_auteur, $connect_statut;
		global $couleur_foncee, $couleur_claire, $options;
		global $spip_lang_left, $spip_lang_right;

		$s = "";
		// Ajouter un formulaire

		$out = "";
		$out .= "<div class='verdana2'>";
		$out .= _T("forms:article_inserer_un_formulaire_detail");
		$out .= "</div>";

		$query = "SELECT id_form, titre FROM spip_forms ORDER BY titre";
		$result = spip_query($query);
		//ADAPATATION SPIP 2
		//if (spip_num_rows($result)) {
		if (sql_count($result)) {
			$out .= "<br />\n";
			$out .= "<div class='bandeau_rubriques' style='z-index: 1;'>";
			$out .= "<div class='plan-articles'>";
			while ($row = spip_fetch_array($result)) {
				$id_form = $row['id_form'];
				$titre = typo($row['titre']);

				$link = generer_url_ecrire('forms_edit',"id_form=$id_form&retour=".urlencode(self()));
				$out .= "<a href='".$link."'>";
				$out .= $titre."</a>\n";
				$out .= "<div class='arial1' style='text-align:$spip_lang_right;color: black; padding-$spip_lang_left: 4px;' "."title=\""._T("forms:article_recopier_raccourci")."\">";
				$out .= "<strong>&lt;form".$id_form."&gt;</strong>";
				$out .= "</div>";
			}
			$out .= "</div>";
			$out .= "</div>";
		}

		// Creer un formulaire
		if (!include_spip('inc/autoriser'))
			include_spip('inc/autoriser_compat');
		if (autoriser('creer','form')) {
			$out .= "\n<br />";
			$link = generer_url_ecrire('forms_edit',"new=oui&retour=".urlencode(self()));
			$out .= icone_horizontale(_T("forms:icone_creer_formulaire"),
				$link, _DIR_PLUGIN_FORMS."img_pack/form-24.png", "creer.gif", false);
		}

		if (version_compare($GLOBALS['spip_version_code'],'1.9250','>')){
			$s .= cadre_depliable(_DIR_PLUGIN_FORMS."img_pack/form-24.png",_T("forms:article_inserer_un_formulaire"),true,$out,"ajouter_form");
		}
		else {
			$s .= "\n";
			$s .= debut_cadre_relief(_DIR_PLUGIN_FORMS."img_pack/form-24.png", true);

			$s .= "<div style='padding: 2px; background-color: $couleur_claire; text-align: center; color: black;'>";
			$s .= bouton_block_depliable(false,"ajouter_form");
			$s .= "<strong class='verdana3' style='text-transform: uppercase;'>"
				._T("forms:article_inserer_un_formulaire")."</strong>";
			$s .= "</div>\n";

			$s .= debut_block_depliable(false,"ajouter_form");
			$s .= $out;
			$s .= fin_block();

			$s .= fin_cadre_relief(true);
		}

		return $s;
	}

	function Forms_insertions_reponse_un_champ($id_form,$id_donnee,$champ,$type,$val,&$erreur,&$ok){
		$inserts = array();
		if ($type == 'fichier') {
			if (($val = $_FILES[$champ]) AND ($val['tmp_name'])) {
				// Fichier telecharge : deplacer dans IMG, stocker le chemin dans la base
				$dir = sous_repertoire(_DIR_IMG, "protege");
				$dir = sous_repertoire($dir, "form".$id_form);
				$source = $val['tmp_name'];
				$dest = $dir.Forms_nommer_fichier_form($val['name'], $dir);
				if (!Forms_type_fichier_autorise($dest) OR !Forms_deplacer_fichier_form($source, $dest)) {
					$erreur[$champ] = _T("forms:probleme_technique_upload");
					$ok = false;
				}
				else {
					$inserts[] = "("._q($id_donnee).","._q($champ).","._q($dest).")";
				}
			}
			// Cas de la mise a jour pour laquelle on dispose deja d'un fichier uploade !
			elseif ( ($val=Forms_valeurs($id_donnee,$id_form,$champ)) != NULL ) {
				$inserts[] = "("._q($id_donnee).","._q($champ).","._q($val[$champ]).")";
			}
		}
		else if (is_array($val) OR strlen($val)) {
			// Choix multiples : enregistrer chaque valeur separement
			if (is_array($val))
				foreach ($val as $v){
					if (strlen($v))
						$inserts[] = "("._q($id_donnee).","._q($champ).","._q($v).")";
				}
			elseif (strlen($val))
				$inserts[] = "("._q($id_donnee).","._q($champ).","._q($val).")";
		}
		return $inserts;
	}

	function Forms_modifier_reponse($id_form,$id_donnee,&$erreur, $c = NULL, $structure = NULL){
		if (!$structure)	$structure = Forms_structure($id_form);
		$inserts = array();
		$champs_mod = array();
		$valeurs = array();
		$champs = array();
		foreach($structure as $champ=>$infos){
			if (!$c){
				if ($infos['type'] == 'fichier' AND isset($_FILES[$champ]['tmp_name']))
					$val = $_FILES[$champ];
				else
					$val = _request($champ);
			}
			else
				$val = isset($c[$champ])?$c[$champ]:NULL;
			if ($val!==NULL
				AND (($infos['type']!=='password') OR strlen($val))){
				$valeurs[$champ] = $val;
				$champs[$champ] = $infos;
			}
		}
		// Envoyer aux plugins
		$valeurs = pipeline('forms_pre_edition_donnee',
			array(
				'args' => array(
					'id_form' => $id_form,
					'id_donnee' => $id_donnee,
					'champs' => $champs
				),
				'data' => $valeurs
			)
		);
		foreach($valeurs as $champ=>$val){
			$champs_mod[] = $champ;
			// un plugin a pu ajouter un 'champ factice' a enregistrer, non defini dans la structure
			$type = isset($champs[$champ]['type'])?$champs[$champ]['type']:"";
			$ins = Forms_insertions_reponse_un_champ($id_form,$id_donnee,$champ,$type,$val,$erreur,$ok);
			$inserts = array_merge($inserts,$ins);
		}
		if (!count($erreur)){
			if (count($champs_mod)){
				include_spip('base/abstract_sql');
				$in_champs = calcul_mysql_in('champ',join(',',array_map('_q', $champs_mod)));
				spip_query("DELETE FROM spip_forms_donnees_champs WHERE $in_champs AND id_donnee="._q($id_donnee));
			}
			if (count($inserts)){
				spip_query($q="INSERT INTO spip_forms_donnees_champs (id_donnee, champ, valeur) ".
					"VALUES ".join(',', $inserts));
			}
			// Envoyer aux plugins apres enregistrement
			$valeurs = pipeline('forms_post_edition_donnee',
				array(
					'args' => array(
						'id_form' => $id_form,
						'id_donnee' => $id_donnee,
						'champs' => $champs
					),
					'data' => $valeurs
				)
			);
		}
		return count($inserts);
	}

	function Forms_revision_donnee($id_donnee, $c = NULL) {
		include_spip('base/abstract_sql');
		$inserts = array();
		$result = spip_query("SELECT id_form FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
		if (!$row = spip_fetch_array($result)) {
			$erreur['@'] = _T("forms:probleme_technique");
		}
		$id_form = $row['id_form'];
		$structure = Forms_structure($id_form);
		include_spip("inc/forms_type_champs");

		$erreur = Forms_valide_conformite_champs_reponse_post($id_form, $id_donnee, $c, $structure);
		if (!$erreur)
			Forms_modifier_reponse($id_form,$id_donnee,$erreur, $c, $structure);
		if (count($erreur))
			spip_log("erreur: ".serialize($erreur));

		return $erreur;
	}

	function Forms_rang_prochain($id_form){
		$rang = 1;
		$res = spip_query("SELECT max(rang) AS rang_max FROM spip_forms_donnees WHERE id_form="._q($id_form));
		if ($row = spip_fetch_array($res))
			$rang = $row['rang_max']+1;
		return $rang;
	}
	function Forms_rang_update($id_donnee,$rang_nouv){
		$rang_min = $rang_max = 1;
		// recuperer le rang et l'id_form de la donnee modifiee
		$res = spip_query("SELECT id_form,rang FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
		if (!$row = spip_fetch_array($res)) return;
		$rang = $row['rang'];
		$id_form = $row['id_form'];

		// recuperer le min et le max des rangs en cours
		$res = spip_query("SELECT min(rang) AS rang_min, max(rang) AS rang_max FROM spip_forms_donnees WHERE id_form="._q($id_form));
		if ($row = spip_fetch_array($res)){
			$rang_min = $row['rang_min'];
			$rang_max = $row['rang_max'];
		}

		// verifier si des donnees sont pas sans rang et les ramasser
		$res = spip_query("SELECT id_donnee, rang FROM spip_forms_donnees WHERE (rang=NULL OR rang=0) AND id_form="._q($id_form)." ORDER BY id_donnee");
		while ($row = spip_fetch_array($res)){
			$rang_max++;
			spip_query("UPDATE spip_forms_donnees SET rang=$rang_max WHERE id_donnee="._q($row['id_donnee']));
		}
		// borner le rang
		if ($rang_nouv==0) $rang_nouv = Forms_rang_prochain($id_form);
		$rang_nouv = min(max($rang_nouv,$rang_min),$rang_max);
		if ($rang_nouv>$rang) $rang_nouv++; // il faut se decaler d'un car on est devant actuellement
		$rang_nouv = min($rang_nouv,Forms_rang_prochain($id_form));

		// incrementer tous ceux dont le rang est superieur a la cible pour faire une place
		$ok = spip_query("UPDATE spip_forms_donnees SET rang=rang+1 WHERE id_form=$id_form AND rang>="._q($rang_nouv));
		if (!$ok) return $rang;
		// mettre a jour le rang de l'element demande
		$ok = spip_query("UPDATE spip_forms_donnees SET rang="._q($rang_nouv)." WHERE id_donnee=$id_donnee");
		if (!$ok) return $rang;

		// decrementer tous ceux dont le rang est superieur a l'ancien pour recuperer la place
		spip_query("UPDATE spip_forms_donnees SET rang=rang-1 WHERE id_form=$id_form AND rang>$rang");
		$res = spip_query("SELECT id_form,rang FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
		if (!$row = spip_fetch_array($res)) return $rang_nouv;
		return $row['rang'];
	}

	function Forms_enregistrer_reponse_formulaire($id_form, &$id_donnee, &$erreur, &$reponse, $script_validation = 'valide_form', $script_args='', $c=NULL, $rang=NULL) {
		$r = '';
		if (!include_spip('inc/autoriser'))
			include_spip('inc/autoriser_compat');
	
		//adaptation SPIP2
		/*$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form));
		if (!$row = spip_fetch_array($result)) {
			$erreur['@'] = _T("forms:probleme_technique");
		}*/
		
		if (!$row = sql_fetsel("*","spip_forms","id_form=".intval($id_form))) {
			$erreur['@'] = _T("forms:probleme_technique");
		}
		
		$moderation = $row['moderation'];
		// Extraction des donnees pour l'envoi des mails eventuels
		//   accuse de reception et forward webmaster
		$email = unserialize($row['email']);
		$champconfirm = $row['champconfirm'];
		$mailconfirm = '';

		include_spip("inc/forms_type_champs");
		$erreur = Forms_valide_champs_reponse_post($id_form, $id_donnee, $c);

		// Si tout est bon, enregistrer la reponse
		if (!$erreur) {
			global $auteur_session;
			$id_auteur = $auteur_session ? intval($auteur_session['id_auteur']) : 0;
			$url = (_DIR_RESTREINT==_DIR_RESTREINT_ABS)?parametre_url(self(),'id_form',''):_DIR_RESTREINT_ABS;
			if ($id_donnee<0) $url = parametre_url($url,'id_donnee','');
			$ok = true;
			$confirme = false;
			if ($GLOBALS['spip_version_code']<1.92)
				$id = _request("deja_enregistre_$id_form");
			else
				$id = _request("deja_enregistre_$id_form", $c);
			if ($id = intval($id)){
				$id_donnee = $id;
				$ok = false;
				$confirme = true;
			}

			$nom_cookie = Forms_nom_cookie_form($id_form);
			if (isset($_COOKIE[$nom_cookie]))
				$cookie = $_COOKIE[$nom_cookie];
			else {
				include_spip("inc/acces");
				$cookie = creer_uniqid();
			}
			
			//SPIP2 probleme plus bas dans validation de la réponse du sondage qui se passe ds un deuxième temps
			if ($row['type_form']=='sondage')
				$confirmation = 'valide';
				//$confirmation = 'attente';
			else
				$confirmation = 'valide';
				
			if ($moderation == 'posteriori')
				$statut='publie';
			else {
				$statut = 'prop';
				foreach(array('prepa','prop','publie','refuse') as $s)
					if (autoriser(
							'instituer',
							(in_array($row['type_form'],array('','sondage'))?'form':$row['type_form']).'_donnee',
							0,NULL,array('id_form'=>$id_form,'statut'=>'prepa','nouveau_statut'=>$s))){
						$statut = $s;
						break;
					}
			}
			
			// D'abord creer la reponse dans la base de donnees
			if ($ok) {
				if ($id_donnee>0 AND autoriser('modifier', 'donnee', $id_donnee, NULL, array('id_form'=>$id_form))){
					spip_query("UPDATE spip_forms_donnees SET ip="._q($GLOBALS['ip']).", url="._q($url).", confirmation="._q($confirmation).", cookie="._q($cookie)." ".
						"WHERE id_donnee="._q($id_donnee));
				} elseif (autoriser('creer', 'donnee', 0, NULL, array('id_form'=>$id_form))){
					if ($rang==NULL) $rang = array('rang'=>Forms_rang_prochain($id_form));
					elseif(!is_array($rang)) $rang=array('rang'=>$rang);
					
					// adaptation SPIP 2
					/*spip_query("INSERT INTO spip_forms_donnees (id_form, id_auteur, date, ip, url, confirmation,statut, cookie, "
					  . implode(',',array_keys($rang)).") "
					  .	"VALUES ("._q($id_form).","._q($id_auteur).", NOW(),"._q($GLOBALS['ip']).","
					  . _q($url).", '$confirmation', '$statut',"._q($cookie).","
					  . implode(',',array_map('_q',$rang)) .")");*/
					//$id_donnee = spip_insert_id();
					$id_donnee = sql_insertq( 'spip_forms_donnees',array('id_form'=>_q($id_form),'id_auteur'=>_q($id_auteur),'date'=>'NOW()','ip'=>_q($GLOBALS['ip']),'url'=>_q($url),'confirmation'=>$confirmation,'statut'=>$statut,'cookie'=>_q($cookie),implode(',',array_keys($rang))=>implode(',',array_map('_q',$rang))));
					# cf. GROS HACK inc/forms_tables_affichage
					# rattrapper les documents associes a cette nouvelle donnee
					# ils ont un id = 0-id_auteur
					spip_query("UPDATE spip_documents_donnees SET id_donnee = $id_donnee WHERE id_donnee = ".(0-$GLOBALS['auteur_session']['id_auteur']));
					# cf. GROS HACK 2 balise/forms
					# rattrapper les documents associes a cette nouvelle donnee
					# ils ont un id = 0-id_auteur
					spip_query("UPDATE spip_forms_donnees_donnees SET id_donnee = $id_donnee WHERE id_donnee = ".(0-$GLOBALS['auteur_session']['id_auteur']));
				}
				if (!($id_donnee>0)) {
					$erreur['@'] = _T("forms:probleme_technique");
					$ok = false;
				}
				else {
					$_GET["deja_enregistre_$id_form"] = $id_donnee;
				}
			}

			// Puis enregistrer les differents champs
			if ($ok) {
				#$inserts = Forms_insertions_reponse_post($id_form,$id_donnee,$erreur,$ok,$c);
				if (!Forms_modifier_reponse($id_form,$id_donnee,$erreur, $c)) {
					// Reponse vide => annuler
					$erreur['@'] = _T("forms:remplir_un_champ");
					$row = spip_query("SELECT * FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee));
					if(!$row = spip_fetch_array($row))
						spip_query("DELETE FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
					$ok = false;
				}
			}
			/*if ($ok) {
				include_spip('inc/securiser_action');
				spip_query("DELETE FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee));
				spip_query("INSERT INTO spip_forms_donnees_champs (id_donnee, champ, valeur) ".
					"VALUES ".join(',', $inserts));
			}*/
			if ($ok || $confirme) {
				if ($champconfirm)
					if ($row=spip_fetch_array(spip_query("SELECT * FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($champconfirm))))
						$mailconfirm = $row['valeur'];
				if (($email) || ($mailconfirm)) {
					include_spip("inc/session");
					$hash = md5("forms confirme reponse $id_donnee".hash_env());
					$url = generer_url_public($script_validation,"mel_confirm=oui&id_donnee=$id_donnee&hash=$hash".($script_args?"&$script_args":""));
					$r = $url;
					if ($mailconfirm) $reponse = $mailconfirm;
				}
				
				if ($row['type_form']=='sondage') {
					include_spip("inc/session");
					$hash = md5("forms valide reponse sondage $id_donnee $cookie ".hash_env());
					// SPIP2 probleme avec cet url de confirmation de la réponse du sondage.
					$url = generer_url_public($script_validation,"verif_cookie=oui&id_donnee=$id_donnee&hash=$hash".($script_args?"&$script_args":""));
					$r = $url;
				}
			}
		}
		return $r;
	}

	function Forms_generer_mail_reponse_formulaire($id_form, $id_donnee, $env){
		if (!is_array($env)) $env=array();
		$modele_mail_admin = 'form_reponse_email_admin';
		$modele_mail_confirm = 'form_reponse_email_confirm';
		if (isset($env['modele']))
			$modele_mail_confirm = $env['modele'];
		if (isset($env['modele_admin']))
			$modele_mail_admin = $env['modele_admin'];
		
		//adapatation SPIP2
		//$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form));
		//if ($row = spip_fetch_array($result)) {
		if ($row = sql_fetsel("*","spip_forms","id_form=".intval($id_form))) {
			$modele_admin = "modeles/$modele_mail_admin";
			$modele_confirm = "modeles/$modele_mail_confirm";
			if ($f = find_in_path(($m_admin = "$modele_admin-$id_form").".html"))
				$modele_admin = $m_admin;
			if ($f = find_in_path(($m_confirm = "$modele_confirm-$id_form").".html"))
				$modele_confirm = $m_confirm;
			$corps_mail_confirm = recuperer_fond($modele_confirm,array_merge($env,array('id_donnee'=>$id_donnee)));
			$corps_mail_admin = recuperer_fond($modele_admin,array_merge($env,array('id_donnee'=>$id_donnee,'mail_admin'=>'oui')));
			$champconfirm = $row['champconfirm'];
			$email = unserialize($row['email']);
			$email_dest = $email['defaut'];
			$mailconfirm = "";

			// recuperer documents
			$documents_mail = false;
			if ($row['documents_mail']=='oui'){
				//$result2 = spip_query("SELECT champ FROM spip_forms_champs WHERE id_form="._q($id_form)." AND type='fichier'");
				//spip_log("SELECT champ FROM spip_forms_champs WHERE id_form="._q($id_form)." AND type='fichier'");
				//adaptation SPIP2
				//if ($row2 = spip_fetch_array($result2)) {
				if ($row2 = sql_fetsel("champ","spip_forms_champs","id_form=".intval($id_form)." AND type='fichier'")) {
					//$result3 = spip_query("SELECT valeur FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($row2['champ']));
					//spip_log("SELECT valeur FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($row2['champ']));
					//adaptation SPIP2
					//if ($row3 = spip_fetch_array($result3)) {
					if ($row3 = sql_fetsel("valeur","spip_forms_champs","id_donnee=".intval($id_donnee)." AND champ="._q($row2['champ']))) {
						$documents[] = $row3['valeur'];
						$documents_mail = true;
					}
				}
			}
			// recuperer l'email de confirmation
			$result2 = spip_query("SELECT * FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($champconfirm));
			//if ($row2 = spip_fetch_array($result2)) {
			if ($row2 = sql_fetsel("*","spip_forms_donnees_champs","id_donnee="._q($id_donnee)." AND champ="._q($champconfirm))) {
				$mailconfirm = $row2['valeur'];
			}

			// recuperer l'email d'admin
			$result2 = spip_query("SELECT * FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($email['route']));
			//if ($row2 = spip_fetch_array($result2)) {
			if ($row2 = sql_fetsel("*","spip_forms_donnees_champs","id_donnee="._q($id_donnee)." AND champ="._q($email['route']))){
				if (isset($email[$row2['valeur']]))
					$email_dest = $email[$row2['valeur']];
			}

			include_spip('inc/mail');
			$from_host = parse_url($GLOBALS['meta']['adresse_site']);
			$from_host = $from_host['host'];
			if ($mailconfirm !== '') {
				$from = $GLOBALS['meta']['email_webmaster'];
				//$from = "formulaire@$from_host";
				$head="From: $from\n";
				$sujet = $row['titre'];
				$dest = $mailconfirm;
				// mettre le texte dans un charset acceptable et sans entites
				//$mess_iso = unicode2charset(html2unicode(charset2unicode($corps_mail)),'iso-8859-1');
				//mail($dest, $sujet, $mess_iso, $head);
				$headers = "";
				if (preg_match(",<html>(.*)</html>,Uims",$corps_mail_confirm,$regs)){
					$charset = $GLOBALS['meta']['charset'];
					$headers .=
					"MIME-Version: 1.0\n".
					"Content-Type: text/html; charset=$charset\n".
					"Content-Transfer-Encoding: 8bit\n";
					if (preg_match(",<h[1-6]>(.*)</h[1-6]>,Uims",$regs[1],$hs))
						$sujet=$hs[1];
				}
				envoyer_mail($dest, $sujet, $corps_mail_confirm, $from, $headers);
			}
			if ($email_dest != '') {
				$from = $mailconfirm?$mailconfirm:"formulaire_$id_form@$from_host";
				$head="From: $from\n";
				$sujet = $row['titre'];
				$dest = $email_dest;
				// mettre le texte dans un charset acceptable et sans entites
				//$mess_iso = unicode2charset(html2unicode(charset2unicode($corps_mail_admin)),'iso-8859-1');
				//mail($dest, $sujet, $mess_iso, $head);
				$headers = "";
				if (preg_match(",<html>.*</html>,Uims",$corps_mail_admin,$regs)){
					$charset = $GLOBALS['meta']['charset'];
					$headers .=
					"MIME-Version: 1.0\n".
					"Content-Type: text/html; charset=$charset\n".
					"Content-Transfer-Encoding: 8bit\n";
					if (preg_match(",<h[1-6]>(.*)</h[1-6]>,Uims",$regs[1],$hs))
						$sujet=$hs[1];
				}
				//joindre les documents si necessaire
				if ($documents_mail && is_array($documents)) {
					$random_hash = md5(date('r', time()));
					$headers = "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
					$charset = $GLOBALS['meta']['charset'];
					$corps_mail_admin = 	"This is a multi-part message in MIME format." .
								"\n--PHP-mixed-".$random_hash .
								"\nContent-Type: text/plain; charset=\"" . $charset . "\"" .
								"\nContent-Transfer-Encoding: 8bit\n\n" . $corps_mail_admin;

					foreach($documents as $document){
						$filename = substr(strrchr($document, "/"), 1);
						$filetype = substr(strrchr($document, "."), 1);
						$corps_mail_admin .= "\n\n--PHP-mixed-".$random_hash."\nContent-Type: application/".$filetype."; name=\"".$filename."\"\nContent-Transfer-Encoding: base64\nContent-Disposition: attachment; filename=\"".$filename."\"\r\n" .
									chunk_split(base64_encode(file_get_contents($document)), 72)."\r\n";
					}
					$corps_mail_admin .= "\n\n--PHP-mixed-".$random_hash."--\r\n";
				}
				envoyer_mail($dest, $sujet, $corps_mail_admin, $from, $headers);
		 	}
		}
	}


function Forms_obligatoire($row,$forms_obligatoires){
	$returned=$row;
	global $auteur_session;
	$id_auteur = $auteur_session ? intval($auteur_session['id_auteur']) : 0;
	$form_tab=explode(',',$forms_obligatoires);
	$chercher=true;
	$i=0;
	while ($chercher && $i<count($form_tab)){
		$form_id=$form_tab[$i];
		$cookie = $_COOKIE[Forms_nom_cookie_form($form_id)];
		$q="SELECT id_form FROM spip_forms_donnees WHERE statut='publie' AND id_form="._q($form_id)." ";
		if ($cookie) $q.="AND (cookie="._q($cookie)." OR id_auteur="._q($id_auteur).") ";
		else
			if ($id_auteur)
				$q.="AND id_auteur="._q($id_auteur)." ";
			else
				$q.="AND 0=1 ";
		$res=spip_query($q);
		if (!spip_fetch_array($res)){
			$res2 = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($form_id));
			$returned = spip_fetch_array($res2);
			$chercher=false;
		}
		$i++;
	}
	return $returned;
}

//ajout SPIP 2
include_spip('inc/vieilles_defs');

function Forms_afficher_liste_donnees_liees($type_source, $id, $type_lie, $type_table, $script, $bloc_id, $arg_ajax, $retour){
	// article, donnee
	// donnee, donnee_liee
	// donnee_liee, donnee
	$lieeliante = ($type_source=='donnee_liee')?'liante':'liee';
	$linkable = strncmp($type_source,'donnee',6)!=0;
	$in_type_table="";
	if ($type_table){
		include_spip("base/abstract_sql");
		include_spip("base/forms_base_api");
		$in_type_table = calcul_mysql_in('d.id_form',implode(",",Forms_liste_tables($type_table)))." AND";
	}

	$out = "";
	$iid = intval($id);

	$les_donnees = "0";
	$nombre_donnees = 0;
	$liste = array();
	$forms = array();
	$types = array();
	$prefixi18n = array();

	$champ_donnee_liee = "id_$type_lie";
	$champ_donnee_source = "id_$type_source";
	$table_liens = strncmp($type_source,"donnee",6)==0?"spip_forms_donnees_donnees":"spip_forms_donnees_{$type_source}s";

	$res = spip_query("SELECT dl.$champ_donnee_liee
	  FROM $table_liens AS dl
	  JOIN spip_forms_donnees AS d ON d.id_donnee=dl.$champ_donnee_liee
	  WHERE $in_type_table dl.$champ_donnee_source="._q($iid));
	// ADAPTATION SPIP 2
	/*$nombre_donnees = $cpt = spip_num_rows($res);*/
	$nombre_donnees = $cpt =sql_count($res);
	while ($row = spip_fetch_array($res,SPIP_NUM))	$les_donnees.=",".$row[0];

	$tranches = ($cpt>1000)?2*_TRANCHES:_TRANCHES;
	$tmp_var = $bloc_id;
	$nb_aff = floor(1.5 * $tranches);
	if ($cpt > $nb_aff) {
		$nb_aff = $tranches;
		$tranches = afficher_tranches_requete($cpt, $tmp_var, generer_url_ecrire($script,$arg_ajax), $nb_aff);
	} else $tranches = '';

	$deb_aff = _request($tmp_var);
	$deb_aff = ($deb_aff !== NULL ? intval($deb_aff) : 0);

	$limit = (($deb_aff < 0) ? '' : " LIMIT $deb_aff, $nb_aff");

	$res = spip_query(
	"SELECT dl.$champ_donnee_liee
	FROM $table_liens AS dl
	JOIN spip_forms_donnees AS d ON d.id_donnee=dl.$champ_donnee_liee
	WHERE $in_type_table dl.$champ_donnee_source="._q($iid)."
	ORDER BY d.id_form $limit");
	while ($row = spip_fetch_array($res)){
		list($id_form,$titreform,$type_form,$t) = Forms_liste_decrit_donnee($row[$champ_donnee_liee],true,$linkable);
		if (!count($t))
			list($id_form,$titreform,$type_form,$t) = Forms_liste_decrit_donnee($row[$champ_donnee_liee], false,$linkable);
		if (count($t)){
			$liste[$id_form][$row[$champ_donnee_liee]]=$t;
			$forms[$id_form] = $titreform;
			$types[$id_form] = $type_form;
		}
	}
	foreach($types as $type_form)
		$prefixi18n[$type_form] = forms_prefixi18n($type_form);
	if ($lieeliante=='liee')
		$type_autoriser = strncmp($type_source,'donnee',6)==0?'donnee':$type_source;
	else
		$type_autoriser = 'donnee';

	if (count($liste) OR $tranches) {
		$out .= "<div class='liste liste-donnees'>";
		$out .= $tranches;
		$out .= "<table width='100%' cellpadding='3' cellspacing='0' border='0' background=''>";
		$table = array();
		foreach($liste as $id_form=>$donnees){
			$vals = array();
			$vals[] = "";
			$vals[] = "<a href='".generer_url_ecrire("donnees_tous","id_form=$id_form&retour=".urlencode($retour))."'>".$forms[$id_form]."</a>";
			$vals[] = "";
			$table[] = $vals;
			foreach($donnees as $id_donnee=>$champs){
				$vals = array();
				$vals[] = $id_donnee;
				if ($lieeliante=='liee')
					$auth_modifier = autoriser('modifier',$type_autoriser,$iid,NULL,array('id_donnee_liee'=>$id_donnee));
				else
					$auth_modifier = autoriser('modifier',$type_autoriser,$id_donnee,NULL,array('id_form'=>$id_form,'id_donnee_liee'=>$iid));
				$vals[] =
				  ($auth_modifier?"<a href='".generer_url_ecrire("donnees_edit","id_form=$id_form&id_donnee=$id_donnee&retour=".urlencode($retour))."'>":"")
				  .implode(", ",$champs)
				  .($auth_modifier?"</a>":"");
				$redirect = ancre_url((_DIR_RESTREINT?"":_DIR_RESTREINT_ABS).self(),'tables');
				$action = "";
				if ($lieeliante=='liee'){
					if (autoriser("delier_donnee",$type_autoriser,$iid,NULL,array('id_donnee_liee'=>$id_donnee)))
						$action = generer_action_auteur("forms_lier_donnees","$id,$type_source,retirer,$id_donnee",urlencode($redirect));
				}
				else
					if (autoriser("delier_donnee",$type_autoriser,$id_donnee,NULL,array('id_form'=>$id_form,'id_donnee_liee'=>$iid)))
						$action = generer_action_auteur("forms_lier_donnees","$id_donnee,$type_lie,retirer,$id",urlencode($redirect));
				if ($action){
					$action = ancre_url($action,$bloc_id);
					$redirajax = generer_url_ecrire($script,$arg_ajax);
					$vals[] = "<a href='$action' rel='$redirajax' class='ajaxAction' >"
						. _T($prefixi18n[$types[$id_form]].":lien_retirer_donnee_$lieeliante")."&nbsp;". http_img_pack('croix-rouge.gif', "X", "width='7' height='7' border='0' align='middle'")
						. "</a>";
				}
				else $vals[] = "";
				$table[] = $vals;
			}
		}
		$largeurs = array('', '', '', '', '');
		$styles = array('arial11', 'arial11', 'arial2', 'arial11', 'arial11');
		$out .= afficher_liste($largeurs, $table, $styles, false);

		$out .= "</table></div>\n";
	}
	return array($out,$les_donnees,$nombre_donnees) ;
}

function Forms_liste_decrit_donnee($id_donnee, $specifiant=true, $linkable=true){
	$t = array();$titreform="";
	$id_form = 0;
	$type_form = "";
	if ($specifiant) $specifiant = "c.specifiant='oui' AND ";
	else $specifiant="";
	if ($linkable) $linkable = " AND f.linkable='oui'";
	else $linkable = "";
	$res2 = spip_query("SELECT c.titre,dc.valeur,f.titre AS titreform,f.id_form,f.type_form FROM spip_forms_donnees_champs AS dc
	JOIN spip_forms_donnees AS d ON d.id_donnee=dc.id_donnee
	JOIN spip_forms_champs AS c ON c.champ=dc.champ AND c.id_form=d.id_form
	JOIN spip_forms AS f ON f.id_form=d.id_form
	WHERE $specifiant dc.id_donnee="._q($id_donnee)."$linkable ORDER BY c.rang");
	while ($row2 = spip_fetch_array($res2)){
		$t[$row2['titre']] = $row2['valeur'];
		$titreform = $row2['titreform'];
		$id_form = $row2['id_form'];
		$type_form = $row2['type_form'];
	}
	return array($id_form,$titreform,$type_form,$t);
}

?>
