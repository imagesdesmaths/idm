<?php
/**
 * Déclaration de la balise `#CONFIGURER_SAISIE`
 *
 * @package SPIP\Saisies\Balises
 */

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Compile la balise `#CONFIGURER_SAISIE`
 *
 * @uses Pile::recuperer_et_supprimer_argument_balise()
 * @uses Pile::creer_et_ajouter_argument_balise()
 * @see balise_INCLURE_dist()
 *  
 * @param Champ $p
 * @return Champ
**/
function balise_CONFIGURER_SAISIE_dist($p){

	// On recupere le premier argument : le nom de la saisie
	$saisie = Pile::recuperer_et_supprimer_argument_balise(1, $p);

	// On ajoute le squelette a inclure dans les parametres
	$p = Pile::creer_et_ajouter_argument_balise($p, 'fond', 'inclure/configurer_saisie');

	// On ajoute l'environnement
	$p = Pile::creer_et_ajouter_argument_balise($p, 'env');

	// On ajoute le nom recupere
	$p = Pile::creer_et_ajouter_argument_balise($p, 'saisie', $saisie);

	// On redirige vers la balise INCLURE
	if (function_exists('balise_INCLURE')) {
		return balise_INCLURE($p);
	} else {
		return balise_INCLURE_dist($p);
	}

}


