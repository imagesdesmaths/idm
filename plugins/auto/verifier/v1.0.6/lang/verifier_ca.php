<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/verifier?lang_cible=ca
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_date' => 'El format de la data no és correcte.',
	'erreur_email' => 'L’adreça de correu electrònic <em>@email@</em> no té un format vàlid.',
	'erreur_email_nondispo' => 'L’adreça de correu electrònic <em>@email@</em> ja s’utilitza.',
	'erreur_entier' => 'El valor ha de ser un nombre enter.',
	'erreur_entier_entre' => 'El valor ha d’estar comprès entre @min@ i @max@.',
	'erreur_entier_max' => 'El valor ha de ser inferior a @max@.',
	'erreur_entier_min' => 'El valor ha de ser superior a @min@.',
	'erreur_id_document' => 'Aquest identificador de document no és vàlid.',
	'erreur_numerique' => 'El format del número no és vàlid.',
	'erreur_regex' => 'El format de la cadena no és vàlida.',
	'erreur_siren' => 'Número SIREN no vàlid.',
	'erreur_siret' => 'Número SIRET no vàlid.',
	'erreur_taille_egal' => 'El valor ha de tenir exactament @egal@ caràcters.', # MODIF
	'erreur_taille_entre' => 'El valor ha d’estar comprès entre @min@ i @max@ caràcters.', # MODIF
	'erreur_taille_max' => 'El valor ha de comprendre com a molt @max@ caràcters.', # MODIF
	'erreur_taille_min' => 'El valor ha de tenir com a mínim @min@ caràcters.', # MODIF
	'erreur_telephone' => 'El número no és vàlid.',
	'erreur_url' => 'L’adreça no és vàlida.', # MODIF

	// O
	'option_email_disponible_label' => 'Adreça disponible',
	'option_email_disponible_label_case' => 'Verificar que l’adreça no l’utilitzi ja un altre usuari',
	'option_email_mode_5322' => 'Verificació la més compatible amb els estàndards disponibles ',
	'option_email_mode_label' => 'Mitjà de verificació dels correus electrònics',
	'option_email_mode_normal' => 'Verificació normal d’SPIP',
	'option_email_mode_strict' => 'Verificació menys permissiva',
	'option_entier_max_label' => 'Valor màxim',
	'option_entier_min_label' => 'Valor mínim',
	'option_regex_modele_label' => 'El valor ha de coincidir amb la màscara de la següent',
	'option_siren_siret_mode_label' => 'Què voleu verificar?',
	'option_siren_siret_mode_siren' => 'el SIREN',
	'option_siren_siret_mode_siret' => 'el SIRET',
	'option_taille_max_label' => 'Mida màxima',
	'option_taille_min_label' => 'Mida mínima',

	// T
	'type_date' => 'Data',
	'type_date_description' => 'Verifica que el valor és una data en format JJ/MM/AAAA. El separador és lliure (".", "/", etc.).',
	'type_email' => 'Adreça de correu electrònic',
	'type_email_description' => 'Verifica que el format de l’adreça de correu electrònica sigui correcte.',
	'type_email_disponible' => 'Disponibilitat d’una adreça de correu electrònic',
	'type_email_disponible_description' => 'Verifica que l’adreça de correu electrònica no sigui utilitzada ja per un altre usuari del sistema.',
	'type_entier' => 'Número enter', # MODIF
	'type_entier_description' => 'Verifica que el valor sigui un número enter, amb la possibilitat de restringir entre dos valors.',
	'type_regex' => 'Expressió regular ',
	'type_regex_description' => 'Verifica que el valor correspon a la màscara demanada. Per l’ús de màscares, aneu a <a href="http://fr2.php.net/manual/fr/reference.pcre.pattern.syntax.php">l’ajuda en línia de PHP</a>.',
	'type_siren_siret' => 'SIREN o SIRET',
	'type_siren_siret_description' => 'Verifica queel valor és un número vàlid del <a href="http://fr.wikipedia.org/wiki/SIREN">Système d’Identification du Répertoire des ENtreprises</a> francès.',
	'type_taille' => 'Mida',
	'type_taille_description' => 'Verifica que la mida del valor correspon al mínim i/o al màxim demanat.',
	'type_telephone' => 'Número de telèfon',
	'type_telephone_description' => 'Verifica que el número de telèfon correspon a un esquema reconegut.'
);

?>
