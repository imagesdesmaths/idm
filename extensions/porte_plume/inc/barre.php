<?php

/**
 * 
 * Ce fichier est la uniquement pour compatibilite avec SPIP < 2.1
 * Il est inutile ensuite
 * 
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

// construit un bouton (ancre) de raccourci avec icone et aide

// http://doc.spip.org/@bouton_barre_racc
function bouton_barre_racc($action, $img, $help, $champhelp) {
	return;
}

// construit un tableau de raccourcis pour un noeud de DOM 

// http://doc.spip.org/@afficher_barre
if (!function_exists('afficher_barre')) {
function afficher_barre($champ, $forum=false, $lang='') {
	return;
}
}

// expliciter les 3 arguments pour avoir xhtml strict

// http://doc.spip.org/@afficher_textarea_barre
function afficher_textarea_barre($texte, $forum=false, $form='')
{
	global $spip_display, $spip_ecran;
	$rows = ($spip_ecran == "large") ? 28 : 15;
	
	$class = 'formo' . ($forum ? ' textarea_forum':'');
	return 
	  "<textarea name='texte' id='texte' "
	. " rows='$rows' class='$class' cols='40'>"
	. entites_html($texte)
	. "</textarea>\n";
}

?>
