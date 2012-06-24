<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Fonction qui 
 * @return 
 */
function action_charger_plugins_dist() {
	// Securisation: aucun argument attendu

	include_spip('inc/minipres');
	// Autorisation
	if(!autoriser('webmestre')) {
		echo minipres();
		exit;
	}

	$plugins = _request('a_installer');
	$logs = array();
	foreach ($plugins as $_plugin) {
		continue;
	}
	
	include_spip('exec/install');
	echo minipres('Resultats installation', generer_form_ecrire('admin_plugin&voir=tous', serialize($logs) . bouton_suivant()));

	exit;
}
?>
