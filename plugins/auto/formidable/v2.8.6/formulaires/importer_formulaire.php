<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/formidable');
include_spip('inc/config');

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

		try {
			$erreur_ou_id = $importer($fichier);
		}
		catch (Exception $e){
			$erreur_ou_id = $e->getMessage();
		}

		if (!is_numeric($erreur_ou_id)){
			$retours['message_erreur'] = $erreur_ou_id;
			$retours['editable'] = true;
		}
		else{
			$id_formulaire = intval($erreur_ou_id);
			// Tout a fonctionné. En fonction de la config, on attribue l'auteur courant
			$auteurs = lire_config('formidable/analyse/auteur');
			if ($auteurs == 'on') {
				if ($id_auteur = session_get('id_auteur')) {
					// association (par défaut) du formulaire et de l'auteur courant
					objet_associer(array('formulaire'=>$id_formulaire), array('auteur'=>$id_auteur));
				}
			}
			$retours['redirect'] = generer_url_ecrire('formulaire', "id_formulaire=$id_formulaire");
		}
	}
	
	return $retours;
}

?>
