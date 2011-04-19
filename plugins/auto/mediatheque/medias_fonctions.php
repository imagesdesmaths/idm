<?php
/**
 * Plugin Portfolio/Gestion des documents
 * Licence GPL (c) 2006-2008 Cedric Morin, romy.tetue.net
 *
 */

/**
 * Enter description here...
 *
 * @param unknown_type $id_document
 * @param unknown_type $statut
 * @param unknown_type $id_rubrique
 * @param unknown_type $type
 * @param unknown_type $ajax
 * @return unknown
 */
function medias_puce_statut_document($id_document, $statut){
	if ($statut=='publie') {
		$puce='puce-verte.gif';
	}
	else if ($statut == "prepa") {
		$puce = 'puce-blanche.gif';
	}
	else if ($statut == "poubelle") {
		$puce = 'puce-poubelle.gif';
	}
	else 
		$puce = 'puce-blanche.gif';

	return http_img_pack($puce, $statut, "class='puce'");
}



//
// <BOUCLE(DOCUMENTS)>
//
// http://doc.spip.org/@boucle_DOCUMENTS_dist
function boucle_DOCUMENTS($id_boucle, &$boucles) {
	$boucle = &$boucles[$id_boucle];
	$id_table = $boucle->id_table;

	// on ne veut pas des fichiers de taille nulle,
	// sauf s'ils sont distants (taille inconnue)
	array_unshift($boucle->where,array("'($id_table.taille > 0 OR $id_table.distant=\\'oui\\')'"));

	// Supprimer les vignettes
	if (!isset($boucle->modificateur['criteres']['mode'])
	AND !isset($boucle->modificateur['criteres']['tout'])) {
		array_unshift($boucle->where,array("'IN'", "'$id_table.mode'", "'(\\'image\\',\\'document\\')'"));
	}

	// Pour une boucle generique (DOCUMENTS) sans critere de lien, verifier
	// qu notre document est lie a un element publie
	// (le critere {tout} permet de les afficher tous quand meme)
	// S'il y a un critere de lien {id_article} par exemple, on zappe
	// ces complications (et tant pis si la boucle n'a pas prevu de
	// verification du statut de l'article)
	if (!isset($boucle->modificateur['tout'])
	AND !isset($boucle->modificateur['criteres']['statut'])
	) {
		if ($GLOBALS['var_preview']) {
			array_unshift($boucle->where,"'($id_table.statut IN (\"publie\",\"prop\",\"prepa\"))'");
		} else {
			if ($GLOBALS['meta']["post_dates"] == 'non')
				array_unshift($boucle->where,array("'<'", "'$id_table" . ".date_publication'", "sql_quote(quete_date_postdates())"));
			array_unshift($boucle->where,"'(($id_table.statut = \"publie\"))'");
		}
	}

	return calculer_boucle($id_boucle, $boucles);
}

function lien_objet($id,$type,$longueur=80,$connect=NULL){
	include_spip('inc/liens');
	$titre = traiter_raccourci_titre($id, $type, $connect);
	$titre = typo($titre['titre']);
	if (!strlen($titre))
		$titre = _T('info_sans_titre');
	$url = generer_url_entite($id,$type);
	return "<a href='$url' class='$type'>".couper($titre,$longueur)."</a>";
}

function critere_DOCUMENTS_orphelins_dist($idb, &$boucles, $crit) {

	$boucle = &$boucles[$idb];
	$quoi = '@$Pile[0]["orphelins"]';
	$cond = $crit->cond;
	$not = $crit->not?"":"NOT";

	$select = sql_get_select("DISTINCT id_document","spip_documents_liens as oooo");
	$where = "'".$boucle->id_table.".id_document $not IN ($select)'";
	if ($cond)
		$where = "($quoi)?$where:''";
	
	$boucle->where[]= $where;
}

?>