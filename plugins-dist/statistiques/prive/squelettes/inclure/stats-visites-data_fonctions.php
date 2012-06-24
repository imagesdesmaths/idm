<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/acces');
include_spip('inc/statistiques');

function duree_zoom($duree,$sens='plus'){
	$largeur_abs = 420/$duree;

	if ($largeur_abs > 1) {
		$inc = ceil($largeur_abs / 5);
		$duree_plus = round(420 / ($largeur_abs - $inc));
		$duree_moins = round(420 / ($largeur_abs + $inc));
	}

	if ($largeur_abs == 1) {
		$duree_plus = 840;
		$duree_moins = 210;
	}

	if ($largeur_abs < 1) {
		$duree_plus = round(420 * ((1/$largeur_abs) + 1));
		$duree_moins = round(420 * ((1/$largeur_abs) - 1));
	}
	return ($sens=='plus'?$duree_moins:$duree_plus);
}

function stats_total($serveur=''){
	$row = sql_fetsel("SUM(visites) AS total_absolu", "spip_visites",'','','','','',$serveur);
	return $row ? $row['total_absolu'] : 0;
}