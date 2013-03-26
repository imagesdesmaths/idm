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
		$id_formulaire = insert_formulaire();
	}

	// Enregistre l'envoi dans la BD
	if ($id_formulaire > 0) $err = formulaire_set($id_formulaire);

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
function insert_formulaire() {
	// Envoyer aux plugins
	$champs = pipeline('pre_insertion',
		array(
			'args' => array(
				'table' => 'spip_formulaires',
			),
			'data' => $champs
		)
	);
	$id_formulaire = sql_insertq("spip_formulaires");

	return $id_formulaire;
}

/**
 * Appelle la fonction de modification d'un formulaire
 *
 * @param int $id_formulaire
 * @param unknown_type $set
 * @return $err
 */
function formulaire_set($id_formulaire, $set=null) {
	include_spip('inc/saisies');
	$err = '';

	$c = array();
	$champs = saisies_lister_champs($GLOBALS['formulaires']['editer_formulaire']);
	foreach ($champs as $champ)
		$c[$champ] = _request($champ,$set);
	
	include_spip('inc/modifier');
	revision_formulaire($id_formulaire, $c);

	return $err;
}

/**
 * Enregistre une révision de formulaire
 *
 * @param int $id_formulaire
 * @param array $c
 * @return
 */
function revision_formulaire($id_formulaire, $c=false) {
	$invalideur = "id='id_formulaire/$id_formulaire'";

	modifier_contenu('formulaire', $id_formulaire,
		array(
			'nonvide' => array('titre' => _T('info_sans_titre')),
			'invalideur' => $invalideur
		),
		$c);

	return ''; // pas d'erreur
}

?>
