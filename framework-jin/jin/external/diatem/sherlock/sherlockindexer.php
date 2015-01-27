<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\dataformat\Json;
use jin\external\diatem\sherlock\SherlockCore;
use jin\external\diatem\sherlock\Sherlock;

/** Classe destinée à la gestion de l'indexation des données par Sherlock.
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
class SherlockIndexer extends SherlockCore {
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
    
    
    /**	Ajoute ou met à jour un document du référentiel
     * 
     * @param string $documentType  Type de document. Tel que défini dans le XML de configuration.
     * @param int|string $documentId	Identifiant unique du document. Peut être numérique ou alphanumérique.
     * @param array[array|int|string] $documentContent Tableau de données à indexer, sous la forme : array('fieldName1' => 'value1', 'fieldName2' => 'value2')
     * @return int|boolean  Retourne 1 si le document a été ajouté au référentiel, 2 si il a été mis à jour, FALSE en cas d'erreur.
     */
    public function addDocument($documentType, $documentId, $documentContent) {
	$jdata = Json::encode($documentContent);
	if (Json::getLastErrorCode() != 0) {
	    
	    parent::throwError('Erreur de transformation des données au format JSon : ' . Json::getLastErrorVerbose());
	    return false;
	}

	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/' . $documentType . '/' . $documentId, $jdata, 'POST');

	if ($retour) {
	    if (isset($retour['created'])) {
		return 1;
	    } else {
		return 2;
	    }
	} else {
	    return false;
	}
    }

    
    /**	Supprime un document du référentiel
     * 
     * @param string $documentType  Type de document. Tel que défini dans le XML de configuration.
     * @param int|string $documentId	Identifiant unique du document. Peut être numérique ou alphanumérique.
     * @return boolean	Echec ou réussite de la suppression
     */
    public function deleteDocument($documentType, $documentId) {
	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/' . $documentType . '/' . $documentId, null, 'DELETE');

	if ($retour) {
	    return $retour['found'];
	} else {
	    return false;
	}
    }
}