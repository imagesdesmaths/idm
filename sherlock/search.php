<?php

include_once dirname(__FILE__).'/../config/mes_options.php';
include_once dirname(__FILE__).'/../framework-jin/jin/launcher.php';

use jin\external\diatem\sherlock\Sherlock;
use jin\external\diatem\sherlock\SherlockSearch;
use jin\external\diatem\sherlock\SherlockResult;
use jin\query\QueryResult;
use jin\external\diatem\sherlock\facets\SimpleFacet;
use jin\lang\ArrayTools;
use jin\log\Debug;
use jin\dataformat\Json;
use jin\lang\ListTools;

$sherlock = new Sherlock(
    $GLOBALS['elasticsearch_config']['host'],
    $GLOBALS['elasticsearch_config']['index'],
    $GLOBALS['elasticsearch_config']['port'],
    $GLOBALS['elasticsearch_config']['debug']
);

$recherche = htmlentities(isset($_POST['recherche']))
    ? $_POST['recherche']
    : (isset($_GET['recherche'])
        ? $_GET['recherche']
        : '');
$pagination = 1;
$pagination = isset($_POST['pagination']) ? $_POST['pagination'] : 1;

// Recherche exacte
$sherlocksearchExacte = new SherlockSearch($sherlock);
$sherlocksearchExacte->addTextCriteria($recherche, 'titre,surtitre,soustitre,descriptif,chapeau,texte,postscriptum,credits,lientitre,lienurl,date,auteur,mots,rubrique', false);
$sherlocksearchExacte->setResultNbLimit($GLOBALS['elasticsearch_config']['pagin']);
$sherlocksearchExacte->setIndex($GLOBALS['elasticsearch_config']['pagin'] * ($pagination - 1));

// Recherche approximative
$useApproximative = false;
$sherlocksearchApproximative = new SherlockSearch($sherlock);
$sherlocksearchApproximative->addTextCriteria($recherche, 'titre,surtitre,soustitre,descriptif,chapeau,texte,postscriptum,credits,lientitre,lienurl,date,auteur,mots,rubrique');
$sherlocksearchApproximative->setResultNbLimit($GLOBALS['elasticsearch_config']['pagin']);
$sherlocksearchApproximative->setIndex($GLOBALS['elasticsearch_config']['pagin'] * ($pagination - 1));

// Facet TYPE
$facet_type = new SimpleFacet('_type', 'type');
if(isset($_POST['type'])){
    $facet_type->setSelectedValue($_POST['type']);
}
$sherlocksearchExacte->addFacet($facet_type);
$sherlocksearchApproximative->addFacet($facet_type);

// Facet AUTEUR
$facet_auteur = new SimpleFacet('auteur_exact', 'auteur');
if(isset($_POST['auteur'])){
    $facet_auteur->setSelectedValues(ListTools::toArray($_POST['auteur']));
}
$sherlocksearchExacte->addFacet($facet_auteur);
$sherlocksearchApproximative->addFacet($facet_auteur);

// Facet ACCESSIBILITE
$facet_accessibilite = new SimpleFacet('piste', 'accessibilite');
if(isset($_POST['accessibilite'])){
    $facet_accessibilite->setSelectedValues(ListTools::toArray($_POST['accessibilite']));
}
$sherlocksearchExacte->addFacet($facet_accessibilite);
$sherlocksearchApproximative->addFacet($facet_accessibilite);

// Facet MOT-CLÉ
$facet_mot = new SimpleFacet('mots', 'mot');
if(isset($_POST['mot'])){
    $facet_mot->setSelectedValues(ListTools::toArray($_POST['mot']));
}
$sherlocksearchExacte->addFacet($facet_mot);
$sherlocksearchApproximative->addFacet($facet_mot);


$sherlocksearch = $sherlocksearchExacte;
$sherlockresults = $sherlocksearchExacte->search();
if($sherlockresults){
    $resultats = $sherlockresults->getQueryResult();

    if($sherlockresults->getTotalCount() == 0) {
        $useApproximative = true;
        $sherlocksearch = $sherlocksearchApproximative;
        $sherlockresults = $sherlocksearchApproximative->search();
        if($sherlockresults){
            $resultats = $sherlockresults->getQueryResult();
        }
    }
}

