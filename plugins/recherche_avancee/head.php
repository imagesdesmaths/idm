<?php

	function recherche_avancee_insert_head($flux){
	$flux .= 	'<link rel="stylesheet" href="'.find_in_path('recherche_avancee.css').'" type="text/css" media="projection, screen" />';

	return $flux;

	}

?>