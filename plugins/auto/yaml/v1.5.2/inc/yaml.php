<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

# textwheel fournit yaml_decode() aussi...
# include_spip('inc/yaml-mini');

# wrapper de la class sfYAML pour SPIP
#
# fournit deux fonctions pour YAML,
# analogues a json_encode() et json_decode
#
# Regle de dev: ne pas se rendre dependant de la lib sous-jacente

// Si on est en PHP4
 if (version_compare(PHP_VERSION, '5.0.0', '<'))
	define('_LIB_YAML','spyc-php4'); 
 else {
	// temporaire le temps de tester spyc
	define('_LIB_YAML','sfyaml'); 
	#define('_LIB_YAML','spyc'); 
}
/*
 * Encode n'importe quelle structure en yaml
 * @param $struct
 * @return string
 */
function yaml_encode($struct, $opt = array()) {
	// Si PHP4
	if (_LIB_YAML == 'spyc-php4') {
		require_once _DIR_PLUGIN_YAML.'spyc/spyc-php4.php';
		return Spyc::YAMLDump($struct);
	}
	// test temporaire
	if (_LIB_YAML == 'spyc') {
		require_once _DIR_PLUGIN_YAML.'spyc/spyc.php';
		return Spyc::YAMLDump($struct);
	}

	require_once _DIR_PLUGIN_YAML.'inc/yaml_sfyaml.php';
	return yaml_sfyaml_encode($struct, $opt);
}

/*
 * Decode un texte yaml, renvoie la structure
 * @param string $input
 *        boolean $show_error  true: arrete le parsing et retourne erreur en cas d'echec  - false: retourne un simple false en cas d'erreur de parsing
 */
if (!function_exists('yaml_decode')) {
function yaml_decode($input,$show_error=true) {
	// Si PHP4
	if (_LIB_YAML == 'spyc-php4') {
		require_once _DIR_PLUGIN_YAML.'spyc/spyc-php4.php';
		return Spyc::YAMLLoad($input);
	}
	// test temporaire
	if (_LIB_YAML == 'spyc') {
		require_once _DIR_PLUGIN_YAML.'spyc/spyc.php';
		return Spyc::YAMLLoad($input);
	}

	require_once _DIR_PLUGIN_YAML.'inc/yaml_sfyaml.php';
	return yaml_sfyaml_decode($input,$show_error);
}
}

/*
 * Decode un fichier en utilisant yaml_decode
 * @param string $fichier 
 */
function yaml_decode_file($fichier){
	$yaml = '';
	$retour = false;
	
	lire_fichier($fichier, $yaml);
	// Si on recupere bien quelque chose
	if ($yaml){
		$retour = yaml_decode($yaml);
	}
	
	return $retour;
}

/*
 * Charge les inclusions de YAML dans un tableau
 * Les inclusions sont indiquees dans le tableau via la valeur 'inclure:rep/fichier.yaml' ou rep indique le chemin relatif.
 * On passe donc par find_in_path() pour trouver le fichier
 * @param array $tableau
 */

function yaml_charger_inclusions($tableau){
	if (is_array($tableau)){
		$retour = array();
		foreach($tableau as $cle => $valeur) {
			if (is_string($valeur) && substr($valeur,0,8)=='inclure:' && substr($valeur,-5)=='.yaml')
				$retour = array_merge($retour,yaml_charger_inclusions(yaml_decode_file(find_in_path(substr($valeur,8)))));
			elseif (is_array($valeur))
				$retour = array_merge($retour,array($cle => yaml_charger_inclusions($valeur)));
			else
				$retour = array_merge($retour,array($cle => $valeur));
		}
		return $retour;
	}
	elseif (is_string($tableau) && substr($tableau,0,8)=='inclure:' && substr($tableau,-5)=='.yaml')
		return yaml_charger_inclusions(yaml_decode_file(find_in_path(substr($tableau,8))));
	else
		return $tableau;
}

?>
