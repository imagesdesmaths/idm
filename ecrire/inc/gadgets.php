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

//
// Pour les boutons dont l'action fait des requetes SQL,
// le bandeau des gadgets s'affiche en deux temps :
// 1. On affiche un minimum de <div> permettant aux boutons de jouer
//    du on/off au survol
//    -> fonction bandeau_gadgets()
// 2. Au survol, sera execute un script en Ajax menu_{gadget}.php
//


// http://doc.spip.org/@bandeau_gadgets
function bandeau_gadgets($largeur, $options, $id_rubrique) {
  global $connect_id_auteur, $spip_lang_rtl, $spip_lang, $spip_lang_left, $spip_lang_right, $spip_ecran;

	$bandeau = "<div id='bandeau-gadgets'>".
	"\n<div style='width:{$largeur}px' class='centered'>\n<div style='position: relative; z-index: 1000; height:1%'>"

	// GADGET Menu rubriques
	. "\n<div id='bandeautoutsite' class='bandeau bandeau_couleur_sous' style='text-align:$spip_lang_left;$spip_lang_left: 0px;'>"
	. "<a href='"
	. generer_url_ecrire("articles_tous")
	. "' class='lien_sous'" 
	. ">"
	._T('icone_site_entier')
	. "</a>"
	. "\n<div id='gadget-rubriques'></div>"
	. "</div>";
	// FIN GADGET Menu rubriques


	// GADGET Navigation rapide
	$bandeau .= "<div id='bandeaunavrapide' class='bandeau bandeau_couleur_sous' style='text-align:$spip_lang_left;$spip_lang_left: 30px;'>"
	. "<a href='" . generer_url_ecrire("brouteur", ($id_rubrique ? "id_rubrique=$id_rubrique" : '')) . "' class='lien_sous'>" . _T('icone_brouteur') . "</a>"
	. "\n<div id='gadget-navigation'></div>\n"
	. "</div>\n";
	// FIN GADGET Navigation rapide

	// GADGET Recherche
	$r =  _T('info_rechercher');
	$bandeau .= "\n<div id='bandeaurecherche' class='bandeau bandeau_couleur_sous' style='text-align:$spip_lang_left;$spip_lang_left: 60px;'>"
	. generer_form_ecrire('recherche', 
		("<input type='text' size='10' value='$r' name='recherche' class='formo' accesskey='r' id='form_recherche' style='width: 140px;' />"),
		" method='get' style='margin: 0px; position: relative;'")
	. "</div>";
	// FIN GADGET recherche

	// messagerie et agenda
	if ($GLOBALS['meta']['messagerie_agenda'] != 'non') {
		// GADGET Agenda
		$bandeau .= "<div id='bandeauagenda' class='bandeau bandeau_couleur_sous' style='text-align:$spip_lang_left;$spip_lang_left: 100px;'>"
		. "<a href='" . generer_url_ecrire("calendrier","type=semaine") . "' class='lien_sous'>"
		. _T('icone_agenda')
		. "</a>"
		
		. "\n<div id='gadget-agenda'></div>\n"
		. "</div>\n";
		// FIN GADGET Agenda

		// GADGET Messagerie
		$gadget = '';
		$gadget .= "<div id='bandeaumessagerie' class='bandeau bandeau_couleur_sous' style='text-align:$spip_lang_left;$spip_lang_left: 130px;'>";
		$gadget .= "<a href='" . generer_url_ecrire("messagerie") . "' class='lien_sous'>";
		$gadget .= _T('icone_messagerie_personnelle');
		$gadget .= "</a>";
		$gadget .= "\n<div id='gadget-messagerie'></div>\n";
		$gadget .= "</div>";

		$bandeau .= $gadget;

		// FIN GADGET Messagerie
	}

	// Suivi activite
	$bandeau .= "<div id='bandeausynchro' class='bandeau bandeau_couleur_sous' style='$spip_lang_left: 160px;'>"
	. "<a href='" . generer_url_ecrire("synchro") . "' class='lien_sous'>"
	. _T('icone_suivi_activite')
	. "</a>"
//	. "\n<div id='gadget-suivi'><div>&nbsp;</div>"
//	. icone_horizontale(_T('analyse_xml'), parametre_url(self(),'transformer_xml', 'valider_xml'), 'racine-24.gif', '', false)
//	. "</div>".
	. "</div>\n";

/*	
		// Infos perso
	$bandeau .= "\n<div id='bandeauinfoperso' class='bandeau bandeau_couleur_sous' style='$spip_lang_left: 200px;'>"
	. "<a href='" . generer_url_ecrire("auteur_infos","id_auteur=$connect_id_auteur") . "' class='lien_sous'>"
	. _T('icone_informations_personnelles')
	. "</a>"
	. "</div>";
*/
		
		//
		// -------- Affichage de droite ----------
	
		// Deconnection
	$bandeau .= "\n<div class='bandeau bandeau_couleur_sous' id='bandeaudeconnecter' style='$spip_lang_right: 0px;'>";
	$bandeau .= "<a href='" . generer_url_action("logout","logout=prive") . "' class='lien_sous'>"._T('icone_deconnecter')."</a>".aide("deconnect");
	$bandeau .= "</div>";
	
	$decal = 0;
	$decal = $decal + 150;

	$bandeau .= "\n<div id='bandeauinterface' class='bandeau bandeau_couleur_sous' style='$spip_lang_right: ".$decal."px; text-align: $spip_lang_right; white-space: nowrap;'>";
	
	// couleurs
//	$couleurs = charger_fonction('couleurs', 'inc');
//	$bandeau .= "<div id='preferences_couleurs' title='" . attribut_html(_T('titre_changer_couleur_interface')) . "'>";
//	$bandeau .= $couleurs() . "</div>";

	// menu
	$self = self('&');
	$bandeau .= "\n<div id='preferences_map'><map name='map_layout' id='map_layout'>"
	  . lien_change_var (generer_action_auteur('preferer',"display:1", $self),'','', '1,0,18,15', _T('lien_afficher_texte_seul'))
	  . lien_change_var (generer_action_auteur('preferer',"display:2", $self),'','', '19,0,40,15', _T('lien_afficher_texte_icones'))
	  . lien_change_var (generer_action_auteur('preferer',"display:3", $self),'','', '41,0,59,15', _T('lien_afficher_icones_seuls'))
		. "\n</map></div>";
	$bandeau .= "<div id='preferences_menu'>"
		. http_img_pack("choix-layout$spip_lang_rtl".($spip_lang=='he'?'_he':'').".gif", _T('choix_interface'), " style='vertical-align: middle' width='59' height='15' usemap='#map_layout'")
		. http_img_pack("rien.gif", "", "width='10' height='1'")
		. "</div>";
	// ecran
	if ($spip_ecran == "large") 
		$bandeau .= "<div id='preferences_ecran'><a href='".generer_action_auteur('preferer',"spip_ecran:etroit", $self)."' class='lien_sous'>"._T('info_petit_ecran')."</a>/<b>"._T('info_grand_ecran')."</b></div>";
	else
		$bandeau .= "<div id='preferences_ecran'><b>"._T('info_petit_ecran')."</b>/<a href='".generer_action_auteur('preferer',"spip_ecran:large", $self)."' class='lien_sous'>"._T('info_grand_ecran')."</a></div>";
	$bandeau .= "</div>";


	$bandeau .= "</div>";
	$bandeau .= "</div>\n";


	$bandeau .= '</div>';
	
	return $bandeau;
}

