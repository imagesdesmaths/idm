<?php

/**
 * Plugin générique de configuration pour SPIP
 *
 * @license    GNU/GPL
 * @package    plugins
 * @subpackage cfg
 * @category   outils
 * @copyright  (c) toggg, marcimat 2007-2008
 * @link       http://www.spip-contrib.net/
 * @version    $Id: selecteur_couleur.php 53409 2011-10-13 20:42:57Z yffic@lefourneau.com $
 *
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Patch de compatibilité avec classe cfg_couleur,
 *
 * @deprecated OBSOLETE (utilisez la classe {see palette})
 * @param mixed $valeur # inutilisé
 * @param Object $cfg
 */
function cfg_charger_param_selecteur_couleur($valeur, &$cfg){
	// si provient d'un CVT, on met inline, sinon dans head
	$ou = ($cfg->depuis_cvt) ? 'inline':'head';
	// si le plugin Palette est installé, on patche
	if (is_dir(find_in_path(_DIR_PLUGIN_PALETTE))) {
		$cfg->param[$ou] .= "
<style>
.colorpicker {position: relative;}
</style>
<script type='text/javascript'>
//<![CDATA[
jQuery(document).ready(function() {
	jQuery('input.cfg_couleur').each(function() {
		jQuery(this).addClass('palette');
		jQuery(this).removeClass('cfg_couleur');
	});
	init_palette(); // relancer la palette pour prendre en compte les changements precedents (et pour les cas ajax)
});
//]]>
</script>
";
	}
}
?>
