<?php
/**
 * Plugin Portfolio/Gestion des documents
 * Licence GPL (c) 2006-2008 Cedric Morin, romy.tetue.net
 *
 */

/* Pour que le pipeline de rale pas ! */
function medias_autoriser(){}


function autoriser_portfolio_administrer_dist($faire,$quoi,$id,$qui,$options) {
	return $qui['statut'] == '0minirezo';
}

function autoriser_documents21_bouton_dist($faire,$quoi,$id,$qui,$options) {
	return autoriser('administrer','portfolio',$id,$qui,$options);
}
function autoriser_documents_bouton_dist($faire,$quoi,$id,$qui,$options) {
	return autoriser('administrer','portfolio',$id,$qui,$options);
}

/**
 * Autoriser le changement des dimensions sur un document
 * @param <type> $faire
 * @param <type> $quoi
 * @param <type> $id
 * @param <type> $qui
 * @param <type> $options
 * @return <type>
 */
function autoriser_document_tailler_dist($faire,$quoi,$id,$qui,$options) {

	if (!$id_document=intval($id))
		return false;
	if (!autoriser('modifier','document',$id,$qui,$options))
		return false;
	
	if (!isset($options['document']) OR !$document = $options['document'])
		$document = sql_fetsel('*','spip_documents','id_document='.intval($id_document));
	
	// (on ne le propose pas pour les images qu'on sait
	// lire : gif jpg png), sauf bug, ou document distant
	if (in_array($document['extension'], array('gif','jpg','png'))
		AND $document['hauteur']
		AND $document['largeur']
		AND $document['distant']!='oui')
		return false;
	
	// Donnees sur le type de document
	$extension = $document['extension'];
	$type_inclus = sql_getfetsel('inclus','spip_types_documents', "extension=".sql_quote($extension));

	if (($type_inclus == "embed" OR $type_inclus == "image")
	AND (
		// documents dont la taille est definie
		($document['largeur'] * $document['hauteur'])
		// ou distants
		OR $document['distant'] == 'oui'
		// ou tous les formats qui s'affichent en embed
		OR $type_inclus == "embed"
	))
		return true;
}



/**
 * On ne peut modifier un document que s'il n'est pas lie a un objet qu'on n'a pas le droit d'editer
 *
 * @staticvar <type> $m
 * @param <type> $faire
 * @param <type> $type
 * @param <type> $id
 * @param <type> $qui
 * @param <type> $opt
 * @return <type>
 */
function autoriser_document_modifier($faire, $type, $id, $qui, $opt){
	static $m = array();

	// les admins ont le droit de modifier tous les documents
	if ($qui['statut'] == '0minirezo'
	AND !$qui['restreint'])
		return true;

	if (!isset($m[$id])) {
		// un document non publie peut etre modifie par tout le monde (... ?)
		if ($s = sql_getfetsel("statut", "spip_documents", "id_document=".intval($id))
			AND $s!=='publie')
			$m[$id] = true;
	}

	if (!isset($m[$id])) {
		$interdit = false;

		$s = sql_select("id_objet,objet", "spip_documents_liens", "id_document=".sql_quote($id));
		while ($t = sql_fetch($s)) {
			if (!autoriser('modifier', $t['objet'], $t['id_objet'], $qui, $opt)) {
				$interdit = true;
				break;
			}
		}

		$m[$id] = ($interdit?false:true);
	}

	return $m[$id];
}


/**
 * On ne peut supprimer un document que s'il n'est lie a aucun objet
 * ET qu'on a le droit de le modifier !
 *
 * @param <type> $faire
 * @param <type> $type
 * @param <type> $id
 * @param <type> $qui
 * @param <type> $opt
 * @return <type>
 */
function autoriser_document_supprimer($faire, $type, $id, $qui, $opt){
	if (!intval($id)
		OR !$qui['id_auteur']
		OR !autoriser('ecrire','','',$qui))
		return false;
	// ne pas considerer le document parent
	// (cas des vignettes ou autre document annexe rattache a un document)
	if (sql_countsel('spip_documents_liens', "objet!='document' AND id_document=".intval($id)))
		return false;

	return autoriser('modifier','document',$id,$qui,$opt);
}

function autoriser_orphelins_supprimer($faire, $type, $id, $qui, $opt){
	if ($qui['statut'] == '0minirezo'
	AND !$qui['restreint'])
		return true;
}		