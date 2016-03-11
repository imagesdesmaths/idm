<?php

/**
 * Gestion de l'affichage des saisies
 *
 * @package SPIP\Saisies\Saisies
**/

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;

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

// Différentes méthodes pour trouver les saisies
include_spip('inc/saisies_lister');

// Différentes méthodes pour manipuler une liste de saisies
include_spip('inc/saisies_manipuler');

// Les outils pour afficher les saisies et leur vue
include_spip('inc/saisies_afficher');

/**
 * Cherche la description des saisies d'un formulaire CVT dont on donne le nom
 *
 * @param string $form Nom du formulaire dont on cherche les saisies
 * @param array $args Tableau d'arguments du formulaire
 * @return array Retourne les saisies du formulaire sinon false
 */
function saisies_chercher_formulaire($form, $args){
	if ($fonction_saisies = charger_fonction('saisies', 'formulaires/'.$form, true)
		and $saisies = call_user_func_array($fonction_saisies, $args)
		and is_array($saisies)
		// On passe les saisies dans un pipeline normé comme pour CVT
		and $saisies = pipeline(
			'formulaire_saisies',
			array(
				'args' => array('form' => $form, 'args' => $args),
				'data' => $saisies
			)
		)
		// Si c'est toujours un tableau après le pipeline
		and is_array($saisies)
	){
		return $saisies;
	}
	else{
		return false;
	}
}

/**
 * Cherche une saisie par son id, son nom ou son chemin et renvoie soit la saisie, soit son chemin
 *
 * @param array $saisies Un tableau décrivant les saisies
 * @param unknown_type $id_ou_nom_ou_chemin L'identifiant ou le nom de la saisie à chercher ou le chemin sous forme d'une liste de clés
 * @param bool $retourner_chemin Indique si on retourne non pas la saisie mais son chemin
 * @return array Retourne soit la saisie, soit son chemin, soit null
 */
function saisies_chercher($saisies, $id_ou_nom_ou_chemin, $retourner_chemin=false){

	if (is_array($saisies) and $id_ou_nom_ou_chemin){
		if (is_string($id_ou_nom_ou_chemin)){
			$nom = $id_ou_nom_ou_chemin;
			// identifiant ? premier caractere @
			$id = ($nom[0] == '@');

			foreach($saisies as $cle => $saisie){
				$chemin = array($cle);
				// notre saisie est la bonne ?
				if ($nom == ($id ? $saisie['identifiant'] : $saisie['options']['nom'])) {
					return $retourner_chemin ? $chemin : $saisie;
				// sinon a telle des enfants ? et si c'est le cas, cherchons dedans
				} elseif (isset($saisie['saisies']) and is_array($saisie['saisies']) and $saisie['saisies']
					and ($retour = saisies_chercher($saisie['saisies'], $nom, $retourner_chemin))) {
						return $retourner_chemin ? array_merge($chemin, array('saisies'), $retour) : $retour;
				}

			}
		}
		elseif (is_array($id_ou_nom_ou_chemin)){
			$chemin = $id_ou_nom_ou_chemin;
			$saisie = $saisies;
			// On vérifie l'existence quand même
			foreach ($chemin as $cle){
				if (isset($saisie[$cle])) $saisie = $saisie[$cle];
				else return null;
			}
			// Si c'est une vraie saisie
			if ($saisie['saisie'] and $saisie['options']['nom'])
				return $retourner_chemin ? $chemin : $saisie;
		}
	}
	
	return null;
}

/**
 * Génère un nom unique pour un champ d'un formulaire donné
 *
 * @param array $formulaire
 *     Le formulaire à analyser 
 * @param string $type_saisie
 *     Le type de champ dont on veut un identifiant 
 * @return string
 *     Un nom unique par rapport aux autres champs du formulaire
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
 * Crée un identifiant Unique
 * pour toutes les saisies donnees qui n'en ont pas 
 *
 * @param Array $saisies Tableau de saisies
 * @param Bool $regenerer Régénère un nouvel identifiant pour toutes les saisies ?
 * @return Array Tableau de saisies complété des identifiants
 */
