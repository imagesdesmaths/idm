<?php
/*
*	+----------------------------------+
*	Nom de l'outil : Filets de Separation
*	Idee originale : FredoMkb
*	Serieuse refonte et integration au Couteau Suisse : Patrice Vanneufville
*	+-------------------------------------+
*	Toutes les infos sur : http://www.spip-contrib.net/?article1564
*/

// Constantes surchargeables
//@define('_FILETS_SEP_BALISE_DEBUT', '<hr');
//@define('_FILETS_SEP_BALISE_FIN', '/>');
@define('_FILETS_SEP_BALISE_DEBUT', '<p');
@define('_FILETS_SEP_BALISE_FIN', '></p>');
@define('_FILETS_SEP_MAX_CSS', 7);
@define('_FILETS_REG_EXT', '\.(?:png|gif|jpg)');

// cette fonction est appelee automatiquement a chaque affichage de la page privee du Couteau Suisse
function filets_sep_installe() {
//cs_log('filets_sep_installe()');
	include_spip('inc/texte');
	$filets = array();
	$bt = defined('_DIR_PLUGIN_PORTE_PLUME');
	$path = find_in_path('img/filets');
	$dossier = opendir($path);
	if($path) while ($image = readdir($dossier)) {
		if (preg_match(',^(([a-z0-9_-]+)'._FILETS_REG_EXT.'),', $image, $reg)) {
			$filets[0][] = '__'.$reg[1].'__';
			$filets[2][] = $reg[2];
			list(,$haut) = @getimagesize($path.'/'.$reg[1]);
			if ($haut) $haut="height:{$haut}px;";
			$f = url_absolue($path).'/'.$reg[1];
			$filets[1][] = code_echappement(_FILETS_SEP_BALISE_DEBUT." class=\"filet_sep filet_sep_image\" style=\"$haut background-image: url($f);\""._FILETS_SEP_BALISE_FIN);
			if($bt)
				$filets[4]['filet_'.str_replace('.','_',$reg[1])] = $reg[1];
		}
	}
	if($bt) for($i=0; $i<=_FILETS_SEP_MAX_CSS; $i++)
		$filets[5]['filet_'.$i] = $i;
	return array('filets_sep' => $filets);
}

// liste des nouveaux raccourcis ajoutes par l'outil
// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
function filets_sep_raccourcis() {
	$filets = cs_lire_data_outil('filets_sep');
	return _T('couteauprive:filets_sep:aide', 
		array('liste' => '<b>'.join('</b>, <b>', $filets[0]).'</b>', 'max'=>_FILETS_SEP_MAX_CSS));
}

// Fonction pour generer des filets de separation selon les balises presentes dans le texte fourni.
// Cette fonction n'est pas appelee dans les balises html : html|code|cadre|frame|script
function filets_sep_rempl($texte) {
	if (strpos($texte, '__')===false) return $texte;

	// On memorise les modeles d'expression rationnelle a utiliser pour chercher les balises numeriques.
	$modele_nombre = "#(?:\s*[\n\r]\s*)__(\d+)__(?=\s*[\n\r]\s*)#iU";

	// On remplace les balises filets numeriques dans le texte par le code HTML correspondant
	// le resultat est protege pour eviter que la typo de SPIP y touche
	while (preg_match($modele_nombre, $texte))
		$texte = preg_replace_callback($modele_nombre, 
			create_function('$matches', 'return code_echappement("'._FILETS_SEP_BALISE_DEBUT.' class=\'filet_sep filet_sep_$matches[1]\''._FILETS_SEP_BALISE_FIN.'");'), $texte); 
	if (strpos($texte, '__')===false) return $texte;

	// On remplace les balises filets images dans le texte par le code HTML correspondant.
	// le resultat est protege pour eviter que la typo de SPIP y touche
	$filets = cs_lire_data_outil('filets_sep');
	return str_replace($filets[0], $filets[1], $texte);
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