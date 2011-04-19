<?php

// module inclu dans la description de l'outil en page de configuration

if (!defined("_ECRIRE_INC_VERSION")) return; // securiser
include_spip('inc/actions');
include_spip('inc/distant');
include_spip('inc/presentation');

define('_MAJ_SVN_FILE', 'file:///home/svn/repository/spip-zone/');
define('_MAJ_SVN_DEBUT', 'svn://zone.spip.org/spip-zone/');
define('_MAJ_SVN_TRAC', 'svn://trac.rezo.net/spip-zone/'); // ancienne URL
define('_MAJ_ZONE', 'http://zone.spip.org/trac/spip-zone/');
define('_MAJ_LOG_DEBUT', _MAJ_ZONE.'log/');
define('_MAJ_LOG_FIN', '?format=changelog');
define('_MAJ_ZIP', 'http://files.spip.org/spip-zone/');
define('_MAJ_ECRAN_SECU', _MAJ_ZONE.'browser/_core_/securite/ecran_securite.php?format=txt');

// Pour SPIP = 2.0.X
if(!function_exists('info_maj_spip')) {
	include_spip('inc/plugin');
	if(!function_exists('spip_version_compare')) {
		function spip_version_compare($v1,$v2,$op) { return version_compare($v1,$v2,$op); }
	}
	function info_maj_spip(){
		if (!autoriser('webmestre')) return "";
		// derniere version de SPIP
		$maj = $GLOBALS['meta']['info_maj_spip'];
		if (!$maj) return "";
		$maj = explode('|',$maj);
		// c'est une ancienne notif, on a fait la maj depuis !
		if ($GLOBALS['spip_version_branche']!==array_shift($maj)) {
			// compat_maj_spip(true);
			return "";
		}
		// derniere version de SPIP 2.?.?
		$maj = implode('|',$maj);
		if (strncmp($maj,"<a",2)==0) $maj = extraire_attribut ($maj, 'title');
		$lien = "http://www.spip.net/".$GLOBALS['spip_lang']."_download";
		$maj = _T('couteau:maj_rev_ok',array('revision'=>$maj, 'url'=>$lien, 'zip'=>''));
		// derniere version de SPIP 2.0.?
		include_spip('lib/maj_auto/distant_mise_a_jour');
		if(function_exists('info_maj_cache')) {
			list(,,$rev) = preg_split('/\D+/', $GLOBALS['spip_version_branche']);
			$nom = _DIR_CACHE_XML . _VERSIONS_LISTE;
			$page = info_maj_cache($nom, 'spip', !file_exists($nom) ? '' : file_get_contents($nom));
			preg_match_all(',/SPIP\D+2\D+0(\D+(\d+))?.*?[.]zip",i', $page, $m,  PREG_SET_ORDER);
			$page=0;
			foreach ($m as $v) if ($v[2]>$rev && $v[2]>$page) $page = $v[2];
			if($page) {
				$lien = "http://files.spip.org/spip/archives/SPIP-v2-0-$page.zip"; // 'http://files.spip.org/spip/archives/#SPIP-v2-0-'.$page;
				$maj = _T('couteau:maj_rev_ok',array('revision'=>'2.0.'.$page, 'url'=>$lien, 'zip'=>'')) . '<br/>' . $maj;
			}
		}
		// liens morts
		return preg_replace(',\[([^[]+)->\],', '$1', $maj);
	}
	function compat_maj_spip($forcer=false) {
		include_spip('lib/maj_auto/distant_mise_a_jour');
		if(function_exists('genie_mise_a_jour_dist') && $forcer) return genie_mise_a_jour_dist(0);
	}
}

