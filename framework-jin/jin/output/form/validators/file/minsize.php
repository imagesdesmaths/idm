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

/** Validateur : teste si le fichier a une taille (en octets) minimum
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Minsize extends GlobalFileValidator implements ValidatorInterface{
    /**
     * Constructeur
     * @param type $args    Tableau d'arguments. minsize (LTaille minimale (en octets))
     */
    public function __construct($args) {
	parent::__construct($args, array('minsize'));
    }
    
    /**
     * Teste la validité
     * @param array $valeur Valeur $_FILES à tester
     * @return boolean
     */
    public function isValid($valeur){
	parent::resetErrors();
	
	if($valeur['size'] <  parent::getArgValue('minsize')){
	     $eMsg = Trad::trad('minsize');
	     
	     $o = parent::getArgValue('minsize');
	     $ko = parent::getArgValue('minsize')/1024;
	     $mo = parent::getArgValue('minsize')/1024/1024;
	     
	     $msize = $o.' octets';
	     if($mo > 1){
		 $msize = NumberTools::numberFormat($mo, 2).' mo';
	     }else if($ko > 1){
		 $msize = NumberTools::numberFormat($ko, 2).' ko';
	     }
	     
	     $eMsg = StringTools::replaceAll($eMsg, '%minsize%', $msize);
	     parent::addError($eMsg);
	     
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

