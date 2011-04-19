<?php

/*
	Cet outil 'decoration' permet aux redacteurs d'un site spip de d'appliquer des styles aux textes SPIP
	Attention : seules les balises en minuscules sont reconnues.
	Doc : http://www.spip-contrib.net/?article2427
*/

// cette fonction est appelee automatiquement a chaque affichage de la page privee du Couteau Suisse
function decoration_installe() {
	if(!defined('_decoration_BALISES')) return NULL;
cs_log("decoration_installe()");
	// on decode les balises entrees dans la config
	$deco_balises = preg_split("/[\r\n]+/", trim(_decoration_BALISES));
	$aide = $trouve = $remplace = $alias = $auto_balises = $auto_remplace = $BT = array();
	foreach ($deco_balises as $balise) {
		if (preg_match('/(span|div|auto)\.([^.]+)\.(class|lang)\s*=(.+)$/', $balise, $regs)) {
			// les class/lang
			list($auto, $div, $racc, $attr, $valeur) = array($regs[1]=='auto', $regs[1], trim($regs[2]), trim($regs[3]), trim($regs[4]));
			if (defined('_SPIP20100') && $attr=='lang') {
				// Pour SPIP>=2.1 on utilise l'astuce <multi>[XX]...</multi> pour beneficier ensuite de la typo appropriee
				$BT[] = array($racc, true, $div);
				$aide[] = $racc; 
				$trouve[] = "<$racc>"; $trouve[] = "</$racc>";
				$remplace[] = $a = "<multi>[$valeur]"; 
				$remplace[] = $b = "</multi>";
			} else {
				$attr="$attr=\"$valeur\"";
				$BT[] = array($racc, $auto, $div);
				if ($auto) {
					$auto_balises[] = $racc; 
					$auto_remplace[$racc] = "$attr>";
				} else {
					$aide[] = $racc; 
					$trouve[] = "<$racc>"; $trouve[] = "</$racc>"; $trouve[] = "<$racc/>";
					$remplace[] = $a = "<$div $attr>"; 
					$remplace[] = $b = "</$div>"; $remplace[] = $a.$b;
				}
			}
		} elseif (preg_match('/(span|div|auto)\.([^=]+)=(.+)$/', $balise, $regs)) {
			// les styles inline
			list($auto, $div, $racc, $style) = array($regs[1]=='auto', $regs[1], trim($regs[2]), trim($regs[3]));
			$BT[] = array($racc, $auto, $div);
			$attr="style=\"$style\"";
			if ($auto) {
				$auto_balises[] = $racc; 
				$auto_remplace[$racc] = "$attr>";
			} else {
				$aide[] = $racc; 
				$trouve[] = "<$racc>"; $trouve[] = "</$racc>"; $trouve[] = "<$racc/>";
				$remplace[] = $a = "<$div $attr>";
				$remplace[] = $b = "</$div>"; $remplace[] = $a.$b;
			}
		} elseif (preg_match('/([^=]+)=(.+)$/', $balise, $regs)) {
			// les alias
			$alias[trim($regs[1])] = trim($regs[2]);
		}
	}
	// ajout des alias qu'on a trouves
	foreach ($alias as $a=>$v) 
		if(($i=array_search("<$v>", $trouve, true))!==false) {
			$aide[] = $a; $trouve[] = "<$a>"; $trouve[] = "</$a>"; $trouve[] = "<$a/>";
			$remplace[] = $remplace[$i]; $remplace[] = $remplace[$i+1]; $remplace[] = $remplace[$i+2];
		} elseif(array_search($v, $auto_balises, true)!==false) {
			$auto_balises[] = $a;
			$auto_remplace[$a] = $auto_remplace[$v];
		}
	// liste des balises disponibles
	$aide = array_merge($aide, $auto_balises);
	$n = count($auto_balises);
	// protection $auto_balises pour la future regExpr
	array_walk($auto_balises, 'cs_preg_quote');
	// renvoi des donnees compilees
	return array( 'decoration'=> array(
		// balises fixes a trouver
		$trouve, 
		// remplacement des balises fixes
		$remplace,
		// RegExpr pour les balises automatiques
		$n?($n==1?",<($auto_balises[0])>(.*?)</$auto_balises[0]>,ms":',<('.join('|', $auto_balises).')>(.*?)</\\1>,ms'):'',
		// association pour les balises automatiques
		$auto_remplace,
		// balises disponibles
		$BT),
		// aide
		'decoration_racc' => $aide,
	);
}

// liste des nouveaux raccourcis ajoutes par l'outil
// si cette fonction n'existe pas, le plugin cherche alors  _T('couteauprive:un_outil:aide');
function decoration_raccourcis() {
	$racc = cs_lire_data_outil('decoration', 'decoration_racc');
	return _T('couteauprive:decoration:aide', array('liste' => '<b>'.join('</b>, <b>', $racc).'</b>'));
}

