<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\components\ui;

use jin\output\components\GlobalComponent;
use jin\lang\StringTools;
use jin\language\Trad;

/** Classe parent de tout composant de type INTERFACE
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class UIComponent extends GlobalComponent {

    /**
     * Constructeur
     * @param string $name  Nom du composant
     * @param string $componentName Type de composant (ex. InputText)
     */
    protected function __construct($name, $componentName) {
	parent::__construct($name, $componentName);
	$this->label = $name;
	
	Trad::loadTradFile('uicomponents.ini');
    }
    

    /**
     * Rendu par défaut du composant de type UI 
     * @return	string
     */
    protected function render() {
	$html = parent::render();
	return $this->replaceMagicFields($html);
    }
    

    /**
     * Remplace les champs magiques des assets - concernant uniquement les champs magiques des composants de type FORM
     * @param string $html  HTML à inspeter
     * @return string
     */
    protected function replaceMagicFields($html) {
	$html = parent::replaceMagicFields($html);

	return $html;
    }

}
