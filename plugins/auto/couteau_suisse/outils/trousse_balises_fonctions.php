<?php

// La balise #CHR, equivalent a #EVAL{"chr(XX)"} ou #VAL{XX}|chr
function balise_CHR_dist($p) {
	if (($v = interprete_argument_balise(1,$p))!==NULL){
		$p->code = "chr(intval($v))";
		$p->type = 'php';
	}
	return $p;
}

// La balise #BOLO
// inspiree des travaux de Cyril Marion : http://www.spip-contrib.net/Balise-BOLO
function balise_BOLO_dist($p) {
	$bolo = "'Nam id pede vel ipsum pulvinar pretium. Mauris id nunc. Vivamus lorem. Proin auctor rutrum ligula. Sed suscipit justo et nunc. Praesent ut leo quis neque luctus eleifend. Vestibulum nec nisl. Proin tincidunt. Sed enim. Curabitur posuere purus a quam. Aenean odio wisi, vestibulum sed, accumsan vitae, rhoncus suscipit, lectus. Sed a lacus. Aenean erat odio, molestie a, lobortis ut, blandit eu, arcu. Donec mauris. Sed sed libero ac sem venenatis sollicitudin. Donec arcu est, volutpat id, dictum a, molestie eu, justo. Nam aliquet faucibus quam. Pellentesque cursus, neque eu placerat facilisis, metus ante fringilla mi, vitae vestibulum nulla turpis quis orci. Quisque nec turpis vel justo volutpat venenatis. Mauris fermentum. Nulla blandit, augue a laoreet gravida, velit lectus molestie wisi, eget volutpat velit eros sit amet tortor. Suspendisse sollicitudin lectus. Nunc velit mauris, ultrices vel, vestibulum et, rhoncus sed, massa. Curabitur luctus erat ac dolor. In pulvinar posuere sapien. Suspendisse dapibus elementum quam. Ut nec diam. Nulla pulvinar. Nam id pede vel ipsum pulvinar pretium. Mauris id nunc. Vivamus lorem. Proin auctor rutrum ligula. Sed suscipit justo et nunc. Praesent ut leo quis neque luctus eleifend. Vestibulum nec nisl. Proin tincidunt. Sed enim. Curabitur posuere purus a quam. Aenean odio wisi, vestibulum sed, accumsan vitae, rhoncus suscipit, lectus. Sed a lacus. Aenean erat odio, molestie a, lobortis ut, blandit eu, arcu. Donec mauris. Sed sed libero ac sem venenatis sollicitudin. Donec arcu est, volutpat id, dictum a, molestie eu, justo. Nam aliquet faucibus quam. Pellentesque cursus, neque eu placerat facilisis, metus ante fringilla mi, vitae vestibulum nulla turpis quis orci. Quisque nec turpis vel justo volutpat venenatis. Mauris fermentum. Nulla blandit, augue a laoreet gravida, velit lectus molestie wisi, eget volutpat velit eros sit amet tortor. Suspendisse sollicitudin lectus. Nunc velit mauris, ultrices vel, vestibulum et, rhoncus sed, massa. Curabitur luctus erat ac dolor. In pulvinar posuere sapien. Suspendisse dapibus elementum quam. Ut nec diam. Nulla pulvinar. '";
	if(($couper = interprete_argument_balise(1,$p)) !== NULL)
		$p->code = "couper($bolo, $couper)";
	else
		$p->code = $bolo;
	$p->interdire_scripts = false;
	return $p;   
}

// La balise #MAINTENANT
function balise_MAINTENANT_dist($p) {
	$format = sinon(interprete_argument_balise(1,$p), "'Y-m-d H:i:s'");
	$p->code = "date($format)";
	$p->interdire_scripts = false;
	return $p;
}

// La balise #NOW
function balise_NOW_dist($p) {
	return balise_MAINTENANT_dist($p);
}


function balise_LESMOTS_dist($p){
	$i_boucle = $p->nom_boucle ? $p->nom_boucle : $p->id_boucle;
	// #LESMOTS hors boucle ? ne rien faire
	if (!$type = $p->boucles[$i_boucle]->type_requete) {
		$p->code = "''";
		$p->interdire_scripts = false;
		return $p;
	}

	// le compilateur 1.9.2 ne calcule pas primary pour les tables secondaires
	// il peut aussi arriver une table sans primary (par ex: une vue)
	if (!($primary = $p->boucles[$i_boucle]->primary)) {
		include_spip('inc/vieilles_defs'); # 1.9.2 pour trouver_def_table
		list($nom, $desc) = trouver_def_table(
			$p->boucles[$i_boucle]->type_requete, $p->boucles[$i_boucle]);
		$primary = $desc['key']['PRIMARY KEY'];
	}
	$primary = explode(',',$primary);
	$id = array();
	foreach($primary as $key)
		$id[] = champ_sql(trim($key),$p);
	$primary = implode(".'-'.",$id);
	$p->code = "classe_boucle_crayon('"
		. $type
		."',"
		.sinon(interprete_argument_balise(1,$p),"''")
		.","
		. $primary
		.").' '";
	$p->interdire_scripts = false;
	return $p;

	// Cherche le champ 'lesmots' dans la pile
	$_lesmots = champ_sql('lesmots', $p); 
	// Si le champ n'existe pas (cas de spip_articles), on applique
	// le fond les_mots.html en passant id_article dans le contexte;
	// dans le cas contraire on prend le champ SQL 'lesmots'
	if ($_lesmots AND $_lesmots != '$Pile[0][\'lesmots\']') {
		$p->code = "safehtml($_lesmots)";
		// $p->interdire_scripts = true;
	} else {
		if ($cle = $p->boucles[$p->id_boucle]->primary)
			$id = champ_sql($primary, $p);
		$p->code = "recuperer_fond('fonds/lesmots', array($cle => $id))";
		// securite imposee par recuperer_fond()
		$p->interdire_scripts = false;
	}
	return $p;
}

?>