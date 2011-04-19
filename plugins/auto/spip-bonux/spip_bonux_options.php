<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Romy Tetue
 * Licence GPL
 * 
 */

 /**
 * une fonction qui regarde si $texte est une chaine de langue
 * de la forme <:qqch:>
 * si oui applique _T()
 * si non applique typo() suivant le mode choisi
 *
 * @param unknown_type $valeur Une valeur à tester. Si c'est un tableau, la fonction s'appliquera récursivement dessus.
 * @param string $mode_typo Le mode d'application de la fonction typo(), avec trois valeurs possibles "toujours", "jamais" ou "multi".
 * @return unknown_type Retourne la valeur éventuellement modifiée.
 */
function _T_ou_typo($valeur, $mode_typo='toujours') {
	
	// Si la valeur est bien une chaine (et pas non plus un entier déguisé)
	if (is_string($valeur) and !intval($valeur)){
		// Si la chaine est du type <:truc:> on passe à _T()
		if (preg_match('/^\<:(.*?):\>$/', $valeur, $match)) 
			$valeur = _T($match[1]);
		// Sinon on la passe a typo()
		else {
			if (!in_array($mode_typo, array('toujours', 'multi', 'jamais')))
				$mode_typo = 'toujours';
			
			if ($mode_typo == 'toujours' or ($mode_typo == 'multi' and strpos($valeur, '<multi>') !== false)){
				include_spip('inc/texte');
				$valeur = typo($valeur);
			}
		}
	}
	// Si c'est un tableau, on reapplique la fonction récursivement
	elseif (is_array($valeur)){
		foreach ($valeur as $cle => $valeur2){
			$valeur[$cle] = _T_ou_typo($valeur2, $mode_typo);
		}
	}

	return $valeur;

}

/*
 * Insère toutes les valeurs du tableau $arr2 après (ou avant) $cle dans le tableau $arr1.
 * Si $cle n'est pas trouvé, les valeurs de $arr2 seront ajoutés à la fin de $arr1.
 *
 * La fonction garde autant que possible les associations entre les clés. Elle fonctionnera donc aussi bien
 * avec des tableaux à index numérique que des tableaux associatifs.
 * Attention tout de même, elle utilise array_merge() donc les valeurs de clés étant en conflits seront écrasées.
 *
 * @param array $arr1 Tableau dans lequel se fera l'insertion
 * @param unknown_type $cle Clé de $arr1 après (ou avant) laquelle se fera l'insertion
 * @param array $arr2 Tableau contenant les valeurs à insérer
 * @param bool $avant Indique si l'insertion se fait avant la clé (par défaut c'est après)
 * @return array Retourne le tableau avec l'insertion
 */
function array_insert($arr1, $cle, $arr2, $avant=false){
	$index = array_search($cle, array_keys($arr1));
	if($index === false){
		$index = count($arr1); // insert @ end of array if $key not found
	}
	else {
		if(!$avant){
			$index++;
		}
	}
	$fin = array_splice($arr1, $index);
	return array_merge($arr1, $arr2, $fin);
}

/*
 * Une fonction extrêmement pratique, mais qui n'est disponible qu'à partir de PHP 5.3 !
 * cf. http://www.php.net/manual/fr/function.array-replace-recursive.php
 */
if (!function_exists('array_replace_recursive')){
	function array_replace_recursive($array, $array1){
		function recurse($array, $array1){
			foreach ($array1 as $key => $value){
				// create new key in $array, if it is empty or not an array
				if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key])))
					$array[$key] = array();
				// overwrite the value in the base array
				if (is_array($value))
					$value = recurse($array[$key], $value);
				$array[$key] = $value;
			}
			return $array;
		}

		// handle the arguments, merge one by one
		$args = func_get_args();
		$array = $args[0];
		if (!is_array($array))
			return $array;
		
		for ($i = 1; $i < count($args); $i++)
			if (is_array($args[$i]))
				$array = recurse($array, $args[$i]);
		
		return $array;
	}
}

if (defined('_BONUX_STYLE'))
	_chemin(_DIR_PLUGIN_SPIP_BONUX."spip21/");

?>
