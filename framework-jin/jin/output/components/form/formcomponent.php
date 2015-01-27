<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\components\form;

use jin\output\components\GlobalComponent;
use jin\lang\StringTools;
use jin\language\Trad;

/** Classe parent de tout composant de type FORM (destinés à être utilisés avec des balises FORM)
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class FormComponent extends GlobalComponent{
    /**
     *
     * @var string Texte d'erreur affiché
     */
    private $error = '';
    
    /**
     *
     * @var string classe d'erreur affiché
     */
    private $errorclass = 'error';  
    
    /**
     *
     * @var string|array  Valeur actuelle. Tableau de données pour les composants pouvant supporter plusieurs valeurs. (Ex. COMBO)
     */
    private $value = null;
    
    /**
     *
     * @var string|array  Valeur par défaut. Tableau de données pour les composants pouvant supporter plusieurs valeurs. (Ex. COMBO)
     */
    private $defaultvalue = null;
    
    /**
     *
     * @var string  Label affiché
     */
    private $label = '';
    
    
    /**
     * Constructeur
     * @param string $name  Nom du composant
     * @param string $componentName Type de composant (ex. InputText)
     */
    protected function __construct($name, $componentName) {
	parent::__construct($name, $componentName);
	$this->label = $name;
	
	Trad::loadTradFile('formcomponents.ini');
    }
    
    
    /**
     * Définit l'erreur affichée
     * @param string $error   Texte de l'erreur
     */
    public function setError($error){
	$this->error = $error;
    }

    /**
     * Définit l'erreur affichée
     * @param string $errorclass class de l'erreur
     */
    public function setErrorClass($errorclass){
	$this->errorclass = $errorclass;
    }  
    
    
    
    /**
     * Retourne l'erreur affichée
     * @return string
     */
    public function getError(){
	return $this->error;
    }
    
     /**
     * Retourne la classe d'erreur  affichée
     * @return string
     */
    public function getErrorClass(){
	return $this->errorclass;
    }   
    
    /**
     * Définit la valeur actuelle
     * @param string $value Valeur actuelle
     */
    public function setValue($value){
	$this->value = $value;
    }
    
    
    /**
     * Retourne la valeur actuelle
     * @return string
     */
    public function getValue(){
	return $this->value;
    }
    
    
     /**
     * Définit la valeur par défaut
     * @param string $value Valeur actuelle
     */
    public function setDefaultValue($value){
	$this->defaultvalue = $value;
    }
    
    
    /**
     * Retourne la valeur  par défaut
     * @return string
     */
    public function getDefaultValue(){
	return $this->defaultvalue;
    }
    
    
    /**
     * Définit la valeur du label
     * @param string $label Valeur du label
     */
    public function setLabel($label){
	$this->label = $label;
    }
    
    
    /**
     * Retourne la valeur du label
     * @return string
     */
    public function getLabel(){
	return $this->label;
    }
    
    
    /**
     * Rendu par défaut du composant de type FORM (prise en compte de %label% %value% %error% %style%)
     * @return	string
     */
    protected function render(){
	$html = parent::render();
	return $this->replaceMagicFields($html);
    }
    
    
    /**
     * Remplace les champs magiques des assets - concernant uniquement les champs magiques des composants de type FORM
     * @param string $html  HTML à inspeter
     * @return string
     */
    protected function replaceMagicFields($html){
	$html = parent::replaceMagicFields($html);
	$html = StringTools::replaceAll($html, '%label%', $this->getLabel());
	if(!is_array($this->getValue())){
	    $html = StringTools::replaceAll($html, '%value%', $this->getValue());
	}
	if(!is_array($this->getDefaultValue())){
	    $html = StringTools::replaceAll($html, '%defaultvalue%', $this->getDefaultValue());
	}
	$html = StringTools::replaceAll($html, '%error%', $this->getError());
	return $html;
    }
}