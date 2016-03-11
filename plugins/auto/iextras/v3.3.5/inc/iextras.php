<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/cextras');

/**
 * Retourne la liste des saisies extras pour
 * un objet donné.
 *
 * @param string $table Nom de la table SQL de l'objet éditorial
 * @return Array Liste de saisies
**/
function iextras_champs_extras_definis($table='') {
	static $tables = array();

	if (!$tables) {
		// sinon calculer...
		$n = strlen('champs_extras_');
		foreach ($GLOBALS['meta'] as $cle => $val) {
			if (strpos($cle, 'champs_extras_') === 0) {
				$_table = substr($cle, $n);
				$s = unserialize($val);
				$tables[$_table] = $s ? $s : array();
			}
		}
	}

	if (!$table) {
		return $tables;
	} elseif (isset($tables[$table])) {
		return $tables[$table];
	}

	return array();
}


/**
 * Compter les saisies extras d'une table
 *
 * @param String $table Table sql
 * @return Int Nombre d'éléments.
**/
function compter_champs_extras($table) {
	static $tables = array();

	if (!count($tables)) {
		include_spip('inc/saisies');
		$saisies_tables = iextras_champs_extras_definis();
		foreach($saisies_tables as $t=>$s) {
			if ($s = saisies_lister_par_nom($s)) {
				$tables[$t] = count($s);
			}
		}
	}

	if (isset($tables[$table])) {
		return $tables[$table];
	}
}


