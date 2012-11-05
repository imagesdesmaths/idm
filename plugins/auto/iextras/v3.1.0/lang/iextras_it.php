<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/iextras?lang_cible=it
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'action_associer' => 'gestisci questo campo',
	'action_associer_title' => 'Gestisci della visualizzazione di questo campo extra',
	'action_desassocier' => 'disassocia',
	'action_desassocier_title' => 'Non gestire la visualizzazione di questo campo extra',
	'action_descendre' => 'sposta giù',
	'action_descendre_title' => 'Sposta il campo verso il basso',
	'action_modifier' => 'modifica',
	'action_modifier_title' => 'Modifica i parametri del campo extra',
	'action_monter' => 'sposta su',
	'action_monter_title' => 'Sposta il campo verso l\'alto',
	'action_supprimer' => 'elimina',
	'action_supprimer_title' => 'Elimina totalmente il campo dal database',

	// C
	'caracteres_autorises_champ' => 'Caratteri possibili: lettere senza accento, cifre, - e _',
	'caracteres_interdits' => 'Alcuni caratteri utilizzati non sono compatibili con questo campo.',
	'champ_deja_existant' => 'Un campo con lo stesso nome già esiste per questa tabella.',
	'champ_sauvegarde' => 'Campo extra salvato!',
	'champs_extras' => 'Campi Extra',
	'champs_extras_de' => 'Champs Extras de : @objet@', # NEW

	// E
	'erreur_action' => 'Azione @action@ sconosciuta.',
	'erreur_enregistrement_champ' => 'Problema di creazione del campo extra.',

	// I
	'icone_creer_champ_extra' => 'Crea un nuovo campo extra',
	'info_description_champ_extra' => 'Questa pagina consente di gestire i campi extra, 
						e cioè dei campi supplementari all\'interno delle tabelle di SPIP,
						gestiti dai form di modifica e creazione.',
	'info_description_champ_extra_creer' => 'Puoi creare dei nuovi campi che verranno quindi visualizzati
						su questa pagina, nel riquadro "Lista dei campi extra", oltre che nei form.',
	'info_description_champ_extra_presents' => 'Infine, se dei campi già esistono nel database,
						ma non sono dichiarati (da parte di un plugin o di modelli), puoi
            scegliere di farli gestire a questo plugin. Questi campi, qualora rilevati,
            verranno mostrati nel riquadro "Lista dei campi presenti e non gestiti".',
	'info_modifier_champ_extra' => 'Modifica il campo extra',
	'info_nouveau_champ_extra' => 'Nuovo campo extra',
	'info_saisie' => 'Saisie :', # NEW

	// L
	'label_attention' => 'Istruzioni importanti',
	'label_champ' => 'Nome del campo',
	'label_class' => 'Classi CSS',
	'label_datas' => 'Liste de valeurs', # NEW
	'label_explication' => 'Istruzioni di inserimento',
	'label_label' => 'Etichetta di inserimento',
	'label_li_class' => 'Classi CSS dell\'&lt;li&gt; padre',
	'label_obligatoire' => 'Campo obbligatorio?',
	'label_rechercher' => 'Ricerca',
	'label_rechercher_ponderation' => 'Pondération de la recherche', # NEW
	'label_restrictions_auteur' => 'Par auteur', # NEW
	'label_restrictions_branches' => 'Par branche', # NEW
	'label_restrictions_groupes' => 'Par groupe', # NEW
	'label_restrictions_secteurs' => 'Par secteur', # NEW
	'label_saisie' => 'Type de saisie', # NEW
	'label_sql' => 'Definizione SQL',
	'label_table' => 'Oggetto',
	'label_traitements' => 'Trattamenti automatici',
	'label_versionner' => 'Versionner le contenu du champ', # NEW
	'legend_declaration' => 'Dichiarazione',
	'legend_options_saisies' => 'Opzioni di inserimento',
	'legend_options_techniques' => 'Opzioni tecniche',
	'legend_restriction' => 'Restriction', # NEW
	'legend_restrictions_modifier' => 'Modifier la saisie', # NEW
	'legend_restrictions_voir' => 'Voir la saisie', # NEW
	'liste_des_extras' => 'Lista dei campi extra',
	'liste_des_extras_possibles' => 'Lista dei campi presenti e non gestiti',
	'liste_objets_applicables' => 'Liste des objets éditoriaux', # NEW

	// N
	'nb_element' => '1 élément', # NEW
	'nb_elements' => '@nb@ éléments', # NEW

	// P
	'precisions_pour_attention' => 'Per indicare un\'informazione importante.
		Utilizzare con moderazione!!
		Può essere una stringa di traduzione «plugin:stringa».',
	'precisions_pour_class' => 'Aggiungi delle classi CSS all\'elemento,
		separate da uno spazio. Esempio: "inserer_barre_edition" per un riquadro
    con il plugin Porte Plume',
	'precisions_pour_datas' => 'Certains types de champ demandent une liste des valeurs acceptées : indiquez-en une par ligne, suivie d\'une virgule et d\'une description. Une ligne vide pour la valeur par défaut. La description peut être une chaîne de langue.', # NEW
	'precisions_pour_explication' => 'Puoi fornire più informazioni riguardanti l\'inserimento. 
		Può essere una stringa di traduzione «plugin:stringa».',
	'precisions_pour_label' => 'Può essere una stringa di traduzione «plugin:stringa».',
	'precisions_pour_li_class' => 'Aggiungi delle classi CSS all\'elemento &lt;li&gt; padre,
		separate da uno spazio. Esempio: "haut" per avere tutta la larghezza del form',
	'precisions_pour_nouvelle_saisie' => 'Permet de changer le type de saisie utilisée pour ce champ', # NEW
	'precisions_pour_nouvelle_saisie_attention' => 'Attention cependant, un changement de type de saisie perd les options de configuration de la saisie actuelle qui ne sont pas communes avec la nouvelle saisie sélectionnée !', # NEW
	'precisions_pour_rechercher' => 'Includere questo campo nel motore di ricerca?',
	'precisions_pour_rechercher_ponderation' => 'SPIP pondère une recherche dans une colonne par un coefficient de ponderation.
		Celui-ci permet de mettre en avant les colonnes les plus pertinentes (titre par exemple) par rapport à d\'autres qui le sont moins.
		Le coefficient appliqué sur les champs extras est par défaut 2. Pour vous donner un ordre d\'idée, notez que SPIP utilise 8 pour le titre, 1 pour le texte.', # NEW
	'precisions_pour_restrictions_branches' => 'Identifiants de branches à restreindre (séparateur «:»)', # NEW
	'precisions_pour_restrictions_groupes' => 'Identifiants de groupes à restreindre (séparateur «:»)', # NEW
	'precisions_pour_restrictions_secteurs' => 'Identifiants de secteurs à restreindre (séparateur «:»)', # NEW
	'precisions_pour_saisie' => 'Afficher une saisie de type :', # NEW
	'precisions_pour_traitements' => 'Applica automaticamente un trattamento
		per il segnaposto #NOME_DEL_CAMPO:',
	'precisions_pour_versionner' => 'Le versionnage s\'appliquera uniquement si le plugin
		«révisions» est actif et que l\'objet éditorial du champs extra est lui-même versionné', # NEW

	// R
	'radio_restrictions_auteur_admin' => 'Seulement les administrateurs', # NEW
	'radio_restrictions_auteur_aucune' => 'Tout le monde peut', # NEW
	'radio_restrictions_auteur_webmestre' => 'Seulement les webmestres', # NEW
	'radio_traitements_aucun' => 'Nessuno',
	'radio_traitements_raccourcis' => 'Trattamento delle scorciatoie di SPIP (propre)',
	'radio_traitements_typo' => 'Solo trattamento tipografico (typo)',

	// S
	'saisies_champs_extras' => 'Dei «Campi Extra»',
	'saisies_saisies' => 'De «Saisies»',
	'supprimer_reelement' => 'Elimina questo campo?',

	// T
	'titre_iextras' => 'Campi Extra',
	'titre_page_iextras' => 'Campi Extra',

	// V
	'veuillez_renseigner_ce_champ' => 'Si prega di compilare questo campo!'
);

?>
