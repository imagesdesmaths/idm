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
 * Permet de faire un comptage par table liee
 *
 * @syntaxe `{compteur table[, champ]}`
 * @link http://www.spip-contrib.net/Classer-les-articles-par-nombre-de#forum409210
 * 
 * @example
 *     Pour avoir les auteurs classes par articles et
 *     le nombre d'article de chacun :
 * 
 *     ```
 *     <BOUCLE1(AUTEURS){compteur articles}{par compteur_articles}>
 *     #ID_AUTEUR : #COMPTEUR{articles}
 *     </BOUCLE1>
 *     ```
 *
 * @note
 *     Avec un seul argument {compteur autre_table} le groupby est fait
 *     implicitement sur la cle primaire de la boucle en cours.
 *     Avec un second argument {compteur autre_table,champ_fusion}
 *     le groupby est fait sur le champ_fusion"
 * 
 * @param string $idb
 *     Identifiant de la boucle
 * @param Boucle[] $boucles
 *     AST du squelette
 * @param Critere $crit
 *     Paramètres du critère dans cette boucle
 * @param bool $left
 *     true pour utiliser un left join plutôt qu'un inner join.      
 * @return void
 */
function critere_compteur($idb, &$boucles, $crit, $left=false){
	$boucle = &$boucles[$idb];

	if (isset($crit->param[1])) {
		$_fusion = calculer_liste($crit->param[1], array(), $boucles, $boucle->id_parent);
	} else {
		$_fusion = "''";
	}
	$params = $crit->param;
	$table = reset($params);
	$table = $table[0]->texte;
	$op = false;
	if (preg_match(',^(\w+)([<>=])([0-9]+)$,',$table,$r)){
		$table=$r[1];
		if (count($r)>=3) $op=$r[2];
		if (count($r)>=4) $op_val=$r[3];
	}
	$type = objet_type($table);
	$type_id = id_table_objet($type);
	
	/**
	 * Si la clé primaire est une clé multiple, on prend la première partie
	 * Utile pour compter les versions de spip_versions par exemple
	 */
	if (count($types = explode(',',$type_id)) > 1)
		$type_id = $types[0];
	$table_sql = table_objet_sql($type);

	$trouver_table = charger_fonction('trouver_table','base');
	$arrivee = array($table, $trouver_table($table, $boucle->sql_serveur));
	$depart = array($boucle->id_table,$trouver_table($boucle->id_table, $boucle->sql_serveur));

	// noter les jointures deja installees
	$joins = array_keys($boucle->from);
	if ($compt = calculer_jointure($boucle,$depart,$arrivee)){
		if ($_fusion!="''"){
			// en cas de jointure, on ne veut pas du group_by sur la cle primaire !
			// cela casse le compteur !
			foreach($boucle->group as $k=>$group)
				if ($group == $boucle->id_table.'.'.$boucle->primary)
					unset($boucle->group[$k]);
			$boucle->group[] = '".($gb='.$_fusion.')."';
		}

		$boucle->select[]= "COUNT($compt.$type_id) AS compteur_$table";	
		if ($op)
			$boucle->having[]= array("'".$op."'", "'compteur_".$table."'",$op_val);
		if ($left){
			foreach($boucle->from as $k=>$val){
				if (!in_array($k, $joins)){
					$boucle->from_type[$k] = 'left';
				}
			}
		}
	}
}

/**
 * {compteur_left xxx} permet de faire la meme chose que {compteur xxx}
 * mais avec un LEFT JOIN pour ne pas ignorer ceux qui ont un compteur nul
 * @param <type> $idb
 * @param <type> $boucles
 * @param <type> $crit
 */
function critere_compteur_left($idb, &$boucles, $crit){
	critere_compteur($idb, $boucles, $crit, true);
}

/**  Critere {somme champ} #SOMME{champ} */
function critere_somme($idb, &$boucles, $crit){
	calcul_critere_fonctions(array('SUM'=>'somme'), $idb, $boucles, $crit);
}

/**  Critere {compte champ} #COMPTE{champ} */
function critere_compte($idb, &$boucles, $crit){
	calcul_critere_fonctions(array('COUNT'=>'compte'), $idb, $boucles, $crit);
}

/**  Critere {moyenne champ} #MOYENNE{champ} */
function critere_moyenne($idb, &$boucles, $crit){
	calcul_critere_fonctions(array('AVG'=>'moyenne'), $idb, $boucles, $crit);
}

/**  Critere {minimum champ} #MINIMUM{champ} */
function critere_minimum($idb, &$boucles, $crit){
	calcul_critere_fonctions(array('MIN'=>'minimum'), $idb, $boucles, $crit);
}

/**  Critere {maximum champ} #MAXIMUM{champ} */
function critere_maximum($idb, &$boucles, $crit){
	calcul_critere_fonctions(array('MAX'=>'maximum'), $idb, $boucles, $crit);
}

/**  Critere {stats champ} calcul la totale : somme, compte, minimum, moyenne, maximum */
function critere_stats($idb, &$boucles, $crit){
	calcul_critere_fonctions(array(
		'SUM'=>'somme',
		'COUNT'=>'compte',
		'AVG'=>'moyenne',
		'MIN'=>'minimum',
		'MAX'=>'maximum',
	), $idb, $boucles, $crit);
}

/* $func : array(FUNC => balise) */
function calcul_critere_fonctions($func, $idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];

	$params = $crit->param;
	$champ = reset($params);
	$champ = $champ[0]->texte;

	// option DISTINCT {compte DISTINCT(id_article) }
	$filter="";
	if (preg_match('/^([a-zA-Z]+)\(\s*([a-zA-Z_]+)\s*\)$/', trim($champ), $r)) {
		$filter = $r[1]; // DISTINCT
		$champ = $r[2]; // id_article
	}
	
	$sel = $filter ? "$filter($champ)" : $champ;
	foreach ($func as $f => $as) {
		$boucle->select[]= "$f($sel) AS $as" . "_$champ";
	}
}


?>
