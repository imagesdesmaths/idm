<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2006                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;


define ('_DEBUG_AUTORISER', false);

// surcharge possible de autoriser(), sinon autoriser_dist()
// http://doc.spip.org/@autoriser
if (!function_exists('autoriser')) {
// http://doc.spip.org/@autoriser
	function autoriser() {
		$args = func_get_args(); 
		return call_user_func_array('autoriser_dist', $args);
	}
}
function auth_rubrique_compat($id_auteur, $statut)
{
	if ($statut != '0minirezo') return $statut;

	$result = spip_query("SELECT id_rubrique FROM spip_auteurs_rubriques WHERE id_auteur=$id_auteur AND id_rubrique!='0'");
	//adapation SPIP2
	//if (!spip_num_rows($result)) {
	if (!sql_count($result)) {
		$GLOBALS['connect_toutes_rubriques'] = true;
		return 0;
	}

	$rubriques = array();
	for (;;) {
		$r = array();
		while ($row = spip_fetch_array($result)) {
			$id_rubrique = $row['id_rubrique'];
			$r[]= $rubriques[$id_rubrique] = $id_rubrique;
		}
		if (!$r) return $rubriques;
		$r = join(',', $r);

		$result = spip_query("SELECT id_rubrique FROM spip_rubriques WHERE id_parent IN ($r) AND id_rubrique NOT IN ($r)");
	}
}

// API pour une fonction generique d'autorisation :
// $qui est : vide (on prend alors auteur_session)
//            un id_auteur (on regarde dans la base)
//            un tableau auteur complet, y compris [restreint]
// $faire est une action ('modifier', 'publier'...)
// $type est un type d'objet ou nom de table ('article')
// $id est l'id de l'objet sur lequel on veut agir
// $opt (inutilise pour le moment) = options sous forme de tableau associatif
// (par exemple pour preciser si l'autorisation concerne tel ou tel champ)
//
// Seul le premier argument est obligatoire
//
// http://doc.spip.org/@autoriser_dist
function autoriser_dist($faire, $type='', $id=0, $qui = NULL, $opt = NULL) {
	static $restreint = array();

	// Qui ? auteur_session ?
	if (!is_array($qui)) {
		if (is_int($qui)) {
			$qui = spip_fetch_array(spip_query(
			"SELECT * FROM spip_auteurs WHERE id_auteur=".$qui));
		} else {
			$qui = $GLOBALS['auteur_session'];
		}
	}

	// Admins restreints, les verifier ici (pas generique mais...)
	// Par convention $restreint est un array des rubriques autorisees
	// (y compris leurs sous-rubriques), ou 0 si admin complet
	if (is_array($qui)
	AND $qui['statut'] == '0minirezo'
	AND !isset($qui['restreint'])) {
		if (!isset($restreint[$qui['id_auteur']])) {
			include_spip('inc/auth'); # pour auth_rubrique
			$restreint[$qui['id_auteur']] = auth_rubrique_compat($qui['id_auteur'], $qui['statut']);
		}
		$qui['restreint'] = $restreint[$qui['id_auteur']];
	}

	if (_DEBUG_AUTORISER) spip_log("autoriser $faire $type $id ?");

	// Chercher une fonction d'autorisation explicite
	if (
	// 1. Sous la forme "autoriser_type_faire"
		(
		$type
		AND $f = 'autoriser_'.$type.'_'.$faire
		AND (function_exists($f) OR function_exists($f.='_dist'))
		)

	// 2. Sous la forme "autoriser_type"
	// ne pas tester si $type est vide
	OR (
		$type
		AND $f = 'autoriser_'.$type
		AND (function_exists($f) OR function_exists($f.='_dist'))
	)

	// 3. Sous la forme "autoriser_faire"
	OR (
		$f = 'autoriser_'.$faire
		AND (function_exists($f) OR function_exists($f.='_dist'))
	)

	// 4. Sinon autorisation generique
	OR (
		$f = 'autoriser_defaut'
		AND (function_exists($f) OR function_exists($f.='_dist'))
	)

	)
		$a = $f($faire,$type,intval($id),$qui,$opt);

	if (_DEBUG_AUTORISER) spip_log("$f($faire,$type,$id): ".($a?'OK':'niet'));

	return $a;
}

// Autorisation par defaut : les admins complets OK, les autres non
// http://doc.spip.org/@autoriser_defaut_dist
function autoriser_defaut_dist($faire, $type, $id, $qui, $opt) {
	return
		$qui['statut'] == '0minirezo'
		AND !$qui['restreint'];
}

