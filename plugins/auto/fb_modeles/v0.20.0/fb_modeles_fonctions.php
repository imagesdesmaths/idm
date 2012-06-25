<?php
/**
 * @name 		Fonctions
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 * @license		GNU/GPLv3 (http://www.opensource.org/licenses/gpl-3.0.html)
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Alias de la fonction "fbmod_config()" dans Options
 */
function fb_modeles_conf($str) {
	return fbmod_config($str);
}

/**
 * Renvoie le code de langue Facebook
 */
function fb_modeles_lang($lang) {
	return strtolower($lang).'_'.strtoupper($lang);
}

/**
 * Trasnformation des 'oui'/'non' en booléens
 */
function fb_modeles_bool($val=null) {
	if ($val=='oui') return 'true';
	if ($val=='non') return 'false';
	return $val;
}

?>