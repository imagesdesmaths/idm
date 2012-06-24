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
 * @version    $Id: config.php 53409 2011-10-13 20:42:57Z yffic@lefourneau.com $
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Le controlleur de CFG
 *
 * @param Array $regs
 * @return Array
 */
function controleurs_config_dist($regs) {
    list(,$crayon,$type,$champ,$id) = $regs;
	// evidemment, pour CFG, on recupere pas tout a fait ce qu'on souhaite...
	// retraduire depot___plugin__casier__cle en depot::plugin/casier/cle
	include_spip('cfg_fonctions');
	$config = cfg_crayon2config($champ);
	$val = lire_config($config);
    if ($val === null) {
	    return array("$type $config: " . _U('crayons:pas_de_valeur'), 6);
    }
    
    $valeur = array('config' => $val);
	$n = new Crayon($crayon, $valeur);
	
	$contexte = array();
    if (is_string($val) and preg_match(",[\n\r],", $val))
		$contexte['config'] = array('type'=>'texte');
	else
		$contexte['config'] = array('type'=>'ligne');
		
    $html = $n->formulaire($contexte);
    include_spip('action/crayon_html');
    $html = crayons_formulaire($html, 'crayons_config_store');
    $status = NULL;

	return array($html, $status);

}


?>
