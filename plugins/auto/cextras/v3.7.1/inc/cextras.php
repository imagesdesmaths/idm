<?php

/**
 * Déclaration d'autorisations pour les champs extras
 *
 * @package SPIP\Cextras\Fonctions
**/

// sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * Log une information
 *
 * @param mixed $contenu
 *     Contenu à loger
 * @param bool $important
 *     Est-ce une info importante à loger ?
 */
function extras_log($contenu, $important=false) {
	if ($important) {
		spip_log($contenu, 'extras.'. _LOG_INFO);
	} else {
		spip_log($contenu, 'extras.'. _LOG_INFO_IMPORTANTE);
	}
}


/**
 * Retourne la liste des objets valides utilisables
 *
 * C'est à dire les objets dont on peut afficher les champs dans les
 * formulaires, ce qui correspond aux objets éditoriaux déclarés
 * comme avec l'option principale.
 *
 * @return array
 *    Couples (table sql => description de l'objet éditorial)
 */
function cextras_objets_valides(){

	$objets = array();
	$tables = lister_tables_objets_sql();
	ksort($tables);

	foreach($tables as $table => $desc) {
		if (($desc['editable'] == 'oui') and ($desc['principale'] == 'oui')) {
			$objets[$table] = $desc;
		}
	}

	return $objets;
}



/**
 * Liste les saisies ayant une definition SQL
 *
 * S'assurer de l'absence de clé, qui fait croire à saisies que le tableau est déjà à plat
 * alors que ce n'est pas forcément encore le cas (ie: il peut y avoir des fieldset à prendre
 * en compte).
 * 
 * @param Array $saisies liste de saisies
 * @return array Liste de ces saisies triees par nom ayant une option sql définie
 */
function champs_extras_saisies_lister_avec_sql($saisies) {
	if (!function_exists('saisies_lister_avec_sql')) {
		include_spip('inc/saisies');
	}

	return saisies_lister_avec_sql(array_values($saisies));
}



/**
 * Liste les saisies ayant des traitements
 *
 * Retourne uniquement les saisies ayant traitements à appliquer sur
 * les champs tel que des traitements typo ou traitements raccourcis.
 *
 * @param array $saisies
 *     Liste de saisies
 * @param String $tri
 *     Tri par défaut des résultats (s'ils ne sont pas deja triés) ('nom', 'identifiant')
 * @return array
 *     Liste de ces saisies triées par nom ayant des traitements définis
**/
function saisies_lister_avec_traitements($saisies, $tri = 'nom') {
	return saisies_lister_avec_option('traitements', $saisies, $tri);
}



/**
 * Créer les champs extras (colonnes en base de données)
 * definies par le lot de saisies donné 
 *
 * @param string $table
 *     Nom de la table SQL
 * @param array $saisies
 *     Description des saisies
 * @return bool|void
 *     False si pas de table ou aucune saisie de type SQL
**/
function champs_extras_creer($table, $saisies) {
	if (!$table) {
		return false;
	}
	if (!is_array($saisies) OR !count($saisies)) {
		return false;
	}

	// uniquement les saisies décrivant SQL
	$saisies = champs_extras_saisies_lister_avec_sql($saisies);

	if (!$saisies) {
		return false;
	}

	$desc = lister_tables_objets_sql($table);

	// parcours des saisies et ajout des champs extras nouveaux dans
	// la description de la table
	foreach ($saisies as $saisie) {
		$nom = $saisie['options']['nom'];
		// le champ ne doit pas deja exister !
		if (!isset($desc['field'][$nom])) {
			$desc['field'][$nom] = $saisie['options']['sql'];
		}
	}
	
	// executer la mise a jour
	include_spip('base/create');
	creer_ou_upgrader_table($table, $desc, true, true);
}


