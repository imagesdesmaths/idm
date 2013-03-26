<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Validation d'un SIREN ou d'un SIRET 
 *
 * 1/ Un SIREN comporte STRICTEMENT 9 caractères
 * 1b/ Un SIRET comporte strictement 14 caractères
 * 2/ Un siren/siret utilise une clef de controle "1-2"
 *    Un siren/siret est donc valide si la somme des chiffres pairs
 *    + la somme du double de tous les chiffres impairs (16 = 1+6 = 7) est un multiple de 10
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   Indique s'il faut tester le SIREN ou le SIRET.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_siren_siret_dist($valeur, $options=array()){
	if (!$options['mode'] or !in_array($options['mode'], array('siren', 'siret'))){
		$mode = 'siren';
	}
	else{
		$mode = $options['mode'];
	}

	// on supprime les espaces avant d'effectuer les tests
	$valeur = preg_replace('/\s/', '', $valeur);

	// Test de SIREN
	if ($mode == 'siren'){
		$erreur = _T('verifier:erreur_siren');
		if (!is_string($valeur))
			return $erreur;

		// Si pas 9 caractère, c'est déjà foiré !
		if(!preg_match('/^[0-9]{9}$/',$valeur)) return $erreur;
	
		// On vérifie la clef de controle "1-2"
		$somme = 0;
		$i = 0; // Les impaires
		while($i < 9){ $somme += $valeur[$i]; $i+=2; }
		$i = 1; // Les paires !
		while($i < 9){ if((2*$valeur[$i])>9) $somme += (2*$valeur[$i])-9; else $somme += 2*$valeur[$i]; $i+=2; }
	
		if ($somme % 10) return $erreur;
	}
	// Test de SIRET
	else{
		$erreur = _T('verifier:erreur_siret');
		if (!is_string($valeur))
			return $erreur;

		// Si pas 14 caractère, c'est déjà foiré !
		if(!preg_match('/^[0-9]{14}$/',$valeur)) return $erreur;
		if(preg_match('/[0]{8}/',$valeur)) return $erreur;

		// Pour le SIRET on vérifie la clef de controle "1-2" avec les impaires *2
		// (vs pairs*2 pour SIREN, parce qu'on part de la fin)
		$somme = 0;
		$i = 1; // Les paires
		while($i < 14){ $somme += $valeur[$i]; $i+=2; }
		$i = 0; // Les impaires !
		while($i < 14){ if((2*$valeur[$i])>9) $somme += (2*$valeur[$i])-9; else $somme += 2*$valeur[$i]; $i+=2; }
	
		if($somme % 10) return $erreur;
	}
	
	return '';
}
