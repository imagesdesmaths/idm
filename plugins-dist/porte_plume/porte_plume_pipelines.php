<?php
/*
 * Plugin Porte Plume pour SPIP 2
 * Licence GPL
 * Auteur Matthieu Marcillaud
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

#define('PORTE_PLUME_PUBLIC', true);

function porte_plume_autoriser($flux){return $flux;}

/**
 * Autoriser l'action de previsu : la fermer aux non identifies
 * si pas de porte plume dans le public
 * @param string $faire
 * @param string $type
 * @param int $id
 * @param array $qui
 * @param array $opt
 * @return bool
 */
function autoriser_porteplume_previsualiser_dist($faire, $type, $id, $qui, $opt){
	return
		(test_espace_prive() AND autoriser('ecrire'))
	  OR (!test_espace_prive() AND autoriser('afficher_public','porteplume'));
}

// autoriser le porte plume dans le public ?
function autoriser_porteplume_afficher_public_dist($faire, $type, $id, $qui, $opt) {
	// compatibilite d'avant le formulaire de configuration
	if (defined('PORTE_PLUME_PUBLIC')) {
		return PORTE_PLUME_PUBLIC;
	}
	return ($GLOBALS['meta']['barre_outils_public'] !== 'non');
	
	// n'autoriser qu'aux identifies :
	# return $qui['id_auteur'] ? PORTE_PLUME_PUBLIC : false;
}

function porte_plume_insert_head_public($flux){
	include_spip('inc/autoriser');
	if (autoriser('afficher_public', 'porteplume')) {
		$flux = porte_plume_inserer_head($flux, $GLOBALS['spip_lang']);
	}
	return $flux;
}

function porte_plume_insert_head_prive($flux){
	$js = find_in_path('javascript/porte_plume_forcer_hauteur.js');
	$flux = porte_plume_inserer_head($flux, $GLOBALS['spip_lang'], $prive=true)
		. "<script type='text/javascript' src='$js'></script>\n";
	
	return $flux;
}

function porte_plume_inserer_head($flux, $lang, $prive = false){
	$xregexp = find_in_path('javascript/xregexp-min.js');
	$markitup = find_in_path('javascript/jquery.markitup_pour_spip.js');
	$js_previsu = find_in_path('javascript/jquery.previsu_spip.js');
	$js_start = parametre_url(generer_url_public('porte_plume_start.js'), 'lang', $lang);
	if (defined('_VAR_MODE') AND _VAR_MODE=="recalcul")
		$js_start = parametre_url($js_start, 'var_mode', 'recalcul');

	$flux 
		.= porte_plume_insert_head_css('', $prive) // compat SPIP 2.0
		//.  "<script type='text/javascript' src='$xregexp'></script>\n" // pour IE... pff
		.  "<script type='text/javascript' src='$markitup'></script>\n"
		.  "<script type='text/javascript' src='$js_previsu'></script>\n"
		.  "<script type='text/javascript' src='$js_start'></script>\n";

	return $flux;
}

// pour charger tous les CSS avant les JS
// uniquement dans le public. (SPIP 2.1+)
// ici aussi appele depuis le prive avec le parametre $prive a true.
function porte_plume_insert_head_css($flux='', $prive = false){
	static $done = false;
	if ($done) return $flux;
	$done = true;
	include_spip('inc/autoriser');
	// toujours autoriser pour le prive.
	if ($prive or autoriser('afficher_public', 'porteplume')) {
		if ($prive) {
			$cssprive = find_in_path('css/barre_outils_prive.css');
			$flux .= "<link rel='stylesheet' type='text/css' media='all' href='$cssprive' />\n";
		}
		$css = direction_css(find_in_path('css/barre_outils.css'), lang_dir());
		$css_icones = generer_url_public('barre_outils_icones.css');
		if (defined('_VAR_MODE') AND _VAR_MODE=="recalcul")
			$css_icones = parametre_url($css_icones, 'var_mode', 'recalcul');
		$flux
			.= "<link rel='stylesheet' type='text/css' media='all' href='$css' />\n"
			.  "<link rel='stylesheet' type='text/css' media='all' href='$css_icones' />\n";
	}
	return $flux;
}


// valeur par defaut des configurations
function porte_plume_configurer_liste_metas($metas){
	$metas['barre_outils_public'] = 'oui';
	return $metas;
}


function porte_plume_affiche_milieu($flux){
	if ($flux['args']['exec']=='configurer_avancees')
		$flux['data'] .= recuperer_fond('prive/squelettes/inclure/configurer',array('configurer'=>'configurer_porte_plume'));

	return $flux;
}
?>
