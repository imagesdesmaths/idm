<?php 

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

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
