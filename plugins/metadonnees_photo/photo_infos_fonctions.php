<?php


// Lire aux:Lens, qui n'est pas du Exif standard
function lire_aux_lens ($filename) {

    ob_start();
    readfile($filename);
    $source = ob_get_contents();
    ob_end_clean();
    
    $xmpdata_start = strpos($source,"<x:xmpmeta");
    $xmpdata_end = strpos($source,"</x:xmpmeta>");
    $xmplenght = $xmpdata_end-$xmpdata_start;
    $xmpdata = substr($source,$xmpdata_start,$xmplenght+12);
    
    if (mb_eregi("aux:Lens=\"([^\"]*)\"", $xmpdata, $regs)) {
		return $regs[1];
    }
    if (mb_eregi("<aux:Lens>([^<]*)<\/aux:Lens>", $xmpdata, $regs)) {
		return $regs[1];
    }
}

function extraire_exif($fichier) {
	global $pb_exif;
	
	if ($pb_exif["$fichier"]) return $pb_exif["$fichier"];

	if (!file_exists($fichier)) return;

		$time = filemtime($fichier);

		$fichier_exif = sous_repertoire(_DIR_VAR, 'cache-exif') . md5($fichier.$time).".php";


		// Systeme de cache pour les variables exif								
		if (file_exists($fichier_exif)) {
			lire_fichier($fichier_exif, $pb_ecrire);
			$pb_exif["$fichier"] = unserialize($pb_ecrire);

			return $pb_exif["$fichier"];
		}
		
	
		include_spip("inc/exifReader");
	
	 	$er = new phpExifReader($fichier);
		$er->processFile();
		$pb_exif["$fichier"] = $er->getImageInfo();	

		// Essayer de trouver aux:Lens
		$pb_exif["$fichier"]["auxLens"] = str_replace(" mm", "&nbsp;", lire_aux_lens($fichier));



		// Completer GPS
		if (function_exists(exif_read_data)) {
			$exif_direc = exif_read_data($fichier);
			
			// Si Latitude deja fixee, la traiter
			// Si la ref n'est ni N ni S, c'est une erreur (j'en trouve sur Flickr)
			if (!($exif_direc["GPSLatitudeRef"] == "N" || $exif_direc["GPSLatitudeRef"] == "S")) {
				unset($pb_exif["$fichier"]["GPSLatitude"]);
			}
			if ($pb_exif["$fichier"]["GPSLatitude"]) {
				$exif_direc["GPSLatitude"][0] = $pb_exif["$fichier"]["GPSLatitude"]["Degrees"];
				$exif_direc["GPSLatitude"][1] = ($pb_exif["$fichier"]["GPSLatitude"]["Minutes"] * 100 + round($pb_exif["$fichier"]["GPSLatitude"]["Seconds"] / 60 * 100)) . "/100";
				
				$exif_direc["GPSLatitudeRef"] = $pb_exif["$fichier"]["GPSLatitudeRef"];
			}
			// Traiter la Latitude
			// Retourne GPSLatitude en degres, minutes, secondes
			// Retour GPSLatitudeInt en valeur entiere pour Google
			if (isset($exif_direc["GPSLatitude"])) {
			
				$deg = $exif_direc["GPSLatitude"][0];
				if ( strpos($deg, "/") > 0) {
					$deg = substr($deg, 0, strpos($deg, "/"));
				}
				
				$min = $exif_direc["GPSLatitude"][1];
				if ( strpos($min, "/") > 0) {
					$minutes = substr($min, 0, strpos($min, "/"));
					$rap = substr($min, strpos($min, "/")+1, 12);
					
					$minutes = $minutes / $rap;
					
					$secondes = ($minutes - floor($minutes)) * 60 ;
					$minutes = floor($minutes);
				}
				
				$N_S = $exif_direc["GPSLatitudeRef"];
				$pb_exif["$fichier"]["GPSLatitude"] = $deg."°&nbsp;$minutes"."’"."&nbsp;$secondes"."”&nbsp;$N_S";

				// Retourne aussi une valeur entiere pour Google Maps				
				$GPSLatitudeInt = $deg + ($min / 6000) ;
				if ($N_S == "S") $GPSLatitudeInt = -1 * $GPSLatitudeInt;
				$pb_exif["$fichier"]["GPSLatitudeInt"] = $GPSLatitudeInt ;
			}

			// Verifier que la precedente ref est E/W, sinon ne pas traiter
			if (!($exif_direc["GPSLongitudeRef"] == "E" || $exif_direc["GPSLongitudeRef"] == "W")) {
				unset($pb_exif["$fichier"]["GPSLongitude"]);
			}
			if ($pb_exif["$fichier"]["GPSLongitude"]) {
				$exif_direc["GPSLongitude"][0] = $pb_exif["$fichier"]["GPSLongitude"]["Degrees"];
				$exif_direc["GPSLongitude"][1] = ($pb_exif["$fichier"]["GPSLongitude"]["Minutes"] * 100 + round($pb_exif["$fichier"]["GPSLongitude"]["Seconds"] / 60 * 100)) . "/100";
				
				$exif_direc["GPSLongitudeRef"] = $pb_exif["$fichier"]["GPSLongitudeRef"];
			}
			// Traiter longitude
			if (isset($exif_direc["GPSLongitude"])) {
				$deg = $exif_direc["GPSLongitude"][0];
				if ( strpos($deg, "/") > 0) {
					$deg = substr($deg, 0, strpos($deg, "/"));
				}
				
				$min = $exif_direc["GPSLongitude"][1];
				if ( strpos($min, "/") > 0) {
					$minutes = substr($min, 0, strpos($min, "/"));
					$rap = substr($min, strpos($min, "/")+1, 12);
					
					$minutes = $minutes / $rap;
					
					$secondes = ($minutes - floor($minutes)) * 60 ;
					$minutes = floor($minutes);
				}
				
				$W_E = $exif_direc["GPSLongitudeRef"];
				$pb_exif["$fichier"]["GPSLongitude"] =  $deg."°&nbsp;$minutes"."’"."&nbsp;$secondes"."”&nbsp;$W_E";

				// Retourne aussi une valeur entiere pour Google Maps				
				$GPSLongitudeInt = $deg + ($min / 6000) ;
				if ($W_E == "W") $GPSLongitudeInt = -1 * $GPSLongitudeInt;
				$pb_exif["$fichier"]["GPSLongitudeInt"] = $GPSLongitudeInt ;
			}
			
			
		}
	
		$pb_ecrire = serialize($pb_exif["$fichier"]);
		ecrire_fichier($fichier_exif, $pb_ecrire);
	
	
		return $pb_exif["$fichier"];
}

