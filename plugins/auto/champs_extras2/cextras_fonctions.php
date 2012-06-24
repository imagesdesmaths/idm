<?php


/**
 * Retourne la classe ChampExtra du champ demande
 * permettant ainsi d'exploiter ses donnees.
 *
 * <BOUCLE_x(TABLE)>
 *  - #CHAMP_EXTRA{nom_du_champ}
 *  - #CHAMP_EXTRA{nom_du_champ,label}
 * </BOUCLE_x>
 * 
 * @return ChampExtra
**/
function balise_CHAMP_EXTRA_dist($p) {
	// prendre nom de la cle primaire de l'objet pour calculer sa valeur
	$id_boucle = $p->nom_boucle ? $p->nom_boucle : $p->id_boucle;
	$objet = $p->boucles[$id_boucle]->id_table;
	
	// recuperer les parametres : colonne sql (champ)
	if (!$colonne = interprete_argument_balise(1, $p)) {
		$msg = array('zbug_balise_sans_argument',	array('balise' => ' CHAMP_EXTRA'));
		erreur_squelette($msg, $p);
	}
		
	$demande = sinon(interprete_argument_balise(2, $p), "''");
	$p->code = "calculer_balise_CHAMP_EXTRA('$objet', $colonne, $demande)";
	return $p;
}

// retourne un champ extra donne (le tableau de description des options de saisies)
// ou un des attributs de ce tableau
function calculer_balise_CHAMP_EXTRA($objet, $colonne, $demande='') {
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
 * #LISTER_CHOIX{champ}
 * #LISTER_CHOIX{champ, " > "}
 * #LISTER_CHOIX**{champ} // retourne un tableau cle/valeur
 * 
 * @return ChampExtra
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


function calculer_balise_LISTER_CHOIX($objet, $colonne) {
	if ($options = calculer_balise_CHAMP_EXTRA($objet, $colonne)) {
		if (isset($options['datas']) and $options['datas']) {
			include_spip('inc/saisies');
			return saisies_chaine2tableau($options['datas']);
		}
	}
	return '';
}



/*
 * Liste les valeurs des champs de type liste (enum, radio, case)
 * Ces champs enregistrent en base la valeur de la cle
 * Il faut donc transcrire cle -> valeur
 * 
 * #LISTER_VALEURS{champ}
 * #LISTER_VALEURS{champ, " > "} 
 * #LISTER_VALEURS**{champ} // retourne un tableau cle/valeur
 * 
 * /!\ 
 * Pour des raisons d'efficacite des requetes SQL
 * le parametre "champ" ne peut etre calcule
 * #LISTER_VALEURS{#GET{champ}} ne peut pas fonctionner.
 * 
 * Si cette restriction est trop limitative, on verra par la suite
 * pour l'instant, on laisse comme ca...
 * 
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
		$msg = array('zbug_balise_sans_argument',	array('balise' => ' LISTER_VALEURS'));
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
	$p->code = "calculer_balise_LISTER_VALEURS('$objet', '$_id_objet', $colonne, $id_objet, $valeur)";
	
	// retourne un array si #LISTER_VALEURS**
	// sinon fabrique une chaine avec le separateur designe.
	if ($p->etoile != "**") {
		$p->code = "(is_array(\$a = $p->code) ? join($separateur, \$a) : " . $p->code . ")";
	}
	
	return $p;
}


// retourne un tableau de la liste des valeurs choisies pour un champ extra de table donne
function calculer_balise_LISTER_VALEURS($objet, $_id_objet, $colonne, $id_objet, $cles) {
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
