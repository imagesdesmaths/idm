<?php

/**
 * Plugin générique de configuration pour SPIP
 *
 * @license    GNU/GPL
 * @package    plugins
 * @subpackage cfg
 * @category   outils
 * @copyright  (c) toggg, marcimat 2007-2008
 * @link       http://www.spip-contrib.net/
 * @version    $Id$
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * si non definie, _COMPAT_CFG_192 vaut "_COMPAT_CFG_192" :(
 */
define ('_COMPAT_CFG_192',false);

/**
 * Vérification du fichier $nom
 *
 * @param  string $nom
 * @param  Object $cfg
 * @return Object
 */
function cfg_pre_verifier_cfg_fichier($nom, &$cfg){	
	$f = cfg_get_info_fichier_upload($nom);
	// si pas de fichier envoye, on ne traite pas le champ
	if (!$f['tmp_name']) {
		unset ($cfg->champs[$nom], $cfg->extensions['cfg_fichier'][$nom]);
	// sinon indiquer un changement
	// pour eviter le message d'erreur "pas de changement"
	} else {
		set_request($nom, '<OLD>'.	$cfg->val[$nom]);
	}
	return $cfg;
}

/**
 * Pré-traitement du fichier $nom
 *
 * @param  string $nom
 * @param  Object $cfg
 * @return Object
 */
function cfg_pre_traiter_cfg_fichier($nom, &$cfg){
	include_spip('inc/flock');
	
	// enlever <OLD>
	$cfg->val[$nom] = str_replace('<OLD>','', $cfg->val[$nom]);
	
	// effacement
	if (_request('_cfg_delete')){
		$supprimer_fichier = _COMPAT_CFG_192 ? 'cfg_supprimer_fichier' : 'supprimer_fichier';
		if (!$supprimer_fichier(get_spip_doc($cfg->val[$nom]))) {
			$cfg->messages['erreurs'][$nom] = _T('cfg:erreur_suppression_fichier', array('fichier'=>get_spip_doc($cfg->val[$nom])));		
		}
	// ajout ou modification
	} else {
		$f = cfg_get_info_fichier_upload($nom);
		if ($f['tmp_name']) {
			// suppression de l'ancien fichier
			$supprimer_fichier = _COMPAT_CFG_192 ? 'cfg_supprimer_fichier' : 'supprimer_fichier';
			if ($cfg->val[$nom] && !$supprimer_fichier(get_spip_doc($cfg->val[$nom]))) {
				$cfg->messages['erreurs'][$nom] = _T('cfg:erreur_suppression_fichier', array('fichier'=>get_spip_doc($cfg->val[$nom])));	
			} else {
				if (!$fichier = cfg_ajoute_un_document($f['tmp_name'],$f['name'],$nom, 'config/'.$cfg->vue)){
					$cfg->messages['erreurs'][$nom] = _T('cfg:erreur_copie_fichier', array('fichier'=>'config/'.$cfg->vue . '/' . $f['name']));	
				} else {
					$cfg->val[$nom] = set_spip_doc($fichier);
				}
			}
		}
	}

	return $cfg;
}

/**
 *
 * @param  string $nom
 * @return string
 */
function cfg_get_info_fichier_upload($nom){
	return $_FILES ? $_FILES[$nom] : $GLOBALS['HTTP_POST_FILES'][$nom];
}

/**
 * Ajouter un document (au format $_FILES)<br>
 * (n'ajoute pas le contenu en base dans spip_documents...)
 * 
 * @param  string $source      Le fichier sur le serveur (/var/tmp/xyz34)
 * @param  string $nom_envoye  Son nom chez le client (portequoi.pdf)
 * @param  string $nom_dest    Le nom sous lequel le sauvegarder
 * @param  string $dans        Où l'enregistrer
 * @return string
 */
