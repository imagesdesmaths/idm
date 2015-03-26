<?php
/*
 * Plugin Facteur 2
 * (c) 2009-2011 Collectif SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Transformer un mail texte ou HTML simplifie en mail HTML complet avec le wrapper emails/texte.html
 * Si le mail est un mail texte :
 *   la premiere ligne est le sujet
 *   le reste est le corps du mail
 *
 * Si le mail est un mail HTML simplifie :
 *   le sujet est entre <title></title>
 *   le corps est entre <body></body>
 *   une eventuelle intro peut etre fournie entre <intro></intro>
 *
 * @param string $texte_ou_html
 * @return string
 */
function facteur_email_wrap_to_html($texte_ou_html){
	$texte_ou_html = trim($texte_ou_html);
	// attention : si pas de contenu on renvoi du vide aussi (mail vide = mail vide)
	if (!strlen(trim($texte_ou_html)))
		return $texte_ou_html;

	$contexte = array("sujet"=>"","texte"=>"","intro"=>"");

	// tester si le mail est en html (simplifie)
	if (substr($texte_ou_html,0,1)=="<"
	  AND substr($texte_ou_html,-1,1)==">"
	  AND stripos($texte_ou_html,"</body>")!==false){

		// dans ce cas on ruse un peu : extraire le sujet du title
		$sujet = "";
		if (preg_match(",<title>(.*)</title>,Uims",$texte_ou_html,$m)){
			$contexte['sujet'] = $m[1];
			$texte_ou_html = preg_replace(",<title>(.*)</title>,Uims","",$texte_ou_html,1);
			$texte_ou_html = trim($texte_ou_html);
		}
		if (preg_match(",<intro>(.*)</intro>,Uims",$texte_ou_html,$m)){
			$contexte['intro'] = $m[1];
			$texte_ou_html = preg_replace(",<intro>(.*)</intro>,Uims","",$texte_ou_html,1);
			$texte_ou_html = trim($texte_ou_html);
		}
		$contexte['html'] = preg_replace(",</?body>,ims","",$texte_ou_html);
	}
	else {
		// la premiere ligne est toujours le sujet
		$texte_ou_html = explode("\n",$texte_ou_html);
		$contexte['sujet'] = trim(array_shift($texte_ou_html));
		$contexte['texte'] = trim(implode("\n",$texte_ou_html));
	}

	// attention : si pas de contenu on renvoi du vide aussi (mail vide = mail vide)
	if (!strlen(trim(implode("",$contexte))))
		return "";

	return recuperer_fond("emails/texte",$contexte);
}

	/*

	Written by Eric Dols - edols@auditavenue.com

	You may freely use or modify this, provided
	you leave credits to the original coder.
	Feedback about (un)successfull uses, bugs and improvements done
	are much appreciated, but don't expect actual support.

	PURPOSE OF THIS FUNCTION
		It is designed to process html emails relying
		on a css stylesheet placed in the <head> for layout in
		order to enhance compatibility with email clients,
		including webmail services.
		Provided you use minimal css, you can keep styling separate
		from the content in your email template, and let this function
		"inject" those styles inline in your email html tags on-the-fly,
		just before sending.
		Technically, it grabs the style declarations found in the
		<head> section and inserts each declaration inline,
		inside the corresponding html tags in the email message.

		Supports both HTML and XHTML markup seamlessly. Thus
		tolerant to email message writers using non-xhtml tag,
		even when template is xhtml compliant (e.g. they would
		add <img ...> instead of a xhtml compliant <img ... />).

	NEW 10 dec. 2003:
		- code revised, including a few regexp bugs fixed.
		- multiple class for a tag are now allowed <p class="firstclass secondclass">
		- all unsupported css styles are now moved to the body section (not just a:hover etc...)

	USE
		Add this function to a function library include, like "inline.inc"
		and include it near the beginning of your php page:
		require ("inline.inc");

		load the html source of message into a variable
		like $html_source and process it using:
		$html_source = sheet2inline($html_source)


	STYLE DEFINITIONS SUPPORTED
		TAG { ... }
		TAG1, TAG2, ... { ... }
		TAG.class { ... }
		.class { ...)
		TAG:pseudo { ... }


		CSS definitions may be freely formatted (spaces, tabs, linefeeds...),
		they are converted to oneliners before inserting them inline in the html tags.

		.class definitions are processed AFTER tag definitions,
		thus appended inline after any existing tag styling to
		preserve the normal css priority behavior.

		Existing style="..." attributes in tags are NOT stripped. However they MUST
		be with double quotes. If not, an addtional style="..." attribute will be added


	KNOWN LIMITATIONS
		- style info should be placed in <head> section. I believe
			it shouldnt be too hard to modify to point to an external
			stylesheet instead.
		- no support (yet?):
			* chains like P UL LI { .... } or P UL LI.class { .... }
			* #divname p { ... } and <tag id="...">
			* a:hover, a:visited {...} multiple class:pseudo
			They require a significantly more complicated processing likely
			based on stylesheet and document trees parsing.
			Many email clients don't handle more than what is supported
			by this script anyway.
		- pseudo-classes like a:hover {...} can't be inserted inline
			in the html tags: they are moved to a <style> declaration in
			the <body> instead. This is a limitation from html, not this script.
		- It is still up to you to check if target email clients render
			your css styled templates correctly, especially webmail services
			like Hotmail, in which the email becomes a sub-part of an html page,
			with styles already in place.
	*/
