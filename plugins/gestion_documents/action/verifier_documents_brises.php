<?php
/**
 * Plugin Portfolio/Gestion des documents
 * Licence GPL (c) 2006-2008 Cedric Morin, romy.tetue.net
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Verifier tous les fichiers brises
 *
 */
function action_verifier_documents_brises_dist() {
	include_spip('inc/documents');
	$res = sql_select('fichier,brise,id_document','spip_documents',"distant='non'");
	while ($row = sql_fetch($res)){
		if (($brise = !@file_exists(get_spip_doc($row['fichier'])))!=$row['brise'])
			sql_updateq('spip_documents',array('brise'=>$brise),'id_document='.intval($row['id_document']));
	}
}

?>