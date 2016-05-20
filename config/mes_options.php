<?php

# appel JIN
include realpath(dirname(__FILE__)) .'/../framework-jin/jin/launcher.php';

date_default_timezone_set('Europe/Paris');
ini_set('date.timezone','Europe/Paris');
define ('_ID_WEBMESTRES', '1:41:2532:2082:2494');
define ('_SPIP_LOCK_MODE', 0);
//define ('_LOG_FILTRE_GRAVITE', 7);

//define('_NO_CACHE', -1); 
// afficher toutes les erreurs
//error_reporting(E_ALL);
//@ini_set("display_errors", "On");
 
// afficher toutes les erreurs dans SPIP aussi
//define('SPIP_ERREUR_REPORT',E_ALL);
// afficher toutes les erreurs dans les pipelines aussi
//define('SPIP_ERREUR_REPORT_INCLUDE_PLUGINS',E_ALL);
//$GLOBALS['taille_des_logs'] = 5000;

$GLOBALS['dossier_squelettes'] = 'squelettes-custom';
$GLOBALS['elasticsearch_config'] = array(
    'host' => 'localhost',
    'index' => 'idm',
    'port' => 9200,
    'debug' => false,
    'pagin' => 10
);

/*
    Constantes utilisées par squelettes-custom/
 */
define('RUBRIQUE_SPECIAL', 18);                 // squelette lié : squelettes-custom/article-18.html
define('RUBRIQUE_TRIBUNES', 6);
define('RUBRIQUE_DEBAT_DU_18', 55);
define('RUBRIQUE_DEFIS_DES_MATHS', 54);
define('RUBRIQUE_PODCAST', 38);
define('RUBRIQUE_CONCOURS', 47);
define('RUBRIQUE_ARCHIVES', 2);
define('RUBRIQUE_EN_SORTANT_DE_L_ECOLE', 50);
define('RUBRIQUE_REVUE_DE_PRESSE', 26);
define('RUBRIQUE_EVENEMENTS', 33);
define('RUBRIQUE_FIGURES_SANS_PAROLES', 56);    // squelette lié : squelettes-custom/article-56.html

define('ARTICLE_IMAGES_DU_JOUR', 167);
define('ARTICLE_PRESENTATION', 63);
define('ARTICLE_EQUIPE', 16);
define('ARTICLE_FONCTIONNEMENT', 17);
define('ARTICLE_PARTENAIRES', 100);
define('ARTICLE_DEVENIR_CONTRIBUTEUR', 950);
define('ARTICLE_MENTIONS_LEGALES', 1213);
define('ARTICLE_MODE_EMPLOI_TECHNIQUE', 493);

define('GROUPE_MOT_ACTUALITE_IMPORTANTE', 7);

define('MOT_FEATURED', 25);
define('MOT_PISTE_VERTE', 20);
define('MOT_PISTE_BLEUE', 21);
define('MOT_PISTE_ROUGE', 22);
define('MOT_PISTE_NOIRE', 23);
define('MOT_HORS_PISTE', 24);

?>
