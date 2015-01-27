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
 * Filtre image. Adoucit les contours.
 * 
 * @auteur     Loïc Gerard
 */
final class Smooth extends ImageFilter implements FilterInterface{
    /**
     *
     * @var integer Intensité. 0 = intensité max.
     */
    private $intensite;
    
    /**
     * Constructeur
     * @param integer $intensite   Degré de lissage 0 = intensité maximale
     */
    public function __construct($intensite) {
	parent::__construct();
	$this->intensite = $intensite;
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	imagefilter ($imageRessource , IMG_FILTER_SMOOTH, $this->intensite);

	return $imageRessource;
    }
}