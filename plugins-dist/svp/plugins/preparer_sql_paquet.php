<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

function plugins_preparer_sql_paquet($plugin)
{
	include_spip('inc/svp_outiller');

	$champs = array();
	if (!$plugin)
		return $champs;
	
	// On initialise les champs ne necessitant aucune transformation
	$champs['categorie'] = $plugin['categorie'] ? $plugin['categorie'] : '';
	$champs['etat'] = $plugin['etat'] ? $plugin['etat'] : '';
	$champs['version'] = $plugin['version'] ? normaliser_version($plugin['version']) : '';
	$champs['version_base'] = $plugin['schema'] ? $plugin['schema'] : '';
	$champs['logo'] = $plugin['logo'] ? $plugin['logo'] : '';
	$champs['lien_doc'] = $plugin['documentation'] ? $plugin['documentation'] : '';
	$champs['lien_demo'] = $plugin['demonstration'] ? $plugin['demonstration'] : '';
	$champs['lien_dev'] = $plugin['developpement'] ? $plugin['developpement'] : '';

	// On passe le prefixe en lettres majuscules comme ce qui est fait dans SPIP
	// Ainsi les valeurs dans la table spip_plugins coincideront avec celles de la meta plugin
	$champs['prefixe'] = strtoupper($plugin['prefix']);

	// Indicateurs d'etat numerique (pour simplifier la recherche des maj de STP)
	static $num = array('stable'=>4, 'test'=>3, 'dev'=>2, 'experimental'=>1);
	$champs['etatnum'] = isset($num[$plugin['etat']]) ? $num[$plugin['etat']] : 0;

	// Tags : liste de mots-cles
	$champs['tags'] = ($plugin['tags']) ? serialize($plugin['tags']) : '';
	
	// On passe en utf-8 avec le bon charset les champs pouvant contenir des entites html
	$champs['nom'] = entite2charset($plugin['nom']);
	$champs['description'] = entite2charset($plugin['description']);
	$champs['slogan'] = $plugin['slogan'] ? entite2charset($plugin['slogan']) : '';
	
	// Traitement des auteurs, credits, licences et copyright
	$champs['auteur'] = ($plugin['auteur']) ? serialize($plugin['auteur']) : '';
	$champs['credit'] = ($plugin['credit']) ? serialize($plugin['credit']) : '';
	$champs['licence'] = ($plugin['licence']) ? serialize($plugin['licence']) : '';
	$champs['copyright'] = ($plugin['copyright']) ? serialize($plugin['copyright']) : '';
	
	// Extraction de la compatibilite SPIP et construction de la liste des branches spip supportees
	$champs['compatibilite_spip'] = ($plugin['compatibilite']) ? $plugin['compatibilite'] : '';
	$champs['branches_spip'] = ($plugin['compatibilite']) ? compiler_branches_spip($plugin['compatibilite']) : '';
	
	// Construction du tableau des dependances necessite, lib et utilise
	$dependances['necessite'] = $plugin['necessite'];
	$dependances['librairie'] = $plugin['lib'];
	$dependances['utilise'] = $plugin['utilise'];
	$champs['dependances'] = serialize($dependances);

	return $champs;
}

?>
