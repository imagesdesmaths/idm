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

function formulaires_illustrer_document_charger_dist($id_document){
	$valeurs = sql_fetsel('id_document,mode,id_vignette,extension','spip_documents','id_document='.intval($id_document));
	if (!$valeurs /*OR in_array($valeurs['extension'],array('jpg','gif','png'))*/)
		return array('editable'=>false,'id'=>$id_document);

	$valeurs['id'] = $id_document;
	$valeurs['_hidden'] = "<input name='id_document' value='$id_document' type='hidden' />";
	$valeurs['mode'] = 'vignette'; // pour les id dans le dom
	$vignette = sql_fetsel('fichier,largeur,hauteur','spip_documents','id_document='.$valeurs['id_vignette']);
	$valeurs['vignette'] = get_spip_doc($vignette['fichier']);
	$valeurs['hauteur'] = $vignette['hauteur'];
	$valeurs['largeur'] = $vignette['largeur'];
	
	return $valeurs;
}

function formulaires_illustrer_document_verifier_dist($id_document){
	$erreurs = array();
	if (_request('supprimer')){
		
	}
	else {
		
		$id_vignette = sql_getfetsel('id_vignette','spip_documents','id_document='.intval($id_document));
		$verifier = charger_fonction('verifier','formulaires/joindre_document');
		$erreurs = $verifier($id_vignette,0,'','vignette');
	}
	return $erreurs;
}

function formulaires_illustrer_document_traiter_dist($id_document){
	$id_vignette = sql_getfetsel('id_vignette','spip_documents','id_document='.intval($id_document));
	$res = array('editable'=>true);
	if (_request('supprimer')){
		$supprimer_document = charger_fonction('supprimer_document','action');
		if ($id_vignette)
			$supprimer_document($id_vignette);
		$res['message_ok'] = _T('gestdoc:vignette_supprimee');
	}
	else {
		$ajouter_documents = charger_fonction('ajouter_documents', 'action');
	
		include_spip('inc/joindre_document');
		$files = joindre_trouver_fichier_envoye();
	
		$ajoute = action_ajouter_documents_dist($id_vignette,$files,'',0,'vignette');
	
		
		if (is_int(reset($ajoute))){
			$id_vignette = reset($ajoute);
			include_spip('action/editer_document');
			document_set($id_document,array("id_vignette" => $id_vignette,'mode'=>'document'));
			$res['message_ok'] = _T('gestdoc:document_installe_succes');
		}
		else 
			$res['message_erreur'] = reset($ajoute);
	}

	// todo : 
	// generer les case docs si c'est necessaire
	// rediriger sinon
	return $res;
	
}

?>