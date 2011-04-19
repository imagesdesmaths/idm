<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/


if (!defined('_ECRIRE_INC_VERSION')) return;

// Determiner les tables gerees via spip_xxx_liens
function recherche_tables_liens() {
	if ($GLOBALS['spip_version_base'] >= 16428)
		return array('document', 'auteur', 'mot');
	else
	if ($GLOBALS['spip_version_base'] >= 12008)
		return array('document');
	else
		return array();
}

// methodes sql
function inc_recherche_to_array_dist($recherche, $options=null) {

	$requete = array(
	"SELECT"=>array(),
	"FROM"=>array(),
	"WHERE"=>array(),
	"GROUPBY"=>array(),
	"ORDERBY"=>array(),
	"LIMIT"=>"",
	"HAVING"=>array()
	);

	$options = array_merge(
		array('table' => 'article',
		),
		(array)$options
	);
	$table = $options['table'];
	$serveur = $options['serveur'];

	include_spip('inc/rechercher');

	// s'il n'y a qu'un mot mais <= 3 lettres, il faut le chercher avec une *
	// ex: RFC => RFC* ; car mysql fulltext n'indexe pas ces mots
	if (preg_match('/^\w{1,3}$/', $recherche))
		$recherche .= '*';

	list($methode, $q, $preg) = expression_recherche($recherche, $options);

	$l = liste_des_champs();
	$champs = $l[$table];

	$jointures = $options['jointures']
		? liste_des_jointures()
		: array();

	$_id_table = id_table_objet($table);
	$requete['SELECT'][] = "t.".$_id_table;
	$a = array();
	// Recherche fulltext
	foreach ($champs as $champ => $poids) {
		if (is_array($champ)){
		  spip_log("requetes imbriquees interdites");
		} else {
			if (strpos($champ,".")===FALSE)
				$champ = "t.$champ";
			$requete['SELECT'][] = $champ;
			$a[] = $champ.' '.$methode.' '.$q;
		}
	}
	if ($a) $requete['WHERE'][] = join(" OR ", $a);
	$requete['FROM'][] = table_objet_sql($table).' AS t';

	// FULLTEXT
	$fulltext = false; # cette table est-elle fulltext?
	if ($keys = fulltext_keys($table, 't', $serveur)) {
		$fulltext = true;

		$r = trim(preg_replace(',\s+,', ' ', $recherche));

		// si espace, ajouter la meme chaine avec des guillemets pour ameliorer la pertinence
		$pe = (strpos($r, ' ') AND strpos($r,'"')===false)
			? sql_quote(trim("\"$r\""), $serveur) : '';

		// On utilise la translitteration pour contourner le pb des bases
		// declarees en iso-latin mais remplies d'utf8
		if (($r2 = translitteration($r)) != $r)
			$r .= ' '.$r2;

		$p = sql_quote(trim("$r"), $serveur);

		// On va additionner toutes les cles FULLTEXT
		// de la table
		$score = array();
		foreach ($keys as $name => $key) {
			$val = "MATCH($key) AGAINST ($p)";
			// Une chaine exacte rapporte plein de points
			if ($pe)
				$val .= "+ 2 * MATCH($key) AGAINST ($pe)";

			// Appliquer les ponderations donnees
			// quels sont les champs presents ?
			// par defaut le poids d'une cle est fonction decroissante
			// de son nombre d'elements
			// ainsi un FULLTEXT sur `titre` vaudra plus que `titre`,`chapo`
			$compteur = preg_match_all(',`.*`,U', $key, $ignore);
			$mult = intval(sqrt(1000/$compteur))/10;

			// (Compat ascendante) si un FULLTEXT porte sur un seul champ,
			// ET est nomme de la meme facon : `titre` (`titre`)
			// sa ponderation est eventuellement donnee par la table $liste
			if ($key == "t.`${name}`"
			AND $ponderation = $liste[$table][$name])
				$mult = $ponderation;

			// Appliquer le coefficient multiplicatif
			if ($mult != 1)
				$val = "($val) * $mult";

			// si symboles booleens les prendre en compte
			if ($boolean = preg_match(', [+-><~]|\* |".*?",', " $r "))
				$val = "MATCH($key) AGAINST ($p IN BOOLEAN MODE) * $mult";
			$score[] = $val;
		}

		// On ajoute la premiere cle FULLTEXT de chaque jointure
		$from = array_pop($requete['FROM']);

		if (is_array($jointures[$table]))
		foreach(array_keys($jointures[$table]) as $jtable) {
			$i++;
			if ($mkeys = fulltext_keys($jtable, 'obj'.$i, $serveur)) {
				$score[] = "SUM(MATCH(".array_shift($mkeys).") AGAINST ($p".($boolean ?' IN BOOLEAN MODE':'')."))";
				$_id_join = id_table_objet($jtable);
				$table_join = table_objet($jtable);


				$lesliens = recherche_tables_liens();
				if (in_array($jtable, $lesliens))
					$from .= "
					LEFT JOIN spip_${jtable}s_liens as lien$i ON lien$i.`id_objet`=t.$_id_table AND lien$i.`objet`='${table}'
					LEFT JOIN spip_${jtable}s as obj$i ON obj$i.$_id_join= lien$i.`id_objet`
					";
				else
					$from .= "
					LEFT JOIN spip_${jtable}s_${table}s as lien$i ON lien$i.$_id_table=t.$_id_table
					LEFT JOIN spip_${table_join} AS obj$i ON lien$i.$_id_join=obj$i.$_id_join
					";
			}
		}
		$requete['FROM'][] = $from;
		$score = join(' + ', $score).' AS score';
		spip_log($score, 'recherche');

		// si on define(_FULLTEXT_WHERE_$table,'date>"2000")
		// cette contrainte est ajoutee ici:)
		$requete['WHERE'] = array();
		if (defined('_FULLTEXT_WHERE_'.$table))
			$requete['WHERE'][] = constant('_FULLTEXT_WHERE_'.$table);
		else
			if (!test_espace_prive()
			AND in_array($table, array('article', 'rubrique', 'breve', 'forum', 'syndic_article')))
				$requete['WHERE'][] = "t.statut='publie'";

		// nombre max de resultats renvoyes par l'API
		define('_FULLTEXT_MAX_RESULTS', 500);

		// preparer la requete
		$requete['SELECT'] = array(
			"t.$_id_table"
			,$score
		);

		// popularite ?
		if (true # config : "prendre en compte la popularite
		AND $table == 'article')
			$requete['SELECT'][] = "t.popularite";

		# "t.date"
		# "t.note"

		#array_unshift($requete['FROM'], table_objet_sql($table)." AS t");
		$requete['GROUPBY'] = array("t.$_id_table");
		$requete['ORDERBY'] = "score DESC";
		$requete['LIMIT'] = "0,"._FULLTEXT_MAX_RESULTS;
		$requete['HAVING'] = '';

		#var_dump($requete);
		#spip_log($requete,'recherche');
#			exit;
	}

	$r = array();

	$s = sql_select(
		$requete['SELECT'], $requete['FROM'], $requete['WHERE'],
		implode(" ",$requete['GROUPBY']),
		$requete['ORDERBY'], $requete['LIMIT'],
		$requete['HAVING'], $serveur
	);

	if (!$s) spip_log(mysql_errno().' '.mysql_error()."\n".$recherche, 'recherche');

	while ($t = sql_fetch($s,$serveur)
	AND (!isset($t['score']) OR $t['score']>0)) {
		$id = intval($t[$_id_table]);

		// FULLTEXT
		if ($fulltext) {
			$pts = $t['score'];

			if (isset($t['popularite'])
			AND $mpop = $GLOBALS['meta']['popularite_max'])
				$pts *= (1+$t['popularite']/$mpop);

			$r[$id]['score'] = $pts;

		} ELSE
		// fin FULLTEXT

		if ($options['toutvoir']
		OR autoriser('voir', $table, $id)) {
			// indiquer les champs concernes
			$champs_vus = array();
			$score = 0;
			$matches = array();

			$vu = false;
			foreach ($champs as $champ => $poids) {
				$champ = explode('.',$champ);
				$champ = end($champ);
				if ($n = 
					($options['score'] || $options['matches'])
					? preg_match_all($preg, translitteration_rapide($t[$champ]), $regs, PREG_SET_ORDER)
					: preg_match($preg, translitteration_rapide($t[$champ]))
				) {
					$vu = true;

					if ($options['champs'])
						$champs_vus[$champ] = $t[$champ];
					if ($options['score'])
						$score += $n * $poids;
					if ($options['matches'])
						$matches[$champ] = $regs;

					if (!$options['champs']
					AND !$options['score']
					AND !$options['matches'])
						break;
				}
			}

			if ($vu) {
				$r[$id] = array();
				if ($champs_vus)
					$r[$id]['champs'] = $champs_vus;
				if ($score)
					$r[$id]['score'] = $score;
				if ($matches)
					$r[$id]['matches'] = $matches;
			}
		}
	}


	// Gerer les donnees associees
	if (!$fulltext
	AND isset($jointures[$table])
	AND $joints = recherche_en_base(
			$recherche,
			$jointures[$table],
			array_merge($options, array('jointures' => false))
		)
	) {
		foreach ($joints as $jtable => $jj) {
			$it = id_table_objet($table);
			$ij =  id_table_objet($jtable);
			$lesliens = recherche_tables_liens();
			if (in_array($jtable, $lesliens))
				$s = sql_select("id_objet as $it", "spip_${jtable}s_liens", array("objet='$table'",sql_in('id_'.${jtable}, array_keys($jj))), '','','','',$serveur);
			else
				$s = sql_select("$it,$ij", "spip_${jtable}s_${table}s", sql_in('id_'.${jtable}, array_keys($jj)), '','','','',$serveur);
			while ($t = sql_fetch($s)) {
				$id = $t[$it];
				$joint = $jj[$t[$ij]];
				if (!isset($r))
					$r = array();
				if (!isset($r[$id]))
					$r[$id] = array();
				if ($joint['score'])
					$r[$id]['score'] += $joint['score'];
				if ($joint['champs'])
				foreach($joint['champs'] as $c => $val)
					$r[$id]['champs'][$jtable.'.'.$c] = $val;
				if ($joint['matches'])
				foreach($joint['matches'] as $c => $val)
					$r[$id]['matches'][$jtable.'.'.$c] = $val;
			}
		}
	}

	return $r;
}


?>