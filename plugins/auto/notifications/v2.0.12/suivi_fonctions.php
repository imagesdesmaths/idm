<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

if (!$GLOBALS['visiteur_session']['id_auteur']) {
	include_spip('inc/headers');
	redirige_par_entete(parametre_url(generer_url_public('login'), 'url', self(), '&'));
} else {
	// Si l'auteur a un email valide, on lui reaffecte tous les forums
	// signes de son email
	// -> faille secu : combine au changement d'email, cela permet de 'voler'
	// tous les forums de quelqu'un :
	// 1/ A (auteur loge) change mon email pour celui de B qui n'a pas de compte
	// 2/ A revient sur cette page et tous les forums de B lui sont associes
	// 3/ A reprend son email d'origine et depossede B de tous ses forums
	//    (l'email de B reste dans la table, mais id_auteur utilise en priorite)
	if (strlen($GLOBALS['visiteur_session']['email'])) {
		include_spip('base/abstract_sql');
		#sql_update('spip_forum', array('id_auteur' => $GLOBALS['visiteur_session']['id_auteur']), 'id_auteur=0 AND email_auteur='.sql_quote($GLOBALS['visiteur_session']['email']));
	}

}

?>
