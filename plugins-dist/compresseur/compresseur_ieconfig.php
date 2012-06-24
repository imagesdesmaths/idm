<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// On déclare ici la config du core
function compresseur_ieconfig_metas($table){
	$table['compresseur']['titre'] = _T('compresseur:info_compresseur_titre');
	$table['compresseur']['icone'] = 'compresseur-16.png';
	$table['compresseur']['metas_brutes'] = 'auto_compress_http,auto_compress_js,auto_compress_css,auto_compress_closure';
	
	return $table;
}

?>