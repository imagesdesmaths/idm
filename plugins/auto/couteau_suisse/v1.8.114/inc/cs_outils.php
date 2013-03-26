<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2007               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://www.spip-contrib.net/?article2166   #
#-----------------------------------------------------#
#  Fichier contenant les fonctions concernant la      #
#  description des outils.                            #
#-----------------------------------------------------#

if(!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/autoriser');
// Constantes distantes
include_spip('cout_define');

// initialiser les plugins, les pipelines, etc.
function cs_init_plugins() {
	@unlink(_DIR_TMP."couteau-suisse.plat");
	include_spip('inc/plugin'); 
	defined('_SPIP20100')?actualise_plugins_actifs():verif_plugin();
	if(defined('_LOG_CS')) cs_log(" -- actualise_plugins_actifs() effectue");
}

// initialise un outil, ses variables, et en renvoie la description compilee
function cs_initialisation_d_un_outil($outil_, $description_outil, $modif) {
	global $outils, $metas_outils;
	$outil = &$outils[$outil_];
	if(!isset($outil['init_ok'])) {
		$outil['init_ok'] = 1;
		if(!isset($outil['categorie'])) $outil['categorie'] = 'divers';
		if(!isset($outil['nom'])) $outil['nom'] = couteauprive_T($outil['id'].':nom');
		if(strpos($outil['nom'], '<:')!==false)
			$outil['nom'] = preg_replace(',<:([:a-z0-9_-]+):>,ie', '_T("$1")', $outil['nom']);
		// $outil['surcharge'] n'est pas encore renseigne si la fonction d'installation est surchargee
		if(isset($outil['surcharge']) || (function_exists($outil_.'_installe') && $outil['surcharge']=1))
			$outil['nom'] = $outil['nom'].' *';
		if(isset($outil['perso'])) $outil['nom'] = '<i>'.$outil['nom'].'</i>';
		$outil['actif'] = isset($metas_outils[$outil['id']])?@$metas_outils[$outil['id']]['actif']:0;
		if(isset($outil['contrib']) && $outil['contrib'])
			$metas_outils[$outil['id']]['contrib'] = $outil['contrib'];
		// si SPIP est trop ancien ou trop recent...
		if(cs_version_erreur($outil)) { $metas_outils[$outil['id']]['actif'] = $outil['actif'] = 0; }
		// au cas ou des variables sont presentes dans le code
		$outil['variables'] = array(); $outil['nb_variables'] = 0;
		// ces 2 lignes peuvent initialiser des variables dans $metas_vars ou $metas_vars_code
		if(isset($outil['code:spip_options'])) $outil['code:spip_options'] = cs_parse_code_php($outil['code:spip_options']);
		if(isset($outil['code:options'])) $outil['code:options'] = cs_parse_code_php($outil['code:options']);
		if(isset($outil['code:fonctions'])) $outil['code:fonctions'] = cs_parse_code_php($outil['code:fonctions']);
	}
	// cette ligne peut utiliser des variables dans $metas_vars ou $metas_vars_code
	return $description_outil($outil_, 'admin_couteau_suisse', $modif);
}

// renvoie la configuration du pack actuel
function cs_description_pack() {
	if(!isset($GLOBALS['cs_pack_actuel'])) return '';
	return debut_cadre_relief('', true)
		. "<h3 class='titrem'><img src='"._DIR_IMG_PACK."puce-verte.gif' width='9' height='9' alt='-' />&nbsp;" . couteauprive_T('pack_titre') . '</h3>'
		. ((strlen($temp = cs_action_rapide('pack')))?"<div class='cs_action_rapide' id='cs_action_rapide'>$temp</div>":'')
		. propre(couteauprive_T('pack_descrip', array('pack'=> couteauprive_T('pack_actuel', array('date'=>cs_date()))))
		. "\n\n" . couteauprive_T('contrib', array('url'=>'[->'._URL_CONTRIB.'2552]')))
		. '<br/><textarea rows=40 cols=500 style="width:100%; font-size:90%;">'
		. htmlentities($GLOBALS[cs_pack_actuel], ENT_QUOTES, $GLOBALS['meta']['charset']) . '</textarea>'
		. fin_cadre_relief(true);
}

// renvoie la liste des langues dispos sur un module

function cs_liste_langues($module) {
	$reg = '/' . preg_quote($module) . '_([^./]+)\.php$';
	$files = preg_files(_DIR_PLUGIN_COUTEAU_SUISSE.'lang/', $reg);
	$f = create_function('$a', 'return preg_match(",'.$reg.',",$a,$r)?($r[1]=="fr"?"[fr]":"[[$r[1]->'._CS_TRAD_MODULE.$module.'?lang_orig=fr&lang_cible=$r[1]]]"):"";');
	$files = array_map($f, $files);
	return join(" ", $files);
}

function cs_liste_traducteurs($modules) {
	$modules = array_map('preg_quote', $modules);
	$reg = '/('.join('|',$modules).')\.xml$';
	$files = preg_files(_DIR_PLUGIN_COUTEAU_SUISSE.'lang/', $reg);
	$res = array();
	foreach($files as $f) {
		lire_fichier($f, $desc);
		if(preg_match_all(',<traducteur .*? />,', $desc, $reg)) 
			foreach($reg[0] as $r) $res[] = '['.extraire_attribut($r, 'nom').'->'.extraire_attribut($r, 'lien').']';
	}
	sort($res);
	return join(", ", array_unique($res));
}

// renvoie qq infos pour la traduction
function cs_description_trad() {
	$modules = array('couteau', 'couteauprive', 'paquet-couteau_suisse');
	$res = array();
	foreach($modules as $m) $res[] = "\n-* " . couteauprive_T('trad_mod', array('mod'=>$m)) . cs_liste_langues($m);
	return debut_cadre_relief('', true)
		. "<h3 class='titrem'><img src='"._DIR_IMG_PACK."puce-verte.gif' width='9' height='9' alt='-' />&nbsp;"
		. (defined('_SPIP30000')?_T('info_traductions'):ucfirst(_T('afficher_trad'))) . '</h3>'
		. propre(couteauprive_T('trad_help', array('url'=>_CS_TRAD_ACCUEIL, 'trad'=>join('', $res), 'contrib'=>cs_liste_traducteurs($modules)))
		) . fin_cadre_relief(true);
}

// renvoie (pour la nouvelle interface) la description d'un outil
function description_outil2($outil_id) {
	if(!strlen($outil_id)) return couteauprive_T('outils_cliquez');
	global $outils, $metas_vars, $metas_outils;
	include_spip('cout_utils');
	// remplir $outils (et aussi $cs_variables qu'on n'utilise pas ici);
	include_spip('config_outils');
cs_log(" -- description_outil2($outil_id) - Appel de config_outils.php : nb_outils = ".count($outils));

cs_log(" -- appel de charger_fonction('description_outil', 'inc') et de description_outil($outil_id) :");
	$description_outil = charger_fonction('description_outil', 'inc');
	$descrip = cs_initialisation_d_un_outil($outil_id, $description_outil, true);

	include_spip('inc/presentation');
	include_spip('inc/texte');
	include_spip('public/parametrer'); // fonctions pour les pipelines

	$s = '<div class="cs-cadre">';

	$outil = $outils[$outil_id]; unset($outils);
	$actif = $outil['actif'];
	$puce = $actif?'puce-verte.gif':'puce-rouge.gif';
	$titre_etat = couteauprive_T('outil_'.($actif?'actif':'inactif'));
	$nb_var = intval($outil['nb_variables']);

	// cette valeur par defaut n'est pas definie sous SPIP 1.92
	// constante abandonnee sous SPIP 3.0
	if(!defined('_SPIP30000')) @define('_ID_WEBMESTRES', 1);
	if(!strlen($outil['id']) || !autoriser('configurer', 'outil', 0, NULL, $outil))
		return $s . _T('info_acces_interdit') . '</div>';

	$s .= "<h3 class='titrem'><img src='" . _DIR_IMG_PACK."$puce' width='9' height='9' alt=\"$titre_etat\" title=\"$titre_etat\" />&nbsp;" 
		. $outil['nom'] . '</h3>';
	$s .= '<div class="cs_menu_outil">';
	if($nb_var)
		$s .= '<a href="'.generer_url_ecrire(_request('source'),'cmd=reset&outil='.$outil_id).'" title="' 
			. couteauprive_T('par_defaut') . '">' . couteauprive_T('par_defaut') . '</a>&nbsp;|&nbsp;';
	if(!$actif)
		$s .= '<a href="'.generer_url_ecrire(_request('source'),'cmd=hide&outil='.$outil_id).'" title="' 
			. couteauprive_T('outil_cacher') . '">' . couteauprive_T('outil_cacher') . '</a>&nbsp;|&nbsp;';
	$act = $actif?'des':'';
	$s .= '<a href="'.generer_url_ecrire(_request('source'),'cmd=switch&outil='.$outil_id).'" title="' 
		. _T("couteauprive:outil_{$act}activer_le").'">'._T("couteauprive:outil_{$act}activer")."</a></div>";
	if(strlen($temp = cs_action_fichiers_distants($outil) . cs_action_rapide($outil_id, $actif))) 
		$s .= "<div class='cs_action_rapide' id='cs_action_rapide'>$temp</div>";
	$descrip = propre($descrip); 
	$s .= cs_nettoie($descrip); // absolument une variable pour les passages par reference (PHP 5.4)
	$p = '';
	if($b = cs_balises_traitees($outil_id, '*, #'))
		$p .=  '<p>' . couteauprive_T('detail_balise_etoilee', array('bal' => $b.'*')) . '</p>';
	if($actif && isset($outil['code:spip_options']) && strlen($outil['code:spip_options']) && ($outil_id<>'cs_comportement'))
		$p .= '<p>' . couteauprive_T('detail_spip_options' 
			. (defined('_CS_SPIP_OPTIONS_OK')?'_ok':''), array('lien'=>description_outil_liens_callback(array(1=>'cs_comportement')))) . '</p>';
	if((isset($outil['jquery']) && $outil['jquery']=='oui') || strpos(':'.join(':',array_keys($outil)), ':code:jq')!==false)
		$p .= '<p>' . couteauprive_T('detail_jquery2') . '</p>';
	if(isset($outil['auteur']) && strlen($outil['auteur']))
		$p .= '<p>' . _T('auteur') .' '. ($outil['auteur']) . '</p>';
	if(isset($outil['contrib']) && strlen($outil['contrib']))
		$p .= '<p>' . couteauprive_T('contrib', array('url'=>'[->'._URL_CONTRIB.$outil['contrib'].']')) . '</p>';

	$p = $s . propre($p) . detail_outil($outil_id) . '</div>';
	// Grrr les retours simples de SPIP 3 ...
	return (defined('_AUTOBR') && strlen(_AUTOBR))?str_replace(_AUTOBR, ' ', $p):$p;

}

// met a jour les outils caches/interdits et renvoie deux listes d'outils actifs et inactifs
function liste_outils() {
	global $outils;
	$id = $nb_actifs = 0;
	$categ = array();
	$metas_caches = isset($GLOBALS['meta']['tweaks_caches'])?unserialize($GLOBALS['meta']['tweaks_caches']):array();
	foreach($outils as $outil) {
		// liste des categories
		if(!isset($categ[$cat=&$outil['categorie']])) {
			$tmp = couteauprive_T('categ:'.$cat);
			if($tmp{1}=='.') $tmp='0'.$tmp; // classement sur deux chiffres
			$categ[$cat] = strncmp($tmp, 'categ', 5)==0?$cat:$tmp;
		}
		// ressensement des autorisations
		if(!autoriser('configurer', 'outil', 0, NULL, $outil))
			$outils[$outil['id']]['interdit'] = $metas_caches[$outil['id']]['cache'] = 1;
	}
	// une constante : facon rapide d'interdire des lames a la manipulation
	if(defined('_CS_OUTILS_CACHES'))
		foreach (explode(':',_CS_OUTILS_CACHES) as $o) $outils[$o]['interdit'] = $metas_caches[$o]['cache'] = 1;
	asort($categ);
	$results_actifs = $results_inactifs = '';
	foreach($categ as $i=>$c) {
		$s_actifs = $s_inactifs = array();
		foreach($outils as $outil) if($outil['categorie']==$i) {
			$test = $outil['actif']?'s_actifs':'s_inactifs';
			$hide = !$outil['actif'] && isset($metas_caches[$outil['id']]['cache']);
			if(!$hide)
				${$test}[] .= $outil['nom'] . '|' . $outil['index'] . '|' . $outil['id'];
		}
		$nb_actifs += count($s_actifs);
		foreach(array('s_actifs', 's_inactifs') as $temp) if(count(${$temp})) {
			sort(${$temp});
			$reset=_request('cmd')=='resetjs'?"\ncs_EffaceCookie('sous_liste_$id');":'';
			$titre = "<span class='light cs_hidden'> (".count(${$temp}).")</span>";
			preg_match(',[0-9. ]*(.*)$,', $c, $reg);
			$titre = "<div class='titrem categorie'>$reg[1]$titre</div>";
			$href = generer_url_ecrire(_request('exec'),"cmd=descrip&outil=");
			foreach(${$temp} as $j=>$v)
				${$temp}[$j] = preg_replace(',^(.*)\|(.*)\|(.*)$,', '<a class="cs_href" id="$3" href="'.$href.'$3">$1</a>', $v);
			${$temp} = '<ul><li>'.join("</li><li>\n", ${$temp}).'</li></ul>';
			if(strlen(${$temp})) ${'result'.$temp} .= $titre
				. "<div id='sous_liste_$id' class='sous_liste'>" . ${$temp} . '</div>';
			$id++;
		}
	}

	$fieldset = '<fieldset style="width:92%; margin:0; padding:0.6em;" class="cadre-trait-couleur liste_outils"><legend style="font-weight:bold; color:';
	return array($nb_actifs, '<div id="cs_outils" class="cs_outils">'
	. '<div class="cs_liste cs_inactifs">' . $fieldset . 'red;">' . couteauprive_T('outils_inactifs') . '</legend>'
	. $results_inactifs . '</fieldset></div>'
	. '<form id="csform" name="csform" method="post" action="' . generer_url_ecrire(_request('exec'),"cmd=switch").'">'
	. '<input type="hidden" value="test" name="cs_selection" id="cs_selection" />'
	. '<div class="cs_toggle"><div style="display:none;">'
	. '<a id="cs_toggle_a" title="' . couteauprive_T('outils_permuter_gras1') . '" href="' . generer_url_ecrire(_request('exec'),"cmd=switch").'">'
	. '<img alt="<->" src="' . find_in_path('img/permute.gif').'"/></a>'
	. '<p id="cs_toggle_p">(0)</p>'
	. '<a id="cs_reset_a" title="'.couteauprive_T('outils_resetselection').'" href="#">'
	. '&nbsp;<img alt="X" class="class_png" src="'.find_in_path('img/nosel.gif').'"/>&nbsp;</a>'
	.	'</div></div></form>'
	. '<div class="cs_liste cs_actifs">' . $fieldset . '#22BB22;">' . couteauprive_T('outils_actifs') . '</legend>'
	. $results_actifs . '</fieldset>'
	. '<div style="float:left; width:60%"><form><input type="text" size="10" value="'._T('info_rechercher').'" name="cs_rech" id="cs_rech" class="recherche cs_rech" accesskey="r" onfocus="if(this.value==cs_init_recherche)this.value=\'\';" onkeyup="cs_Recherche(this.value);"><span id="results"></span></form></div>'
	. '<div style="text-align: right;"><a id="cs_tous_a" title="' . couteauprive_T('outils_selectionactifs') . '" href="#">'
	. couteauprive_T('outils_selectiontous') . '</a></div>'
	. '</div></div>');
}

// renvoie les details techniques d'un outil
function detail_outil($outil_id) {
	global $outils;
	$outil = &$outils[$outil_id];
	$div = '<div class="cs_details_outil">';
	if(cs_version_erreur($outil)) return $div . couteauprive_T('erreur:version') . '</div>';
	$details = $a = array();
	foreach(array('spip_options', 'options', 'fonctions', 'js', 'jq') as $in)
		if(isset($outil['code:'.$in])) $a[] = couteauprive_T('code_'.$in);
	$serkeys = ':'.join(':',array_keys($outil));
	foreach(array('css', 'js', 'jq') as $in)
		if(strpos($serkeys, ":code:$in")!==false) $a[] = couteauprive_T('code_'.$in);
	if(count($a)) $details[] = couteauprive_T('detail_inline') . ' ' . join(', ', $a);
	$a = array();
	foreach(array('.php', '_options.php', '_fonctions.php', '.js', '.js.html', '.css', '.css.html') as $ext)
		if(find_in_path('outils/'.($temp=$outil_id.$ext))) $a[] = $temp;
	if(count($a)) $details[] = couteauprive_T('detail_fichiers') . ' ' . join(', ', $a);
	if($b=cs_balises_traitees($outil_id)) $details[] = couteauprive_T('detail_traitements') . $b;
	if(preg_match_all(',(pipeline|pipelinecode):([a-z_]+),', $serkeys, $regs, PREG_PATTERN_ORDER))
		$details[] = couteauprive_T('detail_pipelines') . ' ' . join(', ', array_unique($regs[2]));
	if($outil['nb_disabled']) $details[] = couteauprive_T('detail_disabled') . ' ' . $outil['nb_disabled'];
	if(isset($outil['fichiers_distants'])) {
		$a = array();
		foreach($outil['fichiers_distants'] as $i) $a[] = cs_basename($outil[$i]);
		$details[] = couteauprive_T('detail_fichiers_distant') . ' ' . join(', ', $a);
	}
	if($outil['surcharge']) $details[] = '* ' . couteauprive_T('detail_surcharge') . ' ' . _T('item_oui');
	if(count($details)) return $div . join('<br />', $details) . '</div>';
	return '';
}

// liste les balises sur lesquelles l'outil applique un traitement
function cs_balises_traitees($outil_id, $join=', #') {
	global $outils;
	if(preg_match_all(',traitement:([A-Z_]+),', serialize(array_keys($outils[$outil_id])), $regs, PREG_PATTERN_ORDER))
		return  ' #' . join($join, array_unique($regs[1]));
	return '';
}

// renvoie les boutons eventuels d'action rapide
function cs_action_rapide($outil_id, $actif=true) {
	include_spip('inc/texte');
	include_spip('inc/actions_compat');
	$f = "{$outil_id}_action_rapide";
	include_spip("outils/$f");
	if(!function_exists($f)) return '';
	if(strlen($f = trim($f()))) {
		// si inactif...
		if(!$actif) {
			if(preg_match_all(',<legend[^>]*>(.*?):?\s*</legend>,', $f, $regs)	
				|| preg_match_all(',<p[^>]*>(.*?):?\s*</p>,', $f, $regs))
				// on ne conserve que les <legend> ou <p>
				$f = '<ul><li>' . join("</li><li>", $regs[1]) . '</li></ul>';
		}
		$info = '<strong>' . definir_puce() . '&nbsp;' . couteauprive_T('action_rapide'.($actif?'':'_non')) . "</strong>";
		return "<div>$info</div><div>$f</div>";
	}
	return '';
}
// gere les fichiers distants d'un outil
function cs_action_fichiers_distants(&$outil, $forcer=false, $tester=false) {
	if(!isset($outil['fichiers_distants'])) return '';
	$lib = sous_repertoire(_DIR_RACINE, 'lib');
	$actif = $outil['actif'];
	$a = array(); $reload = false;
	foreach($outil['fichiers_distants'] as $i) {
		$erreur = false;
		$res_pipe = '';
		$dir = sous_repertoire($lib, $outil['id']);
		// prefixe et basename sans arguments
		preg_match('/[^:]*/', $i, $reg); 
		$f = $reg[0] . '_' . cs_basename($outil[$i]);
		// 1er appel : envoi du nom du fichier
		$file = pipeline('fichier_distant', array('outil'=>$outil['id'], 'actif'=>$actif, 'fichier_local'=>$dir.$f));
		$file = $file['fichier_local'];
		$size = ($forcer || @(!file_exists($file)) ? 0 : filesize($file));
		if($size) $statut = couteauprive_T('distant_present', array('date'=>cs_date_long(date('Y-m-d H:i:s', filemtime($file)))));
		elseif($actif || $forcer) {
			include_spip('inc/distant');
			if($distant = recuperer_page($outil[$i])) {
				// 2e appel : envoi du texte
				$distant = pipeline('fichier_distant', array('outil'=>$outil['id'], 'fichier_local'=>$file, 
						'fichier_distant'=>$outil[$i], 'message'=>'', 'texte'=>$distant, 'actif'=>$actif));
				$dir = dirname($file = $distant['fichier_local']);
				$message = $distant['message'] . "\n_ " . couteauprive_T('copie_vers', array('dir'=>cs_root_canonicalize($dir.'/')));
				$distant = $distant['texte'];
				if(preg_match(',\.php\d?$,', $file)) {
					$test = preg_replace(',^.*?\<\?php|\?\>.*?$,', '', $distant);
					if(!@eval("return true; ". preg_replace(',function\s+\w+,','\\0_zz',$test))) $distant = false;
					else $distant = cs_ecrire_fichier($file, '<'."?php\n\n".trim($test)."\n\n?".'>');
				} else
					$distant = cs_ecrire_fichier($file, $distant);
			}
			if($distant) { $statut = '<span style="color:green">'.couteauprive_T('distant_charge').'</span>'; $reload = true; }
			else $erreur = $statut = '<span style="color:red">'.couteauprive_T('distant_echoue').'</span>';
		} else $erreur = $statut = couteauprive_T('distant_inactif');
		if($erreur) {
			$outil['erreurs']['fichiers_distants'][$outil[$i]] = -1;
			$message .= "\n_ " . couteauprive_T('local_ko', array('file'=>cs_root_canonicalize($file)));
		}
		$a[] = '[{'.basename($file)."}->{$outil[$i]}]\n_ ".$statut.$message;
	}
	if($tester) return $a;
	if($reload) $reload = "<input class='cs_sobre' type='submit' value=\" [" 
		. attribut_html(couteauprive_T('outil_actualiser')).']" onclick="javascript:return cs_href_click(\'\', true);" />';
	$a = '<ul style="margin:0.6em 0 0.6em 4em;"><li>' . join("</li><li style='margin-top:0.4em;'>", $a) . '</li></ul>';
	$b = ($actif || !$erreur)?'rss_actualiser':($erreur?'distant_charger':false);
	$b = $b?"\n<p class='cs_sobre'><input class='cs_sobre' type='submit' value=\" ["
			. attribut_html(couteauprive_T(''.$b)).']" />' . $reload . '</p>':'';
	return ajax_action_auteur('action_rapide', 'fichiers_distants', 'admin_couteau_suisse', "arg=$outil[id]|fichiers_distants&cmd=descrip#cs_action_rapide",
			'<p>' . couteauprive_T('distant_aide') . '</p>'
			. '<p style="margin-top:1em"><strong>' . definir_puce() . '&nbsp;' . couteauprive_T('detail_fichiers_distant') . '</strong></p>'
			. '<div>' . propre($a) . '</div>' . $b);
	
}

// Liste les endroits de la base ou on trouve un raccourci
// Ex. : $champs = array("article/texte", "rubrique/texte")
function cs_raccourcis_presents($champs, $racc) {
	if(!defined('_SPIP19300')) return "(SPIP 2 mini)";
	$res = array();
	foreach($champs as $c) {
		list($type, $champ) = explode('/', $c, 2);
		$f = create_function('$a', 'return "[$a"."->'.$type.'$a]";');
		$ids = sql_allfetsel(id_table_objet($type), table_objet_sql($type), $champ.' LIKE '._q("$racc"));
		if(count($ids)) {
			$ids = array_map($f, array_map('reset', $ids));
			$res[] = join(', ', $ids);
		}
	}
	return count($ids)?join(", ", array_unique($res)):couteauprive_T('variable_vide');
}

?>