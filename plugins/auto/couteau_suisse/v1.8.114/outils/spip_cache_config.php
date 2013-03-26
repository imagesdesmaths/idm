<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

# Fichier de configuration pris en compte par config_outils.php et specialement dedie a la configuration du cache SPIP
# --------------------------------------------------------------------------------------------------------------------

function outils_spip_cache_config_dist() {

// Ajout de l'outil 'spip_cache'
add_outil(array(
	'id' => 'spip_cache',
	'code:spip_options' => "%%radio_desactive_cache"
		.(defined('_SPIP19300')?'4%%%%compacte_prive%%%%compacte_tout':'3')
		."%%%%duree_cache%%%%duree_cache_mutu%%%%quota_cache%%%%derniere_modif_invalide%%",
	'categorie' => 'admin',
	'description' => 
		(defined('_SPIP19300')
			?'<:spip_cache:2:><:spip_cache::><:spip_cache:3:> [[%compacte_css%]][[->%compacte_js%]][[->%compacte_prive%]]'
				.(defined('_SPIP20200')?'[[->%compacte_tout%]]':'')
			:'<:spip_cache:1:><:spip_cache::>'),
));

// Ajout des variables utilisees ci-dessus
add_variables(

// SPIP<=1.92
array(
	'nom' => 'radio_desactive_cache3',
	'format' => _format_NOMBRE,
	'radio' => array(0 => 'couteauprive:cache_nornal', 1 => 'couteauprive:cache_sans'),
	'defaut' => 0,
	// si la variable est egale a 1, on code (jquery.js et forms_styles.css restent en cache)
	'code:%s' => defined('_SPIP19300')?'':"\$cs_fond = isset(\$GLOBALS['fond'])?\$GLOBALS['fond']:_request('page');
if (!in_array(\$cs_fond, array('jquery.js','forms_styles.css'))) \$_SERVER['REQUEST_METHOD']='POST';\n",
),

/*
pour SPIP 2.0 :
 define('_NO_CACHE',0); -> toujours prendre tous les fichiers en cache
 define('_NO_CACHE',-1); -> ne jamais utiliser le cache ni meme creer les fichiers cache
 define('_NO_CACHE',1); -> ne pas utiliser le fichier en cache, mais stocker le resultat du calcul dans le fichier cache
 La fonction cache_valide() retourne :
	'1' si il faut mettre le cache a jour, '0' si le cache est valide, '-1' s'il faut calculer sans stocker en cache
*/
array(
	'nom' => 'radio_desactive_cache4',
	'format' => _format_NOMBRE,
	'radio' => array(2 => 'couteauprive:cache_nornal', 0 => 'couteauprive:cache_permanent', -1 => 'couteauprive:cache_sans', 1 => 'couteauprive:cache_controle'),
	'radio/ligne' => 2,
	'defaut' => 2,
	'code:%s!=2' => "define('_NO_CACHE',%s);\n",
), array(
	'nom' => 'duree_cache',
	'format' => _format_NOMBRE,
	'defaut' => "24", // 1 jour
	'code' => "\$GLOBALS['delais']=%s*3600;\n",
), array(
	'nom' => 'duree_cache_mutu',
	'format' => _format_NOMBRE,
	'defaut' => "24", // 1 jour
	'code:%s!=24' => "define('_DUREE_CACHE_DEFAUT', %s*3600);\n",
), array(
	'nom' => 'quota_cache',
	'format' => _format_NOMBRE,
	'defaut' => 10, // 10 Mo
	'code:%s!=10' => "\$GLOBALS['quota_cache']=%s;\n",
), array(
	'nom' => 'derniere_modif_invalide',
	'format' => _format_NOMBRE,
	'radio' => array(0 => 'item_oui', 1 => 'item_non'),
	'defaut' => 0,
	'code:%s' => "\$GLOBALS['derniere_modif_invalide']=false;\n",
), array(
	'nom' => 'compacte_tout',
	'check' => 'couteauprive:compacte_tout',
	'defaut' => 0,
	'code:%s' => "define('_INTERDIRE_COMPACTE_HEAD',1);\n",
), array(
	'nom' => 'compacte_prive',
	'check' => 'couteauprive:compacte_prive',
	'defaut' => 0,
	'code:%s' => "define('_INTERDIRE_COMPACTE_HEAD_ECRIRE',1);\n",
), array(
	'nom' => 'compacte_css',
	'check' => 'couteauprive:compacte_css',
	// variable externe au Couteau Suisse
	'externe' => "\$GLOBALS['meta']['auto_compress_css']=='oui'",
	// action lors d'un changement de valeur
	'action' => "ecrire_meta('auto_compress_css', %s?'oui':non);",
), array(
	'nom' => 'compacte_js',
	'check' => 'couteauprive:compacte_js',
	'externe' => "\$GLOBALS['meta']['auto_compress_js']=='oui'",
	'action' => "ecrire_meta('auto_compress_js', %s?'oui':non);",
));

}

?>