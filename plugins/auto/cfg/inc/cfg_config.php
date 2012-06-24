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
 * @version    $Id: cfg_config.php 53409 2011-10-13 20:42:57Z yffic@lefourneau.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * charge le depot qui va bien en fonction de l'argument demande
 * 
 * exemples : 
 * - meta::description
 * - metapack::prefixe_plugin
 * - metapack::prefixe/casier/champ
 * - tablepack::auteur@extra:8/prefixe/casier/champ
 * - tablepack::~id_auteur@extra/prefixe/casier/champ
 *
 * en l'absence du nom de depot (gauche des ::) cette fonction prendra comme suit :
 * - ~ en premier caractere : tablepack
 * - : present avant un / : tablepack
 * - sinon metapack
 *
 * @param  string $args
 * @return Object
 */
function cfg_charger_depot($args){
	$r = explode('::',$args,2);
	if (count($r) > 1)
		list($depot,$args) = $r;
	else {
		// si un seul argument, il faut trouver le depot
		$depot = cfg_charger_depot_args($args);
	}
	$depot = new cfg_depot($depot);
	$depot->charger_args($args);
	return $depot;
}

function cfg_charger_depot_args($args){

		if ($args[0] == '~'){
			return'tablepack';	
		} elseif (
			(list($head, ) = explode('/',$args,2)) &&
			(strpos($head,':') !== false)) {
				return'tablepack';
		} else {
			if (strpos($args,'/') !== false)
				return'metapack';
			else 
				return'meta';
		}
}


/**
 * cette classe charge les fonctions de lecture et ecriture d'un depot (dans depots/)
 *
 * Ces depots ont une version qui evoluera en fonction si des changements d'api apparaissent
 *
 * version 2 (fonctions)
 * - charger_args
 * - lire, ecrire, effacer
 * 
 * @package    plugins
 * @subpackage cfg
 */
class cfg_depot{
	
	/**
	 * Le nom de la classe du dépôt
	 * @var string 
	 */
	var $nom;
	
	/**
	 * Le dépôt
	 * @var Object 
	 */
	var $depot;
	
	/*
	 *
	 * Constructeur de la classe
	 *
	 * 'depot' est le nom du fichier php stocke dans /depots/{depot}.php
	 * qui contient une classe 'cfg_depot_{depot}'
	 *
	 * $params est un tableau de parametres passes a la classe cfg_depot_{depot} qui peut contenir :
	 * <code>
	 * 'champs' => array(
	 *		'nom'=>array(
	 *			'balise' => 'select|textarea|input',  // nom de la balise
	 *			'type' => 'checkbox|hidden|text...',  // type d'un input 
	 *			'tableau' => bool,  // est-ce un champ tableau name="champ[]" ?
	 *			'cfg' => 'xx',    // classe css commencant par css_xx
	 *			'id' => y,  // cle du tableau 'champs_id' (emplacement qui possede ce champ)
	 *		),
	 * 'champs_id' => array(
	 *		cle => 'nom'  // nom d'un champ de type id
	 *		),
	 *	'param' => array(
	 *		'parametre_cfg' => 'valeur'  // les parametres <!-- param=valeur --> passes dans les formulaires cfg
	 *		),
	 *	'val' => array(
	 *		'nom' => 'valeur'  // les valeurs des champs sont stockes dedans
	 *		)
	 *	);
	 * </code>
	 *
	 * @param string $depot
	 * @param Array $params
	 */
	function cfg_depot($depot='metapack', $params=array()){
		if (!isset($params['param'])) {
			$params['param'] = array();
		}
		
		include_spip('depots/'.$depot);
		if (!class_exists($class = 'cfg_depot_'.$depot)) {
			die("CFG ne trouve pas le d&eacute;pot $depot");
		}
		$this->depot = new $class($params);
		$this->version = $this->depot->version;
		$this->nom = $depot;
	}
	
	/**
	 * ajoute les parametres transmis dans l'objet du depot
	 *
	 * @param Array $params
	 */
	function add_params($params){
		foreach ($params as $o=>$v) {
			$this->depot->$o = $v;
		}	
	}

