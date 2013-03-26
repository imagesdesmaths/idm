<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function saisies_header_prive($flux){
	$js = find_in_path('javascript/saisies.js');
	$flux .= "\n<script type='text/javascript' src='$js'></script>\n";
	$css = generer_url_public('saisies.css');
	$flux .= "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";
	$css_constructeur = find_in_path('css/formulaires_constructeur.css');
	$flux .= "\n<link rel='stylesheet' href='$css_constructeur' type='text/css' />\n";
	return $flux;
}

function saisies_affichage_final($flux){
	if (($p = strpos($flux,"<!--!inserer_saisie_editer-->"))!==false){
		// On insère la CSS devant le premier <link> trouvé
		if (!$pi = strpos($flux, "<link") AND !$pi=strpos($flux, '</head'))
			$pi = $p; // si pas de <link inserer comme un goret entre 2 <li> de saisies
		$css = generer_url_public('saisies.css');
		$ins_css = "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";
		$flux = substr_replace($flux, $ins_css, $pi, 0);
		
		// On insère le JS à la fin du <head>
		$pos_head = strpos($flux, '</head');
		$js = find_in_path('javascript/saisies.js');
		$ins_js = "\n<script type='text/javascript' src='$js'></script>\n";
		$flux = substr_replace($flux, $ins_js, $pos_head, 0);
	}
	return $flux;
}

// Déclaration des pipelines
function saisies_saisies_autonomes($flux) { return $flux; }
function saisies_formulaire_saisies($flux) { return $flux; }

// Déclarer automatiquement les champs d'un CVT si on les trouve dans un tableau de saisies et s'ils ne sont pas déjà déclarés
function saisies_formulaire_charger($flux){
    // Si le flux data est inexistant, on quitte : Le CVT d'origine a décidé de ne pas continuer
    if (!is_array($flux['data']))
        return $flux;
	// Il faut que la fonction existe et qu'elle retourne bien un tableau
	if (include_spip('inc/saisies')
		and $saisies = saisies_chercher_formulaire($flux['args']['form'], $flux['args']['args'])
	){
		// On ajoute au contexte les champs à déclarer
		$contexte = saisies_lister_valeurs_defaut($saisies);
		$flux['data'] = array_merge($contexte, $flux['data']);
		
		// On ajoute le tableau complet des saisies
		$flux['data']['_saisies'] = $saisies;
	}
	return $flux;
}

// Aiguiller CVT vers un squelette propre à Saisies lorsqu'on a déclaré des saisies et qu'il n'y a pas déjà un HTML
function saisies_styliser($flux){
	// Si on cherche un squelette de formulaire
	if (strncmp($flux['args']['fond'],'formulaires/',12)==0
		// Et qu'il y a des saisies dans le contexte
		and isset($flux['args']['contexte']['_saisies'])
		// Et que le fichier choisi est vide ou n'existe pas
		and include_spip('inc/flock')
		and $ext = $flux['args']['ext']
		and lire_fichier($flux['data'].'.'.$ext, $contenu_squelette)
		and !trim($contenu_squelette)
	){
		$flux['data'] = preg_replace("/\.$ext$/", '', find_in_path("formulaires/inc-saisies-cvt.$ext"));
	}
	
	return $flux;
}

// Ajouter les vérifications déclarées dans la fonction "saisies" du CVT
function saisies_formulaire_verifier($flux){
	// Il faut que la fonction existe et qu'elle retourne bien un tableau
	if (include_spip('inc/saisies') and $saisies = saisies_chercher_formulaire($flux['args']['form'], $flux['args']['args'])){
		// On ajoute au contexte les champs à déclarer
		$erreurs = saisies_verifier($saisies);
		if ($erreurs and !isset($erreurs['message_erreur']))
			$erreurs['message_erreur'] = _T('saisies:erreur_generique');
		$flux['data'] = array_merge($erreurs, $flux['data']);
	}


	return $flux;
}

?>
