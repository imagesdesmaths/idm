<?php
/**
 * Plugin Portfolio/Gestion des documents
 * Licence GPL (c) 2006-2008 Cedric Morin, romy.tetue.net
 *
 */

/* Pour que le pipeline de rale pas ! */
function gestdoc_autoriser(){}


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
