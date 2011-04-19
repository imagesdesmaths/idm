<?php

function ecran_securite_pre_description_outil($flux) {
	if($flux['outil']!="ecran_securite") return $flux;
	// ecran de securite dans config/
	$f = dirname(cs_spip_file_options(4))."/ecran_securite.php";
	// conflit/doublon potentiel ?
	// $flux['non'] est vrai si le Couteau Suisse ne lance aucun fichier par lui-meme
	$conf = (@file_exists($f) && !defined('_SPIP20100')) || (defined("_ECRAN_SECURITE") && $flux['non'])
		?"<hr/>\n@puce@ <span style=\"color: red;\">"._T("couteauprive:ecran_conflit".($flux['non']?"2":""), array("file"=>_NOM_PERMANENTS_INACCESSIBLES."ecran_securite.php"))."</span>"
		:"";
	if(defined('_ECRAN_SECURITE')) {
		$vers = _ECRAN_SECURITE;
		// recherche de la version du fichier distant
		include_spip("outils/maj_auto_action_rapide");
		$maj = maj_auto_rev_distante(_MAJ_ECRAN_SECU,false,",(\d+\.\d+(\.\d+)?),",0,true);
		if($maj{0} != "-") 
			$tmp = "\n".(_ECRAN_SECURITE!=$maj?"- "._T("couteauprive:ecran_maj_ko", array("n"=>"<span style=\"color: red;\">$maj</span>")):_T("couteauprive:ecran_maj_ok"));
	} else $vers=_T("couteauprive:ecran_ko");
	// options SPIP en amont ? (mieux !)
	if(!defined("_CS_SPIP_OPTIONS_OK"))
		$tmp .= "\n- "._T("couteauprive:detail_spip_options2");
	$flux['texte'] = str_replace(array("@_ECRAN_SECURITE@","@_ECRAN_CONFLIT@","@_ECRAN_SUITE@"), array($vers,$conf,$tmp), $flux['texte']);
	return $flux;
}

# TODO : eviter l'insertion et recopier le fichier dans config/mes_options.php pour SPIP>=2.1
function ecran_securite_fichier_distant($flux) {
	// besoin du 1er appel uniquement
	if($flux['outil']!='ecran_securite' || isset($flux['texte'])) return $flux;
	// fichier global de config (y compris la mutu)
	$flux['fichier_local'] = dirname(cs_spip_file_options(4)).'/ecran_securite.php';
	// fichier local de config
	#$flux['fichier_local'] = dirname(cs_spip_file_options(3)).'/ecran_securite.php';
	return $flux;
}

?>