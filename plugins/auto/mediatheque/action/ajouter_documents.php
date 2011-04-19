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

include_spip('inc/getdocument');
include_spip('inc/documents');
include_spip('inc/ajouter_documents'); // compat core
include_spip('inc/choisir_mode_document'); // compat core
include_spip('inc/renseigner_document');

function action_ajouter_documents_dist($id_document, $files, $objet, $id_objet, $mode){
	$ajouter_un_document = charger_fonction('ajouter_un_document','action');
	$ajoutes = array();

	// on ne peut mettre qu'un seul document a la place d'un autre ou en vignette d'un autre
	if (intval($id_document)){
		$ajoutes[] = $ajouter_un_document($id_document, reset($files), $objet, $id_objet, $mode);
	}
	else
		foreach($files as $file){
			$ajoutes[] = $ajouter_un_document('new', $file, $objet, $id_objet, $mode);
		}
	return $ajoutes;
}

/**
 * Ajouter un document (au format $_FILES)
 *
 * @param  $id_document
 *    document a remplacer
 * @param  $file
 *   description au format $_FILES enrichi :
 *   tmp_name : le fichier sur le serveur (/var/tmp/xyz34)
 *   name : le nom initial chez le client (portequoi.pdf)
 *   titrer : true/false
 *   mode : choix (ou auto), image, document, vignette, ...
 *   distant : url distante
 *
 * http://doc.spip.org/@ajouter_un_document
 *
 * @param  $objet
 *   objet parent
 * @param  $id_objet
 *   id_objet du parent
 * @param  $mode
 *   mode par defaut si pas precise pour le document
 * @return array|bool|int|mixed|string|unknown
 */
