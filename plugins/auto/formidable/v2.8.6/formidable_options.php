<?php

/**
 * Options globales chargées à chaque hit
 *
 * @package SPIP\Formidable\Options
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;


/* déclaration des différentes variables utilisées pour effectuer l'anonymisation */
$GLOBALS['formulaires']['variables_anonymisation'] = array(
	'remote_user' => '$_SERVER["REMOTE_USER"]',
	'php_auth_user' => '$_SERVER["PHP_AUTH_USER"]',
);

/*
* on se contente d'initialiser si ces variable si elles ne
* le sont pas dans mes_options.php de l'instance
*/
if (isset($GLOBALS['formulaires']['passwd']) == false) {
	$GLOBALS['formulaires']['passwd'] = array(
		'interne' => 'palabresecreta',
	);
}

if (!function_exists('array_fill_keys')) {
    /**
     * Remplit un tableau avec des valeurs, en spécifiant les clés
     *
     * Fonction dans PHP 5.2+
     * @see http://php.net/manual/fr/function.array-fill-keys.php
     *
     * @param array $keys
     *     Tableau de valeurs qui sera utilisé comme clés.
     * @param mixed $value
     *     Valeur à utiliser pour remplir le tableau.
     * @return array
     *     Le tableau rempli.
    **/
    function array_fill_keys($keys, $value){
        array_combine($keys,array_fill(0,count($keys),$value));
    }
}

?>
