<?php

/*
   Cet outil en couleurs permet aux redacteurs d'un site spip de d'appliquer facilement des couleurs aux textes SPIP
   Utilisation pour le redacteur : 
		[rouge]Lorem ipsum dolor sit amet[/rouge]
		[red]Lorem ipsum dolor sit amet[/red]
   Les balises anglaises sont les couleurs utilisees dans les feuilles de style.
   Attention : seules les balises en minuscules sont reconnues.
*/
/*
   +----------------------------------+
    Nom de l'outil : Couleurs dans vos textes
   +----------------------------------+
    Date : Vendredi 11 aout 2003
    Idee originale :  Aurelien PIERARD : aurelien.pierard(a)dsaf.pm.gouv.fr
    Serieuse refonte et integration au Couteau Suisse : Patrice Vanneufville, mars 2007
	Doc : http://contrib.spip.net/?article2427
   +-------------------------------------+
  
*/

function couleurs_constantes() {
	return array(array(
		array('noir', 'rouge', 'marron', 'vert', 'vert olive', 'bleu marine', 'violet', 'gris', 'argent', 'vert clair', 'bleu', 'fuchia', 'bleu clair', 'blanc', 'bleu azur', 'beige', 'brun', 'bleu violet', 'brun clair', 'rose clair', 'vert fonce', 'orange fonce', 'mauve fonce', 'bleu ciel', 'or', 'ivoire', 'orange', 'lavande', 'rose', 'prune', 'saumon', 'neige', 'turquoise', 'jaune paille', 'jaune'),
		array('black', 'red', 'maroon', 'green', 'olive', 'navy', 'purple', 'gray', 'silver', 'chartreuse', 'blue', 'fuchsia', 'aqua', 'white', 'azure', 'bisque', 'brown', 'blueviolet', 'chocolate', 'cornsilk', 'darkgreen', 'darkorange', 'darkorchid', 'deepskyblue', 'gold', 'ivory', 'orange', 'lavender', 'pink', 'plum', 'salmon', 'snow', 'turquoise', 'wheat', 'yellow') ),
	array('aliceblue'=>'F0F8FF','antiquewhite'=>'FAEBD7','aqua'=>'00FFFF','aquamarine'=>'7FFFD4','azure'=>'F0FFFF','beige'=>'F5F5DC','bisque'=>'FFE4C4','black'=>'000000','blanchedalmond'=>'FFEBCD','blue'=>'0000FF','blueviolet'=>'8A2BE2','brown'=>'A52A2A','burlywood'=>'DEB887','cadetblue'=>'5F9EA0','chartreuse'=>'7FFF00','chocolate'=>'D2691E','coral'=>'FF7F50','cornflowerblue'=>'6495ED','cornsilk'=>'FFF8DC','crimson'=>'DC143C','cyan'=>'00FFFF','darkblue'=>'00008B','darkcyan'=>'008B8B','darkgoldenrod'=>'B8860B','darkgray'=>'A9A9A9','darkgreen'=>'006400','darkkhaki'=>'BDB76B','darkmagenta'=>'8B008B','darkolivegreen'=>'556B2F','darkorange'=>'FF8C00','darkorchid'=>'9932CC','darkred'=>'8B0000','darksalmon'=>'E9967A','darkseagreen'=>'8FBC8F','darkslateblue'=>'483D8B','darkturqoise'=>'00CED1','darkslategray'=>'2F4F4F','darkviolet'=>'9400D3','deeppink'=>'FF1493','deepskyblue'=>'00BFFF','dimgray'=>'696969','dodgerblue'=>'1E90FF','firebrick'=>'B22222','floralwhite'=>'FFFAF0','forestgreen'=>'228B22','fuchsia'=>'FF00FF','gainsboro'=>'DCDCDC','ghostwhite'=>'F8F8FF','gold'=>'FFD700','goldenrod'=>'DAA520','gray'=>'808080','green'=>'008000','greenyellow'=>'ADFF2F','honeydew'=>'F0FFF0','hotpink'=>'FF69B4','indianred'=>'CD5C5C','indigo'=>'4B0082','ivory'=>'FFFFF0','khaki'=>'F0E68C','lavender'=>'E6E6FA','lavenderblush'=>'FFF0F5','lawngreen'=>'7CFC00','lemonchiffon'=>'FFFACD','lightblue'=>'ADD8E6','lightcoral'=>'F08080','lightcyan'=>'E0FFFF','lightgoldenrodyellow'=>'FAFAD2','lightgreen'=>'90EE90','lightgrey'=>'D3D3D3','lightpink'=>'FFB6C1','lightsalmon'=>'FFA07A','lightseagreen'=>'20B2AA','lightskyblue'=>'87CEFA','lightslategray'=>'778899','lisghtsteelblue'=>'B0C4DE','lightyellow'=>'FFFFE0','lime'=>'00FF00','limegreen'=>'32CD32','linen'=>'FAF0E6','magenta'=>'FF00FF','maroon'=>'800000','mediumaquamarine'=>'66CDAA','mediumblue'=>'0000CD','mediumorchid'=>'BA55D3','mediumpurple'=>'9370DB','mediumseagreen'=>'3CB371','mediumslateblue'=>'7B68EE','mediumspringgreen'=>'00FA9A','mediumturquoise'=>'48D1CC','mediumvioletred'=>'C71585','midnightblue'=>'191970','mintcream'=>'F5FFFA','mistyrose'=>'FFE4E1','moccasin'=>'FFE4B5','navajowhite'=>'FFDEAD','navy'=>'000080','navyblue'=>'9FAFDF','oldlace'=>'FDF5E6','olive'=>'808000','olivedrab'=>'6B8E23','orange'=>'FFA500','orangered'=>'FF4500','orchid'=>'DA70D6','palegoldenrod'=>'EEE8AA','palegreen'=>'98FB98','paleturquoise'=>'AFEEEE','palevioletred'=>'DB7093','papayawhip'=>'FFEFD5','peachpuff'=>'FFDAB9','peru'=>'CD853F','pink'=>'FFC0CB','plum'=>'DDA0DD','powderblue'=>'B0E0E6','purple'=>'800080','red'=>'FF0000','rosybrown'=>'BC8F8F','royalblue'=>'4169E1','saddlebrown'=>'8B4513','salmon'=>'FA8072','sandybrown'=>'F4A460','seagreen'=>'2E8B57','seashell'=>'FFF5EE','sienna'=>'A0522D','silver'=>'C0C0C0','skyblue'=>'87CEEB','slateblue'=>'6A5ACD','snow'=>'FFFAFA','springgreen'=>'00FF7F','steelblue'=>'4682B4','tan'=>'D2B48C','teal'=>'008080','thistle'=>'D8BFD8','tomato'=>'FF6347','turquoise'=>'40E0D0','violet'=>'EE82EE','wheat'=>'F5DEB3','white'=>'FFFFFF','whitesmoke'=>'F5F5F5','yellow'=>'FFFF00','yellowgreen'=>'9ACD32') );
}