/**
 * Supprimer les champs extras (colonne dans la base de données)
 * definies par le lot de saisies donné
 *
 * @param string $table
 *     Nom de la table SQL
 * @param array $saisies
 *     Description des saisies
 * @return bool
 *     False si pas de table, aucune saisie de type SQL, ou une suppression en erreur
 *     True si toutes les suppressions sont OK
**/
function champs_extras_supprimer($table, $saisies) {
	if (!$table) {
		return false;
	}
	if (!is_array($saisies) OR !count($saisies)) {
		return false;
	}

	$saisies = champs_extras_saisies_lister_avec_sql($saisies);

	if (!$saisies) {
		return false;
	}	
	
	$desc = lister_tables_objets_sql($table);

	$ok = true;
	foreach ($saisies as $saisie) {
		$nom = $saisie['options']['nom'];	
		if (isset($desc['field'][$nom])) {
			$ok &= sql_alter("TABLE $table DROP COLUMN $nom");
		}
	}
	return $ok;
}


/**
 * Modifier les champs extras (colonne dans la base de données)
 * definies par le lot de saisies donné   
 *
 * Permet de changer la structure SQL ou le nom de la colonne
 * des saisies
 * 
 * @param string $table
 *     Nom de la table SQL
 * @param array $saisies_nouvelles
 *     Description des saisies nouvelles
 * @param array $saisies_anciennes
 *     Description des saisies anciennes
 * @return bool
 *     True si les changement SQL sont correctement effectués
**/
function champs_extras_modifier($table, $saisies_nouvelles, $saisies_anciennes) {
	$ok = true;
	foreach ($saisies_nouvelles as $id => $n) {
		$n_nom = $n['options']['nom'];
		if (isset($n['options']['sql'])) {
			$n_sql = $n['options']['sql'];
			$a_nom = $saisies_anciennes[$id]['options']['nom'];
			$a_sql = $saisies_anciennes[$id]['options']['sql'];
			if ($n_nom != $a_nom OR $n_sql != $n_sql) {
				$ok &= sql_alter("TABLE $table CHANGE COLUMN $a_nom $n_nom $n_sql");
			}
		}
	}
	return $ok;
}


/**
 * Complète un tableau de mise à jour de plugin afin d'installer les champs extras.
 *
 * @example
 *     ```
 *     cextras_api_upgrade(motus_declarer_champs_extras(), $maj['create']);
 *     ```
 *
 * @param array $declaration_champs_extras
 *     Liste de champs extras à installer, c'est à dire la liste de saisies
 *     présentes dans le pipeline declarer_champs_extras() du plugin qui demande l'installation
 * @param array $maj_item
 *     Un des éléments du tableau d'upgrade $maj,
 *     il sera complété des actions d'installation des champs extras demandés
 * 
 * @return bool
 *     false si les déclarations sont mal formées
 *     true sinon
**/
function cextras_api_upgrade($declaration_champs_extras, &$maj_item) {
	if (!is_array($declaration_champs_extras)) {
		return false;
	}
	if (!is_array($maj_item)) {
		$maj_item = array();
	}
	foreach($declaration_champs_extras as $table=>$champs) {
		$maj_item[] = array('champs_extras_creer',$table, $champs);
	}

	return true;
}


/**
 * Supprime les champs extras declarés
 *
 * @example
 *     ```
 *     cextras_api_vider_tables(motus_declarer_champs_extras());
 *     ```
 * 
 * @param array $declaration_champs_extras
 *     Liste de champs extras à désinstaller, c'est à dire la liste de saisies
 *     présentes dans le pipeline declarer_champs_extras() du plugin qui demande la désinstallation
 * 
 * @return bool
 *     false si déclaration mal formée
 *     true sinon
**/
function cextras_api_vider_tables($declaration_champs_extras) {
	if (!is_array($declaration_champs_extras)) {
		return false;
	}
	foreach($declaration_champs_extras as $table=>$champs) {
		champs_extras_supprimer($table, $champs);
	}
	return true;
}


