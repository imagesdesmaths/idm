<?php
	// definir ce pipeline, sans ecraser sa valeur s'il existe
  if(!isset($GLOBALS['spip_pipeline']['declarer_champs_extras']))
    $GLOBALS['spip_pipeline']['declarer_champs_extras'] = "";
  if(!isset($GLOBALS['spip_pipeline']['objets_extensibles']))
    $GLOBALS['spip_pipeline']['objets_extensibles'] = "";
	
	// utiliser ce pipeline a part
	// afin d'etre certain d'arriver apres les autres plugins
	// sinon toutes les tables ne sont pas declarees
	// et les champs supplementaires ne peuvent pas se declarer comme il faut
	$GLOBALS['spip_pipeline']['declarer_tables_principales'] .= '||cextras_declarer_champs_apres_les_autres';
	function cextras_declarer_champs_apres_les_autres($tables_principales) {
		include_spip('base/cextras');
		return cextras_declarer_tables_principales($tables_principales);
	}
	$GLOBALS['spip_pipeline']['declarer_tables_interfaces'] .= '||cextras_declarer_champs_interfaces_apres_les_autres';
	function cextras_declarer_champs_interfaces_apres_les_autres($interface) {
		include_spip('base/cextras');
		return cextras_declarer_tables_interfaces($interface);
	}
?>
