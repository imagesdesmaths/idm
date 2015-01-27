<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\components\ui\table;

use jin\output\components\ui\UIComponent;
use jin\output\components\ComponentInterface;
use jin\query\QueryResult;
use jin\lang\ArrayTools;
use jin\filesystem\AssetFile;
use jin\lang\StringTools;
use jin\log\Debug;
use jin\lang\ListTools;
use jin\output\components\ui\table\TableModel;

/** Composant UI Table (à utiliser en adjonction à un objet QueryResult)
 *  @auteur     Loïc Gerard
 */
class Table extends UIComponent implements ComponentInterface{
    //--------------------------------------------------------------------------
    //PARAMETRES


    /**
     *
     * @var jin\query\QueryResult   Datasource du composant
     */
    private $datasource;


    /**
     *
     * @var array   Tableau des noms de colonnes
     */
    private $headers;


    /**
     *
     * @var string  Prefixe utilisé pour les IDS des cellules header
     */
    private $header_td_idPrefix = '_header_';


    /**
     *
     * @var string  Préfixe utilisé pour les IDS des cellules standard
     */
    private $line_td_idPrefix = '_line_';


    /**
     *
     * @var int Index de début de parsing
     */
    private $startIndex = 0;


    /**
     *
     * @var int Index de fin de parsing
     */
    private $endIndex = -1;


    /**
     *
     * @var jin\output\components\ui\table\TableModel   Instance de TableModel définissant les règles d'affichage des cellules.
     */
    private $tableModel;


    //--------------------------------------------------------------------------
    //TEMPLATES


    /**
     *
     * @var string  Template des élément TH
     */
    private $th_template;


    /**
     *
     * @var string  Template des élément TR
     */
    private $tr_template;


    /**
     *
     * @var string  Template des élément TD
     */
    private $td_template;


    /**
     *
     * @var string  Template des élément TD alternés
     */
    private $td_alternate_template;


    /**
     *
     * @var string  Template des élément THEAD
     */
    private $thead_template;


    /**
     *
     * @var string  Template des élément TBODY
     */
    private $tbody_template;


    //--------------------------------------------------------------------------
    //CLASSES CSS APPLIQUABLES AUX ELEMENTS

    /**
     *
     * @var string  Classes CSS appliquées aux éléments TH
     */
    private $th_classes = '';


    /**
     *
     * @var string  Classes CSS appliquées aux éléments TR
     */
    private $tr_classes = '';


    /**
     *
     * @var string  Classes CSS appliquées aux éléments TD
     */
    private $td_classes = '';


    /**
     *
     * @var string  Classes CSS appliquées aux éléments TD alternés
     */
    private $td_alternate_classes = '';


    /**
     *
     * @var string  Classes CSS appliquées aux éléments THEAD
     */
    private $thead_classes = '';


    /**
     *
     * @var string  Classes CSS appliquées aux éléments TBODY
     */
    private $tbody_classes = '';


    /**
     *
     * @var string  Classes CSS appliquées par colonnes
     */
    private $col_classes = '';


    /**
     * Constructeur
     * @param string $name  Nom du composant
     */
    public function __construct($name){
    parent::__construct($name, 'ui_table');

    $this->tableModel = new TableModel();
    }


    /**
     * Effectue le rendu du composant
     * @return string
     */
    public function render(){
    $html = parent::render();
    $html = $this->renderHeaders($html);
    $html = $this->renderLines($html);

    return $html;
    }


    /**
     * Définit les en-tête de colonne
     * @param array $headers    Noms des en-tête de colonne
     */
    public function setHeaders($headers){
    $this->headers = $headers;
    }


    /**
     * Définit un TableModel appliquable à ce composant
     * @param \jin\output\components\ui\table\TableModel $tm    TableModel Appliquable
     */
    public function setTableModel(TableModel $tm){
    $this->tableModel = $tm;
    }


    /**
     * Définit la Datasource (QueryResult) appliquable au composant.
     * @param \jin\query\QueryResult $datasource
     */
    public function setDataSource(QueryResult $datasource){
    $this->datasource = $datasource;
    }


    /**
     * Retourne la datasource (QueryResult) utilisé par le composant
     * @return \jin\query\QueryResult
     */
    public function getDataSource(){
    return $this->datasource;
    }


    /**
     * Redéfinit les index de parsing. Pour un affichage partiel.
     * @param int $startIndex   Index de début de parsing
     * @param int $endIndex Index de fin de parsing
     */
    public function setParsingIndexes($startIndex, $endIndex = -1){
    $this->startIndex = $startIndex;
    $this->endIndex = $endIndex;
    }


