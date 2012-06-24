<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Retourne la definition de la barre markitup designee.
 * (cette declaration est au format json)
 * 
 * Deux pipelines 'porte_plume_pre_charger' et 'porte_plume_charger' 
 * permettent de recuperer l'objet de classe Barre_outil
 * avant son export en json pour modifier des elements.
 * 
 * @return string : declaration json
 */
function porte_plume_creer_json_markitup(){
	// on recupere l'ensemble des barres d'outils connues
	include_spip('porte_plume_fonctions');
	if (!$sets = barre_outils_liste()) {
		return null;
	}

	// 1 on initialise tous les jeux de barres
	$barres = array();
	foreach($sets as $set) {
		if (($barre = barre_outils_initialiser($set)) AND is_object($barre))
			$barres[$set] = $barre;
	}
	
	// 2 prechargement
	// charge des nouveaux boutons au besoin
	// exemples : 
	//		$barre = &$flux['spip'];
	//  	$barre->ajouterApres('bold',array(params));
	//  	$barre->ajouterAvant('bold',array(params));		
	// 
	//  	$bold = $barre->get('bold');
	//  	$bold['id'] = 'bold2';
	//  	$barre->ajouterApres('italic',$bold);
	$barres = pipeline('porte_plume_barre_pre_charger', $barres);


	// 3 chargement
	// 		permet de cacher ou afficher certains boutons au besoin
	// 		exemples :
	//		$barre = &$flux['spip'];
	//  	$barre->afficher('bold');
	//  	$barre->cacher('bold');
	//
	//		$barre->cacherTout();
	//		$barre->afficher(array('bold','italic','header1'));
	$barres = pipeline('porte_plume_barre_charger', $barres);


	// 4 on cree les jsons
	$json = "";
	foreach($barres as $set=>$barre) {
		$json .= $barre->creer_json();
	}
	return $json;
}


?>
