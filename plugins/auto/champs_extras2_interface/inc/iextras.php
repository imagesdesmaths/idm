<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// etre certain d'avoir la classe ChampExtra de connue
include_spip('inc/cextras');

function iextras_get_extras(){
	$extras = @unserialize($GLOBALS['meta']['iextras']);
	if (!is_array($extras)) $extras = array();
	// reinitialiser aucazou les valeurs de tables
	foreach($extras as $e) {
		if (!$e->_table_sql) {
			$e->definir(); // va recreer les infos des tables/objet/type
		}
	}
	return $extras;
}


/* retourne l'extra ayant l'id demande */
function iextra_get_extra($extra_id){
		$extras = iextras_get_extras();
		foreach($extras as $extra) {
			if ($extra->get_id() == $extra_id) {
				return $extra;
			}
		}
		return false;
}

function iextras_set_extras($extras){
	ecrire_meta('iextras',serialize($extras));
	return $extras;
}

// tableau des extras, mais classes par table SQL
// et sous forme de tableau PHP pour pouvoir boucler dessus.
function iextras_get_extras_par_table(){
	$extras = iextras_get_extras();
	$tables = array();
	foreach($extras as $e) {
		if (!isset($tables[$e->table])) {
			$tables[$e->table] = array();
		}
		$tables[$e->table][] = $e->toArray();
	}
	return $tables;
}

// tableau des extras, tries par table SQL
function iextras_get_extras_tries_par_table(){
	$extras = iextras_get_extras();
	$tables = $extras_tries = array();
	foreach($extras as $e) {
		if (!isset($tables[$e->table])) {
			$tables[$e->table] = array();
		}
		$tables[$e->table][] = $e;
	}
	sort($tables);
	foreach ($tables as $table) {
		foreach ($table as $extra) {
			$extras_tries[] = $extra;
		}
	}
	return $extras_tries;
}
?>
