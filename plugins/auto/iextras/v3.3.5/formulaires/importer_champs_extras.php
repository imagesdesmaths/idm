<?php

if (!defined("_ECRIRE_INC_VERSION")) return;


function formulaires_importer_champs_extras_charger_dist() {
	if (!autoriser('configurer', 'champs_extras')) {
		return false;
	}

	$valeurs = array(
		'fichier' => '',
		'fusionner' => 'non',
	);

	return $valeurs;
}



function formulaires_importer_champs_extras_verifier_dist() {
	$erreurs = array();

	if (empty($_FILES['fichier']['tmp_name'])) {
		$erreurs['fichier'] = _T('info_obligatoire');
	}

	return $erreurs;
}


function formulaires_importer_champs_extras_traiter_dist() {
	$res = array('editable' => true);

	$fichier = $_FILES['fichier']['tmp_name'];
	lire_fichier($fichier, $yaml);

	if (!$yaml) {
		$res['message_erreur'] = "Lecture du fichier en erreur.";
		return $res;
	}

	include_spip('inc/yaml');
	$description = yaml_decode($yaml, true);

	if (!$description OR !is_array($description)) {
		$res['message_erreur'] = "Pas de champ trouvé dans le fichier.";
		return $res;
	}

	if (iextras_importer_description($description, $message, _request('fusionner') == 'oui')) {
		$res['message_ok'] = $message;
	} else {
		$res['message_erreur'] = $message;
	}

	return $res;
}


/**
 * Importe une description de champs extras donnée
 *
 * @param array $description 
 *    description des champs extras (table sql => liste des champs extras)
 * @param string $message
 *    message de retour, rempli par cette fonction
 * @param bool $fusionner_doublons
 *    true si on fusionne les champs présents dans la sauvegarde et aussi présents sur le site. False pour les ignorer.
 * @return bool
 *    true si tout s'est bien passé, false sinon
**/
function iextras_importer_description($description,  &$message, $fusionner_doublons = false) {
	include_spip('inc/iextras');
	include_spip('inc/saisies');
	include_spip('inc/texte');
	include_spip('inc/cextras');

	$tables_sql_presentes = array_keys(lister_tables_objets_sql());

	$message = '';
	$nbt = count($description);
	$message .= "{{Fichier importé :}}\n";
	$message .= "- $nbt objets éditoriaux.\n";

	$nbc = 0;
	foreach ($description as $table => $saisies) {
		$nbc += count($saisies);
	}
	$message .= "- $nbc champs extras.\n";

	foreach ($description as $table => $saisies) {

		if (!in_array($table, $tables_sql_presentes)) {
			$message .= "\nTable {{ $table }} absente sur le site\n";
			$message .= count($saisies) . " champs extras ignorés !!\n";
			continue;
		}

		$champs_presents = $champs_futurs = iextras_champs_extras_definis($table);
		$champs_presents_par_nom = saisies_lister_par_nom($champs_presents);

		$objet = objet_type($table);
		$titre = _T(objet_info($objet, 'texte_objets'));
		$message .= "\n{{ $titre :}}\n";
		$message .= count($saisies) . " champs extras\n";

		foreach ($saisies as $saisie) {
			$nom = isset($saisie['options']['nom']) ? $saisie['options']['nom'] : '';
			if (!$nom) {
				$message .= "- !! Saisie sans nom ignorée\n";
				continue;
			}

			// champ déjà présent ?
			if (isset($champs_presents_par_nom[$nom])) {
				if ($fusionner_doublons) {
					$message .= "- {{ $nom :}} modifié (déjà présent)\n";
					$champs_futurs = saisies_modifier($champs_futurs, $nom, $saisie);
				} else {
					$message .= "- {{ $nom :}} ignoré (déjà présent)\n";
				}
			} else {
				$message .= "- {{ $nom :}} ajouté\n";
				$champs_futurs = saisies_inserer($champs_futurs, $saisie);
			}
		}

		$diff = saisies_comparer_par_identifiant($champs_presents, $champs_futurs);

		// ajouter les nouveaux champs;
		if ($diff['ajoutees']) {
			$message .= count($diff['ajoutees']) . " champs ajoutés.\n";
			champs_extras_creer($table, $diff['ajoutees']);
		}

		// modifier les champs modifies;
		if ($diff['modifiees']) {
			$message .= count($diff['modifiees']) . " champs modifiés.\n";
			$anciennes = saisies_lister_par_identifiant($champs_presents);
			$anciennes = array_intersect_key($anciennes, $diff['modifiees']);
			champs_extras_modifier($table, $diff['modifiees'], $anciennes);
		}

		// enregistrer la nouvelle config
		if ($diff['ajoutees'] or $diff['modifiees']) {
			ecrire_meta("champs_extras_" . $table, serialize($champs_futurs));
		} else {
			$message .= "Aucune modification !\n";
		}
	}

	$message = propre($message);

	return true;
}
