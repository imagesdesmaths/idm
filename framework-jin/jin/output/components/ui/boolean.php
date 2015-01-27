<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\components\ui;

use jin\output\components\ui\UIComponent;
use jin\output\components\ComponentInterface;
use jin\filesystem\AssetFile;
use jin\lang\StringTools;
use jin\log\Debug;

/** Composant UI Boolean. Affiche une valeur booléenne.
 * 	@auteur		Loïc Gerard	
 */
class Boolean extends UIComponent implements ComponentInterface{
    /**
     *
     * @var boolean Valeur
     */
    private $value;
    
    
    /**
     * Constructeur
     * @param string $name  Nom du composant
     */
    public function __construct($name){
	parent::__construct($name, 'ui_boolean');
    }
    
    
    /**
     * Effectue le rendu du composant
     * @return string
     */
    public function render(){
	$html = parent::render();
	
	if(is_null($this->value)){
	    $html = StringTools::replaceAll($html, '%value%', '');
	}else if($this->value){
	    $true = new AssetFile($this->componentName.'/true.tpl');
	    $true_content = $true->getContent();
	    $html = StringTools::replaceAll($html, '%value%', $true_content);
	}else{
	    $false = new AssetFile($this->componentName.'/false.tpl');
	    $false_content = $false->getContent();
	    $html = StringTools::replaceAll($html, '%value%', $false_content);
	}
	return $html;
	$tbody_content = StringTools::replaceAll($tbody_content, '%class%', $this->tbody_classes);

	return $html;
    }
    
    
    /**
     * Retourne la valeur courante
     * @return boolean
     */
    public function getValue(){
	return $this->value;
    }
    
    
    /**
     * Définit la valeur du composant
     * @param mixed $value  Valeur (boolean ou 1|0)
     * @throws \Exception
     */
    public function setValue($value){
	if(is_null($value)){
	    $this->value = null;
	}else if(is_bool($value)){
	    $this->value = $value;
	}else if(is_numeric($value)){
	    if($value == 0){
		$this->value = false;
	    }else{
		$this->value = true;
	    }
	}else if($value == ''){
	    $this->value = null;
	}else{
	    throw new \Exception('Valeur '.$value.' non appliquable a un UIComponent de type Boolean');
	}
    }
}

