<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/saisies?lang_cible=it
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// B
	'bouton_parcourir_docs_article' => 'Sfoglia l\'articolo',
	'bouton_parcourir_docs_breve' => 'Sfoglia la breve',
	'bouton_parcourir_docs_rubrique' => 'Sfoglia la rubrica',
	'bouton_parcourir_mediatheque' => 'Sfoglia la mediateca',

	// C
	'construire_action_annuler' => 'Annulla',
	'construire_action_configurer' => 'Configura',
	'construire_action_deplacer' => 'Sposta',
	'construire_action_dupliquer' => 'Duplica',
	'construire_action_dupliquer_copie' => '(copia)',
	'construire_action_supprimer' => 'Elimina',
	'construire_ajouter_champ' => 'Aggiungi un campo',
	'construire_attention_enregistrer' => 'Non dimenticare di salvare le tue modifiche!',
	'construire_attention_modifie' => 'Il modulo in oggetto è diverso dal modulo iniziale. Hai la possibilità di reinizializzare il suo stato a quello precedente alle modifiche.',
	'construire_attention_supprime' => 'Le modifiche includono l\'eliminazione di alcuni campi. Conferma il salvataggio di questa nuova versione del modulo.',
	'construire_aucun_champs' => 'Al momento non è presente alcun campo in questo modulo.',
	'construire_confirmer_supprimer_champ' => 'Vuoi veramente eliminare questo campo?',
	'construire_info_nb_champs_masques' => '@nb@ campo(i) con maschera. Configura il gruppo.',
	'construire_position_explication' => 'Indica prima di quale altro campo sarà spostato quello corrente.',
	'construire_position_fin_formulaire' => 'Alla fine del modulo',
	'construire_position_fin_groupe' => 'Alla fine del gruppo @groupe@',
	'construire_position_label' => 'Posizione del campo',
	'construire_reinitialiser' => 'Reinizializza il modulo',
	'construire_reinitialiser_confirmer' => 'Perderai tutte le modifiche. Sei sicuro di voler tornare al modulo iniziale?',
	'construire_verifications_aucune' => 'Nessuna',
	'construire_verifications_label' => 'Tipo di verifica da effettuare',

	// E
	'erreur_generique' => 'Ci sono degli errori nei campi di seguito, si prega di verificare gli inserimenti',
	'erreur_option_nom_unique' => 'Questo nome è già utilizzato da un altro campo e deve essere univoco all\'interno del modulo.',

	// I
	'info_configurer_saisies' => 'Pagina di test di Saisies',

	// L
	'label_annee' => 'Anno',
	'label_jour' => 'Giorno',
	'label_mois' => 'Mese',

	// O
	'option_aff_art_interface_explication' => 'Mostra unicamente gli articoli della lingua dell\'utente',
	'option_aff_art_interface_label' => 'Visualizzazione multilingua',
	'option_aff_langue_explication' => 'Mostra la lingua dell\'articolo o della rubrica selezionata davanti al titolo',
	'option_aff_langue_label' => 'Mostra la lingua',
	'option_aff_rub_interface_explication' => 'Mostra unicamente le rubriche della lingua dell\'utente',
	'option_aff_rub_interface_label' => 'Visualizzazione multilingua',
	'option_attention_explication' => 'Un messaggio più importante dei una spiegazione.',
	'option_attention_label' => 'Avvertimento',
	'option_autocomplete_defaut' => 'Lascia predefinito',
	'option_autocomplete_explication' => 'Al caricamento della pagina, il tuo navigatore può preimpostare il campo in funzione della sua storia',
	'option_autocomplete_label' => 'Preimpostazione del campo',
	'option_autocomplete_off' => 'Disattiva',
	'option_autocomplete_on' => 'Attiva',
	'option_cacher_option_intro_label' => 'Nascondi la prima scelta vuota',
	'option_choix_destinataires_explication' => 'Uno o più autori tra i quali l\'utente potrà fare una scelta. Se non si seleziona niente, è l\'autore che ha installato il sito che sarà scelto.',
	'option_choix_destinataires_label' => 'Possibili destinatari',
	'option_class_label' => 'Classi CSS supplementari',
	'option_cols_explication' => 'Larghezza del blocco in numero di caratteri. Questa opzione non è sempre applicata poichè gli stili CSS la possono annullare.',
	'option_cols_label' => 'Larghezza',
	'option_datas_explication' => 'Indica una scelta per riga con il formato "chiave|Etichetta della scelta"',
	'option_datas_label' => 'Elenco delle scelte possibili',
	'option_defaut_label' => 'Valore predefinito',
	'option_disable_avec_post_explication' => 'Identica all\'opzione precedente ma invia lo stesso il valore in un campo nascosto.',
	'option_disable_avec_post_label' => 'Disattiva ma invia',
	'option_disable_explication' => 'Il campo non può ottenere il focus.',
	'option_disable_label' => 'Disattiva il campo',
	'option_erreur_obligatoire_explication' => 'Vous pouvez personnaliser le message d\'erreur affiché pour indiquer l\'obligation (sinon laisser vide).', # NEW
	'option_erreur_obligatoire_label' => 'Message d\'obligation', # NEW
	'option_explication_explication' => 'Se necessario, una frase breve che descrive il campo.',
	'option_explication_label' => 'Spiegazione',
	'option_groupe_affichage' => 'Visualizzazione',
	'option_groupe_description' => 'Descrizione',
	'option_groupe_utilisation' => 'Utilizzazione',
	'option_groupe_validation' => 'Validazione',
	'option_heure_pas_explication' => 'Lorsque vous utilisez l’horaire, un menu s’affiche pour aider à saisir heures et minutes. Vous pouvez ici choisir l’intervalle de temps entre chaque choix (par défaut 30min).', # NEW
	'option_heure_pas_label' => 'Intervalle des minutes dans le menu d’aide à la saisie', # NEW
	'option_horaire_label' => 'Horaire', # NEW
	'option_horaire_label_case' => 'Permettre de saisie aussi l’horaire', # NEW
	'option_info_obligatoire_explication' => 'Puoi modificare l\'indicazione predefinita per i campi obbligatori : <i>[Obbligatorio]</i>.',
	'option_info_obligatoire_label' => 'Indicazione obbligatorio',
	'option_inserer_barre_choix_edition' => 'barra del testo completa',
	'option_inserer_barre_choix_forum' => 'barra dei forum',
	'option_inserer_barre_explication' => 'Inserisci una barra del testo se disponibile (porte-plume attivo).',
	'option_inserer_barre_label' => 'Inserisci una barra di utility',
	'option_label_case_label' => 'Etichetta a lato della casella',
	'option_label_explication' => 'Il titolo che sarà mostrato.',
	'option_label_label' => 'Etichetta',
	'option_maxlength_explication' => 'L\'utente non può digiatare più caratteri del numero qui indicato.',
	'option_maxlength_label' => 'Numero massimo di caratteri',
	'option_multiple_explication' => 'L\'utente può selezionare più valori',
	'option_multiple_label' => 'Scelta multipla',
	'option_nom_explication' => 'Un nome informatico che indentifica il campo. Deve contentere solo caratteri alfanumerici minuscoli o il carattere "_".',
	'option_nom_label' => 'Nome del campo',
	'option_obligatoire_label' => 'Campo obbligatorio',
	'option_option_intro_label' => 'Etichetta del primo campo vuoto',
	'option_option_statut_label' => 'Mostra gli stati',
	'option_pliable_label' => 'Richiudibile',
	'option_pliable_label_case' => 'Il gruppo di campi può essere chiuso.',
	'option_plie_label' => 'Già chiuso',
	'option_plie_label_case' => 'Se il gruppo di campi è richiudibile, sarà già chiuso alla visualizzazione del modulo.',
	'option_previsualisation_explication' => 'Se porte-plume è attivo, aggiungi una scheda per previsualizzare la resa del testo inserito.',
	'option_previsualisation_label' => 'Attiva la previsualizzazione',
	'option_readonly_explication' => 'Il campo può essere letto, selezionato, ma non modificato.',
	'option_readonly_label' => 'Sola lettura',
	'option_rows_explication' => 'Altezza del blocco in numero ri righe. Questa opzione non è sempre applicata poichè gli stili CSS del sito potrebbero annullarla.',
	'option_rows_label' => 'Numero di righe',
	'option_size_explication' => 'Larghezza del campo in numero di caratteri. Questa opzione non è sempre applicata poich%egrave; gli stili CSS del sito potrebbero annullarla.',
	'option_size_label' => 'Dimensione del campo',
	'option_type_choix_plusieurs' => 'Consenti all\'utente di scegliere <strong>più</strong> destinatari.',
	'option_type_choix_tous' => 'Imposta <strong>tutti</strong> questi autori come destinatari. L\'utente non avrà alcuna scelta.',
	'option_type_choix_un' => 'Consenti all\'utente di scegliere <strong>un solo</strong> destinatario.',
	'option_type_explication' => 'In modalità "mascherata", il contenuto del campo non sarà visibile.',
	'option_type_label' => 'Tipo del campo',
	'option_type_password' => 'Mascherato',
	'option_type_text' => 'Normale',

	// S
	'saisie_auteurs_explication' => 'Consente di selezionare uno o più autori',
	'saisie_auteurs_titre' => 'Autori',
	'saisie_case_explication' => 'Consente di attivare o disattivare qualcosa.',
	'saisie_case_titre' => 'Casella di spunta',
	'saisie_checkbox_explication' => 'Consente di scegliere più opzioni da spuntare.',
	'saisie_checkbox_titre' => 'Caselle di spunta',
	'saisie_date_explication' => 'Consente di inserire una data con l\'aiuto di un calendario',
	'saisie_date_titre' => 'Data',
	'saisie_destinataires_explication' => 'Consente di scegliere uno o più destinatari tra gli autore selezionati.',
	'saisie_destinataires_titre' => 'Destinatari',
	'saisie_explication_explication' => 'Un testo esplicativo generale.',
	'saisie_explication_titre' => 'Spiegazione',
	'saisie_fieldset_explication' => 'Un blocco che può contenere più campi.',
	'saisie_fieldset_titre' => 'Gruppo di campi',
	'saisie_file_explication' => 'Invio di un file',
	'saisie_file_titre' => 'File',
	'saisie_hidden_explication' => 'Un campo preimpostato che l\'utente non potrà vedere.',
	'saisie_hidden_titre' => 'Campo nascosto',
	'saisie_input_explication' => 'Una semplice riga di testo, che può essere visibile o mascherata (password).',
	'saisie_input_titre' => 'Riga di testo',
	'saisie_oui_non_explication' => 'Si o no',
	'saisie_oui_non_titre' => 'Si o no',
	'saisie_radio_defaut_choix1' => 'Uno',
	'saisie_radio_defaut_choix2' => 'Due',
	'saisie_radio_defaut_choix3' => 'Tre',
	'saisie_radio_explication' => 'Consente di scegliere un\'opzione tra più disponibili.',
	'saisie_radio_titre' => 'Scelta unica',
	'saisie_selecteur_article' => 'Mostra un navigatore per la selezione di un articolo',
	'saisie_selecteur_article_titre' => 'Selettore d\'articolo',
	'saisie_selecteur_rubrique' => 'Mostra un navigatore per la selezione di una rubrica',
	'saisie_selecteur_rubrique_article' => 'Mostra un navigatore per la selezione di un articolo o di una rubrica',
	'saisie_selecteur_rubrique_article_titre' => 'Selettore d\'articolo o rubrica',
	'saisie_selecteur_rubrique_titre' => 'Selettore di rubrica',
	'saisie_selection_explication' => 'Scegli una opzione nel menu a tendina.',
	'saisie_selection_multiple_explication' => 'Consente di scegliere più opzioni con un elenco.',
	'saisie_selection_multiple_titre' => 'Scelta multipla',
	'saisie_selection_titre' => 'Menu a tendina',
	'saisie_textarea_explication' => 'Un campo di testo su più linee.',
	'saisie_textarea_titre' => 'Blocco di testo',

	// T
	'tous_visiteurs' => 'Tutti gli utenti (anche non registrati)',
	'tout_selectionner' => 'Tout sélectionner', # NEW

	// V
	'vue_sans_reponse' => '<i>Senza risposta</i>',

	// Z
	'z' => 'zzz'
);

?>
