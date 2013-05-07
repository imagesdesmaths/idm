<?php

/***************************************************************************\
 * Plugin Vider Rubrique pour Spip 3.0
 * Licence GPL (c) 2012 - Apsulis
 * Suppression de tout le contenu d'une rubrique
 *
\***************************************************************************/


function trim_value(&$value){$value = trim($value);}

/**
 * Duplique un article dans la rubrique cible
 * - Conserve le contenu de l'article source
 * - Conserve les logos de l'article source
 * - Conserve le statut de publication de l'article source
 */
function dupliquer_article($article,$rubrique){
	include_spip('action/editer_article');
	include_spip('inc/modifier_article');
	include_spip('inc/modifier');
	include_spip('inc/config');
		
	// On lit l'article qui va etre dupliqué
	$champs = array('*');
	$from = 'spip_articles';
	$where = array( 
		"id_article=".$article
	);
	$infos = sql_allfetsel($champs, $from, $where);

	// On choisi les champs que l'on veut conserver
	$champs_dupliques = explode(",", lire_config('duplicator/config/art_champs'));
	array_walk($champs_dupliques, 'trim_value');
	
	if ($champs_dupliques[0]==''){ $champs_dupliques = array( 'surtitre','titre','soustitre','descriptif','chapo','texte','ps','accepter_forum','lang','langue_choisie','nom_site','url_site' ); }
	foreach ($champs_dupliques as $key => $value) {
		$infos_de_l_article[$value] = $infos[0][$value];
	}
	
	// On cherche ses mots clefs
	$mots_clefs_de_l_article = lire_les_mots_clefs($article,'article');

	//////////////
	// ON DUPLIQUE
	//////////////
	// On le clone avec les champs choisis ci-dessus, il sera NON publié par défaut
	$id_article = insert_article($rubrique);
	revision_article($id_article, $infos_de_l_article);
	
	// On lui rend son statut
	$maj_statut_article = sql_updateq("spip_articles", array('statut' => $infos[0]['statut']), "id_article=".$id_article);

	// On lui remet ses mots clefs
	remettre_les_mots_clefs($mots_clefs_de_l_article,$id_article,'article');
	
	// On lui copie ses logos
	dupliquer_logo($article,$id_article,'article',false);
	dupliquer_logo($article,$id_article,'article',true);
	
	/////////////////////////////////////
	// Duplication des url dans spip_url
	/////////////////////////////////////
	$where = array( 
		"id_objet=".$article,
		"type='article'",
	);
//	$infos_url = sql_allfetsel('*', 'spip_urls', $where, );
	$infos_url = sql_fetsel('*', 'spip_urls', $where, 'date', 'date DESC');
	
	$infos_url['id_objet'] = $id_article;
	$url = $infos_url['url'];
	//$infos_url['url']
	$u = preg_replace('/(.*)(-|,)\d*$/', '$1', $url, -1, $c); // supprimer le numéro à la fin
	if ($c == 0) $infos_url['url'] = $url.'-'.$id_article; // Ajoute le numéro de l'article
	else $infos_url['url'] = $u.'-'.$id_article;
	sql_insertq('spip_urls', $infos_url);
	
	return $id_article;
}

/**
 * Duplique une rubrique dans la rubrique qui la contient
 * - Conserve le contenu de la rubrique source
 * - Conserve les mots clefs de la rubrique source
 * - Conserve les articles de la rubrique source
 */
