<?php
/**
* Jin Framework
* Diatem
*/
namespace jin\output\components\ui\table;

use jin\output\components\ui\UIComponent;
use jin\output\components\ComponentInterface;
use jin\output\components\ui\table\Table;
use jin\query\QueryResult;
use jin\lang\NumberTools;
use jin\lang\StringTools;
use jin\lang\ListTools;
use jin\log\Debug;
use jin\filesystem\AssetFile;

/** Composant UI Pagination (à utiliser obligatoirement en adjonction à un composant UI Table)
* 	@auteur		Loïc Gerard, Samuel Marchal
*/
class Pagination extends UIComponent implements ComponentInterface {
    //--------------------------------------------------------------------------
    //PARAMETRES

    /**
    *
    * @var jin\output\components\ui\table\Table    Composant UI Table sur lequel effectuer la pagination
    */
    private $targetTableComponent;


    /**
    *
    * @var int	Nombre maximum de résultats par page
    */
    private $maxByPage = 20;


    /**
    *
    * @var boolean Préserve les autres paramètres GET
    */
    private $preserveQueryString = true;


    /**
    *
    * @var int	Page courante
    */
    private $currentPage = 1;


    /**
    *
    * @var string  Nom de l'argument transmis en GET pour modifier la pagination (Dans un fonctionnement classique)
    */
    private $getArgument = 'p';


    /**
    *
    * @var int Nombre max de pages affichées (nombre impaire)
    */
    private $maxShowedPages = 3;


    //--------------------------------------------------------------------------
    //PARAMETRES automatiquement déterminés


    /**
    *
    * @var boolean Définit que l'utilisateur a forcé l'affichage d'une page spécifique. (Sinon déterminé automatiquement)
    */
    private $forcedPage = false;


    /**
    *
    * @var int	Nombre de pages
    */
    private $nbPages = 0;


    /**
    *
    * @var int	Nombre total de résultats
    */
    private $resultsCount;


    //--------------------------------------------------------------------------
    //TEMPLATES


    /**
    *
    * @var string  Template utilisée pour le lien de la première page
    */
    private $first_template;


    /**
    *
    * @var string  Template utilisée pour le lien de la dernière page
    */
    private $last_template;


    /**
    *
    * @var string  Template utilisée pour le lien d'une page
    */
    private $page_template;


    /**
    *
    * @var string  Template utilisée pour le lien de la page sélectionnée
    */
    private $selectedpage_template;


    /**
    *
    * @var string  Template utilisée pour le lien de la page précédente
    */
    private $previous_template;


    /**
    *
    * @var string  Template utilisée pour le lien de la page suivante
    */
    private $next_template;


    //--------------------------------------------------------------------------
    //Classes CSS


    /**
    *
    * @var string  Classes CSS pour le lien de la première page
    */
    private $first_classes = '';


    /**
    *
    * @var string  Classes CSS pour le lien de la dernière page
    */
    private $last_classes = '';


    /**
    *
    * @var string  Classes CSS pour le lien de la page sélectionnée
    */
    private $selectedpage_classes = '';


    /**
    *
    * @var string  Classes CSS pour le lien d'une page
    */
    private $page_classes = '';


    /**
    *
    * @var string  Classes CSS pour le lien e la page précédente
    */
    private $previous_classes = '';


    /**
    *
    * @var string  Classes CSS pour le lien de la page suivante
    */
    private $next_classes = '';


    //--------------------------------------------------------------------------
    //Méthodes publiques


    /**
    * Constructeur
    * @param string $name    Nom du composant
    */
    public function __construct($name){
        parent::__construct($name, 'ui_pagination');
    }


    /**
    * Effectue un rendu du composant
    * @return string
    */
    public function render(){
        $html = parent::render();

        $items = '';

        //Affichage lien FIRST
        if($this->currentPage > 1){
            $first = $this->getFirstTemplate();
            $first = StringTools::replaceAll($first, '%page%', 1);
            $items .= $first;
        }

        //Affichage previous
        if($this->currentPage > 1){
            $prev = $this->getPreviousTemplate();
            $prev = StringTools::replaceAll($prev, '%page%', $this->currentPage-1);
            $items .= $prev;
        }

        //Affichage des pages
        $startPage = $this->currentPage-NumberTools::floor($this->maxShowedPages/2);
        $endPage = $this->currentPage+NumberTools::floor($this->maxShowedPages/2);
        if($startPage < 1){
            $endPage += (1 - $startPage);
            $startPage = 1;
        }
        if($endPage > $this->nbPages){
            $endPage = $this->nbPages;
        }
        if(($endPage-$startPage+1) != $this->maxShowedPages){
            $startPage = $endPage-$this->maxShowedPages+1;
            if($startPage < 1){
                $startPage = 1;
            }
        }
        for($i = $startPage; $i <= $endPage; $i++){
            if($this->currentPage == $i){
                $page = $this->getSelectedPageTemplate();
                $page = StringTools::replaceAll($page, '%page%', $i);
                $items .= $page;
            }else{
                $page = $this->getPageTemplate();
                $page = StringTools::replaceAll($page, '%page%', $i);
                $items .= $page;
            }

        }

        //Affichage next
        if($this->currentPage < $this->nbPages){
            $next = $this->getNextTemplate();
            $next = StringTools::replaceAll($next, '%page%', $this->currentPage+1);
            $items .= $next;
        }

        //Affichage last
        if($this->currentPage != $this->nbPages && $this->nbPages > 0){
            $last = $this->getLastTemplate();
            $last = StringTools::replaceAll($last, '%page%', $this->nbPages);
            $items .= $last;
        }

        $html = StringTools::replaceAll($html, '%items%', $items);

        return $html;
    }


