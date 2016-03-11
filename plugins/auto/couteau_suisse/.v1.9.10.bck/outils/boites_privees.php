<?php

// Doc : http://contrib.spip.net/Les-Boites-Privees

if (!defined("_ECRIRE_INC_VERSION")) return;
include_spip('inc/presentation');
include_spip('inc/layer');

// compatibilite SQL pour SPIP 1.92
if(!defined('_SPIP19300')) {
	include_spip('base/abstract_sql');
	if(!function_exists('sql_select')) { function sql_select($s=array(),$f=array(),$w=array(),$g=array(),$o=array(),$l='',$h=array(),$sv='') {
		return spip_abstract_select($s,$f,$w,$g,$o,$l,'',$h,'','',$sv); } }
	if(!function_exists('sql_fetch')) { function sql_fetch($s) { return spip_fetch_array($s); } }
	if(!function_exists('sql_update')) { function sql_update($t, $e, $w=array()) {
		if(!is_array($t))$t=array($t); if(!is_array($e))$e=array($e); if(!is_array($w))$w=array($w);
		$q=$r =''; foreach($e as $i=>$v) $e[$i] = "$i=$v";
		return spip_query("UPDATE ".join(',',$t)." SET ".join(',',$e).(empty($w)?'':" WHERE ".join(' AND ',$w)));
	} }
}

// cette fonction appelee automatiquement a chaque affichage de la page privee du Couteau Suisse renvoie un tableau
function boites_privees_installe_dist(){
	tri_auteurs_verifie_table(); // OPTIM : ne le faire qu'a l'activation de la lame ou de la boite ? upgrade de SPIP ?
	return false;
}

function boites_privees_affiche_gauche($flux){
	$exec = &$flux['args']['exec'];
	if(defined('boites_privees_TRI_AUTEURS') && ($exec=='article' || $exec=='articles')) {
		include_spip('outils/boites_privees_action_rapide');
		$flux['data'] .= action_rapide_tri_auteurs($flux['args']['id_article']);
	}
	if(defined('boites_privees_URLS_PROPRES')) {
		// fonction de SPIP >= 3.0
		$e = function_exists('trouver_objet_exec')
			?trouver_objet_exec($exec)
			:array('type'=>$exec, 'id_table_objet'=>$flux['args']['id_'.$exec]?'id_'.$exec:'');
		if($e && strlen($e['type']) && strlen($e['id_table_objet']))
			$flux['data'] .= cs_urls_propres($e['type'], $flux['args'][$e['id_table_objet']]);
		else switch($exec) {
			// SPIP>=3.0 : objets au singulier uniquement (autres 'case' pour compatibilite SPIP<3.0)
			case 'articles': $flux['data'] .= cs_urls_propres('article', $flux['args']['id_article']); break;
			case 'naviguer': $flux['data'] .= cs_urls_propres('rubrique', $flux['args']['id_rubrique']); break;
			case 'auteur_infos': case 'auteurs_edit': $flux['data'] .= cs_urls_propres('auteur', $flux['args']['id_auteur']); break;
			case 'breves_voir': $flux['data'] .= cs_urls_propres('breve', $flux['args']['id_breve']); break;
			case 'mots_edit': $flux['data'] .= cs_urls_propres('mot', $flux['args']['id_mot']); break;
			case 'site': case 'sites': $flux['data'] .= cs_urls_propres('syndic', $flux['args']['id_syndic']); break;
		}
	}
	return cs_pipeline_boite_privee($flux, 'gauche');
}

function boites_privees_affiche_milieu($flux){
	switch($flux['args']['exec']) {
		// SPIP >= 3.0 : objets au singulier
		case 'article': case 'articles': {
			// texte original au format spip
			if(defined('boites_privees_ARTICLES'))
				$flux['data'] .= cs_formatspip($flux['args']['id_article']);
			break;
		}
		default:
			break;
	}
	return cs_pipeline_boite_privee($flux, 'milieu');
}

