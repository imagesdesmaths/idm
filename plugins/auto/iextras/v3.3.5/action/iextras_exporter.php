<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Exporte des champs extras
 *
 * Crée un fichier PHP contenant des informations relatives (array)
 * aux saisies utilisées par les champs extras sur un ou plusieurs objets
 *
 * Paramètres d'action :
 *
 * - yaml/tous                       Tous les champs extras de tous les objets
 * - php/tous                        Tous les champs extras de tous les objets (export PHP)
 * - yaml/objet/{type}/tous          Tous les champs extras de l'objet {type}. {@example: `yaml/objet/auteur/tous`}
 * - yaml/objet/{type}/champ/{nom}   Le champ {nom} de l'objet {type}. {@example: `yaml/objet/auteur/champ/date_naissance`}
 * 
**/
function action_iextras_exporter_dist() {
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	// droits
	include_spip('inc/autoriser');
	if (!autoriser('configurer', 'iextra')) {
		include_spip('inc/minipres');
		echo minipres();
		exit;
	}

	list($format, $quoi, $objet, $quoi_objet, $champ) = array_pad(explode('/', $arg), 5, null);

	// formats possibles
	if (!in_array($format, array('yaml', 'php'))) {
		include_spip('inc/minipres');
		echo minipres(_T('iextras:erreur_format_export',array("format" => $format)));
		exit;
	}

	// actions possibles
	if (!in_array($quoi, array('tous','objet'))) {
		include_spip('inc/minipres');
		echo minipres(_T('iextras:erreur_action',array("action" => $quoi)));
		exit;
	}

	// liste des champs extras par table SQL array(table sql => array(saisies))
	$champs = array();
	$titre = "";

	if ($quoi == 'tous') {
		$titre  = 'tous';
		$champs = iextras_exporter_tous();
	}
	elseif ($quoi_objet == 'tous') {
		$titre = $objet;
		$champs = iextras_exporter_objet_tous($objet);
	}
	else {
		$titre = "$objet-$champ";
		$champs = iextras_exporter_objet_champ($objet, $champ);
	}

	return iextras_envoyer_export($champs, $titre, $format);
}


/**
 * Retourne tous les champs extras par table SQL
**/
function iextras_exporter_tous() {
	include_spip('inc/iextras');
	$tables = lister_tables_objets_sql();
	$champs = array();
	foreach ($tables as $table => $desc) {
		if ($liste = iextras_champs_extras_definis($table)) {
			$champs[$table] = $liste;
		}
	}
	return $champs;
}


/**
 * Retourne tous les champs extras d'un objet
 *
 * @param string $objet
**/
function iextras_exporter_objet_tous($objet) {
	include_spip('inc/iextras');
	$champs = array();
	$table = table_objet_sql($objet);
	if ($liste = iextras_champs_extras_definis($table)) {
		$champs[$table] = $liste;
	}
	return $champs;
}


/**
 * Retourne un champ extra d'un objet
 *
 * @param string $objet
 * @param string $champ
**/
function iextras_exporter_objet_champ($objet, $champ) {
	include_spip('inc/iextras');
	$champs = array();
	$table = table_objet_sql($objet);
	if ($liste = iextras_champs_extras_definis($table)) {
		include_spip('inc/saisies');
		$liste = saisies_lister_par_nom($liste);
		if (!empty($liste[$champ])) {
			$champs[$table] = array();
			$champs[$table][] = $liste[$champ];
		}
	}
	return $champs;
}


/**
 * Exporte un contenu (description de champs extras) au format YAML
 *
 * Envoie les données au navigateur !
 *
 * @param array $export
 * @param string $nom_fichier
 * @param string $format
 *     Format d'export (yaml ou php)
**/
function iextras_envoyer_export($export, $nom_fichier, $format = 'yaml') {

	switch ($format) {
		case 'php':
			$export = iextras_preparer_export_php($export);
			$export = iextras_ecrire_export_php($export);
			
			break;

		case 'yaml':
		default:
			// On envode en yaml
			include_spip('inc/yaml');
			$export = yaml_encode($export);
			break;
	}


	$date = date("Ymd-His");
	Header("Content-Type: text/x-yaml;");
	Header("Content-Disposition: attachment; filename=champs_extras_export-$date-$nom_fichier.$format");
	Header("Content-Length: " . strlen($export));
	echo $export;
	exit;
}


