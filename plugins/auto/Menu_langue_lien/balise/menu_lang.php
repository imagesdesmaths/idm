<?php

if (!defined("_ECRIRE_INC_VERSION")) return;	#securite

// #MENU_LANG affiche le menu des langues de l'espace public
// et preselectionne celle la globale $lang
// ou de l'argument fourni: #MENU_LANG{#ENV{malangue}} 

// http://doc.spip.org/@balise_MENU_LANG
function balise_MENU_LANG ($p) {
	$i_boucle = $p->nom_boucle ? $p->nom_boucle : ($p->id_boucle ? $p->id_boucle :'');
	if($i_boucle){
		$_id_objet = $p->boucles[$i_boucle]->primary;
	}
	
	return calculer_balise_dynamique(
		$p,
		'MENU_LANG',
		array(
			'LANG_TYPE_BOUCLE', // demande du type d'objet
			$_id_objet
		)
	);
}

// s'il n'y a qu'une langue eviter definitivement la balise ?php 
// http://doc.spip.org/@balise_MENU_LANG_stat
function balise_MENU_LANG_stat ($args, $context_compil) {
	if (strpos($GLOBALS['meta']['langues_multilingue'],',') === false) return '';
	$objet = $args[0];
	$id_objet = $args[1];
	if ($objet == 'balise_hors_boucle') {
		$objet = '';
		$id_objet = '';
		$id_table_objet ='';
	}else{
		$objet = table_objet($objet);
		$id_table_objet = id_table_objet($objet);
	}
	return array($objet, $id_objet,$id_table_objet);
}

// normalement $opt sera toujours non vide suite au test ci-dessus
// http://doc.spip.org/@balise_MENU_LANG_dyn
function balise_MENU_LANG_dyn($objet,$id_objet,$id_table_objet) {
	include_spip('inc/lang');
	# lien a partir de /
	$cible = parametre_url(self(), 'lang' , '', '&');
	$post = generer_url_action('converser', 'redirect='. rawurlencode($cible), '&');

	return array('formulaires/menu_lang',
		3600,
		array(
			//'nom' => $nom,
			'lang' => $GLOBALS['spip_lang'],
			'url' => $post,
			$id_table_objet => $id_objet
		)
	);
}

// balise type_boucle de Rastapopoulos dans le plugin etiquettes
// present aussi dans plugin ajaxforms...
// bref, a integrer dans le core ? :p
function balise_LANG_TYPE_BOUCLE($p) {
	$type = $p->boucles[$p->id_boucle]->id_table;
	$p->code = $type ? $type : "balise_hors_boucle";
	return $p;
}
?>