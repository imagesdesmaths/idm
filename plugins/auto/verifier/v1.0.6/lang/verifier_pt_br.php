<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/verifier?lang_cible=pt_br
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'Este Cep está incorreto.',
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
	'erreur_id_document' => 'Esta extensão de documento não é válida.',
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

	// O
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
