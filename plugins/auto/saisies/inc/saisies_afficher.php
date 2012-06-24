<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;

/*
 * Indique si une saisie peut être affichée.
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
 * @return bool Retourne un booléen indiquant l'état éditable ou pas
 */
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
	// Identifiant unique de saisie, si present
	if (isset($champ['identifiant'])) {
		$contexte['id_saisie'] = $champ['identifiant'];
	}
	
	// Peut-être des transformations à faire sur les options textuelles
	$options = $champ['options'];

	
	foreach ($options as $option => $valeur){
		$options[$option] = _T_ou_typo($valeur, 'multi');
	}
	
	// On ajoute les options propres à la saisie
	$contexte = array_merge($contexte, $options);

	// Si env est définie dans les options ou qu'il y a des enfants, on ajoute tout l'environnement
	if (isset($contexte['env']) or is_array($champ['saisies'])) {
		unset($contexte['env']);

		// on sauve l'ancien environnement
		// car les sous-saisies ne doivent pas être affectees
		// par les modification sur l'environnement servant à generer la saisie mère
		$contexte['_env'] = $env;
		
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
 * Génère une vue d'une saisie à partir d'un tableau la décrivant
 *
 * @see saisies_generer_html()
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

		// on sauve l'ancien environnement
		// car les sous-saisies ne doivent pas être affectees
		// par les modification sur l'environnement servant à generer la saisie mère
		$contexte['_env'] = $env;
				
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
