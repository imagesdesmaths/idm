<?php
/**
 * Plugin Corbeille 3.0
 * La corbeille pour Spip 3.0
 * Collectif
 * Licence GPL
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Parametres de configuration personnalisables/surchargeables de la corbeille :
 * global $corbeille_params;
 * 
 * $corbeille_params["nom de l'objet SPIP"] = array (
 * 			[voir la structure ci-dessous] 
 * );
 * 
 * la fonction corbeille_table_infos($objet) renverra :
 *		- si $objet==-1, la liste des objets renseignes
 * 		- sinon, la globale $corbeille_params[$objet] si elle existe
 * 		- sinon, la valeur par defaut $param[$objet] si elle existe
 * 		- sinon, false
 * 
 * "nom de l'objet spip" => array (
 * 			"statut" => nom du statut dans la base de donnees (bdd),
 * 			"table" => nom eventuel de la table, pour definir plusieurs noisettes avec une meme table mais des statuts differents
 * 			"tableliee"  => tableau des tables spip a vider en meme temps 
 * )
 * 
 * @param string $table
 * @return array
 */
function corbeille_table_infos($table=-1){
	global $corbeille_params;
	if (!is_array($corbeille_params))
		$corbeille_params = array();
	if (isset($corbeille_params[$table]))
		return $corbeille_params[$table];

	$param = array (
		"articles" => array(
			"statut" => "poubelle",
			"tableliee"=> array("spip_auteurs_articles","spip_documents_liens","spip_mots_articles","spip_signatures","spip_versions","spip_versions_fragments","spip_forum"),
		),
		"auteurs" => array(
			"statut" => "5poubelle",
			"tableliee"=> array("spip_documents_liens"),
		),					
		"breves"=> array(
			"statut" => "refuse",
			"tableliee"=> array("spip_documents_liens"),
		),
		"forums_publics" => array(
			"statut" => "off",
			"table"=>"forum",
		),
		"forums_prives" => array(
			"statut" => "privoff",
			"table"=>"forum",
		),
		"signatures"=> array(
			"statut" => "poubelle", 
		),
		"sites" => array(
			"statut" => "refuse",
			"tableliee"=> array("spip_syndic_articles","spip_mots_syndic","spip_documents_liens"),
		),
	);
	$param = pipeline('corbeille_table_infos', $param);
	
	if (isset($param[$table]))
		return $param[$table];
	if ($table==-1) 
		return array_merge(array_keys($corbeille_params), array_keys($param));
	return false;
}

/**
 * supprime les elements listes d'un type donne
 *
 * @param nom $table
 * @param tableau $ids
 * @return $ids trouves (sinon false)
 */
function corbeille_vider($table, $ids=array()) {
	include_spip('base/abstract_sql');
	$params = corbeille_table_infos($table);
	if (isset($params['table']))
		$table = $params['table'];
	
	$type = objet_type($table);
	$table_sql = table_objet_sql($type);
	$id_table = id_table_objet($type);

	$statut = $params['statut'];
	if (!$statut)
		return false;

	// determine les index des elements a supprimer
	if ($ids===-1) {
		// recupere les identifiants des objets a supprimer
		$ids = array_map('reset',sql_allfetsel($id_table,$table_sql,'statut='.sql_quote($statut)));
	}
	else {
		// verifions les ids qui existent vraiment
		$ids = array_map('reset',sql_allfetsel($id_table,$table_sql,sql_in($id_table,$ids).' AND statut='.sql_quote($statut)));
	}
	if (!count($ids))
		return false;
		

	// supprime les elements definis par la liste des index
	sql_delete($table_sql,sql_in($id_table,$ids));
	// suppresion des elements lies
	if ($table_liee=$params['tableliee']) {
		$trouver_table = charger_fonction('trouver_table','base');
		foreach($table_liee as $unetable) {
			$desc = $trouver_table($unetable);
			if (isset($desc['field'][$id_table]))
				sql_delete($unetable,sql_in($id_table,$ids));
			elseif(isset($desc['field']['id_objet']) AND isset($desc['field']['objet']))
				sql_delete($unetable,sql_in('id_objet',$ids)." AND objet=".sql_quote($type));		
		}
	}
	return $ids;
}

?>
