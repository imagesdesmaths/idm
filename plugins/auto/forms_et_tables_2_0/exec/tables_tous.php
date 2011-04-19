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

include_spip('inc/forms_tables_affichage');

function exec_tables_tous(){
	echo afficher_tables_tous('table',_T("table:toutes_tables"),_T("table:type_des_tables"),_T("table:icone_creer_table"));
}

?>