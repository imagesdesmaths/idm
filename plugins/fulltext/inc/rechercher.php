<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2009                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/


if (!defined("_ECRIRE_INC_VERSION")) return;


// Donne la liste des champs/tables ou l'on sait chercher/remplacer
// avec un poids pour le score
// http://doc.spip.org/@liste_des_champs
function liste_des_champs() {
	return
	pipeline('rechercher_liste_des_champs',
		array(
			'article' => array(
				'surtitre' => 5, 'titre' => 8, 'soustitre' => 5, 'chapo' => 3,
				'texte' => 1, 'ps' => 1, 'nom_site' => 1, 'url_site' => 1,
				'descriptif' => 4
			),
			'breve' => array(
				'titre' => 8, 'texte' => 2, 'lien_titre' => 1, 'lien_url' => 1
			),
			'rubrique' => array(
				'titre' => 8, 'descriptif' => 5, 'texte' => 1
			),
			'site' => array(
				'nom_site' => 5, 'url_site' => 1, 'descriptif' => 3
			),
			'mot' => array(
				'titre' => 8, 'texte' => 1, 'descriptif' => 5
			),
			'auteur' => array(
				'nom' => 5, 'bio' => 1, 'email' => 1, 'nom_site' => 1, 'url_site' => 1, 'login' => 1
			),
			'forum' => array(
				'titre' => 3, 'texte' => 1, 'auteur' => 2, 'email_auteur' => 2, 'nom_site' => 1, 'url_site' => 1
			),
			'document' => array(
				'titre' => 3, 'descriptif' => 1, 'fichier' => 1
			),
			'syndic_article' => array(
				'titre' => 5, 'descriptif' => 1
			),
			'signature' => array(
				'nom_email' => 2, 'ad_email' => 4,
				'nom_site' => 2, 'url_site' => 4,
				'message' => 1
			)
		)
	);
}


// Recherche des auteurs et mots-cles associes
// en ne regardant que le titre ou le nom
// http://doc.spip.org/@liste_des_jointures
function liste_des_jointures() {
	return 
	pipeline('rechercher_liste_des_jointures',
			array(
			'article' => array(
				'auteur' => array('nom' => 10),
				'mot' => array('titre' => 3),
				'document' => array('titre' => 2, 'descriptif' => 1)
			),
			'breve' => array(
				'mot' => array('titre' => 3),
				'document' => array('titre' => 2, 'descriptif' => 1)
			),
			'rubrique' => array(
				'mot' => array('titre' => 3),
				'document' => array('titre' => 2, 'descriptif' => 1)
			),
			'document' => array(
				'mot' => array('titre' => 3)
			)
		)
	);
}


function fulltext_keys($table, $prefix=null, $serveur=null) {
	if ($s = spip_query("SHOW CREATE TABLE ".table_objet_sql($table), $serveur)
	AND $t = sql_fetch($s)
	AND $create = array_pop($t)
	AND preg_match_all('/,\s*FULLTEXT\sKEY.*`(.*)`\s+[(](.*)[)]/i', $create, $keys, PREG_SET_ORDER)) {
		$cles = array();
		foreach ($keys as $key) {
			$cle = $key[2];
			if ($prefix)
				$cle = preg_replace(',`.*`,U', $prefix.'.$0', $cle);
			$cles[$key[1]] = $cle;
		}
		spip_log("fulltext $table: ".join(', ',array_keys($cles)),'recherche');
		return $cles;
	}
}

