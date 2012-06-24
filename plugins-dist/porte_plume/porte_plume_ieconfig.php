<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

function porte_plume_ieconfig_metas($table){
	$table['porte_plume']['titre'] = _T('barreoutils:info_barre_outils_public');
	$table['porte_plume']['icone'] = 'porte-plume-16.png';
	$table['porte_plume']['metas_brutes'] = 'barre_outils_public';
	
	return $table;
}

?>