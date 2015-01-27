<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock\searchconditions;

use jin\external\diatem\sherlock\SearchItemInterface;

/** Filtre Sherlock de type condition : filtre sur la valeur absolue d'un terme unique
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class ConditionOnSingleTerm implements SearchItemInterface{
    /**
     *
     * @var array Noms des champs sur lesquels appliquer le filtre
     */
    private $fields;
    
    /**
     *
     * @var string  Valeur de test
     */
    private $values;
    
    
    /**	Constructeur
     * 
     * @param array $fields Noms des champs sur lesquels appliquer le filtre
     * @param string $values  Valeur de test
     */
    public function __construct($fields, $values) {
	$this->fields = $fields;
	$this->values = $values;
    }
    
    
    /**	Construit le tableau destiné à être ajouté dans une requête de recherche par SherlockSearch
     * 
     * @return array	Paramètres de recherche SherlockSearch
     */
    public function getParamArray(){
	$outArray = array();
	foreach ($this->fields as $field){
	    $condArray = array();
	    $condArray['term'] = array();
	    $condArray['term'][$field] = $this->values;
	    $outArray[] = $condArray;
	}

	return $outArray;
    }
}
