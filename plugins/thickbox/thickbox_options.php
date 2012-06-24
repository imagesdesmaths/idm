<?php
/**
 * @name 		Options
 * @author 		Piero Wbmstr <@link piero.wbmstr@gmail.com>
 * @copyright 	CreaDesign 2009 {@link http://creadesignweb.free.fr/}
 * @license		http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 	0.2 (06/2009)
 * @package		thickbox
 *
 * BASED ON :
 * - Thickbox 3.1 - One Box To Rule Them All.
 *   By Cody Lindley (http://www.codylindley.com)
 *   Copyright (c) 2007 cody lindley - MIT License
 *
 * - plugin SPIP 'Thickbox 2'
 *   By Fil, Izo, BoOz (http://spip-zone.info/spip.php?article31)
 */
if (!defined("_ECRIRE_INC_VERSION")) return;
	
$p=explode(basename(_DIR_PLUGINS)."/",str_replace('\\','/',realpath(dirname(__FILE__))));
define('_DIR_THICKBOX',(_DIR_PLUGINS.end($p)));

// -------------------------------------------------------------
// Globales

$GLOBALS['THICKBOX_DOCUMENTATION'] = 'doc_thickbox3';
$GLOBALS['THICKBOX_TEST_IMAGE'] = _DIR_THICKBOX.'/images/single.jpg';
$GLOBALS['THICKBOX_LOGO'] = _DIR_THICKBOX.'/images/thickbox.png';
$GLOBALS['THICKBOX_DEFAULTS'] = array(
	'include_css' 		=> 'oui',
	'option_modal' 		=> 'non',
	'titre_default' 	=> '',
	'option_onclick' 	=> 'oui',
	'option_width' 		=> 300,
	'option_height' 	=> 400,
	'option_width_img' 	=> 100,
	'option_height_img' => 100,
	'dialogbox_url' 	=> 'dialogbox.html',
	'option_width_db' 	=> 500,
	'option_height_db' 	=> 400,
	'img_closer' 		=> 'images/close.gif',
);

// -------------------------------------------------------------
// Fonctions

function thickbox_config(){
	$config = array();
	$a = unserialize($GLOBALS['meta']['thickbox']);
	if($a == array()) $a = $GLOBALS['THICKBOX_DEFAULTS'];
	foreach($a as $key=>$val){
		$config[$key] = $val;
	}
	return $config;
}

function tb_cut_filename($_f) {
	$f = substr(strrchr($_f, '/'), 1);
	$file_s = getimagesize($_f);
	$file = array();
	if($f != '.') {
		$file['name'] = substr($f, 0, strrpos($f, '.'));
		$file['ext'] = strtolower(substr(strrchr($f, '.'), 1));
		$file['width'] = $file_s[0];
		$file['height'] = $file_s[1];
		$file['mime'] = $file_s['mime'];
	}
	return ($file);
}


// -------------------------------------------------------------
// Info _CDC (privé ...)
if(isset($GLOBALS['_CDC_PLUGINS'])) {
	$GLOBALS['_CDC_PLUGINS']['plugins'][] = 'thickbox';
	$GLOBALS['_CDC_PLUGINS']['set']['thickbox'] = array('texte' => _T('thickbox:thickbox'),'fond' => find_in_path("images/thickbox.png"),'lien' => array("cfg","cfg=thickbox"));
	$GLOBALS['_CDC_PLUGINS']['comment']['thickbox'] = "TODO : tester les navigateurs (FF ok -)";
}
?>