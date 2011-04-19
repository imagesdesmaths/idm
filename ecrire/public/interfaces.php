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


// Definition des noeuds de l'arbre de syntaxe abstraite

// http://doc.spip.org/@Texte
class Texte {
	var $type = 'texte';
	var $texte;
	var $avant, $apres = ""; // s'il y avait des guillemets autour
	var $ligne = 0;
}

// http://doc.spip.org/@Inclure
class Inclure {
	var $type = 'include';
	var $texte;
	var $avant, $apres = ''; // inutilises mais generiques
	var $ligne = 0;
	var $param = array();  //  valeurs des params
}

//
// encodage d'une boucle SPIP en un objet PHP
//
// http://doc.spip.org/@Boucle
class Boucle {
	var $type = 'boucle';
	var $id_boucle;
	var $id_parent ='';
	var $avant, $milieu, $apres, $altern = '';
	var $lang_select;
	var $type_requete;
	var $table_optionnelle = false; # si ? dans <BOUCLE_x(table ?)>
	var $sql_serveur = '';
	var $param = array();
	var $criteres = array();
	var $separateur = array();
	var $jointures = array();
	var $jointures_explicites = false;
	var $doublons;
	var $partie, $total_parties,$mode_partie='';
	var $externe = ''; # appel a partir d'une autre boucle (recursion)
	// champs pour la construction de la requete SQL
	var $select = array();
	var $from = array();
	var $from_type = array();
	var $where = array();
	var $join = array();
	var $having = array();
	var $limit;
	var $group = array();
	var $order = array();
	var $default_order = array();
	var $date = 'date' ;
	var $hash = "" ;
	var $in = "" ;
	var $sous_requete = false;
	var $hierarchie = '';
	var $statut = false; # definition/surcharge du statut des elements retournes
	// champs pour la construction du corps PHP
	var $show = array();
	var $id_table;
	var $primary;
	var $return;
	var $numrows = false;
	var $cptrows = false;
	var $ligne = 0;
	var $descr =  array(); # noms des fichiers source et but etc

	var $modificateur = array(); // table pour stocker les modificateurs de boucle tels que tout, plat ..., utilisable par les plugins egalement

	// obsoletes, conserves provisoirement pour compatibilite
	var $tout = false;
	var $plat = false;
	var $lien = false;
}

// sous-noeud du precedent

// http://doc.spip.org/@Critere
class Critere {
	var $op;
	var $not;
	var $exclus;
	var $param = array();
	var $ligne = 0;
}

// http://doc.spip.org/@Champ
class Champ {
	var $type = 'champ';
	var $nom_champ;
	var $nom_boucle= ''; // seulement si boucle explicite
	var $avant, $apres; // tableaux d'objets
	var $etoile;
	var $param = array();  // filtre explicites
	var $fonctions = array();  // source des filtres (compatibilite)
	// champs pour la production de code
	var $id_boucle;
	var $boucles;
	var $type_requete;
	// resultat de la compilation:  toujours une expression PHP.
	// Chaine vide comme valeur par defaut (pour balise indefinie etc)
	var $code = ''; 
	var $interdire_scripts = true; // false si on est sur de cette balise
	// tableau pour la production de code dependant du contexte
	// id_mere;  pour TOTAL_BOUCLE hors du corps
	// document; pour embed et img dans les textes
	// sourcefile; pour DOSSIER_SQUELETTE
	var $descr = array();
	// pour localiser les erreurs
	var $ligne = 0;
}


// http://doc.spip.org/@Idiome
class Idiome {
	var $type = 'idiome';
	var $nom_champ = ""; // la chaine a traduire
	var $module = ""; // son module de definition
	var $arg = array(); // les arguments a passer a la chaine
	var $param = array(); // les filtres a appliquer au resultat
	var $fonctions = array(); // source des filtres  (compatibilite)
	var $avant, $apres; // inutilises mais faut = ci-dessus
	// champs pour la production de code, cf ci-dessus
	var $id_boucle;
	var $boucles;
	var $type_requete;
	// resultat de la compilation:  toujours une expression PHP.
	// Chaine vide comme valeur par defaut (n'arrive pas normalement)
	var $code = '';
	var $interdire_scripts = false;
	var $descr = array();
	var $ligne = 0;
}

