<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/*
 * Une librairie pour manipuler ou obtenir des infos sur un tableau de saisies
 *
 * saisies_lister_par_nom()
 * saisies_lister_champs()
 * saisies_lister_valeurs_defaut()
 * saisies_charger_champs()
 * saisies_chercher()
 * saisies_supprimer()
 * saisies_inserer()
 * saisies_deplacer()
 * saisies_modifier()
 * saisies_verifier()
 * saisies_comparer()
 * saisies_generer_html()
 * saisies_generer_vue()
 * saisies_generer_nom()
 * saisies_inserer_html()
 * saisies_lister_disponibles()
 * saisies_autonomes()
 */


/*
 * Prend la description complète du contenu d'un formulaire et retourne
 * les saisies "à plat" classées par nom.
 *
 * @param array $contenu Le contenu d'un formulaire
 * @param bool $avec_conteneur Indique si on renvoie aussi les saisies ayant des enfants, comme les fieldset
 * @return array Un tableau avec uniquement les saisies
 */
function saisies_lister_par_nom($contenu, $avec_conteneur=true){
	$saisies = array();
	
	if (is_array($contenu)){
		foreach ($contenu as $ligne){
			if (is_array($ligne)){
				if (array_key_exists('saisie', $ligne) and (!is_array($ligne['saisies']) or $avec_conteneur)){
					$saisies[$ligne['options']['nom']] = $ligne;
				}
				if (is_array($ligne['saisies'])){
					$saisies = array_merge($saisies, saisies_lister_par_nom($ligne['saisies']));
				}
			}
		}
	}
	
	return $saisies;
}



/*
 * Prend la description complète du contenu d'un formulaire et retourne
 * les saisies "à plat" classées par type de saisie.
 * $saisie['input']['input_1'] = $saisie
 *
 * @param array $contenu Le contenu d'un formulaire
 * @return array Un tableau avec uniquement les saisies
 */
function saisies_lister_par_type($contenu) {
	$saisies = array();
	
	if (is_array($contenu)){
		foreach ($contenu as $ligne){
			if (is_array($ligne)){
				if (array_key_exists('saisie', $ligne) and (!is_array($ligne['saisies']))){
					$saisies[ $ligne['saisie'] ][ $ligne['options']['nom'] ] = $ligne;
				}
				if (is_array($ligne['saisies'])){
					$saisies = array_merge($saisies, saisies_lister_par_type($ligne['saisies']));
				}
			}
		}
	}
	
	return $saisies;
}



/*
 * Prend la description complète du contenu d'un formulaire et retourne
 * une liste des noms des champs du formulaire.
 *
 * @param array $contenu Le contenu d'un formulaire
 * @return array Un tableau listant les noms des champs
 */
function saisies_lister_champs($contenu, $avec_conteneur=true){
	$saisies = saisies_lister_par_nom($contenu, $avec_conteneur);
	return array_keys($saisies);
}

/*
 * Prend la description complète du contenu d'un formulaire et retourne
 * une liste des valeurs par défaut des champs du formulaire.
 *
 * @param array $contenu Le contenu d'un formulaire
 * @return array Un tableau renvoyant la valeur par défaut de chaque champs
 */
function saisies_lister_valeurs_defaut($contenu){
	$contenu = saisies_lister_par_nom($contenu, false);
	$defaut = array();
	foreach ($contenu as $champs => $ligne)
		$defaut[$champs]  = isset($ligne['options']['defaut']) ? $ligne['options']['defaut'] : ''; 
	return $defaut;
}


/*
 * A utiliser dans une fonction charger d'un formulaire CVT,
 * cette fonction renvoie le tableau de contexte correspondant
 * de la forme $contexte['nom_champ'] = ''
 *
 * @param array $contenu Le contenu d'un formulaire (un tableau de saisies)
 * @return array Un tableau de contexte
 */
function saisies_charger_champs($contenu) {
	// array_fill_keys est disponible uniquement avec PHP >= 5.2.0
	// return array_fill_keys(saisies_lister_champs($contenu, false), '');
	$champs = array();
	foreach (saisies_lister_champs($contenu, false) as $champ)
		$champs[$champ] = '';
	return $champs;
}

/*
 * Cherche la description des saisies d'un formulaire CVT dont on donne le nom
 *
 * @param string $form Nom du formulaire dont on cherche les saisies
 * @return array Retourne les saisies du formulaire sinon false
 */
function saisies_chercher_formulaire($form, $args){
	if ($fonction_saisies = charger_fonction('saisies', 'formulaires/'.$form, true)
		and $saisies = call_user_func_array($fonction_saisies, $args)
		and is_array($saisies)
	){
		// On passe les saisies dans un pipeline normé comme pour CVT
		$saisies = pipeline(
			'formulaire_saisies',
			array(
				'args' => array('form' => $form, 'args' => $args),
				'data' => $saisies
			)
		);
		return $saisies;
	}
	else
		return false;
}

