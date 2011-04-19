<?php

@define('_INTRODUCTION_CODE', '@@CS_SUITE@@');

// compatibilite avec SPIP 1.92 et anterieurs
$GLOBALS['cs_couper_intro'] = 'couper_intro';
if (!defined('_SPIP19300')) {
	$GLOBALS['cs_couper_intro'] = 'couper_intro2';
	function couper_intro2($texte, $long, $suite) {
		$texte = couper_intro($texte, $long);
		$i = strpos($texte, '&nbsp;(...)');
		if (strlen($texte) - $i == 11)
			$texte = substr($texte, 0, $i) . _INTRODUCTION_CODE;
		return $texte;
	}
	function chapo_redirigetil($chapo) { return $chapo && $chapo[0] == '=';	}
	function objet_type($table_objet){ return preg_replace(',^spip_|s$,', '', $table_objet); }
}
// compatibilite avec SPIP 2.0 : la balise a fortement change !! >> TODO
// la fonction couper_intro a disparu.
// voir function filtre_introduction_dist
if (defined('_SPIP19300')) {
	$GLOBALS['cs_couper_intro'] = 'couper_intro3';
	function couper_intro3($texte, $long, $suite) {
		$texte = extraire_multi(preg_replace(",(</?)intro>,i", "\\1intro>", $texte)); // minuscules
		$intro = '';
		while ($fin = strpos($texte, "</intro>")) {
			$zone = substr($texte, 0, $fin);
			$texte = substr($texte, $fin + strlen("</intro>"));
			if ($deb = strpos($zone, "<intro>") OR substr($zone, 0, 7) == "<intro>")
				$zone = substr($zone, $deb + 7);
			$intro .= $zone;
		}
		$texte = nettoyer_raccourcis_typo($intro ? $intro : $texte);
		return PtoBR(traiter_raccourcis(preg_replace(',([|]\s*)+,S', '; ', couper($texte, $long, _INTRODUCTION_CODE))));
	}
}

function remplace_points_de_suite($texte, $id, $racc) {
	if (strpos($texte, _INTRODUCTION_CODE) === false) return $texte;
	// precaution sur le tout paragrapher de SPIP >= 2.0 !
	$mem = $GLOBALS['toujours_paragrapher'];  
	$GLOBALS['toujours_paragrapher'] = false;  
	// des points de suite bien propres
	@define('_INTRODUCTION_SUITE', '&nbsp;(...)');
	$intro_suite = propre(_INTRODUCTION_SUITE);
	// si les points de suite sont cliquables
	if ($id && _INTRODUCTION_LIEN == 1) {
		$url = (defined('_SPIP19300') && test_espace_prive())
			?generer_url_entite_absolue($id, $racc, '', '', true):"$racc$id";
		if (substr($intro_suite, 0, 6) == '<br />') 
			$intro_suite = propre("<br />[".substr($intro_suite, 6)."->$url]");
			else $intro_suite = propre("&nbsp;[{$intro_suite}->$url]");
		$intro_suite = inserer_attribut($intro_suite, 'class', extraire_attribut($intro_suite,'class') . ' pts_suite');
	}
	$GLOBALS['toujours_paragrapher'] = $mem; 
	return str_replace(_INTRODUCTION_CODE, $intro_suite, $texte);
}

// lgr>0 : aucun parametre, donc lgr par defaut
// lgr<0 : parametre #INTRODUCTION{longeur}
// lgr=0 : pas possible
// TODO : $connect est pour SPIP 2.0
function cs_introduction($texte, $descriptif, $lgr, $id, $racc, $connect) {
	@define('_INTRODUCTION_LGR', 100);
	// fonction couper_intro
	$couper = $GLOBALS['cs_couper_intro'];
	if (strlen($descriptif))
		# si descriptif contient juste des espaces ca produit une intro vide, 
		# c'est une fonctionnalite, pas un bug
		// ici le descriptif est coupe s'il est trop long
		$texte = $lgr<0?propre($couper($descriptif, -$lgr, _INTRODUCTION_CODE)):propre($descriptif);
	else {
		// pas de maths dans l'intro...
		$texte = preg_replace(',<math>.*</math>,imsU', '', $texte);
		// on coupe proprement...
		$lgr = $lgr>0?round($lgr*_INTRODUCTION_LGR/100):-$lgr;
		$texte = PtoBR(propre(supprimer_tags($couper(cs_introduire($texte), $lgr, _INTRODUCTION_CODE))));
	}
	// si les points de suite ont ete ajoutes
	return remplace_points_de_suite($texte, $id, $racc);
} // introduction()

if (!function_exists('balise_INTRODUCTION')) {
	// #INTRODUCTION_SPIP (pour tests)
	function balise_INTRODUCTION_SPIP($p) {
		return balise_INTRODUCTION_dist($p);
	}
	include_spip('public/interfaces');
	global $table_des_traitements;
	// INTRODUCTION_SPIP est une INTRODUCTION !
	if (!isset($table_des_traitements['INTRODUCTION_SPIP']))
		$table_des_traitements['INTRODUCTION_SPIP'] = $table_des_traitements['INTRODUCTION'];
	// #INTRODUCTION
	function balise_INTRODUCTION($p) {
		$type = $p->type_requete;
		$_texte = champ_sql('texte', $p);
		$_descriptif =  "''";
		$_id = 0;
		$_lgr = "600";
		switch ($type) {
			case 'articles':
				$_chapo = champ_sql('chapo', $p);
				$_descriptif =  champ_sql('descriptif', $p);
				$_texte = "(strlen($_descriptif) OR chapo_redirigetil($_chapo)) ? '' : $_chapo . \"\\n\\n\" . $_texte";
				$_lgr = "500";
				break;
			case 'rubriques':
				$_descriptif =  champ_sql('descriptif', $p);
				break;
			case 'breves':
				$_lgr = "300";
				break;
		}
		// longueur en parametre ?
		if(($v = interprete_argument_balise(1,$p))!==NULL) $_lgr = "-intval($v)" ;
		$_id = champ_sql(id_table_objet($racc = objet_type($type)), $p);
		$p->code = "cs_introduction($_texte, $_descriptif, $_lgr, $_id, '$racc', \$connect)";
		#$p->interdire_scripts = true;
		$p->etoile = '*'; // propre est deja fait dans le calcul de l'intro
		return $p;
	}
	
} //!function_exists('balise_INTRODUCTION') 
else spip_log("Erreur - balise_INTRODUCTION() existe deja et ne peut pas etre surchargee par le Couteau Suisse !");

?>