<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/verifier?lang_cible=it
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'Il CAP non è corretto.',
	'erreur_comparaison_egal' => 'La valeur doit être égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_egal_type' => 'La valeur doit être égale et de même type que le champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand' => 'La valeur doit être supérieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand_egal' => 'La valeur doit être supérieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit' => 'La valeur doit être inférieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit_egal' => 'La valeur doit être inférieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_couleur' => 'Le code couleur n\'est pas valide.', # NEW
	'erreur_date' => 'La data non è valida.',
	'erreur_date_format' => 'Il formato della data non è corretto.',
	'erreur_decimal' => 'Il valore deve essere un numero decimale.',
	'erreur_decimal_nb_decimales' => 'Il numero non deve avere più di @nb_decimales@ cifre dopo la virgola.',
	'erreur_email' => 'L\'indirizzo di posta <em>@email@</em> non ha un formato valido.',
	'erreur_email_nondispo' => 'L\'indirizzo di posta <em>@email@</em> è già utilizzato.',
	'erreur_entier' => 'Il valore deve essere un numero intero.',
	'erreur_entier_entre' => 'Il valore deve essere compreso tra @min@ e @max@.',
	'erreur_entier_max' => 'Il valore deve essere minore di @max@.',
	'erreur_entier_min' => 'Il valore deve essere maggiore di @min@.',
	'erreur_heure' => 'L’horaire indiquée n’existe pas.', # NEW
	'erreur_heure_format' => 'Le format de l’heure n’est pas accepté.', # NEW
	'erreur_id_document' => 'L\'id del documento non è valido.',
	'erreur_inconnue_generique' => 'Le format n\'est pas correct.', # NEW
	'erreur_isbn' => 'Le numéro ISBN n\'est pas valide (ex: 978-2-1234-5680-3 ou 2-1234-5680-X)', # NEW
	'erreur_isbn_13_X' => 'Un numéro ISBN-13 ne peut pas se terminer par X.', # NEW
	'erreur_isbn_G' => 'Le premier segment doit être égal à 978 ou 979.', # NEW
	'erreur_isbn_nb_caracteres' => 'Le numéro ISBN doit comprendre 10 ou 13 caractères, sans compter les tirets (actuellement @nb@).', # NEW
	'erreur_isbn_nb_segments' => 'Le numéro ISBN doit comprendre 4 ou 5 segments (actuellement @nb@).', # NEW
	'erreur_isbn_segment' => 'Le segment "@segment@" comprend @nb@ chiffre(s) en trop.', # NEW
	'erreur_isbn_segment_lettre' => 'Le segment "@segment@" ne doit pas contenir de lettre.', # NEW
	'erreur_numerique' => 'Il formato del numero non è valido.',
	'erreur_regex' => 'Il formato non è valido.',
	'erreur_siren' => 'Il numero di SIREN non è valido.',
	'erreur_siret' => 'Il numero di SIRET non è valido.',
	'erreur_taille_egal' => 'Il valore deve avere esattamente @egal@ caratteri.', # MODIF
	'erreur_taille_entre' => 'Il valore deve avere da @min@ a @max@ caratteri.', # MODIF
	'erreur_taille_max' => 'Il valore deve avere al massimo @max@ caratteri.', # MODIF
	'erreur_taille_min' => 'Il valore deve avere minimo @min@ caratteri.', # MODIF
	'erreur_telephone' => 'Il numero non è valido.',
	'erreur_url' => 'L\'indirizzo <em>@url@</em> non è valido.',
	'erreur_url_protocole' => 'L\'indirizzo inserito <em>(@url@)</em> deve cominciare con @protocole@',
	'erreur_url_protocole_exact' => 'L\'indirizzo inserito <em>(@url@)</em> non comincia con un protocollo valido (http:// ad esempio)',

	// N
	'normaliser_option_date' => 'Normaliser la date ?', # NEW
	'normaliser_option_date_aucune' => 'Non', # NEW
	'normaliser_option_date_en_datetime' => 'Au format «Datetime» (pour SQL)', # NEW

	// O
	'option_couleur_normaliser_label' => 'Normaliser le code couleur ?', # NEW
	'option_couleur_type_hexa' => 'Code couleur au format héxadécimal', # NEW
	'option_couleur_type_label' => 'Type de vérification à effectuer', # NEW
	'option_decimal_nb_decimales_label' => 'Numero di decimali dopo la virgola',
	'option_email_disponible_label' => 'Indirizzo disponibile',
	'option_email_disponible_label_case' => 'Verifica che l\'indirizzo non sia già stato utilizzato da un utente',
	'option_email_mode_5322' => 'Verifica rispetto agli standard disponibili',
	'option_email_mode_label' => 'Modalità di verifica delle email',
	'option_email_mode_normal' => 'Verifica normale di SPIP',
	'option_email_mode_strict' => 'Verifica meno permissiva',
	'option_entier_max_label' => 'Valore massimo',
	'option_entier_min_label' => 'Valore minimo',
	'option_regex_modele_label' => 'Il valore deve corrispondere alla seguente maschera',
	'option_siren_siret_mode_label' => 'Cosa vuoi verificare?',
	'option_siren_siret_mode_siren' => 'il SIREN',
	'option_siren_siret_mode_siret' => 'il SIRET',
	'option_taille_max_label' => 'Dimensione massima',
	'option_taille_min_label' => 'Dimensione minima',
	'option_url_mode_complet' => 'Verifica completa dell\'url',
	'option_url_mode_label' => 'Modalità di verifica dell\'url',
	'option_url_mode_php_filter' => 'Verifica completa dell\'url grazie al filtro FILTER_VALIDATE_URL di php',
	'option_url_mode_protocole_seul' => 'Verifica solo la presenza di un protocollo',
	'option_url_protocole_label' => 'Nome del protocollo da verificare',
	'option_url_type_protocole_exact' => 'Inserisci un protocollo qui sotto:',
	'option_url_type_protocole_ftp' => 'Protocolli ftp : ftp o sftp',
	'option_url_type_protocole_label' => 'Tipo di protocollo da verificare',
	'option_url_type_protocole_mail' => 'Protocolli mail: imap, pop3 o smtp',
	'option_url_type_protocole_tous' => 'Tutti i protocolli accettati',
	'option_url_type_protocole_web' => 'Protocolli web: http o https',

	// T
	'type_couleur' => 'Couleur', # NEW
	'type_couleur_description' => 'Vérifie que la valeur est un code couleur.', # NEW
	'type_date' => 'Data',
	'type_date_description' => 'Verifica che il valore sia una data nel formato GG/MM/AAAA. Il separatore è libero (";", "/", ecc).',
	'type_decimal' => 'Numero decimale',
	'type_decimal_description' => 'Verifica che il valore sia un numero decimale, con la possibilità di restringerlo ad un intervallo tra due valori e di specificare il numero di cifre decimali dopo la virgola.',
	'type_email' => 'Indirizzo di posta elettronica',
	'type_email_description' => 'Verifica che l\'indirizzo di posta abbia un formato corretto.',
	'type_email_disponible' => 'Disponibilità di un indirizzo di posta elettronica',
	'type_email_disponible_description' => 'Verifica che l\'indirizzo di posta elettronica non sia già utilizzato da un altro utente del sistema.',
	'type_entier' => 'Numero intero',
	'type_entier_description' => 'Verifica che il valore sia un numero intero, con la possibilità di restringerlo ad un intervallo tra due valori.',
	'type_regex' => 'Espressione regolare',
	'type_regex_description' => 'Verifica che il valore corrisponda alla maschera richiesta. Per l\'utilizzo delle maschere, riferisciti all\'<a href="http://it.php.net/manual/en/reference.pcre.pattern.syntax.php">aiuto in linea di PHP</a>.',
	'type_siren_siret' => 'SIREN o SIRET',
	'type_siren_siret_description' => 'Verifica che il valore sia un numero valido di <a href="http://fr.wikipedia.org/wiki/SIREN">Système d’Identification du Répertoire des ENtreprises</a> francese.',
	'type_taille' => 'Dimensione',
	'type_taille_description' => 'Verifica che la dimensione del valore corrisponda ad un minimo e/o ad un massimo richiesto.',
	'type_telephone' => 'Numero telefonico',
	'type_telephone_description' => 'Verifica che il numero telefonico corrisponda ad uno schema riconosciuto.',
	'type_url' => 'URL',
	'type_url_description' => 'Verifica che l\'url corrisponda ad uno schema riconosciuto.'
);

?>
