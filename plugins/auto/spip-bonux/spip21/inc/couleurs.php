<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2008                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;

// Appelee sans argument, cette fonction retourne un menu de couleurs
// Avec un argument numerique, elle retourne les parametres d'URL 
// pour les feuilles de style calculees (cf commencer_page et svg)
// Avec un argument de type tableau, elle remplace le tableau par defaut
// par celui donne en argument

include_once(_DIR_RESTREINT."inc/couleurs.php");
inc_couleurs_dist(
array(
// Vert de gris
1 => array (
		"couleur_foncee" => "#999966",
		"couleur_claire" => "#CCCC99",
		"couleur_lien" => "#666633",
		"couleur_lien_off" => "#999966"
		),
// Rose vieux
2 => array (
		"couleur_foncee" => "#EB68B3",
		"couleur_claire" => "#E4A7C5",
		"couleur_lien" => "#8F004D",
		"couleur_lien_off" => "#BE6B97"
		),
// Orange
	/*
3 => array (
		"couleur_foncee" => "#fa9a00",
		"couleur_claire" => "#ffc000",
		"couleur_lien" => "#FF5B00",
		"couleur_lien_off" => "#B49280"
		),
//  Bleu truquoise
4 => array (
		"couleur_foncee" => "#5da7c5",
		"couleur_claire" => "#97d2e1",
		"couleur_lien" => "#116587",
		"couleur_lien_off" => "#81B7CD"
		),*/
// Violet
5 => array (
		"couleur_foncee" => "#8F8FBD",
		"couleur_claire" => "#C4C4DD",
		"couleur_lien" => "#6071A5",
		"couleur_lien_off" => "#5C5C8C"
		),
//  Gris
6 => array (
		"couleur_foncee" => "#909090",
		"couleur_claire" => "#D3D3D3",
		"couleur_lien" => "#808080",
		"couleur_lien_off" => "#909090"
		),
)
				,true);

?>