// Autoriser a publier dans la rubrique $id
// http://doc.spip.org/@autoriser_rubrique_publierdans_dist
function autoriser_rubrique_publierdans_dist($faire, $type, $id, $qui, $opt) {
	return
		($qui['statut'] == '0minirezo')
		AND (!$qui['restreint']
			? true
			: in_array($id, $qui['restreint'])
		);
}

// Autoriser a modifier la rubrique $id
// = publierdans rubrique $id
// http://doc.spip.org/@autoriser_rubrique_modifier_dist
function autoriser_rubrique_modifier_dist($faire, $type, $id, $qui, $opt) {
	return
		autoriser('publierdans', 'rubrique', $id, $qui, $opt);
}

// Autoriser a modifier la breve $id
// = admins & redac si la breve n'est pas publiee
// = admins de rubrique parente si publiee
// http://doc.spip.org/@autoriser_breve_modifier_dist
function autoriser_breve_modifier_dist($faire, $type, $id, $qui, $opt) {
	$s = spip_query(
	"SELECT id_rubrique,statut FROM spip_breves WHERE id_breve="._q($id));
	$r = spip_fetch_array($s);
	return
		($r['statut'] == 'publie')
			? autoriser('publierdans', 'rubrique', $r['id_rubrique'], $qui, $opt)
			: in_array($qui['statut'], array('0minirezo', '1comite'));
}

// Autoriser a modifier l'article $id
// = publierdans rubrique parente
// = ou statut 'prop,prepa' et $qui est auteur
// http://doc.spip.org/@autoriser_article_modifier_dist
function autoriser_article_modifier_dist($faire, $type, $id, $qui, $opt) {
	$s = spip_query(
	"SELECT id_rubrique,statut FROM spip_articles WHERE id_article="._q($id));
	$r = spip_fetch_array($s);
	return
		autoriser('publierdans', 'rubrique', $r['id_rubrique'], $qui, $opt)
		OR (
			in_array($qui['statut'], array('0minirezo', '1comite'))
			AND in_array($r['statut'], array('prop','prepa', 'poubelle'))
			//adapation SPIP2
			//AND spip_num_rows(auteurs_article($id, "id_auteur=".$qui['id_auteur']))
			AND sql_count(auteurs_article($id, "id_auteur=".$qui['id_auteur']))
		);
}

// Lire les stats ?
// = tous les admins
// http://doc.spip.org/@autoriser_voirstats_dist
function autoriser_voirstats_dist($faire, $type, $id, $qui, $opt) {
	return
		$qui['statut'] == '0minirezo';
}


// Voir un objet
// http://doc.spip.org/@autoriser_voir_dist
function autoriser_voir_dist($faire, $type, $id, $qui, $opt) {
	if (
		($qui['statut'] == '0minirezo')
		OR ($type != 'article')
	)
		return true;

	// un article 'prepa' ou 'poubelle' dont on n'est pas auteur : interdit
	$s = spip_query(
	"SELECT statut FROM spip_articles WHERE id_article="._q($id));
	$r = spip_fetch_array($s);
	return
		in_array($r['statut'], array('prop', 'publie'))
		//adapation SPIP2
		//OR spip_num_rows(auteurs_article($id, "id_auteur=".$qui['id_auteur']));
		OR sql_count(auteurs_article($id, "id_auteur=".$qui['id_auteur']));
}

// Voir les revisions ?
// = voir l'objet
// http://doc.spip.org/@autoriser_voirrevisions_dist
function autoriser_voirrevisions_dist($faire, $type, $id, $qui, $opt) {
	return
		autoriser('voir', $type, $id, $qui, $opt);
}

// Moderer le forum ?
// = modifier l'objet correspondant (si forum attache a un objet)
// = droits par defaut sinon (admin complet pour moderation complete)
// http://doc.spip.org/@autoriser_modererforum_dist
function autoriser_modererforum_dist($faire, $type, $id, $qui, $opt) {
	return
		autoriser('modifier', $type, $id, $qui, $opt);
}

// Modifier un forum ?
// = jamais !
// http://doc.spip.org/@autoriser_modifier_forum_dist
function autoriser_modifier_forum_dist($faire, $type, $id, $qui, $opt) {
	return
		false;
}


// Moderer la petition ?
// = modifier l'article correspondant
// = droits par defaut sinon (admin complet pour moderation de tout)
// http://doc.spip.org/@autoriser_moderer_petition_dist
function autoriser_moderer_petition_dist($faire, $type, $id, $qui, $opt) {
	return
		autoriser('modifier', $type, $id, $qui, $opt);
}

?>
