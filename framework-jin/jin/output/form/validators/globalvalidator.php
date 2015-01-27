<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\form\validators;

use jin\language\Trad;

/** Classe parent de tout validateur
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class GlobalValidator{
    /**
     *
     * @var array   Liste des erreurs
     */
    private $errors = array();
    
    /**
     *
     * @var array   Paramètres
     */
    private $args = array();
    
    
    /**
     * Constructeur
     * @param array $args   Tableau d'arguments array('arg1'=>'val1','arg2'=>'val2)
     * @param array $requiredArgs   Tableau des arguments requis array('arg1','arg2')
     * @throws \Exception
     */
    protected function __construct($args, $requiredArgs) {
	foreach($requiredArgs as $a){
	    if(!isset($args[$a])){
		throw new \Exception('Argument manquant pour le validateur : '.$a);
	    }
	}
	$this->args = $args;
	
	Trad::loadTradFile('formvalidators.ini');
    }
    
    
    /**
     * Retourne la valeur d'un argument
     * @param string $argName	Nom de l'argument
     * @return string
     */
    protected function getArgValue($argName){
	return $this->args[$argName];
    }
    
    
    /**
     * Ajoute une erreur
     * @param string $errorText	Texte de l'erreur
     */
    protected function addError($errorText){
	$this->errors[] = $errorText;
    }
    
    
    /**
     * Réinitialise les erreurs
     */
    protected function resetErrors(){
	$this->errors = array();
    }
    
    
    /**
     * Retourne un tableau des erreurs rencontrées
     * @return array	Tableau d'erreurs
     */
    public function getErrors(){
	return $this->errors;
    }
    
    
    /**
     * Retourne le type de validateur
     * @return string
     */
    public function getType(){
	return 'validator';
    }
}
