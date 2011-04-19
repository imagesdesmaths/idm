<?php
/**
 * Action affichant la prévisualisation de porte plume
 *
 * Pas besoin de sécuriser outre mesure ici, on ne réalise donc qu'un
 * recuperer_fond
 *
 * On passe par cette action pour éviter les redirection et la perte du $_POST de
 * $forcer_lang=true;
 * cf : ecrire/public.php ligne 80
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

function action_porte_plume_previsu_dist(){

	// $_POST a ete sanitise par SPIP
	// et le fond injecte des interdire_scripts pour empecher les injections PHP
	// le js est bloque ou non selon les reglages de SPIP et si on est ou non dans l'espace prive
	$contexte = $_POST;

	// mais il faut avoir le droit de previsualiser
	// (par defaut le droit d'aller dans ecrire/)
	if (!autoriser('previsualiser','porte_plume'))
		$contexte = array();
	header('Content-type: text/html; charset='.pp_charset());
	echo recuperer_fond('prive/porte_plume_preview',$contexte);
}


// retourner le charset SQL si on le connait, en priorite
// sinon, on utilise le charset de l'affichage HTML.
// Cependant, on peut forcer un charset donne avec une constante :
// define('PORTE_PLUME_PREVIEW_CHARSET','utf-8');

function pp_charset() {
	if (defined('PORTE_PLUME_PREVIEW_CHARSET')) {
		return PORTE_PLUME_PREVIEW_CHARSET;
	}

	$charset = $GLOBALS['meta']['charset'];
	$charset_sql = isset($GLOBALS['charset_sql_base']) ? $GLOBALS['charset_sql_base'] : '';
	if ($charset_sql == 'utf8') {
		$charset_sql = 'utf-8';
	}
	return $charset_sql ? $charset_sql : $charset;
}

?>