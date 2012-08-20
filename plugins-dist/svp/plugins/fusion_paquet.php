<?php

if (!defined('_ECRIRE_INC_VERSION')) return;
include_spip('inc/plugin');
include_spip('inc/svp_outiller');

// Fusion des informations de chaque balise plugin en considerant la compatibilite SPIP
// Pour les balise paquet sans balise spip incluse cette fonction permet de generer une structure
// identique pour les balises dites techniques
function plugins_fusion_paquet($plugins) {
	global $balises_techniques;

	$fusion = array();
	if (!$plugins)
		return $fusion;

	// On initialise les informations a retourner avec l'index 0 du tableau qui contient les donnees communes
	// de la balise paquet
	$fusion = $plugins[0];

	// On relit les balises paquet et spip et :
	// -- pour la balise paquet on reindexe les balises techniques dans un sous-tableau d'index 0
	// -- pour chaque balise spip on merge les informations additionnelles avec les donnees
	// communes dans un sous-tableau d'index egal a l'intervalle de compatibilite
	foreach ($plugins as $_compatibilite => $_paquet_spip) {
		if ($_paquet_spip['balise'] == 'paquet') {
			// Deplacement du contenu de chaque balise technique commune si elle est non vide
			foreach ($balises_techniques as $_btech) {
				if (isset($fusion[$_btech]) and $fusion[$_btech]) {
					$balise = $fusion[$_btech];
					unset($fusion[$_btech]);
					$fusion[$_btech][0] = $balise;
				}
			}
		}
		else {
			// Balise spip
			// On merge les balises techniques existantes en les rangeant das un sous tableau indexe par
			// la compatibilite et ce pour chaque balise
			foreach ($_paquet_spip as $_index => $_balise) {
				if ($_index AND $_index != 'balise') {
					$fusion[$_index][$_compatibilite] = $_balise;
					if (!isset($fusion[$_index][0]))
						$fusion[$_index][0] = array();
				}
			}
		}
	}

	return $fusion;
}

?>
