<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include('exec/message.php');

function exec_message()
{
	exec_message_args_ap(intval(_request('id_message')),_request('forcer_dest'),  _request('cherche_auteur'));
}

function exec_message_args_ap($id_message, $forcer_dest, $cherche_auteur)
{
	global  $connect_id_auteur;

	$res = sql_getfetsel("type", "spip_messages", "id_message=$id_message");

	if ($res AND $res != "affich")
		$res = sql_fetsel("vu", "spip_auteurs_messages", "id_auteur=$connect_id_auteur AND id_message=$id_message");

	if (!$res) {
		include_spip('inc/minipres');
		echo minipres();
	} else {
	// Marquer le message vu pour le visiteur
		if (is_array($res) AND $res['vu'] != 'oui') {
			include_spip('inc/headers');
			redirige_par_entete(redirige_action_auteur("editer_message","$id_message/:$connect_id_auteur", 'message', "id_message=$id_message", true));
		}
		//Raison  de la surcharge
		exec_affiche_message($id_message, $cherche_auteur, $forcer_dest);
	}
}

function exec_affiche_message($id_message, $cherche_auteur, $forcer_dest)
{
  $row = sql_fetsel("*", "spip_messages", "id_message=$id_message");
  if ($row) {
	$id_message = $row['id_message'];
	$date_heure = $row["date_heure"];
	$date_fin = $row["date_fin"];
	$titre = typo($row["titre"]);
	$texte = propre($row["texte"]);
	//Ajout du champ lieu
	$lieu = typo($row["lieu"]);
	//Ajout du champ id_rubrique
	$id_rubrique = $row['id_rubrique'];
	$type = $row["type"];
	$statut = $row["statut"];
	$rv = $row["rv"];
	$expediteur = $row['id_auteur'];

	$lejour=journum($row['date_heure']);
	$lemois = mois($row['date_heure']);		
	$lannee = annee($row['date_heure']);		

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page($titre, "accueil", "messagerie");

	echo debut_gauche('', true);
	
	if ($rv != 'non')
	  echo http_calendrier_agenda ($lannee, $lemois, $lejour, $lemois, $lannee,false, generer_url_ecrire('calendrier'));
	
	echo "<br />";
	echo  http_calendrier_rv(quete_calendrier_taches_annonces(),"annonces");
	echo  http_calendrier_rv(quete_calendrier_taches_pb(),"pb");
	echo  http_calendrier_rv(quete_calendrier_taches_rv(), "rv");

	if ($rv != "non") {
		list ($sh, $ah) = quete_calendrier_interval(quete_calendrier_jour($lannee,$lemois, $lejour));
		foreach ($ah as $k => $v)
		  {
		    foreach ($v as $l => $e)
		      {
			if (preg_match(",=$id_message$,", $e['URL']))
			  {
			    $ah[$k][$l]['CATEGORIES'] = "calendrier-nb";
			    break;
			  }
		      }
		  }
		echo creer_colonne_droite('', true);	

		echo http_calendrier_ics_titre($lannee,$lemois,$lejour,generer_url_ecrire('calendrier'));
		echo http_calendrier_ics($lannee,$lemois, $lejour, '', '', 90, array($sh, $ah));
	}

	echo debut_droite('', true);

	//Seconde raison de la surcharge
	http_affiche_message_ap($id_message, $expediteur, $statut, $type, $texte, $titre, $rv, $date_heure, $date_fin, $cherche_auteur, $forcer_dest, $lieu, $id_rubrique);

	// reponses et bouton poster message

	$discuter = charger_fonction('discuter', 'inc');
	echo $discuter($id_message, 'message', 'id_message', "perso");
  }

  echo fin_gauche(), fin_page();
}

