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
 * Filtre image. Permet de croper une image sur des dimensions spécifiées
 * Cette méthode entraîne une perte de matière.
 */
final class Crop extends ImageFilter implements FilterInterface{
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
     * @param integer $width	Largeur de l'image en sortie
     * @param integer $height	Hauteur de l'image en sortie
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
	
	
	//On effectue au préalable un resize
	$xratio = $startWidth/$this->width;
	$yratio = $startHeight/$this->height;
	if($xratio == $yratio){
	    if($startHeight == $this->height &&
		$startWidth == $this->width){
		//Cas spécial. pas de redimentionnement nécessaire.
		$resizedTmp = $imageRessource;
	    }else{
		//ratios identiques. On peut prendre la largeur ou la hauteur comme base indifféremment
		$nouvelleLargeur = $this->width;
		$nouvelleHauteur = $this->height;
	    } 
	}else if($xratio > $yratio){
	    //La hauteur de l'image fait foi.  On redimentionne à la hauteur.

	    $nouvelleHauteur = $this->height;
	    $nouvelleLargeur = (($startWidth*(($nouvelleHauteur)/$startHeight)));
	}else{
	    //La largeur de l'image fait foi.  On redimentionne à la largeur

	    $nouvelleLargeur = $this->width;
	    $nouvelleHauteur = (($startHeight*(($nouvelleLargeur)/$startWidth)));
	}
	
	if(isset($nouvelleHauteur)){
	    $resizedTmp = $this->image->getEmptyContainer($nouvelleLargeur, $nouvelleHauteur);
	
	    imagecopyresampled($resizedTmp, $imageRessource, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $startWidth, $startHeight);
	}
	imagedestroy($imageRessource);
	
	
	//Deuxième étape : on coupe les cotés ou le haut
	$startWidth = imagesx($resizedTmp);
	$startHeight = imagesy($resizedTmp);
	
	if($startWidth == $this->width && $startHeight == $this->height){
	    //Cas particulier, aucune opération complémentaire nécessaire
	    return $resizedTmp;
	}elseif($startWidth == $this->width){
	    //On a redimensionné sur la largeur. On coupe le haut et le bas
	    $resized = $this->image->getEmptyContainer($this->width, $this->height);
	    $xdecay = 0;
	    $ydecay = ($startHeight - $this->height) / 2;
	    imagecopyresampled($resized, $resizedTmp, 0, 0, $xdecay, $ydecay, $this->width, $this->height, $this->width, $this->height);
	    imagedestroy($resizedTmp);
	    return $resized;
	}else{
	    //On a redimensionné sur la hauteur. On coupe à droite et à gauche
	    $resized = $this->image->getEmptyContainer($this->width, $this->height);
	    $xdecay = ($startWidth - $this->width) / 2;
	    $ydecay = 0;
	    imagecopyresampled($resized, $resizedTmp, 0, 0, $xdecay, $ydecay, $this->width, $this->height, $this->width, $this->height);
	    imagedestroy($resizedTmp);
	    return $resized;
	}
	
	
	
	return $resized;
	
	
	
	/////
	$xratio = $startWidth/$this->width;
	$yratio = $startHeight/$this->height;
	$xdecay = 0;
	$ydecay = 0;
	if($xratio == $yratio){
	    if($startHeight == $this->height &&
		$startWidth == $this->width){
		//Cas spécial. pas de redimentionnement nécessaire.
		return $imageRessource;
	    }
	    
	    //ratios identiques. On peut prendre la largeur ou la hauteur comme base indifféremment
	    $largeurToTake = $this->width;
	    $hauteurToTake = $this->height;
	}else if($xratio > $yratio){
	    //La hauteur de l'image fait foi.  On redimentionne à la hauteur. On coupe les cotés
	    
	    $hauteurToTake = $this->height;
	    $largeurToTake = (($startWidth*(($hauteurToTake)/$startHeight)));
	    $xdecay = ($largeurToTake - $this->width) / 2;
	}else{
	    //La largeur de l'image fait foi.  On redimentionne à la largeur. On coupe le haut et le bas

	    $largeurToTake = $this->width;
	    $hauteurToTake = (($startHeight*(($largeurToTake)/$startWidth)));
	    $ydecay = ($hauteurToTake - $this->height) / 2;
	}
	
	$resized = $this->image->getEmptyContainer($this->width, $this->height);
	imagecopyresampled($resized, $imageRessource, 0, 0, $xdecay, $ydecay, $this->width, $this->height, $largeurToTake, $hauteurToTake);

	return $resized;
    }
}