// cette fonction appelee automatiquement a chaque affichage de la page privee du Couteau Suisse renvoie un tableau
function couleurs_installe_dist() {
cs_log("couleurs_installe_dist()");

	list($couleurs, $html) = couleurs_constantes();
	foreach ($couleurs[0] as $c=>$val)
		$couleurs[2][$val] = isset($html[$couleurs[1][$c]])?'#'.$html[$couleurs[1][$c]]:$couleurs[1][$c];

	if (_COULEURS_SET===1) {
		$perso = preg_replace('^\s*(=|,)\s*^','\1', trim(_COULEURS_PERSO));
		$perso = explode(',', $perso);
		$couleurs_perso = array();
		foreach($perso as $p) {
			list($a, $b) = explode('=', $p, 2);
			$b = isset($html[$b])?'#'.$html[$b]:$b;
			if (strlen($a) && strlen($b)) {
				if(in_array($b, $couleurs[0])) $b = $couleurs[2][$b];
				$couleurs_perso[$a] = $b;
			} elseif (strlen($a)) {
				$b=in_array($a, $couleurs[0])?$couleurs[2][$a]:$a;
				$couleurs_perso[$a] = $b;
			}
		}
		$couleurs[2] = $couleurs_perso;
		$couleurs[0] = join('|', array_keys($couleurs_perso));
		$aide = array_keys($couleurs_perso);
	} else {
		$aide = array_merge($couleurs[0], $couleurs[1]);
		$couleurs[0] = join('|', $couleurs[0]);
		$couleurs[1] = join('|', $couleurs[1]);
	}

	if(defined('_DIR_PLUGIN_PORTE_PLUME')) {
		foreach(array('texte','fond') as $x) {
			$texte = _T('couteau:pp_couleur_icone_'.$x);
			foreach ($couleurs[2] as $i=>$c) {
				// icone de la couleur $i
				$color = isset($html[$c])?$html[$c]:str_replace('#','',$c);
				$couleurs[4]['couleur_'.$x.'_'.str_replace(' ','_',$i)] = array($texte, $color);
			}
		}
	}
	return array($couleurs, 'racc'=>$aide);
}

