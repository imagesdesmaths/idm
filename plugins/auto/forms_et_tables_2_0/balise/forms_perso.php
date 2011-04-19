<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * ??? 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

include_spip('balise/forms');
global $balise_FORMS_PERSO_collecte;
$balise_FORMS_PERSO_collecte = array('id_form','id_article','id_donnee', 'id_donnee_liee');

function balise_FORMS_PERSO ($p) {
	return calculer_balise_dynamique($p,'FORMS', array('id_form', 'id_article', 'id_donnee','id_donnee_liee'));
}

function balise_FORMS_PERSO_stat($args, $filtres) {
	return $args;
}

?>