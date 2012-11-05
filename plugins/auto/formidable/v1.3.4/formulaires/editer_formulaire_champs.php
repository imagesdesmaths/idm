<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;


function formulaires_editer_formulaire_champs_charger($id_formulaire){
	$contexte = array();
	$id_formulaire = intval($id_formulaire);
	
	// On teste si le formulaire existe
	if ($id_formulaire
		and $formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = '.$id_formulaire)
		and autoriser('editer', 'formulaire', $id_formulaire)
	){
		$saisies = unserialize($formulaire['saisies']);
		if (!is_array($saisies)) $saisies = array();
		$contexte['_saisies'] = $saisies;
		$contexte['id'] = $id_formulaire;
	}
	
	return $contexte;
}

function formulaires_editer_formulaire_champs_verifier($id_formulaire){
	include_spip('inc/saisies');
	$erreurs = array();
	
	// Si c'est pas une confirmation ni une annulation
	if (!_request('confirmation') and !($annulation = _request('annulation'))){
		// On récupère le formulaire dans la session
		$saisies_nouvelles = session_get("constructeur_formulaire_formidable_$id_formulaire");
	
		// On récupère les anciennes saisies
		$saisies_anciennes = unserialize(sql_getfetsel(
			'saisies',
			'spip_formulaires',
			'id_formulaire = '.$id_formulaire
		));
	
		// On compare
		$comparaison = saisies_comparer($saisies_anciennes, $saisies_nouvelles);
	
		// S'il y a des suppressions, on demande confirmation avec attention
		if ($comparaison['supprimees'])
			$erreurs['message_erreur'] = _T('saisies:construire_attention_supprime');
	}
	// Si on annule on génère une erreur bidon juste pour réafficher le formulaire
	elseif ($annulation){
		$erreurs['pouetpouet'] = true;
	}
	
	return $erreurs;
}

function formulaires_editer_formulaire_champs_traiter($id_formulaire){
	include_spip('inc/saisies');
	$retours = array();
	$id_formulaire = intval($id_formulaire);
	
	// On récupère le formulaire dans la session
	$saisies_nouvelles = session_get("constructeur_formulaire_formidable_$id_formulaire");
	
	// On récupère les anciennes saisies
	$saisies_anciennes = unserialize(sql_getfetsel(
		'saisies',
		'spip_formulaires',
		'id_formulaire = '.$id_formulaire
	));
	
	// On envoie les nouvelles dans la table dans la table
	$ok = sql_updateq(
		'spip_formulaires',
		array(
			'saisies' => serialize($saisies_nouvelles)
		),
		'id_formulaire = '.$id_formulaire
	);
	
	// Si c'est bon on appelle d'éventuelles fonctions d'update des traitements puis on renvoie vers la config des traitements
	if ($ok){
		// On va chercher les traitements
		$traitements = unserialize(sql_getfetsel(
			'traitements',
			'spip_formulaires',
			'id_formulaire = '.$id_formulaire
		));
		
		// Pour chaque traitements on regarde s'i y a une fonction d'update
		if (is_array($traitements))
			foreach ($traitements as $type_traitement => $traitement){
				if ($update = charger_fonction('update', "traiter/$type_traitement", true)){
					$update($id_formulaire, $traitement, $saisies_anciennes, $saisies_nouvelles);
				}
			}
		
		// On redirige vers la config suivante
		$retours['redirect'] = parametre_url(
			parametre_url(
				parametre_url(
					generer_url_ecrire('formulaire_edit')
					, 'id_formulaire', $id_formulaire
				)
				, 'configurer', 'traitements'
			)
			, 'avertissement', 'oui'
		);
	}
	
	return $retours;
}

?>
