<?php
/*
*	+----------------------------------+
*	Nom de l'outil : Filets de Separation
*	Idee originale : FredoMkb
*	Serieuse refonte et integration au Couteau Suisse : Patrice Vanneufville
*	+-------------------------------------+
*	Toutes les infos sur : http://contrib.spip.net/?article1564
*/

// Constantes surchargeables
//@define('_FILETS_SEP_BALISE_DEBUT', '<hr');
//@define('_FILETS_SEP_BALISE_FIN', '/>');
@define('_FILETS_SEP_BALISE_DEBUT', '<p');
@define('_FILETS_SEP_BALISE_FIN', '></p>');
@define('_FILETS_SEP_MAX_CSS', 7);
@define('_FILETS_REG_DEBUT', '#(?:\s*[\n\r]\s*)__(');
@define('_FILETS_REG_FIN', ')__(?=\s*[\n\r]\s*)#iU');
@define('_FILETS_REG_EXT', '\.(?:png|gif|jpg)');

// cette fonction appelee automatiquement a chaque affichage de la page privee du Couteau Suisse renvoie un tableau
function filets_sep_installe_dist() {
//cs_log('filets_sep_installe_dist()');
	include_spip('inc/texte');
	// Tester si on echappe en span ou en div
	$mode = ($bmode=preg_match(',<('._BALISES_BLOCS.'|p)(\W|$),iS', _FILETS_SEP_BALISE_DEBUT))?'div':'span';
	$bt = defined('_DIR_PLUGIN_PORTE_PLUME');
	$filets = array();
	// filets numeriques
	for($i=0; $i<=_FILETS_SEP_MAX_CSS; $i++) {
		$filets[6][] = $i;
		$f = cs_code_echappement(_FILETS_SEP_BALISE_DEBUT." class='filet_sep filet_sep_$i'"._FILETS_SEP_BALISE_FIN, '', $mode);
		$filets[1]["$i"] = $bmode?"\n\n".$f."\n\n":$f;
	}
	// filets image	
	$path = find_in_path('img/filets');
	$dossier = opendir($path);
	if($path) while ($image = readdir($dossier)) {
		if (preg_match(',^(([a-z0-9_-]+)'._FILETS_REG_EXT.'),', $image, $reg)) {
			$filets[0][] = '__'.$reg[1].'__';
			$filets[6][] = preg_quote($reg[1]);
			$filets[2][] = $reg[2];
			list(,$haut) = @getimagesize($path.'/'.$reg[1]);
			if ($haut) $haut="height:{$haut}px;";
			$f = url_absolue($path).'/'.$reg[1];
			$f = cs_code_echappement(_FILETS_SEP_BALISE_DEBUT." class=\"filet_sep filet_sep_image\" style=\"$haut background-image: url($f);\""._FILETS_SEP_BALISE_FIN, '', $mode);
			$filets[1][$reg[1]] = $bmode?"\n\n".$f."\n\n":$f;
			if($bt)
				$filets[4]['filet_'.str_replace('.','_',$reg[1])] = $reg[1];
		}
	}
	// RegExpr finale
	$filets[6] = _FILETS_REG_DEBUT . join('|', $filets[6]) . _FILETS_REG_FIN;
	if($bt) for($i=0; $i<=_FILETS_SEP_MAX_CSS; $i++)
		$filets[5]['filet_'.$i] = $i;
	return array($filets);
}

// liste des nouveaux raccourcis ajoutes par l'outil
// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
function filets_sep_raccourcis() {
	$filets = cs_lire_data_outil('filets_sep');
	return _T('couteauprive:filets_sep:aide', 
		array('liste' => '<b>'.join('</b>, <b>', $filets[0]).'</b>', 'max'=>_FILETS_SEP_MAX_CSS));
}

function filets_sep_callback($matches) {
	global $filets_tmp;
	return $filets_tmp[1][$matches[1]];
}

// Fonction pour generer des filets de separation selon les balises presentes dans le texte fourni.
// Cette fonction n'est pas appelee dans les balises html : html|code|cadre|frame|script
function filets_sep_rempl($texte) {
	if (strpos($texte, '__')===false) return $texte;

	global $filets_tmp;
	$filets_tmp = cs_lire_data_outil('filets_sep');

	// On remplace les balises filets dans le texte par le code HTML correspondant
	// le resultat a ete protege pour eviter que la typo de SPIP y touche
	$texte = preg_replace_callback($filets_tmp[6], 'filets_sep_callback', $texte); 
	
	// Nettoyage et retour
	unset($filets_tmp);	
	return $texte;
}

