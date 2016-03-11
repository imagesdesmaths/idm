<?php

// cette fonction appelee automatiquement a chaque affichage de la page privee du Couteau Suisse renvoie un tableau
function jcorner_installe_dist() {
cs_log("jcorner_installe_dist()");
	if(!function_exists('_jcorner_CLASSES')) return NULL;

	// on decode les balises entrees dans la config
	$classes = preg_split("/[\r\n]+/", _jcorner_CLASSES());
	$code = array();
	foreach ($classes as $class) {
		list($class,) = explode('//', $class);
		if (preg_match('/^\s*([\'"]?)(.*?)\\1\s*=(.*)$/', $class, $regs)) {
			// forme avec commande jQuery
			$a = trim($regs[2]); $b = trim($regs[3]);
			$b = preg_match('/^(=*)\s*\.*(.*)$/', $b, $regs2)?trim($regs2[2]):'';
			$not = !strlen($regs2[1])?'.not(".jc_done").addClass("jc_done")':'';
			if(strlen($a) && strlen($b)) $code[] = "jQuery(\"$a\", this)$not.$b;";
		} elseif (preg_match('/^\s*([\'"]?)(.+)\\1\s*$/', $class, $regs)) {
			// forme simple avec coins arrondis
			$a = trim($regs[2]);
			if (strlen($a)) $code[] = "jQuery(\"$a\", this).not('.jc_done').addClass('jc_done').corner();";
		}
	}
	// en retour : le code jQuery
	return array(join("\n\t", $code));
}


function jcorner_insert_head($flux) {
	return $flux . "<script type=\"text/javascript\"><!--\nfunction jcorner_init() {\n\tif(typeof jQuery.fn.corner!='function') return;\n\t".cs_lire_data_outil('jcorner')."\n}\n// --> </script>\n";
}

?>