function lire_exif($fichier, $type=false) {
	
	$exif = extraire_exif($fichier);
	
//	print_r($exif);	
	
	if (!$type) return $exif;
	else return $exif["$type"];
	
	
	
}

function extraire_iptc($fichier) {
	global $pb_iptc;
	
	if ($pb_iptc["$fichier"]) return $pb_iptc["$fichier"];


	if (!file_exists($fichier)) return;
	

		$time = filemtime($fichier);

		$fichier_iptc = sous_repertoire(_DIR_VAR, 'cache-iptc') . md5($fichier.$time).".php";

		// Systeme de cache pour les variables iptc								
		if (file_exists($fichier_iptc)) {
			lire_fichier($fichier_iptc, $pb_ecrire);
			$pb_iptc["$fichier"] = unserialize($pb_ecrire);

			return $pb_iptc["$fichier"];
		}
	
		include_spip("inc/iptc");

		$er = new class_IPTC($fichier);
		$iptc = $er->fct_lireIPTC();
		$codesiptc = $er->h_codesIptc;
		
		$pb_iptc["$fichier"] = $iptc;	
	
		$pb_ecrire = serialize($pb_iptc["$fichier"]);
		ecrire_fichier($fichier_iptc, $pb_ecrire);
	
	
		return $pb_iptc["$fichier"];
}


function lire_iptc ($fichier, $type=false) {
	if (!function_exists(iptcparse)) return;

	$iptc = extraire_iptc($fichier);
	

	if ($iptc["copyright"]) $iptc["copyright"] = mb_eregi_replace("\(c\)", "©", $iptc["copyright"]);
	
	if ($type) return $iptc["$type"];
	else return $iptc;
	
}

function test_traiter_image($im, $largeur, $hauteur) {
	$surface = $largeur * $hauteur;

	if ($surface > $GLOBALS["meta"]["max_taille_vignettes_echec"]) return false;
	else return true;
	
	
}

