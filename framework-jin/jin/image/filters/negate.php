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
 * Filtre image. Inverse les couleurs de l'image.
 * 
 * @auteur     Loïc Gerard
 */
final class Negate extends ImageFilter implements FilterInterface{
    /**
     * Constructeur
     */
    public function __construct() {
	parent::__construct();
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	imagefilter ($imageRessource , IMG_FILTER_NEGATE);

	return $imageRessource;
    }
}