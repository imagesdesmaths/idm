<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

// mise a jour des donnees si envoi via formulaire
// http://doc.spip.org/@enregistre_modif_plugin
function enregistre_modif_plugin(){
	include_spip('inc/plugin');
  // recuperer les plugins dans l'ordre des $_POST
	$test = array();
	foreach(liste_plugin_files() as $file){
	  $test['s'.substr(md5($file),0,16)] = $file;
	}
	$plugin=array();

	foreach($_POST as $choix=>$val){
		if (isset($test[$choix])&&$val=='O')
			$plugin[]=$test[$choix];
	}

	spip_log("Changement des plugins actifs par l'auteur " . $GLOBALS['visiteur_session']['id_auteur'] . ": " . join(',', $plugin));
	ecrire_plugin_actifs($plugin);

	// Chaque fois que l'on valide des plugins, on memorise la liste de ces plugins comme etant "interessants", avec un score initial, qui sera decremente a chaque tour : ainsi un plugin active pourra reter visible a l'ecran, jusqu'a ce qu'il tombe dans l'oubli.
	$plugins_interessants = @unserialize($GLOBALS['meta']['plugins_interessants']);
	if (!is_array($plugins_interessants))
		$plugins_interessants = array();

	$plugins_interessants2 = array();

	foreach($plugins_interessants as $plug => $score)
		if ($score > 1)
			$plugins_interessants2[$plug] = $score-1;
	foreach ($plugin as $plug)
		$plugins_interessants2[$plug] = 10; // score initial
	ecrire_meta('plugins_interessants', serialize($plugins_interessants2));

	if (isset($GLOBALS['meta']['plugin_erreur_activation'])){
		$GLOBALS['redirect'] = parametre_url(_request('redirect'),'voir','recents');
	}
}

// http://doc.spip.org/@action_activer_plugins_dist
function action_activer_plugins_dist() {

	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();

	if (!autoriser('configurer', 'plugins'))
		die('erreur');
	// forcer la maj des meta pour les cas de modif de numero de version base via phpmyadmin
	lire_metas();
	enregistre_modif_plugin();
}

?>
