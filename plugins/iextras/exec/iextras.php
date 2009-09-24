<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');

function exec_iextras_dist(){
	global $spip_lang_right;
	// si pas autorise : message d'erreur
	if (!autoriser('configurer', 'iextras')) {
		include_spip('inc/minipres');
		echo minipres();
		die();
	}

	// pipeline d'initialisation
	pipeline('exec_init', array('args'=>array('exec'=>'iextras'),'data'=>''));

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
	echo cadre_champs_extras_infos();
	echo pipeline('affiche_gauche', array('args'=>array('exec'=>'iextras'),'data'=>''));
	
	// colonne droite
	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite', array('args'=>array('exec'=>'iextras'),'data'=>''));
	
	// centre
	echo debut_droite('', true);

	// contenu
	include_spip('inc/iextras');
	include_spip('inc/cextras_gerer');
	echo recuperer_fond('prive/contenu/champs_extras', array(
		'extras'=>iextras_get_extras_par_table(),
		'noms_tables'=>cextras_objets_valides()
	));
	echo recuperer_fond('prive/contenu/champs_extras_possibles', array(
		'extras'=>extras_champs_utilisables(),
		'noms_tables'=>cextras_objets_valides()
	));
			
	echo icone_inline(_T('iextras:icone_creer_champ_extra'), generer_url_ecrire("iextras_edit"), find_in_path("images/iextras-24.png"), "creer.gif", $spip_lang_right);
	// fin contenu

	echo pipeline('affiche_milieu', array('args'=>array('exec'=>'iextras'),'data'=>''));

	echo fin_gauche(), fin_page();
}

// afficher les informations de la page
function cadre_champs_extras_infos() {
	$boite = pipeline ('boite_infos', array('data' => '',
		'args' => array(
			'type'=>'champs_extras',
		)
	));

	if ($boite)
		return debut_boite_info(true) . $boite . fin_boite_info(true);	
}

?>
