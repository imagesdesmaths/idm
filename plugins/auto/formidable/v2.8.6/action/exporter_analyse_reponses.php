<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/*
 * Exporter l'analyse des réponses d'un formulaire
 * @param unknown_type $arg
 * @return unknown_type
 */
function action_exporter_analyse_reponses_dist($arg=null) {
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
        
        $saisies = saisies_lister_par_nom(unserialize($formulaire['saisies']), false);
        
        // exclure les champs non analysés
        $traitement = unserialize($formulaire['traitements']);
        foreach (explode("|",$traitement['enregistrement']['analyse_exclure_champs']) as $exclure){
            unset($saisies[$exclure]);
        }
		$res = sql_select(
            array('nom, valeur'),

            'spip_formulaires_reponses_champs AS FRC,
            spip_formulaires_reponses AS FR,
            spip_formulaires AS F',

            "FRC.id_formulaires_reponse=FR.id_formulaires_reponse
            AND FR.statut='publie'
            AND F.id_formulaire=FR.id_formulaire
            AND F.id_formulaire=$id_formulaire"
        );

        $valeurs = array();
        while($r = sql_fetch($res)) {
            $valeurs[$r['nom']][] = is_array(unserialize($r['valeur']))
                ? unserialize($r['valeur'])
                : $r['valeur'];
        }

        foreach ($saisies as $nom=>$saisie){
            $valeur = sql_getfetsel(
                'valeur',
                'spip_formulaires_reponses_champs',
                'id_formulaires_reponse = '.intval($reponse['id_formulaires_reponse']).' and nom = '.sql_quote($nom)
            );
            if (is_array(unserialize($valeur)))
                $valeur = unserialize($valeur);

            $reponse_complete[] = formidable_analyser_saisie($saisie, $valeurs, 0, true);
        }

        $colonnes = array(_T('formidable:champs'), _T('formidable:sans_reponses'));
        foreach($reponse_complete as $reponses) {
            foreach($reponses as $key => $reponse) {
                if ($key == 'header' || $key == 'sans_reponse') continue;
                if (in_array($key, $colonnes) == false)
                    array_push($colonnes, $key);
            }
        }

        $csv = array();
        foreach($reponse_complete as $reponses) {
            foreach($colonnes as $colonne) {
                $csv[$reponses['header']][$colonne] =
                    isset($reponses[$colonne])
                        ? $reponses[$colonne]
                        : '';
            }
            $csv[$reponses['header']][_T('formidable:champs')] = $reponses['header'];
            $csv[$reponses['header']][_T('formidable:sans_reponses')]
                = $reponses['formidable:sans_reponse'];
        }

        $cpt_ligne = 1;
        $reponses_completes = array();
        $reponses_completes[0] = $colonnes;
        foreach($csv as $ligne => $colonnes) {
            $cpt_colonne = 0;
            foreach($colonnes as $colonne) {
                $reponses_completes[$cpt_ligne][$cpt_colonne++] = $colonne;
            }
            $cpt_ligne++;
        }

		if ($reponses_completes and $exporter_csv = charger_fonction('exporter_csv', 'inc/', true)){
			$exporter_csv('analyses-formulaire-'.$formulaire['identifiant'], $reponses_completes);
			exit();
		}
	}
}

?>