    /**
    * Définit le composant UI Table sur lequel s'applique la pagination
    * @param \jin\output\components\ui\table\Table $table
    */
    public function setTable(Table $table){
        $this->targetTableComponent = $table;
        $this->updateTable();
    }


    /**
    * Redéfinit le nombre maximum de résultats à afficer par page
    * @param int $nb	Nombre de résultats
    */
    public function setMaxResultsByPage($nb){
        $this->maxByPage = $nb;
        $this->updateTable();
    }


    /**
    * Choisit de préserver ou non la QueryString à travers les pages
    * @param boolean $preserve Choix (true = préserver)
    */
    public function preserveQueryString($preserve){
        $this->preserveQueryString = $preserve;
        $this->updateTable();
    }


    /**
    * Redéfinit la page courante
    * @param int $page Numéro de page. (1 = première page)
    */
    public function setCurrentPage($page){
        $this->currentPage = $page;
        $this->forcedPage = true;
        $this->updateTable();
    }


    /**
    * Retourne le numéro dee la page courante (1 = première page)
    * @return int
    */
    public function getCurrentPage(){
        return $this->currentPage = $page;
    }


    /**
    * Redéfinit le nom de l'argument transmis en GET pour modifier la pagination
    * @param string $argumentName
    */
    public function setPostArgument($argumentName){
        $this->getArgument = $argumentName;
    }


    /**
    * Retourne le nom de l'argument actuellement transmis en GET pour modifier la pagination
    * @return string
    */
    public function getPostArgument(){
        return $this->getArgument;
    }


    /**
    * Ajoute une classe CSS appliquable à un élément du composant.
    * @param string $cssClass	Classe CSS à appliquer
    * @param string $element Element sur lequel appliquer la classe. Elements possibles : first,last,page,selectedpage,next,previous
    * @return boolean
    * @throws \Exception
    */
    public function addElementClass($cssClass, $element){
        if(StringTools::toLowerCase($element) == 'first'){
            if(!ListTools::contains($this->first_classes, $cssClass)){
                $this->first_classes = ListTools::append($this->first_classes, $cssClass);
                return true;
            }
            return false;
        }else if(StringTools::toLowerCase($element) == 'last'){
            if(!ListTools::contains($this->last_classes, $cssClass)){
                $this->last_classes = ListTools::append($this->last_classes, $cssClass);
                return true;
            }
            return false;
        }else if(StringTools::toLowerCase($element) == 'page'){
            if(!ListTools::contains($this->page_classes, $cssClass)){
                $this->page_classes = ListTools::append($this->page_classes, $cssClass);
                return true;
            }
            return false;
        }else if(StringTools::toLowerCase($element) == 'previous'){
            if(!ListTools::contains($this->previous_classes, $cssClass)){
                $this->previous_classes = ListTools::append($this->previous_classes, $cssClass);
                return true;
            }
            return false;
        }else if(StringTools::toLowerCase($element) == 'next'){
            if(!ListTools::contains($this->next_classes, $cssClass)){
                $this->next_classes = ListTools::append($this->next_classes, $cssClass);
                return true;
            }
            return false;
        }else{
            throw new \Exception('Element '.$element.' non reconnu');
            return false;
        }
    }


    //--------------------------------------------------------------------------
    //Méthodes privées


    /**
    * Met à jour les données après une modification des paramètres
    */
    private function updateTable(){
        if(isset($_GET[$this->getArgument]) && !$this->forcedPage){
            $this->currentPage = $_GET[$this->getArgument];
        }

        if(!$this->resultsCount){
            $ds = $this->targetTableComponent->getDataSource();
            $this->resultsCount = $ds->count();
        }
        $this->nbPages = NumberTools::ceil($this->resultsCount/$this->maxByPage);

        $imin = ($this->currentPage - 1)*$this->maxByPage;
        $imax = $imin+$this->maxByPage-1;


        if($imax > ($this->resultsCount - 1)){
            $imax = $this->resultsCount - 1;
        }

        $this->targetTableComponent->setParsingIndexes($imin, $imax);
    }


