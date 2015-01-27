<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\log\Debug;
use jin\external\diatem\sherlock\SherlockResult;
use jin\external\diatem\sherlock\SherlockCore;
use jin\external\diatem\sherlock\Sherlock;


/** Classe permettant d'effectuer diverses opérations annexes sur Sherlock.
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class SherlockUtils extends SherlockCore {
    /**
     *
     * @var \jin\external\diatem\sherlock\Sherlock    Instance d'un objet Sherlock
     */
    private $sherlock;

    
    /**	Constructeur
     * 
     * @param \jin\external\diatem\sherlock\Sherlock $sherlock	 Instance d'un objet Sherlock
     */
    public function __construct(Sherlock $sherlock) {
	$this->sherlock = $sherlock;
	parent::__construct($this->sherlock);
    }

    
    /**	Analyse les termes d'un document spécifié. Retourne le résultat de l'analyse effectuée par Sherlock. FALSE en cas d'erreur.
     * 
     * @param string $documentType  Nom du type de document. Tel que spécifié dans le document XML d'initialisation de l'application.
     * @param int|string $documentId	Identifiant unique du document à analyser
     * @return array|boolean	Retourne FALSE en cas d'erreur.
     */
    public function analyseTermsOfADocument($documentType, $documentId) {
	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/' . $documentType . '/' . $documentId . '/_termvector', null);

	if(!$retour){
	    parent::throwError('Impossible d\'analyser le document '.$documentType.':'.$documentId.' : '.parent::getLastError());
	    return false;
	}else{
	    return $retour;
	}
    }

    
    /**	Retourne les données indexées d'un document spécifié. FALSE en cas d'erreur.
     * 
     * @param string $documentType  Nom du type de document. Tel que spécifié dans le document XML d'initialisation de l'application.
     * @param int|string $documentId	Identifiant unique du document à analyser
     * @return array|boolean	Retourne FALSE en cas d'erreur.
     */
    public function getDocument($documentType, $documentId) {
	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/' . $documentType . '/' . $documentId, null);

	if ($retour) {
	    return $retour;
	} else {
	    return false;
	}
    }

    
    /**	Effectue une recherche rapide sur l'ensemble des champs pour procéder à des suggestions de résultats.
     * 
     * @param string $search	Termes recherchés
     * @param string $documentType  Nom du type de document. Tel que spécifié dans le document XML d'initialisation de l'application. On pourra fournir une liste de types de documents séparés par des virgules, sans espaces.
     * @param int $maxResults	[optionel] Nombre maximum de résultats à retourner. 10 par défaut.
     * @return \jin\external\diatem\sherlock\SherlockResult
     */
    public function autoCompleteSuggestions($search, $documentType = '', $maxResults = 10){
	$json = '{
	    "size": '.$maxResults.',
	    "query": {
	       "match": {
		  "_all": {
		     "query": "' . $search . '",
		     "operator": "and"
		  }
	       }
	    }
	 }';
	
	if ($documentType != ''){
	    $documentType .= '/';
	}

	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/' . $documentType. '_search', $json);
	return new SherlockResult($retour, 0);
    }
}
