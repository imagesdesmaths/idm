<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\form\validators;

use jin\output\form\validators\ValidatorInterface;
use jin\output\form\validators\GlobalValidator;
use jin\language\Trad;
use jin\lang\StringTools;

/** Validateur : teste si une valeur est un format de date valide
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Isdate extends GlobalValidator implements ValidatorInterface{
    /**
     * Constructeur
     * @param type $args    Tableau d'arguments. (argument format requis : donne le format de date attendu. Ex : d/m/Y)
     */
    public function __construct($args) {
	parent::__construct($args, array('format'));
    }
    
    /**
     * Teste la validité
     * @param mixed $valeur Valeur à tester
     * @return boolean
     */
    public function isValid($valeur){
	parent::resetErrors();
	
	$format = $this->getArgValue('format');
	$d = \DateTime::createFromFormat($format, $valeur);
	$res =  $d && $d->format($format) == $valeur;
	
	if(!$res){
	    $eMsg = Trad::trad('isdate');
	    $eMsg = StringTools::replaceAll($eMsg, '%format%', parent::getArgValue('format'));
	    parent::addError($eMsg);
	}
	return $res;
    }
    
    
    /**
     * Priorité NIV1 du validateur
     * @return boolean
     */
    public function isPrior(){
	return false;
    }
}

