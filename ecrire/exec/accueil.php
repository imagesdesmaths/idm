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

// http://doc.spip.org/@encours_accueil
function encours_accueil()
{
	global $connect_statut, $connect_toutes_rubriques;


	$res = '';

	// Les articles a valider
	//

	$res .=  afficher_objets('article',_T('info_articles_proposes'), array("WHERE" => "statut='prop'", 'ORDER BY' => "date DESC"));

	//
	// Les breves a valider
	//
	$res .= afficher_objets('breve',afficher_plus(generer_url_ecrire('breves'))._T('info_breves_valider'), array("FROM" => 'spip_breves', 'WHERE' => "statut='prepa' OR statut='prop'", 'ORDER BY' => "date_heure DESC"), true);

	//
	// Les sites references a valider
	//
	if ($GLOBALS['meta']['activer_sites'] != 'non') {
		$res .= afficher_objets('site',afficher_plus(generer_url_ecrire('sites_tous')).'<b>' . _T('info_site_valider') . '</b>', array("FROM" => 'spip_syndic', 'WHERE' => "statut='prop'", 'ORDER BY'=> "nom_site"));
	}

	if ($connect_statut == '0minirezo') {
	//
	// Les sites a probleme
	//
	  if ($GLOBALS['meta']['activer_sites'] != 'non') {
		$res .= afficher_objets('site',afficher_plus(generer_url_ecrire('sites_tous')). '<b>' . _T('avis_sites_syndiques_probleme') . '</b>', array('FROM' => 'spip_syndic', 'WHERE' => "(syndication='off' OR syndication='sus') AND statut='publie'", 'ORDER BY' => 'nom_site'));
	}

	// Les articles syndiques en attente de validation
		$cpt = sql_countsel("spip_syndic_articles", "statut='dispo'");
		if ($cpt)
			$res .= "\n<br /><small><a href='"
			. generer_url_ecrire("sites_tous","")
			. "' style='color: black;'>"
			. $cpt
			. " "
			. _T('info_liens_syndiques_1')
			. " "
			. _T('info_liens_syndiques_2')
			. "</a></small>";

	// Les forums en attente de moderation

		$cpt = sql_countsel("spip_forum", "statut='prop'");
		if ($cpt) {
		if ($cpt>1)
			$lien = _T('info_liens_syndiques_3')." "._T('info_liens_syndiques_4');
		else
			$lien = _T('info_liens_syndiques_5')." "._T('info_liens_syndiques_6');
		$lien = "<small>$cpt $lien " ._T('info_liens_syndiques_7'). "</small>";
		if ($connect_toutes_rubriques)
			$lien = "<a href='" . generer_url_ecrire("controle_forum","type=prop") . "' style='color: black;'>". $lien . ".</a>";
		$res .= "\n<br />" . $lien;
		}
	}
	
	$res = pipeline('accueil_encours',$res);

	if (!$res) return '';

	return 
	"<div style='position:relative;display:inline;'>" 
	. debut_cadre_couleur_foncee("",true, "", _T('texte_en_cours_validation')
		. (($GLOBALS['meta']['forum_prive_objets'] != 'non')
			? ' '._T('texte_en_cours_validation_forum')
			: '' )
		)
	. $res
	. bouton_spip_rss('a_suivre')
	. fin_cadre_couleur_foncee(true)
	. "</div>";
}

//
// Raccourcis pour malvoyants
//

// http://doc.spip.org/@colonne_droite_eq4
function colonne_droite_eq4($id_rubrique, $activer_breves, $activer_sites, $articles_mots) {
	global  $connect_statut, $connect_toutes_rubriques;

	$res = sql_countsel('spip_rubriques');
	if ($res) {
		$res = icone_horizontale(_T('icone_ecrire_article'), generer_url_ecrire("articles_edit","new=oui"), "article-24.gif","creer.gif", false);

		if ($activer_breves != "non") {
			$res .= icone_horizontale(_T('icone_nouvelle_breve'), generer_url_ecrire("breves_edit","new=oui"), "breve-24.gif","creer.gif", false);
		}
	}
	else {
		if ($connect_statut == '0minirezo') {
			$res = "<div class='verdana2'>"._T('info_ecrire_article')."</div>";
		}
	}
	if (autoriser('creerrubriquedans', 'rubrique', $id_rubrique)) {
		$res .= icone_horizontale(_T('icone_creer_rubrique_2'), generer_url_ecrire("rubriques_edit","new=oui"), "rubrique-24.gif","creer.gif", false);
	}
	return  bloc_des_raccourcis($res);
 }

