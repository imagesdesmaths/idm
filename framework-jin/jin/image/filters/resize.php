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
 * Filtre image. Permet de redimentionner une image sans déformation. 
 * Selon la taille de l'image initiale, la largeur ou la hauteur est prise
 * comme valeur de référence. L'autre dimension sera moindre que celle souhaitée
 * de manière à conserver la cohérence de l'image, sans perte de matière.
 * 
 * @auteur     Loïc Gerard
 */
final class Resize extends ImageFilter implements FilterInterface{
    /**
     *
     * @var integer Largeur maximale souhaitée
     */
    private $width;
    
    /**
     *
     * @var integer Hauteur maximale souhaitée
     */
    private $height;
    
    
    /**
     * Constructeur
     * @param integer $width	Largeur maximale souhaitée
     * @param integer $height	Hauteur maximale souhaitée
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
	
	$xratio = $startWidth/$this->width;
	$yratio = $startHeight/$this->height;
	if($xratio == $yratio){
	    if($startHeight == $this->height &&
		$startWidth == $this->width){
		//Cas spécial. pas de redimentionnement nécessaire.
		return $imageRessource;
	    }
	    
	    //ratios identiques. On peut prendre la largeur ou la hauteur comme base indifféremment
	    $nouvelleLargeur = $this->width;
	    $nouvelleHauteur = $this->height;
	}else if($xratio > $yratio){
	    //La largeur de l'image fait foi. (Seule dimension permettant un redimentionnement sans perte de matière)
	    //L'image fera la largeur souhaitée. La heauteur sera moindre et proportionnelle.
	    
	    $nouvelleLargeur = $this->width;
	    $nouvelleHauteur = (($startHeight*(($nouvelleLargeur)/$startWidth)));
	}else{
	    //La hauteur de l'image fait foi. (Seule dimension permettant un redimentionnement sans perte de matière)
	    //L'image fera la hauteur souhaitée. La largeur sera moindre et proportionnelle.
	    
	    $nouvelleHauteur = $this->height;
	    $nouvelleLargeur = (($startWidth*(($nouvelleHauteur)/$startHeight)));
	}
	
	
	$resized = $this->image->getEmptyContainer($nouvelleLargeur, $nouvelleHauteur);
	
	imagecopyresampled($resized, $imageRessource, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $startWidth, $startHeight);
	imagedestroy($imageRessource);
	
	return $resized;
    }
}