// Supprime tous les raccourcis typographique de SPIP
function interventionDivine($v) {
    $v = preg_replace('/^\-{4,}$/mi', '', $v);             // horizontal rule
    $v = preg_replace('/(\[)(.*?)(->.*?\])/mi', '$2', $v); // links
    $v = preg_replace('/\[\[.*?\]\]/mi', '', $v);          // notes
    $v = preg_replace('/\n(\|[^\n]*\|\n)+\n/mi', '', $v);  // tables
    $v = preg_replace('/^_\s+/mi', '', $v);                // SPIP new lines
    $v = preg_replace('/^-[*#]+/mi', '', $v);              // lists
    $v = preg_replace('/\[\??(.*?)(<-)?\]/mi', '', $v);    // anchors
    $v = preg_replace('/[{}\n]/mi', '', $v);               // brackets / new lines
    $v = preg_replace('/\s{2,}/mi', ' ', $v);               // multiples spaces
    return strip_tags($v);
}

?>

<div id="content" class="block-left">

    <div class="category">Recherche sur le site</div>

    <?php

    if(isset($resultats)){

        if($useApproximative) {
            echo '<p class="alert">Aucun résultat n\'a été trouvé pour le terme exact &#171;&nbsp;'.htmlentities($recherche).'&nbsp;&#187;&nbsp;</p>';
        }

        echo '<h1>'.$sherlockresults->getTotalCount().' résultats pour &#171;&nbsp;'.htmlentities($recherche).'&nbsp;&#187;&nbsp;</h1>';

        foreach($resultats as $item){
            $resume = '';

            if($item['_type'] != 'event') {
                $resume = preg_replace('/(\s+\S+)$/', '', substr(strip_tags($item['descriptif']), 0, 500));
                if(strlen($resume) > 450) {
                    $resume .= '...';
                }
            }

            $url = $item['url'];
            $linktext = 'Accéder à l\'article';
            if($item['_type'] == 'event') {
                $url = '+'.$url.'+';
                $linktext = 'Accéder à l\'évènement';
            }
            if($item['_type'] == 'tribune') {
                $url = '+'.$url.'+';
                $linktext = 'Accéder à la tribune';
            }

            $images = glob(($item['_type'] == 'event' ? 'IMG/breveon' : 'IMG/arton') . $item['_id'].'.*');
            $image = count($images) > 0 ? $images[0] : null;

            echo '<div class="result '.$item['_type'].'">';
                echo '<a href="'.$url.'"><span>'.$linktext.'</span></a>';
                echo '<div class="icon">';
                    echo '<i class="flaticon-'.$item['_type'].'"></i>';
                echo '</div>';
                echo '<div class="content">';
                    echo '<p class="author">'.$item['auteur'].'</p>';
                    echo '<h3 class="title">'.$item['titre'].'</h3>';
                    echo '<div class="resume">'. interventionDivine($resume) .'</div>';
                    echo '<span class="date">'.$item['date'].'</span>';
                    if($item['_type'] != 'event') {
                        echo '<span class="category">Catégorie : '.$item['rubrique'].'</span>';
                        echo '<div class="keywords">';
                            if($item['piste']) {
                                switch ($item['piste']) {
                                    case 'Piste verte':
                                        echo '<span class="keyword green-track">Piste verte</span>';
                                        break;
                                    case 'Piste bleue':
                                        echo '<span class="keyword blue-track">Piste bleue</span>';
                                        break;
                                    case 'Piste rouge':
                                        echo '<span class="keyword red-track">Piste rouge</span>';
                                        break;
                                    case 'Piste noire':
                                        echo '<span class="keyword black-track">Piste noire</span>';
                                        break;
                                    case 'Hors-piste':
                                        echo '<span class="keyword off-track">Hors piste</span>';
                                        break;
                                }
                            }
                            if(is_array($item['mots']) && count($item['mots']) > 0) {
                                $keywords = array_unique($item['mots']);
                                foreach ($keywords as $keyword) {
                                    if($keyword) {
                                        echo '<span class="keyword">'.$keyword.'</span>';
                                    }
                                }
                            }
                        echo '</div>';
                    }
                echo '</div>';
                if(!is_null($image)) {
                    echo '<div class="image">';
                        echo '<img src="'.$image.'" alt="'.$item['titre'].'">';
                    echo '</div>';
                }
            echo '</div>';
        }

        // Pagination
        if($sherlockresults->getTotalCount() > $GLOBALS['elasticsearch_config']['pagin']) {
            $p = $sherlocksearch->getIndex() / $GLOBALS['elasticsearch_config']['pagin'] + 1;
            $total = floor($sherlockresults->getTotalCount() / $GLOBALS['elasticsearch_config']['pagin']) + 1;
            $left = min(max($p - 4, 1), $total - 4);
            $right = $left + 8;
            $mass = false;
            echo '<span class="pages">';
               for ($i = 1; $i <= $total; $i++) {
                    $classes = '';
                    if($p == $i) {
                        echo '<strong class="on">'.$i.'</strong>';
                    } else {
                        if(($i > 1 && $i < $left) || ($i > $right && $i < $total)) {
                            if(!$mass) {
                                echo '<span class="tbc">';
                                    echo '<span class="sep"> | </span>...';
                                    echo '<span class="sep"> | </span>';
                                echo '</span>';
                            }
                            $mass = true;
                        } else {
                            $mass = false;
                            echo '<span data-pagin="'.$i.'" class="lien_pagination">'.$i.'</span>';
                            if($i < $total) {
                                echo '<span class="sep"> | </span>';
                            }
                        }
                    }
               }
            echo '</span>';
        }

        if($GLOBALS['elasticsearch_config']['debug']) {
            echo '<p class="alert">Debug:</p>';
            echo '<div class="debug-output">';
                Debug::dump($sherlock->getLastError());
                Debug::dump($sherlock->getLastServerCall());
                Debug::dump(json_decode($sherlock->getLastServerResponse()));
            echo '</div>';
        }

    } else {

        echo '<h1>Aucun résultat pour &#171;&nbsp;'.htmlentities($recherche).'&nbsp;&#187;&nbsp;</h1>';
        echo '<p class="alert">Une erreur est survenue lors de la recherche</p>';
        if($GLOBALS['elasticsearch_config']['debug']) {
            echo '<div class="debug-output">';
                Debug::dump($sherlock->getLastError());
                Debug::dump($sherlock->getLastServerCall());
                Debug::dump($sherlock->getLastServerResponse());
            echo '</div>';
        }

    }

    ?>