function decoration_callback($matches) {
	global $deco_balises;
	return cs_block($matches[2])
			?'<div ' . $deco_balises[3][$matches[1]] . $matches[2] . '</div>'
			:'<span ' . $deco_balises[3][$matches[1]] . $matches[2] . '</span>';
}

// cette fonction n'est pas appelee dans les balises html : html|code|cadre|frame|script
function decoration_rempl($texte) {
	if (strpos($texte, '<')===false) return $texte;
	// reecrire les raccourcis du type <balise   />
	$texte = preg_replace(', +/>,', '/>', $texte);
	global $deco_balises;
	// balises fixes, facile : on remplace tout d'un coup !
	$texte = str_replace($deco_balises[0], $deco_balises[1], $texte);
	// balises automatiques, plus long : il faut un callback pour analyser l'interieur du texte
	return strlen($deco_balises[2])
		?preg_replace_callback($deco_balises[2], 'decoration_callback', $texte)
		:$texte;
}

// fonction pipeline
function decoration_pre_typo($texte) {
	if (strpos($texte, '<')===false || !defined('_decoration_BALISES')) return $texte;
	// pour les callbacks
	global $deco_balises;
	// lecture des balises et des remplacements
	$deco_balises = cs_lire_data_outil('decoration');
	// on remplace apres echappement
	$texte = cs_echappe_balises('', 'decoration_rempl', $texte);
	// menage
	unset($deco_balises);
	return $texte;
}

// cette fonction renvoie une ligne de tableau entre <tr></tr> afin de l'inserer dans la Barre Typo V2, si elle est presente
function decoration_BarreTypo($tr) {
	$balises = cs_lire_data_outil('decoration');
	$res = array(); 
	foreach($balises[4] as $v) {
		$tmp = $v[1]?"('<$v[0]>','</$v[0]>'":"_etendu('<$v[0]>','</$v[0]>','<$v[0]/>'";
		$res[] = "<a href=\"javascript:barre_raccourci$tmp,@@champ@@)\"><span class=\"cs_BT\">$v[0]</span></a>";
	}
	$res = join(' ', $res); 
	return $tr.'<tr><td><p style="margin:0; line-height:1.8em;">'._T('couteauprive:decoration:nom')."&nbsp;$res</p></td></tr>";
}

// les 2 fonctions suivantes inserent les boutons pour le plugin Porte Plume, s'il est present (SPIP>=2.0)
function decoration_PP_pre_charger($flux) {
	$balises = cs_lire_data_outil('decoration');
	$max = count($balises[4]);
	$r = array();
	foreach($balises[4] as $b) {
		$id = 'decoration_'.$b[0];
		$r[] = array(
				"id" => $id,
				"name" => _T('couteau:pp_decoration_inserer', array('racc'=>$b[0], 'balise'=>$b[2])),
				"className" => $id,
				"selectionType" => $b[2]=='div'?"line":"word",
				// $b[1] est vrai si la balise <racc/> est interdite
				"replaceWith" => "function(h){ return outil_decoration(h.selection, '$b[0]', '$b[2]', '".($b[1]?'':"<$b[0]/>")."'); }",
				"display" => true);
	}
	$r = array(
		"id"	=> 'cs_decoration_drop',
		"name"	=> _T('couteau:pp_decoration_inserer_drop'),
		"className"	=> 'cs_decoration_drop',
		"replaceWith"	=> '',
		"display"	=> true,
		"dropMenu"	=> $r,

	);
	foreach(cs_pp_liste_barres('decoration') as $b) {
		$flux[$b]->ajouterApres('stroke_through', $r);
		$flux[$b]->ajouterFonction("function outil_decoration(sel, racc, balise, defaut) {
			if(sel) {
				r='<'+racc+'>'+sel+'</'+racc+'>';
				return balise=='span'?r.replace(/(\\n\\n|\\r\\n\\r\\n|\\r\\r)/g,'</'+racc+'>\$1<'+racc+'>'):r;
			}
			return defaut;
		}");
	}
	return $flux;
}
function decoration_PP_icones($flux){
	$balises = cs_lire_data_outil('decoration');
	// icones utilisees. Attention : mettre les drop-boutons en premier !!
	$flux['cs_decoration_drop'] = 'decoration_div.png';
	foreach($balises[4] as $b) {
		$id = 'decoration_'.$b[0];
		$flux[$id] = find_in_path("icones_barre/{$id}.png")?$id.'.png'
			:"decoration_{$b[2]}.png";
	}
	return $flux;
}

?>