<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Romy Tetue
 * Licence GPL
 * 
 */

$GLOBALS['exception_des_connect'][] = 'pour';
$GLOBALS['exception_des_connect'][] = 'condition';

/* le critere {tableau ...} des boucles pour:POUR */
function critere_POUR_tableau_dist($idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];
	if (isset($crit->param[0])){
		$table = calculer_liste($crit->param[0], array(), $boucles, $boucle->id_parent);
		$boucle->having[]=array("'tableau'",$table);
	}
}

/* le critere {si ...} des boucles condition:CONDITION */
function critere_CONDITION_si_dist($idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];
	if (isset($crit->param[0])){
		$si = calculer_liste($crit->param[0], array(), $boucles, $boucle->id_parent);
		$boucle->having[]='($test='.$si.')?array(\'tableau\',\'1:1\'):\'\'';
	}
}

/**
 * http://www.spip-contrib.net/Classer-les-articles-par-nombre-de#forum409210
 * Permet de faire un comptage par table liee
 * exemple
 * <BOUCLE1(AUTEURS){compteur articles}{par compteur_articles}>
 * #ID_AUTEUR : #COMPTEUR{articles}
 * </BOUCLE1>
 * pour avoir les auteurs classes par articles et le nombre d'article de chacun
 *
 * @param unknown_type $idb
 * @param unknown_type $boucles
 * @param unknown_type $crit
 */
function critere_compteur($idb, &$boucles, $crit, $left=false){
	$boucle = &$boucles[$idb];

	$_fusion = calculer_liste($crit->param[1], array(), $boucles, $boucle->id_parent);
	$params = $crit->param;
	$table = reset($params);
	$table = $table[0]->texte;
	$op = false;
	if(preg_match(',^(\w+)([<>=])([0-9]+)$,',$table,$r)){
		$table=$r[1];
		if (count($r)>=3) $op=$r[2];
		if (count($r)>=4) $op_val=$r[3];
	}
	$type = objet_type($table);
	$type_id = id_table_objet($type);
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
	$_fusion = calculer_liste($crit->param[1], array(), $boucles, $boucle->id_parent);

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

/**
 * {tri [champ_par_defaut][,sens_par_defaut][,nom_variable]}
 * champ_par_defaut : un champ de la table sql
 * sens_par_defaut : -1 ou inverse pour decroissant, 1 ou direct pour croissant
 * nom_variable : nom de la variable utilisee (par defaut tri_nomboucle)
 * 
 * {tri titre}
 * {tri titre,inverse}
 * {tri titre,-1}
 * {tri titre,-1,truc}
 * 
 * @param unknown_type $idb
 * @param unknown_type $boucles
 * @param unknown_type $crit
 */
function critere_tri_dist($idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];
	$id_table = $boucle->id_table;

	// definition du champ par defaut
	$_champ_defaut = !isset($crit->param[0][0]) ? "''" : calculer_liste(array($crit->param[0][0]), array(), $boucles, $boucle->id_parent);
	$_sens_defaut = !isset($crit->param[1][0]) ? "1" : calculer_liste(array($crit->param[1][0]), array(), $boucles, $boucle->id_parent);
	$_variable = !isset($crit->param[2][0]) ? "'$idb'" : calculer_liste(array($crit->param[2][0]), array(), $boucles, $boucle->id_parent);

	$_tri = "((\$t=(isset(\$Pile[0]['tri'.$_variable]))?\$Pile[0]['tri'.$_variable]:$_champ_defaut)?tri_protege_champ(\$t):'')";
	
	$_sens_defaut = "(is_array(\$s=$_sens_defaut)?(isset(\$s[\$st=$_tri])?\$s[\$st]:reset(\$s)):\$s)";
	$_sens ="((intval(\$t=(isset(\$Pile[0]['sens'.$_variable]))?\$Pile[0]['sens'.$_variable]:$_sens_defaut)==-1 OR \$t=='inverse')?-1:1)";

	$boucle->modificateur['tri_champ'] = $_tri;
	$boucle->modificateur['tri_sens'] = $_sens;
	$boucle->modificateur['tri_nom'] = $_variable;
	// faut il inserer un test sur l'existence de $tri parmi les champs de la table ?
	// evite des erreurs sql, mais peut empecher des tri sur jointure ...
	$boucle->hash .= "
	\$senstri = '';
	\$tri = $_tri;
	if (\$tri){
		\$senstri = $_sens;
		\$senstri = (\$senstri<0)?' DESC':'';
	};
	";
	$field = serialize(array_keys($boucle->show['field']));
	$boucle->select[] = "\".tri_champ_select(\$tri).\"";
	$boucle->order[] = "tri_champ_order(\$tri,'$id_table','$field').\$senstri";
}

/**
 * Trouver toutes les objets qui ont des enfants (les noeuds de l'arbre)
 * {noeud}
 * {!noeud} retourne les feuilles
 *
 * @global array $exceptions_des_tables
 * @param string $idb
 * @param array $boucles
 * @param <type> $crit
 */
function critere_noeud_dist($idb, &$boucles, $crit) {
	global $exceptions_des_tables;
	$not = $crit->not;
	$boucle = &$boucles[$idb];
	$primary = $boucle->primary;

	if (!$primary OR strpos($primary,',')) {
		erreur_squelette(_T('zbug_doublon_sur_table_sans_cle_primaire'), "BOUCLE$idb");
		return;
	}
	$table = $boucle->type_requete;
	$table_sql = table_objet_sql(objet_type($table));

	$id_parent = isset($exceptions_des_tables[$boucle->id_table]['id_parent']) ?
		$exceptions_des_tables[$boucle->id_table]['id_parent'] :
		'id_parent';

	$in = "IN";
	$where= array("'IN'", "'$boucle->id_table." . "$primary'","'('.sql_get_select('$id_parent', '$table_sql').')'");
	if ($not)
		$where = array("'NOT'",$where);

	$boucle->where[]= $where;
}

/**
 * Trouver toutes les objets qui n'ont pas d'enfants (les feuilles de l'arbre)
 * {feuille}
 * {!feuille} retourne les noeuds
 *
 * @global array $exceptions_des_tables
 * @param string $idb
 * @param array $boucles
 * @param <type> $crit
 */
function critere_feuille_dist($idb, &$boucles, $crit) {
	$not = $crit->not;
	$crit->not = $not ? false:true;
	critere_noeud_dist($idb,$boucles,$crit);
	$crit->not = $not;
}

?>
