<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\external\diatem\sherlock\SherlockCore;
use jin\external\diatem\sherlock\Sherlock;
use jin\log\Debug;
use jin\filesystem\File;
use jin\dataformat\Json;

/** Permet la configuration distante d'un serveur Sherlock.
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check
 */
class SherlockConfig extends SherlockCore {

    /**
     *
     * @var \jin\external\diatem\sherlock\Sherlock    Instance d'un objet Sherlock
     */
    private $sherlock;


    /**	Initialise un objet permettant la configuration distante d'un serveur Sherlock.
     *
     * @param \jin\external\diatem\sherlock\Sherlock $sherlock	Instance d'un objet Sherlock correctement initialisé
     */
    public function __construct(Sherlock $sherlock) {
	$this->sherlock = $sherlock;
	parent::__construct($this->sherlock);
    }


    /**	Permet d'initialiser Sherlock pour un environnement spécifique.
     *	L'initialisation crée un index sur le serveur Sherlock, supprime cet
     *	index et les données associées si elles existaient, génère la configuration
     *	et les types de données en fonction du fichier de configuration XML
     *	transmis en paramètre. Attention en cas de modification de ce fichier
     *	XML il faudra réinitialiser à nouveau l'espace de nom et réindexer toutes
     *	les données.
     *
     * @param string $xmlConfigFilePath	Chemin ou absolu du fichier XML de configuration.
     * @return	boolean	Succès ou échec de l'initialisation
     *  Se référer à la documentation pour connaitre la syntaxe à respecter.
     */
    public function initializeApplication($xmlConfigFilePath) {
	//Suppression des données existantes
	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/', null, 'DELETE');

	//Lecture du fichier XML
	$file = new File($xmlConfigFilePath);
	$fileContent = $file->getContent();
	$xml = new \SimpleXMLElement($fileContent);

	//Création des paramètres d'appel
	$mapping = array();

	//Création des tokenizers pour la gestion de l'autocompletion
	$mapping['settings'] = array();
	$mapping['settings']['analysis'] = array();
	$mapping['settings']['analysis']['filter'] = array();
	$mapping['settings']['analysis']['filter']['nGram_filter'] = array();
	$mapping['settings']['analysis']['filter']['nGram_filter']['type'] = 'nGram';
	$mapping['settings']['analysis']['filter']['nGram_filter']['min_gram'] = 2;
	$mapping['settings']['analysis']['filter']['nGram_filter']['max_gram'] = 20;
	$mapping['settings']['analysis']['filter']['nGram_filter']['token_chars'] = array('letter', 'digit', 'punctuation', 'symbol');

	$mapping['settings']['analysis']['analyzer'] = array();
	$mapping['settings']['analysis']['analyzer']['nGram_analyzer'] = array();
	$mapping['settings']['analysis']['analyzer']['nGram_analyzer']['type'] = 'custom';
	$mapping['settings']['analysis']['analyzer']['nGram_analyzer']['tokenizer'] = 'whitespace';
	$mapping['settings']['analysis']['analyzer']['nGram_analyzer']['filter'] = array('lowercase', 'asciifolding', 'nGram_filter');

	$mapping['settings']['analysis']['analyzer']['whitespace_analyzer'] = array();
	$mapping['settings']['analysis']['analyzer']['whitespace_analyzer']['type'] = 'custom';
	$mapping['settings']['analysis']['analyzer']['whitespace_analyzer']['tokenizer'] = 'whitespace';
	$mapping['settings']['analysis']['analyzer']['whitespace_analyzer']['filter'] = array('lowercase', 'asciifolding');

	//Analyzer pour les recherches sur des données destinées à des facets
	$mapping['settings']['analysis']['analyzer']['facetanalyzer'] = array();
	$mapping['settings']['analysis']['analyzer']['facetanalyzer']['type'] = 'custom';
	$mapping['settings']['analysis']['analyzer']['facetanalyzer']['tokenizer'] = 'keyword';
	$mapping['settings']['analysis']['analyzer']['facetanalyzer']['filter'] = array();

	//Création du mapping
	$mapping['mappings'] = array();
	for ($i = 0; $i < count($xml->documentType); $i++) {
	    $documentTypeName = (string) $xml->documentType[$i]->documentTypeName;

	    //On crée l'entrée dans mapping
	    $mapping['mappings'][$documentTypeName] = array();

	    //On générère _all pour l'autocompletion
	    $mapping['mappings'][$documentTypeName]['_all'] = array();
	    $mapping['mappings'][$documentTypeName]['_all']['index_analyzer'] = 'nGram_analyzer';
	    $mapping['mappings'][$documentTypeName]['_all']['search_analyzer'] = 'whitespace_analyzer';

	    $mapping['mappings'][$documentTypeName]['properties'] = array();

	    for ($j = 0; $j < count($xml->documentType[$i]->fields->field); $j++) {
		$fieldName = (string) $xml->documentType[$i]->fields->field[$j]->fieldName;

		//On crée le noeud dans les propriétés du mapping
		$mapping['mappings'][$documentTypeName]['properties'][$fieldName] = array();

		for ($k = 0; $k < count($xml->documentType[$i]->fields->field[$j]->option); $k++) {
		    $optionName = (string) $xml->documentType[$i]->fields->field[$j]->option[$k]['name'];
		    $optionValue = (string) $xml->documentType[$i]->fields->field[$j]->option[$k];

		    //On définit le couple nom/valeur dans le mapping

		    if ($optionValue == 'true') {
			$optionValue = true;
		    } elseif ($optionValue=='false') {
			$optionValue = false;
		    }

		    $mapping['mappings'][$documentTypeName]['properties'][$fieldName][$optionName] = $optionValue;
		}
	    }

	}
	//Conversion en Json
	$jsonContent = Json::encode($mapping);
	$retour = parent::callMethod($this->sherlock->getAppzCode() . '' , $jsonContent);

	if(!isset($retour['acknowledged']) || !$retour['acknowledged']){
	    parent::throwError('Impossible d\'initialiser l\'application : '.$this->sherlock->getLastError());
	    return false;
	}

	return true;
    }


    /**	Retourne les types de documents supportés par l'environnement courant
     * utilisé pour Sherlock. Retourne FALSE si la connexion est impossible.
     *
     * @return array|boolean	Retourne un tableau contenant les informations sur les
     * types de documents configurés sur l'environnement courant de Sherlock.
     * retourne FALSE si la connexion est impossible.
     */
    public function getDocumentTypes() {
	$retour = parent::callMethod($this->sherlock->getAppzCode() . '/_mapping', null);

	if ($retour) {
	    return $retour;
	} else {
	    return false;
	}
    }


    /**	Retourne la configuration complète du serveur Sherlock sous forme de tableau
     *
     * @return	array|boolean	Un tableau contenant les informations sur la configuration
     * du serveur Sherlock, FALSE en cas de connexion impossible
     */
    function getNodesInfo(){
	$retour = parent::callMethod('_nodes', null, false);

	if ($retour) {
	    return $retour;
	} else {
	    return false;
	}
    }
}
