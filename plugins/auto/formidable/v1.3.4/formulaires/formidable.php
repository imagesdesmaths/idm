<?php

/**
 * Gestion de l'affichage et traitement d'un formulaire Formidable
 *
 * @package SPIP\Formidable\Formulaires
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/formidable');
include_spip('inc/saisies');
include_spip('base/abstract_sql');
include_spip('inc/autoriser');

/**
 * Chargement du formulaire CVT de Formidable.
 * 
 * Genere le formulaire dont l'identifiant (numerique ou texte est indique)
 *
 * @param int|string $id_formulaire
 *     Identifiant numerique ou textuel du formulaire formidable
 * @param array $valeurs
 *     Valeurs par défauts passées au contexte du formulaire
 *     Exemple : array('hidden_1' => 3) pour que champ identifie "@hidden_1@" soit prerempli
 * @param int|bool $id_formulaires_reponse
 *     Identifiant d'une réponse pour forcer la reedition de cette reponse spécifique
 * 
 * @return array
 *     Contexte envoyé au squelette HTML du formulaire.
**/
function formulaires_formidable_charger($id_formulaire, $valeurs=array(), $id_formulaires_reponse=false){
	$contexte = array();

	// On peut donner soit un id soit un identifiant
	if (intval($id_formulaire) > 0)
		$where = 'id_formulaire = '.intval($id_formulaire);
	elseif (is_string($id_formulaire))
		$where = 'identifiant = '.sql_quote($id_formulaire);
	else
		return;
	
	// On cherche si le formulaire existe
	if ($formulaire = sql_fetsel('*', 'spip_formulaires', $where)) {
		// on ajoute un point d'entrée avec les infos de ce formulaire
		// pour d'eventuels plugins qui en ont l'utilité
		$contexte += array('_formidable' => $formulaire);
		// Est-ce que la personne a le droit de répondre ?
		if (autoriser('repondre', 'formulaire', $formulaire['id_formulaire'], null, array('formulaire'=>$formulaire))){
			$saisies = unserialize($formulaire['saisies']);
			$traitements = unserialize($formulaire['traitements']);
			// On déclare les champs
			$contexte += array_fill_keys(saisies_lister_champs($saisies), '');
			$contexte['mechantrobot'] = '';
			// On ajoute le formulaire complet
			$contexte['_saisies'] = $saisies;
		
			$contexte['id'] = $formulaire['id_formulaire'];
			$contexte['_hidden'] = '<input type="hidden" name="id_formulaire" value="'.$contexte['id'].'"/>';
			
			// S'il y a des valeurs par défaut dans l'appel, alors on pré-remplit
			if ($valeurs){
				// Si c'est une chaine on essaye de la parser
				if (is_string($valeurs)){
					$liste = explode(',', $valeurs);
					$liste = array_map('trim', $liste);
					$valeurs = array();
					foreach ($liste as $i=>$cle_ou_valeur){
						if ($i % 2 == 0)
							$valeurs[$liste[$i]] = $liste[$i+1];
					}
				}
				
				// On regarde si maintenant on a un tableau
				if ($valeurs and is_array($valeurs)){
					$contexte = array_merge($contexte, $valeurs);
				}
			}

			// Si on passe un identifiant de reponse, on edite cette reponse si elle existe
			if ($id_formulaires_reponse = intval($id_formulaires_reponse)) {
				$contexte = formidable_definir_contexte_avec_reponse($contexte, $id_formulaires_reponse, $ok);
				if ($ok) {
					// On ajoute un hidden pour dire que c'est une modif
					$contexte['_hidden'] .= "\n".'<input type="hidden" name="deja_enregistre_'.$formulaire['id_formulaire'].'" value="'.$id_formulaires_reponse.'"/>';
				} else {
					$contexte['editable'] = false;
					$contexte['message_erreur'] = _T('formidable:traiter_enregistrement_erreur_edition_reponse_inexistante');
				}
			} else {
				
				// Si multiple = non mais que c'est modifiable, alors on va chercher
				// la dernière réponse si elle existe
				if ($options = $traitements['enregistrement']
					and !$options['multiple']
					and $options['modifiable']
					and $reponses = formidable_verifier_reponse_formulaire($formulaire['id_formulaire'], $options['identification'])
				){
					$id_formulaires_reponse = array_pop($reponses);
					$contexte = formidable_definir_contexte_avec_reponse($contexte, $id_formulaires_reponse, $ok);

					// On ajoute un hidden pour dire que c'est une modif
					$contexte['_hidden'] .= "\n".'<input type="hidden" name="deja_enregistre_'.$formulaire['id_formulaire'].'" value="'.$id_formulaires_reponse.'"/>';
				}
				
			}
		}
		else{
			$contexte['editable'] = false;
			// le formulaire a déjà été répondu.
			// peut être faut il afficher les statistiques des réponses
			if ($formulaire['apres'] == 'stats') {
				// Nous sommes face à un sondage auquel on a déjà répondu !
				// On remplace complètement l'affichage du formulaire
				// par un affichage du résultat de sondage !
				$contexte['_remplacer_formulaire'] = recuperer_fond('modeles/formulaire_analyse', array(
					'id_formulaire' => $formulaire['id_formulaire'],
				));
			} else {
				$contexte['message_erreur'] = _T('formidable:traiter_enregistrement_erreur_deja_repondu');
			}
		}
	}
	else{
		$contexte['editable'] = false;
		$contexte['message_erreur'] = _T('formidable:erreur_inexistant');
	}
	if (!isset($contexte['_hidden'])) {
		$contexte['_hidden'] = '';
	}
	$contexte['_hidden'] .= "\n".'<input type="hidden" name="formidable_afficher_apres'/*.$formulaire['id_formulaire']*/.'" value="'.$formulaire['apres'].'"/>';// marche pas
	
	$contexte['formidable_afficher_apres']=$formulaire['apres'];
	
	return $contexte;
}


