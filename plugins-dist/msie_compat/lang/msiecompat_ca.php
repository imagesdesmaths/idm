<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/msiecompat?lang_cible=ca
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// C
	'choix_explication' => '<p>Aquesta configuració us permet millorar la compatibilitat del lloc públic amb el navegador Internet Explorer.</p>
   <ul>
   <li><a href=\'http://jquery.khurshid.com/ifixpng.php\'>iFixPng</a> (<b>per defecte</b>) restableix la semi transparència les imatges al format PNG a  MSIE 5 i 6.</li>
   <li><a href=\'http://code.google.com/p/ie7-js/\'>IE7.js</a> corregeix les imatges PNG i afegeix selectors CSS2 per MSIE 5 i 6 (<a href=\'http://ie7-js.googlecode.com/svn/test/index.html\'>podeu consultar la llista de selectors compatibles introduïts per IE7.js i IE8.js</a>).</li>
   <li>IE8.js completa IE7.js enriquint els comportaments dels CSS de MSIE 5 al 7. </li>
   <li>IE7-squish corregeix tres errors de MSIE 6 (sobretot el doble marge dels elements flotants), però poden aparèixer efectes indesitjables (el webmestre ha de verificar la compatibilitat).</li>
   </ul>', # MODIF
	'choix_non' => 'No activar-ho: no afegir res a les meves plantilles', # MODIF
	'choix_titre' => 'Compatibilitat Microsoft Internet Explorer' # MODIF
);

?>
