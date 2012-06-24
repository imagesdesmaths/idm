<?php
/**
 * Plugin S.P
 * Licence IV
 * (c) 2011 vers l'infini et au dela
 */

/**
 * Teleporter et deballer un composant
 * @param string $methode
 *   http|git|svn|...
 * @param string $source
 *   url source du composant
 * @param string $dest
 *   chemin du repertoire ou deballer le composant. Inclus le dernier segment
 * @param array $options
 *   revision => ''
 *   --ignore-externals
 * @return bool\string
 */
function action_teleporter_composant_dist($methode,$source,$dest,$options=array()){

	# Si definie a '', le chargeur est interdit ; mais on n'aurait de toutes
	# facons jamais pu venir ici avec toutes les securisations faites :^)
	if (!_DIR_PLUGINS_AUTO) die('jamais');

	// verifier que la methode est connue
	if (!$teleporter =  charger_fonction($methode,"teleporter",true)){
		spip_log("Methode $methode inconnue pour teleporter $source vers $dest","teleport"._LOG_ERREUR);
		return _T('svp:erreur_teleporter_methode_inconue',array('methode' => $methode));
	}

	if (!$dest = teleporter_verifier_destination($d = $dest)){
		spip_log("Rerpertoire $d non accessible pour teleporter $source vers $d","teleport"._LOG_ERREUR);
		return _T('svp:erreur_teleporter_destination_erreur',array('dir' => $d));
		#$texte = "<p>"._T('plugin_erreur_droit1',array('dest'=>$dest))."</p>"
		#  . "<p>"._T('plugin_erreur_droit2').aide('install0')."</p>";
	}

	# destination temporaire des fichiers si besoin
	$options['dir_tmp'] = sous_repertoire(_DIR_CACHE, 'chargeur');

	return $teleporter($methode,$source,$dest,$options);
}


/**
 * Verifier et preparer l'arborescence jusqu'au repertoire parent
 *
 * @param string $dest
 * @return bool|string
 */
function teleporter_verifier_destination($dest){
	$dest = rtrim($dest,"/");
	$final = basename($dest);
	$base = dirname($dest);
	$create = array();
	// on cree tout le chemin jusqu'a dest non inclus
	while (!is_dir($base)){
		$create[] = basename($base);
		$base = dirname($base);
	}
	while (count($create)){
		if (!is_writable($base))
			return false;
		$base = sous_repertoire($base,array_pop($create));
		if (!$base)
			return false;
	}

	if (!is_writable($base))
		return false;

	return $base."/$final";
}

function teleporter_nettoyer_vieille_version($dest){
	$old = "";
	if (is_dir($dest)){
		$dir = dirname($dest);
		$base = basename($dest);
		$old="$dir/.$base.bck";
		if (is_dir($old))
			supprimer_repertoire($old);
		rename($dest,$old);
	}
	return $old;
}
