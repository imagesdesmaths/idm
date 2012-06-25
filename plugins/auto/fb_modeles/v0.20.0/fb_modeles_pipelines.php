<?php
/**
 * @name 		Pipelines
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 * @license		GNU/GPLv3 (http://www.opensource.org/licenses/gpl-3.0.html)
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Insertion des infos Open Graph en en-tete si possible
 */
function fb_modeles_insert_head($flux) {
	$config = fbmod_config();

	// La feuille de styles du plugin
	$flux .= "<link rel='stylesheet' href='".find_in_path('fb_modeles.css')."' type='text/css' media=\"projection, screen, tv\" />";

	if ($config && $config['include_metas']=='oui') {

	} else {
		if (isset($config['appid']) && strlen($config['appid'])) {
			$flux .= "\n<meta property=\"fb:app_id\" content=\"".$config['appid']."\" />";
		}
		elseif (isset($config['pageid']) && strlen($config['pageid'])) {
			$flux .= "\n<meta property=\"fb:page_id\" content=\"".$config['pageid']."\" />";
		}
		elseif (isset($config['userid']) && strlen($config['userid'])) {
			$flux .= "\n<meta property=\"fb:admins\" content=\"".$config['userid']."\" />";
		}
		else {
			$flux .= "\n<!-- FB Modeles vide -->";
		}
	}
	$flux .= "\n";

	return $flux;	
}

?>