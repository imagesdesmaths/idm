<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans svn://zone.spip.org/spip-zone/_core_/plugins/msie_compat/lang/
if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// C
	'choix_explication' => '<p>Cette configuration vous permet d&rsquo;am&eacute;liorer la compatibilit&eacute; du site public avec le navigateur Internet Explorer.</p>
			<ul>
			<li><a href=\'http://jquery.khurshid.com/ifixpng.php\'>iFixPng</a> (<b>par défaut</b>) rétablit la semi-transparence les images au format PNG sous MSIE&nbsp;5&nbsp;et&nbsp;6.</li>
			<li><a href=\'http://code.google.com/p/ie7-js/\'>IE7.js</a> corrige les images PNG et ajoute des s&eacute;lecteurs CSS2 pour MSIE&nbsp;5&nbsp;et&nbsp;6 (<a href=\'http://ie7-js.googlecode.com/svn/test/index.html\'>vous pouvez consulter la liste des sélecteurs compatibles introduits par IE7.js et IE8.js</a>).</li>
			<li>IE8.js complète IE7.js en enrichissant les comportements des CSS de MSIE 5 à&nbsp;7. </li>
			<li>IE7-squish corrige trois bugs de MSIE&nbsp;6 (notamment la double marge des éléments flottants), mais des effets indésirables peuvent apparaître (le webmestre doit vérifier la compatibilité).</li>
			</ul>',
	'choix_non' => 'Ne pas activer&nbsp;: ne rien ajouter à mes squelettes',
	'choix_titre' => 'Compatibilité Microsoft Internet Explorer'
);

?>
