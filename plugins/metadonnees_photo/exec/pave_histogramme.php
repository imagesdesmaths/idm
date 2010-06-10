<?php


function exec_pave_histogramme() {
	echo recuperer_fond("inc_histogramme_small",
		array('id_document' => _request('id_document')));
}		


?>