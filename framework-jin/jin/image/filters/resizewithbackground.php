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
 * L'image en sortie fera exactement la taille indiquée. La matière manquante
 * sera remplacée par la couleur indiquée. (Dans le cas d'une image avec
 * transparence il est possible de ne pas renseigner les paramètres de couleur
 * pour obtenir un fond transparent)
 * 
 * @auteur     Loïc Gerard
 */
final class ResizeWithBackground extends ImageFilter implements FilterInterface{
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
     *
     * @var integer Composante rouge de la couleur de fond. NULL = transparent
     */
    private $red;
    
    
    /**
     *
     * @var integer Composante verte de la couleur de fond. NULL = transparent
     */
    private $green;
    
    
    /**
     *
     * @var integer Composante bleue de la couleur de fond. NULL = transparent
     */
    private $blue;
    
    
    /**
     * Constructeur
     * @param integer $width	Largeur souhaite
     * @param integer $height	Hauteur souhaitée
     * @param integer $red	[Optionel] Composante rouge de la couleur de fond. (De 0 à 100) NULL = transparent
     * @param integer $green	[Optionel] Composante verte de la couleur de fond. (De 0 à 100) NULL = transparent
     * @param integer $blue	[Optionel] Composante bleue de la couleur de fond. (De 0 à 100) NULL = transparent
     */
    public function __construct($width, $height, $red = null, $green = null, $blue = null) {
	parent::__construct();
	$this->width = $width;
	$this->height = $height;
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
	
	//Calcul du décalage de l'image
	$xdecay = 0;
	if($nouvelleLargeur != $this->width){
	    $xdecay = ($this->width - $nouvelleLargeur)/2;
	}
	$ydecay = 0;
	if($nouvelleHauteur != $this->height){
	    $ydecay = ($this->height - $nouvelleHauteur)/2;
	}
	
	//Conteneur vide
	$resized = $this->image->getEmptyContainer($this->width, $this->height, $this->red, $this->green, $this->blue);
	
	//Redimentionnement
	imagecopyresampled($resized, $imageRessource, $xdecay, $ydecay, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $startWidth, $startHeight);
	imagedestroy($imageRessource);
	
	return $resized;
    }
}