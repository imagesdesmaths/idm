<?php
if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * Retourne la liste des saisies extras concernant un objet donné
 *
 * @param string $table Nom d'une table SQL éditoriale
 * @return array Liste des saisies extras de l'objet
**/
function champs_extras_objet($table) {
	static $saisies_tables = array();
	if (!$saisies_tables) {
		$saisies_tables = pipeline('declarer_champs_extras', array());
	}
	
	return isset($saisies_tables[$table]) ? $saisies_tables[$table] : array();
}

/**
 * Filtrer par autorisation les saisies transmises 
 *
 * @param String $faire Type d'autorisation testee : 'voir', 'modifier'
 * @param String $quoi Objet d'application : 'article'
 * @param Array $saisies Liste des saisies à filtrer
 * @param Array $args Arguments pouvant être utiles à l'autorisation
 * @return Array Liste des saisies filtrées
**/
function champs_extras_autorisation($faire, $quoi='', $saisies=array(), $args=array()) {
	if (!$saisies) return array();
	foreach ($saisies as $cle=>$saisie) {
		$id = isset($args['id']) ? $args['id'] : $args['id_objet'];
		$autoriser_quoi = $quoi . _SEPARATEUR_CEXTRAS_AUTORISER . $saisie['options']['nom'];
		if (!autoriser($faire . 'extra', $autoriser_quoi, $id, '', array(
			'type' => $quoi,
			'id_objet' => $id,
			'contexte' => $args['contexte'],
			'table' => table_objet_sql($quoi),
			'saisie' => $saisie
		))) {
			// on n'est pas autorise
			unset($saisies[$cle]);
		}
		else
		{
			// on est autorise
			// on teste les sous-elements
			if (isset($saisie['saisies']) and $saisie['saisies']) {
				$saisies['saisies'] = champs_extras_autorisation($faire, $quoi, $saisie['saisies'], $args);
			}
		}
	}
	return $saisies;
}

/**
 * Ajoute pour chaque saisie de type SQL un drapeau (input hidden)
 * permettant de retrouver les saisies editées.
 * Particulièrement utile pour les checkbox qui ne renvoient
 * rien si on les décoche.
 *
 * @param Array $saisies liste de saisies
 * @return Array $saisies Saisies complétées des drapeaux d'édition
**/
function champs_extras_ajouter_drapeau_edition($saisies, $inc = false) {
	$saisies_sql = saisies_lister_avec_sql($saisies);
	foreach ($saisies_sql as $saisie) {
		$nom = $saisie['options']['nom'];
		$saisies[] = array(
			'saisie' => 'hidden',
			'options' => array(
				'nom' => "cextra_$nom",
				'defaut' => 1 
			)
		);
	}
	return $saisies;
}

// ---------- pipelines -----------


// ajouter les champs sur les formulaires CVT editer_xx
function cextras_editer_contenu_objet($flux){
	
	// recuperer les saisies de l'objet en cours
	$objet = $flux['args']['type'];
	include_spip('inc/cextras');
	if ($saisies = champs_extras_objet( table_objet_sql($objet) )) {
		// filtrer simplement les saisies que la personne en cours peut voir
		$saisies = champs_extras_autorisation('modifier', $objet, $saisies, $flux['args']);
		// pour chaque saisie presente, de type champs extras (hors fieldset et autres)
		// ajouter un flag d'edition
		$saisies = champs_extras_ajouter_drapeau_edition($saisies);
		// ajouter au formulaire
		$ajout = recuperer_fond('inclure/generer_saisies', array_merge($flux['args']['contexte'], array('saisies'=>$saisies)));
		$flux['data'] = preg_replace('%(<!--extra-->)%is', '<ul>'.$ajout.'</ul>'."\n".'$1', $flux['data']);
	}

	return $flux;
}


