<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function echanger_formulaire_yaml_exporter_dist($id_formulaire){
	include_spip('base/abstract_sql');
	include_spip('inc/yaml');
	$id_formulaire = intval($id_formulaire);
	$export = '';
	
	if ($id_formulaire > 0){
		// On récupère le formulaire
		$formulaire = sql_fetsel(
			'*',
			'spip_formulaires',
			'id_formulaire = '.$id_formulaire
		);
		
		// On décompresse les trucs sérialisés
		$formulaire['saisies'] = unserialize($formulaire['saisies']);
		$formulaire['traitements'] = unserialize($formulaire['traitements']);
		
		// On envode en yaml
		$export = yaml_encode($formulaire);
	}
	
	Header("Content-Type: text/x-yaml;");
	Header('Content-Disposition: attachment; filename=formulaire-'.$formulaire['identifiant'].'.yaml');
	Header("Content-Length: ".strlen($export));
	echo $export;
	exit();
}

function echanger_formulaire_yaml_importer_dist($fichier){
	$yaml = '';
	lire_fichier($fichier, $yaml);
	// Si on a bien recupere une chaine on tente de la decoder
	if ($yaml){
		include_spip('inc/yaml');
		$formulaire = yaml_decode($yaml);
		// Si le decodage marche on importe alors le contenu
		if (is_array($formulaire)){
			include_spip('action/editer_formulaire');
			// On enlève les champs inutiles
			unset($formulaire['id_formulaire']);
			// On vérifie que l'identifiant n'existe pas déjà
			$deja = sql_getfetsel(
				'id_formulaire',
				'spip_formulaires',
				'identifiant = '.sql_quote($formulaire['identifiant'])
			);
			if ($deja)
				$formulaire['identifiant'] = $formulaire['identifiant'].'_'.time();
			// On insère un nouveau formulaire
			$id_formulaire = insert_formulaire();
			// Si ça a marché on modifie les champs de base
			if ($id_formulaire > 0 and !($erreur = formulaire_set($id_formulaire, $formulaire))){
				// Et ensuite les saisies et les traitements
				$ok = sql_updateq(
					'spip_formulaires',
					array(
						'saisies' => serialize($formulaire['saisies']),
						'traitements' => serialize($formulaire['traitements'])
					),
					'id_formulaire = '.$id_formulaire
				);
			}
		}
	}
	
	if ($id_formulaire and $ok){
		return $id_formulaire;
	}
	else{
		return _T('formidable:erreur_importer_yaml');
	}
}

?>
