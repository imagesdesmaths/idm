<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org/tradlang_module/sites?lang_cible=es
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'articles_dispo' => 'En attente', # NEW
	'articles_meme_auteur' => 'Tous les articles de cet auteur', # NEW
	'articles_off' => 'Bloqués', # NEW
	'articles_publie' => 'Publiés', # NEW
	'articles_refuse' => 'Supprimés', # NEW
	'articles_tous' => 'Tous', # NEW
	'aucun_article_syndic' => 'Aucun article syndiqué', # NEW
	'avis_echec_syndication_01' => 'La sindicación falló: el «backend» indicado es indescifrable o no propone ningún artículo.',
	'avis_echec_syndication_02' => 'La sindicación falló: imposible acceder al «backend» de este sitio.',
	'avis_site_introuvable' => 'No se encuentra el sitio',
	'avis_site_syndique_probleme' => 'ATENCIÓN: la sindicación de ese sitio encontró un problema; por lo cual se interrumpió el sistema temporalmente. Verifica la dirección del archivo de sindicación de este sitio (<b>@url_syndic@</b>), e intenta una nueva recuperación de la información.',
	'avis_sites_probleme_syndication' => 'Estos sitios tienen un problema de sindicación',
	'avis_sites_syndiques_probleme' => 'Estos sitios sindicados tienen problemas',

	// B
	'bouton_exporter' => 'Exporter', # NEW
	'bouton_importer' => 'Importer', # NEW
	'bouton_radio_modere_posteriori' => 'moderado a posteriori', # MODIF
	'bouton_radio_modere_priori' => 'moderado a priori', # MODIF
	'bouton_radio_non_syndication' => 'Ninguna sindicación',
	'bouton_radio_syndication' => 'Sindicación',

	// C
	'confirmer_purger_syndication' => 'Êtes-vous certain de vouloir supprimer tous les articles syndiqués de ce site ?', # NEW

	// E
	'entree_adresse_fichier_syndication' => 'Dirección del archivo de sindicación:',
	'entree_adresse_site' => '<b>Dirección del sitio</b> [Obligatorio]',
	'entree_description_site' => 'Descripción del sitio',
	'erreur_fichier_format_inconnu' => 'Le format du fichier @fichier@ n\'est pas pris en charge.', # NEW
	'erreur_fichier_incorrect' => 'Impossible de lire le fichier.', # NEW

	// F
	'form_prop_nom_site' => 'Nombre del sitio',

	// I
	'icone_article_syndic' => 'Article syndiqué', # NEW
	'icone_articles_syndic' => 'Articles syndiqués', # NEW
	'icone_controler_syndication' => 'Publication des articles syndiqués', # NEW
	'icone_modifier_site' => 'Modificar este sitio',
	'icone_referencer_nouveau_site' => 'Referenciar un nuevo sitio',
	'icone_site_reference' => 'Sites référencés', # NEW
	'icone_supprimer_article' => 'Supprimer cet article', # NEW
	'icone_supprimer_articles' => 'Supprimer ces articles', # NEW
	'icone_valider_article' => 'Valider cet article', # NEW
	'icone_valider_articles' => 'Valider ces articles', # NEW
	'icone_voir_sites_references' => 'Ver los sitios referenciados',
	'info_1_site_importe' => '1 site a été importé', # NEW
	'info_a_valider' => '[a validar]',
	'info_aucun_site_importe' => 'Aucun site n\'a pu être importé', # NEW
	'info_bloquer' => 'bloquear',
	'info_bloquer_lien' => 'bloquear este enlace',
	'info_derniere_syndication' => 'La última sindicación de este sitio fue realizada el',
	'info_liens_syndiques_1' => 'enlaces sindicados',
	'info_liens_syndiques_2' => 'están en espera de validación.',
	'info_nb_sites_importes' => '@nb@ sites ont été importés', # NEW
	'info_nom_site_2' => '<b>Nombre del sitio</b> [Obligatorio]',
	'info_panne_site_syndique' => 'El sitio sindicado tiene problemas',
	'info_probleme_grave' => 'problema de',
	'info_question_proposer_site' => '¿Quién puede proponer los sitios referenciados?',
	'info_retablir_lien' => 'restablecer el enlace',
	'info_site_attente' => 'Sitio Web en espera de validación',
	'info_site_propose' => 'Sitio propuesto el',
	'info_site_reference' => 'Sitio referenciado en línea',
	'info_site_refuse' => 'Sitio Web rechazado',
	'info_site_syndique' => 'Este sitio está sindicado...', # MODIF
	'info_site_valider' => 'Sitios a validar',
	'info_sites_referencer' => 'Referenciar un sitio',
	'info_sites_refuses' => 'Los sitios rechazados',
	'info_statut_site_1' => 'Este sitio está:',
	'info_statut_site_2' => 'Publicado',
	'info_statut_site_3' => 'Propuesto',
	'info_statut_site_4' => 'A la papelera', # MODIF
	'info_syndication' => 'sindicación:',
	'info_syndication_articles' => 'artículo(s)',
	'item_bloquer_liens_syndiques' => 'Bloquear los enlaces sindicados en validación',
	'item_gerer_annuaire_site_web' => 'Gestionar un directorio de sitios Web',
	'item_non_bloquer_liens_syndiques' => 'No bloquear los enlaces de sindicación',
	'item_non_gerer_annuaire_site_web' => 'Desactivar el directorio de sitios Web',
	'item_non_utiliser_syndication' => 'No utilizar la sindicación automática',
	'item_utiliser_syndication' => 'Utilizar la sindicación automática',

	// L
	'label_exporter_avec_mots_cles_1' => 'Exporter les mots-clés sous forme de tags', # NEW
	'label_exporter_id_parent' => 'Exporter les sites de la rubrique', # NEW
	'label_exporter_publie_seulement_1' => 'Exporter uniquement les sites publiés', # NEW
	'label_fichier_import' => 'Fichier HTML', # NEW
	'label_importer_les_tags_1' => 'Importer les tags sous forme de mot-clé', # NEW
	'label_importer_statut_publie_1' => 'Publier automatiquement les sites', # NEW
	'lien_mise_a_jour_syndication' => 'Actualizar ahora',
	'lien_nouvelle_recuperation' => 'Intentar recuperar nuevamente los datos',
	'lien_purger_syndication' => 'Effacer tous les articles syndiqués', # NEW

	// N
	'nombre_articles_syndic' => '@nb@ articles syndiqués', # NEW

	// S
	'statut_off' => 'Supprimé', # NEW
	'statut_prop' => 'En attente', # NEW
	'statut_publie' => 'Publié', # NEW
	'syndic_choix_moderation' => '¿Qué hacemos con los siguientes enlaces que vengan de este sitio?',
	'syndic_choix_oublier' => '¿Qué hacemos con los enlaces que no figuren en el archivo de sindicación?',
	'syndic_choix_resume' => 'Algunos sitios difunden el texto completo de los artículos. Cuando esté disponible, deseas sindicar:',
	'syndic_lien_obsolete' => 'enlace obsoleto',
	'syndic_option_miroir' => 'bloquearlos automáticamente',
	'syndic_option_oubli' => 'borrarlos (tras @mois@ meses)',
	'syndic_option_resume_non' => 'el contenido completo de los artículos (en formato HTML)',
	'syndic_option_resume_oui' => 'un simple resumen (en formato texto)',
	'syndic_options' => 'Opciones de sindicación:',

	// T
	'texte_expliquer_export_bookmarks' => 'Vous pouvez exporter une liste de sites au format Marque-page HTML,
	pour vous permettre ensuite de l\'importer dans votre navigateur ou dans un service en ligne', # NEW
	'texte_expliquer_import_bookmarks' => 'Vous pouvez importer une liste de sites au format Marque-page HTML,
	en provenance de votre navigateur ou d\'un service en ligne de gestion des Marques-pages.', # NEW
	'texte_liens_sites_syndiques' => 'Los enlaces salidos de los sitios sindicados pueden
 ser bloqueados a priori ; el ajuste indicado
 a continuación se refiere al ajuste
 predeterminado de los sitios sindicados después
 de su creación. De todos modos, posteriormente
 se puede desbloquear cada enlace individualmente, o
 escoger, sitio a sitio, el bloqueo de los
 enlaces que vienen de tal o cual sitio.', # MODIF
	'texte_messages_publics' => 'Mensajes públicos del artículo:',
	'texte_non_fonction_referencement' => 'Puedes preferir no usar esta función automática, e indicar tu mismo los elementos concernientes a este sitio...', # MODIF
	'texte_referencement_automatique' => '<b>Referenciar automáticamente un sitio</b><br />Se puede referenciar rápidamente un sitio Web indicando aquí la dirección URL deseada, o la dirección de su archivo de sindicación. SPIP recuperará automáticamente las informaciones correspondientes (título, descripción...).', # MODIF
	'texte_referencement_automatique_verifier' => 'Deberías verificar la información facilitada por <tt>@url@</tt> antes de guardar.',
	'texte_syndication' => 'Es posible recuperar automáticamente, cuando un sitio Web lo permite,
 la lista de novedades. Para ello, debes activar la sindicación.
