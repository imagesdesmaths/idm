<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

function action_iextras_dist() {
	$securiser_action = charger_fonction('securiser_action', 'inc');
	$arg = $securiser_action();
	
	// droits
	include_spip('inc/autoriser');
	if (!autoriser('configurer', 'iextra')) {
		include_spip('inc/minipres');
		echo minipres();
		exit;
	}
	
	@list($arg, $id_extra_ou_table, $champ) = explode ('/', $arg);
	
	// actions possibles
	if (!in_array($arg, array(
		'monter_extra',
		'descendre_extra',
		'supprimer_extra',
		'desassocier_extra',
		'associer_champ',
		'supprimer_champ'))){
			include_spip('inc/minipres');
			echo minipres(_T('iextras:erreur_action',array("action"=>$arg)));
			exit;		
	}

	// cas de monter
	if (($arg == 'monter_extra') and $id_extra = $id_extra_ou_table){
		action_monter_champ_extra($id_extra);
	}
	
	// cas de descente
	if (($arg == 'descendre_extra') and $id_extra = $id_extra_ou_table){
		action_descendre_champ_extra($id_extra);
	}
			
	// cas de suppression
	if (($arg == 'supprimer_extra') and $id_extra = $id_extra_ou_table){
		action_supprimer_champ_extra($id_extra);
	}

	// cas de desassociation
	if (($arg == 'desassocier_extra') and $id_extra = $id_extra_ou_table){
		action_desassocier_champ_extra($id_extra);
	}
	
	// cas de l'association d'un champ existant
	if (($arg == 'associer_champ') and ($table = $id_extra_ou_table) and $champ){
		$extra_id = action_associer_champ_sql_comme_champ_extra($table, $champ);
	}

	// cas de la suppression d'un champ existant
	if (($arg == 'supprimer_champ') and ($table = $id_extra_ou_table) and $champ){
		action_supprimer_champ_sql($table, $champ);
	}
}


// remonter d'un cran un champ extra
function action_monter_champ_extra($extra_id) {
	include_spip('inc/iextras');
	$extras = iextras_get_extras_tries_par_table();
	foreach($extras as $i=>$extra) {
		if ($extra->get_id() == $extra_id) {
			extras_log("Remonter le champ $extra->table/$extra->champ par auteur ".$GLOBALS['auteur_session']['id_auteur']);
			
			if ($i !== 0) {
				unset($extras[$i]);
				array_splice($extras, $i-1, 0, array($extra));
				iextras_set_extras($extras);
			}
			break;
		}
	}	
}

// descendre d'un cran un champ extra
function action_descendre_champ_extra($extra_id) {
	include_spip('inc/iextras');
	$extras = iextras_get_extras_tries_par_table();
	$total = count($extras);
	foreach($extras as $i=>$extra) {
		if ($extra->get_id() == $extra_id) {
			extras_log("Descendre le champ $extra->table/$extra->champ par auteur ".$GLOBALS['auteur_session']['id_auteur']);
			
			if ($i+1 !== $total) {
				unset($extras[$i]);
				array_splice($extras, $i+1, 0, array($extra));
				iextras_set_extras($extras);
			}
			break;
		}
	}	
}

// suppression d'un champ extra donne
function action_supprimer_champ_extra($extra_id) {
	include_spip('inc/iextras');
	$extras = iextras_get_extras();
	foreach($extras as $i=>$extra) {
		if ($extra->get_id() == $extra_id) {
			extras_log("Suppression d'un champ par auteur ".$GLOBALS['auteur_session']['id_auteur'],true);
			extras_log($extra, true);
			
			include_spip('inc/cextras_gerer');
			vider_champs_extras($extra);
			
			unset($extras[$i]);
			iextras_set_extras($extras);
			break;
		}
	}	
}

// desassocier un champ extra 
// (ne plus le gerer avec le plugin champ extra
// mais ne pas le supprimer de la base de donnee)
function action_desassocier_champ_extra($extra_id) {
	include_spip('inc/iextras');
	$extras = iextras_get_extras();
	foreach($extras as $i=>$extra) {
		if ($extra->get_id() == $extra_id) {
			extras_log("Desassociation du champ $extra->table/$extra->champ par auteur ".$GLOBALS['auteur_session']['id_auteur'],true);
			
			unset($extras[$i]);
			iextras_set_extras($extras);
			break;
		}
	}	
}

// definir un champ SQL existant comme un champ extra a prendre
// en compte par ce plugin
function action_associer_champ_sql_comme_champ_extra($table, $champ){
	// recuperer la description du champ
	include_spip('inc/cextras_gerer');
	include_spip('inc/iextras');
	$champs = extras_champs_anormaux();
	if (isset($champs[$table][$champ])) {
		$sql = $champs[$table][$champ];
		// creer un champ extra avec ce champ
		$extra = new ChampExtra(array(
			'table' => objet_type($table),
			'champ' => $champ,
			'label' => 'label_'.$champ,
			'type' => 'ligne',
			'sql' => $sql,
		));
		// penser a creer une fonction pour ajouter et supprimer un champ...
		// ajout du champ
		extras_log("Ajout d'un champ deja existant par auteur ".$GLOBALS['auteur_session']['id_auteur'],true);
		extras_log($extra, true);
		
		$extras = iextras_get_extras();
		$extras[] = $extra;
		iextras_set_extras($extras);
		
		// retourner extra_id
		return $extra->get_id();
	}	
}

// suppression de la base d'un champ d'une table donnee.
function action_supprimer_champ_sql($table, $champ) {
	// recuperer les descriptions
	// pour verifier que le champ n'est pas declare par quelqu'un
	include_spip('inc/cextras_gerer');
	$champs = extras_champs_anormaux();
	if (isset($champs[$table][$champ])) {
		// suppression
		extras_log("Suppression du champ $table/$champ par auteur ".$GLOBALS['auteur_session']['id_auteur'],true);
		
		$table = table_objet_sql($table);
		sql_alter("TABLE $table DROP ".$champ);			
	}
}

?>
