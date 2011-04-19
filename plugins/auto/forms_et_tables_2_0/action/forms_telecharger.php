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
include_spip('inc/forms_export');

function action_forms_telecharger(){
	global $auteur_session;
	$arg = _request('arg');
	$hash = _request('hash');
	$id_auteur = $auteur_session['id_auteur'];
	$redirect = _request('redirect');
	if ($redirect==NULL) $redirect="";
	if (!include_spip("inc/securiser_action"))
		include_spip("inc/actions");
	if (verifier_action_auteur("forms_telecharger-$arg",$hash,$id_auteur)==TRUE) {
		if (!include_spip('inc/autoriser'))
			include_spip('inc/autoriser_compat');
		if (autoriser('supprimer','form',$id_form)){
			$id_form = intval($arg);
			$delim = _request('delim');
			if ($delim == 'TAB') $delim = "\t";
			
			$out = Forms_formater_les_reponses($id_form, "csv", $delim, $fichiers, $filename);
		
			// Excel ?
			if ($delim == ','){
				$extension = 'csv';
				$charset = $GLOBALS['meta']['charset'];
			}
			else {
				$extension = 'xls';
				# Excel n'accepte pas l'utf-8 ni les entites html... on fait quoi?
				include_spip('inc/charsets');
				$out = unicode2charset(charset2unicode($out), 'iso-8859-1');
				$charset = 'iso-8859-1';
			}
		
			if (!count($fichiers)) {
				Header("Content-Type: text/comma-separated-values; charset=$charset");
				Header("Content-Disposition: attachment; filename=$filename.$extension");
				//Header("Content-Type: text/plain; charset=$charset");
				Header("Content-Length: ".strlen($out));
				echo $out;
				exit();
			} 
			else {
				//
				// S'il y a des fichiers joints, creer un ZIP
				//
				define( 'PCLZIP_TEMPORARY_DIR', _DIR_TMP ); // au cas ou ca n'est pas fait dans la librairie
				include_spip("inc/pclzip");
				include_spip("inc/session");
			
				$zip = _DIR_TMP."form".$id_form."_".rand().".zip";
				$csv = _DIR_TMP."$filename.$extension";
			
				$f = fopen($csv, "wb");
				fwrite($f, $out);
				fclose($f);
			
				$chemin = _DIR_RACINE;
				$fichiers = $chemin.join(",$chemin", $fichiers);
			
				$archive = new PclZip($zip);
				$archive->add($csv, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $filename);
				$archive->add($fichiers, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $filename.'/fichiers');
			
				Header("Content-Type: application/zip");
				Header("Content-Disposition: attachment; filename=$filename.zip");
				Header("Content-Length: ".filesize($zip));
				readfile($zip);
			
				@unlink($csv);
				@unlink($zip);
				exit();
			}
		}
	}
	if ($redirect)
		redirige_par_entete(str_replace("&amp;","&",urldecode($redirect)));
}

?>