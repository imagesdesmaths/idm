<?php

/***************************************************************************\
 * Plugin Duplicator pour Spip 2.0
 * Licence GPL (c) 2010 - Apsulis
 * Duplication de rubriques et d'articles
 *
\***************************************************************************/


function duplicator_boite_infos($flux){

	$type = $flux['args']['type'];

	if(autoriser("webmestre")){
		if ( (lire_config('duplicator/config/duplic_rubrique')=="oui") ){
			if ( ($id = intval($flux['args']['id'])) && ($type=='rubrique') ) {
				$contexte = array('id_objet'=>$id,'objet'=>$type);
				$flux["data"] .= recuperer_fond("noisettes/bouton_duplicator", $contexte);
			}
		}
		if ( (lire_config('duplicator/config/duplic_article')=="oui") ){
			if ( ($id = intval($flux['args']['id'])) && ($type=='article') ) {
				$contexte = array('id_objet'=>$id,'objet'=>$type);
				$flux["data"] .= recuperer_fond("noisettes/bouton_duplicator", $contexte);
			}
		}
	}

	return $flux;
}

function duplicator_jqueryui_plugins($plugins){
	$plugins[] = "jquery.ui.dialog";
	return $plugins;
}