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

// pour le support des vieux dump
// pff ou vous l'avez trouve ce dump ?
// http://doc.spip.org/@inc_import_0_0_dist
function inc_import_0_0_dist($f, $request, $gz='fread') {
	global $import_ok;

	// detruire les tables a restaurer
	$init = $request['init'];
	$tables = $init($request);

	$import_ok = false;
	$b = false;
	if (!($type = xml_fetch_tag($f, $b, $gz))) return false;
	if ($type == '/SPIP') return !($import_ok = true);
	$is_art = ($type == 'article');
	$is_mot = ($type == 'mot');
	for (;;) {
		$b = false;
		if (!($col = xml_fetch_tag($f, $b, $gz))) return false;
		if ($col == ("/$type")) break;
		$value = true;
		if (!xml_fetch_tag($f, $value, $gz)) return false;
		if ($is_art AND $col == 'id_auteur') {
			$auteurs[] = $value;
		}
		else if ($is_mot AND $col == 'id_article') {
			$articles[] = $value;
		}
		else if ($is_mot AND $col == 'id_breve') {
			$breves[] = $value;
		}
		else if ($is_mot AND $col == 'id_forum') {
			$forums[] = $value;
		}
		else if ($is_mot AND $col == 'id_rubrique') {
			$rubriques[] = $value;
		}
		else if ($is_mot AND $col == 'id_syndic') {
			$syndics[] = $value;
		}
		else if ($col != 'maj') {
			$cols[] = $col;
			$values[] = sql_quote($value);
			if ($is_art && ($col == 'id_article')) $id_article = $value;
			if ($is_mot && ($col == 'id_mot')) $id_mot = $value;
		}
	}

	$table = "spip_$type";
	if ($type != 'forum' AND $type != 'syndic') $table .= 's';
	spip_query("REPLACE $table (" . join(",", $cols) . ") VALUES (" . join(",", $values) . ")");

	if ($is_art && $id_article) {
		sql_delete("spip_auteurs_articles", "id_article=$id_article");
		if ($auteurs) {
			reset ($auteurs);
			while (list(, $auteur) = each($auteurs)) {
			  sql_insert("spip_auteurs_articles", "(id_auteur, id_article)", "($auteur, $id_article)");
			}
		}
	}
	if ($is_mot && $id_mot) {
		sql_delete("spip_mots_articles", "id_mot=$id_mot");
		sql_delete("spip_mots_breves", "id_mot=$id_mot");
		sql_delete("spip_mots_forum", "id_mot=$id_mot");
		sql_delete("spip_mots_rubriques", "id_mot=$id_mot");
		sql_delete("spip_mots_syndic", "id_mot=$id_mot");
		if ($articles) {
			reset ($articles);
			while (list(, $article) = each($articles)) {

				sql_insert("spip_mots_articles", "(id_mot, id_article)", "($id_mot, $article)");
			}
		}
		if ($breves) {
			reset ($breves);
			while (list(, $breve) = each($breves)) {

				sql_insert("spip_mots_breves", "(id_mot, id_breve)", "($id_mot, $breve)");
			}
		}
		if ($forums) {
			reset ($forums);
			while (list(, $forum) = each($forums)) {

				sql_insert("spip_mots_forum", "(id_mot, id_forum)", "($id_mot, $forum)");
			}
		}
		if ($rubriques) {
			reset ($rubriques);
			while (list(, $rubrique) = each($rubriques)) {

				sql_insert("spip_mots_rubriques", "(id_mot, id_rubrique)", "($id_mot, $id_rubrique)");
			}
		}
		if ($syndics) {
			reset ($syndics);
			while (list(, $syndic) = each($syndics)) {

				sql_insert("spip_mots_syndic", "(id_mot, id_syndic)", "($id_mot, $syndic)");
			}
		}
	}

	return $import_ok = "      ";
}
?>
