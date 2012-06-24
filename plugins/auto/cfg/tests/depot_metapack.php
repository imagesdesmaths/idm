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
	$essais[] = array($assoc, 'metapack::assoc');
	$essais[] = array(serialize($assoc), 'metapack::serie');
	$essais[] = array(null, 'metapack::rien');
	$essais[] = array('defaut', 'metapack::rien','defaut');
	// chemins
	$essais[] = array($assoc, 'metapack::assoc/');
	$essais[] = array('element 1', 'metapack::assoc/one');
	$essais[] = array(array('un'=>1, 'deux'=>2, 'troisc'=>"3"), 'metapack::assoc/three');
	$essais[] = array(1, 'metapack::assoc/three/un');
	$essais[] = array('3', 'metapack::assoc/three/troisc');
	// racourcis
	$essais[] = array($assoc, 'assoc/');
	$essais[] = array('element 1', 'assoc/one');
	
	$err = tester_fun('lire_config', $essais);

	// retablissement des metas
	$GLOBALS['meta']=$meta;
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>lire_config metapack</b><dl>' . join('', $err) . '</dl>');
	}

### ecrire_config ###

	$essais = array();
	$essais[] = array(true, 'metapack::test_cfg_zero', 0);
	$essais[] = array(true, 'metapack::test_cfg_zeroc', '0');
	$essais[] = array(true, 'metapack::test_cfg_chaine', 'une chaine');		
	$essais[] = array(true, 'metapack::test_cfg_assoc', $assoc);
	$essais[] = array(true, 'metapack::test_cfg_serie', serialize($assoc));
	// chemins
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier', $assoc);
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/truc', 'trac');
	
	$err = tester_fun('ecrire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>ecrire_config metapack</b><dl>' . join('', $err) . '</dl>');
	}
	
### re lire_config ###

	$essais = array();
	$essais[] = array(0, 'metapack::test_cfg_zero');
	$essais[] = array('0', 'metapack::test_cfg_zeroc');
	$essais[] = array('une chaine', 'metapack::test_cfg_chaine');		
	$essais[] = array($assoc, 'metapack::test_cfg_assoc');
	$essais[] = array(serialize($assoc), 'metapack::test_cfg_serie');
	// chemins
	$essais[] = array($assoc + array('truc'=>'trac'), 'metapack::test_cfg_chemin/casier');
	$essais[] = array('trac', 'metapack::test_cfg_chemin/casier/truc');
	$essais[] = array(1, 'metapack::test_cfg_chemin/casier/three/un');
	// chemin pas la
	$essais[] = array(null, 'metapack::test_cfg_chemin/casier/three/huit');
	
	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture ecrire_config metapack</b><dl>' . join('', $err) . '</dl>');
	}

### re effacer_config ###

	$essais = array();
	$essais[] = array(true, 'metapack::test_cfg_zero');
	$essais[] = array(true, 'metapack::test_cfg_zeroc');
	$essais[] = array(true, 'metapack::test_cfg_chaine');		
	$essais[] = array(true, 'metapack::test_cfg_assoc');
	$essais[] = array(true, 'metapack::test_cfg_serie');
	// chemins
	// on enleve finement tout test_cfg_chemin : il ne doit rien rester
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/huit'); // n'existe pas
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/troisc');
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/deux');
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/three/un'); // supprime three
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/one'); 
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/two'); 
	$essais[] = array(true, 'metapack::test_cfg_chemin/casier/truc'); // supprimer chemin/casier

	$err = tester_fun('effacer_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>effacer_config metapack</b><dl>' . join('', $err) . '</dl>');
	}

	
### re lire_config ###

	$essais = array();
	$essais[] = array(null, 'metapack::test_cfg_zero');
	$essais[] = array(null, 'metapack::test_cfg_zeroc');
	$essais[] = array(null, 'metapack::test_cfg_chaine');		
	$essais[] = array(null, 'metapack::test_cfg_assoc');
	$essais[] = array(null, 'metapack::test_cfg_serie');
	$essais[] = array(null, 'metapack::test_cfg_chemin');

	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture effacer_config metapack</b><dl>' . join('', $err) . '</dl>');
	}

	
	echo "OK";

?>