//
// Raccourcis pour voyants ...
//

// http://doc.spip.org/@colonne_droite_neq4
function colonne_droite_neq4($id_rubrique, $activer_breves, $activer_sites, $articles_mots) {
  global  $connect_statut, $connect_id_auteur, $connect_login;

	$gadget = '';

	if ($id_rubrique > 0) {
		$dans_rub = "&id_rubrique=$id_rubrique";
		$dans_parent = "&id_parent=$id_rubrique";
	} else $dans_rub = $dans_parent = '';

	if (autoriser('creerrubriquedans', 'rubrique', $id_rubrique)) {
		$gadget .= "<td>"
			. icone_horizontale(_T('icone_creer_rubrique'), generer_url_ecrire("rubriques_edit","new=oui"), "rubrique-24.gif", "creer.gif", false)
			. "</td>";
		}
	$n = sql_countsel('spip_rubriques');
	if ($n) {
		$gadget .= "<td>"
			. icone_horizontale(_T('icone_ecrire_article'), generer_url_ecrire("articles_edit","new=oui$dans_rub"), "article-24.gif","creer.gif", false)
			. "</td>";
			
		if ($activer_breves != "non") {
				$gadget .= "<td>";
				$gadget .= icone_horizontale(_T('icone_nouvelle_breve'), generer_url_ecrire("breves_edit","new=oui$dans_rub"), "breve-24.gif","creer.gif", false);
				$gadget .= "</td>";
			}
			
		if ($activer_sites == 'oui') {
				if ($connect_statut == '0minirezo' OR $GLOBALS['meta']["proposer_sites"] > 0) {
					$gadget .= "<td>";
					$gadget .= icone_horizontale(_T('info_sites_referencer'), generer_url_ecrire("sites_edit","new=oui$dans_rub"), "site-24.gif","creer.gif", false);
					$gadget .= "</td>";
				}
			} 
	}
	$gadget = "<table><tr>$gadget</tr></table>\n";

	if ($connect_statut != "0minirezo") {
	
		$gadget .= "<table><tr>";
	
		$cpt = sql_countsel('spip_auteurs_articles', "id_auteur=$connect_id_auteur");
		if ($cpt) {
			$gadget .= "<td>"
			. icone_horizontale (_T('icone_tous_articles'), generer_url_ecrire("articles_page"), "article-24.gif", "", false)
			. "</td>";
		}
	
		if ($activer_breves != "non"){
			$gadget .= "<td>"
			. icone_horizontale (_T('icone_breves'), generer_url_ecrire("breves",""), "breve-24.gif", "", false)
			. "</td>";
		}
	
		if ($articles_mots != "non") {
			$gadget .= "<td>"
			. icone_horizontale  (_T('icone_mots_cles'), generer_url_ecrire("mots_tous",""), "mot-cle-24.gif", "", false)
			. "</td>";
		}

		if ($activer_sites<>'non') {
			$gadget .= "<td>"
			. icone_horizontale  (_T('icone_sites_references'), generer_url_ecrire("sites_tous",""), "site-24.gif", "", false)
			. "</td>";
		}
		$gadget .= "</tr></table>\n";
	}
	$gadget = pipeline('accueil_gadgets',$gadget);

	if (strlen($gadget) > 0) {
	  $gadget = debut_cadre_trait_couleur('', true)
	    . $gadget
	    . fin_cadre_trait_couleur(true);
	}

	return $gadget;
}

// Cartouche d'identification, avec les rubriques administrees

