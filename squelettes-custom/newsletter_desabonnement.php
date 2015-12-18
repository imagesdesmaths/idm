<?php

include_once dirname(__FILE__).'/../config/mes_options.php';

header('Content-Type: application/json');

$dbcon = null;
$debug = false;

// Connexion à la base de données
try{
	$dbcon = new PDO($GLOBALS['db_config']['type'].":host=".$GLOBALS['db_config']['host'].";dbname=".$GLOBALS['db_config']['name'], $GLOBALS['db_config']['user'], $GLOBALS['db_config']['pass']);
	$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Recherche d'un abonnement existant
	$stmt = $dbcon->prepare("
		UPDATE spip_abonnements
		SET date_desinscription = :date
		WHERE email = :email
	");
	$stmt->bindValue(':date', date('Y-m-d H:i:s'));
	$stmt->bindValue(':email', $_REQUEST['email']);
	$stmt->execute();

	// Toujours renvoyer un résultat positif, pour éviter une recherche sur les personnes inscrites
	print json_encode(array(
		'success' => 'Vous avez bien été désinscrit.'
	));
	die;

} catch(PDOException $e){

	if($debug) { print json_encode(array('error' => $e->getMessage())); die; }
	print json_encode(array(
		'error' => 'Une erreur est survenue, veuillez réessayer plus tard.'
	));
	die;

}

?>
