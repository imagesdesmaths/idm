<?php

/*
 * transforme un raccourci de ressource en un lien minimaliste
 * 
 *
 */

define('_EXTRAIRE_RESSOURCES', ',' . '<"?(https?://|[^\s][\w -]+\.[\w -]+)[^<]*>'.',UimsS');


function traiter_ressources($r) {
	$html = null;
	if ($ressource = charger_fonction('ressource', 'inc', true)) {
		$html = $ressource($r[0]);
	}

	if (is_null($html)) {
		include_spip('inc/lien');
		$url = explode(' ', trim($r[0], '<>'));
		$url = $url[0];
		# <http://url/absolue>
		if (preg_match(',^https?://,i', $url))
			$html = PtoBR(propre("<span class='ressource spip_out'>&lt;[->".$url."]&gt;</span>"));
		# <url/relative>
		else if (false !== strpos($url, '/'))
			$html = PtoBR(propre("<span class='ressource spip_in'>&lt;[->".$url."]&gt;</span>"));
		# <fichier.rtf>
		else {
			preg_match(',\.([^.]+)$,', $url, $regs);
			if (file_exists($f = _DIR_IMG.$regs[1].'/'.$url)) {
				$html = PtoBR(propre("<span class='ressource spip_in'>&lt;[".$url."->".$f."]&gt;</span>"));
			} else {
				$html = PtoBR(propre("<span class='ressource'>&lt;".$url."&gt;</span>"));
			}
		}
	}

	return '<html>'.$html.'</html>';
}

?>
