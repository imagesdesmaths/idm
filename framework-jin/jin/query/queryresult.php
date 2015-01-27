<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\query;

use \Exception;
use \Iterator;
use jin\lang\ArrayTools;
use jin\log\Debug;
use jin\lang\NumberTools;


/** Gestion d'un résultat Query. Peut être parcouru : foreach($objet as $ligne){ echo $ligne['columnName']; }
 *
 *  @auteur     Loïc Gerard
 *  @check
 */
class QueryResult implements Iterator {
    /**
     *
     * @var array   Data
     */
    private $resultat = array();


    /**
     * Constructeur
     * @param type $data    Données à initialiser (tableau d'objets)
     * @throws Exception
     */
    public function __construct($data) {
        if (!is_array($data)) {
            throw new Exception('Les données doivent être sous la forme d\'un tableau d\'objets');
        }

        $this->resultat = $data;
    }


    /**
     * Limite les résultats de la query
     * @param int $from Index de début de parsing
     * @param int $to   Index de fin de parsing
     * @throws Exception
     */
    public function limitResults($from, $to = -1) {
        if ($from < 0) {
            throw new Exception('Le paramètre from doit être positif.');
        } elseif ($from > $this->count()) {
            throw new Exception('Le paramètre from est supérieur au nombre de résultats de la requête.');
        } elseif ($to > $this->count()) {
            throw new Exception('Le paramètre to est supérieur au nombre de résultats de la requête.');
        }

        $l = NULL;
        if ($to >= 0) {
            $l = $to - $from + 1;
        }
        $this->resultat = array_slice($this->resultat, $from, $l);
    }


    /**
     * Ajoute une colonne
     * @param string $columnName    Nom de la colonne
     * @param string $defaultValue  Valeur par défaut à initialiser
     */
    public function addColumn($columnName, $defaultValue = '') {
        $nb = count($this->resultat);
        for ($i = 0; $i < $nb; $i++) {
            if(is_callable($defaultValue)) {
                $this->resultat[$i][$columnName] = $defaultValue($this->resultat[$i]);
            } else {
                $this->resultat[$i][$columnName] = $defaultValue;
            }
        }
    }


    /**
     * Duplique une colonne
     * @param string $columnName    Nom de la colonne à dupliquer
     * @param string $newColumnName Nom de la nouvelle colonne
     */
    public function duplicateColumn($columnName, $newColumnName){
        $nb = count($this->resultat);
        for ($i = 0; $i < $nb; $i++) {
            $this->resultat[$i][$newColumnName] = $this->resultat[$i][$columnName];
        }
    }


    /**
     * Supprime une colonne
     * @param string $columnName    Nom de la colonne à supprimer
     */
    public function removeColumn($columnName) {
        $nb = count($this->resultat);
        for ($i = 0; $i < $nb; $i++) {
            unset($this->resultat[$i][$columnName]);
        }
    }

    /**
     * Ordonne les colonnes
     * @param array $columnNames  Noms des colonnes fourni dans le nouvel ordre
     * @throws \Exception
     */
    public function orderColumns($columnNames){
        if(!is_array($columnNames) || empty($columnNames)){
            throw new \Exception('Impossible d\'ordonner le QueryResult : le tableau de noms de colonnes fourni est invalide');
        }
        if(count($this->resultat) > 0) {
            $orderedResult = array();
            $nb = count($this->resultat);
            foreach ($columnNames as $columnName) {
                if(isset($this->resultat[0][$columnName])) {
                    for ($i = 0; $i < $nb; $i++) {
                        $orderedResult[$i][$columnName] = $this->resultat[$i][$columnName];
                        unset($this->resultat[$i][$columnName]);
                    }
                }
            }
            $remainingKeys = array_keys($this->resultat[0]);
            foreach ($remainingKeys as $remainingKey) {
                for ($i = 0; $i < $nb; $i++) {
                    $orderedResult[$i][$remainingKey] = $this->resultat[$i][$remainingKey];
                }
            }
            $this->resultat = $orderedResult;
        }
    }

    /**
     * Redéfinit la valeur d'une cellule
     * @param string $value Valeur
     * @param string $column    Nom de la colonne
     * @param int $row  Numéro de la ligne
     */
    public function setValueAt($value, $column, $row = 0) {
        $this->resultat[$row][$column] = $value;
    }


    /**
     * Retourne le nombre de lignes
     * @return int
     */
    public function count() {
        return count($this->resultat);
    }


