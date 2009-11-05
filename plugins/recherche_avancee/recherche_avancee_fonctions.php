<?php
/*
 *   +----------------------------------+
 *    Filtres :    google_like
 *   +----------------------------------+
 *    Créé le 28 septembre 2004 : Nicolas Steinmetz,  pdepaepe
 *	  http://www.spip-contrib.net/Google-Like
 *   +-------------------------------------+
 *  - Conversion automatique en texte brut et sans accent
 *	- Affichage des mots entiers seulement 
 *	- Surlignage des mots 
 *	- Affichage d'un resume si on ne trouve rien
*/

function recherche_avancee_google_like($string, $resume='')
{	// Convertir en texte brut sans accent
	$string = textebrut($string);
	$string = translitteration($string);
	$rech = translitteration($_GET['recherche']);
	// Supprimer les caracteres qui m...
	$badguy = array("^", "/", "\\", "$", "@", "*");
	$rech = str_replace($badguy,"",$rech);
	// en avant
	$query = rtrim(str_replace("+", " ", $rech));  
	$qt = explode(" ", $query);
	$num = count ($qt);
	// $cc = ceil(55 / $num);
	$cc=55;
	for ($i = 0; $i < $num; $i++) 
	{	//$tab[$i] = preg_split("/($qt[$i])/i",$string,2, PREG_SPLIT_DELIM_CAPTURE);
		$tab[$i] = preg_split("/\b($qt[$i])/i",$string,2, PREG_SPLIT_DELIM_CAPTURE);
		if(count($tab[$i])>1)
		{	// Chaine avant
			$avant = substr($tab[$i][0],-$cc,$cc);
			$mots = split(" ",$avant,2);
			if (count($mots)>1) $avant = $mots[1];
			// Chaine apres
			$apres = substr($tab[$i][2],0,$cc);
			$apres = preg_replace('@(.+)\s\S+@s', '\1', $apres);
			// Concatener
			if ($string_re=='') $string_re = "<i class=rsusp>[...]</i>";
			$string_re .= " $avant<span class=spip_surligne>".$tab[$i][1]."</span>$apres <i class=rsusp>[...]</i> ";
		}
	}
	// Si rien trouve : renvoyer les premiers mots en resume
	if ($resume!='' && $string_re=='')
	{	$mots = split(" ",$string,40);
		for ($i = 0; $i < count($mots)-1; $i++)
		{	$string_re .= $mots[$i]." ";
			if (strlen($string_re)>2*$cc) break;
		}
		$string_re .= "<i class=rsusp>[...]</i>";
	}
	return $string_re;
}

?>