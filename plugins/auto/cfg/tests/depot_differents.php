<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

	// nom du test
	$test = 'cfg:depot_metapack';

	// recherche test.inc qui nous ouvre au monde spip
	$deep = 2;
	$include = '../../tests/test.inc';
	while (!defined('_SPIP_TEST_INC') && $deep++ < 6) {
		$include = '../' . $include;
		@include $include;
	}
	if (!defined('_SPIP_TEST_INC')) {
		die("Pas de $include");
	}


### lire_config ###

	$meta = $GLOBALS['meta'];
	
	// les bases de test
	$assoc = array(
		'one' => 'element 1',
		'two' => 'element 2',
		'three' => array('un'=>1, 'deux'=>2, 'troisc'=>"3")

	);
	$serassoc = serialize($assoc);

	
	// on flingue meta a juste nos donnees
	$GLOBALS['meta'] = array(
		'zero' => serialize(0),
		'zeroc' => serialize('0'),
		'chaine' => serialize('une chaine'),
		'assoc' => serialize($assoc),
		'serie' => serialize(serialize($assoc))
	);

	// racine
	$essais[] = array(0, 'metapack::zero');
	$essais[] = array('0', 'metapack::zeroc');
	$essais[] = array('une chaine', 'metapack::chaine');
	$essais[] = array(array('un'=>1, 'deux'=>2, 'troisc'=>"3"), 'metapack::assoc/three');
	
	$err = tester_fun('lire_config', $essais);

	// retablissement des metas
	$GLOBALS['meta']=$meta;
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>lire_config metapack</b><dl>' . join('', $err) . '</dl>');
	}



	// on flingue meta a juste nos donnees
	$GLOBALS['meta'] = array(
		'zero' => 0,
		'zeroc' => '0',
		'chaine' => 'une chaine',
		'assoc' => $assoc,
		'serie' => serialize($assoc)
	);
		
	$essais = array();
	$essais[] = array(0, 'zero');
	$essais[] = array('0', 'zeroc');
	$essais[] = array('une chaine', 'chaine');

	$err = tester_fun('lire_config', $essais);
	
	// retablissement des metas
	$GLOBALS['meta']=$meta;
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>lire_config meta</b><dl>' . join('', $err) . '</dl>');
	}

	
	echo "OK";

?>
