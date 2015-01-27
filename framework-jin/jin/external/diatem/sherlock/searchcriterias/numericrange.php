<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock\searchcriterias;

use jin\external\diatem\sherlock\SearchItemInterface;

/** Filtre Sherlock de type critère : recherche sur une plage de valeurs de type numérique ou date.
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class NumericRange implements SearchItemInterface{
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
    
    
    /**	Valeur de bas de plage
     *
     * @var int|string
     */
    private $min;
    
    
    /**	Valeur de haut de plage
     *
     * @var int|string
     */
    private $max;
    
    
    /**	Constructeur
     * 
     * @param array $fields Noms des champs sur lesquels appliquer le filtre
     * @param int|string $values  Valeur de test
     */
    public function __construct($fields, $values) {
	$this->fields = $fields;
	$this->values = $values;
	if(!is_array($values) || count($values) != 2){
	    throw new \Exception('$values doit être un tableau de deux éléments : array(min,max)');
	}
	$this->min = $this->values[0];
	$this->max = $this->values[1];
	

    }
    
    
    /**	Construit le tableau destiné à être ajouté dans une requête de recherche par SherlockSearch
     * 
     * @return array	Paramètres de recherche SherlockSearch
     */
    public function getParamArray(){
	
	$outArray = array();
	foreach ($this->fields as $field){
	    $critArray['range'] = array();
	    $critArray['range'][$field]['from'] = $this->min;
	    $critArray['range'][$field]['to'] = $this->max;
	    $outArray[] = $critArray;
	}
	
	return $outArray;
    }
}