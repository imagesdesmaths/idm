<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\ressources;

use jin\output\ressources\GlobalLoader;
use jin\output\ressources\optimizer\JsMinify;
use jin\JinCore;

/** Permet l'automatisation du chargement de fichiers CSS et la gestion auto d'un Minifer et du cache.
 * @auteur  Loïc Gerard
 */
class JsLoader extends GlobalLoader{
   /**
    *
    * @var boolean Minify activé ou non
    */
    private $minify;
    
    
    /**
     * Constructeur
     * @param string $uniqueId	Identifiant unique du pack de JS (pour gestion du cache). Ne pas mettre pour deux usages différents le même identifiant.
     * @param boolean $minify	[optionel] usage ou non de la compression de données (TRUE par défaut)
     */
    public function __construct($uniqueId, $minify = true){
	$this->minify = $minify;
	parent::__construct($uniqueId);
    }
    
    
    /**
     * Retourne le code HTML à ajouter dans le HEAD
     * @return string
     */
    public function getHTMLCode(){
	parent::getHTMLLink();
	return '<script src="'.JinCore::getJinRootUrl().'_script/ressource/js.php?uid='.parent::getKey().'"></script>';
    }
    
    
    /**
     * Génère le contenu à partir des fichiers et le pousse en cache
     */
    protected function generateContentInCache(){
	$fcontent = parent::generateContent();
	if($this->minify){
	    $fcontent = JsMinify::jsminify($fcontent);
	}
	parent::saveContentInCache($fcontent);
    }
}
