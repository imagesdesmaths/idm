<?php
/**
 * Plugin Facteur
 * (c) 2009-2013 Collectif SPIP
 * Distribue sous licence GPL
 * 
 * @package SPIP\Facteur\Pipelines
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Insertion dans le pipeline recuperer_fond (SPIP)
 * 
 * On indique dans le formulaire de configuration de l'identité du site
 * que facteur surchargera l'email configuré ici pour envoyer les emails
 * 
 * @param array $flux
 * 		Le contexte du pipeline
 * @return array $flux
 * 		Le contexte du pipeline modifé
 */
function facteur_formulaire_fond($flux){
	if(($flux['args']['form'] == 'configurer_identite')
		&& (isset($GLOBALS['meta']['facteur_adresse_envoi']) && $GLOBALS['meta']['facteur_adresse_envoi'] == 'oui')
		&& (isset($GLOBALS['meta']['facteur_adresse_envoi_email']) && strlen($GLOBALS['meta']['facteur_adresse_envoi_email']) > 0)){
		$ajout = '<p class="notice">'._T('facteur:message_identite_email').'</p>';
		$flux['data'] = preg_replace(",(<li [^>]*class=[\"']editer editer_email_webmaster.*>)(.*<label),Uims","\\1".$ajout."\\2",$flux['data'],1);
	}
	return $flux;
}

?>