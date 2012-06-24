<?php
/**
 * @name 		Balise_FBMOD
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 * @license		GNU/GPLv3 (http://www.opensource.org/licenses/gpl-3.0.html)
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Balise unique FB modeles : renvoie une valeur de la configuration, la valeur par défaut sinon
 */
function balise_FBMOD_dist($p) {
	// Interpretation des arguments :
	//	- arg 1 : 'argument'
	//	- arg 2 : 'sinon'
	$_what = interprete_argument_balise(1,$p);
	$_sinon = interprete_argument_balise(2,$p);
	$p->code = isset($_what) && $_what ? 
		( isset($_sinon) && $_sinon ? "fbmod_config($_what, $_sinon)" : "fbmod_config($_what)" )
		: null;
	return $p;
}

?>