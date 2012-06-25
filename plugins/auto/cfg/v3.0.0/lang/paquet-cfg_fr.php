<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

// C
	'cfg_description' => '
		Augmente les possibilités de gestion de configuration pour d\'autres plugins
		en fournissant un mode de stockage PHP.

		Attention : une partie du fonctionnement de CFG pour SPIP 2 a été intégrée dans SPIP 3 de façon
		légèrement différente. Il est nécessaire de migrer les plugins qui utilisaient CFG pour SPIP 2.
		La plupart n\'auront plus besoin de ce plugin pour gérer leur configurations.',
			
	'cfg_slogan' => 'Gestion de configurations.',
	'cfg_titre' => 'CFG',
);
?>
