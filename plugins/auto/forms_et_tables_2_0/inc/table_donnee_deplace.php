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

include_spip("inc/presentation");
include_spip("inc/layer");
include_spip("base/forms");
include_spip("inc/forms");
include_spip("public/assembler");

function inc_table_donnee_deplace_dist($id_donnee,$id_form){
	$contexte = array('id_form'=>$id_form,'id_donnee'=>$id_donnee);
	$res = recuperer_fond("fonds/table_sort",$contexte);
	return $res;
}

?>