function maj_auto_action_rapide() {
	global $spip_version_affichee, $spip_version_base;
	$arg_chargeur = $spip_version_base>=15828?'url_zip_plugin2':'url_zip_plugin'; // eq. SPIP >= 2.1.2
	$time = time();
	$timeout = ini_get('max_execution_time');
	$timeout = $timeout?min(30,floor($timeout/2)):10;
	$style = 'style="padding:0.4em;"';
	// verification des mises a jour de SPIP>=2.1
	include_spip('inc/presentation');
	list($m1,$m2) = preg_split('/\D+/', $GLOBALS['spip_version_branche']);
	$html1 = (function_exists('info_maj_spip') && ($html1=info_maj_spip()))
		?"<fieldset><legend $style>"._T('couteauprive:help2', array('version'=>'SPIP '.$spip_version_affichee)).'</legend>'.propre("\n|{{{$html1}}}|")
			.(preg_match(",$m1\.$m2\.\d+,",$html1)?'<p>'._T('couteau:maj_spip').'</p>':'').'</fieldset>'
		:'';
	// verification de l'ecran de securite
	if(defined('_ECRAN_SECURITE')) {
		$maj = maj_auto_rev_distante(_MAJ_ECRAN_SECU,false,",(\d+\.\d+(\.\d+)?),",0,true);
		if($maj{0}!="-" && _ECRAN_SECURITE!=$maj) {
			include_spip('inc/description_outil');
			$html1 .= "\n<fieldset><legend $style>"._T('couteauprive:help2', array('version'=>_T('couteauprive:ecran_securite:nom').' '._ECRAN_SECURITE)).'</legend>'
				. description_outil_liens(_T("couteauprive:ecran_maj_ko2", array("n"=>"<span style=\"color:red; font-weight:bold;\">$maj</span>"))).'</fieldset>';
		}
	}
	// verification des plugins
	include_spip('inc/plugin');
	$plugins_actifs = array_values(liste_chemin_plugin_actifs());
	// tous, mais les actifs d'abord...
	$plugins = array_unique(array_merge($plugins_actifs, liste_plugin_files()));
	$html_actifs = $html_inactifs = array();
	foreach ($plugins as $p) /*if(preg_match(',^auto/,', $p))*/ {
		$actif = in_array($p, $plugins_actifs, true);
		$auto = preg_match(',^auto/,', $p);
		$infos = plugin_get_infos_maj($p, $stop=time()-$time>$timeout);
		$maj_lib = $checked = '';
		if($stop)
			$maj_lib = '<span class="cs_relancer">'.'Temps serveur &eacute;coul&eacute; : [poursuivre->#].'.'</span>';
		elseif($infos['maj_dispo']) { 
			$maj_lib = _T('couteau:maj_rev_ok', 
				array('revision' => $infos['rev_rss'], 'url'=>$infos['url_origine'], 'zip'=>$infos['zip_trac']));
			$checked = " class='maj_checked'"; }
		elseif($infos['rev_rss']>0 && $infos['rev_local'])
			$maj_lib = _T('couteau:maj'.($infos['svn']?'_svn':'_ok'),
				array('zip'=>$infos['zip_trac'], 'url'=>$infos['url_origine']));
		elseif($auto) {
			$maj_lib = _T('couteau:maj_rev_ko', array('url'=>$infos['url_origine']));
			$checked = " class='maj_checked'"; }
		elseif($infos['rev_local'] && $infos['rev_rss']<=0)
			$maj_lib = _T('couteau:maj_rev_ko', array('url'=>$infos['url_origine']));
		// eventuels liens morts
		$maj_lib = preg_replace(',\[([^[]+)->\],', '$1', $maj_lib);
		$nom = preg_replace(",[\n\r]+,",' ',$infos['nom']). '&nbsp;(v' .$infos['version'] . ')' . ($maj_lib?"\n_ {{".$maj_lib.'}}':'');
		$rev = $infos['rev_local']?_T('couteau:maj_rev', array('revision' => $infos['rev_local'])):'';
		if(strlen($infos['commit'])) $rev .= (strlen($rev)?'<br/>':'') . cs_date_court($infos['commit']);
		if($infos['svn']) $rev .= '<br/>SVN';		
		if(!strlen($rev)) $rev = '&nbsp;';
		$zip_log = (strlen($infos['zip_log']) && $infos['zip_log']!=$infos['zip_trac'])
			?"<label><input type='radio' value='$infos[zip_log]'$checked name='$arg_chargeur'/>[->$infos[zip_log]]</label>":'';
		$bouton = '&nbsp;';
		if($auto && !$stop) $bouton = strlen($infos['zip_trac'])
			?"<input type='radio' value='$infos[zip_trac]'$checked name='$arg_chargeur'/>"
			:'<center style="margin-top:0.6em;font-weight:bold;"><acronym title="'._T('couteau:maj_zip_ko').'">&#63;</acronym></center>';
		if(strlen($zip_log)) {
			if (!$stop)
				$nom .= "\n_ "._T('couteau:maj_verif') . "\n_ $zip_log\n_ {$bouton}[->$infos[zip_trac]]<label>";
			$bouton = '&nbsp;';
		}
		${$actif?'html_actifs':'html_inactifs'}[] = "|$bouton|$nom|$rev|";
	}
	
	$html1 = "\n<div $style id='maj_auto_div'>$html1<fieldset><legend $style>"
		. _T('couteau:maj_liste').'</legend>'
		. propre(
			(count($html_actifs)? "\n|{{" . _T('couteau:plug_actifs') . "}}|<|<|\n" . join("\n",$html_actifs) . "\n" : '')
			. (count($html_inactifs)? "\n|{{" . _T('couteau:plug_inactifs') . "}}|<|<|\n" . join("\n",$html_inactifs) . "\n" : '')
		  )
		. "<div style='text-align: right;'><input class='fondo' type='submit' value=\""
		. attribut_html(_T('couteau:maj_maj'))
		. '" /><p><i>'._T('couteau:maj_verif2').'</i></p></div></fieldset></div>'
		. http_script("
jQuery(document).ready(function() {
	var ch = jQuery('#maj_auto_div .maj_checked');
	var re = jQuery('.cs_relancer a');
	if(ch.length) ch[0].checked = true;
	else if(!re.length){
		jQuery('#maj_auto_div :submit').parent().remove();
		jQuery('#maj_auto_div :radio').attr('disabled','disabled');
	}
	if(!jQuery('#maj_auto_div :radio:checked').length)
		jQuery('#maj_auto_div :radio:first')[0].checked = true;
	re.click(function() {
		cs_href_click(jQuery('#maj_auto')[0], true);
		return false;
	});
});");
	$html2 = "\n<div class='cs_sobre'><input class='cs_sobre' type='submit' value=\"["
		. attribut_html(_T('couteau:maj_actu'))	. ']" /></div>';

// premier formulaire non ajax, lancant directement charger_plugin
	return redirige_action_post('charger_plugin', '', 'admin_couteau_suisse', "cmd=descrip&outil=maj_auto#cs_infos", $html1)
// second formulaire ajax : lien d'actualisation forcee
		. ajax_action_auteur('action_rapide', 'maj_auto_forcer', 'admin_couteau_suisse', "arg=maj_auto|description_outil&cmd=descrip#cs_action_rapide", $html2);
}

// renvoie le pattern present dans la page distante
// si le pattern est NULL, renvoie un simple 'is_file_exists'
function maj_auto_rev_distante($url, $timeout=false, $pattern=NULL, $lastmodified=0, $force=false) {
	$force |= in_array(_request('var_mode'), array('calcul', 'recalcul'));
	// pour la version distante, on regarde toutes les 24h00 (meme en cas d'echec)
	$maj_ = isset($GLOBALS['meta']['tweaks_maj_auto'])?unserialize($GLOBALS['meta']['tweaks_maj_auto']):array();
	if(!isset($maj_[$url_=md5($url)])) $maj_[$url_] = array(0, false);
	$maj = &$maj_[$url_];
	// prendre le cache si svn.revision n'est pas modifie recemment, si les 24h ne sont pas ecoulee, et si on ne force pas
	if (!$force && $maj[1]!==false && ($lastmodified<$maj[0]) && (time()-$maj[0] < 24*3600))
		$distant = $maj[1];
	elseif($timeout)
		return '-1';
	else {
		$distant = $maj[1] = ($pattern!==NULL)
			?(($distant = recuperer_page($url))
				?(preg_match($pattern, $distant, $regs)?$regs[1]:'-2')
				:'-1')
			:strlen(recuperer_page($url, false, true, 0));
		$maj[0] = time();
		ecrire_meta('tweaks_maj_auto', serialize($maj_));
		ecrire_metas();
	}
	return $distant;
}

function plugin_get_infos_maj($p, $timeout=false) {
	$get_infos = defined('_SPIP20100')?charger_fonction('get_infos','plugins'):'plugin_get_infos';
	$infos = $get_infos($p);
	// fichier svn.revision
	$ok = lire_fichier($svn_rev = _DIR_PLUGINS.$p.'/svn.revision', $svn);
	$lastmodified = @file_exists($svn_rev)?@filemtime($svn_rev):0;
	if($ok && preg_match(',<origine>(.+)</origine>,', $svn, $regs)) {
		$url_origine = str_replace(array(_MAJ_SVN_FILE, _MAJ_SVN_DEBUT), _MAJ_LOG_DEBUT, $regs[1]);
		// prise en compte du recent demenagement de la Zone...
		$url_origine = preg_replace(',/_plugins_/_(?:stable|dev|test)_/,','/_plugins_/', $url_origine);
	} else $url_origine = '';
	$infos['commit'] = ($ok && preg_match(',<commit>(.+)</commit>,', $svn, $regs))?$regs[1]:'';
	$rev_local = (strlen($svn) && preg_match(',<revision>(.+)</revision>,', $svn, $regs))
		?intval($regs[1]):version_svn_courante(_DIR_PLUGINS.$p);
	if($infos['svn'] = $rev_local<0) { 
		// fichier SVN
		if (lire_fichier(_DIR_PLUGINS.$p.'/.svn/entries', $svn) 
				&& preg_match(',(?:'.preg_quote(_MAJ_SVN_TRAC).'|'.preg_quote(_MAJ_SVN_DEBUT).')[^\n\r]+,ms', $svn, $regs)) {
			$url_origine = str_replace(array(_MAJ_SVN_TRAC,_MAJ_SVN_DEBUT), _MAJ_LOG_DEBUT, $regs[0]);
			// prise en compte du recent demenagement de la Zone...
			$url_origine = preg_replace(',/_plugins_/_(?:stable|dev|test)_/,','/_plugins_/', $url_origine);
		}
		//$infos['zip_trac'] = 'SVN';
	}
	$infos['url_origine'] = strlen($url_origine)?$url_origine._MAJ_LOG_FIN:'';
	$infos['rev_local'] = abs($rev_local);
	$infos['rev_rss'] = intval(maj_auto_rev_distante($infos['url_origine'], $timeout, ', \[(\d+)\],', $lastmodified));
	$infos['maj_dispo'] = $infos['rev_rss']>0 && $infos['rev_local']>0 && $infos['rev_rss']>$infos['rev_local'];
	// fichiers zip
	$infos['zip_log'] = $infos['zip_trac'] = '';
	$p2 = preg_match(',^auto/(.*)$,', $p, $regs)?$regs[1]:'';
	if(strlen($p2)) {
		// supposition du nom d'archive sur files.spip.org
		if(intval(maj_auto_rev_distante($f = _MAJ_ZIP.$p2.'.zip', $timeout))) $infos['zip_trac'] = $f;
		// nom de l'archive recemment installee par chargeur
		if(lire_fichier(sous_repertoire(_DIR_CACHE, 'chargeur').$p2.'/install.log', $log)
				&& preg_match(',[\n\r]source: *([^\n\r]+),msi', $log, $regs)
				&& intval(maj_auto_rev_distante($regs[1], $timeout)))
			$infos['zip_log'] = $regs[1];
		// au final on prend le bon
		if(!$infos['zip_trac']) $infos['zip_trac'] = $infos['zip_log'];
	}
	return $infos;
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function maj_auto_maj_auto_forcer_action() {
	// forcer la lecture de la derniere version de SPIP
	if(function_exists('compat_maj_spip')) compat_maj_spip(true); // pour SPIP < 2.1
	elseif($cron = charger_fonction('mise_a_jour', 'genie')) $cron(0);
	// forcer la lecture des revisions distantes de plugins
	ecrire_meta('tweaks_maj_auto', serialize(array()));
	ecrire_metas();
}

?>