<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\lang;

use jin\lang\StringTools;
use jin\lang\ArrayTools;

/** Gestion de liste de valeurs (inspiré des méthodes de list de coldfusion)
 *
 * 	@auteur	    Loïc Gerard
 * 	@check
 */
class ListTools{
    /**
     * Modifie les séparateurs d'une liste
     * @param string $list  Liste à modifier
     * @param string $oldDelimiter  Ancien séparateur
     * @param string $newDelimiter  Nouveau séparateur
     * @return string
     */
    public static function changeDelims($list, $oldDelimiter, $newDelimiter){
	return StringTools::replaceAll($list, $oldDelimiter, $newDelimiter);
    }
    
    
    /**
     * Ajoute un élément à la fin d'une liste
     * @param string $list  Liste à modifier
     * @param string $value Valeur à ajouter
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function append($list, $value, $delimiter=','){
	if($list == ''){
	    $list = $value;
	}else{
	    $list .= $delimiter.$value;
	}
	return $list;
    }
    
    
    /**
     * Recherche la position d'une valeur dans la liste
     * @param string $list  Liste source
     * @param string $value Valeur à rechercher
     * @param string $delimiter	Séparateur
     * @return int|boolean  Position dans la liste
     */
    public static function find($list, $value, $delimiter = ','){
	return ArrayTools::find(self::toArray($list, $delimiter), $value);
    }
    
    
    /**
     * Recherche la position d'une valeur dans la liste (en ne prenant pas en compte la casse)
     * @param string $list  Liste source
     * @param string $value Valeur à rechercher
     * @param string $delimiter	Séparateur
     * @return int|boolean  Position dans la liste
     */
    public static function findNoCase($list, $value, $delimiter = ','){
	return ArrayTools::findNoCase(self::toArray($list, $delimiter), $value);
    }
    
    
    /**
     * Définit si une liste contient une valeur donnée
     * @param string $list  Liste source
     * @param string $value Valeur à rechercher
     * @param string $delimiter	Séparateur
     * @return boolean
     */
    public static function contains($list, $value, $delimiter = ','){
	if(is_numeric(ArrayTools::find(self::toArray($list, $delimiter), $value))){
	    return true;
	}
	return false;
    }
    
    
    /**
     * Définit si une liste contient une valeur donnée (en ne tenant pas compte de la casse)
     * @param string $list  Liste source
     * @param string $value Valeur à rechercher
     * @param string $delimiter	Séparateur
     * @return boolean
     */
    public static function containsNoCase($list, $value, $delimiter = ','){
	if(is_numeric(ArrayTools::findNoCase(self::toArray($list, $delimiter), $value))){
	    return true;
	}
	return false;
    }
    
    
    /**
     * Supprime une valeur de la liste à une position donnée
     * @param string $list  Liste source
     * @param int $index    Index
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function deleteAt($list, $index, $delimiter = ','){
	return ArrayTools::deleteAt(self::toArray($list, $delimiter), $index);
    }
    
    
    /**
     * Retourne le premier élément de la liste
     * @param string $list  Liste source
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function first($list, $delimiter = ','){
	$arr = self::toArray($list, $delimiter);
	return $arr[0];
    }
    
    
     /**
     * Retourne le dernier élément de la liste
     * @param string $list  Liste source
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function last($list, $delimiter = ','){
	$arr = self::toArray($list, $delimiter);
	
	if(isset($arr[count($arr)-1])){
	    return $arr[count($arr)-1];
	}else{
	    return null;
	}
	
    }
    
    
    /**
     * Retourne un élément de la liste, à la position donnée
     * @param string $list  Liste source
     * @param int $index    Position
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function ListGetAt($list, $index, $delimiter = ','){
	$arr = self::toArray($list, $delimiter);
	return $arr[$index];
    }
    
    
    /**
     * Insère un élément dans la liste, à une position donnée
     * @param string $list  Liste source
     * @param int $index    Position
     * @param string $value Valeur
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function ListInsertAt($list, $index, $value, $delimiter = ','){
	$arr = self::toArray($list, $delimiter);
	$arr = ArrayTools::insertAt($arr, $index, $value);
	return ArrayTools::toList($arr, $delimiter);
    }

    
    /**
     * Retourne le nombre d'éléments d'une liste
     * @param string $delimiter	Séparateur
     * @return int
     */
    public static function len($delimiter = ','){
	$arr = self::toArray($list, $delimiter);
	return count($arr);
    }
    
    
    /**
     * Ajoute un élément en tête de liste
     * @param string $list  Liste source
     * @param string $value Valeur à ajouter
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function prepend($list, $value, $delimiter = ','){
	$list = $value.$delimiter.$list;
	return $list;
    }
    
    
    /**
     * Redéfinit la valeur d'un des éléments d'une liste
     * @param string $list  Liste source
     * @param int $index   Position
     * @param string $value Valeur
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function setAt($list, $index, $value, $delimiter = ','){
	$arr = self::toArray($list, $delimiter);
	$arr[$index] = $value;
	return ArrayTools::toList($arr, $delimiter);
    }
    
    
    /**
     * Convertit une liste en tableau
     * @param string $list  Liste source
     * @param string $delimiter	Séparateur
     * @return string
     */
    public static function toArray($list, $delimiter = ','){
	if($list == ''){
	    return array();
	}else{
	    return StringTools::explode($list, $delimiter);
	}
	
    }
}