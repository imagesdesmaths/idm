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

function formidable_id_formulaire($id){
	// on utilise une static pour etre sur que si l'appel dans verifier() passe, celui dans traiter() passera aussi
	// meme si entre temps on perds la base
	static $id_formulaires = array();
	if (isset($id_formulaires[$id]))
		return $id_formulaires[$id];

    if (is_numeric($id))
		$where = 'id_formulaire = ' . intval($id);
	elseif (is_string($id))
		$where = 'identifiant = ' . sql_quote($id);
	else
		return 0;

	$id_formulaire = intval(sql_getfetsel('id_formulaire','spip_formulaires',$where));

	if ($id_formulaire
		AND !test_espace_prive()
	  AND !objet_test_si_publie("formulaire",$id_formulaire))
		return $id_formulaires[$id] = 0;

	return $id_formulaires[$id] = $id_formulaire;
}

/**
 * Chargement du formulaire CVT de Formidable.
 *
 * Genere le formulaire dont l'identifiant (numerique ou texte est indique)
 *
 * @param int|string $id
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
function formulaires_formidable_charger($id, $valeurs = array(), $id_formulaires_reponse = false){
	$contexte = array();

	// On peut donner soit un id soit un identifiant
	if (!$id_formulaire = formidable_id_formulaire($id))
		return;

	// On cherche si le formulaire existe
	if ($formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = ' . intval($id_formulaire))){
		// On ajoute un point d'entrée avec les infos de ce formulaire
		// pour d'eventuels plugins qui en ont l'utilité
		$contexte['_formidable'] = $formulaire;

		// Est-ce que la personne a le droit de répondre ?
		if (autoriser('repondre', 'formulaire', $formulaire['id_formulaire'], null, array('formulaire' => $formulaire))){
			$saisies = unserialize($formulaire['saisies']);
			$traitements = unserialize($formulaire['traitements']);

			// On déclare les champs avec les valeurs par défaut
			$contexte = array_merge(saisies_lister_valeurs_defaut($saisies), $contexte);
			$contexte['mechantrobot'] = '';
			// On ajoute le formulaire complet
			$contexte['_saisies'] = $saisies;

			$contexte['id'] = $formulaire['id_formulaire'];
			$contexte['_hidden'] = '<input type="hidden" name="id_formulaire" value="' . $contexte['id'] . '"/>';

			// S'il y a des valeurs par défaut dans l'appel, alors on pré-remplit
			if ($valeurs){
				// Si c'est une chaine on essaye de la parser
				if (is_string($valeurs)){
					$liste = explode(',', $valeurs);
					$liste = array_map('trim', $liste);
					$valeurs = array();
					foreach ($liste as $i => $cle_ou_valeur){
						if ($i%2==0)
							$valeurs[$liste[$i]] = $liste[$i+1];
					}
				}

				// Si on a un tableau, alors on écrase avec les valeurs données depuis l'appel
				if ($valeurs and is_array($valeurs)){
					$contexte = array_merge($contexte, $valeurs);
				}
			}

			// Si on passe un identifiant de reponse, on edite cette reponse si elle existe
			if ($id_formulaires_reponse = intval($id_formulaires_reponse)){
				$contexte = formidable_definir_contexte_avec_reponse($contexte, $id_formulaires_reponse, $ok);
				if ($ok == false){
					$contexte['editable'] = false;
					$contexte['message_erreur'] = _T('formidable:traiter_enregistrement_erreur_edition_reponse_inexistante');
				}
			} else {

				// calcul des paramètres d'anonymisation
				$options = isset($traitements['enregistrement']) ? $traitements['enregistrement'] : null;

				$anonymisation = (isset($options['anonymiser']) && $options['anonymiser']==true)
					? isset($options['anonymiser_variable']) ? $options['anonymiser_variable'] : ''
					: '';

				// Si multiple = non mais que c'est modifiable, alors on va chercher
				// la dernière réponse si elle existe
				if ($options
					and !$options['multiple']
					and $options['modifiable']
					and $reponses = formidable_verifier_reponse_formulaire($formulaire['id_formulaire'], $options['identification'], $anonymisation)
				){
					$id_formulaires_reponse = array_pop($reponses);
					$contexte = formidable_definir_contexte_avec_reponse($contexte, $id_formulaires_reponse, $ok);
				}

			}
		} else {
			$contexte['editable'] = false;
			// le formulaire a déjà été répondu.
			// peut être faut il afficher les statistiques des réponses
			if ($formulaire['apres']=='stats'){
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
	} else {
		$contexte['editable'] = false;
		$contexte['message_erreur'] = _T('formidable:erreur_inexistant');
	}
	if (!isset($contexte['_hidden'])){
		$contexte['_hidden'] = '';
	}
	$contexte['_hidden'] .= "\n" . '<input type="hidden" name="formidable_afficher_apres' /*.$formulaire['id_formulaire']*/ . '" value="' . $formulaire['apres'] . '"/>'; // marche pas

	$contexte['formidable_afficher_apres'] = $formulaire['apres'];

	return $contexte;
}


