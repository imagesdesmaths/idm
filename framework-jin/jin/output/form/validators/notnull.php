<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\form\validators;

use jin\output\form\validators\ValidatorInterface;
use jin\output\form\validators\GlobalValidator;
use jin\language\Trad;

/** Validateur : teste si une valeur n'est pas nulle
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Notnull extends GlobalValidator implements ValidatorInterface{
    /**
     * Constructeur
     * @param type $args    Tableau d'arguments. (Aucun argument requis)
     */
    public function __construct($args) {
	parent::__construct($args, array());
    }
    
    
     /**
     * Teste la validité
     * @param mixed $valeur Valeur à tester
     * @return boolean
     */
    public function isValid($valeur){
	
	parent::resetErrors();
	if($valeur == '' || is_null($valeur)){
	    parent::addError(Trad::trad('notnull'));
	    return false;
	}
	return true;
    }
    
    
    /**
     * Priorité NIV1 du validateur
     * @return boolean
     */
    public function isPrior(){
	return true;
    }
}

