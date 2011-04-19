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

include_spip('inc/actions'); // *action_auteur et determine_upload
include_spip('inc/date');

// donne le chemin du fichier relatif a _DIR_IMG
// pour stockage 'tel quel' dans la base de donnees
// http://doc.spip.org/@set_spip_doc
function set_spip_doc($fichier) {
	if (strpos($fichier, _DIR_IMG) === 0)
		return substr($fichier, strlen(_DIR_IMG));
	else
		return $fichier; // ex: fichier distant
}

// donne le chemin complet du fichier
// http://doc.spip.org/@get_spip_doc
function get_spip_doc($fichier) {
	// fichier distant
	if (preg_match(',^\w+://,', $fichier))
		return $fichier;

	// gestion d'erreurs, fichier=''
	if (!strlen($fichier))
		return false;

	$fichier = (strpos($fichier, _DIR_IMG) === false)
		? _DIR_IMG . $fichier
		: $fichier ;

	// fichier normal
	return $fichier;
}

// Constante indiquant le charset probable des documents non utf-8 joints

@define('CHARSET_JOINT', 'iso-8859-1');

// Filtre pour #FICHIER permettant d'incruster le contenu d'un document
// Si 2e arg fourni, conversion dans le charset du site si possible

// http://doc.spip.org/@contenu_document
function contenu_document($arg, $charset='')
{
	if (is_numeric($arg)) {
		$r = sql_fetsel("fichier,distant", "spip_documents", "id_document=".sql_quote($arg));
		if (!$r) return '';
		$f = $r['fichier'];
		$f = ($r['distant'] =='oui') ? _DIR_RACINE . copie_locale($f) : get_spip_doc($f);
	}
	else {
		if (!@file_exists($f=$arg)){
			if (!$f = copie_locale($f))
				return '';
			$f = _DIR_RACINE . $f;
		}
	}

	$r = spip_file_get_contents($f);

	if ($charset) {
		include_spip('inc/charset');
		if ($charset !== 'auto') {
			$r = importer_charset($r, $charset);
		} elseif ($GLOBALS['meta']['charset'] == 'utf-8' AND !is_utf8($r))
			$r = importer_charset($r, CHARSET_JOINT);
	}
	return $r;
}

// http://doc.spip.org/@generer_url_document_dist
function generer_url_document_dist($id_document, $args='', $ancre='') {

	include_spip('inc/autoriser');
	if (!autoriser('voir', 'document', $id_document)) return '';

	$r = sql_fetsel("fichier,distant", "spip_documents", "id_document=".sql_quote($id_document));

	if (!$r) return '';

	$f = $r['fichier'];

	if ($r['distant'] == 'oui')
		// on passe quand meme par get_spip_doc car un document distant
		// peut avoir une url locale suite a une rotation
		return get_spip_doc($f);

	// Si droit de voir tous les docs, pas seulement celui-ci
	// il est inutilement couteux de rajouter une protection

	$r = autoriser('voir', 'document');

	if ($r AND $r !== 'htaccess') return get_spip_doc($f);

	include_spip('inc/securiser_action');

	// cette action doit etre publique !
	return generer_url_action('acceder_document',
		$args . ($args ? "&" : '')
			. 'arg='.$id_document
			. ($ancre ? "&ancre=$ancre" : '')
			. '&cle=' . calculer_cle_action($id_document.','.$f)
			. '&file=' . rawurlencode($f)
			,false,true);
}

//
// Vignette pour les documents lies
// Fonction rendue surchargeable dans inc/vignette
// Laissée pour compatibilité SPIP < 2.1.0 rev 15773
// Appelé dans public/quete

