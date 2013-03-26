<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/formidable');

function formulaires_editer_formulaire_traitements_charger($id_formulaire){
	$contexte = array();
	$id_formulaire = intval($id_formulaire);
	
	// On teste si le formulaire existe
	if ($id_formulaire
		and $formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = '.$id_formulaire)
		and autoriser('editer', 'formulaire', $id_formulaire)
	){
		$traitements = unserialize($formulaire['traitements']);
		$saisies = unserialize($formulaire['saisies']);
		if (!is_array($traitements)) $traitements = array();
		if (!is_array($saisies)) $saisies = array();
		$contexte['traitements'] = $traitements;
		$contexte['traitements_choisis'] = array_keys($traitements);
		$contexte['formulaire'] = _T_ou_typo($saisies, 'multi');
		$contexte['id'] = $id_formulaire;
		
		$traitements_disponibles = traitements_lister_disponibles();
		$configurer_traitements = array();
		foreach ($traitements_disponibles as $type_traitement => $traitement){
			$configurer_traitements[] = array(
				'saisie' => 'checkbox',
				'options' => array(
					'nom' => 'traitements_choisis',
					'label' => $traitement['titre'],
					'datas' => array(
						$type_traitement => $traitement['description']
					)
				)
			);
			$configurer_traitements[] = array(
				'saisie' => 'fieldset',
				'options' => array(
					'nom' => 'options',
					'label' => $traitement['titre'],
					'li_class' => "$type_traitement options_traiter"
				),
				'saisies' => saisies_transformer_noms($traitement['options'], '/^.*$/', "traitements[$type_traitement][\\0]")
			);
		}
		$contexte['_configurer_traitements'] = $configurer_traitements;
		
		// Si on demande un avertissement et qu'il y a déjà des traitements de configurés
		if (_request('avertissement') == 'oui')
			$contexte['message_ok'] = $traitements ? _T('formidable:traitements_avertissement_modification') : _T('formidable:traitements_avertissement_creation');
	}
	else{
		$contexte['editable'] = false;
	}
	
	// On enlève l'éventuel avertissement pour le prochain envoi
	$contexte['action'] = parametre_url(self(), 'avertissement', '');
	
	return $contexte;
}

function formulaires_editer_formulaire_traitements_verifier($id_formulaire){
	include_spip('inc/saisies');
	$erreurs = array();
	$traitements_disponibles = traitements_lister_disponibles();
	
	// On regarde quels traitements sont demandés
	$traitements_choisis = _request('traitements_choisis');
	
	if (is_array($traitements_choisis))
		foreach ($traitements_choisis as $type_traitement){
			$erreurs = array_merge($erreurs, saisies_verifier(saisies_transformer_noms($traitements_disponibles[$type_traitement]['options'], '/^.*$/', "traitements[$type_traitement][\\0]")));
		}
	
	return $erreurs;
}

function formulaires_editer_formulaire_traitements_traiter($id_formulaire){
	$retours = array();
	$id_formulaire = intval($id_formulaire);
	
	// On récupère tout le tableau des traitements
	$traitements = _request('traitements');
	// On ne garde que les morceaux qui correspondent aux traitements choisis
	$traitements_choisis = _request('traitements_choisis');
	if (!$traitements_choisis) $traitements_choisis = array();
	$traitements_choisis = array_flip($traitements_choisis);
	$traitements = array_intersect_key($traitements, $traitements_choisis);
	
	// Et on l'enregistre tel quel
	$ok = sql_updateq(
		'spip_formulaires',
		array(
			'traitements' => serialize($traitements)
		),
		'id_formulaire = '.$id_formulaire
	);
	
	// On va sur la page de visualisation quand c'est fini
	if ($ok){
		$retours['redirect'] = parametre_url(generer_url_ecrire('formulaire'), 'id_formulaire', $id_formulaire);
	}
	else{
		$retours['editable'] = true;
		$retours['message_erreur'] = _T('formidable:erreur_base');
	}
	
	return $retours;
}

?>
