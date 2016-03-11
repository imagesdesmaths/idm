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
		'associer_champ',
		'supprimer_champ'))){
			include_spip('inc/minipres');
			echo minipres(_T('iextras:erreur_action',array("action"=>$arg)));
			exit;		
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


// definir un champ SQL existant comme un champ extra a prendre
// en compte par ce plugin
function action_associer_champ_sql_comme_champ_extra($table, $champ){
	// recuperer la description du champ
	include_spip('inc/cextras');
	include_spip('inc/iextras');
	$champs = extras_champs_anormaux();
	if (isset($champs[$table][$champ])) {
		
		$sql = $champs[$table][$champ];
		$saisies = iextras_champs_extras_definis($table);
		
		include_spip('inc/saisies');
		$saisies_sql = saisies_lister_disponibles_sql();
		
		$type_saisie =  'textarea';
		
		$saisies = saisies_inserer($saisies, array(
			'saisie' => $type_saisie,
			'options' => array_merge(
				$saisies_sql[$type_saisie]['defaut']['options'], array(
					'nom' => $champ,
					'label' => ucfirst($champ)
		))));

		// sauver
		ecrire_meta('champs_extras_' . $table, serialize($saisies));
		
		// supprimer la session d'edition du formulaire pour le remettre a zero
		session_set('constructeur_formulaire_champs_extras_' . $table, null);
	}	
}

// suppression de la base d'un champ d'une table donnee.
function action_supprimer_champ_sql($table, $champ) {
	// recuperer les descriptions
	// pour verifier que le champ n'est pas declare par quelqu'un
	include_spip('inc/cextras');
	$champs = extras_champs_anormaux();
	if (isset($champs[$table][$champ])) {
		// suppression
		extras_log("Suppression du champ $table/$champ par auteur ".$GLOBALS['auteur_session']['id_auteur'],true);
		
		sql_alter("TABLE $table DROP COLUMN ".$champ);			
	}
}