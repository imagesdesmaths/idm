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

// http://doc.spip.org/@exec_config_lang_dist
function exec_config_lang_dist()
{ 

	if (!autoriser('configurer', 'lang')) {
		include_spip('inc/minipres');
		echo minipres();
	} else {

	$config = charger_fonction('config', 'inc');
	$config();

	pipeline('exec_init',array('args'=>array('exec'=>'config_lang'),'data'=>''));
	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('titre_page_config_contenu'), "configuration", "langues");

	echo debut_gauche('', true);

	echo debut_droite('', true);

	echo "<br /><div style='text-align: center'>", 
	  gros_titre(_T('info_langues'), '', false),
	  '</div><br />',
	  barre_onglets("config_lang", "langues"),
	  '<br />';
 
	$langue = charger_fonction('langue', 'configuration');
	echo $langue();

	$transcodeur = charger_fonction('transcodeur', 'configuration');
	echo $transcodeur();

	echo fin_gauche(), fin_page();
	}
}
?>
