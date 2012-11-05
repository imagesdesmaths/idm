<?php
/**
 * @name 		DevelopmentDebugger
 * @author 		Piero Wbmstr <piero.wbmstr@gmail.com>
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

# --------------------------------------------------------------
# Fichier de configuration pris en compte par config_outils.php 
# et specialement dedie a la configuration de ma lame perso
# --------------------------------------------------------------

// Ajout de l'outil 'devdebug'
function outils_devdebug_config_dist() {
	// Pour ne pas voir les erreurs dans le formulaire CS
	@ini_set('display_errors','1'); 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	// Defaut
	@define('_DEVDEBUG_MODE_DEF', 0);
	@define('_DEVDEBUG_ESPACE_DEF', 'tout');
	@define('_DEVDEBUG_NIVEAU_DEF', 'warning');
	// Ajout de l'outil
	add_outil(array(
		'id' => 'devdebug',
        'contrib' => 3572,
        'auteur' => 'Piero Wbmstr',
        'categorie' => 'devel',
		'code:options' => "%%devdebug_mode%%%%devdebug_espace%%%%devdebug_niveau%%devdebug_charger_debug();\n",
		'autoriser' => "autoriser('webmestre')",
		'description' => '<:devdebug::>[[%devdebug_mode%]][[%devdebug_espace%]][[%devdebug_niveau%]]',
	));
	// Ajout des variables utilisees ci-dessus
	add_variables(array(
			'nom' => 'devdebug_mode',
			'format' => _format_NOMBRE,
			'radio' => array(1=>'item_oui',0=>'item_non'),
			'defaut' => _DEVDEBUG_MODE_DEF,
			'code' => "define('_DEVDEBUG_MODE', %s);\n",
		),array(
			'nom' => 'devdebug_espace',
			'format' => _format_CHAINE,
			'radio' => array(
				'tout'=>'couteauprive:devdebug:item_tout',
				'prive'=>'couteauprive:devdebug:item_espace_prive',
				'public'=>'couteauprive:devdebug:item_espace_public'),
			'defaut' => _DEVDEBUG_ESPACE_DEF,
			'code' => "define('_DEVDEBUG_ESPACE', %s);\n",
		),array(
			'nom' => 'devdebug_niveau',
			'format' => _format_CHAINE,
			'select' => array(
				'warning' => 'couteauprive:devdebug:item_e_warning',
				'notice' => 'couteauprive:devdebug:item_e_notice',
				'all' => 'couteauprive:devdebug:item_e_all',
				'error' => 'couteauprive:devdebug:item_e_error', 
				'strict' => 'couteauprive:devdebug:item_e_strict',
			),
			'defaut' => _DEVDEBUG_NIVEAU_DEF,
			'code' => "define('_DEVDEBUG_NIVEAU', %s);\n",
		)
	);
}
?>