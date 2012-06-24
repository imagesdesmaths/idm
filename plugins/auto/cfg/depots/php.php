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
 * @version    $Id: php.php 43371 2011-01-07 10:44:03Z alexis.pellicier@nds.k12.tr $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Retrouve et met a jour les donnees d'un fichier php.
 * @package    plugins
 * @subpackage cfg
 */
class cfg_depot_php
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
	 * Dépôt dans les attributs de la classe
	 *
	 * @param Array $params
	 */
	function cfg_depot_php($params=array()) {
		foreach ($params as $o=>$v) {
			$this->$o = $v;
		}
	}
	

	/**
	 * calcule l'emplacement du fichier
	 *
	 * @staticvar Array $fichier
	 * @return string # L'emplacement du fichier
	 */
	function get_fichier(){
		static $fichier = array();
		$cle = $this->param['nom'] . ' - ' . $this->param['fichier'];
		if (isset($fichier[$cle])) 
			return $fichier[$cle];
		
		if (!$this->param['fichier']) 
			$f = _DIR_VAR . 'cfg/' . $this->param['nom'] . '.php';	
		else
			$f = _DIR_RACINE . $this->param['fichier'];

		include_spip('inc/flock');
		return $fichier[$cle] = sous_repertoire(dirname($f)) . basename($f);
	}
	
	
	/**
	 * charge la base (racine) et le point de l'arbre sur lequel on se trouve (ici)
	 *
	 * @param boolean $lire
	 * @return boolean
	 */
	function charger($lire=false){
		$fichier = $this->get_fichier();

		// inclut une variable $cfg
		if (!@include $fichier) {
			if ($lire) return false;
			$this->_base = array();
		} elseif (!$cfg OR !is_array($cfg)) {
			$this->_base = array();
		} else {
			$this->_base = $cfg;
		}

		$this->_ici = &$this->_base;
		$this->_ici = &$this->monte_arbre($this->_ici, $this->param['nom']);
		$this->_ici = &$this->monte_arbre($this->_ici, $this->param['casier']);
		$this->_ici = &$this->monte_arbre($this->_ici, $this->param['cfg_id']);
		return true;
	}
	
	/**
	 * recuperer les valeurs.
	 *
	 * @return Array
	 */
	function lire() {
		if (!$this->charger(true)){
			return array(true, null); // pas de chargement = pas de valeur encore enregistrees
		}
		
		// utile ??
		if ($this->param['cfg_id']) {
			$cles = explode('/', $this->param['cfg_id']);
			foreach ($this->champs_id as $i => $name) {
				$this->_ici[$name] = $cles[$i];
			}
		}
		return array(true, $this->_ici);
	}


	/**
	 * ecrit chaque enregistrement pour chaque champ.
	 *
	 * @return Array
	 */
	function ecrire() {
		if (!$this->charger()){
			return array(false, $this->val);	
		}

		foreach ($this->champs as $name => $def) {
			if (isset($def['id'])) continue;
			$this->_ici[$name] = $this->val[$name];
		}
		
		if (!$this->ecrire_fichier($this->_base)){
			return array(false, $this->val);
		}
		
		return array(true, $this->_ici);	
	}


	/**
	 * supprime chaque enregistrement pour chaque champ.
	 *
	 * @return Array
	 */
	function effacer(){
		if (!$this->charger()){
			return array(false, $this->val);	
		}

		// pas de champ, on supprime tout
		if (!$this->champs)
			return array($this->ecrire_fichier(), array());
			
		// effacer les champs
		foreach ($this->champs as $name => $def) {
			if (isset($def['id'])) continue;
			unset($this->_ici[$name]);
		}
		
		// supprimer les dossiers vides
		for ($i = count($this->_arbre); $i--; ) {
			if ($this->_arbre[$i][0][$this->_arbre[$i][1]]) {
				break;
			}
			unset($this->_arbre[$i][0][$this->_arbre[$i][1]]);
		}

		return array($this->ecrire_fichier($this->_base), $this->_ici);
	}
	

	/**
	 * Ecrire un fichier
	 *
	 * @param Array $contenu
	 * @return boolean
	 */
	function ecrire_fichier($contenu=array()){
		$fichier = $this->get_fichier();

		if (!$contenu) {
			return supprimer_fichier($fichier);
		}

$contenu = '<?php
/**************
* Config ecrite par cfg le ' . date('r') . '
* 
* NE PAS EDITER MANUELLEMENT !
***************/

$cfg = ' . var_export($contenu, true) . ';
?>
';
		return ecrire_fichier($fichier, $contenu);
	}
	
	/**
	 * charger les arguments de
	 * - lire_config(php::nom/casier/champ)
	 * - lire_config(php::adresse/fichier.php:nom/casier/champ)
	 *
	 * @param string $args
	 * @return boolean
	 */
	function charger_args($args){
		list($fichier, $args) = explode(':',$args);
		if (!$args) {
			$args = $fichier;
			$fichier = _DIR_VAR . 'cfg/' . $fichier . '.php';	
		}
		$this->param['fichier'] = $fichier;
		$arbre = explode('/',$args);
		$this->param['nom'] = array_shift($arbre);
		if ($champ = array_pop($arbre))
			$this->champs = array($champ=>true);
		$this->param['casier'] = implode('/',$arbre);
		return true;	
	}


	/**
	 * se positionner dans le tableau arborescent
	 *
	 * @param &Array $base
	 * @param Array $chemin
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