function image_histogramme($im) {
	include_spip("inc/filtres_images");
	
	$fonction = array('image_histo', func_get_args());
	$image = image_valeurs_trans($im, "histo","png",$fonction);
	
	if (!$image) return("");
	
	$x_i = $image["largeur"];
	$y_i = $image["hauteur"];
	$surface = $x_i * $y_i;
	
	if (!test_traiter_image($im, $x_i, $y_i) ) return;
	
	
	$im = $image["fichier"];
	
	$dest = $image["fichier_dest"];
	$creer = $image["creer"];

	if ($creer) {
		$im = $image["fonction_imagecreatefrom"]($im);
		$im_ = imagecreatetruecolor(258, 130);
		@imagealphablending($im_, false);
		@imagesavealpha($im_,true);
		$color_t = ImageColorAllocateAlpha( $im_, 255, 255, 255 , 50);
		imagefill ($im_, 0, 0, $color_t);
		$col_poly = imagecolorallocate($im_,60,60,60);
		imagepolygon($im_, array ( 0, 0, 257, 0, 257, 129, 0,129 ), 4, $col_poly);

		for ($x = 0; $x < $x_i; $x++) {
			for ($y=0; $y < $y_i; $y++) {

				$rgb = ImageColorAt($im, $x, $y);
				$a = ($rgb >> 24) & 0xFF;
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;

				$a = (127-$a) / 127;
				$a=1;
				
				$gris = round($a*($r+$g+$b) / 3);
				$r = round($a*$r);
				$g = round($a*$g);
				$b = round($a*$b);
				
				$val_gris[$gris] ++;
				$val_r[$r] ++;
				$val_g[$g] ++;
				$val_b[$b] ++;
			} 
		}
		$max = max( max($val_gris), max($val_r), max($val_g), max($val_b));
		
		// Limiter Max si trop concentr'e
		$max = min ($max, round($surface*0.03));

		$rapport = (127/$max);

		$gris_50 = imagecolorallocate($im_, 170,170,170);
		$gris_70 = imagecolorallocate($im_, 60,60,60);
		for ($i = 0; $i < 256; $i++) {
			$val = 127 - round(max(0,$val_gris[$i]) * $rapport);
			imageline ($im_, $i+1, 128, $i+1, $val+1, $gris_50);
			imagesetpixel ($im_, $i+1, $val+1, $gris_70);
		}
		$bleu = imagecolorallocate($im_, 0, 0, 255);
		for ($i = 0; $i < 256; $i++) {
			$val = 127 - round(max(0,$val_b[$i]) * $rapport);
			if ($i==0) imagesetpixel ($im_, $i+1, $val+1, $bleu);
			else imageline($im_, $i, $val_old+1, $i+1, $val+1, $bleu);

			$val_old = $val;
		}
		$green = imagecolorallocate($im_, 0, 255, 0);
		for ($i = 0; $i < 256; $i++) {
			$val = 127 - round(max(0,$val_g[$i]) * $rapport);
			if ($i==0) imagesetpixel ($im_, $i+1, $val+1, $green);
			else imageline($im_, $i, $val_old+1, $i+1, $val+1, $green);
			$val_old = $val;
		}
		$rouge = imagecolorallocate($im_, 255, 0, 0);
		for ($i = 0; $i < 256; $i++) {
			$val = 127 - round(max(0,$val_r[$i]) * $rapport);
			if ($i==0) imagesetpixel ($im_, $i+1, $val+1, $rouge);
			else imageline($im_, $i, $val_old+1, $i+1, $val+1, $rouge);
			$val_old = $val;
		}

		$image["fonction_image"]($im_, "$dest");
		imagedestroy($im_);
		imagedestroy($im);
	}

	return "<img src='$dest' style='width: 258px; height: 130px;'  />";
}

function position_carte ($latitude, $longitude, $taille) {
	if (strlen($latitude) == 0 && strlen($longitude) == 0) return;

	$img = find_in_path("imgs_photo/earth-map-$taille.jpg");
	$img = "<img src='$img' alt='carte' />";
	
	
	$n = round(($taille / 4) - (($latitude / 90) * ($taille / 4)));
	$l = round(($taille / 2) + (($longitude / 180) * ($taille / 2)));
	
	$n = ($n - 4)."px";
	$l = ($l - 4)."px";
	
	$croix = find_in_path("imgs_photo/croix-gps.gif");
	$croix = "<img src='$croix' alt='+' />";

	
	return "<div style='position: relative; text-align: left;'><div>$img</div><div style='position: absolute; top: $n; left: $l;'>$croix</div></div>";
}


?>
