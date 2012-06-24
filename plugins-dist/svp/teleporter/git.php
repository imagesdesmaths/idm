<?php
/**
 * Plugin S.P
 * Licence IV
 * (c) 2011 vers l'infini et au dela
 */

/**
 * Teleporter et deballer un composant
 * Deployer un repo GIT depuis source et revision donnees
 *
 * @param string $methode
 *   http|git|svn|...
 * @param string $source
 * @param string $dest
 * @param array $options
 *   revision => 'ae89'
 *   branche => 'xxx'
 * @return bool
 */
function teleporter_git_dist($methode,$source,$dest,$options=array()){

	$branche = (isset($options['branche'])?$options['branche']:'master');
	if (is_dir($dest)){
		$infos = teleporter_git_read($dest,array('format'=>'assoc'));
		if (!$infos){
			spip_log("Suppression de $dest qui n'est pas au format GIT","teleport");
			$old = teleporter_nettoyer_vieille_version($dest);
		}
		elseif ($infos['source']!==$source) {
			spip_log("Suppression de $dest qui n'est pas sur le bon repository GIT","teleport");
			$old = teleporter_nettoyer_vieille_version($dest);
		}
		elseif (!isset($options['revision'])
		  OR $options['revision']!=$infos['revision']){
			$command = "git checkout ".escapeshellarg($branche);
			teleporter_git_exec($dest,$command);
			$command = "git pull --all";
			teleporter_git_exec($dest,$command);

			if (isset($options['revision'])){
				$command = "git checkout ".escapeshellarg($options['revision']);
				teleporter_git_exec($dest,$command);
			}
			else {
				$command = "git checkout ".escapeshellarg($branche);
				teleporter_git_exec($dest,$command);
			}
		}
		else {
			spip_log("$dest deja sur GIT $source Revision ".$options['revision'],"teleport");
		}
	}

	if (!is_dir($dest)){
		$command = "git clone ";
		$command .= escapeshellarg($source)." ".escapeshellarg($dest);
		teleporter_git_exec($dest,$command);
		if (isset($options['revision'])){
			$command = "git checkout ".escapeshellarg($options['revision']);
			teleporter_git_exec($dest,$command);
		}
	}

	// verifier que tout a bien marche
	$infos = teleporter_git_read($dest);
	if (!$infos) return false;

	return true;
}

/**
 * Lire l'etat GIT du repo
 * @param string $dest
 * @param array $options
 * @return void
 */
function teleporter_git_read($dest, $options=array()){

	if (!is_dir("$dest/.git"))
		return "";

	$curdir = getcwd();
	chdir($dest);

	exec("git remote -v",$output);
	$output = implode("\n",$output);

	$source = "";
	if (preg_match(",(\w+://.*)\s+\(fetch\)$,Uims",$output,$m))
		$source = $m[1];
	elseif (preg_match(",([^@\s]+@[^:\s]+:.*)\s+\(fetch\)$,Uims",$output,$m))
		$source = $m[1];

	if (!$source){
		chdir($curdir);
		return "";
	}

	$source = $m[1];

	exec("git log -1",$output);
	$hash = explode(" ",reset($output));
	$hash = end($hash);

	// lire la branche ? TODO
	chdir($curdir);

	if (preg_match(",[^0-9a-f],i",$hash))
		return false;

	return array(
		'source' => $source,
		'revision' => substr($hash,0,7),
		'dest' => $dest
	);
}

function teleporter_git_exec($dest,$command){
	spip_log("{$dest}:{$command}","teleport");
	$curdir = getcwd();
	chdir($dest);
	exec($command);
	chdir($curdir);
}