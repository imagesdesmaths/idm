<?php
/**
 * Plugin Portfolio/Gestion des documents
 * Licence GPL (c) 2006-2008 Cedric Morin, romy.tetue.net
 *
 */


function gestdoc_post_edition($flux){
	// si on ajoute un document, mettre son statut a jour
	if($flux['args']['operation']=='ajouter_document'){
		include_spip('action/editer_document');
		// mettre a jour le statut si necessaire
		instituer_document($flux['args']['id_objet']);
	}
	// si on institue un objet, mettre ses documents lies a jour
	elseif($flux['args']['operation']=='instituer' OR isset($flux['data']['statut'])){
		if ($flux['args']['table']!=='spip_documents'){
			// verifier d'abord les doublons !
			$marquer_doublons_doc = charger_fonction('marquer_doublons_doc','inc');
			$marquer_doublons_doc($flux['data'],$flux['args']['id_objet'],$flux['args']['type'],id_table_objet($flux['args']['type'], $flux['args']['serveur']),$flux['args']['table_objet'],$flux['args']['spip_table_objet'], '', $flux['args']['serveur']);
			include_spip('base/abstract_sql');
			$type = objet_type($flux['args']['table']);
			$id = $flux['args']['id_objet'];
			$docs = array_map('reset',sql_allfetsel('id_document','spip_documents_liens','id_objet='.intval($id).' AND objet='.sql_quote($type)));
			include_spip('action/editer_document');
			foreach($docs as $id_document)
				// mettre a jour le statut si necessaire
				instituer_document($id_document);
		}
	}
	else {
		if ($flux['args']['table']!=='spip_documents'){
			// verifier les doublons !
			$marquer_doublons_doc = charger_fonction('marquer_doublons_doc','inc');
			$marquer_doublons_doc($flux['data'],$flux['args']['id_objet'],$flux['args']['type'],id_table_objet($flux['args']['type'], $flux['args']['serveur']),$flux['args']['table_objet'],$flux['args']['spip_table_objet'], '', $flux['args']['serveur']);
		}
	}
	return $flux;
}

// liste des exec avec la colonne document
$GLOBALS['gestdoc_exec_colonne_document'][] = 'articles_edit';
$GLOBALS['gestdoc_exec_colonne_document'][] = 'breves_edit';
$GLOBALS['gestdoc_exec_colonne_document'][] = 'rubriques_edit';

function gestdoc_affiche_gauche($flux){
	if (in_array($flux['args']['exec'],$GLOBALS['gestdoc_exec_colonne_document'])
		AND $table = preg_replace(",_edit$,","",$flux['args']['exec'])
		AND $type = objet_type($table)
		AND $id_table_objet = id_table_objet($type)
		AND ($id = intval($flux['args'][$id_table_objet]) OR $id = 0-$GLOBALS['visiteur_session']['id_auteur'])
	  AND (autoriser('joindredocument',$type,$id))){
		$flux['data'] .= recuperer_fond('prive/editer/colonne_document',array('objet'=>$type,'id_objet'=>$id));
	}
	
	return $flux;
}

function gestdoc_objets_extensibles($objets){
	return array_merge($objets, array('document' => _T('gestdoc:objet_documents')));
}

function gestdoc_document_desc_actions($flux){
	return $flux;
}

function gestdoc_editer_document_actions($flux){
	return $flux;
}