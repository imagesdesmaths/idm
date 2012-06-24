<?php
/*
 * Plugin xxx
 * (c) 2009 cedric
 * Distribue sous licence GPL
 *
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

define('_BOUTON_MODE_IMAGE', true);

include_spip('inc/documents'); // pour la fonction affiche_raccourci_doc
function medias_raccourcis_doc($id_document,$titre,$descriptif,$inclus,$largeur,$hauteur,$mode,$vu){
	$raccourci = '';
	$doc = 'doc';

	if ($mode=='image' AND (strlen($descriptif.$titre) == 0))
		$doc = 'img';

	// Affichage du raccourci <doc...> correspondant
	if ($vu=='oui')
		$raccourci = affiche_raccourci_doc($doc, $id_document, '');
	else {
		$raccourci = 
			  affiche_raccourci_doc($doc, $id_document, 'left')
			. affiche_raccourci_doc($doc, $id_document, 'center')
			. affiche_raccourci_doc($doc, $id_document, 'right');
		if ($mode=='document'
			AND ($inclus == "embed" OR $inclus == "image")
			AND $largeur > 0 AND $hauteur > 0) {
			$raccourci =
			  "<span>"._T('medias:info_inclusion_vignette')."</span>"
			. $raccourci
			. "<span>"._T('medias:info_inclusion_directe')."</span>"
			. affiche_raccourci_doc('emb', $id_document, 'left')
			. affiche_raccourci_doc('emb', $id_document, 'center')
			. affiche_raccourci_doc('emb', $id_document, 'right');
		}
	}
	return "<div class='raccourcis'>".$raccourci."</div>";
}


?>
