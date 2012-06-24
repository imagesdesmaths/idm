<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Fonction de base de l'API de vérification.
 * @param mixed $valeur La valeur a verifier.
 * @param string $type Le type de verification a appliquer.
 * @param array $options Un eventuel tableau d'options suivant le type.
 * @return string Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function inc_verifier_dist($valeur, $type, $options=null){

	// On vérifie que les options sont bien un tableau
	if (!is_array($options))
		$options = array();

	// Si la valeur est vide, il n'y a rien a verifier donc c'est bon
	if (is_null($valeur) or (is_string($valeur) and $valeur == '')) return '';

	// On cherche si une fonction correspondant au type existe
	if ($verifier = charger_fonction($type, 'verifier',true)){
		$erreur = $verifier($valeur, $options);
	}

	// On passe le tout dans le pipeline du meme nom
	$erreur = pipeline(
		'verifier',
		array(
			'args' => array(
				'valeur' => $valeur,
				'type' => $type,
				'options' => $options
			),
			'data' => $erreur
		)
	);

	return $erreur;
}

/**
 * Liste toutes les vérifications possibles
 *
 * @return Retourne un tableau listant les vérifications et leurs options
 */
function verifier_lister_disponibles(){
	static $verifications = null;
	
	if (is_null($verifications)){
		$verifications = array();
		$liste = find_all_in_path('verifier/', '.+[.]yaml$');
		
		if (count($liste)){
			foreach ($liste as $fichier=>$chemin){
				$type_verif = preg_replace(',[.]yaml$,i', '', $fichier);
				$dossier = str_replace($fichier, '', $chemin);
				// On ne garde que les vérifications qui ont bien la fonction !
				if (charger_fonction($type_verif, 'verifier', true)
					and (
						is_array($verif = verifier_charger_infos($type_verif))
					)
				){
					$verifications[$type_verif] = $verif;
				}
			}
		}
	}
	
	return $verifications;
}

/**
 * Charger les informations contenues dans le yaml d'une vérification
 *
 * @param string $type_verif Le type de la vérification
 * @return array Un tableau contenant le YAML décodé
 */
function verifier_charger_infos($type_verif){
	include_spip('inc/yaml');
	$fichier = find_in_path("verifier/$type_verif.yaml");
	$verif = yaml_decode_file($fichier);
	if (is_array($verif)){
		$verif['titre'] = $verif['titre'] ? _T_ou_typo($verif['titre']) : $type_verif;
		$verif['description'] = $verif['description'] ? _T_ou_typo($verif['description']) : '';
		$verif['icone'] = $verif['icone'] ? find_in_path($verif['icone']) : '';
	}
	return $verif;
}

?>
