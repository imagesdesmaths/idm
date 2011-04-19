<?php

@define('_sommaire_NB_TITRES_MINI', 2);
@define('_sommaire_SANS_FOND', '[!fond]');

// aide le Couteau Suisse a calculer la balise #INTRODUCTION
$GLOBALS['cs_introduire'][] = 'sommaire_nettoyer_raccourcis';

// renvoie le sommaire d'une page d'article
// $page=false reinitialise le compteur interne des ancres
function sommaire_d_une_page(&$texte, &$nbh3, $page=0, $num_pages=0) {
	static $index = 0;
	if($page===false) $index = 0;
	static $self = NULL; 
	if(!isset($self)) 
		$self = str_replace('&', '&amp;', nettoyer_uri());//self();//$GLOBALS['REQUEST_URI'];
	if($page===false) return;
	// trouver quel <hx> est utilise
	$root = $niveau = $match = preg_match(',<h(\d),',$GLOBALS['debut_intertitre'],$regs)?$regs[1]:'3';
	@define('_sommaire_NB_CARACTERES', 30);
	@define('_sommaire_PROFONDEUR', 1);
	if(_sommaire_PROFONDEUR>1)
		$match = $match .'-' . ($match+_sommaire_PROFONDEUR-1);
	// traitement des intertitres <hx>
	preg_match_all(",(<h([$match])[^>]*)>(.*)</h\\2>,Umsi", $texte, $regs);
	$nbh3 += count($regs[0]);
	$pos = 0; $sommaire = '';
	// calcul de la page
	$suffixe = $page?_T('couteau:sommaire_page', array('page'=>$page)):'';
	$fct_lien_retour = function_exists('sommaire_lien_retour')?'sommaire_lien_retour':'sommaire_lien_retour_dist';
	$fct_id_ancre = defined('_sommaire_JOLIES_ANCRES')?'sommaire_id_ancre_ex'
		:(function_exists('sommaire_id_ancre')?'sommaire_id_ancre':'sommaire_id_ancre_dist');
	$nb = count($regs[0]);
	for($i=0;$i<$nb;$i++,$index++){
		$w = &$regs[0][$i]; $h = &$regs[1][$i]; $n = &$regs[2][$i];
		if (($pos2 = strpos($texte, $w, $pos))!==false) {
			$t = $regs[3][$i];
			// calcul de l'ancre, $t peut etre modifie
			$ancre = $fct_id_ancre($index, $t, $n);
			$id = " id=\"$ancre\">";
			//$titre = preg_replace(',^<p[^>]*>(.*)</p>$,Umsi', '\\1', trim($t));
			// ancre 'retour au sommaire', sauf :
			// si on imprime, ou si les blocs depliables utilisent h{$n}...
			$titre = (defined('_CS_PRINT') OR (strpos($w, 'blocs_titre')!==false))
				?$t//$titre
				:$fct_lien_retour($self, $t);//$titre);
			$texte = substr($texte, 0, $pos2) . $h . $id . $titre
				. substr($texte, $pos2 + strlen($h)+1 + strlen($regs[3][$i]));
			$pos = $pos2 + strlen($id) + strlen($w);
			$brut = sommaire_nettoyer_titre($t);
			// pas trop long quand meme...
			$lien = cs_propre(couper($brut, _sommaire_NB_CARACTERES));
			// eviter une ponctuation a la fin, surtout si la page est precisee
			$lien = preg_replace('/(&nbsp;|\s)*'.($page?'[!?,;.:]+$/':'[,;.:]+$/'), '', $lien);
			$titre = attribut_html(couper($brut, 100));
			// si la decoupe en page est active...
			$artpage = (function_exists('decoupe_url') && (strlen(_request('artpage')) || $page>1) )
				?decoupe_url($self, $page, $num_pages):$self;
			$artpage = "\n<li><a $st title=\"$titre\" href=\"{$artpage}#$ancre\">$lien</a>$suffixe";
			if($niveau==$n) $sommaire .= ($sommaire?'</li>':'').$artpage;
			elseif($niveau<$n) $sommaire .= "\n<ul>".$artpage;
			else $sommaire .= '</li></ul></li>'.$artpage;
			$niveau = $n;
		}
	}
	return $sommaire?$sommaire.'</li>'.($niveau!=$root?'</ul>':''):'';
}

function sommaire_nettoyer_titre($t) {
	// pas de notes
	$brut = preg_replace(',\[<a href=["\']#nb.*?</a>\],','', echappe_retour($t,'CS'));
	// pas de glossaire
	if(function_exists('cs_retire_glossaire')) $brut = cs_retire_glossaire($brut);
	// texte brut
	$brut2 = trim(preg_replace(',[\n\r]+,',' ',textebrut($brut)));
	// cas des intertitres en image_typo
	if(!strlen($brut2)) $brut2 = trim(extraire_attribut($brut, 'alt'));
	return $brut2;
}

/*
 Fonction surchargeable qui reconstruit les titres de la page 
 en ajoutant une ancre de retour au sommaire.
 La fonction de surcharge a placer dans config/mes_options.php est : 
   sommaire_lien_retour($self, $titre)
 Exemple sans lien de retour : 
   function sommaire_lien_retour($self, $titre) { return $titre; }
*/
function sommaire_lien_retour_dist($self, $titre) {
	static $haut = NULL;
	if(!isset($haut)) 
		$haut = '<a title="'._T('couteau:sommaire_titre').'" href="'.$self.'#outil_sommaire" class="sommaire_ancre">&nbsp;</a>';
	return $haut . $titre;
}

