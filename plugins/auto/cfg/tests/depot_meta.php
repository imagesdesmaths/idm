<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

	// nom du test
	$test = 'cfg:depot_meta';

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


### lire_config meta ###

	$meta = $GLOBALS['meta'];
	
	// les bases de test
	$assoc = array('one' => 'element 1', 'two' => 'element 2');
	$serassoc = serialize($assoc);
	
	// on flingue meta a juste nos donnees
	$GLOBALS['meta'] = array(
		'zero' => 0,
		'zeroc' => '0',
		'chaine' => 'une chaine',
		'assoc' => $assoc,
		'serie' => serialize($assoc)
	);

	$essais[] = array(0, 'zero');
	$essais[] = array('0', 'zeroc');
	$essais[] = array('une chaine', 'chaine');
	$essais[] = array($assoc, 'assoc');
	$essais[] = array($assoc, 'serie');
	$essais[] = array(serialize($assoc), 'serie','',0);
	$essais[] = array(null, 'rien');
	$essais[] = array('defaut', 'rien','defaut');

	$err = tester_fun('lire_config', $essais);

	// retablissement des metas
	$GLOBALS['meta']=$meta;
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>lire_config meta</b><dl>' . join('', $err) . '</dl>');
	}

### ecrire_config meta ###

	/*
	 * Notes sur l'ecriture :
	 * - dans le tableau $GLOBALS['meta'], les valeurs transmises
	 * conservent effectivement leur type
	 * - si l'on applique un lire_metas() (reecriture du tableau $GLOBALS['meta']
	 * depuis les informations de la table spip_meta, les types de valeurs
	 * sont tous des types string (puisque la colonne 'valeur' de spip_meta est
	 * varchar (ou text).
	 * 	- 0 devient alors '0'
	 *  - array(xxx) devient 'Array'
	 *
	 * Cela ne se produit pas avec le depot 'metapack' qui serialize systematiquement
	 * tout ce qu'on lui donne (et peut donc restituer le type de donnee correctement).
	 *
	 */
	$essais = array();
	$essais[] = array(true, 'test_cfg_zero', 0);
	$essais[] = array(true, 'test_cfg_zeroc', '0');
	$essais[] = array(true, 'test_cfg_chaine', 'une chaine');		
	$essais[] = array(true, 'test_cfg_assoc', $assoc);
	$essais[] = array(true, 'test_cfg_serie', serialize($assoc));

	$err = tester_fun('ecrire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>ecrire_config meta</b><dl>' . join('', $err) . '</dl>');
	}
	
### re lire_config meta ###

	$essais = array();
	$essais[] = array(0, 'test_cfg_zero');
	$essais[] = array('0', 'test_cfg_zeroc');
	$essais[] = array('une chaine', 'test_cfg_chaine');		
	$essais[] = array($assoc, 'test_cfg_assoc');
	$essais[] = array(serialize($assoc), 'test_cfg_serie','',0);

	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture ecrire_config meta</b><dl>' . join('', $err) . '</dl>');
	}

### re effacer_config meta ###

	$essais = array();
	$essais[] = array(true, 'test_cfg_zero');
	$essais[] = array(true, 'test_cfg_zeroc');
	$essais[] = array(true, 'test_cfg_chaine');		
	$essais[] = array(true, 'test_cfg_assoc');
	$essais[] = array(true, 'test_cfg_serie');

	$err = tester_fun('effacer_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>effacer_config meta</b><dl>' . join('', $err) . '</dl>');
	}

	
### re lire_config meta ###

	$essais = array();
	$essais[] = array(null, 'test_cfg_zero');
	$essais[] = array(null, 'test_cfg_zeroc');
	$essais[] = array(null, 'test_cfg_chaine');		
	$essais[] = array(null, 'test_cfg_assoc');
	$essais[] = array(null, 'test_cfg_serie');

	$err = tester_fun('lire_config', $essais);
	
	// si le tableau $err est pas vide ca va pas
	if ($err) {
		die ('<b>relecture effacer_config meta</b><dl>' . join('', $err) . '</dl>');
	}

	
	echo "OK";

?>
