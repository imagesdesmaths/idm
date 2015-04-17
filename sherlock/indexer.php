<?php

define("_ECRIRE_INC_VERSION","fake");
function spip_connect_db ($host,$port,$user,$pass,$db) {
#    echo "$host:$port $user($pass) $db\n";
    $GLOBALS['db_config'] = array (
        "type" => "mysql",
        "host" => $host,
        "name" => $db,
        "user" => $user,
        "pass" => $pass
    );
}
include_once dirname(__FILE__).'/../config/connect.php';

include_once dirname(__FILE__).'/../config/mes_options.php';
include_once dirname(__FILE__).'/../framework-jin/jin/launcher.php';

use jin\external\diatem\sherlock\Sherlock;
use jin\external\diatem\sherlock\SherlockConfig;
use jin\external\diatem\sherlock\SherlockIndexer;
use jin\log\Debug;

class IdmIndexer
{

    private $sherlock = false;
    private $sherlockconfig = false;
    private $sherlockindexer = false;
    private $dbcon = false;
    private $initialized = false;

    public function IdmIndexer() {

        //Initialisation des objets nécessaires
        $this->sherlock = new Sherlock(
            $GLOBALS['elasticsearch_config']['host'],
            $GLOBALS['elasticsearch_config']['index'],
            $GLOBALS['elasticsearch_config']['port'],
            $GLOBALS['elasticsearch_config']['debug']
        );
        $this->sherlockconfig = new SherlockConfig($this->sherlock);
        $this->sherlockindexer = new SherlockIndexer($this->sherlock);

    }

    public function initialize() {

        if(!$this->initialized) {

            //Initialisation des données
            $result = $this->sherlockconfig->initializeApplication('config.xml');
            if(!$result) {

                echo '<b style="color:red">&#x2718;</b> Initialisation de l\'index idm<br>';

            } else {

                echo '<b style="color:green">&#x2714;</b> Initialisation de l\'index idm<br>';
                echo '<b style="color:green">&#x2714;</b> Initialisation des types<br>';

                // Connexion à la base de données
                try{
                    $this->dbcon = new PDO($GLOBALS['db_config']['type'].":host=".$GLOBALS['db_config']['host'].";dbname=".$GLOBALS['db_config']['name'].";charset=utf8", $GLOBALS['db_config']['user'], $GLOBALS['db_config']['pass']);
                    $this->dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $this->initialized = true;
                    echo '<b style="color:green">&#x2714;</b> Connexion à la base de données<br>';
                } catch(PDOException $e){
                    echo '<b style="color:red">&#x2718;</b> Connexion à la base de données<br>';
                }

            }

        }

        return $this->initialized;

    }

    public function getLastError() {
        return $this->sherlock->getLastError();
    }

