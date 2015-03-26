<?php

/**
 * Déclaration des autorisations
 *
 * @package SPIP\Formidable\Autorisations
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('action/editer_liens');
include_spip('inc/config');

/**
 * Autorisation par auteur et par formulaire
 *
 * Seuls les auteurs associés à un formulaire peuvent y accéder
 *
 * @param  int   $id        id du formulaire à tester
 * @param  int   $id_auteur id de l'auteur à tester, si ==0 => auteur courant
 * @return bool  true s'il a le droit, false sinon
 *
*/
function formidable_autoriser_par_auteur($id, $id_auteur = 0) {
	if ($id == 0) return true;

	$retour = false;

	if ($id_auteur == 0)
		$id_auteur = session_get('id_auteur');

	if ($id_auteur == null) {
		$retour = false;
	} else {
		$autorisations = objet_trouver_liens(array('formulaire'=>$id),array('auteur'=>$id_auteur));
		$retour = count($autorisations) > 0;
	}

	return $retour;
}

/**
 * Réponses à un formulaire éditable par un auteur
 *
 * Est-on en présence d'un auteur qui tente de modifier les réponses d'un formulaire
 * et que Formidable est configuré pour prendre en compte les auteurs
 * et que les auteurs sont en droit de modifier les réponses de leurs formulaires ?
 *
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @return bool  true s'il a le droit, false sinon
 *
*/
function formidable_auteur_admin_reponse($qui) {
	// L'auteur peut-il administrer les réponses ?
	$admin_reponses_auteur = lire_config('formidable/analyse/admin_reponses_auteur');
	$auteurs = lire_config('formidable/analyse/auteur');
	$is_admin = (isset($qui['statut']) and $qui['statut'] == '0minirezo');
	$retour = ($is_admin or (($auteurs == 'on') and ($admin_reponses_auteur == 'on')));

	return $retour;
}

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
	$auteurs = lire_config('formidable/analyse/auteur');
        
	/* administrateur ? */
	if (isset($qui['statut']) and $qui['statut'] <= '0minirezo' and (count($qui['restreint']) == 0))
		return true;

	/* Test des autorisations par auteur */
	if ($auteurs == 'on') {
		return formidable_autoriser_par_auteur($id);
	}
        
        /* Test des autorisations pour un admin restreint */
        if (count($qui['restreint'])) {
            $autoriser_admin_restreint = isset($GLOBALS['autoriser_admin_restreint']) 
                    ? $GLOBALS['autoriser_admin_restreint'] 
                        : lire_config('formidable/analyse/autoriser_admin_restreint') == 'on' 
                            ? true 
                            : false;
            return $autoriser_admin_restreint;
	}
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
    if (!isset($traitements['enregistrement']) OR !($options = $traitements['enregistrement'])) {
        return true;
    // Sinon faut voir les options
    } else {
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
                if (!formidable_verifier_reponse_formulaire($id))
                    return true;
                else
                    return false;
            }
        }
    }
}

/**
 * Autorisation d'associer un nouvel auteur à un formulaire
 *
 * mêmes autorisations que pour éditer le formulaire
 *
**/
function autoriser_formulaire_associerauteurs_dist($faire, $type, $id, $qui, $opt) {
	return autoriser_formulaire_editer_dist($faire, $type, $id, $qui, $opt);
}

/**
 * Autorisation de modifier un formulaire
 *
 * mêmes autorisations que pour éditer le formulaire
 *
**/
function autoriser_formulaire_modifier_dist($faire, $type, $id, $qui, $opt) {
	return autoriser_formulaire_editer_dist($faire, $type, $id, $qui, $opt);
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
function autoriser_formulairesreponse_instituer_dist($faire, $type, $id, $qui, $opt){
	return formidable_auteur_admin_reponse($qui);
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
function autoriser_formulairesreponse_voir_dist($faire, $type, $id, $qui, $opt){
	return autoriser_formulaire_editer_dist($faire, $type, $id, $qui, $opt);
}

/**
 * Autorisation de modifier une réponse d'un formulaire formidable
 *
 * suivant la config, un administrateur ou l'auteur du formulaire peuvent
 * voir les résultats
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulairesreponse_modifier_dist($faire, $type, $id, $qui, $opt){
    if ($id_formulaire = intval(sql_getfetsel(
			'id_formulaire', 'spip_formulaires_reponses', "id_formulaires_reponse=$id"))) {

		$retour = (autoriser_formulaire_editer_dist($faire, $type, $id_formulaire, $qui, $opt)
				and formidable_auteur_admin_reponse($qui));
	}
	return $retour;
}

/**
 * Autorisation de supprimer une réponse d'un formulaire formidable
 *
 * Il faut pouvoir modifier les réponses d'un formulaire pour pouvoir les en supprimer
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_formulairesreponse_supprimer_dist($faire, $type, $id, $qui, $opt) {
	$retour = autoriser_formulairesreponse_modifier_dist($faire, $type, $id, $qui, $opt);
	return $retour;
}

?>
