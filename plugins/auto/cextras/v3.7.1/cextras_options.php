<?php

/**
 * Options globales chargées à chaque hit
 *
 * @package SPIP\Cextras\Options
**/

// sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

// utiliser ces pipelines a part
// afin d'etre certain d'arriver apres les autres plugins
// sinon toutes les tables ne sont pas declarees
// et les champs supplementaires ne peuvent pas se declarer comme il faut

if (!isset($GLOBALS['spip_pipeline']['declarer_tables_objets_sql'])) {
	$GLOBALS['spip_pipeline']['declarer_tables_objets_sql'] = '';
}
if (!isset($GLOBALS['spip_pipeline']['declarer_tables_interfaces'])) {
	$GLOBALS['spip_pipeline']['declarer_tables_interfaces'] = '';
}

$GLOBALS['spip_pipeline']['declarer_tables_objets_sql'] .= '||cextras_declarer_champs_apres_les_autres';
$GLOBALS['spip_pipeline']['declarer_tables_interfaces'] .= '||cextras_declarer_champs_interfaces_apres_les_autres';

/**
 * Ajouter les déclaration dechamps extras sur les objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @see cextras_declarer_tables_objets_sql()
 * @param array $tables
 *     Description des objets éditoriaux
 * @return array
 *     Description des objets éditoriaux
**/
function cextras_declarer_champs_apres_les_autres($tables) {
	include_spip('base/cextras');
	return cextras_declarer_tables_objets_sql($tables);
}

/**
 * Ajouter les déclaration d'interface des champs extras pour le compilateur
 *
 * @pipeline declarer_tables_interfaces
 * @see cextras_declarer_tables_interfaces()
 * @param array $interface
 *     Description des interfaces pour le compilateur
 * @return array
 *     Description des interfaces pour le compilateur
**/
function cextras_declarer_champs_interfaces_apres_les_autres($interface) {
	include_spip('base/cextras');
	return cextras_declarer_tables_interfaces($interface);
}