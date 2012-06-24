<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

	// nom du test
	$test = 'cfg:depot_php';

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
	
	// les bases de test
	$assoc = array(
		'one' => 'element 1',
		'two' => 'element 2',
		'three' => array('un'=>1, 'deux'=>2, 'troisc'=>"3")

	);

### ecrire_config ###

	$essais = array();
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_zero', 0);
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_zeroc', '0');
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chaine', 'une chaine');		
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_assoc', $assoc);
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_serie', serialize($assoc));
	// chemins
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier', $assoc);
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/truc', 'trac');
	
	$err = tester_fun('ecrire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>ecrire_config php</b><dl>' . join('', $err) . '</dl>');
	}
	
### re lire_config ###

	$essais = array();
	$essais[] = array(0, 'php::tests_cfg_php/test_cfg_zero');
	$essais[] = array('0', 'php::tests_cfg_php/test_cfg_zeroc');
	$essais[] = array('une chaine', 'php::tests_cfg_php/test_cfg_chaine');		
	$essais[] = array($assoc, 'php::tests_cfg_php/test_cfg_assoc');
	$essais[] = array(serialize($assoc), 'php::tests_cfg_php/test_cfg_serie');
	// chemins
	$essais[] = array($assoc + array('truc'=>'trac'), 'php::tests_cfg_php/test_cfg_chemin/casier');
	$essais[] = array('trac', 'php::tests_cfg_php/test_cfg_chemin/casier/truc');
	$essais[] = array(1, 'php::tests_cfg_php/test_cfg_chemin/casier/three/un');
	// chemin pas la
	$essais[] = array(null, 'php::tests_cfg_php/test_cfg_chemin/casier/three/huit');
	
	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture ecrire_config php</b><dl>' . join('', $err) . '</dl>');
	}

### re effacer_config ###

	$essais = array();
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_zero');
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_zeroc');
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chaine');		
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_assoc');
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_serie');
	// chemins
	// on enleve finement tout test_cfg_chemin : il ne doit rien rester
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/three/huit'); // n'existe pas
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/three/troisc');
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/three/deux');
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/three/un'); // supprime three
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/one'); 
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/two'); 
	$essais[] = array(true, 'php::tests_cfg_php/test_cfg_chemin/casier/truc'); // supprimer chemin/casier

	$err = tester_fun('effacer_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>effacer_config php</b><dl>' . join('', $err) . '</dl>');
	}

	
### re lire_config ###

	$essais = array();
	$essais[] = array(null, 'php::tests_cfg_php/test_cfg_zero');
	$essais[] = array(null, 'php::tests_cfg_php/test_cfg_zeroc');
	$essais[] = array(null, 'php::tests_cfg_php/test_cfg_chaine');		
	$essais[] = array(null, 'php::tests_cfg_php/test_cfg_assoc');
	$essais[] = array(null, 'php::tests_cfg_php/test_cfg_serie');
	$essais[] = array(null, 'php::tests_cfg_php/test_cfg_chemin');
	$essais[] = array(null, 'php::tests_cfg_php');
	
	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture effacer_config php</b><dl>' . join('', $err) . '</dl>');
	}

	echo "OK";

?>