    /**
    * Retourne la QueryString à utiliser, selon le paramètre preserveQueryString défini
    * @return string
    */
    private function getQueryString(){
        $qs = '?';
        if($this->preserveQueryString && isset($_GET) && count($_GET) > 0) {
            foreach ($_GET as $key => $value) {
                if($key != $this->getArgument) {
                    $qs .= $key . '=' . $value . '&';
                }
            }
        }
        return $qs;
    }


    /**
    * Retourne la template appliquable aux éléments de type first
    * @return string
    */
    private function getFirstTemplate(){
        if($this->first_template){
            return $this->first_template;
        }
        $first = new AssetFile($this->componentName.'/first.tpl');
        $first_content = $first->getContent();
        $first_content = StringTools::replaceAll($first_content, '%class%', ListTools::changeDelims($this->first_classes, ',', ' '));
        $first_content = StringTools::replaceAll($first_content, '%querystring%', $this->getQueryString());
        $first_content = StringTools::replaceAll($first_content, '%getargument%', $this->getArgument);
        $this->first_template = $first_content;
        return $this->first_template;
    }


    /**
    * Retourne la template appliquable aux éléments de type last
    * @return string
    */
    private function getLastTemplate(){
        if($this->last_template){
            return $this->last_template;
        }
        $last = new AssetFile($this->componentName.'/last.tpl');
        $last_content = $last->getContent();
        $last_content = StringTools::replaceAll($last_content, '%class%', ListTools::changeDelims($this->last_classes, ',', ' '));
        $last_content = StringTools::replaceAll($last_content, '%querystring%', $this->getQueryString());
        $last_content = StringTools::replaceAll($last_content, '%getargument%', $this->getArgument);
        $this->last_template = $last_content;
        return $this->last_template;
    }


    /**
    * Retourne la template appliquable aux éléments de type page
    * @return string
    */
    private function getPageTemplate(){
        if($this->page_template){
            return $this->page_template;
        }
        $page = new AssetFile($this->componentName.'/page.tpl');
        $page_content = $page->getContent();
        $page_content = StringTools::replaceAll($page_content, '%class%', ListTools::changeDelims($this->page_classes, ',', ' '));
        $page_content = StringTools::replaceAll($page_content, '%querystring%', $this->getQueryString());
        $page_content = StringTools::replaceAll($page_content, '%getargument%', $this->getArgument);
        $this->page_template = $page_content;
        return $this->page_template;
    }


    /**
    * Retourne la template appliquable aux éléments de type selectedpage
    * @return string
    */
    private function getSelectedPageTemplate(){
        if($this->selectedpage_template){
            return $this->selectedpage_template;
        }
        $spage = new AssetFile($this->componentName.'/selectedpage.tpl');
        $spage_content = $spage->getContent();
        $spage_content = StringTools::replaceAll($spage_content, '%class%', ListTools::changeDelims($this->selectedpage_classes, ',', ' '));
        $spage_content = StringTools::replaceAll($spage_content, '%querystring%', $this->getQueryString());
        $spage_content = StringTools::replaceAll($spage_content, '%getargument%', $this->getArgument);
        $this->selectedpage_template = $spage_content;
        return $this->selectedpage_template;
    }


    /**
    * Retourne la template appliquable aux éléments de type next
    * @return string
    */
    private function getNextTemplate(){
        if($this->next_template){
            return $this->next_template;
        }
        $next = new AssetFile($this->componentName.'/next.tpl');
        $next_content = $next->getContent();
        $next_content = StringTools::replaceAll($next_content, '%class%', ListTools::changeDelims($this->next_classes, ',', ' '));
        $next_content = StringTools::replaceAll($next_content, '%querystring%', $this->getQueryString());
        $next_content = StringTools::replaceAll($next_content, '%getargument%', $this->getArgument);
        $this->next_template = $next_content;
        return $this->next_template;
    }


    /**
    * Retourne la template appliquable aux éléments de type previous
    * @return string
    */
    private function getPreviousTemplate(){
        if($this->previous_template){
            return $this->previous_template;
        }
        $previous = new AssetFile($this->componentName.'/previous.tpl');
        $previous_content = $previous->getContent();
        $previous_content = StringTools::replaceAll($previous_content, '%class%', ListTools::changeDelims($this->previous_classes, ',', ' '));
        $previous_content = StringTools::replaceAll($previous_content, '%querystring%', $this->getQueryString());
        $previous_content = StringTools::replaceAll($previous_content, '%getargument%', $this->getArgument);
        $this->previous_template = $previous_content;
        return $this->previous_template;
    }
}

