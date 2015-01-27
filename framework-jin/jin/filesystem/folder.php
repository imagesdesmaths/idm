<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\filesystem;

use \Exception;
use \Iterator;
use jin\lang\StringTools;

/** Permet le parcours des fichiers d'un répertoire. Initialiser l'objet, puis le parcourir avec un foreach($objet AS $fichier){ }
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Folder implements Iterator {

    /**
     * @var string Chemin relatif d'accès au dossier à parcourir
     */
    private $folderPath;
    
    /**
     *
     * @var array Tableau des fichiers/dossiers
     */
    private $files = array();
    
    /**
     *
     * @var string  Extensions à privilégier
     */
    private $extensions = '';

    
    /**	Constructeur.  Initialiser l'objet, puis le parcourir avec un foreach($objet AS $fichier){ }
     * 
     * @param string	$folderPath	Chemin relatif du dossier que l'on souhaite parcourir
     * @param string	$extensions	Extensions souhaitées, séparées par des virgules. (Par défaut liste tous les fichiers et dossiers)
     * @throws Exception
     */
    public function __construct($folderPath, $extensions = '') {
	$this->folderPath = $folderPath;
	$this->extensions = $extensions;

	if (!is_dir($this->folderPath)) {
	    throw new Exception('Le dossier ' . $this->folderPath . ' n\'existe pas');
	}

	$this->buildData();
    }

    
    /**	Préconstruit les données à partir des données transmises au constructeur
     * 
     */
    private function buildData() {
	$handle = opendir($this->folderPath);
	while (false !== ($file = readdir($handle))) {
	    $vext = StringTools::replaceAll(StringTools::toLowerCase($this->extensions), ',', '|');
	    if (
		    !is_dir($file) && $file != '.' && $file != '..' && ($this->extensions == '' || preg_match("/\.(" . $vext . ")$/", $file))
	    ) {
		$this->files[] = $file;
	    }
	}
    }

    
    /**	Fonction d'itération : CURRENT
     * 
     * @return array
     */
    public function current() {
	return current($this->files);
    }

    
    /** Fonction d'itération : KEY
     * 
     * @return string
     */
    public function key() {
	return key($this->files);
    }

    
    /**	Fonction d'itération : REWIND
     * 
     * @return \jin\filesystem\Folder
     */
    public function rewind() {
	reset($this->files);
	return $this;
    }

    
    /** Fonction d'itération : NEXT
     * 
     */
    public function next() {
	next($this->files);
    }

    
    /** Fonction d'itération : VALID
     * 
     * @return boolean
     */
    public function valid() {
	return array_key_exists(key($this->files), $this->files);
    }

}
