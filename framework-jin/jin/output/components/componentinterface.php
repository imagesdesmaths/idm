<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\components;

/** Interface de tout composant
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		
 */
Interface ComponentInterface{
    public function __construct($name);
    public function render();
}