<?php
// Pour publier directement les messages publics d'auteurs autorises par moderation moderee
function moderation_vip($flux){
	global $visiteur_session;
	include_spip('inc/session');
	if( $visiteur_session
		&& $flux['args']['table']=='spip_forum'
		&& $flux['args']['action']=='instituer'
		&& $flux['data']['statut']!='prive'
		&& defined('_MOD_MOD_'.$visiteur_session['statut'])
	)
		$flux['data']['statut']='publie';
	return $flux;
}
?>