</div>

<div class="block-right block-search">
<?php

if(isset($resultats)){

    $types = array(
        'article'   => 'Article',
        'tribune'   => 'Tribune',
        'event'     => 'Évènement'
    );

    if($facet_type->length() > 0)  {
        echo '<h2>Type</h2>';
        // Sélectionnés en premier
        foreach($facet_type as $f) {
            if($f['selected']) {
                echo '<div data-facet="type" data-value="'.$f['key'].'" class="selected">'.$types[$f['key']].' <span>&times;</span></div>';
            }
        }
        foreach($facet_type as $f) {
            if(!$f['selected']) {
                echo '<div data-facet="type" data-value="'.$f['key'].'" >'.$types[$f['key']].' ('.$f['doc_count'].')</div>';
            }
        }
    }

    if($facet_auteur->length() > 0)  {
        echo '<h2>Auteur</h2>';
        // Sélectionnés en premier
        foreach($facet_auteur as $f) {
            if($f['selected']) {
                echo '<div data-facet="auteur" data-value="'.$f['key'].'" class="selected">'.$f['key'].' <span>&times;</span></div>';
            }
        }
        foreach($facet_auteur as $f) {
            if(!$f['selected']) {
                echo '<div data-facet="auteur" data-value="'.$f['key'].'" >'.$f['key'].' ('.$f['doc_count'].')</div>';
            }
        }
    }

    if($facet_accessibilite->length() > 0)  {
        echo '<h2>Accessibilité</h2>';
        // Sélectionnés en premier
        foreach($facet_accessibilite as $f) {
            if($f['selected']) {
                $class = '';
                switch (strtolower($f['key'])) {
                    case 'piste verte':
                        $class = 'green-track';
                        break;
                    case 'piste bleue':
                        $class = 'blue-track';
                        break;
                    case 'piste rouge':
                        $class = 'red-track';
                        break;
                    case 'piste noire':
                        $class = 'black-track';
                        break;
                    case 'hors-piste':
                        $class = 'off-track';
                        break;
                }
                echo '<div data-facet="accessibilite" data-value="'.$f['key'].'" class="selected '.$class.'">'.$f['key'].' <span>&times;</span></div>';
            }
        }
        foreach($facet_accessibilite as $f) {
            if(!$f['selected']) {
                $class = '';
                switch (strtolower($f['key'])) {
                    case 'piste verte':
                        $class = 'green-track';
                        break;
                    case 'piste bleue':
                        $class = 'blue-track';
                        break;
                    case 'piste rouge':
                        $class = 'red-track';
                        break;
                    case 'piste noire':
                        $class = 'black-track';
                        break;
                    case 'hors-piste':
                        $class = 'off-track';
                        break;
                }
                echo '<div data-facet="accessibilite" data-value="'.$f['key'].'" class="'.$class.'">'.$f['key'].' ('.$f['doc_count'].')</div>';
            }
        }
    }

    if($facet_mot->length() > 0)  {
        echo '<h2>Mots-clés</h2>';
        // Sélectionnés en premier
        foreach($facet_mot as $f) {
            if($f['selected']) {
                echo '<div data-facet="mot" data-value="'.$f['key'].'" class="selected">'.$f['key'].' <span>&times;</span></div>';
            }
        }
        foreach($facet_mot as $f) {
            if(!$f['selected']) {
                echo '<div data-facet="mot" data-value="'.$f['key'].'" >'.$f['key'].' ('.$f['doc_count'].')</div>';
            }
        }
    }
}

