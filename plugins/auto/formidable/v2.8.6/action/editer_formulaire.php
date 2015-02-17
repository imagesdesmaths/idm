<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Action de création / Modification d'un formulaire
 * @param unknown_type $arg
 * @return unknown_type
 */
function action_editer_formulaire_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}

	// si id_formulaire n'est pas un nombre, c'est une creation
	if (!$id_formulaire = intval($arg)) {
		$id_formulaire = formulaire_inserer();
	}

	// Enregistre l'envoi dans la BD
	if ($id_formulaire > 0) $err = formulaire_modifier($id_formulaire);

	if (_request('redirect')) {
		$redirect = parametre_url(urldecode(_request('redirect')),
			'id_formulaire', $id_formulaire, '&') . $err;

		include_spip('inc/headers');
		redirige_par_entete($redirect);
	}
	else
		return array($id_formulaire,$err);
}

/**
 * Crée un nouveau formulaire et retourne son ID
 *
 * @return int id_formulaire
 */
function formulaire_inserer() {
	$champs = array(
		'statut' => 'prop',
		'date_creation' => date('Y-m-d H:i:s'),
	);
	// Envoyer aux plugins
	$champs = pipeline('pre_insertion',
		array(
			'args' => array(
				'table' => 'spip_formulaires',
			),
			'data' => $champs
		)
	);
	$id_formulaire = sql_insertq("spip_formulaires", $champs);

	pipeline('post_insertion',
		array(
			'args' => array(
				'table' => 'spip_formulaires',
				'id_objet' => $id_formulaire
			),
			'data' => $champs
		)
	);

	return $id_formulaire;
}

/**
 * Appelle la fonction de modification d'un formulaire
 *
 * @param int $id_formulaire
 * @param array|null $set
 * @return string
 */
function formulaire_modifier($id_formulaire, $set=null) {
	include_spip('inc/modifier');
	include_spip('inc/filtres');
	$err = '';

	$c = collecter_requests(
		// white list
		objet_info('formulaire','champs_editables'),
		// black list
		array('statut'),
		// donnees eventuellement fournies
		$set
	);


	$invalideur = "id='id_formulaire/$id_formulaire'";
	if ($err = objet_modifier_champs('formulaire', $id_formulaire,
		array(
			'nonvide' => array('titre' => _T('info_sans_titre')),
			'invalideur' => $invalideur,
		),
		$c))
		return $err;

	// Modification de statut, changement de rubrique ?
	$c = collecter_requests(array('statut'),array(),$set);
	include_spip("action/editer_objet");
	$err = objet_instituer('formulaire',$id_formulaire, $c);

	return $err;
}



function revision_formulaire($id_formulaire, $c=false) { return formulaire_modifier($id_formulaire, $c);}
function insert_formulaire() {	return formulaire_inserer();}
function formulaire_set($id_formulaire, $set=null) {	return formulaire_modifier($id_formulaire, $set);}
