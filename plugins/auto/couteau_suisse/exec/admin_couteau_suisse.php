<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://www.spip-contrib.net/?article2166   #
#-----------------------------------------------------#
if(!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/autoriser');
include_spip('inc/texte');
include_spip('inc/layer');
include_spip('inc/presentation');
include_spip('base/cout_upgrade');

// mise a jour des donnees si envoi via formulaire
function enregistre_modif_outils($cmd){
cs_log("INIT : enregistre_modif_outils()");
	global $outils, $metas_outils;
	// recuperer les outils dans $_POST ou $_GET
	$toggle = array();
	if(isset($_GET['outil'])) $toggle[] = $_GET['outil'];
		elseif(isset($_POST['cs_selection'])) $toggle = explode(',', $_POST['cs_selection']);
		else return;
	$_GET['outil'] = ($cmd!='hide' && count($toggle)==1)?$toggle[0]:'';
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
	@define('_ID_WEBMESTRES', 1);
	cs_minipres();
	$cmd = _request('cmd');
	$exec = _request('exec');

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
	if(strlen($pack = _request('pack')) && isset($GLOBALS['cs_installer'][$pack]['outils'])) {
		if($cmd=='install'){
			spip_log("Installation personnalisee de '$pack' par l'auteur id=$connect_id_auteur");
			// installer le pack et rediriger
			cout_install_pack($pack, true);
		} elseif($cmd=='delete'){
			spip_log("Suppression de '$pack' par l'auteur id=$connect_id_auteur");
			$p = preg_quote($pack,'/');
			$r = "[$]GLOBALS\['cs_installer'\]\['$p'\] *=";
			cs_ecrire_config(
				array("/$r/", "/# [^\\n\\r]+[\\n\\r]+if\(0\) {$r}.*?# $p #[\\n\\r]+/s"),
				array('if(0) \0', ''));
			// simplement prendre en compte la supression
			cout_exec_redirige('cmd=pack', false);
		}
	}
	// reset des variables d'un outil
	if($cmd=='reset' && strlen($_GET['outil'])){
		spip_log("Reset des variables de '$_GET[outil]' par l'auteur id=$connect_id_auteur");
		global $outils;
		include_spip('cout_utils');
		include_spip('config_outils');
		if(autoriser('configurer', 'outil', 0, NULL, $outils[$_GET['outil']])) {
			include_spip('inc/cs_outils');
			cs_initialisation_d_un_outil($_GET['outil'], charger_fonction('description_outil', 'inc'), true);
			foreach ($outils[$_GET['outil']]['variables'] as $a)
				if(autoriser('configurer', 'variable', 0, NULL, array('nom'=>$a, 'outil'=>$outils[$_GET['outil']])))
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
	$afficher_outil = ($cmd=='descrip' OR $cmd=='switch')?$_GET['outil']:'';

	// initialisation generale forcee : recuperation de $outils;
	cs_initialisation(true, $cmd!='noinclude');
	cs_installe_outils();

	// mise a jour des donnees si envoi via formulaire
	// sinon fait une passe de verif sur les outils
	if($cmd=='switch' OR $cmd=='hide'){
		enregistre_modif_outils($cmd);
		cout_exec_redirige(strlen($_GET['outil'])?"cmd=descrip&outil={$_GET[outil]}#cs_infos":'');
	}
//	else
//		verif_outils();

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('couteauprive:titre'), "configuration", 'couteau_suisse');

	// pour la  version du plugin
	include_spip('inc/plugin');
	if(isset($GLOBALS['meta']['plugin'])) {
		$t = unserialize($GLOBALS['meta']['plugin']);
		$dir = $t['COUTEAU_SUISSE']['dir'];
		$dir_type = $t['COUTEAU_SUISSE']['dir_type'];
		$bt_dir = $t['BARRETYPOENRICHIE']['dir'];
		$bt_version = $t['BARRETYPOENRICHIE']['version'];
	}
	if(!strlen($dir)) $dir = 'couteau_suisse';
	if(!strlen($bt_dir)) $bt_dir = 'barre_typo_v2';
	$get_infos = defined('_SPIP20100')?charger_fonction('get_infos','plugins'):'plugin_get_infos';
	if (isset($dir_type)) {
		$t = $get_infos($dir, false, constant($dir_type));
	} else {
		$t = $get_infos($dir);
	}
	$cs_version_base = $t['version_base']; $cs_version = $t['version'];
	// mises a jour eventuelles de la base
	installe_un_plugin($dir, $t, $dir_type);
	unset($t);
	if(!strlen($bt_version)) { $bt_version = $get_infos($bt_dir); $bt_version = $bt_version['version']; }
	
	$cs_revision = ((lire_fichier(_DIR_PLUGIN_COUTEAU_SUISSE.'svn.revision',$t)) && (preg_match(',<revision>(\d+)</revision>,',$t,$r)))
		?'<br/>'._T('couteauprive:version_revision', array('revision'=>$r[1])):"";
	include_spip('public/assembler');
	echo recuperer_fond('exec/admin_couteau_suisse_head', array(
		'force' => in_array(_request('var_mode'), array('calcul', 'recalcul'))?'oui':null,
		'cs_version' => $cs_version,
		'exec' => _request('exec'),
	));
	echo "<br /><br /><br />";
	gros_titre(_T('couteauprive:titre'), '', false);
	echo barre_onglets("configuration", 'couteau_suisse');
	echo '<div style="font-size:85%">';
// verification d'une base venant de SPIP 1.8
$res = spip_query("DESCRIBE spip_meta valeur");
$resultat = function_exists('spip_fetch_array')?spip_fetch_array($res):sql_fetch($res);
if($resultat['Type']!='text') echo "<p style=\"color:red;\">Attention : votre base semble ancienne et le Couteau Suisse ne va pas bien fonctionner.</p><p>La table 'spip_meta' a pour type de valeur '$resultat[Type]' au lieu de 'text'.</p>";
// verification de la barre typo V2
$mini = '2.5.3';
if(strlen($bt_version) and (version_compare($bt_version,$mini,'<'))) echo "<p>"._T('couteauprive:erreur:bt', array('version'=>$bt_version, 'mini'=>$mini))."</p>";
echo "<script type=\"text/javascript\"><!-- 
if(!window.jQuery) document.write('".str_replace('/','\/',addslashes(propre('<p>'._T('couteauprive:erreur:jquery').'</p>')))."');
//--></script>";
	echo '</div>';

	// chargement des outils
	include_spip('inc/cs_outils'); 
	list($outils_affiches_actifs, $liste_outils) = liste_outils();
	// cadre de gauche
	echo debut_gauche('', true);
	// pour la liste des docs sur spip-contrib
	$contribs = isset($GLOBALS['meta']['tweaks_contribs'])?unserialize($GLOBALS['meta']['tweaks_contribs']):array();
	foreach($contribs as $i=>$v) $contribs[$i] = preg_replace_callback('/@@(.*?)@@/', 'cs_couper_25', $v);
	sort($contribs);
	$aide = '';
	if(isset($GLOBALS['cs_installer'])) foreach(array_keys($GLOBALS['cs_installer']) as $pack)
		$aide .= "\n_ " . _T('couteauprive:pack_du', array('pack'=>"{[{$pack}|"._T('couteauprive:pack_installe').'->' . generer_url_ecrire($exec,'cmd=install&pack='.urlencode($pack)) . ']}'));
	// si le plugin est installe par procedure automatique, on permet la mise a jour directe (SPIP >= 2.0)
	$arg_chargeur = $GLOBALS['spip_version_base']>=15828?'url_zip_plugin2':'url_zip_plugin'; // eq. SPIP >= 2.1.2
	$form_update = preg_match(',plugins/auto/couteau_suisse/$,',_DIR_PLUGIN_COUTEAU_SUISSE)?
		"<input type='hidden' name='$arg_chargeur' value='http://files.spip.org/spip-zone/couteau_suisse.zip' />"
		. "<br/><div class='cs_sobre'><input type='submit' value='&bull; " . attribut_html(_T('couteauprive:version_update')) . "' class='cs_sobre' title='" . attribut_html(_T('couteauprive:version_update_title')) . "' /></div>"
		:"";
	// un lien si le plugin plugin "Telechargeur" est present (SPIP < 2.0)
	if(!strlen($form_update) && defined('_DIR_PLUGIN_CHARGEUR'))
		$form_update = "<br/>&bull; <a title='" . attribut_html(_T('couteauprive:version_update_chargeur_title')) . "' href='../spip.php?action=charger&plugin=couteau_suisse&url_retour=".urlencode(generer_url_ecrire('admin_couteau_suisse'))."'>"._T('couteauprive:version_update_chargeur').'</a>';
	// compilation du bandeau gauche
	$aide =	_T('couteauprive:help2', array(
			'version' => $cs_version.$cs_revision.'<br/>'.
				(defined('_CS_PAS_DE_DISTANT')?'('._T('couteauprive:version_distante_off').')':'<span class="cs_version">'._T('couteauprive:version_distante').'</span>')
				))
		. $form_update
		. '<br/>&bull;&nbsp;['._T('couteauprive:pack_titre') . '|' . _T('couteauprive:pack_alt') . '->' . generer_url_ecrire($exec,'cmd=pack#cs_infos') . "]\n\n"
		. _T('couteauprive:help3', array(

			'reset' => generer_url_ecrire($exec,'cmd=resetall'),
			'hide' => generer_url_ecrire($exec,'cmd=showall'),
			'contribs' => join('', $contribs),
			'install' => $aide
	));
	if(function_exists('redirige_action_post')) $aide = redirige_action_post('charger_plugin', '', 'admin_couteau_suisse', '', $aide); // SPIP >= 2.0
	$aide = '<div class="cs_aide">'._T('couteauprive:help')."\n\n$aide</div>";
	echo debut_boite_info(true), propre($aide), fin_boite_info(true);
	$aide = cs_aide_raccourcis();
	if(strlen($aide))
		echo debut_boite_info(true), $aide, fin_boite_info(true);
	$aide = cs_aide_pipelines($outils_affiches_actifs);
	if(strlen($aide))
		echo debut_boite_info(true), $aide, fin_boite_info(true);
	echo pipeline('affiche_gauche',array('args'=>array('exec'=>$exec),'data'=>''));

	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite',array('args'=>array('exec'=>$exec),'data'=>'')),
		debut_droite('', true),
		debut_cadre_trait_couleur(find_in_path('img/couteau-24.gif'),true,'','&nbsp;'._T('couteauprive:outils_liste')),
		_T('couteauprive:outil_intro'),
		"\n<table border='0' cellspacing='0' cellpadding='5' style='width:100%;'><tr><td class='sansserif'>";

	$_GET['source'] = $exec;
	echo '<div class="conteneur">', $liste_outils,
		'</div><br class="conteneur" /><div class="cs_patience"><br />'.http_img_pack('searching.gif','*','').' ...</div>';
	flush();
	echo '<div class="conteneur"><div id="cs_infos" class="cs_infos">',
		$cmd=='pack'?cs_description_pack():description_outil2($afficher_outil),
		'</div><script type="text/javascript"><!--
var cs_descripted = "', $afficher_outil, '";
document.write("<style type=\'text/css\'>#csjs{display:none;}<\/style>");
//--></script><div id="csjs" style="color:red;"><br/>', _T('couteauprive:erreur:js'),'</div>
<noscript><style type="text/css">#csjs{display:none;}</style><div style="color:red;"><br/>', _T('couteauprive:erreur:nojs'),
$_GET['modif']=='oui'?'<br/>'._T('couteauprive:vars_modifiees').'.':'','</div></noscript>',
		'</div></td></tr></table>',
		'<style type="text/css">.cs_patience{display:none;}</style>',
		fin_cadre_trait_couleur(true),

		pipeline('affiche_milieu',array('args'=>array('exec'=>$exec),'data'=>'')),
		fin_gauche(), fin_page();
cs_log(" FIN : exec_admin_couteau_suisse()");
}

// callback pour les contribs
function cs_couper_25($matches) { return couper(_T($matches[1]), 25); }

?>