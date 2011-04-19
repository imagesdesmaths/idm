<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/presentation');

// http://doc.spip.org/@exec_articles_page_dist
function exec_articles_page_dist()
{
	global $connect_statut, $connect_id_auteur;

 	pipeline('exec_init',array('args'=>array('exec'=>'articles_page'),'data'=>''));
	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('titre_page_articles_page'), "naviguer", "articles");

	echo debut_gauche('', true);

//
// Afficher le bouton de creation d'article
//

	echo pipeline('affiche_gauche',array('args'=>array('exec'=>'articles_page'),'data'=>''));

	if (sql_countsel('spip_rubriques')) {
		echo bloc_des_raccourcis(icone_horizontale(_T('icone_ecrire_article'), generer_url_ecrire("articles_edit","new=oui"), "article-24.gif", "creer.gif", false));
	} else {
		if (autoriser('creerrubriquedans', 'rubrique')) {
			echo _T('texte_creer_rubrique');
			echo	bloc_des_raccourcis(icone_horizontale (_T('icone_creer_rubrique'), generer_url_ecrire("rubriques_edit","new=oui&retour=nav"), "rubrique-24.gif", "creer.gif",false));
		}
	}

	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite',array('args'=>array('exec'=>'articles_page'),'data'=>''));
echo debut_droite('', true);

//
// Vos articles en cours de redaction
//

	echo afficher_objets('article',_T('info_en_cours_validation'), array('FROM' => "spip_articles AS articles, spip_auteurs_articles AS lien ", "WHERE" => "articles.id_article=lien.id_article AND lien.id_auteur=$connect_id_auteur AND articles.statut='prepa'", 'ORDER BY' => "articles.date DESC"));



//
// Vos articles soumis au vote
//

	echo afficher_objets('article',_T('info_attente_validation'), array('FROM' => "spip_articles AS articles, spip_auteurs_articles AS lien ", "WHERE" => "articles.id_article=lien.id_article AND lien.id_auteur=$connect_id_auteur AND articles.statut='prop'", "ORDER BY" => "articles.date"));

//
// Vos articles publies
//

	echo afficher_objets('article',_T('info_publies'),	array("FROM" =>"spip_articles AS articles, spip_auteurs_articles AS lien ", "WHERE" => "articles.id_article=lien.id_article AND lien.id_auteur=$connect_id_auteur AND articles.statut='publie'", 'ORDER BY' => "articles.date DESC"));

//
//  Vos articles refuses
//

	echo afficher_objets('article',_T('info_refuses'),	array('FROM' =>"spip_articles AS articles, spip_auteurs_articles AS lien ", "WHERE" => "articles.id_article=lien.id_article AND lien.id_auteur=$connect_id_auteur AND articles.statut='refuse'",  'ORDER BY' => "articles.date DESC"));

	echo pipeline('affiche_milieu',array('args'=>array('exec'=>'articles_page'),'data'=>''));

	echo fin_gauche(), fin_page();
}

?>
