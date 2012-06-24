<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

function revisions_ieconfig_metas($table){
	$table['revisions']['titre'] = _T('revisions:titre_revisions');
	$table['revisions']['icone'] = 'revision-16.png';
	$table['revisions']['metas_serialize'] = 'objets_versions';
	
	return $table;
}

?>