<blockquote><i>Algunos proveedores de hospedaje desactivan esta funcionalidad ;
 en ese caso, no podrás utilizar la sindicación de contenido desde tu sitio.</i></blockquote>', # MODIF
	'titre_articles_syndiques' => 'Artículos sindicados de este sitio',
	'titre_dernier_article_syndique' => 'Ultimos artículos sindicados',
	'titre_exporter_bookmarks' => 'Exporter des Marques-pages', # NEW
	'titre_importer_bookmarks' => 'Importer des Marques-pages', # NEW
	'titre_importer_exporter_bookmarks' => 'Importer et Exporter des Marques-pages', # NEW
	'titre_page_sites_tous' => 'Los sitios referenciados',
	'titre_referencement_sites' => 'Agregar sitios y sindicar',
	'titre_site_numero' => 'Sitio',
	'titre_sites_proposes' => 'Los sitios propuestos',
	'titre_sites_references_rubrique' => 'Los sitios referenciados en esta sección',
	'titre_sites_syndiques' => 'Los sitios sindicados',
	'titre_sites_tous' => 'Los sitios referenciados',
	'titre_syndication' => 'Sindicación de sitios',
	'tout_voir' => 'Voir tous les articles syndiqués', # NEW

	// U
	'un_article_syndic' => '1 article syndiqué' # NEW
);

?>
