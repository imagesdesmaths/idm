<?php

// Auteur : Patrice Vanneufville, 2007

// 'liens_en_clair' est un filtre place dans : liens_en_clair_fonctions.php
// 'liens_en_clair_post_propre' automatise les liens en clair si on trouve cs=print dans le lien de la page
function liens_en_clair_post_propre($texte) {
	if (!defined('_CS_PRINT') || strpos($texte, 'href')===false) return $texte;
	// appeler liens_en_clair() une fois que certaines balises ont ete protegees
	return cs_echappe_balises('html|code|cadre|frame|script|acronym|cite', 'liens_en_clair', $texte);
}

?>