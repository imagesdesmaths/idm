<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/saisies');

function formulaires_editer_formulaire_charger($id_formulaire, $nouveau){
	$contexte = array();
	$editer_formulaire = $GLOBALS['formulaires']['editer_formulaire'];
	$champs = saisies_lister_champs($editer_formulaire);
	$id_formulaire = intval($id_formulaire);
	
	$contexte['_contenu'] = $editer_formulaire;
	
	// Est-ce qu'on a le droit ?
	if (autoriser('editer', 'formulaire')){
		// Est-ce que le formulaire existe ?
		if ($id_formulaire > 0 and $formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = '.$id_formulaire)){
			// Alors on pré-remplit avec les valeurs
			foreach($champs as $champ)
				$contexte[$champ] = $formulaire[$champ];
			$contexte['_action'] = array('editer_formulaire', $id_formulaire);
		}
		// Sinon si c'est une création
		elseif ($nouveau == 'oui'){
			// On déclare juste les champs
			foreach ($champs as $champ)
				$contexte[$champ] = '';
			$contexte['_action'] = array('editer_formulaire', $nouveau);
		}
		// Sinon c'est n'importe quoi
		else{
			$contexte['editable'] = false;
			$contexte['message_erreur'] = 'Erreur dans les parametres.';
		}
	}
	else{
		$contexte['editable'] = false;
		$contexte['message_erreur'] = _T('formidable:erreur_autorisation');
	}
	
	return $contexte;
}

function formulaires_editer_formulaire_verifier($id_formulaire, $nouveau){
	$configurer_formulaire = $GLOBALS['formulaires']['editer_formulaire'];
	$erreurs = saisies_verifier($configurer_formulaire);
	// On vérifie l'unicité de l'identifiant
	if (!$erreurs['identifiant'] and sql_getfetsel('id_formulaire', 'spip_formulaires', 'identifiant = '.sql_quote(_request('identifiant').' and id_formulaire != '.$id_formulaire)))
		$erreurs['identifiant'] = _T('formidable:erreur_identifiant');
	return $erreurs;
}

function formulaires_editer_formulaire_traiter($id_formulaire, $nouveau){
	include_spip('inc/editer');
	$id_formulaire = $id_formulaire ? $id_formulaire : $nouveau;
	$retours = formulaires_editer_objet_traiter('formulaire', $id_formulaire);
	
	// S'il n'y a pas d'erreur et que le formulaire est bien là
	if (!$retours['message_erreur'] and $retours['id_formulaire'] > 0){
		// Si c'était un nouveau on reste sur l'édition
		if (!intval($id_formulaire) and $nouveau == 'oui'){
			$retours['redirect'] = parametre_url(generer_url_ecrire('formulaire_edit'), 'id_formulaire', $retours['id_formulaire'], '&');
		}
		// Sinon on redirige vers la page de visualisation
		else{
			$retours['redirect'] = parametre_url(generer_url_ecrire('formulaire'), 'id_formulaire', $retours['id_formulaire'], '&');
		}
	}
	
	return $retours;
}

?>
