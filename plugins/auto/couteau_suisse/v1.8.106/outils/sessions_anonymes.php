<?php

// supprimer les vieilles sessions anonymes
function cs_nettoyer_sessions_anonymes() {
	spip_log("Purge des vieilles sessions anonymes");
	include_spip('inc/session');
	if($dir = opendir(_DIR_SESSIONS)) {
		if(!defined('_RENOUVELLE_ALEA')) define('_RENOUVELLE_ALEA', 12 * 3600); // Pour SPIP 1.92
		$t = time() - (4*_RENOUVELLE_ALEA);
		$nb = 0;
		while(($f = readdir($dir)) !== false)
			if (preg_match(",^[^\d-]*0_\w{32}\.php[3]?$,", $f, $regs))
				if ($t > filemtime($f = _DIR_SESSIONS.$f))
					{ spip_unlink($f); $nb++; }
	}
	spip_log(" -> $nb suppression(s)");
	// forcer le recalcul de la session courante
	spip_session(true);
	return 1;
}

function sessions_anonymes_pre_description_outil($flux) {
	if($flux['outil']!='sessions_anonymes') return $flux;
	//if($flux['actif']) {
		$nb1 = count(preg_files(_DIR_SESSIONS,'/[^\d-]*-?\d+_'));
		$nb2 = count(preg_files(_DIR_SESSIONS,'/[^\d-]*0_'));
	//} else $nb1 = $nb2 = '??';
	if(!defined('_RENOUVELLE_ALEA')) define('_RENOUVELLE_ALEA', 12 * 3600); // Pour SPIP 1.92
	$flux['texte'] = str_replace(array('@_NB_SESSIONS1@','@_NB_SESSIONS2@','@_NB_SESSIONS3@','@_DIR_SESSIONS@'), 
		array("{{{$nb1}}}","{{{$nb2}}}", round(4*_RENOUVELLE_ALEA/3600/24), _DIR_SESSIONS), $flux['texte']);
	return $flux;
}

?>