<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/verifier?lang_cible=pt_br
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'Este Cep está incorreto.',
	'erreur_comparaison_egal' => 'La valeur doit être égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_egal_type' => 'La valeur doit être égale et de même type que le champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand' => 'La valeur doit être supérieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_grand_egal' => 'La valeur doit être supérieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit' => 'La valeur doit être inférieure au champ "@nom_champ@"', # NEW
	'erreur_comparaison_petit_egal' => 'La valeur doit être inférieure ou égale au champ "@nom_champ@"', # NEW
	'erreur_couleur' => 'Le code couleur n\'est pas valide.', # NEW
	'erreur_date' => 'A data não é válida.',
	'erreur_date_format' => 'O formato da data não é aceitável.',
	'erreur_decimal' => 'O valor deve ser um número decimal.',
	'erreur_decimal_nb_decimales' => 'O número não deve ter mais de @nb_decimales@ algarismos depois da vírgula.',
	'erreur_email' => 'O endereço de e-mail <em>@email@</em> não está num formato válido.',
	'erreur_email_nondispo' => 'O endereço de e-mail <em>@email@</em> já está sendo usado.',
	'erreur_entier' => 'O valor deve ser um número inteiro.',
	'erreur_entier_entre' => 'O valor dever ser entre @min@ e @max@.',
	'erreur_entier_max' => 'O valor deve ser inferior a @max@.',
	'erreur_entier_min' => 'O valor deve ser superior a @min@.',
	'erreur_heure' => 'L’horaire indiquée n’existe pas.', # NEW
	'erreur_heure_format' => 'Le format de l’heure n’est pas accepté.', # NEW
	'erreur_id_document' => 'Esta extensão de documento não é válida.',
	'erreur_inconnue_generique' => 'Le format n\'est pas correct.', # NEW
	'erreur_isbn' => 'Le numéro ISBN n\'est pas valide (ex: 978-2-1234-5680-3 ou 2-1234-5680-X)', # NEW
	'erreur_isbn_13_X' => 'Un numéro ISBN-13 ne peut pas se terminer par X.', # NEW
	'erreur_isbn_G' => 'Le premier segment doit être égal à 978 ou 979.', # NEW
	'erreur_isbn_nb_caracteres' => 'Le numéro ISBN doit comprendre 10 ou 13 caractères, sans compter les tirets (actuellement @nb@).', # NEW
	'erreur_isbn_nb_segments' => 'Le numéro ISBN doit comprendre 4 ou 5 segments (actuellement @nb@).', # NEW
	'erreur_isbn_segment' => 'Le segment "@segment@" comprend @nb@ chiffre(s) en trop.', # NEW
	'erreur_isbn_segment_lettre' => 'Le segment "@segment@" ne doit pas contenir de lettre.', # NEW
	'erreur_numerique' => 'O formato do número não é válido.',
	'erreur_regex' => 'O formato da expressão não é válido.',
	'erreur_siren' => 'O número SIREN não é válido.',
	'erreur_siret' => 'O número SIRET não é válido.',
	'erreur_taille_egal' => 'O valor deve ter exatamente @egal@ caracteres.', # MODIF
	'erreur_taille_entre' => 'O valor deve ter entre @min@ e @max@ caracteres.', # MODIF
	'erreur_taille_max' => 'O valor deve ter no máximo @max@ caracteres.', # MODIF
	'erreur_taille_min' => 'O valor deve ter no mínimo @min@ caracteres.', # MODIF
	'erreur_telephone' => 'O número não é válido.',
	'erreur_url' => 'O endereço <em>@url@</em> não é válido.',
	'erreur_url_protocole' => 'O endereço informado <em>(@url@)</em> deve começar com @protocole@',
	'erreur_url_protocole_exact' => 'O endereço informado <em>(@url@)</em> não começa com um protocolo válido (http:// por exemplo)',

	// N
	'normaliser_option_date' => 'Normaliser la date ?', # NEW
	'normaliser_option_date_aucune' => 'Non', # NEW
	'normaliser_option_date_en_datetime' => 'Au format «Datetime» (pour SQL)', # NEW

	// O
	'option_couleur_normaliser_label' => 'Normaliser le code couleur ?', # NEW
	'option_couleur_type_hexa' => 'Code couleur au format héxadécimal', # NEW
	'option_couleur_type_label' => 'Type de vérification à effectuer', # NEW
	'option_decimal_nb_decimales_label' => 'Número de décimais depois da vírgula',
	'option_email_disponible_label' => 'Endereço disponível',
	'option_email_disponible_label_case' => 'Verificar se o endereço já não está sendo utilizado por um usuário',
	'option_email_mode_5322' => 'A verificação mais de acordo com os padrões disponíveis',
	'option_email_mode_label' => 'Modo de verificação de e-mails',
	'option_email_mode_normal' => 'Verificação normal do SPIP',
	'option_email_mode_strict' => 'Verificação menos permissiva',
	'option_entier_max_label' => 'Valor máximo',
	'option_entier_min_label' => 'Valor mínimo',
	'option_regex_modele_label' => 'O valor deve correspponder à máscara a seguir',
	'option_siren_siret_mode_label' => 'O que você quer verificar?',
	'option_siren_siret_mode_siren' => 'O número SIREN',
	'option_siren_siret_mode_siret' => 'O número SIRET',
	'option_taille_max_label' => 'Tamanho máximo',
	'option_taille_min_label' => 'Tamanho mínimo',
	'option_url_mode_complet' => 'Verificação completa de url',
	'option_url_mode_label' => 'Modo de verificação de urls',
	'option_url_mode_php_filter' => 'Verificação completa de url através do filtro FILTER_VALIDATE_URL do php',
	'option_url_mode_protocole_seul' => 'Verificação apenas da presença de um protocolo',
	'option_url_protocole_label' => 'Nome do protocolo a ser verificado',
	'option_url_type_protocole_exact' => 'Informar um protocolo abaixo:',
	'option_url_type_protocole_ftp' => 'Protocolos ftp: ftp ou sftp',
	'option_url_type_protocole_label' => 'Tipo de protocolo a ser verificado',
	'option_url_type_protocole_mail' => 'Protocolos de e-mail: imap, pop3 ou smtp',
	'option_url_type_protocole_tous' => 'Todos os protocolos aceitos',
	'option_url_type_protocole_web' => 'Protocolos web: http ou https',

	// T
	'type_couleur' => 'Couleur', # NEW
	'type_couleur_description' => 'Vérifie que la valeur est un code couleur.', # NEW
	'type_date' => 'Data',
	'type_date_description' => 'Verifica se o valor é uma data no formato DD/MM/AAAA. O separador é livre (".", "/" etc).',
	'type_decimal' => 'Número decimal',
	'type_decimal_description' => 'Verifica se o valor é um número decimal, com a possibilidade de restringir entre dois valores e de especificar o número de decimais após a vírgula.',
	'type_email' => 'Endereço de e-mail',
	'type_email_description' => 'Verifica se o endereço de e-mail está num formato correto.',
	'type_email_disponible' => 'Disponibilidade de um endereço de e-mail',
	'type_email_disponible_description' => 'Verifica se o endereço de e-mail já está sendo utilizado por um outro usuário do sistema.',
	'type_entier' => 'Número inteiro',
	'type_entier_description' => 'Verifica se o valor é um número inteiro, com a possibilidade de restringir entre dois valores.',
	'type_regex' => 'Expressão regular',
	'type_regex_description' => 'Verifica se o valor corresponde à máscara solicitada. Para a utilização de máscaras, consulte <a href="http://fr2.php.net/manual/fr/reference.pcre.pattern.syntax.php">ajuda online do PHP</a>.',
	'type_siren_siret' => 'SIREN ou SIRET',
	'type_siren_siret_description' => 'Verifica se o valor é um número válido de <a href="http://fr.wikipedia.org/wiki/SIREN">sistema de identificação do cadastro de empresas (Système d’Identification du Répertoire des ENtreprises)</a> francês.',
	'type_taille' => 'Tamanho',
	'type_taille_description' => 'Verifica se o tamanho do valor corresponde ao mínimo e/ou ao máximo solicitado.',
	'type_telephone' => 'Número de telefone',
	'type_telephone_description' => 'Verifica se o número de telefone corresponde a um esquema reconhecido.',
	'type_url' => 'URL',
	'type_url_description' => 'Verifica se o url corresponde a um esquema reconhecido.'
);

?>
