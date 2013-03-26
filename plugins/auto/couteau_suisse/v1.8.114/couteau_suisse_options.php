<?php
//Pour voir les spip_log, il faut dans mes_options.php (voir inc/utils)
#define ('_LOG_FILTRE_GRAVITE',8);

// Ce fichier est charge a chaque hit //
if (!defined('_ECRIRE_INC_VERSION')) return;

// Pour forcer les logs du plugin, outil actif ou non :
#define('_LOG_CS_FORCE', 'oui');

// Declaration des pipelines qui permettent d'interpreter la description d'un outil issue d'une chaine de langue
// init_description_outil : pipeline d'initialisation, texte brut sorti du fichier de langue
// les variables de l'outil ne sont pas encore interpretees
#$GLOBALS['spip_pipeline']['init_description_outil']='';
// pre_description_outil : 1er pipeline de pre_affichage, indispensable d'y mettre par exemple certaines constantes
if (!isset($GLOBALS['spip_pipeline']['pre_description_outil']))
	$GLOBALS['spip_pipeline']['pre_description_outil']='';
// post_description_outil : 2e pipeline de pre_affichage, ici le texte est quasi definitif
#$GLOBALS['spip_pipeline']['post_description_outil']='';
// a l'issue du telechargement d'un fichier distant
$GLOBALS['spip_pipeline']['fichier_distant']='';

// Declaration d'un pipeline servant a inserer un bouton sous la baniere du Couteau Suisse
if (!isset($GLOBALS['spip_pipeline']['porte_plume_cs_pre_charger']))
	$GLOBALS['spip_pipeline']['porte_plume_cs_pre_charger']='';

// pour les serveurs qui aiment les virgules...
$GLOBALS['spip_version_code'] = str_replace(',','.',$GLOBALS['spip_version_code']);
// constantes de compatibilite
// (pour info : SPIP 2.0 => 12691, SPIP 2.1 => 15133, SPIP 2.2 => ??, , SPIP 3.0 => 17743)
if ($GLOBALS['spip_version_code']>=17743) 
	{ @define('_SPIP30000', 1); @define('_SPIP20200', 1); @define('_SPIP20100', 1); @define('_SPIP19300', 1); @define('_SPIP19200', 1); }
elseif (!strncmp($GLOBALS['spip_version_affichee'],'2.2',3)) 
	{ @define('_SPIP20200', 1); @define('_SPIP20100', 1); @define('_SPIP19300', 1); @define('_SPIP19200', 1); }
elseif ($GLOBALS['spip_version_code']>=15133) 
	{ @define('_SPIP20100', 1); @define('_SPIP19300', 1); @define('_SPIP19200', 1); }
elseif (version_compare($GLOBALS['spip_version_code'],'1.9300','>=')) 
	{ @define('_SPIP19300', 1); @define('_SPIP19200', 1); }
elseif (version_compare($GLOBALS['spip_version_code'],'1.9200','>=')) 
	@define('_SPIP19200', 1);
else @define('_SPIP19100', 1);

// globales de controles de passes
$GLOBALS['cs_options'] /*= $GLOBALS['cs_fonctions'] = $GLOBALS['cs_fonctions_essai'] */
	= $GLOBALS['cs_init'] = $GLOBALS['cs_utils'] = $GLOBALS['cs_verif'] = $GLOBALS['cs_outils'] = 0;
// parametres d'url concernant le plugin ?
$GLOBALS['cs_params'] = isset($_GET['cs'])?explode(',', urldecode($_GET['cs'])):array();
// fichiers/dossiers temporaires pour le Couteau Suisse
define('_DIR_CS_TMP', sous_repertoire(_DIR_TMP, 'couteau-suisse'));

// pour voir les erreurs ?
if (in_array('report', $GLOBALS['cs_params'])) 
	{ define('_CS_REPORT', 1); error_reporting(E_ALL ^ E_NOTICE); }
elseif (in_array('reportall', $GLOBALS['cs_params']) && isset($auteur_session['statut']) && $auteur_session['statut']=='0minirezo')
	{ define('_CS_REPORTALL', 1); @define('_LOG_CS', 1); error_reporting(E_ALL); }

// liste des outils et des variables
global $metas_vars, $metas_outils;
if (!isset($GLOBALS['meta']['tweaks_actifs'])) {
cs_log("  -- lecture metas");
	include_spip('inc/meta');
	lire_metas();
}
$metas_outils = isset($GLOBALS['meta']['tweaks_actifs'])?unserialize($GLOBALS['meta']['tweaks_actifs']):array();
$metas_vars = isset($GLOBALS['meta']['tweaks_variables'])?unserialize($GLOBALS['meta']['tweaks_variables']):array();

