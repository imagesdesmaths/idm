<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org/tradlang_module/sites?lang_cible=ru
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
	'avis_echec_syndication_01' => 'Синдикация прошла неудачно: данные нечитабельны или отсутствует статья',
	'avis_echec_syndication_02' => 'Синдикация прошла неудачно: нет доступа к базе данных этого сайта.',
	'avis_site_introuvable' => 'Сайт не найден',
	'avis_site_syndique_probleme' => 'Предупреждение: получение статей и новостей с других сайтов на этот сайт столкнулось с проблемой; следовательно работа системы временно прервана. Пожалуйста, проверьте адрес другого сайта (<b> @url_syndic@ </b>), и попробуйте еще раз восстановить информацию.',
	'avis_sites_probleme_syndication' => 'Эти сайты столкнулись с проблемой обмена новостями и статьями',
	'avis_sites_syndiques_probleme' => 'Эти объединенные сайты вызвали проблему',

	// B
	'bouton_exporter' => 'Exporter', # NEW
	'bouton_importer' => 'Importer', # NEW
	'bouton_radio_modere_posteriori' => 'пост-модерация', # MODIF
	'bouton_radio_modere_priori' => 'пре-модерация', # MODIF
	'bouton_radio_non_syndication' => 'Не объединятся',
	'bouton_radio_syndication' => 'Объединение:',

	// C
	'confirmer_purger_syndication' => 'Êtes-vous certain de vouloir supprimer tous les articles syndiqués de ce site ?', # NEW

	// E
	'entree_adresse_fichier_syndication' => 'Адрес  файла  для объединения:',
	'entree_adresse_site' => '<b>адрес сайта</b> [Необходимый]',
	'entree_description_site' => 'Описание сайта',
	'erreur_fichier_format_inconnu' => 'Le format du fichier @fichier@ n\'est pas pris en charge.', # NEW
	'erreur_fichier_incorrect' => 'Impossible de lire le fichier.', # NEW

	// F
	'form_prop_nom_site' => 'Название сайта',

	// I
	'icone_article_syndic' => 'Article syndiqué', # NEW
	'icone_articles_syndic' => 'Articles syndiqués', # NEW
	'icone_controler_syndication' => 'Publication des articles syndiqués', # NEW
	'icone_modifier_site' => 'Изменить этот сайт',
	'icone_referencer_nouveau_site' => 'Новый сайт',
	'icone_site_reference' => 'Sites référencés', # NEW
	'icone_supprimer_article' => 'Supprimer cet article', # NEW
	'icone_supprimer_articles' => 'Supprimer ces articles', # NEW
	'icone_valider_article' => 'Valider cet article', # NEW
	'icone_valider_articles' => 'Valider ces articles', # NEW
	'icone_voir_sites_references' => 'Показать ссылающиеся сайты',
	'info_1_site_importe' => '1 site a été importé', # NEW
	'info_a_valider' => '[на утверждении]',
	'info_aucun_site_importe' => 'Aucun site n\'a pu être importé', # NEW
	'info_bloquer' => 'блок',
	'info_bloquer_lien' => 'блокировать эту ссылку',
	'info_derniere_syndication' => 'Последний обмен этого сайта был проведен на',
	'info_liens_syndiques_1' => 'объединенные ссылки',
	'info_liens_syndiques_2' => 'ожидание утверждения.',
	'info_nb_sites_importes' => '@nb@ sites ont été importés', # NEW
	'info_nom_site_2' => '<b>Название сайта</b> [Необходимо]',
	'info_panne_site_syndique' => 'Синдикация сайта недоступна',
	'info_probleme_grave' => 'ошибка',
	'info_question_proposer_site' => 'Кто может предложить ссылочные сайты?',
	'info_retablir_lien' => 'восстановить эту ссылку',
	'info_site_attente' => 'Вебсайт, ожидающий проверки',
	'info_site_propose' => 'Сайт отправленный на:',
	'info_site_reference' => 'Сайты, на которые ведут ссылки, онлайн',
	'info_site_refuse' => 'Вебсайт отклонен',
	'info_site_syndique' => 'Этот сайт объединен...', # MODIF
	'info_site_valider' => 'Сайты, которые будут утверждены',
	'info_sites_referencer' => 'Ссылка на сайт',
	'info_sites_refuses' => 'Отключить сайты',
	'info_statut_site_1' => 'Этот сайт:',
	'info_statut_site_2' => 'Опубликованный',
	'info_statut_site_3' => 'Отправленный',
	'info_statut_site_4' => 'В корзину', # MODIF
	'info_syndication' => 'RSS:',
	'info_syndication_articles' => 'статья(и)',
	'item_bloquer_liens_syndiques' => 'Блокировать объединенные ссылки для утверждения',
	'item_gerer_annuaire_site_web' => 'Вести каталог Вебсайтов',
	'item_non_bloquer_liens_syndiques' => 'Не блокировать ссылки, поступающие от объединений в синдикаты',
	'item_non_gerer_annuaire_site_web' => 'Отключить каталог Вебсайтов',
	'item_non_utiliser_syndication' => 'Не использовать автоматическое получение статей и новостей с других сайтов по RSS',
	'item_utiliser_syndication' => 'Использовать автоматическое объединение',

	// L
	'label_exporter_avec_mots_cles_1' => 'Exporter les mots-clés sous forme de tags', # NEW
	'label_exporter_id_parent' => 'Exporter les sites de la rubrique', # NEW
	'label_exporter_publie_seulement_1' => 'Exporter uniquement les sites publiés', # NEW
	'label_fichier_import' => 'Fichier HTML', # NEW
	'label_importer_les_tags_1' => 'Importer les tags sous forme de mot-clé', # NEW
	'label_importer_statut_publie_1' => 'Publier automatiquement les sites', # NEW
	'lien_mise_a_jour_syndication' => 'Обновить сейчас',
	'lien_nouvelle_recuperation' => 'Попробывать выполнить новый поиск данных',
	'lien_purger_syndication' => 'Effacer tous les articles syndiqués', # NEW

	// N
	'nombre_articles_syndic' => '@nb@ articles syndiqués', # NEW

	// S
	'statut_off' => 'Supprimé', # NEW
	'statut_prop' => 'En attente', # NEW
	'statut_publie' => 'Publié', # NEW
	'syndic_choix_moderation' => 'Что должно быть сделано со следующими ссылками с этого сайта?',
	'syndic_choix_oublier' => 'Что должно быть сделано с ссылками, которые больше не присутствуют при получении статей и новостей с других сайтов по RSS?',
	'syndic_choix_resume' => 'Некоторые сайты предлагают целые тексты своих статей. Когда целый текст доступен, хотите ли Вы объединить его:',
	'syndic_lien_obsolete' => 'устаревшая ссылка',
	'syndic_option_miroir' => 'блокировать их автоматически',
	'syndic_option_oubli' => 'удалить тему(после @mois@ months)',
	'syndic_option_resume_non' => 'полное содержание статей(HTML формат)',
	'syndic_option_resume_oui' => 'только краткое изложение (тестовый формат)',
	'syndic_options' => 'Опции объединения в синдикаты:',

	// T
	'texte_expliquer_export_bookmarks' => 'Vous pouvez exporter une liste de sites au format Marque-page HTML,
	pour vous permettre ensuite de l\'importer dans votre navigateur ou dans un service en ligne', # NEW
	'texte_expliquer_import_bookmarks' => 'Vous pouvez importer une liste de sites au format Marque-page HTML,
	en provenance de votre navigateur ou d\'un service en ligne de gestion des Marques-pages.', # NEW
	'texte_liens_sites_syndiques' => 'Ссылки, поступающие от объединенных сайтов могли 
   быть блокированы заранее; следующее 
   урегулирование показа - урегулирование по умолчанию объединенных сайтов после их создания. Это 