function action_ajouter_un_document_dist($id_document, $file, $objet, $id_objet, $mode) {
	
	$source = $file['tmp_name'];
	$nom_envoye = $file['name'];

	// passer en minuscules le nom du fichier, pour eviter les collisions
	// si le file system fait la difference entre les deux il ne detectera
	// pas que Toto.pdf et toto.pdf
	// et on aura une collision en cas de changement de file system
	$file['name'] = strtolower(translitteration($file['name']));
	
	// Pouvoir definir dans mes_options.php que l'on veut titrer tous les documents par d�faut
	if (!defined('_TITRER_DOCUMENTS')) { define('_TITRER_DOCUMENTS', false); }

	$titrer = isset($file['titrer'])?$file['titrer']:_TITRER_DOCUMENTS;
	$mode = ((isset($file['mode']) AND $file['mode'])?$file['mode']:$mode);

	include_spip('inc/modifier');
	if (isset($file['distant']) AND $file['distant'] AND !in_array($mode,array('choix','auto','image','document'))) {
		include_spip('inc/distant');
		$file['tmp_name'] = _DIR_RACINE . copie_locale($source);
		$source = $file['tmp_name'];
		unset($file['distant']);
	}

	// Documents distants : pas trop de verifications bloquantes, mais un test
	// via une requete HEAD pour savoir si la ressource existe (non 404), si le
	// content-type est connu, et si possible recuperer la taille, voire plus.
	if (isset($file['distant']) AND $file['distant']) {
		include_spip('inc/distant');
		if (is_array($a = renseigner_source_distante($source))) {

			$champs = $a;
			# NB: dans les bonnes conditions (fichier autorise et pas trop gros)
			# $a['fichier'] est une copie locale du fichier

			unset($champs['type_image']);
		}
		// on ne doit plus arriver ici, car l'url distante a ete verifiee a la saisie !
		else {
			spip_log("Echec du lien vers le document $source, abandon");
			return $a; // message d'erreur
		}
	}
	else { // pas distant

		$champs = array(
			'distant' => 'non'
		);
		
		$type_image = ''; // au pire
		$champs['titre'] = '';
		if ($titrer){
			$titre = substr($nom_envoye,0, strrpos($nom_envoye, ".")); // Enlever l'extension du nom du fichier
			$titre = preg_replace(',[[:punct:][:space:]]+,u', ' ', $titre);
			$champs['titre'] = preg_replace(',\.([^.]+)$,', '', $titre);
		}

		if (!$fichier = fixer_fichier_upload($file))
			return ("Impossible de telecharger le fichier");
		
		$champs['inclus'] = $fichier['inclus'];
		$champs['extension'] = $fichier['extension'];
		$champs['fichier'] = $fichier['fichier'];


		$infos = renseigner_taille_dimension_image($champs['fichier'],$champs['extension']);
		if (is_string($infos))
			return $infos; // c'est un message d'erreur !
		
		$champs = array_merge($champs,$infos);

		// Si mode == 'choix', fixer le mode image/document
		if (in_array($mode,array('choix','auto'))) {
			$choisir_mode_document = charger_fonction('choisir_mode_document','inc');
			$mode = $choisir_mode_document($champs, $champs['inclus'] == 'image', $objet);
		}
		$champs['mode'] = $mode;

		if (($test = verifier_taille_document_acceptable($champs))!==true){
			spip_unlink($champs['fichier']);
			return $test; // erreur sur les dimensions du fichier
		}

		
		unset($champs['type_image']);
		unset($champs['inclus']);
		$champs['fichier'] = set_spip_doc($champs['fichier']);
	}
	
	// lier le parent si necessaire
	if ($id_objet=intval($id_objet) AND $objet)
		$champs['parents'][] = "$objet|$id_objet";

	// "mettre a jour un document" si on lui
	// passe un id_document
	if ($id_document=intval($id_document)){
		unset($champs['titre']); // garder le titre d'origine
		unset($champs['date']); // garder la date d'origine
		unset($champs['descriptif']); // garder la desc d'origine
		// unset($a['distant']); # on peut remplacer un doc statique par un doc distant
		// unset($a['mode']); # on peut remplacer une image par un document ?
	}

	include_spip('action/editer_document');
	// Installer le document dans la base
	if (!$id_document){
		$id_document = insert_document();
		spip_log ("ajout du document ".$file['tmp_name']." ".$file['name']."  (M '$mode' T '$objet' L '$id_objet' D '$id_document')");
	}
	
	document_set($id_document,$champs);

	// permettre aux plugins de faire des modifs a l'ajout initial
	// ex EXIF qui tourne les images si necessaire
	pipeline('post_edition',
		array(
			'args' => array(
				'table' => 'spip_documents', // compatibilite
				'table_objet' => 'documents',
				'spip_table_objet' => 'spip_documents',
				'type' =>'document',
				'id_objet' => $id_document,
				'champs' => array_keys($champs),
				'serveur' => '', // serveur par defaut, on ne sait pas faire mieux pour le moment
				'action' => 'ajouter_document',
				'operation' => 'ajouter_document', // compat <= v2.0
			),
			'data' => $champs
		)
	);

	return $id_document ;
}


if (!function_exists('corriger_extension')){
/**
 * Corrige l'extension du fichier dans quelques cas particuliers
 * (a passer dans ecrire/base/typedoc)
 * A noter : une extension 'pdf ' passe dans la requete de controle
 * mysql> SELECT * FROM spip_types_documents WHERE extension="pdf ";
 *
 * @param string $ext
 * @return string
 */
function corriger_extension($ext) {
	$ext = preg_replace(',[^a-z0-9],i', '', $ext);
	switch ($ext) {
		case 'htm':
			$ext='html';
			break;
		case 'jpeg':
			$ext='jpg';
			break;
		case 'tiff':
			$ext='tif';
			break;
	}
	return $ext;
}
}

/**
 * Verifie la possibilite d'uploader une extension
 * renvoie un tableau descriptif si l'extension est acceptee
 * une chaine 'zip' si il faut zipper
 * false si l'extension est refusee
 * 
 */
function verifier_upload_autorise($source){
	if (preg_match(",\.([^.]+)$,", $source, $match)
	  AND $ext = $match[1]){
		
	  $ext = corriger_extension(strtolower($ext));
		if ($row = sql_fetsel("extension,inclus", "spip_types_documents", "extension=" . sql_quote($ext) . " AND upload='oui'"))
			return $row;
	}
		
	if (sql_countsel("spip_types_documents", "extension='zip' AND upload='oui'"))
		return 'zip';

	spip_log("Extension $ext interdite a l'upload");
	return false;
}


