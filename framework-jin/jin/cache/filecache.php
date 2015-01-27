<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\cache;

use \DateTime;
use jin\cache\CacheInterface;
use jin\lang\StringTools;
use jin\JinCore;
use jin\filesystem\Folder;

/** Gestion du cache via le système de fichiers
 *
 * 	@auteur		Loïc Gerard
 */
class FileCache implements CacheInterface {

    /**
     * 	Constructeur
     * 	@return void
     */
    public function __construct() {
	
    }

    /**
     * 	Permet de savoir si une clé donnée est définie dans le cache
     * 	@param 	String	$key		Clé à rechercher
     * 	@return boolean			TRUE si définie dans le cache
     */
    public function isInCache($key) {
	$key = $this->getEncodedKey($key);
	$cachePath = JinCore::getContainerPath() . JinCore::getConfigValue('cacheFileFolder') . $key;
	
	if (file_exists($cachePath)) {
	    return true;
	} else {
	    return false;
	}
    }

    /**
     * 	Permet de retourner une valeur du cache à partir de sa clé.
     * 	@param 	String	$key		Clé à rechercher
     * 	@return	mixed			Valeur trouvée ou NULL si aucune valeur n'est trouvée
     */
    public function getFromCache($key) {
	$key = $this->getEncodedKey($key);

	$cachePath = JinCore::getContainerPath() . JinCore::getConfigValue('cacheFileFolder') . $key;
	if (file_exists($cachePath)) {
	    return unserialize(file_get_contents($cachePath));
	} else {
	    return NULL;
	}
    }

    /**
     * 	Supprime une valeur du cache
     * 	@param 	String	$key		Clé à supprimer
     * 	@return	void
     */
    public function deleteFromCache($key) {
	$key = $this->getEncodedKey($key);
	$cachePath = JinCore::getContainerPath() . JinCore::getConfigValue('cacheFileFolder') . $key;
	if (file_exists($cachePath)) {
	    unlink($cachePath);
	}
    }

    /**
     * 	Sauvegarde une valeur dans le cache
     * 	@param	String	$key		Clé à sauvegarder
     * 	@param 	mixed	$value	Valeur à sauvegarder
     * 	@return	void
     */
    public function saveInCache($key, $value) {
	$key = $this->getEncodedKey($key);
	$this->deleteFromCache($key);
	
	$cachePath = JinCore::getContainerPath() . JinCore::getConfigValue('cacheFileFolder') . $key;
	file_put_contents($cachePath, serialize($value), LOCK_EX);
    }

    /**
     * 	Supprime tout le contenu du cache
     * 	@return	void
     */
    public function clearCache() {
	$cacheFolder = JinCore::getContainerPath() . JinCore::getConfigValue('cacheFileFolder');
	$folder = new Folder($cacheFolder);
	foreach($folder as $f){
	    $fullPath = $cacheFolder.$f;
	    if(is_file($fullPath)){
		unlink($fullPath);
	    }
	}
	
	
    }

    /**
     * 	Retourne une clé encodée à partir d'une clé en clair
     * 	@param	String 	$key		Clé à encoder
     * 	@return string			Clé encodée
     */
    private function getEncodedKey($key) {
	return StringTools::hashCode($key);
    }

}
