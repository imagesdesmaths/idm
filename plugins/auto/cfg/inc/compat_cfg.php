<?php

/**
 * Plugin générique de configuration pour SPIP
 *
 * @license    GNU/GPL
 * @package    plugins
 * @subpackage cfg
 * @category   outils
 * @copyright  (c) toggg 2007
 * @link       http://www.spip-contrib.net/
 * @version    $Id: compat_cfg.php 36744 2010-03-29 02:31:19Z gilles.vincent@gmail.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * CFG doit-il être compatible SPIP 1.9.2 ?
 * @ignore
 */
define('_COMPAT_CFG_192', true);

if (version_compare($GLOBALS['spip_version_code'], '11216', '<')
	&& !function_exists('balise_ACTION_FORMULAIRE_dist')) {
		function balise_ACTION_FORMULAIRE_dist($p){
			$p->code="''";
			$p->interdire_scripts = false;
			return $p;
		}
}

/* fichier de compatibilite vers spip 1.9.2 */
if (version_compare($GLOBALS['spip_version_code'], '1.9300', '<')
	AND $f = charger_fonction('compat_cfg', 'inc'))
		$f();

/**
 * Gestion de la compatibilité avec SPIP 1.9.2
 *
 * <b>ceci n'est pas l'original du plugin compat mais la copie pour CFG</b>
 *
 * En termes de distribution ce fichier PEUT etre recopie dans chaque plugin
 * qui desire en avoir une version autonome (voire forkee), A CONDITION DE
 * RENOMMER le fichier et ses deux fonctions ; c'est un peu lourd a maintenir
 * mais c'est le prix a payer pour l'independance des plugins entre eux :-(
 *
 * la version commune a tous est developpee sur
 * {@link http://zone.spip.org/spip-zone/browser/_dev_/compat/ svn://zone.spip.org/spip-zone/_dev_/compat/}
 *
 * @param Array $quoi
 */
function inc_compat_cfg_dist($quoi = NULL) {
	if (!function_exists($f = 'compat_cfg_defs')) $f .= '_dist';
	$defs = $f();

	include_spip('base/abstract_sql');
	
	if (is_string($quoi))
		$quoi = array($quoi);
	else if (is_null($quoi))
		$quoi = array_keys($defs);

	foreach ($quoi as $d) {
		if (!function_exists($d)
		AND isset($defs[$d])) {
			eval ("function $d".$defs[$d]);
		}
	}
}

/**
 * Calcule le tableau de compatibilité des fonctions non définies sous SPIP2.0
 * (fournit leur arbre syntaxique manipulé par le compilo)
 * 
 * @return Array
 */