// http://doc.spip.org/@personnel_accueil
function personnel_accueil($coockcookie)
{
	global $spip_lang_left, $connect_id_auteur, $connect_id_rubrique ;

	$res = '';

	if (count($connect_id_rubrique)) {

		$res = sql_allfetsel("R.id_rubrique, R.titre, R.descriptif", "spip_auteurs_rubriques AS A LEFT JOIN spip_rubriques AS R ON A.id_rubrique=R.id_rubrique", "A.id_auteur=$connect_id_auteur", "", "titre");

		foreach ($res as $k => $r) {
			$res[$k] = "<a title='" .
			  typo($r['descriptif']) .
			  "' href='" .
			  generer_url_ecrire('naviguer', "id_rubrique=" .$r['id_rubrique']) . "'>" .
			  typo($r['titre']) .
			  '</a>';
		}

		$res = "<ul style='margin:0px; padding-$spip_lang_left: 20px; margin-bottom: 5px;'>\n<li>" . join("</li>\n<li>", $res) . "\n</li></ul>";
	}

	//
	// Supprimer le cookie, se deconnecter...
	//
	
	if ($coockcookie) {
		$lien = generer_url_action('cookie', "cookie_admin=non&url=".rawurlencode('./'. _SPIP_ECRIRE_SCRIPT));
		$t = _T('icone_supprimer_cookie');
		$lien = icone_horizontale($t, $lien, "cookie-24.gif", "supprimer-sansdanger.gif", false);
		if ($GLOBALS['spip_display'] != 1) 
			$lien = str_replace('</td></tr></table>', 
					 aide("cookie").'</td></tr></table>',
					 $lien);
	}
	//
	// Modification du cookie
	//

	else {
		$cookie = rawurlencode("@$connect_login");
		$retour = rawurlencode('./' . _SPIP_ECRIRE_SCRIPT);
		$lien = generer_url_action('cookie', "cookie_admin=$cookie&url=$retour");
		$lien = 
			  _T('info_activer_cookie').
			  aide ("cookie").
			icone_horizontale(_T('icone_activer_cookie'), $lien,"cookie-24.gif", "", false);
	}
	
	$titre_cadre = afficher_plus(generer_url_ecrire("auteur_infos","id_auteur=$connect_id_auteur"));
	$titre_cadre .= majuscules(typo($GLOBALS['visiteur_session']['nom']));
	
	return debut_cadre_relief("fiche-perso-24.gif",true, '',$titre_cadre)
	. $res
	. "<div class='info_cookie'>$lien</div>"
	. fin_cadre_relief(true);
}

// Cartouche du site, avec le nombre d'articles, breves et messages de forums

