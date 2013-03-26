<?php

/**
 * Déclaration d'autorisations pour les champs extras
 *
 * @package SPIP\Cextras\Autorisations
**/

// sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * Fonction d'appel pour le pipeline autoriser
 * @pipeline autoriser
 */
function cextras_autoriser(){}


/**
 * Retourne si une saisie peut s'afficher ou non 
 *
 * Teste les options de restrictions de la saisie si il y en a
 * et calcule en fonction l'autorisation
 * 
 * @param array $saisie
 *     Saisie que l'on traite.
 * @param string $action
 *     Le type d'action : voir | modifier
 * @param string $table
 *     La table d'application : spip_articles
 * @param int $id
 *     Identifiant de la table : 3
 * @param array $qui
 *     Description de l'auteur en cours
 * @param Array $opt
 *     Options de l'autorisation
 * @return Bool
 *     La saisie peut elle s'afficher ?
**/
function champs_extras_restrictions($saisie, $action, $table, $id, $qui, $opt) {
	if (!$saisie) {
		return true;
	}
	
	if (!isset($saisie['options']['restrictions']) OR !$saisie['options']['restrictions']) {
		return true;
	}

	if (!in_array($action, array('voir', 'modifier'))) {
		return true;
	}

	$restrictions = $saisie['options']['restrictions'];

	// tester si des options d'autorisations sont definies pour cette saisie
	// et les appliquer.
	// peut être 'voir' ou 'modifier'
		// dedans peut être par type d'auteur 'webmestre', 'admin'
	// peut être par secteur parent.
	// peut être par branche parente.
	// peut être par groupe parent.

	// restriction par type d'auteur
	if (isset($restrictions[$action]['auteur']) and $auteur = $restrictions[$action]['auteur']) {
		switch ($auteur) {
			case 'webmestre':
				if (!autoriser('webmestre')) {
					return false;
				}
				break;
			case 'admin':
				if ($qui['statut'] != '0minirezo' AND !$qui['restreint']) {
					return false;
				}
				break;
		}
	}

	// pour les autres autorisations, dès qu'une est valide, on part.
	// cela permet de dire que l'on peut restreindre au secteur 1 et à la branche 3,
	// branche en dehors du secteur 1
	// le cumul des autorisations rendrait impossible cela
	unset($restrictions['voir']);
	unset($restrictions['modifier']);

	// enlever tous les false (0, '')
	$restrictions = array_filter($restrictions);
	
	if ($restrictions) {
		foreach ($restrictions as $type => $ids) {
			$ids = explode(':', $ids);
			$cible = rtrim($type, 's');
			$restriction = charger_fonction("restreindre_extras_objet_sur_$cible", "inc", true);

			if ($restriction and $restriction($opt['type'], $opt['id_objet'], $opt, $ids, $cible)) {
				return true;
			}
		}
		// aucune des restrictions n'a ete validee
		return false;
	}
	
	return true;
}

/**
 * Autorisation de voir un champ extra
 *
 * Cherche une autorisation spécifique pour le champ si elle existe
 * (autoriser_{objet}_voirextra_{colonne}_dist), sinon applique
 * l'autorisation prévue par la description de la saisie
 * 
 * @example
 *     ```
 *     autoriser('voirextra','auteur', $id_auteur,'',
 *         array('champ'=>'prenom', 'saisie'=>$saisie, ...));
 *     ```
 *     Appelle ``autoriser_auteur_voirextra_prenom_dist()`` si la fonction existe...
 * 
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_voirextra_dist($faire, $type, $id, $qui, $opt){
	if (isset($opt['saisie'])) {
		// tester des fonctions d'autorisations plus precises declarees
		if ($opt['champ']) {
			$f = 'autoriser_' . $opt['type'] . '_voirextra_' . $opt['champ'];
			if (function_exists($f) OR function_exists($f .= '_dist')) {
				return $f($faire, $type, $id, $qui, $opt);
			}
		}
		return champs_extras_restrictions($opt['saisie'], substr($faire, 0, -5), $opt['table'], $id, $qui, $opt);
	}
	return true;
}

/**
 * Autorisation de modifier un champ extra
 *
 * Cherche une autorisation spécifique pour le champ si elle existe
 * (autoriser_{objet}_modifierextra_{colonne}_dist), sinon applique
 * l'autorisation prévue par la description de la saisie
 * 
 * @example
 *     ```
 *     autoriser('modifierextra','auteur', $id_auteur,'',
 *         array('champ'=>'prenom', 'saisie'=>$saisie, ...));
 *     ```
 *     Appelle ``autoriser_auteur_modifierextra_prenom_dist()`` si elle existe
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_modifierextra_dist($faire, $type, $id, $qui, $opt){
	if (isset($opt['saisie'])) {
		// tester des fonctions d'autorisations plus precises declarees
		if ($opt['champ']) {
			$f = 'autoriser_' . $opt['type'] . '_modifierextra_' . $opt['champ'];
			if (function_exists($f) OR function_exists($f .= '_dist')) {
				return $f($faire, $type, $id, $qui, $opt);
			}
		}
		return champs_extras_restrictions($opt['saisie'], substr($faire, 0, -5), $opt['table'], $id, $qui, $opt);
	}
	return true;
}



/**
 * Fonction d'aide pour créer des autorisations de champs spécifiques
 * 
 * Permet d'indiquer que tels champs extras se limitent à telle ou telle rubrique
 * et cela en créant à la volée les fonctions d'autorisations adéquates.
 * 
 * @example
 *     ```
 *     restreindre_extras('article', array('nom', 'prenom'), array(8, 12));
 *     restreindre_extras('site', 'url_doc', 18, true); // recursivement aux sous rubriques
 *     ```
 *
 * @param string $objet
 *     Objet possédant les extras
 * @param mixed $noms
 *     Nom des extras a restreindre
 * @param mixed $ids
 *     Identifiant (des rubriques par defaut) sur lesquelles s'appliquent les champs
 * @param string $cible
 *     Type de la fonction de test qui sera appelee, par defaut "rubrique". Peut aussi etre "secteur", "groupe" ou des fonctions definies
 * @param bool $recursif
 *     Application recursive sur les sous rubriques ? ATTENTION, c'est gourmand en requetes SQL :)
 * @return bool
 *     true si on a fait quelque chose
 */
