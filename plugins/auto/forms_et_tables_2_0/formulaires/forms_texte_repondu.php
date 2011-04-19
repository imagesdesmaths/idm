<?php

if (!defined("_ECRIRE_INC_VERSION")) return;	#securite

include_spip('base/abstract_sql');

function balise_FORMS_TEXTE_REPONDU ($p) {
  return calculer_balise_dynamique($p,'FORMS_TEXTE_REPONDU',array('id_form'));
}

function balise_FORMS_TEXTE_REPONDU_stat($args, $filtres) {
	return $args;
}
function balise_FORMS_TEXTE_REPONDU_dyn($id_form, $texte='',$texte_autres='') {
	include_spip('inc/forms');
	if (Forms_verif_cookie_sondage_utilise($id_form)) return $texte;
	else return $texte_autres;
}
?>