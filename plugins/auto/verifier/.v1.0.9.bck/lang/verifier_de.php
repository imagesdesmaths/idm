<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/verifier?lang_cible=de
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'Ungültige Postleitzahl',
	'erreur_date' => 'Fromat des Datums ungültig',
	'erreur_date_format' => 'Dieses Datumsformat wird nicht akzeptiert',
	'erreur_decimal' => 'Der Wert muß einen Dezimalzahl sein',
	'erreur_decimal_nb_decimales' => 'Die Zahl darf nicht mehr als @nb_decimales@ Nachkommastellen haben.',
	'erreur_email' => 'Die Mailadresse  <em>@email@</em> hat einen Syntaxfehler.',
	'erreur_email_nondispo' => 'Die Mailadresse <em>@email@</em>  wird bereits verwendet.',
	'erreur_entier' => 'Der Wert muß eine ganze Zahl sein.',
	'erreur_entier_entre' => 'Der Wert muß zwischen  @min@ und @max@ liegen.',
	'erreur_entier_max' => 'Der Wert muß kleiner als @max@ sein.',
	'erreur_entier_min' => 'Der Wert muß größer als @min@ sein.',
	'erreur_id_document' => 'Diese Dokumenten-ID ist ungültig',
	'erreur_numerique' => 'Zahlenformat ungültig',
	'erreur_regex' => 'Zeichenkettenformat ungültig',
	'erreur_siren' => 'SIREN Nummer ungültig',
	'erreur_siret' => 'SIRET Nummer ungültig',
	'erreur_taille_egal' => 'Der Wert muß exakt @egal@ Zeichen haben.', # MODIF
	'erreur_taille_entre' => 'Der Wert muß zwischen @min@ und @max@ Zeichen haben.', # MODIF
	'erreur_taille_max' => 'Der Wert darf maximal @max@ Zeichen haben.', # MODIF
	'erreur_taille_min' => 'Der Wert muß mindestens @min@ Zeichen haben.', # MODIF
	'erreur_telephone' => 'Zahl ungültig',
	'erreur_url' => 'Die Adresse <em>@url@</em> ist ungültig.',
	'erreur_url_protocole' => 'Die eingegebene Adresse <em>(@url@)</em> muß mit @protocole@ beginnen.',
	'erreur_url_protocole_exact' => 'Die eingegebene Adresse <em>(@url@)</em> beginnt nicht mit einem gültigen Protokoll (zum Beispiel http:// ).',

	// O
	'option_decimal_nb_decimales_label' => 'Dezimalstellen nach dem Komma',
	'option_email_disponible_label' => 'Adresse verfügbar',
	'option_email_disponible_label_case' => 'Überprüfen, ob die Adresse bereits verwendet wird.',
	'option_email_mode_5322' => 'Streng standardgemäße Überprüfung',
	'option_email_mode_label' => 'Art der Mailprüfung',
	'option_email_mode_normal' => 'Normale SPIP-Prüfung',
	'option_email_mode_strict' => 'Strengere Prüfung',
	'option_entier_max_label' => 'Maximalwert',
	'option_entier_min_label' => 'Minimalwert',
	'option_regex_modele_label' => 'Der Wert muß mit der folgenden Maske übereinstimmen.',
	'option_siren_siret_mode_label' => 'Was möchten sie überprüfen?',
	'option_siren_siret_mode_siren' => 'SIREN (frz. Unternehmens ID)',
	'option_siren_siret_mode_siret' => 'SIRET (frz. geographische Unternehmens ID)',
	'option_taille_max_label' => 'Maximalgröße',
	'option_taille_min_label' => 'Minimalgröße',
	'option_url_mode_complet' => 'Vollständige Prüfung des URL',
	'option_url_mode_label' => 'Art der URL-Prüfung',
	'option_url_mode_php_filter' => 'Vollständige Prüfung des URL mit dem PHP-Filter FILTER_VALIDATE_URL',
	'option_url_mode_protocole_seul' => 'Nur die Angabe eines Protokolls prüfen',
	'option_url_protocole_label' => 'Names des überprüften Protokolls',
	'option_url_type_protocole_exact' => 'Geben Sie hier ein Protokoll an:',
	'option_url_type_protocole_ftp' => 'FTP-Protokolle: ftp oder sftp',
	'option_url_type_protocole_label' => 'Typ des erforderlichen Protokolls',
	'option_url_type_protocole_mail' => 'Mail-Protokolle: imap, pop3 oder smtp',
	'option_url_type_protocole_tous' => 'Alle Protokolle werden akzeptiert',
	'option_url_type_protocole_web' => 'Web-Protokolle: http oder https',

	// T
	'type_date' => 'Datum',
	'type_date_description' => 'Überprüft den Wert auf das Datumsformat  JJ/MM/AAAA. Verschiedene Trenner sind möglich (".", "/", etc).',
	'type_decimal' => 'Dezimalzahl',
	'type_decimal_description' => 'Prüft ob der Wert eine Dezimalzahl ist und ermöglicht, einen Wertebereich und die Anzahl der Nachkommastellen festzulegen.',
	'type_email' => 'Mailadresse',
	'type_email_description' => 'Überprüft das Format der Mailadresse',
	'type_email_disponible' => 'Verfügbarkeit einer Mailadresse',
	'type_email_disponible_description' => 'Überprüft ob die Mailadresse bereits von einem anderen Nutzer des System verwendet wird.',
	'type_entier' => 'Ganzzahl',
	'type_entier_description' => 'Überprüft ob der Wert eine Ganzzahl ist; bietet die Möglichkeit, einen Bereich zwischen zwei Zahlen anzugeben.',
	'type_regex' => 'Regulärer Ausdruck',
	'type_regex_description' => 'Prüft ob der Wert mit der vorgegebenen Maske übereinstimmt. Zur Verwendung der Masken <a href="http://www.php.net/manual/de/reference.pcre.pattern.syntax.php">lesen sie bitte die PHP Dokumentation</a>.',
	'type_siren_siret' => 'SIREN oder SIRET',
	'type_siren_siret_description' => 'Prüft ob der Wert eine gültige Nummer des <a href="http://fr.wikipedia.org/wiki/SIREN">Système d’Identification du Répertoire des Entreprises</a> ist.',
	'type_taille' => 'Größe',
	'type_taille_description' => 'Überprüft ob der Wert zum geforderten Minimal- oder Maximalwert paßt.',
	'type_telephone' => 'Telefonnummer',
	'type_telephone_description' => 'Prüft ob die Telefonnummer einem bekannten Schema entspricht.',
	'type_url' => 'URL',
	'type_url_description' => 'Prüft ob der URL einem anerkannten Schema entspricht.'
);

?>
