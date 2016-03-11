<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans svn://zone.spip.org/spip-zone/_plugins_/champs_extras_interface/trunk/lang/
if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'action_associer' => 'gérer ce champ',
	'action_associer_title' => 'Gérer l’affichage de ce champ extra',
	'action_desassocier' => 'désassocier',
	'action_desassocier_title' => 'Ne plus gérer l’affichage de ce champ extra',
	'action_descendre' => 'descendre',
	'action_descendre_title' => 'Déplacer le champ d’un rang vers le bas',
	'action_modifier' => 'modifier',
	'action_modifier_title' => 'Modifier les paramètres du champ extra',
	'action_monter' => 'monter',
	'action_monter_title' => 'Monter le champ d’un rang vers le haut',
	'action_supprimer' => 'supprimer',
	'action_supprimer_title' => 'Supprimer totalement le champ de la base de données',

	// B
	'bouton_importer' => 'Importer',

	// C
	'caracteres_autorises_champ' => 'Caractères possibles : lettres sans accent, chiffres, - et _',
	'caracteres_interdits' => 'Certains caractères utilisés ne conviennent pas pour ce champ.',
	'champ_deja_existant' => 'Un champ homonyme existe déjà pour cette table.',
	'champ_sauvegarde' => 'Champ extra sauvegardé !',
	'champs_extras' => 'Champs Extras',
	'champs_extras_de' => 'Champs Extras de : @objet@',

	// E
	'erreur_action' => 'Action @action@ inconnue.',
	'erreur_enregistrement_champ' => 'Problème de création du champ extra.',
	'erreur_format_export' => 'Format d’export @format@ inconnu.',
	'exporter_objet' => 'Exporter tous les champs extras de : @objet@',
	'exporter_objet_champ' => 'Exporter le champs extras : @objet@ / @nom@',
	'exporter_tous' => 'Exporter tous les champs extras',
	'exporter_tous_explication' => 'Exporter tous les champs extras au format YAML pour utilisation dans le formulaire d’importation',
	'exporter_tous_php' => 'Export PHP',
	'exporter_tous_php_explication' => 'Exporter au format PHP pour réutilisation dans un plugin dépendant uniquement de Champs Extras Core.',

	// I
	'icone_creer_champ_extra' => 'Créer un nouveau champ extra',
	'importer_explications' => 'Le fait d’importer des champs extras dans ce site complètera
		tous les champs extras déjà présents avec les nouveaux déclarés dans le fichier d’import.
		Les nouveaux champs s’ajouteront à la suite des champs extras déjà présents.',
	'importer_fichier' => 'Fichier à importer',
	'importer_fichier_explication' => 'Fichier d’export au format YAML',
	'importer_fusionner' => 'Modifier les champs déjà présents',
	'importer_fusionner_explication' => 'Si des champs extras à importer sont déjà présents sur le site,
		le processus d’importation les ignore (par défaut). Vous pouvez cependant demander à
		modifier toutes les informations de ces champs avec ceux du fichier d’importé.',
	'importer_fusionner_non' => 'Ne pas toucher les champs déjà présents sur le site',
	'importer_fusionner_oui' => 'Modifier les champs extras communs avec l’import',
	'info_description_champ_extra' => 'Cette page permet de gérer des champs extras, 
						c’est à dire des champs supplémentaires dans les tables de SPIP,
						pris en compte dans les formulaires d’édition.',
	'info_description_champ_extra_creer' => 'Vous pouvez créer de nouveaux champs qui s’afficheront alors
						sur cette page, dans le cadre « Liste des objets éditoriaux », ainsi que dans les formulaires.',
	'info_description_champ_extra_presents' => 'Enfin, si des champs existent déjà dans votre base de données,
						mais ne sont pas déclarés (par un plugin ou un jeu de squelettes), vous
						pouvez demander à ce plugin de les gérer. Ces champs, s’il y en a,
						apparaissent dans un cadre « Liste des champs présents non gérés ».',
	'info_modifier_champ_extra' => 'Modifier champ extra',
	'info_nouveau_champ_extra' => 'Nouveau champ extra',
	'info_saisie' => 'Saisie :',

	// L
	'label_attention' => 'Explications très importantes',
	'label_champ' => 'Nom du champ',
	'label_class' => 'Classes CSS',
	'label_conteneur_class' => 'Classes CSS du conteneur parent',
	'label_datas' => 'Liste de valeurs',
	'label_explication' => 'Explications de la saisie',
	'label_label' => 'Label de la saisie',
	'label_obligatoire' => 'Champ obligatoire ?',
	'label_rechercher' => 'Recherche',
	'label_rechercher_ponderation' => 'Pondération de la recherche',
	'label_restrictions_auteur' => 'Par auteur',
	'label_restrictions_branches' => 'Par branche',
	'label_restrictions_groupes' => 'Par groupe',
	'label_restrictions_secteurs' => 'Par secteur',
	'label_saisie' => 'Type de saisie',
	'label_sql' => 'Définition SQL',
	'label_table' => 'Objet',
	'label_traitements' => 'Traitements automatiques',
	'label_versionner' => 'Versionner le contenu du champ',
	'legend_declaration' => 'Déclaration',
	'legend_options_saisies' => 'Options de la saisie',
	'legend_options_techniques' => 'Technique',
	'legend_restriction' => 'Restriction',
	'legend_restrictions_modifier' => 'Modifier la saisie',
	'legend_restrictions_voir' => 'Voir la saisie',
	'liste_des_extras' => 'Liste des champs extras',
	'liste_des_extras_possibles' => 'Liste des champs présents non gérés',
	'liste_objets_applicables' => 'Liste des objets éditoriaux',

	// N
	'nb_element' => '1 élément',
	'nb_elements' => '@nb@ éléments',

	// P
	'precisions_pour_attention' => 'Pour quelque chose de très important à indiquer.
		À utiliser avec beaucoup de modération !
		Peut être une chaîne de langue « plugin:chaine ».',
	'precisions_pour_class' => 'Ajouter des classes CSS sur l’élément,
		séparées par un espace. Exemple : "inserer_barre_edition" pour un bloc
		avec le plugin Porte Plume',
	'precisions_pour_conteneur_class' => 'Ajouter des classes CSS sur le conteneur parent,
		séparées par un espace. Exemple : "pleine_largeur" pour avoir toute la largeur sur le formulaire',
	'precisions_pour_datas' => 'Certains types de champ demandent une liste des valeurs acceptées : indiquez-en une par ligne, suivie d’une virgule et d’une description. Une ligne vide pour la valeur par défaut. La description peut être une chaîne de langue.',
	'precisions_pour_explication' => 'Vous pouvez donner plus d’informations concernant la saisie. 
		Peut être une chaîne de langue « plugin:chaine ».',
	'precisions_pour_label' => 'Peut être une chaîne de langue « plugin:chaine ».',
	'precisions_pour_nouvelle_saisie' => 'Permet de changer le type de saisie utilisée pour ce champ',
	'precisions_pour_nouvelle_saisie_attention' => 'Attention cependant, un changement de type de saisie perd les options de configuration de la saisie actuelle qui ne sont pas communes avec la nouvelle saisie sélectionnée !',
	'precisions_pour_rechercher' => 'Inclure ce champ dans le moteur de recherche ?',
	'precisions_pour_rechercher_ponderation' => 'SPIP pondère une recherche dans une colonne par un coefficient de ponderation.
		Celui-ci permet de mettre en avant les colonnes les plus pertinentes (titre par exemple) par rapport à d’autres qui le sont moins.
		Le coefficient appliqué sur les champs extras est par défaut 2. Pour vous donner un ordre d’idée, notez que SPIP utilise 8 pour le titre, 1 pour le texte.',
	'precisions_pour_restrictions_branches' => 'Identifiants de branches à restreindre (séparateur « :»)',
	'precisions_pour_restrictions_groupes' => 'Identifiants de groupes à restreindre (séparateur « :»)',
	'precisions_pour_restrictions_secteurs' => 'Identifiants de secteurs à restreindre (séparateur « :»)',
	'precisions_pour_saisie' => 'Afficher une saisie de type :',
	'precisions_pour_traitements' => 'Appliquer automatiquement un traitement
		pour la balise #NOM_DU_CHAMP résultante :',
	'precisions_pour_versionner' => 'Le versionnage s’appliquera uniquement si le plugin
		« révisions » est actif et que l’objet éditorial du champ extra est lui-même versionné',

	// R
	'radio_restrictions_auteur_admin' => 'Seulement les administrateurs (même restreints)',
	'radio_restrictions_auteur_admin_complet' => 'Seulement les administrateurs complets',
	'radio_restrictions_auteur_aucune' => 'Tout le monde peut',
	'radio_restrictions_auteur_webmestre' => 'Seulement les webmestres',
	'radio_traitements_aucun' => 'Aucun',
	'radio_traitements_raccourcis' => 'Traitements des raccourcis SPIP (propre)',
	'radio_traitements_typo' => 'Traitements de typographie uniquement (typo)',

	// S
	'saisies_champs_extras' => 'De « Champs Extras »',
	'saisies_saisies' => 'De « Saisies »',
	'supprimer_reelement' => 'Supprimer ce champ ?',

	// T
	'titre_iextras' => 'Champs Extras',
	'titre_iextras_exporter' => 'Exporter des Champs Extras',
	'titre_iextras_exporter_importer' => 'Exporter ou importer des Champs Extras',
	'titre_iextras_importer' => 'Importer des Champs Extras',
	'titre_page_iextras' => 'Champs Extras',

	// V
	'veuillez_renseigner_ce_champ' => 'Veuillez renseigner ce champ !'
);

?>
