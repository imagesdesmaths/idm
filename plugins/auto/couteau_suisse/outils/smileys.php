<?php

// Outil SMILEYS - 25 decembre 2006
// serieuse refonte et integration au Couteau Suisse : Patrice Vanneufville, 2006
// Toutes les infos sur : http://www.spip-contrib.net/?article1561
// dessin des frimousses : Sylvain Michel [http://www.guaph.net/]

// cette fonction est appelee automatiquement a chaque affichage de la page privee du Couteau Suisse
function smileys_installe() {
	$path = find_in_path('img/smileys');
cs_log("smileys_installe() : $path");
	$path2 = url_absolue($path);

	// l'ordre des smileys ici est important :
	//  - les doubles, puis les simples, puis les courts
	//  - le raccourci insere par la balise #SMILEYS est la premiere occurence de chaque fichier
	$smileys = array(
	// attention ' est different de ’ (&#8217;) (SPIP utilise/ecrit ce dernier)
	 ":&#8217;-))"=> 'pleure_de_rire.png',
	 ":&#8217;-)"=> 'pleure_de_rire.png',
	 ":&#8217;-D"	=> 'pleure_de_rire.png',
	 ":&#8217;-("	=> 'triste.png',
	
	// les doubles :
	 ':-))'	=> 'mort_de_rire.png',
	 ':))'	=> 'mort_de_rire.png',
	 ":'-))"=> 'pleure_de_rire.png',
	 ':-(('	=> 'en_colere.png',

	// les simples :
	 ';-)'	=> 'clin_d-oeil.png',
	 ':-)'	=> 'sourire.png',
	 ':-D'	=> 'mort_de_rire.png',
	 ":'-)"=> 'pleure_de_rire.png',
	 ":'-D"	=> 'pleure_de_rire.png',
	 ':-('	=> 'pas_content.png',
	 ":'-("	=> 'triste.png',
	 ':-&gt;' => 'diable.png',
	 '|-)'	=> 'rouge.png',
	 ':o)'	=> 'rigolo.png',
	 'B-)'	=> 'lunettes.png',
	 ':-P'	=> 'tire_la_langue.png',
	 ':-p'	=> 'tire_la_langue.png',
	 ':-|'	=> 'bof.png',
	 ':-/'	=> 'mouais.png',
	 ':-O'	=> 'surpris.png',
	 ':-o'	=> 'surpris.png',

	// les courts : tester a l'usage...
	// attention : ils ne sont reconnus que s'il y a un espace avant !
	 ':)'	=> 'sourire.png',
	 ':('	=> 'pas_content.png',
	 ';)'	=> 'clin_d-oeil.png',
	 ':|'	=> 'bof.png',
	 '|)'	=> 'rouge.png',
	 ':/'	=> 'mouais.png',
	);
	
	$aide = array();
	foreach ($smileys as $smy=>$val) {
		$espace = strlen($smy)==2?' ':'';
		$smileys2[0][] = $espace.$smy;
		list(,,,$size) = @getimagesize("$path/$val");
		// cs_code_echappement evite que le remplacement se fasse a l'interieur des attributs de la balise <img>
		$smileys2[1][] = cs_code_echappement($espace."<img alt=\"$smy\" title=\"$smy\" class=\"no_image_filtrer format_png\" src=\"$path2/$val\" $size/>", 'SMILE');
		$smileys2[2][] = $val;
		// aide : liste des smileys disponibles
		$aide[] = $smy;
	}

	if(defined('_DIR_PLUGIN_PORTE_PLUME')) {
		$sm = smileys_uniques($smileys2);
 		$max = count($sm[2]);
		for ($i=0; $i<$max; $i++)
			$smileys2[4]['smiley_'.str_replace('.png','',$sm[2][$i])] = $sm[2][$i];
	}
	return array('smileys'=>$smileys2, 'smileys_racc'=>$aide);
}

// liste des nouveaux raccourcis ajoutes par l'outil
// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
function smileys_raccourcis() {
	$racc = cs_lire_data_outil('smileys', 'smileys_racc');
	return _T('couteauprive:smileys:aide', array('liste' => '<b>'.join('</b>, <b>', $racc).'</b>'));
}

function smileys_echappe_balises_callback($matches) {
 return cs_code_echappement($matches[1], 'SMILE');
}