// on active tout de suite les logs, si l'outil est actif.
if ((isset($metas_outils['cs_comportement']['actif']) && $metas_outils['cs_comportement']['actif'] && $metas_vars['log_couteau_suisse'])
 || defined('_LOG_CS_FORCE') || in_array('log', $GLOBALS['cs_params']))	@define('_LOG_CS', 1);
if(defined('_LOG_CS')) {
	cs_log(str_repeat('-', 80), '', sprintf('COUTEAU-SUISSE. [#%04X]. ', rand()));
	cs_log('INIT : couteau_suisse_options, '.$_SERVER['REQUEST_URI']);
}

// on passe son chemin si un reset general est demande
$zap = _request('cmd')=='resetall';

// cas ou les options seraient appelees en dehors de tmp/charger_plugins_options.php
if (!defined('_DIR_PLUGIN_COUTEAU_SUISSE')) {
	spip_log('## ERREUR : constante "_DIR_PLUGIN_COUTEAU_SUISSE" non definie !');
	spip_log(' URI : '.$_SERVER['REQUEST_URI'].'. POST : '.var_export($POST, true));
	$zap = true;
}

// lancer maintenant les options du Couteau Suisse
if($zap)
	cs_log(' FIN : couteau_suisse_options sans initialisation du plugin');
else {
	// $cs_metas_pipelines ne sert qu'a l'execution et ne comporte que :
	//	- le code pour <head></head>
	//	- le code pour les pipelines utilises
	global $cs_metas_pipelines;
	$cs_metas_pipelines = array();

	// alias pour passer en mode impression
	if ( in_array('print', $GLOBALS['cs_params']) ||
		(isset($_GET['page']) && in_array($_GET['page'], array('print','imprimer','imprimir_articulo','imprimir_breve','article_pdf')))
	   ) define('_CS_PRINT', 1);

	// recherche des fichiers a inclure : si les fichiers sont absents, on recompilera le plugin
	// fichiers testes : tmp/couteau-suisse/mes_options.php et tmp/couteau-suisse/mes_spip_options.php
	$cs_exists = file_exists($f_mo = _DIR_CS_TMP.'mes_options.php');
	$f_mso = _DIR_CS_TMP.'mes_spip_options.php';
	if(!(isset($GLOBALS['cs_spip_options']) && $GLOBALS['cs_spip_options'])) $cs_exists &= file_exists($f_mso);
	if(!$cs_exists) cs_log(" -- '$f_mo' ou '$f_mso' introuvable !");

	// lancer l'initialisation du plugin. on force la compilation si cs=calcul
	include_once(_DIR_PLUGIN_COUTEAU_SUISSE.'cout_lancement.php');
	cs_initialisation(!$cs_exists || in_array('calcul', $GLOBALS['cs_params']));
	if(defined('_LOG_CS')) cs_log("PUIS : couteau_suisse_options, initialisation terminee");

	// inclusion des options hautes de SPIP, si ce n'est pas deja fait par config/mes_options.php
	if(!(isset($GLOBALS['cs_spip_options']) && $GLOBALS['cs_spip_options'])) {
		if(file_exists($f_mso)) {
			if(defined('_LOG_CS')) cs_log(" -- inclusion de '$f_mso'");
			include_once($f_mso);
		} else
			cs_log(" -- fichier '$f_mso' toujours introuvable !!");
	} else
		cs_log(" -- fichier '$f_mso' deja inclu par config/mes_options.php");

	// inclusion des options pre-compilees du Couteau Suisse, si ce n'est pas deja fait...
	if (!$GLOBALS['cs_options']) {
		if(file_exists($f_mo)) {
			if(defined('_LOG_CS')) cs_log(" -- inclusion de '$f_mo'");
			include_once($f_mo);
			// verification cardinale des metas : reinitialisation si une erreur est detectee
			if (count($metas_outils)<>$GLOBALS['cs_verif']) {
				cs_log("ERREUR : metas incorrects - verif = $GLOBALS[cs_verif]");
				cs_initialisation(true);
				if (!$GLOBALS['cs_verif']) { 
					if(file_exists($f_mso)) include_once($f_mso); 
					if(file_exists($f_mo)) include_once($f_mo); 
				}
			}
		} else
			cs_log(" -- fichier '$f_mo' toujours introuvable !!");
	} else cs_log(" -- pas d'inclusion de '$f_mo' ; on est deja passe par ici !?");

	// si une recompilation a eu lieu...
	if ($GLOBALS['cs_utils']) {
		// lancer la procedure d'installation pour chaque outil
		if(defined('_LOG_CS')) cs_log(' -- cs_installe_outils...');
		cs_installe_outils();
		if(in_array('calcul', $GLOBALS['cs_params'])) {
			include_spip('inc/headers');
			redirige_par_entete(parametre_url($GLOBALS['REQUEST_URI'],'cs',str_replace('calcul','ok',join(',',$GLOBALS['cs_params'])),'&'));
		}
	}

	// a-t-on voulu inclure couteau_suisse_fonctions.php ?
	if ($GLOBALS['cs_fonctions_essai']) {
		if(defined('_LOG_CS')) cs_log(" -- lancement de cs_charge_fonctions()");
		cs_charge_fonctions();
	}

	if(defined('_LOG_CS')) cs_log(" FIN : couteau_suisse_options, cs_spip_options = $GLOBALS[cs_spip_options], cs_options = $GLOBALS[cs_options], cs_fonctions_essai = $GLOBALS[cs_fonctions_essai]");
}

