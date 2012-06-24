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
 *
 * @param mixed $type # inutilisé
 * @param mixed $modele # inutilisé
 * @param mixed $id # inutilisé
 * @param Array $content 
 * @return string 
 */
function vues_config_dist($type, $modele, $id, $content) {
	return propre($content['config']);
}

?>