/**
 * Vérification du formulaire CVT de Formidable.
 * 
 * Pour chaque champ posté, effectue les vérifications demandées par
 * les saisies et retourne éventuellement les erreurs de saisie.
 *
 * @param int|string $id_formulaire
 *     Identifiant numerique ou textuel du formulaire formidable
 * @param array $valeurs
 *     Valeurs par défauts passées au contexte du formulaire
 *     Exemple : array('hidden_1' => 3) pour que champ identifie "@hidden_1@" soit prerempli
 * @param int|bool $id_formulaires_reponse
 *     Identifiant d'une réponse pour forcer la reedition de cette reponse spécifique
 * 
 * @return array
 *     Tableau des erreurs
**/
function formulaires_formidable_verifier($id_formulaire, $valeurs=array(), $id_formulaires_reponse=false){
	$erreurs = array();
	
	// Sale bête !
	if (_request('mechantrobot') != ''){
		$erreurs['hahahaha'] = 'hahahaha';
		return $erreurs;
	}
	
	$id_formulaire = intval(_request('id_formulaire'));
	$formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = '.$id_formulaire);
	$saisies = unserialize($formulaire['saisies']);
	
	$erreurs = saisies_verifier($saisies);
	
	if ($erreurs and !isset($erreurs['message_erreur']))
		$erreurs['message_erreur'] = _T('formidable:erreur_generique');

	return $erreurs;
}


/**
 * Traitement du formulaire CVT de Formidable.
 * 
 * Exécute les traitements qui sont indiqués dans la configuration des
 * traitements de ce formulaire formidable.
 *
 * Une fois fait, gère le retour après traitements des saisies en fonction
 * de ce qui a été configuré dans le formulaire, par exemple :
 * - faire réafficher le formulaire,
 * - faire afficher les saisies
 * - rediriger sur une autre page...
 *
 * @param int|string $id_formulaire
 *     Identifiant numerique ou textuel du formulaire formidable
 * @param array $valeurs
 *     Valeurs par défauts passées au contexte du formulaire
 *     Exemple : array('hidden_1' => 3) pour que champ identifie "@hidden_1@" soit prerempli
 * @param int|bool $id_formulaires_reponse
 *     Identifiant d'une réponse pour forcer la reedition de cette reponse spécifique
 * 
 * @return array
 *     Tableau des erreurs
**/
function formulaires_formidable_traiter($id_formulaire, $valeurs=array(), $id_formulaires_reponse=false){
	$retours = array();
	
	$id_formulaire = intval(_request('id_formulaire'));
	$formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = '.$id_formulaire);
	$traitements = unserialize($formulaire['traitements']);

	// selon le choix, le formulaire se remet en route à la fin ou non
	$retours['editable'] = ($formulaire['apres']=='formulaire');
	$retours['formidable_afficher_apres'] = $formulaire['apres'];

	// Si on a une redirection valide
	if (($formulaire['apres']== "redirige") AND ($formulaire['url_redirect']!="")) {
		refuser_traiter_formulaire_ajax();
		// traiter les raccourcis artX, brX
		include_spip("inc/lien");
		$url_redirect = typer_raccourci($formulaire['url_redirect']);
		if (count($url_redirect)>2) {
			$url_redirect = $url_redirect[0].$url_redirect[2];
		} else {
			$url_redirect = $formulaire['url_redirect'];      // URL classique
		}

		$retours['redirect'] = $url_redirect; 
	}

	// Si on a des traitements 
	if (is_array($traitements) and !empty($traitements)) {
		foreach($traitements as $type_traitement=>$options){
			if ($appliquer_traitement = charger_fonction($type_traitement, 'traiter/', true)) {
				$retours = $appliquer_traitement(
					array(
						'formulaire' => $formulaire,
						'options' => $options
					),
					$retours
				);
			}
		}

		// Si on a personnalisé le message de retour, c'est lui qui est affiché uniquement
		if ($formulaire['message_retour']) {
			$retours['message_ok'] = _T_ou_typo($formulaire['message_retour']);
		}
	}
	else{
		$retours['message_ok'] = _T('formidable:retour_aucun_traitement');
	}

	return $retours;
}


/**
 * Ajoute dans le contexte les elements
 * donnés par une reponse de formulaire indiquée 
 *
 * @param array $contexte
 *     Contexte pour le squelette HTML du formulaire
 * @param int $id_formulaires_reponse
 *     Identifiant de réponse
 * @param bool $ok
 *     La reponse existe bien ?
 * @return array $contexte
 *     Contexte complète des nouvelles informations
 * 
**/
function formidable_definir_contexte_avec_reponse($contexte, $id_formulaires_reponse, &$ok) {
	// On va chercher tous les champs
	$champs = sql_allfetsel(
		'nom, valeur',
		'spip_formulaires_reponses_champs',
		'id_formulaires_reponse = '.$id_formulaires_reponse
	);
	$ok = count($champs) ? true : false;
	
	// On remplit le contexte avec
	foreach ($champs as $champ){
		$test_array = unserialize($champ['valeur']);
		$contexte[$champ['nom']] = is_array($test_array) ? $test_array : $champ['valeur'];
	}

	return $contexte;
}

?>
