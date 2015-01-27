<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\lang\ArrayTools;
use jin\query\QueryResult;


/** Objet permettant le traitement de résultats de recherche.
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class SherlockResult{
    /**
     *
     * @var array Données Sherlock
     */
    private $data;
    
    /**
     *
     * @var int Index de début de parsing. 0 par défaut.
     */
    private $index;
    
    
    /**	Constructeur
     * 
     * @param array $sherlockData   Tableau de données au format de sortie Sherlock.
     * @param int $index	Index de début de parsing.
     * @throws \Exception
     */
    public function __construct($sherlockData, $index) {
	$this->data = $sherlockData;
	$this->index = $index;
	if(!isset($this->data['took'])){
	    throw new \Exception('Impossible d\'initialiser les données : données non compatibles Sherlock');
	}
    }
    
    
    /**	Retourne le nombre de résultats contenus dans l'objet.
     * 
     * @return int  Nombre de résultats contenus dans l'objet (En fonction de l'index courant et du nombre max)
     */
    public function getResultCount(){
	if(isset($this->data['hits']['hits'])){
	    return count($this->data['hits']['hits']);
	}else{
	    return 0;
	}
	
    }
    
    
    /**	Retourne le nombre total de résultats possibles.
     * 
     * @return int  Nombre total de résultats possibles
     */
    public function getTotalCount(){
	return $this->data['hits']['total'];
    }
    
    
    /**	Retourne le score maximum de matching
     * 
     * @return float	Score maximum de matching
     */
    public function getMaxScore(){
	return $this->data['hits']['max_score'];
    }
    
    
    /**	Retourne l'index de début de parsing
     * 
     * @return int Index de début de parsing
     */
    public function getIndex(){
	return $this->index;
    }
    
    
    /**	Retourne les données au format brut. (array)
     * 
     * @return array	Données brutes
     */
    public function getData(){
	return $this->data;
    }
    
    
    /**	Retourne les données au format QueryResult exploitable
     * 
     * @return \jin\query\QueryResult	Objet QueryResult exploitable
     */
    public function getQueryResult(){
	$tempData = $this->data['hits']['hits'];
	for($i = 0; $i < count($tempData); $i++){
	    $tempData[$i] = ArrayTools::merge($tempData[$i], $tempData[$i]['_source']);
	    unset($tempData[$i]['_source']);
	}
	
	return new QueryResult($tempData);
    }
}
