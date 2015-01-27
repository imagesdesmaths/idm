<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\output\components;

use jin\filesystem\AssetFile;
use jin\lang\StringTools;
use jin\lang\ArrayTools;
/** Classe parent de tout composant
 *
 *  @auteur     Loïc Gerard
 *  @version    0.0.1
 *  @check
 */
class GlobalComponent{
    /**
     *
     * @var string  Nom du composant
     */
    protected $name;


    /**
     *
     * @var string Personnalisation de la balise style
     */
    private $stylecss = '';


    /**
     *
     * @var array Classes appliquées
     */
    private $classes = array();


    /**
     *
     * @var array Attributs ajoutés
     */
    private $attributes = array();


    /**
     *
     * @var string  Nom du type de composant (Ex. InputText)
     */
    protected $componentName;


    /**
     * Constructeur
     * @param string $name  Nom du composant
     * @param string $componentName Nom du type de composant (Ex. InputText)
     */
    protected function __construct($name, $componentName) {
        $this->name = $name;
        $this->componentName = $componentName;
    }


    /**
     * Retourne le rendu de l'asset du composant
     * @return string
     */
    protected function getAsset(){
    $af = new AssetFile($this->componentName.'/html.tpl');
    return $af->getContent();
    }


    /**
     * Retourne le nom du composant
     * @return string
     */
    public function getName(){
        return $this->name;
    }


    /**
     * Définit ce qui sera affiché dans la balise style du composant
     * @param string $style Déclaration CSS
     */
    public function setStyleCSS($style){
        $this->stylecss = $style;
    }


    /**
     * Retourne ce qui est affiché dans la balise style du composant
     */
    public function getStyleCSS(){
        return $this->stylecss;
    }


    /**
     * Applique une nouvelle classe CSS
     * @param string $className Nom de la classe à appliquer
     * @return boolean  Retourne FALSE si cette classe était déjà appliquée
     */
    public function addClass($className){
        if(!is_numeric(ArrayTools::find($this->classes, $className))){
            $this->classes[] = $className;
            return true;
        }
        return false;
    }


    /**
     * Supprime une classe CSS appliquée
     * @param string $className Nom de la classe à supprimer
     * @return boolean  Retourne FALSE si cette classe n'était pas appliquée
     */
    public function removeClass($className){
        $pos = ArrayTools::find($this->classes, $className);
        if(is_numeric($pos)){
            $this->classes = ArrayTools::deleteAt($this->classes, $pos);
            return true;
        }
        return false;
    }


    /**
     * Retourne un tableau des classes CSS appliquées
     * @return array
     */
    public function getClasses(){
        return $this->classes;
    }


    /**
     * Ajoute un nouvel attribut
     * @param string $attributeName  Nom de l'attribut
     * @param string $attributeValue Value de l'attribut
     * @return boolean               Retourne FALSE si cet atribut était déjà ajouté
     */
    public function addAttribute($attributeName, $attributeValue){
        if(!ArrayTools::isKeyExists($this->attributes, $attributeName)){
            $this->attributes[$attributeName] = $attributeValue;
            return true;
        }
        return false;
    }


    /**
     * Supprime un attribut ajouté
     * @param string $attributeName Nom de l'attribut
     * @return boolean              Retourne FALSE si cet attribut n'était pas ajouté
     */
    public function removeAttribute($attributeName){
        if(isset($this->attributes[$attributeName])){
            unset($this->attributes[$attributeName]);
            return true;
        }
        return false;
    }


    /**
     * Retourne un tableau des attributs ajoutés
     * @return array
     */
    public function getAttributes(){
        return $this->attributes;
    }


    /**
     * Rendu par défaut d'un composant(prise en compte de %name%, %style% et %class%)
     * @return  string
     */
    protected function render(){
    return $this->replaceMagicFields($this->getAsset());
    }


    /**
     * Remplace les champs magiques des assets - concernant uniquement les champs magiques des composants globaux
     * @param string $html  HTML à inspeter
     * @return string
     */
    protected function replaceMagicFields($html){
    $html = StringTools::replaceAll($html, '%name%', $this->getName());
    $html = StringTools::replaceAll($html, '%style%', $this->getStyleCSS());
    $html = StringTools::replaceAll($html, '%class%', ArrayTools::toList($this->classes, ' '));

    $strAttributes = '';
    foreach ($this->attributes as $key => $value) {
        $strAttributes .= ' ' . $key . '="' . $value . '"';
    }
    $html = StringTools::replaceAll($html, '%attributes%', $strAttributes);
    return $html;
    }
}

