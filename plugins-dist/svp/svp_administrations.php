<?php

include_spip('base/create');

function svp_upgrade($nom_meta_base_version, $version_cible){

	$maj = array();

	$install = array('maj_tables', array('spip_depots','spip_plugins','spip_depots_plugins','spip_paquets'));
	$maj['create'][] = $install;
	$maj['0.2'][]    = array('maj_tables', 'spip_paquets');
	$maj['0.3'][]    = array('maj_tables', 'spip_paquets'); // prefixe et attente
	$maj['0.3'][]    = array('svp_synchroniser_prefixe');
	include_spip('inc/svp_depoter_local');
	// on force le recalcul des infos des paquets locaux.
	$maj['0.3.1'][]  = array('svp_actualiser_paquets_locaux', true);

	// autant mettre tout a jour pour avoir une base propre apres renommage extensions=> plugins_dist
	$maj['0.4.0'][] = array('svp_vider_tables', $nom_meta_base_version);
	$maj['0.4.0'][] = $install;

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

function svp_vider_tables($nom_meta_base_version) {
	sql_drop_table("spip_depots");
	sql_drop_table("spip_plugins");
	sql_drop_table("spip_depots_plugins");
	sql_drop_table("spip_paquets");
	effacer_meta($nom_meta_base_version);

	spip_log('DESINSTALLATION BDD', 'svp_actions.' . _LOG_INFO);
}


// ajoute le prefixe des plugins dans chaque ligne de paquets
function svp_synchroniser_prefixe() {
	$paquets = sql_allfetsel(
		array('pa.id_paquet', 'pl.prefixe'),
		array('spip_paquets AS pa', 'spip_plugins AS pl'),
		'pl.id_plugin=pa.id_plugin');

	if ($paquets) {
		// On insere, en encapsulant pour sqlite...
		if (sql_preferer_transaction()) {
			sql_demarrer_transaction();
		}
		
		foreach ($paquets as $paquet) {
			sql_updateq('spip_paquets',
				array('prefixe' => $paquet['prefixe']),
				'id_paquet=' . intval($paquet['id_paquet']));
		}

		if (sql_preferer_transaction()) {
			sql_terminer_transaction();
		}
	}
}
?>
