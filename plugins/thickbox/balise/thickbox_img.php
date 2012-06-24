<?php
/**
 * @name 		Image
 * @author 		Piero Wbmstr <@link piero.wbmstr@gmail.com>
 * @copyright 	CreaDesign 2009 {@link http://creadesignweb.free.fr/}
 * @license		http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 	0.2 (06/2009)
 * @package		thickbox
 * @subpackage	Balises
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

function balise_THICKBOX_IMG($p) {
   return calculer_balise_dynamique($p, THICKBOX_IMG, array());
}

function balise_THICKBOX_IMG_dyn($text, $url, $title='', $text, $_width=false, $_height=false, $mode='', $id='') {
	return balise_thickbox_dyn('image', $_url, $title, $text, $_width, $_height, $mode);
}
?>