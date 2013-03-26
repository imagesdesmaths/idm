<?php

@define('_CS_AUTOBR_BR', '<br />');

// Sous SPIP 3, _CS_AUTOBR_TRAIT n'est jamais defini

// pipeline pre_typo, appel automatique si defined('_CS_AUTOBR_RACC')
function autobr_alinea($flux) {
	while ($fin = strpos($flux, '</alinea>')) {
		$zone = substr($flux, 0, $fin);
		if(($deb = strpos($zone, '<alinea>'))!==false)	$zone = substr($zone, $deb + 8);
		$flux = substr($flux, 0, $deb) 
			// protection des echappement eventuels
			. str_replace('@ABR@', 'base64', post_autobr(trim(str_replace('base64', '@ABR@', $zone)), _CS_AUTOBR_BR)) 
			. substr($flux, $fin + strlen('</alinea>'));
	}
	return $flux;
}

// traitements sur la balise #TEXTE (SPIP < 3)
function autobr_pre_propre($flux) {
	// post_autobr() est une fonction de traitement qui possede son propre systeme d'echappement
	// on traite, sauf si la balise alinea est detectee
	if(defined('_CS_AUTOBR_TRAIT') && (!defined('_CS_AUTOBR_RACC') || strpos($flux, '<alinea>')===false))
		$flux = cs_echappe_balises('html|code|cadre|frame|script|jeux', 'post_autobr', $flux, _CS_AUTOBR_BR);
	return $flux;
}

if(defined('_CS_AUTOBR_RACC')) {
	// liste des nouveaux raccourcis ajoutes par l'outil
	// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
	function autobr_raccourcis() {
		return _T('couteauprive:autobr_racc');
	}
}

function autobr_nettoyer_raccourcis($texte) {
	return str_replace(array('<alinea>','</alinea>'), '', $texte);
}

function autobr_PP_icones($flux) {
	if(defined('_CS_AUTOBR_RACC')) $flux['autobr'] = 'autobr.png';
	return $flux;
}

function autobr_CS_pre_charger($flux) {
	if(!defined('_CS_AUTOBR_RACC')) return $flux;
	$r = array(array(
		"id" => 'autobr',
		"name" => _T('couteau:pp_autobr'),
		"className" => 'autobr',
		"openWith"    => "\n&lt;alinea&gt;", 
		"closeWith"   => "&lt;/alinea&gt;\n",
		"selectionType" => "line",
		"display" => true));
	foreach(cs_pp_liste_barres('autobr') as $b)
		$flux[$b] = isset($flux[$b])?array_merge($flux[$b], $r):$r;
	return $flux;
}

?>