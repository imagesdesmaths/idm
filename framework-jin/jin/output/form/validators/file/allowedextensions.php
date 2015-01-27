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

/** Validateur : teste si le fichier est de types précisés
 *
 *  @auteur     Loïc Gerard
 *  @version    0.0.1
 *  @check
 */
class Allowedextensions extends GlobalFileValidator implements ValidatorInterface{
    /**
     * Constructeur
     * @param type $args    Tableau d'arguments. extensionList (Liste d'extensions supportées. ex: jpg,csv)
     */
    public function __construct($args) {
        parent::__construct($args, array('extensionList'));
    }

    /**
     * Teste la validité
     * @param array $valeur Valeur $_FILES à tester
     * @return boolean
     */
    public function isValid($valeur){
        parent::resetErrors();

        $currentExt = ListTools::last($valeur['name'], '.');
        if($currentExt && !ListTools::containsNoCase(parent::getArgValue('extensionList'), $currentExt)){
            $eMsg = Trad::trad('allowedextensions');
            parent::addError(StringTools::replaceAll($eMsg, '%extensionList%', parent::getArgValue('extensionList')));
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

