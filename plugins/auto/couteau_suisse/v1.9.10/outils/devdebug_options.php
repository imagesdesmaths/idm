<?php
/**
 * @name 		DevelopmentDebugger
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 * @link 		http://contrib.spip.net/?article3572
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * On charge la config de l'outil et les valeurs d'erreurs renvoyees
 */
function devdebug_charger_debug(){
	// On renvoie direct si pas defini
	if(!defined('_DEVDEBUG_MODE')) return;
	// Sinon, on traite
	if(_DEVDEBUG_MODE==1){
		$prive = test_espace_prive();
		// Les liens d'erreur generes par PHP renvoient ... en local ! dans le php.ini standard
		// On les definit du type 'http://fr.php.net/manual/en/ %s .php' (necessite une connexion)
		$devdebug_langues_phpdoc = array('en','fr','de','ja','pl','ro','fa','es','tr');
		if(function_exists('utiliser_langue_visiteur')) utiliser_langue_visiteur();
		$lang = (isset($GLOBALS['spip_lang']) && in_array($GLOBALS['spip_lang'], $devdebug_langues_phpdoc))
			? $GLOBALS['spip_lang'] : 'fr';
		@ini_set('docref_root', "http://www.php.net/manual/".$lang."/");
		@ini_set('docref_ext', '.php');
		// On lance le php error tracking quoiqu'il arrive
		@ini_set('track_errors',1);
		// On evite d'afficher les erreurs repetees
		@ini_set('ignore_repeated_errors',1);
		// Compatibilite PHP (recup de 'inc_version', mais qui le definit trop tard)
		@define('E_DEPRECATED',8192); // PHP 5.3
		// Et let's go
		$niveau = 'E_WARNING';
		if(defined('_DEVDEBUG_NIVEAU')) switch(_DEVDEBUG_NIVEAU) {
			case 'warning' : $niveau = "E_ALL ^ E_NOTICE"; break;
			case 'error' : $niveau = "E_ALL ^ (E_NOTICE | E_WARNING)"; break;
			case 'strict' : $niveau = "-1"; break;
			case 'all' : $niveau = "E_ALL | E_DEPRECATED"; break;
			case 'user' : $niveau = "E_USER_NOTICE | E_USER_WARNING | E_USER_ERROR"; break;
			case 'notice' : default : $niveau = "E_ALL"; break;
		}
		if(defined('_DEVDEBUG_ESPACE')) switch(_DEVDEBUG_ESPACE) {
			case 'public' :
				if(!$prive) {
					@ini_set('display_errors',1); 
					eval("error_reporting($niveau);");
				}
				else @ini_set('display_errors',0);
				break;
			case 'prive' :
				if($prive) {
					@ini_set('display_errors',1); 
					eval("error_reporting($niveau);");
				}
				else @ini_set('display_errors',0);
				break;
			default :
				@ini_set('display_errors',1); 
				eval("error_reporting($niveau);");
		}
	}
	elseif(_DEVDEBUG_MODE==0) @ini_set('display_errors',0);
}

/**
 * Page de reglages accessible tout le temps par le webmestre : 'ecrire/?exec=debug'
 * En cas de probleme
 * => on detoure le CS : 
 *		=> "redirect" enleve
 *		=> ajout d'un input "exec" hidden
 * (je sais c'est mal!)
 */
function exec_debug() {
	ini_set('display_errors','1'); error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	include_spip('inc/minipres'); 
	global $connect_statut;
	if ($connect_statut != "0minirezo" || !autoriser('configurer', 'configuration')){ echo minipres(); exit;}
	include_spip('inc/cs_outils'); 
	$content = description_outil2('devdebug');
	$content = str_replace(" name='redirect'", " name='abcdef'", $content);
	$content = str_replace("?exec=devdebugger", '', $content);
	echo minipres(' ',str_replace("<input type='hidden' name='action' value='description_outil' />", "<input type='hidden' name='action' value='description_outil' /><input type='hidden' name='exec' value='devdebugger' />", $content));
	exit;  
}

?>