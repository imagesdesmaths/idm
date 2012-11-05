<?php

/**
 * Déclaration des autorisations
 * 
 * @package SPIP\Formidable\Autorisations
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Fonction d'appel pour le pipeline
 * @pipeline autoriser
 */
function formidable_autoriser(){}

/**
 * Autorisation d'éditer un formulaire formidable
 *
 * Seuls les admins peuvent éditer les formulaires
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulaire_editer_dist($faire, $type, $id, $qui, $opt){
	if (isset($qui['statut']) and $qui['statut'] <= '0minirezo' and !$qui['restreint']) return true;
	else return false;
}

/**
 * Autorisation de voir la liste des formulaires formidable
 *
 *  Admins et rédacteurs peuvent voir les formulaires existants
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulaires_menu_dist($faire, $type, $id, $qui, $opt){
	if (isset($qui['statut']) and $qui['statut'] <= '1comite') return true;
	else return false;
}



/**
 * Autorisation de répondre à un formidable formidable
 *
 * On peut répondre à un formulaire si :
 * - c'est un formulaire classique
 * - on enregistre et que multiple = oui
 * - on enregistre et que multiple = non et que la personne n'a pas répondu encore
 * - on enregistre et que multiple = non et que modifiable = oui
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulaire_repondre_dist($faire, $type, $id, $qui, $opt){
	// On regarde si il y a déjà le formulaire dans les options
	if (isset($options['formulaire']))
		$formulaire = $options['formulaire'];
	// Sinon on va le chercher
	else{
		$formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = '.$id);
	}
	
	$traitements = unserialize($formulaire['traitements']);
	
	// S'il n'y a pas d'enregistrement, c'est forcément bon
	if (!($options = $traitements['enregistrement']))
		return true;
	// Sinon faut voir les options
	else{
		// Si multiple = oui c'est bon
		if ($options['multiple'])
			return true;
		else{
			// Si c'est modifiable, c'est bon
			if ($options['modifiable'])
				return true;
			else{
				include_spip('inc/formidable');
				// Si la personne n'a jamais répondu, c'est bon
				if (!formidable_verifier_reponse_formulaire($id, $options['identification']))
					return true;
				else
					return false;
			}
		}
	}
}


/**
 * Autorisation d'instituer une réponse
 *
 * On peut modérer une réponse si on est admin
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulaires_reponse_instituer_dist($faire, $type, $id, $qui, $opt){
	if (isset($qui['statut']) and $qui['statut'] <= '0minirezo' and !$qui['restreint']) return true;
	else return false;
}

/**
 * Autorisation de voir les réponses d'un formulaire formidable
 *
 * Au moins rédacteur pour voir les résultats
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulaires_reponse_voir_dist($faire, $type, $id, $qui, $opt){
	if (isset($qui['statut']) and $qui['statut'] <= '1comite') return true;
	else return false;
}

/**
 * Autorisation de supprimer une réponse d'un formulaire formidable
 *
 * Il faut pouvoir éditer un formulaire pour pouvoir en supprimer des réponses
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulaires_reponse_supprimer_dist($faire, $type, $id, $qui, $opt){
	// On récupère l'id du formulaire
	if ($id_formulaire = intval(sql_getfetsel('id_formulaire', 'spip_formulaires_reponses', $id)))
		return autoriser('editer', 'formulaire', $id_formulaire);
	else
		return false;
}

?>
