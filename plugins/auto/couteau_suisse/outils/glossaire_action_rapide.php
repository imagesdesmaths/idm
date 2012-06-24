<?php

// module inclu dans la description de l'outil en page de configuration

include_spip('inc/actions');

// verifie les entrees mortes
function glossaire_verifie(&$c) {
	include_spip('public/parametrer'); // pour mes_fonctions
	$res = array();
	$c = count($gloss = glossaire_query_tab());
	for($i=0; $i<$c; $i++) for($j=$i+1; $j<$c; $j++) {
		$gi = &$gloss[$i]; $gj = &$gloss[$j];
		if(!isset($gi['mots']))
			list($gi['mots'],$gi['regs'],$gi['titre2']) = glossaire_parse(extraire_multi($gi['titre']));
		if(!isset($gj['mots']))
			list($gj['mots'],$gj['regs'],$gj['titre2']) = glossaire_parse(extraire_multi($gj['titre']));
		$u = false;
		$titre = $gi['mots']?glossaire_gogogo($gj['titre2'], $gi['mots'], -1, $u):'';
		if(count($gi['regs']))
			$titre .= preg_replace_callback($gi['regs'], "glossaire_echappe_mot_callback", $gj[titre], -1);
		if(strpos($titre,'@@GLOSS')!==false) {	
			$a = '['.$gi['titre'].'->mot'.$gi['id_mot'].']';
			$b = '['.$gj['titre'].'->mot'.$gj['id_mot'].']';
			$res[] = "&bull; "._T('couteauprive:glossaire_erreur', array('mot1'=>$a, 'mot2'=>$b))."\n_ ";
		}
	}
	if(count($res)) return propre(join('', $res)._T('couteauprive:glossaire_inverser'));
	return '';
}


function glossaire_action_rapide() {
	if(_request('test_bd')) {
		$info = glossaire_verifie($count);
		$info = $info
			?('<div style="color:red">'.$info.'</div>')
			:('<div style="color:green">'._T('couteauprive:glossaire_ok', array('nb'=>$count)).'</div>');
	} else $info = '';
	return ajax_action_auteur('action_rapide', 'test', 'admin_couteau_suisse', "arg=glossaire|description_outil&cmd=descrip#cs_action_rapide",
		"\n<fieldset><legend>"._T('couteau:test_base')."</legend><div style='text-align: center; padding:0.4em;'><input class='fondo' type='submit' value=\""
		. attribut_html(_T('couteau:lancer_test')) . "\" /></div></fieldset>$info");
}

// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
function glossaire_test_action() {
	// lancer la verification des mots du glossaire
	redirige_vers_exec(array('test_bd' => 1));
}

?>