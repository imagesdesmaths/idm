<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function inc_rechercher_joints_formulaires_reponse_formulaires_reponses_champ_dist($table,$table_liee,$ids_trouves, $serveur){

	$cle_depart =  "id_formulaires_reponse";
	$cle_arrivee =  "id_formulaires_reponse";

	$s = sql_select("DISTINCT R.$cle_depart", "spip_formulaires_reponses AS R JOIN spip_formulaires_reponses_champs AS C ON C.id_formulaires_reponse=R.id_formulaires_reponse", sql_in("C.id_formulaires_reponses_champ", $ids_trouves), '','','','',$serveur);

	return array($cle_depart, $cle_arrivee, $s);
}