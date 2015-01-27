<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

use jin\lang\ArrayTools;
use jin\lang\ListTools;
use jin\dataformat\Json;
use jin\external\diatem\sherlock\searchcriterias\AbsoluteOnSingleTerm;
use jin\external\diatem\sherlock\searchcriterias\ApproximateOnSingleTerm;
use jin\external\diatem\sherlock\searchcriterias\ApproximateOnText;
use jin\external\diatem\sherlock\searchcriterias\AbsoluteOnText;
use jin\external\diatem\sherlock\searchcriterias\NumericRange;
use jin\external\diatem\sherlock\searchconditions\ConditionOnSingleTerm;
use jin\external\diatem\sherlock\searchconditions\ConditionOnNumericRange;
use jin\external\diatem\sherlock\SherlockResult;
use jin\external\diatem\sherlock\Sherlock;
use jin\external\diatem\sherlock\SherlockCore;
use jin\external\diatem\sherlock\SherlockFacets;
use jin\log\Debug;

/** Permet d'effectuer des recherches
 *
 *  @auteur     Loïc Gerard
 *  @version    0.0.1
 *  @check
 */
class SherlockSearch extends SherlockCore {

    /**
     *
     * @var \jin\external\diatem\sherlock\Sherlock    Instance d'un objet Sherlock
     */
    private $sherlock;

    /**
     *
     * @var array   Critères de recherche.
     */
    private $criterias = array();

    /**
     *
     * @var array Condition de recherche.
     */
    private $conditions = array();

    /**
     *
     * @var string Liste des types de documents concernés par la recherche
     */
    private $documentTypes = '';

    /**
     *
     * @var string  Mode d'application des conditions. (or ou and)
     */
    private $conditionOperator = 'and';

    /**
     *
     * @var int Nombre maximum de résultats recherchés
     */
    private $maxResults = -1;

    /**
     *
     * @var int Index de début de parsing
     */
    private $index = 0;

    /**
     *
     * @var init Nombre minimum de critères devant être réussis pour qu'un résultat soit retourné
     */
    private $minimumShouldMatch = null;
    private $sherlockfacets = array();

    /** Constructeur
     *
     * @param \jin\external\diatem\sherlock\Sherlock $sherlock  Instance d'un objet Sherlock
     */
    public function __construct(Sherlock $sherlock) {
        $this->sherlock = $sherlock;
        parent::__construct($this->sherlock);
    }

    //--------------------------------------------------------------------------
    //DEFINITION DES CRITERES ET CONDITIONS DE LA RECHERCHE

    /** Ajoute une condition sur un terme EXACT. Une condition dois TOUJOURS être respectée pour qu'un resultat soit retourné.
     *
     * @param string $value Terme exact
     * @param string $fieldNames    Liste des champs dans lesquels effectuer la recherche. (Séparés par des virgules, sans espaces)
     * @return boolean  Succes ou echec
     */
    public function addCondition($value, $fieldNames) {
        $this->conditions[] = new ConditionOnSingleTerm(ListTools::toArray($fieldNames), $value);

        return true;
    }

    /** Ajoute une condition portant sur une plage de valeurs. (Adapté aux champs de type DATE et NUMERIQUES) Une condition dois TOUJOURS être respectée pour qu'un resultat soit retourné.
     *
     * @param numeric|string $minValue  Valeur de bas de plage.
     * @param numeric|string $maxValue  Valeur de haut de plage.
     * @param string $fieldNames    Liste des champs dans lesquels effectuer la recherche. (Séparés par des virgules, sans espaces)
     * @return boolean  Succes ou echec
     */
    public function addRangeCondition($minValue, $maxValue, $fieldNames) {
        $this->conditions[] = new ConditionOnNumericRange(ListTools::toArray($fieldNames), array($minValue, $maxValue));
        return true;
    }

    /** Ajoute un critère de recherche portant sur un terme unique.
     *
     * @param string $value     Terme recherché
     * @param string $fieldNames    Liste des champs dans lesquels effectuer la recherche. (Séparés par des virgules, sans espaces)
     * @param boolean $approximate  [optionel] Définit si la recherche doit porter sur le terme EXACT (FALSE) ou sur une approximation (TRUE). (TRUE par défaut)
     * @return boolean  Succes ou echec
     */
    public function addSingleTermCriteria($value, $fieldNames, $approximate = true) {
        if ($approximate) {
            $this->criterias[] = new ApproximateOnSingleTerm(ListTools::toArray($fieldNames), $value);
        } else {
            $this->criterias[] = new AbsoluteOnSingleTerm(ListTools::toArray($fieldNames), $value);
        }
        return true;
    }

