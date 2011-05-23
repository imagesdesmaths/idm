<?php
function genie_fulltext_index_document_dist($t) {
	// Ne retenir que les 50 premiers ko
	@define('_FULLTEXT_TAILLE',50000);

	$nb_docs = 5;
	if ($docLists = sql_select("*", "spip_documents", "extrait = 'non'", "", "maj", "0,".intval($nb_docs+1))) {
		while($nb_docs-- AND $row = sql_fetch($docLists)) {
			$extension = $row['extension'];
			$doc = $row['fichier'];
      		spip_log('Indexation de '.$doc, 'extract');
			global $extracteur;
			if (include_spip('extract/'.$extension)
				AND function_exists($lire = $extracteur[$extension])) {
				include_spip('inc/distant');
				include_spip('inc/documents');
				if (!$fichier = copie_locale(get_spip_doc($row['fichier']), 'test')) {
					spip_log('Pas de copie locale de '.$row['fichier'], 'extract');
					return;
				}
				// par defaut, on pense que l'extracteur va retourner ce charset
				$charset = 'iso-8859-1';
				// lire le contenu
				$contenu = $lire(_DIR_RACINE.$fichier, $charset);
				if (!$contenu) {
					spip_log('Echec de l\'extraction de '.$fichier, 'extract');
					sql_updateq("spip_documents", array('contenu' => '', 'extrait' => 'err'), "id_document=".intval($row['id_document']));
				} else {
					$contenu = substr($contenu, 0, _FULLTEXT_TAILLE);
					// importer le charset
					include_spip('inc/charsets');
					$contenu = importer_charset($contenu, $charset);
					sql_updateq("spip_documents", array('contenu' => $contenu, 'extrait' => 'oui'), "id_document=".intval($row['id_document']));
				}
			}
			else {
				// inutile de parcourir un par un tous les docs avec la meme extension !
				sql_updateq('spip_documents', array('contenu' => '', 'extrait' => 'err'),"extrait = 'non' AND extension=".sql_quote($extension));
				spip_log("Impossible d'indexer tous les .$extension", 'extract');
			}
		}
		if ($row = sql_fetch($docLists)){
			spip_log("il reste des docs a indexer...", 'extract');
			return 0-$t; // il y a encore des docs a indexer
		}
	}
	return 0;
}
?>