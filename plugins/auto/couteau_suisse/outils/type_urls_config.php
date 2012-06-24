<?php

#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://www.spip-contrib.net/?article2166   #
#-----------------------------------------------------#
if (!defined("_ECRIRE_INC_VERSION")) return;

# Fichier de configuration pris en compte par config_outils.php et specialement dedie a la configuration des URLs
# ---------------------------------------------------------------------------------------------------------------

# TODO : implementer les constantes _url_propres_sep_id, _URLS_ARBO_MIN, etc. !!

function outils_type_urls_config_dist() {

// Ajout de l'outil 'type_urls'
add_outil(array(
	'id' => 'type_urls',
	'code:spip_options' => "%%radio_type_urls3%%%%spip_script%%
switch(\$GLOBALS['type_urls']) {
	case 'page':%%terminaison_urls_page%%%%separateur_urls_page%%break;
	case 'propres':%%url_max_propres%%%%debut_urls_propres%%%%terminaison_urls_propres%%%%marqueurs_urls_propres%%break;
	case 'propres2':%%url_max_propres2%%%%debut_urls_propres2%%%%marqueurs_urls_propres2%%break;
	case 'libres':%%url_max_libres%%%%debut_urls_libres%%%%terminaison_urls_libres%%break;
	case 'arbo':%%url_max_arbo%%%%url_arbo_minuscules%%%%url_arbo_sep_id%%%%terminaison_urls_arbo%%%%urls_arbo_sans_type%%break;
	case 'propres_qs':%%url_max_propres_qs%%%%terminaison_urls_propres_qs%%%%marqueurs_urls_propres_qs%%break;
	case 'propres-qs':%%url_max_propres_qs%%%%terminaison_urls_propres_qs%%break;
}",
	'categorie' => 'admin',
	// TODO : Dependance du plugin "Urls Etendues" sous SPIP 2.1
	'description' => '<:type_urls::>'
		// Tronc commun sous SPIP 2.0
		.(defined('_SPIP19300')?'<radio_type_urls3 valeur="propres/propres2/libres/arbo/propres_qs"><:type_urls:1:>[[%urls_avec_id%]][[->%urls_avec_id2%]][[->%urls_id_3_chiffres%]][[->%urls_id_sauf_rubriques%]][[->%urls_id_sauf_liste%]]</radio_type_urls3>':''),
	defined('_SPIP20100')
		?'pipelinecode:arbo_creer_chaine_url, pipelinecode:propres_creer_chaine_url'
		:'pipelinecode:creer_chaine_url'
		 => "\$id = \$flux['objet']['id_objet']; \$ok = true;
if(%%urls_id_sauf_rubriques%%)  {\$ok = strpos(':%%urls_id_sauf_liste%%:',':'.\$flux['objet']['type'].':')===false;}
if(%%urls_id_3_chiffres%%) {\$id = sprintf('%03d', \$id);}
if(%%urls_avec_id2%%) {@define('_CS_URL_SEP','-'); if(\$ok) \$flux['data']=\$id._CS_URL_SEP.\$flux['data'];}
if(%%urls_avec_id%%) {@define('_CS_URL_SEP',','); if(\$ok) \$flux['data'].=_CS_URL_SEP.\$id;}
if(%%urls_minuscules%%) {\$flux['data']=strtolower(\$flux['data']);}",
));

// Ajout des variables utilisees ci-dessus
add_variables(

// ici on a besoin de boutons radio : 'page', 'html', 'propres', 'propres2, 'arbo', 'libres', 'standard' et 'propres-qs'
array(
	'nom' => 'radio_type_urls3',
	'format' => _format_CHAINE,
	'radio' => defined('_SPIP19300')
				// a partir de SPIP 2.0
				?array('page' => 'couteauprive:url_page',
					 'html' => 'couteauprive:url_html', 
					 'propres' => 'couteauprive:url_propres',
					 'propres2' => 'couteauprive:url_propres2',
					 'libres'=> 'couteauprive:url_libres',
					 'arbo'=> 'couteauprive:url_arbo',
					 'standard' => 'couteauprive:url_standard',
					 'propres_qs' => 'couteauprive:url_propres_qs')
				// max SPIP 1.92
				:array('page' => 'couteauprive:url_page',
					 'html' => 'couteauprive:url_html', 
					 'propres' => 'couteauprive:url_propres',
					 'propres2' => 'couteauprive:url_propres2',
					 'standard' => 'couteauprive:url_standard',
					 'propres-qs' => 'couteauprive:url_propres-qs'),
	'radio/ligne' => 4,
	'defaut' => "'page'",
	'code' => "\$GLOBALS['type_urls']=%s;\n",
),

# Utilise par 'page' (toutes les URLs) et 'propre' 'propre2' 'libres' et 'arbo' pour les objets non reconnus
# fonction d'appel dans inc/utils.php : get_spip_script()

array(
	'nom' => 'spip_script',
	'format' => _format_CHAINE,
	'defaut' => "'spip.php'",
	'code' => "define('_SPIP_SCRIPT', %s);\n",
),

///////////  define('URLS_PAGE_EXEMPLE', 'spip.php?article12'); /////////////////

#######
# on peut indiquer '.html' pour faire joli
#define ('_terminaison_urls_page', '');
# ci-dessous, ce qu'on veut ou presque (de preference pas de '/')
# attention toutefois seuls '' et '=' figurent dans les modes de compatibilite
#define ('_separateur_urls_page', '');
# on peut indiquer '' si on a installe le .htaccess
#define ('_debut_urls_page', get_spip_script('./').'?');
#######

array(
	'nom' => 'terminaison_urls_page',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'code:strlen(%s)' => "define('_terminaison_urls_page', %s);",
), array(
	'nom' => 'separateur_urls_page',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'code:strlen(%s)' => "define('_separateur_urls_page', %s);",
),

///////////  define('URLS_ARBO_EXEMPLE', '/article/Titre'); /////////////////

array(
	'nom' => 'url_arbo_minuscules',
	'format' => _format_NOMBRE,
	'radio' => array(0 => 'item_oui', 1 => 'item_non'),				
	'defaut' => 1,
	'code:!%s' => "define('_url_arbo_minuscules', %s);",
), array(
	'nom' => 'urls_arbo_sans_type',
	'format' => _format_NOMBRE,
	'radio' => array(0 => 'item_oui', 1 => 'item_non'),				
	'defaut' => 1,
	'code:%s' => "\n\$GLOBALS['url_arbo_types']=array('rubrique'=>'','article'=>'','breve'=>'','mot'=>'','auteur'=>'','site'=>'');",
), array(
	'nom' => 'url_arbo_sep_id',
	'format' => _format_CHAINE,
	'defaut' => "'-'",
	'code' => "define('_url_arbo_sep_id', %s);",
), array(
	'nom' => 'url_max_arbo',
	'format' => _format_NOMBRE,
	'defaut' => 35,
	'label' => '<:label:url_max_propres:>',
	'code' => "define('_URLS_ARBO_MAX', %s);",
), array(
	'nom' => 'terminaison_urls_arbo',
	'format' => _format_CHAINE,
	'defaut' => "'.html'",
	'label' => '<:label:terminaison_urls_page:>',
	'code' => "define('_terminaison_urls_arbo', %s);",
),

///////////  define('URLS_PROPRES_EXEMPLE', 'Titre-de-l-article -Rubrique-'); /////////////////

array(
	'nom' => 'terminaison_urls_propres',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'label' => '<:label:terminaison_urls_page:>',
	'code:strlen(%s)' => "define('_terminaison_urls_propres', %s);",
), array(
	'nom' => 'url_max_propres',
	'format' => _format_NOMBRE,
	'defaut' => 35,
	'code' => "define('_URLS_PROPRES_MAX', %s);",
), array(
	'nom' => 'debut_urls_propres',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'code:strlen(%s)' => "define('_debut_urls_propres', %s);",
), array(
	'nom' => 'marqueurs_urls_propres',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),				
	'defaut' => 1,
	'code:!%s' => "define('_MARQUEUR_URL', false);"
), array(
	'nom' => 'url_max_propres2',
	'format' => _format_NOMBRE,
	'defaut' => 35,
	'label' => '<:label:url_max_propres:>',
	'code' => "define('_URLS_PROPRES_MAX', %s);",
), array(
	'nom' => 'debut_urls_propres2',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'label' => '<:label:debut_urls_propres:>',
	'code:strlen(%s)' => "define('_debut_urls_propres', %s);",
), array(
	'nom' => 'marqueurs_urls_propres2',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),				
	'defaut' => 1,
	'label' => '<:label:marqueurs_urls_propres:>',
	'code:!%s' => "define('_MARQUEUR_URL', false);"
), array(
	'nom' => 'terminaison_urls_libres',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'label' => '<:label:terminaison_urls_page:>',
	'code:strlen(%s)' => "define('_terminaison_urls_propres', %s);",
), array(
	'nom' => 'url_max_libres',
	'format' => _format_NOMBRE,
	'defaut' => 35,
	'label' => '<:label:url_max_propres:>',
	'code' => "define('_URLS_PROPRES_MAX', %s);",
), array(
	'nom' => 'debut_urls_libres',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'label' => '<:label:debut_urls_propres:>',
	'code:strlen(%s)' => "define('_debut_urls_propres', %s);",
), array(
	'nom' => 'terminaison_urls_propres_qs',
	'format' => _format_CHAINE,
	'defaut' => "''",
	'label' => '<:label:terminaison_urls_page:>',
	'code:strlen(%s)' => "define('_terminaison_urls_propres', %s);",
), array(
	'nom' => 'url_max_propres_qs',
	'format' => _format_NOMBRE,
	'defaut' => 35,
	'label' => '<:label:url_max_propres:>',
	'code' => "define('_URLS_PROPRES_MAX', %s);",
), array(
	'nom' => 'marqueurs_urls_propres_qs',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),				
	'defaut' => 1,
	'label' => '<:label:marqueurs_urls_propres:>',
	'code:!%s' => "define('_MARQUEUR_URL', false);",
),

array(
	'nom' => 'urls_minuscules',
	'check' => 'couteauprive:urls_minuscules',
	'label' => '@_CS_CHOIX@',
	'defaut' => 0,
), array(
	'nom' => 'urls_avec_id',
	'check' => 'couteauprive:urls_avec_id',
	'defaut' => 0,
), array(
	'nom' => 'urls_avec_id2',
	'check' => 'couteauprive:urls_avec_id2',
	'defaut' => 0,
), array(
	'nom' => 'urls_id_3_chiffres',
	'check' => 'couteauprive:urls_3_chiffres',
	'defaut' => 0,
), array(
	'nom' => 'urls_id_sauf_rubriques',
	'check' => 'couteauprive:urls_id_sauf_rubriques',
	'defaut' => 0,
), array(
	'nom' => 'urls_id_sauf_liste',
	'format' => _format_CHAINE,
	'defaut' => "'rubrique:auteur'",
));}

?>