// fonction pipeline pre_typo
function filets_sep($texte) {
	if (strpos($texte, '__')===false) return $texte;
	return cs_echappe_balises('', 'filets_sep_rempl', $texte);
}

// cette fonction renvoie une ligne de tableau entre <tr></tr> afin de l'inserer dans la Barre Typo V2, si elle est presente
function filets_sep_BarreTypo($tr) {
	$filets = cs_lire_data_outil('filets_sep');
	$res = array();
	for($i=0; $i<=_FILETS_SEP_MAX_CSS; $i++)
		$res[] = "<a title=\"__{$i}__\" href=\"javascript:barre_inserer('\\n\\n__{$i}__\\n\\n',@@champ@@)\"><span class=\"cs_BT\">CSS {$i}</span></a>";
	$max = count($filets[0]);
	for($i=0; $i<$max; $i++)
		$res[] = "<a title=\"{$filets[0][$i]}\" href=\"javascript:barre_inserer('\\n\\n{$filets[0][$i]}\\n\\n',@@champ@@)\"><span class=\"cs_BT\">{$filets[0][$i]}</span></a>";
	$res = join(' ', $res);
	return $tr.'<tr><td><p style="margin:0; line-height:1.8em;">'._T('couteauprive:filets_sep:nom')."&nbsp;$res</p></td></tr>";
}

// les 2 fonctions suivantes inserent les boutons pour le plugin Porte Plume, s'il est present (SPIP>=2.0)
function filets_PP_pre_charger($flux) {
	$filets = cs_lire_data_outil('filets_sep');
	$max = count($filets[0]);
	$r = array();
	for ($i=0; $i<=_FILETS_SEP_MAX_CSS; $i++) {
		$r[] = array(
			"id" => 'filet_'.$i,
			"name" => _T('couteau:pp_filets_inserer', array('filet'=>$i)),
			"className" => 'filet_'.$i,
			"replaceWith" => "\n__{$i}__\n",
			"display" => true);
	}
	for ($i=0; $i<$max; $i++) {
		$c = &$filets[0][$i];
		$id = 'filet_'.str_replace('.', '_', trim($c, '_'));
		$r[] = array(
			"id" => $id,
			"name" => _T('couteau:pp_filets_inserer', array('filet'=>$filets[2][$i])),
			"className" => $id,
			"replaceWith" => "\n$c\n",
			"display" => true);
	}
	$r = array(
		"id" => 'cs_filets_drop',
		"name" => _T('couteau:pp_filets_inserer_drop'),
		"className" => 'cs_filets_drop',
		"replaceWith" => '',
		"display" => true,
		"dropMenu" => $r,
	);
	foreach(cs_pp_liste_barres('filets_sep') as $b)
		$flux[$b]->ajouterApres('grpCaracteres', $r);
	return $flux;
}
function filets_PP_icones($flux) {
	$filets = cs_lire_data_outil('filets_sep');
	// icones utilisees. Attention : mettre les drop-boutons en premier !!
	$flux['cs_filets_drop'] = filets_creer_icone_barre(find_in_path('img/filets/ornement.png'));
	$path = find_in_path('img/filets').'/';
	foreach($filets[4] as $i=>$v) $flux[$i] = filets_creer_icone_barre($path.$v);
	foreach($filets[5] as $i=>$v) $flux[$i] = filets_creer_icone_barre('', $v);
	return $flux;
}
// creation d'icone pour le plugin porte-plume
function filets_creer_icone_barre($file, $num=-1) {
	static $icones_barre;
	rep_icones_barre($icones_barre);
	define_IMG_GD_MAX_PIXELS();
	// la config "Methode de fabrication des vignettes" doit etre renseignee pour 'image_reduire'
	if($num<0) {
		list($w) = @getimagesize($file);
		$file = filtrer('image_recadre', $file, floor($w/4), 40, '');
		$file = filtrer('image_reduire', $file, 19, 19);
		$file = filtrer('image_recadre', $file, 16, 16, 'left');
	} else {
		$file = image_typo("_{$num}_", 'couleur=00BFFF', 'taille=9', 'police=dustismo.ttf');
		$file = filtrer('image_recadre', $file, 16, 10, 'bottom');
	}
	$nom = basename($src = extraire_attribut($file, 'src'));
	@copy($src, $icones_barre.$nom);
	return $nom;
}
?>