function facteur_convertir_styles_inline($body){
	// variables to be accessed in the callback sub-function too
	global $styledefinition, $styletag, $styleclass;

	// Let's first load the stylesheet information in a $styles array using a regexp
	preg_match_all ( "/^[ \t]*([.]?)([\w, #]+)([.:])?(\S*)\s+{([^}]+)}/mi", $body , $styles);
	/*
		$styles[1] = . or ''  => .class or tag (empty)
		$styles[2] = name of class or tag(s)
		$styles[3] = : . or '' => followed by pseudo-element, class separator or nothing (empty)
		$styles[4] = name of pseudo-element after a tag, if any
		$styles[5] = the style definition itself, i.e. what's between the { }
	*/

	// Now loop through the styles found and act accordingly;

	// process TAG {...} & TAG1, TAG2,... {...} definitions only first by order of appearance
	foreach ($styles[1] as $i => $type) {
		if ($type=="" && $styles[3][$i]=="") {
			$styledefinition = trim($styles[5][$i]);
			$styletag = preg_replace("/ *, */", "|", trim($styles[2][$i])); //echo $styletag."<br />";
			$styleclass = "";
			// process TAG {...} and TAG1, TAG2 {...} but not TAG1 TAG2 {...} or #divname styles
			if (!preg_match("/ /", $styletag) && !preg_match("/#/", $styletag)) {
				$pattern = "!<(".$styletag.")([^>]*(?= /)|[^>]*)( /)?>!mi";
				$body = preg_replace_callback ($pattern, 'facteur_addstyle' , $body);
				$styles[6][$i]=1; // mark as injected inline
			}
		}
	}

	// append additional .CLASS {...} and TAG.CLASS {...} styling by order of appearance
	// important to do so after TAG {...} definitions, so that class attributes override TAG styles when needed
	foreach ($styles[1] as $i => $type) {
		if ($type!="." && $styles[3][$i]=="." ) {	// class definition for a specific tag
			$styledefinition = trim($styles[5][$i]);
			$styletag = trim($styles[2][$i]);
			$styleclass = trim($styles[4][$i]);
			$pattern = "!<(".$styletag.")([^>]* class\=['\"][^'\"]*".$styleclass."[^'\"]*['\"][^>]*(?= /)|[^>]* class\=['\"][^'\"]*".$styleclass."[^'\"]*['\"][^>]*)( />)?>!mi";
			$body = preg_replace_callback ($pattern, 'facteur_addstyle' , $body);
			$styles[6][$i]=1; // mark as injected inline

		}
		elseif ($type=="." && $styles[3][$i]=="" ) {	// general class definition for any tag
			$styledefinition = trim($styles[5][$i]);
			$styletag = "";
			$styleclass = trim($styles[2][$i]);
			$pattern = "!<(\w+)([^>]* class\=['\"]".$styleclass."['\"][^>]*(?= /)|[^>]* class\=['\"]".$styleclass."['\"][^>]*)( />)?>!mi";
			$body = preg_replace_callback ($pattern, 'facteur_addstyle' , $body);
			$styles[6][$i]=1; // mark as injected inline
		}
	}


	/* move all style declarations that weren't injected from <head> to a <body> <style> section,
		 including but not limited to:
		 - pseudo-classes like a:hover {...} as they can't be set inline
		 - declaration chains like UL LI {...}
		 - #divname {...}. These are not supported by email clients like Mac/Entourage anyway, it seems. */
	foreach ($styles[1] as $i => $type) {
		if ($styles[6][$i]=="") {
			// add a <style type="text/css"> section after <body> if there's isn't one yet
			if (preg_match ("!<body[^>]*>\s*<style!mi", $body)==0) {
				$body = preg_replace ("/(<body[^>]*>)/i", "\n\$1\n".'<style type="text/css">'."\n<!--\n-->\n</style>\n", $body);
			}
			// append a copy of the pseudo-element declaration to that body style section
			$styledefinition = trim($styles[5][$i]);
			$styledefinition = preg_replace ("!\s+!mi", " ", $styledefinition ); // convert style definition to a one-liner (optional)
			$declaration = $styles[1][$i].trim($styles[2][$i]).$styles[3][$i].trim($styles[4][$i])." { ".$styledefinition." }";
			$body = preg_replace ("!(<body[^>]*>\s*<style[^>]*>\s*<\!\-\-[^>]*)"."(\s*\-\->\s*</style>)!si", "\$1".$declaration."\n\$2", $body);
			$styles[6][$i]= 2; // mark as moved to <style> section in <body>
		}
	}

	// remove stylesheet declaration(s) from <head> section (comment following line out if not wanted)
	//$body = preg_replace ("!(<head>.*)<style type.*</style>(.*</head>)!si", "\$1\$2" , $body);

	// check what styles have been injected
#			print_r($styles);

	return $body;
}

