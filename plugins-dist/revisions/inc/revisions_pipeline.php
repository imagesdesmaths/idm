<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

function revisions_boite_infos($flux){
	$type = $flux['args']['type'];
	if ($id = intval($flux['args']['id'])
	  AND $tables = unserialize($GLOBALS['meta']['objets_versions'])
		AND in_array(table_objet_sql($type),$tables)
	  AND autoriser('voirrevisions',$type,$id)
	  // regarder le numero de revision le plus eleve, et afficher le bouton
	  // si c'est interessant (id_version>1)
	  AND sql_countsel('spip_versions', 'id_objet='.intval($id).' AND objet = '.sql_quote($type)) > 1
	) {
		include_spip('inc/presentation');
		$flux['data'] .= icone_horizontale(_T('revisions:info_historique_lien'), generer_url_ecrire('revision',"id_objet=$id&objet=$type"), "revision-24.png");
	}

	return $flux;
}

/**
 * Afficher les dernieres revisions en bas de la page d'accueil de ecrire/
 */
function revisions_affiche_milieu($flux) {
	if ($flux['args']['exec'] == 'accueil') {
		$contexte = array();
		if ($GLOBALS['visiteur_session']['statut']!=='0minirezo')
			$contexte['id_auteur'] = $GLOBALS['visiteur_session']['id_auteur'];
		$flux['data'] .= recuperer_fond('prive/objets/liste/versions',$contexte,array('ajax'=>true));
	}
	if ($flux['args']['exec'] == 'suivi_edito') {
		$contexte = array();
		if ($GLOBALS['visiteur_session']['statut']!=='0minirezo')
			$contexte['id_auteur'] = $GLOBALS['visiteur_session']['id_auteur'];
		$flux['data'] .= recuperer_fond('prive/objets/liste/versions',$contexte,array('ajax'=>true));
	}
	return $flux;
}

/**
 * Definir les metas de configuration liee aux revisions
 * Utilisé par inc/config
 *
 * @param array $metas
 * @return array
 */
function revisions_configurer_liste_metas($metas){
	// Dorénavant dans les metas on utilisera un array serialisé de types d'objets
	// qui correspondront aux objets versionnés
	$metas['objets_versions'] =  '';

	return $metas;
}

/**
 * Definir la liste des tables possibles
 * @param object $array
 * @return
 */
function revisions_revisions_liste_objets($array){
	$array['articles'] = 'revisions:articles';
	$array['breves'] = 'revisions:breves';
	$array['rubriques'] = 'revisions:rubriques';
	$array['mots'] = 'revisions:mots';
	$array['groupes_mots'] = 'revisions:groupes_mots';

	return $array;
}

function revisions_formulaire_charger($flux){
	if (strncmp($flux['args']['form'],'editer_',7)==0
	  AND $id_version = _request('id_version')
	  AND $objet = substr($flux['args']['form'],7)
	  AND $id_table_objet = id_table_objet($objet)
	  AND isset($flux['data'][$id_table_objet])
		AND $id = intval($flux['data'][$id_table_objet])
	  AND !$flux['args']['je_suis_poste']){
		// ajouter un message convival pour indiquer qu'on a restaure la version
		$flux['data']['message_ok'] = _T('revisions:icone_restaurer_version',array('version'=>$id_version));
		$flux['data']['message_ok'] .= "<br />"._T('revisions:message_valider_recuperer_version');
		// recuperer la version
		include_spip('inc/revisions');
		$champs = recuperer_version($id,$objet, $id_version);
		foreach($champs as $champ=>$valeur){
			if (!strncmp($champ,'jointure_',9)==0){
				if ($champ=='id_rubrique'){
					$flux['data']['id_parent'] = $valeur;
				}
				else
					$flux['data'][$champ] = $valeur;
			}
		}
	}
	return $flux;
}
?>