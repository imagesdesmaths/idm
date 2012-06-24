<?php
/**
 * @name 		Options
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 * @license		GNU/GPLv3 (http://www.opensource.org/licenses/gpl-3.0.html)
 */
if (!defined("_ECRIRE_INC_VERSION")) return;
//ini_set('display_errors','1'); error_reporting(E_ALL);

/**
 * Nom du meta CFG de configuration
 */
define('FB_MODELS_CFGMETA', 'config_fb_modeles');

/**
 * Nom de la page de documentation interne pour generation des liens
 */
define('FB_MODELS_DOC', 'fb_modeles');

/**
 * URL de la page de documentation sur spip-contrib (documentation officielle)
 */
define('FB_MODELS_DOC_CONTRIB', 'http://www.spip-contrib.net/?article3872');

// -------------------------
// CONFIGURATION
// -------------------------

/**
 * Config par defaut
 */
$GLOBALS['FB_APP_DEF'] = array(
	'appid' => '',
	'userid' => '',
	'pageid' => '',
	'url_page' => '',
	'include_metas' => 'non',
	'xfbml' => 'oui',
	// URL des plugins
	'like_url' => 'http://www.facebook.com/plugins/like.php',
	'activity_url' => 'http://www.facebook.com/plugins/activity.php',
	'like_box_url' => 'http://www.facebook.com/plugins/likebox.php',
	'send_url' => 'http://www.facebook.com/plugins/send.php',
	'comments_url' => 'http://www.facebook.com/plugins/comments.php',
	'live_stream_url' => 'http://www.facebook.com/plugins/live-stream.php',
	// Valeurs communes : 'stds' pour standards, 'def' pour defaut
	'font_stds' => array('arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'),
	'font_def' => 'lucida grande',
	'colorscheme_stds' => array('light','dark'),
	'colorscheme_def' => 'light',	
	'border_color_def' => '#dddddd',
);

/** 
 * Recuperation de la config (CFG si actif)
 */
function fbmod_config($str=null, $sinon=null){
	$conf = array_merge($GLOBALS['FB_APP_DEF'], 
		function_exists('lire_config') ? lire_config(FB_MODELS_CFGMETA, array()) : array());
	// On ajoute la langue a la mode facebook
	include_spip('inc/xfbml_languages');
	$conf['fb_lang'] = isset($GLOBALS['xfbml_languages'][$GLOBALS['spip_lang']]) ? 
		$GLOBALS['xfbml_languages'][$GLOBALS['spip_lang']] : 
			strtolower($GLOBALS['spip_lang']).'_'.strtoupper($GLOBALS['spip_lang']);
//var_export($conf);
	if (!is_null($str)) {
		return isset($conf[$str]) ? $conf[$str] : $sinon;
	}
	return $conf;
}

?>