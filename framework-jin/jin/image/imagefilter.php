<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\image;

use jin\image\Image;

/** Classe parent de tous filtre Image
 *
 *  @auteur     Loïc Gerard
 */
class ImageFilter{
    /**
     *
     * @var \jin\image\Image Instance de la classe Image sur lequel appliquer le filtre
     */
    protected $image;
    
    /**
     * Constructeur
     */
    public function __construct() {
    }
    
    /**
     * Methode appelée à l'initialisation du filtre par l'objet Image
     * @param \jin\image\Image $image	Instance de la classe Image sur lequel appliquer le filtre
     */
    public function init(Image $image){
	$this->image = $image;
    }
}

