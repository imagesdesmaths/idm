<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\image;

use jin\filesystem\File;
use jin\image\ImageFilter;
use jin\lang\ListTools;
use jin\lang\StringTools;

/** Classe permettant la modification d'images. Typiquement on instancie un
 * objet jin\image\Image puis on y applique des filtres. jin\image\filters/*
 * On peut ensuite extraire l'image générée de plusieurs méthodes :
 * -> Modification du fichier original (write())
 * -> Ecriture dans un nouveay fichier (write($path))
 * -> Sortie en tant qu'image dans le navigateur (writeInOutput())
 * -> Sortie dans le navigateur en HTML (writeInHTMLOutput())
 * -> Sortie du binaire
 *
 *  @auteur     Loïc Gerard
 */
class Image{
    /**
     *
     * @var string  Chemin du fichier
     */
    private $path;
    
    
    /**
     *
     * @var \jin\filesystem\File	Objet File représentant l'image
     */
    private $file;
    
    
    /**
     *
     * @var string  Extension du fichier. (lowercase)
     */
    private $extension;
    
    
    /**
     *
     * @var array   Filtres applicables. (Tableau d'objets héritants de jin\image\ImageFilter et implémentants jin\imag\FilterInterface)
     */
    private $filters = array();
    
    
    /**
     *
     * @var integer Qualité appliquée à l'écriture des fichiers de type JPEG
     */
    private $jpgQuality = 100;
    
    
    /**
     *
     * @var integer Degré de compression appliqué à l'écriture des fichiers de type PNG
     */
    private $pngCompression = 0;
    
    
    /**
     * Constructeur
     * @param string $path Chemin d'un fichier existant
     * @throws \Exception
     */
    public function __construct($path) {
	$this->path = $path;
	$this->file = new File($this->path);
	
	$this->extension = StringTools::toLowerCase(ListTools::last($this->path, '.'));
	if($this->extension != 'jpg' && $this->extension != 'png'){
	    throw new \Exception('Extension '.$this->extension.' non supportée');
	}
    }
    
    
    /**
     * Ajoute un filtre de traitement
     * @param \jin\image\ImageFilter $filter objets héritants de jin\image\ImageFilter et implémentants jin\image\FilterInterface
     */
    public function addFilter(ImageFilter $filter){
	$filter->init($this);
	$this->filters[] = $filter;
    }
    
    
    /**
     * Ecrit le résultat dans un fichier
     * @param string $path  [optionel] Fichier de destination. Si non renseigné : écriture dans le fichier d'origine.
     * @throws \Exception
     */
    public function write($path = null){
	$image = $this->applyFilters();
	
	if($this->extension == 'jpg'){
	    if($path){
		imagejpeg($image, $path, $this->jpgQuality);
	    }else{
		imagejpeg($image, $this->path, $this->jpgQuality);
	    }
	}else if($this->extension == 'png'){
	    if($path){
		imagepng($image, $path, $this->pngCompression);
	    }else{
		imagepng($image, $this->path, $this->pngCompression);
	    }
	}else{
	    throw new \Exception('Impossible de générer l\'image : extension non supportée');
	}
	
    }
    
    
    /**
     * Eeffectue une sortie de l'image directement dans le navigateur. (Headers modifiés)
     * @throws \Exception
     */
    public function writeInOutput(){
	$image = $this->applyFilters();
	
	if($this->extension == 'jpg'){
	    header('Content-Type: image/jpg');
	    imagejpeg($image, null, $this->jpgQuality);
	}else if($this->extension == 'png'){
	    header('Content-Type: image/png');
	    imagepng($image, null, $this->pngCompression);
	}else{
	    throw new \Exception('Impossible de générer l\'image : extension non supportée');
	}
    }
    
    
    /**
     * Effectue une sortie de l'image en HTML. (balise img et base64)
     * @throws \Exception
     */
    public function writeInHTMLOutput(){
	$image = $this->applyFilters();
	
	if($this->extension == 'jpg'){
	    ob_start();
	    imagejpeg($image, null, $this->jpgQuality);
	    $contents = ob_get_contents();
	    ob_end_clean();

	    $base64 = "data:image/jpeg;base64," . base64_encode($contents);
	    echo "<img src=$base64 />";
	}else if($this->extension == 'png'){
	    ob_start();
	    imagepng($image, null, $this->pngCompression);
	    $contents = ob_get_contents();
	    ob_end_clean();

	    $base64 = "data:image/png;base64," . base64_encode($contents);
	    echo "<img src=$base64 />";
	}else{
	    throw new \Exception('Impossible de générer l\'image : extension non supportée');
	}
    }
    
    
    /**
     * Retourne l'image générée en base64
     * @return string
     * @throws \Exception
     */
    public function getBase64(){
	$image = $this->applyFilters();
	
	if($this->extension == 'jpg'){
	    ob_start();
	    imagejpeg($image, null, $this->jpgQuality);
	    $contents = ob_get_contents();
	    ob_end_clean();

	    $base64 = "data:image/jpeg;base64," . base64_encode($contents);
	    return $base64;
	}else if($this->extension == 'png'){
	    ob_start();
	    imagepng($image, null, $this->pngCompression);
	    $contents = ob_get_contents();
	    ob_end_clean();

	    $base64 = "data:image/png;base64," . base64_encode($contents);
	    return $base64;
	}else{
	    throw new \Exception('Impossible de générer l\'image : extension non supportée');
	}
    }
    
    
    /**
     * Retourne l'image générée en objet RessourceImage GD
     * @return resource	RessourceImage GD
     */
    public function getImageRessource(){
	return $this->applyFilters();
    }
    
    
    /**
     * Modifie la qualité de sortie des fichiers de type JPEG
     * @param integer $quality	Qualité. De 0 à 100
     * @throws \Exception
     */
    public function setJpegQuality($quality){
	if(!is_numeric($quality) ||
		$quality < 0 ||
		$quality > 100){
	    throw new \Exception('Qualité JPEG : valeur numérique attendue de 0 à 100');
	}
	$this->jpgQuality = $quality;
    }
    
    
    /**
     * Modifié le degré de compression appliqué aux fichiers de type PNG
     * @param integer $compression  Degré de compression. (De 0 à 9)
     * @throws \Exception
     */
    public function setPngCompression($compression){
	if(!is_numeric($compression) ||
		$compression < 0 ||
		$compression > 100){
	    throw new \Exception('Qualité JPEG : valeur numérique attendue de 0 à 100');
	}
	$this->jpgQuality = $quality;
    }
    
    
    /**
     * Retourne TRUE si le fichier supporte la transparence
     * @return boolean
     */
    public function isTransparency(){
	if($this->extension == 'png'){
	    return true;
	}
	return false;
    }
    
    
    /**
     * Crée une image container vide compatible avec la gestion colorimétrique et
     * la transparence de l'image courante. (A utiliser pour les filtres)
     * Retourne un objet ResourceImage GD
     * @param integer $width	Largeur
     * @param integer $height	Hauteur
     * @param integer $red	[optionel] Composante rouge de la couleur de fond. Si non renseigné : couleur transparente.
     * @param integer $green	[optionel] Composante verte de la couleur de fond. Si non renseigné : couleur transparente.
     * @param integer $blue	[optionel] Composante bleue de la couleur de fond. Si non renseigné : couleur transparente.
     * @return resource
     */
    public function getEmptyContainer($width, $height, $red = null, $green = null, $blue = null){
	$container = imagecreatetruecolor($width, $height);
	if($this->isTransparency()){
	    //imagealphablending($container, false);
	    imagesavealpha($container, true);
	    imagefill($container,0,0,0x7fff0000);
	}
	if($red && $green && $blue){
	    $color = imagecolorallocate($container, $red, $green, $blue);
	    imagefill($container, 0, 0, $color);
	}
	return $container;
    }
    
    
    /**
     * Applique les filtres et retourne un objet ResourceImage GD
     * @return resource
     */
    private function applyFilters(){
	if($this->extension == 'jpg'){
	    $source = imagecreatefromjpeg($this->path);
	}else if($this->extension == 'png'){
	    $source = imagecreatefrompng($this->path);
	}
	
	foreach($this->filters as $filtre){
	    $source = $filtre->apply($source);
	}
	
	return $source;
    }
}