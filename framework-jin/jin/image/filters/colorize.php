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
 * Filtre image. Applique un effet de colorisation à l'image.
 * 
 * @auteur     Loïc Gerard
 */
final class Colorize extends ImageFilter implements FilterInterface{
    /**
     *
     * @var integer Composante rouge de l'effet
     */
    private $red;
    
    
    /**
     *
     * @var integer Composant verte de l'effet
     */
    private $green;
    
    
    /**
     *
     * @var integer Composante bleue de l'effet
     */
    private $blue;
    
    
    /**
     *
     * @var integer Alpha de l'effet
     */
    private $alpha;
    
    
    /**
     * Constructeur
     * @param integer $red	    Composante rouge de la couleur à appliquer. De 0 à 255
     * @param integer $green	    Composante verte de la couleur à appliquer. De 0 à 255
     * @param integer $blue	    Composante bleue de la couleur à appliquer. De 0 à 255
     * @param integer $intensite    Intensité de l'effet. De 0 à 100.
     */
    public function __construct($red, $green, $blue, $intensite = 100) {
	parent::__construct();
	$this->red = $red;
	$this->green = $green;
	$this->blue = $blue;
	$this->alpha = 100-$intensite;
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	imagefilter ($imageRessource , IMG_FILTER_COLORIZE, $this->red, $this->green, $this->blue, $this->alpha);

	return $imageRessource;
    }
}