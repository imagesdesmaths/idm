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
 * Filtre image. Applique un effet de pixelisation.
 * 
 * @auteur     Loïc Gerard
 */
final class Pixelate extends ImageFilter implements FilterInterface{
    /**
     *
     * @var integer Taille des pixels
     */
    private $pixelSize;
    
    
    /**
     * Constructeur
     * @param integer $pixelSize   Taille des pixels
     */
    public function __construct($pixelSize) {
	parent::__construct();
	$this->pixelSize = $pixelSize;
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	imagefilter ($imageRessource , IMG_FILTER_PIXELATE, $this->pixelSize, true);

	return $imageRessource;
    }
}