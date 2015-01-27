<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\form\validators\file;

use jin\output\form\validators\ValidatorInterface;
use jin\output\form\validators\file\GlobalFileValidator;
use jin\language\Trad;
use jin\lang\ListTools;
use jin\lang\StringTools;
use jin\lang\NumberTools;

/** Validateur : teste si le fichier est renseigné
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Notnull extends GlobalFileValidator implements ValidatorInterface{
    /**
     * Constructeur
     * @param type $args    Tableau d'arguments. (Aucun argument requis))
     */
    public function __construct($args) {
	parent::__construct($args, array());
    }
    
    
    /**
     * Teste la validité
     * @param array $valeur Valeur $_FILES à tester
     * @return boolean
     */
    public function isValid($valeur){
	parent::resetErrors();
	
	if($valeur['name'] == ''){
	    parent::addError(Trad::trad('filenotnull'));
	    
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

