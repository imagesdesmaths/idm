<?php

include_once dirname(__FILE__).'/../config/mes_options.php';

header('Content-Type: application/json');

$dbcon = null;
$debug = false;

// On vérifie qu'un email a bien été passé
if(!isset($_REQUEST['email']) || !filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
	print json_encode(array(
		'error' => 'Email invalide'
	));
	die;
}

// Connexion à la base de données
try{
	$dbcon = new PDO($GLOBALS['db_config']['type'].":host=".$GLOBALS['db_config']['host'].";dbname=".$GLOBALS['db_config']['name'], $GLOBALS['db_config']['user'], $GLOBALS['db_config']['pass']);
	$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Recherche d'un abonnement existant
	$stmt = $dbcon->prepare("
		SELECT id_abonnement, date_desinscription
		FROM spip_idm_abonnements
		WHERE email = :email
	");
	$stmt->bindValue(':email', $_REQUEST['email']);
	if($stmt->execute() && $row = $stmt->fetch()) {

		// Si l'abonnement existe, mais que l'utilisateur est désinscrit, on le réinscrit
		if($row['date_desinscription']) {
			$stmt = $dbcon->prepare("
				UPDATE spip_idm_abonnements
				SET date_desinscription = NULL
				WHERE email = :email
			");
			$stmt->bindValue(':email', $_REQUEST['email']);
			$stmt->execute();
			if($debug) { print json_encode(array('success' => 'Row updated')); die; }
		}
		if($debug) { print json_encode(array('success' => 'Row not updated')); die; }

	} else {

		// Si aucun abonnement n'existe, on l'inscrit
		$stmt = $dbcon->prepare("
			INSERT INTO spip_idm_abonnements(email, date_inscription)
			VALUES(:email, :date)
		");
		$stmt->bindValue(':email', $_REQUEST['email']);
		$stmt->bindValue(':date', date('Y-m-d H:i:s'));
		$stmt->execute();
		if($debug) { print json_encode(array('success' => 'Row inserted')); die; }

	}

	// Toujours renvoyer un résultat positif, pour éviter une recherche sur les personnes inscrites
	print json_encode(array(
		'success' => 'Votre inscription a bien été prise en compte.'
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
