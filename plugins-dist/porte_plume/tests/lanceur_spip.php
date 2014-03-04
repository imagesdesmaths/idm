<?php
/**
 * Ce fichier permet de lancer SPIP
 * pour obtenir ses fonctions depuis
 * les jeux de tests unitaires (simpletest)
 * des plugins
 * 
 * Il verifie aussi la presence du plugin simpleTest
 * 
 */
$version_lanceur = '1.0.0';

$remonte = "../";
while (!is_dir($remonte."ecrire"))
	$remonte = "../$remonte";
require $remonte.'tests/test.inc';

if (!defined('_ECRIRE_INC_VERSION')) {
	die("<strong>Echec :</strong> SPIP ne peut pas etre demarre automatiquement pour le test.<br />
		Vous utilisez certainement un lien symbolique dans votre repertoire plugins.");
}
include_spip('inc/tests');
if (!class_exists('SpipTestSuite')) {
	die("<strong>Echec :</strong> le plugin pour les tests unitaires avec SimpleTest ne semble pas actif.");
}
?>