// http://doc.spip.org/@vignette_par_defaut
function vignette_par_defaut($ext, $size=true, $loop = true) {

	if (!$ext)
		$ext = 'txt';


	// Chercher la vignette correspondant a ce type de document
	// dans les vignettes persos, ou dans les vignettes standard
	if (
	# installation dans un dossier /vignettes personnel, par exemple /squelettes/vignettes
	!@file_exists($v = find_in_path("vignettes/".$ext.".png"))
	AND !@file_exists($v = find_in_path("vignettes/".$ext.".gif"))
	# dans /icones (n'existe plus)
	AND !@file_exists($v = _DIR_IMG_ICONES . $ext.'.png')
	AND !@file_exists($v = _DIR_IMG_ICONES . $ext.'.gif')
	# icones standard
	AND !@file_exists($v = _DIR_IMG_ICONES_DIST . $ext.'.png')
	# cas d'une install dans un repertoire "applicatif"...
	AND !@file_exists(_ROOT_IMG_ICONES_DIST . $v)
	)
		if ($loop)
			$v = vignette_par_defaut('defaut', false, $loop=false);
		else
			$v = false; # pas trouve l'icone de base

	if (!$size) return $v;

	if ($size = @getimagesize($v)) {
		$largeur = $size[0];
		$hauteur = $size[1];
	}

	return array($v, $largeur, $hauteur);
}

//
// Affiche le document avec sa vignette par defaut
//
// Attention : en mode 'doc', si c'est un fichier graphique on prefere
// afficher une vue reduite, quand c'est possible (presque toujours, donc)
// En mode 'image', l'image conserve sa taille
//
// A noter : dans le portfolio prive on pousse le vice jusqu'a reduire la taille
// de la vignette -> c'est a ca que sert la variable $portfolio
// http://doc.spip.org/@image_pattern
// TO BE DELETED
function image_pattern($vignette) {
	return "<img src='"
			. get_spip_doc($vignette['fichier'])."'
			alt=' '
			width='".$vignette['largeur']."'
			height='".$vignette['hauteur']."' />";
}

//
// Affiche le document avec sa vignette par defaut
//
// Attention : en mode 'doc', si c'est un fichier graphique on prefere
// afficher une vue reduite, quand c'est possible (presque toujours, donc)
// En mode 'image', l'image conserve sa taille
//
// A noter : dans le portfolio prive on pousse le vice jusqu'a reduire la taille
// de la vignette -> c'est a ca que sert la variable $portfolio
// http://doc.spip.org/@vignette_automatique
// TO BE DELETED // utilise par ecrire/quete.php
function vignette_automatique($img, $doc, $lien, $x=0, $y=0, $align='', $class='spip_logos')
{
	include_spip('inc/distant');
	include_spip('inc/filtres');
	include_spip('inc/filtres_images_mini');
	$e = $doc['extension'];
	if (!$img) {
		if ($img = image_du_document($doc)) {
			if (!$x AND !$y) // eviter une double reduction
				$img = image_reduire($img);
		}
		else{
			$f = charger_fonction('vignette','inc');
			$img = $f($e, false);
			$size = @getimagesize($img);
			$img = "<img src='$img' ".$size[3]." />";
		}
	}
	else{
		$size = @getimagesize($img);
		$img = "<img src='$img' ".$size[3]." />";
	}
	// on appelle image_reduire independamment de la presence ou non
	// des librairies graphiques
	// la fonction sait se debrouiller et faire de son mieux dans tous les cas
	if ($x OR $y) {
		$img = image_reduire($img, $x, $y);
	}
	$img = inserer_attribut($img, 'alt', '');
	$img = inserer_attribut($img, 'class', $class);
	if ($align) $img = inserer_attribut($img, 'align', $align);

	if (!$lien) return $img;

	$titre = supprimer_tags(typo($doc['titre']));
	$titre = " - " .taille_en_octets($doc['taille'])
	  . ($titre ? " - $titre" : "");

	include_spip('base/abstract_sql');
	$type = sql_fetsel('titre, mime_type','spip_types_documents', "extension = " . sql_quote($e));

	$mime = $type['mime_type'];
	$titre = attribut_html(couper($type['titre'] . $titre, 80));

	return "<a href='$lien' type='$mime' title='$titre'>$img</a>";
}
// Trouve une image caracteristique d'un document.
// Si celui-ci est une image et que les outils graphiques sont dispos,
// retourner le document (en exploitant sa copie locale s'il est distant).
// Autrement retourner la vignette fournie par SPIP pour ce type MIME
// Resultat: un fichier local existant
// TO BE DELETED // utilise par vignette_automatique() ci-dessus
function image_du_document($document)
{
	$e = $document['extension'];
	if ((strpos($GLOBALS['meta']['formats_graphiques'], $e) !== false)
	  AND (!test_espace_prive() OR $GLOBALS['meta']['creer_preview']=='oui')
	  AND $document['fichier']) {
		if ($document['distant'] == 'oui') {
			$image = _DIR_RACINE.copie_locale($document['fichier']);
		}
		else
			$image = get_spip_doc($document['fichier']);
		if (@file_exists($image)) return $image;
	}
	return '';
}