?>
</div>

<script type="text/javascript">

    function getAjax() {
        try {
            return new ActiveXObject('Msxml2.XMLHTTP');
        } catch (e) {
            try {
                return new ActiveXObject('Microsoft.XMLHTTP');
            } catch (e) {
                return new XMLHttpRequest();
            }
        }
    }

    /**
     * Perform AJAX call.
     *
     * @param {string} url URL of AJAX service.
     * @param {function} func Function to call when response arrives.
     * @param {string} method Request method post or get.
     * @param {Array} array Array with arguments to send.
     * ex : sendAjax("ajax.cfm", self.ajaxCallback, 'post', "arg1=value&arg2=value", [param1,param2]);
     */
    function sendAjax(url, func, method, array, funcarray) {
        var x = getAjax();

        x.open(method, url, true);

        x.onreadystatechange = function() {
            if (x.readyState == 4) {
                func(x.responseText, x.responseXML, funcarray);
            }
        };

        if (method == 'post')
            x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        x.send(array);
    }

    var args = new Array();

    function doRecherche(){
        $(document).off('click', '[data-facet]');
        $(document).off('click', '[data-pagin]');
        var arg = 'recherche='+document.getElementById('recherche').value;
        for (var key in data = args){
            arg += '&'+key+'='+args[key];
        }
        sendAjax("sherlock/search_fr.php",cb_doRecherche,'post',arg,[args]);
    }

    function cb_doRecherche(text, xml, params){
        args = params[0];
        $('#recherche_ajax').empty().html(text);
    }

    function addArg(key, value, unique){
        if(args[key] == undefined || unique){
            args[key] = new Array();
        }
        if(unique){
            args[key].push(value);
        }else{
            if(args[key].indexOf(value) == -1){
                args[key].push(value);
            }
        }

    }

    function removeArg(key, value){
        if(args[key] != undefined){
            var index = args[key].indexOf(value);
            if(index != -1){
                delete args[key][index];
                args[key].splice(index, 1);
            }
            if(args[key].length == 0){
                delete args[key];
            }
        }
    }

    $('.block-search [data-facet].selected').each(function(index, el) {
        addArg($(this).data('facet'), $(this).data('value'), false);
    });
    $(document).on('click', '[data-facet]', function(event) {
        event.preventDefault();
        if($(this).is('.selected')) {
            removeArg($(this).data('facet'), $(this).data('value'));
            doRecherche();
        } else {
            addArg($(this).data('facet'), $(this).data('value'), false);
            doRecherche();
        }
    });
    $(document).on('click', '[data-pagin]', function(event) {
        event.preventDefault();
        addArg('pagination', $(this).data('pagin'), true);
        doRecherche();
    });

</script>
