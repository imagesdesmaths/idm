<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function saisies_header_prive($flux){
	$js = find_in_path('javascript/saisies.js');
	$flux .= "\n<script type='text/javascript' src='$js'></script>\n";
	$css = generer_url_public('saisies.css');
	$flux .= "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";
	return $flux;
}

function saisies_affichage_final($flux){
	if (($p = strpos($flux,"<!--!inserer_saisie_editer-->"))!==false){
		$pi = strpos($flux, "<script");
		if (!$pi)
			$pi = $p; // si pas de <script inserer comme un goret entre 2 <li> de saisies
		$css = generer_url_public('saisies.css');
		$ins = "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";
		$flux = substr_replace($flux, $ins, $pi, 0);
	}
	return $flux;
}

// declaration du pipeline
function saisies_saisies_autonomes($flux) { return $flux;}
?>
