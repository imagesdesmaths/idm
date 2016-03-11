<?php
/******************************************************************
***  Ce plugin eva_geometrie, créé par Olivier Gautier  ***
*** 		est mis à disposition sous un ***
*** contrat GNU/GPL consultable à l'adresse                    ***
***      http://www.april.org/gnu/gpl_french.html		     ***
******************************************************************/
function eva_geometrie_install($action){
	
	switch ($action){
	
	case 'test':
	if (!$GLOBALS['meta']['eva_geometrie_test']) {return false;}
	else {
	//Pour les collègues matheux, on insères ici quelques formats de documents à accepter par SPIP pour le logiciel Scilab
		//Ajout de l'icone pour le format sce pour Scilab
		if (!@opendir(_DIR_IMG."icones")) {mkdir(_DIR_IMG."icones");}
		if (!@fopen(_DIR_IMG."icones/sce.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/sce.png',_DIR_IMG.'icones/sce.png');}
		//On poursuit avec l'ajout du format sce dans la base de données
		$test_sce_req=sql_select('inclus','spip_types_documents',"extension = 'sce'");
		$test_sce_ta=sql_fetch($test_sce_req);
		$test_sce=$test_sce_ta['inclus'];
		if (!$test_sce) {
			sql_insertq('spip_types_documents',array('extension' => 'sce','mime_type' => 'application/Scilab','titre' => 'Scilab','inclus' => 'embed','upload' => 'oui'));
		}
		//Ajout de l'icone pour le format sci pour Scilab
		if (!@fopen(_DIR_IMG."icones/sci.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/sci.png',_DIR_IMG.'icones/sci.png');}
		//On poursuit avec l'ajout du format sci dans la base de données
		$test_sci_req=sql_select('inclus','spip_types_documents',"extension = 'sci'");
		$test_sci_ta=sql_fetch($test_sci_req);
		$test_sci=$test_sci_ta['inclus'];
		if (!$test_sci) {
			sql_insertq('spip_types_documents',array('extension' => 'sci','mime_type' => 'application/Scilab','titre' => 'Scilab','inclus' => 'embed','upload' => 'oui'));
		}
		//Ajout de l'icone pour le format tst pour Scilab
		if (!@fopen(_DIR_IMG."icones/tst.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/tst.png',_DIR_IMG.'icones/tst.png');}
		//On poursuit avec l'ajout du format tst dans la base de données
		$test_tst_req=sql_select('inclus','spip_types_documents',"extension = 'tst'");
		$test_tst_ta=sql_fetch($test_tst_req);
		$test_tst=$test_tst_ta['inclus'];
		if (!$test_tst) {
			sql_insertq('spip_types_documents',array('extension' => 'tst','mime_type' => 'application/Scilab','titre' => 'Scilab','inclus' => 'embed','upload' => 'oui'));
		}
		//Ajout de l'icone pour le format cos pour Scilab
		if (!@fopen(_DIR_IMG."icones/cos.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/cos.png',_DIR_IMG.'icones/cos.png');}
		//On poursuit avec l'ajout du format cos dans la base de données
		$test_cos_req=sql_select('inclus','spip_types_documents',"extension = 'cos'");
		$test_cos_ta=sql_fetch($test_cos_req);
		$test_cos=$test_cos_ta['inclus'];
		if (!$test_cos) {
			sql_insertq('spip_types_documents',array('extension' => 'cos','mime_type' => 'application/Scilab','titre' => 'Scilab','inclus' => 'embed','upload' => 'oui'));
		}
		//Ajout de l'icone pour le format xcos pour Scilab
		if (!@fopen(_DIR_IMG."icones/xcos.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/xcos.png',_DIR_IMG.'icones/xcos.png');}
		//On poursuit avec l'ajout du format xcos dans la base de données
		$test_xcos_req=sql_select('inclus','spip_types_documents',"extension = 'xcos'");
		$test_xcos_ta=sql_fetch($test_xcos_req);
		$test_xcos=$test_xcos_ta['inclus'];
		if (!$test_xcos) {
			sql_insertq('spip_types_documents',array('extension' => 'xcos','mime_type' => 'application/Scilab','titre' => 'Scilab','inclus' => 'embed','upload' => 'oui'));
		}
		//Ajout de l'icone pour le format cosf pour Scilab
		if (!@fopen(_DIR_IMG."icones/cosf.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/cosf.png',_DIR_IMG.'icones/cosf.png');}
		//On poursuit avec l'ajout du format cosf dans la base de données
		$test_cosf_req=sql_select('inclus','spip_types_documents',"extension = 'cosf'");
		$test_cosf_ta=sql_fetch($test_cosf_req);
		$test_cosf=$test_cosf_ta['inclus'];
		if (!$test_cosf) {
			sql_insertq('spip_types_documents',array('extension' => 'cosf','mime_type' => 'application/Scilab','titre' => 'Scilab','inclus' => 'embed','upload' => 'oui'));
		}
	//Pour les collègues matheux, on insères ici quelques formats de documents à accepter par SPIP (algobox, XCAS)
		//On commence par ajouter l'icone pour le format alg = logiciel algobox
		if (!@fopen(_DIR_IMG."icones/alg.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/alg.png',_DIR_IMG.'icones/alg.png');}
		//On poursuit avec l'ajout du format alg dans la base de données
		$test_alg_req=sql_select('inclus','spip_types_documents',"extension = 'alg'");
		$test_alg_ta=sql_fetch($test_alg_req);
		$test_alg=$test_alg_ta['inclus'];
		if (!$test_alg) {
			sql_insertq('spip_types_documents',array('extension' => 'alg','mime_type' => 'application/algobox','titre' => 'AlgoBox','inclus' => 'embed','upload' => 'oui'));
		}
		//On commence par ajouter l'icone pour le format xws = logiciel Xcas
		if (!@fopen(_DIR_IMG."icones/xws.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/xws.png',_DIR_IMG.'icones/xws.png');}
		//On poursuit avec l'ajout du format xws dans la base de données
		$test_xws_req=sql_select('inclus','spip_types_documents',"extension = 'xws'");
		$test_xws_ta=sql_fetch($test_xws_req);
		$test_xws=$test_xws_ta['inclus'];
		if (!$test_xws) {
			sql_insertq('spip_types_documents',array('extension' => 'xws','mime_type' => 'application/Xcas','titre' => 'Xcas','inclus' => 'embed','upload' => 'oui'));
		}
		//On commence par ajouter l'icone pour le format sb2 = logiciel Scratch
		if (!@fopen(_DIR_IMG."icones/sb2.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/sb2.png',_DIR_IMG.'icones/sb2.png');}
		//On poursuit avec l'ajout du format sb2 dans la base de données
		$test_scratch_req=sql_select('inclus','spip_types_documents',"extension = 'sb2'");
		$test_scratch_ta=sql_fetch($test_scratch_req);
		$test_scratch=$test_scratch_ta['inclus'];
		if (!$test_scratch) {
			sql_insertq('spip_types_documents',array('extension' => 'sb2','mime_type' => 'application/Scratch','titre' => 'Scratch','inclus' => 'embed','upload' => 'oui'));
		}

	//Mise à jour avec le nouveau format zirs pour CarMetal
		//On commence par ajouter l'icone pour le format zirs = copie de zir
		if (!@fopen(_DIR_IMG."icones/zirs.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/zirs.png',_DIR_IMG.'icones/zirs.png');}
		//On poursuit avec l'ajout du format zirs dans la base de données
		$test_zirs_req=sql_select('inclus','spip_types_documents',"extension = 'zirs'");
		$test_zirs_ta=sql_fetch($test_zirs_req);
		$test_zirs=$test_zirs_ta['inclus'];
		if (!$test_zirs) {
			sql_insertq('spip_types_documents',array('extension' => 'zirs','mime_type' => 'application/x-carmetal','titre' => 'CarMetal','inclus' => 'embed','upload' => 'oui'));
		}
	//Tests globaux
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
	$test4_ta=sql_fetch($test4_req);
	$test4=$test4_ta['inclus'];
	$test5_req=sql_select('inclus','spip_types_documents',"extension = 'zirs'");
	$test5_ta=sql_fetch($test5_req);
	$test5=$test5_ta['inclus'];
	$test6_req=sql_select('inclus','spip_types_documents',"extension = 'sb2'");
	$test6_ta=sql_fetch($test6_req);
	$test6=$test6_ta['inclus'];
	if ((!@opendir(_DIR_IMG."icones")) OR (!@fopen(_DIR_IMG."icones/ggb.png", "r")) OR (!@fopen(_DIR_IMG."icones/glb.png", "r")) OR (!@fopen(_DIR_IMG."icones/gxt.png", "r")) OR (!@fopen(_DIR_IMG."icones/zir.png", "r")) OR (!@fopen(_DIR_IMG."icones/zirs.png", "r")) OR !$test OR !$test2 OR !$test3 OR !$test4 OR !$test5 OR !$test6) {return false;}
	else {return true;}
	}
	break;

	case 'install':
	if (!@opendir(_DIR_IMG."icones")) {mkdir(_DIR_IMG."icones");}
	if (!@fopen(_DIR_IMG."icones/ggb.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/ggb.png',_DIR_IMG.'icones/ggb.png');}
	if (!@fopen(_DIR_IMG."icones/glb.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/glb.png',_DIR_IMG.'icones/glb.png');}
	if (!@fopen(_DIR_IMG."icones/gxt.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/gxt.png',_DIR_IMG.'icones/gxt.png');}
	if (!@fopen(_DIR_IMG."icones/zir.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/zir.png',_DIR_IMG.'icones/zir.png');}
	if (!@fopen(_DIR_IMG."icones/zirs.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/zirs.png',_DIR_IMG.'icones/zirs.png');}
	if (!@fopen(_DIR_IMG."icones/sb2.png", "r")) {copy(_DIR_PLUGIN_EVA_GEOMETRIE.'img_pack/sb2.png',_DIR_IMG.'icones/sb2.png');}
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
	$test_zirs_req=sql_select('inclus','spip_types_documents',"extension = 'zirs'");
	$test_zirs_ta=sql_fetch($test_zirs_req);
	$test_zirs=$test_zirs_ta['inclus'];
	if (!$test_zirs) {
	sql_insertq('spip_types_documents',array('extension' => 'zirs','mime_type' => 'application/x-carmetal','titre' => 'CarMetal','inclus' => 'embed','upload' => 'oui'));
	}
	$test_sb2_req=sql_select('inclus','spip_types_documents',"extension = 'sb2'");
	$test_sb2_ta=sql_fetch($test_sb2_req);
	$test_sb2=$test_sb2_ta['inclus'];
	if (!$test_sb2) {
	sql_insertq('spip_types_documents',array('extension' => 'sb2','mime_type' => 'application/Scratch','titre' => 'Scratch','inclus' => 'embed','upload' => 'oui'));
	}
	ecrire_meta('eva_geometrie_test','1');
	break;
       
	case 'uninstall':
	effacer_meta('eva_geometrie_test');
	break;
	}
}
?>