<?php
if (!defined("_ECRIRE_INC_VERSION")) return; 

function mll_insert_head_css($flux){
	// Insertion de la feuille de styles du menu de langues
	$css_mll = find_in_path('mll_styles.css');
	$flux .='<link rel="stylesheet" type="text/css" media="screen" href="'.$css_mll.'" />';

	return $flux;
}

?>