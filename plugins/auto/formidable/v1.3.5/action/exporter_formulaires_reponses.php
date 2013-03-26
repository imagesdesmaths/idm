<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/*
 * Exporter toutes les réponses d'un formulaire
 * @param unknown_type $arg
 * @return unknown_type
 */
function action_exporter_formulaires_reponses_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}

	// on ne fait des choses seulements si le formulaire existe et qu'il a des enregistrements
	$ok = false;
	if (
		$id_formulaire = intval($arg)
		and $formulaire = sql_fetsel('*','spip_formulaires','id_formulaire = '.$id_formulaire)
		and $reponses = sql_allfetsel('*', 'spip_formulaires_reponses', 'id_formulaire = '.$id_formulaire.' and statut = '.sql_quote('publie'))
	) {
		include_spip('inc/saisies');
		include_spip('classes/facteur');
		include_spip('inc/filtres');
		$reponses_completes = array();
		
		// La première ligne des titres
		$titres = array(_T('public:date'), _T('formidable:reponses_auteur'), _T('formidable:reponses_ip'));
		$saisies = saisies_lister_par_nom(unserialize($formulaire['saisies']), false);
		foreach ($saisies as $nom=>$saisie){
			$options = $saisie['options'];
			$titres[] = sinon($options['label_case'], sinon($options['label'], $nom));
		}
		$reponses_completes[] = $titres;
		
		// On parcourt chaque réponse
		foreach ($reponses as $reponse){
			// Est-ce qu'il y a un auteur avec un nom
			$nom_auteur = '';
			if ($id_auteur = intval($reponse['id_auteur'])){
				$nom_auteur = sql_getfetsel('nom', 'spip_auteurs', 'id_auteur = '.$id_auteur);
			}
			if (!$nom_auteur) $nom_auteur = '';
			
			// Le début de la réponse avec les infos (date, auteur, etc)
			$reponse_complete = array($reponse['date'], $nom_auteur, $reponse['ip']);
			
			// Ensuite tous les champs
			foreach ($saisies as $nom=>$saisie){
				$valeur = sql_getfetsel(
					'valeur',
					'spip_formulaires_reponses_champs',
					'id_formulaires_reponse = '.intval($reponse['id_formulaires_reponse']).' and nom = '.sql_quote($nom)
				);
				if (is_array(unserialize($valeur)))
					$valeur = unserialize($valeur);
				$reponse_complete[] = Facteur::html2text(
					recuperer_fond(
						'saisies-vues/_base',
						array_merge(
							array(
								'valeur_uniquement' => 'oui',
								'type_saisie' => $saisie['saisie'],
								'valeur' => $valeur
							),
							$saisie['options']
						)
					)
				);
			}
			
			// On ajoute la ligne à l'ensemble des réponses
			$reponses_completes[] = $reponse_complete;
		}
		
		if ($reponses_completes and $exporter_csv = charger_fonction('exporter_csv', 'inc/', true)){
			echo $exporter_csv('reponses-formulaire-'.$formulaire['identifiant'], $reponses_completes);
			exit();
		}
	}
}

?>
