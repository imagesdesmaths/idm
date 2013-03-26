<?php

/**
 * Déclarations de balises pour les squelettes
 *
 * @package SPIP\Cextras\Fonctions
**/

// sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Retourne la description de la saisie du champ demandé
 * permettant ainsi d'exploiter ses données.
 *
 * @example
 *     ```
 *     <BOUCLE_x(TABLE)>
 *     - #CHAMP_EXTRA{nom_du_champ}
 *     - #CHAMP_EXTRA{nom_du_champ,label}
 *     </BOUCLE_x>
 *     ```
 *
 * @balise CHAMP_EXTRA
 * @note
 *     Lève une erreur de squelette si le nom de champs extras
 *     n'est pas indiqué en premier paramètre de la balise
 * 
 * @param Champ $p
 *     AST au niveau de la balise
 * @return Champ
 *     AST complété par le code PHP de la balise
**/
function balise_CHAMP_EXTRA_dist($p) {
	// prendre nom de la cle primaire de l'objet pour calculer sa valeur
	$id_boucle = $p->nom_boucle ? $p->nom_boucle : $p->id_boucle;
	$objet = $p->boucles[$id_boucle]->id_table;

	// recuperer les parametres : colonne sql (champ)
	if (!$colonne = interprete_argument_balise(1, $p)) {
		$msg = array('zbug_balise_sans_argument', array('balise' => ' CHAMP_EXTRA'));
		erreur_squelette($msg, $p);
	}

	$demande = sinon(interprete_argument_balise(2, $p), "''");
	$p->code = "calculer_balise_CHAMP_EXTRA('$objet', $colonne, $demande)";
	return $p;
}

/**
 * Retourne la description d'un champ extra indiqué
 *
 * Retourne le tableau de description des options de saisies
 * ou un des attributs de ce tableau
 *
 * @param string $objet
 *     Type d'objet
 * @param string $colonne
 *     Nom de la colonne SQL
 * @param string $demande
 *     Nom du paramètre demandé.
 *     Non renseigné, tout le tableau de description est retourné
 * @return mixed
 *     - Tableau si toute la description est demandée
 *     - Indéfini si un élément spécifique de la description est demandé.
 *     - Chaine vide si le champs extra n'est pas trouvé
 */
function calculer_balise_CHAMP_EXTRA($objet, $colonne, $demande='') {
	// Si la balise n'est pas dans une boucle, on cherche un objet explicite dans le premier argument
	// de la forme "trucs/colonne" ou "spip_trucs/colonne"
	if (!$objet and $decoupe = explode('/', $colonne) and count($decoupe) == 2){
		$objet = $decoupe[0];
		$colonne = $decoupe[1];
	}
	
	// recuperer la liste des champs extras existants
	include_spip('cextras_pipelines');
	if (!$saisies = champs_extras_objet( $table = table_objet_sql($objet) )) {
		return '';
	}
	
	include_spip('inc/saisies');
	if (!$saisie = saisies_chercher($saisies, $colonne)) {
		return '';
	}

	if (!$demande) {
		return $saisie['options']; // retourne la description de la saisie...
	}

	if (array_key_exists($demande, $saisie['options'])) {
		return $saisie['options'][$demande];
	}

	return '';
}


/**
 * Retourne les choix possibles d'un champ extra donné
 *
 * @example
 *     ```
 *     #LISTER_CHOIX{champ}
 *     #LISTER_CHOIX{champ, " > "}
 *     #LISTER_CHOIX**{champ} // retourne un tableau cle/valeur
 *     ```
 *
 * @balise LISTER_CHOIX
 * @param Champ $p
 *     AST au niveau de la balise
 * @return Champ
 *     AST complété par le code PHP de la balise
**/
function balise_LISTER_CHOIX_dist($p) {
	// prendre nom de la cle primaire de l'objet pour calculer sa valeur
	$id_boucle = $p->nom_boucle ? $p->nom_boucle : $p->id_boucle;

	// s'il n'y a pas de nom de boucle, on ne peut pas fonctionner
	if (!isset($p->boucles[$id_boucle])) {
		$msg = array('zbug_champ_hors_boucle', array('champ' => ' LISTER_CHOIX'));
		erreur_squelette($msg, $p);
		$p->code = "''";
		return $p;
	}
	
	$objet = $p->boucles[$id_boucle]->id_table;
	
	// recuperer les parametres : colonne sql (champ)
	if (!$colonne = interprete_argument_balise(1, $p)) {
		$msg = array('zbug_balise_sans_argument',	array('balise' => ' LISTER_CHOIX'));
		erreur_squelette($msg, $p);
		$p->code = "''";
		return $p;
	}
	
	$separateur = interprete_argument_balise(2, $p);
	if (!$separateur) $separateur = "', '";

	// generer le code d'execution
	$p->code = "calculer_balise_LISTER_CHOIX('$objet', $colonne)";

	// retourne un array si #LISTER_CHOIX**
	// sinon fabrique une chaine avec le separateur designe.
	if ($p->etoile != "**") {
		$p->code = "(is_array(\$a = $p->code) ? join($separateur, \$a) : " . $p->code . ")";
	}
	
	return $p;
}


