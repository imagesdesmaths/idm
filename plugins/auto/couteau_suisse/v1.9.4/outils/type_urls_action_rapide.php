<?php
/*
 module mon_outil_action_rapide.php inclu :
 - dans la description de l'outil en page de configuration
 - apres l'appel de ?exec=action_rapide&arg=type_urls|argument
*/

if(defined('_SPIP20100')) {
	// declarer le raccourci de boucle URLS
	global $table_des_tables;
	$table_des_tables['urls']='urls';
}

function type_urls_action_rapide($actif) {
//	include_spip('inc/actions');
//	include_spip('inc/actions_compat');

//cs_log($_POST, '==== type_urls_action_rapide :'); cs_log($_GET);
	include_spip('public/assembler'); // pour recuperer_fond()
	$fd = recuperer_fond(defined('_SPIP19300')?'fonds/type_urls':'fonds/type_urls_191', array(
		'type_urls' => $GLOBALS['type_urls'],
		'ar_num_objet' => _request('ar_num_objet'),
		'ar_type_objet' => _request('ar_type_objet'),
	));
	// au cas ou il y aurait plusieurs actions, on fabrique plusieurs <form>
	$fd = explode('@@CS_FORM@@', $fd);
	$res = "";
	$arg = defined('_SPIP19300')?'edit_urls2_':'edit_urls_';
	foreach($fd as $i=>$f) {
		// syntaxe : ajax_action_auteur($action, $id, $script, $args='', $corps=false, $args_ajax='', $fct_ajax='')
		$res .= ajax_action_auteur('action_rapide', $arg.$i, 'admin_couteau_suisse', "arg=type_urls|description_outil&modif=oui&cmd=descrip#cs_action_rapide", $f, '', 'function() { jQuery(\'#ar_chercher\', this).click();}')."\n";
	}
	return $res;
}

// Fonction appelee par exec/action_rapide : ?exec=action_rapide&arg=type_urls|URL_objet (pipe obligatoire)
// Renvoie les caracteristiques URLs d'un objet (cas SPIP >= 2.0)
function type_urls_URL_objet_exec() {
	global $type_urls;
	$type = _request('type_objet');
	$trouver_table = charger_fonction('trouver_table', 'base');
	$desc = $trouver_table(table_objet($type));
	$table = $desc['table'];
	$champ_titre = $desc['titre']?$desc['titre']:'titre';
	$col_id =  @$desc['key']["PRIMARY KEY"];
	if (!$col_id) return false; // Quand $type ne reference pas une table
	$id_objet = intval(_request('id_objet'));

	// chercher dans la table des URLS
	include_spip('base/abstract_sql');
	//  Recuperer les URLs propre correspondant a l'objet.
	$rows = sql_allfetsel("U.url, U.date, O.$champ_titre", "$table AS O LEFT JOIN spip_urls AS U ON (U.type='$type' AND U.id_objet=O.$col_id)", "O.$col_id=$id_objet", '', 'U.date DESC');
	if (!$rows[0]) return false; # Quand $id_objet n'est pas un numero connu
	// Calcul de l'URL complete
	$url = str_replace('.././','../',generer_url_entite($id_objet, $type, '', '', true));
	$row2 = !strlen($url2 = $rows[0]['url'])
		// si l'URL n'etait pas presente en base, maintenant elle l'est ! (non verrouillee du coup...)
		?sql_fetsel("url, date", "spip_urls", "id_objet=$id_objet AND type='$type'", '', 'date DESC', 1)
		:array('url'=>$url2, 'date'=>$rows[0]['date']);
	// URL verrouilee par sa date ?
	$now = date('Y-m-d H:i:s');
	$verrou = $row2['date']>$now;
	include_spip('inc/charsets');
	$titre = charset2unicode($rows[0]['titre']);
	$info = ' ('._T('couteau:url_verrouillee').')';
	array_shift($rows); $toutes = $url2.($verrou?$info:'');
	foreach($rows as $r) $toutes .= '<br/>'.$r['url'].($r['date']>$now?$info:'');
	//  titre || URL complete || type d'URLs || URL recalculee || URL propre en base || verrou || toutes les URLs trouvees en base
	echo $titre.'||'.$url.'||'.$type_urls.'||'.$row2['url'].'||'.$url2.'||'.($verrou?'oui':'non').'||'.$toutes;
}

