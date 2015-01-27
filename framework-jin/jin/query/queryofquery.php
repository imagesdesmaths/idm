<?php

namespace jin\query;

use jin\query\Query;
use jin\query\QueryResult;
use jin\log\Debug;

class QueryOfQuery {
    private $query;
    private $queryResult;
    private $fields = '*';
    private $conditions = array();
    private $strCondition = '';
    private $orderBy;
    private $orderBySens = 'ASC';
    
    public function __construct(Query $query = null, QueryResult $queryResult = null, $fields = '*') {
	if(!is_null($query)){
	    $this->query = $query;
	}else if(!is_null($queryResult)){
	    $this->queryResult = $queryResult;
	}else{
	    throw new \Exception('Vous devez spécifier un objet Query ou un objet QueryResult');
	}
	$this->fields = $fields;
    }
    
    public function addCondition($field, $operator, $value){
	//Vérification des paramètres
	if(is_numeric($value)){
	    if(!($operator == '==' || $operator == '<' || $operator == '>' 
	    || $operator == '<=' || $operator == '>=' || $operator == '!=')){
		throw new \Exception('L\'opérateur '.$operator.'n\'est pas supporté');
	    }
	}else{
	    if(!($operator == '==' || $operator == '!=')){
		throw new \Exception('L\'opérateur '.$operator.'n\'est pas supporté');
	    }
	}
	
	$inp = array();
	$inp['field'] = $field;
	$inp['operator'] = $operator;
	$inp['value'] = $value;
	$this->conditions[] = $inp;
    }
    
    public function getResults(){

	$rs;
	if(!is_null($this->query)){
	    $rs = $this->query->getRs(); 
	}else if(!is_null($this->queryResult)){
	    $rs = $this->queryResult->getDatasInArray(true, true);
	}
	
	
	$first = true;
	$this->strCondition = 'if(1 == 1 ';
	foreach ($this->conditions as $cond){
	    if(is_string($cond['value'])){
		$this->strCondition .= '&& ($v[\''.$cond['field'].'\'] '.$cond['operator'].' \''.$cond['value'].'\')';
	    }else{
		$this->strCondition .= '&& ($v[\''.$cond['field'].'\'] '.$cond['operator'].' '.$cond['value'].')';
	    }
	    
	}
	$this->strCondition .= '){ return true; }else{ return false; }';
	
	
	$rs = array_filter($rs, array($this, 'testLine'));

	if($this->orderBy){
	    if($this->orderBySens == 'ASC'){
	       usort($rs, array($this, 'testOrderASC'));
	    }elseif($this->orderBySens == 'DESC'){
	       usort($rs, array($this, 'testOrderDESC'));
	    }
	}
	
	$rs = array_values($rs);
	
	return new QueryResult($rs);
    }
    
    public function setOrderBy($field, $order = 'ASC'){
	if(!($order == 'ASC' || $order == 'DESC')){
	    throw new \Exception('Seuls les tris ASC et DESC sont supportés');
	}
	
	$this->orderBySens = $order;
	$this->orderBy = $field;
    }
    
    private function testOrderASC($a, $b){
	return strnatcmp($a[$this->orderBy], $b[$this->orderBy]);
    }
    
    private function testOrderDESC($a, $b){
	return strnatcmp($b[$this->orderBy], $a[$this->orderBy]);
    }
    
    private function testLine($v){
	return eval($this->strCondition);
    }
}
