<?php

if (!defined("_ECRIRE_INC_VERSION")) return;


function formulaires_ajouter_depot_charger_dist(){
	// On ne renvoie pas les valeurs saisies mais on fait un raz systematique
	return array();
}

function formulaires_ajouter_depot_verifier_dist(){
	
	$erreurs = array();
	$xml = trim(_request('xml_paquets'));

	if (!$xml) {
		// L'url est obligatoire
		$erreurs['xml_paquets'] = _T('svp:message_nok_champ_obligatoire');
	}
	elseif (!svp_verifier_adresse_depot($xml)) {
		// L'url n'est pas correcte, le fichier xml n'a pas ete trouve
		$erreurs['xml_paquets'] = _T('svp:message_nok_url_depot_incorrecte', array('url' => $xml));
	}
	elseif (sql_countsel('spip_depots','xml_paquets='.sql_quote($xml))) {
		// L'url est deja ajoutee
		$erreurs['xml_paquets'] = _T('svp:message_nok_depot_deja_ajoute', array('url' => $xml));
	}
	return $erreurs;
}

function formulaires_ajouter_depot_traiter_dist(){
	include_spip('inc/svp_depoter_distant');

	$retour = array();
	$xml = trim(_request('xml_paquets'));

	// On ajoute le depot et ses plugins dans la base
	// On traite le cas d'erreur fichier ($retour['message_erreur']) non conforme
	// - si la syntaxe xml est incorrecte
	// - ou si le depot ne possede pas au moins un plugin
	$ok = svp_ajouter_depot($xml, $erreur);

	// Determination des messages de retour
	if (!$ok)
		$retour['message_erreur'] = $erreur;
	else {
		$retour['message_ok'] = _T('svp:message_ok_depot_ajoute', array('url' => $xml));
		spip_log("ACTION AJOUTER DEPOT (manuel) : url = ". $xml, 'svp_actions.' . _LOG_INFO);
	}
	$retour['editable'] = true;

	return $retour;
}


/**
 * Teste la validite d'une url d'un depot de paquets
 *
 * @param string $url
 * @return boolean
 */

// $url	=> url du fichier xml de description du depot
function svp_verifier_adresse_depot($url){
	include_spip('inc/distant');
	// evitons de recuperer 2 fois le XML demandé.
	// si on le recupere ici, il sera deja a jour pour le prochain copie_locale
	// lors du traitement.
	return (copie_locale($url) ? true : false);
	#return (!$xml = recuperer_page($url)) ? false : true;
}

?>
