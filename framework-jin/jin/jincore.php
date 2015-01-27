<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin;

use jin\filesystem\IniFile;
use jin\log\Debug;
use jin\lang\StringTools;

/** Méthodes de bas niveau du framework
 *  @auteur     Loïc Gerard
 *  @check      27/03/2014
 */
class JinCore {

    /** Configuration JIN
     * @var array
     */
    private static $config;

    /**
     * Url de la racine du dossier contenant JIN
     * @var string
     */
    private static $containerUrl;

    /**
     * Url de la racine de la librairie Jin
     * @var string
     */
    private static $jinRootUrl;

    /** Fonction appelée automatiquement à chaque besoin d'une classe par le système
     *
     *  @param  $className  string  Chemin de la classe
     */
    public static function autoload($className) {

	$tab = explode('\\', $className);
	$path = strtolower(implode(DIRECTORY_SEPARATOR, $tab)) . '.php';

	$surcharge = self::getContainerPath() . self::getConfigValue('surchargeAbsolutePath') . '/' . str_replace('jin/', '', $path);

	if (self::getConfigValue('surcharge') && file_exists($surcharge)) {
	    //Surcharge
	    $path = $surcharge;
	} else {
	    //Fichier natif
	    $path = str_replace('jin/jincore.php', '', __FILE__) . $path;
	}

	if (is_file($path)) {
	    require($path);
	}
    }

    /**
     * Retourne l'url de la racine de la librairie Jin
     * @return string
     */
    public static function getJinRootUrl() {
	if (self::$jinRootUrl) {
	    return self::$jinRootUrl;
	}
	self::$jinRootUrl = self::getContainerUrl() . 'framework-jin/jin/';
	return self::$jinRootUrl;
    }

    /** Retourne le chemin absolu de la racine de la librairie Jin
     *
     * @return string   Chemin absolu de la racine de la librairie Jin
     */
    public static function getJinRootPath() {
	return str_replace('jincore.php', '', __FILE__);
    }

    /** Retourne le chemin absolu du dossier contenant le framework Jin
     *
     * @return string   Chemin absolu de le dossier contenant la librairie Jin
     */
    public static function getContainerPath() {
	$basePath = str_replace('framework-jin/jin/jincore.php', '', __FILE__);
	$basePath = str_replace('jin/jincore.php', '', $basePath);

	return $basePath;
    }

    /**
     * Retourne l'url de la racine du projet
     * @return string
     */
    public static function getContainerUrl() {
	if (self::$containerUrl) {
	    return self::$containerUrl;
	}
	$rootUrl = 'http';
	if (isset($_SERVER["HTTPS"])) {
	    $rootUrl .= "s";
	}
	$rootUrl .= "://" . $_SERVER["SERVER_NAME"];
	if ($_SERVER["SERVER_PORT"] != "80") {
	    $rootUrl .= ":" . $_SERVER["SERVER_PORT"];
	}
	
	$rootUrl .= StringTools::replaceAll(self::getContainerPath(), $_SERVER['DOCUMENT_ROOT'], '');
	if(StringTools::right($rootUrl, 1) != '/'){
	    $rootUrl .= '/';
	}
	
	self::$containerUrl = $rootUrl;
	return self::$containerUrl;
    }


    /**
     * Retourne l'url de la page courante
     * @return string
     */
    private static function getCurrentPageUrl() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"])) {
	    $pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
	    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
    }

    /** Retourne la valeur d'une variable de configuration Jin (défini dans le fichier config.ini)
     *
     * @param string $configParam   Nom de la variable de configuration
     * @return string
     */
    public static function getConfigValue($configParam) {
	if (is_null(self::$config)) {
	    self::$config = new IniFile(self::getJinRootPath() . 'config.ini');
	    $spath = self::getContainerPath() . self::getConfigValue('surchargeAbsolutePath') . '/config.ini';
	    if (file_exists($spath) && self::$config->get('surcharge') == 1) {
		self::$config->surcharge($spath);
	    }
	}

	return self::$config->get($configParam);
    }

    /** Retourne le chemin relatif des assets Jin
     *
     * @return string   Chemin relatif
     */
    public static function getRelativePathAssets() {
	return '_assets/';
    }

    /** Retourne le chemin relatif des librairies externes
     *
     * @return string   Chemin relatif
     */
    public static function getRelativeExtLibs() {
	return '_extlibs/';
    }

    /** Retourne le chemin relatif des fichiers de langue
     *
     * @return string   Chemin relatif
     */
    public static function getRelativePathLanguage() {
	return '_languages/';
    }

}