/*
 * Cherche une saisie par son nom ou son chemin et renvoie soit la saisie, soit son chemin
 *
 * @param array $saisies Un tableau décrivant les saisies
 * @param unknown_type $nom_ou_chemin Le nom de la saisie à chercher ou le chemin sous forme d'une liste de clés
 * @param bool $retourner_chemin Indique si on retourne non pas la saisie mais son chemin
 * @return array Retourne soit la saisie, soit son chemin, soit null
 */
function saisies_chercher($saisies, $nom_ou_chemin, $retourner_chemin=false){
	if (is_array($saisies) and $nom_ou_chemin){
		if (is_string($nom_ou_chemin)){
			$nom = $nom_ou_chemin;
			foreach($saisies as $cle => $saisie){
				$chemin = array($cle);
				if ($saisie['options']['nom'] == $nom)
					return $retourner_chemin ? $chemin : $saisie;
				elseif ($saisie['saisies'] and is_array($saisie['saisies']) and ($retour = saisies_chercher($saisie['saisies'], $nom, $retourner_chemin))){
					return $retourner_chemin ? array_merge($chemin, array('saisies'), $retour) : $retour;
				}
			}
		}
		elseif (is_array($nom_ou_chemin)){
			$chemin = $nom_ou_chemin;
			$saisie = $saisies;
			// On vérifie l'existence quand même
			foreach ($chemin as $cle){
				$saisie = $saisie[$cle];
			}
			// Si c'est une vraie saisie
			if ($saisie['saisie'] and $saisie['options']['nom'])
				return $retourner_chemin ? $chemin : $saisie;
		}
	}
	
	return null;
}

/*
 * Supprimer une saisie dont on donne le nom ou le chemin
 *
 * @param array $saisies Un tableau décriant les saisies
 * @param unknown_type $nom_ou_chemin Le nom de la saisie à supprimer ou son chemin sous forme d'une liste de clés
 * @return array Retourne le tableau modifié décrivant les saisies
 */
function saisies_supprimer($saisies, $nom_ou_chemin){
	// Si la saisie n'existe pas, on ne fait rien
	if ($chemin = saisies_chercher($saisies, $nom_ou_chemin, true)){
		// La position finale de la saisie
		$position = array_pop($chemin);
	
		// On va chercher le parent par référence pour pouvoir le modifier
		$parent =& $saisies;
		foreach($chemin as $cle){
			$parent =& $parent[$cle];
		}
		
		// On supprime et réordonne
		unset($parent[$position]);
		$parent = array_values($parent);
	}
	
	return $saisies;
}

