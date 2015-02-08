<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Tetue
 * Licence GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Recuperer les champs date_xx et heure_xx, verifier leur coherence et les reformater
 *
 * @param string $suffixe
 * @param bool $horaire
 * @param array $erreurs
 * @return int
 */
function verifier_corriger_date_saisie($suffixe,$horaire,&$erreurs){
	include_spip('inc/filtres');
	$date = _request("date_$suffixe").($horaire?' '.trim(_request("heure_$suffixe")).':00':'');
	$date = recup_date($date);
	if (!$date)
		return '';
	$ret = null;
	if (!$ret=mktime(0,0,0,$date[1],$date[2],$date[0]))
		$erreurs["date_$suffixe"] = _T('spip_bonux:erreur_date');
	elseif (!$ret=mktime($date[3],$date[4],$date[5],$date[1],$date[2],$date[0]))
		$erreurs["date_$suffixe"] = _T('spip_bonux:erreur_heure');
	if ($ret){
		if (trim(_request("date_$suffixe")!==($d=date('d/m/Y',$ret)))){
			$erreurs["date_$suffixe"] = _T('spip_bonux:erreur_date_corrigee');
			set_request("date_$suffixe",$d);
		}
		if ($horaire AND trim(_request("heure_$suffixe")!==($h=date('H:i',$ret)))){
			$erreurs["heure_$suffixe"] = _T('spip_bonux:erreur_heure_corrigee');
			set_request("heure_$suffixe",$h);
		}
	}
	return $ret;
}

?>