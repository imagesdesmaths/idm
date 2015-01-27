<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\filesystem;

/** Lecture et analyse de fichiers .ini
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		24/04/2014
 */
class IniFile{
    
    /**	Tableau de valeurs issues de la lecture du fichier
     *
     * @var array
     */
    private $values = null;
    
    /**	Chemin d'accès absolu ou relatif au fichier INI
     *
     * @var string 
     */
    private $path;
    
    
    /**	Constructeur
     * 
     * @param string $path  Chemin absolu ou relatif du fichier
     */
    public function __construct($path) {
	$this->values = parse_ini_file($path);
	$this->path = $path;

	if(is_null($this->values) || !$this->values){
	    throw new \Exception('La lecture du fichier '.$path.' a échouée.');
	}
    }
    
    
    /**
     * Surcharge un fichier INI avec le contenu d'un autre fichier INI
     * @param type $path   Chemin absolu ou relatif du fichier
     * @throws \Exception
     */
    public function surcharge($path){
	$ndata = parse_ini_file($path);
	
	if(is_null($ndata) || !$ndata){
	    throw new \Exception('La lecture du fichier '.$path.' a échouée.');
	}
	$this->values = array_merge($this->values, $ndata);
    }
    
    
    /** Lit une valeur
     * 
     * @param string $cle	Clé
     * @param boolean $errorIfNotExists	[optionel] Génère une exception si la clé n'existe pas
     * @return null
     */
    public function get($cle, $errorIfNotExists = false) {
	if (is_null($this->values)) {
	    return null;
	} else if (array_key_exists($cle, $this->values)) {
	    return $this->values[$cle];
	} else {
	    if($errorIfNotExists){
		throw new \Exception('La clé '.$cle.' n\'existe pas dans le fichier '.$this->path);
	    }else{
		return null;
	    }
	}
    }

    
    /** Retourne toutes les clés
     * 
     * @return array	Clés définies dans le fichier .INI
     */
    public function getAllKeys() {
	if (is_array($this->values)) {
	    return array_keys($this->values);
	} else {
	    return array();
	}
    }

    /**	Retourne l'ensemble des données (clés et valeurs)
     * 
     * @return array	Tableau clé->valeur
     */
    public function getAll() {
	return $this->values;
    }
    
    
    /**	Permet de savoir si le chargement et la lecture du fichier se sont effectués correctement.
     * 
     * @return boolean	TRUE si le fichier a été chargé correctement
     */
    public function isLoaded() {
	return !is_null($this->values);
    }
}
