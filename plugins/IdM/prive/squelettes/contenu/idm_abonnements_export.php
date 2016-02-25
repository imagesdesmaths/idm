<?php

include_once dirname(__FILE__).'/../../../../../config/mes_options.php';
include_once dirname(__FILE__).'/../../../../../framework-jin/jin/launcher.php';

header('Content-Type: text/csv');

use jin\dataformat\Csv;

$dbcon = null;

try{
    $dbcon = new PDO($GLOBALS['db_config']['type'].":host=".$GLOBALS['db_config']['host'].";dbname=".$GLOBALS['db_config']['name'], $GLOBALS['db_config']['user'], $GLOBALS['db_config']['pass']);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if( isset($_REQUEST['all']) ) {
        $stmt = $dbcon->prepare("
            SELECT id_abonnement, email, date_inscription, date_desinscription
            FROM spip_idm_abonnements
        ");
    } else {
        $stmt = $dbcon->prepare("
            SELECT id_abonnement, email, date_inscription
            FROM spip_idm_abonnements
            WHERE date_desinscription IS NULL
        ");
    }

    $data = array();
    if($stmt->execute()) {
        while($row = $stmt->fetch()) {
            $dataR = array(
                'Id' => $row['id_abonnement'],
                'Email' => $row['email'],
                'Inscription' => $row['date_inscription']
            );
            if( isset($_REQUEST['all']) ) {
                $dataR['Desinscription'] = $row['date_desinscription'];
            }
            $data[] = $dataR;
        }
    }

    $csv = new Csv();
    $csv->populateWithArray($data);
    $csv->output('idm-abonnes-newsletter.'.date('YmdHis').'.csv');
    exit;

} catch(PDOException $e){}

?>