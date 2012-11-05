<?php 

/**
 * Gestion de la balise GENERER_SAISIES
 *
 * @package SPIP\Saisies\Balises
 */

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Compile la balise GENERER_SAISIES
 *
 * La balise accepte 1 paramètre qui est une liste de descriptions de saisies
 * dont on veut générer le HTML affichant les champs du formulaires
 *
 * Cette balise est un raccourcis :
 * - #GENERER_SAISIES{#TABLEAU_DE_SAISIES} est équivalent à
 * - #INCLURE{fond=generer_saisies,env,saisies=#TABLEAU_DE_SAISIES}
 *
 * @param Champ $p
 *     Pile au niveau de la balise
 * @return Champ
 *     Pile complété du code à générer
**/
function balise_GENERER_SAISIES_dist($p){

	// On recupere le premier (et seul) argument : le tableau decrivant ce qu'on veut generer
	$config = Pile::recuperer_et_supprimer_argument_balise(1, $p);
	
	// On ajoute le squelette a inclure dans les parametres
	$p = Pile::creer_et_ajouter_argument_balise($p, 'fond', 'inclure/generer_saisies');
	
	// On ajoute l'environnement
	$p = Pile::creer_et_ajouter_argument_balise($p, 'env');
	
	// On ajoute le tableau recupere
	$p = Pile::creer_et_ajouter_argument_balise($p, 'saisies', $config);
	
	// On redirige vers la balise INCLURE
	if(function_exists('balise_INCLURE'))
		return balise_INCLURE($p);
	else
		return balise_INCLURE_dist($p);	

}

?>
