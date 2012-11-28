<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/* 
 * #VOIR_SAISIE{type,nom} : champs obligatoires
 * 
 * collecte des arguments en fonctions du parametre "nom"
 * ajoute des arguments
 * appelle #INCLURE avec les arguments collectes en plus
 * 
 */
function balise_VOIR_SAISIE_dist ($p) {

	// on recupere les parametres sans les traduire en code d'execution php
	$type_saisie = Pile::recuperer_et_supprimer_argument_balise(1, $p);
	$nom       = Pile::recuperer_et_supprimer_argument_balise(1, $p);

	// creer #ENV*{$titre} (* pour les cas de tableau serialises par exemple, que l'on veut reutiliser)
	$env_nom   = Pile::creer_balise('ENV', array('param' => array($nom), 'etoile' => '*')); // #ENV*{nom}

	// on modifie $p pour ajouter des arguments
	// {nom=$nom, valeur=#ENV{$nom}, type_saisie=$type, fond=saisies/_base}
	$p = Pile::creer_et_ajouter_argument_balise($p, 'nom', $nom);
	$p = Pile::creer_et_ajouter_argument_balise($p, 'valeur', $env_nom);
	$p = Pile::creer_et_ajouter_argument_balise($p, 'type_saisie', $type_saisie);
	$p = Pile::creer_et_ajouter_argument_balise($p, 'fond', 'saisies-vues/_base');

	// on appelle la balise #INCLURE
	// avec les arguments ajoutes
	if(function_exists('balise_INCLURE'))
		return balise_INCLURE($p);
	else
		return balise_INCLURE_dist($p);	
		
}

?>