function boites_privees_affiche_droite($flux) {
	switch($flux['args']['exec']) {
		case 'auteur':case 'auteurs':/* Pour SPIP < v3 : */case 'auteur_infos':case 'auteurs_edit': 
			$flux['data'] .= cs_infos_webmasters() . cs_infos_connection();	break;
		case 'admin_couteau_suisse':
			$flux['data'] .= cs_boite_rss(); break;
		default:
			break;
	}
	return cs_pipeline_boite_privee($flux, 'droite');
}

/*
 fonction appelant une liste de fonctions qui permettent :
 - d'ajouter facilement des boites privees perso
 - voire de modifier les boites fournies par le plugin
 par exemple : 
	$GLOBALS['boites_privees_gauche'][] = 'ma_boite_privee';
	function ma_boite_privee($flux, $exec) { 
		return $flux . debut_boite_info(true) . 'Youpi !!' . fin_boite_info(true); 
	}
*/
function cs_pipeline_boite_privee(&$flux, $endroit) {
	// liste de filtres
	$globale = 'boites_privees_'.$endroit;
	if(!(isset($GLOBALS[$globale]) && is_array($GLOBALS[$globale]))) return $flux;
	$liste = array_unique($GLOBALS[$globale]);
	foreach($liste as $f)
		if (function_exists($f)) $flux['data'] = $f($flux['data'], $flux['args']['exec']);
	return $flux;
}

// pipeline utilise sous SPIP>=2.1, histoire de respecter l'ordre de stockage des auteurs d'objets
function boites_privees_pre_boucle($flux) {
	if(!defined('boites_privees_TRI_AUTEURS') || $flux->type_requete!='auteurs' 
			|| !count($L1 = $flux->join) || !count($w = &$flux->where)>1) return $flux;
	// alias de la jointure
	$L1 = array_keys($L1);
	if(defined('_SPIP30000')) { 
		if($w[0][0]=="'='" && $w[1][0]=="'='")
			// SPIP v3 : 2 liens (sur objet et id_objet)
			$flux->order[] = 'tri_auteurs_sqlfield('.$w[0][2].','.$w[1][2].','._q($L1[0]).','._q($flux->serveur).')';
	} elseif($w[0][0]=="'='")
		// SPIP v2.1 : 1 lien (sur id_article)
		$flux->order[] = 'tri_auteurs_sqlfield('.$w[0][2].',\'article\','._q($L1[0]).','._q($flux->serveur).')';
	return $flux;
}

// function listant les auteurs d'un objet, tries suivant le champ 'ordre'
function tri_auteurs_sqlfield($id_objet, $type_objet, $alias, $serveur) {
	static $res = array();
	if(!isset($r[$i = "$id_objet,$type_objet,$serveur"])) {
		$t = defined('_SPIP30000')
			?sql_allfetsel('id_auteur','spip_auteurs_liens', "objet=$type_objet AND id_objet=$id_objet", '','ordre','','',$serveur)
			:sql_allfetsel('id_auteur','spip_auteurs_articles', "id_article=$id_objet", '','ordre','','',$serveur);
		$r[$i] = count($t)>1?'FIELD('.$alias.'.id_auteur,'.join(array_map('reset', $t), ',').')':'';
	}
	return $r[$i];
}

