<?php
/**
 * Plugin S.P
 * Licence IV
 * (c) 2011 vers l'infini et au dela
 */

/**
 * Teleporter et deballer un composant
 * Deployer un repo SVN depuis source et revision donnees
 *
 * @param string $methode
 *   http|git|svn|...
 * @param string $source
 * @param string $dest
 * @param array $options
 *   revision => nnn
 *   literal => --ignore-externals
 * @return bool
 */
function teleporter_svn_dist($methode,$source,$dest,$options=array()){
	if (is_dir($dest)){
		$infos = teleporter_svn_read($dest);
		if (!$infos){
			spip_log("Suppression de $dest qui n'est pas au format SVN","teleport");
			$old = teleporter_nettoyer_vieille_version($dest);
		}
		elseif ($infos['source']!==$source) {
			spip_log("Suppression de $dest qui n'est pas sur le bon repository SVN","teleport");
			$old = teleporter_nettoyer_vieille_version($dest);
		}
		elseif (!isset($options['revision'])
		  OR $options['revision']!=$infos['revision']){
			$command = "svn up ";
			if (isset($options['revision']))
				$command .= escapeshellarg("-r".$options['revision'])." ";
			if (isset($options['ignore-externals']))
				$command .= "--ignore-externals ";

			$command .= escapeshellarg($dest);
			spip_log($command,"teleport");
			exec($command);
		}
		else {
			// Rien a faire !
			spip_log("$dest deja a jour (Revision ".$options['revision']." SVN de $source)","teleport");
		}
	}

	if (!is_dir($dest)){
		$command = "svn co ";
		if (isset($options['revision']))
			$command .= escapeshellarg("-r".$options['revision'])." ";
		if (isset($options['ignore-externals']))
			$command .= "--ignore-externals ";
		$command .= escapeshellarg($source)." ".escapeshellarg($dest);
		spip_log($command,"teleport");
		exec($command);
	}

	// verifier que tout a bien marche
	$infos = teleporter_svn_read($dest);
	if (!$infos) return false;

	return true;
}

/**
 * Lire source et revision d'un repertoire SVN
 * et reconstruire la ligne de commande
 * @param $dest
 * @param $options
 * @return string
 */
function teleporter_svn_read($dest,$options=array()){

	if (!is_dir("$dest/.svn"))
		return "";

	// on veut lire ce qui est actuellement deploye
	// et reconstituer la ligne de commande pour le deployer
	exec("svn info ".escapeshellarg($dest),$output);
	$output = implode("\n",$output);

	// URL
	// URL: svn://trac.rezo.net/spip/spip
	if (!preg_match(",^URL[^:\w]*:\s+(.*)$,Uims",$output,$m))
		return "";
	$source = $m[1];

	// Revision
	// Revision: 18763
	if (!preg_match(",^R..?vision[^:\w]*:\s+(\d+)$,Uims",$output,$m))
		return "";

	$revision = $m[1];

	return array(
		'source' => $source,
		'revision' => $revision,
		'dest' => $dest
	);
}