<?php
    /**
    * Jin Framework
    * Diatem
    */
    namespace jin\output\components\form;

    use jin\output\components\form\FormComponent;
    use jin\output\components\ComponentInterface;
    use jin\filesystem\AssetFile;
    use jin\lang\StringTools;


    /** Composant Select
    *
    *  @auteur     Loïc Gerard
    *  @version    0.0.1
    *  @check
    */
    class Select extends FormComponent implements ComponentInterface{

    /**
    *
    * @var array
    */
    private $values;

    /**
    * Constructeur
    * @param string $name  Nom du composant
    */
    public function __construct($name) {
        parent::__construct($name, 'select');
    }


    /**
    * Rendu du composant
    * @return string
    */
    public function render(){
    //Rendu option
        $o = new AssetFile($this->componentName.'/option.tpl');
        $o_content = $o->getContent();

        $addContent = '';
        foreach($this->values as $k => $v){
            $ac = $o_content;
            $ac = StringTools::replaceAll($ac, '%value%', $v);
            $ac = StringTools::replaceAll($ac, '%label%', $k);

            $selected = false;
            if($this->getValue() == $v){
                $selected = true;
            }
            if(is_null($this->getValue() && $this->getDefaultValue() == $v)){
                $selected = true;
            }

            if($selected){
                $ac = StringTools::replaceAll($ac, '%selected%', 'selected="selected"');
            }else{
                $ac = StringTools::replaceAll($ac, '%selected%', '');
            }

            $addContent .= $ac;
        }

        $html = parent::render();
        $html = StringTools::replaceAll($html, '%items%', $addContent);

        return $html;
    }


    /**
    * Ajoute un choix dans la liste
    * @param string $value Valeur du choix
    * @param string $label Label affiché
    */
    public function addValue($value, $label){
        $this->values[$label] = $value;
    }

    /**
    * Définit les valeurs du Select
    * @param array $values Tableau de valeurs (clé/valeur) ex. array('label'=>'val','label','val');
    */
    public function setValues($values){
        $this->values = $values;
    }


    /**
    * Définit une datasource permettant de définir des valeurs au select
    * @param type $queryResult
    * @param type $colNameForLabel
    * @param type $colNameForValue
    */
    public function setDataSource($queryResult, $colNameForLabel, $colNameForValue){
        foreach($queryResult as $v){
            $this->values[$v[$colNameForLabel]] = $v[$colNameForValue];
        }
    }
}