function cfg_ajoute_un_document($source, $nom_envoye, $nom_dest, $dans='config') {

	include_spip('inc/modifier');
	include_spip('inc/ajouter_documents');
	
	$type_image = ''; // au pire
	// tester le type de document :
	// - interdit a l'upload ?
	// - quelle extension dans spip_types_documents ?
	// - est-ce "inclus" comme une image ?

	preg_match(",^(.*)\.([^.]+)$,", $nom_envoye, $match);
	@list(,$titre,$ext) = $match;
	$ext = corriger_extension(strtolower($ext));
	// ajouter l'extension au nom propose...
	$row = sql_fetsel("inclus", "spip_types_documents", "extension=" . sql_quote($ext) . " AND upload='oui'");

	if ($row) {
		$type_inclus_image = ($row['inclus'] == 'image');
		// hum stocke dans IMG/$ext ?
		$fichier = cfg_copier_document($ext, $nom_dest.'.'.$ext, $source, $dans);
	} else {

/* STOCKER LES DOCUMENTS INCONNUS AU FORMAT .ZIP */
		$type_inclus_image = false;

		if (!sql_countsel("spip_types_documents", "extension='zip' AND upload='oui'")) {
			spip_log("Extension $ext interdite a l'upload");
			return;
		}

		$ext = 'zip';
		if (!$tmp_dir = tempnam(_DIR_TMP, 'tmp_upload')) return;
		spip_unlink($tmp_dir); @mkdir($tmp_dir);
		$tmp = $tmp_dir.'/'.translitteration($nom_envoye);
		$nom_envoye .= '.zip'; # conserver l'extension dans le nom de fichier, par exemple toto.js => toto.js.zip
		_COMPAT_CFG_192 ? cfg_deplacer_fichier_upload($source, $tmp) : deplacer_fichier_upload($source, $tmp);
		include_spip('inc/pclzip');
		$source = _DIR_TMP . 'archive.zip';
		$archive = new PclZip($source);
		$v_list = $archive->create($tmp,
			PCLZIP_OPT_REMOVE_PATH, $tmp_dir,
			PCLZIP_OPT_ADD_PATH, '');
		effacer_repertoire_temporaire($tmp_dir);
		if (!$v_list) {
			spip_log("Echec creation du zip ");
			return;
		}
		// hum too ?
		$fichier = cfg_copier_document($ext, $nom_dest.'.zip', $source, $dans);
		spip_unlink($source);
	}

	if ($ext == "svg") {
		// supprimer les scripts
		traite_svg($fichier);
	} elseif ($ext != "mov") {// image ?
		// Si c'est une image, recuperer sa taille et son type (detecte aussi swf)
		$size_image = @getimagesize($fichier);
		$type_image = decoder_type_image($size_image[2]);
	}

	// Quelques infos sur le fichier
	if (!$fichier OR !@file_exists($fichier)
	OR !$taille = @intval(filesize($fichier))) {
		spip_log ("Echec copie du fichier $fichier");
		return;
	}

	if (!$type_image) {
		if (_DOC_MAX_SIZE > 0
		AND $taille > _DOC_MAX_SIZE*1024) {
			spip_unlink ($fichier);
			check_upload_error(6,
			_T('info_logo_max_poids',
				array('maxi' => taille_en_octets(_DOC_MAX_SIZE*1024),
				'actuel' => taille_en_octets($taille))));
		}
	}
	else { // image
		if (_IMG_MAX_SIZE > 0
		AND $taille > _IMG_MAX_SIZE*1024) {
			spip_unlink ($fichier);
			check_upload_error(6,
			_T('info_logo_max_poids',
				array('maxi' => taille_en_octets(_IMG_MAX_SIZE*1024),
				'actuel' => taille_en_octets($taille))));
		}

		if (_IMG_MAX_WIDTH * _IMG_MAX_HEIGHT
		AND ($size_image[0] > _IMG_MAX_WIDTH
		OR $size_image[1] > _IMG_MAX_HEIGHT)) {
			spip_unlink ($fichier);
			check_upload_error(6, 
			_T('info_logo_max_taille',
				array(
				'maxi' =>
					_T('info_largeur_vignette',
						array('largeur_vignette' => _IMG_MAX_WIDTH,
						'hauteur_vignette' => _IMG_MAX_HEIGHT)),
				'actuel' =>
					_T('info_largeur_vignette',
						array('largeur_vignette' => $size_image[0],
						'hauteur_vignette' => $size_image[1]))
			)));
		}
	}

	return $fichier;
}


/**
 * Copier un document
 * 
 * @param string $ext    L'extension du fichier
 * @param string $dest   le nom sous lequel le sauvegarder
 * @param string $source le fichier sur le serveur (/var/tmp/xyz34)
 * @param string $dans   Où le copier
 * @return string
 */
