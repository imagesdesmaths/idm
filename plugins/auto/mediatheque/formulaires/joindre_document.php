<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2009                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

function joindre_determiner_mode($mode,$id_document,$objet){
	if ($mode=='auto'){
		if (intval($id_document))
			$mode = sql_getfetsel('mode','spip_documents','id_document='.intval($id_document));
		if (!in_array($mode,array('choix','document','image'))){
			$mode='choix';
			if ($objet AND $GLOBALS['meta']["documents_$objet"]=='non')
				$mode = 'image';
		}
	}
	return $mode;
}

function formulaires_joindre_document_charger_dist($id_document='new',$id_objet=0,$objet='',$mode = 'auto',$galerie = false, $proposer_media=true, $proposer_ftp=true){
	$valeurs = array();
	$mode = joindre_determiner_mode($mode,$id_document,$objet);
	
	$valeurs['id'] = $id_document;
	$valeurs['mode'] = $mode;
	
	$valeurs['url'] = 'http://';
	$valeurs['fichier_upload'] = '';
	
	$valeurs['_options_upload_ftp'] = '';
	$valeurs['_dir_upload_ftp'] = '';
	
	$valeurs['joindre_upload']=''; 
	$valeurs['joindre_distant']=''; 
	$valeurs['joindre_ftp']='';
	$valeurs['joindre_mediatheque']='';

	$valeurs['editable'] = ' ';
	if (intval($id_document)){
		$valeurs['editable'] = autoriser('modifier','document',$id_document)?' ':'';
	}
	
	$valeurs['proposer_media'] = is_string($proposer_media) ? (preg_match('/^(false|non|no)$/i', $proposer_media) ? false : true) : $proposer_media;
	$valeurs['proposer_ftp'] = is_string($proposer_ftp) ? (preg_match('/^(false|non|no)$/i', $proposer_ftp) ? false : true) : $proposer_ftp;
	
	# regarder si un choix d'upload FTP est vraiment possible
	if (
	 $valeurs['proposer_ftp']
	 AND test_espace_prive() # ??
	 AND ($mode == 'document' OR $mode == 'choix') # si c'est pour un document
	 //AND !$vignette_de_doc		# pas pour une vignette (NB: la ligne precedente suffit, mais si on la supprime il faut conserver ce test-ci)
	 AND $GLOBALS['flag_upload']
	 ) {
		include_spip('inc/actions');
		if ($dir = determine_upload('documents')) {
			// quels sont les docs accessibles en ftp ?
			$valeurs['_options_upload_ftp'] = joindre_options_upload_ftp($dir, $mode);
			// s'il n'y en a pas, on affiche un message d'aide
			// en mode document, mais pas en mode image
			if ($valeurs['_options_upload_ftp'] OR ($mode == 'document' OR $mode=='choix'))
				$valeurs['_dir_upload_ftp'] = "<b>".joli_repertoire($dir)."</b>";
		}
	}
	// On ne propose le FTP que si on a des choses a afficher
	$valeurs['proposer_ftp'] = ($valeurs['_options_upload_ftp'] or $valeurs['_dir_upload_ftp']);
	
	if ($galerie){
		# colonne documents ou portfolio ?
		$valeurs['_galerie'] = $galerie;
	}
	if ($objet AND $id_objet){
		$valeurs['id_objet'] = $id_objet;
		$valeurs['objet'] = $objet;
		$valeurs['refdoc_joindre'] = '';
		if ($valeurs['editable']){
			include_spip('inc/autoriser');
			$valeurs['editable'] = autoriser('modifier',$objet,$id_objet)?' ':'';
		}
	}
	
	return $valeurs;
}


function formulaires_joindre_document_verifier_dist($id_document='new',$id_objet=0,$objet='',$mode = 'auto',$galerie = false, $proposer_media=true, $proposer_ftp=true){
	include_spip('inc/joindre_document');
	
	$erreurs = array();
	// on joint un document deja dans le site
	if (_request('joindre_mediatheque')){
    $refdoc_joindre = intval(preg_replace(',^(doc|document|img),','',_request('refdoc_joindre')));
		if (!sql_getfetsel('id_document','spip_documents','id_document='.intval($refdoc_joindre)))
			$erreurs['message_erreur'] = _T('medias:erreur_aucun_document');
	}
	// sinon c'est un upload
	else {
		$files = joindre_trouver_fichier_envoye();
		if (is_string($files)){
			$erreurs['message_erreur'] = $files;
		}
		elseif(is_array($files)){
			// erreur si on a pas trouve de fichier
			if (!count($files))
				$erreurs['message_erreur'] = _T('medias:erreur_aucun_fichier');

			else{
				// regarder si on a eu une erreur sur l'upload d'un fichier
				foreach($files as $file){
					if (isset($file['error'])
						AND $test = joindre_upload_error($file['error'])){
							if (is_string($test))
								$erreurs['message_erreur'] = $test;
							else
								$erreurs['message_erreur'] = _T('medias:erreur_aucun_fichier');
					}
				}

				// si ce n'est pas deja un post de zip confirme
				// regarder si il faut lister le contenu du zip et le presenter
				if (!count($erreurs)
				 AND !_request('joindre_zip')
				 AND $contenu_zip = joindre_verifier_zip($files)){
					list($fichiers,$erreurs,$tmp_zip) = $contenu_zip;
					$erreurs['lister_contenu_archive'] = recuperer_fond("formulaires/inc-lister_archive_jointe",array('chemin_zip'=>$tmp_zip,'liste_fichiers_zip'=>$fichiers,'erreurs_fichier_zip'=>$erreurs));
				}
			}
		}

		if (count($erreurs) AND defined('_tmp_dir'))
			effacer_repertoire_temporaire(_tmp_dir);
	}
	
	return $erreurs;
}


