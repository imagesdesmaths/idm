<?php
/**
 * @name 		Fonctions
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

function dialogbox_links($texte) {
	$tb_class = " class='thickbox' ";
	$classes_spip = array( 'spip_note', 'spip_glossaire' );
	$a = preg_match_all("/<a([^>]*)>/i", $texte, $links, PREG_PATTERN_ORDER);
	unset($links[0]);
	foreach($links[1] as $str){
		$b = explode(" ", trim($str));
		$ok = false;
		foreach($b as $c){
			$to_change = $c;
			$d = explode("=", $c);
			$d[1] = strtolower(trim($d[1], '"\''));
			if( eregi('class', $d[0]) ){
				if(!in_array($d[1], $classes_spip)) $texte = str_replace($to_change, $tb_class, $texte);
				$ok = true;
			}
		}
		if($ok == false) $texte = str_replace($str, $tb_class.$str, $texte);
	}
	return $texte;
}
?>