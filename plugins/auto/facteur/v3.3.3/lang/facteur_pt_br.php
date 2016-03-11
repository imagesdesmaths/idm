<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/facteur?lang_cible=pt_br
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// C
	'config_info_enregistree' => 'A configuração do Carteiro foi gravada corretamente',
	'configuration_adresse_envoi' => 'Configuração do endereço de envio',
	'configuration_facteur' => 'Carteiro',
	'configuration_mailer' => 'Configuração do mailer',
	'configuration_smtp' => 'Seleção do método de envio de e-mail',
	'configuration_smtp_descriptif' => 'Se tiver dúvida, escolha a função mail do PHP.',
	'corps_email_de_test' => 'Este é um e-mail de teste acentuado',

	// E
	'email_envoye_par' => 'Enviado por @site@',
	'email_test_envoye' => 'O e-mail de teste foi enviado corretamente. Se você não o receber, verifique a configuração do seu servidor ou contate o administrador do servidor.',
	'erreur' => 'Erro',
	'erreur_dans_log' => ' : consulte o arquivo de log para obter mais detalhes',
	'erreur_generale' => 'Há um ou mais erros de configuração. Por favor, verifique o conteúdo do formulário.',
	'erreur_invalid_host' => 'Este nome de host não está correto',
	'erreur_invalid_port' => 'Este número de porta não está correto',

	// F
	'facteur_adresse_envoi_email' => 'E-mail:',
	'facteur_adresse_envoi_nom' => 'Nome:',
	'facteur_bcc' => 'Cópia Oculta (BCC):',
	'facteur_cc' => 'Cópia (CC):',
	'facteur_copies' => 'Cópias:',
	'facteur_copies_descriptif' => 'Um e-mail será enviado em cópia para os endereços especificados. Um único endereço em cópia e/ou um único endereço em cópia oculta.',
	'facteur_filtre_accents' => 'Transformar os acentos em entidades HTML (útil especialmente para o Hotmail).',
	'facteur_filtre_css' => 'Transformaros estílos contidos entre <head> e </head> em estilos "em linha", útil para os webmails, já que os estilos em linha têm prioridade sobre os estilos externos.',
	'facteur_filtre_images' => 'Embutir as imagens referenciadas no próprio e-mail',
	'facteur_filtre_iso_8859' => 'Converter em ISO-8859-1',
	'facteur_filtres' => 'Filtros',
	'facteur_filtres_descriptif' => 'Filtros podem ser aplicados aos e-mails, no momento do envio.',
	'facteur_smtp_auth' => 'Requer autenticação:',
	'facteur_smtp_auth_non' => 'não',
	'facteur_smtp_auth_oui' => 'sim',
	'facteur_smtp_host' => 'Host:',
	'facteur_smtp_password' => 'Senha:',
	'facteur_smtp_port' => 'Porta:',
	'facteur_smtp_secure' => 'Conexão segura:',
	'facteur_smtp_secure_non' => 'náo',
	'facteur_smtp_secure_ssl' => 'SSL (obsoleto)',
	'facteur_smtp_secure_tls' => 'TLS (recomendado)',
	'facteur_smtp_sender' => 'Retorno dos erros (opcional)',
	'facteur_smtp_sender_descriptif' => 'Define no cabeçalho da mensagem o endereço de e-mail de retorno dos erros (ou Return-Path) e, quando de um envio pelo método SMTP, define também o endereço do remetente.',
	'facteur_smtp_username' => 'Nome do usuário:',

	// M
	'message_identite_email' => 'A configuração do plugin "Carteiro" define este endereço de e-mail para o envio das mensagens.',

	// N
	'note_test_configuration' => 'Um e-mail será enviado ao endereço de envio definido (ou ao do webmaster).', # MODIF

	// P
	'personnaliser' => 'Personalizar essas configurações',

	// T
	'tester' => 'Testar',
	'tester_la_configuration' => 'Testar a configuração',

	// U
	'utiliser_mail' => 'Usar a função mail do PHP',
	'utiliser_reglages_site' => 'Usar as configurações do site SPIP: o nome exibido será o nome do site SPIP e o endereço de e-mail será o do webmaster',
	'utiliser_smtp' => 'Usar SMTP',

	// V
	'valider' => 'Validar',
	'version_html' => 'Versão HTML.',
	'version_texte' => 'Versão texto.'
);

?>