	/**
	 * récupérer les enregistrements des différents champs.
	 * @param Array $params
	 * @return Array
	 */
	function lire($params = array()){
		$this->add_params($params);
		return $this->depot->lire(); // array($ok, $val, $messages)
	}
		
	/**
	 * ecrit chaque enregistrement pour chaque champ.
	 * @param Array $params
	 * @return Array
	 */
	function ecrire($params = array()){
		$this->add_params($params);
		return $this->depot->ecrire(); // array($ok, $val, $messages)
	}

	/**
	 * supprime chaque enregistrement pour chaque champ.
	 * @param Array $params
	 * @return Array
	 */
	function effacer($params = array()){
		$this->add_params($params);
		return $this->depot->effacer(); // array($ok, $val, $messages)
	}	

	/**
	 * Lecture de la configuration
	 *
	 * @param boolean $unserialize
	 * @return string
	 */
	function lire_config($unserialize=true){
		list($ok, $s) = $this->depot->lire($unserialize);
		if ($ok && ($nom = $this->nom_champ())) {
			return $s[$nom];
		} elseif ($ok) {
			return $s;	
		} 
	}

	/**
	 * enregistrer une configuration
	 *
	 * @param mixed $valeur
	 * @return boolean
	 */
	function ecrire_config($valeur){
		if ($nom = $this->nom_champ()) {
			$this->depot->val = array($nom=>$valeur);
		} else {
			$this->depot->val = $valeur;
		}
		list($ok, $s) =  $this->depot->ecrire();
		return $ok;	
	}

	/**
	 * supprimer une config
	 * 
	 * @return boolean
	 */
	function effacer_config(){
		if ($nom = $this->nom_champ()){
			$this->depot->val[$nom] = false;
		} else {
			$this->depot->val = null;	
		}
		list($ok, $s) =  $this->depot->effacer();
		return $ok;	

	}	

	/**
	 * le nom d'un champ s'il est dans le dépôt
	 * @return boolean|string
	 */
	function nom_champ(){
		if (count($this->depot->champs)==1){
			foreach ($this->depot->champs as $nom=>$def){
				return $nom;	
			}
		}
		return false;			
	}
	
	/**
	 * charge les arguments d'un lire/ecrire/effacer_config
	 * dans le depot : lire_config($args = 'metapack::prefixe/casier/champ');
	 *
	 * @param Array $args
	 * @return boolean
	 */
	function charger_args($args){
		if (method_exists($this->depot, 'charger_args')){
			return $this->depot->charger_args($args);	
		}
		return false;
	}
}



/**
 * Lecture de la configuration
 *
 * lire_config() permet de recuperer une config depuis le php<br>
 * memes arguments que la balise (forcement)<br>
 * $cfg: la config, lire_config('montruc') est un tableau<br>
 * lire_config('montruc/sub') est l'element "sub" de cette config
 * comme la balise pour ~, ~id_auteur ou table:id<br>
 *
 * $unserialize est mis par l'histoire, et affecte le depot 'meta'
 *
 * @param  string  $cfg          la config
 * @param  mixed   $def          un defaut optionnel
 * @param  boolean $unserialize  n'affecte que le depot 'meta'
 * @return string
 */
if (!function_exists('lire_config')) {
	function lire_config($cfg='', $def=null, $unserialize=true) {
		$depot = cfg_charger_depot($cfg);
		$r = $depot->lire_config($unserialize);
		if (is_null($r)) return $def;
		return $r;
	}
}

/**
 * enregistrer une configuration
 *
 * @param  string $cfg
 * @param  mixed  $valeur
 * @return boolean
 */
 if (!function_exists('ecrire_config')) {
	function ecrire_config($cfg='', $valeur=null){
		$depot = cfg_charger_depot($cfg);
		return $depot->ecrire_config($valeur);
	}
}


/**
 * supprimer une config
 *
 * @param  string $cfg
 * @return boolean
 */
 if (!function_exists('effacer_config')) {
	function effacer_config($cfg=''){
		$depot = cfg_charger_depot($cfg);
		return $depot->effacer_config();	
	}
}



?>
