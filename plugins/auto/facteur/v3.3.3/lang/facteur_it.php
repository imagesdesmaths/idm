<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/facteur?lang_cible=it
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// C
	'config_info_enregistree' => 'La configurazione di Facteur è stata registrata',
	'configuration_adresse_envoi' => 'Configurazione dell’indirizzo emittente',
	'configuration_mailer' => 'Configurazione del mailer',
	'configuration_smtp' => 'Scelta del metodo d’invio di mail',
	'configuration_smtp_descriptif' => 'Se no siete sicuri, scegliete la funzione mail di PHP.',
	'corps_email_de_test' => 'Questo è un mail di prova con accento',

	// E
	'email_envoye_par' => 'Inviato da @site@',
	'email_test_envoye' => 'La mail di prova è stata correttamente inviata. Se non la ricevete correttamente, verficate la configurazione del server o contattate un amministratore del server.',
	'erreur' => 'Errorr',
	'erreur_dans_log' => ': consultate il file log per maggiori dettagli',
	'erreur_generale' => 'Ci sono uno o più errori di configurazione. Verificate il contenuto del formulario.',
	'erreur_invalid_host' => 'Questo nome di host non è corretto',
	'erreur_invalid_port' => 'Questu numero di porta non è corretto',

	// F
	'facteur_adresse_envoi_email' => 'Email:',
	'facteur_adresse_envoi_nom' => 'Cognome:',
	'facteur_bcc' => 'Copia nascosta (CCN):',
	'facteur_cc' => 'Copia (CC):',
	'facteur_copies' => 'Copie:',
	'facteur_copies_descriptif' => 'Una mail sarà mandata in copia agli indirizzi definiti. Un solo indirizzo in copia e/o un solo indirizzo in copia nascosta.',
	'facteur_filtre_accents' => 'Trasformate gli accenti nella loro entity html (utile sopratutto per Hotmail).',
	'facteur_filtre_css' => 'Trasformare gli stili contenuti tra <head> e </head> negli stili "in linea", utile per le webmail perché gli stili in linea hanno la precedenza sugli stili estermi.',
	'facteur_filtre_images' => 'Integrate le immagini citate nelle mail',
	'facteur_filtre_iso_8859' => 'Convertire in ISO-8859-1',
	'facteur_filtres' => 'Filtri',
	'facteur_filtres_descriptif' => 'Alcuni filtri possono essere applicati alle mail al momento dell’invio.',
	'facteur_smtp_auth' => 'Richiede un’autenticazione:',
	'facteur_smtp_auth_non' => 'no',
	'facteur_smtp_auth_oui' => 'si',
	'facteur_smtp_host' => 'Host:',
	'facteur_smtp_password' => 'Password:',
	'facteur_smtp_port' => 'Porta:',
	'facteur_smtp_secure' => 'Connessione sicura:',
	'facteur_smtp_secure_non' => 'no',
	'facteur_smtp_secure_ssl' => 'SSL', # MODIF
	'facteur_smtp_secure_tls' => 'TLS', # MODIF
	'facteur_smtp_sender' => 'Resoconto degli errori (opzionale)',
	'facteur_smtp_sender_descriptif' => 'Definisce nella testata della mail l’indirizzo mail di resoconto degli errori (o Return-Path), e durante l’invio tramite il metodo SMTP definisce anche l’indirizzo del mittente.',
	'facteur_smtp_username' => 'Nome dell’utente:',

	// M
	'message_identite_email' => 'La configurazione del plugin "facteur" sovraccarica questo indirizzo mail per l’invio della posta.',

	// N
	'note_test_configuration' => 'Una mail sarà inviata all’indirizzo definito (o all’indirizzo del webmaster).', # MODIF

	// P
	'personnaliser' => 'Personnalizzate questi impostazioni',

	// T
	'tester' => 'Provare',
	'tester_la_configuration' => 'Provare la configurazione',

	// U
	'utiliser_mail' => 'Usare la funzione mail di PHP',
	'utiliser_reglages_site' => 'Usare le impostazioni del sito SPIP: il nome visualizzato sarà il nome del sito SPIP e l’indirizzo mail sarà quello del webmaster',
	'utiliser_smtp' => 'Utilisare SMTP',

	// V
	'valider' => 'Confermare',
	'version_html' => 'Versione HTML.',
	'version_texte' => 'Versione testo.'
);

?>
