<?php
/**
 * @name 		Balise generale
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

function balise_THICKBOX($p) {
	return calculer_balise_dynamique($p, thickbox, array());
}

function balise_thickbox_dyn($_type, $_url, $title='', $text='', $_width=false, $_height=false, $mode='', $id='', $add_class='') {
	global $div, $img, $tb_conf, $str_href, $str_titre, $str_class, $str_input, $str_dim_img, $str_rel, $str_frame, $str_dialogbox, $modal, $nomodal, $frame, $noframe, $inline, $titre, $width, $height;
	$tb_conf = thickbox_config();
	$str_class = " class='thickbox".(($add_class AND strlen($add_class)) ? ' '.$add_class : '')."'";
	$str_frame = "&amp;KeepThis=true&amp;TB_iframe=true";
	$str_input = " type='button'";
	$str_dialogbox = "page=".( strlen($tb_conf['dialogbox_url']) ? substr($tb_conf['dialogbox_url'], 0, strrpos($tb_conf['dialogbox_url'], '.')) : substr($GLOBALS['THICKBOX_DEFAULTS']['dialogbox_url'], 0, strrpos($GLOBALS['THICKBOX_DEFAULTS']['dialogbox_url'], '.')) )."&amp;";

	$modes = explode(';', $mode);
	$modal = in_array('modal', $modes) ? true:false;
	$nomodal = in_array('nomodal', $modes) ? true:false;
	$frame = in_array('frame', $modes) ? true:false;
	$noframe = in_array('noframe', $modes) ? true:false;
	$inline = in_array('inline', $modes) ? true:false;
	$type = $_type ? $_type : 'link';
	$img = in_array($type, array('image','gallery')) ? true:false;

	if($type == 'dialogbox') $url = $GLOBALS['meta']['adresse_site'].'/?'.$str_dialogbox.$_url;
	else {
//		$url = (eregi("^http://[_A-Z0-9-]+\.[_A-Z0-9-]+[.A-Z0-9-]*(/~|/?)[/_.A-Z0-9#?&=+-]*$", $_url) 
		$url = (preg_match("/^[http|https]+[:\/\/]+[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+$/i", $_url)
			OR substr_count($_url, ':8888') ) ? 
			$_url 
			: 
//			( eregi("[/_.A-Z0-9-]*[_.A-Z0-9-]+\.(jpg|gif|png|jpeg|html)$", $_url) ?
			( preg_match("/[A-Za-z0-9\-_]+\.(jpg|gif|png|jpeg|html)$/i", $_url) ?
				$GLOBALS['meta']['adresse_site'].'/'.$_url
				:
				( strlen($_url) && ($_url[0] == '?') ? 
					$GLOBALS['meta']['adresse_site'].'/'.$_url 
					: 
					$GLOBALS['meta']['adresse_site'].'/?'.$_url 
				)
			);
	}
	if($img) {
		$file = tb_cut_filename($url);
		$width = $_width ? intval($_width) : ( $tb_conf['option_width_img'] ? intval($tb_conf['option_width_img']) : $GLOBALS['THICKBOX_DEFAULTS']['option_width_img']);
		$height = $_height ? intval($_height) : ( $tb_conf['option_height_img'] ? intval($tb_conf['option_height_img']) : $GLOBALS['THICKBOX_DEFAULTS']['option_height_img']);
		$titre = ($title!='') ? $title : $file['name'];
	}
	else {
		if($type == 'dialogbox') {
			$width = $_width ? intval($_width) : ( $tb_conf['option_width_db'] ? intval($tb_conf['option_width_db']) : $GLOBALS['THICKBOX_DEFAULTS']['option_width_db']);
			$height = $_height ? intval($_height) : ( $tb_conf['option_height_db'] ? intval($tb_conf['option_height_db']) : $GLOBALS['THICKBOX_DEFAULTS']['option_height_db']);
		}
		else {
			$width = $_width ? intval($_width) : ( $tb_conf['option_width'] ? intval($tb_conf['option_width']) : $GLOBALS['THICKBOX_DEFAULTS']['option_width']);
			$height = $_height ? intval($_height) : ( $tb_conf['option_height'] ? intval($tb_conf['option_height']) : $GLOBALS['THICKBOX_DEFAULTS']['option_height']);
		}
		$titre = ($title!='') ? $title : ( strlen($tb_conf['titre_default']) ? $tb_conf['titre_default'] : false);
	}
	$str_titre = (strlen($titre)) ? " title='".$titre."'" : false;

	if($inline AND $id!='') $str_href = '\#TB_inline?';
	else $str_href = $url;
	if($frame OR ($type == 'dialogbox' AND !$noframe)) $str_href .= $str_frame;
	if($img) {
		if($file['width'] > $file['height']){
			$str_dim_img = " width='".$width."px' height='".intval(($file['height']*$height)/$file['width'])."px'";
		}
		else{
			$str_dim_img = " width='".intval(($file['width']*$width)/$file['height'])."px' height='".$height."px'";
		}
	}
	else $str_href .= '&amp;width='.$width.'&amp;height='.$height;
	if($modal OR ($type == 'dialogbox' AND !$nomodal)) $str_href .= '&amp;modal=true';
	if($inline AND $id!='') $str_href .= '&amp;inlineId='.$id;

	switch ($type) {
		case 'link' : 
			$div = sprintf("<a href='%s' %s>%s</a>", $str_href, $str_class.$str_titre, $text);
			break;
		case 'input' :
			$div = sprintf("<input alt='%s' %s value='%s' />", $str_href, $str_input.$options.$str_class.$str_titre, $text);
			break;
		case 'image' :
			$div = sprintf("<a href='%s' type='%s' %s><img src='%s' %s /></a>", $str_href, $file['mime'], $str_titre, $str_href, $str_dim_img);
			break;
		case 'gallery' :
			static $gal_id;
			if (!isset($gal_id)) $gal_id = uniqid();
			if (!strlen($text)) $text = $gal_id;
			$str_rel = " rel='gallery-".$text."'";
			$div = sprintf("<a href='%s' type='%s' %s><img src='%s' %s /></a>", $str_href, $file['mime'], $str_rel.$str_titre, $str_href, $str_dim_img);
			break;
		case 'dialogbox' :
			$div = sprintf("<a href='%s' %s>%s</a>", $str_href, $str_class.$str_titre, $text);
			break;
		case 'url' :
			$div = sprintf("'%s' %s", $str_href, $str_class.$str_titre);
			break;
	}

	echo $div;
}
?>