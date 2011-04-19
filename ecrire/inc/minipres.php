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

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/headers');
include_spip('inc/texte'); //inclue inc/lang et inc/filtres

//
// Presentation des pages d'installation et d'erreurs
//

// http://doc.spip.org/@install_debut_html
function install_debut_html($titre = 'AUTO', $onLoad = '') {
	global $spip_lang_right,$spip_lang_left;
	
	utiliser_langue_visiteur();

	http_no_cache();

	if ($titre=='AUTO')
		$titre=_T('info_installation_systeme_publication');

	# le charset est en utf-8, pour recuperer le nom comme il faut
	# lors de l'installation
	if (!headers_sent())
		header('Content-Type: text/html; charset=utf-8');

	// au cas ou minipres() est appele avant spip_initialisation_suite()
	if (!defined('_DOCTYPE_ECRIRE')) define('_DOCTYPE_ECRIRE', '');
	return  _DOCTYPE_ECRIRE.
		html_lang_attributes().
		"<head>\n".
		"<title>".
		textebrut($titre).
		"</title>
		<link rel='stylesheet' href='".direction_css(find_in_path('minipres.css')).
		"' type='text/css' media='all' />\n" .
 // cet appel permet d'assurer un copier-coller du nom du repertoire a creer dans tmp (esj)
		http_script('',  "spip_barre.js") .
"</head>
<body".$onLoad." class='minipres'>
	<div id='minipres'>
	<h1>".
	  $titre .
	  "</h1>
	<div>\n";
}

// http://doc.spip.org/@install_fin_html
function install_fin_html() {
	return "\n\t</div>\n\t</div>\n</body>\n</html>";
}

// http://doc.spip.org/@minipres
function minipres($titre='', $corps="", $onload='')
{
	if (!defined('_AJAX')) define('_AJAX', false);
	if (!$titre) {
		if (!_AJAX)
			http_status(403);
		if (!$titre = _request('action')
		AND !$titre = _request('exec')
		AND !$titre = _request('page'))
			$titre = '?';

		$titre = htmlspecialchars($titre);

		$titre = ($titre == 'install')
		  ?  _T('avis_espace_interdit')
		  : $titre . '&nbsp;: '. _T('info_acces_interdit');
		$corps = generer_form_ecrire('accueil', '','',_T('public:accueil_site'));
		spip_log($GLOBALS['visiteur_session']['nom'] . " $titre " . $_SERVER['REQUEST_URI']);
	}

	if (!_AJAX)
		return install_debut_html($titre, $onload)
		. $corps
		. install_fin_html();
	else {
		include_spip('inc/headers');
		include_spip('inc/actions');
		$url = self('&',true);
		foreach ($_POST as $v => $c)
			$url = parametre_url($url, $v, $c, '&');
		echo ajax_retour("<div>".$titre . redirige_formulaire($url)."</div>",false);
	}
}
?>