function saisies_identifier($saisies, $regenerer = false) {
	if (!is_array($saisies)) {
		return array();
	}
	foreach ($saisies as $k => $saisie) {
		$saisies[$k] = saisie_identifier($saisie, $regenerer);
	}
	return $saisies;
}

/**
 * Crée un identifiant Unique
 * pour la saisie donnee si elle n'en a pas
 * (et pour ses sous saisies éventuels)
 *
 * @param Array $saisie Tableau d'une saisie
 * @param Bool $regenerer Régénère un nouvel identifiant pour la saisie ?
 * @return Array Tableau de la saisie complété de l'identifiant
**/
function saisie_identifier($saisie, $regenerer = false) {
	if (!isset($saisie['identifiant']) OR !$saisie['identifiant']) {
		$saisie['identifiant'] = uniqid('@');
	} elseif ($regenerer) {
		$saisie['identifiant'] = uniqid('@');
	}
	if (isset($saisie['saisies']) AND is_array($saisie['saisies'])) {
		$saisie['saisies'] = saisies_identifier($saisie['saisies'], $regenerer);
	}
	return $saisie;
}

/**
 * Vérifier tout un formulaire tel que décrit avec les Saisies
 *
 * @param array $formulaire Le contenu d'un formulaire décrit dans un tableau de Saisies
 * @param bool $saisies_masquees_nulles Si TRUE, les saisies masquées selon afficher_si ne seront pas verifiées, leur valeur étant forcée a NULL. Cette valeur NULL est transmise à traiter (via set_request).
 * @return array Retourne un tableau d'erreurs
 */
function saisies_verifier($formulaire, $saisies_masquees_nulles=true){
	include_spip('inc/verifier');
	$erreurs = array();
	$verif_fonction = charger_fonction('verifier','inc',true);

	if ($saisies_masquees_nulles)
		$formulaire = saisies_verifier_afficher_si($formulaire);
	
	$saisies = saisies_lister_par_nom($formulaire);
	foreach ($saisies as $saisie){
		$obligatoire = isset($saisie['options']['obligatoire']) ? $saisie['options']['obligatoire'] : '';
		$champ = $saisie['options']['nom'];
		$file = ($saisie['saisie'] == 'input' and isset($saisie['options']['type']) and $saisie['options']['type'] == 'file');
		$verifier = isset($saisie['verifier']) ? $saisie['verifier'] : false;

		// Si le nom du champ est un tableau indexé, il faut parser !
		if (preg_match('/([\w]+)((\[[\w]+\])+)/', $champ, $separe)){
			$valeur = _request($separe[1]);
			preg_match_all('/\[([\w]+)\]/', $separe[2], $index);
			// On va chercher au fond du tableau
			foreach($index[1] as $cle){
				$valeur = isset($valeur[$cle]) ? $valeur[$cle] : null;
			}
		}
		// Sinon la valeur est juste celle du nom
		else
			$valeur = _request($champ);
		
		// Pour la saisie "destinataires" il faut filtrer si jamais on a mis un premier choix vide
		if ($saisie['saisie'] == 'destinataires') {
			$valeur = array_filter($valeur);
		}
		
		// On regarde d'abord si le champ est obligatoire
		if ($obligatoire
			and $obligatoire != 'non'
			and (
				($file and !$_FILES[$champ]['name'])
				or (!$file and (
					is_null($valeur)
					or (is_string($valeur) and trim($valeur) == '')
					or (is_array($valeur) and count($valeur) == 0)
				))
			)
		) {
			$erreurs[$champ] =
				(isset($saisie['options']['erreur_obligatoire']) and $saisie['options']['erreur_obligatoire'])
				? $saisie['options']['erreur_obligatoire']
				: _T('info_obligatoire');
		}

		// On continue seulement si ya pas d'erreur d'obligation et qu'il y a une demande de verif
		if ((!isset($erreurs[$champ]) or !$erreurs[$champ]) and is_array($verifier) and $verif_fonction){
			$normaliser = null;
			// Si le champ n'est pas valide par rapport au test demandé, on ajoute l'erreur
			$options = isset($verifier['options']) ? $verifier['options'] : array();
			if ($erreur_eventuelle = $verif_fonction($valeur, $verifier['type'], $options, $normaliser)) {
				$erreurs[$champ] = $erreur_eventuelle;
			// S'il n'y a pas d'erreur et que la variable de normalisation a été remplie, on l'injecte dans le POST
			} elseif (!is_null($normaliser)) {
				set_request($champ, $normaliser);
			}
		}
	}
	
	return $erreurs;
}

