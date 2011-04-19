<?php
/**
 * Plugin Corbeille 2.0
 * La corbeille pour Spip 2.0
 * Collectif
 * Licence GPL
 */

function exec_corbeille_dist(){
	if (!autoriser('administrer','corbeille')){
		include_spip('inc/minipres');
		echo minipres(_T('ecrire:avis_acces_interdit'));		
	}
	
	$commencer_page = charger_fonction('commencer_page','inc');
	echo $commencer_page(_T('corbeille:corbeille'),'configuration');

	echo debut_gauche('',true);
	echo debut_boite_info(true);
	echo propre(_T('corbeille:readme'));  	
	echo fin_boite_info(true);

	echo debut_droite('',true);
	echo gros_titre(_T('corbeille:corbeille'),'',false);


	echo formulaire_recherche('corbeille');
	// recuperer toutes les noisettes d'admin existantes
	$liste = find_all_in_path("prive/listes/","/corbeille_[^.]*[.]html");
	foreach ($liste as $noisette) {
		if (preg_match(',^corbeille_([^.]*)$,',basename($noisette,'.html'),$regs)){
			$table = $regs[1];
			echo recuperer_fond("prive/inc-corbeille",array_merge($_GET,array('table'=>$table)));
		}
	}

	echo fin_gauche(),fin_page();
}

?>