<?php
// Ce fichier est charge a chaque recalcul
// Attention, ici il se peut que le plugin ne soit pas initialise (cas des .js/.css par exemple)
if (!defined("_ECRIRE_INC_VERSION")) return;

// pour voir les erreurs ?
if (defined('_CS_REPORT')) error_reporting(E_ALL ^ E_NOTICE);
elseif (defined('_CS_REPORTALL')) error_reporting(E_ALL);

$GLOBALS['cs_fonctions_essai'] = 1;
//if(defined('_LOG_CS')) cs_log("INIT : cout_fonctions ($GLOBALS[cs_spip_options]/$GLOBALS[cs_options]/$GLOBALS[cs_fonctions]/$GLOBALS[cs_init])");

// plugin initialise si cout_options est OK (fin de compilation par exemple)
if(!$GLOBALS['cs_init']) {
	if($GLOBALS['cs_options']) {
		if(!$GLOBALS['cs_fonctions']) {
			// inclusion des fonctions pre-compilees
			if(defined('_LOG_CS')) cs_log("INCL : "._DIR_CS_TMP.'mes_fonctions.php');
			@include(_DIR_CS_TMP.'mes_fonctions.php');
			//if(defined('_LOG_CS')) cs_log("FIN INCL : "._DIR_CS_TMP.'mes_fonctions.php');
		} // else cs_log(' FIN : cout_fonctions deja inclus');
	} else {
		$cs_log = function_exists('cs_log') ? 'cs_log' : 'spip_log';
		$cs_log('ESSAI : cout_fonctions, mais cout_options n\'est pas inclus');
	}
} else {
	$cs_log = function_exists('cs_log') ? 'cs_log' : 'spip_log';
	$cs_log('ESSAI : cout_fonctions, mais initialisation en cours');
}

// raccourci pour le JavaScript
function cs_javascript($chaine) { return unicode_to_javascript(addslashes(html2unicode($chaine))); }

?>