function formulaires_joindre_document_traiter_dist($id_document='new',$id_objet=0,$objet='',$mode = 'auto',$galerie = false, $proposer_media=true, $proposer_ftp=true){
	$res = array('editable'=>true);
	$ancre = '';
	// on joint un document deja dans le site
	if (_request('joindre_mediatheque')){
		if ($refdoc_joindre = intval(preg_replace(',^(doc|document|img),','',_request('refdoc_joindre')))){
			// lier le parent en plus
			$champs = array('ajout_parents' => array("$objet|$id_objet"));
			include_spip('action/editer_document');
			document_set($refdoc_joindre,$champs);
			set_request('refdoc_joindre',''); // vider la saisie
			$ancre = $refdoc_joindre;
			$res['message_ok'] = _T('medias:document_attache_succes');
		}
	}
	// sinon c'est un upload
	else {
		$ajouter_documents = charger_fonction('ajouter_documents', 'action');

		$mode = joindre_determiner_mode($mode,$id_document,$objet);
		include_spip('inc/joindre_document');
		$files = joindre_trouver_fichier_envoye();

		$nouveaux_doc = $ajouter_documents($id_document,$files,$objet,$id_objet,$mode);

		if (defined('_tmp_dir'))
			effacer_repertoire_temporaire(_tmp_dir);

		// checker les erreurs eventuelles
		$messages_erreur = array();
		$nb_docs = 0;
		foreach ($nouveaux_doc as $doc) {
			if (!is_numeric($doc))
				$messages_erreur[] = $doc;
			else{
				if (!$ancre)
					$ancre = $doc;
				$nb_docs++;
			}
		}
		if (count($messages_erreur))
			$res['message_erreur'] = implode('<br />',$messages_erreur);
		if ($nb_docs){
			$autoopen = "<script type='text/javascript'>setTimeout(function(){if (window.jQuery) jQuery('#doc$ancre a.editbox').get(0).focus();},30);</script>";
			$res['message_ok'] = $nb_docs==1? _T('medias:document_installe_succes').$autoopen:_T('medias:nb_documents_installe_succes',array('nb'=>$nb_docs));
		}
		if ($ancre)
			$res['redirect'] = "#doc$ancre";
	}
	
	return $res;
}



/**
 * Retourner le contenu du select HTML d'utilisation de fichiers envoyes
 *
 * @param string $dir
 * @param string $mode
 * @return string
 */
function joindre_options_upload_ftp($dir, $mode = 'document') {
	$fichiers = preg_files($dir);
	$exts = array();
	$dirs = array(); 
	$texte_upload = array();

	// en mode "charger une image", ne proposer que les inclus
	$inclus = ($mode == 'document' OR $mode =='choix')
		? ''
		: " AND inclus='image'";

	foreach ($fichiers as $f) {
		$f = preg_replace(",^$dir,",'',$f);
		if (preg_match(",\.([^.]+)$,", $f, $match)) {
			$ext = strtolower($match[1]);
			if (!isset($exts[$ext])) {
				include_spip('action/ajouter_documents');
				$ext = corriger_extension($ext);
				if (sql_fetsel('extension', 'spip_types_documents', $a = "extension='$ext'" . $inclus))
					$exts[$ext] = 'oui';
				else $exts[$ext] = 'non';
			}

			$k = 2*substr_count($f,'/');
			$n = strrpos($f, "/");
			if ($n === false)
			  $lefichier = $f;
			else {
			  $lefichier = substr($f, $n+1, strlen($f));
			  $ledossier = substr($f, 0, $n);
			  if (!in_array($ledossier, $dirs)) {
				$texte_upload[] = "\n<option value=\"$ledossier\">"
				. str_repeat("&nbsp;",$k) 
				._T('tout_dossier_upload', array('upload' => $ledossier))
				."</option>";
				$dirs[]= $ledossier;
			  }
			}

			if ($exts[$ext] == 'oui')
			  $texte_upload[] = "\n<option value=\"$f\">" .
			    str_repeat("&nbsp;",$k+2) .
			    $lefichier .
			    "</option>";
		}
	} 

	$texte = join('', $texte_upload);
	if (count($texte_upload)>1) {
		$texte = "\n<option value=\"/\" style='font-weight: bold;'>"
				._T('info_installer_tous_documents')
				."</option>" . $texte;
	}

	return $texte;
}


/**
 * Lister les fichiers contenus dans un zip
 *
 * @param unknown_type $files
 * @return unknown
 */
function joindre_liste_contenu_tailles_archive($files) {
	include_spip('inc/charsets'); # pour le nom de fichier

	$res = '';
	if (is_array($files))
		foreach ($files as $nom => $file) {
			$nom = translitteration($nom);
			$date = date_interface(date("Y-m-d H:i:s", $file['mtime']));
	
			$taille = taille_en_octets($file['size']);
			$res .= "<li title=\"".attribut_html($title)."\"><b>$nom</b> &ndash; $taille<br />&nbsp; $date</li>\n";
		}
	
	return $res;
}


function joindre_liste_erreurs_to_li($erreurs){
	$res = implode("</li><li>",$erreurs);
	if (strlen($res)) $res = "<li>$res</li>";
	if (count($erreurs)>4){
		$res = "<li><span style='cursor:pointer;' onclick='jQuery(this).siblings(\"ul\").toggle();return false;'>"._T("medias:erreurs_voir",array('nb'=>count($erreurs)))."</span><ul style='display:none;'>".$res."</ul></li>";
	}
	return $res;
}

?>
