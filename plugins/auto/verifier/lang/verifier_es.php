<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'Este código postal es incorrecto',
	'erreur_comparaison_egal' => 'La valeur doit être égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_egal_type' => 'La valeur doit être égale et de même type que le champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand' => 'La valeur doit être supérieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand_egal' => 'La valeur doit être supérieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit' => 'La valeur doit être inférieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit_egal' => 'La valeur doit être inférieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_date' => 'La fecha es inválida',
	'erreur_date_format' => 'No se acepta este formato de fecha.',
	'erreur_decimal' => 'La valeur doit être un nombre décimal.', # NEW
	'erreur_decimal_nb_decimales' => 'Le nombre ne doit pas avoir plus de @nb_decimales@ chiffres après la virgule.', # NEW
	'erreur_email' => 'La dirección de correo <em>@email@</em> no tiene un formato válido.',
	'erreur_email_nondispo' => 'La dirección de correo <em>@email@</em> ya está en uso.',
	'erreur_entier' => 'El valor debe ser un número entero.',
	'erreur_entier_entre' => 'El valor deber ser entre @min@ y @max@.',
	'erreur_entier_max' => 'El valor debe ser inferior a @max@.',
	'erreur_entier_min' => 'El valor debe ser superior a @min@.',
	'erreur_id_document' => 'Este identificador de documento es inválido.',
	'erreur_inconnue_generique' => 'Le format n\'est pas correct.', # NEW
	'erreur_numerique' => 'El formato del número es inválido.',
	'erreur_regex' => 'El formato de la cadena es inválido.',
	'erreur_siren' => 'Este número de SIREN es inválido.',
	'erreur_siret' => 'El número de SIRET es inválido.',
	'erreur_taille_egal' => 'El valor debe tener exactamente @egal@ carácteres.',
	'erreur_taille_entre' => 'El valor debe tener entre @min@ y @max@ carácteres.',
	'erreur_taille_max' => 'El valor debe tener como máximo @max@ carácteres.',
	'erreur_taille_min' => 'El valor debe tener al mínimo @min@ carácteres.',
	'erreur_telephone' => 'El número es inválido.',
	'erreur_url' => 'La dirección es inválida.', # MODIF
	'erreur_url_protocole' => 'L\'adresse saisie <em>(@url@)</em> doit commencer par @protocole@', # NEW
	'erreur_url_protocole_exact' => 'L\'adresse saisie <em>(@url@)</em> ne commence pas par un protocole valide (http:// par exemple)', # NEW

	// O
	'option_decimal_nb_decimales_label' => 'Nombre de décimales après la virgule', # NEW
	'option_email_disponible_label' => 'Dirección disponible',
	'option_email_disponible_label_case' => 'Verifique que la dirección no sea usada por otra persona.',
	'option_email_mode_5322' => 'La verificación más conforme a los estándares existentes',
	'option_email_mode_label' => 'Modo de comprobación de las direcciones de correo',
	'option_email_mode_normal' => 'Comprobación normal de SPIP',
	'option_email_mode_strict' => 'Comprobación no tan permisiva',
	'option_entier_max_label' => 'Valor máximo',
	'option_entier_min_label' => 'Valor mínimo',
	'option_regex_modele_label' => 'El valor debe corresponder al patrón siguiente',
	'option_siren_siret_mode_label' => '¿Qué quiere comprobar?',
	'option_siren_siret_mode_siren' => 'el SIREN',
	'option_siren_siret_mode_siret' => 'el SIRET',
	'option_taille_max_label' => 'Tamaño máximo',
	'option_taille_min_label' => 'Tamaño mínimo',
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
	'type_date' => 'Fecha',
	'type_date_description' => 'Comprueba que el valor es una fecha con el formato JJ/MM/AAAA. El separador no importa (".", "/", etc).',
	'type_decimal' => 'Nombre décimal', # NEW
	'type_decimal_description' => 'Vérifie que la valeur est un nombre décimal, avec la possibilité de restreindre entre deux valeurs et de préciser le nombre de décimales après la virgule.', # NEW
	'type_email' => 'Dirección de correo electrónico',
	'type_email_description' => 'Comprueba que la dirección de correo tiene el formato correcto.',
	'type_email_disponible' => 'Disponibilidad de una dirección de correo',
	'type_email_disponible_description' => 'Comprueba que la dirección de correo no está usadapor otro usuario del sistema.',
	'type_entier' => 'Número entero', # MODIF
	'type_entier_description' => 'Comprueba que el valor es un número entero, con la posibilidad de restringir entre dos valores.',
	'type_regex' => 'Expresión regular',
	'type_regex_description' => 'Comprueba que el valor corresponda al patrón indicado. Para el uso de los patrones, referirse a <a href="http://php.net/manual/es/reference.pcre.pattern.syntax.php">la documentación en linea de PHP</a>.',
	'type_siren_siret' => 'SIREN o SIRET',
	'type_siren_siret_description' => 'Comprueba que el valor es un número valido del <a href="http://fr.wikipedia.org/wiki/SIREN">Sistema de Identificación del Repertorio de las Empresas</a> francés.',
	'type_taille' => 'Tamaño',
	'type_taille_description' => 'Comprueba que el tamaño del valor corresponde al mínimo y/o al máximo indicado.',
	'type_telephone' => 'Número de teléfono',
	'type_telephone_description' => 'Comprueba que el número de teléfono corresponde a un patrón reconocido.',
	'type_url' => 'URL', # NEW
	'type_url_description' => 'Vérifie que l\'url correspond à un schéma reconnu.' # NEW
);

?>
