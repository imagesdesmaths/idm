<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Charger
 *
 * @param int $id_objet
 * @param string $objet
 * @return array
 */
function formulaires_tri_auteurs_charger_dist($id_objet=0, $objet='article'){
	if (defined('boites_privees_TRI_AUTEURS') && $id_objet && autoriser('modifier', $objet, $id_objet)) {
		return array(
			'objet' => $objet,
			'id_objet' => $id_objet,
			'editable' => $objet=='article');
	}
	return false;
}

/**
 * Traiter
 *
 * @param int $id_objet
 * @param string $objet
 * @return array
 */
function formulaires_tri_auteurs_traiter_dist($id_objet=0, $objet='article'){
	include_spip('inc/autoriser');
	if ($objet=='article' AND autoriser('modifier', $objet, $id_objet)){
		$id_article = _request('bp_article');
		$id_auteur = abs(_request('bp_auteur'));
		$monter = _request('bp_auteur')>0;
		include_spip('base/abstract_sql');
		// liste des auteurs de l'article
		$a = defined('_SPIP30000')
			?sql_allfetsel('id_auteur, ordre', 'spip_auteurs_liens', "objet='article' AND id_objet=$id_article", '', 'ordre')
			:sql_allfetsel('id_auteur, ordre', 'spip_auteurs_articles', "id_article=$id_article", '', 'ordre');
		$c = count($a);
		// recherche des auteurs a permuter
		for($i=$j=0;$i<$c;$i++)
			if($a[$i]['id_auteur']==$id_auteur) { $j=!$monter?min($i+1,$c-1):max($i-1,0); break; }
		spip_log("formulaires_tri_auteurs_traiter_dist, article $id_article : echange entre l'auteur {$a[$i][id_auteur]} et l'auteur {$a[$j][id_auteur]}");
		// permutation
		$tmp = $a[$i]; $a[$i] = $a[$j]; $a[$j] = $tmp;
		// mise a jour en base 
		// note : l'ordre est un nombre negatif, permettant aux auteurs ajoutes ulterieurement d'etre les derniers (ordre 0 par defaut)
		for($i=0;$i<$c;$i++) defined('_SPIP30000')
			?sql_update('spip_auteurs_liens', array('ordre'=>$i-$c), "objet='article' AND id_objet=$id_article AND id_auteur=".$a[$i]['id_auteur'])
			:sql_update('spip_auteurs_articles', array('ordre'=>$i-$c), "id_article=$id_article AND id_auteur=".$a[$i]['id_auteur']);

		include_spip('inc/invalideur');
		suivre_invalideur("id='$objet/$id_objet'");
	}
		
	return array('message_ok'=>_T('config_info_enregistree'), 'editable'=>true);
}

?>