<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\external\diatem\sherlock\SherlockCore;
use jin\external\diatem\sherlock\Sherlock;
use jin\log\Debug;
use jin\lang\ArrayTools;

class SherlockAnalyzer extends SherlockCore {
    /**
     *
     * @var \jin\external\diatem\sherlock\Sherlock    Instance d'un objet Sherlock
     */
    private $sherlock;
    
    /**	Initialise un objet permettant d'effectuer des analyses
     * 
     * @param \jin\external\diatem\sherlock\Sherlock $sherlock	Instance d'un objet Sherlock correctement initialisé
     */
    public function __construct(Sherlock $sherlock) {
	$this->sherlock = $sherlock;
	parent::__construct($this->sherlock);
    }
    
    /**
     * Analyse les mots-clé d'un document. Nécessite de configurer l'attribut avec store=TRUE et term_vector=with_positions_offsets_payloads
     * 
     * @param string $documentType
     * @param string $documentId
     */
    public function analyzeTokens($documentType, $documentId, $field){
	//http://localhost:9200/twitter/tweet/1/_termvector?pretty=true
	$json = '{
	    "fields" : ["'.$field.'"],
	    "offsets" : true,
	    "payloads" : true,
	    "positions" : true,
	    "term_statistics" : true,
	    "field_statistics" : true
	 }';
	
	
	$args = array();
	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/'.$documentType.'/'.$documentId.'/_termvector?pretty=true',  $json);
	
	if(!isset($retour['found']) || $retour['found'] == false || count($retour['term_vectors']) == 0){
	    return false;
	}
	
	$keywords = array();
	foreach($retour['term_vectors'][$field]['terms'] as $term => $value){
	    $obj = array();
	    $obj['term'] = $term;
	    $obj['freq'] = $value['term_freq'];
	    $keywords[] = $obj;
	}
	
	
	$keywords = ArrayTools::sortAssociativeArray($keywords, 'freq');
	$keywords = ArrayTools::reverse($keywords);
	
	return $keywords;
    }
}