/**
 * Applatie une description tabulaire
 * @param string $tab Le tableau à aplatir
 * @return $nouveau_tab
 */
function saisies_aplatir_tableau($tab){
	$nouveau_tab = array();
	foreach($tab as $entree=>$contenu){
		if (is_array($contenu)) {
			foreach ($contenu as $cle => $valeur) {
				$nouveau_tab[$cle] = $valeur;
			}
		} else {
			$nouveau_tab[$entree] = $contenu;
		}
	}
	return $nouveau_tab;
}

/**
 * Applatie une description chaînée, en supprimant les sous-groupes.
 * @param string $chaine La chaîne à aplatir
 * @return $chaine
 */
function saisies_aplatir_chaine($chaine){
	return trim(preg_replace("#(?:^|\n)(\*(?:.*)|/\*)\n#i","\n",$chaine));
}

/**
 * Transforme une chaine en tableau avec comme principe :
 * 
 * - une ligne devient une case
 * - si la ligne est de la forme truc|bidule alors truc est la clé et bidule la valeur
 * - si la ligne commence par * alors on commence un sous-tableau
 * - si la ligne est égale à /*, alors on fini le sous-tableau
 * 
 * @param string $chaine Une chaine à transformer
 * @param string $separateur Séparateur utilisé
 * @return array Retourne un tableau PHP
 */
function saisies_chaine2tableau($chaine, $separateur="\n"){
	if ($chaine and is_string($chaine)){
		$tableau = array();
		$soustab = False;
		// On découpe d'abord en lignes
		$lignes = explode($separateur, $chaine);
		foreach ($lignes as $i=>$ligne){
			$ligne = trim(trim($ligne), '|');
			// Si ce n'est pas une ligne sans rien
			if ($ligne !== ''){
				// si ca commence par * c'est qu'on va faire un sous tableau
				if (strpos($ligne,"*")===0) {
					$soustab=True;
					$soustab_cle 	= _T_ou_typo(substr($ligne,1), 'multi');
					if (!isset($tableau[$soustab_cle])){
						$tableau[$soustab_cle] = array();
					}
				}
				elseif ($ligne=="/*") {//si on finit sous tableau
					$soustab=False;
				}
				else{//sinon c'est une entrée normale
				// Si on trouve un découpage dans la ligne on fait cle|valeur
					if (strpos($ligne, '|') !== false) {
						list($cle,$valeur) = explode('|', $ligne, 2);
						// permettre les traductions de valeurs au passage
						if ($soustab == True){
							$tableau[$soustab_cle][$cle] = _T_ou_typo($valeur, 'multi');
						} else {
							$tableau[$cle] = _T_ou_typo($valeur, 'multi');
						}
					}
				// Sinon on génère la clé
					else{
						if ($soustab == True) {
							$tableau[$soustab_cle][$i] = _T_ou_typo($ligne,'multi');
						} else {
							$tableau[$i] = _T_ou_typo($ligne,'multi');
						}
					}
				}
			}
		}
		return $tableau;
	}
	// Si c'est déjà un tableau on lui applique _T_ou_typo (qui fonctionne de manière récursive avant de le renvoyer
	elseif (is_array($chaine)){
		return _T_ou_typo($chaine, 'multi');
	} else {
		return array();
	}
}

