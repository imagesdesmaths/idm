<?php
/**
 * Plugin Spip 2.0 Reloaded
 * Ce que vous ne trouverez pas dans Spip 2.0
 * (c) 2008 Cedric Morin
 * Licence GPL
 * 
 */

if (!defined("_ECRIRE_INC_VERSION")) return;


global $array_server;

// fonction pour la premiere connexion a un serveur array
function req_array_dist($host, $port, $login, $pass, $db='', $prefixe='', $ldap='') {
	$GLOBALS['array_rappel_nom_base'] = false;
#	spip_log("Connexion vers $host, base $db, prefixe $prefixe "
#		 . ($ok ? "operationnelle sur $link" : 'impossible'));

	return array(
		'db' => $db,
		'prefixe' => 'spip',
		'link' => false,
		'ldap' => '',
		);
}

function array_get_var($table){
	if (is_string($table) AND $t = unserialize($table))
		$table = $t;
	if(is_string($table) AND strpos($table,':')!==FALSE){
		$iter = explode(':',$table);
		if (count($iter)==2 AND is_numeric($iter[0]) AND is_numeric($iter[1]))
			$var = range($iter[0],$iter[1]);
		if (count($iter)==3 AND is_numeric($iter[0]) AND is_numeric($iter[1]) AND is_numeric($iter[2]))
			$var = range($iter[0],$iter[2],$iter[1]);
		return $var; // pas de copie necessaire
	}
	// $table doit toujours etre un array
	if (!is_array($table)) return null;
	// faisons une copie, sans le sous tableau recursif GLOBALS eventuel
	$var = array();
	foreach($table as $k=>$v)
		if ($k !== 'GLOBALS')
			$var[$k] = $v;
	return $var;
}

function array_where_sql2php($where){
	$where = preg_replace(",(^|\()([\w.]+)\s*REGEXP\s*(.+)($|\)),Uims","\\1preg_match('/'.str_replace('/','\/',\\3).'/Uims',\\2)\\4",$where); // == -> preg_match
	$where = preg_replace(",([\w.]+)\s*=,Uims","\\1==",$where); // = -> ==
	$where = preg_replace(";^FIELD\(([^,]+),(.*)$;Uims","in_array(\\1,array(\\2)",$where); // IN -> FIELD -> in_array()
	$where = preg_replace(";(^|\(|\(\()([\w.]+)\s*IN\s*(.+)($|\)|\)\));Uims","in_array(\\2,array\\3",$where); // IN  -> in_array()
	return $where;
}

function array_where_teste($cle,$valeur,$table,$where){
	if (is_array($valeur))
		$valeur = serialize($valeur);
	$where = preg_replace(array(
	",(\W)$table\.cle(\W),i",
	",(\W)cle(\W),i",
	",(\W)$table\.valeur(\W),i",
	",(\W)valeur(\W),i",
	',NOT\(,i'
	),
	array(
	"\\1'".addslashes($cle)."'\\2",
	"\\1'".addslashes($cle)."'\\2",
	"\\1'".addslashes($valeur)."'\\2",
	"\\1'".addslashes($valeur)."'\\2",
	"\\1!("
	),$where);
	return eval("if ($where) return true; else return false;");
}


function calculer_array_where($v)
{
	if (!is_array($v))
	  return array_where_sql2php($v) ;

	$op = array_shift($v);
	if (!($n=count($v)))
		return $op;
	else {
		$arg = calculer_array_where(array_shift($v));
		if ($n==1) {
			  return "$op($arg)";
		} else {
			$arg2 = calculer_array_where(array_shift($v));
			if ($n==2) {
				return array_where_sql2php("($arg $op $arg2)");
			} else return "($arg $op ($arg2) : $v[0])";
		}
	}
}


function array_query_filter($cle,$valeur,$table,$where){
	static $wherec = array();
	$hash = md5(serialize($where));
	if (!isset($wherec[$hash])){
		if (is_array($where))
			$wherec[$hash] = implode("AND ",array_map('calculer_array_where',$where));
		else 
			$wherec[$hash] = calculer_array_where($where);
	}
	return array_where_teste($cle,$valeur,$table,$wherec[$hash]);
}

