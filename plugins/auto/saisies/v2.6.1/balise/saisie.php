<?php

/**
 * Déclaration de la classe `Pile` et de la balise `#SAISIE`
 *
 * @package SPIP\Saisies\Balises
**/

if (!defined("_ECRIRE_INC_VERSION")) return;

// pour ne pas interferer avec d'eventuelles futures fonctions du core
// on met le tout dans une classe ; les fonctions sont autonomes.

/**
 * Conteneur pour modifier les arguments d'une balise SPIP (de classe Champ) à compiler
 *
 * @note
 *     Ces fonctions visent à modifier l'AST (Arbre de Syntaxe Abstraite) issues
 *     de l'analyse du squelette. Très utile pour créer des balises qui
 *     transmettent des arguments supplémentaires automatiquement, à des balises
 *     déjà existantes.
 *     Voir un exemple d'utilisation dans `balise_SAISIE_dist()`.
 * 
 * @note
 *     Les arguments sont stockés sont dans l'entree 0 de la propriété `param`
 *     dans l'objet Champ (représenté par `$p`), donc dans `$p->param[0]`.
 * 
 *     `param[0][0]` vaut toujours '' (ou presque ?)
 *
 * @see balise_SAISIE_dist() Pour un exemple d'utilisation
**/
class Pile {


	/**
	 * Récupère un argument de balise
	 * 
	 * @param int $pos
	 * @param Champ $p
	 * @return mixed|null Élément de l'AST représentant l'argument s'il existe
	**/
	static function recuperer_argument_balise($pos, $p) {
		if (!isset($p->param[0])) {
			return null;
		}
		if (!isset($p->param[0][$pos])) {
			return null;
		}
		return $p->param[0][$pos];
	}

	/**
	 * Supprime un argument de balise
	 *
	 * @param int $pos
	 * @param Champ $p
	 * @return Champ
	**/
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


	/**
	 * Retourne un argument de balise, et le supprime de la liste des arguments
	 *
	 * @uses Pile::recuperer_argument_balise()
	 * @uses Pile::supprimer_argument_balise()
	 * 
	 * @param int $pos
	 * @param Champ $p
	 * @return mixed|null Élément de l'AST représentant l'argument s'il existe
	**/
	static function recuperer_et_supprimer_argument_balise($pos, &$p) {
		$arg = Pile::recuperer_argument_balise($pos, $p);
		$p   = Pile::supprimer_argument_balise($pos, $p);
		return $arg;
	}


	/**
	 * Ajoute un argument de balise
	 *
	 * Empile l'argument à la suite des arguments déjà existants pour la balise
	 * 
	 * @param mixed $element Élément de l'AST représentant l'argument à ajouter
	 * @param Champ $p
	 * @return Champ
	**/
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


	/**
	 * Crée l'élément de l'AST représentant un argument de balise.
	 *
	 * @example
	 *     ```
	 *     $nom = Pile::creer_argument_balise(nom);           // {nom}
	 *     $nom = Pile::creer_argument_balise(nom, 'coucou'); // {nom=coucou}
	 *     
	 *     $balise = Pile::creer_balise('BALISE');
	 *     $nom = Pile::creer_argument_balise(nom, $balise);  // {nom=#BALISE}
	 *     ```
	 * 
	 * @param string $nom
	 *     Nom de l'argument
	 * @param string|object $valeur
	 *     Valeur de l'argument. Peut être une chaîne de caractère ou un autre élément d'AST
	 * @return array
	**/
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


	/**
	 * Crée et ajoute un argument à une balise
	 *
	 * @uses Pile::creer_argument_balise()
	 * @uses Pile::ajouter_argument_balise()
	 * 
	 * @param Champ $p
	 * @param string $nom
	 *     Nom de l'argument
	 * @param string|object $valeur
	 *     Valeur de l'argument. Peut être une chaîne de caractère ou un autre élément d'AST
	 * @return Champ
	**/
	static function creer_et_ajouter_argument_balise($p, $nom, $valeur = null) {
		$new = Pile::creer_argument_balise($nom, $valeur); 
		return Pile::ajouter_argument_balise($new, $p);
	}



	/**
	 * Crée l'AST d'une balise
	 *
	 * @example
	 *     ```
	 *     // Crée : #ENV*{titre}
	 *     $titre = Pile::recuperer_argument_balise(1, $p); // $titre, 1er argument de la balise actuelle 
	 *     $env = Pile::creer_balise('ENV', array('param' => array($titre), 'etoile' => '*'));
	 *     ```
	 * 
	 * @param string $nom
	 *     Nom de la balise
	 * @param array $opt
	 *     Options (remplira les propriétés correspondantes de l'objet Champ)
	 * @return Champ
	**/
	static function creer_balise($nom, $opt = array()) {
		include_spip('public/interfaces');
		$b = new Champ;
		$b->nom_champ = strtoupper($nom);
		foreach ($opt as $o=>$val) {
			if (property_exists($b,$o)) {
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



/**
 * Compile la balise `#SAISIE` qui retourne le code HTML de la saisie de formulaire indiquée.
 *
 * Cette balise incluera le squelette `saisies/_base.html` et lui-même `saisies/{type}.html`
 *
 * La balise `#SAISIE` est un raccourci pour une écriture plus compliquée de la balise `#INCLURE`.
 * La balise calcule une série de paramètre récupérer et à transmettre à `#INCLURE`,
 * en fonction des valeurs des 2 premiers paramètres transmis.
 * 
 * Les autres arguments sont transmis tels quels à la balise `#INCLURE`.
 *
 * Ainsi `#SAISIE{input,nom,label=Nom,...}` exécutera l'équivalent de
 * `#INCLURE{nom=nom,valeur=#ENV{nom},type_saisie=input,erreurs,fond=saisies/_base,label=Nom,...}`
 *
 * @syntaxe `#SAISIE{type,nom[,option=xx,...]}`
 *
 * @uses Pile::recuperer_et_supprimer_argument_balise()
 * @uses Pile::creer_balise()
 * @uses Pile::creer_et_ajouter_argument_balise()
 * @see balise_INCLURE_dist()
 *
 * @param Champ $p
 * @return Champ
 */
function balise_SAISIE_dist($p) {

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
	if (function_exists('balise_INCLURE')) {
		return balise_INCLURE($p);
	} else {
		return balise_INCLURE_dist($p);
	}
}