/*
 * 
 * Rechercher les champs non declares mais existants
 * dans la base de donnee en cours
 * (code d'origine : _fil_)
 * 
 */

/**
 * Liste les tables et les champs que le plugin et spip savent gérer
 * mais qui ne sont pas déclarés à SPIP
 * 
 * @param string $connect
 *     Nom du connecteur de base de données
 * @return array
 *     Tableau (table => couples(colonne => description SQL))
 */
function extras_champs_utilisables($connect='') {
	$tout = extras_champs_anormaux($connect);
	$objets = cextras_objets_valides();
	$utilisables = array_intersect_key($tout, $objets);
	ksort($utilisables);
	return $utilisables;
}

/**
 * Liste les champs anormaux par rapport aux définitions de SPIP
 *
 * @note
 *     Aucune garantie que $connect autre que la connexion principale fasse quelque chose
 *
 * @param string $connect
 *     Nom du connecteur de base de données
 * @return array
 *     Tableau (table => couples(colonne => description SQL))
 */
function extras_champs_anormaux($connect='') {
	static $tout = false;
	if ($tout !== false) {
		return $tout;
	}
	// recuperer les tables et champs de la base de donnees
	// les vrais de vrai dans la base sql...
	$tout = extras_base($connect);

	// recuperer les champs SPIP connus
	// si certains ne sont pas declares alors qu'ils sont presents
	// dans la base sql, on pourra proposer de les utiliser comme champs
	// extras (plugin interface).
	include_spip('base/objets');
	$tables_spip = lister_tables_objets_sql();

	// chercher ce qui est different
	$ntables = array();
	$nchamps = array();
	// la table doit être un objet editorial
	$tout = array_intersect_key($tout, $tables_spip);
	foreach ($tout as $table => $champs) {
		// la table doit être un objet editorial principal
		if ($tables_spip[$table]['principale'] == 'oui') {
			// pour chaque champ absent de la déclaration, on le note dans $nchamps.
			foreach($champs as $champ => $desc) {
				if (!isset($tables_spip[$table]['field'][$champ])) {
					if (!isset($nchamps[$table])) {
						$nchamps[$table] = array(); 
					}
					$nchamps[$table][$champ] = $desc;
				}
			}
		}
	}

	if($nchamps) {
		$tout = $nchamps;
	} else {
		$tout = array();
	}

	return $tout;
}

/**
 * Établit la liste de tous les champs de toutes les tables de la connexion
 * sql donnée
 * 
 * Ignore la table 'spip_test'
 *
 * @param string $connect
 *     Nom du connecteur de base de données
 * @return array
 *     Tableau (table => couples(colonne => description SQL))
 */
function extras_base($connect='') {
	$champs = array();
	
	foreach (extras_tables($connect) as $table) {
		if ($table != 'spip_test') {
			$champs[$table] = extras_champs($table, $connect);
		}
	}
	return $champs;
}


/**
 * Liste les tables SQL disponibles de la connexion sql donnée
 * 
 * @param string $connect
 *     Nom du connecteur de base de données
 * @return array
 *     Liste de tables SQL
 */
function extras_tables($connect='') {
	$a = array();
	$taille_prefixe = strlen( $GLOBALS['connexions'][$connect ? $connect : 0]['prefixe'] );

	if ($s = sql_showbase(null, $connect)) {
		while ($t = sql_fetch($s, $connect)) {
				$t = 'spip' . substr(array_pop($t), $taille_prefixe);
				$a[] = $t;
		}
	}
	return $a;
}


/**
 * Liste les champs dispos dans la table SQL de la connexion sql donnée
 *
 * @param string $table
 *     Nom de la table SQL
 * @param string $connect
 *     Nom du connecteur de base de données
 * @return array
 *     Couples (colonne => description SQL)
 */
function extras_champs($table, $connect) {
	$desc = sql_showtable($table, true, $connect);
	if (is_array($desc['field'])) {
		return $desc['field'];
	} else {
		return array();
	}
}
