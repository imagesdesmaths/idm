<?php
// filtre 'titre_rubrique' a utiliser sur #ID_RUBRIQUE d'un objet ou #ID_PARENT d'une rubrique
// Ex :  : <BOUCLE_a(ARTICLES)>[(#ID_RUBRIQUE|titre_rubrique)]</BOUCLE_a>
// Ex :  : <BOUCLE_b(BREVES)>[(#ID_RUBRIQUE|titre_rubrique)]</BOUCLE_b>
// Ex :  : <BOUCLE_r(RUBRIQUES)>[(#ID_PARENT|titre_rubrique)]</BOUCLE_r>
//
// filtre 'titre_groupe' a utiliser sur #ID_GROUPE d'un mot-clef
// Ex :  : <BOUCLE_m(MOTS)>[(#ID_GROUPE|titre_groupe)]</BOUCLE_m>
if(defined('_SPIP19300')) {
	function filtre_titre_rubrique($id_rubrique, $table='rubriques', $id='id_rubrique') {
		return cs_titre_id($id_rubrique, $table, $id);
	}
	function filtre_titre_groupe($id_mot, $table='groupes_mots', $id='id_groupe') {
		return cs_titre_id($id_mot, $table, $id);
	}
} else {
	function titre_rubrique($id_rubrique, $table='rubriques', $id='id_rubrique') {
		return cs_titre_id($id_rubrique, $table, $id);
	}
	function titre_groupe($id_mot, $table='groupes_mots', $id='id_groupe') {
		return cs_titre_id($id_mot, $table, $id);
	}
}

// filtre 'titre_id', s'applique aux #ID_OBJET
// Renvoie le titre trouve dans la $table_parent, la ou $champ_id = $id
function cs_titre_id($id, $table_parent='rubriques', $champ_id='id_rubrique') {
// spip_log("#TITRE_PARENT SELECTED FROM spip_$table_parent WHERE $champ_id=$id".(!$id?' : requete non executee':''));
	// retour nul si pas de parent a priori
	if(!$id) return '';
	return cs_titre_sql($table_parent, "$champ_id=$id");
}

// choix du champ qui correspond a un titre
function cs_titre_champ($table) {
	return $table=='auteurs'?'nom':'titre';
}

// cherche le titre/nom d'un objet en base
function cs_titre_sql($table, $where) {
	$titre = cs_titre_champ($table);
	// Utiliser la bonne requete en fonction de la version de SPIP
	if(function_exists('sql_getfetsel') && function_exists('table_objet_sql')) {
		// SPIP 2.0
		if($r = sql_getfetsel($titre, table_objet_sql($table), $where))
			return $r;
	} else {
		if($r = spip_query("SELECT $titre FROM spip_$table WHERE $where"))
			// s'il existe un champ, on le retourne
			if($row = spip_fetch_array($r)) return $row[$titre];
	}
	// sinon, rien !
	return '';
}

// Rubrique parente de tout objet possedant un 'id_rubrique' ou groupe de mot-clef
function balise_TITRE_PARENT_dist($p) {
	// examen du contexte
	switch ($p->type_requete) {
		case 'rubriques':
			$table_parent = 'rubriques';
			$champ_parent = 'id_rubrique';
			$id = 'id_parent';
			break;
		case 'mots':
			$table_parent = 'groupes_mots';
			$id = $champ_parent = 'id_groupe';
			break;
		default:
			$table_parent = 'rubriques';
			$id = $champ_parent = 'id_rubrique';
			break;
	}
	// id de l'objet a trouver pour retourner son titre
	$id = champ_sql($id, $p);
	// le code php a executer
	$p->code = "cs_titre_id(intval($id), '$table_parent', '$champ_parent')";
	$p->interdire_scripts = false;
	return $p;
}

// juste le groupe d'un mot-clef
function balise_TITRE_GROUPE_dist($p) {
	$p->code = "''";
	$p->interdire_scripts = false;
	return $p->type_requete=='mots'?balise_TITRE_PARENT_dist($p):$p;
}

if(defined('_SPIP19300') && defined('_PARENTS_ETENDUS')) {

	// recherche de la table associee a l'objet
	function cs_table_objet($objet) {
		switch($objet) {
			case 'trad': return 'articles';
			case 'thread': /*case 'forum':*/ return 'forum';
			case 'secteur': return 'rubriques';
#			case 'import': return ''; // a quoi ca sert ?
		}
		return table_objet($objet);
	}
	
	// balise #TITRE_QQCHOSE
	// voire #TITRE_QQCHOSE{id_qqchose}
	function balise_TITRE__dist($p) {
		$champ = $p->nom_champ;
		if ($f = charger_fonction($champ, 'balise', true))
			return $f($p);
		$code = champ_sql($champ, $p);
		if (strpos($code, '@$Pile[0]') !== false) {
			// le champ est absent de la base, on peut calculer la balise
			preg_match(",^TITRE_([A-Z_]+)?$,i", $champ, $regs);
			$objet = strtolower($regs[1]);
			$table = cs_table_objet($objet);
			$champ_parent = id_table_objet($table);
			// id de l'objet a trouver pour retourner son titre
			$id = ($v = interprete_argument_balise(1,$p))!==NULL ? $v : champ_sql('id_'.$objet, $p);
			// le code php a executer, avant de le passer aux traitements
			$p->code = cs_titre_traitements("cs_titre_id(intval($id), '$table', '$champ_parent')", $table);
		} else 
			// puisque le champ est present dans la base, on le renvoie
			$p->code = champ_sql($champ, $p);
		$p->interdire_scripts = false;
		return $p;
	}

	// voir la fonction champs_traitements($p) dans : public/refereces.php
	function cs_titre_traitements($code, $table) {
		global $table_des_traitements;
		$ps = $table_des_traitements[strtoupper(cs_titre_champ($table))];
		if (is_array($ps))
			$ps = $ps[isset($ps[$table])?$table:0];
		if (!$ps) return $code;
		// champs sensibles
		if(in_array($table, array('messages', 'forums', 'signatures', 'syndic_articles')))
			$ps = "safehtml($ps)";
		// remplacement final
		return str_replace('%s', $code, $ps);
	}

} // if(defined('_SPIP19300'))

include_spip('public/interfaces');
global $table_des_traitements;

// TITRE_PARENT et TITRE_GROUPE sont des TITREs !
if (!isset($table_des_traitements['TITRE_PARENT']))
	$table_des_traitements['TITRE_PARENT'] = $table_des_traitements['TITRE'];
if (!isset($table_des_traitements['TITRE_GROUPE']))
	$table_des_traitements['TITRE_GROUPE'] = $table_des_traitements['TITRE'];

?>