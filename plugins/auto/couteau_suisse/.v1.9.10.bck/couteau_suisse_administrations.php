<?php
// pour tester la MAJ !
# $GLOBALS['meta']['couteau_suisse_base_version']='1.8';

if(!defined('_SPIP20100')) {
	// Versions SPIP anterieures a 2.1
	function couteau_suisse_install($action){
		static $ok = 0;
		if(defined('_LOG_CS')) cs_log("couteau_suisse_install($action)");
		include_spip('inc/meta');
		include_spip('inc/plugin');
		if(isset($GLOBALS['meta']['plugin'])) {
			$t = unserialize($GLOBALS['meta']['plugin']);
			$t = $t['COUTEAU_SUISSE']['dir'];
		}
		$t = plugin_get_infos(strlen($t)?$t:'couteau_suisse');
		switch ($action){
			case 'test':
				// affichage d'un lien ici, puisque le pipeline 'affiche_gauche' n'est pas pris en compte dans 'admin_plugin'...
				if(!$ok && _request('exec') == 'admin_plugin') {
					if(!defined('_SPIP19300')) echo '<br />';
					include_spip('inc/presentation');
					echo debut_cadre_enfonce('', true),
						icone_horizontale(_T('couteau:titre'), generer_url_ecrire('admin_couteau_suisse'), cs_icone(24), '', false),
						fin_cadre_enfonce(true);
					$ok++;
				}
				return isset($GLOBALS['meta']['couteau_suisse_base_version'])
					AND ($GLOBALS['meta']['couteau_suisse_base_version']>=$t['version_base'])
					AND isset($GLOBALS['meta']['tweaks_actifs']);
				break;
			case 'install':
				couteau_suisse_upgrade('couteau_suisse_base_version',$t['version_base']);
				break;
			case 'uninstall':
				couteau_suisse_vider_tables('couteau_suisse_base_version');
				break;
		}
	}
}

// desinstallation des donnees du plugin
function couteau_suisse_vider_tables($nom_meta_base_version) {
	effacer_meta($nom_meta_base_version);
	// effacement de toutes les metas du Couteau Suisse
	foreach(array_keys($GLOBALS['meta']) as $meta) {
		if(strpos($meta, 'tweaks_') === 0) effacer_meta($meta);
		if(strpos($meta, 'cs_') === 0) effacer_meta($meta);
	}
	ecrire_metas(); # Pour SPIP 1.92
	// effacement des repertoires temporaires
	include_spip('inc/getdocument');
	foreach(array(_DIR_CS_TMP, _DIR_VAR.'couteau-suisse') as $dir) 
		if(@file_exists($dir)) effacer_repertoire_temporaire($dir);
	// fichier RSS temporaire
	include_spip('cout_define');
	@unlink(_CS_TMP_RSS);
	// retrait de l'inclusion eventuelle dans config/mes_options.php
	include_spip('cout_utils');
	cs_verif_FILE_OPTIONS(false, true);
}