function restreindre_extras($objet, $noms=array(), $ids=array(), $cible='rubrique', $recursif=false) {
	if (!$objet or !$noms or !$ids) {
		return false;
	}

	if (!is_array($noms)) { $noms = array($noms); }
	if (!is_array($ids))  { $ids  = array($ids); }

	#$objet = objet_type($objet);
	$ids = var_export($ids, true);
	$recursif = var_export($recursif, true);

	foreach ($noms as $nom) {
		$m = "autoriser_" . $objet . "_modifierextra_" . $nom . "_dist";
		$v = "autoriser_" . $objet . "_voirextra_" . $nom . "_dist";

		$code = "
			if (!function_exists('$m')) {
				function $m(\$faire, \$quoi, \$id, \$qui, \$opt) {
					return _restreindre_extras_objet('$objet', \$id, \$opt, $ids, '$cible', $recursif);
				}
			}
			if (!function_exists('$v')) {
				function $v(\$faire, \$quoi, \$id, \$qui, \$opt) {
					return autoriser('modifierextra', \$quoi, \$id, \$qui, \$opt);
				}
			}
		";

		# var_dump($code);
		eval($code);
	}

	return true;
}



/**
 * Fonction d'autorisation interne à la fonction restreindre_extras()
 * 
 * Teste si un objet à le droit d'afficher des champs extras
 * en fonction de la rubrique (ou autre defini dans la cible)
 * dans laquelle il se trouve et des rubriques autorisées
 *
 * On met en cache pour éviter de plomber le serveur SQL, vu que la plupart du temps
 * un hit demandera systématiquement le même objet/id_objet lorsqu'il affiche
 * un formulaire.
 *
 * @param string $objet
 *     Objet possédant les extras
 * @param int $id_objet
 *     Nom des extras a restreindre
 * @param array $opt
 *     Options des autorisations
 * @param mixed $ids
 *     Identifiant(s) (en rapport avec la cible) sur lesquelles s'appliquent les champs
 * @param string $cible
 *     Type de la fonction de test qui sera appelee, par defaut "rubrique".
 *     Peut aussi etre "secteur", "groupe" ou des fonctions definies
 * @param bool $recursif
 *     Application recursive sur les sous rubriques ? ATTENTION, c'est
 *     gourmand en requetes SQL :)
 * @return bool
 *     Autorisé ou non
**/
function _restreindre_extras_objet($objet, $id_objet, $opt, $ids, $cible='rubrique', $recursif=false) {
	static $autorise = array();

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
 * Fonction d'autorisation interne à la fonction restreindre_extras()
 * 
 * Teste si un objet à le droit d'afficher des champs extras
 * en fonction de la rubrique (ou autre defini dans la cible)
 * dans laquelle il se trouve et des rubriques autorisées
 * 
 * Le dernier argument donne la colonne à chercher dans l'objet correspondant
 *
 * @param string $objet
 *     Objet possédant les extras
 * @param int $id_objet
 *     Nom des extras a restreindre
 * @param array $opt
 *     Options des autorisations
 * @param mixed $ids
 *     Identifiant(s) (en rapport avec la cible) sur lesquelles s'appliquent les champs
 * @param bool $_id_cible
 *     Nom de la colonne SQL cible (id_rubrique, id_secteur, id_groupe...)
 * @return bool|int
 *     - true : autorisé,
 *     - false : non autorisé,
 *     - 0 : incertain.
**/
function _restreindre_extras_objet_sur_cible($objet, $id_objet, $opt, $ids, $_id_cible) {

	$id_cible = 0;
	if (isset($opt['contexte'][$_id_cible])) {
		$id_cible = intval($opt['contexte'][$_id_cible]);
	}
  
	if (!$id_cible) {
		// on tente de le trouver dans la table de l'objet
		$table = table_objet_sql($objet);
		$id_table = id_table_objet($table);
		include_spip('base/objets');
		$desc = lister_tables_objets_sql($table);
  
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
 * Fonction d'autorisation interne à la fonction restreindre_extras()
 * spécifique au test d'appartenance à une branche de rubrique
 *
 * @note ATTENTION, c'est gourmand en requetes SQL :)
 * 
 * @see inc_restreindre_extras_objet_sur_rubrique_dist()
 * @param string $objet
 *     Objet possédant les extras
 * @param int $id_objet
 *     Nom des extras a restreindre
 * @param array $opt
 *     Options des autorisations
 * @param mixed $ids
 *     Identifiant(s) des branches de rubrique sur lesquelles s'appliquent les champs
 * @param bool $recursif
 *     Non utilisé
 * @return bool
 *     Autorisé ou non
 */
function inc_restreindre_extras_objet_sur_branche_dist($objet, $id_objet, $opt, $ids, $recursif) {
	return inc_restreindre_extras_objet_sur_rubrique_dist($objet, $id_objet, $opt, $ids, true);
}

/**
 * Fonction d'autorisation interne à la fonction restreindre_extras()
 * spécifique au test d'appartenance à une rubrique
 *
 * @param string $objet
 *     Objet possédant les extras
 * @param int $id_objet
 *     Nom des extras a restreindre
 * @param array $opt
 *     Options des autorisations
 * @param mixed $ids
 *     Identifiant(s) des rubriques sur lesquelles s'appliquent les champs
 * @param bool $recursif
 *     Application récursive sur les sous rubriques ?
 *     ATTENTION, c'est gourmand en requetes SQL :)
 * @return bool
 *     Autorisé ou non
 */
function inc_restreindre_extras_objet_sur_rubrique_dist($objet, $id_objet, $opt, $ids, $recursif) {

	list($id_rubrique, $ok) = _restreindre_extras_objet_sur_cible($objet, $id_objet, $opt, $ids, 'id_rubrique');

	if ($ok) {
		return true;
	}

	if (!$recursif) {
		return false;
	}

	// tester si un parent proche existe lorsqu'on ne connait pas la rubrique.
	if (!$id_rubrique AND $id_rubrique = _request('id_parent')) {
		if (in_array($id_rubrique, $ids)) {
			return true;
		}
	}
	
	// on teste si l'objet est dans une sous rubrique de celles mentionnee...
	if ($id_rubrique) {
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
 * Fonction d'autorisation interne à la fonction restreindre_extras()
 * spécifique au test d'appartenance à un secteur
 *
 * @param string $objet
 *     Objet possédant les extras
 * @param int $id_objet
 *     Nom des extras a restreindre
 * @param array $opt
 *     Options des autorisations
 * @param mixed $ids
 *     Identifiant(s) des secteurs sur lesquelles s'appliquent les champs
 * @param bool $recursif
 *     Non utilisé
 * @return bool
 *     Autorisé ou non
 */
function inc_restreindre_extras_objet_sur_secteur_dist($objet, $id_objet, $opt, $ids, $recursif=false) {
	list($id_secteur, $ok) = _restreindre_extras_objet_sur_cible($objet, $id_objet, $opt, $ids, 'id_secteur');
	return $ok;
}



/**
 * Fonction d'autorisation interne à la fonction restreindre_extras()
 * spécifique au test d'appartenance à un groupe de mot
 *
 * Alias de groupemot
 *
 * @see inc_restreindre_extras_objet_sur_groupemot_dist()
 * @param string $objet
 *     Objet possédant les extras
 * @param int $id_objet
 *     Nom des extras a restreindre
 * @param array $opt
 *     Options des autorisations
 * @param mixed $ids
 *     Identifiant(s) des groupes de mots sur lesquelles s'appliquent les champs
 * @param bool $recursif
 *     True pour appliquer aux branches d'un groupe de mot
 *     (avec plugin spécifique groupe de mots arborescents)
 * @return bool
 *     Autorisé ou non
 */
function inc_restreindre_extras_objet_sur_groupe_dist($objet, $id_objet, $opt, $ids, $recursif) {
	return inc_restreindre_extras_objet_sur_groupemot_dist($objet, $id_objet, $opt, $ids, $recursif);
}

/**
 * Fonction d'autorisation interne à la fonction restreindre_extras()
 * spécifique au test d'appartenance à un groupe de mot
 *
 * @param string $objet
 *     Objet possédant les extras
 * @param int $id_objet
 *     Nom des extras a restreindre
 * @param array $opt
 *     Options des autorisations
 * @param mixed $ids
 *     Identifiant(s) des groupes de mots sur lesquelles s'appliquent les champs
 * @param bool $recursif
 *     True pour appliquer aux branches d'un groupe de mot
 *     (avec plugin spécifique groupe de mots arborescents)
 * @return bool
 *     Autorisé ou non
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