/**
 * facteur_addstyle
 * @author Eric Dols
 *
 * @param $matches
 * @return string
 */
function facteur_addstyle($matches) {

	// $matches[1]=tag, $matches[2]=tag attributes (if any), $matches[3]=xhtml closing (if any)

	// variables values set in calling function
	global $styledefinition, $styletag, $styleclass;

	// convert the style definition to a one-liner
	$styledefinition = preg_replace ("!\s+!mi", " ", $styledefinition );
	// convert all double-quotes to single-quotes
	$styledefinition = preg_replace ('/"/','\'', $styledefinition );

	if (preg_match ("/style\=/i", $matches[2])) {
			// add styles to existing style attribute if any already in the tag
			$pattern = "!(.* style\=)[\"]([^\"]*)[\"](.*)!mi";
			$replacement = "\$1".'"'."\$2 ".$styledefinition.'"'."\$3";
			$attributes = preg_replace ($pattern, $replacement , $matches[2]);
	} else {
			// otherwise add new style attribute to tag (none was present)
			$attributes = $matches[2].' style="'.$styledefinition.'"';
	}

	if ($styleclass!="") {
		// if we were injecting a class style, remove the now useless class attribute from the html tag

		// Single class in tag case (class="classname"): remove class attribute altogether
		$pattern = "!(.*) class\=['\"]".$styleclass."['\"](.*)!mi";
		$replacement = "\$1\$2";
		$attributes = preg_replace ( $pattern, $replacement, $attributes);

		// Multiple classes in tag case (class="classname anotherclass..."): remove class name from class attribute.
		// classes are injected inline and removed by order of appearance in <head> stylesheet
		// exact same behavior as where last declared class attributes in <style> take over (IE6 tested only)
		$pattern = "!(.* class\=['\"][^\"]*)(".$styleclass." | ".$styleclass.")([^\"]*['\"].*)!mi";
		$replacement = "\$1\$3";
		$attributes = preg_replace ( $pattern, $replacement, $attributes);

	}

	return "<".$matches[1].$attributes.$matches[3].">";
}

/**
 * Un filtre pour transformer les retour ligne texte en br si besoin (si pas autobr actif)
 *
 * @param string $texte
 * @return string
 */
function facteur_nl2br_si_pas_autobr($texte){
	return (_AUTOBR?$texte:nl2br($texte));
}

/**
 * Transformer un mail HTML en mail Texte proprement :
 * - les tableaux de mise en page sont utilisés pour structurer le mail texte
 * - le reste du HTML est markdownifie car c'est un format texte lisible et conventionnel
 *
 * @param string $html
 * @return string
 */
