<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

function svp_ieconfig_metas($table){
	$table['svp']['titre'] = _T('svp:titre_page_configurer');
	$table['svp']['icone'] = 'svp-16.png';
	$table['svp']['metas_serialize'] = 'svp';
	
	return $table;
}

?>