<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Gestion des puces d'action rapide de formulaires
 *
 * @package SPIP\Formidable\Puce_statut
**/

include_spip('inc/presentation');

/**
 * Gestion de l'affichage ajax des puces d'action rapide de formulaires
 *
 * Récupère l'identifiant id et le type d'objet dans les données postées
 * et appelle la fonction de traitement de cet exec.
 * 
 * @see exec_puce_statut_formulaires_args()
 * @return string Code HTML
**/
function exec_puce_statut_formulaires_dist()
{
	exec_puce_statut_formulaires_args(_request('id'),  _request('type'));
}

/**
 * Traitement de l'affichage ajax des puces d'action rapide
 *
 * Appelle la fonction de traitement des puces statuts
 * après avoir retrouvé le statut en cours de l'objet
 * et son parent s'il en a un
 * 
 * @param int $id
 *     Identifiant de l'objet
 * @param string $type
 *     Type d'objet
 * @return string Code HTML
**/
function exec_puce_statut_formulaires_args($id, $type)
{
	if (in_array($type,array('formulaires','formulaires_reponse'))) {
		$table = table_objet_sql($type);
		$prim = id_table_objet($type);
		$id = intval($id);
		$r = sql_fetsel("id_formulaire,statut", "$table", "$prim=$id");
		$statut = $r['statut'];
		$id_formulaire = $r['id_formulaire'];
	} else {
		$id_formulaire = intval($id);
		$statut = 'prop'; // arbitraire
	}
	$puce_statut = charger_fonction('puce_statut', 'inc');
	ajax_retour($puce_statut($id,$statut,$id_formulaire,$type, true));
}

?>