function facteur_mail_html2text($html){
	// nettoyer les balises de mise en page html
	$html = preg_replace(",</(td|th)>,Uims","<br/>",$html);
	$html = preg_replace(",</(table)>,Uims","@@@hr@@@",$html);
	$html = preg_replace(",</?(html|body|table|td|th|tbody|thead|center|article|section|span)[^>]*>,Uims","\n\n",$html);

	// commentaires html et conditionnels
	$html = preg_replace(",<!--.*-->,Uims","\n",$html);
	$html = preg_replace(",<!\[.*\]>,Uims","\n",$html);

	$html = preg_replace(",<(/?)(div|tr|caption)([^>]*>),Uims","<\\1p>",$html);
	$html = preg_replace(",(<p>\s*)+,ims","<p>",$html);
	$html = preg_replace(",<br/?>\s*</p>,ims","</p>",$html);
	$html = preg_replace(",</p>\s*<br/?>,ims","</p>",$html);
	$html = preg_replace(",(</p>\s*(@@@hr@@@)?\s*)+,ims","</p>\\2",$html);
	$html = preg_replace(",(<p>\s*</p>),ims","",$html);

	// succession @@@hr@@@<hr> et <hr>@@@hr@@@
	$html = preg_replace(",@@@hr@@@\s*(<[^>]*>\s*)?<hr[^>]*>,ims","@@@hr@@@\n",$html);
	$html = preg_replace(",<hr[^>]*>\s*(<[^>]*>\s*)?@@@hr@@@,ims","\n@@@hr@@@",$html);

	$html = preg_replace(",<textarea[^>]*spip_cadre[^>]*>(.*)</textarea>,Uims","<code>\n\\1\n</code>",$html);

	// vider le contenu de qqunes :
	$html = preg_replace(",<head[^>]*>.*</head>,Uims","\n",$html);

	// Liens :
	// Nettoyage des liens des notes de bas de page
	$html = preg_replace("@<a href=\"#n(b|h)[0-9]+-[0-9]+\" name=\"n(b|h)[0-9]+-[0-9]+\" class=\"spip_note\">([0-9]+)</a>@", "\\3", $html);
	// Supprimer tous les liens internes
	$html = preg_replace("/\<a href=['\"]#(.*?)['\"][^>]*>(.*?)<\/a>/ims","\\2", $html);
	// Remplace tous les liens
	preg_match_all("/\<a href=['\"](.*?)['\"][^>]*>(.*?)<\/a>/ims", $html,$matches,PREG_SET_ORDER);
	$prelinks = $postlinks = array();
	if (!function_exists('url_absolue'))
		include_spip('inc/filtres');
	foreach ($matches as $k => $match){
		$link = "@@@link$k@@@";
		$url = str_replace("&amp;","&",$match[1]);
		if ($match[2]==$match[1] OR $match[2]==$url){
			// si le texte est l'url :
			$prelinks[$match[0]] = "$link";
		}
		else {
			// texte + url
			$prelinks[$match[0]] = $match[2] . " ($link)";
		}
		// passer l'url en absolu dans le texte sinon elle n'est pas clicable ni utilisable
		$postlinks[$link] = url_absolue($url);
	}
	$html = str_replace(array_keys($prelinks), array_values($prelinks),$html);

	// les images par leur alt ?
	// au moins les puces
	$html = preg_replace(',<img\s[^>]*alt="-"[^>]*>,Uims','-',$html);
	// les autres
	$html = preg_replace(',<img\s[^>]*alt=[\'"]([^\'"]*)[\'"][^>]*>,Uims',"\\1",$html);
	// on vire celles sans alt
	$html = preg_replace(",</?(img)[^>]*>,Uims","\n",$html);

	// espaces
	$html = str_replace("&nbsp;"," ",$html);
	$html = preg_replace(",<p>\s+,ims","<p>",$html);

	#return $html;
	include_spip("lib/markdownify/markdownify");
	$parser = new Markdownify('inline',false,false);
	$texte = $parser->parseString($html);

	$texte = str_replace(array_keys($postlinks), array_values($postlinks),$texte);


	// trim et sauts de ligne en trop ou pas assez
	$texte = trim($texte);
	$texte = str_replace("<br />\n","\n",$texte);
	$texte = preg_replace(",(@@@hr@@@\s*)+\Z,ims","",$texte);
	$texte = preg_replace(",(@@@hr@@@\s*\n)+,ims","\n\n\n".str_pad("-",75,"-")."\n\n\n",$texte);
	$texte = preg_replace(",(\n#+\s),ims","\n\n\\1",$texte);
	$texte = preg_replace(",(\n\s*)(\n\s*)+(\n)+,ims","\n\n\n",$texte);


	// <p> et </p> restants
	$texte = str_replace(array("<p>","</p>"),array("",""),$texte);

	// entites restantes ? (dans du code...)
	include_spip('inc/charsets');
	$texte = unicode2charset($texte);
	$texte = str_replace(array('&#039;', '&#034;'),array("'",'"'), $texte);


	// Faire des lignes de 75 caracteres maximum
	return trim(wordwrap($texte));
}
?>
