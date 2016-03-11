<?php

if(!defined("_ECRIRE_INC_VERSION")) return;

// attention, ici il se peut que le plugin ne soit pas initialise (cas des .js/.css par exemple)
if(defined('_LOG_CS')) cs_log("inclusion de cout_pipelines.php");

// fonction d'erreur indispensable a tous les pipelines
function cs_deferr($f) {
	spip_log(_L("Pipeline CS : fonction '$f' non definie !"));
}

/*********
 * PRIVE *
 *********/

// ajout d'un onglet sur la page de configuration de SPIP<3
function couteau_suisse_ajouter_onglets($flux){
	include_spip('inc/autoriser');
	$arg = $flux['args']=='configuration' || $flux['args']=='plugins';
	// si on est admin...
	if($arg && autoriser('configurer', 'cs'))
		$flux['data']['couteau_suisse']= new Bouton(cs_icone(24), 'couteau:titre', generer_url_ecrire('admin_couteau_suisse'));
	return $flux;
}

function eval_metas_pipelines(&$flux, $pipe){
	global $cs_metas_pipelines;
	if(isset($cs_metas_pipelines[$pipe])) eval($cs_metas_pipelines[$pipe]);
	return $flux;
}
function couteau_suisse_affiche_gauche($flux){
	return eval_metas_pipelines($flux, 'affiche_gauche');
}
function couteau_suisse_affiche_droite($flux){
	return eval_metas_pipelines($flux, 'affiche_droite');
}
function couteau_suisse_affiche_milieu($flux){
	return eval_metas_pipelines($flux, 'affiche_milieu');
}
function couteau_suisse_boite_infos($flux){
	return eval_metas_pipelines($flux, 'boite_infos');
}
function couteau_suisse_pre_boucle($flux){
	return eval_metas_pipelines($flux, 'pre_boucle');
}

function couteau_suisse_header_prive($flux_){
	global $cs_metas_pipelines;
	$flux = '';
	if(isset($cs_metas_pipelines['header_prive'])) eval($cs_metas_pipelines['header_prive']);
	cs_compile_header($flux,'css', '_prive', false); cs_compile_header($flux, 'js', '_prive');
	return $flux_ . $flux;
}


/**********
 * PUBLIC *
 **********/

function couteau_suisse_insert_head_css($flux_ = '', $prive = false){
	static $done = false;
	if($done) return $flux_;
	$done = true;
	global $cs_metas_pipelines;
	$flux = '';
	if(isset($cs_metas_pipelines['insert_head_css'])) eval($cs_metas_pipelines['insert_head_css']);
	cs_compile_header($flux, 'css');
	return $flux_ . $flux;
}

function couteau_suisse_insert_head($flux_){
	global $cs_metas_pipelines;
	$flux = '';
	if(isset($cs_metas_pipelines['insert_head'])) eval($cs_metas_pipelines['insert_head']);
	cs_compile_header($flux, 'js');
	return $flux_ 
		. couteau_suisse_insert_head_css() // en cas d'absence de balise #INSERT_HEAD_CSS
		. $flux;
}

function couteau_suisse_affichage_final($flux){
	eval_metas_pipelines($flux, 'affichage_final');
	return cs_nettoie($flux);
}

function couteau_suisse_recuperer_fond($flux){
	$fond = &$flux['args']['fond']; $texte = &$flux['data']['texte'];
	eval_metas_pipelines($flux, 'recuperer_fond');
	$texte = cs_nettoie($texte);
	return $flux;
}

/********
 * TYPO *
 ********/

function couteau_suisse_nettoyer_raccourcis_typo($flux){
	return eval_metas_pipelines($flux, 'nettoyer_raccourcis_typo');
}
function couteau_suisse_pre_propre($flux){
	return eval_metas_pipelines($flux, 'pre_propre');
}
function couteau_suisse_pre_typo($flux){
	return eval_metas_pipelines($flux, 'pre_typo');
}
function couteau_suisse_post_propre($flux){
	eval_metas_pipelines($flux, 'post_propre');
	// tracage des echappements SPIP (<html/><code/><cadre/> etc.) pour les traitements (s'il y en a) venant apres propre()
	// Note : SPIP echappe egalement les modeles
	if($GLOBALS['cs_post_propre']) {
		if(strpos($flux, '<span class="base64"')!==false)
			$flux = preg_replace(',<span class="base64"[^>]+></span>,', _CS_HTMLA.'$0'._CS_HTMLB, $flux);
		if(strpos($flux, '<div class="base64"')!==false)
			$flux = preg_replace(',<div class="base64"[^>]+></div>,', _CS_HTMLA.'$0'._CS_HTMLB, $flux);
	}
	return $flux;
}

