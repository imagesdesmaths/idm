<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include('exec/message_edit.php');

function exec_message_edit()
{
	global  $connect_id_auteur, $connect_statut,   $spip_lang_rtl;

	$id_message =  intval(_request('id_message'));
	$dest = intval(_request('dest'));

	if (_request('new')=='oui') {
		$onfocus = "\nonfocus=\"if(!antifocus){this.value='';antifocus=true;}\"";
	} else $onfocus = '';

	$row = spip_fetch_array(spip_query("SELECT * FROM spip_messages WHERE id_message=$id_message"));

	$id_message = $row['id_message'];
	$date_heure = $row["date_heure"];
	$date_fin = $row["date_fin"];
	$titre = entites_html($row["titre"]);
	$texte = entites_html($row["texte"]);
	//Ajout du champ lieu
	$lieu = entites_html($row["lieu"]);
	//Ajout du champ id_rubrique
	$id_rubrique =  $row["id_rubrique"];
	$type = $row["type"];
	$statut = $row["statut"];
	$rv = $row["rv"];
	$expediteur = $row["id_auteur"];

	if (!($expediteur == $connect_id_auteur OR ($type == 'affich' AND $connect_statut == '0minirezo'))) {
		echo minipres(_T('avis_non_acces_message'));
		exit;
	}

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
		$nom = spip_fetch_array(spip_query("SELECT nom, email FROM spip_auteurs WHERE id_auteur=$dest"));
		if (strlen($nom['email']) > 3) {
			echo "<div align='center'>";
			icone(_T('info_envoyer_message_prive'), "mailto:".$nom['email'], "envoi-message-24.gif");
			echo "</div>";
		}
	}

	echo debut_droite('', true);

	$res =  "<div class='arial2'>"
	. "<span style='color:green' class='verdana1 spip_small'><b>$le_type</b></span>";
	if ($type == "affich")
		$res .="<p style='color:red;' class='verdana1 spip_x-small'>" . _T('texte_message_edit')."</p>";
	
	$res .= '<br /><br />' . _T('texte_titre_obligatoire')."<br />\n";
	$res .="<input type='text' class='formo' name='titre' value=\"$titre\" size='40' $onfocus />";

	if (!$dest) {
		if ($type == 'normal') {
		  $res .="<br /><b>"._T('info_nom_destinataire')."</b><br />\n";
		  $res .="<input type='text' class='formo' name='cherche_auteur' value='' size='40'/>";
		}
	} else {
		$nom = spip_fetch_array(spip_query("SELECT nom FROM spip_auteurs WHERE id_auteur=$dest"));
		$res .="<br /><b>" .
		  _T('info_nom_destinataire') .
		  "</b>&nbsp;:&nbsp;&nbsp; " .
		  $nom['nom'] .
		  "<br /><br />\n";
	}
	$res .= '<br />';

	//////////////////////////////////////////////////////
	// Fixer rendez-vous?
	//
	if ($rv == "oui") $fonction = "rv.gif";	else $fonction = "";
	$res .= debut_cadre_trait_couleur($logo.".gif", true, $fonction, _T('titre_rendez_vous'));
	$res .= afficher_si_rdv($date_heure, $date_fin, ($rv == "oui")); 
	$res .= fin_cadre_trait_couleur(true);

	//Edition du champ LIEU
	if($type == 'affich') {
		$res .="<br /><b>"._T('ap:lieu')."</b><br />\n";
		$res .= "<input type='text' class='formo' name='lieu' value=\"$lieu\" size='40' />";;
		$res .="<br />\n";
	}

	// selecteur de rubrique
	$chercher_rubrique = charger_fonction('chercher_rubrique', 'inc');
	$res .= debut_cadre_couleur("rubrique-24.gif", true, "",_T('entree_interieur_rubrique'));
	$res .= $chercher_rubrique($id_rubrique, 'annonce', false); 
	$res .= fin_cadre_couleur(true);

	$res .= "\n<p><b>"._T('info_texte_message_02')."</b><br />";
	$res .= "<textarea name='texte' rows='20' class='formo' cols='40'>";
	$res .= $texte;
	$res .= "</textarea></p><br />\n";
	
	$res .= "\n<div align='right'><input type='submit' value='"._T('bouton_valider')."' class='fondo'/></div>"	
	. "\n</div>";

	echo redirige_action_auteur('editer_message', $id_message, 'message',"id_message=$id_message", $res, " method='post'");

	echo fin_gauche(), fin_page();
}

?>
