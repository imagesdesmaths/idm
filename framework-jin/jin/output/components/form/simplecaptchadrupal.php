<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\components\form;

use jin\output\components\form\FormComponent;
use jin\output\components\ComponentInterface;
use jin\language\Trad;
use jin\lang\StringTools;

/** Composant SimpleCaptcha (pour une utilisation sur Drupal) (Captcha se basant sur la librairie SecureImage PHP)
 *
 * 	@auteur		Loïc Gerard
 */
class SimpleCaptchaDrupal extends FormComponent implements ComponentInterface{

    /**
     * Constructeur
     * @param string $name  Nom du composant
     */
    public function __construct($name) {
	parent::__construct($name, 'simplecaptchadrupal');
    }
    
    
    /**
     * Rendu du composant
     * @return type
     */
    public function render(){
	$html = parent::render();
	$html = StringTools::replaceAll($html, '%txtchangecaptcha%',  Trad::trad('simplecaptcha_change'));
	
	return $html;
    }
}
