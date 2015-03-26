<?php

/*
module mon_outil_action_rapide.php inclu :
 - dans la description de l'outil en page de configuration
 - apres l'appel de ?exec=action_rapide&arg=boites_privees|argument
*/

if(defined('_SPIP20100')) {

	// Nouveaute SPIP 2.1 : se baser sur un nouveau champ 'ordre' de la table spip_auteurs_liens
	// Fonction qui affiche le formulaire CVT triant les auteurs d'un article : 
	function action_rapide_tri_auteurs($id_article=0) {
		$f = trim(recuperer_fond('fonds/tri_auteurs2', array('id_objet'=>$id_article, 'objet'=>'article')));
		// pas de cadre si un seul auteur...
		if(strpos($f, '<table ')===false) return "";
		return cadre_depliable(cs_icone(24),
			cs_div_configuration().'<b>'._T('couteau:tri_auteurs').'</b>',
			false,	// true = deplie
			$f, 'bp_tri_auteurs2');
	}

} else {

	// Fonction qui centralise : 
	//	- le 1er affichage : action_rapide_tri_auteurs($id_article)
	//	- l'appel exec : action_rapide_tri_auteurs()
	function action_rapide_tri_auteurs($id_article=0) {
		$id = $id_article?$id_article:_request('id_article');
		include_spip('public/assembler'); // pour recuperer_fond(), SPIP 1.92
		$texte = trim(recuperer_fond('fonds/tri_auteurs', array('id_article'=>$id)));
		// syntaxe : ajax_action_auteur($action, $id, $script, $args='', $corps=false, $args_ajax='', $fct_ajax='')
		if(strlen($texte)) {
			include_spip('inc/actions_compat');
			// un clic sur 'monter' ou 'descendre' va permettre une redirection vers
			// les fonctions : boites_privees_URL_objet_exec(), puis action_rapide_tri_auteurs()
			$texte = ajax_action_auteur('action_rapide', 'tri_auteurs', 'articles', "arg=boites_privees|URL_objet&fct=tri_auteurs&id_article=$id#bp_tri_auteurs_corps", $texte);
		}
		// si appel exec, l'id article est nul...
		if(!$id_article) return $texte;
		// ici, 1er affichage !
		if(!strlen($texte)) return '';
		// SPIP 1.92
		if(!defined('_SPIP19300')) return debut_cadre_relief(cs_icone(24), true)
			. cs_div_configuration()
			. "<div class='verdana1' style='text-align: left;'>"
			. block_parfois_visible('bp_ta', '<b>'._T('couteau:tri_auteurs').'</b>', "<div id='bp_tri_auteurs_corps'>$texte</div>", 'text-align: center;')
			. "</div>"
			. fin_cadre_relief(true);
		// SPIP 2.x
		return cadre_depliable(cs_icone(24),
			cs_div_configuration().'<b>'._T('couteau:tri_auteurs').'</b>',
			false,	// true = deplie
			"<div id='bp_tri_auteurs_corps'>$texte</div>",
			'bp_tri_auteurs');
	}
	// Fonction {$outil}_{$arg}_exec() appelee par exec/action_rapide : ?exec=action_rapide&arg=boites_privees|URL_objet (pipe obligatoire)
	// Renvoie un formulaire en partie privee
	function boites_privees_URL_objet_exec() {
	cs_log("INIT : exec_action_rapide_dist() - Preparation du retour par Ajax (donnees transmises par GET)");
		$script = _request('script');
	cs_log(" -- fonction = $fct - script = $script - arg = $arg");
		cs_minipres(!preg_match('/^\w+$/', $script));
		$res = function_exists($fct = 'action_rapide_'._request('fct'))?$fct():'';
	cs_log(" FIN : exec_description_outil_dist() - Appel maintenant de ajax_retour() pour afficher le formulaire de la boite privee");	
		ajax_retour($res);
	}
	// fonction {$outil}_{$arg}_action() appelee par action/action_rapide.php
	function boites_privees_tri_auteurs_action() {
		// boite privee : tri les auteurs d'un article
		$id_article = _request('bp_article');
		$id_auteur = abs(_request('bp_auteur'));
		$monter = _request('bp_auteur')>0;
	
		if(!defined('_SPIP19300')) include_spip('outils/boites_privees'); // pour les fonctions SQL
		$s = sql_select('id_auteur', 'spip_auteurs_articles', "id_article=$id_article");
		$i=0; $j=0;
		while ($a = sql_fetch($s)) {
			if($a['id_auteur']==$id_auteur) { $i = $a['id_auteur']; break; }
			$j = $a['id_auteur'];
		}
	
		if(!$monter && $i && ($a = sql_fetch($s))) $j = $a['id_auteur'];
		spip_log("action_rapide_tri_auteurs, article $id_article : echange entre l'auteur $i et l'auteur $j");
		if($i && $j) {
			sql_update('spip_auteurs_articles', array('id_auteur'=>-99), "id_article=$id_article AND id_auteur=$i");
			sql_update('spip_auteurs_articles', array('id_auteur'=>$i), "id_article=$id_article AND id_auteur=$j");
			sql_update('spip_auteurs_articles', array('id_auteur'=>$j), "id_article=$id_article AND id_auteur=-99");
		}
		// action terminee, pret pour la redirection exec !
		return;
	}
}

?>