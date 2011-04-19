<?php

include_spip('base/serial');

//ajout du champ lieu
global  $tables_principales;
$tables_principales['spip_messages']['field']['lieu'] = "text DEFAULT '' NOT NULL";

//ajout du champ id_rubrique
$tables_principales['spip_messages']['field']['id_rubrique'] = "bigint(21) DEFAULT '0' NOT NULL";
$tables_principales['spip_messages']['key']['id_rubrique'] = 'id_rubrique';

?>