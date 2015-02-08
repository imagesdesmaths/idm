<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/charsets');	# pour le nom de fichier

/**
 * Dupliquer le contenu d'un objet
 *
 * @param null $id_objet
 * @return void
 */
function action_duplicator_dist($args=null) {

	if (is_null($args)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$args = $securiser_action();
	}
	
	include_spip('inc/duplicator');
	
	list($objet,$id_objet,$articles) = explode(':',$args);
	
	if ( ($objet=="rubrique") && ($id=intval($id_objet)) ){
		// On duplique la rubrique
		spip_log("Duplication de la rubrique : $id.",'duplicator');
		$dup_articles = true;
		if($articles)
			$dup_articles = false;
		$nouvelle_rubrique = dupliquer_rubrique($id,null,' (cible)',$dup_articles);
		spip_log("Nouvelle rubrique créée : id_rubrique $nouvelle_rubrique.",'duplicator');
		include_spip('inc/headers');
		if ($redirect = _request('redirect'))
			redirige_par_entete(str_replace('&amp;','&',$redirect));
		redirige_par_entete(generer_url_ecrire("rubrique","id_rubrique=".$nouvelle_rubrique, "&"));
	}

	if ( ($objet=="article") && ($id=intval($id_objet)) ){
		// On duplique l article
		$rub = sql_getfetsel('id_rubrique', 'spip_articles', 'id_article='. $id);
		spip_log("Duplication de l'article : $id dans la rubrique $rub.",'duplicator');
		$nouvel_article = dupliquer_article(intval($id),intval($rub));
		spip_log("Nouvel article créé dans la rubrique $rub : id_article $nouvel_article.",'duplicator');
		include_spip('inc/headers');
		if ($redirect = _request('redirect'))
			redirige_par_entete(str_replace('&amp;','&',$redirect));
		redirige_par_entete(generer_url_ecrire("articles","id_article=".$nouvel_article, "&"));
	}

}