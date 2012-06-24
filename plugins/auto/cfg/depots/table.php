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
 * @version    $Id: table.php 36744 2010-03-29 02:31:19Z gilles.vincent@gmail.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Retrouve et met a jour les colonnes d'une table.
 * ici, cfg_id est obligatoire ...
 * 
 * @package    plugins
 * @subpackage cfg
 */
class cfg_depot_table
{
	/**
	 * Les champs manipulés
	 * @var Array
	 */
	var $champs = array();

	/**
	 * Si on passe par cfg_id, ça fait..
	 * Heu.. Quelque chose d'utile ?
	 * @var Array
	 */
	var $champs_id = array();

	/**
	 * Les valeurs en dépôt
	 * @var Array
	 */
	var $val = array();

	/**
	 * Les différents paramètres : Tables, Colonnes, cfg_id, et Casier
	 * @var Array
	 */
	var $param = array();

	/**
	 * Pour gestion de l'affichage en succès ou échec
	 * @var Array
	 */
	var $messages = array('message_ok'=>array(), 'message_erreur'=>array(), 'erreurs'=>array());
	
	/**
	 * Arbre
	 * @var Array
	 */
	var $_arbre = array();

	/**
	 * Le WHERE permettant de retrouver l'Arbre
	 * @var Array
	 */
	var $_id = array();

	/**
	 * Base de l'arbre
	 * @var Array
	 */
	var $_base = null;

	/**
	 * Où on est dans l'arbre $this->_arbre
	 * @var &Array
	 */
	var $_ici = null;
	
	/**
	 * version du depot
	 * @var int
	 */
	var $version = 2;
	
	/**
	 * Dépôt dans les attributs de la classe
	 *
	 * @param Array $params
	 */
	function cfg_depot_table($params=array()){
		foreach ($params as $o=>$v) {
			$this->$o = $v;
		}
	}
	
	/**
	 * charge la base (racine) et le point de l'arbre sur lequel on se trouve (ici)
	 *
	 * @param boolean $creer # inutilisé
	 */
	function charger($creer = false){
		
		if (!$this->param['table']) {
			$this->messages['message_erreur'][] = _T('cfg:nom_table_manquant');
			return false;
		}
		
		// colid : nom de la colonne primary key
		list($this->param['table'], $colid) = $this->get_table_id($this->param['table']);
		
		// renseigner les liens id=valeur
		$id = explode('/',$this->param['cfg_id']);
		foreach ($colid as $n=>$c) {
			if (isset($id[$n])) {
				$this->_id[$c] = $id[$n];
			}
		}
		
		if (!$this->param['cfg_id'] AND !($this->param['autoriser_absence_id'] == 'oui')) {
			$this->messages['message_erreur'][] = _T('cfg:id_manquant');
			return false;
		}

		// select
		$this->_select = array();
		if ($this->champs){
			foreach ($this->champs as $nom => $def) {
				if (isset($def['id'])) {
					continue;
				}
				$this->_select[] = $nom;
			}
		} else {
			$this->_select[] = '*';	
		}
		
		// where
		$this->_where = array();
		foreach ($this->_id as $nom => $id) {
			$this->_where[] = $nom . '=' . sql_quote($id);
		}
			
		$this->_base = ($d = sql_fetsel(
			$this->_select, 
			$this->param['table'], 
			$this->_where)) ? $d : array();
		
		$this->_existe = count($this->_base);
			
		$this->_ici = &$this->_base;
		return true;
	}
	
	/**
	 * recuperer les valeurs.
	 *
	 * @return Array
	 */
	function lire() {
		// charger
		if (!$this->charger()){
			return array(false, $this->val, $this->messages);	
		}

		// utile ??
		if ($this->param['cfg_id']) {
			$cles = explode('/', $this->param['cfg_id']);
			foreach ($this->champs_id as $i => $name) {
				$this->_ici[$name] = $cles[$i];
			}
		}
	
		// s'il y a des champs demandes, ne retourner que ceux-ci
		if (count($this->champs)){
			$val = array();
			foreach ($this->champs as $name => $def) {
				$val[$name] = $this->_ici[$name];
			}
			$this->_ici = $val;
		}
		return array(true, $this->_ici);
	}