// ajouter les champs extras soumis par les formulaire CVT editer_xx
function cextras_pre_edition($flux){
	
	include_spip('inc/cextras');
	$table = $flux['args']['table'];
	if ($saisies = champs_extras_objet( $table )) {
		$saisies = saisies_lister_avec_sql($saisies);
		foreach ($saisies as $saisie) {
			$nom = $saisie['options']['nom'];
			if (_request('cextra_' .  $nom)) {
				$extra = _request($nom);
				if (is_array($extra)) {
					$extra = join(',' , $extra);
				}
				$flux['data'][$nom] = corriger_caracteres($extra);
			}
		}
	}

	return $flux;
}


// ajouter le champ extra sur la visualisation de l'objet
function cextras_afficher_contenu_objet($flux){
	// recuperer les saisies de l'objet en cours
	$objet = $flux['args']['type'];
	include_spip('inc/cextras');
	if ($saisies = champs_extras_objet( $table = table_objet_sql($objet) )) {
		// ajouter au contexte les noms et valeurs des champs extras
		$saisies_sql = saisies_lister_avec_sql($saisies);
		$valeurs = sql_fetsel(array_keys($saisies_sql), $table, id_table_objet($table) . '=' . sql_quote($flux['args']['id_objet']));
		if (!$valeurs) {
			$valeurs = array();
		} else {
			// on applique les eventuels traitements definis
			// /!\ La saisies-vues/_base applique |propre par defaut si elle ne trouve pas de saisie
			// Dans ce cas, certains traitements peuvent être effectués 2 fois !
			$saisies_traitees = saisies_lister_avec_traitements($saisies_sql);
			unset($saisies_sql);
			foreach ($saisies_traitees as $saisie) {
				$traitement = $saisie['options']['traitements'];
				$traitement = defined($traitement) ? constant($traitement) : $traitement;
				$nom = $saisie['options']['nom'];
				list($avant, $apres) = explode('%s', $traitement);
				eval('$val = ' . $avant . ' $valeurs[$nom] ' . $apres . ';');
				$valeurs[$nom] = $val;
			}
		}
		$contexte = array_merge($flux['args']['contexte'], $valeurs);

		// restreindre la vue selon les autorisations
		$saisies = champs_extras_autorisation('voir', $objet, $saisies, $flux['args']);

		// ajouter les vues
		$flux['data'] .= recuperer_fond('inclure/voir_saisies', array_merge($contexte, array(
					'saisies' => $saisies,
					'valeurs' => $valeurs,
		)));
	}

	return $flux;
}

// verification de la validite des champs extras
function cextras_formulaire_verifier($flux){
	$form = $flux['args']['form'];
	
	if (strncmp($form, 'editer_', 7) !== 0) {
		return $flux;
	}
	
	$objet = substr($form, 7);
	if ($saisies = champs_extras_objet( $table = table_objet_sql($objet) )) {
		include_spip('inc/autoriser');
		include_spip('inc/saisies');

		$verifier = charger_fonction('verifier', 'inc', true);
		$saisies = saisies_lister_avec_sql($saisies);

		// restreindre la vue selon les autorisations
		$id_objet = $flux['args']['args'][0]; // ? vraiment toujours ?
		$saisies = champs_extras_autorisation('modifier', $objet, $saisies, array_merge($flux['args'], array('id' => $id_objet)));

		foreach ($saisies as $saisie) {
			// verifier obligatoire
			$nom = $saisie['options']['nom'];
			if (isset($saisie['options']['obligatoire']) and $saisie['options']['obligatoire']
			and !_request($nom))
			{
				$flux['data'][$nom] = _T('info_obligatoire');
			// verifier (api)
			} elseif ($verifier AND isset($saisie['verifier']) and $verif = $saisie['verifier']['type']) {
				if ($erreur = $verifier(_request($nom), $verif, $saisie['verifier']['options'])) {
					$flux['data'][$nom] = $erreur;
				}
			}
		}
	}

	return $flux;
}



?>
