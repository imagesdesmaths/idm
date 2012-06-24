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

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Pipeline header_prive
 * 
 * @param string $flux
 * @return string
 */
function compresseur_header_prive($flux){
	include_spip('compresseur_fonctions');
	return compacte_head($flux);
}

/**
 * injecter l'appel au compresseur sous la forme de filtre
 * pour intervenir sur l'ensemble du head
 * du squelette public
 * 
 * @param string $flux
 * @return string
 */
function compresseur_insert_head($flux){
	$flux .= '<'
		.'?php header("X-Spip-Filtre: '
		.'compacte_head'
		.'"); ?'.'>';
	return $flux;
}

/**
 * Afficher le formulaire de configuration sur la page de config avancees
 * @param string $flux
 * @return string
 */
function compresseur_affiche_milieu($flux){
	
	if ($flux['args']['exec']=='configurer_avancees'){
			// Compression http et compactages CSS ou JS
			$flux['data'] .= recuperer_fond('prive/squelettes/inclure/configurer',array('configurer'=>'configurer_compresseur'));
	}

	return $flux;
}

/**
 * Lister les metas et leurs valeurs par defaut
 * @param array $metas
 * @return array
 */
function compresseur_configurer_liste_metas($metas){
	$metas['auto_compress_js']='non';
	$metas['auto_compress_closure']='non';
	$metas['auto_compress_css']='non';
	return $metas;
}

/**
 * Declarer les filtres sur les squelettes mis en cache
 * ici minification CSS si la meta la demande
 *
 * @param array $filtres
 * @return array
 */
function compresseur_declarer_filtres_squelettes($flux){
	if (!test_espace_prive()
	  AND !defined('_INTERDIRE_COMPRESSION_HTML')
	  AND $GLOBALS['meta']['auto_compress_http']=='oui'
		AND (!isset($flux['args']['entetes']['Content-Type']) OR strncmp($flux['args']['entetes']['Content-Type'],'text/html',9)==0)
	){
		include_spip("inc/compresseur_minifier");
		$flux['data'][] = 'minifier_html';
	}
  return $flux;
}

?>