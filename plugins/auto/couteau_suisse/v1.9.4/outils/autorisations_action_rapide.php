<?php

#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2013               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if (!defined("_ECRIRE_INC_VERSION")) return;

# Fichier de configuration pris en compte par config_outils.php et specialement dedie a la configuration des autorisations SPIP
# -----------------------------------------------------------------------------------------------------------------------------

// renvoie array($faire, $type, $id)
function autorisations_parse($a) {
	$a = explode(' ', trim(preg_replace(',\s+,',' ',preg_replace(',[^a-z0-9]+,i',' ',$a))), 3);
	if(!$a[0] || is_integer($a[0])) return array(-1);
	if(intval($a[2])) return array($a[0], $a[1], intval($a[2]));
	if(intval($a[1])) return array('', $a[0], intval($a[1]));
	return array($a[0], $a[1], 0);
}

function autorisations_action_rapide($actif) {
	$res = $obj = $faire = array();
	// les objets existants (SPIP>=3)
	$objets = function_exists('lister_tables_objets_sql')?lister_tables_objets_sql():array();
	// les fonctions disponibles
	$arr = get_defined_functions(); $user = &$arr['user'];
	unset($arr['user']['autoriser_dist']);
	// les alias maison
	$alias = function_exists('autorisations_liste')?autorisations_liste():array();
	$nb_fonctions = $nb_surcharges = 0;
	foreach ($user as $v) if(strncmp($v, 'autoriser_', 10)===0 && preg_match(',^(autoriser_(.*?))(_dist)?$,', $v, $reg)) {
		$nb_fonctions++;
		if(!$reg[3] && function_exists($reg[1].'_dist')) { $nb_surcharges++; continue; }
		$sup = ($reg[3] && function_exists($reg[1]))?'<sup>(*)</sup>':'';
		if(in_array($reg[1], $alias)) { $sp1='<span class="vert">'; $sp2="</span>"; } else $sp1 = $sp2 = '';
		$tmp = explode('_', $reg[2], 2);
		$table = table_objet_sql($tmp[0]);
		if(in_array($tmp[1], array('menu','onglet','bouton'))) 
			$res['['.$tmp[1].']'][] = $sp1.$tmp[0].$sup.$sp2; 
		elseif(strncmp($table, 'spip_', 5)===0)
			$faire[$tmp[1]?$tmp[1]:couteauprive_T('variable_vide')][] = $obj[$table][] = $tmp[1]?$sp1.$tmp[1].$sup.' '.$tmp[0].$sp2:"<span class='bleu'>$sp1$tmp[0]$sp2</span>"; 
		elseif($tmp[1])
			$res[$tmp[0]][] = $sp1.$tmp[1].$sup.' '.$tmp[0].$sp2; 
		else
			$res['[unique]'][] = $sp1.$tmp[0].$sup.$sp2; 
	}
	foreach($obj as $k=>$r) {
		sort($r);
		$t = $objets[$k]['texte_objets'];
		$obj[$k] = '<li><b>'.(!$t?"[$k]":_T($t)).' : </b>'.join(', ', $r).'</li>';
	}
	foreach($res as $k=>$r) {
		sort($r);
		$res[$k] = "<li><b>$k : </b>".join(', ', $r).'</li>';
	}
	foreach($faire as $k=>$r) {
		sort($r);
		$faire[$k] = "<li><b>$k : </b>".join(', ', $r).'</li>';
	}
	sort($obj); sort($res); sort($faire);
	return '<style>#cs_auth h3{cursor:pointer; margin:0.5em 0;} #cs_auth{margin:0 2em;} #cs_auth ul{margin:0 1em;} .vert{color:#2B2;} .bleu{color:#22B;}</style>
<div id="cs_auth"><p>'
		. couteauprive_T('autorisations_bilan', array('nb1'=>$nb_fonctions,'nb2'=>$nb_surcharges))
		. '</p><h3>1. '.couteauprive_T('autorisations_titre1', array('nb'=>count($obj))).'<span id="auth_1" class="cs_hidden"> (...)</span></h3><ul>'
		. join('', $obj)
		. '</ul><h3>2. '.couteauprive_T('autorisations_titre2', array('nb'=>count($faire))).'<span id="auth_2" class="cs_hidden"> (...)</span></h3><ul>'
		. join(' ', $faire)
		. '</ul><h3>3. '.couteauprive_T('autorisations_titre3', array('nb'=>count($res))).'<span id="auth_3" class="cs_hidden"> (...)</span></h3><ul>'
		. join('', $res)
		. '</ul>'.($nb_surcharges?'<p><sup>(*)</sup> '.couteauprive_T('autorisations_surcharge').'</p>':'') 
		. '</div>' . bouton_actualiser_action_rapide() . http_script("
jQuery(document).ready(function() {
	jQuery('#cs_auth h3').click( function() {
		var span = jQuery('span', this);
		if(!span.length) return true;
		jQuery(this).next().toggleClass('cs_hidden');
		cs_EcrireCookie(span[0].id, '+'+span[0].className, dixans);
		span.toggleClass('cs_hidden');
		return false; // annulation du clic
	}).each(autorisations_lire_cookie);

function autorisations_lire_cookie(i,e){
	var span = jQuery('span', this);
	if(!span.length) return;
	var c = cs_LireCookie(span[0].id);
	if(c==null || c.match('cs_hidden')) {
		jQuery(this).next().addClass('cs_hidden');
		span.removeClass('cs_hidden');
	}
}
});");
}

?>