// verifier que le champ 'ordre' est bien present dans la table des liens, sinon on le cree
// cette fonction ($complet=true) permet egalement une mise a jour en cas de creation du champ 'ordre' sur un site existant
function tri_auteurs_verifie_table($complet=false) {
	global $metas_outils; 
	if(!defined('_SPIP20100') || //!defined('boites_privees_TRI_AUTEURS')) return;
		!isset($metas_outils['boites_privees']['actif']) || !$metas_outils['boites_privees']['actif']) return;

	include_spip('base/abstract_sql');
	$table = defined('_SPIP30000')?'spip_auteurs_liens':'spip_auteurs_articles';
	$x = sql_showtable($table);
	if($x = !isset($x['field']['ordre']))
		sql_alter("TABLE $table ADD ordre INT NOT NULL DEFAULT '0'");
	if($complet || $x) {
		// mise a jour du champ 'ordre' pour les articles a plusieurs auteurs et n'ayant jamais ete tries grace a ce champ
		if(defined('_SPIP30000')) {
			$q1 = sql_select('id_objet, COUNT(*) as nb', $table, "objet='article' AND ordre=0", 'id_objet', '','', "nb>1");
			while($r1 = sql_fetch($q1)) {
				$q2 = sql_select('id_auteur', $table, "objet='article' AND ordre=0 AND id_objet=".$r1['id_objet']);
				$j = $r1['nb'] + 999; $i = 0;
				while($r2 = sql_fetch($q2))
					sql_update($table, array('ordre'=>$i++ - $j), 
						"objet='article' AND ordre=0 AND id_objet=$r1[id_objet] AND id_auteur=".$r2['id_auteur']);
			}
		} else {
			$q1 = sql_select('id_article, COUNT(*) as nb', $table, "ordre=0", 'id_article', '','', "nb>1");
			while($r1 = sql_fetch($q1)) {
				$q2 = sql_select('id_auteur', $table, "ordre=0 AND id_article=".$r1['id_article']);
				$j = $r1['nb'] + 999; $i = 0;
				while($r2 = sql_fetch($q2))
					sql_update($table, array('ordre'=>$i++ - $j), 
						"ordre=0 AND id_article=$r1[id_article] AND id_auteur=".$r2['id_auteur']);
			}
		}
	} // $complet
}

function cs_boite_rss() {
	include_spip('inc/autoriser');
	if (!defined('boites_privees_CS') || !autoriser('configurer','csinfosrss')) return '';
	return debut_boite_info(true)
		. '<p><b>'.couteauprive_T('rss_titre').'</b></p><div class="cs_boite_rss"><div><p>'.couteauprive_T('rss_attente').'</p><noscript>'.couteauprive_T('outil_inactif').' !</noscript></div></div>'
		/*.'<div style="text-align: right; font-size: 87%;"><a title="'.couteauprive_T('rss_desactiver').'" href="'
		.generer_url_ecrire(_request('exec'),'cmd=switch&outil=rss_couteau_suisse').'">'.couteauprive_T('supprimer_cadre').'</a></div>'*/
		. fin_boite_info(true);
}

function cs_infos_webmasters() {
	include_spip('inc/autoriser');
	if (!defined('boites_privees_WEBMASTERS') || !autoriser('configurer','csinfoswebmasters')) return '';
	include_spip('cout_define');
	list($w) = get_liste_administrateurs();
	return cs_cadre_depliable(_T('couteau:webmestres'), 'bp_infos_webmasters', 
	"<p>".(strlen($w)?'&bull; '.str_replace(', ','<br/>&bull; ',$w):_T('couteau:variable_vide'))."</p>");
}

function cs_infos_connection() {
	include_spip('inc/autoriser');
	if (!defined('boites_privees_AUTEURS') || !autoriser('configurer','csinfosconnection')) return '';
	include_spip('public/assembler');
	return cs_cadre_depliable(_T('couteau:connections'), 'bp_infos_connection',
		recuperer_fond('fonds/derniers_connectes'));
}

function cs_formatspip($id_article){
	include_spip('public/assembler');
	if(!$txt = recuperer_fond('fonds/format_spip', array('id_article'=>$id_article))) return '';
	$txt = explode('@TITRE@=', $txt, 2);
	// compatibilite avec SPIP 1.92
	$compat = function_exists('bouton_block_depliable');
	$bouton = $compat?bouton_block_depliable(cs_div_configuration().$txt[1], 'invisible', "formatspip")
		:bouton_block_invisible("formatspip").cs_div_configuration().$txt[1];
	$bloc = $compat?debut_block_depliable(false, "formatspip")
		:debut_block_invisible("formatspip");
	return debut_cadre_enfonce(cs_icone(24,'formatspip','png'), true, '', $bouton)
		. $bloc	. $txt[0] . fin_block()
		. fin_cadre_enfonce(true);
}

