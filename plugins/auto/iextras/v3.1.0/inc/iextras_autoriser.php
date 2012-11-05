<?php

/**
 * Déclaration d'autorisations pour l'interface des champs extras
 *
 * @package SPIP\Iextras\Autorisations
**/

// sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Fonction d'appel pour le pipeline autoriser
 * @pipeline autoriser
 */
function iextras_autoriser(){}

/**
 * Autorisation de configurer les champs extras
 *
 * Il faut être webmestre !
 * 
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_iextras_configurer_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('webmestre', $type, $id, $qui, $opt);
}

