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
 * @version    $Id: cfg_id.php 36735 2010-03-28 21:25:09Z gilles.vincent@gmail.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * apres que le parseur a trouve les champs
 *
 * @param string $nom
 * @param Object $cfg
 * @return string
 */
function cfg_pre_charger_cfg_id($nom, &$cfg){

	// id a renseigner
	$cfg->champs[$nom]['id'] = count($cfg->champs_id);
	$cfg->champs_id[] = $nom;	

	// Cas des champs multi, si des champs (Y)
	// sont declares id par la classe cfg_id,
	// <input type='x' name='Yn' class='cfg_id'>
	// on les ajoute dans le chemin pour retrouver les donnees
	// #CONFIG{.../y1/y2/y3/...}
	// 
	if (_request('_cfg_affiche')) {
		$cfg->param['cfg_id'] = implode('/', array_map('_request', $cfg->champs_id));
	} 
	    
	return true;
}

/**
 *
 * @param string $nom
 * @param Object $cfg
 * @return string
 */
function cfg_pre_traiter_cfg_id($nom, &$cfg){
	
	// lorsque c'est un champ de type multi que l'on modifie 
	// et si l'identifiant a change,  il faut soit le copier, soit de deplacer
	//
	// pour ca, on compare le hidden name='cfg_id' aux champs editables 
	// qui ont la classe css 'cfg_id'
	if ($cfg->champs_id) {
		$new_id = implode('/', array_map('_request', $cfg->champs_id));
		if ($new_id != $cfg->param['cfg_id']){
			// si c'est un deplacement, on efface
			if (!_request('_cfg_copier')) {
				// et ne pas perdre les valeurs suite a l'effacement dans ce cas precis
				$vals = $cfg->val;
				$cfg->effacer();
				$cfg->val = $vals;
			}
			$cfg->param['cfg_id'] = $new_id;
			// recreer un depot avec le nouvel identifiant 
			// (sinon les requetes ne creent pas les bons 'where')
			include_spip('inc/cfg_config');
			$cfg->depot = new cfg_depot($cfg->param['depot'], $cfg->params);
			// recharger le formulaire avec le nouvel identifiant (sinon les parametres 
			// <!-- param=valeur --> de formulaires qui contienent 
			// #ENV{cfg_id} ou #ENV{id} ne sont pas a jour)
			$cfg->formulaire();
		}
	}	
	
	return true;
}

?>
