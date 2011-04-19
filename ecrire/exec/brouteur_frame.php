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

// http://doc.spip.org/@exec_brouteur_frame_dist
function exec_brouteur_frame_dist() {
	global $connect_id_auteur, $spip_ecran, $spip_lang_left;

	$id_rubrique = is_numeric(_request('rubrique')) ? intval(_request('rubrique')) : "";
	$frame = _request('frame');
	$effacer_suivant = _request('effacer_suivant');
	$special = _request('special');
	$peutpub = autoriser('publierdans','rubrique');

	include_spip('inc/headers');
	http_no_cache();

	$profile = _request('var_profile') ? "&var_profile=1" : '';

	echo _DOCTYPE_ECRIRE
	. html_lang_attributes()
	. pipeline('header_prive',
		"<head>\n"
		.  "<title>brouteur_frame</title>\n"
		. "<meta http-equiv='Content-Type' content='text/html"
		. (($c = $GLOBALS['meta']['charset']) ? "; charset=$c" : '')
		. "' />\n"
		. envoi_link(_T('info_mon_site_spip'))	
		. http_script('jQuery(function(){
	jQuery("a.iframe").click(function(){
		window.open(this.href,"iframe"+this.rel);
		return false;
	});
});')
		. "</head>\n")
	."<body>";

	if ($spip_ecran == "large") {
		$nb_col = 4;
	} else {
		$nb_col = 3;
	}

	if ($effacer_suivant == "oui" && $frame < $nb_col) {
		$res = '';
		for ($i = $frame+1; $i < $nb_col; $i++) {
			$res .= "\nparent.iframe$i.location.href='" . generer_url_ecrire('brouteur_frame',"frame=$i$profile") . "'";
		}
		echo http_script($res);
	}
	echo "\n<div class='arial2'>";

	if ($special == "redac") {
		$result=sql_select("articles.id_article, articles.id_rubrique, articles.titre, articles.statut", "spip_articles AS articles LEFT JOIN spip_auteurs_articles AS lien ON articles.id_article=lien.id_article", "articles.statut = 'prepa' AND lien.id_auteur = $connect_id_auteur ", " id_article ", " articles.date DESC");
		$res = '';
		while($row=sql_fetch($result)){
			$id_article=$row['id_article'];
			if (autoriser('voir','article',$id_article)){
				$titre = typo($row['titre']);
				$statut = $row['statut'];
				$h = generer_url_ecrire('articles',"id_article=$id_article");
				$res .= "<a class='$statut'\nhref='javascript:window.parent.location=\"$h\"'>$titre</a>";
				}
			}
		if ($res) {
			echo "\n<div style='padding-top: 6px; padding-bottom: 3px;'><b class='verdana2'>"._T("info_cours_edition")."</b></div>";
			echo "\n<div class='plan-articles'>", $res, "</div>";
		}
	
	} else if ($special == "valider") {
		$result=sql_select("id_article, id_rubrique, titre, statut", "spip_articles", "statut = 'prop'", "", "date DESC");
		$res = '';
		while($row=sql_fetch($result)){
			$id_article=$row['id_article'];
			if (autoriser('voir','article',$id_article)){
				$titre = typo($row['titre']);
				$statut = $row['statut'];
				$h = generer_url_ecrire('articles',"id_article=$id_article");
				$res .= "<a class='$statut' href='javascript:window.parent.location=\"$h\"'>$titre</a>";
				}
		}

		if ($res) {
			echo "\n<div style='padding-top: 6px; padding-bottom: 3px;'><b class='verdana2'>"._T("info_articles_proposes")."</b></div>";
			echo "\n<div class='plan-articles'>", $res, "</div>";
		}
	
		$result=sql_select("*", "spip_breves", "statut = 'prop'", "", "date_heure DESC", "20");
		$res = '';
		while($row=sql_fetch($result)){
			$id_breve=$row['id_breve'];
			if (autoriser('voir','breve',$id_breve)){
				$titre = typo($row['titre']);
				$statut = $row['statut'];
				$h = generer_url_ecrire('breves_voir',"id_breve=$id_breve");
				$res .= "<a class='$statut' href='javascript:window.parent.location=\"$h\"'>$titre</a>";
				}
		}
		if ($res) {
			echo "\n<div style='padding-top: 6px;'><b class='verdana2'>"._T("info_breves_valider")."</b></div>";
			echo "\n<div class='plan-articles'>", $res, "</div>";
		}

	}
	else {
	  if ($id_rubrique !== "" AND autoriser('voir','rubrique',$id_rubrique)) {

		$row = sql_fetsel("id_rubrique, titre, id_parent", "spip_rubriques", "id_rubrique=$id_rubrique",'', '0+titre,titre');

		if ($row){
			$titre = typo($row['titre']);
			$id_parent=$row['id_parent'];
			
			if ($id_parent == 0) $icone = "secteur-24.gif";
			else $icone = "rubrique-24.gif";
			
			echo "\n<div style='background-color: #cccccc; border: 1px solid #444444;'>";
			echo icone_horizontale($titre, "javascript:window.parent.location=\"" . generer_url_ecrire('naviguer',"id_rubrique=$id_rubrique") .'"', $icone, "", false);
			echo "</div>";
		}  else if ($frame == 0) {
			echo "\n<div style='background-color: #cccccc; border: 1px solid #444444;'>";
			echo icone_horizontale(_T('info_racine_site'), "javascript:window.parent.location=\"" . generer_url_ecrire('naviguer') . '"', "racine-site-24.gif","", false);
			echo "</div>";
		}

		$result = sql_select("id_rubrique, titre, id_parent", "spip_rubriques", "id_parent=$id_rubrique",'', '0+titre,titre');

		while($row=sql_fetch($result)){
			$ze_rubrique=$row['id_rubrique'];
			if (autoriser('voir','rubrique',$ze_rubrique)){
				$titre = typo($row['titre']);
				$id_parent=$row['id_parent'];
				
				echo "\n<div class='brouteur_rubrique'
	onmouseover=\"changeclass(this, 'brouteur_rubrique_on');\"
	onmouseout=\"changeclass(this, 'brouteur_rubrique');\">";
	
				if ($id_parent == '0') 	{
				  echo "\n<div style='", frame_background_image("secteur-24.gif"), ";'><a href='", generer_url_ecrire('brouteur_frame', "rubrique=$ze_rubrique&frame=".($frame+1)."&effacer_suivant=oui$profile"), "' class='iframe' rel='", ($frame+1), "'>",
				    $titre,
				    "</a></div>";
				}
				else {
					if ($frame+1 < $nb_col)
					  echo "\n<div style='",
					    frame_background_image("rubrique-24.gif"), ";'><a href='", generer_url_ecrire('brouteur_frame', "rubrique=$ze_rubrique&frame=".($frame+1)."&effacer_suivant=oui$profile"), "' class='iframe' rel='",
					    ($frame+1),
					    "'>$titre</a></div>";
					else  echo "\n<div style='",
					  frame_background_image("rubrique-24.gif"), ";'><a href='javascript:window.parent.location=\"" . generer_url_ecrire('brouteur',"id_rubrique=$ze_rubrique$profile")."\"'>",$titre,"</a></div>";
				}
				echo "</div>\n";
			}
		}

	
		if ($id_rubrique > 0) {
			if ($peutpub)
				$result = sql_select("id_article, id_rubrique, titre, statut", "spip_articles", "id_rubrique=$id_rubrique", "", "date DESC");
			else 
				$result = sql_select("articles.id_article, articles.id_rubrique, articles.titre, articles.statut", "spip_articles AS articles, spip_auteurs_articles AS lien", "articles.id_rubrique=$id_rubrique AND (articles.statut = 'publie' OR articles.statut = 'prop' OR (articles.statut = 'prepa' AND articles.id_article = lien.id_article AND lien.id_auteur = $connect_id_auteur)) ", " id_article ", " articles.date DESC");
			$res = '';
			while($row=sql_fetch($result)){
					$id_article=$row['id_article'];
					if (autoriser('voir','article',$id_article)){
						$titre = typo($row['titre']);
						$statut = $row['statut'];
						$h = generer_url_ecrire('articles',"id_article=$id_article");
						$res .= "<a class='$statut' href='javascript:window.parent.location=\"$h\"'>$titre</a>";
					}
			}
			if ($res) {
				echo "\n<div style='padding-top: 6px; padding-bottom: 3px;'><b class='verdana2'>"._T('info_articles')."</b></div>";
				echo "\n<div class='plan-articles'>", $res, "</div>";
			}
	
			$result=sql_select("*", "spip_breves", "id_rubrique=$id_rubrique", "", "date_heure DESC", "20");
			$res = '';
			while($row=sql_fetch($result)){
				$id_breve=$row['id_breve'];
				if (autoriser('voir','breve',$id_breve)){
					$titre = typo($row['titre']);
					$statut = $row['statut'];
					$h = generer_url_ecrire('breves_voir',"id_breve=$id_breve");
					$res .= "<a class='$statut' href='javascript:window.parent.location=\"$h\"'>$titre</a>";
				}
			}
			if ($res) {
				echo "\n<div style='padding-top: 6px;'><b class='verdana2'>"._T('info_breves_02')."</b></div>";
				echo "\n<div class='plan-articles'>", $res, "</div>";

			}
	
			$result=sql_select("*", "spip_syndic", "id_rubrique=$id_rubrique AND statut!='refuse'", "", "nom_site");
			$res = '';
			while($row=sql_fetch($result)){
				$id_syndic=$row['id_syndic'];
				if (autoriser('voir','site',$id_syndic)){
					$titre = typo($row['nom_site']);
					$statut = $row['statut'];
					$h = generer_url_ecrire('sites',"id_syndic=$id_syndic");
					$res .= "\n<div class='brouteur_icone_site'><b><a href='javascript:window.parent.location=\"$h\"'>$titre</a></b></div>";
				}
			}
			if ($res)
				echo "\n<div style='padding-top: 6px;'><b class='verdana2'>"._T('icone_sites_references')."</b></div>", $res;
		}

		// en derniere colonne, afficher articles et breves
		if ($frame == 0 AND $id_rubrique==0) {

			$cpt = sql_fetsel('A.id_article', "spip_auteurs_articles AS A LEFT JOIN spip_articles AS L ON A.id_article = L.id_article", "L.statut = 'prepa' AND A.id_auteur=$connect_id_auteur", "A.id_article");

			if ($cpt) {

			  echo "\n<div class='brouteur_icone_article'><b class='verdana2'><a href='", generer_url_ecrire('brouteur_frame', "special=redac&frame=".($frame+1)."&effacer_suivant=oui$profile"), "' class='iframe' rel='",($frame+1),"'>",
				_T("info_cours_edition"),"</a></b></div>";
			}
			
			$cpt = sql_countsel("spip_articles AS articles", "articles.statut = 'prop'");
			if (!$cpt)
				$cpt = sql_countsel("spip_breves", "statut = 'prop'");
			if ($cpt)
				echo "\n<div class='brouteur_icone_article'><b class='verdana2'><a href='", generer_url_ecrire('brouteur_frame', "special=valider&frame=".($frame+1)."&effacer_suivant=oui$profile"), "' class='iframe' rel='",
			    ($frame+1)."'>",
			    _T("info_articles_proposes"),
			    " / "._T("info_breves_valider")."</a></b></div>";
		}
	}
   }
	echo "</div>";

	echo "</body></html>";
}

// http://doc.spip.org/@frame_background_image
function frame_background_image($f)
{
	return "background-image: url(" . 
		chemin_image($f) .
		")";
}
?>
