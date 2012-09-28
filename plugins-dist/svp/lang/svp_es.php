<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/svp?lang_cible=es
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'action_patienter' => 'Las acciones solicitadas se están procesando. Por favor, espere...',
	'actions_a_faire' => 'Acciones a ejecutar',
	'actions_demandees' => 'Acciones solicitadas:',
	'actions_en_erreur' => 'Errores que se produjeron',
	'actions_necessaires' => 'Se realizarán las siguientes acciones adicionales:',
	'actions_non_traitees' => 'Acciones no ejecutadas',
	'actions_realises' => 'Acciones ejecutadas',
	'afficher_les_plugins_incompatibles' => 'Mostrar los plugins incompatibles',
	'alerte_compatibilite' => 'Compatibilité forcée', # NEW

	// B
	'bouton_activer' => 'Activar',
	'bouton_actualiser' => 'Actualizar',
	'bouton_actualiser_tout' => 'Actualizar los repositorios',
	'bouton_appliquer' => 'Aplicar',
	'bouton_confirmer' => 'Confirmar',
	'bouton_desactiver' => 'Desactivar',
	'bouton_desinstaller' => 'Desinstalar',
	'bouton_installer' => 'Descargar y activar',
	'bouton_modifier_depot' => 'Modificar el repositorio',
	'bouton_supprimer' => 'Eliminar',
	'bouton_up' => 'Actualizar',
	'bulle_actualiser_depot' => 'Actualizar los paquetes del repositorio',
	'bulle_actualiser_tout_depot' => 'Actualizar los paquetes de todos los repositorios',
	'bulle_afficher_xml_plugin' => 'Contenido del archivo XML del plugin',
	'bulle_ajouter_spipzone' => 'Añadir el repositorio SPIP-Zone',
	'bulle_aller_depot' => 'Dirige a la página de este repositorio',
	'bulle_aller_documentation' => 'Se dirige a la página de documentación',
	'bulle_aller_plugin' => 'Se dirige a la página del plugin',
	'bulle_supprimer_depot' => 'Suprimir el repositorio y sus paquetes',
	'bulle_telecharger_archive' => 'Descargar el archivo',
	'bulle_telecharger_fichier_depot' => 'Descargar el archivo XML del repositorio',
	'bulle_telecharger_librairie' => 'Descargar la biblioteca',

	// C
	'cacher_les_plugins_incompatibles' => 'No mostrar los plugins incompatibles',
	'categorie_aucune' => 'Sin categoría',
	'categorie_auteur' => 'Autenticación, autor, autorización',
	'categorie_communication' => 'Comunicación, interactividad, mensajería',
	'categorie_date' => 'Agenda, calendario, fechas',
	'categorie_divers' => 'Nuevos objetos, servicios externos',
	'categorie_edition' => 'Edición, impresión, redacción',
	'categorie_maintenance' => 'Configuración, mantenimiento',
	'categorie_multimedia' => 'Imágenes, galería, multimedia',
	'categorie_navigation' => 'Navegación, búsqueda, organización',
	'categorie_outil' => 'Herramienta de desarrollo',
	'categorie_performance' => 'Optimización, desempeño, seguridad',
	'categorie_squelette' => 'Esqueleto',
	'categorie_statistique' => 'Referenciamiento, estadísticas',
	'categorie_theme' => 'Tema',
	'config_activer_log_verbeux' => '¿Activar los logs detallados?',
	'config_activer_log_verbeux_explication' => 'Esta opción genera logs de SVP mucho más locuaces...',
	'config_activer_pas_a_pas' => '¿Activar el modo paso a paso?',
	'config_activer_pas_a_pas_explication' => 'Activar este modo permite mostrar información sobre los resultados de la acción después de que se completa cada paso, en lugar de mostrar conjuntamente el resultado global de todas las acciones al finalizar el proceso solicitado.',
	'config_activer_runtime' => '¿Activer el modo runtime ?',
	'config_activer_runtime_explication' => 'El modo runtime (si) carga únicamente los plugins compatibles con la versión de SPIP que estás utilizando, lo que es altamente recomendado para la mayoría de los usuarios. En el modo no-runtime (non) son cargados todos los plugins de un repositorio, cualquiera sea la versión de SPIP que estés utilizando. Esto es útil únicamente para utilizar SVP con el propósito de presentar todos los plugins existentes, como lo hace el sitio Plugins SPIP (plugins.spip.net)',
	'config_autoriser_activer_paquets_obsoletes' => '¿Autorizar la activación de los paquetes obsoletos?',
	'config_autoriser_activer_paquets_obsoletes_explication' => 'Los paquetes obsoletos son paquetes locales que son más antiguos que otros paquetes existentes a nivel local. La obsolescencia es determinada sobre la base del estado (estable, en prueba, en desarrollo) del paquete, así como en función de su versión. Activa esta opción si deseas conservar la capacidad de activar estos plugins obsoletos. ',
	'config_depot_editable' => '¿Permitir la edición de los repositorios?',
	'config_depot_editable_explication' => 'Esto permite que las informaciones de un repositorio puedan ser modificadas y que se les puedan asignar palabras clave o documentos. Esta opción no debería interesarle a nadie! Es preferible dejarla establecida en "no"!',
	'confirmer_telecharger_dans' => 'El plugin será cargado en una carpeta (@dir@) que ya existe. Esta acción  eliminará el contenido actual de dicha carpeta. Una copia de los contenidos actuales será guardado en "@dir_backup@". Debes confirmar esta acción.',

	// E
	'erreur_actions_non_traitees' => 'Certaines actions n\'ont pas été réalisées. Cela peut provenir d\'une erreur lors des actions à réaliser, ou d\'un affichage de cette page alors que des actions sont encore en cours. Les actions avaient été lancées par @auteur@ le @date@.', # NEW
	'erreur_dir_dib_ecriture' => 'Le répertoire des bibliothèques @dir@ n\'est pas accessible en écriture. Impossible d\'y charger une bibliothèque !', # NEW
	'erreur_dir_dib_indefini' => 'Le répertoire _DIR_LIB n\'est pas défini. Impossible d\'y charger une bibliothèque !', # NEW
	'erreur_dir_plugins_auto' => 'Le répertoire « plugins/auto » permettant de télécharger des paquets
		n\'est pas créé ou n\'est pas accessible en écriture.
		<strong>Vous devez le créer pour pouvoir installer de nouveaux plugins depuis cette interface.</strong>', # NEW
	'erreur_dir_plugins_auto_ecriture' => 'Le répertoire de paquets @dir@ n\'est pas accessible en écriture. Impossible d\'y charger un paquet !', # NEW
	'erreur_dir_plugins_auto_indefini' => 'La carpeta _DIR_PLUGIN_AUTO no está definida. No es posible cargar el paquete! ',
	'erreur_dir_plugins_auto_titre' => 'No se puede acceder a "plugins/auto"!',
	'erreur_teleporter_chargement_source_impossible' => 'Chargement impossible de la source @source@', # NEW
	'erreur_teleporter_destination_erreur' => 'Répertoire @dir@ non accessible pour téléporter', # NEW
	'erreur_teleporter_echec_deballage_archive' => 'No se puede descomprimir  @fichier@',
	'erreur_teleporter_format_archive_non_supporte' => 'Le format @extension@ n\'est pas supporté par le téléporteur', # NEW
	'erreur_teleporter_methode_inconue' => 'Méthode @methode@ inconnue pour téléporter', # NEW
	'erreur_teleporter_type_fichier_inconnu' => 'Tipo de archivo desconocido para  @source@',
	'erreurs_xml' => 'Impossible de lire certaines descriptions XML', # NEW
	'explication_destination' => 'Le chemin sera calculé depuis le nom de l\'archive si vous ne le remplissez pas.', # NEW

	// F
	'fieldset_debug' => 'Depurar',
	'fieldset_edition' => 'Edición',
	'fieldset_fonctionnement' => 'Funcionamiento',

	// I
	'info_1_depot' => '1 repositorio',
	'info_1_paquet' => '1 paquete',
	'info_1_plugin' => '1 plugin',
	'info_admin_plugin_actif_non_verrou_non' => 'Cette page liste les plugins non actifs du site. Ces plugins sont forcément non verrouillés.', # NEW
	'info_admin_plugin_actif_non_verrou_tous' => 'Cette page liste les plugins non actifs du site. Ces plugins sont forcément non verrouillés.', # NEW
	'info_admin_plugin_actif_oui_verrou_non' => 'Cette page liste les plugins actifs et non verrouillés du site.', # NEW
	'info_admin_plugin_actif_oui_verrou_tous' => 'Cette page liste tous les plugins actifs du site, verrouillés ou pas.', # NEW
	'info_admin_plugin_verrou_non' => 'Cette page liste tous les plugins non verrouillés du site, actifs ou pas.', # NEW
	'info_admin_plugin_verrou_tous' => 'Esta página muestra todos los plugins del sitio.',
	'info_admin_plugin_verrouille' => 'Cette page liste les plugins actifs et verrouillés (placés dans le répertoire <code>@dir_plugins_dist@</code>).
	Si vous souhaitez les désactiver,
	veuillez contacter le webmestre du site,
	ou vous reporter <a href="http://programmer.spip.org/repertoire_plugins_dist">à la documentation</a>.', # NEW
	'info_adresse_spipzone' => 'SPIP-Zone - Plugins',
	'info_ajouter_depot' => 'En ajoutant des dépôts à votre base, vous aurez la possiblité d\'obtenir des informations et d\'effectuer des recherches sur tous les paquets hébergés par les dépôts ajoutés.<br />Un dépôt est décrit par un fichier XML contenant les informations sur le dépôt et sur tous ses paquets.', # NEW
	'info_aucun_depot' => 'ningún repositorio',
	'info_aucun_depot_ajoute' => 'Aucun dépôt disponible !<br /> Utilisez le formulaire ci-dessous pour ajouter le dépôt «SPIP-Zone - Plugins» dont l\'url est déjà pré-remplie ou un autre dépôt de votre choix.', # NEW
	'info_aucun_paquet' => 'ningún paquete',
	'info_aucun_plugin' => 'ningún plugin',
	'info_boite_charger_plugin' => '<strong>Cette page est uniquement accessible aux webmestres du site.</strong><p>Elle vous permet de rechercher des plugins mis à disposition par les dépôts enregistrés dans votre configuration et de les installer physiquement sur votre serveur</p>', # NEW
	'info_boite_depot_gerer' => '<strong>Cette page est uniquement accessible aux webmestres du site.</strong><p>Elle permet l\'ajout et l\'actualisation des dépôts de plugins.</p>', # NEW
	'info_charger_plugin' => 'Pour ajouter un ou plusieurs plugins, effectuez préalablement une recherche multi-critères sur les plugins de la galaxie SPIP. La recherche n\'inclut que les plugins compatibles avec la version SPIP installée et signale les plugins déjà actifs sur le site.', # NEW
	'info_compatibilite_dependance' => 'Para @compatibilite@:',
	'info_contributions_hebergees' => '@total_autres@ autre(s) contribution(s) hébergée(s)', # NEW
	'info_critere_phrase' => 'Saisissez les mots-clés à chercher dans le préfixe, le nom, le slogan, la description et les auteurs des plugins', # NEW
	'info_depots_disponibles' => '@total_depots@ repositorio(s)',
	'info_fichier_depot' => 'Saisissez l\'url du fichier de description du dépôt à ajouter.<br />Pour ajouter le dépôt «SPIP-Zone - Plugins» cliquez sur ce lien : ', # NEW
	'info_nb_depots' => '@nb@ repositorios',
	'info_nb_paquets' => '@nb@ paquetes',
	'info_nb_plugins' => '@nb@ plugins',
	'info_paquets_disponibles' => '@total_paquets@ paquete(s) disponible(s)',
	'info_plugin_attente_dependance' => 'dependencias faltantes',
	'info_plugin_incompatible' => 'versión incompatible',
	'info_plugin_installe' => 'ya instalado',
	'info_plugin_obsolete' => 'versión obsoleta',
	'info_plugins_disponibles' => '@total_plugins@ plugin(s) disponible(s)',
	'info_plugins_heberges' => '@total_plugins@ plugin(s) almacenado(s)',
	'info_tri_nom' => 'ordenado(s) alfabéticamente',
	'info_tri_score' => 'ordenado(s) por pertinencia decreciente',
	'info_type_depot_git' => 'Repositorio administrado con GIT',
	'info_type_depot_manuel' => 'Repositorio administrado manualmente',
	'info_type_depot_svn' => 'Repositorio administrado con SVN',
	'info_verrouille' => 'No es posible desactivar o desinstalar este plugin.',
	'installation_en_cours' => 'Las acciones solicitadas están siendo ejecutadas',

	// L
	'label_1_autre_contribution' => 'otra contribución',
	'label_actualise_le' => 'Actualizado el',
	'label_archive' => 'URL del archivo',
	'label_branches_spip' => 'Compatible',
	'label_categorie' => 'Categoría',
	'label_compatibilite_spip' => 'Compatibilidad',
	'label_critere_categorie' => 'Categorías',
	'label_critere_depot' => 'Repositorios',
	'label_critere_doublon' => 'Compatibilidad',
	'label_critere_etat' => 'Estados',
	'label_critere_phrase' => 'Buscar en los plugins',
	'label_destination' => 'Ruta del directorio « auto » donde subir el plugin',
	'label_modifie_le' => 'Modificado el',
	'label_n_autres_contributions' => 'otras contribuciones',
	'label_prefixe' => 'Prefijo',
	'label_selectionner_plugin' => 'Seleccionar este plugin',
	'label_tags' => 'Etiquetas',
	'label_type_depot' => 'Tipo de repositorio:',
	'label_type_depot_git' => 'Repositorio en GIT',
	'label_type_depot_manuel' => 'Repositorio manual',
	'label_type_depot_svn' => 'Repositorio con SVN',
	'label_url_archives' => 'URL del contenedor de los archivos',
	'label_url_brouteur' => 'URL de la raíz de las fuentes',
	'label_url_serveur' => 'URL del servidor',
	'label_version' => 'Versión',
	'label_xml_depot' => 'Archivo XML del repositorio',
	'label_xml_plugin' => 'XML',
	'legende_installer_plugins' => 'Instalar plugins',
	'legende_rechercher_plugins' => 'Buscar plugins',

	// M
	'message_action_finale_get_fail' => 'El plugin "@plugin@" (versión: @version@) no ha podido ser recuperado correctamente',
	'message_action_finale_get_ok' => 'El plugin "@plugin@" (versión: @version@) ha sido recuperado exitosamente',
	'message_action_finale_getlib_fail' => 'La instalación de la biblioteca "@plugin@" ha fallado',
	'message_action_finale_getlib_ok' => 'La biblioteca "@plugin@" ha sido instalada',
	'message_action_finale_geton_fail' => 'La descarga o la activación del  plugin "@plugin@"  (versión: @version@) no se han  efectuado correctamente',
	'message_action_finale_geton_ok' => 'La descarga y la activación del plugin "@plugin@" (versión: @version@) se ejecutaron exitosamente.',
	'message_action_finale_install_fail' => 'La instalación del plugin  "@plugin@" (versión : @version@) ha fallado',
	'message_action_finale_install_ok' => 'La instalación del plugin "@plugin@" (versión : @version@) se ha ejecutado exitosamente',
	'message_action_finale_kill_fail' => 'Los archivos del plugin "@plugin@" (versión: @version@) no han podido ser correctamente eliminados',
	'message_action_finale_kill_ok' => 'Los archivos del plugin "@plugin@" (versión: @version@) han sido eliminados exitosamente',
	'message_action_finale_off_fail' => 'La desactivación del plugin "@plugin@" (versión: @version@) no se ha completado correctamente',
	'message_action_finale_off_ok' => 'La desactivación del plugin "@plugin@" (versión: @version@) se ha ejecutado exitosamente',
	'message_action_finale_on_fail' => 'La activación del plugin "@plugin@" (versión: @version@) no se ha completado correctamente',
	'message_action_finale_on_ok' => 'La activación del plugin "@plugin@" (versión: @version@) se ha ejecutado exitosamente',
	'message_action_finale_stop_fail' => 'La desinstalación del plugin "@plugin@" (versión: @version@) no se ha completado correctamente',
	'message_action_finale_stop_ok' => 'La desinstalación del plugin "@plugin@" (versión: @version@) se ha ejecutado exitosamente',
	'message_action_finale_up_fail' => 'La actualización del plugin "@plugin@" (de la versión  @version@ a la @version_maj@) no se ha completado correctamente',
	'message_action_finale_up_ok' => 'La actualización del "@plugin@" (de la versión @version@ a la  @version_maj@) se ha ejecutado exitosamente',
	'message_action_finale_upon_fail' => 'La actualización y la activación del plugin "@plugin@" (de la versión @version@ a la @version_maj@) no se ha completado correctamente',
	'message_action_finale_upon_ok' => 'La actualización y la activación del plugin "@plugin@" (de la versión @version@ a la @version_maj@) se ha completado exitosamente',
	'message_action_get' => 'Descargar el plugin "@plugin@"  (versión: @version@)',
	'message_action_getlib' => 'Descargar la biblioteca "<a href="@version@" class="spip_out">@plugin@</a>"',
	'message_action_geton' => 'Descargar y activar el plugin "@plugin@" (versión: @version@)',
	'message_action_install' => 'El plugin "@plugin@" (versión: @version@) será instalado',
	'message_action_kill' => 'Eliminación de los archivos del plugin "@plugin@" (versión: @version@)',
	'message_action_off' => 'Desactivar el plugin "@plugin@"  (versión: @version@)',
	'message_action_on' => 'Activar el plugin "@plugin@"  (versión: @version@)',
	'message_action_stop' => 'Desinstalar el plugin "@plugin@" (versión: @version@)',
	'message_action_up' => 'Actualización del plugin "@plugin@" (de la versión @version@ a la  @version_maj@)',
	'message_action_upon' => 'Actualización y activación del plugin "@plugin@" (versión: @version@)',
	'message_dependance_plugin' => 'El plugin @plugin@ depende de @dependance@.',
	'message_dependance_plugin_version' => 'El plugin @plugin@ depende de @dependance@ @version@',
	'message_erreur_aucun_plugin_selectionne' => 'No se ha seleccionado ningún plugin.',
	'message_erreur_ecriture_lib' => '@plugin@ a besoin de la bibliothèque <a href="@lib_url@">@lib@</a> placée dans le répertoire <var>lib/</var> à la racine de votre site. Cependant, ce répertoire n\'est pas accessible en écriture. Vous devez l\'installer manuellement ou donner des permissions d\'écriture à ce répertoire.', # NEW
	'message_erreur_maj_inconnu' => 'No se puede actualizar un plugin desconocido.',
	'message_erreur_plugin_introuvable' => 'No fue posible encontrar el plugin @plugin@ para @action@.',
	'message_erreur_plugin_non_actif' => 'No se puede desactivar un plugin inactivo.',
	'message_incompatibilite_spip' => '@plugin@  no es compatible con la versión de SPIP que estás utilizando.',
	'message_nok_aucun_depot_disponible' => 'Aucun plugin n\'est disponible ! Veuillez vous rendre dans la page de gestion des dépôts pour ajouter des listes de plugins.', # NEW
	'message_nok_aucun_paquet_ajoute' => 'Le dépôt « @url@ » ne fournit aucun nouveau paquet par rapport à la base déjà enregistrée. Il n\'a donc pas été ajouté', # NEW
	'message_nok_aucun_plugin_selectionne' => 'No hay plugins a instalar. Selecciona los plugins que deseas instalar',
	'message_nok_champ_obligatoire' => 'Este campo es requerido',
	'message_nok_depot_deja_ajoute' => 'La dirección "@url@" corresponde a un repositorio que ya ha sido añadido',
	'message_nok_maj_introuvable' => 'No fue posible encontrar la actualización del plugin @plugin@.',
	'message_nok_plugin_inexistant' => 'El plugin solicitado no existe  (@plugin@).',
	'message_nok_sql_insert_depot' => 'Se obtuvo un error SQL al intentar añadir el repositorio  @objet@',
	'message_nok_url_depot_incorrecte' => 'La dirección "@url@" no es correcta',
	'message_nok_xml_non_conforme' => 'Le fichier XML « @fichier@ » de description du dépôt n\'est pas conforme', # NEW
	'message_ok_aucun_plugin_trouve' => 'No hay plugins coincidentes con los criterios señalados.',
	'message_ok_depot_ajoute' => 'El repositorio "@url@" ha sido añadido.',
	'message_ok_plugins_trouves' => '@nb_plugins@ plugin(s) coinciden con los criterios de búsqueda señalados (@tri@). Selecciona debajo los plugins que deseas descargar y activar en tu servidor.',
	'message_telechargement_archive_effectue' => 'El archivo ha sido descomprimido exitosamente en @dir@.',

	// N
	'nettoyer_actions' => 'Limpiar estas acciones! Esto eliminará la lista de acciones pendientes de ejecutar.',

	// O
	'onglet_depots' => 'Administrar los repositorios',
	'option_categorie_toute' => 'Todas las categorías',
	'option_depot_tout' => 'Todos los repositorios',
	'option_doublon_non' => 'La versión más reciente',
	'option_doublon_oui' => 'Todas las versiones compatibles',
	'option_etat_tout' => 'Todos los estados',

	// P
	'placeholder_phrase' => 'prefijo, nombre, eslogan, descripción o autor',
	'plugin_info_actif' => 'Plugin activo',
	'plugin_info_up' => 'Está disponible una actualización del plugin (versión @version@)',
	'plugin_info_verrouille' => 'Plugin verrouillé', # NEW
	'plugins_inactifs_liste' => 'Inactivos',
	'plugins_non_verrouilles_liste' => 'Non verrouillés', # NEW
	'plugins_verrouilles_liste' => 'Verrouillés', # NEW

	// R
	'resume_table_depots' => 'Lista de los repositorios añadidos',
	'resume_table_paquets' => 'Lista de los paquetes',
	'resume_table_plugins' => 'Liste des plugins @categorie@', # NEW

	// T
	'telecharger_archive_plugin_explication' => 'Vous pouvez télécharger une archive qui se chargera
		dans votre répertoire « plugins/auto », en écrivant l\'URL de l\'archive dans le champ de saisie.', # NEW
	'titre_depot' => 'Repositorio',
	'titre_depots' => 'Repositorios',
	'titre_form_ajouter_depot' => 'Añadir un repositorio',
	'titre_form_charger_plugin' => 'Buscar y añadir plugins',
	'titre_form_charger_plugin_archive' => 'Descargar un plugin desde su archivo',
	'titre_form_configurer_svp' => 'Configurar el Servidor de Plugins',
	'titre_liste_autres_contributions' => 'Esqueletos, bibliotecas, paquetes de íconos...',
	'titre_liste_autres_depots' => 'Otros repositorios',
	'titre_liste_depots' => 'Lista de los repositorios  disponibles',
	'titre_liste_paquets_plugin' => 'Lista de los paquetes del plugin',
	'titre_liste_plugins' => 'Lista de plugins',
	'titre_logo_depot' => 'Logo del repositorio',
	'titre_logo_plugin' => 'Logo del plugin',
	'titre_nouveau_depot' => 'Nuevo repositorio',
	'titre_page_configurer' => 'Servidor de Plugins',
	'titre_paquet' => 'Paquete',
	'titre_paquets' => 'Paquetes',
	'titre_plugin' => 'Plugin',
	'titre_plugins' => 'Plugins',
	'tout_cocher' => 'Marcar todo',
	'tout_cocher_up' => 'Seleccionar las actualizaciones',
	'tout_decocher' => 'Desmarcar todo'
);

?>
