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
include_spip('inc/actions');

// ne pas faire d'erreur si les chaines sont > 254 caracteres
// http://doc.spip.org/@levenshtein255
function levenshtein255 ($a, $b) {
	$a = substr($a, 0, 254);
	$b = substr($b, 0, 254);
	return @levenshtein($a,$b);
}

// reduit un mot a sa valeur translitteree et en minuscules
// http://doc.spip.org/@reduire_mot
function reduire_mot($mot) {
	return strtr(
		translitteration(trim($mot)),
		'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		'abcdefghijklmnopqrstuvwxyz'
		);
}

// http://doc.spip.org/@mots_ressemblants
function mots_ressemblants($mot, $table_mots, $table_ids='') {

	$result = array();

	if (!$table_mots) return $result;

	$lim = 2;
	$nb = 0;
	$opt = 1000000;
	$mot_opt = '';
	$mot = reduire_mot($mot);
	$len = strlen($mot);

	while (!$nb AND $lim < 10) {
		reset($table_mots);
		if ($table_ids) reset($table_ids);
		while (list(, $val) = each($table_mots)) {
			if ($table_ids) list(, $id) = each($table_ids);
			else $id = $val;
			$val2 = trim($val);
			if ($val2) {
				if (!isset($distance[$id])) {
					$val2 = reduire_mot($val2);
					$len2 = strlen($val2);
					if ($val2 == $mot)
						$m = -2; # resultat exact
					else if (substr($val2, 0, $len) == $mot)
						$m = -1; # sous-chaine
					else {
						# distance
						$m = levenshtein255($val2, $mot);
						# ne pas compter la distance due a la longueur
						$m -= max(0, $len2 - $len); 
					}
					$distance[$id] = $m;
				} else $m = 0;
				if ($m <= $lim) {
					$selection[$id] = $m;
					if ($m < $opt) {
						$opt = $m;
						$mot_opt = $val;
					}
					$nb++;
				}
			}
		}
		$lim += 2;
	}

	if (!$nb) return $result;
	reset($selection);
	if ($opt > -1) {
		$moy = 1;
		while(list(, $val) = each($selection)) $moy *= $val;
		if($moy) $moy = pow($moy, 1.0/$nb);
		$lim = ($opt + $moy) / 2;
	}
	else $lim = -1;

	reset($selection);
	while (list($key, $val) = each($selection)) {
		if ($val <= $lim) {
			$result[] = $key;
		}
	}
	return $result;
}


/*
 * Affiche la liste des mots-cles associes a l'objet specifie
 * plus le formulaire d'ajout de mot-cle
 */

// http://doc.spip.org/@affiche_mots_ressemblant
function affiche_mots_ressemblant($cherche_mot, $objet, $id_objet, $resultat, $table, $table_id, $url_base)
{
	$les_mots = sql_in('id_mot', $resultat);
	$res = sql_allfetsel("*", "spip_mots", $les_mots, "", "titre", "17");

	foreach ($res as $k => $row) {
		$id_mot = $row['id_mot'];
		$titre = $row['titre'];
		$type = typo($row['type']);
		$descriptif = $row['descriptif'];

		$res[$k]= ajax_action_auteur('editer_mots', "$id_objet,,$table,$table_id,$objet,$id_mot", $url_base, "$table_id=$id_objet", array(typo($titre),' title="' . _T('info_ajouter_mot') .'"'),"&id_objet=$id_objet&objet=$objet") .
		  (!$descriptif ? '' : ("\n(<span class='spip_xx-small'>".supprimer_tags(couper(propre($descriptif), 100)).")</span><br />\n"));

	}

	$res2 = ($type
		? "<strong>$type</strong>&nbsp;: "
		: '' )
		. _T('info_plusieurs_mots_trouves', array('cherche_mot' => $cherche_mot))
		."<br />";

	if (count($resultat) > 17)
		$res2 .= "<br /><strong>" ._T('info_trop_resultat', array('cherche_mot' => $cherche_mot)) ."</strong><br />\n";

	return $res2 . '<ul><li>' . join("</li>\n<li>", $res) . '</li></ul>';
}

?>
