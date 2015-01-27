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
use \DateTime;

/** Composant UI Date. Affiche une valeur de type Date
 * 	@auteur		Loïc Gerard	
 */
class Date extends UIComponent implements ComponentInterface{
    /**
     *
     * @var DateTime Objet DateTime représentant la valeur
     */
    private $value;
    
    
    /**
     * Constructeur
     * @param string $name  Nom du composant
     */
    public function __construct($name){
	parent::__construct($name, 'ui_date');
    }
    
    
    /**
     * Effectue le rendu du composant
     * @return string
     */
    public function render(){
	$html = parent::render();
	$html = StringTools::replaceAll($html, '%value%', $this->getValue());
	
	return $html;
    }
    
    
    /**
     * Retourne la valeur courante au format String
     * @param type $format  [optionel] Format de date en sortie. (Par défaut d/m/Y)
     * @return string
     */
    public function getValue($format = 'd/m/Y'){
	return $this->value->format($format);
    }
    
    
   /**
    * Définit la valeur courante au format String
    * @param string $value  Date sous une chaine libre
    */
    public function setValue($value){
	$this->value = new DateTime($value);
    }
    
    
    /**
     * Définit la valeur courante
     * @param \DateTime $dt Objet DateTime
     */
    public function setDateTimeValue(\DateTime $dt){
	$this->value = $dt;
    }
    
    
    /**
     * Retourne la valeur au format DateTime
     * @return \DateTime
     */
    public function getDateTimeValue(){
	return $this->value;
    }
}

