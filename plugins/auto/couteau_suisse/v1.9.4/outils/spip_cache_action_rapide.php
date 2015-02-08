<?php

// module inclu dans la description de l'outil en page de configuration
// ici, un bouton : "vider le cache"

include_spip('inc/invalideur');
//include_spip('inc/actions');
//include_spip('inc/actions_compat');

// Compatibilite SPIP < 2.0
if(!defined('_SPIP19300')) {
	function taille_du_cache() {
		$cpt = spip_fetch_array(spip_query("SELECT SUM(taille) AS n FROM spip_caches WHERE type='t'"));
		return $cpt['n'];
	}
/*	function redirige_action_post($action, $arg, $ret, $gra, $corps, $att='') {
		$r = _DIR_RESTREINT_ABS . generer_url_ecrire($ret, $gra, true, true);
		return generer_action_auteur($action, $arg, $r, $corps, $att . " method='post'");
	}*/
}

function spip_cache_action_rapide($actif) {
	if(!$actif) return _T('bouton_vider_cache');
	include_spip('inc/texte'); // pour attribut_html()
	if ($n = taille_du_cache())
	  $info = _T('taille_cache_octets', array('octets' => taille_en_octets($n)));
	else
	  $info = _T('taille_cache_vide');
	// on envoie une action 'action_rapide' car 'purger' n'existe pas (encore?) en exec/
	return ajax_action_rapide_simple('cache', $info, 'bouton_vider_cache')
		. bouton_actualiser_action_rapide();

/*	// appel direct vers SPIP, sans ajax :
	return redirige_action_post('purger', 'cache', 'admin_couteau_suisse', "cmd=descrip&outil=spip_cache#cs_infos",
			"\n<div style='text-align: center; padding:0.4em;'><input class='fondo' type='submit' value=\"" .
			attribut_html(_T('bouton_vider_cache')) . "\" />&nbsp;($info)</div>"); */
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function spip_cache_cache_action() {
	// purger le cache de SPIP...
	// $arg doit obligatoirement etre 'cache' sinon SPIP se fache !
	$purger = charger_fonction('purger', 'action');
	$purger();
}
// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function spip_cache_actualise_action() {
	// actualiser le calcul du cache de SPIP...
	// rien a faire :-)
}

?>