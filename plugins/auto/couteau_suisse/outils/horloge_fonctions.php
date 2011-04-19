<?php
// action speciale, si cs_dateserveur=oui
if(!isset($GLOBALS['cs_fonctions']) && isset($_GET['cs_dateserveur'])) {
	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8"?>',
		'<curTime><U>', date("U"), '</U><Z>', date("Z"), '</Z></curTime>';
	exit;
}

// La balise #HORLOGE
function balise_HORLOGE_dist($p) {
	$i = 1; $args = array();
	while(($a = interprete_argument_balise($i++,$p)) != NULL) $args[] = $a;
	$args = count($args)?join(".'||'.", $args):"''";
	$p->code = "horloge_params($args)";
	$p->interdire_scripts = false;
	return $p;
}

function horloge_params($args) {
	$t = array();
	$bal = 'span'; $def='99:99';
	$args = explode('||', $args);
	foreach($args as $a) {
		list($a, $b) = explode('=', $a, 2);
		if($b=="''" || $b=='""') $b = '';
		if(strlen($a)) {
			if($a=='id') $id = 'jclock'.$b;
			elseif($a=='defaut') $def = $b;
			elseif($a=='balise') $bal = $b;
			else $t[$a] = "$a=$b";
		}
	}
	return "<$bal class=\"jclock" . (isset($id)?" $id\" id=\"$id":'')
		.'" title="'.join('||',$t)."\">$def</$bal> ";
}
?>