<?php

function compacte_ecrire_balise_script_dist($src){
	return "<script type='text/javascript' src='$src'></script>";
}
function compacte_ecrire_balise_link_dist($src,$media=""){
	return "<link rel='stylesheet'".($media?" media='$media'":"")." href='$src' type='text/css' />";
}


// http://doc.spip.org/@compacte_css
function compacte_css ($contenu) {
	// nettoyer la css de tout ce qui sert pas
	$contenu = preg_replace(",/\*.*\*/,Ums","",$contenu); // pas de commentaires
	$contenu = preg_replace(",\s(?=\s),Ums","",$contenu); // pas d'espaces consecutifs
	$contenu = preg_replace("/\s?({|;|,|:)\s?/ms","$1",$contenu); // pas d'espaces dans les declarations css
	$contenu = preg_replace("/\s}/ms","}",$contenu); // pas d'espaces dans les declarations css
	// passser les codes couleurs en 3 car si possible
	// uniquement si non precedees d'un [="'] ce qui indique qu'on est dans un filter(xx=#?...)
	$contenu = preg_replace(";([:\s,(])#([0-9a-f])(\\2)([0-9a-f])(\\4)([0-9a-f])(\\6)(?=[^\w\-]);i","$1#$2$4$6",$contenu);
	// supprimer les declarations vides
	$contenu = preg_replace(",(^|})([^{}]*){},Ums","$1",$contenu);
	$contenu = trim($contenu);

	return $contenu;
}

// Compacte du javascript grace a Dean Edward's JavaScriptPacker
// utile pour prive/jquery.js par exemple
// http://doc.spip.org/@compacte_js
function compacte_js($flux) {
	// si la closure est demandee, on pourrait zapper cette etape
	// mais avec le risque, en localhost, de depasser 200ko et d'echec
	#if ($GLOBALS['meta']['auto_compress_closure'] == 'oui')
	#	return $flux;

	if (!strlen($flux))
		return $flux;
	include_spip('lib/JavascriptPacker/class.JavaScriptPacker');
	$packer = new JavaScriptPacker($flux, 0, true, false);

	// en cas d'echec (?) renvoyer l'original
	if (!strlen($t = $packer->pack())) {
		spip_log('erreur de compacte_js');
		return $flux;
	}

	return $t;
}


// Appelee par compacte_head() si le webmestre le desire, cette fonction
// compacte les scripts js dans un fichier statique pose dans local/
// en entree : un <head> html.
// http://doc.spip.org/@compacte_head_js
function compacte_head_js($flux) {
	$url_base = url_de_base();
	$url_page = substr(generer_url_public('A'), 0, -1);
	$dir = preg_quote($url_page,',').'|'.preg_quote(preg_replace(",^$url_base,",_DIR_RACINE,$url_page),',');

	$scripts = array();
	$flux_nocomment = preg_replace(",<!--.*-->,Uims","",$flux);
	foreach (extraire_balises($flux_nocomment,'script') as $s) {
		if (extraire_attribut($s, 'type') === 'text/javascript'
		AND $src = extraire_attribut($s, 'src')
		AND !strlen(strip_tags($s))
		AND (
			preg_match(',^('.$dir.')(.*)$,', $src, $r)
			OR (
				// ou si c'est un fichier
				$src = preg_replace(',^'.preg_quote(url_de_base(),',').',', '', $src)
				// enlever un timestamp eventuel derriere un nom de fichier statique
				AND $src2 = preg_replace(",[.]js[?].+$,",'.js',$src)
				// verifier qu'il n'y a pas de ../ ni / au debut (securite)
				AND !preg_match(',(^/|\.\.),', substr($src,strlen(_DIR_RACINE)))
				// et si il est lisible
				AND @is_readable($src2)
			)
		)) {
			if ($r)
				$scripts[$s] = explode('&',
					str_replace('&amp;', '&', $r[2]), 2);
			else
				$scripts[$s] = $src;
		}
	}

	if (list($src,$comms) = filtre_cache_static($scripts,'js')){
		$compacte_ecrire_balise_script = charger_fonction('compacte_ecrire_balise_script','');
		$scripts = array_keys($scripts);
		$flux = str_replace(reset($scripts),
			$comms .$compacte_ecrire_balise_script($src)."\n",
			$flux);
		$flux = str_replace($scripts,"",$flux);
	}

	return $flux;
}

