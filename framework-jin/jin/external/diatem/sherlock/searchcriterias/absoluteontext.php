<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock\searchcriterias;

use jin\external\diatem\sherlock\SearchItemInterface;

/** Filtre Sherlock de type critère : recherche absolue sur plusieurs termes
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class AbsoluteOnText implements SearchItemInterface{
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
	$critArray['multi_match'] = array();
	$critArray['multi_match']["query"] = $this->values;
	$critArray['multi_match']["fields"] = $this->fields;

	return array($critArray);
	
	
    }
}