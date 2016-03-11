<?php

/**
 * Gestion de l'affichage des saisies.
 *
 * @return SPIP\Saisies\Manipuler
 **/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Supprimer une saisie dont on donne l'identifiant, le nom ou le chemin.
 *
 * @param array        $saisies             Tableau des descriptions de saisies
 * @param string|array $id_ou_nom_ou_chemin
 *     L'identifiant unique
 *     ou le nom de la saisie à supprimer
 *     ou son chemin sous forme d'une liste de clés
 *
 * @return array
 *               Tableau modifié décrivant les saisies
 */
function saisies_supprimer($saisies, $id_ou_nom_ou_chemin) {
	// Si la saisie n'existe pas, on ne fait rien
	if ($chemin = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true)) {
		// La position finale de la saisie
		$position = array_pop($chemin);

		// On va chercher le parent par référence pour pouvoir le modifier
		$parent = &$saisies;
		foreach ($chemin as $cle) {
			$parent = &$parent[$cle];
		}

		// On supprime et réordonne
		unset($parent[$position]);
		$parent = array_values($parent);
	}

	return $saisies;
}

/**
 * Insère une saisie à une position donnée.
 *
 * @param array $saisies     Tableau des descriptions de saisies
 * @param array $saisie     Description de la saisie à insérer
 * @param array $chemin
 *     Position complète où insérer la saisie.
 *     En absence, insère la saisie à la fin.
 *
 * @return array
 *     Tableau des saisies complété de la saisie insérée
 */
function saisies_inserer($saisies, $saisie, $chemin = array()) {
	// On vérifie quand même que ce qu'on veut insérer est correct
	if ($saisie['saisie'] and $saisie['options']['nom']) {
		// ajouter un identifiant
		$saisie = saisie_identifier($saisie);

		// Par défaut le parent c'est la racine
		$parent = &$saisies;
		// S'il n'y a pas de position, on va insérer à la fin du formulaire
		if (!$chemin) {
			$position = count($parent);
		} elseif (is_array($chemin)) {
			$position = array_pop($chemin);
			foreach ($chemin as $cle) {
				// Si la clé est un conteneur de saisies "saisies" et qu'elle n'existe pas encore, on la crée
				if ($cle == 'saisies' and !isset($parent[$cle])) {
					$parent[$cle] = array();
				}
				$parent = &$parent[$cle];
			}
			// On vérifie maintenant que la position est cohérente avec le parent
			if ($position < 0) {
				$position = 0;
			} elseif ($position > count($parent)) {
				$position = count($parent);
			}
		}
		// Et enfin on insère
		array_splice($parent, $position, 0, array($saisie));
	}

	return $saisies;
}

/**
 * Duplique une saisie (ou groupe de saisies)
 * en placant la copie à la suite de la saisie d'origine.
 * Modifie automatiquement les identifiants des saisies.
 *
 * @param array        $saisies             Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant unique ou le nom ou le chemin de la saisie a dupliquer
 *
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_dupliquer($saisies, $id_ou_nom_ou_chemin) {
	// On récupère le contenu de la saisie à déplacer
	$saisie = saisies_chercher($saisies, $id_ou_nom_ou_chemin);
	if ($saisie) {
		list($clone) = saisies_transformer_noms_auto($saisies, array($saisie));
		// insertion apres quoi ?
		$chemin_validation = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true);
		// 1 de plus pour mettre APRES le champ trouve
		++$chemin_validation[count($chemin_validation) - 1];
		// On ajoute "copie" après le label du champs
		$clone['options']['label'] .= ' '._T('saisies:construire_action_dupliquer_copie');

		// Création de nouveau identifiants pour le clone
		$clone = saisie_identifier($clone, true);

		$saisies = saisies_inserer($saisies, $clone, $chemin_validation);
	}

	return $saisies;
}

/**
 * Déplace une saisie existante autre part.
 *
 * @param array        $saisies             Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant unique ou le nom ou le chemin de la saisie à déplacer
 * @param string       $ou                  Le nom de la saisie devant laquelle on déplacera OU le nom d'un conteneur entre crochets [conteneur]
 *
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_deplacer($saisies, $id_ou_nom_ou_chemin, $ou) {
	// On récupère le contenu de la saisie à déplacer
	$saisie = saisies_chercher($saisies, $id_ou_nom_ou_chemin);

	// Si on l'a bien trouvé
	if ($saisie) {
		// On cherche l'endroit où la déplacer
		// Si $ou est vide, c'est à la fin de la racine
		if (!$ou) {
			$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
			$chemin = array(count($saisies));
		}
		// Si l'endroit est entre crochet, c'est un conteneur
		elseif (preg_match('/^\[(@?[\w]*)\]$/', $ou, $match)) {
			$parent = $match[1];
			// Si dans les crochets il n'y a rien, on met à la fin du formulaire
			if (!$parent) {
				$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
				$chemin = array(count($saisies));
			}
			// Sinon on vérifie que ce conteneur existe
			elseif (saisies_chercher($saisies, $parent, true)) {
				// S'il existe on supprime la saisie et on recherche la nouvelle position
				$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
				$parent = saisies_chercher($saisies, $parent, true);
				$chemin = array_merge($parent, array('saisies', 1000000));
			} else {
				$chemin = false;
			}
		}
		// Sinon ça sera devant un champ
		else {
			// On vérifie que le champ existe
			if (saisies_chercher($saisies, $ou, true)) {
				// S'il existe on supprime la saisie
				$saisies = saisies_supprimer($saisies, $id_ou_nom_ou_chemin);
				// Et on recherche la nouvelle position qui n'est plus forcément la même maintenant qu'on a supprimé une saisie
				$chemin = saisies_chercher($saisies, $ou, true);
			} else {
				$chemin = false;
			}
		}

		// Si seulement on a bien trouvé un nouvel endroit où la placer, alors on déplace
		if ($chemin) {
			$saisies = saisies_inserer($saisies, $saisie, $chemin);
		}
	}

	return $saisies;
}

/**
 * Modifie une saisie.
 *
 * @param array        $saisies             Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant unique ou le nom ou le chemin de la saisie à modifier
 * @param array        $modifs              Le tableau des modifications à apporter à la saisie
 *
 * @return Retourne le tableau décrivant les saisies, mais modifié
 */
