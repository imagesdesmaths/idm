<?php
if (!defined("_ECRIRE_INC_VERSION")) return;


/* 
 * Déclarer les nouveaux champs et 
 * les nouvelles infos des objets éditoriaux
 * 
 * /!\ Ne pas utiliser table_objet() qui ferait une reentrance et des calculs faux.
 */
function cextras_declarer_tables_objets_sql($tables){

	include_spip('inc/cextras');
	
	// recuperer les champs crees par les plugins
	// array($table => array(Liste de saisies))
	include_spip('inc/saisies');
	$saisies_tables = pipeline('declarer_champs_extras', array());
	foreach ($saisies_tables as $table => $saisies) {
		if (isset($tables[$table])) {
			$saisies = saisies_lister_avec_sql($saisies);
			foreach ($saisies as $saisie) {
				$nom = $saisie['options']['nom'];
				if (!isset($tables[$table]['field'][$nom])) {
					$tables[$table]['field'][$nom] = $saisie['options']['sql'];
				}
				if (isset($saisie['options']['rechercher'])) {
					$ponderation = $saisie['options']['rechercher'];
					if ($ponderation === 'on' OR $ponderation === true) {
						$ponderation = 2;
					} else {
						$ponderation = intval($ponderation);
					}
					$tables[$table]['rechercher_champs'][$nom] = $ponderation;
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
**/
function cextras_declarer_tables_interfaces($interface){

	include_spip('inc/cextras');
	
	// recuperer les champs crees par les plugins
	$saisies_tables = pipeline('declarer_champs_extras', array());
	if (!$saisies_tables) {
		return $interface;
	}
	
	include_spip('inc/saisies');
	foreach ($saisies_tables as $table=>$saisies) {
		$saisies = saisies_lister_avec_sql($saisies);
		$saisies = saisies_lister_avec_traitements($saisies);
		
		foreach ($saisies as $saisie) {
			$traitement = $saisie['options']['traitements'];
			$balise = strtoupper($saisie['options']['nom']);
			// definir
			if (!isset($interface['table_des_traitements'][$balise])) {
				$interface['table_des_traitements'][$balise] = array();
			}
			// le traitement peut etre le nom d'un define
			$traitement = defined($traitement) ? constant($traitement) : $traitement;
	
			// SPIP 3 permet de declarer par la table sql directement.
			$interface['table_des_traitements'][$balise][$table] = $traitement;		
			
		}
	}

	// ajouter les champs au tableau spip
	return $interface;
}


?>
