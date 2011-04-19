<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * ??? 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

//
// Formulaires : Structure
//
global $tables_principales;
global $tables_auxiliaires;

$spip_forms = array(
	"id_form" 	=> "bigint(21) NOT NULL",
	"titre" 	=> "varchar(255) NOT NULL",
	"descriptif" 	=> "text",
	"type_form" 	=> "varchar(255) NOT NULL",
	"modifiable" 	=> "ENUM('non', 'oui') DEFAULT 'non'",
	"multiple" 	=> "ENUM('non', 'oui') DEFAULT 'non'",
	"forms_obligatoires" => "varchar(255) NOT NULL DEFAULT ''",
	"email" => "text",
	"champconfirm" => "varchar(255) NOT NULL",
	"texte" 	=> "text",
	"moderation"	=> "VARCHAR(10) DEFAULT 'posteriori'",
	"public" => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
	"linkable" => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
	"documents" => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
	"documents_mail" => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
	"arborescent" => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
	'html_wrap' => "text",
	"maj" 		=> "TIMESTAMP");

$spip_forms_key = array(
	"PRIMARY KEY" => "id_form");

$tables_principales['spip_forms'] = array(
	'field' => &$spip_forms,
	'key' => &$spip_forms_key);

// Boucle FORMS_CHAMPS
$formschamp_field = array(
		"id_form"	=> "bigint(21) NOT NULL",
		"champ" => "varchar(100) NOT NULL",
		"rang" => "bigint(21) NOT NULL",
		"titre" => "text",
		"type" => "varchar(100)",
		"taille" => "bigint(21) NOT NULL",
		"obligatoire" => "varchar(3)",
		"extra_info" => "text", // une info supplementaire par champ a utiliser librement ex : type mot->id_groupe, type url->verif, type fichier -> taille
		'specifiant' => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
		'listable_admin' => "ENUM('non', 'oui') DEFAULT 'oui' NOT NULL",
		'listable' => "ENUM('non', 'oui') DEFAULT 'oui' NOT NULL",
		'public' => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
		'saisie' => "ENUM('non', 'oui') DEFAULT 'oui' NOT NULL",
		'aide' => "text",
		'html_wrap' => "text"
);

$formschamp_key = array(
	"PRIMARY KEY"	=> "id_form, champ",
	"KEY" => "rang"
);

$tables_principales['spip_forms_champs'] =
	array('field' => &$formschamp_field, 'key' => &$formschamp_key);

// Boucle FORMS_CHAMPS_CHOIX
$formschampchoix_field = array(
		"id_form"	=> "bigint(21) NOT NULL",
		"champ" => "varchar(100) NOT NULL",
		"choix" => "varchar(100) NOT NULL DEFAULT ''",
		"titre" => "text",
		"rang" => "bigint(21) NOT NULL"
);
$formschampchoix_key = array(
	"PRIMARY KEY"	=> "id_form, champ, choix",
	"KEY" => "choix"
);

$tables_principales['spip_forms_champs_choix'] =
	array('field' => &$formschampchoix_field, 'key' => &$formschampchoix_key);

//
// Formulaires : Donnees
//
$spip_forms_donnees = array(
	"id_donnee" 	=> "bigint(21) NOT NULL",
	"id_form" 	=> "bigint(21) NOT NULL",
	"date"		=> "DATETIME NOT NULL",
	"ip"		=> "VARCHAR(255) NOT NULL",
	"id_auteur"	=> "bigint(21) NOT NULL",
	"id_article_export"	=> "bigint(21) NOT NULL",
	"url" => "VARCHAR(255) NOT NULL",
	"confirmation" 	=> "VARCHAR(10) NOT NULL",
	"statut"	=> "VARCHAR(10) NOT NULL",
	"cookie"	=> "VARCHAR(255) NOT NULL",
	"rang" => "bigint(21) NOT NULL",
	"bgch" => "bigint(21) NOT NULL", // arborescence
	"bdte" => "bigint(21) NOT NULL", // arborescence
	"niveau" => "bigint(21) DEFAULT '0' NOT NULL", // arborescence
	"maj" 		=> "TIMESTAMP");

$spip_forms_donnees_key = array(
	"PRIMARY KEY" 	=> "id_donnee",
	"KEY id_form" 	=> "id_form, date",
	"KEY date" 	=> "date",
	"KEY cookie" 	=> "cookie",
	"KEY id_auteur" => "id_auteur",
	"KEY statut" 	=> "statut, id_form");
$spip_forms_donnees_join = array(
	"id_donnee" 	=> "id_donnee",
	"id_form" 	=> "id_form",
	"id_auteur" => "id_auteur");

$tables_principales['spip_forms_donnees'] = array(
	'field' => &$spip_forms_donnees,
	'key' => &$spip_forms_donnees_key,
	'join'=>&$spip_forms_donnees_join);

$spip_forms_donnees_champs = array(
	"id_donnee" 	=> "bigint(21) NOT NULL",
	"champ" 	=> "varchar(255) NOT NULL",
	"valeur" 	=> "TEXT NOT NULL",
	"maj" 		=> "TIMESTAMP");

$spip_forms_donnees_champs_key = array(
	"UNIQUE champ" 	=> "champ (128), id_donnee, valeur(128)",
	"KEY id_donnee" => "id_donnee"	);

$tables_principales['spip_forms_donnees_champs'] = array(
	'field' => &$spip_forms_donnees_champs,
	'key' => &$spip_forms_donnees_champs_key);



