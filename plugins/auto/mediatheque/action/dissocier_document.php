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


function action_dissocier_document_dist(){
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	$arg = explode('-',$arg);

	list($id_objet, $objet, $document) = $arg;
	$suppr=false;
	if (count($arg)>3 AND $arg[3]=='suppr')
		$suppr = true;
	if (count($arg)>4 AND $arg[4]=='safe')
		$check = true;
	if ($id_objet=intval($id_objet)	AND autoriser('modifier',$objet,$id_objet))
		dissocier_document($document, $objet, $id_objet, $suppr, $check);
	else
		spip_log("Interdit de modifier $objet $id_objet","spip");
}

// http://doc.spip.org/@supprimer_lien_document
function supprimer_lien_document($id_document, $objet, $id_objet, $supprime = false, $check = false) {
	if (!$id_document = intval($id_document))
		return false;

	// D'abord on ne supprime pas, on dissocie
	sql_delete("spip_documents_liens", "id_objet=".intval($id_objet)." AND objet=".sql_quote($objet)." AND id_document=".$id_document);

	// Si c'est une vignette, l'eliminer du document auquel elle appartient
	// cas tordu peu probable
	sql_updateq("spip_documents", array('id_vignette' => 0), "id_vignette=".$id_document);

	pipeline('post_edition',
		array(
			'args' => array(
				'operation' => 'delier_document',
				'table' => 'spip_documents',
				'id_objet' => $id_document,
				'objet' => $objet,
				'id' => $id_objet
			),
			'data' => null
		)
	);

	if ($check) {
		// si demande, on verifie que ses documents vus sont bien lies !
		$spip_table_objet = table_objet_sql($objet);
		$table_objet = table_objet($objet);
		$id_table_objet = id_table_objet($objet,$serveur);
		$champs = sql_fetsel('*',$spip_table_objet,addslashes($id_table_objet)."=".intval($id_objet));

		$marquer_doublons_doc = charger_fonction('marquer_doublons_doc','inc');
		$marquer_doublons_doc($champs,$id_objet,$objet,$id_table_objet,$table_objet,$spip_table_objet, '', $serveur);
	}

	// On supprime ensuite s'il est orphelin
	// et si demande
	// ici on ne bloque pas la suppression d'un document rattache a un autre
	if ($supprime AND !sql_countsel('spip_documents_liens', "objet!='document' AND id_document=".$id_document)){
		$supprimer_document = charger_fonction('supprimer_document','action');
		return $supprimer_document($id_document);
	}
}

function dissocier_document($document, $objet, $id_objet, $supprime = false, $check = false){
	if ($id_document=intval($document)) {
		supprimer_lien_document($id_document, $objet, $id_objet, $supprime, $check);
	}
	else {
		list($image,$mode) = explode('/',$document);
		$image = ($image=='I');
		$typdoc = sql_in('docs.extension', array('gif', 'jpg', 'png'), $image  ? '' : 'NOT');

		$obj = "id_objet=".intval($id_objet)." AND objet=".sql_quote($objet);

		$s = sql_select('docs.id_document',
			"spip_documents AS docs LEFT JOIN spip_documents_liens AS l ON l.id_document=docs.id_document",
			"$obj AND vu='non' AND docs.mode=".sql_quote($mode)." AND $typdoc");
		while ($t = sql_fetch($s)) {
			supprimer_lien_document($t['id_document'], $objet, $id_objet, $supprime, $check);
		}
	}

	// pas tres generique ca ...
	if ($objet == 'rubrique') {
		include_spip('inc/rubriques');
		depublier_branche_rubrique_if($id);
	}
}
?>
