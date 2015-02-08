<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if(!defined("_ECRIRE_INC_VERSION")) return;

// Ici se definissent les constantes du Couteau Suisse

// RSS de trac
@define('_CS_RSS_SOURCE', 'http://zone.spip.org/trac/spip-zone/log/_plugins_/couteau_suisse?format=rss&mode=stop_on_copy&limit=20');
// Doc de contrib.spip.net
@define('_URL_CONTRIB', 'http://contrib.spip.net/?article');
// Revisions du CS
@define('_URL_CS_PLUGIN_XML', 'http://zone.spip.org/trac/spip-zone/browser/_plugins_/couteau_suisse/plugin.xml?format=txt');
// On met a jour le flux rss toutes les 2 heures
define('_CS_RSS_UPDATE', 2*3600);
define('_CS_RSS_COUNT', 15);
// Fichier 
define('_CS_TMP_RSS', _DIR_TMP.'rss_couteau_suisse.html');
// Traductions des modules
define('_CS_TRAD_ACCUEIL', 'http://trad.spip.org/');
define('_CS_TRAD_MODULE', _CS_TRAD_ACCUEIL.'tradlang_module/');


// Qui sont les webmestres et les administrateurs ?
function get_liste_administrateurs() {
	include_spip('inc/autoriser');
	include_spip('inc/texte');
	$admins = $webmestres = array();
	$s = spip_query("SELECT * FROM spip_auteurs WHERE statut='0minirezo'");
	$fetch = function_exists('sql_fetch')?'sql_fetch':'spip_fetch_array'; // compatibilite SPIP 1.92
	while ($qui = $fetch($s)) {
		$nom = '<a href="'
			. generer_url_ecrire(defined('_SPIP30000')?'auteur':'auteur_infos',"id_auteur=$qui[id_auteur]")
			. '">' . typo($qui['nom']."</a> (id_auteur=$qui[id_auteur])");
		if(autoriser('webmestre','','',$qui)) $webmestres[$qui['id_auteur']] = $nom;
		else if(autoriser('configurer','plugins','',$qui)) $admins[$qui['id_auteur']] = $nom;
	}
	return array(
		count($webmestres)?join(', ', $webmestres):_T('couteauprive:variable_vide'), 
		count($admins)?join(', ', $admins):_T('couteauprive:variable_vide'));
}

// Polices disponibles
function get_liste_fonts() {
	return array_keys(find_all_in_path('polices/', '\w+\.ttf$'));
}

// Montrer le fichier mes_options.php en cours
function show_file_options() {
	return cs_root_canonicalize(cs_spip_file_options(3));
}

?>