/**
 * Retourne les choix possibles d'un champ extra indiqué
 *
 * @param string $objet
 *     Type d'objet
 * @param string $colonne
 *     Nom de la colonne SQL
 * @return string|array
 *     - Tableau des couples (clé => valeur) des choix
 *     - Chaîne vide si le champs extra n'est pas trouvé
 */
function calculer_balise_LISTER_CHOIX($objet, $colonne) {
	if ($options = calculer_balise_CHAMP_EXTRA($objet, $colonne)) {
		if (isset($options['datas']) and $options['datas']) {
			include_spip('inc/saisies');
			return saisies_chaine2tableau($options['datas']);
		}
	}
	return '';
}



/**
 * Liste les valeurs des champs de type liste (enum, radio, case)
 * 
 * Ces champs enregistrent en base la valeur de la clé
 * Il faut donc transcrire clé -> valeur
 *
 * @example
 *     ```
 *     #LISTER_VALEURS{champ}
 *     #LISTER_VALEURS{champ, " > "} 
 *     #LISTER_VALEURS**{champ} // retourne un tableau cle/valeur
 *     ```
 * 
 * @note 
 *     Pour des raisons d'efficacité des requetes SQL
 *     le paramètre "champ" ne peut être calculé
 *     ``#LISTER_VALEURS{#GET{champ}}`` ne peut pas fonctionner.
 * 
 *     Si cette restriction est trop limitative, on verra par la suite
 *     pour l'instant, on laisse comme ca...
 *
 * @balise LISTER_VALEURS
 * @param Champ $p
 *     AST au niveau de la balise
 * @return Champ
 *     AST complété par le code PHP de la balise
 */
function balise_LISTER_VALEURS_dist($p) {
	// prendre nom de la cle primaire de l'objet pour calculer sa valeur
	$id_boucle = $p->nom_boucle ? $p->nom_boucle : $p->id_boucle;

	// s'il n'y a pas de nom de boucle, on ne peut pas fonctionner
	if (!isset($p->boucles[$id_boucle])) {
		$msg = array('zbug_champ_hors_boucle', array('champ' => ' LISTER_VALEURS'));
		erreur_squelette($msg, $p);
		$p->code = "''";
		return $p;
	}
	
	$objet = $p->boucles[$id_boucle]->id_table;
	$_id_objet = $p->boucles[$id_boucle]->primary;
	$id_objet = champ_sql($_id_objet, $p);

	// recuperer les parametres : colonne sql (champ)
	if (!$colonne = interprete_argument_balise(1, $p)) {
		$msg = array('zbug_balise_sans_argument', array('balise' => ' LISTER_VALEURS'));
		erreur_squelette($msg, $p);
		$p->code = "''";
		return $p;
	}
	
	$separateur = interprete_argument_balise(2, $p);
	if (!$separateur) $separateur = "', '";
	
	// demander la colonne dans la requete SQL
	// $colonne doit etre un texte 'nom_du_champ'
	if ($p->param[0][1][0]->type != 'texte') {
		$msg = array('cextras:zbug_balise_argument_non_texte', array('nb'=>1, 'balise' => ' LISTER_VALEURS'));
		erreur_squelette($msg, $p);
		$p->code = "''";
		return $p;
	}
	
	$texte_colonne = $p->param[0][1][0]->texte;
	
	$valeur = champ_sql($texte_colonne, $p);

	// generer le code d'execution
	$p->code = "calculer_balise_LISTER_VALEURS('$objet', $colonne, $valeur)";

	// retourne un array si #LISTER_VALEURS**
	// sinon fabrique une chaine avec le separateur designe.
	if ($p->etoile != "**") {
		$p->code = "(is_array(\$a = $p->code) ? join($separateur, \$a) : " . $p->code . ")";
	}

	return $p;
}


/**
 * Retourne liste des valeurs choisies pour un champ extra indiqué
 *
 * @param string $objet
 *     Type d'objet
 * @param string $colonne
 *     Nom de la colonne SQL
 * @param string $cles
 *     Valeurs enregistrées pour ce champ dans la bdd pour l'objet en cours
 * 
 * @return string|array
 *     - Tableau des couples (clé => valeur) des choix
 *     - Chaîne vide si le champs extra n'est pas trouvé
**/
function calculer_balise_LISTER_VALEURS($objet, $colonne, $cles) {

	// exploser les cles !
	$cles = explode(',', $cles);

	// si pas de cles, on part aussi gentiment
	if (!$cles) return array();

	// recuperer les choix possibles
	$choix = calculer_balise_LISTER_CHOIX($objet, $colonne);

	// sortir gentiment si pas de champs declares
	// on ne peut pas traduire les cles
	if (!$choix) return $cles;

	// correspondances...
	$vals = array_intersect_key($choix, array_flip($cles));

	// et voici les valeurs !
	return $vals ? $vals : $cles;
}



?>
