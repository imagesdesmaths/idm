<?php

include_spip('base/ap_serial');

global  $table_des_traitements;
$table_des_traitements['LIEU'][]= 'propre(%s)';

$table_des_tables['annonces']='messages';
$exceptions_des_tables['annonces']['id_annonce']='id_message';
$exceptions_des_tables['annonces']['date']='date_heure';
$table_date['annonces']='date_heure';
$table_date_fin['annonces']='date_fin';

?>