/*
 * Insère une saisie à une position donnée
 * 
 * @param array $saisies Un tableau décrivant les saisies
 * @param array $saisie La saisie à insérer
 * @param array $chemin La position complète où insérer la saisie
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_inserer($saisies, $saisie, $chemin=array()){
	// On vérifie quand même que ce qu'on veut insérer est correct
	if ($saisie['saisie'] and $saisie['options']['nom']){
		// Par défaut le parent c'est la racine
		$parent =& $saisies;
		// S'il n'y a pas de position, on va insérer à la fin du formulaire
		if (!$chemin){
			$position = count($parent);
		}
		elseif (is_array($chemin)){
			$position = array_pop($chemin);
			foreach ($chemin as $cle){
				// Si la clé est un conteneur de saisies "saisies" et qu'elle n'existe pas encore, on la crée
				if ($cle == 'saisies' and !isset($parent[$cle]))
					$parent[$cle] = array();
				$parent =& $parent[$cle];
			}
			// On vérifie maintenant que la position est cohérente avec le parent
			if ($position < 0) $position = 0;
			elseif ($position > count($parent)) $position = count($parent);
		}
		// Et enfin on insère
		array_splice($parent, $position, 0, array($saisie));
	}
	
	return $saisies;
}



/*
 * Duplique une saisie (ou groupe de saisie)
 * en placant la copie a la suite de la saisie d'origine.
 * Modifie automatiquement les identifiants des saisies
 *
 * @param array $saisies Un tableau décrivant les saisies
 * @param unknown_type $nom_ou_chemin Le nom ou le chemin de la saisie a dupliquer
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_dupliquer($saisies, $nom_ou_chemin){
	// On récupère le contenu de la saisie à déplacer
	$saisie = saisies_chercher($saisies, $nom_ou_chemin);
	if ($saisie) {
		list($clone) = saisies_transformer_noms_auto($saisies, array($saisie));
		// insertion apres quoi ?
		$chemin_validation = saisies_chercher($saisies, $nom_ou_chemin, true);
		// 1 de plus pour mettre APRES le champ trouve
		$chemin_validation[count($chemin_validation)-1]++;

		$saisies = saisies_inserer($saisies, $clone, $chemin_validation);
	}

	return $saisies;
}


/*
 * Déplace une saisie existante autre part
 *
 * @param array $saisies Un tableau décrivant les saisies
 * @param unknown_type $nom_ou_chemin Le nom ou le chemin de la saisie à déplacer
 * @param string $ou Le nom de la saisie devant laquelle on déplacera OU le nom d'un conteneur entre crochets [conteneur]
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_deplacer($saisies, $nom_ou_chemin, $ou){
	// On récupère le contenu de la saisie à déplacer
	$saisie = saisies_chercher($saisies, $nom_ou_chemin);
	
	// Si on l'a bien trouvé
	if ($saisie){
		// On cherche l'endroit où la déplacer
		// Si $ou est vide, c'est à la fin de la racine
		if (!$ou){
			$saisies = saisies_supprimer($saisies, $nom_ou_chemin);
			$chemin = array(count($saisies));
		}
		// Si l'endroit est entre crochet, c'est un conteneur
		elseif (preg_match('/^\[([\w]*)\]$/', $ou, $match)){
			$parent = $match[1];
			// Si dans les crochets il n'y a rien, on met à la fin du formulaire
			if (!$parent){
				$saisies = saisies_supprimer($saisies, $nom_ou_chemin);
				$chemin = array(count($saisies));
			}
			// Sinon on vérifie que ce conteneur existe
			elseif (saisies_chercher($saisies, $parent, true)){
				// S'il existe on supprime la saisie et on recherche la nouvelle position
				$saisies = saisies_supprimer($saisies, $nom_ou_chemin);
				$parent = saisies_chercher($saisies, $parent, true);
				$chemin = array_merge($parent, array('saisies', 1000000));
			}
			else
				$chemin = false;
		}
		// Sinon ça sera devant un champ
		else{
			// On vérifie que le champ existe
			if (saisies_chercher($saisies, $ou, true)){
				// S'il existe on supprime la saisie et on recherche la nouvelle position
				$saisies = saisies_supprimer($saisies, $nom_ou_chemin);
				$chemin = saisies_chercher($saisies, $ou, true);
			}
			else
				$chemin = false;
		}
		
		// Si seulement on a bien trouvé un nouvel endroit où la placer, alors on déplace
		if ($chemin)
			$saisies = saisies_inserer($saisies, $saisie, $chemin);
	}
	
	return $saisies;
}

/*
 * Modifie une saisie
 *
 * @param array $saisies Un tableau décrivant les saisies
 * @param unknown_type $nom_ou_chemin Le nom ou le chemin de la saisie à modifier
 * @param array $modifs Le tableau des modifications à apporter à la saisie
 * @return Retourne le tableau décrivant les saisies, mais modifié
 */
function saisies_modifier($saisies, $nom_ou_chemin, $modifs){
	$chemin = saisies_chercher($saisies, $nom_ou_chemin, true);
	$position = array_pop($chemin);
	$parent =& $saisies;
	foreach ($chemin as $cle){
		$parent =& $parent[$cle];
	}
	
	// On récupère le type, le nom et les enfants tels quels
	$modifs['saisie'] = $parent[$position]['saisie'];
	$modifs['options']['nom'] = $parent[$position]['options']['nom'];
	if (is_array($parent[$position]['saisies'])) $modifs['saisies'] = $parent[$position]['saisies'];
	
	// On remplace tout
	$parent[$position] = $modifs;
	
	// Cette méthode ne marche pas trop
	//$parent[$position] = array_replace_recursive($parent[$position], $modifs);
	
	return $saisies;
}

/*
 * Transforme tous les noms du formulaire avec un preg_replace
 *
 * @param array $saisies Un tableau décrivant les saisies
 * @param string $masque Ce que l'on doit chercher dans le nom
 * @param string $remplacement Ce par quoi on doit remplacer
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_transformer_noms($saisies, $masque, $remplacement){
	if (is_array($saisies)){
		foreach ($saisies as $cle => $saisie){
			$saisies[$cle]['options']['nom'] = preg_replace($masque, $remplacement, $saisie['options']['nom']);
			if (is_array($saisie['saisies']))
				$saisies[$cle]['saisies'] = saisies_transformer_noms($saisie['saisies'], $masque, $remplacement);
		}
	}
	
	return $saisies;
}



/*
 * Transforme les noms d'une liste de saisie pour qu'ils soient
 * uniques dans le formulaire donne.
 *
 * @param array $formulaire Le formulaire à analyser 
 * @param array $saisies Un tableau décrivant les saisies.
 * @return array Retourne le tableau modifié des saisies
 */