function couteau_suisse_post_typo($flux){
	return eval_metas_pipelines($flux, 'post_typo');
}

/********
 * BASE *
 *******/

function couteau_suisse_pre_edition($flux){
	return eval_metas_pipelines($flux, 'pre_edition');
}
function couteau_suisse_post_edition($flux){
	return eval_metas_pipelines($flux, 'post_edition');
}

/**********
 * DIVERS *
 *********/

function couteau_suisse_formulaire_verifier($flux){
	return eval_metas_pipelines($flux, 'formulaire_verifier');
}

function couteau_suisse_taches_generales_cron($flux){
	return eval_metas_pipelines($flux, 'taches_generales_cron');
}

// pipeline SPIP<2.1
function couteau_suisse_creer_chaine_url($flux){
	return eval_metas_pipelines($flux, 'creer_chaine_url');
}
// pipelines SPIP>=2.1
function couteau_suisse_arbo_creer_chaine_url($flux){
	return eval_metas_pipelines($flux, 'arbo_creer_chaine_url');
}
function couteau_suisse_propres_creer_chaine_url($flux){
	return eval_metas_pipelines($flux, 'propres_creer_chaine_url');
}
// pipelines SPIP>=2.0
function couteau_suisse_declarer_tables_interfaces($flux){
	if(function_exists('cs_table_des_traitements')) cs_table_des_traitements($flux['table_des_traitements']);
	return eval_metas_pipelines($flux, 'declarer_tables_interfaces');
}

// eux fonctions obsoletes, conservees pour SPIP<3.0 :
// le contenu du sous-menu est gere par les lames elles-memes
function couteau_suisse_bt_toolbox($params) {
	global $cs_metas_pipelines;
	if(!isset($cs_metas_pipelines['bt_toolbox'])) return $params;
	$flux = '';
	eval($cs_metas_pipelines['bt_toolbox']);
	$tableau_formulaire = '
 <table class="spip_barre" style="width: auto; padding: 1px!important; border-top: 0px;" summary="">'
	. str_replace(array('@@champ@@','@@span@@'), array($params['champ'], 'span style="vertical-align:75%;"'), $flux) . '
 </table>';
	$params['flux'] .= produceWharf('couteau_suisse', '', $tableau_formulaire);
	return $params;
}
// bouton principal du Couteau Suisse
function couteau_suisse_bt_gadgets($params) {
	global $cs_metas_pipelines;
	if(!isset($cs_metas_pipelines['bt_toolbox'])) return $params;
	$params['flux'] .= bouton_barre_racc("swap_couche('".$GLOBALS['numero_block']['couteau_suisse']."','');", cs_icone(24), _T('couteauprive:raccourcis_barre'), $params['help']);
	return $params;
}

function couteau_suisse_porte_plume_barre_pre_charger($flux){
	eval_metas_pipelines($flux, 'porte_plume_barre_pre_charger');
	$barres = pipeline('porte_plume_cs_pre_charger', array());
	$r = array(
		"id" => 'couteau_suisse_drop',
		"name" => _T('couteau:pp_couteau_suisse_drop'),
		"className" => 'couteau_suisse_drop',
		"replaceWith" => '',
		"display" => true,
	);
	foreach($barres as $barre=>$menu) {
		$r["dropMenu"] = $menu;
		$flux[$barre]->ajouterApres('grpCaracteres', $r);
	}
	return $flux;
}

function couteau_suisse_porte_plume_lien_classe_vers_icone($flux){
	global $cs_metas_pipelines;
	if (isset($cs_metas_pipelines['porte_plume_lien_classe_vers_icone'])) {
		$flux['couteau_suisse_drop'] = 'couteau-19.png';
		// chemin des icones-typo de couleur
		_chemin(sous_repertoire(_DIR_VAR, 'couteau-suisse'));
		eval($cs_metas_pipelines['porte_plume_lien_classe_vers_icone']);
	}
	return $flux;
}

// pipeline maison : bouton sous un drop Couteau Suisse
function couteau_suisse_porte_plume_cs_pre_charger($flux){
	return eval_metas_pipelines($flux, 'porte_plume_cs_pre_charger');
}


// compatibilite avec le plugin Facteur
function couteau_suisse_facteur_pre_envoi($flux){
	return eval_metas_pipelines($flux, 'facteur_pre_envoi');
}

