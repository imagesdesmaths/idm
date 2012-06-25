<?php
/*
 
+-------------------------------+
 Nom de l'outil : sommaire
+-------------------------------+
 Date : mardi 03 avril 2007
 Auteur :  Patrice Vanneufville
+-------------------------------+
 Presente un petit sommaire 
 en haut de l'article base sur 
 les balises {{{}}}
+-------------------------------+

*/

// liste des nouveaux raccourcis ajoutes par l'outil
// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
function sommaire_raccourcis() {
	return _T('couteauprive:sommaire_'.(defined('_sommaire_AUTOMATIQUE')?'sans':'avec'))
	.'<br />'._T('couteauprive:sommaire_titres')
	.(defined('_sommaire_JOLIES_ANCRES')?'<br />'._T('couteauprive:sommaire_ancres'):'');
}

// pipeline 'nettoyer_raccourcis'
function sommaire_nettoyer_raccourcis($texte) {
	$texte = preg_replace(',\{\{\{\*+,', '{{{', $texte);
	return str_replace(array(_sommaire_SANS_FOND, _CS_SANS_SOMMAIRE, _CS_AVEC_SOMMAIRE), '', $texte);
}

// renvoie le niveau d'intertitre en cours
function sommaire_niveau_intertitres() {
	// SPIP 3.0 remplace les intertitres avec TextWheels
	// TODO : recuperer la valeur utilisee par TW au lieu de '3'
	return (isset($GLOBALS['debut_intertitre']) && preg_match(',<h(\d),', $GLOBALS['debut_intertitre'], $r))
		?$r[1]:'3';
}

// informer dans la description de l'outil de la balise utilisee par SPIP
function sommaire_description_outil($flux) {
	if($flux['outil']=='sommaire') {
		$h = sommaire_niveau_intertitres();
		$flux['texte'] = str_replace(array('@h3@','@h4@'), array('h'.$h,'h'.($h+1)), $flux['texte']);
	}
	return $flux;
}

// callback pour la fonction suivante
function sommaire_intertitres_callback($matches) {
	static $racc = array();
	$niv = strlen($matches[1])-1;
	if(!isset($racc[$niv])) {
		// SPIP 3.0 : plus de globale ! TODO : recuperer la valeur utilisee par TW au lieu de 'h3'
		if(!isset($GLOBALS['debut_intertitre'])) $GLOBALS['debut_intertitre'] = '<h3 class="spip">';
		if(!isset($GLOBALS['fin_intertitre'])) $GLOBALS['fin_intertitre'] = '</h3>';
		$cfg = $niv+1;
		// compatibilite avec les Enluminures Typo v3 et initialisation des variables
		if(function_exists('typoenluminee_pre_propre')) typoenluminee_pre_propre('');
		// double emploi ici, mais le sommaire a besoin que les titres soient transformes
		if($cfg>1 && isset($GLOBALS['debut_intertitre_'.$cfg]))
			$racc[$niv][0] = $GLOBALS['debut_intertitre_'.$cfg];
		// si pas d'enluminures, copie sur les <h3>
		elseif(preg_match(',<h(\d),', $GLOBALS['debut_intertitre'], $r))	
			$racc[$niv][0] = str_replace($r[0], '<h'.($r[1]+$niv), $GLOBALS['debut_intertitre']);
		// au pire, pas de sous-titres !
		else $racc[$niv][0] = $GLOBALS['debut_intertitre'];
		if($cfg>1 && isset($GLOBALS['fin_intertitre_'.$cfg]))
			$racc[$niv][1] = $GLOBALS['fin_intertitre_'.$cfg];
		elseif(preg_match(',/h(\d)>,', $GLOBALS['fin_intertitre'], $r))
			$racc[$niv][1] = str_replace($r[0], '/h'.($r[1]+$niv).'>', $GLOBALS['fin_intertitre']);
		else $racc[$niv][1] = $GLOBALS['fin_intertitre'];
	}
	return $racc[$niv][0].$matches[2].$racc[$niv][1];
}

// cette fonction n'est pas appelee dans les balises html : html|code|cadre|frame|script
function sommaire_intertitres_rempl($texte) {
	if (strpos($texte, '{{{*')===false) return $texte;
	return preg_replace_callback(',\{\{\{(\*+)(.*?)\}\}\},ms', 'sommaire_intertitres_callback', $texte);
}

// fonction pipeline pre_typo
function sommaire_intertitres($texte) {
	if (strpos($texte, '{{{*')===false) return $texte;
	// on remplace apres echappement
	return cs_echappe_balises('', 'sommaire_intertitres_rempl', $texte);
}
?>