function cs_urls_propres($type, $id) {
	global $type_urls;
	if(!$id) return '';
	$res = "";
	// SPIP >= 2.0
	if(defined('_SPIP19300')) {
		$url = generer_url_entite_absolue($id, $type, '', '', true);
		$lien_public = "\n[<span>[". _T('couteau:urls_propres_lien'). "|{$url}->{$url}]</span>]\n\n";
		$s = sql_select("url, date", "spip_urls", "id_objet=$id AND type='$type'", '', 'date DESC');
		$now = date('Y-m-d H:i:s');
		$info = ' ('._T('couteau:url_verrouillee').')';
		while ($t = sql_fetch($s)) $res .= ($res?'<br />':'').'&bull;&nbsp;<html>'.$t['url'].($t['date']>$now?$info:'')."</html>\n";
		if(!find_in_path($f = $type."."._EXTENSION_SQUELETTES))
			$lien_public .= '{{[!]}} {'._T('info_erreur_squelette2',array('fichier'=>$f))."}\n\n";
	// SPIP 1.92
	} else {
		// impossible de calculer l'url publique d'ici.
		$table = $type.($type=='syndic'?'':'s');
		$r = spip_query("SELECT url_propre FROM spip_$table WHERE id_$type=$id");
		if ($r && $r = spip_fetch_array($r) ) {
			if(!strlen($r=$r['url_propre'])) $r = couteauprive_T('variable_vide');
			$res .= "&bull;&nbsp;$r\n";
		}
		$lien_public = './?exec=action_rapide&arg=type_urls|URL_objet_191&format=iframe&type_objet='.$type.'&id_objet='.$id.'&script=foo';
		$lien_public = '<iframe src="'.$lien_public.'" width="100%" style="border:none; height:4em;"></iframe>';
	}

	$format = in_array($type_urls, array('page', 'standard', 'html'))
		?_T('couteau:urls_propres_erreur')
		:_T('couteau:urls_propres_objet');
	$mem = $GLOBALS['class_spip_plus'];
	$GLOBALS['class_spip_plus']=' class="spip"';
	$res = propre(
		_T('couteau:urls_propres_format', array(
			'format'=>$type_urls,
			'url'=>generer_url_ecrire('admin_couteau_suisse', 'cmd=descrip&outil=type_urls#cs_infos')
		)). "\n\n"
		. $format . "\n\n"
		. '|{{'. _T('couteau:2pts', array(
			'objet'=>strtoupper(filtrer_entites(_T('couteau:objet_'.$type))).' '.$id
		))."}}|\n"
		. "|$res|")
		// bug SPIP ?
		. propre($lien_public);
	$GLOBALS['class_spip_plus'] = $mem;
	return cs_cadre_depliable(_T('couteau:urls_propres_titre'), 'bp_urls_propres', $res);
}

function cs_div_configuration() {
	include_spip('inc/autoriser');
	if(!autoriser('configurer', 'cs')) return '';
	$img = defined('_SPIP30000')?chemin_image('secteur-12.png'):_DIR_IMG_PACK.'secteur-12.gif';
	return '<div style="float:right; top:4px; right:-4px; position:relative;" ><a title="'._T('couteau:configurer').'" href="'.generer_url_ecrire('admin_couteau_suisse','cmd=descrip&outil=boites_privees#cs_infos').'"><img alt="'._T('couteau:configurer').'" src="'.$img.'"/></a></div>';
}

function cs_cadre_depliable($titre, $id, $texte) {
	// SPIP 1.92
	if(!defined('_SPIP19300')) return debut_cadre_relief(cs_icone(24), true)
		. cs_div_configuration()
		. "<div class='verdana1' style='text-align: left;'>"
		. block_parfois_visible($id, "<b>$titre</b>", $texte, 'text-align: center;')
		. "</div>"
		. fin_cadre_relief(true);
	// SPIP >= 2.0
	return cadre_depliable(cs_icone(24), cs_div_configuration()."<b>$titre</b>", false /*true = deplie*/, $texte, $id);
}

?>