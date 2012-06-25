<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Vérifie que la valeur correspond à un id_dcoument valide
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_id_document_dist($valeur, $options=array()){
	$erreur = '';
	
	if ($valeur !== '') {
		// On vérifie déjà qu'il s'agit d'un nombre
		if(!is_numeric($valeur))
			$erreur = _T('verifier:erreur_id_document');
		// Puis qu'il y a au moins un document avec cet id
		elseif (!sql_countsel('spip_documents',"id_document=$valeur"))
			$erreur = _T('verifier:erreur_id_document');
	}
	
	return $erreur;
}

?>
