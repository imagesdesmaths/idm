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
	function objet_type($table_objet){ return preg_replace(',^spip_|s$,', '', $table_objet); }
}

// fonction obsolete sous SPIP 3.0
function chapo_redirigetil2($chapo) { return $chapo && $chapo[0] == '=';	}

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

function remplace_points_de_suite($texte, $id, $racc, $connect=NULL) {
	// des points de suite bien propres
	defined('_INTRODUCTION_SUITE') || define('_INTRODUCTION_SUITE', '&nbsp;(...)');
	defined('_INTRODUCTION_LIEN') || define('_INTRODUCTION_LIEN', 0);
	defined('_INTRODUCTION_SUITE_SYSTEMATIQUE') || define('_INTRODUCTION_SUITE_SYSTEMATIQUE', 0);
	if (strpos($texte, _INTRODUCTION_CODE) === false) {
		if(!_INTRODUCTION_SUITE_SYSTEMATIQUE) return $texte;
		$texte .= _INTRODUCTION_SUITE;
	}
	$intro_suite = cs_propre(_INTRODUCTION_SUITE);
	// si les points de suite sont cliquables
	if ($id && _INTRODUCTION_LIEN) {
		if(defined('_SPIP19300')) {
			if(!$connect) $connect = true;
			$url = test_espace_prive()
				?generer_url_entite_absolue($id, $racc, '', '', $connect)
				:generer_url_entite($id, $racc, '', '', $connect); //"$racc$id";
		} else $url= $racc.$id;
		$intro_suite = strncmp($intro_suite, '<br />', 6)===0
			?'<br />'.cs_lien($url, substr($intro_suite, 6))
			:'&nbsp;'.cs_lien($url, $intro_suite);
		$intro_suite = inserer_attribut($intro_suite, 'class', extraire_attribut($intro_suite,'class') . ' pts_suite');
	}
	return str_replace(_INTRODUCTION_CODE, $intro_suite, $texte);
}

// lgr>0 : aucun paramètre, donc longueur par défaut
// lgr<0 : paramètre spécifié #INTRODUCTION{longueur}
// lgr=0 : pas possible
// $connect (bases distantes) est pour SPIP>=2.0
function cs_introduction($texte, $descriptif, $lgr, $id, $racc, $connect) {
	defined('_INTRODUCTION_LGR') || define('_INTRODUCTION_LGR', 100);
	defined('_INTRODUCTION_DESCRIPTIF_ENTIER') || define('_INTRODUCTION_DESCRIPTIF_ENTIER', 0);
	// fonction couper_intro
	$couper = $GLOBALS['cs_couper_intro'];
	if (strlen($descriptif))
		# si le descriptif ne contient que des espaces ça produit une intro vide, 
		# c'est une fonctionnalité, pas un bug
		// ici le descriptif est coupé s'il est trop long et si la config le permet
		$texte = propre(
			($lgr<0 && !_INTRODUCTION_DESCRIPTIF_ENTIER)
				?$couper($descriptif, -$lgr, _INTRODUCTION_CODE):$descriptif
		);
	else {
		// pas de maths dans l'intro...
		$texte = preg_replace(',<math>.*</math>,imsU', '', $texte);
		// on coupe proprement...
		$lgr = $lgr>0?round($lgr*_INTRODUCTION_LGR/100):-$lgr;
		$texte = cs_propre(supprimer_tags($couper(cs_introduire($texte), $lgr, _INTRODUCTION_CODE)));
	}
	// si les points de suite ont ete ajoutes
	return remplace_points_de_suite($texte, $id, $racc, $connect);
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
				$_texte = defined('_SPIP30000')
					?"strlen($_descriptif) ? '' : $_chapo . \"\\n\\n\" . $_texte"
					:"(strlen($_descriptif) OR chapo_redirigetil2($_chapo)) ? '' : $_chapo . \"\\n\\n\" . $_texte";
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