// http://doc.spip.org/@Polyglotte
class Polyglotte {
	var $type = 'polyglotte';
	var $traductions = array(); // les textes ou choisir
	var $ligne = 0;
}

// Une structure necessaire au traitement d'erreur a l'execution
// Le champ code est inutilise, mais harmonise le traitement d'erreurs.
class Contexte {
	var $descr = array();
	var $id_boucle = '';
	var $ligne = 0;
	var $lang = '';
	var $code = '';
}

global $table_criteres_infixes;
$table_criteres_infixes = array('<', '>', '<=', '>=', '==', '===', '!=', '!==', '<>',  '?');

global $exception_des_connect;
$exception_des_connect[] = ''; // ne pas transmettre le connect='' par les inclure
//
// Globales de description de la base

//ces variables ne sont pas initialisees par "$var = array()"
// afin de permettre leur extension dans mes_options.php etc

// http://doc.spip.org/@declarer_interfaces
function declarer_interfaces(){
 global $exceptions_des_tables, $table_des_tables, $table_date, $table_titre;

$table_des_tables['articles']='articles';
$table_des_tables['auteurs']='auteurs';
$table_des_tables['breves']='breves';
$table_des_tables['forums']='forum';
$table_des_tables['signatures']='signatures';
$table_des_tables['documents']='documents';
$table_des_tables['types_documents']='types_documents';
$table_des_tables['mots']='mots';
$table_des_tables['groupes_mots']='groupes_mots';
$table_des_tables['rubriques']='rubriques';
$table_des_tables['syndication']='syndic';
$table_des_tables['syndic']='syndic';
$table_des_tables['syndic_articles']='syndic_articles';
$table_des_tables['hierarchie']='rubriques';
$table_des_tables['messages']='messages';
$table_des_tables['petitions']='petitions';

$exceptions_des_tables['breves']['id_secteur']='id_rubrique';
$exceptions_des_tables['breves']['date']='date_heure';
$exceptions_des_tables['breves']['nom_site']='lien_titre';
$exceptions_des_tables['breves']['url_site']='lien_url';

$exceptions_des_tables['forums']['date']='date_heure';
$exceptions_des_tables['forums']['nom']='auteur';
$exceptions_des_tables['forums']['email']='email_auteur';

$exceptions_des_tables['signatures']['date']='date_time';
$exceptions_des_tables['signatures']['nom']='nom_email';
$exceptions_des_tables['signatures']['email']='ad_email';

$exceptions_des_tables['documents']['type_document']=array('types_documents'
, 'titre');
$exceptions_des_tables['documents']['extension_document']=array('types_documents', 'extension');
$exceptions_des_tables['documents']['mime_type']=array('types_documents'
, 'mime_type');

# ne sert plus ? verifier balise_URL_ARTICLE
$exceptions_des_tables['syndic_articles']['url_article']='url';
# ne sert plus ? verifier balise_LESAUTEURS
$exceptions_des_tables['syndic_articles']['lesauteurs']='lesauteurs';
$exceptions_des_tables['syndic_articles']['url_site']=array('syndic', 'url_site');
$exceptions_des_tables['syndic_articles']['nom_site']=array('syndic', 'nom_site');

$table_titre['mots']= "titre, '' AS lang";
$table_titre['breves']= 'titre , lang';
$table_titre['articles']= 'titre, lang';
$table_titre['rubriques']= 'titre, lang';
$table_titre['forums']= "titre, '' AS lang";
$table_titre['messages']= "titre, '' AS lang";
$table_titre['auteurs']= "nom AS titre, '' AS lang";
$table_titre['site']= "nom_site AS titre, '' AS lang";
$table_titre['syndic']= "nom_site AS titre, '' AS lang";
$table_titre['documents']= "titre, fichier AS surnom, '' AS lang";

$table_date['articles']='date';
$table_date['auteurs']='date';
$table_date['breves']='date_heure';
$table_date['forums']='date_heure';
$table_date['signatures']='date_time';
$table_date['documents']='date';
$table_date['types_documents']='date';
$table_date['groupes_mots']='date';
$table_date['mots']='date';
$table_date['rubriques']='date';
$table_date['syndication']='date';
$table_date['syndic_articles']='date';

//
// tableau des tables de jointures
// Ex: gestion du critere {id_mot} dans la boucle(ARTICLES)

global $tables_jointures;

$tables_jointures['spip_articles'][]= 'mots_articles';
$tables_jointures['spip_articles']['id_auteur']= 'auteurs_articles';
$tables_jointures['spip_articles'][]= 'documents_liens';
$tables_jointures['spip_articles'][]= 'mots';
$tables_jointures['spip_articles'][]= 'signatures';
$tables_jointures['spip_articles'][]= 'petitions';

$tables_jointures['spip_auteurs'][]= 'auteurs_articles';

$tables_jointures['spip_breves'][]= 'mots_breves';
$tables_jointures['spip_breves'][]= 'documents_liens';
$tables_jointures['spip_breves'][]= 'mots';

$tables_jointures['spip_documents'][]= 'documents_liens';
$tables_jointures['spip_documents'][]= 'mots_documents';
$tables_jointures['spip_documents'][]= 'types_documents';
$tables_jointures['spip_documents'][]= 'mots';

$tables_jointures['spip_forum'][]= 'mots_forum';
$tables_jointures['spip_forum'][]= 'mots';
$tables_jointures['spip_forum'][]= 'documents_liens';

$tables_jointures['spip_rubriques'][]= 'mots_rubriques';
$tables_jointures['spip_rubriques'][]= 'documents_liens';
$tables_jointures['spip_rubriques'][]= 'mots';

$tables_jointures['spip_syndic'][]= 'mots_syndic';
$tables_jointures['spip_syndic'][]= 'mots';

$tables_jointures['spip_syndic_articles'][]= 'syndic';
$tables_jointures['spip_syndic_articles'][]= 'mots_syndic';
$tables_jointures['spip_syndic_articles'][]= 'mots';

$tables_jointures['spip_mots'][]= 'mots_articles';
$tables_jointures['spip_mots'][]= 'mots_breves';
$tables_jointures['spip_mots'][]= 'mots_forum';
$tables_jointures['spip_mots'][]= 'mots_rubriques';
$tables_jointures['spip_mots'][]= 'mots_syndic';
$tables_jointures['spip_mots'][]= 'mots_documents';

$tables_jointures['spip_groupes_mots'][]= 'mots';


global  $exceptions_des_jointures;
$exceptions_des_jointures['titre_mot'] = array('spip_mots', 'titre');
$exceptions_des_jointures['type_mot'] = array('spip_mots', 'type');
$exceptions_des_jointures['id_mot_syndic']= array('spip_mots_syndic','id_mot');
$exceptions_des_jointures['titre_mot_syndic']= array('spip_mots','titre');
$exceptions_des_jointures['type_mot_syndic']= array('spip_mots','type');
$exceptions_des_jointures['petition'] = array('spip_petitions', 'texte');
$exceptions_des_jointures['id_signature']= array('spip_signatures', 'id_signature');

global  $table_des_traitements;

define('_TRAITEMENT_TYPO', 'typo(%s, "TYPO", $connect)');
define('_TRAITEMENT_RACCOURCIS', 'propre(%s, $connect)');

$table_des_traitements['BIO'][]= _TRAITEMENT_RACCOURCIS;
$table_des_traitements['CHAPO'][]= _TRAITEMENT_RACCOURCIS;
$table_des_traitements['DATE'][]= 'normaliser_date(%s)';
$table_des_traitements['DATE_REDAC'][]= 'normaliser_date(%s)';
$table_des_traitements['DATE_MODIF'][]= 'normaliser_date(%s)';
$table_des_traitements['DATE_NOUVEAUTES'][]= 'normaliser_date(%s)';
$table_des_traitements['DESCRIPTIF'][]= _TRAITEMENT_RACCOURCIS;
$table_des_traitements['FICHIER']['documents']= 'get_spip_doc(%s)';
$table_des_traitements['INTRODUCTION'][]= 'PtoBR('. _TRAITEMENT_RACCOURCIS .')';
$table_des_traitements['LIEN_TITRE'][]= _TRAITEMENT_TYPO;
$table_des_traitements['LIEN_URL'][]= 'vider_url(%s)';
$table_des_traitements['MESSAGE'][]= _TRAITEMENT_RACCOURCIS;
$table_des_traitements['NOM_SITE_SPIP'][]= _TRAITEMENT_TYPO;
$table_des_traitements['NOM_SITE'][]=  _TRAITEMENT_TYPO;
$table_des_traitements['NOM'][]= _TRAITEMENT_TYPO;
$table_des_traitements['AUTEUR'][]= _TRAITEMENT_TYPO;
$table_des_traitements['PARAMETRES_FORUM'][]= 'htmlspecialchars(%s)';
$table_des_traitements['PS'][]= _TRAITEMENT_RACCOURCIS;
$table_des_traitements['SOURCE'][]= _TRAITEMENT_TYPO;
$table_des_traitements['SOUSTITRE'][]= _TRAITEMENT_TYPO;
$table_des_traitements['SURTITRE'][]= _TRAITEMENT_TYPO;
$table_des_traitements['TAGS'][]= '%s';
$table_des_traitements['TEXTE'][]= _TRAITEMENT_RACCOURCIS;
$table_des_traitements['TITRE'][]= _TRAITEMENT_TYPO;
$table_des_traitements['TYPE'][]= _TRAITEMENT_TYPO;
$table_des_traitements['DESCRIPTIF_SITE_SPIP'][]= _TRAITEMENT_RACCOURCIS;
$table_des_traitements['ENV'][]= 'entites_html(%s,true)';

$table_des_traitements['TEXTE']['forums']= "safehtml("._TRAITEMENT_RACCOURCIS.")";
$table_des_traitements['TITRE']['forums']= "safehtml("._TRAITEMENT_TYPO.")";
$table_des_traitements['NOTES']['forums']= "safehtml("._TRAITEMENT_RACCOURCIS.")";
$table_des_traitements['NOM_SITE']['forums']=  "safehtml("._TRAITEMENT_TYPO.")";
$table_des_traitements['URL_SITE']['forums']= 'safehtml(vider_url(%s))';
$table_des_traitements['AUTEUR']['forums']= 'safehtml(vider_url(%s))';
$table_des_traitements['EMAIL_AUTEUR']['forums']= 'safehtml(vider_url(%s))';

// gerer les sauts de ligne dans les textes des forums
$table_des_traitements['TEXTE']['forums'] =
	str_replace('%s', 'post_autobr(%s)',
	$table_des_traitements['TEXTE']['forums']
);


// Articles syndiques : passage des donnees telles quelles, sans traitement typo
// A noter, dans applique_filtres la securite et conformite XHTML de ces champs
// est assuree par safehtml()
foreach(array('TITRE','DESCRIPTIF','SOURCE') as $balise)
	if (!isset($table_des_traitements[$balise]['syndic_articles']))
		$table_des_traitements[$balise]['syndic_articles'] = '%s';

	// gerer l'affectation en 2 temps car si le pipe n'est pas encore declare, on ecrase les globales
	$interfaces = pipeline('declarer_tables_interfaces',
			array(
			'table_des_tables'=>$table_des_tables,
			'exceptions_des_tables'=>$exceptions_des_tables,
			'table_date'=>$table_date,
			'table_titre'=>$table_titre,
			'tables_jointures'=>$tables_jointures,
			'exceptions_des_jointures'=>$exceptions_des_jointures,
			'table_des_traitements'=>$table_des_traitements,
			));
	if ($interfaces){
			$table_des_tables = $interfaces['table_des_tables'];
			$exceptions_des_tables = $interfaces['exceptions_des_tables'];
			$table_date = $interfaces['table_date'];
			$table_titre = $interfaces['table_titre'];
			$tables_jointures = $interfaces['tables_jointures'];
			$exceptions_des_jointures = $interfaces['exceptions_des_jointures'];
			$table_des_traitements = $interfaces['table_des_traitements'];
	}
}

declarer_interfaces();

?>
