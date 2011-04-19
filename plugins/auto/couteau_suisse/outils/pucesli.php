<?php

function pucesli_rempl($texte) {
	return preg_replace('/^-\s*(?![-*#])/m', '-* ', $texte);
}

function pucesli_pre_typo($texte) {
	if (strpos($texte, '-')===false) return $texte;
	return cs_echappe_balises('', 'pucesli_rempl', $texte);
}

?>