function saisies_transformer_noms_auto($formulaire, $saisies){

	if (is_array($saisies)){
		foreach ($saisies as $cle => $saisie){
			$saisies[$cle]['options']['nom'] = saisies_generer_nom($formulaire, $saisie['saisie']);
			// il faut prendre en compte dans $formulaire les saisies modifiees
			// sinon on aurait potentiellement 2 champs successifs avec le meme nom.
			// on n'ajoute pas les saisies dont les noms ne sont pas encore calculees.
			$new = $saisies[$cle];
			unset($new['saisies']);
			$formulaire[] = $new;
			
			if (is_array($saisie['saisies']))
				$saisies[$cle]['saisies'] = saisies_transformer_noms_auto($formulaire, $saisie['saisies']);
		}
	}

	return $saisies;
}


/*
 * Vérifier tout un formulaire tel que décrit avec les Saisies
 *
 * @param array $formulaire Le contenu d'un formulaire décrit dans un tableau de Saisies
 * @return array Retourne un tableau d'erreurs
 */
function saisies_verifier($formulaire){
	include_spip('inc/verifier');
	$erreurs = array();
	$verif_fonction = charger_fonction('verifier','inc',true);
	
	$saisies = saisies_lister_par_nom($formulaire);
	foreach ($saisies as $saisie){
		$obligatoire = $saisie['options']['obligatoire'];
		$champ = $saisie['options']['nom'];
		$verifier = $saisie['verifier'];

		// Si le nom du champ est un tableau indexé, il faut parser !
		if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)){
			$valeur = _request($separe[1]);
			preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
			// On va chercher au fond du tableau
			foreach($index[1] as $cle){
				$valeur = $valeur[$cle];
			}
		}
		// Sinon la valeur est juste celle du nom
		else
			$valeur = _request($champ);
		
		// On regarde d'abord si le champ est obligatoire
		if ($obligatoire and $obligatoire != 'non' and (is_null($valeur) or (is_string($valeur) and trim($valeur) == '') or (is_array($valeur) and count($valeur) == 0)))
			$erreurs[$champ] = _T('info_obligatoire');
		
		// On continue seulement si ya pas d'erreur d'obligation et qu'il y a une demande de verif
		if (!$erreurs[$champ] and is_array($verifier) and $verif_fonction){
			// Si le champ n'est pas valide par rapport au test demandé, on ajoute l'erreur
			if ($erreur_eventuelle = $verif_fonction($valeur, $verifier['type'], $verifier['options']))
				$erreurs[$champ] = $erreur_eventuelle;
		}
	}
	
	return $erreurs;
}

/*
 * Compare deux tableaux de saisies pour connaitre les différences
 * @param array $saisies_anciennes Un tableau décrivant des saisies
 * @param array $saisies_nouvelles Un autre tableau décrivant des saisies
 * @param bool $avec_conteneur Indique si on veut prendre en compte dans la comparaison les conteneurs comme les fieldsets
 * @return array Retourne le tableau des saisies supprimées, ajoutées et modifiées
 */
function saisies_comparer($saisies_anciennes, $saisies_nouvelles, $avec_conteneur=true){
	$saisies_anciennes = saisies_lister_par_nom($saisies_anciennes, $avec_conteneur);
	$saisies_nouvelles = saisies_lister_par_nom($saisies_nouvelles, $avec_conteneur);
	
	// Les saisies supprimées sont celles qui restent dans les anciennes quand on a enlevé toutes les nouvelles
	$saisies_supprimees = array_diff_key($saisies_anciennes, $saisies_nouvelles);
	// Les saisies ajoutées, c'est le contraire
	$saisies_ajoutees = array_diff_key($saisies_nouvelles, $saisies_anciennes);
	// Il reste alors les saisies qui ont le même nom
	$saisies_restantes = array_intersect_key($saisies_anciennes, $saisies_nouvelles);
	// Dans celles-ci, celles qui sont modifiées sont celles dont la valeurs est différentes
	$saisies_modifiees = array_udiff($saisies_nouvelles, $saisies_restantes, 'saisies_comparer_rappel');
	// Et enfin les saisies qui ont le même nom et la même valeur
	$saisies_identiques = array_diff_key($saisies_restantes, $saisies_modifiees);
	
	return array(
		'supprimees' => $saisies_supprimees,
		'ajoutees' => $saisies_ajoutees,
		'modifiees' => $saisies_modifiees,
		'identiques' => $saisies_identiques
	);
}

/*
 * Compare deux saisies et indique si elles sont égales ou pas
 */
function saisies_comparer_rappel($a, $b){
	if ($a === $b) return 0;
	else return 1;
}


