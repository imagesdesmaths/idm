<?php 

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function balise_VOIR_SAISIES_dist($p){

	// On recupere les arguments : les tableaux decrivant ce qu'on veut generer + les reponses
	$saisies = Pile::recuperer_et_supprimer_argument_balise(1, $p);
	$valeurs = Pile::recuperer_et_supprimer_argument_balise(1, $p);
	
	// On ajoute le squelette a inclure dans les parametres
	$p = Pile::creer_et_ajouter_argument_balise($p, 'fond', 'inclure/voir_saisies');
	
	// On ajoute l'environnement
	$p = Pile::creer_et_ajouter_argument_balise($p, 'env');
	
	// On ajoute les tableaux recuperes
	$p = Pile::creer_et_ajouter_argument_balise($p, 'saisies', $saisies);
	$p = Pile::creer_et_ajouter_argument_balise($p, 'valeurs', $valeurs);
	
	// On redirige vers la balise INCLURE
	if(function_exists('balise_INCLURE'))
		return balise_INCLURE($p);
	else
		return balise_INCLURE_dist($p);	

}

?>
