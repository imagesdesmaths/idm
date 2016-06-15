<?php
include_once dirname(__FILE__).'/../config/mes_options.php';
header('Content-Type: application/json');
$dbcon = null;
$debug = false;
// On vérifie qu'un email a bien été passé
$email=$_REQUEST['email'];
if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	print json_encode(array(
		'error' => 'Email invalide'
	));
	die;
}
$headers = array("From: ".$email,
    "Reply-To: ".$email,
    "X-Mailer: PHP/" . PHP_VERSION
);
$headers = implode("\r\n", $headers);
mail('sympa@listes.math.cnrs.fr', 'suscribe idm-news','sub idm-news', $headers);


// Toujours renvoyer un résultat positif, pour éviter une recherche sur les personnes inscrites
print json_encode(array(

	'success' => 'Votre inscription a bien été prise en compte.'
));
die;

?>