// creation d'icone pour le plugin porte-plume
function couleurs_creer_icone_barre($texte, $color) {
	static $icones_barre;
	rep_icones_barre($icones_barre);
	$img = image_typo($texte, 'couleur='.$color, 'taille=12', 'police=dustismo_bold.ttf');
	$nom = basename($src = extraire_attribut($img, 'src'));
	@copy($src, $icones_barre.$nom);
	return $nom;
}

// liste des nouveaux raccourcis ajoutes par l'outil
// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
function couleurs_raccourcis() {
	$racc = cs_lire_data_outil('couleurs', 'racc');
	return _T('couteauprive:couleurs:aide', array(
		'liste' => '<b>'.join('</b>, <b>', $racc).'</b>',
		'fond' => _COULEURS_FONDS==1?_T('couteauprive:couleurs_fonds'):'',
	));
}

// callbacks
function couleurs_texte_callback($matches) {
	global $outil_couleurs;
	return "<span style=\"color:{$outil_couleurs[2][$matches[1]]};\">";
}
function couleurs_fond_callback($matches) {
	global $outil_couleurs;
	return "<span style=\"background-color:{$outil_couleurs[2][$matches[2]]};\">";
}

// cette fonction n'est pas appelee dans les balises html : html|code|cadre|frame|script
function couleurs_rempl($texte) {
	if (strpos($texte, '[')===false || strpos($texte, '/')===false) return $texte;
	// pour les callbacks
	global $outil_couleurs;

	// voila, on remplace tous les raccourcis $outil_couleurs[0] (balises francaises ou personnalisees)...
	$texte = preg_replace_callback(",\[($outil_couleurs[0])\],", 'couleurs_texte_callback', $texte);
	if(_COULEURS_FONDS===1) {
		$texte = preg_replace_callback(",\[(bg|fond)\s+($outil_couleurs[0])\],", 'couleurs_fond_callback', $texte);
		$texte = preg_replace(",\[/(fond|bg)\],", '</span>', $texte);
		$texte = preg_replace(",\[/(bg|fond)\s+($outil_couleurs[0])\],", '</span>', $texte);
	}
	// cas des 36 couleurs css
	if(_COULEURS_SET===0) {
		// raccourcis anglais, plus facile...
		$texte = preg_replace(",\[($outil_couleurs[1])\],", '<span style="color:$1;">', $texte);
		if(_COULEURS_FONDS===1)
			$texte = preg_replace(",\[(bg|fond)\s+($outil_couleurs[1])\],", '<span style="background-color:$2;">', $texte);
		// et toutes les balises de fin...
		$texte = preg_replace(",\[/(bg|fond)?\s*(couleur|$outil_couleurs[0]|color|$outil_couleurs[1])\],", '</span>', $texte);
	} 
	// cas des couleurs personnalisees
	elseif(_COULEURS_SET===1) {
		// et toutes les balises de fin...
		$texte = preg_replace(",\[/(couleur|$outil_couleurs[0]|color|)\],", '</span>', $texte);
	}
	// patch de conformite : les <span> doivent etre inclus dans les paragraphes
	while (preg_match(",(<span style=\"(background-)?color:[^;]+;\">)([^<]*)\n[\n]+,Sms", $texte, $regs))
		$texte = str_replace($regs[0], "$regs[1]$regs[3]</span>\n\n$regs[1]", $texte);
	return $texte;  
}

