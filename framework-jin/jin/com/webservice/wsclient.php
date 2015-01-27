<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\com\webservice;

/** Utilisation de webservice côté client
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		05/05/2014
 */
class WSClient {

    /** Objet Soap Client
     *
     * 	@var object
     */
    private $client;

    
    /** Constructeur de la classe
     * 	@param		string	 	$url			Lien du webservice serveur (fichier WSDL)
     * 	@param		boolean		$cache			[optionel] Cache actif (true par défaut)
     * 	@param		boolean		$trace			[optionel] Debug actif (false par défaut)
     */
    public function __construct($url, $cache = true, $trace = false) {
	$opt_cache = 0;
	if ($cache) {
	    $opt_cache = 1;
	}
	$opt_trace = 0;
	if ($trace) {
	    $opt_trace = 1;
	}
	$this->client = new \SoapClient($url, array('wsdl_cache' => $opt_cache, 'trace' => $opt_trace));
    }

    
    /** Permet d'appeler une fonction du webservice
     * 	@param		string	 	$fonction		Fonction du webservice à utiliser
     * 	@param		array	 	$listArgument		Tableau associatifs d'arguments pour la fonction (cle => valeur)
     * 	@return		object					Renvoie le résultat de la fonction du webservice utilisée
     */
    public function service($fonction, $listArgument = array()) {
	try {
	    return $this->client->__soapCall($fonction, $listArgument);
	} catch (\Exception $e) {
	    throw new \Exception('Erreur lors de l\'appel de la méthode ' . $fonction . ' du webservice : ' . $e->getMessage());
	    return null;
	}
    }

    
    /** Retourne la dernière réponse envoyée par le webservice (Si debug actif)
     * 	@return	string réponse XML renvoyée par le service
     */
    public function getLastResponse() {
	return $this->client->__getLastResponse();
    }

    
    /** Retourne la dernière requête envoyée au webservice (Si debug actif)
     * 	@return	string requête XML envoyée au service
     */
    public function getLastRequest() {
	$this->client->__getLastRequest();
    }
    
    
    /** Activer ou désactiver le cache WSDL
     * 	@param 		boolean 	$etat	    Activation du cache
     * 	@return		void
     */
    public function setWSDLCacheEnabled($etat) {
	if ($etat) {
	    ini_set('soap.wsdl_cache_enabled', '1');
	    ini_set('soap.wsdl_cache_ttl', 1);
	} else {
	    ini_set('soap.wsdl_cache_enabled', '0');
	    ini_set('soap.wsdl_cache_ttl', 0);
	}
    }

    
    /** Récupère l'état d'activation du cache WSDL
     * 	@return	    boolean	état d'activation
     */
    public function getWSDLCacheEnabled() {
	if (ini_get('soap.wsdl_cache_enabled') == '0') {
	    return false;
	} else {
	    return true;
	}
    }

    
    /** Récupère un tableau contenant la liste des méthodes disponibles sur le WebService
     * 	@return	    array   Tableau de méthodes
     */
    public function getMethodsList() {
	return $this->client->__getFunctions();
    }

}
