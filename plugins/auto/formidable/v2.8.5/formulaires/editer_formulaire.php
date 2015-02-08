<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/saisies');
include_spip('action/editer_liens');
include_spip('inc/config');

function formulaires_editer_formulaire_charger($id_formulaire, $nouveau){
	$id_formulaire = intval($nouveau?0:$id_formulaire);
	include_spip('inc/editer');

	// Est-ce qu'on a le droit ?
	if (!autoriser('editer', 'formulaire', $id_formulaire)){
		$contexte = array();
		$contexte['editable'] = false;
		$contexte['message_erreur'] = _T('formidable:erreur_autorisation');
	}
	else
		$contexte = formulaires_editer_objet_charger('formulaire', $id_formulaire,0,0,'','');
	unset($contexte['id_formulaire']);
	
	return $contexte;
}

function formulaires_editer_formulaire_verifier($id_formulaire, $nouveau){
	$id_formulaire = intval($nouveau?0:$id_formulaire);
	$erreurs = array();

	include_spip('inc/editer');
	$erreurs = formulaires_editer_objet_verifier('formulaire',$id_formulaire,array('titre','identifiant'));

	if (!isset($erreurs['identifiant'])){
		$identifiant = _request('identifiant');
		// format de l'identifiant
		if (!preg_match("/^[\w]+$/",$identifiant))
			$erreurs['identifiant'] = _T('formidable:erreur_identifiant_format');
		// unicite de l'identifiant
		elseif (sql_getfetsel('id_formulaire', 'spip_formulaires', 'identifiant = '.sql_quote($identifiant).' AND id_formulaire != '.intval($id_formulaire)))
			$erreurs['identifiant'] = _T('formidable:erreur_identifiant');
	}

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
			// Tout a fonctionné. En fonction de la config, on attribue l'auteur courant
			$auteurs = lire_config('formidable/analyse/auteur');
			if ($auteurs == 'on') {
				if ($id_auteur = session_get('id_auteur')) {
					// association (par défaut) du formulaire et de l'auteur courant
					objet_associer(array('formulaire'=>$retours['id_formulaire']), array('auteur'=>$id_auteur));
				}
			}
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
