<?php

	// utiliser ce pipeline a part
	// afin d'etre certain d'arriver apres les autres plugins
	// sinon toutes les tables ne sont pas declarees
	// et les champs supplementaires ne peuvent pas se declarer comme il faut
	$GLOBALS['spip_pipeline']['declarer_tables_objets_sql'] .= '||cextras_declarer_champs_apres_les_autres';
	function cextras_declarer_champs_apres_les_autres($tables) {
		include_spip('base/cextras');
		return cextras_declarer_tables_objets_sql($tables);
	}
	$GLOBALS['spip_pipeline']['declarer_tables_interfaces'] .= '||cextras_declarer_champs_interfaces_apres_les_autres';
	function cextras_declarer_champs_interfaces_apres_les_autres($interface) {
		include_spip('base/cextras');
		return cextras_declarer_tables_interfaces($interface);
	}
?>
