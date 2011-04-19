<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * © 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

function exec_forms_lier_donnees(){
	$type = _request('type');
	if (!preg_match(',[\w]+,',$type))
		$type = 'article';
	$id = _request("id_$type");
	$forms_lier_donnees = charger_fonction('forms_lier_donnees','inc');
	$out = $forms_lier_donnees($type,$id, _request('script'), true);
	ajax_retour($out);
}

?>