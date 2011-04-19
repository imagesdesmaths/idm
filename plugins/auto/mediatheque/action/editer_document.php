<?php
/**
 * Plugin Portfolio/Gestion des documents
 * Licence GPL (c) 2006-2008 Cedric Morin, romy.tetue.net
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Action editer_document
 *
 * @return unknown
 */
function action_editer_document_dist() {

	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	// Envoi depuis le formulaire de creation d'un document
	if (!$id_document = intval($arg)) {
		$id_document = insert_document();
	} 

	if ($id_document = intval($id_document)) {
		document_set($id_document);
	}
	// Erreur
	else{
		include_spip('inc/headers');
		redirige_url_ecrire();
	}

	if (_request('redirect')) {
		$redirect = parametre_url(urldecode(_request('redirect')),
			'id_document', $id_document, '&');
			
		include_spip('inc/headers');
		redirige_par_entete($redirect);
	}
	else 
		return array($id_document,'');
}

/**
 * Creer un nouveau document
 *
 * @return unknown
 */
function insert_document() {

	$champs = array(
		'statut' => 'prop',
		'date' => 'NOW()',
	);

	// Envoyer aux plugins
	$champs = pipeline('pre_insertion',
		array(
			'args' => array(
				'table' => 'spip_documents',
			),
			'data' => $champs
		)
	);
	$id_document = sql_insertq("spip_documents", $champs);
	
	return $id_document;
}


/**
 * Enregistre une revision de document.
 * $c est un contenu (par defaut on prend le contenu via _request())
 *
 * @param int $id_document
 * @param array $c
 */
function document_set ($id_document, $c=false) {

	// champs normaux
	$champs = array();
	foreach (array(
		'titre', 'descriptif', 'date', 'taille', 'largeur','hauteur','mode','credits',
		'fichier','distant','extension', 'id_vignette',
	  ) as $champ)
		if (($a = _request($champ,$c)) !== null)
			$champs[$champ] = $a;

	// Si le document est publie, invalider les caches et demander sa reindexation
	$t = sql_getfetsel("statut", "spip_documents", 'id_document='.intval($id_document));
	if ($t == 'publie') {
		$invalideur = "id='id_document/$id_document'";
		$indexation = true;
	}
	
	$ancien_fichier = "";
	// si le fichier est modifie, noter le nom de l'ancien pour faire le menage
	if (isset($champs['fichier'])){
		$ancien_fichier = sql_getfetsel('fichier','spip_documents','id_document='.intval($id_document));
	}

	include_spip('inc/modifier');
	modifier_contenu('document', $id_document,
		array(
			'invalideur' => $invalideur,
			'indexation' => $indexation
		),
		$champs);

	// nettoyer l'ancien fichier si necessaire
	if ($champs['fichier'] // un plugin a pu interdire la modif du fichier en virant le champ
	 AND $ancien_fichier // on avait bien note le nom du fichier avant la modif
	 AND $ancien_fichier!==$champs['fichier'] // et il a ete modifie
	 AND @file_exists($f = get_spip_doc($ancien_fichier)))
	 	spip_unlink($f);

	// Changer le statut du document ?
	// le statut n'est jamais fixe manuellement mais decoule de celui des objets lies
	if(instituer_document($id_document,array('parents'=>_request('parents',$c),'ajout_parents'=>_request('ajout_parents',$c)))) {

		//
		// Post-modifications
		//
	
		// Invalider les caches
		include_spip('inc/invalideur');
		suivre_invalideur("id='id_document/$id_document'");	
	}

}
/**
 * determiner le statut d'un document : prepa/publie
 * si on trouve un element joint sans champ statut ou avec un statut='publie' alors le doc est publie aussi
 *
 * @param int $id_document
 */
function instituer_document($id_document,$champs=array()){
	
	$statut=isset($champs['statut'])?$champs['statut']:null;
	$date_publication = isset($champs['date_publication'])?$champs['date_publication']:null;
	if (isset($champs['parents']))
		medias_revision_document_parents($id_document,$champs['parents']);
	if (isset($champs['ajout_parents']))
		medias_revision_document_parents($id_document,$champs['ajout_parents'],true);
	
	$row = sql_fetsel("statut,date_publication", "spip_documents", "id_document=$id_document");
	$statut_ancien = $row['statut'];
	$date_publication_ancienne = $row['date_publication'];
	if (is_null($statut)){
		$statut = 'prepa';
	
		$trouver_table = charger_fonction('trouver_table','base');
		$res = sql_select('id_objet,objet','spip_documents_liens',"objet!='document' AND id_document=".intval($id_document));
		// dans 10 ans, ca nous fera un bug a corriger vers 2018
		// penser a ouvrir un ticket d'ici la :p
		$date_publication=time()+10*365*24*3600;
		while($row = sql_fetch($res)){
			$table = table_objet_sql($row['objet']);
			$desc = $trouver_table($table);
			// si pas de champ statut, c'est un objet publie, donc c'est bon
			if (!isset($desc['field']['statut'])){
				$statut = 'publie';
				$date_publication=0;
				continue;
			}
			$id_table = id_table_objet($row['objet']);
			$row2 = sql_fetsel('statut'.($table=='spip_articles'?",date":""),$table,$id_table.'='.intval($row['id_objet']));
			if ($row2['statut']=='publie'){
				$statut = 'publie';
				// si ce n'est pas un article, c'est donc deja publie, on met la date a 0
				if (!$row2['date']){
					$date_publication=0;
					continue;
				}
				else {
					$date_publication = min($date_publication,strtotime($row2['date']));
				}
			}
		}
		$date_publication = date('Y-m-d H:i:s',$date_publication);
		if ($statut=='publie' AND $statut_ancien=='publie' AND $date_publie==$date_publication_ancienne)
			return false;
		if ($statut!='publie' AND $statut_ancien!='publie' AND $statut_ancien!='0')
			return false;
	}
	if ($statut!==$statut_ancien
	OR $date_publication!=$date_publication_ancienne){
		sql_updateq('spip_documents',array('statut'=>$statut,'date_publication'=>$date_publication),'id_document='.intval($id_document));
		return true;
	}
	return false;
}


/**
 * Revision des parents d'un document
 * chaque parent est liste au format objet|id_objet
 *
 * @param unknown_type $id_document
 * @param unknown_type $parents
 */
function medias_revision_document_parents($id_document, $parents=null, $ajout=false){
	if (!is_array($parents))
		return;
	
	$insertions = array();
	$cond = array();
	// au format objet|id_objet
	foreach($parents as $p){
		$p = explode('|',$p);
		if (preg_match('/^[a-z0-9_]+$/i', $objet=$p[0])){ // securite
			$insertions[] = array('id_document'=>$id_document,'objet'=>$p[0],'id_objet'=>$p[1]);
			$cond[] = "(id_objet=".intval($p[1])." AND objet=".sql_quote($p[0]).")";
		}
	}
	if (!$ajout){
		// suppression des parents obsoletes
		$cond_notin = "id_document=".intval($id_document).(count($cond)?" AND NOT(".implode(") AND NOT(",$cond).")":"");
		#$cond_in = "id_document=".intval($id_document).(count($cond)?" AND (".implode(" OR (",$cond).")":"");
		sql_delete("spip_documents_liens", $cond_notin);
	}

	foreach($insertions as $ins){
		if (!sql_countsel('spip_documents_liens','id_document='.intval($ins['id_document'])." AND id_objet=".intval($ins['id_objet'])." AND objet=".sql_quote($ins['objet'])))
			sql_insertq('spip_documents_liens',$ins);
	}
}
?>
