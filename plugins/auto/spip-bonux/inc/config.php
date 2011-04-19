<?php
/*
 * Plugin xxx
 * (c) 2009 xxx
 * Distribue sous licence GPL
 *
 */


include_once _DIR_RESTREINT.'inc/config.php';
if (!defined('_DIR_PLUGIN_CFG')){
	if (!function_exists('lire_config')){
		function lire_config($cfg='', $def=null, $unserialize=true) {
			include_spip('configurer/pipelines');
			return spip_bonux_lire_config($cfg, $def, $unserialize);
		}
	}
}
?>