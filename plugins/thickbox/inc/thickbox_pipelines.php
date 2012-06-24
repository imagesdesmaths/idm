<?php
/**
 * @name 		Pipelines
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

function thickbox_insert_head($flux){
	// cette ligne ne charge pas le plugin sans couteau suisse?
//	if(!$GLOBALS["spip_pipeline"]["insert_js"])
	$flux = thickbox_header_prive($flux);
	return $flux;
}

function thickbox_header_prive($flux) {
	include_spip("inc/filtres");
	global $closer, $closer_ttl, $nexter, $previouser, $img_close;
	$th_meta = thickbox_config();

	$img_close = sprintf("<img src='%s' width='16px' border=0 />&nbsp;",
		( strlen($th_meta['img_closer']) ? url_absolue(find_in_path($th_meta['img_closer'])) : url_absolue(find_in_path($GLOBALS['THICKBOX_DEFAULTS']['img_closer'])) )
	);
	$closer = texte_backend(_T('thickbox:close'))."&nbsp;".$img_close;
	$closer_ttl = texte_backend(_T('thickbox:fermer'));
	$nexter = texte_backend(_T('thickbox:previous'));
	$previouser = texte_backend(_T('thickbox:next'));

	if( $th_meta['include_css'] == 'oui')
		$flux .= "\n<link rel='stylesheet' href='".url_absolue(find_in_path('css/thickbox.css'))."' type='text/css' media='projection, screen, tv' />";
	$flux .= "\n<script src='".url_absolue(find_in_path('javascript/thickbox-3.1.js'))."' type='text/javascript'></script>"
		."\n<!--[if lte IE 6]><link rel='stylesheet' href='".url_absolue(find_in_path('css/thickbox_ie6.css'))."' type='text/css' media='projection, screen, tv' /><![endif]-->";
	$flux .=
'
<script type="text/javascript"><!--
//on page load call tb_init
var init_f = function() {
	var tb_pathToImage = "'.url_absolue(find_in_path('images/circle_animation.gif')).'";
	if (jQuery("a.thickbox,a[type=\'image/jpeg\'],a[type=\'image/png\'],a[type=\'image/gif\']",this).size()) {
		jQuery("a[type=\'image/jpeg\'],a[type=\'image/png\'],a[type=\'image/gif\']").addClass("thickbox")';
	if($th_meta['option_onclick'] == 'oui') $flux .= '.removeAttr("onClick")';
	$flux .= ';';
	if(strlen($th_meta['titre_default'])) $flux .= 
'
		jQuery("a.thickbox, area.thickbox, input.thickbox").attr("title", function(arr){
			var str = jQuery(this).attr("title");
			if(str.length == 0) return "'.texte_backend($th_meta['titre_default']).'";
			else return str;
		});';
	$flux .=
'
		tb_lang("'.$closer.'", "'.$closer_ttl.'", "'.$nexter.'", "'.$previouser.'");
		tb_init("a.thickbox, area.thickbox, input.thickbox");
		imgLoader = new Image();
		imgLoader.src = tb_pathToImage;
	}
}
if (window.jQuery) jQuery(document).ready(init_f);
// --></script>';
	$flux .= "";
	return $flux;
}

// ? verifier l utilisation
function thickbox_insert_js($flux){
	include_spip("inc/filtres");
	if($flux['type']=='inline')
		$flux["data"]["thickbox"] =
'
<!-- thick box plugin --><script type="text/javascript"><!--
var init_f = function() {
	var tb_pathToImage = "'.url_absolue(find_in_path('images/circle_animation.gif')).'";
	if ($("a.thickbox,a[type=\'image/jpeg\'],a[type=\'image/png\'],a[type=\'image/gif\']",this).size()) {
		var TB_initload = function(){
			$("a[type=\'image/jpeg\'],a[type=\'image/png\'],a[type=\'image/gif\']").addClass("thickbox");
			tb_init("a.thickbox, area.thickbox, input.thickbox");
			imgLoader = new Image();
			imgLoader.src = tb_pathToImage;
		};
		if (typeof tb_init == "function") {
			TB_initload();
		} else {
			$("head")
			.prepend("<link rel=\'stylesheet\'type=\'text/css\' href=\''.url_absolue(find_in_path('css/thickbox.css')).'\' />");
			$.getScript("'
				.url_absolue(find_in_path('javas/thickbox-3.1.js'))
				.'", TB_initload)
		}
	};
}
if(typeof onAjaxLoad == "function") onAjaxLoad(init_f);
$(document).ready(function(){setTimeout(init_f.apply(document),200)});
// --></script>';
	return $flux;
}

// ? verifier l utilisation
function thickbox_verifie_js_necessaire($flux) {
	$page = $flux["page"]["texte"];
	$necessaire = preg_match(",<a[^>]+(?:(type)|class)\s*=\s*['\"](?(1)image/(?:jpeg|png|gif)|[^>'\"]*\bthickbox\b[^>'\"]*)['\"],iUs", $page);
	$flux["data"]["thickbox"] = $necessaire;
	return $flux;
}
?>