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

// http://doc.spip.org/@exec_statistiques_lang_dist
function exec_statistiques_lang_dist()
{
        if (!autoriser('voirstats')) {
          include_spip('inc/minipres');
          echo minipres();
	} else statistiques_lang_ok();
}

// http://doc.spip.org/@statistiques_lang_ok
function statistiques_lang_ok()
{
	global $spip_ecran, $spip_lang_right;

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('onglet_repartition_lang'), "statistiques_visites", "repartition-langues");

	if ($spip_ecran == "large") {
		$largeur_table = 974;
	} else {
		$largeur_table = 750;
	}
	$taille = $largeur_table - 200;	
	echo "<table class='centered' width='$largeur_table'><tr><td style='width: $largeur_table" . "px; text-align:center;' class='verdana2'>";
	echo "<br /><br />";

	echo gros_titre(_T('onglet_repartition_lang'),'', false);

//barre_onglets("repartition", "langues");

	if (_request('critere') == "debut") {
		$critere = "visites";
//	echo gros_titre(_T('onglet_repartition_debut','', false));	
	} else {
		$critere = "popularite";
//	echo gros_titre(_T('onglet_repartition_actuelle','', false));	
}

	echo ($critere == "popularite") ? barre_onglets("rep_depuis", "popularite"): barre_onglets("rep_depuis", "debut");


//
// Statistiques par langue
//


	echo debut_cadre_enfonce("langues-24.gif", true);

	$r = sql_fetsel("SUM($critere) AS total_visites", "spip_articles");

	$visites = 1;
	if ($r)
		$total_visites = $r['total_visites'];
	else
		$total_visites = 1;

	$result = sql_select("lang, SUM(".$critere.") AS cnt", "spip_articles", "statut='publie' ", "lang");
		
	echo "\n<table cellpadding='2' cellspacing='0' border='0' width='100%' style='border: 1px solid #aaaaaa;'>";
	$ifond = 1;
		
	$visites_abs = 0;
	while ($row = sql_fetch($result)) {

		$lang = $row['lang'];
		$visites = round($row['cnt'] / $total_visites * $taille);
		$pourcent = round($row['cnt'] / $total_visites * 100);

		if ($visites > 0) {

				if ($ifond==0){
					$ifond=1;
					$couleur="white";
				}else{
					$ifond=0;
					$couleur="eeeeee";
				}
	
				echo "\n<tr style='background-color: $couleur'>";
				$dir=lang_dir($lang,'',' dir="rtl"');
				echo "<td style='width: 100%; border-bottom: 1px solid #cccccc;'><span class='verdana2'$dir><span style='float: $spip_lang_right;'>$pourcent%</span>".traduire_nom_langue($lang)."</span></td>";
				
				echo "<td style='border-bottom: 1px solid #cccccc;'>";
				echo "\n<table cellpadding='0' cellspacing='0' border='0' width='".($taille+5)."'>";
				echo "\n<tr><td style='align:$spip_lang_right; background-color: #eeeeee; border: 1px solid #999999; white-space: nowrap;'>";
				if ($visites_abs > 0) echo "<img src='" . chemin_image('rien.gif') . "' width='$visites_abs' height='8' alt=' ' />";
				if ($visites>0) echo "<img src='" . chemin_image('rien.gif') . "' class='couleur_langue' style='border: 0px;' width='$visites' height='8' alt=' ' />";
				echo "</td></tr></table>\n";
	
				echo "</td>";
				echo "</tr>";
				$visites_abs += $visites;
		}
	}
	echo "</table>\n";


//echo "<p><span class='verdana1 spip_medium'>"._T('texte_signification')."</span>";

	echo fin_cadre_enfonce(true);

	echo "</td></tr></table>";
	echo fin_page();
}
?>
