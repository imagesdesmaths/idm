<?php

function photo_infos_pave($args) {
	if ($args["args"]["type"] == "case_document") {
		$args["data"] .= recuperer_fond("pave_exif",
			array('id_document' => $args["args"]["id"]));;
	}
	return $args;
}

?>