/**
 * Prépare les saisies (les simplifie) pour un export au format PHP
 *
 * @param array $export
 *     Liste des saisies, par table SQL
 * @return array
 *     Idem, simplifié
**/
function iextras_preparer_export_php($export) {
	include_spip('inc/saisies');
	foreach ($export as $table => $champs) {
		if (!$champs) {
			unset($export[$table]);
			continue;
		}

		// simplifier chaque champ
		foreach ($champs as $i => $champ) {
			$export[$table][$i] = iextras_preparer_export_php_saisie($champ);
		}
	}

	return $export;
}

/**
 * Simplifie l'écriture d'une saisie de champs extras
 *
 * @param array Description de saisie
 * @return array
**/
function iextras_preparer_export_php_saisie($saisie) {

	// 1 mettre 'saisie' en tout premier, c'est plus pratique !
	$saisie = array('saisie' => $saisie['saisie']) + $saisie;

	// 2 mettre 'saisies' en dernier
	if (isset($saisie['saisies'])) {
		$saisies = $saisie['saisies'];
		unset($saisie['saisies']);
		$saisie['saisies'] = $saisies;
		// 2 bis : traiter toutes les saisies enfants
		foreach ($saisie['saisies'] as $k => $s) {
			$saisie['saisies'][$k] = iextras_preparer_export_php_saisie($s);
		}
	}

	// 3 pas besoin d'identifiant
	unset($saisie['identifiant']);
	// 4 nettoyage de quelques champs souvent vides
	if (isset($saisie['options']['restrictions'])) {
		if (empty($saisie['options']['restrictions']['secteurs'])) {
			unset($saisie['options']['restrictions']['secteurs']);
		}
		if (empty($saisie['options']['restrictions']['branches'])) {
			unset($saisie['options']['restrictions']['branches']);
		}
		if (empty($saisie['options']['restrictions']['voir']['auteur'])) {
			unset($saisie['options']['restrictions']['voir']['auteur']);
		}
		if (empty($saisie['options']['restrictions']['modifier']['auteur'])) {
			unset($saisie['options']['restrictions']['modifier']['auteur']);
		}
		if (empty($saisie['options']['restrictions']['voir'])) {
			unset($saisie['options']['restrictions']['voir']);
		}
		if (empty($saisie['options']['restrictions']['modifier'])) {
			unset($saisie['options']['restrictions']['modifier']);
		}
		if (empty($saisie['options']['restrictions'])) {
			unset($saisie['options']['restrictions']);
		}
	}

	// 5 les datas doivent être des tableaux
	if (isset($saisie['options']['datas'])) {
		if (!is_array($saisie['options']['datas'])) {
			$saisie['options']['datas'] = saisies_chaine2tableau($saisie['options']['datas']);
		}
	}

	return $saisie;
}

/**
 * Écrit le code PHP de l'export PHP
 *
 * @param array $export
 *     Liste des saisies, par table SQL
 * @return string
 *     Code PHP
**/
function iextras_ecrire_export_php($export) {
	$contenu = <<<EOF
<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

function monplugin_declarer_champs_extras(\$champs = array()) {
EOF;
	foreach ($export as $table => $champs) {
		$contenu .= "

	// Table : $table
	if (!is_array(\$champs['$table'])) {
		\$champs['$table'] = array();
	}
";
		foreach ($champs as $champ) {
			$nom = $champ['options']['nom'];
			$desc = var_export($champ, true);
			$desc = explode("\n", $desc);
			$desc = implode("\n\t\t", $desc);
			$contenu .= "\n\t\$champs['$table']['$nom'] = $desc;\n";
		}
	}

	$contenu .= <<<EOF

	return \$champs;
}
EOF;

	return $contenu;
}
