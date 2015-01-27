<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\form\validators;

use jin\output\form\validators\ValidatorInterface;
use jin\output\form\validators\GlobalValidator;
use jin\language\Trad;

/** Validateur : teste si une valeur est numérique
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Isnumeric extends GlobalValidator implements ValidatorInterface{
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
	if(!is_numeric($valeur)){
	    parent::addError(Trad::trad('isnumeric'));
	    return false;
	}
	return true;
    }
    
    
    /**
     * Priorité NIV1 du validateur
     * @return boolean
     */
    public function isPrior(){
	return false;
    }
}

