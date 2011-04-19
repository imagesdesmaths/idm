<?php
/*
 * Plugin Porte Plume pour SPIP 2
 * Licence GPL
 * Auteur Matthieu Marcillaud
 */
if (!defined("_ECRIRE_INC_VERSION")) return;



/**
 * Definition de la barre 'forum' pour markitup
 */
function barre_outils_forum(){
	// on modifie simplement la barre d'edition
	$edition = charger_fonction('edition','barre_outils');
	$barre = $edition();
	$barre->nameSpace = 'forum';
	$barre->cacherTout();
	$barre->afficher(array(
		'bold','italic',
		'sepLink','link',
		'sepGuillemets', 'quote',
		'sepCaracteres','guillemets', 'guillemets_simples', 
		   'guillemets_de', 'guillemets_de_simples',
		   'guillemets_autres', 'guillemets_autres_simples',
		   'A_grave', 'E_aigu', 'E_grave', 'aelig', 'AElig', 'oe', 'OE', 'Ccedil',
	));
	return $barre;
}


?>
