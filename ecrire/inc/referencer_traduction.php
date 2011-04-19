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

// http://doc.spip.org/@inc_referencer_traduction_dist
function inc_referencer_traduction_dist($id_article, $flag, $id_rubrique, $id_trad, $trad_err='')
{
	global $spip_display;

	if (! (($GLOBALS['meta']['multi_articles'] == 'oui')
		OR (($GLOBALS['meta']['multi_rubriques'] == 'oui') 
			AND ($GLOBALS['meta']['gerer_trad'] == 'oui'))) )
		return '';

	$langue_article = sql_fetsel("lang", "spip_articles", "id_article=$id_article");

	$langue_article = $langue_article['lang'];

	$reponse = '';
	// Choix langue article
	if ($GLOBALS['meta']['multi_articles'] == 'oui' AND $flag) {

		$row = sql_fetsel("lang", "spip_rubriques", "id_rubrique=$id_rubrique");
		$langue_parent = $row['lang'];

		if (!$langue_parent)
			$langue_parent = $GLOBALS['meta']['langue_site'];
		if (!$langue_article)
			$langue_article = $langue_parent;

		if ($menu = liste_options_langues('changer_lang', $langue_article, $langue_parent)) {
// attention ce onchange doit etre suivi de <span><input type='submit'
			$lien = "\nonchange=\"this.nextSibling.firstChild.style.visibility='visible';\"";
			$menu =  select_langues('changer_lang', $lien, $menu, _T('info_multi_cet_article'));
			
			$menu = ajax_action_post('referencer_traduction', "$id_article,$id_rubrique","articles","id_article=$id_article", $menu, _T('bouton_changer'), " class='visible_au_chargement'");

			$reponse .= debut_cadre_couleur('',true)
			. "\n<div style='text-align: center;'>"
			. $menu
			. "</div>\n"
			. fin_cadre_couleur(true);
		}
	}

	if ($trad_err)
		$reponse .= "<div><span style='color: red' size='2' face='Verdana, Geneva, helvetica, sans-serif'>"._T('trad_deja_traduit'). "</span></div>";

	// Afficher la liste des traductions

	if ($id_trad) {
		$requete = array('SELECT' => "id_article, id_rubrique, titre, lang, statut, id_trad", 'FROM' => "spip_articles", 'WHERE' => "id_trad = $id_trad");
		$styles = array(array('',7), array('', 12), array('arial2'), array('arial2', 100));
		$presenter_liste = charger_fonction('presenter_liste', 'inc');
		$tableau = array();
		$liste = $presenter_liste($requete, 'articles_traduction', $tableau,  $id_article, false, $styles, '',_T('trad_article_traduction'));
	} else $liste = '';

	// changer les globales de direction de langue
	changer_typo($langue_article);

	// Participation aux Traductions pas pour Mal-voyant. A completer
	if ($spip_display == 4) $form =''; else {
	$form = "<table width='100%'><tr>";

	if ($flag  AND !$liste) {
			// Formulaire pour lier a un article
		$form .= "<td style='width: 60%' class='arial2'>"
		. ajax_action_post("referencer_traduction",
				$id_article,
				'articles',
				"id_article=$id_article",
				("<label for='lier_trad'>" . _T('trad_lier') . "</label>" .
				 "\n<input type='text' name='lier_trad' id='lier_trad' size='5' />\n"),
				_T('bouton_valider'),
				"")
		. "</td>\n"
		. "<td style='width: 10px'> &nbsp; </td>"
		. "<td style='width: 2px; background: url(" . chemin_image("tirets-separation.gif") . ")'>". http_img_pack('rien.gif', " ", "width='2' height='2'") . "</td>"
		. "<td style='width: 10px'> &nbsp; </td>";
	}

	$form .= "<td>"
	. icone_horizontale(_T('trad_new'), generer_url_ecrire("articles_edit","new=oui&lier_trad=$id_article&id_rubrique=$id_rubrique"), "traductions-24.gif", "creer.gif", false)
	. "</td>";

	if ($flag AND $liste) {
		$clic = _T('trad_delier');
		$form .= "<td style='width: 10px'> &nbsp; </td>"
		. "<td style='width: 2px; background: url(" . chemin_image("tirets-separation.gif") . ")'>". http_img_pack('rien.gif', " ", "width='2' height='2'") . "</td>"
		. "<td style='width: 10px'> &nbsp; </td>"
		. "<td>"
		  // la 1ere occurrence de clic ne sert pas en Ajax
		. icone_horizontale($clic, ajax_action_auteur("referencer_traduction","$id_article,-$id_trad",'articles', "id_article=$id_article",array($clic)), "traductions-24.gif", "supprimer.gif", false)
		. "</td>\n";
	}

	$form .= "</tr></table>";
	}
	if ($GLOBALS['meta']['gerer_trad'] == 'oui')
		$bouton = _T('titre_langue_trad_article');
	else
		$bouton = _T('titre_langue_article');

	if ($langue_article)
		$bouton .= "&nbsp; (".traduire_nom_langue($langue_article).")";

	$res = debut_cadre_enfonce('langues-24.gif', true, "", 
			bouton_block_depliable($bouton,$flag === 'ajax','languearticle,lier_traductions'))
		. debut_block_depliable($flag === 'ajax','languearticle')
		. $reponse
		. fin_block()
		. $liste
		. debut_block_depliable($flag === 'ajax','lier_traductions')
		. $form
		. fin_block()
		. fin_cadre_enfonce(true);
	return ajax_action_greffe("referencer_traduction", $id_article, $res);
}


// http://doc.spip.org/@articles_traduction
function articles_traduction($row, $id_article)
{
	global $connect_toutes_rubriques;

	$vals = array();
	$id_rubrique_trad = $row["id_rubrique"];
	$id_article_trad = $row["id_article"];
	$id_trad = $row["id_trad"];
	$titre_trad = $row["titre"];
	$lang_trad = $row["lang"];
	$statut_trad = $row["statut"];

	changer_typo($lang_trad);
	$lang_dir = lang_dir($lang_trad);
	$titre_trad = "<span dir='$lang_dir'>$titre_trad</span>";

	$puce_statut = charger_fonction('puce_statut', 'inc');
	$vals[] = $puce_statut($id_article_trad, $statut_trad, $id_rubrique_trad, 'article');
		
	if ($id_article_trad == $id_trad) {
			$vals[] = http_img_pack('langues-12.gif', "", " class='lang'");
			$titre_trad = "<b>$titre_trad</b>";
	} else {
		if (!$connect_toutes_rubriques)
			$vals[] = http_img_pack('langues-off-12.gif', "", " class='lang'");
		else 
		    $vals[] = ajax_action_auteur("referencer_traduction", "$id_article,$id_trad,$id_article_trad", 'articles', "id_article=$id_article", array(http_img_pack('langues-off-12.gif', _T('trad_reference'), "class='lang'"), ' title="' . _T('trad_reference') . '"'));
	}

	$s = typo(supprime_img($titre_trad,''));
	if ($id_article_trad != $id_article) 
			$s = "<a href='" . generer_url_ecrire("articles","id_article=$id_article_trad") . "'>$s</a>";
	if ($id_article_trad == $id_trad)
			$s .= " "._T('trad_reference');

	$vals[] = $s;
	$vals[] = traduire_nom_langue($lang_trad);
	return $vals;
}

?>