/**
 * Retourne si une saisie peut être affichée.
 * On s'appuie sur l'éventuelle clé "editable" du $champ.
 * Si editable vaut :
 *  absent : le champ est éditable
 *  1, le champ est éditable
 *  0, le champ n'est pas éditable
 * -1, le champ est éditable s'il y a du contenu dans le champ (l'environnement)
 *     ou dans un de ses enfants (fieldsets)
 *
 * @param $champ tableau de description de la saisie
 * @param $env environnement transmis à la saisie, certainement l'environnement du formulaire
 * @param $utiliser_editable false pour juste tester le cas -1
 * 
 * @return bool la saisie est-elle éditable ?
**/
function saisie_editable($champ, $env, $utiliser_editable=true) {
	if ($utiliser_editable) {
		// si le champ n'est pas éditable, on sort.
		if (!isset($champ['editable'])) {
			return true;
		}
		$editable = $champ['editable'];

		if ($editable > 0) {
			return true;
		}
		if ($editable == 0) {
			return false;
		}
	}

	// cas -1
	// name de la saisie
	if (isset($champ['options']['nom'])) {
		// si on a le name dans l'environnement, on le teste
		$nom = $champ['options']['nom'];
		if (isset($env[$nom])) {
			return $env[$nom] ? true : false ;
		}
	}
	// sinon, si on a des sous saisies
	if (isset($champ['saisies']) and is_array($champ['saisies'])) {
		foreach($champ['saisies'] as $saisie) {
			if (saisie_editable($saisie, $env, false)) {
				return true;
			}
		}
	}
	
	// aucun des paramètres demandés n'avait de contenu
	return false;
	
}


/*
 * Génère une saisie à partir d'un tableau la décrivant et de l'environnement
 * Le tableau doit être de la forme suivante :
 * array(
 *		'saisie' => 'input',
 *		'options' => array(
 *			'nom' => 'le_name',
 *			'label' => 'Un titre plus joli',
 *			'obligatoire' => 'oui',
 *			'explication' => 'Remplissez ce champ en utilisant votre clavier.'
 *		)
 * )
 */
function saisies_generer_html($champ, $env=array()){
	// Si le parametre n'est pas bon, on genere du vide
	if (!is_array($champ))
		return '';

	// Si la saisie n'est pas editable, on sort aussi.
	if (!saisie_editable($champ, $env)) {
		return '';
	}
	
	$contexte = array();
	
	// On sélectionne le type de saisie
	$contexte['type_saisie'] = $champ['saisie'];
	
	// Peut-être des transformations à faire sur les options textuelles
	$options = $champ['options'];

	
	foreach ($options as $option => $valeur){
		$options[$option] = _T_ou_typo($valeur, 'multi');
	}
	
	// On ajoute les options propres à la saisie
	$contexte = array_merge($contexte, $options);
	
	// Si env est définie dans les options ou qu'il y a des enfants, on ajoute tout l'environnement
	if(isset($contexte['env']) or is_array($champ['saisies'])){
		unset($contexte['env']);
		
		// À partir du moment où on passe tout l'environnement, il faut enlever certains éléments qui ne doivent absolument provenir que des options
		unset($env['inserer_debut']);
		unset($env['inserer_fin']);
		$saisies_disponibles = saisies_lister_disponibles();
		if (is_array($saisies_disponibles[$contexte['type_saisie']]['options'])){
			$options_a_supprimer = saisies_lister_champs($saisies_disponibles[$contexte['type_saisie']]['options']);
			foreach ($options_a_supprimer as $option_a_supprimer){
				unset($env[$option_a_supprimer]);
			}
		}
		
		$contexte = array_merge($env, $contexte);
	}
	// Sinon on ne sélectionne que quelques éléments importants
	else{
		// On récupère la liste des erreurs
		$contexte['erreurs'] = $env['erreurs'];
	}
	
	// Dans tous les cas on récupère de l'environnement la valeur actuelle du champ
	// Si le nom du champ est un tableau indexé, il faut parser !
	if (preg_match('/([\w]+)((\[[\w]+\])+)/', $contexte['nom'], $separe)){
		$contexte['valeur'] = $env[$separe[1]];
		preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
		// On va chercher au fond du tableau
		foreach($index[1] as $cle){
			$contexte['valeur'] = $contexte['valeur'][$cle];
		}
	}
	// Sinon la valeur est juste celle du nom
	else
		$contexte['valeur'] = $env[$contexte['nom']];
	
	// Si ya des enfants on les remonte dans le contexte
	if (is_array($champ['saisies']))
		$contexte['saisies'] = $champ['saisies'];
	
	// On génère la saisie
	return recuperer_fond(
		'saisies/_base',
		$contexte
	);
}

/*
 * Génère une vue d'une saisie
 *
 * @param array $saisie Un tableau décrivant une saisie
 * @param array $env L'environnement, contenant normalement la réponse à la saisie
 * @param array $env_obligatoire
 * @return string Retour le HTML des vues
 */
