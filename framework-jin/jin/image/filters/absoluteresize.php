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
 * Filtre image. Permet de redimentionner une image de manière absolue, c'est à
 * dire sans garantie de conservation du ration largeur/hauteur
 * 
 *  @auteur     Loïc Gerard
 */
final class AbsoluteResize extends ImageFilter implements FilterInterface{
    /**
     *
     * @var integer Largeur souhaitée
     */
    private $width;
    
    /**
     *
     * @var integer Hauteur souhaitée
     */
    private $height;
    
    
    /**
     * Constructeur
     * @param integer $width	Largeur souhaitée
     * @paraminteger $height	Hauteur souhaitée
     */
    public function __construct($width, $height) {
	parent::__construct();
	$this->width = $width;
	$this->height = $height;
    }
    
    
    /**
     * Application du filtre
     * @param resource $imageRessource	ImageRessource GD sur lequel appliquer le filtre
     * @return resource	ImageRessource GD modifié
     */
    public function apply($imageRessource){
	$startWidth = imagesx($imageRessource);
	$startHeight = imagesy($imageRessource);
	
	if($startWidth == $this->width &&
		$startHeight == $this->height){
	    //Cas particulier. Image déjà à la bonne taille.
	    return $imageRessource;
	}
	
	$resized = $this->image->getEmptyContainer($this->width, $this->height);
	
	imagecopyresampled($resized, $imageRessource, 0, 0, 0, 0, $this->width, $this->height, $startWidth, $startHeight);
	imagedestroy($imageRessource);
	
	return $resized;
    }
}