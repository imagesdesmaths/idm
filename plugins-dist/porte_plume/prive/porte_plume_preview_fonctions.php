<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

// retourner le charset SQL si on le connait, en priorite
// sinon, on utilise le charset de l'affichage HTML.
// Cependant, on peut forcer un charset donne avec une constante :
// define('PORTE_PLUME_PREVIEW_CHARSET','utf-8');
function filtre_pp_charset() {
	if (defined('PORTE_PLUME_PREVIEW_CHARSET')) {
		return PORTE_PLUME_PREVIEW_CHARSET;
	}

	$charset = $GLOBALS['charset'];
	$charset_sql = isset($GLOBALS['charset_sql_base']) ? $GLOBALS['charset_sql_base'] : '';
	if ($charset_sql == 'utf8') {
		$charset_sql = 'utf-8';
	}
	return $charset_sql ? $charset_sql : $charset;
}

?>
