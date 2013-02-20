<?php

function idm_upgrade ($nom_meta_base_version, $version_cible) {
  $maj = array();

  $maj['create'] = array(array('maj_tables', array('spip_idm_relecteurs',
                                                   'spip_idm_teams',
                                                   'spip_idm_relecture',
                                                   'spip_relecteurs_articles',
                                                   'spip_auteurs',
                                                   'spip_articles')));

  $maj['201111131024'] = array ($maj['create'][0], array('idm_teams',array()));
  $maj['201302201203'] = $maj['create'];

  include_spip ('base/upgrade');
  maj_plugin ($nom_meta_base_version, $version_cible, $maj);
}

function idm_vider_tables ($nom_meta_base_version) {}

?>