function http_affiche_message_ap($id_message, $expediteur, $statut, $type, $texte, $titre, $rv, $date_heure, $date_fin, $cherche_auteur, $forcer_dest, $lieu, $id_rubrique)
{
  global $connect_id_auteur,$connect_statut, $les_notes; 

	if ($type == 'normal') {
		$le_type = _T('info_message_2').aide ("messut");
		$la_couleur = "#02531b";
		$fond = "#cffede";
	}
	else if ($type == 'pb') {
		$le_type = _T('info_pense_bete').aide ("messpense");
		$la_couleur = "#3874b0";
		$fond = "#edf3fe";
	}
	else if ($type == 'affich') {
		$le_type = _T('info_annonce');
		$la_couleur = "#ccaa00";
		$fond = "#ffffee";
	}
	
	// affichage des caracteristiques du message

	echo "<div style='border: 1px solid $la_couleur; background-color: $fond; padding: 5px;'>"; // debut cadre de couleur
	//echo debut_cadre_relief("messagerie-24.gif", true);
	echo "\n<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
	echo "<tr><td>"; # uniques

	echo "<span style='color: $la_couleur' class='verdana1 spip_small'><b>$le_type</b></span><br />";
	echo "<span class='verdana1 spip_large'><b>$titre</b></span>";
	if ($statut == 'redac') {
		echo "<br /><span style='color: red;' class='verdana1 spip_small'><b>"._T('info_redaction_en_cours')."</b></span>";
	}
	else if ($rv == 'non') {
		echo "<br /><span style='color: #666666;' class='verdana1 spip_small'><b>".nom_jour($date_heure).' '.affdate_heure($date_heure)."</b></span>";
	}


	//////////////////////////////////////////////////////
	// Message avec participants
	//
	
	if ($type == 'normal')
	  $total_dest = http_message_avec_participants($id_message, $statut, $forcer_dest, $cherche_auteur, $expediteur);

	if ($rv != "non") http_afficher_rendez_vous($date_heure, $date_fin);

	//Affichage du champ Lieu
	if($type == 'affich') {
		echo "<div class='serif'><p>". _T('ap:lieu') . $lieu ."</p></div>";
	}
	
	//Affichage du champ ID_RUBRIQUE (du calendrier)
	if($type == 'affich') {
//		$titre_rubrique = sql_getfetsel('titre', 'spip_rubriques', 'id_rubrique='.intval($id_rubrique));
		$row = spip_fetch_array(spip_query("SELECT titre FROM spip_rubriques WHERE id_rubrique=$id_rubrique"));
		echo "<div class='serif'><p>". _T('ap:calendrier_pub') . typo($row['titre']) ."</p></div>";
	}

	//////////////////////////////////////////////////////
	// Le message lui-meme
	//

	echo "\n<br />"
	  . "<div class='serif'>$texte</div>";

	if ($les_notes) {
		echo debut_cadre_relief('', true);
		echo "<div dir=" . lang_dir() ."' class='arial11'>";
		echo justifier("<b>"._T('info_notes')."&nbsp;:</b> ".$les_notes);
		echo "</div>";
		echo fin_cadre_relief(true);
	}

	if ($expediteur == $connect_id_auteur AND $statut == 'redac') {
	  if ($type == 'normal' AND $total_dest < 2) {
	    echo "<p style='color: #666666; text-align: right;' class='verdana1 spip_small'><b>"._T('avis_destinataire_obligatoire')."</b></p>";
	  } else {
	    echo "\n<div class='centered'>";
	    echo icone_inline(_T('icone_envoyer_message'), redirige_action_auteur('editer_message', "$id_message/publie", "message","id_message=$id_message"), "messagerie-24.gif", "creer.gif");
	    echo "</div>";
	  }
	}
	echo "</td></tr></table>\n";

	//	echo "</td></tr></table>\n"; //echo fin_cadre_relief(true);
	echo "</div>";			// fin du cadre de couleur
	
	// Les boutons

	$aut = ($expediteur == $connect_id_auteur);
	$aff = ($type == 'affich' AND $connect_statut == '0minirezo');

	echo "\n<table width='100%'><tr><td>";

	// bouton de suppression

	if ($aut AND ($statut == 'redac' OR $type == 'pb') OR $aff) {
	  echo icone_inline(_T('icone_supprimer_message'), redirige_action_auteur("editer_message","-$id_message", 'messagerie'), "messagerie-24.gif", "supprimer.gif", 'left');
	}

	// bouton retrait de la discussion

	if ($statut == 'publie' AND $type == 'normal') {
	  echo icone_inline(_T('icone_arret_discussion'), redirige_action_auteur("editer_message","$id_message/-$connect_id_auteur", 'messagerie', "id_message=$id_message"), "messagerie-24.gif", "supprimer.gif", 'left');
	}

	// bouton modifier ce message

	if ($aut OR $aff) {
	  echo icone_inline(_T('icone_modifier_message'), (generer_url_ecrire("message_edit","id_message=$id_message")), "messagerie-24.gif", "edit.gif", 'right');
	}
	echo "</td></tr></table>";
}

