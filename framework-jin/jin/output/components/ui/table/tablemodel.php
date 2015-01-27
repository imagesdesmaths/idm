<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\components\ui\table;



/** Composant permettant de définir un modèle d'affichage à utiliser sur un composant de type UI Table
 * 	@auteur		Loïc Gerard	
 */
class TableModel{
    /**
     *
     * @var array   Modèle
     */
    private $model = array();
    
    
    /**
     * Constructeur
     */
    public function __construct() {
    }
    
    
    /**
     * Définit un composant appliquable à une colonne donnée
     * @param string|int $colName   Nom de la colonne du header, ou nom de la colonne dans le QueryResult ou numéro de colonne
     * @param string $uiComponentName	Chemin du composant. Ex: jin/output/components/ui/Boolean
     */
    public function setColComponent($colName, $uiComponentName){
	if(is_string($colName)){
	    $this->model[$colName] = $uiComponentName;
	}else if(is_numeric($colName)){;
	     $this->model['#colnum_'.$colName] = $uiComponentName;
	}else{
	    throw new \Exception('Nom de colonne non valide : '.$colName);
	}
	
    }
    
    
    /**
     * Effectue le rendu d'une cellule à travers le filtre de ce modèle
     * @param string $tableName	Nom du composant UI Table
     * @param string $dataColName	Nom de la colonne dans le QueryResult
     * @param string $headerColName	Nom de la colonne dans le header
     * @param int $col		Numéro de colonne
     * @param int $row		Numéro de ligne
     * @param string $value	Valeur de la cellule
     * @return string
     */
    public function renderCell($tableName, $dataColName, $headerColName, $col, $row, $value){
	$cname;
	
	if(isset($this->model[$headerColName])){
	    $cname = $headerColName;
	}else if(isset($this->model[$dataColName])){
	    $cname = $dataColName;
	}else if(isset($this->model['#colnum_'.$col])){
	    $cname = '#colnum_'.$col;
	}else{
	     return $value;
	}
	
	$c = new $this->model[$cname]($tableName.'_'.$dataColName.'_'.$row);
	$c->setValue($value);
	return $c->render();
	
    }
}