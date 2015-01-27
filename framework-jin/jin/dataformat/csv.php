<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\dataformat;

use jin\query\QueryResult;

/** Gestion de flux CSV
 *
 * 	@auteur	    Loïc Gerard
 * 	@check
 */
class Csv {
    /**
     *	Données lues/à écrire
     * @var array  
     */
    private $data;

    
    /**
     * Constructeur
     */
    public function __construct() {
	
    }

    
    /**
     * Définit les données à écrire à partir d'un tableau de tableaux associatifs.
     * Ex. array(array('id'=>1,'col'=>'valeur1'),array('id'=>2,'col'=>'valeur2'))
     * @param array $associativeArray
     */
    public function populateWithArray($associativeArray) {
	$this->data = $associativeArray;
    }
    
    
    /**
     * Définit les données à écrire à partir d'un objet QueryResult
     * @param \jin\query\QueryResult $queryResult
     */
    public function populateWithQueryResult(QueryResult $queryResult){
	$this->data = $queryResult->getDatasInArray(true, true);
    }

    
    /**
     * Ecrit le flux CSV dans un fichier
     * @param string $filePath	Chemin relatif/absolu du fichier
     * @throws \Exception
     * @throws Exception
     */
    public function outputInFile($filePath) {
	if (!$this->data) {
	    throw new \Exception('Aucune donnée CSV à exporter.');
	}

	// On cherche des infos sur le fichier à ouvrir
	if (file_exists($filePath)){
	    $infos_fichier = stat($filePath);
	}

	// Si le fichier est inexistant ou vide, on va le créer et y ajouter les 
	// libellés de colonne.
	if (!file_exists($filePath) || (isset($infos_fichier) && $infos_fichier['size'] == 0)) {

	    // On ouvre le fichier en écriture seule et on le vide de son contenu
	    $fp = @fopen($filePath, 'w');
	    if ($fp === false)
		throw new Exception("Le fichier ${$filePath} n'a pas pu être créé.");

	    // Les entêtes sont les clés du tableau associatif
	    $entetes = array_keys($this->data[0]);

	    // Décodage des entêtes qui sont en UTF8 à la base
	    foreach ($entetes as &$entete) {
		// Notez l'utilisation de iconv pour changer l'encodage.
		$entete = (is_string($entete)) ?
			iconv("UTF-8", "Windows-1252//TRANSLIT", $entete) : $entete;
	    }

	    // On utilise le troisième paramètre de fputcsv pour changer le séparateur 
	    // par défaut de php.
	    fputcsv($fp, $entetes, ';');
	}

	// On ouvre le handler en écriture pour écrire le fichier
	// s'il ne l'est pas déjà.
	if (!isset($fp)) {
	    $fp = fopen($filePath, 'a');
	}

	$this->writeDataInIO($fp);
	

	fclose($fp);
    }

    
    /**
     * Ecrit le flux CSV dans la sortie navigateur
     * @param string $fileName	Nom du fichier généré
     * @throws \Exception
     */
    public function output($fileName) {
	if (!$this->data) {
	    throw new \Exception('Aucune donnée CSV à exporter.');
	}

	header('Content-Type: application/excel');
	header('Content-Disposition: attachment; filename="'.$fileName.'"');

	$fp = fopen('php://output', 'w');
	
	// Les entêtes sont les clés du tableau associatif
	$entetes = array_keys($this->data[0]);

	// Décodage des entêtes qui sont en UTF8 à la base
	foreach ($entetes as &$entete) {
	    // Notez l'utilisation de iconv pour changer l'encodage.
	    $entete = (is_string($entete)) ? iconv("UTF-8", "Windows-1252//TRANSLIT", $entete) : $entete;
	}

	// On utilise le troisième paramètre de fputcsv pour changer le séparateur 
	// par défaut de php.
	fputcsv($fp, $entetes, ';');
	// Écriture des données
	$this->writeDataInIO($fp);
	
	fclose($fp);
    }
    
    
    /**
     * Ecrit dans le flux de sortie
     * @param ressource $fp
     */
    private function writeDataInIO($fp){
	// Écriture des données
	foreach ($this->data as $donnee) {
	    foreach ($donnee as &$champ) {
		$champ = (is_string($champ)) ?
			iconv("UTF-8", "Windows-1252//TRANSLIT", $champ) : $champ;
	    }
	    fputcsv($fp, $donnee, ';');
	}
    }

}
