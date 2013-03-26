<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function traiter_enregistrement_dist($args, $retours){
	include_spip('inc/formidable');
	include_spip('base/abstract_sql');
	$options = $args['options'];
	$formulaire = $args['formulaire'];
	$id_formulaire = intval($formulaire['id_formulaire']);
	$saisies = unserialize($formulaire['saisies']);
	$saisies = saisies_lister_par_nom($saisies);
	
	// La personne a-t-elle un compte ?
	global $auteur_session;
	$id_auteur = $auteur_session ? intval($auteur_session['id_auteur']) : 0;
	
	// On cherche le cookie et sinon on le crée
	$nom_cookie = formidable_generer_nom_cookie($id_formulaire);
	if (isset($_COOKIE[$nom_cookie]))
		$cookie = $_COOKIE[$nom_cookie];
	else {
		include_spip("inc/acces");
		$cookie = creer_uniqid();
	}
	
	// On regarde si c'est une modif d'une réponse existante
	$id_formulaires_reponse = intval(_request('deja_enregistre_'.$id_formulaire));
	
	// Si la moderation est a posteriori ou que la personne est un boss, on publie direct
	if ($options['moderation'] == 'posteriori' or autoriser('instituer', 'formulaires_reponse', $id_formulaires_reponse, null, array('id_formulaire'=>$id_formulaire, 'nouveau_statut'=>'publie')))
		$statut='publie';
	else
		$statut = 'prop';
	
	// Si ce n'est pas une modif d'une réponse existante, on crée d'abord la réponse
	if (!$id_formulaires_reponse){
		$id_formulaires_reponse = sql_insertq(
			'spip_formulaires_reponses',
			array(
				'id_formulaire' => $id_formulaire,
				'id_auteur' => $id_auteur,
				'cookie' => $cookie,
				'ip' => $GLOBALS['ip'],
				'date' => 'NOW()',
				'statut' => $statut
			)
		);
		// Si on a pas le droit de répondre plusieurs fois ou que les réponses seront modifiables, il faut poser un cookie
		if (!$options['multiple'] or $options['modifiable']){
			include_spip("inc/cookie");
			// Expiration dans 30 jours
			spip_setcookie($nom_cookie, $_COOKIE[$nom_cookie] = $cookie, time() + 30 * 24 * 3600);
		}
	}
	
	// Si l'id n'a pas été créé correctement alors erreur
	if (!($id_formulaires_reponse > 0)){
		$retours['message_erreur'] .= "\n<br/>"._T('formidable:traiter_enregistrement_erreur_base');
	}
	// Sinon on continue à mettre à jour
	else{
		$champs = array();
		$insertions = array();
		foreach($saisies as $nom => $saisie){
			// On ne prend que les champs qui ont effectivement été envoyés par le formulaire
			if (($valeur = _request($nom)) !== null){
				$champs[] = $nom;
				$insertions[] = array(
					'id_formulaires_reponse' => $id_formulaires_reponse,
					'nom' => $nom,
					'valeur' => is_array($valeur) ? serialize($valeur) : $valeur
				);
			}
		}
		
		// S'il y a bien des choses à modifier
		if ($champs){
			// On supprime d'abord les champs
			sql_delete(
				'spip_formulaires_reponses_champs',
				array(
					'id_formulaires_reponse = '.$id_formulaires_reponse,
					sql_in('nom', $champs)
				)
			);
			
			// Puis on insère les nouvelles valeurs
			sql_insertq_multi(
				'spip_formulaires_reponses_champs',
				$insertions
			);
		}
	}
	
	return $retours;
}

function traiter_enregistrement_update_dist($id_formulaire, $traitement, $saisies_anciennes, $saisies_nouvelles){
	include_spip('inc/saisies');
	include_spip('base/abstract_sql');
	$comparaison = saisies_comparer($saisies_anciennes, $saisies_nouvelles);
	
	// Si des champs ont été supprimés, il faut supprimer les réponses à ces champs
	if ($comparaison['supprimees']){
		// On récupère les réponses du formulaire
		$reponses = sql_allfetsel(
			'id_formulaires_reponse',
			'spip_formulaires_reponses',
			'id_formulaire = '.$id_formulaire
		);
		$reponses = array_map('reset', $reponses);
		
		// Tous les noms de champs à supprimer
		$noms = array_keys($comparaison['supprimees']);
		
		// On supprime
		sql_delete(
			'spip_formulaires_reponses_champs',
			array(
				sql_in('id_formulaires_reponse', $reponses),
				sql_in('nom', $noms)
			)
		);
	}
}

?>