// fonction de remplacement
// les balises suivantes sont protegees : html|code|cadre|frame|script|acronym|cite
function cs_rempl_smileys($texte) {
	if (strpos($texte, ':')===false && strpos($texte, ')')===false) return $texte;
	$smileys_rempl = cs_lire_data_outil('smileys');
	// protection des images, on ne sait jamais...
	$texte = preg_replace_callback(',(<img .*?/>),ms', 'smileys_echappe_balises_callback', $texte);
	// smileys a probleme :
	$texte = str_replace(':->', ':-&gt;', $texte); // remplacer > par &gt;
	// remplacer ’ (apostrophe curly) par &#8217;
	$texte = str_replace(':’-', ':&#8217;-', $texte);
	$texte = str_replace(':'.chr(146).'-', ':&#8217;-', $texte);
	// voila, on remplace tous les smileys d'un coup...
	$texte = str_replace($smileys_rempl[0], $smileys_rempl[1], $texte);
	return echappe_retour($texte, 'SMILE');
}

// fonction principale (pipeline pre_typo)
function cs_smileys_pre_typo($texte) {
	if (strpos($texte, ':')===false && strpos($texte, ')')===false) return $texte;
	// appeler cs_rempl_smileys() une fois que certaines balises ont ete protegees
	return cs_echappe_balises('html|code|cadre|frame|script|acronym|cite', 'cs_rempl_smileys', $texte);
}

// fonction qui renvoie un tableau de smileys uniques
function smileys_uniques($smileys) {
	$max = count($smileys[1]);
	$new = array(array(), array(), array());
	for ($i=0; $i<$max; $i++) {
		if(!in_array($smileys[2][$i], $new[2])) {
			$new[0][] = $smileys[0][$i]; // texte
			$new[1][] = $smileys[1][$i]; // image
			$new[2][] = $smileys[2][$i]; // nom de fichier
		}
	}
	return $new;
}

// cette fonction renvoie une ligne de tableau entre <tr></tr> afin de l'inserer dans la Barre Typo V2, si elle est presente
function cs_smileys_BarreTypo($tr) {
	$smileys = smileys_uniques(cs_lire_data_outil('smileys'));
	$max = count($smileys[0]);
	$res = '';
	for ($i=0; $i<$max; $i++)
		$res .= "<a href=\"javascript:barre_inserer('{$smileys[0][$i]}',@@champ@@)\">{$smileys[1][$i]}</a>";
	return $tr.'<tr><td><@@span@@>'._T('couteauprive:smileys:nom').'</span>&nbsp;'.echappe_retour($res, 'SMILE').'</td></tr>';
}

// les 2 fonctions suivantes inserent les boutons pour le plugin Porte Plume, s'il est present (SPIP>=2.0)
function cs_smileys_PP_pre_charger($flux) {
	$smileys = smileys_uniques(cs_lire_data_outil('smileys'));
	$max = count($smileys[0]);
	$r = array();
	for ($i=0; $i<$max; $i++) {
		$id = 'smiley_'.str_replace('.png','',$smileys[2][$i]);
		$r[] = array(
				"id" => $id,
				"name" => _T('couteau:pp_smileys_inserer', array('smiley'=>$smileys[0][$i])),
				"className" => $id,
				"replaceWith" => $smileys[0][$i],
				"display" => true);
	}
	$r = array(
		"id" => 'cs_smileys_drop',
		"name" => _T('couteau:pp_smileys_inserer', array('smiley'=>'')),
		"className" => 'cs_smileys_drop',
		"replaceWith" => '',
		"display" => true,
		"dropMenu"	=> $r,
	);
	foreach(cs_pp_liste_barres('smileys') as $b)
		$flux[$b]->ajouterApres('grpCaracteres', $r);
	return $flux;
}
function cs_smileys_PP_icones($flux) {
	$smileys = cs_lire_data_outil('smileys');
	$path = find_in_path('img/smileys').'/';
	// icones utilisees. Attention : mettre les drop-boutons en premier !!
	$flux['cs_smileys_drop'] = smileys_creer_icone_barre(find_in_path('img/smileys/mort_de_rire.png'));
	foreach($smileys[4] as $i=>$v) $flux[$i] = smileys_creer_icone_barre($path.$v);
	return $flux;
}
// creation d'icone pour le plugin porte-plume
function smileys_creer_icone_barre($file) {
	static $icones_barre;
	rep_icones_barre($icones_barre);
	$file = filtrer('image_recadre', $file, 16, 16, 'topleft');
	$nom = basename($src = extraire_attribut($file, 'src'));
	@copy($src, $icones_barre.$nom);
	return $nom;
}

?>