function couleurs_pre_typo($texte) {
	if (strpos($texte, '[')===false || strpos($texte, '/')===false) return $texte;
	// pour les callbacks
	global $outil_couleurs;
	// lecture des raccoucis de couleur
	$outil_couleurs = cs_lire_data_outil('couleurs');
	// appeler couleurs_rempl() une fois que certaines balises ont ete protegees
	$texte = cs_echappe_balises('', 'couleurs_rempl', $texte);
	// menage
	unset($outil_couleurs);
	// retour
	return $texte;
}

// cette fonction renvoie une ligne de tableau entre <tr></tr> afin de l'inserer dans la Barre Typo V2, si elle est presente
function couleurs_BarreTypo($tr) {
	$couleurs = cs_lire_data_outil('couleurs');
	$r1 = $r2 = array(); 
	foreach($couleurs[2] as $i=>$v)
		$r1[] = "<a title=\"$i\" href=\"javascript:barre_raccourci('[$i]','[/$i]',@@champ@@)\"><span class=\"cs_BT cs_BTg\" style=\"color:$v;\">A</span></a>";
	$r1 = join(' ', $r1); 
	if(_COULEURS_FONDS===1) {
		foreach($couleurs[2] as $i=>$v)
			$r2[] = "<a title=\"fond $i\" href=\"javascript:barre_raccourci('[fond $i]','[/fond $i]',@@champ@@)\"><span class=\"cs_BT cs_BTg\" style=\"color:$v;\">F</span></a>";
		$r2 = ' '._T('couteauprive:fonds').' '.join(' ', $r2).''; 
	} else $r2='';
	return $tr.'<tr><td><p style="margin:0; line-height:1.9em;">'._T('couteauprive:couleurs:nom')."&nbsp;$r1$r2</div></td></tr>";
}

// les 2 fonctions suivantes inserent les boutons pour le plugin Porte Plume, s'il est present (SPIP>=2.0)
function couleurs_PP_pre_charger($flux) {
	$couleurs = cs_lire_data_outil('couleurs');
	$r1 = $r2 = array();
	foreach($couleurs[2] as $i=>$v) {
		$id = 'couleur_texte_'.str_replace(' ','_',$i);
		$r1[] = array(
				"id" => $id,
				"name" => _T('couteau:pp_couleur_texte', array('couleur'=>$i)),
				"className" => $id, 
				"openWith" => "[$i]", 
				"closeWith" => "[/$i]",
				"selectionType" => "word",
				"display" => true);
	}
	if(_COULEURS_FONDS===1) foreach($couleurs[2] as $i=>$v) {
		$id = 'couleur_fond_'.str_replace(' ','_',$i);
		$r2[] = array(
				"id" => $id,
				"name" => _T('couteau:pp_couleur_fond', array('couleur'=>$i)),
				"className" => $id, 
				"openWith" => "[fond $i]", 
				"closeWith" => "[/fond $i]",
				"selectionType" => "word",
				"display" => true);
	}

	$a = array(
		"id" => 'cs_couleur_texte',
		"name" => _T('couteau:colorer_texte'),
		"className" => 'cs_couleur_texte',
		"replaceWith" => '',
		"display" => true,
		"dropMenu"	=> $r1,
	);
	foreach($barres = cs_pp_liste_barres('couleurs') as $b)
		$flux[$b]->ajouterApres('stroke_through', $a);
	if(!count($r2)) return $flux;

	$a = array(
		"id" => 'cs_couleur_fond',
		"name" => _T('couteau:colorer_fond'),
		"className" => 'cs_couleur_fond',
		"replaceWith" => '',
		"display" => true,
		"dropMenu"	=> $r2,
	);
	foreach($barres as $b)
		$flux[$b]->ajouterApres('cs_couleur_texte', $a);
	return $flux;
}
function couleurs_PP_icones($flux) {
	$couleurs = cs_lire_data_outil('couleurs');
	// icones utilisees. Attention : mettre les drop-boutons en premier !!
	$flux['cs_couleur_texte'] = couleurs_creer_icone_barre(_T('couteau:pp_couleur_icone_texte'), '00BFFF');
	$flux['cs_couleur_fond'] = couleurs_creer_icone_barre(_T('couteau:pp_couleur_icone_fond'), '00BFFF');
	foreach($couleurs[4] as $i=>$v) $flux[$i] = couleurs_creer_icone_barre($v[0], $v[1]);
	return $flux;
}