// Droits pour configurer le Couteau Suisse (fonction surchargeable sans le _dist)
// Droits par defaut equivalents a 'configurer' les 'plugins', donc tous les administrateurs non restreints
function autoriser_cs_configurer_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('configurer', 'plugins', $id, $qui, $opt);
}

// Droits pour afficher le bouton du Couteau Suisse dans le bandeau de SPIP
function autoriser_csconfig_bouton_dist($faire, $type, $id, $qui, $opt) {
    return autoriser('configurer', 'cs', $id, $qui, $opt); // SPIP < 3.0
}
function autoriser_csconfig_menu_dist($faire, $type, $id, $qui, $opt) {
    return autoriser('configurer', 'cs', $id, $qui, $opt); // SPIP >= 3.0
}

// Droits pour voir/manipuler un outil du Couteau Suisse
// $opt doit representer ici l'outil concerne : $outil
// Si $opt['autoriser'] (code PHP) n'est pas renseigne, ces droits natifs sont toujours accordes
function autoriser_outil_configurer_dist($faire, $type, $id, $qui, $opt) {
	if(!is_array($opt)) return autoriser('configurer', 'cs', $id, $qui, $opt);
	// test sur la version de SPIP
	$test = !cs_version_erreur($opt)
		// autorisation d'un outil en particulier
		&& autoriser('configurer', 'outil_'.$opt['id'], $id, $qui, $opt)
		// autorisation de la categorie de l'outil
		&& autoriser('configurer', 'categorie_'.$opt['categorie'], $id, $qui, $opt);
	if($test && isset($opt['autoriser']))
		eval('$test &= '.$opt['autoriser'].';');
	return $test;
}

// Droits pour modifier une variable du Couteau Suisse
// $opt doit contenir le nom de la variable et le tableau de l'outil appelant
function autoriser_variable_configurer_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('configurer', 'cs', $id, $qui, $opt)
		&& autoriser('configurer', 'outil_'.$opt['outil']['id'], $id, $qui, $opt['outil'])
		&& autoriser('configurer', 'variable_'.$opt['nom'], $id, $qui, $opt['outil']);
}

if(!defined('_SPIP20100')) {
	// Bug SPIP 2.0.x
	function autoriser_cs_configurer($faire, $type, $id, $qui, $opt) {
		return autoriser_cs_configurer_dist($faire, $type, $id, $qui, $opt); }
	function autoriser_outil_configurer($faire, $type, $id, $qui, $opt) {
		return autoriser_outil_configurer_dist($faire, $type, $id, $qui, $opt); }
	function autoriser_variable_configurer($faire, $type, $id, $qui, $opt) {
		return autoriser_variable_configurer_dist($faire, $type, $id, $qui, $opt); }
}

// TODO : revoir eventuellement tout ca avec la syntaxe de <necessite>
function cs_version_erreur(&$outil) {
	return (isset($outil['version-min']) && version_compare($GLOBALS['spip_version_code'], $outil['version-min'], '<'))
		|| (isset($outil['version-max']) && version_compare($GLOBALS['spip_version_code'], $outil['version-max'], '>'));
}

// Logs de tmp/spip.log
function cs_log($variable, $prefixe='', $stat='') {
	static $rand;
	if($stat) $rand = $stat;
	if (!is_string($variable)) $variable = var_export($variable, true);
	if(!defined('_LOG_CS') /*|| !defined('_CS_REPORTALL')*/ || !strlen($variable)) return;
	spip_log($variable = $rand.$prefixe.$variable);
	if (defined('_CS_REPORTALL')) echo '<br />',htmlentities($variable);
}

