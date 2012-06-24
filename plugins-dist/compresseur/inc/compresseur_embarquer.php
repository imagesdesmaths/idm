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

function compresseur_embarquer_images_css($contenu, $source){
	#$path = suivre_lien(url_absolue($source),'./');
	$base = ((substr($source,-1)=='/')?$source:(dirname($source).'/'));

	return preg_replace_callback(
		",url\s*\(\s*['\"]?([^'\"/][^:]*[.](png|gif|jpg))['\"]?\s*\),Uims",
		create_function('$x',
			'return "url(\"".filtre_embarque_fichier($x[1],"'.$base.'")."\")";'
		), $contenu);
}


/**
 *
Embarquer des images dans les css, tous nav :

/*
Content-Type: multipart/related; boundary="_ANY_STRING_WILL_DO_AS_A_SEPARATOR"

--_ANY_STRING_WILL_DO_AS_A_SEPARATOR
Content-Location:chevron
Content-Transfer-Encoding:base64

iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFAQMAAAC3obSmAAAABlBMVEX///9mZmaO7mygAAAAEElEQVR42mNYwBDAoAHECwAKMgIJXa7xqgAAAABJRU5ErkJggg==

--_ANY_STRING_WILL_DO_AS_A_SEPARATOR
...

--_ANY_STRING_WILL_DO_AS_A_SEPARATOR
* /

Puis

background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFAQMAAAC3obSmAAAABlBMVEX///9mZmaO7mygAAAAEElEQVR42mNYwBDAoAHECwAKMgIJXa7xqgAAAABJRU5ErkJggg==");
*background-image:url(mhtml:urlfeuille.css!chevron)}

 *
 */