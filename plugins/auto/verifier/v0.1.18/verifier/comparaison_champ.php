<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Compare la valeur avec un autre champ du _request().
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   Un éventuel tableau d'options.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_comparaison_champ_dist($valeur, $options=array()){
	include_spip('inc/filtres');
	
	// On vérifie qu'on a bien un champ à comparer
	if (!$champ = $options['champ'] or !is_scalar($champ)) return true;
	else $valeur_champ = _request($champ);
	
	// On cherche le nom du champ
	$nom_champ = $options['nom_champ'] ? $options['nom_champ'] : $champ;
	
	switch ($options['comparaison']){
		case 'petit':
			return $valeur < $valeur_champ ? '' : _T('verifier:erreur_comparaison_petit', array('nom_champ'=>$nom_champ));
			break;
		case 'petit_egal':
			return $valeur <= $valeur_champ ? '' : _T('verifier:erreur_comparaison_petit_egal', array('nom_champ'=>$nom_champ));
			break;
		case 'grand':
			return $valeur > $valeur_champ ? '' : _T('verifier:erreur_comparaison_grand', array('nom_champ'=>$nom_champ));
			break;
		case 'grand_egal':
			return $valeur >= $valeur_champ ? '' : _T('verifier:erreur_comparaison_grand_egal', array('nom_champ'=>$nom_champ));
			break;
		case 'egal_type':
			return $valeur === $valeur_champ ? '' : _T('verifier:erreur_comparaison_egal_type', array('nom_champ'=>$nom_champ));
			break;
		default:
			return $valeur == $valeur_champ ? '' : _T('verifier:erreur_comparaison_egal', array('nom_champ'=>$nom_champ));
			break;
	}
}

