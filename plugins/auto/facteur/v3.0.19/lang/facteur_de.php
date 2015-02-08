<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/facteur?lang_cible=de
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// C
	'config_info_enregistree' => 'Die Konfiguration des Briefträgers wurde gespeichert.',
	'configuration_adresse_envoi' => 'Absenderadresse einstellen',
	'configuration_facteur' => 'Briefträger',
	'configuration_mailer' => 'Konfiguration des Mailers',
	'configuration_smtp' => 'Auswahl der Versandmethode',
	'configuration_smtp_descriptif' => 'Im Zweifel hier die mail() Funktion von PHP eintragen.',
	'corps_email_de_test' => 'Das ist ein Versandtest mit Sondärzeichen: Bär Größe Maß accentué',

	// E
	'email_envoye_par' => 'Absender @site@',
	'email_test_envoye' => 'Die Testmail wurde fehlerfrei verschickt. Falls sie nicht richtig ankommt, bearbeiten sie ihre Serverkonfiguration oder kontaktieren sie den Administrator.',
	'erreur' => 'Fehler',
	'erreur_dans_log' => ' : mehr Details in der Logdatei',
	'erreur_generale' => 'Konfigurationsfehler. Bitte Inhalt des Formulars korrigieren.',
	'erreur_invalid_host' => 'falscher Servername',
	'erreur_invalid_port' => 'falsche Portnummer',

	// F
	'facteur_adresse_envoi_email' => 'E-Mail :',
	'facteur_adresse_envoi_nom' => 'Name:',
	'facteur_bcc' => 'Blindkopie (BCC) :',
	'facteur_cc' => 'Kopie (CC) :',
	'facteur_copies' => 'Kopien:',
	'facteur_copies_descriptif' => 'Eine Kopie der E-Mails wird an die angegebenen Adressen geschickt. Geben sie eine Adresse als Empfänger der Kopie bzw. Blindkopie an.',
	'facteur_filtre_accents' => 'Sonderzeichen in HTML-Entitäten umwandeln (z.B. für Hotmail).',
	'facteur_filtre_css' => 'Stile zwischen <head> und </head> zu "inline" Stilen umwandeln, sinnvoll für Webmail die inline-Stile externen vorzieht.',
	'facteur_filtre_images' => 'Verlinkte Bilder in E-Mail einbetten',
	'facteur_filtre_iso_8859' => 'Nach ISO-8859-1 umwandeln',
	'facteur_filtres' => 'Filter',
	'facteur_filtres_descriptif' => 'Beim Versand können die Mails durch mehrere Filter behandelt werden.',
	'facteur_smtp_auth' => 'Autorisierung erforderlich:',
	'facteur_smtp_auth_non' => 'nein',
	'facteur_smtp_auth_oui' => 'ja',
	'facteur_smtp_host' => 'Server:',
	'facteur_smtp_password' => 'Passwort:',
	'facteur_smtp_port' => 'Port:',
	'facteur_smtp_secure' => 'Verschlüsselte Verbindung:',
	'facteur_smtp_secure_non' => 'nein',
	'facteur_smtp_secure_ssl' => 'SSL',
	'facteur_smtp_secure_tls' => 'TLS',
	'facteur_smtp_sender' => 'Fehlercodes (optional)',
	'facteur_smtp_sender_descriptif' => 'Legt im Kopf der Mail die Empfängeradresse für Fehlermeldungen fest (bzw. den Return-Path), bestimmt ebenfalls die Absenderadresse bei Versand per SMTP.',
	'facteur_smtp_username' => 'Benutzername:',

	// M
	'message_identite_email' => 'Die Konfiguration des Plugins Briefträger (facteur) überschreibt diese Adresse für den Mailversand.',

	// N
	'note_test_configuration' => 'Eine Mail wird an die Absendeadresse geschickt (oder an den Webmaster).',

	// P
	'personnaliser' => 'Individuelle Einstellungen',

	// T
	'tester' => 'Testen',
	'tester_la_configuration' => 'Konfiguration testen',

	// U
	'utiliser_mail' => 'Funktion mail() von PHP verwenden',
	'utiliser_reglages_site' => 'Einstellungen von SPIP verwenden: als Name wird die Bezeichnung der SPIP-Website verwendet und als Adresse die des Webmasters.',
	'utiliser_smtp' => 'SMTP verwenden',

	// V
	'valider' => ' OK ',
	'version_html' => 'HTML-Version.',
	'version_texte' => 'Textversion.'
);

?>
