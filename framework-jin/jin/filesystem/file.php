<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\filesystem;

use jin\lang\StringTools;
use jin\lang\ArrayTools;
use jin\log\Debug;

/** Lecture écriture d'un fichier
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		22/04/2014
 */
class File {

    /**
     * Contenu du fichier
     * 	@var string
     */
    private $fileContent;

    
    /**
     * 	Contenu du fichier, ligne par ligne
     * 	@var array
     */
    private $fileLines;

    
    /**
     * 	Chemin absolu de la ressource
     * 	@var string
     */
    private $path;

    
    /**
     * 	Extension
     * 	@var string
     */
    private $extension;

    
    /**
     * 	Constructeur
     * 
     * 	@param string		$path			Chemin absolu de la ressource
     * 	@param boolean		$createIfNotExists 	[optionel] Le système doit créer la ressource si elle n'existe pas.(Dans les autres cas une erreur est relevée si on essaie de lire/écrire un fichier qui n'existe pas)
     * 	@throws \Exception
     * 	@return	void
     */
    public function __construct($path, $createIfNotExists = false) {

	//Affectation
	$this->path = $path;

	//Définition de l'extension
	$nma = StringTools::explode($path, '.');
	$this->extension = StringTools::toLowerCase($nma[count($nma) - 1]);


	if (is_dir($path)) {
	    throw new \Exception('Impossible d\'ouvrir le fichier ' . $path . ' : il s\'agit d\'un répertoire');
	} else if (!file_exists($path) && $createIfNotExists) {
	    $succes = touch($this->path);
	    if (!$succes) {
		throw new \Exception('Impossible d\'écrire dans le fichier ' . $this->path . ' : Vérifier les droits d\'accès');
	    }
	    $this->fileContent = '';
	} else if (!file_exists($path) && !$createIfNotExists) {
	    throw new \Exception('Impossible d\'ouvrir le fichier ' . $path . ' : celui-ci n\'existe pas.');
	}
    }

    
    /**
     * 	Lit le contenu du fichier
     * 
     * 	@return void
     */
    private function readContent() {
	$this->fileContent = file_get_contents($this->path);
    }

    
    /** Lit les lignes du contenu du fichier
     * 
     * 	@return void
     */
    private function readLines() {
	$this->fileLines = file($this->path);
    }

    
    /** Retourne l'extension du fichier
     * 
     * 	@return string	Extension du fichier
     */
    public function getExtension() {
	return $this->extension;
    }

    
    /** Retourne le contenu du fichier
     * 
     * 	@return	string Contenu du fichier
     */
    public function getContent() {
	if (is_null($this->fileContent)) {
	    $this->readContent();
	}
	return $this->fileContent;
    }
    
    
    public function getBinaryContent(){
	$ret = fopen($this->path, 'r', true);
	return base64_encode(stream_get_contents($ret));
    }

    
    /** Retourne les lignes définies du fichier
     * 
     * 	@param integer $start		[optionel] Ligne de début [0 par défaut]
     * 	@param integer $nb		[optionel] Nombre de lignes à retourner. Si -1 : jusqu'à la fin du fichier. [-1 par défaut]
     * 	@param boolean $errorIfEnd	[optionel] Génère une erreur si les paramètres transmis ne sont pas compatibles avec le fichier. [TRUE par défaut]
     * 	@throws \Exception
     * 	@return	array	Lignes du fichier correspondant aux paramètres définis
     */
    public function getLines($start = 0, $nb = -1, $errorIfEnd = true) {
	//On récupère les lignes du fichier
	if (is_null($this->fileLines)) {
	    $this->readLines();
	}

	//On calcule le nombre de lignes
	$nbLines = count($this->fileLines);

	//On détermine le nombre de lignes à récupérer si $nb = -1
	if ($nb == -1) {
	    $nb = $nbLines - $start - 1;
	}

	//Erreur si le fichier ne contient pas assez de ligne pour atteindre e début de sélection
	if ($nbLines < $start) {
	    throw new \Exception('Le fichier ' . $this->path . ' contient ' . $nbLines . ' lignes. Impossible d\'accéder à la ligne ' . $start);
	}

	//Erreur si le fichier ne contient pas assez de ligne pour atteindre la fin de sélection
	if ($nbLines < $start + $nb) {
	    if ($errorIfEnd) {
		throw new \Exception('Le fichier ' . $this->path . ' contient ' . $nbLines . ' lignes. Impossible d\'accéder à la ligne ' . $start + $nb);
	    } else {
		$nb = $nbLines - $start;
	    }
	}

	return array_slice($this->fileLines, $start, $nb);
    }

    
    /** Retourne le chemin absolu du fichier
     * 
     * 	@return	string Chemin absolu
     */
    public function getFilePath() {
	return $this->path;
    }

    
    /** Ecriture dans le fichier
     * 
     * 	@param	string	$content	Contenu à écrire
     * 	@param 	boolean $append		Ajouter le contenu au fichier existant
     * 	@return	void;
     */
    public function write($content, $append = false) {
	if (!$append) {
	    //On réécrit tout le contenu
	    $succes = file_put_contents($this->path, $content, LOCK_EX);
	    if (!$succes) {
		throw new \Exception('Impossible d\'écrire dans le fichier ' . $this->path . ' : Vérifier les droits d\'accès');
	    }
	} else {
	    //On ajoute juste une nouvelle ligne
	    $succes = file_put_contents($this->path, $content, FILE_APPEND | LOCK_EX);
	    if (!$succes) {
		throw new \Exception('Impossible d\'écrire dans le fichier ' . $this->path . ' : Vérifier les droits d\'accès');
	    }
	}
    }

    
    /** Modifier le groupe propriétaire
     * 
     * 	@param	string 	$groupe	    Groupe propriétaire (example root)
     * 	@return	void
     */
    public function changeGroupe($groupe) {
	chgrp($this->path, $groupe);
    }

    
    /** Modifier le propriétaire (opération CHOWN)
     * 
     * 	@param	string	$owner	Propriétaire (example root)
     * 	@return void
     */
    public function changeOwner($owner) {
	chown($this->path, $owner);
    }

    
    /** Modifier les permissions (opération CHMOD)
     * 
     * 	@param	numeric $chmod	Permissions (Example 777)
     * 	@return	void
     */
    public function changePermissions($chmod) {
	chmod($this->path, $chmod);
    }

    
    /** Supprimer le fichier
     * 
     * 	@return	boolean	Succès/échec de l'opération
     */
    public function delete() {
	return unlink($this->path);
    }
    
    
    /**
     * Retourne le nom du fichier
     * @return string
     */
    public function getFileName(){
	$d = StringTools::explode($this->path, '/');
	return $d[ArrayTools::length($d)-1];
    }
    
    
    /**
     * Déplace le fichier dans un autre répertoire
     * @param string $path  Dossier de destination (absolu ou relatif)
     */
    public function move($path) {
	rename($this->path , $path.$this->getFileName());
    }

    
    /**     Retourne un saut de ligne
     * 
     *      @return string  Saut de ligne
     */
    public static function getCarriageReturn() {
	return "\r";
    }

}
