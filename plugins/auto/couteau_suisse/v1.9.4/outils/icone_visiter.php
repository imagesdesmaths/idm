<?php
function icone_visiter_header_prive($flux) {
	global $spip_lang_left,$spip_lang_right;
	$chercher_logo = charger_fonction('chercher_logo', 'inc');
	if ($r = $chercher_logo(0, 'id_syndic', 'on'))  {
		list($fid, $dir, $nom, $format) = $r;
		// pour javascript...
		include_spip('inc/filtres_images');
		if(defined('_SPIP19300')) {
			include_spip('inc/filtres_images_mini'); // pour SPIP 2.1
			$r = image_reduire("<img src='$fid' alt='' style='margin:0; background-color:transparent' />", 46, 46);
			$r = "<span style='height:48px; margin:0;'>$r</span>";
			$q = 'span.icon_fond:last';
		} else {
			$r = image_reduire("<img src='$fid' alt='' style='margin:0;' />", 48, 48);
			$r = addslashes("<span style='height:48px; margin:4px;'>$r</span>");
			$q = 'img[@src*=visiter]';
		}
	} else return $flux;
	$r = str_replace('/', '\/', $r);
	return $flux. <<<HEAD
<script type="text/javascript"><!--
// des que le DOM est pret...
if (window.jQuery) jQuery(document).ready(function(){
	jQuery("$q").hide().after("$r");
	// SPIP 3 ou bando ?
	var b = jQuery('#bando_haut .voir').clone().addClass('icone_visiter');
	if(b.length)
		jQuery('#bando_navigation .largeur').prepend(b.attr('title', b.text()).html(jQuery("$r")));
});
//--></script>
<style type="text/css">
	.icone_visiter {margin:8px; position:absolute; right:0;}
</style>
HEAD;
}
?>