// http://doc.spip.org/@document_et_vignette
// TO BE DELETED // utilise par tourner()
function document_et_vignette($document, $url, $portfolio=false) {
	$extension = $document['extension'];
	$vignette = $document['id_vignette'];

	if ($vignette)
		$vignette = sql_fetsel("*", "spip_documents", "id_document = ".$vignette);
	if ($vignette) {
		include_spip('inc/filtres');
		$loc = get_spip_doc($vignette['fichier']);
		$image = filtrer('image_reduire', $loc, 120, 110, false, true);
		if ($loc == $image)
			$image = image_pattern($vignette);
	}
	else if (in_array($extension,
		explode(',', $GLOBALS['meta']['formats_graphiques']))
	AND $GLOBALS['meta']['creer_preview'] == 'oui') {
		include_spip('inc/distant');
		include_spip('inc/filtres');

		// Si le document distant a une copie locale, on peut l'exploiter
		if ($document['distant'] == 'oui') {
			$image = _DIR_RACINE.copie_locale($document['fichier'], 'test');
		} else {
			$image = get_spip_doc($document['fichier']);
		}

		if ($image) {
			if ($portfolio) {
				$image = filtrer('image_reduire',	$image,	110, 120, false, true);
			} else {
				$image = filtrer('image_reduire',	$image,	-1,-1,false, true);
			}
			$image = inserer_attribut($image, "class", "miniature_document");
		}
	} else {
		$image = '';
	}

	if (!$image) {
		$f = charger_fonction('vignette','inc');
		list($fichier, $largeur, $hauteur) = $f($extension);
		$image = "<img src='$fichier'\n\theight='$hauteur' style='' width='$largeur' alt=' ' />";
	} else $image = inserer_attribut($image, 'alt', ' ');

	if (!$url)
		return $image;
	else {
		$t = sql_fetsel("mime_type", "spip_types_documents", "extension=".sql_quote($document['extension']));
		return "<a href='$url'\n\ttype='".$t['mime_type']."'>$image</a>";
	}
}


//
// Afficher un document dans la colonne de gauche
//

