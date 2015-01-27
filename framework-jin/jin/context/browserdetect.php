<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\context;

use jin\log\Debug;
use jin\JinCore;

/** Classe permettant la détection du navigateur et de ses capacités (basé sur Browser : https://github.com/cbschuld/Browser.php)
 *
 * 	@auteur		Loïc Gerard
 */
class BrowserDetect {

    /**
     * Instance de Browser; 
     * @var Browser
     */
    private static $browserData;
    
   

    /**	Retourne une chaîne identifiant le navigateur/plate-forme client
     * 
     * @return string	chaîne d'identification
     */
    public static function getUserAgent(){
	if (is_null(self::$browserData)) {
	    self::detectBrowser();
	}

	return self::$browserData->getUserAgent();
    }
    
    
    /**	Retourne le nom du navigateur
     * 
     * @return string	Nom du navigateur
     */
    public static function getBrowser() {
	if (is_null(self::$browserData)) {
	    self::detectBrowser();
	}

	return self::$browserData->getBrowser();
    }

    
    /**	Retourne la version du navigateur
     * 
     * @return string	Version du navigateur
     */
    public static function getBrowserVersion() {
	if (is_null(self::$browserData)) {
	    self::detectBrowser();
	}

	return self::$browserData->getVersion();
    }

    
    /**	Retourne le nom de l'OS utilisé
     * 
     * @return string	Nom de l'OS utilisé
     */
    public static function getPlateformName() {
	if (is_null(self::$browserData)) {
	    self::detectBrowser();
	}

	return self::$browserData->getPlatform();
    }

    
    /**
     * Permet de savoir si il s'agit d'un robot
     * @return boolean TRUE si il s'agit d'un robot
     */
    public static function isCrawler(){
	if (is_null(self::$browserData)) {
	    self::detectBrowser();
	}
	
	return self::$browserData->isRobot();
    }

    
    /**	Permet la détection du navigateur
     * 
     */
    private static function detectBrowser() {
	require_once(JinCore::getJinRootPath() . '_extlibs/browser/Browser.php');
	self::$browserData = new \Browser();
    }

}
