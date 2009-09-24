<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/iextras');
include_spip('inc/cextras_gerer');

function formulaires_editer_champ_extra_charger_dist($id_extra='new', $redirect=''){
	// nouveau ?
	$new = ($id_extra == 'new') ? ' ': '';
	
	// valeur par defaut (on utilise les valeurs d'un champ vide)
	$c = new ChampExtra;
	$valeurs = array_merge($c->toArray(), array(
		'id_extra' => $id_extra,
		'new' => $new,
		'redirect' => $redirect,
	));
	// valeur par defaut tout de meme sur sql et pour saisie
	if (!$valeurs['sql']) $valeurs['sql'] = "text NOT NULL DEFAULT ''";
	if (!$valeurs['type']) $valeurs['type'] = "ligne";
	
	// si un extra est demande (pour edition)
	// remplir les valeurs avec infos de celui-ci
	if (!$new) {
		$extra = iextra_get_extra($id_extra);
		$valeurs = array_merge($valeurs, $extra->toArray());
	}
	return $valeurs;
}


function formulaires_editer_champ_extra_verifier_dist($id_extra='new', $redirect=''){
	$erreurs = array();
	
	// nouveau ?
	$new = ($id_extra == 'new') ? ' ': '';	
	
	// recuperer les valeurs postees
	$extra = iextras_post_formulaire();
	
	// pas de champ vide
	foreach(array('champ', 'table', 'type', 'label', 'sql') as $c) {
		if (!$extra[$c]) {
			$erreurs[$c] = _T('iextras:veuillez_renseigner_ce_champ');
		}
	}
	
	// 'champ' correctement ecrit
	if ($champ = trim($extra['champ'])) {
		if (!preg_match('/^[a-zA-Z0-9_-]+$/',$champ)) {
			$erreurs['champ'] = _T('iextras:caracteres_interdits');
		}
	}
	
	// si nouveau champ, ou modification du nom du champ
	// verifier qu'un champ homonyme 
	// n'existe pas deja sur la meme table
	$verifier = false;
	if (!$new) {
		$ancien = iextra_get_extra($id_extra);
		if (($ancien->champ != $champ) or ($ancien->table != $extra['table'])) {
			$verifier = true;
		}
	}
	if ($new or $verifier) {	
		$table = table_objet_sql($extra['table']);
		$desc = sql_showtable($table);
		if (isset($desc['field'][$champ])) {
			$erreurs['champ'] = _T('iextras:champ_deja_existant');
		}
	}
	
	return $erreurs;
}


function formulaires_editer_champ_extra_traiter_dist($id_extra='new', $redirect=''){
	// nouveau ?
	$new = ($id_extra == 'new') ? ' ': '';
		
	// recuperer les valeurs postees
	$extra = iextras_post_formulaire();

	// recreer le tableau de stockage des extras
	$extras = iextras_get_extras();

	// ajout du champ ou modification du champ extra de meme id.
	$extra = new ChampExtra($extra);
	if ($new) {
		$extras[] = $extra;
	} else {
		foreach($extras as $i=>$e) {
			if ($e->get_id() == $id_extra) {
				$extras[$i] = $extra;
				break;
			}
		}		
	}

	// l'enregistrer
	iextras_set_extras($extras);
	
	// creer le champ s'il est nouveau :
	if ($new) {
		creer_champs_extras($extra);
		extras_log("Creation d'un nouveau champ par auteur ".$GLOBALS['auteur_session']['id_auteur'],true);
		extras_log($extra, true);

	}
	
	$res = array(
		'editable' => true,
		'message_ok' => _T('iextras:champ_sauvegarde'),
	);
	if ($redirect) $res['redirect'] = $redirect;

	return $res;
}

// recuperer les valeurs postees par le formulaire
function iextras_post_formulaire() {
	$extra = array();
	foreach(array('champ', 'table', 'type', 'label', 'sql', 'precisions', 'obligatoire', 'enum', 'rechercher') as $c) {
		$extra[$c] = _request($c);
	}
	return $extra;	
}

?>
