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
 * @version    $Id: type_pwd.php 36735 2010-03-28 21:25:09Z gilles.vincent@gmail.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * 
 * @param string $champ
 * @param Object $cfg
 * @return string
 */
function cfg_verifier_type_pwd($champ, &$cfg) {
	if (strlen($cfg->val[$champ]) < 5){
		$cfg->ajouter_erreur($champ, _T('cfg:erreur_type_pwd', array('champ'=>$champ)));
	}
	return true;
}


?>
