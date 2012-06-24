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
 * @version    $Id: metapack.php 37604 2010-04-24 07:31:15Z esj@rezo.net $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Retrouve et met a jour les donnees dans spip_meta (mode serialise)
 * @package    plugins
 * @subpackage cfg
 */
class cfg_depot_metapack
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
	 * version du depot
	 * @var int
	 */
	var $version = 2;
	
	/**
	 * Stockage interne dans les attributs de la classe
	 * 
	 * @param Array $params 
	 */
	function cfg_depot_metapack($params=array())
	{
		foreach ($params as $o=>$v) {
			$this->$o = $v;
		}	
	}
	

	/**
	 * charge la base (racine) et le point de l'arbre sur lequel on se trouve (ici)
	 * 
	 * @param boolean $lire
	 * @return boolean
	 */
	function charger($lire = false){
		if ($lire && !isset($GLOBALS['meta'][$this->param['nom']])) 
			return false;
		$this->_base = is_array($c = $GLOBALS['meta'][$this->param['nom']]) ? $c : @unserialize($c);
		$this->_arbre = array();
		$this->_ici = &$this->_base;
		$this->_ici = &$this->monte_arbre($this->_ici, $this->param['casier']);
		$this->_ici = &$this->monte_arbre($this->_ici, isset($this->param['cfg_id']) ? $this->param['cfg_id'] : '');
		return true;
	}
	
	/**
	 * recuperer les valeurs.
	 * 
	 * @return Array
	 */
	function lire()
	{
		if (!$this->charger(true)){
			return array(true, null); // pas de chargement = pas de valeur encore enregistrees
		}
		$ici = &$this->_ici;
    	
		// utile ??
		if (isset($this->param['cfg_id'])) {
			$cles = explode('/', $this->param['cfg_id']);
			foreach ($this->champs_id as $i => $name) {
				$ici[$name] = $cles[$i];
			}
		}
    	
		// s'il y a des champs demandes, les retourner... sinon, retourner la base
		// (cas de lire_config('metapack::nom') tout court)
		if (count($this->champs)){
			$val = array();
			foreach ($this->champs as $name => $def) {
				$val[$name] = $ici[$name];
			}
			$ici = $val;
		}

		return array(true, $ici);
	}


	/**
	 * ecrit une meta pour tous les champs
	 * 
	 * @return Array
	 */
	function ecrire()
	{
  		// si pas de champs : on ecrit directement (ecrire_meta(metapack::nom,$val))...
  		if (!$this->champs){
  			ecrire_meta($this->param['nom'], serialize($this->val));
  			if (defined('_COMPAT_CFG_192')) ecrire_metas();
  			return array(true, $this->val);
  		}
  		
		if (!$this->charger()){
			return array(false, $this->val);	
		}
		$ici = &$this->_ici;
		
		foreach ($this->champs as $name => $def) {
			if (isset($def['id'])) continue;
			$ici[$name] = $this->val[$name];
		}

		ecrire_meta($this->param['nom'], serialize($this->_base));
		if (defined('_COMPAT_CFG_192')) ecrire_metas();
		return array(true, $ici);
	}
	
	
	/**
	 * supprime chaque enregistrement de meta pour chaque champ
	 * 
	 * @return Array
	 */
	function effacer(){
  		// si pas de champs : on supprime directement (effacer_meta(metapack::nom))...
  		if (!$this->champs){
  			effacer_meta($this->param['nom']);
  			if (defined('_COMPAT_CFG_192')) ecrire_metas();
  			return array(true, array());
  		}
  		
		if (!$this->charger()){
			return array(false, $this->val);	
		}
		$ici = &$this->_ici;

		// supprimer les champs
		foreach ($this->champs as $name => $def) {
			if (isset($def['id'])) continue;
			unset($ici[$name]);
		}

		// supprimer les dossiers vides
		for ($i = count($this->_arbre); $i--; ) {
			if ($this->_arbre[$i][0][$this->_arbre[$i][1]]) {
				break;
			}
			unset($this->_arbre[$i][0][$this->_arbre[$i][1]]);
		}
		
		if (!$this->_base) {
			effacer_meta($this->param['nom']);
		} else {
			ecrire_meta($this->param['nom'], serialize($this->_base));
		}
		if (defined('_COMPAT_CFG_192')) ecrire_metas();
		
		return array(true, array());
	}
	
	
	/**
	 * charger les arguments de lire_config(metapack::nom/casier/champ)
	 * il se peut qu'il n'y ait pas de champs si : lire_config(metapack::nom);
	 * 
	 * @param string $args # $args = 'nom'; ici
	 * @return boolean
	 */
	function charger_args($args){
		$args = explode('/',$args);
		$this->param['nom'] = array_shift($args);
		if ($champ = array_pop($args)) {
			$this->champs = array($champ=>true);
		}
		$this->param['casier'] = implode('/',$args);
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
}



?>