// pipeline maison : pre-affichage de la description d'un outil
// flux['outil'] est l'id de l'outil, $flux['actif'] est l'etat de l'outil, flux['texte'] est le texte de description
function couteau_suisse_pre_description_outil($flux) {
	global $cs_metas_pipelines;
	$id = &$flux['outil']; $texte = &$flux['texte'];
	if(isset($cs_metas_pipelines['pre_description_outil']))
		eval($cs_metas_pipelines['pre_description_outil']);
	return $flux;
}
// A l'issue du telechargement d'un fichier distant
function couteau_suisse_fichier_distant($flux) {
	global $cs_metas_pipelines;
	if(isset($cs_metas_pipelines['fichier_distant']))
		eval($cs_metas_pipelines['fichier_distant']);
	return $flux;
}

// callback pour la fonction cs_compile_pipe()
function cs_compile_header_callback($matches) {
if(defined('_LOG_CS')) cs_log(" -- compilation d'un header. Code CSS : ".couper($matches[1], 150));
	return cs_recuperer_code($matches[1]);
}

// recherche et compilation par SPIP du contenu d'un fichier .html : <cs_html>contenu</cs_html>
// $type = 'css' ou 'js'
function cs_compile_header(&$flux, $type_, $suffixe='', $rem=true) {
//if(defined('_LOG_CS')) cs_log(" -- recherche de compilations necessaires du header.");
	global $cs_metas_pipelines;
	if(isset($cs_metas_pipelines[$type = 'header_'.$type_.$suffixe])) {
		$header = &$cs_metas_pipelines[$type];
		if(strpos($header, '<cs_html>')!==false) {
			$header = preg_replace_callback(',<cs_html>(.*)</cs_html>,Ums', 'cs_compile_header_callback', $header);
			// sauvegarde en metas
			ecrire_meta('tweaks_pipelines', serialize($cs_metas_pipelines));
			ecrire_metas();
			ecrire_fichier(_DIR_CS_TMP.$type.'.html', "<!-- Fichier de controle $type_ pour le plugin 'Couteau Suisse' -->\n\n$header");
		}
		$flux .= $header;
	}
	if($rem)
		$flux = strlen(trim($flux))?"\n<!-- Debut CS -->\n$flux\n<!-- Fin CS -->\n\n":"\n<!-- CS vide -->\n\n";
}

// construction d'un hit
// (recherche et compilation par SPIP du contenu d'un fichier .html : <cs_html>contenu</cs_html>)
// $type = 'css' ou 'js'
function cs_header_hit(&$flux, $type, $suffixe='') {
	$f = "header$suffixe.$type";
	$nom = sous_repertoire(_DIR_VAR,'couteau-suisse') . $f;
	$tmp = _DIR_CS_TMP . $f;
	if(!file_exists($tmp) || !file_exists($nom) || (defined('_VAR_MODE') && _VAR_MODE=='recalcul') || _request('var_mode')=='recalcul') {
		if (lire_fichier(_DIR_CS_TMP."header.$type.html", $t) && strlen($t)) {
			if(strpos($t, '<cs_html>')!==false)
				$t = preg_replace_callback(',<cs_html>(.*)</cs_html>,Ums', 'cs_compile_header_callback', $t);
			ecrire_fichier($nom, $t, true);
			ecrire_fichier($tmp, $t, true);
		} else {
			if(defined('_LOG_CS')) cs_log(" -- fichier $fo illisible. hit non construit");
			return;
		}
	}
	switch($type) {
		case 'js': $flux .= '<script src="'.$nom.'" type="text/javascript"></script>'; break;
		case 'css': include_spip('inc/filtres');
			$flux .= '<link rel="stylesheet" href="'.direction_css($nom).'" type="text/css" media="all" />'; break;
	}
}

/**
 * recupere le resultat du calcul d'une compilation de code de squelette (marcimat)
 * $coucou = $this->recuperer_code('[(#AUTORISER{ok}|oui)coucou]');
 */
function cs_recuperer_code(&$code) {//, $contexte=array(), $options = array(), $connect=''){
	$fond = _DIR_CS_TMP . md5($code);
	$base = $fond . '.html';
	if(!file_exists($base) || (defined('_VAR_MODE') && _VAR_MODE=='recalcul') || _request('var_mode')=='recalcul')
		ecrire_fichier($base, $code);
	include_spip('public/assembler');
	$fond = str_replace('../', '', $fond);
//	return recuperer_fond($fond, array('fond'=>$fond));
	$f = inclure_page($fond, array('fond'=>$fond));
	return $f['texte'];
}


/*
if(defined('_LOG_CS')) cs_log("INIT : cout_pipelines, lgr=" . strlen($cs_metas_pipelines['pipelines']));
if(!$GLOBALS['cs_pipelines']) include_once(_DIR_CS_TMP.'pipelines.php');
if(defined('_LOG_CS')) cs_log(' -- sortie de cout_pipelines... cs_pipelines = ' . intval($GLOBALS['cs_pipelines']));
*/
?>