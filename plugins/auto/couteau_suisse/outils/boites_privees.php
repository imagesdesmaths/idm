<?php

// Doc : http://www.spip-contrib.net/Les-Boites-Privees

if (!defined("_ECRIRE_INC_VERSION")) return;
include_spip('inc/presentation');
include_spip('inc/layer');

// compatibilite SPIP SQL < 2.0
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

function boites_privees_affiche_gauche($flux){
	$exec = &$flux['args']['exec'];
	if(defined('boites_privees_TRI_AUTEURS') && ($exec=='articles')) {
		include_spip('outils/boites_privees_action_rapide');
		$flux['data'] .= action_rapide_tri_auteurs($flux['args']['id_article']);
	}
	if(defined('boites_privees_URLS_PROPRES')) 
		switch($exec) {
			case 'articles': $flux['data'] .= cs_urls_propres('article', $flux['args']['id_article']); break;
			case 'naviguer': $flux['data'] .= cs_urls_propres('rubrique', $flux['args']['id_rubrique']); break;
			case 'auteur_infos': case 'auteurs_edit': $flux['data'] .= cs_urls_propres('auteur', $flux['args']['id_auteur']); break;
			case 'breves_voir': $flux['data'] .= cs_urls_propres('breve', $flux['args']['id_breve']); break;
			case 'mots_edit': $flux['data'] .= cs_urls_propres('mot', $flux['args']['id_mot']); break;
			case 'sites': $flux['data'] .= cs_urls_propres('syndic', $flux['args']['id_syndic']); break;
		}
	return cs_pipeline_boite_privee($flux, 'gauche');
}

function boites_privees_affiche_milieu($flux){
	switch($flux['args']['exec']) {
		case 'articles': {
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
		case 'auteurs':case 'auteur_infos':case 'auteurs_edit': 
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
 - voire de modifier les boites "officielles"
 par exemple : 
	$GLOBALS['boites_privees_gauche'][] = 'ma_boite_privee';
	function ma_boite_privee($flux, $exec) { 
		return $flux . debut_boite_info(true) . 'Youpi !!' . fin_boite_info(true); 
	}
*/
function cs_pipeline_boite_privee(&$flux, $endroit) {
	// liste de filtres
	if(!is_array($GLOBALS[$globale = 'boites_privees_'.$endroit])) return $flux;
	$liste = array_unique($GLOBALS[$globale]);
	foreach($liste as $f)
		if (function_exists($f)) $flux['data'] = $f($flux['data'], $flux['args']['exec']);
	return $flux;
}

function cs_boite_rss() {
	include_spip('inc/autoriser');
	if (!defined('boites_privees_CS') || !autoriser('configurer','csinfosrss')) return '';
	return debut_boite_info(true)
		. '<p><b>'._T('couteauprive:rss_titre').'</b></p><div class="cs_boite_rss"><div><p>'._T('couteauprive:rss_attente').'</p><noscript>'._T('couteauprive:outil_inactif').' !</noscript></div></div>'
		/*.'<div style="text-align: right; font-size: 87%;"><a title="'._T('couteauprive:rss_desactiver').'" href="'
		.generer_url_ecrire(_request('exec'),'cmd=switch&outil=rss_couteau_suisse').'">'._T('couteauprive:supprimer_cadre').'</a></div>'*/
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
	// compatibilite SPIP < 2.0
	$compat = function_exists('bouton_block_depliable');
	$bouton = $compat?bouton_block_depliable(cs_div_configuration().$txt[1], 'invisible', "formatspip")
		:bouton_block_invisible("formatspip").cs_div_configuration().$txt[1];
	$bloc = $compat?debut_block_depliable(false, "formatspip")
		:debut_block_invisible("formatspip");
	return debut_cadre_enfonce(find_in_path('/img/formatspip-24.png'), true, '', $bouton)
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
		$s = sql_select("url", "spip_urls", "id_objet=$id AND type='$type'", '', 'date DESC');
		while ($t = sql_fetch($s)) $res .= ($res?'<br />':'')."&bull;&nbsp;$t[url]\n";
	// SPIP < 2.0
	} else {
		// impossible de calculer l'url publique d'ici.
		$table = $type.($type=='syndic'?'':'s');
		$r = spip_query("SELECT url_propre FROM spip_$table WHERE id_$type=$id");
		if ($r && $r = spip_fetch_array($r) ) {
			if(!strlen($r=$r['url_propre'])) $r=_T('couteauprive:variable_vide');
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
	return '<div style="float:right; top:4px; right:-4px; position:relative;" ><a title="'._T('couteau:configurer').'" href="'.generer_url_ecrire('admin_couteau_suisse','cmd=descrip&outil=boites_privees#cs_infos').'"><img alt="'._T('couteau:configurer').'" src="'._DIR_IMG_PACK.'secteur-12.gif"/></a></div>';
}

function cs_cadre_depliable($titre, $id, $texte) {
	// SPIP < 2.0
	if(!defined('_SPIP19300')) return debut_cadre_relief(find_in_path('img/couteau-24.gif'), true)
		. cs_div_configuration()
		. "<div class='verdana1' style='text-align: left;'>"
		. block_parfois_visible($id, "<b>$titre</b>", $texte, 'text-align: center;')
		. "</div>"
		. fin_cadre_relief(true);
	// SPIP >= 2.0
	return cadre_depliable(find_in_path('img/couteau-24.gif'), cs_div_configuration()."<b>$titre</b>", false /*true = deplie*/, $texte, $id);
}

?>