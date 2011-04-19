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
include_spip('inc/date');


// http://doc.spip.org/@exec_message_edit_dist
function exec_message_edit_dist()
{
	exec_message_edit_args(intval(_request('id_message')), 
			       _request('new'),
			       intval(_request('dest')));
}
// http://doc.spip.org/@exec_message_edit_args
function exec_message_edit_args($id_message, $new, $dest)
{
	global  $connect_id_auteur, $connect_statut;

	if ($new == 'oui') {
		$onfocus = "\nonfocus=\"if(!antifocus){this.value='';antifocus=true;}\"";
	} else $onfocus = '';

	$row = sql_fetsel("*", "spip_messages", "id_message=$id_message");

	$id_message = $row['id_message'];
	$date_heure = $row["date_heure"];
	$date_fin = $row["date_fin"];
	$titre = entites_html($row["titre"]);
	$texte = entites_html($row["texte"]);
	$type = $row["type"];
	$statut = $row["statut"];
	$rv = $row["rv"];
	$expediteur = $row["id_auteur"];

	if (!($expediteur == $connect_id_auteur OR ($type == 'affich' AND $connect_statut == '0minirezo'))) {
		include_spip('inc/minipres');
		echo minipres();
	} else {

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('titre_page_message_edit'), "accueil", "messagerie");

	if ($type == 'normal') {
	  $le_type = _T('bouton_envoi_message_02');
	  $logo = "message";
	}
	if ($type == 'pb') {
	  $le_type = _T('bouton_pense_bete');
	  $logo = "pense-bete";
	}
	if ($type == 'affich') {
	  $le_type = _T('bouton_annonce');
	  $logo = "annonce";
	}


	echo debut_gauche('', true);
	
	if($type == 'normal' AND $dest) {
		$email = sql_getfetsel("email", "spip_auteurs", "id_auteur=$dest");
		if (strlen($email) > 3) {
			echo icone(_T('info_envoyer_message_prive'), "mailto:".$email, "envoi-message-24.gif");
		}
	}

	echo debut_droite('', true);

	$res =  "<div class='arial2'>"
	. "<span style='color:green' class='verdana1 spip_small'><b>$le_type</b></span>";
	if ($type == "affich")
		$res .="<p style='color:red;' class='verdana1 spip_x-small'>" . _T('texte_message_edit')."</p>";
	
	$res .= '<br /><br />'."<label for='titre'>" . _T('texte_titre_obligatoire')."</label><br />\n";
	$res .="<input type='text' class='formo' name='titre' id='titre' value=\"$titre\" size='40' $onfocus />";

	if (!$dest) {
		if ($type == 'normal') {
		  $res .="<br /><label for='cherche_auteur'><b>"._T('info_nom_destinataire')."</b></label><br />\n";
		  $res .="<input type='text' class='formo' name='cherche_auteur' id='cherche_auteur' value='' size='40'/>";
		}
	} else {
		$nom = sql_getfetsel("nom", "spip_auteurs", "id_auteur=$dest");
		$res .= "<br /><b>" .
		  _T('info_nom_destinataire') .
		  "</b>&nbsp;:&nbsp;&nbsp; " .
		  $nom .
		  "<br /><br />\n";
	}
	$res .= '<br />';

	//////////////////////////////////////////////////////
	// Fixer rendez-vous?
	//
	if ($rv == "oui") $fonction = "rv.gif";	else $fonction = "";

	$res .= debut_cadre_trait_couleur($logo.".gif", true, $fonction, _T('titre_rendez_vous'))
	  . afficher_si_rdv($date_heure, $date_fin, ($rv == "oui"))
	  . fin_cadre_trait_couleur(true)
	  . "\n<p><label for='texte'><b>"
	  . _T('info_texte_message_02')
	  . "</b></label><br />"
	  . "<textarea name='texte' id='texte' rows='20' class='formo' cols='40'>"
	  . $texte
	  . "</textarea></p><br />\n"
	  . "\n<div style='text-align: right'><input type='submit' value='"
	  . _T('bouton_valider')
	  . "' /></div>"	
	  . "\n</div>";

	echo redirige_action_post('editer_message', $id_message, 'message',"id_message=$id_message", $res);

	echo fin_gauche(), fin_page();
	}
}

// http://doc.spip.org/@afficher_si_rdv
function afficher_si_rdv($date_heure, $date_fin, $choix)
{
	$heures_debut = heures($date_heure);
	$minutes_debut = minutes($date_heure);
	$heures_fin = heures($date_fin);
	$minutes_fin = minutes($date_fin);
  
	if ($date_fin == "0000-00-00 00:00:00") {
		$date_fin = $date_heure;
		$heures_fin = $heures_debut + 1;
	}
  
	if ($heures_fin >=24){
		$heures_fin = 23;
		$minutes_fin = 59;
	}
			
	$lib = _T('item_non_afficher_calendrier');
	if (!$choix)  $lib = "<b>$lib</b>";

	$res = "\n<div><input type='radio' name='rv' value='non' id='rv_off'" .
		(!$choix ? " checked='checked' " : '')
		. "\nonclick=\"changeVisible(this.checked, 'heure-rv', 'none', 'block');\"/>"
		. "<label for='rv_off'>"
		. $lib
		. "</label>"
		. "</div>";

	$lib = _T('item_afficher_calendrier');
	if ($choix)  $lib = "<b>$lib</b>";

	$res .= "\n<div><input type='radio' name='rv' value='oui' id='rv_on' " .
		($choix ? " checked='checked' " : '') .
		"\nonclick=\"changeVisible(this.checked, 'heure-rv', 'block', 'none');\"/>" . 
		"<label for='rv_on'>"
		. $lib
		. "</label>"
	  . '</div>';
	
	$display = ($choix ? "block" : "none");
	
	return $res .
	 "\n<div id='heure-rv' style='display: $display; padding-top: 4px; padding-left: 24px;'>" .
	  afficher_jour_mois_annee_h_m($date_heure, $heures_debut, $minutes_debut) .
	  "<br />".
	  afficher_jour_mois_annee_h_m($date_fin, $heures_fin, $minutes_fin, '_fin') .
	  "</div>";
}

?>
