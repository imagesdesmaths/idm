<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\com\Curl;
use jin\dataformat\Json;
use jin\lang\StringTools;
use jin\external\diatem\sherlock\SherlockCore;

/** Classe principale Sherlock. A instancier avant toute autre travail sur Sherlock. 
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class Sherlock extends SherlockCore{
    /**
     *
     * @var string Url du serveur Sherlock (ElasticSearch)
     */
    private $host;
    
    /**
     *
     * @var numeric Port sur lequel effectuer les appels
     */
    private $port;
    
    /**
     *
     * @var string chaîne de connexion
     */
    private $cnxString;
    
    /**
     *
     * @var string code de l'applicatif. (Doit être unique, correspond à l'index sur le serveur ElasticSearch)
     */
    private $appzCode;
    
    /**
     *
     * @var boolean Détermine si les erreurs sont catchées ou directement exprimées
     */
    private $thowError = true;
    
    /**
     *
     * @var array Infos du serveur
     */
    private $serverInfo;
    
    /**
     *
     * @var string Dernière réponse du serveur ElasticSearch
     */
    public $lastResponse;
    
    
    public $lastCall;
    
    /**
     *
     * @var string Dernière erreur rencontrée
     */
    public $lastError;
    
    
    
    
    /**	Instancie un objet Sherlock. Permet de débuter un travail sur Sherlock avec des classes annexes. (SherlockConfig, SherlockIndexer, SherlockResult, SherlockSearch et SherlockUtils)
     * 
     * @param string $host  Url du serveur Sherlock (ElasticSearch)
     * @param string $appzCode	code de l'applicatif. (Doit être unique, correspond à l'index sur le serveur ElasticSearch)
     * @param int $port Port sur lequel effectuer les appels
     * @param boolean $throwError
     */
    public function __construct($host, $appzCode, $port = 9200, $throwError = true) {
	if(StringTools::right($host, 1) == '/'){
	    $host = StringTools::left($host, StringTools::len($host)-1);
	}
	$this->appzCode = $appzCode;
	$this->host = $host;
	$this->port = $port;
	$this->thowError = $throwError;
	$this->cnxString = $this->host.':'.$this->port.'/';
	
	parent::__construct($this);
    }
    
    
    //--------------------------------------------------------------------------
    //Getters
    
    
    /**	Retourne l'Url d'appel au serveur Sherlock (ElasticSearch)
     * 
     * @return string	Url
     */
    public function getHost(){
	return $this->host;
    }
    
    
    /**	Retourne le code de l'applicatif (Correspondant à l'index utilisé par ElasticSearch)
     * 
     * @return string	Code de l'applicatif
     */
    public function getAppzCode(){
	return $this->appzCode;
    }
    
    
    /**	Retourne le port utilisé pour appeler Sherlock
     * 
     * @return int  Port d'écoutre de l'API Rest ElasticSearch
     */
    public function getPort(){
	return $this->port;
    }
    
    
    /**	Retourne la chaîne de connexion
     * 
     * @return string	Chaîne de connexion
     */
    public function getCnxString(){
	return $this->cnxString;
    }
    
    
    /**	Retourne si les erreurs sont catchées ou directement relevées
     * 
     * @return boolean	TRUE : erreurs directement relevées, FALSE : en mode silencieux.
     */
    public function getThrowError(){
	return $this->thowError;
    }
    
    
    
    /**	Retourne l'état du serveur, FALSE si la connexion est impossible
     * 
     * @return array|boolean	FALSE si connexion impossible, sinon code HTML définissant l'état du serveur. (200 si tout est OK)
     */
    public function getServerStatus(){
	if(!$this->serverInfo){
	    $r = $this->getServerInfo();
	    if(!$r){
		return false;
	    }
	}
	return $this->serverInfo['status'];
    }
    
    
    /**	Retourne la version du serveur Sherlock, FALSE si la connexion est impossible
     * 
     * @return array|boolean	FALSE si connexion impossible. Sinon numéro de version.
     */
    public function getServerVersion(){
	if(!$this->serverInfo){
	    $r = $this->getServerInfo();
	    if(!$r){
		return false;
	    }
	}
	return $this->serverInfo['version']['number'];
    }
    
    
    /**	Retourne le noeud serveur sur lequel le test a été effectué, FALSE si la connexion est impossible
     * 
     * @return array|boolean	FALSE si connexion impossible. Sinon nom du noeud.
     */
    public function getServerNodeName(){
	if(!$this->serverInfo){
	    $r = $this->getServerInfo();
	    if(!$r){
		return false;
	    }
	}
	return $this->serverInfo['name'];
    }
    
     /**	Retourne la dernière erreur rencontrée
     * 
     * @return string	Dernière erreur rencontrée
     */
    public function getLastError(){
	return $this->lastError;
    }
    
    
    /**	Retourne la dernière réponse apportée par le serveur ElasticSearch
     * 
     * @return string	Dernière réponse
     */
    public function getLastServerResponse(){
	return $this->lastResponse;
    }
    
    
    public function getLastServerCall(){
	return $this->lastCall;
    }
    
    
    
    
    //--------------------------------------------------------------------------
    //Methodes publiques
    
    
    /**	Permet de tester la connectivité avec Sherlock
     * 
     * @return boolean	Etat de la connectivité.
     */
    public function testConnexion(){
	//On appelle l'url du serveur
	$d = Curl::call($this->cnxString, null);
	if(!$d){
	    $this->throwError('Connexion avec Sherlock impossible : '.Curl::getLastErrorVerbose());
	    return false;
	}
	
	//On log la dernière réponse
	$this->lastResponse = $d;
	
	//On essaie de décoder le JSON
	$df = Json::decode($d);
	
	//Pas d'erreur de traitement
	if(Json::getLastErrorCode() == 0){
	    if($df['status'] == 200){
		//Statut du serveur OK
		return true;
	    }else{
		//Statut du serveur inapproprié
		$this->throwError('Connexion avec Sherlock réussie mais statut serveur inatendu : '.$dt['status']);
		return false;
	    }
	}else{
	    //Erreur de traitement Json
	    $this->throwError('Connexion avec Sherlock impossible : '.Json::getLastErrorVerbose());
	    return false;
	}
    }
    
    
    //--------------------------------------------------------------------------
    //Méthodes privées
    
    
    /**	Permet de charger la configuration du serveur en mémoire.
     * 
     * @return boolean	TRUE si tout s'est bien passé
     */
    private function getServerInfo(){
	//On appelle l'url du serveur
	$d = Curl::call($this->cnxString, null);
	if(!$d){
	    $this->throwError('Connexion avec Sherlock impossible : '.Curl::getLastErrorVerbose());
	    return false;
	}
	
	//On log la dernière réponse
	$this->lastResponse = $d;
	
	//On essaie de décoder le JSON
	$df = Json::decode($d);
	
	//Pas d'erreur de traitement
	if(Json::getLastErrorCode() == 0){
	   $this->serverInfo = $df;
	}else{
	    //Erreur de traitement Json
	    $this->throwError('Connexion avec Sherlock impossible : '.Json::getLastErrorVerbose());
	    return false;
	}
	
	return true;
    }
}