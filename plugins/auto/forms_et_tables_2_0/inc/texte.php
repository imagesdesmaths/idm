<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2006                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/


//
// Definition des {criteres} d'une boucle
//

if (!defined("_ECRIRE_INC_VERSION")) return;
if ($GLOBALS['spip_version_code']<1.92)
	include_spip('inc/forms_texte_191');
else {
	include_once(_DIR_RESTREINT.'inc/texte.php');
}

?>