<?php

// filtre qui extrait le contenu texte d'une page html pour rendre du texte plein
function version_plein_texte($texte){

	$texte = charset2unicode($texte);
	$texte = strtr($texte, array('&amp;'=>'&', '&quot;'=>'"', '&lt;'=>'<', '&gt;'=>'>', '&egrave;'=>'&#232;', '&eacute;'=>'&#233;', '&agrave;' => '&#224;')	);
	
	$cherche = array (
/*a1*/		',</?h1[^>]*>,',
/*a2*/		',</?h2[^>]*>,',
/*a3*/		',<h3[^>]*>,',
/*a3*/		',</h3[^>]*>,',
/*01*/		'@<script[^>]*?>.*?</script>@si', // Supprime le javascript
/*02*/		'@<style[^>]*?>.*?</style>@si',	// Supprime les styles inline
/*03*/		",<link[^>]*>,Uims",			// les css
/*04*/		",<img[^>]*alt=['\"]([^'\"]*)['\"][^>]*>,Uims", // les images
/*05*/		',(<(div|br|p)),i',
/*06*/		'@<[\/\!]*?[^<>]*?'.'>@si',		// Supprime les balises HTML
/*07*/		'@([\r\n])[\s]+@',				// Supprime les espaces
/*08*/		',[\r\n][_]{2},sm',
/*09*/		'@&(quot|#34);@i',				// Remplace les entites HTML
/*10*/		'@&(amp|#38);@i',
/*11*/		'@&(lt|#60);@i',
/*12*/		'@&(gt|#62);@i',
/*13*/		'@&(nbsp|#160);@i',
/*14*/		'@&(iexcl|#161);@i',
/*15*/		'@&(cent|#162);@i',
/*16*/		'@&(pound|#163);@i',
/*17*/		'@&(copy|#169);@i',
/*18*/		'@&#8217;@i',
/*19*/		'@&#(\d+);@e'
	);

	$remplace = array (
/*a1*/		"\n__--------------------------------------------------------\n",
/*a2*/		"\n__...........\n",
/*a3*/		"\n__\n__+++",
/*a3*/		"+++",
/*01*/		'',
/*02*/		'',
/*03*/		'',
/*04*/		'[\1]',
/*05*/		"\n__\\1",
/*06*/		'',
/*07*/		'\1',
/*08*/		"\n",
/*09*/		'"',
/*10*/		'&',
/*11*/		'<',
/*12*/		'>',
/*13*/		' ',
/*14*/		chr(161),
/*15*/		chr(162),
/*16*/		chr(163),
/*17*/		chr(169),
/*18*/		"'",
/*19*/		'chr(\1)' // Evaluation comme PHP
	);
	
	$texte = preg_replace($cherche, $remplace, $texte);
	return $texte;	
}

// filtre qui extrait le contenu texte d'une page html, a l'exclusion de quelques balises elementaires
function version_texte($texte){
	$texte = charset2unicode($texte);

	// accentuer le texte avant de suprimer les tags
	$texte = strtr($texte, array('&amp;'=>'&', '&quot;'=>'"', '&lt;'=>'<', '&gt;'=>'>', '&egrave;'=>'&#232;', '&eacute;'=>'&#233;', '&agrave;' => '&#224;')	);
	
	$cherche = array (
/*01*/		'@<script[^>]*?>.*?</script>@si', // Supprime le javascript
/*02*/		'@<style[^>]*?>.*?</style>@si', // Supprime les styles inline
/*03*/		",<link[^>]*>,Uims",			// les css
/*04*/		",<img[^>]*alt=['\"]([^'\"]*)['\"][^>]*>,Uims", // les images
	);
	
	$remplace = array (
/*01*/		'',
/*02*/		'',
/*03*/		'',
/*04*/		'[\1]',
	);

	// voir : TODO.txt
	
	$texte = preg_replace($cherche, $remplace, $texte);
	return $texte;
}
?>