возможно в любом случае для 
   блокировки каждой ссылки индивидуально, или для 
   выбора, для каждого сайта, блокировки поступающих ссылок 
   от какого-либо сайта.', # MODIF
	'texte_messages_publics' => 'Основные сообщения статьи:',
	'texte_non_fonction_referencement' => 'Вы можете не использовать автоматические функции, и ввести элементы касающиеся этого сайта вручную...', # MODIF
	'texte_referencement_automatique' => 'Автоматизированные ссылки сайта </b> <br /> Вы можете быстро сослаться на вебсайт, указывая ниже требуемый адрес, или адрес сайта, с которого Вы получаете статьи и файлы по RSS. SPIP автоматически соберет информацию о сайте (название, описание ...).', # MODIF
	'texte_referencement_automatique_verifier' => 'Пожалуйста, проверьте предоставленную  информацию, <tt>@url@</tt> перед сохранением.',
	'texte_syndication' => 'Если сайт позволяет, то можно автоматически восстановить  
список последнего материала. Чтобы добиться этого, Вы должны включить обмен статьями и новостями с другими сайтами по RSS. 
  <blockquote> <i> Некоторые хосты отключают эту функцию; 
  в этом случае, Вы не можете использовать 
 обмен статьями и новостями с другими сайтами по RSS. </i> </blockquote>', # MODIF
	'titre_articles_syndiques' => 'Отправка статей с этого сайта',
	'titre_dernier_article_syndique' => 'Последний обмен статей по RSS.',
	'titre_exporter_bookmarks' => 'Exporter des Marques-pages', # NEW
	'titre_importer_bookmarks' => 'Importer des Marques-pages', # NEW
	'titre_importer_exporter_bookmarks' => 'Importer et Exporter des Marques-pages', # NEW
	'titre_page_sites_tous' => 'Ссылочные сайты',
	'titre_referencement_sites' => 'Ссылочные и объединенные сайты ',
	'titre_site_numero' => 'НОМЕР САЙТА:',
	'titre_sites_proposes' => 'Представленные сайты',
	'titre_sites_references_rubrique' => 'Ссылающиеся сайты в этом разделе',
	'titre_sites_syndiques' => 'Объединенные сайты',
	'titre_sites_tous' => 'Каталог сайтов',
	'titre_syndication' => 'Объединение сайтов',
	'tout_voir' => 'Voir tous les articles syndiqués', # NEW

	// U
	'un_article_syndic' => '1 article syndiqué' # NEW
);

?>
