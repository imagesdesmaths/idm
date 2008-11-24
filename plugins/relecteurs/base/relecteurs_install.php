<?php

include_spip('base/abstract_sql');
include_spip('base/create');

function relecteurs_install_orig ($action) {
  $desc = spip_abstract_showtable('spip_auteurs', '', true);

  switch ($action) {

  case 'test':
    return (isset($desc['field']['role']));
    break;

  case 'install':
    spip_query("ALTER TABLE spip_auteurs ADD `role` enum('visiteur','candidat','relecteur') NOT NULL DEFAULT 'visiteur'");
    break;

  case 'uninstall':
    spip_query("ALTER TABLE spip_auteurs DROP COLUMN role");
    break;
  }
}	
?>