// http://doc.spip.org/@afficher_documents_colonne
// TO BE DELETED
function afficher_documents_colonne($id, $type="article",$script=NULL) {
	if (!is_array($GLOBALS['medias_exec_colonne_document']) OR !in_array(_request('exec'),$GLOBALS['medias_exec_colonne_document']))
		$GLOBALS['medias_exec_colonne_document'][] = _request('exec');
	return "";
	include_spip('inc/autoriser');

	// il faut avoir les droits de modif sur l'article pour pouvoir uploader !
	if (!autoriser('joindredocument',$type,$id))
		return "";

	include_spip('inc/presentation'); // pour l'aide quand on appelle afficher_documents_colonne depuis un squelette
	// seuls cas connus : article, breve ou rubrique
	if ($script==NULL){
		$script = $type.'s_edit';
		if (!test_espace_prive())
			$script = parametre_url(self(),"show_docs",'');
	}
	$id_document_actif = _request('show_docs');

	$joindre = charger_fonction('joindre', 'inc');

	define('_INTERFACE_DOCUMENTS', true);
	if (!_INTERFACE_DOCUMENTS
	OR $GLOBALS['meta']["documents_$type"]=='non') {

	// Ajouter nouvelle image
	$ret = "<div id='images'>\n"
		. $joindre(array(
			'cadre' => 'relief',
			'icone' => 'image-24.gif',
			'fonction' => 'creer.gif',
			'titre' => majuscules(_T('bouton_ajouter_image')).aide("ins_img"),
			'script' => $script,
			'args' => "id_$type=$id",
			'id' => $id,
			'intitule' => _T('info_telecharger'),
			'mode' => 'image',
			'type' => $type,
			'ancre' => '',
			'id_document' => 0,
			'iframe_script' => generer_url_ecrire("documents_colonne","id=$id&type=$type",true)
		))
		. '</div><br />';

	if (!_INTERFACE_DOCUMENTS) {
		//// Images sans documents
		$res = sql_select("D.id_document", "spip_documents AS D LEFT JOIN spip_documents_liens AS T ON T.id_document=D.id_document", "T.id_objet=" . intval($id) . " AND T.objet=" . sql_quote($type) . " AND D.mode='image'", "", "D.id_document");

		$ret .= "\n<div id='liste_images'>";

		while ($doc = sql_fetch($res)) {
			$id_document = $doc['id_document'];
			$deplier = ($id_document_actif==$id_document);
			$ret .= afficher_case_document($id_document, $id, $script, $type, $deplier);
		}

		$ret .= "</div><br /><br />\n";
	}
	}

	/// Ajouter nouveau document
	$bouton = !_INTERFACE_DOCUMENTS
		? majuscules(_T('bouton_ajouter_document')).aide("ins_doc")
		: (_T('bouton_ajouter_image_document')).aide("ins_doc");

	$ret .= "<div id='documents'></div>\n<div id='portfolio'></div>\n";
	if ($GLOBALS['meta']["documents_$type"]!='non') {
		$ret .= $joindre(array(
			'cadre' => _INTERFACE_DOCUMENTS ? 'relief' : 'enfonce',
			'icone' => 'doc-24.gif',
			'fonction' => 'creer.gif',
			'titre' => $bouton,
			'script' => $script,
			'args' => "id_$type=$id",
			'id' => $id,
			'intitule' => _T('info_telecharger'),
			'mode' => _INTERFACE_DOCUMENTS ? 'choix' : 'document',
			'type' => $type,
			'ancre' => '',
			'id_document' => 0,
			'iframe_script' => generer_url_ecrire("documents_colonne","id=$id&type=$type",true)
		));
	}

	// Afficher les documents lies
	$ret .= "<br /><div id='liste_documents'>\n";

	//// Documents associes
	$res = sql_select("D.id_document", "spip_documents AS D LEFT JOIN spip_documents_liens AS T ON T.id_document=D.id_document", "T.id_objet=" . intval($id) . " AND T.objet=" . sql_quote($type)
	. ((!_INTERFACE_DOCUMENTS)
		? " AND D.mode='document'"
    	: " AND D.mode IN ('image','document')"
	), "", "D.mode, D.id_document");

	while($row = sql_fetch($res))
		$ret .= afficher_case_document($row['id_document'], $id, $script, $type, ($id_document_actif==$row['id_document']));

	$ret .= "</div>";
	if (test_espace_prive()){
		$ret .= http_script('', "async_upload.js")
		  . http_script('$("form.form_upload").async_upload(async_upload_article_edit)');
	}

	return $ret;
}

//
// Affiche le raccourci <doc123|left>
// et l'insere quand on le clique
//
// http://doc.spip.org/@affiche_raccourci_doc
function affiche_raccourci_doc($doc, $id, $align) {
	static $num = 0;

	if ($align) {
		$pipe = "|$align";

		if ($GLOBALS['browser_barre'])
			$onclick = "\nondblclick=\"barre_inserer('\\x3C$doc$id$pipe&gt;', $('textarea[name=texte]')[0]);\"\ntitle=\"". str_replace('&amp;', '&', entites_html(_T('double_clic_inserer_doc')))."\"";
	} else {
		$align='center';
	}

	return
	  ((++$num > 1) ? "" : http_script('',  "spip_barre.js"))
		. "\n<div style='text-align: $align'$onclick>&lt;$doc$id$pipe&gt;</div>\n";
}


// Est-ce que le document est inclus dans le texte ?
// http://doc.spip.org/@est_inclus
// TO BE DELETED
function est_inclus($id_document) {
	return isset($GLOBALS['doublons_documents_inclus']) ?
		in_array($id_document,$GLOBALS['doublons_documents_inclus']) : false;
}

//
// Afficher un document sous forme de ligne depliable (pages xxx_edit)
//
// TODO: il y a du code a factoriser avec inc/documenter

