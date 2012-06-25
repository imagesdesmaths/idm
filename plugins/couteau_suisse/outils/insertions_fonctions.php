<?php

// cette fonction n'est pas appelee dans les balises html : html|code|cadre|frame|script
function insertions_rempl($texte) {
	$ins = cs_lire_data_outil('insertions');
	if(!$ins) return $texte;
	$texte = str_replace($ins[0][0], $ins[0][1], $texte);
	return preg_replace($ins[1][0], $ins[1][1], $texte);
}

function insertions_callback($m) {
	return $m[1].cs_code_echappement($m[2], 'CS');
}

// Fonctions de traitement sur #TEXTE
function insertions_pre_propre($texte) {
	// prudence : on protege les liens de raccourcis de liens SPIP
	if (strpos($texte, '[')!==false) 
		$texte = preg_replace_callback(',(\[[^][]*->>?)([^]]*)(?=\]),msS', 'insertions_callback', $texte);
	return cs_echappe_balises('', 'insertions_rempl', $texte);
}

?>