// Message de sortie si la zone est non autorisee
function cs_minipres($exit=-1) {
	if($exit===-1) {
		include_spip('inc/autoriser');
		$exit = !autoriser('configurer', 'cs');
	}
	if($exit) {
		include_spip('inc/minipres');
		echo minipres();
		exit;
	}
}

// Dates
function cs_date() {
	return date(_T('couteau:date_court', array('jour'=>'d', 'mois'=>'m', 'annee'=>'y')));
}
function cs_date_long($numdate) {
	$date_array = recup_date($numdate);
	if (!$date_array) return '?';
	list($annee, $mois, $jour, $heures, $minutes, $sec) = $date_array;
	if(!defined('_SPIP19300')) list($heures, $minutes) =array(heures($numdate), minutes($numdate));
	return _T('couteau:stats_date', array('jour'=>$jour, 'mois'=>$mois, 'annee'=>substr($annee,2), 'h'=>$heures, 'm'=>$minutes, 's'=>$sec));
}
function cs_date_court($numdate) {
	$date_array = recup_date($numdate);
	if (!$date_array) return '?';
	list($annee, $mois, $jour) = $date_array;
	return _T('couteau:date_court', array('jour'=>$jour, 'mois'=>$mois, 'annee'=>substr($annee,2)));
}

// Fichier d'options
function cs_spip_file_options($code) {
	// Config generale
	$glo = _DIR_RACINE._NOM_PERMANENTS_INACCESSIBLES._NOM_CONFIG.'.php';
	// Attention a la mutualisation
	if(defined('_DIR_SITE')) {
		// Config locale uniquement
		$nfo = $fo = _DIR_SITE._NOM_PERMANENTS_INACCESSIBLES._NOM_CONFIG.'.php';
	} else {
		// Fichier de config, s'il est present
		$fo = (defined('_FILE_OPTIONS') && strlen(_FILE_OPTIONS))?_FILE_OPTIONS:false;
		// Nom du fichier a creer en cas d'absence
		$nfo = $glo;
	}
	switch($code) {
		case 1: return $fo;
		case 2: return $nfo;
		case 3: return $fo?$fo:$nfo;
		case 4: return $glo;
	}
}

// balises de tracage, directement compatibles regexpr
// le separateur _CS_HTMLX est supprime en fin de calcul
@define('_CS_HTMLA', '<span class="csfoo htmla"></span>');
@define('_CS_HTMLB', '<span class="csfoo htmlb"></span>');
@define('_CS_HTMLX', '<span class="csfoo \w+"></span>');
// avec paragraphage intempestif :
@define('_CS_HTMLX2', '<p>(?:<br[^>]*>\s*)?<span class="csfoo \w+"></span></p>|<span class="csfoo \w+"></span>');

// nettoyage des separateurs
function cs_nettoie(&$flux) {
	if(strpos($flux, '"csfoo ')===false) return $flux;
	return preg_replace(','.(strpos($flux, '<p><br')===false?_CS_HTMLX:_CS_HTMLX2).',', '', $flux);
}

if(defined('_SPIP30000')) {
	// Utilise par maj_auto et le CS lui-meme pour mettre a jour les plugins (ou les paquets de SVP)
	function action_charger_plugin() {
	#	include_spip('inc/minipres'); die(minipres('Partie en d&eacute;veloppement.<br/>Mettre &agrave; jour votre plugin prochainement.'));
		if(is_array($ids_paquet = _request('ids_paquet'))) {
			// il s'agit d'une liste de paquets, on donne la main a SVP (SPIP >= 3.0)
			include_spip('outils/maj_auto_action_rapide');
			maj_auto_svp_maj_plugin($ids_paquet);
		}
		elseif(intval($id_paquet = _request('url_zip_plugin2'))) {
			// il s'agit d'un paquet, on donne la main a SVP (SPIP >= 3.0)
			include_spip('outils/maj_auto_action_rapide');
			maj_auto_svp_maj_plugin(array($id_paquet));
		}
		// methode traditionnelle SPIP2, fonctionne egalement sous SPIP3 grace aux 2 lib distantes
		// lancement de la maj (prise en compte de fichiers fantomes restes apres mise à jour de SPIP)
		if((include_spip('action/charger_plugin') OR include_spip('lib/maj_auto/distant_action_charger_plugin'))
			&& (include_spip('inc/charger_plugin') OR include_spip('lib/maj_auto/distant_inc_charger_plugin')))
			action_charger_plugin_dist();
	}
}

?>