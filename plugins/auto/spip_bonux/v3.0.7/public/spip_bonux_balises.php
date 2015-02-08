<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Tetue
 * Licence GPL
 *
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Empile un element dans un tableau declare par #SET{tableau,#ARRAY}
 * #SET_PUSH{tableau,valeur}
 *
 * @param Champ $p : objet balise
 * @return Champ
 *     La balise ne retourne rien ("")
**/
function balise_SET_PUSH_dist($p){
	$_nom = interprete_argument_balise(1,$p);
	$_valeur = interprete_argument_balise(2,$p);

	if ($_nom AND $_valeur)
		// si le tableau n'existe pas encore, on le cree
		// on ajoute la valeur ensuite (sans passer par array_push)
		$p->code = "vide((\$cle=$_nom)
			. vide((!isset(\$Pile['vars'][\$cle]) OR !is_array(\$Pile['vars'][\$cle]))?\$Pile['vars'][\$cle]=array():'')
			. vide(\$Pile['vars'][\$cle][]=$_valeur))";
	else
		$p->code = "''";

	$p->interdire_scripts = false; // la balise ne renvoie rien
	return $p;
}

/**
 * Si 3 arguments : Cree un tableau nom_tableau de t1 + t2
 * #SET_MERGE{nom_tableau,t1,t2}
 * #SET_MERGE{nom_tableau,#GET{tableau},#ARRAY{cle,valeur}}
 *
 * Si 2 arguments : Merge t1 dans nom_tableau
 * #SET_MERGE{nom_tableau,t1}
 * #SET_MERGE{nom_tableau,#GET{tableau}}
 *
 * @param Champ $p : objet balise
 * @return Champ
 *     La balise ne retourne rien ("")
**/
function balise_SET_MERGE_dist($p){
	$_nom = interprete_argument_balise(1,$p);
	$_t1 = interprete_argument_balise(2,$p);
	$_t2 = interprete_argument_balise(3,$p);

	if ($_nom AND $_t1 AND !$_t2)
		// 2 arguments : merge de $_nom et $_t1 dans $_nom
		// si le tableau n'existe pas encore, on le cree
		$p->code = "vide((\$cle=$_nom)
			. vide((!isset(\$Pile['vars'][\$cle]) OR !is_array(\$Pile['vars'][\$cle]))?\$Pile['vars'][\$cle]=array():'')
			. vide(is_array(\$new=$_t1)?'':\$new=array(\$new))
			. vide(\$Pile['vars'][\$cle] = array_merge(\$Pile['vars'][\$cle],\$new)))";
	elseif ($_nom AND $_t1 AND $_t2)
		// 3 arguments : merge de $_t1 et $_t2 dans $_nom
		// si le tableau n'existe pas encore, on le cree
		$p->code = "vide((\$cle=$_nom)
			. vide((!isset(\$Pile['vars'][\$cle]) OR !is_array(\$Pile['vars'][\$cle]))?\$Pile['vars'][\$cle]=array():'')
			. vide(is_array(\$new1=$_t1)?'':\$new1=array(\$new1))
			. vide(is_array(\$new2=$_t2)?'':\$new2=array(\$new2))
			. vide(\$Pile['vars'][\$cle] = array_merge(\$new1,\$new2)))";
	else
		$p->code = "''";

	$p->interdire_scripts = false; // la balise ne renvoie rien
	return $p;
}

/**
 * Balise #COMPTEUR associee au critere compteur
 *
 * @param Champ $p
 * @return Champ
 */
function balise_COMPTEUR_dist($p) {
	calculer_balise_criteres('compteur', $p);
	if ($p->code=="''")
		calculer_balise_criteres('compteur', $p, "compteur_left");
	return $p;
}

/** Balise #SOMME associee au critere somme */
function balise_SOMME_dist($p) {
	return calculer_balise_criteres('somme', $p);
}

/** Balise #COMPTE associee au critere compte */
function balise_COMPTE_dist($p) {
	return calculer_balise_criteres('compte', $p);
}

/** Balise #MOYENNE associee au critere moyenne */
function balise_MOYENNE_dist($p) {
	return calculer_balise_criteres('moyenne', $p);
}

/** Balise #MINIMUM associee au critere moyenne */
function balise_MINIMUM_dist($p) {
	return calculer_balise_criteres('minimum', $p);
}

/** Balise #MAXIMUM associee au critere moyenne */
function balise_MAXIMUM_dist($p) {
	return calculer_balise_criteres('maximum', $p);
}

/** Balise #STATS associee au critere stats
 * #STATS{id_article,moyenne}
 */
function balise_STATS_dist($p) {
	if (isset($p->param[0][2][0])
	AND $nom = ($p->param[0][2][0]->texte)) {
		return calculer_balise_criteres($nom, $p, 'stats');
	}
	return $p;
}

function calculer_balise_criteres($nom, $p, $motif="") {
	$p->code = "''";
	$motif = $motif ? $motif : $nom;
	if (isset($p->param[0][1][0])
	AND $champ = ($p->param[0][1][0]->texte)) {
		return rindex_pile($p, $nom."_$champ", $motif);
	}
  return $p;
}

?>
