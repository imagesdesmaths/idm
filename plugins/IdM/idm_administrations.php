<?php

function idm_teams () {
  $idm_team_relecture = array (327,633,637);
  $idm_team_billets   = array (63,285,286,7,50);

  sql_delete ("spip_idm_teams");
  foreach ($idm_team_relecture as $i)
    sql_insertq ("spip_idm_teams", array('id_auteur'=>$i, 'team'=>'relecture'));
  foreach ($idm_team_billets as $i)
    sql_insertq ("spip_idm_teams", array('id_auteur'=>$i, 'team'=>'billets'));
}

function idm_upgrade ($nom_meta_base_version, $version_cible) {
  $maj = array();

  $maj['create'] = array(array('maj_tables', array('spip_idm_relecteurs',
                                                   'spip_idm_sujets',
                                                   'spip_idm_teams',
                                                   'spip_relecteurs_articles',
                                                   'spip_idm_sujets_articles',
                                                   'spip_auteurs',
                                                   'spip_articles')));

  $maj['201111131024'] = array ($maj['create'][0], array('idm_teams',array()));
  $maj['201112062116'] = $maj['create'];

  include_spip ('base/upgrade');
  maj_plugin ($nom_meta_base_version, $version_cible, $maj);
}

function idm_vider_tables ($nom_meta_base_version) {}

?>