/**
 * Ajouter les saisies SQL et de recherche
 * sur les options de config d'une saisie (de champs extras)
 *
 * @param array
 * @return array
**/
function iextras_formulaire_verifier($flux) {
	if ($flux['args']['form'] == 'construire_formulaire'
	AND strpos($flux['args']['args'][0], 'champs_extras_')===0
	AND $nom_ou_id = _request('configurer_saisie') ) {

		// On ajoute le préfixe devant l'identifiant
		$identifiant = 'constructeur_formulaire_'.$flux['args']['args'][0];
		// On récupère le formulaire à son état actuel
		$formulaire_actuel = session_get($identifiant);

		if ($nom_ou_id[0] == '@') {
			$saisies_actuelles = saisies_lister_par_identifiant($formulaire_actuel);
			$name = $saisies_actuelles[$nom_ou_id]['options']['nom'];
		} else {
			$saisies_actuelles = saisies_lister_par_nom($formulaire_actuel);
			$name = $nom_ou_id;
		}

		// saisie inexistante => on sort
		if (!isset($saisies_actuelles[$nom_ou_id])) {
			return $flux;
		}

		$nom = 'configurer_' . $name;
		$table = substr($flux['args']['args'][0], strlen('champs_extras_'));


		// on ajoute le fieldset de restrictions de champs
		// (des autorisations pre-reglées en quelque sorte)
		$saisies_restrictions = array();

		// les restrictions de X ne peuvent apparaître que
		// si l'objet possede un Y.
		// secteurs -> id_secteur
		// branches -> id_rubrique
		// groupes -> id_groupe
		$desc = lister_tables_objets_sql($table);
		$types = array(
			'secteurs' => 'id_secteur',
			'branches' => 'id_rubrique',
			'groupes'  => 'id_groupe',
		);
		foreach ($types as $type => $champ) {
			if (isset($desc['field'][$champ])) {
				$saisies_restrictions[] = array(
					'saisie' => 'input',
					'options' => array(
						'nom' => "saisie_modifiee_${name}[options][restrictions][$type]",
						'label' => _T('iextras:label_restrictions_' . $type),
						'explication' => _T('iextras:precisions_pour_restrictions_' . $type),
						'defaut' => '',
					)
				);
			}
		}

		// ajout des restrictions voir | modifier par auteur
		$actions = array('voir', 'modifier');
		foreach ($actions as $action) {
			$saisies_restrictions[] = array(
					'saisie' => 'fieldset',
					'options' => array(
						'nom' => "saisie_modifiee_${name}[options][restrictions][$action]",
						'label' => _T('iextras:legend_restrictions_' . $action),
					),
					'saisies' => array(
						array(
							'saisie' => 'radio',
							'options' => array(
								'nom' => "saisie_modifiee_${name}[options][restrictions][$action][auteur]",
								'label' => _T('iextras:label_restrictions_auteur'),
								'defaut' => '',
								'datas' => array(
									'' => _T('iextras:radio_restrictions_auteur_aucune'),
									'admin' => _T('iextras:radio_restrictions_auteur_admin'),
									'admin_complet' => _T('iextras:radio_restrictions_auteur_admin_complet'),
									'webmestre' => _T('iextras:radio_restrictions_auteur_webmestre'),
								)
							)
						)
					)
				);
		}


		$flux['data'][$nom] = saisies_inserer($flux['data'][$nom], array(
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => "saisie_modifiee_${name}[options][restrictions]",
				'label' => _T('iextras:legend_restriction'),
			),
			'saisies' => $saisies_restrictions
		));



		// on récupère les informations de la saisie
		// pour savoir si c'est un champs éditable (il a une ligne SQL)
		// et dans ce cas, on ajoute les options techniques
		$type_saisie = $saisies_actuelles[$nom_ou_id]['saisie'];
		$saisies_sql = saisies_lister_disponibles_sql();

		if (isset($saisies_sql[$type_saisie])) {

			// liste 'type_de_saisie' => 'Titre de la saisie'
			$liste_saisies = array();
			foreach ($saisies_sql as $s=>$d) {
				$liste_saisies[$s] = $d['titre'];
			}

			$sql = $saisies_sql[$type_saisie]['defaut']['options']['sql'];
			$flux['data'][$nom] = saisies_inserer($flux['data'][$nom], array(

				'saisie' => 'fieldset',
				'options' => array(
					'nom' => "saisie_modifiee_${name}[options][options_techniques]",
					'label' => _T('iextras:legend_options_techniques'),
				),
				'saisies' => array(
					array(
						'saisie' => 'input',
						'options' => array(
							'nom' => "saisie_modifiee_${name}[options][sql]",
							'label' => _T('iextras:label_sql'),
							'obligatoire' => 'oui',
							'size' => 50,
							'defaut' => $sql
						)
					),
					array(
						'saisie' => 'oui_non',
						'options' => array(
							'nom' => "saisie_modifiee_${name}[options][rechercher]",
							'label' => _T('iextras:label_rechercher'),
							'explication' => _T('iextras:precisions_pour_rechercher'),
							'defaut' => ''
						)
					),
					array(
						'saisie' => 'input',
						'options' => array(
							'nom' => "saisie_modifiee_${name}[options][rechercher_ponderation]",
							'label' => _T('iextras:label_rechercher_ponderation'),
							'explication' => _T('iextras:precisions_pour_rechercher_ponderation'),
							'defaut' => 2,
							'afficher_si' => "@saisie_modifiee_${name}[options][rechercher]@ != ''",
						)
					),
					array(
						'saisie' => 'radio',
						'options' => array(
							'nom' => "saisie_modifiee_${name}[options][traitements]",
							'label' => _T('iextras:label_traitements'),
							'explication' => _T('iextras:precisions_pour_traitements'),
							'defaut' => '',
							'datas' => array(
								'' => _T('iextras:radio_traitements_aucun'),
								'_TRAITEMENT_TYPO' => _T('iextras:radio_traitements_typo'),
								'_TRAITEMENT_RACCOURCIS' => _T('iextras:radio_traitements_raccourcis'),
							)
						)
					),
					array(
						'saisie' => 'oui_non',
						'options' => array(
							'nom' => "saisie_modifiee_${name}[options][versionner]",
							'label' => _T('iextras:label_versionner'),
							'explication' => _T('iextras:precisions_pour_versionner'),
							'defaut' => ''
						)
					),
					array(
						'saisie' => 'selection',
						'options' => array(
							'nom' => "saisie_modifiee_${name}[options][nouveau_type_saisie]",
							'label' => _T('iextras:label_saisie'),
							'explication' => _T('iextras:precisions_pour_nouvelle_saisie'),
							'attention' => _T('iextras:precisions_pour_nouvelle_saisie_attention'),
							'defaut' => $type_saisie,
							'datas' => $liste_saisies
						)
					),
				)));
		}
	}
	return $flux;
}
