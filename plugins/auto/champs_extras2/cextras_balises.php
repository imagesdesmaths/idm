<?php


/**
 * Retourne la classe ChampExtra du champ demande
 * permettant ainsi d'exploiter ses donnees.
 *
 * <BOUCLE_x(TABLE)>
 *  - #CHAMP_EXTRA{nom_du_champ}
 * </BOUCLE_x>
 * 
 * @return ChampExtra
**/
function balise_CHAMP_EXTRA_dist($p) {
	// prendre nom de la cle primaire de l'objet pour calculer sa valeur
	$id_boucle = $p->nom_boucle ? $p->nom_boucle : $p->id_boucle;
	$objet = $p->boucles[$id_boucle]->id_table;
	
	// recuperer les parametres : colonne sql (champ)
	$colonne = interprete_argument_balise(1, $p);
	$demande = sinon(interprete_argument_balise(2, $p), "''");
	$p->code = "calculer_balise_CHAMP_EXTRA('$objet', $colonne, $demande)";
	return $p;
}

// retourne un champ extra donne (sa classe) ou une propriete ou methode demandee
function calculer_balise_CHAMP_EXTRA($objet, $colonne, $demande='') {
	// recuperer la liste des champs extras existants
	include_spip('cextras_pipelines');
	if (!$c = cextras_get_extra($objet, $colonne)) {
		return '';
	}
	if (!$demande) {
		return $c; // retourner ChampExtra (attention, c'est un objet !)
	}
	if (property_exists($c, $demande)) {
		return $c->$demande;
	}
	if (method_exists($c, $demande)) {
		return $c->$demande();
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
	$objet = $p->boucles[$id_boucle]->id_table;
	
	// recuperer les parametres : colonne sql (champ)
	$colonne = interprete_argument_balise(1, $p);
	$separateur = interprete_argument_balise(2, $p);
	if (!$separateur) $separateur = "', '";

	// generer le code d'execution
	$p->code = "calculer_balise_LISTER_CHOIX('$objet', $colonne)";
		
	// retourne un array si #LISTER_CHOIX**
	// sinon fabrique une chaine avec le separateur designe.
	if ($p->etoile != "**") {
		$p->code = "join($separateur, " . $p->code . ")";
	}
	
	return $p;
}


function calculer_balise_LISTER_CHOIX($objet, $colonne) {
	if ($c = calculer_balise_CHAMP_EXTRA($objet, $colonne)) {
		// saisie externe (SAISIES)
		if (isset($c->saisie_parametres['datas']) and $c->saisie_parametres['datas']) {
			return $c->saisie_parametres['datas'];
		}
		// saisie de ce plugin
		if ($c->enum) {
			$enum = cextras_enum_array($c->enum);
			if (!is_array($enum)) {
				$enum = array();
			}
			return $enum;
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
	$objet = $p->boucles[$id_boucle]->id_table;
	$_id_objet = $p->boucles[$id_boucle]->primary;
	$id_objet = champ_sql($_id_objet, $p);

	// recuperer les parametres : colonne sql (champ) et separateur
	$colonne = interprete_argument_balise(1, $p);
	$separateur = interprete_argument_balise(2, $p);
	if (!$separateur) $separateur = "', '";
	
	// demander la colonne dans la requete SQL
	// $colonne doit etre un texte 'nom'
	$texte_colonne = $p->param[0][1][0]->texte;
	$valeur = champ_sql($texte_colonne, $p);
	
	// generer le code d'execution
	$p->code = "calculer_balise_LISTER_VALEURS('$objet', '$_id_objet', $colonne, $id_objet, $valeur)";
	
	// retourne un array si #LISTER_VALEURS**
	// sinon fabrique une chaine avec le separateur designe.
	if ($p->etoile != "**") {
		$p->code = "join($separateur, " . $p->code . ")";
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
	foreach($choix as $cle=>$valeur) {
		if (in_array($cle, $cles)) $vals[$cle] = $valeur;
	}

	// et voici les valeurs !
	return $vals ? $vals : $cles;
}



?>