// http://doc.spip.org/@etat_base_accueil
function etat_base_accueil()
{
	global $spip_display, $spip_lang_left, $connect_id_rubrique;

	$where = count($connect_id_rubrique)
	? sql_in('id_rubrique', $connect_id_rubrique)	: '';

	$res = '';

	if ($spip_display != 1) {
		$chercher_logo = charger_fonction('chercher_logo', 'inc');
		if ($r = $chercher_logo(0, 'id_syndic', 'on'))  {
			list($fid, $dir, $nom, $format) = $r;
			include_spip('inc/filtres_images_mini');
			$r = image_reduire("<img src='$fid' alt='' />", 170, 170);
			if ($r)
				$res ="<div style='text-align:center; margin-bottom: 5px;'>$r</div>";
		}
	}
	$res .= "<div class='verdana1'>";

	$res .= propre($GLOBALS['meta']["descriptif_site"]);

	$q = sql_select("COUNT(*) AS cnt, statut", 'spip_articles', '', 'statut', '','', "COUNT(*)<>0");
  
	$cpt = array();
	$cpt2 = array();
	$defaut = $where ? '0/' : '';
	while($row = sql_fetch($q)) {
	  $cpt[$row['statut']] = $row['cnt'];
	  $cpt2[$row['statut']] = $defaut;
	}
	if ($cpt) {
		if ($where) {
			$q = sql_select("COUNT(*) AS cnt, statut", 'spip_articles', $where, "statut");
			while($row = sql_fetch($q)) {
				$r = $row['statut'];
				$cpt2[$r] = intval($row['cnt']) . '/';
			}
		}
		$res .= afficher_plus(generer_url_ecrire("articles_page",""))."<b>"._T('info_articles')."</b>";
		$res .= "<ul style='margin:0px; padding-$spip_lang_left: 20px; margin-bottom: 5px;'>";
		if (isset($cpt['prepa'])) $res .= "<li>"._T("texte_statut_en_cours_redaction").": ".$cpt2['prepa'] . $cpt['prepa'] .'</li>';
		if (isset($cpt['prop'])) $res .= "<li>"._T("texte_statut_attente_validation").": ".$cpt2['prop'] . $cpt['prop'] . '</li>';
		if (isset($cpt['publie'])) $res .= "<li><b>"._T("texte_statut_publies").": ".$cpt2['publie'].$cpt['publie'] ."</b>" . '</li>';
		$res .= "</ul>";
	}

	$q = sql_select("COUNT(*) AS cnt, statut", 'spip_breves', '', 'statut', '','', "COUNT(*)<>0");

	$cpt = array();
	$cpt2 = array();
	$defaut = $where ? '0/' : '';
	while($row = sql_fetch($q)) {
	  $cpt[$row['statut']] = $row['cnt'];
	  $cpt2[$row['statut']] = $defaut;
	}
 
	if ($cpt) {
		if ($where) {
			$q = sql_select("COUNT(*) AS cnt, statut", 'spip_breves', $where, "statut");
			while($row = sql_fetch($q)) {
				$r = $row['statut'];
				$cpt2[$r] = intval($row['cnt']) . '/';
			}
		}
		$res .= afficher_plus(generer_url_ecrire("breves",""))."<b>"._T('info_breves_02')."</b>";
		$res .= "<ul style='margin:0px; padding-$spip_lang_left: 20px; margin-bottom: 5px;'>";
		if (isset($cpt['prop'])) $res .= "<li>"._T("texte_statut_attente_validation").": ".$cpt2['prop'].$cpt['prop'] . '</li>';
		if (isset($cpt['publie'])) $res .= "<li><b>"._T("texte_statut_publies").": ".$cpt2['publie'] .$cpt['publie'] . "</b>" .'</li>';
		$res .= "</ul>";
	}

	$q = sql_select('COUNT(*) AS cnt, statut', 'spip_forum', sql_in('statut', array('publie', 'prop')), 'statut', '','', "COUNT(*)<>0");

	$cpt = array();
	$cpt2 = array();
	$defaut = $where ? '0/' : '';
	while($row = sql_fetch($q)) {
	  $cpt[$row['statut']] = $row['cnt'];
	  $cpt2[$row['statut']] = $defaut;
	}

	if ($cpt) {
		if ($where) {
		  include_spip('inc/forum');
		  list($f, $w) = critere_statut_controle_forum('public');
		  $q = sql_select("COUNT(*) AS cnt, F.statut", "$f", "$w ", "F.statut");
		  while($row = sql_fetch($q)) {
				$r = $row['statut'];
				$cpt2[$r] = intval($row['cnt']) . '/';
			}
		}

		if (autoriser('modererforum'))
			$res .= afficher_plus(generer_url_ecrire("controle_forum",""));
		$res .= "<b>" ._T('onglet_messages_publics') ."</b>";
		$res .= "<ul style='margin:0px; padding-$spip_lang_left: 20px; margin-bottom: 5px;'>";
		if (isset($cpt['prop'])) $res .= "<li>"._T("texte_statut_attente_validation").": ".$cpt2['prop'] .$cpt['prop'] . '</li>';
		if (isset($cpt['publie'])) $res .= "<li><b>"._T("texte_statut_publies").": ".$cpt2['publie'] .$cpt['publie'] . "</b>" .'</li>';
		$res .= "</ul>";
	}
	
	$res .= accueil_liste_participants()
	. "</div>";

	return pipeline('accueil_informations',$res) ;
}


// http://doc.spip.org/@accueil_liste_participants
function accueil_liste_participants()
{
	global $spip_lang_left;

	$q = sql_select("COUNT(*) AS cnt, statut", 'spip_auteurs', sql_in("statut", $GLOBALS['liste_des_statuts']), 'statut', '','', "COUNT(*)<>0");

	$cpt = array();
	while($row=sql_fetch($q)) $cpt[$row['statut']] = $row['cnt']; 

	if (!$cpt) return '';

	       
	$res = afficher_plus(generer_url_ecrire("auteurs"))."<b>"._T('icone_auteurs')."</b>"
	. "<ul style='margin:0px; padding-$spip_lang_left: 20px; margin-bottom: 5px;'>";
		
	foreach($GLOBALS['liste_des_statuts'] as $k => $v) {
	  if (isset($cpt[$v])) $res .= "<li>" . _T($k) . ": " .$cpt[$v] . '</li>';
	}

	$res .= "</ul>";

	return $res; 
}