/**
 * tester le type de document :
 * - interdit a l'upload ?
 * - quelle extension dans spip_types_documents ?
 * - est-ce "inclus" comme une image ?
 * 
 * le zipper si necessaire
 * 
 * @param array $file //format $_FILES
 * @return array
 */
function fixer_fichier_upload($file){



	if (is_array($row=verifier_upload_autorise($file['name']))) {
		$row['fichier'] = copier_document($row['extension'], $file['name'], $file['tmp_name']);
		return $row;
	}
	// creer un zip comme demande
	// pour encapsuler un fichier dont l'extension n'est pas supportee
	elseif($row==='zip'){
		
		$row = array('extension'=>'zip','inclus'=>false);

		$ext = 'zip';
		if (!$tmp_dir = tempnam(_DIR_TMP, 'tmp_upload'))
			return false;
	
		spip_unlink($tmp_dir);
		@mkdir($tmp_dir);
		
		include_spip('inc/charset');
		$tmp = $tmp_dir.'/'.translitteration($file['name']);
		
		$file['name'] .= '.zip'; # conserver l'extension dans le nom de fichier, par exemple toto.js => toto.js.zip

		// deplacer le fichier tmp_name dans le dossier tmp
		deplacer_fichier_upload($file['tmp_name'], $tmp, true);
		
		include_spip('inc/pclzip');
		$source = _DIR_TMP . basename($tmp_dir) . '.zip';
		$archive = new PclZip($source);
		
		$v_list = $archive->create($tmp,
				PCLZIP_OPT_REMOVE_PATH, $tmp_dir,
				PCLZIP_OPT_ADD_PATH, '');
		
		effacer_repertoire_temporaire($tmp_dir);
		if (!$v_list) {
			spip_log("Echec creation du zip ");
			return false;
		}
		
		$row['fichier']  = copier_document($row['extension'], $file['name'], $source);
		spip_unlink($source);
		return $row;
	}
	
	return false;
}


function verifier_taille_document_acceptable($infos){
	
	// si ce n'est pas une image
	if (!$infos['type_image']) {
		if (_DOC_MAX_SIZE > 0
		 AND $infos['taille'] > _DOC_MAX_SIZE*1024)
			return _T('medias:info_doc_max_poids', array('maxi' => taille_en_octets(_DOC_MAX_SIZE*1024), 'actuel' => taille_en_octets($infos['taille'])));

		if ($infos['mode'] == 'image')
			return _T('medias:erreur_format_fichier_image',array('nom'=> $infos['fichier']));
	}
	
	// si c'est une image
	else {

		if (_IMG_MAX_SIZE > 0
		 AND $infos['taille'] > _IMG_MAX_SIZE*1024)
			return _T('medias:info_image_max_poids', array('maxi' => taille_en_octets(_IMG_MAX_SIZE*1024), 'actuel' => taille_en_octets($infos['taille'])));
	
		if (_IMG_MAX_WIDTH * _IMG_MAX_HEIGHT
		 AND ($infos['largeur'] > _IMG_MAX_WIDTH
		 OR $infos['hauteur'] > _IMG_MAX_HEIGHT))

			return _T('info_logo_max_taille',
					array(
					'maxi' =>
						_T('info_largeur_vignette',
							array('largeur_vignette' => _IMG_MAX_WIDTH,
							'hauteur_vignette' => _IMG_MAX_HEIGHT)),
					'actuel' =>
						_T('info_largeur_vignette',
							array('largeur_vignette' => $infos['largeur'],
							'hauteur_vignette' => $infos['hauteur']))
				));
	}

  // verifier en fonction du mode si une fonction est proposee
	if ($verifier_document_mode = charger_fonction("verifier_document_mode_".$infos['mode'],"inc",true))
		return $verifier_document_mode($infos);

	return true;
}


?>