/**
 * Transforme un tableau en chaine de caractères avec comme principe :
 * 
 * - une case de vient une ligne de la chaine
 * - chaque ligne est générée avec la forme cle|valeur
 * - si une entrée du tableau est elle même un tableau, on met une ligne de la forme *clef
 * - pour marquer que l'on quitte un sous-tableau, on met une ligne commencant par /*, sauf si on bascule dans un autre sous-tableau.
 *
 * @param array $tableau Tableau à transformer
 * @return string Texte représentant les données du tableau
 */
function saisies_tableau2chaine($tableau){
	if ($tableau and is_array($tableau)){
		$chaine = '';
		$avant_est_tableau = False;
		foreach($tableau as $cle=>$valeur){
			if (is_array($valeur)){
				$avant_est_tableau = True;
				$ligne=trim("*$cle");
				$chaine .= "$ligne\n";
				$chaine .= saisies_tableau2chaine($valeur)."\n";
				}
			else{	
				if ($avant_est_tableau == True){
						$avant_est_tableau = False;
						$chaine.="/*\n";
					}
				$ligne = trim("$cle|$valeur");
				$chaine .= "$ligne\n";
			}
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




/**
 * Transforme une valeur en tableau d'élements si ce n'est pas déjà le cas
 *
 * @param mixed $valeur
 * @return array Tableau de valeurs
**/
function saisies_valeur2tableau($valeur) {
	if (is_array($valeur)) {
		return $valeur;
	}

	if (!strlen($valeur)) {
		return array();
	}

	$t = saisies_chaine2tableau($valeur);
	if (count($t) > 1) {
		return $t;
	}

	// qu'une seule valeur, c'est qu'elle a peut etre un separateur a virgule
	// et a donc une cle est 0 dans ce cas la d'ailleurs
	if (isset($t[0])) {
		$t = saisies_chaine2tableau($t[0], ',');
	}

	return $t;
}


/**
 * Pour les saisies multiples (type checkbox) proposant un choix alternatif,
 * retrouve à partir des data de choix proposés
 * et des valeurs des choix enregistrés
 * le texte enregistré pour le choix alternatif.
 *
 * @param array $data
 * @param array $valeur
 * @return string choix_alternatif
**/
function saisies_trouver_choix_alternatif($data,$valeur) {
	if (!is_array($valeur)) {
		$valeur = saisies_chaine2tableau($valeur) ;
	}
	if (!is_array($data)) {
		$data = saisies_chaine2tableau($data) ;
	}
	$choix_theorique = array_keys($data);
	$choix_alternatif = array_values(array_diff($valeur,$choix_theorique));
	return $choix_alternatif[0];//on suppose que personne ne s'est amusé à proposer deux choix alternatifs
}

/**
 * Génère une page d'aide listant toutes les saisies et leurs options
 *
 * Retourne le résultat du squelette `inclure/saisies_aide` auquel
 * on a transmis toutes les saisies connues.
 * 
 * @return string Code HTML
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

/**
 * Le tableau de saisies a-t-il une option afficher_si ?
 *
 * @param array $saisies Un tableau de saisies
 * @return boolean
 */

function saisies_afficher_si($saisies) {
	$saisies = saisies_lister_par_nom($saisies,true);
	// Dès qu'il y a au moins une option afficher_si, on l'active
	foreach ($saisies as $saisie) {
		if (isset($saisie['options']['afficher_si']))
			return true;
	}
	return false;
}


/**
 * Le tableau de saisies a-t-il une option afficher_si_remplissage ?
 *
 * @param array $saisies Un tableau de saisies
 * @return boolean
 */
function saisies_afficher_si_remplissage($saisies) {
	$saisies = saisies_lister_par_nom($saisies,true);
	// Dès qu'il y a au moins une option afficher_si_remplissage, on l'active
	foreach ($saisies as $saisie) {
		if (isset($saisie['options']['afficher_si_remplissage']))
			return true;
	}
	return false;
}

