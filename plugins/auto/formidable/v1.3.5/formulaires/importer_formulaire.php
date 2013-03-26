<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/formidable');

function formulaires_importer_formulaire_charger(){
	
	$contexte = array();
	
	// On va chercher toutes les fonctions d'importation existantes
	$types_echange = echanges_formulaire_lister_disponibles();
	$types_import = array();
	foreach ($types_echange['importer'] as $type=>$fonction){
		$types_import[$type] = _T("formidable:echanger_formulaire_${type}_importer");
	}
	
	$contexte['_types_import'] = $types_import;
	
	return $contexte;
}

function formulaires_importer_formulaire_verifier(){
	$erreurs = array();
	
	return $erreurs;
}

function formulaires_importer_formulaire_traiter(){
	$retours = array();
	
	if (!$_FILES['fichier']['error']){
		$type_import = _request('type_import');
		$fichier = $_FILES['fichier']['tmp_name'];
	
		$importer = charger_fonction('importer', "echanger/formulaire/$type_import", true);
		$erreur_ou_id = $importer($fichier);
		
		if (!is_numeric($erreur_ou_id)){
			$retours['message_erreur'] = $erreur;
			$retours['editable'] = true;
		}
		else{
			$id_formulaire = intval($erreur_ou_id);
			$retours['redirect'] = generer_url_ecrire('formulaire', "id_formulaire=$id_formulaire");
		}
	}
	
	return $retours;
}

?>