function dupliquer_rubrique($rubrique,$cible=null,$titre=' (copie)'){
	include_spip('action/editer_rubrique');
	include_spip('inc/config');
		
	// On lit la rubrique qui va etre dupliquée
	$champs = array('*');
	$from = 'spip_rubriques';
	$where = array( 
		"id_rubrique=".$rubrique
	);
	$infos = sql_allfetsel($champs, $from, $where);
	// On choisi les champs que l'on veut conserver
	$champs_dupliques = explode(",", lire_config('duplicator/config/rub_champs'));
	array_walk($champs_dupliques, 'trim_value');
	
	if ($champs_dupliques[0]=="") $champs_dupliques = array('id_parent','titre','descriptif','texte','lang','langue_choisie');
	foreach ($champs_dupliques as $key => $value) {
		$infos_de_la_rubrique[$value] = $infos[0][$value];
	}
	// Si une cible est spécifiée, on ecrase le champ id_parent
	if($cible) $infos_de_la_rubrique['id_parent'] = $cible;
	$infos_de_la_rubrique['titre'] .= $titre;

	// On cherche ses mots clefs
	$mots_clefs_de_la_rubrique = lire_les_mots_clefs($rubrique,'rubrique');

	// On cherche ses articles
	$champs = array('id_article');
	$from = 'spip_articles';
	$where = array( 
		"id_rubrique=".$rubrique
	);
	$articles_de_la_rubrique = sql_allfetsel($champs, $from, $where);

	// On cherche ses sous-rubriques
	$champs = array('id_rubrique');
	$from = 'spip_rubriques';
	$where = array( 
		"id_parent=".$rubrique
	);
	$rubriques_de_la_rubrique = sql_allfetsel($champs, $from, $where);

	//////////////
	// ON DUPLIQUE
	//////////////
	$id_nouvelle_rubrique = insert_rubrique($infos_de_la_rubrique['id_parent']);
	revisions_rubriques($id_nouvelle_rubrique,$infos_de_la_rubrique);
	// On la publie (pour activer l'aperçu)
	$maj_statut_rubrique = sql_updateq("spip_rubriques", array('statut' => 'publie'), "id_rubrique=".$id_nouvelle_rubrique);

	/////////////////////////////////////
	// Duplication des url dans spip_url
	/////////////////////////////////////
	$where = array( 
		"id_objet=".$rubrique,
		"type='rubrique'",
	);
	$infos_url = sql_fetsel('*', 'spip_urls', $where, 'date', 'date DESC');
	
	$infos_url['id_objet'] = $id_nouvelle_rubrique;
	$url = $infos_url['url'];
	//$infos_url['url']
	$u = preg_replace('/(.*)(-|,)\d*$/', '$1', $url, -1, $c); // supprimer le numéro à la fin
	if ($c == 0) $infos_url['url'] = $url.'-'.$id_nouvelle_rubrique; // Ajoute le numéro de l'article
	else $infos_url['url'] = $u.'-'.$id_nouvelle_rubrique;
	sql_insertq('spip_urls', $infos_url);
	
	
	// On lui remet ses mots clefs
	remettre_les_mots_clefs($mots_clefs_de_la_rubrique,$id_nouvelle_rubrique,'rubrique');

	// On lui remet ses articles
	foreach($articles_de_la_rubrique as $champ => $valeur){
		$id_article = dupliquer_article($valeur['id_article'],$id_nouvelle_rubrique);
	}

	// On lui copie ses logos
	dupliquer_logo($rubrique,$id_nouvelle_rubrique,'rubrique',false);
	dupliquer_logo($rubrique,$id_nouvelle_rubrique,'rubrique',true);

	// On lui remet ses sous-rubrique (+ mots clefs + articles + sous rubriques)
	foreach($rubriques_de_la_rubrique as $champ => $valeur){
		$rubrique = $valeur['id_rubrique'];
		$nouvelle_sous_rubrique = dupliquer_rubrique($rubrique,$id_nouvelle_rubrique,'');
	}
	
	return $id_nouvelle_rubrique;
}

function lire_les_mots_clefs($id,$type){
	$champs = array('id_mot');
	$from = 'spip_mots_liens';
	$where = array( 
		"id_objet=".$id,
		"objet=".sql_quote($type)
	);
	$mots_clefs = sql_allfetsel($champs, $from, $where);
	
	return $mots_clefs;
}
function remettre_les_mots_clefs($mots,$id,$type){
	foreach($mots as $champ => $valeur){
		$n = sql_insertq(
			'spip_mots_liens',
			array(
				'id_mot' => $valeur['id_mot'],
				'id_objet' => $id,
				'objet' => $type	
			)
		);
	}
	
	return true;
}

/* FONCTION HONTEUSEMENT ADAPTEE DE DOCUCOPIEUR ==> http://www.spip-contrib.net/DocuCopieur */
/* cette fonction realise la copie d'un logo d'article/rubrique et de son logo de survol */
/* vers le nouvel article/rubrique. */
function dupliquer_logo($id_source, $id_destination, $type='article', $bsurvol = false ){
	include_spip('action/iconifier');
	global $formats_logos;

	if ( $bsurvol == true )
	{
		$logo_type = 'off';	// logo survol
	} else  $logo_type = 'on';	// logo 

	$chercher_logo = charger_fonction('chercher_logo', 'inc');

	$logo_source = $chercher_logo($id_source, 'id_'.$type, $logo_type );
	$logo_source = $logo_source[0];
	if ( !file_exists($logo_source) ) return false;

	$size = @getimagesize($logo_source);
	$mime = !$size ? '': $size['mime'];
	$source['name'] = basename($logo_source);
	$source['type'] = $mime;
	$source['tmp_name'] = $logo_source;
	$source['error'] = 0;
	$source['size'] = @filesize($logo_source);

	action_spip_image_ajouter_dist(substr($type,0,3). $logo_type .$id_destination, 'local', $source );
	return true;
}
