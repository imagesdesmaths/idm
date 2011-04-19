<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');

function exec_iextras_edit_dist(){

	// si pas autorise : message d'erreur
	if (!autoriser('configurer', 'iextras')) {
		include_spip('inc/minipres');
		echo minipres();
		die();
	}

	// pipeline d'initialisation
	pipeline('exec_init', array('args'=>array('exec'=>'iextras_edit'),'data'=>''));

	// entetes
	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('iextras:titre_page_iextras'), "configuration", "configuration");
	
	// titre
	echo "<br /><br /><br />\n"; // outch que c'est vilain !
	echo gros_titre(_T('iextras:titre_iextras'),'', false);
	
	// barre d'onglets
	echo barre_onglets("configuration", "iextras");
	
	// colonne gauche
	echo debut_gauche('', true);
	echo pipeline('affiche_gauche', array('args'=>array('exec'=>'iextras_edit'),'data'=>''));
	
	// colonne droite
	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite', array('args'=>array('exec'=>'iextras_edit'),'data'=>''));
	
	// centre
	echo debut_droite('', true);
	
	// contenu
	$extra_id = _request('extra_id');
	$extra_id = $extra_id ? $extra_id : 'new' ;
	echo recuperer_fond('prive/editer/champs_extras', array(
		'extra_id' => $extra_id,
		'titre' => $extra_id=='new' ? _T('iextras:info_nouveau_champ_extra') : _T('iextras:info_modifier_champ_extra'),
		'redirect' => generer_url_ecrire("iextras"),
		'icone_retour' => icone_inline(_T('icone_retour'), generer_url_ecrire('iextras'), find_in_path("images/iextras-24.png"), "rien.gif",$GLOBALS['spip_lang_left']),
		));

	echo pipeline('affiche_milieu', array('args'=>array('exec'=>'iextras_edit'),'data'=>''));

	echo fin_gauche(), fin_page();
}
?>
