<?php

/**
 * Déclaration colonnes SQL des champs extras
 *
 * @package SPIP\Cextras\Pipelines
**/

// sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * Déclarer les nouveaux champs et les nouvelles infos des objets éditoriaux
 *
 * La fonction déclare tous les champs extras (saisies de type sql).
 *
 * Elle déclare aussi, en fonction des options choisies pour les champs
 * - la recherche dans le champs, avec une certaine pondération,
 * - le versionnage de champ
 * 
 * @note
 *     Ne pas utiliser dans le code de cette fonction
 *     table_objet() qui ferait une réentrance et des calculs faux.
 * 
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function cextras_declarer_tables_objets_sql($tables){

	include_spip('inc/cextras');
	
	// recuperer les champs crees par les plugins
	// array($table => array(Liste de saisies))
	include_spip('inc/saisies');
	
	// si saisies a ete supprime par ftp, on sort tranquilou sans tuer SPIP.
	// champs extras sera ensuite desactive par admin plugins.
	if (!function_exists('saisies_lister_avec_sql')) {
		return $tables;
	}
	
	$saisies_tables = pipeline('declarer_champs_extras', array());
	foreach ($saisies_tables as $table => $saisies) {
		if (isset($tables[$table])) {
			$saisies = saisies_lister_avec_sql($saisies);
			foreach ($saisies as $saisie) {
				$nom = $saisie['options']['nom'];
				if (!isset($tables[$table]['field'][$nom])) {
					$tables[$table]['field'][$nom] = $saisie['options']['sql'];
				}
				// on l'ajoute dans la liste des champs editables
				if (isset($tables[$table]['champs_editables'])
				  and !in_array($nom, $tables[$table]['champs_editables'])){
					$tables[$table]['champs_editables'][] = $nom;
				}

				// ajouter le champ dans les analyses de recherche si demande
				// l'option rechercher peut valoir 'on', true, ou 5 (entier) pour l'indice de ponderation
				// par defaut, la ponderation est de 2.
				if (isset($saisie['options']['rechercher']) and $saisie['options']['rechercher']) {
					$ponderation = $saisie['options']['rechercher'];
					if ($ponderation === 'on' OR $ponderation === true) {
						// le plugin d'interface donne la valeur de ponderation dans une option separee.
						if (isset($saisie['options']['rechercher_ponderation']) and $saisie['options']['rechercher_ponderation']) {
							$ponderation = intval($saisie['options']['rechercher_ponderation']);
						} else {
							$ponderation = 2;
						}
					} else {
						$ponderation = intval($ponderation);
					}
					$tables[$table]['rechercher_champs'][$nom] = $ponderation;
				}
				// option de versionnage ?
				if (isset($saisie['options']['versionner']) and $saisie['options']['versionner']) {
					// on l'ajoute dans la liste des champs versionnables
					if (isset($tables[$table]['champs_versionnes'])
					  and !in_array($nom, $tables[$table]['champs_versionnes'])) {
						$tables[$table]['champs_versionnes'][] = $nom;
					}
				}
			}
		}
	}

	return $tables;
}


/**
 * Déclarer les nouvelles infos sur les champs extras ajoutés
 * en ce qui concerne les traitements automatiques sur les balises.
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
**/
function cextras_declarer_tables_interfaces($interfaces){

	include_spip('inc/cextras');
	include_spip('inc/saisies');

	// si saisies a ete supprime par ftp, on sort tranquilou sans tuer SPIP.
	// champs extras sera ensuite desactive par admin plugins.
	if (!function_exists('saisies_lister_avec_sql')) {
		return $tables;
	}

	// recuperer les champs crees par les plugins
	$saisies_tables = pipeline('declarer_champs_extras', array());
	if (!$saisies_tables) {
		return $interfaces;
	}

	foreach ($saisies_tables as $table=>$saisies) {
		$saisies = saisies_lister_avec_sql($saisies);
		$saisies = saisies_lister_avec_traitements($saisies);

		foreach ($saisies as $saisie) {
			$traitement = $saisie['options']['traitements'];
			$balise = strtoupper($saisie['options']['nom']);
			// definir
			if (!isset($interfaces['table_des_traitements'][$balise])) {
				$interfaces['table_des_traitements'][$balise] = array();
			}
			// le traitement peut etre le nom d'un define
			$traitement = defined($traitement) ? constant($traitement) : $traitement;

			// SPIP 3 permet de declarer par la table sql directement.
			$interfaces['table_des_traitements'][$balise][$table] = $traitement;

		}
	}

	// ajouter les champs au tableau spip
	return $interfaces;
}


?>
