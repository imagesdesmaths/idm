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
use jin\output\form\validators\Isdate;

/** Validateur : teste si une valeur est une date strictement supérieure à une date donnée
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Isdateinferior extends GlobalValidator implements ValidatorInterface{
    /**
     * Constructeur
     * @param type $args    Tableau d'arguments. (argument format requis : donne le format de date attendu. Ex : d/m/Y, argument date requis : donne la date à tester)
     */
    public function __construct($args) {
	parent::__construct($args, array('format','date'));
    }
    
    /**
     * Teste la validité
     * @param mixed $valeur Valeur à tester
     * @return boolean
     */
    public function isValid($valeur){
	parent::resetErrors();
	
	$format = $this->getArgValue('format');
	$dValidator = new Isdate(array('format' => $format));
	
	if(!$dValidator->isValid($valeur)){
	    $eMsg = Trad::trad('isdateinferior');
	    $eMsg = StringTools::replaceAll($eMsg, '%date%', parent::getArgValue('date'));
	    parent::addError($eMsg);
	}else{
	    $d1 = \DateTime::createFromFormat($format, $valeur);
	    $d2 = \DateTime::createFromFormat($format, $this->getArgValue('date'));
	    $d1t = $d1->format('U');
	    $d2t = $d2->format('U');
	    $difference = $d1t - $d2t;
	    
	    if($difference > 0){
		$eMsg = Trad::trad('isdateinferior');
		$eMsg = StringTools::replaceAll($eMsg, '%date%', parent::getArgValue('date'));
		parent::addError($eMsg);
		return false;
	    }
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

