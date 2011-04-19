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

include_spip('inc/rechercher');
if (!defined('_DELAI_CACHE_resultats')) define('_DELAI_CACHE_resultats', 600);

// Preparer les listes id_article IN (...) pour les parties WHERE
// et points =  des requetes du moteur de recherche
// http://doc.spip.org/@inc_prepare_recherche_dist
function inc_prepare_recherche_dist($recherche, $table='articles', $cond=false, $serveur='',$plat=false) {
	static $cache = array();
	$delai_fraicheur = min(_DELAI_CACHE_resultats,time()-$GLOBALS['meta']['derniere_modif']);

	// si recherche n'est pas dans le contexte, on va prendre en globals
	// ca permet de faire des inclure simple.
	if (!isset($recherche) AND isset($GLOBALS['recherche']))
		$recherche = $GLOBALS['recherche'];

	// traiter le cas {recherche?}
	if ($cond AND !strlen($recherche))
		return array("0 as points" /* as points */, /* where */ '');
		
	
	$rechercher = false;

	if (!isset($cache[$recherche][$table])){
		$hash = substr(md5($recherche . $table),0,16);
		$row = sql_fetsel('UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(maj) AS fraicheur','spip_resultats',"recherche='$hash'",'','fraicheur DESC','0,1','',$serveur);
		if (!$row OR ($row['fraicheur']>$delai_fraicheur)){
		 	$rechercher = true;
		}
		$cache[$recherche][$table] = array("resultats.points AS points","recherche='$hash'");
	}

	// si on n'a pas encore traite les donnees dans une boucle precedente
	if ($rechercher) {
		//$tables = liste_des_champs();
		$x = preg_replace(',s$,', '', $table); // eurk
		if ($x == 'syndic') $x = 'site';
		$points = recherche_en_base($recherche,
			$x,
			array(
				'score' => true,
				'toutvoir' => true,
				'jointures' => true
				),
					    $serveur);
		$points = $points[$x];
		
		# Pour les forums, unifier par id_thread et forcer statut='publie', sauf si le crière {plat} ou {tout} est présent
		if ($x == 'forum' AND $points AND $plat != "true") {
			$p2 = array();
            $s = sql_select("id_thread, id_forum, statut", "spip_forum", sql_in('id_forum', array_keys($points)), '','','','', $serveur);
            while ($t = sql_fetch($s, $serveur)){
                   $id_thread = intval($t['id_thread']);
                   $id_forum = intval($t['id_forum']);
                   if ($id_thread){
                           if ($t['statut'] == 'publie')
                                   $p2[$id_thread]['score']
                                           += $points[$id_forum]['score'];
                   }
                   else{
                           $p2[$id_forum]['score'] = $points[$id_forum]['score'];
                   }
            }			
			$points = $p2;
		}

		// supprimer les anciens resultats de cette recherche
		// et les resultats trop vieux avec une marge
		sql_delete('spip_resultats','(maj<DATE_SUB(NOW(), INTERVAL '.($delai_fraicheur+100)." SECOND)) OR (recherche='$hash')",$serveur);

		// inserer les resultats dans la table de cache des resultats
		if (count($points)){
			$tab_couples = array();
			foreach ($points as $id => $p){
				$tab_couples[] = array(
					'recherche' => $hash,
					'id' => $id,
					'points' => $p['score']
				);
			}
			sql_insertq_multi('spip_resultats',$tab_couples,array(),$serveur);
		}
	}

	return $cache[$recherche][$table];
}



?>