function array_results($hash,$store='get',$arg=null){
	static $array_results = array();
	if($store=='get'){
		if (isset($array_results[$hash]['res'])){
			return each($array_results[$hash]['res']);
		}
		if (isset($array_results[$hash]['iter'])) {
			$pas = $array_results[$hash]['iter']['pas'];
			$valeur = $array_results[$hash]['iter']['debut']+$array_results[$hash]['iter']['i']*$pas;
			if (($valeur>$array_results[$hash]['iter']['fin'] AND $pas>0)
			 OR ($valeur<$array_results[$hash]['iter']['fin'] AND $pas<0)) 
				return false;
			return array(++$array_results[$hash]['iter']['i'],$valeur);
		}
		return false;
	}
	elseif($store=='seek'){
		if (isset($array_results[$hash]['res'])){
			// pas de seek sur les tableaux, on emule avec reset+n each
			reset($array_results[$hash]['res']);
			$i=0;
			while ($i++<intval($arg))
				each($array_results[$hash]['res']);
			return true;
		}
		if (isset($array_results[$hash]['iter'])) {
			$array_results[$hash]['iter']['i'] = intval($arg);
			return true;
		}
		return false;
	}
	elseif($store=='count'){
		if (isset($array_results[$hash]['res']))
			return count($array_results[$hash]['res']);
		if (isset($array_results[$hash]['iter']))
			return floor(($array_results[$hash]['iter']['fin']-$array_results[$hash]['iter']['debut'])/$array_results[$hash]['iter']['pas'])+1;
		return false;
	}
	elseif($store=='free')
		unset($array_results[$hash]);
	else {
		$hash = count($array_results)?max(array_keys($array_results))+1:1; // pas de 0 svp
		// un tableau direct
		if (is_array($store)){
			$array_results[$hash]['res'] = $store;
			reset($array_results[$hash]['res']);
		}
		elseif(is_string($store) AND strpos($store,':')!==FALSE){
			$iter = explode(':',$store);
			if (count($iter)==2 OR count($iter)==3)
				$array_results[$hash]['iter']=array('debut'=>reset($iter),'fin'=>end($iter),'pas'=>count($iter)==2?1:$iter[1],'i'=>0);
		}
		return $hash;
	}
}

// emulations array
function array_query($query){
	// pas de jointure, que des requetes simples
	// trouver le tableau de base, fourni en condition having
	// c'est un hack ...
	$table = null;
	if (!is_array($query['having'])) return -1; // on arrive pas ici par une boucle !
	foreach($query['having'] as $k=>$w){
		if (reset($w)=='tableau')
			$table = end($w);
	}
	// recuperer le pseudo nom de la table pour la condition where
	if (is_array($query['from']))
		if (count($query['from'])!==1)
			return false;
		else
			$query['from'] = reset($query['from']);	

	$res = array_get_var($table); // recuperer la table
	if (!$res OR !is_array($res))
		$res = array();
	// filtrons les resultats
	if ($query['where']){
		foreach($res as $k=>$v){
			if (!array_query_filter($k,$v,$query['from'],$query['where']))
				unset($res[$k]);
		}
	}
	if ($query['orderby']){
		// on ne prend que le premier critere
		$sort = is_array($query['orderby'])?reset($query['orderby']):$query['orderby'];
		$sort = str_replace($query['from'].".","",$sort);
		$sort = explode(',',$sort);
		$sort = reset($sort);

		// (POUR){par cle}
		if (preg_match(',^cle,',$sort)){
			if (preg_match(',DESC$,i',$sort))
				krsort($res);
			else
				ksort($res);
		}
		// (POUR){par valeur}
		else if (preg_match(',^valeur,',$sort)){
			if (preg_match(',DESC$,i',$sort))
				arsort($res);
			else
				asort($res);
		}
		// (POUR) {par XXX} : on considere que la valeur est un array,
		// et on trie nos array sur leur valeur XXX ; si ce sont des objets
		// on les caste en array
		else {
			preg_match(',^(.*)( DESC)?$,Ui', $sort, $tri);
			$sens = $tri[2] ? '<' : '>';
			uasort($res,
				create_function('$a, $b',
					'return ((is_string($a["'.$tri[1].'"]) AND is_string($b["'.$tri[1].'"]))?
						 (strcasecmp($a["'.$tri[1].'"],$b["'.$tri[1].'"])'.$sens.'0)
						:((array)$a["'.$tri[1].'"] '.$sens.' (array) $b["'.$tri[1].'"]))
						 ? 1 : -1;'
				)
			);
		}
	}
	if ($query['limit']){
		$limit = explode(',',$query['limit']);
		$res = array_slice($res,$limit[0],$limit[1],true);
	}
	// regarder si il y a un count dans select
	foreach($query['select'] as $s){
		if (preg_match(',^count\(,i',$s)) {
			$res = array(0=>count($res));
			continue;
		}
	}
	// ici calculer un vrai res si la variable existe
	if (count($res)) {
		$hash = array_results(false,$res);
		return $hash;
	}
	return -1; // pas de resultats mais pas false non plus
}

// -----