function _http_affiche_message_ap($id_message, $expediteur, $statut, $type, $texte, $titre, $rv, $date_heure, $date_fin, $cherche_auteur, $forcer_dest, $lieu, $id_rubrique)
{
  global $connect_id_auteur,$connect_statut, $les_notes;

	if ($type == 'normal') {
		$le_type = _T('info_message_2').aide ("messut");
		$la_couleur = "#02531b";
		$couleur_fond = "#cffede";
	}
	else if ($type == 'pb') {
		$le_type = _T('info_pense_bete').aide ("messpense");
		$la_couleur = "#3874b0";
		$couleur_fond = "#edf3fe";
	}
	else if ($type == 'affich') {
		$le_type = _T('info_annonce');
		$la_couleur = "#ccaa00";
		$couleur_fond = "#ffffee";
	}
	
	// affichage des caracteristiques du message

	echo "<div style='border: 1px solid $la_couleur; background-color: $couleur_fond; padding: 5px;'>"; // debut cadre de couleur
	//debut_cadre_relief("messagerie-24.gif");
	echo "\n<table width='100%' cellpadding='0' cellspacing='0' border='0'>";
	echo "<tr><td>"; # uniques

	echo "<span style='color: $la_couleur' class='verdana1 spip_small'><b>$le_type</b></span><br />";
	echo "<span class='verdana1 spip_large'><b>$titre</b></span>";
	if ($statut == 'redac') {
		echo "<br /><span style='color: red;' class='verdana1 spip_small'><b>"._T('info_redaction_en_cours')."</b></span>";
	}
	else if ($rv == 'non') {
		echo "<br /><span style='color: #666666;' class='verdana1 spip_small'><b>".nom_jour($date_heure).' '.affdate_heure($date_heure)."</b></span>";
	}


	//////////////////////////////////////////////////////
	// Message avec participants
	//
	
	if ($type == 'normal') {
	  echo debut_cadre_enfonce("redacteurs-24.gif", true);
	  $total_dest = http_message_avec_participants($id_message, $statut, $forcer_dest, $cherche_auteur, $expediteur);
	  fin_cadre_enfonce();
	}

	if ($rv != "non") http_afficher_rendez_vous($date_heure, $date_fin);


	//Affichage du champ Lieu
	if($type == 'affich') {
		echo "<div class='serif'><p>". _T('ap:lieu') . $lieu ."</p></div>";
	}
	
	//Affichage du champ ID_RUBRIQUE (du calendrier)
	if($type == 'affich') {
//		$titre_rubrique = sql_getfetsel('titre', 'spip_rubriques', 'id_rubrique='.intval($id_rubrique));
		$row = spip_fetch_array(spip_query("SELECT titre FROM spip_rubriques WHERE id_rubrique=$id_rubrique"));
		echo "<div class='serif'><p>". _T('ap:calendrier_pub') . typo($row['titre']) ."</p></div>";
	}
	
	//////////////////////////////////////////////////////
	// Le message lui-meme
	//

	echo "<div align='left'>",
	  "\n<table width='100%' cellpadding='0' cellspacing='0' border='0'>",
	  "<tr><td>",
	  "<div class='serif'><p>$texte</p></div>";

	if ($les_notes) {
		echo debut_cadre_relief();
		echo "<div $dir_lang class='arial11'>";
		echo justifier("<b>"._T('info_notes')."&nbsp;:</b> ".$les_notes);
		echo "</div>";
		echo fin_cadre_relief();
	}

	if ($expediteur == $connect_id_auteur AND $statut == 'redac') {
	  if ($type == 'normal' AND $total_dest < 2) {
	    echo "<p style='color: #666666; text-align: right;' class='verdana1 spip_small'><b>"._T('avis_destinataire_obligatoire')."</b></p>";
	  } else {
	    echo "\n<div align='center'><table><tr><td>";
	    icone (_T('icone_envoyer_message'), redirige_action_auteur('editer_message', "$id_message/publie", "message","id_message=$id_message"), "messagerie-24.gif", "creer.gif");
	    echo "</td></tr></table></div>";
	  }
	}
	echo "</td></tr></table>\n</div>";	

	echo "</td></tr></table>\n"; //fin_cadre_relief();
	echo "</div>";			// fin du cadre de couleur
	
	// Les boutons

	$aut = ($expediteur == $connect_id_auteur);
	$aff = ($type == 'affich' AND $connect_statut == '0minirezo');

	echo "\n<table width='100%'><tr><td>";

	// bouton de suppression

	if ($aut AND ($statut == 'redac' OR $type == 'pb') OR $aff) {
	  echo "\n<table align='left'><tr><td>";
	  icone (_T('icone_supprimer_message'), redirige_action_auteur("editer_message","-$id_message", 'messagerie'), "messagerie-24.gif", "supprimer.gif");
	  echo "</td></tr></table>";
	}

	// bouton retrait de la discussion

	if ($statut == 'publie' AND $type == 'normal') {
	  echo "\n<table align='left'><tr><td>";
	  icone (_T('icone_arret_discussion'), redirige_action_auteur("editer_message","$id_message/-$connect_id_auteur", 'messagerie', "id_message=$id_message"), "messagerie-24.gif", "supprimer.gif");
	  echo "</td></tr></table>";
	}

	// bouton modifier ce message

	if ($aut OR $aff) {
	  echo "\n<table align='right'><tr><td>";
	  icone (_T('icone_modifier_message'), (generer_url_ecrire("message_edit","id_message=$id_message")), "messagerie-24.gif", "edit.gif");
	  echo "</td></tr></table>";
	}
	echo "</td></tr></table>";
}


?>