    /** Ajoute un critère de recherche portant sur une chaîne de caractère pouvant comprendre plusieurs termes.
     *
     * @param string $value     Termes ou phrase recherchée
     * @param string $fieldNames    Liste des champs dans lesquels effectuer la recherche. (Séparés par des virgules, sans espaces)
     * @param type $approximate     [optionel] Définit si la recherche doit porter sur le terme EXACT (FALSE) ou sur une approximation (TRUE). (TRUE par défaut)
     * @return boolean  Succes ou echec
     */
    public function addTextCriteria($value, $fieldNames, $approximate = true) {
        if ($approximate) {
            $this->criterias[] = new ApproximateOnText(ListTools::toArray($fieldNames), $value);
        } else {
            $this->criterias[] = new AbsoluteOnText(ListTools::toArray($fieldNames), $value);
        }
        return true;
    }

    /** Ajoute un critère de recherche portant sur une plage de valeurs. S'applique essentiellement à des champs de type DATE ou NUMERIQUES.
     *
     * @param numeric|string $minValue  Valeur de bas de plage.
     * @param numeric|string $maxValue  Valeur de haut de plage.
     * @param string $fieldNames    Liste des champs dans lesquels effectuer la recherche. (Séparés par des virgules, sans espaces)
     * @return boolean  Succes ou echec
     */
    public function addRangeCriteria($minValue, $maxValue, $fieldNames) {

        $this->criterias[] = new NumericRange(ListTools::toArray($fieldNames), array($minValue, $maxValue));
        return true;
    }

    /** Ajoute un type de document dans lequel effectuer la recherche.
     *
     * @param string $documentType  Nom du type de document. Doit correspondre à ce qui est défini dans le XML d'initialisation de l'application.
     * @return boolean  Succes ou echec
     */
    public function addDocumentType($documentType) {
        if (!ListTools::contains($this->documentTypes, $documentType)) {
            $this->documentTypes = ListTools::append($this->documentTypes, $documentType);
            return true;
        }
        return false;
    }

    /** Modifie le mode d'application des conditions en optant pour un mode Cumulatif (toutes les conditions doivent être justes)
     *
     */
    public function setConditionOperatorToAnd() {
        $this->conditionOperator = 'and';
    }

    /** Modifie le mode d'application des conditions en optant pour un mode optionnel. (Une condition au moins doit être juste)
     *
     */
    public function setConditionOperatorToOr() {
        $this->conditionOperator = 'or';
    }

    /** Définit le nombre maximal de résultats qui seront retournés. -1 pour ne définir aucune limite.
     *
     * @param int $nb   Nombre max de résultats
     */
    public function setResultNbLimit($nb) {
        $this->maxResults = $nb;
    }

    /** Définit l'index de début de parsing
     *
     * @param int $index    Index de début de parsing
     */
    public function setIndex($index) {
        $this->index = $index;
    }

    /** Définit le nombre maximum de critères qui doivent être justes pour qu'un résultat soit retourné. Si le nombre transmis est supérieur au nombre de critères cette option ne s'appliquera pas.
     *
     * @param int $nb   Nombre de critères
     */
    public function setMinimumShouldMatch($nb) {
        $this->minimumShouldMatch = $nb;
    }

    public function addFacet($facetObject) {
        $this->sherlockfacets[] = $facetObject;
    }

    //--------------------------------------------------------------------------
    //GETTERS

    /** Renvoie le mode d'application des conditions. (or ou and)
     *
     * @return string   Mode d'application des conditions (or ou and)
     */
    public function getConditionOperator() {
        return $this->searchOperator;
    }

    /** Retourne le nombre maximal de résultats qui seront retournés. -1 si pas de limite.
     *
     * @return int  Nombre max de résultats.
     */
    public function getResultNbLimit() {
        return $this->maxResults;
    }

    /** Retourne l'index de début de parsing
     *
     * @return int  Index de début de parsing
     */
    public function getIndex() {
        return $this->index;
    }

    /** Retourne le nombre maximum de critères qui doivent être justes pour qu'un résultat soit retourné.
     *
     * @return int  Nombre de critères
     */
    public function getMinimumShouldMatch() {
        return $this->minimumShouldMatch;
    }

