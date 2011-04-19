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

# Les informations sur un auteur selectionne dans le mini navigateur

// http://doc.spip.org/@inc_informer_auteur_dist
function inc_informer_auteur_dist($id)
{
	global $spip_display,$spip_lang_right ;

	include_spip('inc/presentation');
	include_spip('inc/formater_auteur');

	$row = sql_fetsel("*", "spip_auteurs", "id_auteur = $id");
	if ($row) {
		$nom = typo($row["nom"]);
		$bio = propre($row["bio"]);
		$mail = formater_auteur_mail($row, $id);
		$nb = sql_countsel("spip_auteurs_articles", "id_auteur=$id");
		if ($nb > 1)
		  $nb = $nb . "&nbsp;" . _T('info_article_2');
		else if($nb == 1)
		  $nb = "1&nbsp;" . _T('info_article');
		else $nb = "&nbsp;";
	} else {
		$nom = "<span style='color:red'>"
			. _T('texte_vide')
			. '</span>';
		$bio = $mail = $nb = '';
	}
	$res = '';
	if ($spip_display != 1 AND $spip_display!=4 AND $GLOBALS['meta']['image_process'] != "non") {
		$chercher_logo = charger_fonction('chercher_logo', 'inc');
		if ($res = $chercher_logo($id, 'id_auteur', 'on'))  {
			list($fid, $dir, $n, $format) = $res;
			include_spip('inc/filtres_images_mini');
			$res = image_reduire("<img src='$fid' alt='' />", 100, 48);
			if ($res)
				$res =  "<div style='float: $spip_lang_right; margin-$spip_lang_right: -5px; margin-top: -5px;'>$res</div>";
		}
	}

	return "<div class='informer-auteur'>"
	. (!$res ? '' : $res)
	. "<div><a href='"
	. generer_url_ecrire('auteur_infos', "id_auteur=$id")
	. "'>"
	. bonhomme_statut($row)
	. "</a> "
	. $mail
	. " <b>"
	. $nom
	. "</b><br />"
	. $nb
	. "</div><br />"
	. "<div>$bio</div>"
	.  "</div>";
}
?>