	/**
	 * ecrit chaque enregistrement pour chaque champ.
	 *
	 * @return Array
	 */
	function ecrire()
	{
		// charger
		if (!$this->charger()){
			return array(false, $this->val, $this->messages);	
		}

		if ($this->champs){
			foreach ($this->champs as $name => $def) {
				if (isset($def['id'])) continue;
				$this->_ici[$name] = $this->val[$name];
			}
		} else {
			$this->_ici = $this->val;	
		}	
			
		// update
		if ($this->_existe) {	
		    $ok = sql_updateq($this->param['table'], $this->_ici, $this->_where );
	    } else {
			$ok = $id = sql_insertq($this->param['table'], $this->_ici);
	    }

		// remettre l'id
		if ($ok && (count($this->champs_id)==1)) {
			$this->_ici[$nomid = $this->champs_id[0]] = $this->_existe ? $this->val[$nomid] : $ok;
		}
			
		return array($ok, $this->_ici);
	}
	
	
	/**
	 * supprime chaque enregistrement pour chaque champ.
	 *
	 * @return Array
	 */
	function effacer(){
		// charger
		if (!$this->charger()){
			return array(false, $this->val, $this->messages);	
		}
		
		$ok = !$this->_existe || sql_delete($this->param['table'], $this->_where );	
		return array($ok, array());
	}
	
	
	/**
	 * charger les arguments
	 * - lire_config(table::table@colonne:id
	 * - lire_config(table::table:id
	 *
	 * @param string $args
	 * @return boolean
	 */
	function charger_args($args){

		list($table, $id) = explode(':',$args,2);
		list($table, $colonne) = explode('@',$table);
		list($table, $colid) = $this->get_table_id($table);
		
		$this->param['cfg_id'] = $id;
		$this->param['champs'] = $colonne ? array($colonne=>true) : '';
		$this->param['table'] = $table ? $table : 'spip_cfg';
		
		// renseigner les liens id=valeur
		$id = explode(':',$id);
		foreach ($colid as $n=>$c) {
			if (isset($id[$n])) {
				$this->_id[$c] = $id[$n];
			}
		}
		
		return true;	
	}
	
	
	/**
	 * se positionner dans le tableau arborescent
	 *
	 * @param &Array $base
	 * @param string $chemin
	 * @return &Array
	 */
	function & monte_arbre(&$base, $chemin){
		if (!$chemin) {
			return $base;
		}
		if (!is_array($chemin)) {
			$chemin = explode('/', $chemin);
		}
		if (!is_array($base)) {
			$base = array();
		}
		
		foreach ($chemin as $dossier) {
			if (!isset($base[$dossier])) {
				$base[$dossier] = array();
			}
			$this->_arbre[] = array(&$base, $dossier);
			$base = &$base[$dossier];
		}
		
		return $base;
	}
	

	/**
	 * Cherche le vrai nom d'une table
	 * ainsi que ses cles primaires
	 *
	 * @param string $table
	 * @return Array
	 */
	function get_table_id($table) {	
		static $catab = array(
			'tables_principales' => 'base/serial',
			'tables_auxiliaires' => 'base/auxiliaires',
		);
		$try = array($table, 'spip_' . $table);
		foreach ($catab as $categ => $catinc) {
			include_spip($catinc);
			foreach ($try as $nom) {
				if (isset($GLOBALS[$categ][$nom])) {
					return array($nom,
						preg_split('/\s*,\s*/', $GLOBALS[$categ][$nom]['key']['PRIMARY KEY']));
				}
			}
		}
		if ($try = table_objet($table)) {
			return array('spip_' . $try, array(id_table_objet($table)));
		}
		return array(false, false);
	}

}







?>