function saisies_generer_vue($saisie, $env=array(), $env_obligatoire=array()){
	// Si le paramètre n'est pas bon, on génère du vide
	if (!is_array($saisie))
		return '';
	
	$contexte = array();
	
	// On sélectionne le type de saisie
	$contexte['type_saisie'] = $saisie['saisie'];
	
	// Peut-être des transformations à faire sur les options textuelles
	$options = $saisie['options'];
	foreach ($options as $option => $valeur){
		$options[$option] = _T_ou_typo($valeur, 'multi');
	}
	
	// On ajoute les options propres à la saisie
	$contexte = array_merge($contexte, $options);
	
	// Si env est définie dans les options ou qu'il y a des enfants, on ajoute tout l'environnement
	if(isset($contexte['env']) or is_array($saisie['saisies'])){
		unset($contexte['env']);
		
		// À partir du moment où on passe tout l'environnement, il faut enlever 
		// certains éléments qui ne doivent absolument provenir que des options
		$saisies_disponibles = saisies_lister_disponibles();
		if (is_array($saisies_disponibles[$contexte['type_saisie']]['options'])){
			$options_a_supprimer = saisies_lister_champs($saisies_disponibles[$contexte['type_saisie']]['options']);
			foreach ($options_a_supprimer as $option_a_supprimer){
				unset($env[$option_a_supprimer]);
			}
		}
		
		$contexte = array_merge($env, $contexte);
	}
	
	// Dans tous les cas on récupère de l'environnement la valeur actuelle du champ
	
	// On regarde en priorité s'il y a un tableau listant toutes les valeurs
	if ($env['valeurs'] and is_array($env['valeurs']) and isset($env['valeurs'][$contexte['nom']])){
		$contexte['valeur'] = $env['valeurs'][$contexte['nom']];
	}
	// Si le nom du champ est un tableau indexé, il faut parser !
	elseif (preg_match('/([\w]+)((\[[\w]+\])+)/', $contexte['nom'], $separe)){
		$contexte['valeur'] = $env[$separe[1]];
		preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
		// On va chercher au fond du tableau
		foreach($index[1] as $cle){
			$contexte['valeur'] = $contexte['valeur'][$cle];
		}
	}
	// Sinon la valeur est juste celle du nom
	else
		$contexte['valeur'] = $env[$contexte['nom']];
	
	// Si ya des enfants on les remonte dans le contexte
	if (is_array($saisie['saisies']))
		$contexte['saisies'] = $saisie['saisies'];

	if (is_array($env_obligatoire)) {
		$contexte = array_merge($contexte, $env_obligatoire);
	}
	// On génère la saisie
	return recuperer_fond(
		'saisies-vues/_base',
		$contexte
	);
}

/*
 * Génère un nom unique pour un champ d'un formulaire donné
 *
 * @param array $formulaire Le formulaire à analyser 
 * @param string $type_saisie Le type de champ dont on veut un identifiant 
 * @return string Un nom unique par rapport aux autres champs du formulaire
 */
function saisies_generer_nom($formulaire, $type_saisie){
	$champs = saisies_lister_champs($formulaire);
	
	// Tant que type_numero existe, on incrémente le compteur
	$compteur = 1;
	while (array_search($type_saisie.'_'.$compteur, $champs) !== false)
		$compteur++;
	
	// On a alors un compteur unique pour ce formulaire
	return $type_saisie.'_'.$compteur;
}

/**
 * Insère du HTML au début ou à la fin d'une saisie
 *
 * @param array $saisie La description d'une seule saisie
 * @param string $insertion Du code HTML à insérer dans la saisie 
 * @param string $ou L'endroit où insérer le HTML : "debut" ou "fin"
 * @return array Retourne la description de la saisie modifiée
 */
function saisies_inserer_html($saisie, $insertion, $ou='fin'){
	if (!in_array($ou, array('debut', 'fin')))
		$ou = 'fin';
	
	if ($ou == 'debut')
		$saisie['options']['inserer_debut'] = $insertion.$saisie['options']['inserer_debut'];
	elseif ($ou == 'fin')
		$saisie['options']['inserer_fin'] = $saisie['options']['inserer_fin'].$insertion;
	
	return $saisie;
}

/*
 * Liste toutes les saisies configurables (ayant une description)
 *
 * @return array Un tableau listant des saisies et leurs options
 */
