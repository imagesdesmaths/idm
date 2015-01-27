<?php

/**
 * Jin Framework
 * Diatem
 */
namespace jin\lang;

use jin\lang\StringTools;

/** Boite à outil pour les tableaux
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check
 *	@maj		12/06/2014  :	[Loïc Gerard]	Ajout des méthodes isKeyExists(), merge() et length()		
 */
class ArrayTools {

    /** Permet de trier un tableau associatif en précisant la colonne à utiliser pour trier
     * 	@param 	array	$array	Tableau à trier
     * 	@param 	string 	$index	Index de la colonne à utiliser pour effectuer le tri
     * 	@return array		Tableau trié
     */
    public static function sortAssociativeArray($array, $index) {
	$sort = array();
	//préparation d'un nouveau tableau basé sur la clé à trier
	foreach ($array as $key => $val) {
	    $sort[$key] = $val[$index];
	}

	//tri par ordre naturel et insensible à la casse
	natcasesort($sort);

	//formation du nouveau tableau trié selon la clé
	$output = array();
	foreach ($sort as $key => $val) {
	    $output[$key] = $array[$key];
	}
	return $output;
    }
    
    
    /**
     * Ajoute une valeur au tableau en fin de tableau
     * @param array $array  Tableau à modifier
     * @param mixed $value  Valeur à ajouter
     * @return	array
     */
    public static function append($array, $value){
	$array[] = $value;
	return $array;
    }
    
    
    /**
     * Retourne la taille du tableau
     * @param array $array  Tableau source
     * @return int
     */
    public static function length($array){
	return count($array);
    }
    
    
    /**
     * Fusionne deux tableaux en un seul
     * @param array $array1 Premier tableau à fusionner
     * @param array $array2 Second tableau à fusionner
     * @return array
     */
    public static function merge($array1, $array2){
	return array_merge($array1, $array2);
    }
    
    
    /**
     * Effectue la moyenne des valeurs du tableau
     * @param array $array  Tableau source
     * @return float
     */
    public static function avg($array){
	$t = 0;
	foreach($array AS $v){
	    if(is_numeric($v)){
		$t += $v;
	    }
	}
	return $t/count($array);
    }
    
    
    /**
     * Supprime une clé du tableau
     * @param array $array  Tableau source
     * @param int $index    Index à supprimer
     * @return array
     * @throws \Exception
     */
    public static function deleteAt($array, $index){
	if(count($array) < $index){
	    throw new \Exception('Index non valide : ce tableau a '.count($array).' élément(s)');
	    return $array;
	}
	
	unset($array[$index]);
	return $array;
    }
    
    
    /**
     * Insère un élément dans le tableau à une position spécifiée
     * @param array $array  Tableau source
     * @param int $index    Index
     * @param mixed $value  Valeur à ajouter
     * @return array
     * @throws \Exception
     */
    public static function insertAt($array, $index, $value){
	if(count($array) < $index){
	    throw new \Exception('Index non valide : ce tableau a '.count($array).' élément(s)');
	    return $array;
	}
	
	$tabLen = count($array);
	$tabEnd = array_slice ($array, $index, $tabLen-$index+1);
	$tabDeb	= array_slice ($array, 0, $index);
	if(!is_array($value)){
	    $value = array($value);
	}
	$tabOut = array_merge(array_merge($tabDeb, $value),$tabEnd);
	return $tabOut;
    }
    
    
    /**
     * Détermine la valeur max d'un tableau
     * @param array $array  Tableau source
     * @return float
     */
    public static function max($array){
	$m = 0;
	foreach($array AS $v){
	    if(is_numeric($v) && $v > $m){
		$m = $v;
	    }
	}
	return $m;
    }
    
    
     /**
     * Détermine la valeur min d'un tableau
     * @param array $array  Tableau source
     * @return float
     */
    public static function min($array){
	$m = null;
	foreach($array AS $v){
	    if(is_numeric($v) && (is_null($m) || $v < $m)){
		$m = $v;
	    }
	}
	return $m;
    }
    
    
    /**
     * Ajoute un élément au début du tableau
     * @param array $array  Tableau source
     * @param mixed $value  Valeur à ajouter
     * @return array
     */
    public static function prepend($array, $value){
	return self::insertAt($array, 0, $value);
    }
    
    
    /**
     * Trier un tableau non associatif par ses valeurs numériques croissantes
     * @param array $array  Tableau source
     * @return array
     */
    public static function sortNumeric($array){
	sort($array, SORT_NUMERIC);
	return $array;
    }
    
    
    /**
     * Effectue la somme des valeurs du tableau
     * @param array $array  Tableau source
     * @return float
     */
    public static function sum($array){
	$t = 0;
	foreach($array AS $v){
	    if(is_numeric($v)){
		$t += $v;
	    }
	}
	return $t;
    }
    
    
    /**
     * Convertit un tableau en liste de valeurs
     * @param array $array  Tableau source
     * @param string $separateur    Séprateur
     * @return string
     */
    public static function toList($array, $separateur = ','){
	return StringTools::implode($array, $separateur);
    }
    
    
    /**
     * Mélange les valeurs d'un tableau
     * @param array $array  Tableau source
     * @return array
     */
    public static function shuffle($array){
	shuffle($array);
	return $array;
    }
    
    /**
     * Retourne un tableau des valeurs d'un tableau (excluant les clés)
     * @param array $array  Tableau source
     * @return array
     */
    public static function getAllValues($array){
	return array_values($array);
    }
    
    
    /**
     * Supprime les doublons d'un tableau
     * @param array $array  Tableau source
     * @return array
     */
    public static function deleteDoublons($array){
	return array_unique($array);
    }
    
    
    /**
     * Permet de récupérer une portion de tableau
     * @param array $array  Tableau source
     * @param int $index    Index de début
     * @param int $length   Longueur de la portion à récupérer
     * @return array
     */
    public static function getArrayPart($array, $index, $length){
	return array_slice($array, $index, $length);
    }
    
    
    /**
     * Inverse l'ordre d'un tableau
     * @param array $array  Tableau source
     * @return array
     */
    public static function reverse($array){
	return array_reverse($array);
    }
    
    
    /**
     * Obtient une valeur au hasard du tableau
     * @param array $array  Tableau source
     * @return mixed
     */
    public static function getRandomValue($array){
	return $array[array_rand($array, 1)];
    }
    
    
    /**
     * Retourne la position d'un élément dans le tableau
     * @param array $array  Tableau source
     * @param mixed $value  Valeur recherchée
     * @return boolean|int	FALSE si rien n'est trouvé, l'index en cas de réussite.
     */
    public static function find($array, $value){
	return array_search($value, $array);
    }
    
    
    /**
     * Retourne la position d'un élément dans le tableau (sans tenir compte de la casse)
     * @param array $array  Tableau source
     * @param mixed $value  Valeur recherchée
     * @return boolean|int	FALSE si rien n'est trouvé, l'index en cas de réussite.
     */
    public static function findNoCase($array, $value){
	return array_search(strtolower($value), array_map('strtolower', $array));
    }
    
    
    /**
     * Recherche si une clé est définie dans le tableau
     * @param array $array  Tableau source
     * @param string $key   Clé
     * @return boolean
     */
    public static function isKeyExists($array, $key){
	return array_key_exists($key, $array);
    }

}