    /**
     * Retourne la valeur d'une cellule
     * @param string $column    Nom de la colonne
     * @param int $row  Numéro de la ligne
     * @return mixed
     */
    public function getValueAt($column, $row = 0) {
        return $this->resultat[$row][$column];
    }


    /**
     * Retourne les données en un tableau
     * @param boolean $getOnlyHeaders   [Defaut : TRUE] Retourne uniquement les colonnes avec headers
     * @param type $allwaysReturnArrayOfArray   [Defaut : FALSE] : Retourne toujours un tableau de tableaux, même si il n'y a qu'un résultat
     * @return type
     */
    public function getDatasInArray($getOnlyHeaders = true, $allwaysReturnArrayOfArray = false) {
        if ($this->count() == 1 && !$allwaysReturnArrayOfArray) {
            return $this->resultat[0];
        } else {
            if($getOnlyHeaders){
                return $this->getDatasInArrayWithoutNumericHeaders();
            }else{
                return $this->resultat;
            }

        }
    }


    /**
     * Retourne les données sans les colonnes avec header numérique
     * @return array
     */
    private function getDatasInArrayWithoutNumericHeaders() {
        $tempData = $this->resultat;

        if($this->count() > 0) {
            $keys = array();
            foreach ($this->resultat[0] AS $k => $v) {
                if (is_numeric($k)) {
                    $keys[] = $k;
                }
            }

            $size = ArrayTools::length($tempData);
            for ($i = 0; $i < $size; $i++) {
                foreach ($keys AS $k) {
                    unset($tempData[$i][$k]);
                }
            }
        }
        return $tempData;
    }

    /**
     * Retourne un tableau des valeurs d'une colonne (dédoublonné)
     * @param string $column    Nom de la colonne
     * @return mixed
     */
    public function valueList($column){
        $data = array();

        $nb = count($this->resultat);
        for ($i = 0; $i < $nb; $i++) {
            $v = $this->resultat[$i][$column];
            if(!is_numeric(ArrayTools::find($data, $v))){
                $data[] = $v;
            }
        }

        return $data;
    }


    /** Retourne les en-tête de colonne
     * @return  array
     */
    public function getHeaders(){
        $cols = array();
        if(ArrayTools::length($this->resultat) > 0){
            foreach($this->resultat[0] as $c => $v){
                if(!is_numeric($c)){
                    $cols[] = $c;
                }
            }
        }

        return $cols;
    }


    /**
     * Concatène avec les données d'un autre objet QueryResult (Nécessite que les deux QueryResult aient la même structure)
     * @param \jin\query\QueryResult $qr
     * @throws \Exception
     */
    public function concat(QueryResult $qr){
        $arraysAreEqual = ($qr->getHeaders() === $this->getHeaders());
        if(!$arraysAreEqual && $qr->count() > 0 && $this->count() > 0){
            throw new \Exception('Concaténation impossible : les deux QueryResult n\'ont pas la même structure');
        }

        if($qr->count() == 1){
            $this->resultat = ArrayTools::merge($this->resultat, array($qr->getDatasInArray()));
        }else{
            $this->resultat = ArrayTools::merge($this->resultat, $qr->getDatasInArray());
        }
    }


    /**
     * Ajoute une ligne de données
     * @param array $data Tableau associatif contenant les données à ajouter array('colname'=>'valeur','colname2'=>'valeur')
     */
    public function addLine($data){
        $addData = array();
        if(empty($this->resultat)){
            $p = 0;
            foreach($data as $k => $v){
                $addData[$p] = $v;
                $addData[$k] = $v;
            }
        } else {
            $addData = $this->resultat[0];
            $p = 0;
            foreach ($addData as $k => $v) {
                if (!is_numeric($k)) {
                    if (isset($data[$k])) {
                        $addData[$k] = $data[$k];
                        $addData[$p] = $data[$k];
                    } else {
                        $addData[$p] = '';
                    }
                    $p++;
                }
            }
        }
        $this->resultat[] = $addData;
    }

    //Fonctions d'itération

    /**
     * Itération : current
     * @return mixed
     */
    public function current() {
        return current($this->resultat);
    }


    /**
     * Itération : key
     * @return string
     */
    public function key() {
        return key($this->resultat);
    }


    /**
     * Itération : rewind
     * @return \jin\query\QueryResult
     */
    public function rewind() {
        reset($this->resultat);
        return $this;
    }


    /**
     * Itération : next
     */
    public function next() {
        next($this->resultat);
    }


    /**
     * Itération valid
     * @return boolean
     */
    public function valid() {
        return array_key_exists(key($this->resultat), $this->resultat);
    }

}
