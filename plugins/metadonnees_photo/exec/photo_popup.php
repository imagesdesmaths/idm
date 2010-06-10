<?php


function exec_photo_popup() {
		include_spip("inc/utils");
		
		$fichier = $_GET["fichier"];
		$fichier = mb_ereg_replace("^"._DIR_IMG, "", $fichier);
		
		$contexte = array('fichier'=>$fichier);

		$p = evaluer_fond("popup_document", $contexte);
		$ret .= $p["texte"];
		
		
		echo $ret;
		
}		


?>