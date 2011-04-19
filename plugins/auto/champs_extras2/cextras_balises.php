<?php

/*
 * Liste les valeurs des champs de type liste (enum, radio, case)
 * Ces champs enregistrent en base la valeur de la cle
 * Il faut donc transcrire cle -> valeur
 * 
 * #LISTER_VALEURS{champ}
 * #LISTER_VALEURS{champ, " > "} 
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
	// recuperer la liste des champs extras existants
	static $champs = false;
	if ($champs === false) {
		$champs = pipeline('declarer_champs_extras', array());
	}

	// exploser les cles !
	$cles = explode(',', $cles);

	// si pas de cles, on part aussi gentiment
	if (!$cles) return array();
		
	// sortir gentiment si pas de champs declares
	// on ne peut pas traduire les cles
	if (!is_array($champs)) return $cles;
	
	// initialiser les noms corrects d'objet
	$objet = objet_type(table_objet($objet));
	$vals = array();
	
	// on cherche les champs s'appliquant a la meme table	
	foreach ($champs as $c) {
		
		if ($c->enum // sinon pas la peine de continuer
		and $objet == $c->_type // attention aux cas compliques site->syndic !
		and ($colonne == $c->champ)
		and $c->sql) {
			// HOP on a trouve le champs extra
			// il faut calculer le bon retour...
			// comparer $c->enum aux $cles
			
			// 2 possibilites : 
			// - $c->enum = array (plugin) 
			// - $c->enum = string (interface)
			if (is_array($c->enum)) {
				foreach($c->enum as $cle=>$valeur) {
					if (in_array($cle, $cles)) $vals[$cle] = $valeur; // et on suppose que c'est deja traduit
				}
			} else {
				$liste = explode("\n", $c->enum); 
				foreach($liste as $l) {
					list($cle, $valeur) = explode(',', $l, 2);
					if (in_array($cle, $cles)) $vals[$cle] = _T(trim($valeur)); // et on traduit en meme temps...
				}
			}
			// sortir si trouve
			break;
		}
	}
	
	// et voici les valeurs !
	return $vals ? $vals : $cles;
}



?>