    /**
     * Ajoute une classe CSS au style TD pour appliquer en alternance sur les TD
     * @param type $cssClass    Classe CSS à appliquer
     * @return boolean
     */
    public function addtdAlternateClass($cssClass){
    if (!ListTools::contains($this->td_alternate_classes, $cssClass)) {
        $this->td_alternate_classes = ListTools::append($this->td_alternate_classes, $cssClass);
        return true;
    }
    return false;
    }


    /**
     * Ajoute une classe CSS à un élement du composant
     * @param type $cssClass    Classe CSS à appliquer
     * @param type $element Element sur lequel appliquer. Element possibles : td,tr,th,tbody,thead
     * @return boolean
     * @throws \Exception
     */
    public function addElementClass($cssClass, $element){
    if(StringTools::toLowerCase($element) == 'tr'){
        if(!ListTools::contains($this->tr_classes, $cssClass)){
        $this->tr_classes = ListTools::append($this->tr_classes, $cssClass);
        return true;
        }
        return false;
    }else if(StringTools::toLowerCase($element) == 'td'){
        if(!ListTools::contains($this->td_classes, $cssClass)){
        $this->td_classes = ListTools::append($this->td_classes, $cssClass);
        return true;
        }
        return false;
    }else if(StringTools::toLowerCase($element) == 'th'){
        if(!ListTools::contains($this->th_classes, $cssClass)){
        $this->th_classes = ListTools::append($this->th_classes, $cssClass);
        return true;
        }
    }else if(StringTools::toLowerCase($element) == 'tbody'){
        if(!ListTools::contains($this->tbody_classes, $cssClass)){
        $this->tbody_classes = ListTools::append($this->tbody_classes, $cssClass);
        return true;
        }
        return false;
    }else if(StringTools::toLowerCase($element) == 'thead'){
        if(!ListTools::contains($this->thead_classes, $cssClass)){
        $this->thead_classes = ListTools::append($this->thead_classes, $cssClass);
        return true;
        }
        return false;
    }else{
        throw new \Exception('Element '.$element.' non reconnu');
        return false;
    }
    }


    /**
     * Ajoute une classe CSS à une colonne du composant
     * @param string $cssClass    Classe CSS à appliquer
     * @param string|int $column  Colonne sur laquelle appliquer la classe.
     * @return boolean
     */
    public function addColumnClass($cssClass, $column){
    if(!isset($this->col_classes[$column])){
        $this->col_classes[$column] = $cssClass;
        return true;
    }
    if(!ListTools::contains($this->col_classes[$column], $cssClass)){
    $this->tr_classes = ListTools::append($this->tr_classes, $cssClass);
    return true;
    }
    return false;
    }


    /**
     * Effectue le rendu des headers
     * @param string $html  Html généré
     * @return string
     * @throws \Exception
     */
    private function renderHeaders($html){
    //On génère le contenu du TH
    $thead_content = $this->getTheadTemplate();

    //On génère le contenu du TR
    $tr_content = $this->getTrTemplate();

    //On génère les headers qui doivent etre utilisés
    $headersUsed;
    if($this->headers){
        $hc = ArrayTools::length($this->datasource->getHeaders());
        if($hc==0){
        $hc = ArrayTools::length($this->headers);
        }
        if($hc != ArrayTools::length($this->headers)){
        throw new \Exception('Le nombre d\'en-tête de colonne transmis dans les headers ne correspond pas aux données');
        }
        $headersUsed = $this->headers;
    }else{
        $headersUsed = $this->datasource->getHeaders();
    }

    //On génère le contenu du TD (global)
    $th_content = $this->getThTemplate();

    //On génère les colonnes
    $cols = '';
    $colI = 0;
    foreach($headersUsed as $h){
        $hc = $th_content;
        $hc = StringTools::replaceAll($hc, '%id%', $this->name.$this->header_td_idPrefix.$colI);
        $hc = StringTools::replaceAll($hc, '%value%', $h);

        if(isset($this->col_classes[$h])){
        $hc = StringTools::replaceAll($hc, '%columnclass%', $this->col_classes[$h]);
        }else{
        $hc = StringTools::replaceAll($hc, '%columnclass%', '');
        }
        $cols .= $hc;

        $colI++;
    }

    //On remplace dans le TH
    $tr_content = StringTools::replaceAll($tr_content, '%items%', $cols);

    //On remplace dans le THead
    $thead_content = StringTools::replaceAll($thead_content, '%items%', $tr_content);

    //On remplace dans le HTML
    $html = StringTools::replaceAll($html, '%headers%', $thead_content);

    return $html;
    }


    /**
     * Effectue le rendu des lignes
     * @param string $html  Html généré
     * @return string
     */
    private function renderLines($html){
    $tbody_content = $this->getTbodyTemplate();

    $this->datasource->limitResults($this->startIndex, $this->endIndex);

    $lines = '';
    $i = 0;
    foreach($this->datasource as $l){
        $lines .= $this->renderLine($l, $i);
        $i++;
    }

    $tbody_content = StringTools::replaceAll($tbody_content, '%items%', $lines);
    $html = StringTools::replaceAll($html, '%items%', $tbody_content);

    return $html;
    }


