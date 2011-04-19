<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

class ChampExtra{
	var $table = ''; // type de table ('rubrique')
	var $champ = ''; // nom du champ ('ps')
	var $label = ''; // label du champ, code de lanque ('monplug:mon_label')
	var $precisions = ''; // (deprecie ; voir $saisie_parametres) precisions pour la saisie du champ (optionnel), code de lanque ('monplug:mon_label')
	var $obligatoire = false; // ce champ est il obligatoire ? 'oui' ou true : c'est le cas.
	var $verifier = false; // Fonction de vérification du plugin API verifier
	var $verifier_options = array(); // Fonction de vérification du plugin API verifier
	var $rechercher = false; // ce champ entre-t-il dans le moteur de recherche ?
	var $enum = ''; // liste de valeurs (champ texte : "cle1,val1\ncle2,val2" ou tableau : array("cle1"=>"val1","cle2"=>"val2") )
	var $type = ''; // type (ligne/bloc/etc)
	var $sql = ''; // declaration sql (text NOT NULL DEFAULT '')
	var $traitements = ''; // _TRAITEMENT_RACCOURCIS ,  _TRAITEMENT_TYPO ou autre declaration pour la $table_des_traitements

	var $_id = ''; // identifiant de ce champ extra

	// calcules a la volee
	var $_type = ''; // rubrique
	var $_objet = ''; // rubriques
	var $_table_sql = ''; // spip_rubriques

	// experimental (avec saisies)
	var $saisie_externe = false;
	var $saisie_parametres = array();
		/*
		    peut indiquer tout parametre d'une #SAISIE, tel que :
			explication => ''; // message d'explication !
			attention => ''; // message d'attention !
			class => ""; // classes CSS	sur l'element
			li_class => ""; // classes CSS sur l'element parent LI
		*/


	// constructeur
	function ChampExtra($params=array()) {
		$this->definir($params);
	}

	// definir les champs
	function definir($params=array()) {
		foreach ($params as $cle=>$valeur) {
			if (isset($this->$cle)) {
				$this->$cle = $valeur;
			}
		}
		
		// calculer _objet et _table_sql
		$this->_type      = objet_type(table_objet($this->table)); // article
		$this->_objet     = table_objet($this->_type); // articles
		$this->_table_sql = table_objet_sql($this->table); // spip_articles
		
		// calculer l'id du champ extra
		$this->make_id();
	}

	// creer l'id du champ extra :
	function make_id(){
		// creer un hash
		$hash = $this->champ . $this->table . $this->sql;
		$this->_id = substr(md5($hash),0,6);
	}

	// determiner un identifiant
	function get_id(){
		if (!$this->_id) $this->make_id();
		return $this->_id;
	}

	// transformer en tableau PHP les variable publiques de la classe.
	function toArray(){
		$extra = array();
		foreach ($this as $cle=>$val) {
			if ($cle[0]!=='_') {
				$extra[$cle] = $val;
			}
		}
		$extra['extra_id'] = $this->get_id();
		return $extra;
	}

	// affichage si on fait un echo...
	function __toString() {
		return "<pre>" . print_r($this, true) . "</pre>";
	}
}


function declarer_champs_extras($champs, $tables){
	// ajoutons les champs un par un
	foreach ($champs as $c){
		$table = $c->_table_sql;
		if (isset($tables[$table]) and $c->champ and $c->sql) {
			$tables[$table]['field'][$c->champ] = $c->sql;
		}
	}
	return $tables;
}


function declarer_champs_extras_interfaces($champs, $interface){
	// ajoutons les filtres sur les champs
	foreach ($champs as $c){
		if ($c->traitements and $c->champ and $c->sql) {
			$tobjet = $c->_objet;
			$balise = strtoupper($c->champ);
			// definir
			if (!isset($interface['table_des_traitements'][$balise])) {
				$interface['table_des_traitements'][$balise] = array();
			}
			// le traitement peut etre le nom d'un define
			$traitement = defined($c->traitements) ? constant($c->traitements) : $c->traitements;
			$interface['table_des_traitements'][$balise][$tobjet] = $traitement;
		}
	}
	return $interface;
}


/**
 * Log une information si l'on est en mode debug
 * ( define('EXTRAS_DEBUG',true); )
 * Ou si le second parametre est true.
 */
function extras_log($contenu, $important=false) {
	if ($important
	OR (defined('EXTRAS_DEBUG') and EXTRAS_DEBUG)) {
		spip_log($contenu,'extras');
	}
}
?>
