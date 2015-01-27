<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock\searchcriterias;

use jin\external\diatem\sherlock\SearchItemInterface;

/** Filtre Sherlock de type critère : recherche approximative sur un ou plusieurs termes
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class ApproximateOnText implements SearchItemInterface{
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
	
	$critArray = array();
	$critArray['fuzzy_like_this'] = array();
	$critArray['fuzzy_like_this']['fields'] = $this->fields;
	$critArray['fuzzy_like_this']['like_text'] = $this->values;
	$critArray['fuzzy_like_this']['max_query_terms'] = 60;
	
	return array($critArray);
    }
}