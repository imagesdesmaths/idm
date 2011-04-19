<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/presentation');
include_spip('inc/rubriques');

// http://doc.spip.org/@exec_config_multilang_dist
function exec_config_multilang_dist()
{

	if (!autoriser('configurer', 'multilang')) {
		include_spip('inc/minipres');
		echo minipres();
	} else {

	$config = charger_fonction('config', 'inc');
	$config();

	pipeline('exec_init',array('args'=>array('exec'=>'config_multilang'),'data'=>''));
	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('titre_page_config_contenu'), "configuration", "langues");

	echo debut_gauche('', true);
	
	echo pipeline('affiche_gauche',array('args'=>array('exec'=>'config_multilang'),'data'=>''));
	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite',array('args'=>array('exec'=>'config_multilang'),'data'=>''));
	echo debut_droite('', true);

	echo "<br /><div style='text-align: center'>", 
	  gros_titre(_T('info_langues'),'', false),
	  '</div><br />',
	  barre_onglets("config_lang", "multi"),
	  '<br />';

	$referenceur = charger_fonction('referenceur', 'configuration');
	echo $referenceur();

	if ($GLOBALS['meta']['multi_articles'] == "oui"
	OR $GLOBALS['meta']['multi_rubriques'] == "oui"
	OR count(explode(',',$GLOBALS['meta']['langues_utilisees'])) > 1) {
		$locuteur = charger_fonction('locuteur', 'configuration');
		echo $locuteur();
	}

	echo fin_gauche(), fin_page();
	}
}
?>
