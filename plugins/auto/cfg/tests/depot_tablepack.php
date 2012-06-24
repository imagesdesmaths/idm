<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

	// nom du test
	$test = 'cfg:depot_tablepack';

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


### creation de la colonne cfg si absente ###

	// creation de la colonne 'cfg' sur spip_auteurs si elle n'existe pas.
	include_spip('base/abstract_sql');
	$t = sql_showtable('spip_auteurs');
	if (!isset($t['field']['cfg'])) {
		sql_alter('TABLE spip_auteurs ADD COLUMN cfg TEXT DEFAULT \'\' NOT NULL');
	}
	
### creation de la colonne 'extra' si absente ###

	// creation de la colonne 'cfg' sur spip_auteurs si elle n'existe pas.
	include_spip('base/abstract_sql');
	$t = sql_showtable('spip_rubriques');
	if (!isset($t['field']['extra'])) {
		sql_alter('TABLE spip_rubriques ADD COLUMN extra TEXT DEFAULT \'\' NOT NULL');
	}
	
	
### ecrire_config ###
	// les bases de test
	$assoc = array(
		'one' => 'element 1',
		'two' => 'element 2',
		'three' => array('un'=>1, 'deux'=>2, 'troisc'=>"3")

	);
	$serassoc = serialize($assoc);

	
	$essais = array();
	$essais[] = array(true, 'tablepack::~/test_cfg_zero', 0);
	$essais[] = array(true, 'tablepack::~/test_cfg_zeroc', '0');
	$essais[] = array(true, 'tablepack::~/test_cfg_chaine', 'une chaine');		
	$essais[] = array(true, 'tablepack::~/test_cfg_assoc', $assoc);
	$essais[] = array(true, 'tablepack::~/test_cfg_serie', serialize($assoc));
	// chemins
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier', $assoc);
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/truc', 'trac');
	// dans rubriques
	$id_rubrique = sql_getfetsel('id_rubrique', 'spip_rubriques', '', '', '', '0,1');
	$essais[] = array(true, "tablepack::rubriques@extra:$id_rubrique/test_cfg_chemin/casier/truc", 'trac');
	$essais[] = array(true, "tablepack::rubrique@extra:$id_rubrique/test_cfg_chemin/casier/chose", 'trac');
	
	$err = tester_fun('ecrire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>ecrire_config tablepack</b><dl>' . join('', $err) . '</dl>');
	}
	
### re lire_config ###

	$essais = array();
	$essais[] = array(0, 'tablepack::~/test_cfg_zero');
	$essais[] = array('0', 'tablepack::~/test_cfg_zeroc');
	$essais[] = array('une chaine', 'tablepack::~/test_cfg_chaine');		
	$essais[] = array($assoc, 'tablepack::~/test_cfg_assoc');
	$essais[] = array(serialize($assoc), 'tablepack::~/test_cfg_serie');
	// chemins
	$essais[] = array($assoc + array('truc'=>'trac'), 'tablepack::~/test_cfg_chemin/casier');
	$essais[] = array('trac', 'tablepack::~/test_cfg_chemin/casier/truc');
	$essais[] = array(1, 'tablepack::~/test_cfg_chemin/casier/three/un');
	// chemin pas la
	$essais[] = array(null, 'tablepack::~/test_cfg_chemin/casier/three/huit');
	// dans rubrique
	$essais[] = array('trac', "tablepack::rubriques@extra:$id_rubrique/test_cfg_chemin/casier/truc");
	$essais[] = array('trac', "tablepack::rubrique@extra:$id_rubrique/test_cfg_chemin/casier/chose");
	
	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture ecrire_config tablepack</b><dl>' . join('', $err) . '</dl>');
	}

### re effacer_config ###

	$essais = array();
	$essais[] = array(true, 'tablepack::~/test_cfg_zero');
	$essais[] = array(true, 'tablepack::~/test_cfg_zeroc');
	$essais[] = array(true, 'tablepack::~/test_cfg_chaine');		
	$essais[] = array(true, 'tablepack::~/test_cfg_assoc');
	$essais[] = array(true, 'tablepack::~/test_cfg_serie');
	// chemins
	// on enleve finement tout test_cfg_chemin : il ne doit rien rester
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/three/huit'); // n'existe pas
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/three/troisc');
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/three/deux');
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/three/un'); // supprime three
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/one'); 
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/two'); 
	$essais[] = array(true, 'tablepack::~/test_cfg_chemin/casier/truc'); // supprimer chemin/casier
	// dans rubrique
	$essais[] = array(true, "tablepack::rubriques@extra:$id_rubrique/test_cfg_chemin/casier/truc");
	$essais[] = array(true, "tablepack::rubrique@extra:$id_rubrique/test_cfg_chemin/casier/chose");
	
	$err = tester_fun('effacer_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>effacer_config tablepack</b><dl>' . join('', $err) . '</dl>');
	}

	
### re lire_config ###

	$essais = array();
	$essais[] = array(null, 'tablepack::~/test_cfg_zero');
	$essais[] = array(null, 'tablepack::~/test_cfg_zeroc');
	$essais[] = array(null, 'tablepack::~/test_cfg_chaine');		
	$essais[] = array(null, 'tablepack::~/test_cfg_assoc');
	$essais[] = array(null, 'tablepack::~/test_cfg_serie');
	$essais[] = array(null, 'tablepack::~/test_cfg_chemin');
	// dans rubrique
	$essais[] = array(null, "tablepack::rubriques@extra:$id_rubrique/test_cfg_chemin/casier/truc");
	$essais[] = array(null, "tablepack::rubrique@extra:$id_rubrique/test_cfg_chemin/casier/chose");
	$essais[] = array(null, "tablepack::rubriques@extra:$id_rubrique/test_cfg_chemin");
	
	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture effacer_config tablepack</b><dl>' . join('', $err) . '</dl>');
	}


	echo "OK";

?>