    /** Retourne les paramètres qui seront transmis à Sherlock pour effectuer la recherche. Au format Json.
     *
     * @return string   Query JSon
     */
    public function getJsonQuery() {
        $callParams = array();
        $callParams['query'] = array();

        //Ajout des critères de recherche
        if (count($this->criterias) > 0 || count($this->conditions) > 0) {
            $callParams['query']['bool'] = array();

            if (count($this->criterias) > 0) {
                $callParams['query']['bool']['must'] = array();
                foreach ($this->criterias as $criteria) {
                    $callParams['query']['bool']['must'] = ArrayTools::merge($callParams['query']['bool']['must'], $criteria->getParamArray());
                }

                //Directif minimum should match (doit au minimum avoir une clause de juste, ou un pourcentage)
                if (!is_null($this->minimumShouldMatch)) {
                    $callParams['query']['bool']['minimum_should_match'] = $this->minimumShouldMatch;
                }
            }

            //NEW !
            $facetQuery = false;
            foreach ($this->sherlockfacets as $facet) {
                if ($facet->getArgArrayForSearchQuery()) {
                    $facetQuery = true;
                    break;
                }
            }

            if (count($this->conditions) > 0 || $facetQuery) {
                //$callParams['query']['bool']['must'] = array();
                foreach ($this->conditions as $condition) {
                    $callParams['query']['bool']['must'] = ArrayTools::merge($callParams['query']['bool']['must'], $condition->getParamArray());
                }
                foreach ($this->sherlockfacets as $facet) {
                    if ($facet->getArgArrayForSearchQuery()) {
                        $callParams['query']['bool']['must'] = ArrayTools::merge($callParams['query']['bool']['must'], $facet->getArgArrayForSearchQuery());
                    }
                }
            }
        }



    //Ajout des conditions (filtres absolus)
    /*
    if(count($this->conditions) > 0 || $facetQuery) {
        $callParams['query']['constant_score'] = array();
        $callParams['query']['constant_score']['filter'] = array();
        $callParams['query']['constant_score']['filter'][$this->conditionOperator] = array();
        foreach($this->conditions as $condition){
            $callParams['query']['constant_score']['filter'][$this->conditionOperator] = ArrayTools::merge($callParams['query']['constant_score']['filter'][$this->conditionOperator], $condition->getParamArray());
        }
        foreach ($this->sherlockfacets as $facet){
            if($facet->getArgArrayForSearchQuery()){
                $callParams['query']['constant_score']['filter'][$this->conditionOperator] = ArrayTools::merge($callParams['query']['constant_score']['filter'][$this->conditionOperator], $facet->getArgArrayForSearchQuery());
            }
        }
    }
    */

        //Ajout des facets
        if (count($this->sherlockfacets) > 0) {
            $callParams['aggregations'] = array();
            foreach ($this->sherlockfacets as $facet) {
                $callParams['aggregations'] = ArrayTools::merge($callParams['aggregations'], $facet->getArgArrayForAggregate());
            }
        }

        return Json::encode($callParams);
    }

    //--------------------------------------------------------------------------
    //RECHERCHE

    /** Effectue la recherche. Retourne FALSE ou un objet SherlockResult.
     *
     * @return boolean|\jin\external\diatem\sherlock\SherlockResult Objet SherlockResult décrivant les données issues de la recherche
     */
    public function search() {
        if (count($this->conditions) == 0 && count($this->criterias) == 0) {
            parent::throwError('Vous ne pouvez pas effectuer de recherche sans définir de conditions ou de critères de recherche.');
            return false;
        }

        //base
        $callString = $this->sherlock->getAppzCode() . '/';

        //Recherche dans tous les documentTypes ou dans les documentType spécifiés
        if ($this->documentTypes != '') {
            $callString .= $this->documentTypes . '/';
        }

        //base
        $callString .= '_search?sort=_score';

        //si limite en nb de résultats
        if ($this->maxResults > 0) {
            $callString .= '&size=' . $this->maxResults;
        }

        //On spécifie l'index (0 par défaut)
        $callString .= '&from=' . $this->index;


        //On initialise l'array servant à déterminer le Json envoyé à elesticSearch
        $callParamsJson = $this->getJsonQuery();

        if (!$callParamsJson) {
            parent::throwError('Une erreur a eu lieu lors de la transformation des parametres au format Json : ' . Json::getLastErrorVerbose());
            return false;
        }

        $retour = parent::callMethod($callString, $callParamsJson, 'XGET');
        if (!$retour) {
            parent::throwError('Une erreur ElasticSearch a eu lieu : ' . $this->sherlock->getLastServerResponse());
            return false;
        }

        if (isset($retour['status']) && $retour['status'] != 200) {
            parent::throwError('Une erreur ElasticSearch a eu lieu : ' . $this->sherlock->getLastServerResponse());
            return false;
        }

        //Debug::dump($retour);
        //Data facets
        foreach ($this->sherlockfacets as $facet) {
            $data = array();
            if (isset($retour['aggregations'][$facet->getName()])) {
                $data = array_map(function($item) {
                    // Remove empty facets
                    return array_filter($item, function($v) {
                        return $v['key'];
                    });
                }, $retour['aggregations'][$facet->getName()]);
            }
            $facet->setESReturnData($data);
        }


        return new SherlockResult($retour, $this->index);
    }

}
