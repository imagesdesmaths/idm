<?php

/***************************************************************************\
 * Plugin Duplicator pour Spip 3.0
 * Licence GPL (c) 2010-2014 - Apsulis
 * Duplication de rubriques et d'articles
 *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

function duplicator_boite_infos($flux){
	$type = $flux['args']['type'];
	if(autoriser("dupliquer", "rubrique")){
			if (($id = intval($flux['args']['id'])) && ($type=='rubrique')){
				$contexte = array('id_objet'=>$id,'objet'=>$type);
				$flux["data"] .= recuperer_fond("noisettes/bouton_duplicator", $contexte);
			}
	}
	
	if(autoriser("dupliquer", "article")){
			if (($id = intval($flux['args']['id'])) && ($type=='article')){
				$contexte = array('id_objet'=>$id,'objet'=>$type);
				$flux["data"] .= recuperer_fond("noisettes/bouton_duplicator", $contexte);
			}

	}

	return $flux;
}

function duplicator_jqueryui_plugins($plugins){
	$plugins[] = "jquery.ui.dialog";
	return $plugins;
}
