<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'This post code is invalid.',
	'erreur_comparaison_egal' => 'La valeur doit être égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_egal_type' => 'La valeur doit être égale et de même type que le champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand' => 'La valeur doit être supérieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand_egal' => 'La valeur doit être supérieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit' => 'La valeur doit être inférieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit_egal' => 'La valeur doit être inférieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_date' => 'The date is invalid.',
	'erreur_date_format' => 'The date format is invalid.',
	'erreur_decimal' => 'The value must be a decimal number.',
	'erreur_decimal_nb_decimales' => 'The number must have more than @nb_decimales@ digits after the decimal point.',
	'erreur_email' => 'The email address <em>@email@</em> is not correctly formatted.',
	'erreur_email_nondispo' => 'The email address <em>@email@</em> has already been used.',
	'erreur_entier' => 'The value must be an integer.',
	'erreur_entier_entre' => 'The value must be between @min@ and @max@.',
	'erreur_entier_max' => 'The value must be less than @max@.',
	'erreur_entier_min' => 'The value must be greater than @min@.',
	'erreur_id_document' => 'This document identifier is not valid.',
	'erreur_inconnue_generique' => 'Le format n\'est pas correct.', # NEW
	'erreur_numerique' => 'The number format is invalid.',
	'erreur_regex' => 'The regex string is incorrectly formatted.',
	'erreur_siren' => 'The SIREN number is invalid.',
	'erreur_siret' => 'The SIRET number is invalid.',
	'erreur_taille_egal' => 'The value must have exactly @egal@ characters.',
	'erreur_taille_entre' => 'The value must have between @min@ and @max@ characters.',
	'erreur_taille_max' => 'The value must have no more than @max@ characters.',
	'erreur_taille_min' => 'The value must have no less than @min@ characters.',
	'erreur_telephone' => 'The telephone number is invalid.', # MODIF
	'erreur_url' => 'The URL address <em>@url@</em> is invalid.',
	'erreur_url_protocole' => 'The address entered <em>(@url@)</em> must start with @protocole@',
	'erreur_url_protocole_exact' => 'The address entered <em>(@url@)</em> does not start with a valid protocol (e.g. http://)',

	// O
	'option_decimal_nb_decimales_label' => 'Number of decimal places',
	'option_email_disponible_label' => 'Available address',
	'option_email_disponible_label_case' => 'Check that the address has not already be used by another user',
	'option_email_mode_5322' => 'Check against the strictest standards available',
	'option_email_mode_label' => 'Email checking mode',
	'option_email_mode_normal' => 'Normal SPIP checking',
	'option_email_mode_strict' => 'Less permissive checking',
	'option_entier_max_label' => 'Maximum value',
	'option_entier_min_label' => 'Minimum value',
	'option_regex_modele_label' => 'The value must match the following expression',
	'option_siren_siret_mode_label' => 'Are you sure you wish to confirm?', # MODIF
	'option_siren_siret_mode_siren' => 'SIREN number',
	'option_siren_siret_mode_siret' => 'SIRET number',
	'option_taille_max_label' => 'Maximum size',
	'option_taille_min_label' => 'Minimum size',
	'option_url_mode_complet' => 'Full verification of the URL',
	'option_url_mode_label' => 'URL verification mode',
	'option_url_mode_php_filter' => 'Full URL verification using the PHP filter FILTER_VALIDATE_URL',
	'option_url_mode_protocole_seul' => 'Verification of the existence of a protocol only', # MODIF
	'option_url_protocole_label' => 'Name of the protocol to be verified',
	'option_url_type_protocole_exact' => 'Enter a protocol below:',
	'option_url_type_protocole_ftp' => 'File transfer protocols: FTP or SFTP',
	'option_url_type_protocole_label' => 'Type of protocol to be verified',
	'option_url_type_protocole_mail' => 'Mail protocols: IMAP, POP3 or SMTP',
	'option_url_type_protocole_tous' => 'All accepted protocols',
	'option_url_type_protocole_web' => 'Web protocols: HTTP or HTTPS',

	// T
	'type_date' => 'Date',
	'type_date_description' => 'Check that the value is date in the DD/MM/YYYY format. The separator character can be anything (".", "/", etc).',
	'type_decimal' => 'Decimal number',
	'type_decimal_description' => 'Check that the value is a decimal number, with options to restrict the value to a given range and to specify the required number of decmial places.',
	'type_email' => 'Email address',
	'type_email_description' => 'Check that the email address is correctly formatted.',
	'type_email_disponible' => 'Availability of an email address',
	'type_email_disponible_description' => 'Check that the email address has not already been used by another system user.',
	'type_entier' => 'Integer',
	'type_entier_description' => 'Check that the value is an integer, with the option of being restricted between two range values.',
	'type_regex' => 'Regular expression',
	'type_regex_description' => 'Check that the value matches the defined expression. For more information on using regular expressions, please refer to <a href="http://fr2.php.net/manual/en/reference.pcre.pattern.syntax.php">the online PHP help</a>.', # MODIF
	'type_siren_siret' => 'SIREN or SIRET',
	'type_siren_siret_description' => 'Check that the value is a valid number from the French <a href="http://fr.wikipedia.org/wiki/SIREN">Système d’Identification du Répertoire des ENtreprises</a> (Company Registry ID System).',
	'type_taille' => 'Size',
	'type_taille_description' => 'Check that the size of the value corresponds to the minimum and/or maximum specified.',
	'type_telephone' => 'Telephone number',
	'type_telephone_description' => 'Check that the telephone number matches a recognised telephone number format.',
	'type_url' => 'URL',
	'type_url_description' => 'Verify that the URL matches a recognised format.'
);

?>