// http://doc.spip.org/@afficher_case_document
// TO BE DELETED
function afficher_case_document($id_document, $id, $script, $type, $deplier=false) {
	global $spip_lang_right;

	$document = sql_fetsel("docs.id_document, docs.id_vignette,docs.extension,docs.titre,docs.descriptif,docs.fichier,docs.largeur,docs.hauteur,docs.taille,docs.mode,docs.distant, docs.date, L.vu", "spip_documents AS docs INNER JOIN spip_documents_liens AS L ON L.id_document=docs.id_document", "L.id_objet=".intval($id)." AND objet=".sql_quote($type)." AND L.id_document=".sql_quote($id_document));

	if (!$document) return "";

	$id_vignette = $document['id_vignette'];
	$extension = $document['extension'];
	$titre = $document['titre'];
	$descriptif = $document['descriptif'];
	$url = generer_url_entite($id_document, 'document');
	$fichier = $document['fichier'];
	$largeur = $document['largeur'];
	$hauteur = $document['hauteur'];
	$taille = $document['taille'];
	$mode = $document['mode'];
	$distant = $document['distant'];

	// le doc est-il appele dans le texte ?
	$doublon = est_inclus($id_document);

	$cadre = strlen($titre) ? $titre : basename($fichier);

	$letype = sql_fetsel("titre,inclus", "spip_types_documents", "extension=".sql_quote($extension));
	if ($letype) {
		$type_inclus = $letype['inclus'];
		$type_titre = $letype['titre'];
	}
	//
	// Afficher un document
	//
	$ret = "";
	if ($mode == 'document') {

		$ret .= debut_cadre_enfonce("doc-24.gif", true, "", lignes_longues(typo($cadre),20), "document$id_document");
		$ret .= "<a name='document$id_document'></a>\n";

		if ($distant == 'oui') {
			$dist = "\n<div class='verdana1' style='float: $spip_lang_right; text-align: $spip_lang_right;'>";

			// Signaler les documents distants par une icone de trombone
			$dist .= "\n<img src='" . chemin_image('attachment.gif') . "'\n\talt=\"$fichier\"\n\ttitle=\"$fichier\" />\n";
			// Bouton permettant de copier en local le fichier
			include_spip('inc/tourner');
			$dist .= bouton_copier_local($document, $type, $id, $id_document, $script);

			$dist .="</div>\n";
		} else {
			$dist = '';
		}

		//
		// Affichage de la vignette
		//
		$ret .= "\n<div style='text-align: center'>"
		. $dist
		. document_et_vignette($document, $url, true)
		. '</div>'
		. "\n<div class='verdana1' style='text-align: center; color: black;'>\n"
		. ($type_titre ? $type_titre :
		      ( _T('info_document').' '.majuscules($extension)))
		. "</div>";

		// Affichage du raccourci <doc...> correspondant
		$raccourci = '';
		if ($doublon)
			$raccourci .= affiche_raccourci_doc('doc', $id_document, '');
		else {
			if (($type_inclus == "embed" OR $type_inclus == "image") AND $largeur > 0 AND $hauteur > 0) {
				$raccourci .= "<b>"._T('info_inclusion_vignette')."</b><br />";
			}
			$raccourci .= "<div style='color: 333333'>"
			. affiche_raccourci_doc('doc', $id_document, 'left')
			. affiche_raccourci_doc('doc', $id_document, 'center')
			. affiche_raccourci_doc('doc', $id_document, 'right')
			. "</div>\n";

			if (($type_inclus == "embed" OR $type_inclus == "image") AND $largeur > 0 AND $hauteur > 0) {
				$raccourci .= "<div style='padding:2px; ' class='arial1 spip_xx-small'>";
				$raccourci .= "<b>"._T('info_inclusion_directe')."</b><br />";
				$raccourci .= "<div style='color: 333333'>"
				. affiche_raccourci_doc('emb', $id_document, 'left')
				. affiche_raccourci_doc('emb', $id_document, 'center')
				. affiche_raccourci_doc('emb', $id_document, 'right')
				. "</div>\n";
				$raccourci .= "</div>";
			}
		}

		$ret .= "\n<div style='padding:2px; ' class='arial1 spip_xx-small'>"
			. $raccourci."</div>\n";

		$legender = charger_fonction('legender', 'inc');
		$ret .= $legender($id_document, $document, $script, $type, $id, "document$id_document", $deplier);

		$ret .= fin_cadre_enfonce(true);

	} else if ($mode == 'image') {

	//
	// Afficher une image inserable dans l'article
	//

	  $ret .= debut_cadre_relief("image-24.gif", true, "", lignes_longues(typo($cadre),20), "document$id_document");

		//
		// Afficher un apercu (pour les images)
		//
		if ($type_inclus == 'image') {
			$ret .= "<div style='text-align: center; padding: 2px;'>\n";
			$ret .= document_et_vignette($document, $url, true);
			$ret .= "</div>\n";
		}

		//
		// Preparer le raccourci a afficher sous la vignette ou sous l'apercu
		//
		$raccourci = "";
		if (strlen($descriptif) > 0 OR strlen($titre) > 0)
			$doc = 'doc';
		else
			$doc = 'img';

		if ($doublon)
			$raccourci .= affiche_raccourci_doc($doc, $id_document, '');
		else {
			$raccourci .=
				affiche_raccourci_doc($doc, $id_document, 'left')
				. affiche_raccourci_doc($doc, $id_document, 'center')
				. affiche_raccourci_doc($doc, $id_document, 'right');
		}

		$ret .= "\n<div style='padding:2px; ' class='arial1 spip_xx-small'>"
			. $raccourci."</div>\n";


		$legender = charger_fonction('legender', 'inc');
		$ret .= $legender($id_document, $document, $script, $type, $id, "document$id_document", $deplier);

		$ret .= fin_cadre_relief(true);
	}
	return "<div>$ret</div>"; // on encapsule chaque document dans un container pour permettre son remplacement en ajax
}

