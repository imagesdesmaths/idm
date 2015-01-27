<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\image\filters;

use jin\image\FilterInterface;
use jin\image\ImageFilter;
use jin\image\Image;

/**
 * Filtre image. Modifie la luminosité d'une image.
 * 
 * @auteur     Loïc Gerard
 */
final class Brightness extends ImageFilter implements FilterInterface{
    
    private $luminosite;
    
    /**
     * Constructeur
     * @param integer $luminosite   Valeur de luminosité. de -255 à 255. 0 = pas de modification
     */
    public function __construct($luminosite) {
	parent::__construct();
	$this->luminosite = $luminosite;
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	imagefilter ($imageRessource , IMG_FILTER_BRIGHTNESS, $this->luminosite);

	return $imageRessource;
    }
}