function compat_cfg_defs_dist() {
	$defs = array(
		// on fait au plus simple pour le journal
		'journal' => 
			'($phrase, $opt = array()) {
				return spip_log($phrase, \'journal\');
			}',
					
		'push' => 
			'($array, $val) {
				if($array == \'\' OR !array_push($array, $val)) return \'\';
				return $array;
			}',
			
		'et' => 
			'($code, $arg) {
				return ((($code) AND ($arg)) ?\' \' :\'\');
			}',
		
		'ou' => 
			'($code, $arg) {
				return ((($code) OR ($arg)) ?\' \' :\'\');
			}',
		
		'xou' => 
			'($code, $arg) {
				return ((($code) XOR ($arg)) ?\' \' :\'\');
			}',
		
		'non' => 
			'($code) {
				return (($code) ?\'\' :\' \');
			}',
			
		'oui' => 
			'($code) {
				return (($code) ?\' \' :\'\');
			}',
		
		'sql_fetch' => 
			'(
				$res, 
				$serveur=\'\'
			) {
				return spip_fetch_array($res);
			}',
		
		'sql_query' => 
			'($res, $serveur=\'\') {
				return spip_query($res);
			}',	
		
		// n'existe pas en 1.9.2
		'sql_alter' => 
			'($res, $serveur=\'\') {
				return spip_query(\'ALTER \' . $res);
			}',	
				
		// n'existe pas en 1.9.2
		// on cree la requete directement
		'sql_delete' => 
			'($table, $where=\'\', $serveur=\'\') {
				if (!is_array($table)) $table = array($table);
				if (!is_array($where)) $where = array($where);
				$query = \'DELETE FROM \'
						. implode(\',\', $table)
						. \' WHERE \'
						. implode(\' AND \', $where);
				return spip_query($query);
			}',
			
		// sql_quote : _q directement
		'sql_quote' => 
			'(
				$val, 
				$serveur=\'\'
			) {
				return _q($val);
			}',	
						
		'sql_select' => 
			'(
				$select = array(), 
				$from = array(), 
				$where = array(),
				$groupby = array(), 
				$orderby = array(), 
				$limit = \'\', 
				$having = array(),
				$serveur=\'\'
			) {
				return spip_abstract_select(
					$select, 
					$from, 
					$where, 
					$groupby, 
					$orderby, 
					$limit, 
					$sousrequete = \'\', 
					$having,
					$table = \'\', 
					$id = \'\', 
					$serveur);
			}',
		
		'sql_fetsel' =>
			'(
				$select = array(), 
				$from = array(), 
				$where = array(),
				$groupby = array(), 
				$orderby = array(), 
				$limit = \'\', 
				$having = array(),
				$serveur=\'\'
			) {
				return sql_fetch(sql_select(
					$select, 
					$from, 
					$where,
					$groupby, 
					$orderby, 
					$limit, 
					$having,
					$serveur				
				));
			}',	
			
		'sql_getfetsel' =>
			'(
				$select, 
				$from = array(), 
				$where = array(),
				$groupby = array(), 
				$orderby = array(), 
				$limit = \'\', 
				$having = array(),
				$serveur=\'\'
			) {
				$r = sql_fetsel(
					$select, 
					$from, 
					$where,
					$groupby, 
					$orderby, 
					$limit, 
					$having,
					$serveur				
				);
				return $r ? $r[$select] : NULL;
			}',
					
		'sql_allfetsel' =>
			'(
				$select, 
				$from = array(), 
				$where = array(),
				$groupby = array(), 
				$orderby = array(), 
				$limit = \'\', 
				$having = array(),
				$serveur=\'\'
			) {
				$q = sql_select(
					$select, 
					$from, 
					$where,
					$groupby, 
					$orderby, 
					$limit, 
					$having,
					$serveur				
				);
				if (!$q) return array();
				$res = array();
				while ($r = sql_fetch($q)) $res[] = $r;
				return $res;
			}',				
		
		// n'existe pas en 1.9.2
		// on cree la requete directement
		'sql_update' => 
			'(
				$table, 
				$champs, 
				$where=\'\', 
				$desc=array(), 
				$serveur=\'\'
			) {
				if (!is_array($table)) 	$table = array($table);
				if (!is_array($champs)) $champs = array($champs);
				if (!is_array($where)) 	$where = array($where);

				$query = $r = \'\';
				foreach ($champs as $champ => $val)
					$r .= \',\' . $champ . "=$val";
				if ($r = substr($r, 1))
					$query = \'UPDATE \'
							. implode(\',\', $table)
							. \' SET \' . $r
							. (empty($where) ? \'\' :\' WHERE \' . implode(\' AND \', $where));
				if ($query)
					return spip_query($query);
			}',

		'sql_updateq' => 
			'(
				$table, 
				$champs, 
				$where=\'\', 
				$desc=array(), 
				$serveur=\'\'
			) {
				if (!is_array($champs)) $exp = array($champs);
				
				foreach ($champs as $k => $val) {
					$champs[$k] = sql_quote($val);
				}
				
				return sql_update(				
					$table, 
					$champs, 
					$where, 
					$desc, 
					$serveur
				);
			}',	
			
		
		// n'existe pas en 1.9.2
		// on cree la requete directement
		'sql_insertq' => 
			'(
				$table,
				$champs
			) {
				if (!is_array($champs)) $exp = array($champs);
				
				foreach ($champs as $k => $val) {
					$champs[$k] = sql_quote($val);
				}
				
				$query = "INSERT INTO $table (".implode(",", array_keys($champs)).") VALUES (".implode(",", $champs).")";
				return sql_query($query);
			}',
		
		'sql_showtable' => '($table, $serveur=\'\') {
			include_spip("base/abstract_sql");
			return spip_abstract_showtable($table, \'mysql\', true);
		}',
		

		'sql_count' => 
			'(
				$res, 
				$serveur=\'\'
			) {
				return spip_mysql_count($res);
			}',
		

		'sql_countsel' => 
 			'(
				$from = array(), 
				$where = array(),
				$groupby = array(), 
				$limit = \'\', 
				$having = array(),
				$serveur=\'\'
 			) {
				return(sql_getfetsel(\'COUNT(*)\', $from, $where, $groupby, \'\', $limit, $having, $serveur));
 			}',
 					
		'sql_selectdb' => 
			'(
				$res, 
				$serveur=\'\'
			) {
				$GLOBALS[\'spip_mysql_db\'] = mysql_select_db($res);
				return $GLOBALS[\'spip_mysql_db\'];
			}'

	);
	return $defs;
}

?>
