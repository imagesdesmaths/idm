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
 * Filtre image. Modifie le contraste d'une image.
 * 
 * @auteur     Loïc Gerard
 */
final class Contrast extends ImageFilter implements FilterInterface{
    /**
     *
     * @var integer Intensité du contraste
     */
    private $contrast;
    
    
    /**
     * Constructeur
     * @param integer $contrast   Degré de contraste. 0 = valeur de départ
     */
    public function __construct($contrast) {
	parent::__construct();
	$this->contrast = $contrast;
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	imagefilter ($imageRessource , IMG_FILTER_CONTRAST, $this->contrast);

	return $imageRessource;
    }
}