$GLOBALS['spip_array_functions_1'] = array(
		'count' => 'spip_array_count',
		'countsel' => 'spip_array_countsel',
		'errno' => 'spip_array_errno',
		'error' => 'spip_array_error',
		'explain' => 'spip_array_explain',
		'fetch' => 'spip_array_fetch',
		'seek' => 'spip_array_seek',
		'free' => 'spip_array_free',
		'hex' => 'spip_array_hex',
		'in' => 'spip_array_in', 
		'listdbs' => 'spip_array_listdbs',
		'multi' => 'spip_array_multi',
		'optimize' => 'spip_array_optimize',
		'query' => 'spip_array_query',
		'quote' => 'spip_array_quote',
		'select' => 'spip_array_select',
		'selectdb' => 'spip_array_selectdb',
		'set_charset' => 'spip_array_set_charset',
		'get_charset' => 'spip_array_get_charset',
		'showbase' => 'spip_array_showbase',
		'showtable' => 'spip_array_showtable',

		);

function spip_array_set_charset($charset, $serveur=''){
	#spip_log("changement de charset sql : "."SET NAMES "._q($charset));
	return true;
}

function spip_array_get_charset($charset=array(), $serveur=''){
	return false;
}

// Fonction de requete generale, munie d'une trace a la demande
function spip_array_query($query, $serveur='') {

	$connexion = $GLOBALS['connexions'][$serveur ? $serveur : 0];
	$prefixe = $connexion['prefixe'];
	$link = $connexion['link'];
	$db = $connexion['db'];

	$t = !isset($_GET['var_profile']) ? 0 : trace_query_start();
	$r = array_query($query,$db);

	if ($e = spip_array_errno())	// Log de l'erreur eventuelle
		$e .= spip_array_error($query); // et du fautif
	return $t ? trace_query_end(var_export($query,true), $t, $r, $e) : $r;
}


// fonction  instance de sql_select, voir ses specs dans abstract.php
// Les \n et \t sont utiles au debusqueur.

function spip_array_select($select, $from, $where='',
			   $groupby='', $orderby='', $limit='', $having='',
			   $serveur='',$requeter=true) {

	$from = (!is_array($from) ? $from : spip_array_select_as($from));

	// pas de prefixage par nom de table dans array, une seule table a la fois !
	$clean_prefix = trim($from).".";

	$query = array(
	'select'=>$select,
	'from'=>$from,
	'where'=>$where,
	'groupby'=>$groupby,
	'orderby'=>$orderby,
	'limit'=>$limit);
	$querydump = var_export($query,1);
	$query['having'] = $having;

	// Erreur ? C'est du debug de squelette, ou une erreur du serveur
	if (isset($GLOBALS['var_mode'])
	  AND $GLOBALS['var_mode'] == 'debug'
	  AND function_exists('boucle_debug_requete')) {
		include_spip('public/debug');
		boucle_debug_requete($querydump);
	}

	$res = spip_array_query($query, $serveur);

	if (!$res AND function_exists('boucle_debug_requete')) {
		include_spip('public/debug');
		erreur_requete_boucle($querydump,
				      spip_array_errno(),
				      spip_array_error($query) );
	}

	// renvoyer la requete inerte si demandee
	if ($requeter === false) return $querydump;
	return $res ? $res : $querydump;
}

// 0+x avec un champ x commencant par des chiffres est converti par array
// en le nombre qui commence x.
// Pas portable malheureusement, on laisse pour le moment.


function spip_array_order($orderby)
{
	return (is_array($orderby)) ? join(", ", $orderby) :  $orderby;
}


function spip_array_select_as($args)
{
	$argsas = "";
	foreach($args as $k => $v) {
		if (strpos($v, 'JOIN') === false)  $argsas .= ', ';
		$argsas .= $v;// PAS de AS en array : . (is_numeric($k) ? '' : " AS `$k`");
	}
	return substr($argsas,2);
}


function spip_array_selectdb($db) {
	return true;
}


// Retourne les bases accessibles
// Attention on n'a pas toujours les droits


function spip_array_listdbs($serveur='') {
	return false;
}



function spip_array_showbase($match, $serveur='')
{
	$res = array('pour'=>array('table'=>'pour'),'condition'=>array('table'=>'condition'));
	$match = str_replace('_','.',$match);
	$match = str_replace('%','.*',$match);
	$match = str_replace('\.*','%',$match);
	$match = str_replace('\.','_',$match);
	$match = ",^$match$,i";
	foreach(array_keys($res) as $k)
		if (!preg_match($match,$k))
			unset($res[$k]);

	$hash = array_results(false,$res);
	return $hash;
}


// pas fe SHOW en array, on renvoie une declaration type si la variable existe
function spip_array_showtable($nom_table, $serveur='')
{
	if (in_array(strtolower($nom_table),array('pour')))
		return array('field'=>array('cle'=>'text','valeur'=>'text'),'key'=>array('PRIMARY KEY'=>'cle'));
	if (in_array(strtolower($nom_table),array('condition')))
		return array('field'=>array('valeur'=>'text'),'key'=>array());
	return false;
}

