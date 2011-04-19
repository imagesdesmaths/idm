<?php

function ThickBox1_insert_head_css($flux){
	static $done = false;
	if (!$done) {
		$done = true;
		$flux .= ThickBox_call_css();
	}
	return $flux;
}

function ThickBox1_insert_head($flux){
	$flux = ThickBox1_insert_head_css($flux);
	
	// on ajoute la class thickbox aux liens de type="image/xxx"

	// TODO: ne charger thickbox.js et thickbox.css que si 
	// jQuery("a.thickbox,a[type='image/jpeg'],...").size() > 0)
	if(!$GLOBALS["spip_pipeline"]["insert_js"])
		$flux .= ThickBox_call_js();

	return $flux;
}

function ThickBox1_header_prive($flux) {
include_spip("inc/filtres");

$flux .= ThickBox_call_css();
$flux .= ThickBox_call_js();

return $flux;

}

function ThickBox1_insert_js($flux){
include_spip("inc/filtres");

// on ajoute la class thickbox aux liens de type="image/xxx"

// TODO: ne charger thickbox.js et thickbox.css que si 
// jQuery("a.thickbox,a[type='image/jpeg'],...").size() > 0)

if($flux['type']=='inline')
  $flux["data"]["ThickBox1"] =
'
<script type="text/javascript"><!--
// Inside the function "this" will be "document" when called by ready() 
// and "the ajaxed element" when called because of onAjaxLoad 
var init_f = function() {
	var me = this;
	if (jQuery("a.thickbox,a[type=\'image/jpeg\'],a[type=\'image/png\'],a[type=\'image/gif\']",me).addClass("thickbox").size()) {
	
		var TB_initload = function(){
			TB_chemin_animation = "'.url_absolue(find_in_path('circle_animation.gif')).'";
			TB_chemin_close = "'.url_absolue(find_in_path('close.gif')).'";
			TB_chemin_css = "'.url_absolue(find_in_path('thickbox.css')).'";
			TB_init(me);
		};

		if (typeof TB_init == "function") {
			TB_initload();
		} else {
			jQuery("head")
			.prepend("<link rel=\'stylesheet\'type=\'text/css\' href=\''.url_absolue(find_in_path('thickbox.css')).'\' />");
			jQuery.getScript("'
				.url_absolue(find_in_path('javascript/thickbox.js'))
				.'", TB_initload)
		}
	};
}
//onAjaxLoad is defined in private area only
if(typeof onAjaxLoad == "function") onAjaxLoad(init_f);

// Demarrage : on charge et execute les scripts de thickbox en asynchrone
// ce qui permet a la page de s\'afficher plus tot
jQuery(document).ready(function(){setTimeout(init_f.apply(document),200)});
// --></script>';

	return $flux;
}

function ThickBox1_verifie_js_necessaire($flux) {

//var_dump($flux["page"]);
$page = $flux["page"]["texte"];
//cherche <a> avec un type image ou une class thickbox
$necessaire = preg_match(",<a[^>]+(?:(type)|class)\s*=\s*['\"](?(1)image/(?:jpeg|png|gif)|[^>'\"]*\bthickbox\b[^>'\"]*)['\"],iUs",$page); 
$flux["data"]["ThickBox1"] = $necessaire;

return $flux;
  
}

function ThickBox_call_js() {
	$flux = '<script src=\''.url_absolue(find_in_path('javascript/thickbox.js')).'\' type=\'text/javascript\'></script>';
	$flux .= '<script type="text/javascript"><!--
// Inside the function "this" will be "document" when called by ready() 
// and "the ajaxed element" when called because of onAjaxLoad 
var init_f = function() {
	if (jQuery("a.thickbox,a[type=\'image/jpeg\'],a[type=\'image/png\'],a[type=\'image/gif\']",this).addClass("thickbox").size()) {
		TB_chemin_animation = "'.url_absolue(find_in_path('circle_animation.gif')).'";
		TB_chemin_close = "'.url_absolue(find_in_path('close.gif')).'";
		TB_chemin_css = "'.url_absolue(find_in_path('thickbox.css')).'";
		TB_init(this);
	};
}
//onAjaxLoad is defined in private area only
if(typeof onAjaxLoad == "function") onAjaxLoad(init_f);
if (window.jQuery) jQuery(document).ready(init_f);
// --></script>';
	return $flux;
}

function ThickBox_call_css() {
	$flux = '<link rel="stylesheet" href="'.url_absolue(find_in_path('thickbox.css')).'" type="text/css" media="all" />';
	return $flux;
}
?>
