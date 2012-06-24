<?php
/**
 * Fonction pour le pipeline, n'a rien a effectuer
 *
 * @return
 */
function svp_autoriser(){}

/**
 * Autorisation d'iconification d'un depot
 *
 * @param object $faire
 * @param object $type
 * @param object $id
 * @param object $qui
 * @param object $opt
 * @return
 */
function autoriser_depot_iconifier_dist($faire, $type, $id, $qui, $opt){
	return true;
}


/**
 * Ajout de l'onglet Ajouter les plugins dont l'url depend du l'existence ou pas d'un depot
 * de plugins
 *
 * @param array $flux
 * @return array
 */
function svp_ajouter_onglets($flux){
    if ($flux['args']=='plugins') {
		$compteurs = svp_compter('depot');
		$page = ($compteurs['depot'] == 0) ? 'depots' : 'charger_plugin';
        $flux['data']['charger_plugin']= new Bouton(
												find_in_theme('images/plugin-add-24.png'),
												'plugin_titre_automatique_ajouter',
												generer_url_ecrire($page));
	}
    return $flux;
}


/**
 * On affiche dans les boucles (PLUGINS) (DEPOTS) et (PAQUETS)
 * que les distants par defaut
 * Utiliser {tout} pour tout avoir.
 *
 * @param 
 * @return 
**/
function svp_pre_boucle($boucle) {

	// DEPOTS, PAQUETS
	// Pour DEPOTS, on n'a jamais id_depot=0 dedans... donc... pas la peine.
	if (
		$boucle->type_requete == 'paquets'
		# OR $boucle->type_requete == 'depots'
	) {
		$id_table = $boucle->id_table;
		$m_id_depot = $id_table .'.id_depot';
		// Restreindre aux depots distants
		if (
			#!isset($boucle->modificateur['criteres']['id_depot']) && 
			!isset($boucle->modificateur['tout'])) {
				$boucle->where[] = array("'>'", "'$m_id_depot'", "'\"0\"'");				
		}
	}
	// PLUGINS
	elseif ($boucle->type_requete == 'plugins') {
		$id_table = $boucle->id_table;
		/*
		// les modificateurs ne se creent que sur les champs de la table principale
		// pas sur une jointure, il faut donc analyser les criteres passes pour
		// savoir si l'un deux est un 'id_depot'...

		$id_depot = false;
		foreach($boucle->criteres as $c){
			if (($c->op == 'id_depot') // {id_depot} ou {id_depot?}
			OR ($c->param[0][0]->texte == 'id_depot')) // {id_depot=x}
			{
				$id_depot = true;
				break;
			}
		}
		*/
		if (
		#	!$id_depot && 
			!isset($boucle->modificateur['tout'])) {
				// Restreindre aux mots cles non techniques
				$boucle->from["depots_plugins"] =  "spip_depots_plugins";
				$boucle->where[] = array("'='", "'depots_plugins.id_plugin'", "'$id_table.id_plugin'");
				$boucle->where[] = array("'>'", "'depots_plugins.id_depot'", "'\"0\"'");
		}
	}

	
	return $boucle;

}
?>