//
// Recuperation des resultats
//


function spip_array_fetch($r, $t='', $serveur='') {
	if ($r AND $each = array_results($r)) {
		list($cle,$valeur) = $each;
		return array('valeur'=>$valeur,'cle'=>$cle);
	}
	return false;
}

function spip_array_seek($r, $row_number, $serveur='',$requeter=true) {
	return array_results($r,'seek',$row_number);
}


function spip_array_error($query='') {
	spip_log("Erreur - $query", 'array');
	return false;
}

// A transposer dans les portages

function spip_array_errno() {
	return false;
}

function spip_array_explain($query, $serveur='',$requeter=true){
	return $query;
}

// Interface de abstract_sql

function spip_array_count($r, $serveur='') {
	return array_results($r,'count');
}

function spip_array_countsel($from = array(), $where = array(),
			     $groupby = '', $limit = '', $sousrequete = '', $having = array(), $serveur='',$requeter=true)
{
	$r = spip_array_select("*", $from, $where,'', '', $limit,	$having, $serveur, $requeter);
	if (!$requeter) return $r;
	if (!$r) return 0;
	list($c) = spip_array_count($r,$serveur);
	spip_array_free($r,$serveur);
	return $c;
}

function spip_array_free($r, $serveur='') {
	array_results($r,'free');
	return true;
}


function spip_array_multi ($objet, $lang) {
	$retour = "(TRIM(IF(INSTR(".$objet.", '<multi>') = 0 , ".
		"     TRIM(".$objet."), ".
		"     CONCAT( ".
		"          LEFT(".$objet.", INSTR(".$objet.", '<multi>')-1), ".
		"          IF( ".
		"               INSTR(TRIM(RIGHT(".$objet.", LENGTH(".$objet.") -(6+INSTR(".$objet.", '<multi>')))),'[".$lang."]') = 0, ".
		"               IF( ".
		"                     TRIM(RIGHT(".$objet.", LENGTH(".$objet.") -(6+INSTR(".$objet.", '<multi>')))) REGEXP '^\\[[a-z\_]{2,}\\]', ".
		"                     INSERT( ".
		"                          TRIM(RIGHT(".$objet.", LENGTH(".$objet.") -(6+INSTR(".$objet.", '<multi>')))), ".
		"                          1, ".
		"                          INSTR(TRIM(RIGHT(".$objet.", LENGTH(".$objet.") -(6+INSTR(".$objet.", '<multi>')))), ']'), ".
		"                          '' ".
		"                     ), ".
		"                     TRIM(RIGHT(".$objet.", LENGTH(".$objet.") -(6+INSTR(".$objet.", '<multi>')))) ".
		"                ), ".
		"               TRIM(RIGHT(".$objet.", ( LENGTH(".$objet.") - (INSTR(".$objet.", '[".$lang."]')+ LENGTH('[".$lang."]')-1) ) )) ".
		"          ) ".
		"     ) ".
		"))) AS multi ";

	return $retour;
}

function spip_array_hex($v)
{
	return "0x" . $v;
}

function spip_array_quote($v)
{
	return _q($v);
}

// pour compatibilite
function spip_array_in($val, $valeurs, $not='', $serveur='') {
	return calcul_array_in($val, $valeurs, $not);
}

//
// IN (...) est limite a 255 elements, d'ou cette fonction assistante
//

function calcul_array_in($val, $valeurs, $not='') {
	if (is_array($valeurs))
		$valeurs = join(',', array_map('_q', $valeurs));
	if (!strlen(trim($valeurs))) return ($not ? "0=0" : '0=1');

	$n = $i = 0;
	$in_sql ="";
	while ($n = strpos($valeurs, ',', $n+1)) {
	  if ((++$i) >= 255) {
			$in_sql .= "($val $not IN (" .
			  substr($valeurs, 0, $n) .
			  "))\n" .
			  ($not ? "AND\t" : "OR\t");
			$valeurs = substr($valeurs, $n+1);
			$i = $n = 0;
		}
	}
	$in_sql .= "($val $not IN ($valeurs))";

	return "($in_sql)";
}


function spip_array_cite($v, $type) {
	if (sql_test_date($type) AND preg_match('/^\w+\(/', $v)
	OR (sql_test_int($type)
		 AND (is_numeric($v)
		      OR (ctype_xdigit(substr($v,2))
			  AND $v[0]=='0' AND $v[1]=='x'))))
		return $v;
	else return  ("'" . addslashes($v) . "'");
}

?>
