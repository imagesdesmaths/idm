<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\com\Curl;
use jin\dataformat\Json;
use jin\external\diatem\sherlock\Sherlock;
use jin\external\diatem\sherlock\SherlockCurl;


/** Classe dérivant SherlockConfig, Sherlock, SherlockIndexer, SherlockResult et SherlockSearch
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class SherlockCore{
    /**
     *
     * @var \jin\external\diatem\sherlock\Sherlock    Instance d'un objet Sherlock
     */
    private $sherlock;
    
    
    
    
    /**
     * 
     * @param \jin\external\diatem\sherlock\Sherlock $sherlock	Instance d'un objet Sherlock correctement initialisé
     */
    public function __construct(Sherlock $sherlock){
	$this->sherlock = $sherlock;
    }
    
    
   
    
    
    /**	Permet d'appeler une méthode sur ElasticSearch (Sera appelé via l'API REST de ElasticSearch)
     * 
     * @param string $method	Nom de la méthode
     * @param array $args	    [optionel] Tableau d'arguments. Si non NULL, appel en POST, si null, appel en GET. NULL par défaut.
     * @param string $customRequest [optionel] Option à transmettre en CURL. (Exemple DELETE)
     * @return array|boolean		Retourne un tableau issu du JSon retourné par ElasticSearch. Retourne FALSE en cas d'échec de l'appel.
     */
    protected function callMethod($method, $args = null, $customRequest = null){
	
	
	//$d = Curl::call($this->sherlock->getCnxString().$method, $args, $customRequest, false);
	$d = SherlockCurl::call($this->sherlock->getCnxString().$method, $args, false, $customRequest);
	
	//On log la dernière réponse
	$this->sherlock->lastResponse = $d;
	
	//On log la dernière requete
	$this->sherlock->lastCall = $args;
	
	if(!$d){
	    $this->throwError('Appel de l\'url '.$this->sherlock->getCnxString().$method.' impossible : '.SherlockCurl::getLastErrorVerbose());
	    return false; 
	}

	//On essaie de décoder le JSON
	$df = Json::decode($d);
	
	//Pas d'erreur de traitement
	if(Json::getLastErrorCode() == 0){
	   $this->serverInfo = $df;
	   
	   return $df;
	}else{
	    //Erreur de traitement Json
	    $this->throwError('Appel de l\'url '.$this->sherlock->getCnxString().$method.' impossible : '.Json::getLastErrorVerbose() . ' : '.$d);
	    return false;
	}
    }
    
    
    /**	Permet de relever une erreur. Elle sera relevée si throwError est à TRUE, elle sera enregistrée si throwError est à FALSE
     * 
     * @param string $erreur	Texte de l'erreur
     * @throws \Exception
     */
    protected function throwError($erreur){
	$this->sherlock->lastError = $erreur;
	if($this->sherlock->getThrowError()){
	    throw new \Exception($this->sherlock->getLastError());
	}
    }
}
