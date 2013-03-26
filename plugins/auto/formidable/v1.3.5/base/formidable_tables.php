<?php

/**
 * Déclarations relatives à la base de données
 * 
 * @package SPIP\Formidable\Pipelines
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Déclarer les interfaces des tables de formidable pour le compilateur
 * 
 * @pipeline declarer_tables_interfaces
 * 
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
**/
function formidable_declarer_tables_interfaces($interfaces) {
	// 'spip_' dans l'index de $tables_principales
	$interfaces['table_des_tables']['formulaires'] = 'formulaires';
	$interfaces['table_des_tables']['formulaires_reponses'] = 'formulaires_reponses';
	$interfaces['table_des_tables']['formulaires_reponses_champs'] = 'formulaires_reponses_champs';

	$interfaces['tables_jointures']['spip_formulaires'][] = 'formulaires_liens';
	$interfaces['tables_jointures']['spip_articles'][] = 'formulaires_liens';
	$interfaces['tables_jointures']['spip_rubriques'][] = 'formulaires_liens';

	return $interfaces;
}

/**
 * Déclarer les objets éditoriaux des formulaires
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function formidable_declarer_tables_objets_sql($tables) {
	$tables['spip_formulaires'] = array(
		'type'=>'formulaire',
		'titre' => "titre, '' AS lang",
		'date' => '',
		'principale' => 'oui',
		
		'field' => array(
			"id_formulaire" => "bigint(21) NOT NULL",
			"identifiant" => "varchar(200)",
			"titre" => "text NOT NULL default ''",
			"descriptif" => "text",
			"message_retour" => "text NOT NULL default ''",
			"saisies" => "text NOT NULL default ''",
			"traitements" => "text NOT NULL default ''",
			"public" => "enum('non', 'oui') DEFAULT 'non' NOT NULL",
			"statut" => "varchar(10) NOT NULL default ''",
			"maj" => "timestamp",
			"apres" => "varchar(12) NOT NULL default ''",
			"url_redirect" => "varchar(255)"
		),
		'key' => array(
			"PRIMARY KEY" => "id_formulaire"
		),
		'join'=> array(
			'id_formulaire' => 'id_formulaire'
		),
		'rechercher_champs' => array(
		  'titre' => 5, 'descriptif' => 3
		),
	);

	$tables['spip_formulaires_reponses'] = array(
		'type'=>'formulaires_reponse',
		'titre' => "'' AS titre, '' AS lang",
		'date' => 'date',
		'principale' => 'oui',

		'field' => array(
			"id_formulaires_reponse" => "bigint(21) NOT NULL",
			"id_formulaire" => "bigint(21) NOT NULL default 0",
			"date" => "datetime NOT NULL default '0000-00-00 00:00:00'",
			"ip" => "varchar(255) NOT NULL default ''",
			"id_auteur" => "bigint(21) NOT NULL default 0",
			"cookie" => "varchar(255) NOT NULL default ''",
			"statut" => "varchar(10) NOT NULL default ''",
			"maj" => "timestamp"
		),
		'key' => array(
			"PRIMARY KEY" => "id_formulaires_reponse",
			"KEY id_formulaire" => "id_formulaire",
			"KEY id_auteur" => "id_auteur",
			"KEY cookie" => "cookie"
		),
		'join' => array(
			'id_formulaires_reponse' => 'id_formulaires_reponse',
			'id_formulaire' => 'id_formulaire',
			'id_auteur' => 'id_auteur'
		),
		'statut'=> array(
			array(
				'champ' => 'statut',
				'publie' => 'publie',
				'previsu' => 'publie,prop',
				'exception' => array('statut', 'tout'),
			)
		),
		'texte_changer_statut' => 'formulaires_reponse:changer_statut',
		'statut_titres' => array(
			'prop'=>'info_article_propose',
			'publie'=>'info_article_publie',
			'poubelle'=>'info_article_supprime'
		),
		'statut_textes_instituer' => array(
			'prop' => 'texte_statut_propose_evaluation',
			'publie' => 'texte_statut_publie',
			'refuse' => 'texte_statut_poubelle',
		),
	);
	return $tables;
}

/**
 * Déclarer les tables principales de formidable
 *
 * @pipeline declarer_tables_principales
 * @param array $tables_principales
 *     Description des tables
 * @return array
 *     Description complétée des tables
**/
function formidable_declarer_tables_principales($tables_principales){

	// Table formulaires_reponses_champs 
	$formulaires_reponses_champs = array(
		"id_formulaires_reponse" => "bigint(21) NOT NULL default 0",
		"nom" => "varchar(255) NOT NULL default ''",
		"valeur" => "text NOT NULL DEFAULT ''",
		"maj" => "timestamp"
	);
	$formulaires_reponses_champs_cles = array(
		"PRIMARY KEY" => "id_formulaires_reponse, nom",
		"KEY id_formulaires_reponse" => "id_formulaires_reponse"
	);
	$tables_principales['spip_formulaires_reponses_champs'] = array(
		'field' => &$formulaires_reponses_champs,
		'key' => &$formulaires_reponses_champs_cles
	);
	
	return $tables_principales;
}

/**
 * Déclarer les tables auxiliaires de formidable
 *
 * @pipeline declarer_tables_auxiliaires
 * @param array $tables_auxiliaires
 *     Description des tables
 * @return array
 *     Description complétée des tables
**/
function formidable_declarer_tables_auxiliaires($tables_auxiliaires){
	$formulaires_liens = array(
		"id_formulaire"	=> "bigint(21) DEFAULT '0' NOT NULL",
		"id_objet"	=> "bigint(21) DEFAULT '0' NOT NULL",
		"objet"	=> "VARCHAR (25) DEFAULT '' NOT NULL"
	);

	$formulaires_liens_cles = array(
		"PRIMARY KEY" => "id_formulaire,id_objet,objet",
		"KEY id_formulaire" => "id_formulaire"
	);
	
	$tables_auxiliaires['spip_formulaires_liens'] = array(
		'field' => &$formulaires_liens,
		'key' => &$formulaires_liens_cles
	);
	
	return $tables_auxiliaires;
}



?>