    /**
     * Effectue le rendu d'une ligne
     * @param array $line   Données de la ligne
     * @param int $lineNum  Numéro de la ligne
     * @return string
     */
    private function renderLine($line, $lineNum){
    //On génère le contenu du TR
    $tr_content = $this->getTrTemplate();

    //On génère le contenu du TD (global)
    if($lineNum%2 == 0){
        $td_content = $this->getTdTemplate(false);
    }else{
        $td_content = $this->getTdTemplate(true);
    }


    //On génère les colonnes
    $heads = $this->datasource->getHeaders();
    $cols = '';
    $colI = 0;
    foreach($heads as $h){
        $hc = $td_content;
        $hc = StringTools::replaceAll($hc, '%id%', $this->name.$this->header_td_idPrefix.$colI.'_'.$lineNum);

        $headName = '';
        if(isset($this->headers[$colI])){
        $headName = $this->headers[$colI];
        }
        $hc = StringTools::replaceAll($hc, '%value%', $this->tableModel->renderCell($this->name, $h, $headName, $colI, $lineNum, $line[$h]));

        if(isset($this->col_classes[$h])){
        $hc = StringTools::replaceAll($hc, '%columnclass%', $this->col_classes[$h]);
        }else{
        $hc = StringTools::replaceAll($hc, '%columnclass%', '');
        }

        $cols .= $hc;

        $colI++;
    }

    //On remplace dans le TH
    $tr_content = StringTools::replaceAll($tr_content, '%items%', $cols);


    return $tr_content;
    }


    /**
     * Retourne la template d'un élément de type TH
     * @return string
     */
    private function getThTemplate(){
    if($this->th_template){
        return $this->th_template;
    }
    $th = new AssetFile($this->componentName.'/th.tpl');
    $th_content = $th->getContent();
    $th_content = StringTools::replaceAll($th_content, '%class%', '%columnclass%' . ListTools::changeDelims($this->th_classes, ',', ' '));
    $this->th_template = $th_content;
    return $this->th_template;
    }


    /**
     * Retourne la template d'un élément de type TD
     * @return string
     */
    private function getTdTemplate($alternate = false){
    if($alternate){
        if($this->td_alternate_template){
        return $this->td_alternate_template;
        }
        $td = new AssetFile($this->componentName.'/td.tpl');
        $td_content = $td->getContent();
        $allClasses = ArrayTools::toList(ArrayTools::merge(ListTools::toArray($this->td_classes),ListTools::toArray($this->td_alternate_classes)), ' ');
        $td_content = StringTools::replaceAll($td_content, '%class%', '%columnclass%' . $allClasses);
        $this->td_alternate_template = $td_content;
        return $this->td_alternate_template;
    }else{
        if($this->td_template){
        return $this->td_template;
        }
        $td = new AssetFile($this->componentName.'/td.tpl');
        $td_content = $td->getContent();
        $td_content = StringTools::replaceAll($td_content, '%class%', '%columnclass%' . ListTools::changeDelims($this->td_classes, ',', ' '));
        $this->td_template = $td_content;
        return $this->td_template;
    }
    }


    /**
     * Retourne la template d'un élément de type TR
     * @return string
     */
    private function getTrTemplate(){
    if($this->tr_template){
        return $this->tr_template;
    }
    $tr = new AssetFile($this->componentName.'/tr.tpl');
    $tr_content = $tr->getContent();
    $tr_content = StringTools::replaceAll($tr_content, '%class%', ListTools::changeDelims($this->tr_classes, ',', ' '));
    $this->tr_template = $tr_content;
    return $this->tr_template;
    }


    /**
     * Retourne la template d'un élément de type THEAD
     * @return string
     */
    private function getTheadTemplate(){
    if($this->thead_template){
        return $this->thead_template;
    }
    $thead = new AssetFile($this->componentName.'/thead.tpl');
    $thead_content = $thead->getContent();
    $thead_content = StringTools::replaceAll($thead_content, '%class%', ListTools::changeDelims($this->thead_classes, ',', ' '));
    $this->thead_template = $thead_content;
    return $this->thead_template;
    }


    /**
     * Retourne la template d'un élément de type TBODY
     * @return string
     */
    private function getTbodyTemplate(){
    if($this->tbody_template){
        return $this->tbody_template;
    }
    $tbody = new AssetFile($this->componentName.'/tbody.tpl');
    $tbody_content = $tbody->getContent();
    $tbody_content = StringTools::replaceAll($tbody_content, '%class%', ListTools::changeDelims($this->tbody_classes, ',', ' '));
    $this->tbody_template = $tbody_content;
    return $this->tbody_template;
    }


}