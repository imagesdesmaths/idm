<?php

/**
 * Utilisation des pipelines
 *
 * @package SPIP\Saisies\Pipelines
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Ajoute les scripts JS et CSS de saisies dans l'espace privé
 *
 * @param string $flux 
 * @return string
**/
function saisies_header_prive($flux){
	$js = find_in_path('javascript/saisies.js');
	$flux .= "\n<script type='text/javascript' src='$js'></script>\n";
	$css = generer_url_public('saisies.css');
	$flux .= "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";
	$css_constructeur = find_in_path('css/formulaires_constructeur.css');
	$flux .= "\n<link rel='stylesheet' href='$css_constructeur' type='text/css' />\n";
	return $flux;
}

/**
 * Ajoute les scripts JS et CSS de saisies dans l'espace public
 *
 * Ajoute également de quoi gérer le datepicker de la saisie date si
 * celle-ci est utilisée dans la page.
 * 
 * @param string $flux 
 * @return string
**/
function saisies_affichage_final($flux){
	if (
		$GLOBALS['html'] // si c'est bien du HTML
		and ($p = strpos($flux,"<!--!inserer_saisie_editer-->")) !== false // et qu'on a au moins une saisie
		and strpos($flux,'<head') !== false // et qu'on a la balise <head> quelque part
	){
		// On insère la CSS devant le premier <link> trouvé
		if (!$pi = strpos($flux, "<link") AND !$pi=strpos($flux, '</head')) {
			$pi = $p; // si pas de <link inserer comme un goret entre 2 <li> de saisies
		}
		$css = generer_url_public('saisies.css');
		$ins_css = "\n<link rel='stylesheet' href='$css' type='text/css' media='all' />\n";

		if (strpos($flux,"saisie_date")!==false){//si on a une saisie de type date, on va charger les css de jquery_ui
		    include_spip("jqueryui_pipelines");
			if (function_exists("jqueryui_dependances")){
				$ui_plugins = jqueryui_dependances(array("jquery.ui.datepicker"));
				$theme_css = "jquery.ui.theme";
				$ui_css_dir = "css";
				// compatibilité SPIP 3.1 et jQuery UI 1.11
				$version = explode(".",$GLOBALS['spip_version_branche']);
				if ($version[0]>3 OR ($version[0]==3 AND $version[1]>0)) {
					$theme_css = "theme";
					$ui_css_dir = "css/ui";
				}
				array_push($ui_plugins,$theme_css);
				foreach ($ui_plugins as $ui_plug){
					$ui_plug_css = find_in_path("$ui_css_dir/$ui_plug.css");
					if (strpos($flux,"$ui_css_dir/$ui_plug.css")===false){// si pas déjà chargé
						$ins_css .= "\n<link rel='stylesheet' href='$ui_plug_css' type='text/css' media='all' />\n";
					}
				}
			}
		}

		$flux = substr_replace($flux, $ins_css, $pi, 0);
		// On insère le JS à la fin du <head>
		$pos_head = strpos($flux, '</head');
		$js = find_in_path('javascript/saisies.js');
		$ins_js = "\n<script type='text/javascript' src='$js'></script>\n";
		$flux = substr_replace($flux, $ins_js, $pos_head, 0);
	}
	return $flux;
}


/**
 * Déclarer automatiquement les champs d'un formulaire CVT qui déclare des saisies
 *
 * Recherche une fonction `formulaires_XX_saisies_dist` et l'utilise si elle
 * est présente. Cette fonction doit retourner une liste de saisies dont on se
 * sert alors pour calculer les champs utilisés dans le formulaire.
 * 
 * @param array $flux 
 * @return array
**/
function saisies_formulaire_charger($flux){
	// Si le flux data est inexistant, on quitte : Le CVT d'origine a décidé de ne pas continuer
	if (!is_array($flux['data'])){
		return $flux;
	}

	// Il faut que la fonction existe et qu'elle retourne bien un tableau
	include_spip('inc/saisies');
	$saisies = saisies_chercher_formulaire($flux['args']['form'], $flux['args']['args']);

	if ($saisies) {
		// On ajoute au contexte les champs à déclarer
		$contexte = saisies_lister_valeurs_defaut($saisies);
		$flux['data'] = array_merge($contexte, $flux['data']);

		// On ajoute le tableau complet des saisies
		$flux['data']['_saisies'] = $saisies;
	}
	return $flux;
}

/**
 * Aiguiller CVT vers un squelette propre à Saisies lorsqu'on a déclaré des saisies et qu'il n'y a pas déjà un HTML
 *
 * Dans le cadre d'un formulaire CVT demandé, si ce formulaire a déclaré des saisies, et
 * qu'il n'y a pas de squelette spécifique pour afficher le HTML du formulaire,
 * alors on utilise le formulaire générique intégré au plugin saisie, qui calculera le HTML
 * à partir de la déclaration des saisies indiquées.
 * 
 * @see saisies_formulaire_charger()
 * 
 * @param array $flux
 * @return array
**/
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

/**
 * Ajouter les vérifications déclarées dans la fonction "saisies" du CVT
 *
 * Si un formulaire CVT a déclaré des saisies, on utilise sa déclaration
 * pour effectuer les vérifications du formulaire.
 *
 * @see saisies_formulaire_charger()
 * @uses saisies_verifier()
 * 
 * @param array $flux
 *     Liste des erreurs du formulaire
 * @return array
 *     iste des erreurs
 */
function saisies_formulaire_verifier($flux){
	// Il faut que la fonction existe et qu'elle retourne bien un tableau
	include_spip('inc/saisies');
	$saisies = saisies_chercher_formulaire($flux['args']['form'], $flux['args']['args']);
	if ($saisies) {
		// On ajoute au contexte les champs à déclarer
		$erreurs = saisies_verifier($saisies);
		if ($erreurs and !isset($erreurs['message_erreur']))
			$erreurs['message_erreur'] = _T('saisies:erreur_generique');
		$flux['data'] = array_merge($erreurs, $flux['data']);
	}

	return $flux;
}