    public function indexDatas() {

        if(!$this->initialize()) {
            return;
        }

        // Indexation des articles/tribunes
        $stmt = $this->dbcon->prepare("
            SELECT
                article.id_article,
                article.titre,
                article.surtitre,
                article.soustitre,
                article.descriptif,
                article.chapo AS chapeau,
                article.texte,
                article.ps AS postscriptum,
                '' AS credits,
                DATE_FORMAT(article.date, '%d/%m/%Y') AS date,
                auteur.nom AS auteur,
                GROUP_CONCAT(mot.titre SEPARATOR ';') AS mots,
                piste.titre AS piste,
                rubrique.id_rubrique,
                rubrique.titre AS rubrique,
                url.url
            FROM spip_articles article
            LEFT JOIN spip_auteurs_liens auteur_lien
                ON (auteur_lien.id_objet = article.id_article AND auteur_lien.objet = 'article')
            LEFT JOIN spip_auteurs auteur
                ON (auteur.id_auteur = auteur_lien.id_auteur)
            LEFT JOIN spip_mots_liens mot_lien
                ON (mot_lien.id_objet = article.id_article AND mot_lien.objet = 'article' AND mot_lien.id_mot NOT IN("
                    . MOT_FEATURED . ", "
                    . MOT_PISTE_VERTE . ", "
                    . MOT_PISTE_BLEUE . ", "
                    . MOT_PISTE_ROUGE . ", "
                    . MOT_PISTE_NOIRE . ", "
                    . MOT_HORS_PISTE . "))
            LEFT JOIN spip_mots_liens piste_lien
                ON (piste_lien.id_objet = article.id_article AND piste_lien.objet = 'article' AND piste_lien.id_mot IN("
                     . MOT_PISTE_VERTE . ", "
                     . MOT_PISTE_BLEUE . ", "
                     . MOT_PISTE_ROUGE . ", "
                     . MOT_PISTE_NOIRE . ", "
                     . MOT_HORS_PISTE . "))
            LEFT JOIN spip_mots mot
                ON (mot.id_mot = mot_lien.id_mot AND TRIM(mot.titre) != '' )
            LEFT JOIN spip_mots piste
                ON (piste.id_mot = piste_lien.id_mot AND TRIM(piste.titre) != '' )
            LEFT JOIN spip_rubriques rubrique
                ON (rubrique.id_rubrique = article.id_rubrique)
            LEFT JOIN spip_urls url
                ON (url.id_objet = article.id_article AND url.type = 'article')
            GROUP BY article.id_article
        ");
        if($stmt->execute()) {
            while ($row = $stmt->fetch()) {

                $type = 'article';
                if($row['id_rubrique'] == RUBRIQUE_TRIBUNES) {
                    $type = 'tribune';
                }

                $status = $this->sherlockindexer->addDocument($type, $row['id_article'], array(
                    'url' => $row['url'],
                    'titre' => $row['titre'],
                    'titre_exact' => str_replace(',', '', $row['titre']),
                    'surtitre' => $row['surtitre'],
                    'soustitre' => $row['soustitre'],
                    'descriptif' => $row['descriptif'],
                    'chapeau' => $row['chapeau'],
                    'texte' => $row['texte'],
                    'postscriptum' => $row['postscriptum'],
                    'credits' => $row['credits'],
                    'date' => $row['date'],
                    'auteur' => $row['auteur'],
                    'auteur_exact' => str_replace(',', '', $row['auteur']),
                    'mots' => explode(';', $row['mots']),
                    'piste' => $row['piste'],
                    'rubrique' => $row['rubrique'],
                    'rubrique_exact' => str_replace(',', '', $row['rubrique']),
                ));
                if($status == false) {
                    echo '<b style="color:orange">&#x2718;</b> Erreur lors de l\'indexation d\'un élément de type '.$type.' (#'.$row['id_article'].')<br>';
                }
            }
        }

        // Indexation des événements
        $stmt = $this->dbcon->prepare("
            SELECT
                breve.id_breve,
                breve.titre,
                breve.texte,
                breve.lien_titre AS lientitre,
                breve.lien_url AS lienurl,
                DATE_FORMAT(breve.date_heure, '%d/%m/%Y') AS date,
                auteur.nom AS auteur,
                url.url
            FROM spip_breves breve
            LEFT JOIN spip_auteurs_liens auteur_lien
                ON (auteur_lien.id_objet = breve.id_breve AND auteur_lien.objet = 'article')
            LEFT JOIN spip_auteurs auteur
                ON (auteur.id_auteur = auteur_lien.id_auteur)
            LEFT JOIN spip_urls url
                ON (url.id_objet = breve.id_breve AND url.type = 'breve')
            WHERE breve.id_rubrique = " . RUBRIQUE_EVENEMENTS
        );
        if($stmt->execute()) {
            while ($row = $stmt->fetch()) {

                $type = 'event';

                $status = $this->sherlockindexer->addDocument($type, $row['id_breve'], array(
                    'url' => $row['url'],
                    'titre' => $row['titre'],
                    'titre_exact' => str_replace(',', '', $row['titre']),
                    'texte' => $row['texte'],
                    'date' => $row['date'],
                    'auteur' => $row['auteur'],
                    'auteur_exact' => str_replace(',', '', $row['auteur']),
                    'lientitre' => $row['lientitre'],
                    'lienurl' => $row['lienurl'],
                ));
                if($status == false) {
                    echo '<b style="color:orange">&#x2718;</b> Erreur lors de l\'indexation d\'un élément de type '.$type.' (#'.$row['id_breve'].')<br>';
                }
            }
        }

        echo '<b style="color:green">&#x2714;</b> Indexation des données<br>';

        // Debug::dump($this->sherlockconfig->getDocumentTypes());
    }

}

$indexer = new IdmIndexer();
$indexer->indexDatas();

// Debug::dump($indexer->getLastError());

?>
