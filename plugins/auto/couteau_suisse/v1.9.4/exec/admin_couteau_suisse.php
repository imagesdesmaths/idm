<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if(!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/autoriser');
include_spip('inc/texte');
include_spip('inc/layer');
include_spip('inc/presentation');
include_spip('couteau_suisse_administrations');

// mise a jour des donnees si envoi via formulaire
function enregistre_modif_outils(&$cmd, &$outil){
cs_log("INIT : enregistre_modif_outils()");
	global $outils, $metas_outils;
	// recuperer les outils dans $_POST ou $_GET
	$toggle = array();
	if(strlen($outil)) $toggle[] = $outil;
		elseif(isset($_POST['cs_selection'])) $toggle = explode(',', $_POST['cs_selection']);
		else return;
	$outil = ($cmd!='hide' && count($toggle)==1)?$toggle[0]:'';
	$i = $cmd=='hide'?'cache':'actif';
	${$i} = isset($GLOBALS['meta']["tweaks_{$i}s"])?unserialize($GLOBALS['meta']["tweaks_{$i}s"]):array();
	foreach($toggle as $o) if(autoriser('configurer', 'outil', 0, NULL, $outils[$o])) {
		if(isset(${$i}[$o][$i]))
			unset(${$i}[$o][$i]); 
		else ${$i}[$o][$i] = 1;
	}
	if(defined('_SPIP19300')) $connect_id_auteur = $GLOBALS['auteur_session']['id_auteur'];
		else global $connect_id_auteur;
	spip_log("Changement de statut ($i) des outils par l'auteur id=$connect_id_auteur : ".implode(', ',array_keys(${$i})));
	ecrire_meta("tweaks_{$i}s", serialize(${$i}));
	if($cmd=='switch') $metas_outils = ${$i};

	include_spip('inc/plugin');
	defined('_SPIP20100')?actualise_plugins_actifs():verif_plugin();

cs_log(" FIN : enregistre_modif_outils()");
}

function exec_admin_couteau_suisse() {
cs_log("INIT : exec_admin_couteau_suisse()");
	global $spip_lang_right;
	global $outils, $afficher_outil, $metas_vars, $metas_outils;

	// cette valeur par defaut n'est pas definie sous SPIP 1.92
	// constante abandonnee sous SPIP 3.0
	if(!defined('_SPIP30000')) @define('_ID_WEBMESTRES', 1);
	cs_minipres();
	$cmd = _request('cmd');
	$exec = _request('exec');
	$outil = _request('outil');

	include_spip('inc/cs_outils');
	cs_init_plugins();

	// id de l'auteur en session
	if(defined('_SPIP19300')) $connect_id_auteur = $GLOBALS['auteur_session']['id_auteur'];
		else global $connect_id_auteur;

	// reset general
	if($cmd=='resetall'){
		spip_log("Reset General du Couteau Suisse par l'auteur id=$connect_id_auteur");
		foreach(array_keys($GLOBALS['meta']) as $meta) {
			if(strpos($meta, 'tweaks_') === 0) effacer_meta($meta);
			if(strpos($meta, 'cs_') === 0) effacer_meta($meta);
		}
		$metas_vars = $metas_outils = array();
		// ici, pas d'initialisation...
		include_spip('cout_lancement');
		cout_exec_redirige('cmd=resetjs');
	}
	// installation personnalisee
	$pack = _request('pack');
	if(strlen($pack) && isset($GLOBALS['cs_installer'][$pack])) {
		if($cmd=='install'){
			spip_log("Installation personnalisee de '$pack' par l'auteur id=$connect_id_auteur");
			// installer le pack et rediriger
			cout_install_pack($pack, true);
		} elseif($cmd=='delete'){
			spip_log("Suppression de '$pack' par l'auteur id=$connect_id_auteur");
			$p = preg_quote($pack,'/');
			$r = "[$]GLOBALS\['cs_installer'\]\['$p'\]\s*=";
			cs_ecrire_config(
				array("/$r/", "/# [^\\n\\r]+[\\n\\r]+if\(0\) {$r}.*?# $p #[\\n\\r]+/s"),
				array('if(0) \\0', ''));
			// simplement prendre en compte la supression
			cout_exec_redirige('cmd=pack#cs_infos', false);
		}
	}
	// reset des variables d'un outil
	if($cmd=='reset' && strlen($outil)){
		spip_log("Reset des variables de '$_GET[outil]' par l'auteur id=$connect_id_auteur");
		global $outils;
		include_spip('cout_utils');
		include_spip('config_outils');
		if(autoriser('configurer', 'outil', 0, NULL, $outils[$outil])) {
			include_spip('inc/cs_outils');
			cs_initialisation_d_un_outil($outil, charger_fonction('description_outil', 'inc'), true);
			foreach ($outils[$outil]['variables'] as $a)
				if(autoriser('configurer', 'variable', 0, NULL, array('nom'=>$a, 'outil'=>$outils[$outil])))
					unset($metas_vars[$a]);
				else spip_log("Reset interdit de la variable %$a% !!");
			ecrire_meta('tweaks_variables', serialize($metas_vars));
		}
		// tout recompiler
		cout_exec_redirige("cmd=descrip&outil={$_GET[outil]}#cs_infos");
	}
	// reset de l'affichage
	if($cmd=='showall'){
		spip_log("Reset de tous les affichages du Couteau Suisse par l'auteur id=$connect_id_auteur");
		effacer_meta('tweaks_caches');
		cout_exec_redirige();
	}

	// afficher la description d'un outil ?
	$afficher_outil = ($cmd=='descrip' OR $cmd=='switch')?$outil:'';

	// initialisation generale forcee : recuperation de $outils;
	cs_initialisation(true, $cmd!='noinclude');
	cs_installe_outils();

	// mise a jour des donnees si envoi via formulaire
	// sinon fait une passe de verif sur les outils
	if($cmd=='switch' OR $cmd=='hide'){
		enregistre_modif_outils($cmd, $outil);
		cout_exec_redirige(strlen($outil)?"cmd=descrip&outil=$outil#cs_infos":'');
	}

	$t = charger_fonction('commencer_page', 'inc');
	echo $t(couteauprive_T('titre'), 'configuration', 'couteau_suisse');

	// versions du Couteau Suisse et de la barre typo
	include_spip('inc/plugin');
	if(isset($GLOBALS['meta']['plugin'])) {
		$t = unserialize($GLOBALS['meta']['plugin']);
		$dir = $t['COUTEAU_SUISSE']['dir'];
		$dir_type = $t['COUTEAU_SUISSE']['dir_type'];
		// obsolete pour SPIP>=3.0 :
		$bt_dir = $t['BARRETYPOENRICHIE']['dir'];
		$bt_version = $t['BARRETYPOENRICHIE']['version'];
	}
	if(!strlen($dir)) $dir = 'couteau_suisse';
	if(!strlen($bt_dir)) $bt_dir = 'barre_typo_v2';
	$get_infos = defined('_SPIP20100')?charger_fonction('get_infos','plugins'):'plugin_get_infos';
	$t = isset($dir_type)?$get_infos($dir, false, constant($dir_type)):$get_infos($dir);
	$cs_version_base = $t['version_base']?$t['version_base']:$t['schema']; $cs_version = $t['version'];
	if(!function_exists('installe_un_plugin')) {
		// ici SPIP >= 3.0
		// TODO: redondances probables a revoir
		// mises a jour eventuelles de la base
		$installer_plugins = charger_fonction('installer', 'plugins');
		$infos = $installer_plugins('couteau_suisse', 'install');
		if(!$infos) {
			// probablement SVP
			list(,$v)=explode('auto/', _DIR_PLUGIN_COUTEAU_SUISSE);
			$infos = $installer_plugins('auto/'.$v, 'install');
		}
		if($infos && $infos['install_test'])
			 echo $infos['install_test'][1], '<p style="color:red;">', 
			 	isset($GLOBALS['cs_base_update'])?'DB '.$GLOBALS['cs_base_update']:'',
			 	_T($infos['install_test'][0]?'plugin_info_install_ok':'avis_operation_echec'),'</p>';
		unset($infos);
		parse_str(parametres_css_prive(), $paramcss);
	} else {
		// compatibilite SPIP < 3.0
		// mises a jour eventuelles de la base
		$paramcss = array();
		installe_un_plugin($dir, $t, $dir_type);
	}
	if(isset($GLOBALS['cs_base_update'])) 
		echo '<p><a href="',parametre_url(self(),'var_mode','recalcul'),'"><span style="color:red;">', couteauprive_T('rafraichir'),'</span></a></p>';
	if(!strlen($bt_version)) { $bt_version = $get_infos($bt_dir); $bt_version = $bt_version['version']; }
	
	// precaution (inutile ?) sur mes_fonctions.php
	include_spip('public/parametrer');

	$cs_revision = ((lire_fichier(_DIR_PLUGIN_COUTEAU_SUISSE.'svn.revision',$t)) && (preg_match(',<revision>(\d+)</revision>,',$t, $r)))
		?'<br/>'.couteauprive_T('version_revision', array('revision'=>$r[1])):"";
	include_spip('public/assembler');
	echo recuperer_fond('exec/admin_couteau_suisse_head', array_merge(
	 $paramcss,
	 array(
		'force' => in_array(_request('var_mode'), array('calcul', 'recalcul'))?'oui':null,
		'cs_version' => $cs_version,
		'exec' => _request('exec'),
	)));
	if(!defined('_SPIP30000')) echo "<br /><br /><br />";
	gros_titre(couteauprive_T('titre'), '', false);

	// Onglet pour SPIP<3.0
	if(!defined('_SPIP30000')) echo barre_onglets("configuration", 'couteau_suisse');

	echo quelques_verifications($bt_version);

	// chargement des outils
	include_spip('inc/cs_outils'); 
	list($outils_affiches_actifs, $liste_outils) = liste_outils();

	// cadre de gauche
	echo debut_gauche('', true);
	$t = '';
	if(isset($GLOBALS['cs_installer'])) foreach(array_keys($GLOBALS['cs_installer']) as $pack)
		$t .= '<br/>&bull;&nbsp;' . couteauprive_T('pack_du', array('pack'=>"{[{$pack}|".couteauprive_T('pack_installe').'->' . generer_url_ecrire($exec,'cmd=install&pack='.urlencode($pack)) . ']}'));
	$tr = defined('_SPIP30000')?_T('info_traductions'):ucfirst(_T('afficher_trad'));
	$erreur_base = (isset($GLOBALS['meta']['couteau_suisse_base_version']) && version_compare($GLOBALS['meta']['couteau_suisse_base_version'],$cs_version_base,'<'))
		?"<span style='color:red'>DB v$cs_version_base => v".$GLOBALS['meta']['couteau_suisse_base_version'].' ??</span><br/>':'';
	$t = propre('<div>' . $erreur_base . couteauprive_T('help2', array(
			'version' => $cs_version.$cs_revision.'<br/>'.
				(defined('_CS_PAS_DE_DISTANT')?'('.couteauprive_T('version_distante_off').')':'<span class="cs_version">'.couteauprive_T('version_distante').'</span>')
				))
		. chargement_automatique($dir)
		. '</div><div>&bull;&nbsp;[' . couteauprive_T('pack_titre') . '|' . couteauprive_T('pack_alt') . '->' . generer_url_ecrire($exec,'cmd=pack#cs_infos')
		. ']<br/>&bull;&nbsp;[' . $tr . '|' . $tr . '->' . generer_url_ecrire($exec,'cmd=trad#cs_infos')
		. "]</div><div style=\"white-space: nowrap;\">"
		. couteauprive_T('help3', array(
			'reset' => generer_url_ecrire($exec,'cmd=resetall'),
			'hide' => generer_url_ecrire($exec,'cmd=showall'),
			'contribs' => "\n_ &bull; " . cs_liste_contribs(25, "\n_ &bull; "),
			'install' => $t))
		. '</div>');
	if(function_exists('redirige_action_post')) $t = redirige_action_post('charger_plugin', '', 'admin_couteau_suisse', '', $t); // SPIP >= 2.0
	$t = '<div class="cs_aide">'.propre('<div>'.couteauprive_T('help').'</div>').$t.'</div>';
	echo debut_boite_info(true), $t, fin_boite_info(true);
//	if(strlen($t = cs_aide_raccourcis()))
//		echo debut_boite_info(true), $t, fin_boite_info(true);
	$t = cs_aide_pipelines($outils_affiches_actifs);
	if(strlen($t))
		echo debut_boite_info(true), $t, fin_boite_info(true);
	echo pipeline('affiche_gauche',array('args'=>array('exec'=>$exec),'data'=>''));

	// cadre de droite
	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite',array('args'=>array('exec'=>$exec),'data'=>'')),
		debut_droite('', true),
		($outil<>'maj_auto' && include_spip('outils/maj_auto_action_rapide'))?maj_auto_svp_presenter_messages():'',
		debut_cadre_trait_couleur(cs_icone(24),true,'','&nbsp;'.couteauprive_T('outils_liste')),
		'<div class="titrem cs_intros">', couper($t = couteauprive_T('outil_intro'), 50),
		'</div><div id="cs_infos_1" class="sous_liste cs_intros_inner">', $t, '</div>';
	if(strlen($t = cs_aide_raccourcis()))
		echo '<div class="titrem cs_intros">', couper($t, 50),
		'</div><div id="cs_infos_2" class="sous_liste cs_intros_inner">', $t, '</div>';
	echo "\n<table border='0' cellspacing='0' cellpadding='5' style='width:100%;'><tr><td class='sansserif'>";

	$_GET['source'] = $exec;
	echo '<div class="conteneur">', $liste_outils,
		'</div><br class="conteneur" /><div class="cs_patience"><br />'.http_img_pack('searching.gif','*','').' ...</div>';
	flush();
	echo '<div class="conteneur"><div id="cs_infos" class="cs_infos">',
		function_exists($f='cs_description_'.$cmd) || ($cmd=='descrip' && function_exists($f='cs_description_'.$outil))
			?$f():description_outil2($afficher_outil),
		'</div><script type="text/javascript"><!--
var cs_descripted = "', $afficher_outil, '";
document.write("<style type=\'text/css\'>#csjs{display:none;}<\/style>");
//--></script><div id="csjs" style="color:red;"><br/>', couteauprive_T('erreur:js'),'</div>
<noscript><style type="text/css">#csjs{display:none;}</style><div style="color:red;"><br/>', couteauprive_T('erreur:nojs'),
$_GET['modif']=='oui'?'<br/>'.couteauprive_T('vars_modifiees').'.':'','</div></noscript>',
		'</div></td></tr></table>',
		'<style type="text/css">.cs_patience{display:none;}</style>',
		fin_cadre_trait_couleur(true),

		pipeline('affiche_milieu',array('args'=>array('exec'=>$exec),'data'=>'')),
		fin_gauche(), fin_page();
cs_log(" FIN : exec_admin_couteau_suisse()");
}

// messages d'avertissments eventuels
function quelques_verifications($bt_version) {
	// test sur jQuery
	$res = "<script type=\"text/javascript\"><!-- 
if(!window.jQuery) document.write('".str_replace('/','\/',addslashes(propre('<p>'.couteauprive_T('erreur:jquery').'</p>')))."');
//--></script>";
	// verification d'une base venant de SPIP 1.8
	$tmp = spip_query('DESCRIBE spip_meta valeur');
	$tmp = function_exists('spip_fetch_array')?spip_fetch_array($tmp):sql_fetch($tmp);
	if(strlen($tmp['Type']) && $tmp['Type']!='text')
		$res .= "<p style=\"color:red;\">Attention : votre base semble ancienne et le Couteau Suisse ne va pas bien fonctionner.</p><p>La table 'spip_meta' a pour type de valeur '$tmp[Type]' au lieu de 'text'.</p>";
	if(!defined('_SPIP30000')) {
		// verification de la barre typo V2 (SPIP<3.0)
		$mini = '2.5.3';
		if(strlen($bt_version) and (version_compare($bt_version,$mini,'<'))) 
			$res .= "<p>".couteauprive_T('erreur:bt', array('version'=>$bt_version, 'mini'=>$mini))."</p>";
	}
	return "<div style='font-size:85%'>$res</div>";
}

// clic pour la mise a jour du Couteau Suisse
function chargement_automatique($dir) {
	$zip = 'http://files.spip.org/spip-zone/couteau_suisse.zip';
	$auto = strpos(_DIR_PLUGIN_COUTEAU_SUISSE,'plugins/auto/')!==false;
	if($auto && defined('_SPIP30000')) {
		//  passage par SVP ?
		include_spip('outils/maj_auto_action_rapide');
		maj_auto_svp_query($dir, $infos);
		if($infos['id_paquet']) $zip = $infos['id_paquet'].':'.$infos['id_depot'].':'.$dir.':'.$zip;
	}
	// si le plugin est installe par procedure automatique, on permet la mise a jour directe (SPIP >= 2.0)
	$arg_chargeur = $GLOBALS['spip_version_base']>=15828?'url_zip_plugin2':'url_zip_plugin'; // eq. SPIP >= 2.1.2
	$res = $auto?
		"<input type='hidden' name='$arg_chargeur' value='$zip' />"
		. "<br/><div class='cs_sobre'><input type='submit' value='&bull; " . attribut_html(couteauprive_T('version_update')) . "' class='cs_sobre' title='"
		. attribut_html(couteauprive_T('version_update_title')) . "' /></div>"
		:"";
	// un lien si le plugin plugin "Telechargeur" est present (SPIP < 2.0)
	if(!strlen($res) && defined('_DIR_PLUGIN_CHARGEUR'))
		$res = "<br/>&bull; <a title='" . attribut_html(couteauprive_T('version_update_chargeur_title')) 
		. "' href='../spip.php?action=charger&plugin=couteau_suisse&url_retour=".urlencode(generer_url_ecrire('admin_couteau_suisse'))."'>".couteauprive_T('version_update_chargeur').'</a>';
	return $res;
}

// callback pour les contribs
function cs_couper_25($matches) { return couper(couteauprive_T($matches[1]), 25); }

?>