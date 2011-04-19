<?php

if (!defined("_ECRIRE_INC_VERSION")) return;	#securite

include_spip('base/abstract_sql');

function balise_FORMS_TEXTE_REPONDU_TITRE ($p) {
  return calculer_balise_dynamique($p,'FORMS_TEXTE_REPONDU_TITRE',array());
}

function balise_FORMS_TEXTE_REPONDU_TITRE_stat($args, $filtres) {
	return $args;
}
function balise_FORMS_TEXTE_REPONDU_TITRE_dyn($valeur='',$texte='',$texte_autres='') {
	
	if (!$GLOBALS['auteur_session']) return $texte_autres;
	$id_auteur=$GLOBALS['auteur_session']['id_auteur'];
	$q="SELECT id_donnee FROM spip_forms_donnees as donnees,spip_forms as forms " .
	"WHERE forms.id_form=donnees.id_form " .
	"AND forms.titre='".addslashes($valeur)."' " .
	"AND id_auteur=".$id_auteur;
	$r=spip_query($q);
	//adaptation SPIP2
	//if (spip_num_rows($r)>0) return $texte;
	if (sql_count($r)>0) return $texte;
	else return $texte_autres;
}
?>