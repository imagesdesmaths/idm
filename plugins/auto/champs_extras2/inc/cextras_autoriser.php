<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

// mes_fonctions peut aussi declarer des autorisations, donc il faut donc le charger
// en 2.1, c'est deja fait dans inc/autoriser.
// en 2.0, c'est include ($f) au lieu de include_once dans public/parametrer...
// du coup, on appelle directement ce fichier pour eviter des plantages.
include_spip('public/parametrer'); 


// fonction pour le pipeline autoriser
function cextras_autoriser(){}


/**
  * Autorisation de voir un champ extra
  * autoriser('voirextra','auteur_prenom', $id_auteur);
  * -> autoriser_auteur_prenom_voirextra_dist() ...
  */
function autoriser_voirextra_dist($faire, $type, $id, $qui, $opt){
	return true;
}

/**
  * Autorisation de modifier un champ extra
  * autoriser('modifierextra','auteur_prenom', $id_auteur);
  * -> autoriser_auteur_prenom_modifierextra_dist() ...
  */
function autoriser_modifierextra_dist($faire, $type, $id, $qui, $opt){
	return true;
}



/**
 *
 * API pour aider les plus demunis
 * Permet d'indiquer que tels champs extras se limitent a telle ou telle rubrique
 * et cela en creant a la volee les fonctions d'autorisations adequates.
 * 
 * Exemples :
 *   restreindre_extras('article', array('nom', 'prenom'), array(8, 12));
 *   restreindre_extras('site', 'url_doc', 18, true); // recursivement aux sous rubriques
 *
 * @param string $objet      objet possedant les extras
 * @param mixed  $noms       nom des extras a restreindre
 * @param mixed  $ids        identifiant (des rubriques par defaut) sur lesquelles s'appliquent les champs
 * @param string $cible      type de la fonction de test qui sera appelee, par defaut "rubrique". Peut aussi etre "secteur", "groupe" ou des fonctions definies
 * @param bool   $recursif   application recursive sur les sous rubriques ? ATTENTION, c'est gourmand en requetes SQL :)
 *
 * @return bool : true si on a fait quelque chose
 */
function restreindre_extras($objet, $noms=array(), $ids=array(), $cible='rubrique', $recursif=false) {
	if (!$objet or !$noms or !$ids) {
		return false;
	}

	if (!is_array($noms)) { $noms = array($noms); }
	if (!is_array($ids))  { $ids  = array($ids); }

	$objet = objet_type($objet);
	$ids = var_export($ids, true);
	$recursif = var_export($recursif, true);

	$m = '_modifierextra_dist';
	$v = '_voirextra_dist';
	foreach ($noms as $nom) {
		$f = "autoriser_$objet" . "_$nom";
		$code = "
			if (!function_exists('$f$m')) {
				function $f$m(\$faire, \$type, \$id, \$qui, \$opt) {
					return _restreindre_extras_objet('$objet', \$id, \$opt, $ids, '$cible', $recursif);
				}
			}
			if (!function_exists('$f$v')) {
				function $f$v(\$faire, \$type, \$id, \$qui, \$opt) {
					return autoriser('modifierextra', \$type, \$id, \$qui, \$opt);
				}
			}
		";
#		echo $code;
		eval($code);
	}

	return true;
}



/**
 *
 * Fonction d'autorisation interne a la fonction restreindre_extras()
 * Teste si un objet a le droit d'afficher des champs extras
 * en fonction de la rubrique (ou autre defini dans la cible)
 * dans laquelle il se trouve et des rubriques autorisees
 *
 * On cache pour eviter de plomber le serveur SQL, vu que la plupart du temps
 * un hit demandera systematiquement le meme objet/id_objet lorsqu'il affiche
 * un formulaire.
 *
 * @param string $objet      objet possedant les extras
 * @param int    $id_objet   nom des extras a restreindre
 * @param array  $opt        options des autorisations
 * @param mixed  $ids        identifiant(s) (en rapport avec la cible) sur lesquelles s'appliquent les champs
 * @param string $cible      type de la fonction de test qui sera appelee, par defaut "rubrique". Peut aussi etre "secteur", "groupe" ou des fonctions definies
 * @param bool   $recursif   application recursive sur les sous rubriques ? ATTENTION, c'est gourmand en requetes SQL :)
 *
 * @return bool : autorise ou non .
 */
function _restreindre_extras_objet($objet, $id_objet, $opt, $ids, $cible='rubrique', $recursif=false) {
	static $autorise = null;

	if ( $autorise === null )        { $autorise = array(); }
	if ( !isset($autorise[$objet]) ) { $autorise[$objet] = array(); }

	$cle = $cible . implode('-', $ids);
	if (isset($autorise[$objet][$id_objet][$cle])) {
		return $autorise[$objet][$id_objet][$cle];
	}

	$f = charger_fonction("restreindre_extras_objet_sur_$cible", "inc", true);
	if ($f) {
		return $autorise[$objet][$id_objet][$cle] =
			$f($objet, $id_objet, $opt, $ids, $recursif);
	}

	// pas trouve... on n'affiche pas... Pan !
	return $autorise[$objet][$id_objet][$cle] = false;
}


