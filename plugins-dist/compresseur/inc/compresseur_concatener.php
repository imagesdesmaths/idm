<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined("_ECRIRE_INC_VERSION")) return;


/**
 * Concatener en un seul une liste de fichier,
 * avec appels de callback sur chaque fichier,
 * puis sur le fichier final
 *
 * Gestion d'un cache : le fichier concatene n'est produit que si il n'existe pas
 * pour la liste de fichiers fournis en entree  
 *
 *
 * @param array $files
 *   liste des fichiers a concatener, chaque entree sour la forme html=>fichier
 *   string $key : html d'insertion du fichier dans la page
 *   string|array $fichier : chemin du fichier, ou tableau (page,argument) si c'est un squelette
 * @param string $format
 *   js ou css utilise pour l'extension du fichier de sortie
 * @param array $callbacks
 *   tableau de fonctions a appeler :
 *   each_pre : fonction de preparation a appeler sur le contenu de chaque fichier
 *   each_min : fonction de minification a appeler sur le contenu de chaque fichier
 *   all_min : fonction de minification a appeler sur le contenu concatene complet, en fin de traitement
 * @return array
 *   tableau a 2 entrees retournant le nom du fichier et des commentairs html a inserer dans la page initiale
 */
function concatener_fichiers($files,$format='js', $callbacks = array()){
	$nom = "";
	if (!is_array($files) && $files) $files = array($files);
	if (count($files)){
		$callback_min = isset($callbacks['each_min'])?$callbacks['each_min']:'concatener_callback_identite';
		$callback_pre = isset($callbacks['each_pre'])?$callbacks['each_pre']:'';
	  $url_base = self('&');

		// on trie la liste de files pour calculer le nom
		// necessaire pour retomber sur le meme fichier
		// si on renome une url a la volee pour enlever le var_mode=recalcul
		// mais attention, il faut garder l'ordre initial pour la minification elle meme !
		$dir = sous_repertoire(_DIR_VAR,'cache-'.$format);
		$nom = $dir . md5(serialize($files).serialize($callbacks)) . ".$format";
		if (
			(defined('_VAR_MODE') AND _VAR_MODE=='recalcul')
			OR !file_exists($nom)
		) {
			$fichier = "";
			$comms = array();
			$total = 0;
			$files2 = false;
			foreach($files as $key=>$file){
				if (!is_array($file)) {
					// c'est un fichier
					$comm = $file;
					// enlever le timestamp si besoin
					$file = preg_replace(",[?].+$,",'',$file);

					// preparer le fichier si necessaire
					if ($callback_pre)
						$file = $callback_pre($file);
					
					lire_fichier($file, $contenu);
				}
				else {
					// c'est un squelette
					if (!isset($file[1])) $file[1] = '';
					$comm = _SPIP_PAGE . "=$file[0]"
						. (strlen($file[1])?"($file[1])":'');
					parse_str($file[1],$contexte);
					$contenu = recuperer_fond($file[0],$contexte);

					// preparer le contenu si necessaire
					if ($callback_pre)
						$contenu = $callback_pre($contenu, $url_base);
					// enlever le var_mode si present pour retrouver la css minifiee standard
					if (strpos($file[1],'var_mode')!==false) {
						if (!$files2) $files2 = $files;
						$old_key = $key;
						$key = preg_replace(',(&(amp;)?)?var_mode=[^&\'"]*,','',$key);
						$file[1] = preg_replace(',&?var_mode=[^&\'"]*,','',$file[1]);
						if (!strlen($file[1]))
							unset($file[1]);
						$files2 = array_replace_key($files2,$old_key,$key,$file);
					}
				}
				// passer la balise html initiale en second argument
				$fichier .= "/* $comm */\n". $callback_min($contenu, $key) . "\n\n";
				$comms[] = $comm;
				$total += strlen($contenu);
			}

			// calcul du % de compactage
			$pc = intval(1000*strlen($fichier)/$total)/10;
			$comms = "compact [\n\t".join("\n\t", $comms)."\n] $pc%";
			$fichier = "/* $comms */\n\n".$fichier;

			// si on a nettoye des &var_mode=recalcul : mettre a jour le nom
			// on ecrit pas dans le nom initial, qui est de toute facon recherche qu'en cas de recalcul
			// donc jamais utile
			if ($files2) {
				$files=$files2;
				$nom = $dir . md5(serialize($files).serialize($callbacks)) . ".$format";
			}

			$nom_tmp = $nom;
		  $final_callback = (isset($callbacks['all_min'])?$callbacks['all_min']:false);
		  if ($final_callback){
			  unset($callbacks['all_min']);
		    $nom_tmp = $dir . md5(serialize($files).serialize($callbacks)) . ".$format";
		  }
			// ecrire
			ecrire_fichier($nom_tmp,$fichier,true);
			// ecrire une version .gz pour content-negociation par apache, cf. [11539]
			ecrire_fichier("$nom_tmp.gz",$fichier,true);

		  if ($final_callback){
				// closure compiler ou autre super-compresseurs
				// a appliquer sur le fichier final
				$encore = $final_callback($nom_tmp, $nom);
		    // si echec, on se contente de la compression sans cette callback
			  if ($encore!==$nom){
					// ecrire
					ecrire_fichier($nom,$fichier,true);
					// ecrire une version .gz pour content-negociation par apache, cf. [11539]
					ecrire_fichier("$nom.gz",$fichier,true);
			  }
		  }
		}


	}

	// Le commentaire detaille n'apparait qu'au recalcul, pour debug
	return array($nom, (isset($comms) AND $comms) ? "<!-- $comms -->\n" : '');
}

function &concatener_callback_identite(&$contenu){
	return $contenu;
}

function &array_replace_key($tableau,$orig_key,$new_key,$new_value=null){
	$t = array();
  foreach($tableau as $k=>$v){
	  if ($k==$orig_key){
		  $k=$new_key;
	    if (!is_null($new_value))
		    $v = $new_value;
	  }
    $t[$k] = $v;
  }
  return $t;
}