// Fonction {$outil}_{$arg}_exec() appelee par exec/action_rapide : ?exec=action_rapide&arg=type_urls|URL_objet_191 (pipe obligatoire)
// Renvoie les caracteristiques URLs d'un objet (cas SPIP < 2.0)
function type_urls_URL_objet_191_exec() {
	global $type_urls;
	$type = _request('type_objet');
	$table = $type.($type=='syndic'?'':'s');
	$id_objet = intval(_request('id_objet'));
	$r0 = "SELECT url_propre, titre FROM spip_$table WHERE id_$type=$id_objet";
	$r = spip_query($r0);
	if ($r AND $r = spip_fetch_array($r)) { $url_1 = $r['url_propre']; $titre = $r['titre']; }
	if(!function_exists($fct = 'generer_url_'.($type=='syndic'?'site':$type))) {
		if($f = include_spip('urls/'.$type_urls, false))
			include_once($f);
	}
	$url = function_exists($fct)?$fct($id_objet):'??';
	$r = spip_query($r0);
	if ($r AND $r = spip_fetch_array($r)) $url_2 = $r['url_propre'];
	// url propre en base || titre || url complete || type d'URLs || URL recalculee
	include_spip('inc/charsets');
	echo _request('format')=='iframe'
		?"<span style='font-family:Verdana,Arial,Sans,sans-serif; font-size:10px;'>[<a href='../$url' title='$url' target='_blank'>"._T('couteau:urls_propres_lien').'</a>]</span>'

		:$url_1.'||'.charset2unicode($titre).'||'.$url.'||'.$type_urls.'||'.$url_2;
}

// Fonction appelee par exec/action_rapide : ?exec=action_rapide&arg=type_urls|liste_urls (pipe obligatoire)
// Renvoie la liste de toutes les URLs propres de la base (SPIP >= 2.0)
function type_urls_liste_urls_exec() {
	global $type_urls;
	$res = $id = '';
	include_spip('base/abstract_sql');
	if($s=_request('suppr')) {
		$s = explode(',', base64_decode($s), 3);
		sql_delete("spip_urls", $a="id_objet=$s[0] AND type=".sql_quote($s[1]).' AND url='.sql_quote($s[2]));
		include_spip('inc/headers');
		redirige_par_entete(parametre_url(self(),'suppr','','&'));
	}
	include_spip('inc/texte');
	include_spip('inc/presentation');
	include_spip('public/assembler');
	include_spip('inc/pipelines');
	include_spip('inc/commencer_page');
	$f = defined('_SPIP30000')?'init_head':'envoi_link';
	echo '<html><head>'.f_jQuery($f(_T('couteau:urls_propres_titre')))
		.'<meta http-equiv="Content-Type" content="text/html; charset='.$GLOBALS['meta']['charset'].'" /></head><body style="text-align:center">'
		.propre(recuperer_fond('fonds/type_urls_liste', array('type'=>_request('type'))))
		.'</body></html>';
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function type_urls_edit_urls_0_action() {
	// forms[0] : tout purger (cas SPIP < 2.0)
	foreach(array('articles', 'rubriques', 'breves', 'auteurs', 'mots', 'syndic') as $t)
		if($table=_request("purger_$t")) spip_query("UPDATE spip_$table SET url_propre = ''");
	spip_log("OK purge");
}
// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function type_urls_edit_urls2_0_action() {
	// forms[0] : tout purger (cas SPIP >= 2.0)
	sql_delete ('spip_urls');
	spip_log("OK purge");
}
// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function type_urls_edit_urls_1_action() {
	// forms[1] : editer un objet (cas SPIP < 2.0)
	$type = _request('ar_type_objet');
	$table = $type.($type=='syndic'?'':'s');
	$id = intval(_request('ar_num_objet'));
	$url = trim(_request('ar_url_objet'));
	$q = "UPDATE spip_$table SET url_propre="._q($url)." WHERE id_$type=$id";
	spip_query($q);
	redirige_vers_exec(array('ar_num_objet' => _request('ar_num_objet'), 'ar_type_objet' => _request('ar_type_objet')));
}
// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function type_urls_edit_urls2_1_action() {
	// forms[1] : editer un objet (cas SPIP >= 2.0)
	$type = _request('ar_type_objet');
	$id = intval(_request('ar_num_objet'));
	$url = trim(_request('ar_url_objet'));
	$where = 'id_objet='.$id.' AND type='.sql_quote($type);
	if(!$url) {
		sql_delete('spip_urls', $where);
		spip_log("L'URL $type#$id est supprimee");
	} else {
		// pour verrouiller une url, on fixe sa date dans le futur, dans 10 ans
		$verrou = _request('ar_verrouiller')=='oui'?10*365.25*24*3600:0;		
		$row = sql_fetsel("id_objet, url", "spip_urls", $where, '', 'date DESC', 1);
		if($row) {
			sql_updateq('spip_urls', array('date'=>date('Y-m-d H:i:s',time()+$verrou), 'url'=>$url), $where . ' AND url=' . sql_quote($row['url']));
			spip_log("L'URL $type#$id est remplacee par : $url".($verrou?' puis verrouilee':''));
		} else {
			sql_insertq('spip_urls', array('date'=>date('Y-m-d H:i:s',time()+$verrou), 'url'=>$url, 'id_objet'=>$id, 'type'=>$type));
			spip_log("L'URL $type#$id a ete cree : $url".($verrou?' puis verrouilee':''));
		}
	}
	redirige_vers_exec(array('ar_num_objet' => _request('ar_num_objet'), 'ar_type_objet' => _request('ar_type_objet')));
}

function cs_url_publique($id, $type) {
	return generer_url_entite($id, $type, '', '', true);
}
?>