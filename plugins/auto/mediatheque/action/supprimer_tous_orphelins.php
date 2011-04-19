<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('base/abstract_sql');

function action_supprimer_tous_orphelins() {

	$securiser_action = charger_fonction('securiser_action','inc');
	$arg = $securiser_action();

	list($media,$distant,$statut,$sanstitre) = explode('/',$arg); //on récupère le contexte pour ne supprimer les orphelins que de ce dernier
	
	if($media) {
		$select = sql_get_select("extension","spip_types_documents as nnnn","media='$media'");
		$where[] = "spip_documents.extension IN ($select)";	//critere sur le media
	}
	if($distant)
		$where[] = "distant=$distant"; //critere sur le distant
	if($statut)
		$where[] = "statut REGEXP '($statut)'"; //critere sur le statut
	if($sanstitre)
		$where[] = "titre=''"; //critere sur le sanstitre
		
		$select = sql_get_select("DISTINCT id_document","spip_documents_liens as oooo");
		$cond = "spip_documents.id_document NOT IN ($select)"; //on isole les orphelins
		$where[] = $cond;

	$ids_doc_orphelins = sql_select( "id_document", "spip_documents", $where );

	$supprimer_document = charger_fonction('supprimer_document','action');
	while ($row = sql_fetch($ids_doc_orphelins)) {
		$supprimer_document($row['id_document']); // pour les orphelins du contexte, on traite avec la fonction existante
	}
}

?>