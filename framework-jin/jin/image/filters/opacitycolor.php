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
 * Filtre image. Applique un effet d'opacité sur une image tendant vers une couleur.
 * Remarque : principalement appliquable à des images JPEG
 * 
 * @auteur     Loïc Gerard
 */
final class OpacityColor extends ImageFilter implements FilterInterface{
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
     * @var integer Opacité
     */
    private $opacite;
    
    /**
     * 
     * @param integer $opacite	Opacité. De 0 à 100
     * @param integer $red	Composante rouge de l'effet.
     * @param integer $green	Composante verte de l'effet.
     * @param integer $blue	Composante bleue de l'effet.
     */
    public function __construct($opacite, $red, $green, $blue) {
	parent::__construct();
	$this->opacite = 100-$opacite;
	$this->red = $red;
	$this->green = $green;
	$this->blue = $blue;
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	$width = imagesx($imageRessource);
	$height = imagesy($imageRessource);
	
	for($x = 0; $x < $width; $x++){
	    for($y = 0; $y < $height; $y++){
		$color = imagecolorallocatealpha($imageRessource, $this->red, $this->green, $this->blue, $this->opacite);
		imagesetpixel($imageRessource, $x, $y, $color);
	    }
	}
	
	//imagecolorallocatealpha($imageRessource, 0, 0, 0, 100);
	
	return $imageRessource;
    }
}