// Appelee par compacte_head() si le webmestre le desire, cette fonction
// compacte les feuilles de style css dans un fichier statique pose dans local/
// en entree : un <head> html.
// http://doc.spip.org/@compacte_head_css
function compacte_head_css($flux) {
	$url_base = url_de_base();
	$url_page = substr(generer_url_public('A'), 0, -1);
	$dir = preg_quote($url_page,',').'|'.preg_quote(preg_replace(",^$url_base,",_DIR_RACINE,$url_page),',');

	$css = array();
	$flux_nocomment = preg_replace(",<!--.*-->,Uims","",$flux);
	foreach (extraire_balises($flux_nocomment, 'link') as $s) {
		if (extraire_attribut($s, 'rel') === 'stylesheet'
		AND (!($type = extraire_attribut($s, 'type'))
			OR $type == 'text/css')
		AND is_null(extraire_attribut($s, 'name')) # css nommee : pas touche
		AND is_null(extraire_attribut($s, 'id'))   # idem
		AND !strlen(strip_tags($s))
		AND $src = preg_replace(",^$url_base,",_DIR_RACINE,extraire_attribut($s, 'href'))
		AND (
			// regarder si c'est du format spip.php?page=xxx
			preg_match(',^('.$dir.')(.*)$,', $src, $r)
			OR (
				// ou si c'est un fichier
				// enlever un timestamp eventuel derriere un nom de fichier statique
				$src2 = preg_replace(",[.]css[?].+$,",'.css',$src)
				// verifier qu'il n'y a pas de ../ ni / au debut (securite)
				AND !preg_match(',(^/|\.\.),', substr($src2,strlen(_DIR_RACINE)))
				// et si il est lisible
				AND @is_readable($src2)
			)
		)) {
			$media = strval(extraire_attribut($s, 'media'));
			if ($media==='') $media='all';
			if ($r)
				$css[$media][$s] = explode('&',
					str_replace('&amp;', '&', $r[2]), 2);
			else
				$css[$media][$s] = $src;
		}
	}

	// et mettre le tout dans un cache statique
	foreach($css as $m=>$s){
		// si plus d'une css pour ce media ou si c'est une css dynamique
		if (count($s)>1 OR is_array(reset($s))){
			if (list($src,$comms) = filtre_cache_static($s,'css')){
				$compacte_ecrire_balise_link = charger_fonction('compacte_ecrire_balise_link','');
				$s = array_keys($s);
				$flux = str_replace(reset($s),
								$comms . $compacte_ecrire_balise_link($src,$m)."\n",
								$flux);
				$flux = str_replace($s,"",$flux);
			}
		}
	}

	return $flux;
}


// http://doc.spip.org/@filtre_cache_static
function filtre_cache_static($scripts,$type='js'){
	$nom = "";
	if (!is_array($scripts) && $scripts) $scripts = array($scripts);
	if (count($scripts)){
		$dir = sous_repertoire(_DIR_VAR,'cache-'.$type);
		$nom = $dir . md5(serialize($scripts)) . ".$type";
		if (
			$GLOBALS['var_mode']=='recalcul'
			OR !file_exists($nom)
		) {
			$fichier = "";
			$comms = array();
			$total = 0;
			foreach($scripts as $script){
				if (!is_array($script)) {
					// c'est un fichier
					$comm = $script;
					// enlever le timestamp si besoin
					$script = preg_replace(",[?].+$,",'',$script);
					if ($type=='css'){
						$fonctions = array('urls_absolues_css');
						if (isset($GLOBALS['compresseur_filtres_css']) AND is_array($GLOBALS['compresseur_filtres_css']))
							$fonctions = $GLOBALS['compresseur_filtres_css'] + $fonctions;
						$script = appliquer_fonctions_css_fichier($fonctions, $script);
					}
					lire_fichier($script, $contenu);
				}
				else {
					// c'est un squelette
					$comm = _SPIP_PAGE . "=$script[0]"
						. (strlen($script[1])?"($script[1])":'');
					parse_str($script[1],$contexte);
					$contenu = recuperer_fond($script[0],$contexte);
					if ($type=='css'){
						$fonctions = array('urls_absolues_css');
						if (isset($GLOBALS['compresseur_filtres_css']) AND is_array($GLOBALS['compresseur_filtres_css']))
							$fonctions = $GLOBALS['compresseur_filtres_css'] + $fonctions;
						$contenu = appliquer_fonctions_css_contenu($fonctions, $contenu, self('&'));
					}
				}
				$f = 'compacte_'.$type;
					$fichier .= "/* $comm */\n". $f($contenu) . "\n\n";
				$comms[] = $comm;
				$total += strlen($contenu);
			}

			// calcul du % de compactage
			$pc = ($total?intval(1000*strlen($fichier)/$total)/10:0);
			$comms = "compact [\n\t".join("\n\t", $comms)."\n] $pc%";
			$fichier = "/* $comms */\n\n".$fichier;

			// ecrire
			ecrire_fichier($nom,$fichier,true);
			// ecrire une version .gz pour content-negociation par apache, cf. [11539]
			ecrire_fichier("$nom.gz",$fichier,true);
		}

		// closure compiler ou autre super-compresseurs
		compresse_encore($nom, $type);

	}

	// Le commentaire detaille n'apparait qu'au recalcul, pour debug
	return array($nom, (isset($comms) AND $comms) ? "<!-- $comms -->\n" : '');
}

