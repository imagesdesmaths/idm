<?php
/******************************************************************
***  Ce plugin eva_geometrie, crיי par Olivier Gautier  ***
*** 		est mis א disposition sous un ***
*** contrat GNU/GPL consultable א l'adresse                    ***
***      http://www.april.org/gnu/gpl_french.html		     ***
******************************************************************/
function eva_geometrie_install($action){
	
	switch ($action){
	
	case 'test':
	if (!$GLOBALS['meta']['eva_geometrie_test']) {return false;}
	else {
	$test_req=sql_select('inclus','spip_types_documents',"extension = 'ggb'");
	$test_ta=sql_fetch($test_req);
	$test=$test_ta['inclus'];
	$test2_req=sql_select('inclus','spip_types_documents',"extension = 'glb'");
	$test2_ta=sql_fetch($test2_req);
	$test2=$test2_ta['inclus'];
	$test3_req=sql_select('inclus','spip_types_documents',"extension = 'gxt'");
	$test3_ta=sql_fetch($test3_req);
	$test3=$test3_ta['inclus'];
	$test4_req=sql_select('inclus','spip_types_documents',"extension = 'zir'");
	$test4_ta=sql_fetch($test3_req);
	$test4=$test3_ta['inclus'];
	if ((!@opendir(_DIR_IMG."icones")) OR (!@fopen(_DIR_IMG."icones/ggb.png", "r")) OR (!@fopen(_DIR_IMG."icones/glb.png", "r")) OR (!@fopen(_DIR_IMG."icones/gxt.png", "r")) OR (!@fopen(_DIR_IMG."icones/zir.png", "r")) OR !$test OR !$test2 OR !$test3 OR !$test4) {return false;}
	else {return true;}
	}
	break;

	case 'install':
	if (!@opendir(_DIR_IMG."icones")) {mkdir(_DIR_IMG."icones");}
	if (!@fopen(_DIR_IMG."icones/ggb.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/ggb.png',_DIR_IMG.'icones/ggb.png');}
	if (!@fopen(_DIR_IMG."icones/glb.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/glb.png',_DIR_IMG.'icones/glb.png');}
	if (!@fopen(_DIR_IMG."icones/gxt.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/gxt.png',_DIR_IMG.'icones/gxt.png');}
	if (!@fopen(_DIR_IMG."icones/zir.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/zir.png',_DIR_IMG.'icones/zir.png');}
	$test_req=sql_select('inclus','spip_types_documents',"extension = 'ggb'");
	$test_ta=sql_fetch($test_req);
	$test=$test_ta['inclus'];
	if (!$test) {
	sql_insertq('spip_types_documents',array('extension' => 'ggb','mime_type' => 'application-x/geogebra-file','titre' => 'GeoGebra','inclus' => 'embed','upload' => 'oui'));
	}
	$test2_req=sql_select('inclus','spip_types_documents',"extension = 'glb'");
	$test2_ta=sql_fetch($test2_req);
	$test2=$test2_ta['inclus'];
	if (!$test2) {
	sql_insertq('spip_types_documents',array('extension' => 'glb','mime_type' => 'application/geolabo','titre' => 'GeoLabo','inclus' => 'embed','upload' => 'oui'));
	}
	$test3_req=sql_select('inclus','spip_types_documents',"extension = 'gxt'");
	$test3_ta=sql_fetch($test3_req);
	$test3=$test3_ta['inclus'];
	if (!$test3) {
	sql_insertq('spip_types_documents',array('extension' => 'gxt','mime_type' => 'application/geonext','titre' => 'GeoNext','inclus' => 'embed','upload' => 'oui'));
	}
	$test4_req=sql_select('inclus','spip_types_documents',"extension = 'zir'");
	$test4_ta=sql_fetch($test4_req);
	$test4=$test4_ta['inclus'];
	if (!$test4) {
	sql_insertq('spip_types_documents',array('extension' => 'zir','mime_type' => 'application/x-carmetal','titre' => 'CarMetal','inclus' => 'embed','upload' => 'oui'));
	}
	ecrire_meta('eva_geometrie_test','1');
	break;
       
	case 'uninstall':
	effacer_meta('eva_geometrie_test');
	break;
	}
}
?>