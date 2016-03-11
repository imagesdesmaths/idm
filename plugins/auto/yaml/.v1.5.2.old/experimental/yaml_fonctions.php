<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

function yaml_article($id_article) {
	include_spip('inc/yaml');
	$a = array_filter(sql_fetsel('*', 'spip_articles', 'id_article='.$id_article));
	$a['rubrique'] = array_filter(sql_fetsel('*', 'spip_rubriques', 'id_rubrique='.$a['id_rubrique']));

	foreach(sql_allfetsel('*', 'spip_mots AS m LEFT JOIN spip_mots_articles AS c ON m.id_mot=c.id_mot', 'c.id_article='.$id_article) as $m)
		$a['mots'][] = array_filter($m);

	return yaml_encode(
		array_filter($a)
		);
}