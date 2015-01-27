<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\form\validators\file;

use jin\output\form\validators\GlobalValidator;

/** Classe parent de tout filevalidator
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class GlobalFileValidator extends GlobalValidator{

    /**
     * Retourne le type de validateur
     * @return string
     */
    public function getType(){
	return 'filevalidator';
    }
}

