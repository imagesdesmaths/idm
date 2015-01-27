<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\image;

/** Interface pour les classes filtres d'image
 *
 *  @auteur     Loïc Gerard
 */
Interface FilterInterface{
    public function apply($imageRessource);
}
