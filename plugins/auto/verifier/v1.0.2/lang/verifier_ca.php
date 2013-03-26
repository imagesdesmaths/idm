<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/verifier?lang_cible=ca
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'Ce code postal est incorrect.', # NEW
	'erreur_comparaison_egal' => 'La valeur doit être égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_egal_type' => 'La valeur doit être égale et de même type que le champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand' => 'La valeur doit être supérieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand_egal' => 'La valeur doit être supérieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit' => 'La valeur doit être inférieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit_egal' => 'La valeur doit être inférieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_couleur' => 'Le code couleur n\'est pas valide.', # NEW
	'erreur_date' => 'El format de la data no és correcte.',
	'erreur_date_format' => 'Le format de la date n\'est pas accepté.', # NEW
	'erreur_decimal' => 'La valeur doit être un nombre décimal.', # NEW
	'erreur_decimal_nb_decimales' => 'Le nombre ne doit pas avoir plus de @nb_decimales@ chiffres après la virgule.', # NEW
	'erreur_email' => 'L\'adreça de correu electrònic <em>@email@</em> no té un format vàlid.',
	'erreur_email_nondispo' => 'L\'adreça de correu electrònic <em>@email@</em> ja s\'utilitza.',
	'erreur_entier' => 'El valor ha de ser un nombre enter.',
	'erreur_entier_entre' => 'El valor ha d\'estar comprès entre @min@ i @max@.',
	'erreur_entier_max' => 'El valor ha de ser inferior a @max@.',
	'erreur_entier_min' => 'El valor ha de ser superior a @min@.',
	'erreur_heure' => 'L’horaire indiquée n’existe pas.', # NEW
	'erreur_heure_format' => 'Le format de l’heure n’est pas accepté.', # NEW
	'erreur_id_document' => 'Aquest identificador de document no és vàlid.',
	'erreur_inconnue_generique' => 'Le format n\'est pas correct.', # NEW
	'erreur_isbn' => 'Le numéro ISBN n\'est pas valide (ex: 978-2-1234-5680-3 ou 2-1234-5680-X)', # NEW
	'erreur_isbn_13_X' => 'Un numéro ISBN-13 ne peut pas se terminer par X.', # NEW
	'erreur_isbn_G' => 'Le premier segment doit être égal à 978 ou 979.', # NEW
	'erreur_isbn_nb_caracteres' => 'Le numéro ISBN doit comprendre 10 ou 13 caractères, sans compter les tirets (actuellement @nb@).', # NEW
	'erreur_isbn_nb_segments' => 'Le numéro ISBN doit comprendre 4 ou 5 segments (actuellement @nb@).', # NEW
	'erreur_isbn_segment' => 'Le segment "@segment@" comprend @nb@ chiffre(s) en trop.', # NEW
	'erreur_isbn_segment_lettre' => 'Le segment "@segment@" ne doit pas contenir de lettre.', # NEW
	'erreur_numerique' => 'El format del número no és vàlid.',
	'erreur_regex' => 'El format de la cadena no és vàlida.',
	'erreur_siren' => 'Número SIREN no vàlid.',
	'erreur_siret' => 'Número SIRET no vàlid.',
	'erreur_taille_egal' => 'El valor ha de tenir exactament @egal@ caràcters.', # MODIF
	'erreur_taille_entre' => 'El valor ha d\'estar comprès entre @min@ i @max@ caràcters.', # MODIF
	'erreur_taille_max' => 'El valor ha de comprendre com a molt @max@ caràcters.', # MODIF
	'erreur_taille_min' => 'El valor ha de tenir com a mínim @min@ caràcters.', # MODIF
	'erreur_telephone' => 'El número no és vàlid.',
	'erreur_url' => 'L\'adreça no és vàlida.', # MODIF
	'erreur_url_protocole' => 'L\'adresse saisie <em>(@url@)</em> doit commencer par @protocole@', # NEW
	'erreur_url_protocole_exact' => 'L\'adresse saisie <em>(@url@)</em> ne commence pas par un protocole valide (http:// par exemple)', # NEW

	// N
	'normaliser_option_date' => 'Normaliser la date ?', # NEW
	'normaliser_option_date_aucune' => 'Non', # NEW
	'normaliser_option_date_en_datetime' => 'Au format «Datetime» (pour SQL)', # NEW

	// O
	'option_couleur_normaliser_label' => 'Normaliser le code couleur ?', # NEW
	'option_couleur_type_hexa' => 'Code couleur au format héxadécimal', # NEW
	'option_couleur_type_label' => 'Type de vérification à effectuer', # NEW
	'option_decimal_nb_decimales_label' => 'Nombre de décimales après la virgule', # NEW
	'option_email_disponible_label' => 'Adreça disponible',
	'option_email_disponible_label_case' => 'Verificar que l\'adreça no l\'utilitzi ja un altre usuari',
	'option_email_mode_5322' => 'Verificació la més compatible amb els estàndards disponibles ',
	'option_email_mode_label' => 'Mitjà de verificació dels correus electrònics',
	'option_email_mode_normal' => 'Verificació normal d\'SPIP',
	'option_email_mode_strict' => 'Verificació menys permissiva',
	'option_entier_max_label' => 'Valor màxim',
	'option_entier_min_label' => 'Valor mínim',
	'option_regex_modele_label' => 'El valor ha de coincidir amb la màscara de la següent',
	'option_siren_siret_mode_label' => 'Què voleu verificar?',
	'option_siren_siret_mode_siren' => 'el SIREN',
	'option_siren_siret_mode_siret' => 'el SIRET',
	'option_taille_max_label' => 'Mida màxima',
	'option_taille_min_label' => 'Mida mínima',
	'option_url_mode_complet' => 'Vérification complète de l\'url', # NEW
	'option_url_mode_label' => 'Mode de vérification des urls', # NEW
	'option_url_mode_php_filter' => 'Vérification complète de l\'url via le filtre FILTER_VALIDATE_URL de php', # NEW
	'option_url_mode_protocole_seul' => 'Vérification uniquement de la présence d\'un protocole', # NEW
	'option_url_protocole_label' => 'Nom du protocole à vérifier', # NEW
	'option_url_type_protocole_exact' => 'Saisir un protocole ci-dessous :', # NEW
	'option_url_type_protocole_ftp' => 'Protocoles ftp : ftp ou sftp', # NEW
	'option_url_type_protocole_label' => 'Type de protocole à vérifier', # NEW
	'option_url_type_protocole_mail' => 'Protocoles mail : imap, pop3 ou smtp', # NEW
	'option_url_type_protocole_tous' => 'Tous protocoles acceptés', # NEW
	'option_url_type_protocole_web' => 'Protocoles web : http ou https', # NEW

	// T
	'type_couleur' => 'Couleur', # NEW
	'type_couleur_description' => 'Vérifie que la valeur est un code couleur.', # NEW
	'type_date' => 'Data',
	'type_date_description' => 'Verifica que el valor és una data en format JJ/MM/AAAA. El separador és lliure (".", "/", etc.).',
	'type_decimal' => 'Nombre décimal', # NEW
	'type_decimal_description' => 'Vérifie que la valeur est un nombre décimal, avec la possibilité de restreindre entre deux valeurs et de préciser le nombre de décimales après la virgule.', # NEW
	'type_email' => 'Adreça de correu electrònic',
	'type_email_description' => 'Verifica que el format de l\'adreça de correu electrònica sigui correcte.',
	'type_email_disponible' => 'Disponibilitat d\'una adreça de correu electrònic',
	'type_email_disponible_description' => 'Verifica que l\'adreça de correu electrònica no sigui utilitzada ja per un altre usuari del sistema.',
	'type_entier' => 'Número enter', # MODIF
	'type_entier_description' => 'Verifica que el valor sigui un número enter, amb la possibilitat de restringir entre dos valors.',
	'type_regex' => 'Expressió regular ',
	'type_regex_description' => 'Verifica que el valor correspon a la màscara demanada. Per l\'ús de màscares, aneu a <a href="http://fr2.php.net/manual/fr/reference.pcre.pattern.syntax.php">l\'ajuda en línia de PHP</a>.',
	'type_siren_siret' => 'SIREN o SIRET',
	'type_siren_siret_description' => 'Verifica queel valor és un número vàlid del <a href="http://fr.wikipedia.org/wiki/SIREN">Système d’Identification du Répertoire des ENtreprises</a> francès.',
	'type_taille' => 'Mida',
	'type_taille_description' => 'Verifica que la mida del valor correspon al mínim i/o al màxim demanat.',
	'type_telephone' => 'Número de telèfon',
	'type_telephone_description' => 'Verifica que el número de telèfon correspon a un esquema reconegut.',
	'type_url' => 'URL', # NEW
	'type_url_description' => 'Vérifie que l\'url correspond à un schéma reconnu.' # NEW
);

?>