//
// Formulaires : Liens
//
$spip_forms_articles = array(
	"id_form" 	=> "BIGINT (21) DEFAULT '0' NOT NULL",
	"id_article" 	=> "BIGINT (21) DEFAULT '0' NOT NULL");

$spip_forms_articles_key = array(
	"PRIMARY KEY" 	=> "id_form, id_article",
	"KEY id_article" => "id_article");

$tables_auxiliaires['spip_forms_articles'] = array(
	'field' => &$spip_forms_articles,
	'key' => &$spip_forms_articles_key);

$spip_forms_donnees_articles = array(
	"id_donnee" 	=> "BIGINT (21) DEFAULT '0' NOT NULL",
	"id_article" 	=> "BIGINT (21) DEFAULT '0' NOT NULL",
	"article_ref" => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL");

$spip_forms_donnees_articles_key = array(
	"PRIMARY KEY" 	=> "id_donnee, id_article",
	"KEY id_article" => "id_article");

$tables_auxiliaires['spip_forms_donnees_articles'] = array(
	'field' => &$spip_forms_donnees_articles,
	'key' => &$spip_forms_donnees_articles_key);


$spip_forms_donnees_rubriques = array(
	"id_donnee" 	=> "BIGINT (21) DEFAULT '0' NOT NULL",
	"id_rubrique" 	=> "BIGINT (21) DEFAULT '0' NOT NULL");

$spip_forms_donnees_rubriques_key = array(
	"PRIMARY KEY" 	=> "id_donnee, id_rubrique",
	"KEY id_rubrique" => "id_rubrique");

$tables_auxiliaires['spip_forms_donnees_rubriques'] = array(
	'field' => &$spip_forms_donnees_rubriques,
	'key' => &$spip_forms_donnees_rubriques_key);


$spip_forms_donnees_donnees = array(
	"id_donnee" 	=> "BIGINT (21) DEFAULT '0' NOT NULL",
	"donnee_ref" => "ENUM('non', 'oui') DEFAULT 'non' NOT NULL",
	"id_donnee_liee" 	=> "BIGINT (21) DEFAULT '0' NOT NULL"	);

$spip_forms_donnees_donnees_key = array(
	"PRIMARY KEY" 	=> "id_donnee, id_donnee_liee",
	"KEY id_donnee_liee" => "id_donnee_liee");

$tables_auxiliaires['spip_forms_donnees_donnees'] = array(
	'field' => &$spip_forms_donnees_donnees,
	'key' => &$spip_forms_donnees_donnees_key);

$spip_forms_donnees_auteurs = array(
	"id_donnee" 	=> "BIGINT (21) DEFAULT '0' NOT NULL",
	"id_auteur" 	=> "BIGINT (21) DEFAULT '0' NOT NULL");

$spip_forms_donnees_auteurs_key = array(
	"PRIMARY KEY" 	=> "id_donnee, id_auteur",
	"KEY id_auteur" => "id_auteur");

$tables_auxiliaires['spip_forms_donnees_auteurs'] = array(
	'field' => &$spip_forms_donnees_auteurs,
	'key' => &$spip_forms_donnees_auteurs_key);


$spip_documents_donnees = array(
		"id_document"	=> "BIGINT (21) DEFAULT '0' NOT NULL",
		"id_donnee"	=> "BIGINT (21) DEFAULT '0' NOT NULL");

$spip_documents_donnees_key = array(
		"PRIMARY KEY"		=> "id_donnee, id_document",
		"KEY id_document"	=> "id_document");
$tables_auxiliaires['spip_documents_donnees'] = array(
	'field' => &$spip_documents_donnees,
	'key' => &$spip_documents_donnees_key);

//-- Relations ----------------------------------------------------
global $tables_jointures;
$tables_jointures['spip_articles'][] = 'forms_articles';
$tables_jointures['spip_forms'][] = 'forms_articles';
$tables_jointures['spip_articles'][] = 'forms_donnees_articles';
$tables_jointures['spip_auteurs'][] = 'forms_donnees_auteurs';
$tables_jointures['spip_rubriques'][] = 'forms_donnees_rubriques';
$tables_jointures['spip_forms_donnees'][] = 'forms_donnees_articles';
$tables_jointures['spip_forms_donnees'][] = 'forms_donnees_rubriques';
$tables_jointures['spip_forms_donnees'][] = 'forms_donnees_auteurs';
$tables_jointures['spip_forms_donnees'][] = 'documents_donnees';
$tables_jointures['spip_forms_donnees'][] = 'forms';
$tables_jointures['spip_documents'][] = 'documents_donnees';

global $table_des_tables;
$table_des_tables['forms']='forms';
$table_des_tables['forms_champs'] = 'forms_champs';
$table_des_tables['forms_champs_choix'] = 'forms_champs_choix';
$table_des_tables['forms_donnees']='forms_donnees';

global $spip_version_code;
if (version_compare($spip_version_code,'1.9250','<')){
	$table_des_tables['forms_donnees_champs']='forms_donnees_champs';
	$table_des_tables['forms_articles']='forms_articles';
	$table_des_tables['forms_donnees_articles']='forms_donnees_articles';
	$table_des_tables['forms_donnees_auteurs']='forms_donnees_auteurs';
	$table_des_tables['forms_donnees_rubriques']='forms_donnees_rubriques';
	$table_des_tables['documents_donnees']='documents_donnees';
	$table_des_tables['forms_donnees_donnees']='forms_donnees_donnees';
}

global  $exceptions_des_jointures;
$exceptions_des_jointures['type_form'] = array('spip_forms', 'type_form');

$GLOBALS['table_date']['forms_donnees']='date';
?>
