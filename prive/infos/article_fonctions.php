<?php
function instituer_article($id_article, $id_rubrique, $statut){
	$instituer_article = charger_fonction('instituer_article', 'inc');
	return $instituer_article($id_article, $statut,	$id_rubrique);
}

function bouton_lien_statistiques($visites, $id) {
	if ($visites>0)
		return icone_horizontale(_T('icone_evolution_visites', array('visites' => $visites)), generer_url_ecrire("statistiques_visites","id_article=$id"), "statistiques-24.gif","rien.gif", false);
}

?>