function saisies_modifier($saisies, $id_ou_nom_ou_chemin, $modifs) {
	$chemin = saisies_chercher($saisies, $id_ou_nom_ou_chemin, true);
	$position = array_pop($chemin);
	$parent = &$saisies;
	foreach ($chemin as $cle) {
		$parent = &$parent[$cle];
	}

	// On récupère le type tel quel
	$modifs['saisie'] = $parent[$position]['saisie'];
	// On récupère le nom s'il n'y est pas
	if (!isset($modifs['options']['nom'])) {
		$modifs['options']['nom'] = $parent[$position]['options']['nom'];
	}
	// On récupère les enfants tels quels s'il n'y a pas des enfants dans la modif
	if (
		!isset($modifs['saisies'])
		and isset($parent[$position]['saisies'])
		and is_array($parent[$position]['saisies'])
	) {
		$modifs['saisies'] = $parent[$position]['saisies'];
	}

	// Si une option 'nouveau_type_saisie' est donnee, c'est que l'on souhaite
	// peut être changer le type de saisie !
	if (isset($modifs['options']['nouveau_type_saisie']) and $type = $modifs['options']['nouveau_type_saisie']) {
		$modifs['saisie'] = $type;
		unset($modifs['options']['nouveau_type_saisie']);
	}

	// On remplace tout
	$parent[$position] = $modifs;

	// Cette méthode ne marche pas trop
	//$parent[$position] = array_replace_recursive($parent[$position], $modifs);

	return $saisies;
}

/**
 * Transforme tous les noms du formulaire avec un preg_replace.
 *
 * @param array  $saisies      Un tableau décrivant les saisies
 * @param string $masque       Ce que l'on doit chercher dans le nom
 * @param string $remplacement Ce par quoi on doit remplacer
 *
 * @return array               Retourne le tableau modifié des saisies
 */
function saisies_transformer_noms($saisies, $masque, $remplacement) {
	if (is_array($saisies)) {
		foreach ($saisies as $cle => $saisie) {
			$saisies[$cle]['options']['nom'] = preg_replace($masque, $remplacement, $saisie['options']['nom']);
			if (isset($saisie['saisies']) and is_array($saisie['saisies'])) {
				$saisies[$cle]['saisies'] = saisies_transformer_noms($saisie['saisies'], $masque, $remplacement);
			}
		}
	}

	return $saisies;
}

/**
 * Transforme les noms d'une liste de saisies pour qu'ils soient
 * uniques dans le formulaire donné.
 *
 * @param array $formulaire  Le formulaire à analyser
 * @param array $saisies     Un tableau décrivant les saisies.
 *
 * @return array
 *     Retourne le tableau modifié des saisies
 */
function saisies_transformer_noms_auto($formulaire, $saisies) {
	if (is_array($saisies)) {
		foreach ($saisies as $cle => $saisie) {
			$saisies[$cle]['options']['nom'] = saisies_generer_nom($formulaire, $saisie['saisie']);
			// il faut prendre en compte dans $formulaire les saisies modifiees
			// sinon on aurait potentiellement 2 champs successifs avec le meme nom.
			// on n'ajoute pas les saisies dont les noms ne sont pas encore calculees.
			$new = $saisies[$cle];
			unset($new['saisies']);
			$formulaire[] = $new;

			if (is_array($saisie['saisies'])) {
				$saisies[$cle]['saisies'] = saisies_transformer_noms_auto($formulaire, $saisie['saisies']);
			}
		}
	}

	return $saisies;
}

/**
 * Insère du HTML au début ou à la fin d'une saisie.
 *
 * @param array  $saisie    La description d'une seule saisie
 * @param string $insertion Du code HTML à insérer dans la saisie
 * @param string $ou        L'endroit où insérer le HTML : "debut" ou "fin"
 *
 * @return array            Retourne la description de la saisie modifiée
 */
function saisies_inserer_html($saisie, $insertion, $ou = 'fin') {
	if (!in_array($ou, array('debut', 'fin'))) {
		$ou = 'fin';
	}

	if ($ou == 'debut') {
		$saisie['options']['inserer_debut'] =
			$insertion.(isset($saisie['options']['inserer_debut']) ? $saisie['options']['inserer_debut'] : '');
	} elseif ($ou == 'fin') {
		$saisie['options']['inserer_fin'] =
			(isset($saisie['options']['inserer_fin']) ? $saisie['options']['inserer_fin'] : '').$insertion;
	}

	return $saisie;
}