function saisies_lister_disponibles(){
	static $saisies = null;
	
	if (is_null($saisies)){
		$saisies = array();
		$liste = find_all_in_path('saisies/', '.+[.]yaml$');
		
		if (count($liste)){
			foreach ($liste as $fichier=>$chemin){
				$type_saisie = preg_replace(',[.]yaml$,i', '', $fichier);
				$dossier = str_replace($fichier, '', $chemin);
				// On ne garde que les saisies qui ont bien le HTML avec !
				if (file_exists("$dossier$type_saisie.html")
					and (
						is_array($saisie = saisies_charger_infos($type_saisie))
					)
				){
					$saisies[$type_saisie] = $saisie;
				}
			}
		}
	}
	
	return $saisies;
}

/**
 * Charger les informations contenues dans le yaml d'une saisie
 *
 * @param string $type_saisie Le type de la saisie
 * @return array Un tableau contenant le YAML décodé
 */
function saisies_charger_infos($type_saisie){
	include_spip('inc/yaml');
	$fichier = find_in_path("saisies/$type_saisie.yaml");
	$saisie = yaml_decode_file($fichier);
	if (is_array($saisie)){
		$saisie['titre'] = $saisie['titre'] ? _T_ou_typo($saisie['titre']) : $type_saisie;
		$saisie['description'] = $saisie['description'] ? _T_ou_typo($saisie['description']) : '';
		$saisie['icone'] = $saisie['icone'] ? find_in_path($saisie['icone']) : '';
	}
	return $saisie;
}

/*
 * Quelles sont les saisies qui se débrouillent toutes seules, sans le _base commun
 *
 * @return array Retourne un tableau contenant les types de saisies qui ne doivent pas utiliser le _base.html commun
 */
function saisies_autonomes(){
	$saisies_autonomes = pipeline(
		'saisies_autonomes',
		array(
			'fieldset',
			'hidden',
			'destinataires', 
			'explication'
		)
	);
	
	return $saisies_autonomes;
}

/*
 * Transforme une chaine en tableau avec comme principe :
 * - une ligne devient une case
 * - si la ligne est de la forme truc|bidule alors truc est la clé et bidule la valeur
 *
 * @param string $chaine Une chaine à transformer
 * @return array Retourne un tableau PHP
 */
function saisies_chaine2tableau($chaine, $separateur="\n"){
	if ($chaine and is_string($chaine)){
		$tableau = array();
		// On découpe d'abord en lignes
		$lignes = explode($separateur, $chaine);
		foreach ($lignes as $i=>$ligne){
			$ligne = trim(trim($ligne), '|');
			// Si ce n'est pas une ligne sans rien
			if ($ligne !== ''){
				// Si on trouve un découpage dans la ligne on fait cle|valeur
				if (strpos($ligne, '|') !== false){
					list($cle,$valeur) = explode('|', $ligne, 2);
					$tableau[$cle] = $valeur;
				}
				// Sinon on génère la clé
				else{
					$tableau[$i] = $ligne;
				}
			}
		}
		return $tableau;
	}
	// Si c'est déjà un tableau on le renvoie tel quel
	elseif (is_array($chaine)){
		return $chaine;
	}
	else{
		return array();
	}
}

/*
 * Transforme un tableau en chaine de caractères avec comme principe :
 * - une case de vient une ligne de la chaine
 * - chaque ligne est générée avec la forme cle|valeur
 */
function saisies_tableau2chaine($tableau){
	if ($tableau and is_array($tableau)){
		$chaine = '';
	
		foreach($tableau as $cle=>$valeur){
			$ligne = trim("$cle|$valeur");
			$chaine .= "$ligne\n";
		}
		$chaine = trim($chaine);
	
		return $chaine;
	}
	// Si c'est déjà une chaine on la renvoie telle quelle
	elseif (is_string($tableau)){
		return $tableau;
	}
	else{
		return '';
	}
}

/*
 * Génère une page d'aide listant toutes les saisies et leurs options
 */
function saisies_generer_aide(){
	// On a déjà la liste par saisie
	$saisies = saisies_lister_disponibles();
	
	// On construit une liste par options
	$options = array();
	foreach ($saisies as $type_saisie=>$saisie){
		$options_saisie = saisies_lister_par_nom($saisie['options'], false);
		foreach ($options_saisie as $nom=>$option){
			// Si l'option n'existe pas encore
			if (!isset($options[$nom])){
				$options[$nom] = _T_ou_typo($option['options']);
			}
			// On ajoute toujours par qui c'est utilisé
			$options[$nom]['utilisee_par'][] = $type_saisie;
		}
		ksort($options_saisie);
		$saisies[$type_saisie]['options'] = $options_saisie;
	}
	ksort($options);
	
	return recuperer_fond(
		'inclure/saisies_aide',
		array(
			'saisies' => $saisies,
			'options' => $options
		)
	);
}

/*
 * Génère, à partir d'un tableau de saisie le code javascript ajouté à la fin de #GENERER_SAISIES
 * pour produire un affichage conditionnel des saisies avec une option afficher_si.
 *
 * @param array $saisies Un tableau de saisies
 * @param string $id_form Un identifiant unique pour le formulaire
 * @return text
 */