// Etablit la liste des documents orphelins, c'est-a-dire qui ne sont lies
// a rien ; renvoie un tableau (id_document)
// ici on ne join pas avec la table objet pour voir si l'objet existe vraiment
// on considere que c'est le role d'optimiser que de nettoyer les liens morts
// sinon eventuellement appeler avant une fonction nettoyer_liens_documents
// http://doc.spip.org/@lister_les_documents_orphelins
/*
function lister_les_documents_orphelins() {
	$s = sql_select("d.id_document, d.id_vignette",
	"spip_documents AS d LEFT JOIN spip_documents_liens AS l ON d.id_document=l.id_document",
	"(l.id_objet IS NULL)");

	$orphelins = array();
	while ($t = sql_fetch($s)) {
		$orphelins[$t['id_document']] = true;
		// la vignette d'un orphelin est orpheline
		if ($t['id_vignette'])
			$orphelins[$t['id_vignette']] = true;

	}

	// les vignettes qui n'appartiennent a aucun document sont aussi orphelines
	$s = sql_select("v.id_document",
	"spip_documents AS v LEFT JOIN spip_documents AS d ON v.id_document=d.id_vignette",
	"v.mode='vignette' AND d.id_document IS NULL");
	while ($t = sql_fetch($s))
		$orphelins[$t['id_document']] = true;

	return array_keys(array_filter($orphelins));
}

 */

// Supprimer les documents de la table spip_documents,
// ainsi que les fichiers correspondants dans IMG/
// Fonction a n'appeler que sur des documents orphelins
// http://doc.spip.org/@supprimer_documents
/*
function supprimer_documents($liste = array()) {
	if (!count($liste))
		return;

	$in = sql_in('id_document', $liste);

	// Supprimer les fichiers locaux et les copies locales
	// des docs distants
	$s = sql_select("fichier, distant", "spip_documents", $in);
	while ($t = sql_fetch($s)) {
		if ($t['distant'] == 'oui') {
			include_spip('inc/distant');
			if ($local = copie_locale($t['fichier'], 'test'))
				spip_log("efface $local = ".$t['fichier']);
				supprimer_fichier($local);
		}
		else {
			if (@file_exists($f = get_spip_doc($t['fichier']))) {
				spip_log("efface $f");
				supprimer_fichier($f);
			}
		}
	}

	// Supprimer les entrees dans spip_documents et associees
	sql_delete('spip_documents', $in);
	// en principe il ne devrait rien y avoir ici si les documents sont bien orphelins
	sql_delete('spip_documents_liens', $in);
}
*/
?>
