<?php
/*
 * Plugin xxx
 * (c) 2009 cedric
 * Distribue sous licence GPL
 *
 */


// http://doc.spip.org/@marquer_doublons_documents
function inc_marquer_doublons_doc_dist($champs,$id,$type,$id_table_objet,$table_objet,$spip_table_objet, $desc=array(), $serveur=''){
	if (!isset($champs['texte']) AND !isset($champs['chapo'])) return;
	if (!$desc){
		$trouver_table = charger_fonction('trouver_table', 'base');
		$desc = $trouver_table($table_objet, $serveur);
	}
	$load = "";

	// charger le champ manquant en cas de modif partielle de l'objet
	// seulement si le champ existe dans la table demande
	if (!isset($champs['texte']) && isset($desc['field']['texte'])) $load = 'texte';
	if (!isset($champs['chapo']) && isset($desc['field']['chapo'])) $load = 'chapo';
	if ($load){
		$champs[$load] = "";
		$row = sql_fetsel($load, $spip_table_objet, "$id_table_objet=".sql_quote($id));
		if ($row AND isset($row[$load]))
			$champs[$load] = $row[$load];
	}
	include_spip('inc/texte');
	include_spip('base/abstract_sql');
	$GLOBALS['doublons_documents_inclus'] = array();
	traiter_modeles($champs['chapo'].$champs['texte'],true); // detecter les doublons
	sql_updateq("spip_documents_liens", array("vu" => 'non'), "id_objet=$id AND objet=".sql_quote($type));
	if (count($GLOBALS['doublons_documents_inclus'])){
		// on repasse par une requete sur spip_documents pour verifier que les documents existent bien !
		$in_liste = sql_in('id_document',
			$GLOBALS['doublons_documents_inclus']);
		$res = sql_select("id_document", "spip_documents", $in_liste);
		while ($row = sql_fetch($res)) {
			// Creer le lien s'il n'existe pas deja
			sql_insertq("spip_documents_liens", array('id_objet'=>$id, 'objet'=>$type, 'id_document' => $row['id_document'], 'vu' => 'oui'));
			sql_updateq("spip_documents_liens", array("vu" => 'oui'), "id_objet=$id AND objet=".sql_quote($type)." AND id_document=" . $row['id_document']);
		}
	}
}


?>