<?php

// module inclu dans la description de la "Configuration Actuelle" en page de configuration
// ici, un bouton : "sauver la configuration actuelle"

include_spip('inc/actions');

// Compatibilite avec SPIP 1.92
if(!defined('_SPIP19300')) {
	function redirige_action_post($action, $arg, $ret, $gra, $corps, $att='') {
		$r = _DIR_RESTREINT_ABS . generer_url_ecrire($ret, $gra, true, true);
		return generer_action_auteur($action, $arg, $r, $corps, $att . " method='post'");
	}
}

function pack_action_rapide() {
	include_spip('inc/texte'); // pour attribut_html()
	switch($n = count($GLOBALS['cs_installer'])) {
		case 0 : $info = couteauprive_T('pack_nb_zero'); break;
		case 1 : $info = couteauprive_T('pack_nb_un'); break;
		default : $info = couteauprive_T('pack_nb_plrs', array('nb' => $n));
	}
	$liste = $script = '';
	if($n) {
		$exec = _request('exec');
		$fin_delete = couteauprive_T('pack_delete');
		$img = defined('_SPIP30000')?chemin_image('poubelle.png'):_DIR_IMG_PACK.'poubelle.gif';
		$fin_delete = "\" class='pack_delete' title=\"$fin_delete\"><img src=\"$img\" width='12' height='12' alt=\"$fin_delete\" /></a>&nbsp; <a href=\"";
		$fin_install = couteauprive_T('pack_installe');
		$img = defined('_SPIP30000')?chemin_image('secteur-12.png'):_DIR_IMG_PACK.'secteur-12.gif';
		$fin_install = "\" class='pack_install' title=\"$fin_install\"><img src=\"$img\" width='12' height='12' alt=\"$fin_install\" /></a>&nbsp; ";
		foreach(array_keys($GLOBALS['cs_installer']) as $pack) {
			$u = urlencode($pack);
			$liste .= "\n-* <a href=\"" 
				. generer_url_ecrire($exec,'cmd=delete&pack='.$u)
				. $fin_delete
				. generer_url_ecrire($exec,'cmd=install&pack='.$u)
				. $fin_install . $pack;
		}
		$liste = propre($liste);
		$script = "<script type=\"text/javascript\"><!--
if (window.jQuery) jQuery(function(){
	jQuery('a.pack_delete').click( function() { 
		msg=\"".cs_javascript(couteauprive_T('pack_supprimer'))."\";
		return window.confirm(msg.replace(/@pack@/,jQuery(this).parent().text().trim())); 
	});
	jQuery('a.pack_install').click( function() {
		msg=\"".cs_javascript(couteauprive_T('pack_installer')).'\n\n'.cs_javascript(couteauprive_T('cs_reset2'))."\";
		return window.confirm(msg.replace(/@pack@/,jQuery(this).parent().text().trim())); 
	});
}); //--></script>\n";
	}
	// appel direct, sans ajax, histoire de mettre a jour le menu :
	return redirige_action_post('action_rapide', 'sauve_pack', 'admin_couteau_suisse', "cmd=pack#cs_infos",
			"\n$script<div style='padding:0.4em;'><p>$info</p>$liste<p>".couteauprive_T('pack_sauver_descrip', array('file' => show_file_options()))
			."</p><div style='text-align: center;'><input class='fondo' type='submit' value=\""
			.attribut_html(couteauprive_T('pack_sauver')) . "\" /></div></div>"); 
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
// clic "Sauver la configuration actuelle"
function pack_sauve_pack_action() {
	// pour inserer un pack de config dans config/mes_options.php
	$titre0 = $titre = couteauprive_T('pack_actuel', array('date'=>cs_date())); $n=0;
	if(isset($GLOBALS['cs_installer'][$titre]))
		while(isset($GLOBALS['cs_installer']["$titre (".++$n.')']));
	if($n) $titre = "$titre ($n)";
	include_spip(_DIR_CS_TMP.'config');
	$fct = md5($titre.time());
	$config = $GLOBALS['cs_installer'][$titre0];
	if(function_exists($config)) $config = $config();
	$pack = "\n# Le Couteau Suisse : pack de configuration du ".date("d M Y, H:i:s")."\n\$GLOBALS['cs_installer']['$titre'] = 'cs_$fct';
function cs_$fct() { return "
		. var_export($config, true) . ";\n} # $titre #\n";
	cs_ecrire_config(',\?'.'>\s*$,m', $pack.'?'.'>', $pack);
}

?>