// Effectue une recherche sur toutes les tables de la base de donnees
// options :
// - toutvoir pour eviter autoriser(voir)
// - flags pour eviter les flags regexp par defaut (UimsS)
// - champs pour retourner les champs concernes
// - score pour retourner un score
// On peut passer les tables, ou une chaine listant les tables souhaitees
// http://doc.spip.org/@recherche_en_base
function recherche_en_base($recherche='', $tables=NULL, $options=array(), $serveur='') {
	include_spip('base/abstract_sql');

	if (!is_array($tables)) {
		$liste = liste_des_champs();

		if (is_string($tables)
		AND $tables != '') {
			$toutes = array();
			foreach(explode(',', $tables) as $t)
				if (isset($liste[$t]))
					$toutes[$t] = $liste[$t];
			$tables = $toutes;
			unset($toutes);
		} else
			$tables = $liste;
	}

	include_spip('inc/autoriser');

	// options par defaut
	$options = array_merge(array(
		'preg_flags' => 'UimsS',
		'toutvoir' => false,
		'champs' => false,
		'score' => false,
		'matches' => false,
		'jointures' => false
		),
		$options
	);

	$results = array();

	$recherche_brute = $recherche;

	if (!strlen($recherche) OR !count($tables))
		return array();

	$u = $GLOBALS['meta']['pcre_u'];
	include_spip('inc/charsets');
	$recherche = trim(translitteration($recherche));

	// s'il y a plusieurs mots il faut les chercher tous : oblige REGEXP
	$recherche = preg_replace(',\s+,'.$u, '|', $recherche);

	$preg = '/'.str_replace('/', '\\/', $recherche).'/' . $options['preg_flags'];
	// Si la chaine est inactive, on va utiliser LIKE pour aller plus vite
	// ou si l'expression reguliere est invalide
	if (preg_quote($recherche, '/') == $recherche
	OR (@preg_match($preg,'')===FALSE) ) {
		$methode = 'LIKE';
		$q = sql_quote(
			"%"
			. preg_replace(",\s+,".$u, "%", str_replace(array('%','_'), array('\%', '\_'), $recherche))
			. "%"
		);
		// eviter les parentheses qui interferent avec pcre par la suite (dans le preg_match_all) s'il y a des reponses
		$recherche = str_replace(array('(',')','?'),array('\(','\)', '[?]'),$recherche);
		
		$preg = '/'.preg_replace(",\s+,".$u, ".+", $recherche).'/' . $options['preg_flags'];
	} else {
		$methode = 'REGEXP';
		$q = sql_quote($recherche);
	}

	$jointures = $options['jointures']
		? liste_des_jointures()
		: array();

	foreach ($tables as $table => $champs) {

spip_timer('rech');

		$requete = array(
		"SELECT"=>array(),
		"FROM"=>array(),
		"WHERE"=>array(),
		"GROUPBY"=>array(),
		"ORDERBY"=>array(),
		"LIMIT"=>"",
		"HAVING"=>array()
		);

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

			$r = trim(preg_replace(',\s+,', ' ', strtolower($recherche_brute)));

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
			foreach ($keys as $key) {
				$val = "MATCH($key) AGAINST ($p)";
				// Une chaine exacte rapporte plein de points
				if ($pe)
					$val .= "+ 2 * MATCH($key) AGAINST ($pe)";
				// le poids d'une cle est fonction decroissante de son nombre d'elements
				// ainsi un FULLTEXT sur `titre` vaudra plus que `titre`,`chapo`
				$compteur = preg_match_all(',`.*`,U', $key, $ignore);
				$mult = intval(sqrt(1000/$compteur))/10;
					$val = "($val) * $mult";

				// si symboles booleens les prendre en compte
				if ($boolean = preg_match(', [+-><~]|\* |".*?",', " $r "))
					$val = "MATCH($key) AGAINST ($p IN BOOLEAN MODE) * $mult";
				$score[] = $val;
			}

			// On ajoute la premiere cle FULLTEXT de chaque jointure
			$join = array();
			if (is_array($jointures[$table]))
			foreach(array_keys($jointures[$table]) as $jtable) {
				$i++;
				if ($mkeys = fulltext_keys($jtable, 'obj'.$i, $serveur)) {
					$score[] = "SUM(MATCH(".array_shift($mkeys).") AGAINST ($p".($boolean ?' IN BOOLEAN MODE':'')."))";
					$_id_join = id_table_objet($jtable);
					$table_join = table_objet($jtable);

					if ($jtable == 'document')
						$join[] = "
						LEFT JOIN spip_documents_liens AS lien$i ON (lien$i.id_objet=t.$_id_table AND lien$i.objet='$table')
						LEFT JOIN spip_${table_join} AS obj$i ON lien$i.$_id_join=obj$i.$_id_join
						";
					else
						$join[] = "
						LEFT JOIN spip_${jtable}s_${table}s as lien$i ON lien$i.$_id_table=t.$_id_table
						LEFT JOIN spip_${table_join} AS obj$i ON lien$i.$_id_join=obj$i.$_id_join
						";
				}
			}

			$score = join(' + ', $score).' AS score';
			spip_log($score, 'recherche');

			// si on define(_FULLTEXT_WHERE_$table,'date>"2000")
			// cette contrainte est ajoutee ici:)
			$where = (defined('_FULLTEXT_WHERE_'.$table) AND strlen(constant('_FULLTEXT_WHERE_'.$table)))
				? "\n\t\t\t\tWHERE ".constant('_FULLTEXT_WHERE_'.$table)
				:'';

			$s = spip_query(
				$query =
				"SELECT t.$_id_table, $score
				FROM ".table_objet_sql($table)." AS t
				"
				. join("\n",$join)
				."$where
				GROUP BY t.$_id_table
				ORDER BY score DESC
				LIMIT 0,500"
			);
#			var_dump($query);
#			spip_log($query,'recherche');
			if (!$s) spip_log(mysql_errno().' '.mysql_error()."\n".$query, 'recherche');
#			exit;
		}

		else
		$s = sql_select(
			$requete['SELECT'], $requete['FROM'], $requete['WHERE'],
			implode(" ",$requete['GROUPBY']),
			$requete['ORDERBY'], $requete['LIMIT'],
			$requete['HAVING'], $serveur
		);

		while ($t = sql_fetch($s,$serveur)
		AND (!isset($t['score']) OR $t['score']>0)) {
			$id = intval($t[$_id_table]);

			// FULLTEXT
			if ($fulltext)
				$results[$table][$id]['score'] = $t['score'];
			ELSE
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
					if (!isset($results[$table]))
						$results[$table] = array();
					$results[$table][$id] = array();
					if ($champs_vus)
						$results[$table][$id]['champs'] = $champs_vus;
					if ($score)
						$results[$table][$id]['score'] = $score;
					if ($matches)
						$results[$table][$id]['matches'] = $matches;
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
				if ($jtable == 'document')
					$s = sql_select("id_objet as $it, $ij", "spip_documents_liens", array("objet='$table'",sql_in('id_'.${jtable}, array_keys($jj))), '','','','',$serveur);
				else
					$s = sql_select("$it,$ij", "spip_${jtable}s_${table}s", sql_in('id_'.${jtable}, array_keys($jj)), '','','','',$serveur);
				while ($t = sql_fetch($s)) {
					$id = $t[$it];
					$joint = $jj[$t[$ij]];
					if (!isset($results[$table]))
						$results[$table] = array();
					if (!isset($results[$table][$id]))
						$results[$table][$id] = array();
					if ($joint['score'])
						$results[$table][$id]['score'] += $joint['score'];
					if ($joint['champs'])
					foreach($joint['champs'] as $c => $val)
						$results[$table][$id]['champs'][$jtable.'.'.$c] = $val;
					if ($joint['matches'])
					foreach($joint['matches'] as $c => $val)
						$results[$table][$id]['matches'][$jtable.'.'.$c] = $val;
				}
			}
		}
		spip_log("recherche $table ($recherche_brute) : ".count($results[$table])." resultats ".spip_timer('rech'),'recherche');
	}



	return $results;
}


// Effectue une recherche sur toutes les tables de la base de donnees
// http://doc.spip.org/@remplace_en_base
function remplace_en_base($recherche='', $remplace=NULL, $tables=NULL, $options=array()) {
	include_spip('inc/modifier');

	// options par defaut
	$options = array_merge(array(
		'preg_flags' => 'UimsS',
		'toutmodifier' => false
		),
		$options
	);
	$options['champs'] = true;


	if (!is_array($tables))
		$tables = liste_des_champs();

	$results = recherche_en_base($recherche, $tables, $options);

	$preg = '/'.str_replace('/', '\\/', $recherche).'/' . $options['preg_flags'];

	foreach ($results as $table => $r) {
		$_id_table = id_table_objet($table);
		foreach ($r as $id => $x) {
			if ($options['toutmodifier']
			OR autoriser('modifier', $table, $id)) {
				$modifs = array();
				foreach ($x['champs'] as $key => $val) {
					if ($key == $_id_table) next;
					$repl = preg_replace($preg, $remplace, $val);
					if ($repl <> $val)
						$modifs[$key] = $repl;
				}
				if ($modifs)
					modifier_contenu($table, $id,
						array(
							'champs' => array_keys($modifs),
						),
						$modifs);
			}
		}
	}
}

?>