function saisies_generer_js_afficher_si($saisies,$id_form){
	$i = 0;
	$saisies = saisies_lister_par_nom($saisies,true);
	$code = '';
	$code .= '$(document).ready(function(){';
		$code .= 'verifier_saisies_'.$id_form.' = function(form){';
				foreach ($saisies as $saisie) {
					if (isset($saisie['options']['afficher_si'])) {
						$i++;
						switch ($saisie['saisie']) {
							case 'fieldset':
								$class_li = 'fieldset_'.$saisie['options']['nom'];
								break;
							case 'explication':
								$class_li = 'explication_'.$saisie['options']['nom'];
								break;
							default:
								$class_li = 'editer_'.$saisie['options']['nom'];
						}
						$condition = $saisie['options']['afficher_si'];
						// On gère le cas @plugin:non_plugin@
						preg_match_all('#@plugin:(.+)@#U', $condition, $matches);
						foreach ($matches[1] as $plug) {
							if (defined('_DIR_PLUGIN_'.strtoupper($plug)))
								$condition = preg_replace('#@plugin:'.$plug.'@#U', 'true', $condition);
							else
								$condition = preg_replace('#@plugin:'.$plug.'@#U', 'false', $condition);
						}
						// On gère le cas @config:plugin:meta@ suivi d'un test
						preg_match_all('#@config:(.+):(.+)@#U', $condition, $matches);
						foreach ($matches[1] as $plugin) {
							$config = lire_config($plugin);
							$condition = preg_replace('#@config:'.$plugin.':'.$matches[2][0].'@#U', '"'.$config[$matches[2][0]].'"', $condition);
						}
						// On transforme en une condition valide
						preg_match_all('#@(.+)@#U', $condition, $matches);
						foreach ($matches[1] as $nom) {
							switch($saisies[$nom]['saisie']) {
								case 'radio':
								case 'oui_non':
									$condition = preg_replace('#@'.$nom.'@#U', '$(form).find("[name=\''.$nom.'\']:checked").val()', $condition);
									break;
								default:
									$condition = preg_replace('#@'.$nom.'@#U', '$(form).find("[name=\''.$nom.'\']").val()', $condition);
							}
						}
						$code .= 'if ('.$condition.') {$(form).find("li.'.$class_li.'").show(400);} ';
						$code .= 'else {$(form).find(".'.$class_li.'").hide(400);} ';
					}
				}
		$code .= '};';
		$code .= '$("li#afficher_si_'.$id_form.'").parents("form").each(function(){verifier_saisies_'.$id_form.'(this);});';
		$code .= '$("li#afficher_si_'.$id_form.'").parents("form").change(function(){verifier_saisies_'.$id_form.'(this);});';
	$code .= '});';
	return $i>0 ? $code : '';
}

/*
 * Le tableau de saisies a-t-il une option afficher_si ?
 *
 * @param array $saisies Un tableau de saisies
 * @return boolean
 */

function saisies_afficher_si($saisies) {
	$afficher_si = false;
	$saisies = saisies_lister_par_nom($saisies,true);
	foreach ($saisies as $saisie) {
		if (isset($saisie['options']['afficher_si']))
			$afficher_si = true;
	}
	return $afficher_si;
}

/*
 * Lorsque l'on affiche les saisies (#VOIR_SAISIES), les saisies ayant une option afficher_si
 * et dont les conditions ne sont pas remplies doivent être retirées du tableau de saisies
 *
 * @param array $saisies Un tableau de saisies
 * @param array $env Les variables d'environnement
 * @return array Un tableau de saisies
 */

function saisies_verifier_afficher_si($saisies, $env) {
	// eviter une erreur par maladresse d'appel :)
	if (!is_array($saisies)) {
		return array();
	}
	foreach ($saisies as $cle => $saisie) {
		if (isset($saisie['options']['afficher_si'])) {
			$condition = $saisie['options']['afficher_si'];
			// On gère le cas @plugin:non_plugin@
			preg_match_all('#@plugin:(.+)@#U', $condition, $matches);
			foreach ($matches[1] as $plug) {
				if (defined('_DIR_PLUGIN_'.strtoupper($plug)))
					$condition = preg_replace('#@plugin:'.$plug.'@#U', 'true', $condition);
				else
					$condition = preg_replace('#@plugin:'.$plug.'@#U', 'false', $condition);
			}
			// On transforme en une condition valide
			$condition = preg_replace('#@(.+)@#U', '$env["valeurs"][\'$1\']', $condition);
			eval('$ok = '.$condition.';');
			if (!$ok)
				unset($saisies[$cle]);
		}
	}
	return $saisies;
}

?>
