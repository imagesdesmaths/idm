<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// pour ne pas interferer avec d'eventuelles futures fonctions du core
// on met le tout dans un namespace ; les fonctions sont autonomes.

class Pile {


	// les arguments sont dans l'entree 0 du tableau param.
	// param[0][0] vaut toujours '' (ou presque ?)
	static function recuperer_argument_balise($pos, $p) {
		if (!isset($p->param[0])) {
			return null;
		}
		if (!isset($p->param[0][$pos])) {
			return null;
		}	
		return $p->param[0][$pos];
	}
	
	
	
	// les arguments sont dans l'entree 0 du tableau param.
	// param[0][0] vaut toujours '' (ou presque ?)
	static function supprimer_argument_balise($pos, $p) {
		if (!isset($p->param[0])) {
			return null;
		}
		if (!isset($p->param[0][$pos])) {
			return null;
		}	
		if ($pos == 0) {
			array_shift($p->param[0]);
		} else {
			$debut = array_slice($p->param[0], 0, $pos);
			$fin   = array_slice($p->param[0], $pos+1);
			$p->param[0] = array_merge($debut, $fin);
		}		
		return $p;
	}	
	
	
	
	static function recuperer_et_supprimer_argument_balise($pos, &$p) {
		$arg = Pile::recuperer_argument_balise($pos, $p);
		$p   = Pile::supprimer_argument_balise($pos, $p);
		return $arg;
	}
	
	
	
	
	// les arguments sont dans l'entree 0 du tableau param.
	// param[0][0] vaut toujours '' (ou presque ?)
	static function ajouter_argument_balise($element, $p) {
		if (isset($p->param[0][0])) {
			$zero = array_shift($p->param[0]);
			array_unshift($p->param[0], $element);
			array_unshift($p->param[0], $zero);
		} else {
			if (!is_array($p->param[0])) {
				$p->param[0] = array();
			}
			array_unshift($p->param[0], $element);
		}
		return $p;
	}
	
	
	
	// creer_argument_balise(nom) = {nom}
	// creer_argument_balise(nom, 'coucou') = {nom=coucou}
	// creer_argument_balise(nom, $balise) = {nom=#BALISE}
	static function creer_argument_balise($nom, $valeur = null) {
		include_spip('public/interfaces');
		$s = new Texte;
		$s->texte = $nom;
		$s->ligne=0;
		
		// si #BALISE cree avec Pile::creer_balise(), le mettre en array, comme les autres
		if (is_object($valeur)) {
			$valeur = array($valeur);
		}
		
		$res = null;
		
		// {nom}
		if (is_null($valeur)) {
			$res = array($s);
		} 
		// {nom=coucou}
		elseif (is_string($valeur)) {			
			$s->texte .= "=$valeur";
			$res = array($s);
		}
		// {nom=#BALISE}
		elseif (is_array($valeur)) {
			$s->texte .= "="; // /!\ sans cette toute petite chose, ça ne fait pas d'egalite :)
			$res = array_merge(array($s), $valeur);
		}

		return $res;
	}
	
	
	
	static function creer_et_ajouter_argument_balise($p, $nom, $valeur = null) {
		$new = Pile::creer_argument_balise($nom, $valeur); 
		return Pile::ajouter_argument_balise($new, $p);
	}



	// creer une balise
	static function creer_balise($nom, $opt) {
		include_spip('public/interfaces');
		$b = new Champ;
		$b->nom_champ = strtoupper($nom);
		$vars = get_class_vars('Champ'); // property_exists($b, $o); est en php 5
		foreach ($opt as $o=>$val) {
			#if (property_exists($b,$o)) {
			if (array_key_exists($o, $vars)) {
				if ($o == 'param') {
					array_unshift($val, '');
					$b->$o = array($val);
				} else {
					$b->$o = $val;
				}
			}
		}
		return $b;
	}
}



/* 
 * #saisie{type,nom} : champs obligatoires
 * 
 * collecte des arguments en fonctions du parametre "nom"
 * ajoute des arguments
 * appelle #INCLURE avec les arguments collectes en plus
 * 
 * il faudrait en faire une balise dynamique (?)
 * pour avoir un code plus propre
 * mais je n'ai pas reussi a trouver comment recuperer "valeur=#ENV{$nom}"
 * 
 */
function balise_SAISIE_dist ($p) {

	// on recupere les parametres sans les traduire en code d'execution php
	$type_saisie = Pile::recuperer_et_supprimer_argument_balise(1, $p); // $type
	$titre       = Pile::recuperer_et_supprimer_argument_balise(1, $p); // $titre

	// creer #ENV*{$titre} (* pour les cas de tableau serialises par exemple, que l'on veut reutiliser)
	$env_titre   = Pile::creer_balise('ENV', array('param' => array($titre), 'etoile' => '*')); // #ENV*{titre}

	// on modifie $p pour ajouter des arguments
	// {nom=$titre, valeur=#ENV{$titre}, erreurs, type_saisie=$type, fond=saisies/_base}
	$p = Pile::creer_et_ajouter_argument_balise($p, 'nom', $titre);
	$p = Pile::creer_et_ajouter_argument_balise($p, 'valeur', $env_titre);
	$p = Pile::creer_et_ajouter_argument_balise($p, 'type_saisie', $type_saisie);
	$p = Pile::creer_et_ajouter_argument_balise($p, 'erreurs');
	$p = Pile::creer_et_ajouter_argument_balise($p, 'fond', 'saisies/_base');

	// on appelle la balise #INCLURE
	// avec les arguments ajoutes
	if(function_exists('balise_INCLURE'))
		return balise_INCLURE($p);
	else
		return balise_INCLURE_dist($p);	
		
}




?>