// experimenter le Closure Compiler de Google
function compresse_encore (&$nom, $type) {
	# Closure Compiler n'accepte pas des POST plus gros que 200 000 octets
	# au-dela il faut stocker dans un fichier, et envoyer l'url du fichier
	# dans code_url ; en localhost ca ne marche evidemment pas
	if (
	$GLOBALS['meta']['auto_compress_closure'] == 'oui'
	AND $type=='js'
	) {
		lire_fichier($nom, $fichier);
		$dest = dirname($nom).'/'.md5($fichier).'.js';
		if (!@file_exists($dest)) {
			include_spip('inc/distant');

			$datas=array(
				'output_format' => 'text',
				'output_info' => 'compiled_code',
				'compilation_level' => 'SIMPLE_OPTIMIZATIONS', // 'SIMPLE_OPTIMIZATIONS', 'WHITESPACE_ONLY', 'ADVANCED_OPTIMIZATIONS'
			);
			if (strlen($fichier) < 200000)
				$datas['js_code'] = $fichier;
			else
				$datas['url_code'] = url_absolue($nom);

			$cc = recuperer_page('http://closure-compiler.appspot.com/compile',
				$trans=false, $get_headers=false,
				$taille_max = null,
				$datas,
				$boundary = -1);
			if ($cc AND !preg_match(',^\s*Error,', $cc)) {
				spip_log('Closure Compiler: success');
				$cc = "/* $nom + Closure Compiler */\n".$cc;
				ecrire_fichier ($dest, $cc, true);
				ecrire_fichier ("$dest.gz", $cc, true);
			} else
				ecrire_fichier ($dest, '', true);
		}
		if (@filesize($dest))
			$nom = $dest;
	}
}

function appliquer_fonctions_css_fichier($fonctions,$css) {
	if (!preg_match(',\.css$,i', $css, $r)) return $css;

	$url_absolue_css = url_absolue($css);

	// verifier qu'on a un array
	if (is_string($fonctions))
		$fonctions = array($fonctions);

	$sign = implode(",",$fonctions);
	$sign = substr(md5("$css-$sign"), 0,8);

	$file = basename($css,'.css');
	$file = sous_repertoire (_DIR_VAR, 'cache-css')
		. preg_replace(",(.*?)(_rtl|_ltr)?$,","\\1-f-" . $sign . "\\2",$file)
		. '.css';

	if ((@filemtime($f) > @filemtime($css))
	AND ($GLOBALS['var_mode'] != 'recalcul'))
		return $f;

	if ($url_absolue_css==$css){
		if (strncmp($GLOBALS['meta']['adresse_site'],$css,$l=strlen($GLOBALS['meta']['adresse_site']))!=0
		 OR !lire_fichier(_DIR_RACINE . substr($css,$l), $contenu)){
		 		include_spip('inc/distant');
		 		if (!$contenu = recuperer_page($css))
					return $css;
		}
	}
	elseif (!lire_fichier($css, $contenu))
		return $css;

	$contenu = appliquer_fonctions_css_contenu($fonctions, $contenu, $css);

	// ecrire la css
	if (!ecrire_fichier($file, $contenu))
		return $css;

	return $file;
}

function appliquer_fonctions_css_contenu($fonctions, &$contenu, $base) {
	foreach($fonctions as $f)
		if (function_exists($f))
			$contenu = $f($contenu, $base);
	return $contenu;
}


function compresseur_embarquer_images_css($contenu, $source){
	#$path = suivre_lien(url_absolue($source),'./');
	$base = ((substr($source,-1)=='/')?$source:(dirname($source).'/'));

	return preg_replace_callback(
		",url\s*\(\s*['\"]?([^'\"/][^:]*[.](png|gif|jpg))['\"]?\s*\),Uims",
		create_function('$x',
			'return "url(\"".filtre_embarque_fichier($x[1],"'.$base.'")."\")";'
		), $contenu);
}