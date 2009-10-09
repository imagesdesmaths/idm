<?php

function gestdoc_modalbox_insert_head($flux){
	// Insertion des librairies js
	$flux .='<script src="'.find_in_path('modalbox/jquery.simplemodal-1.3-b1.js').'" type="text/javascript"></script>';
	$flux .='<script src="'.find_in_path('modalbox/modalbox.js').'" type="text/javascript"></script>';

	return $flux;
}

?>
