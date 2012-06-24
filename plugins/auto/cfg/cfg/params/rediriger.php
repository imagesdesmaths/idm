<?php

/**
 * Plugin générique de configuration pour SPIP
 *
 * @license    GNU/GPL
 * @package    plugins
 * @subpackage cfg
 * @category   outils
 * @copyright  (c) toggg, marcimat 2007-2008
 * @link       http://www.spip-contrib.net/
 * @version    $Id: rediriger.php 53409 2011-10-13 20:42:57Z yffic@lefourneau.com $
 */
if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * restaure des messages serialises dans une meta 'cfg_message_{id_auteur}'
 * 
 * Si le formulaire cfg avait demande une redirection...
 * (et provient de cette redirection), il est possible
 * qu'il y ait un message a afficher
 * 
 * @param mixed $valeur # inutilisé
 * @param Object $cfg
 */
function cfg_pre_charger_param_rediriger($valeur, &$cfg){
	if ($messages = $GLOBALS['meta']['cfg_message_'.$GLOBALS['auteur_session']['id_auteur']]){
			include_spip('inc/meta');
			effacer_meta('cfg_message_'.$GLOBALS['auteur_session']['id_auteur']);
			if (defined('_COMPAT_CFG_192')) ecrire_metas();
			$cfg->messages = array_merge($cfg->messages, unserialize($messages));
	}	
}

/**
 * Traite une demande de redirection
 * 
 * Si le fond du formulaire demande expressement une redirection
 * par <!-- rediriger=1 -->, on stocke le message dans une meta
 * et on redirige le client, de maniere a charger la page
 * avec la nouvelle config (ce qui permet par exemple a Autorite
 * de controler d'eventuels conflits generes par les nouvelles autorisations)
 * 
 * @param mixed $valeur # inutilisé
 * @param Object $cfg
 */
function cfg_post_traiter_param_rediriger($valeur, &$cfg){
	if ($cfg->messages) {
		include_spip('inc/meta');
		ecrire_meta('cfg_message_'.$GLOBALS['auteur_session']['id_auteur'], serialize($cfg->messages), 'non');
		if (defined('_COMPAT_CFG_192')) ecrire_metas();
		include_spip('inc/headers');
		redirige_par_entete(parametre_url(self(),null,null,'&'));
	}
}

?>
