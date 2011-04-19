<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/cextras');

// mettre 'true' pour autoriser l'utilisation
// les saisies du plugin SAISIES
// en plus de celles de 'extra-saisies/'
// (experimental)
define('_CHAMPS_EXTRAS_SAISIES_EXTERNES', false);

// retourne la liste des objets valides utilisables par le plugin
// (dont on peut afficher les champs dans les formulaires)
function cextras_objets_valides(){
	
	$objets = array();
	
	$objets_extensibles = pipeline("objets_extensibles", array(
		'article'     => _T('cextras:table_article'),
		'auteur'      => _T('cextras:table_auteur'),
		'breve'       => _T('cextras:table_breve'),
		'groupes_mot' => _T('cextras:table_groupes_mot'),
		'mot'         => _T('cextras:table_mot'),
		'rubrique'    => _T('cextras:table_rubrique'),
		'site'        => _T('cextras:table_site')
	));
	ksort($objets_extensibles);
	
	foreach ($objets_extensibles as $objet => $traduction) {
		$objets[$objet] = array(
			'table' => table_objet_sql($objet), 
			'type' => objet_type(table_objet($objet)), 
			'nom' => $traduction,
		);
	}

	return $objets;
}


// formater pour les boucles pour 'type'=>'nom'
function cextras_objets_valides_boucle_pour(){
	$objets = array();
	foreach(cextras_objets_valides() as $objet) {
		$objets[$objet['type']] = $objet['nom'];
	}
	return $objets;
}


// retourne la liste des types de formulaires de saisie
// utilisables par les champs extras
// (crayons appelle cela des 'controleurs')
function cextras_types_formulaires(){
	$types = array();
	
	// saisies de ce plugin
	$saisies = find_all_in_path('extra-saisies/','.*\.html$');
	$noms = array();
	foreach($saisies as $saisie) {
		$type = basename($saisie,'.html');
		$noms['interne/'.$type] = _T('cextras:type', array('type' => $type));
	}
	$types[_T('iextras:saisies_champs_extras')] = $noms;

		
	if (_CHAMPS_EXTRAS_SAISIES_EXTERNES) {
		// plugin saisies (attention au chemin "/saisies/saisies/_base.html")
		$saisies = find_all_in_path('saisies/','/([^_/]{1}[^/]*)\.html$');
		$noms = array();
		foreach($saisies as $saisie) {
			$type = basename($saisie,'.html');
			$noms['externe/'.$type] = _T('cextras:type', array('type' => $type));
		}
		$types[_T('iextras:saisies_saisies')] = $noms;
	}

	return $types;
}


/**
 * Installe des champs extras et
 * gere en meme temps la mise a jour de la meta
 * du plugin concernant la base de donnee
 */
function installer_champs_extras($champs, $nom_meta_base_version, $version_cible, $creer_meta=true) {
	$current_version = 0.0;
	$ok = true;
	if ((!isset($GLOBALS['meta'][$nom_meta_base_version]))
	|| (($current_version = $GLOBALS['meta'][$nom_meta_base_version])!=$version_cible)){
		// cas d'une installation
		$ok = creer_champs_extras($champs);
		if ($ok and $creer_meta) {
			ecrire_meta($nom_meta_base_version,$current_version=$version_cible,'non');
		}
	}
	return $ok;
}

/**
 * Cree en base les champs extras demandes
 * @param $champs : objet ChampExtra ou tableau d'objets ChampExtra
 */
function creer_champs_extras($champs) {
	if (!$champs) {
		return;
	}
	
	if (!is_array($champs)) 
		$champs = array($champs);
				
	// on recupere juste les differentes tables a mettre a jour
	$tables = array();
	foreach ($champs as $c){ 
		if ($table = $c->_table_sql) {
			$tables[$table] = $table;
		} else {
			// ici on est bien ennuye, vu qu'on ne pourra pas creer ce champ.
			extras_log("Aucune table trouvee pour le champs extras ; il ne pourra etre cree :", true);
			extras_log($c, true);
		}
	}	

	if (!$tables) {
		return false;
	}
	
	// on met a jour les tables trouvees
	// recharger les tables principales et auxiliaires
	include_spip('base/serial');
	include_spip('base/auxiliaires');
	global $tables_principales, $tables_auxiliaires;
	base_serial($tables_principales);
	base_auxiliaires($tables_auxiliaires);
	
	// inclure les champs extras declares ALORS que le pipeline
	// n'est pas encore actif : important lorsqu'on active
	// en meme temps CE2 et un plugin dependant
	// et non l'un apres l'autre
	if (!defined('_CHAMPS_EXTRAS_DECLARES')) {
		include_spip('base/cextras');
		$tables_principales = cextras_declarer_tables_principales($tables_principales);
	}

	// executer la mise a jour
	include_spip('base/create');
	maj_tables($tables);

	// pour chaque champ a creer, on verifie qu'il existe bien maintenant !
	$trouver_table = charger_fonction('trouver_table','base');
	$trouver_table(''); // recreer la description des tables.
	$retour = true;
	foreach ($champs as $c){
		if ($objet = $c->_objet) {
			$desc = $trouver_table($objet);
			if (!isset($desc['field'][$c->champ])) {
				extras_log("Le champ extra '" . $c->champ . "' sur $objet n'a pas ete cree :(", true);
				$retour = false;
			}
		} else {
			$retour = false;
		}
	}
	return $retour;
}