function cfg_copier_document($ext, $dest, $source, $dans='_cfg') {

	$dest = preg_replace(',\.\.+,', '.', $dest); // pas de .. dans le nom du doc
	$dir = cfg_creer_repertoire_cfg($dans);
	$dest = preg_replace("/[^._=-\w\d]+/", "_", 
			translitteration(preg_replace("/\.([^.]+)$/", "", 
						      preg_replace("/<[^>]*>/", '', basename($dest)))));

	// ne pas accepter de noms de la forme -r90.jpg qui sont reserves
	// pour les images transformees par rotation (action/documenter)
	$dest = preg_replace(',-r(90|180|270)$,', '', $dest);
	
	$newFile = $dir . $dest .'.'.$ext;

	return _COMPAT_CFG_192 ? cfg_deplacer_fichier_upload($source, $newFile) : deplacer_fichier_upload($source, $newFile);
}

/**
 * Creer IMG/config/vue
 * comme "creer_repertoire_documents" mais avec 2 profondeurs
 *
 * @param  string $ext
 * @return string
 */
function cfg_creer_repertoire_cfg($ext) {
	list($racine, $vue) = explode('/',$ext,2);
	if ($rep = sous_repertoire(_DIR_IMG, $racine)){
		$rep = sous_repertoire(_DIR_IMG.$racine, $vue);
	}

	if (!$ext OR !$rep) {
		spip_log("creer_repertoire_cfg interdit");
		exit;
	}

	// Cette variable de configuration peut etre posee par un plugin
	// par exemple acces_restreint
	if ($GLOBALS['meta']["creer_htaccess"] == 'oui') {
		include_spip('inc/acces');
		verifier_htaccess($rep);
	}

	return $rep;
}

/*
 * compat 1.9.2 :
 * il y a plein de fonctions qui ont change !!
 */
if (_COMPAT_CFG_192) {
	
	/**
	 * pas de securite tuante sur .. comme en 1.9.3<br>
	 *
	 * @deprecated depuis SPIP 2.0
	 * @param  string  $source  Le nom du fichier source
	 * @param  string  $dest    Le nom du fichier de destination
	 * @param  boolean $move    TRUE si on le déplace
	 * @return boolean|string   La destination comme 1.9.3
	 */
	function cfg_deplacer_fichier_upload($source, $dest, $move=false) {
		// Securite
		if (substr($dest,0,strlen(_DIR_RACINE))==_DIR_RACINE)
			$dest = _DIR_RACINE.preg_replace(',\.\.+,', '.', substr($dest,strlen(_DIR_RACINE)));
		else
			$dest = preg_replace(',\.\.+,', '.', $dest);

		if ($move)	$ok = @rename($source, $dest);
		else				$ok = @copy($source, $dest);
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
		return $ok ? $dest : false;
	}
	
	
	/**
	 * Supprimer le fichier de maniere sympa (flock)
	 * 
	 * @deprecated depuis SPIP 2.0
	 * @param  string  $fichier Le nom du fichier à supprimer
	 * @return boolean 
	 */
	function cfg_supprimer_fichier($fichier) {
		if (!@file_exists($fichier))
			return true;

		// verrouiller le fichier destination
		if ($fp = @fopen($fichier, 'a'))
			@flock($fp, LOCK_EX);
		else
			return false;

		// liberer le verrou
		@flock($fp, LOCK_UN);
		@fclose($fp);

		// supprimer
		return @unlink($fichier);
	}
	
	
	if (!function_exists('set_spip_doc')){
		/**
		 * donne le chemin du fichier relatif a _DIR_IMG<br>
		 * pour stockage 'tel quel' dans la base de donnees
		 *
		 * @deprecated depuis SPIP 2.0
		 * @param  string $fichier
		 * @return string
		 */
		function set_spip_doc($fichier) {
			if (strpos($fichier, _DIR_IMG) === 0)
				return substr($fichier, strlen(_DIR_IMG));
			else
				return $fichier; // ex: fichier distant
		}
	}


	if (!function_exists('get_spip_doc')){
		/**
		 * donne le chemin complet du fichier
		 *
		 * @deprecated depuis SPIP 2.0
		 * @param  string $fichier
		 * @return string
		 */
		function get_spip_doc($fichier) {
			// fichier distant
			if (preg_match(',^\w+://,', $fichier))
				return $fichier;

			// gestion d'erreurs, fichier=''
			if (!strlen($fichier))
				return false;

			// fichier normal
			return (strpos($fichier, _DIR_IMG) === false)
				? _DIR_IMG . $fichier
				: $fichier;
		}
	}	
}
?>