/**
 * Vérification du formulaire CVT de Formidable.
 *
 * Pour chaque champ posté, effectue les vérifications demandées par
 * les saisies et retourne éventuellement les erreurs de saisie.
 *
 * @param int|string $id
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
function formulaires_formidable_verifier($id, $valeurs = array(), $id_formulaires_reponse = false){
	$erreurs = array();

	// On peut donner soit un id soit un identifiant
	if (!$id_formulaire = formidable_id_formulaire($id)){

		$erreurs['message_erreur'] = _T('formidable:erreur_base');

	}
	else {

		// Sale bête !
		if (_request('mechantrobot')!=''){
			$erreurs['hahahaha'] = 'hahahaha';
			return $erreurs;
		}

		$formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = ' . intval($id_formulaire));
		$saisies = unserialize($formulaire['saisies']);

		$erreurs = saisies_verifier($saisies);

		if ($erreurs and !isset($erreurs['message_erreur']))
			$erreurs['message_erreur'] = _T('formidable:erreur_generique');

	}

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
 * @param int|string $id
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
function formulaires_formidable_traiter($id, $valeurs = array(), $id_formulaires_reponse = false){
	$retours = array();

	// POST Mortem de securite : on log le $_POST pour ne pas le perdre si quelque chose se passe mal
	include_spip("inc/json");
	$post = json_encode($_POST);
	spip_log($post,"formidable_post"._LOG_INFO_IMPORTANTE);

	// On peut donner soit un id soit un identifiant
	if (!$id_formulaire = formidable_id_formulaire($id))
		return array('message_erreur'=>_T('formidable:erreur_base'));

	$formulaire = sql_fetsel('*', 'spip_formulaires', 'id_formulaire = ' . $id_formulaire);
	$traitements = unserialize($formulaire['traitements']);

	// selon le choix, le formulaire se remet en route à la fin ou non
	$retours['editable'] = ($formulaire['apres']=='formulaire');
	$retours['formidable_afficher_apres'] = $formulaire['apres'];
	$retours['id_formulaire'] = $id_formulaire;

	// Si on a une redirection valide
	if (($formulaire['apres']=="redirige") AND ($formulaire['url_redirect']!="")){
		refuser_traiter_formulaire_ajax();
		// traiter les raccourcis artX, brX
		include_spip("inc/lien");
		$url_redirect = typer_raccourci($formulaire['url_redirect']);
		if (count($url_redirect)>2){
			$url_redirect = $url_redirect[0] . $url_redirect[2];
		} else {
			$url_redirect = $formulaire['url_redirect']; // URL classique
		}

		$retours['redirect'] = $url_redirect;
	}

	// les traitements deja faits se notent ici
	// pour etre sur de ne pas etre appeles 2 fois
	// ainsi si un traitement A a besoin d'un traitement B,
	// et que B n'est pas fait quand il est appele, il peut rendre la main sans rien faire au premier coup
	// et sera rappele au second tour
	$retours['traitements'] = array();
	$erreur_texte = "";

	// Si on a des traitements
	if (is_array($traitements) and !empty($traitements)){
		$maxiter = 5;
		do {
			foreach ($traitements as $type_traitement => $options){
				// si traitement deja appele, ne pas le relancer
				if (!isset($retours['traitements'][$type_traitement])){
				  if ($appliquer_traitement = charger_fonction($type_traitement, 'traiter/', true)){
						$retours = $appliquer_traitement(
							array(
								'formulaire' => $formulaire,
								'options' => $options,
						        'id_formulaire' => $id_formulaire,
						        'valeurs' => $valeurs,
						        'id_formulaires_reponse' => $id_formulaires_reponse,
							),
							$retours
						);
					}
					else {
						// traitement introuvable, ne pas retenter
						$retours['traitements'][$type_traitement] = true;
					}
				}
			}
		}
		while (count($retours['traitements'])<count($traitements) AND $maxiter--);

		// si on ne peut pas traiter correctement, alerter le webmestre
		if (count($retours['traitements'])<count($traitements)){
			$erreur_texte = "Impossible de traiter correctement le formulaire $id\n"
				. "Traitements attendus :".implode(',',array_keys($traitements))."\n"
				. "Traitements realises :".implode(',',array_keys($retours['traitements']))."\n";
		}

		// Si on a personnalisé le message de retour, c'est lui qui est affiché uniquement
		if ($formulaire['message_retour']){
			$retours['message_ok'] = _T_ou_typo($formulaire['message_retour']);
		}
	}
	else {
		$retours['message_erreur'] = _T('formidable:retour_aucun_traitement');
	}

	// si aucun traitement, alerter le webmestre pour ne pas perdre les donnees
	if (!$erreur_texte AND !count($retours['traitements'])){
		$erreur_texte = "Aucun traitement pour le formulaire $id\n";
	}

	if ($erreur_texte){
		$erreur_sujet = "[ERREUR] Traitement Formulaire $id";
		// dumper la saisie pour ne pas la perdre
		$erreur_texte .= "\n".var_export($_REQUEST,true);
		$envoyer_mail = charger_fonction("envoyer_mail", "inc");
		$envoyer_mail($GLOBALS['meta']['email_webmaster'], $erreur_sujet, $erreur_texte);
	}
	unset($retours['traitements']);

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
function formidable_definir_contexte_avec_reponse($contexte, $id_formulaires_reponse, &$ok){
	// On va chercher tous les champs
	$champs = sql_allfetsel(
		'nom, valeur',
		'spip_formulaires_reponses_champs',
		'id_formulaires_reponse = ' . $id_formulaires_reponse
	);
	$ok = count($champs) ? true : false;

	// On remplit le contexte avec
	foreach ($champs as $champ){
		$test_array = unserialize($champ['valeur']);
		$contexte[$champ['nom']] = is_array($test_array) ? $test_array : $champ['valeur'];
	}

	return $contexte;
}