// installation des tables du plugin et mises a jour
function couteau_suisse_upgrade($nom_meta_base_version, $version_cible){
if(defined('_LOG_CS')) cs_log("cout_upgrade : $nom_meta_base_version => $version_cible");
	$current_version = '0.0';
	if(	isset($GLOBALS['meta'][$nom_meta_base_version])
		&& !version_compare($current_version = $GLOBALS['meta'][$nom_meta_base_version], $version_cible) )
			return;
	if($current_version=='0.0') {
		include_spip('base/create'); 
		creer_base();
	}
	if(cs_le_test($current_version, $tmp, '1.0')) {
		cs_suppr_metas_var('set_options');
		cs_suppr_metas_var('radio_set_options3');
		cs_suppr_metas_var('radio_set_options', 'radio_set_options4');
		cs_suppr_metas_var('radio_type_urls', 'radio_type_urls3');
		cs_suppr_metas_var('radio_type_urls2', 'radio_type_urls3');
		cs_suppr_metas_var('radio_filtrer_javascript', 'radio_filtrer_javascript3');
		cs_suppr_metas_var('radio_filtrer_javascript2', 'radio_filtrer_javascript3');
		cs_suppr_metas_var('radio_suivi_forums', 'radio_suivi_forums3');
		cs_suppr_metas_var('desactive_cache');
		cs_suppr_metas_var('radio_desactive_cache', 'radio_desactive_cache3');
		cs_suppr_metas_var('target_blank');
		cs_suppr_metas_var('url_glossaire_externe', 'url_glossaire_externe2');
		cs_suppr_metas_var('');
		if(defined('_SPIP19300')) {
			if(@$metas_vars['radio_desactive_cache3']==1) $metas_vars['radio_desactive_cache4']=-1;
			cs_suppr_metas_var('radio_desactive_cache3');
		}
		foreach(array('cs_decoupe', 'cs_decoration', 'cs_decoration_racc', 'cs_smileys', 'cs_smileys_racc', 
				'cs_chatons', 'cs_chatons_racc', 'cs_jcorner', 'cs_couleurs', 'cs_couleurs_racc', 
				'cs_filets_sep', 'cs_filets_sep_racc', 'cs_insertions') as $meta) 
			effacer_meta($meta);
		ecrire_meta($nom_meta_base_version, $current_version=$tmp);
	}
	if(cs_le_test($current_version, $tmp, '1.5')) {
		// nouveau champ 'ordre'
		include_spip('outils/boites_privees');
		tri_auteurs_verifie_table(true);
		ecrire_meta($nom_meta_base_version, $current_version=$tmp);
	}
	if(cs_le_test($current_version, $tmp, '1.7')) {
		effacer_meta('tweaks_contribs');
		// MAJ forcee de tous les fichiers distants
		cs_maj_forcee(array('ecran_securite', 'previsualisation'));
		ecrire_meta($nom_meta_base_version, $current_version=$tmp);
	}
	if(cs_le_test($current_version, $tmp, '1.10')) {
		// MAJ pour rajeunissement
		cs_maj_forcee(array('maj_auto', 'masquer', 'jcorner'));
		ecrire_meta($nom_meta_base_version, $current_version=$tmp);
	}
	if(cs_le_test($current_version, $tmp, '1.11')) {
		// anciens metas inusites
		foreach(array('tweaks_smileys', 'tweaks_chatons', 'cs_spam_mots') as $meta) 
			effacer_meta($meta);
		ecrire_meta($nom_meta_base_version, $current_version=$tmp);
	}
	ecrire_metas(); # Pour SPIP 1.92
}

function cs_le_test($current_version, &$tmp, $new) {
	if($test = version_compare($current_version, $tmp=$new, '<')) {
		echo '<h4>',_T('couteau:titre'),' - Upgrade ',$tmp,'</h4>';
		$GLOBALS['cs_base_update'] .= $tmp.' > ';
	}
	return $test;
}

function cs_maj_forcee($liste) {
	$outils = isset($GLOBALS['meta']['tweaks_actifs'])?unserialize($GLOBALS['meta']['tweaks_actifs']):array();
	foreach($liste as $l) $outils[$l]['maj_distant'] = 1;
	ecrire_meta('tweaks_actifs', serialize($outils));
}

function cs_suppr_metas_var($meta, $new = false) {
 global $metas_vars;
 if(!isset($metas_vars[$meta])) return;
 if($new) {
 	if(preg_match(',([0-9A-Za-z_-]*)\(('.'[0-9A-Za-z_-]*=[A-Za-z_:-]+\|[0-9A-Za-z_:=>|-]+'.')\),', $metas_vars[$meta], $reg))
		$metas_vars[$new] = $reg[1];
	else $metas_vars[$new] = $metas_vars[$meta];
 }
 unset($metas_vars[$meta]);
}

/*******************/
/* PACKS DE CONFIG */
/*******************/

function cout_install_pack($pack, $redirige=false) {
	global $metas_vars, $metas_outils;
	$pack = &$GLOBALS['cs_installer'][$pack];
	if(is_string($pack) && function_exists($pack)) $pack = $pack();
	effacer_meta('tweaks_actifs');
	$metas_vars = $metas_outils = array();
	foreach(preg_split('%\s*[,|]\s*%', $pack['outils']) as $o) $metas_outils[trim($o)]['actif'] = 1;
	if(is_array($pack['variables'])) foreach($pack['variables'] as $i=>$v) $metas_vars[$i] = $v;
	ecrire_meta('tweaks_actifs', serialize($metas_outils));
	ecrire_meta('tweaks_variables', serialize($metas_vars));
	// tout recompiler
	if($redirige) cout_exec_redirige('cmd=pack#cs_infos');
}

// redirige vers la page exec en cours en vue une reinitialisation du Couteau Suisse
// si $arg==false alors la redirection ne se fera pas (procedure d'installation par exemple)
function cout_exec_redirige($arg='', $recompiler=true) {
	if($recompiler) {
		ecrire_metas();
		cs_initialisation(true);
		include_spip('inc/invalideur');
		suivre_invalideur('1'); # tout effacer
		purger_repertoire(_DIR_SKELS);
		purger_repertoire(_DIR_CACHE);
	}
	if($arg!==false) {
		include_spip('inc/headers');
		redirige_par_entete(generer_url_ecrire(_request('exec'), $arg, true));
	}
}

?>