// http://doc.spip.org/@exec_accueil_dist
function exec_accueil_dist()
{
  global $id_rubrique, $connect_statut, $connect_id_auteur, $spip_display, $connect_id_rubrique;

	$id_rubrique =  intval($id_rubrique);
 	pipeline('exec_init',array('args'=>array('exec'=>'accueil','id_rubrique'=>$id_rubrique),'data'=>''));

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('titre_page_index'), "accueil", "accueil");

	echo debut_gauche("",true);

	if ($spip_display != 4) {
		echo personnel_accueil(@$_COOKIE['spip_admin']);
		echo pipeline('affiche_gauche',array('args'=>array('exec'=>'accueil','id_rubrique'=>$id_rubrique),'data'=>''));

		$nom = typo($GLOBALS['meta']["nom_site"]);
		if (!$nom) $nom=  _T('info_mon_site_spip');
		echo debut_cadre_relief("racine-site-24.gif", true, "", $nom),
		  etat_base_accueil(),
		  fin_cadre_relief(true);
	}

	echo creer_colonne_droite("", true);
	list($evtm, $evtt, $evtr) = http_calendrier_messages(date("Y"), date("m"), date("d")," 23:59:59");

	echo $evtt, $evtm, $evtr;

	echo pipeline('affiche_droite',array('args'=>array('exec'=>'accueil','id_rubrique'=>$id_rubrique),'data'=>''));

	echo debut_droite("", true);

	if ($GLOBALS['meta']["post_dates"] == "non"
	AND $connect_statut == '0minirezo')
		echo afficher_objets('article',_T('info_article_a_paraitre'), array("WHERE" => "statut='publie' AND date>".sql_quote(date('Y-m-d H:i:s')), 'ORDER BY' => "date"));


	// Les articles recents
	//
	echo afficher_objets('article',
	#afficher_plus(generer_url_ecrire('articles_page')) .
	_T('articles_recents'), array("WHERE" => "statut='publie'" .($GLOBALS['meta']["post_dates"] == "non"
		? " AND date<=".sql_quote(date('Y-m-d H:i:s')) : ''),
		'ORDER BY' => "date DESC", 'LIMIT' => '0,4'));

//
// Vos articles en cours 
//

	echo afficher_objets('article',afficher_plus(generer_url_ecrire('articles_page'))._T('info_en_cours_validation'),	array('FROM' => "spip_articles AS articles, spip_auteurs_articles AS lien", "WHERE" => "articles.id_article=lien.id_article AND lien.id_auteur=$connect_id_auteur AND articles.statut='prepa'", "ORDER BY" => "articles.date DESC"));

	if ($spip_display == 4)
	  echo colonne_droite_eq4($id_rubrique,
			 $GLOBALS['meta']["activer_breves"],
			 $GLOBALS['meta']["activer_sites"],
			 $GLOBALS['meta']['articles_mots']);
	else {
	  echo colonne_droite_neq4($id_rubrique,
			 $GLOBALS['meta']["activer_breves"],
			 $GLOBALS['meta']["activer_sites"],
			 $GLOBALS['meta']['articles_mots']);

	  echo encours_accueil();
	}

	include_spip('inc/presenter_enfants');
	if (!$connect_id_rubrique)
		echo afficher_enfant_rub(0, false, true) . "<div class='nettoyeur'></div>";

 	echo pipeline('affiche_milieu',array('args'=>array('exec'=>'accueil'),'data'=>''));

	// Dernieres modifications d'articles
	if (($GLOBALS['meta']['articles_versions'] == 'oui')) {
		include_spip('inc/suivi_versions');
		echo afficher_suivi_versions (0, 0, false, "", true);
	}

	echo fin_gauche(), fin_page();
}
?>
