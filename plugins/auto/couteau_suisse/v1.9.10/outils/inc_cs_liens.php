<?php
// expanser_liens() est introduit sous SPIP 2.0
if (!defined('_SPIP19300')) {
	@define('_RACCOURCI_LIEN', ',\[([^][]*)->(>?)([^]]*)\],msS');
	function expanser_liens($letexte) {
		$inserts = array();
		if (preg_match_all(_RACCOURCI_LIEN, $letexte, $matches, PREG_SET_ORDER)) {
			$i = 0;
			foreach ($matches as $regs) {
				$inserts[++$i] = traiter_raccourci_lien($regs);
				$letexte = str_replace($regs[0], "@@SPIP_ECHAPPE_LIEN_$i@@", $letexte);
			}
		}
		$letexte = typo($letexte, /* echap deja fait, accelerer */ false);
		foreach ($inserts as $i => $insert)
			$letexte = str_replace("@@SPIP_ECHAPPE_LIEN_$i@@", $insert, $letexte);
		return $letexte;
	}
}

/*
 chiffres, lettres, 20 caracteres speciaux autorises dans les urls
 voir les references suivantes :
 	http://gbiv.com/protocols/uri/rfc/rfc3986.html
	http://tools.ietf.org/html/rfc3696
*/
@define('_cs_liens_AUTORISE', $autorises='\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\.\{\|\}\~a-zA-Z0-9');
@define('_cs_liens_AUTORISE_FIN', $autorisesfin='\#\$\&\'\*\+\-\/\=\^\_\`\|\~a-zA-Z0-9');
@define('_cs_liens_HTTP', ",[a-zA-Z]+://[{$autorises}:@]*[{$autorisesfin}],");
@define('_cs_liens_WWW', ",\b(www|ftp)\.[a-zA-Z0-9_-]+\.[{$autorises}]*[{$autorisesfin}],");
@define('_cs_liens_NEWS', ",\bnews:[{$autorises}]*[{$autorisesfin}],");
@define('_cs_liens_MAILS', ",\b(mailto:)?([{$autorises}]*@[a-zA-Z][a-zA-Z0-9-.]*\.[a-zA-Z]+(\?[{$autorises}]*)?),");

// les callbacks...

function cs_liens_echappe_callback($matches) {
	return cs_code_echappement($matches[0], 'LIENS');
}

function cs_liens_raccourcis_callback($matches) {
	if($GLOBALS["liens_interrogation"]) {
		// TODO (SPIP>=2.1) : utiliser $lien_court = charger_fonction('lien_court', 'inc');
		$long_url = defined('_MAX_LONG_URL') ? _MAX_LONG_URL : 40;
		$coupe_url = defined('_MAX_COUPE_URL') ? _MAX_COUPE_URL : 35;
		if(strlen($texte = retour_interro_amp($matches[0]))>$long_url) $texte = substr($texte,0,$coupe_url).'...';
		$texte = expanser_liens('['.echappe_interro_amp($texte).'->'.echappe_interro_amp($matches[0]).']');
	} else
		$texte = expanser_liens('[->'.$matches[0].']');
	return cs_code_echappement($texte, 'LIENS');
}

function cs_liens_email_callback($matches) {
	return cs_code_echappement(expanser_liens("[$matches[2]->mailto:$matches[2]]"), 'LIENS');
}

// les echappements...
 
function echappe_interro_amp(&$texte) {
	return !$GLOBALS["liens_interrogation"]?$texte
		:str_replace(array('?', '!', '&amp;', '&', '--'), 
			array('++cs_INTERRO++', '++cs_EXCLAM++', '++cs_AMP++', '++cs_AMP++', '++cs_TIR++'), $texte);
}

function retour_interro_amp(&$texte) {
	return !$GLOBALS["liens_interrogation"] || strpos($texte, '++')===false?$texte
		:str_replace(array('++cs_INTERRO++', '++cs_EXCLAM++', '++cs_AMP++', '++cs_TIR++'), 
			array('?', '!', '&amp;', '--'), $texte);
}

?>