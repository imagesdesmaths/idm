<?php
/*
	+----------------------------+
	Date : mardi 28 janvier 2003
	Auteur :  "gpl"
	Serieuse refonte et integration en mars 2007 : Patrice Vanneufville
	+-------------------------------------------------------------------+
*/

// liste des nouveaux raccourcis ajoutes par l'outil
// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
function decoupe_raccourcis() {
	$compat = defined('_decoupe_COMPATIBILITE')
		?_T('couteauprive:decoupe:aide2', array('sep' => '<b>'._decoupe_COMPATIBILITE.'</b>')):'';
	return _T('couteauprive:decoupe:aide', array('sep' => '<b>'._decoupe_SEPARATEUR.'</b>')).$compat;
}

function decoupe_nettoyer_raccourcis($texte) {
	if (defined('_decoupe_COMPATIBILITE'))
		return str_replace(array(_decoupe_SEPARATEUR, _decoupe_COMPATIBILITE), '<p>&nbsp;</p>', $texte);
	return str_replace(_decoupe_SEPARATEUR, '<p>&nbsp;</p>', $texte);
}

// 2 fonctions pour le plugin Porte Plume, s'il est present (SPIP>=2.0)
function decoupe_CS_pre_charger($flux) {
	$r = array(array(
		"id" => 'decoupe_pages',
		"name" => _T('couteau:pp_decoupe_separateur'),
		"className" => 'decoupe_pages',
		"replaceWith" => "\n"._decoupe_SEPARATEUR."\n",
		"display" => true), array(
		"id" => 'decoupe_onglets',
		"name" => _T('couteau:pp_decoupe_onglets'),
		"className" => 'decoupe_onglets',
		"replaceWith" => "\n<onglets>"._T('couteau:pp_votre_titre', array('nb'=>1))."\n\n"._T('couteau:pp_votre_texte')."\n\n"
			._decoupe_SEPARATEUR._T('couteau:pp_votre_titre', array('nb'=>2))."\n\n"._T('couteau:pp_votre_texte')."\n\n"
			._decoupe_SEPARATEUR._T('couteau:pp_votre_titre', array('nb'=>3))."\n\n"._T('couteau:pp_votre_texte')."\n\n</onglets>\n",
		"display" => true));
	foreach(cs_pp_liste_barres('decoupe') as $b) {
		// pas de decoupe dans les forums
		$r2 = $b=='forum'?array($r[1]):$r;
		$flux[$b] = isset($flux[$b])?array_merge($flux[$b], $r2):$r2;
	}
	return $flux;
}
function decoupe_PP_icones($flux) {
	$flux['decoupe_pages'] = 'decoupe_pages.png';
	$flux['decoupe_onglets'] = 'decoupe_onglets.png';
	return $flux;
}

?>