// http://doc.spip.org/@gadget_messagerie
function gadget_messagerie() {
	global $connect_statut;

	return "<div>&nbsp;</div>"
	. icone_horizontale(_T('lien_nouvea_pense_bete'),generer_action_auteur("editer_message","pb"), "pense-bete.gif",'',false)
	.  icone_horizontale(_T('lien_nouveau_message'),generer_action_auteur("editer_message","normal"), "message.gif",'',false)
	  . (($connect_statut != "0minirezo") ? '' :
	     icone_horizontale(_T('lien_nouvelle_annonce'),generer_action_auteur("editer_message","affich"), "annonce.gif",'',false));
}

// http://doc.spip.org/@installer_gadgets
function installer_gadgets($id_rubrique)
{
	return "<a id='boutonbandeautoutsite' href='"
	. generer_url_ecrire("articles_tous")
	. "' class='icone26' onmouseover=\"changestyle('bandeautoutsite');\" onfocus=\"changestyle('bandeautoutsite');\" onblur=\"changestyle('bandeautoutsite');\">"
	. http_img_pack("tout-site.png", _T('icone_site_entier'), "width='26' height='20'")
	. "</a>"
	. "<a id='boutonbandeaunavrapide' href='"
	. generer_url_ecrire("brouteur",($id_rubrique ? "id_rubrique=$id_rubrique" : ''))
	. "' class='icone26' onmouseover=\"changestyle('bandeaunavrapide');\" onfocus=\"changestyle('bandeaunavrapide');\" onblur=\"changestyle('bandeaunavrapide');\">"
	. http_img_pack("naviguer-site.png",  _T('icone_brouteur'), "width='26' height='20'")
	."</a>"
	. "<a href='"
	. generer_url_ecrire("recherche")
	. "' class='icone26' onmouseover=\"changestyle('bandeaurecherche'); jQuery('#form_recherche')[0].focus();\" onfocus=\"changestyle('bandeaurecherche');\" onblur=\"changestyle('bandeaurecherche');\">"
	. http_img_pack("loupe.png", _T('info_rechercher'), "width='26' height='20'")
	."</a>"

	. (($GLOBALS['meta']['messagerie_agenda'] != 'non')
		? http_img_pack("rien.gif", "", "width='10'")
		. "<a id='boutonbandeauagenda' href='"
		. generer_url_ecrire("calendrier","type=semaine")
		. "' class='icone26' onmouseover=\"changestyle('bandeauagenda');\">"
		. http_img_pack("cal-rv.png", _T('icone_agenda'), "width='26' height='20'")
		."</a>"
		. "<a href='"
		. generer_url_ecrire("messagerie")
		. "' class='icone26' onmouseover=\"changestyle('bandeaumessagerie');\" onfocus=\"changestyle('bandeaumessagerie');\" onblur=\"changestyle('bandeaumessagerie');\">"
		. http_img_pack("cal-messagerie.png", _T('icone_messagerie_personnelle'), "width='26' height='20'")
		."</a>"
		. "<a href='"
		. generer_url_ecrire("synchro")
		. "' class='icone26' onmouseover=\"changestyle('bandeausynchro');\" onfocus=\"changestyle('bandeausynchro');\" onblur=\"changestyle('bandeausynchro');\">"
		. http_img_pack("cal-suivi.png", _T('icone_suivi_activite'), "width='26' height='20'")
		. "</a>"
	: '');
}

// http://doc.spip.org/@repercuter_gadgets
function repercuter_gadgets($id_rubrique) {

	if (!_SPIP_AJAX) return '';

	// comme on cache fortement ce menu,
	// son url change en fonction de sa date de modif
	$toutsite = "./?exec=menu_rubriques\\x26date=" .  $GLOBALS['meta']['date_calcul_rubriques'];
	$navrapide = "./?exec=menu_navigation\\x26id_rubrique=$id_rubrique";
	$agenda = "./?exec=menu_agenda";

	return
	
	 "\ninit_gadgets('$toutsite','$navrapide','$agenda','"
	 .str_replace('</', '<\\/', addslashes(strtr(gadget_messagerie(),"\n\r","  ")))
	 ."');\n";

}

?>