/**
 *
 * Fonction d'autorisation interne a la fonction restreindre_extras()
 * Teste si un objet a le droit d'afficher des champs extras
 * en fonction de la rubrique (ou autre defini dans la cible)
 * dans laquelle il se trouve et des rubriques autorisees
 * Le dernier argument donne la colonne a chercher dans l'objet correspondant
 *
 * @param string $objet      objet possedant les extras
 * @param int    $id_objet   nom des extras a restreindre
 * @param array  $opt        options des autorisations
 * @param mixed  $ids        identifiant(s) (en rapport avec la cible) sur lesquelles s'appliquent les champs
 * @param bool   $_id_cible  nom de la colonne SQL cible (id_rubrique, id_secteur, id_groupe...)
 *
 * @return mixed : true : autorise, false : non autorise, 0 : incertain.
 * 
 */
function _restreindre_extras_objet_sur_cible($objet, $id_objet, $opt, $ids, $_id_cible) {

    $id_cible = $opt['contexte'][$_id_cible];

    if (!$id_cible) {
		// on tente de le trouver dans la table de l'objet
		$table = table_objet_sql($objet);
		$id_table = id_table_objet($table);
		$trouver_table = charger_fonction('trouver_table', 'base');
		$desc = $trouver_table( table_objet($table) );
		if (isset($desc['field'][$_id_cible])) {
			$id_cible = sql_getfetsel($_id_cible, $table, "$id_table=".sql_quote($id_objet));
		}
    }

	if (!$id_cible) {
		// on essaie aussi dans le contexte d'appel de la page
		$id_cible = _request($_id_cible);
		
		// on tente en cas de id_secteur de s'appuyer sur un eventuel id_rubrique
		if (!$id_cible and $_id_cible == 'id_secteur') {
			if ($i = _request('id_rubrique')) {
				$id_cible = sql_getfetsel('id_secteur', 'spip_rubriques', 'id_rubrique='.sql_quote($i));
			}
		}
	}

	if (!$id_cible) {
		return array($id_cible, false);
	}

    if (in_array($id_cible, $ids)) {
		return array($id_cible, true);
    }

    return array($id_cible, false);
}



/**
 *
 * Fonction d'autorisation interne a la fonction restreindre_extras()
 * specifique au test d'appartenance a une rubrique
 *
 * @param string $objet      objet possedant les extras
 * @param int    $id_objet   nom des extras a restreindre
 * @param array  $opt        options des autorisations
 * @param mixed  $ids        identifiant(s) des rubriques sur lesquelles s'appliquent les champs
 * @param bool   $recursif   application recursive sur les sous rubriques ? ATTENTION, c'est gourmand en requetes SQL :)
 *
 * @return bool : autorise ou non .
 */
function inc_restreindre_extras_objet_sur_rubrique_dist($objet, $id_objet, $opt, $ids, $recursif) {

	list($id_rubrique, $ok) = _restreindre_extras_objet_sur_cible($objet, $id_objet, $opt, $ids, 'id_rubrique');
	if ($ok) {
		return true;
	}
	
	// on teste si l'objet est dans une sous rubrique de celles mentionnee...
	if ($id_rubrique and $recursif) {
		$id_parent = $id_rubrique;
		while ($id_parent = sql_getfetsel("id_parent", "spip_rubriques", "id_rubrique=" . sql_quote($id_parent))) {
			if (in_array($id_parent, $ids)) {
				return true;
			}
		}
	}
		  
    return false;
}




/**
 *
 * Fonction d'autorisation interne a la fonction restreindre_extras()
 * specifique au test d'appartenance a une rubrique
 *
 * @param string $objet      objet possedant les extras
 * @param int    $id_objet   nom des extras a restreindre
 * @param array  $opt        options des autorisations
 * @param mixed  $ids        identifiant(s) des rubriques sur lesquelles s'appliquent les champs
 * @param bool   $recursif   (non utilise)
 *
 * @return bool : autorise ou non .
 */
function inc_restreindre_extras_objet_sur_secteur_dist($objet, $id_objet, $opt, $ids, $recursif=false) {
	list($id_secteur, $ok) = _restreindre_extras_objet_sur_cible($objet, $id_objet, $opt, $ids, 'id_secteur');
	return $ok;
}




/**
 *
 * Fonction d'autorisation interne a la fonction restreindre_extras()
 * specifique au test d'appartenance a une rubrique
 *
 * @param string $objet      objet possedant les extras
 * @param int    $id_objet   nom des extras a restreindre
 * @param array  $opt        options des autorisations
 * @param mixed  $ids        identifiant(s) des rubriques sur lesquelles s'appliquent les champs
 * @param bool   $recursif   application recursive sur les sous rubriques ? ATTENTION, c'est gourmand en requetes SQL :)
 *
 * @return bool : autorise ou non .
 */
function inc_restreindre_extras_objet_sur_groupemot_dist($objet, $id_objet, $opt, $ids, $recursif) {
	list($id_groupe, $ok) = _restreindre_extras_objet_sur_cible($objet, $id_objet, $opt, $ids, 'id_groupe');
	if ($ok) {
		return true;
	}

	// on teste si l'objet est dans un sous groupe de celui mentionne...
	// sauf qu'il n'existe pas encore de groupe avec id_parent :) - sauf avec plugin
	// on desactive cette option si cette colonne est absente
	if ($id_groupe and $recursif) {
		$trouver_table = charger_fonction('trouver_table', 'base');
		$desc = $trouver_table("groupes_mots");
		if (isset($desc['field']['id_parent'])) {
			$id_parent = $id_groupe;
			while ($id_parent = sql_getfetsel("id_parent", "spip_groupes_mots", "id_parent=" . sql_quote($id_parent))) {
				if (in_array($id_parent, $ids)) {
					return true;
				}
			}
		}
	}
		  
    return false;
}

?>