/*
 Fonction surchargeable qui calcule l'ancre d'un intertitre 
 La fonction de surcharge a placer dans config/mes_options.php est : 
   sommaire_id_ancre($index, &$titre, $hn)
 $titre peut etre modifie par cette fonction : utile pour traiter le format {{{Mon titre<mon_ancre>}}}
*/
function sommaire_id_ancre_dist($index, &$titre, $hn) {
	return 'outil_sommaire_'.$index;
}

// Surcharge compatible avec les intertitres en image : jolies ancres
function sommaire_id_ancre_ex($index, &$titre, $hn) {
	// traiter le format {{{Mon titre<mon_ancre>}}} (ou alt='Mon titre&lt;mon_ancre&gt;')
	if(preg_match(',<(\w+)>$,', $titre, $r) || preg_match(',&lt;(\w+)&gt;(?=\'),', $titre, $r)) {
		$titre = str_replace($r[0], '', $titre);
		return $r[1];
	}
	// calculer les ancres d'apres le titre
	$a = strtolower(translitteration(sommaire_nettoyer_titre($titre)));
	$a = trim(preg_replace(',[^a-z0-9_]+,', '_', $a), '_');
	return strlen($a)>2?$a:"sommaire_$index";
}

// fonction appellee sur les parties du textes non comprises entre les balises : html|code|cadre|frame|script|acronym|cite
function sommaire_d_article_rempl($texte0, $sommaire_seul=false) {
	// pour sommaire_nettoyer_raccourcis()
	include_spip('outils/sommaire');
	// si le sommaire est malvenu ou s'il n'y a pas de balise <hx>, alors on laisse tomber
	$inserer_sommaire =  defined('_sommaire_AUTOMATIQUE')
		?strpos($texte0, _CS_SANS_SOMMAIRE)===false
		:strpos($texte0, _CS_AVEC_SOMMAIRE)!==false;
	if (!$inserer_sommaire || strpos($texte0, '<h')===false) 
		return $sommaire_seul?'':sommaire_nettoyer_raccourcis($texte0);
	// on retire les raccourcis du texte
	$texte = sommaire_nettoyer_raccourcis($texte0);
	// on masque les onglets s'il y en a
	if(defined('_onglets_FIN'))
		$texte = preg_replace_callback(',<div class="onglets_bloc_initial.*'._onglets_FIN.',Ums',
			create_function('$matches','return cs_code_echappement($matches[0], \'SOMM\');'), $texte);
	// et la, on y va...
	$sommaire = ''; $i = 1; $nbh3 = 0;
	// reinitialisation de l'index interne de la fonction
	sommaire_d_une_page($texte, $nbh3, false);
	// couplage avec l'outil 'decoupe_article'
	if(defined('_decoupe_SEPARATEUR') && !defined('_CS_PRINT')) {
		$pages = explode(_decoupe_SEPARATEUR, $texte);
		if (($num_page=count($pages)) == 1) $sommaire = sommaire_d_une_page($texte, $nbh3);
		else {
			foreach($pages as $p=>$page) { $sommaire .= sommaire_d_une_page($page, $nbh3, $i++, $num_page); $pages[$p] = $page; }
			$texte = join(_decoupe_SEPARATEUR, $pages);
		}
	} else $sommaire = sommaire_d_une_page($texte, $nbh3);
	if(!strlen($sommaire) || $nbh3<_sommaire_NB_TITRES_MINI)
		return $sommaire_seul?'':sommaire_nettoyer_raccourcis($texte0);

	// calcul du sommaire
	include_spip('public/assembler');
	$sommaire = recuperer_fond('fonds/sommaire', array(
		'sommaire'=>$sommaire,
		'fond_css'=>strpos($texte0, _sommaire_SANS_FOND)===false ?'avec':'sans',
	));

	// si on ne veut que le sommaire, on renvoie le sommaire
	// sinon, on n'insere ce sommaire en tete de texte que si la balise #CS_SOMMAIRE n'est pas activee
	if($sommaire_seul) return $sommaire;
	if(defined('_onglets_FIN')) $texte = echappe_retour($texte, 'SOMM');
	if(defined('_sommaire_BALISE')) return $texte;
	return _sommaire_REM.$sommaire._sommaire_REM.$texte;
}

// fonction appelee par le traitement de #TEXTE/articles
function sommaire_d_article($texte) {
	// s'il n'y a aucun intertitre, on ne fait rien
	// si la balise est utilisee, il faut quand meme inserer les ancres de retour
	if((strpos($texte, '<h')===false)) return $texte;
	return cs_echappe_balises('html|code|cadre|frame|script|acronym|cite|onglets|table', 'sommaire_d_article_rempl', $texte, false);
}

// fonction appelee par le traitement post_propre de #CS_SOMMAIRE
function sommaire_d_article_balise($texte) {
	// si la balise n'est pas utilisee ou s'il n'y a aucun intertitre, on ne fait rien
	if(!defined('_sommaire_BALISE') || (strpos($texte, '<h')===false)) return '';
	return cs_echappe_balises('html|code|cadre|frame|script|acronym|cite|onglets|table', 'sommaire_d_article_rempl', $texte, true);
}

// si on veut la balise #CS_SOMMAIRE
if (defined('_sommaire_BALISE')) {
	// fonction traitant la balise
	function balise_CS_SOMMAIRE_dist($p) {
		// id de l'article a trouver pour retourner son texte
		$texte = ($v = interprete_argument_balise(1,$p))!==NULL ? 'cs_champ_sql('.$v.')' : champ_sql('texte', $p);
		if ($p->type_requete == 'articles' || $v!==NULL) {
			$p->code = 'cs_supprime_notes('.$texte.')';
		} else {
			$p->code = "''";
		}
		$p->interdire_scripts = true;
		return $p;
	}
}
?>