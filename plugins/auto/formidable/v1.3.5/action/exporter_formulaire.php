<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function action_exporter_formulaire_dist(){
	include_spip('inc/formidable');
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	
	list($id_formulaire, $type_export) = preg_split('/[\W]/', $arg);
	
	if ($id_formulaire > 0
		and $type_export
		and $types_echange = echanges_formulaire_lister_disponibles()
		and $exporter = $types_echange['exporter'][$type_export]
	){
		$exporter($id_formulaire);
	}
}

?>
