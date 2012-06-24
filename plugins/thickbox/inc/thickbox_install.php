<?php
/**
 * @name 		Installation
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

include_spip('inc/meta');
function thickbox_install($action){
	switch ($action){
		case 'test':
			return (isset($GLOBALS['meta']['thickbox']));
			break;
		case 'install':
			thickbox_upgrade();
			break;
		case 'uninstall':
			thickbox_uninstall();
			break;
	}
}

function thickbox_upgrade() {
	ecrire_meta('thickbox', serialize($GLOBALS['THICKBOX_DEFAULTS']), 'oui');
	ecrire_metas();
}

function thickbox_uninstall() {
	effacer_meta('thickbox');
}
?>