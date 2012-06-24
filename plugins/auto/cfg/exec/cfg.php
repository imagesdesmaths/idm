<?php

/**
 * Plugin générique de configuration pour SPIP
 *
 * @license    GNU/GPL
 * @package    plugins
 * @subpackage cfg
 * @category   outils
 * @copyright  (c) toggg, marcimat 2007-2008
 * @link       http://www.spip-contrib.net/
 * @version    $Id: cfg.php 36735 2010-03-28 21:25:09Z gilles.vincent@gmail.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * la fonction appelee par le core, une simple "factory" de la classe cfg
 *
 * @param mixed $class # inutilisé
 */
function exec_cfg_dist($class = null)
{
	include_spip('inc/filtres');
	include_spip('inc/cfg');
	$config = new cfg(
		($nom = sinon(_request('cfg'), '')),
		($cfg_id = sinon(_request('cfg_id'),''))
		);
	
	// traitements du formulaire poste
	// seulement s'il provient d'un formulaire CFG
	// et non d'un formulaire CVT dans un fond CFG
	if (_request('arg'))
		$config->traiter();
	
	//
	// affichages
	//
	include_spip("inc/presentation");

	if (!$config->autoriser()) {
		echo $config->acces_refuse();
		exit;
	}

	pipeline('exec_init',array('args'=>array('exec'=>'cfg'),'data'=>''));

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page($config->get_boite(), 'cfg', $config->get_nom());
	echo "<br /><br /><br />\n";

	echo gros_titre(sinon($config->get_titre(), _T('cfg:configuration_modules')), '', false);	
	echo $config->barre_onglets();
	
	// colonne gauche
	echo debut_gauche('', true);

	// si un formulaire cfg est demande
	if ($s = $config->descriptif()) echo debut_boite_info(true) . $s . fin_boite_info(true);
	
	// affiche éventuellement une colonne supplémentaire à gauche
	if ($s = $config->gauche()) echo debut_boite_info(true) . $s . fin_boite_info(true);
	
	echo pipeline('affiche_gauche',array('args'=>array('exec'=>'cfg'),'data'=>''));
	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite',array('args'=>array('exec'=>'cfg'),'data'=>''));
		
	// affichage des messages envoyes par cfg
	if ($s = $config->messages()) echo debut_boite_info(true) . $s . fin_boite_info(true);

	// affichage des liens
	if ($s = $config->liens()) echo debut_boite_info(true) . $s . fin_boite_info(true);
	if ($s = $config->liens_multi()) echo debut_boite_info(true) . $s . fin_boite_info(true);
	
	echo debut_droite("", true);
	
	// centre de la page	
	if ($config->get_presentation() == 'auto') {
		echo debut_cadre_trait_couleur('', true, '', $config->get_boite());
		echo $config->formulaire();
		echo fin_cadre_trait_couleur(true);
	} else {
		echo $config->formulaire();
	}

	// pied
	echo fin_gauche() . fin_page();
}

?>