/**
 * Desinstaller des champs extras
 * et gerer la suppression de la meta du plugin concernant 
 * la base de donnee
 */
function desinstaller_champs_extras($champs, $nom_meta_base_version) {
	vider_champs_extras($champs);
	effacer_meta($nom_meta_base_version);	
}

/**
 * Supprime les champs extras 
 * @param $champs : objet ChampExtra ou tableau d'objets ChampExtra
 */
function vider_champs_extras($champs) {
	if (!is_array($champs)) 
		$champs = array($champs);
		
	// on efface chaque champ trouve
	foreach ($champs as $c){ 
		if ($table = $c->_table_sql and $c->champ and $c->sql) {
			sql_alter("TABLE $table DROP $c->champ");
		}
	}	
}



/**
 * 
 * Rechercher les champs non declares mais existants
 * dans la base de donnee en cours
 * (code d'origine : _fil_)
 * 
 */

// liste les tables et les champs que le plugin et spip savent gerer
function extras_champs_utilisables($connect='') {
	$tout = extras_champs_anormaux($connect);
	$objets = cextras_objets_valides();

	$tables_utilisables = array();
	foreach ($objets as $o){$tables_utilisables[] = $o['table'];}
	foreach ($tout as $table=>$champs) {
		if (!in_array($table, $tables_utilisables)) {
			unset($tout[$table]);
		}
	}
	return $tout;
}

// Liste les champs anormaux par rapport aux definitions de SPIP
// (aucune garantie que $connect autre que la connexion principale fasse quelque chose)
function extras_champs_anormaux($connect='') {
	// recuperer les tables et champs accessibles
	$tout = extras_base($connect);

	// recuperer les champs SPIP connus
	include_spip('base/auxiliaires');
	include_spip('base/serial');
	$tables_spip = array_merge($GLOBALS['tables_principales'], $GLOBALS['tables_auxiliaires']);

	// chercher ce qui est different
	$ntables = array();
	$nchamps = array();
	foreach ($tout as $table => $champs) {
		if (!isset($tables_spip[$table]['field'])) {
			$nchamps[$table] = $champs;
		} else {
			foreach($champs as $champ => $desc) {
				if (!isset($tables_spip[$table]['field'][$champ])) {
					$nchamps[$table][$champ] = $desc;
				}
			}
		}
	}

	unset($tout);
	if($nchamps) {
		$tout = $nchamps;
	} else {
		$tout = array();
	}

	return $tout;
}

// etablit la liste de tous les champs de toutes les tables du connect donne
// ignore la table 'spip_test'
function extras_base($connect='') {
	$champs = array();
	
	foreach (extras_tables($connect) as $table) {
		if ($table != 'spip_test') {
			$champs[$table] = extras_champs($table, $connect);
		}
	}
	return $champs;
}

// liste les tables dispos dans la connexion $connect
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


// liste les champs dispos dans la table $table de la connexion $connect
function extras_champs($table, $connect) {
	$desc = sql_showtable($table, true, $connect);
	if (is_array($desc['field'])) {
		return $desc['field'];
	} else {
		return array();
	}
}


/** fonctions non utilisees du futur defunt plugin extras2 **

// Liste les connexions disponibles dans config/
function extras_connexions() {
	$connexions = array();
	foreach(preg_files(_DIR_CONNECT.'.*[.]php$') as $fichier) {
		if (lire_fichier($fichier, $contenu)
		AND strpos($contenu, 'spip_connect_db')
		)
			$connexions[] = basename($fichier, '.php');
	}

	return $connexions;
}


// etablit la liste de tous les champs de toutes les tables de toutes les bases dispos
function extras_tout() {
	$champs = array();
	foreach(extras_connexions() as $connect)
		foreach (extras_tables($connect) as $table)
			$champs[$connect][$table] = extras_champs($table, $connect);

	return $champs;
}
*/
?>