function couleurs_nettoyer_raccourcis($texte) {
	$couleurs = cs_lire_data_outil('couleurs');
	$couleurs = _COULEURS_SET===0?"$couleurs[0]|$couleurs[1]":$couleurs[0];
	return preg_replace(",\[/?(bg|fond)?\s*($couleurs|couleur|color)\],i", '', $texte);
}

// pipeline maison permettant l'interpretation de la description d'un outil
function couleurs_pre_description_outil($flux) {
	if($flux['outil']==='couleurs')	$flux['texte'] = str_replace(
		array('@_CS_EXEMPLE_COULEURS@', '@_CS_EXEMPLE_COULEURS2@', '@_CS_EXEMPLE_COULEURS3@'),
		array(!$flux['actif']?'@_CS_FOO@':'<br /><span style="font-weight:normal; font-size:85%;"><span style="background-color:black; color:white;">black/noir</span>, <span style="background-color:red;">red/rouge</span>, <span style="background-color:maroon;">maroon/marron</span>, <span style="background-color:green;">green/vert</span>, <span style="background-color:olive;">olive/vert&nbsp;olive</span>, <span style="background-color:navy; color:white;">navy/bleu&nbsp;marine</span>, <span style="background-color:purple;">purple/violet</span>, <span style="background-color:gray;">gray/gris</span>, <span style="background-color:silver;">silver/argent</span>, <span style="background-color:chartreuse;">chartreuse/vert&nbsp;clair</span>, <span style="background-color:blue;">blue/bleu</span>, <span style="background-color:fuchsia;">fuchsia/fuchia</span>, <span style="background-color:aqua;">aqua/bleu&nbsp;clair</span>, <span style="background-color:white;">white/blanc</span>, <span style="background-color:azure;">azure/bleu&nbsp;azur</span>, <span style="background-color:bisque;">bisque/beige</span>, <span style="background-color:brown;">brown/brun</span>, <span style="background-color:blueviolet;">blueviolet/bleu&nbsp;violet</span>, <span style="background-color:chocolate;">chocolate/brun&nbsp;clair</span>, <span style="background-color:cornsilk;">cornsilk/rose&nbsp;clair</span>, <span style="background-color:darkgreen;">darkgreen/vert&nbsp;fonce</span>, <span style="background-color:darkorange;">darkorange/orange&nbsp;fonce</span>, <span style="background-color:darkorchid;">darkorchid/mauve&nbsp;fonce</span>, <span style="background-color:deepskyblue;">deepskyblue/bleu&nbsp;ciel</span>, <span style="background-color:gold;">gold/or</span>, <span style="background-color:ivory;">ivory/ivoire</span>, <span style="background-color:orange;">orange/orange</span>, <span style="background-color:lavender;">lavender/lavande</span>, <span style="background-color:pink;">pink/rose</span>, <span style="background-color:plum;">plum/prune</span>, <span style="background-color:salmon;">salmon/saumon</span>, <span style="background-color:snow;">snow/neige</span>, <span style="background-color:turquoise;">turquoise/turquoise</span>, <span style="background-color:wheat;">wheat/jaune&nbsp;paille</span>, <span style="background-color:yellow;">yellow/jaune</span></span><span style="font-size:50%;"><br />&nbsp;</span>',
		"\n-* <code>Lorem ipsum [rouge]dolor[/rouge] sit amet</code>\n-* <code>Lorem ipsum [red]dolor[/red] sit amet</code>.",
		"\n-* <code>Lorem ipsum [fond rouge]dolor[/fond rouge] sit amet</code>\n-* <code>Lorem ipsum [bg red]dolor[/bg red] sit amet</code>.",
	), $flux['texte']);
	return $flux;
}

?>