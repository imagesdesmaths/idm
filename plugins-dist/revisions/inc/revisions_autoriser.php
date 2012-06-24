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

/* fonction pour le pipeline d'autorisation */
function revisions_autoriser(){}

/**
 * Voir les revisions ?
 * = revisions definies pour cet objet
 * + l'objet existe
 * + autorise a voir l'objet
 */
function autoriser_voirrevisions_dist($faire, $type, $id, $qui, $opt) {
	$table = table_objet_sql($type);
	$id_table_objet = id_table_objet($type);

	include_spip('inc/revisions');
	if (!liste_champs_versionnes($table))
		return false;

	if (!$row = sql_fetsel("*", $table, "$id_table_objet=".intval($id)))
		return false;

	return
		autoriser('voir', $type, $id, $qui, $opt);
}

// tout le monde peut voir le bouton de suivi des revisions
function autoriser_revisions_menu_dist($faire, $type='', $id=0, $qui = NULL, $opt = NULL){
	// SI pas de revisions sur un objet quelconque.
	// ET pas de version... pas de bouton, c'est inutile...
	include_spip('inc/config');
	if (!lire_config('objets_versions/') AND !sql_countsel('spip_versions')) {
		return false;
	}
	return true;
}

?>
