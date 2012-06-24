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
 * @version    $Id: type_idnum.php 36735 2010-03-28 21:25:09Z gilles.vincent@gmail.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 *
 * @param string $champ
 * @param Object $cfg
 * @return string
 */
function cfg_verifier_type_idnum($champ, &$cfg){
	if (!is_numeric($cfg->val[$champ])){
		$cfg->ajouter_erreur(_T('cfg:erreur_type_idnum', array('champ'=>$champ)));
	}
	return true;
}

/**
 *
 * @param string $champ
 * @param Object $cfg
 * @return string
 */
function cfg_pre_traiter_type_idnum($champ, &$cfg){
	$cfg->val[$champ] = intval($cfg->val[$champ]);
	return true;
}

?>
