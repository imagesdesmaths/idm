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

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');

// http://doc.spip.org/@enfants
function enfants($id_parent, $critere, &$nombre_vis, &$nombre_abs){
	$result = sql_select("id_rubrique", "spip_rubriques", "id_parent=".intval($id_parent));

	$nombre = 0;

	while($row = sql_fetch($result)) {
		$id_rubrique = $row['id_rubrique'];

		$visites = intval(sql_getfetsel("SUM(".$critere.")", "spip_articles", "id_rubrique=".intval($id_rubrique)));
		$nombre_abs[$id_rubrique] = $visites;
		$nombre_vis[$id_rubrique] = $visites;
		$nombre += $visites + enfants($id_rubrique, $critere, $nombre_vis, $nombre_abs);
	}
	if (!isset($nombre_vis[$id_parent])) $nombre_vis[$id_parent]=0;
	$nombre_vis[$id_parent] += $nombre;
	return $nombre;
}


// http://doc.spip.org/@enfants_aff
function enfants_aff($id_parent,$decalage, $taille, $critere, $gauche=0) {
	global $spip_lang_right, $spip_lang_left;
	static $abs_total=null;
	static $niveau=0;
	static $nombre_vis;
	static $nombre_abs;
	if (is_null($abs_total)){
		$nombre_vis = array();
		$nombre_abs = array();
		$abs_total = enfants(0, $critere, $nombre_vis, $nombre_abs);
		if ($abs_total<1) $abs_total=1;
		$nombre_vis[0] = 0;
	}
	$visites_abs = 0;
	$out = "";

	$result = sql_select("id_rubrique, titre, descriptif", "spip_rubriques", "id_parent=$id_parent",'', '0+titre,titre');

	while($row = sql_fetch($result)){
		$id_rubrique = $row['id_rubrique'];
		$titre = typo($row['titre']);
		$descriptif = attribut_html(couper(typo($row['descriptif']),80));

		if ($nombre_vis[$id_rubrique]>0 OR $nombre_abs[$id_rubrique]>0){
			$largeur_rouge = floor(($nombre_vis[$id_rubrique] - $nombre_abs[$id_rubrique]) * $taille / $abs_total);
			$largeur_vert = floor($nombre_abs[$id_rubrique] * $taille / $abs_total);
			
			if ($largeur_rouge+$largeur_vert>0){
					
				if ($niveau == 0) {
					$couleur="#cccccc";
				}

				else if ($niveau == 1) {
					$couleur="#eeeeee";
				}
				else {
					$couleur="white";
				}
				$out .= "<table cellpadding='2' cellspacing='0' border='0' width='100%'>";
				$out .= "\n<tr style='background-color: $couleur'>";
				$out .= "\n<td style='border-bottom: 1px solid #aaaaaa; padding-$spip_lang_left: ".($niveau*20+5)."px;'>";

				
				if ( $largeur_rouge > 2) 
					$out .= bouton_block_depliable("<a href='" . generer_url_entite($id_rubrique,'rubrique') . "' style='color: black;' title=\"$descriptif\">$titre</a>","incertain", "stats$id_rubrique");
				else
					$out .= "<div class='verdana1' style='padding-left: 18px; padding-top: 4px; padding-bottom: 3px;'>"
						. "<a href='" . generer_url_entite($id_rubrique,'rubrique') . "' style='color: black;' title=\"$descriptif\">$titre</a>"
						. "</div>";
				$out .= "</td>";
				
				
				if ($niveau==0 OR 1==1){
					$pourcent = round($nombre_vis[$id_rubrique]/$abs_total*1000)/10;
					$out .= "\n<td class='verdana1' style='text-align: $spip_lang_right; width: 40px; border-bottom: 1px solid #aaaaaa;'>$pourcent%</td>";
				}
				else {
					$out .= "<td style='width: 10px; border-bottom: 1px solid #aaaaaa;'></td>";
				}
				
				
				$out .= "\n<td align='right' style='border-bottom: 1px solid #aaaaaa; width:" . ($taille+5) ."px'>";
				
				
				$out .= "\n<table cellpadding='0' cellspacing='0' border='0' width='".($decalage+1+$gauche)."'>";
				$out .= "\n<tr>";
				if ($gauche > 0) $out .= "<td style='width: " .$gauche."px'></td>";
				$out .= "\n<td style='border: 0px; white-space: nowrap;'>";
				$out .= "<div style='border: 1px solid #999999; background-color: #dddddd; height: 12px; padding: 0px; margin: 0px;'>";
				if ($visites_abs > 0) $out .= "<img src='" . chemin_image('rien.gif') . "' style='vertical-align: top; height: 12px; border: 0px; width: ".$visites_abs."px;' alt= ' '/>";
				if ($largeur_rouge>0) $out .= "<img src='" . chemin_image('rien.gif') . "' class='couleur_cumul' style='vertical-align: top; height: 12px; border: 0px; width: " . $largeur_rouge . "px;' alt=' ' />";
				if ($largeur_vert>0) $out .= "<img src='" . chemin_image('rien.gif') . "' class='couleur_nombre' style='vertical-align: top; width: " . $largeur_vert ."px; height: 12px; border: 0px' alt=' ' />";
				$out .= "</div>";
				$out .= "</td></tr></table>\n";
				$out .= "</td></tr></table>";
			}	
		}
		
		if (isset($largeur_rouge) && ($largeur_rouge > 0)) {
			$niveau++;
			$out .= debut_block_depliable(false,"stats$id_rubrique");
			$out .= enfants_aff($id_rubrique,$largeur_rouge, $taille, $critere, $visites_abs+$gauche);
			$out .= fin_block();
			$niveau--;
		}
		$visites_abs = $visites_abs + round($nombre_vis[$id_rubrique]/$abs_total*$taille);
	}
	return $out;
}

?>
