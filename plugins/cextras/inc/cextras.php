<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

class ChampExtra{
	var $table = ''; // type de table ('rubrique')
	var $champ = ''; // nom du champ ('ps')
	var $label = ''; // label du champ, code de lanque ('monplug:mon_label')
	var $precisions = ''; // precisions pour la saisie du champ (optionnel), code de lanque ('monplug:mon_label')
	var $obligatoire = false; // ce champ est il obligatoire ? 'oui' ou true : c'est le cas.
	var $rechercher = false; // ce champ entre-t-il dans le moteur de recherche ?
	var $enum = ''; // liste de valeurs (champ texte : "cle1,val1\ncle2,val2" ou tableau : array("cle1"=>"val1","cle2"=>"val2") )
	var $type = ''; // type (ligne/bloc/etc)
	var $sql = ''; // declaration sql (text NOT NULL DEFAULT '')
	
	var $_id = ''; // identifiant de ce champ extra
	
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
		$extra['id_extra'] = $this->get_id();
		return $extra;
	}
}


function declarer_champs_extras($champs, $tables){
	// ajoutons les champs un par un
	foreach ($champs as $c){
		$table = table_objet_sql($c->table);
		if (isset($tables[$table]) and $c->champ and $c->sql) {
			$tables[$table]['field'][$c->champ] = $c->sql;
		}
	}	
	return $tables;
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
