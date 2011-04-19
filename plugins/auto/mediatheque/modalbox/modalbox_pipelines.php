<?php

function medias_modalbox_insert_head($flux){
	if (!defined('_DIR_PLUGIN_MEDIABOX')) {
		// Insertion des librairies js
		$flux .='<script src="'.find_in_path('modalbox/jquery.simplemodal-1.3.3.js').'" type="text/javascript"></script>';
		$flux .='<script src="'.find_in_path('modalbox/modalbox.js').'" type="text/javascript"></script>';
	}

	return $flux;
}

?>
