<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\ressources;

use jin\cache\Cache;
use jin\JinCore;
use jin\filesystem\File;

/**
 * Classe générique pour chargement de fichiers ressources. (Ne peut pas être utilisée seule)
 */
class GlobalLoader{
    /**
     *
     * @var string  Identifiant unique du pack de ressources
     */
    protected $uniqueId;
    
    /**
     *
     * @var array   Tableau des fichiers ressource
     */
    protected $ressources = array();
    
    
    /**
     * Constructeur
     * @param string $uniqueId	Identifiant unique du pack de ressources
     */
    protected function __construct($uniqueId){
	$this->uniqueId = $uniqueId;
    }
    
    
    /**
     * Ajoute une ressource
     * @param string $relativeFilePath	Chemin relatif du fichier ressource
     */
    public function addRessource($relativeFilePath){
	$this->ressources[] = $relativeFilePath;
    }
    
    
    /**
     * Retourne l'uniqueId
     * @return string
     */
    protected function getKey(){
	return $this->uniqueId;
    }
    
    
    /**
     * Retourne la clé cache utilisée
     * @return string
     */
    protected function getCacheKey(){
	return $this->uniqueId.'_ressource';
    }

    
    /**
     * Retourne le code HTML à insérer dans les balises META
     */
    protected function getHTMLLink(){
	if(!Cache::isInCache($this->getCacheKey())){
	    $this->generateContentInCache();
	}
    }
    
    
    /**
     * Affiche le contenu mis en cache du pack de ressource (sortie finale)
     */
    public function getContent(){
	$cache = Cache::getFromCacheWithDate($this->getCacheKey());
	
	//header('content-type: text/css');
	$tsstring = gmdate('D, d M Y H:i:s ', $cache['time']) . 'GMT';

	$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;

	if ($if_modified_since && $if_modified_since == $tsstring) {
	    header('HTTP/1.1 304 Not Modified');
	} else {
	    header('Last-Modified: ' . $tsstring);
	}
	
	header('Vary: Accept-Encoding');
	header('Cache-Control: max-age=' . JinCore::getConfigValue('RessourceNavigatorCacheTime'));

	echo $cache['value'];
    }
    
    
    /**
     * Ecrit du contenu en cache
     * @param string $content	Contenu
     */
    protected function saveContentInCache($content){
	Cache::saveInCache($this->getCacheKey(), $content);
    }
    
    
    /**
     * Génère le contenu à partir des fichiers ressources spécifiés
     * @return string
     */
    protected function generateContent(){
	$fcontent = '';
	foreach($this->ressources as $ressourceFile){
	    $f = new File(JinCore::getContainerPath().$ressourceFile);
	    $fcontent .= $f->getContent();
	}
	return $fcontent;
    }
   
}

