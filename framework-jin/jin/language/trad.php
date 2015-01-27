<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\language;

use jin\JinCore;
use jin\log\Debug;
use jin\lang\ArrayTools;

/** Classe permettant la gestion de traductions d'items
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Trad {
    /**
     *
     * @var string  Code de la langue active (fr par défaut)
     */
    private static $langueCode = 'fr';
    
    
    /**
     *
     * @var array   Traductions
     */
    private static $trads = array();
    
    
    /**
     *
     * @var array   Fichiers chargés 
     */
    private static $files = array();

    
    /**
     * Définit un autre code de langue (provoque le rechargement des fichiers déjà chargés)
     * @param string $languageCode  Code langue
     */
    public static function setLanguageCode($languageCode) {
	self::$langueCode = $languageCode;
	self::$trads = array();
	foreach(self::$files as $f){
	    self::loadTradFileInMemory($f);
	}
    }

    
    /**
     * Retourne le code langue courant
     * @return string
     */
    public static function getLanguageCode() {
	return self::$langueCode;
    }

    
    /**
     * Charge un nouveau fichier de langue. Ce fichier doit se trouver dans un répertoire au nom du codelangue dans  le repertoire _languages de jin ou du dossier de surcharge. ex. _languages/fr/monfichier.ini
     * @param string $fileName	Nom du fichier INI à charger (sans les répertoires devant) ex. monfichier.ini
     * @return boolean	TRUE si succès
     */
    public static function loadTradFile($fileName) {
	if(!self::isFileLoaded($fileName)){
	    self::$files[] = $fileName;
	    return self::loadTradFileInMemory($fileName);
	}
	return false;
    }
    
    
    /**
     * Permet de savoir si un fichier est déjà requis
     * @param string $fileName	Nom du fichier INI à charger (sans les répertoires devant) ex. monfichier.ini
     * @return boolean	TRUE si succès
     */
    public static function isFileLoaded($fileName){
	if(is_numeric(ArrayTools::find(self::$files, $fileName))){
	    return true;
	}else{
	    return false;
	}
    }
    
    
    /**
     * Charge un nouveau fichier en mémoire (avec le code langue courant)
     * @param type $fileName	Nom du fichier INI à charger (sans les répertoires devant) ex. monfichier.ini
     * @return boolean	TRUE si succès
     */
    private static function loadTradFileInMemory($fileName){
	$surcharge = JinCore::getContainerPath() . JinCore::getConfigValue('surchargeAbsolutePath') . '/' . JinCore::getRelativePathLanguage() . self::$langueCode . '/' . $fileName;

	if(JinCore::getConfigValue('surcharge') && file_exists($surcharge)){
	    $data = parse_ini_file($surcharge);
	}else{
	    $data = parse_ini_file(JinCore::getJinRootPath() . JinCore::getRelativePathLanguage() . self::$langueCode . '/' . $fileName);
	}

	if ($data) {
	    self::$trads = array_merge(self::$trads, $data);
	    return true;
	}

	return false;
    }

    
    /**
     * Renvoie la traduction d'un item défini, pour le code langue courant
     * @param string $code  Code de l'item
     * @return mixed
     */
    public static function trad($code) {

	if (array_key_exists($code, self::$trads)) {
	    return self::$trads[$code];
	}
	return '[' . $code . ']';
    }
}
