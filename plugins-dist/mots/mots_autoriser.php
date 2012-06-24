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

function mots_autoriser(){}


function autoriser_mots_menu_dist($faire, $type, $id, $qui, $opt){
	if ($qui['statut'] == '0minirezo')
		return 	($GLOBALS['meta']['articles_mots'] != 'non' OR sql_countsel('spip_groupes_mots'));
	$where = "";
	if ($qui['statut']=='1comite')
		$where = "comite='oui' OR forum='oui'";
	if ($qui['statut']=='6forum')
		$where = "forum='oui'";
	return ($where
		AND $GLOBALS['meta']['articles_mots'] != 'non'
	  AND sql_countsel('spip_groupes_mots',$where));
}

function autoriser_motcreer_menu_dist($faire, $type, $id, $qui, $opt){
	return 	($GLOBALS['meta']['articles_mots'] != 'non'
		AND sql_countsel('spip_groupes_mots')
	  AND autoriser('creer','mot',null,$qui,$opt));
}

// Voir un objet
// http://doc.spip.org/@autoriser_voir_dist
function autoriser_groupemots_voir_dist($faire, $type, $id, $qui, $opt) {
	if ($qui['statut'] == '0minirezo') return true;
	$acces = sql_fetsel("comite,forum", "spip_groupes_mots", "id_groupe=".intval($id));
	if ($qui['statut']=='1comite' AND ($acces['comite'] == 'oui' OR $acces['forum'] == 'oui'))
		return true;
	if ($qui['statut']=='6forum' AND $acces['forum'] == 'oui')
		return true;
	return false;
}

// Autoriser a creer un groupe de mots
// http://doc.spip.org/@autoriser_groupemots_creer_dist
function autoriser_groupemots_creer_dist($faire, $type, $id, $qui, $opt) {
	return
		$qui['statut'] == '0minirezo'
		AND !$qui['restreint'];
}

// Autoriser a modifier un groupe de mots $id
// y compris en ajoutant/modifiant les mots lui appartenant
// http://doc.spip.org/@autoriser_groupemots_modifier_dist
function autoriser_groupemots_modifier_dist($faire, $type, $id, $qui, $opt) {
	return
		$qui['statut'] == '0minirezo' AND !$qui['restreint']
		AND autoriser('voir','groupemots',$id,$qui,$opt);
}

/**
 * Autoriser a supprimer un groupe de mots $id
 */
function autoriser_groupemots_supprimer_dist($faire, $type, $id, $qui, $opt) {
	if (!autoriser('modifier','groupemots',$id))
		return false;
	return sql_countsel('spip_mots','id_groupe='.intval($id))?false:true;
}

// Autoriser a modifier un mot $id ; note : si on passe l'id_groupe
// dans les options, on gagne du CPU (c'est ce que fait l'espace prive)
// http://doc.spip.org/@autoriser_mot_modifier_dist
function autoriser_mot_modifier_dist($faire, $type, $id, $qui, $opt) {
	return
	isset($opt['id_groupe'])
		? autoriser('modifier', 'groupemots', $opt['id_groupe'], $qui, $opt)
		: (
			$t = sql_getfetsel("id_groupe", "spip_mots", "id_mot=".intval($id))
			AND autoriser('modifier', 'groupemots', $t, $qui, $opt)
		);
}

function autoriser_mot_creer_dist($faire, $type, $id, $qui, $opt) {
	if ($qui['statut'] != '0minirezo' OR $qui['restreint'])
		return false;

	$where = '';
	// si objet associe, verifier qu'un groupe peut etre associe
	// a la table correspondante
	if (isset($opt['associer_objet'])
	  AND $associer_objet = $opt['associer_objet']){
		if (!preg_match(',^(\w+)\|[0-9]+$,',$associer_objet,$match))
			return false;
		$where = "tables_liees REGEXP '(^|,)".addslashes(table_objet($match[1]))."($|,)'";
	}
	// si pas de groupe de mot qui colle, pas le droit
	if (!sql_countsel('spip_groupes_mots',$where))
		return false;

	if (isset($opt['id_groupe']))
		return autoriser('modifier','groupemots',$opt['id_groupe']);
	
	return true;
}

// Supprimer un mot ?
// Par défaut : pouvoir créer un mot dans le groupe
function autoriser_mot_supprimer_dist($faire, $type, $id, $qui, $opt) {
	// On cherche le groupe du mot
	$id_groupe = $opt['id_groupe'] ? $opt['id_groupe'] : sql_getfetsel('id_groupe', 'spip_mots', 'id_mot = '.intval($id));
	
	return autoriser('creer', 'mot', $id, $qui, array('id_groupe'=>$id_groupe));
}


/**
 * Autorisation pour verifier le droit d'associer des mots
 * a un objet
 * si groupe_champ ou id_groupe est fourni dans opts, on regarde les droits pour ce groupe
 * en particulier
 *
 * @return bool
 */
function autoriser_associermots_dist($faire,$quoi,$id,$qui,$opts){
	// jamais de mots sur des mots
	if ($quoi=='mot') return false;
	if ($quoi=='groupemots') return false;
	$droit = substr($qui['statut'],1);

	if (!isset($opts['groupe_champs']) AND !isset($opts['id_groupe'])){
		// chercher si un groupe est autorise pour mon statut
		// et pour la table demandee
		$table = addslashes(table_objet($quoi));
		if (sql_countsel('spip_groupes_mots',"tables_liees REGEXP '(^|,)$table($|,)' AND ".addslashes($droit)."='oui'"))
			return true;
	}
	// cas d'un groupe en particulier
	else {
		// on recupere les champs du groupe s'ils ne sont pas passes en opt
		if (!isset($opts['groupe_champs'])){
			if (!$id_groupe = $opts['id_groupe'])
				return false;
			include_spip('base/abstract_sql');
			$opts['groupe_champs'] = sql_fetsel("*", "spip_groupes_mots", "id_groupe=".intval($id_groupe));
		}
		$droit = $opts['groupe_champs'][$droit];

		return
			($droit == 'oui')
			AND
			// on verifie que l'objet demande est bien dans les tables liees
			in_array(
				table_objet($quoi),
				explode(',', $opts['groupe_champs']['tables_liees'])
			);
	}
	return false;
}


/**
 * Autorisation pour verifier le droit d'afficher le selecteur de mots
 * pour un groupe de mot donne, dans un objet / id_objet donne
 *
 * @return bool
 */
function autoriser_groupemots_afficherselecteurmots_dist($faire,$quoi,$id,$qui,$opts){
	return true;
}


	
// http://doc.spip.org/@autoriser_mot_iconifier_dist
function autoriser_mot_iconifier_dist($faire,$quoi,$id,$qui,$opts){
 return (($qui['statut'] == '0minirezo') AND !$qui['restreint']);
}

function autoriser_groupemots_iconifier_dist($faire,$quoi,$id,$qui,$opts){
 return (($qui['statut'] == '0minirezo') AND !$qui['restreint']);
}

?>
