<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org/tradlang_module/verifier?lang_cible=ru
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'Неправильный индекс ',
	'erreur_comparaison_egal' => 'Значение должно соответствовать полю "@nom_champ@"',
	'erreur_comparaison_egal_type' => 'Значение должно соответствовать и быть такого же типа как поле "@nom_champ@"',
	'erreur_comparaison_grand' => 'Значение должно быть больше чем поле "@nom_champ@"',
	'erreur_comparaison_grand_egal' => 'Значение должно быть больше или соответствовать полю "@nom_champ@"',
	'erreur_comparaison_petit' => 'Значаение должно быть меньше чем поле "@nom_champ@"',
	'erreur_comparaison_petit_egal' => 'Значение должно быть меньшим или равным полю "@nom_champ@"',
	'erreur_couleur' => 'Le code couleur n\'est pas valide.', # NEW
	'erreur_date' => 'Неправильный формат даты.',
	'erreur_date_format' => 'Неправильный формат даты.',
	'erreur_decimal' => 'Число должно быть десятичным.',
	'erreur_decimal_nb_decimales' => 'После запятой должно быть больше чем @nb_decimales@ значений',
	'erreur_email' => 'Неправильный формат <em>@email@</em>.',
	'erreur_email_nondispo' => '<em>@email@</em> уже используется.',
	'erreur_entier' => 'Значение должно быть целым числом.',
	'erreur_entier_entre' => 'Значение должно быть между @min@ и @max@.',
	'erreur_entier_max' => 'Значение должно быть меньше @max@.',
	'erreur_entier_min' => 'Значение должно быть больше чем @min@.',
	'erreur_id_document' => 'Ошибочный идентификатор документа.',
	'erreur_inconnue_generique' => 'Неправильный формат.',
	'erreur_numerique' => 'Неправильный формат числа.',
	'erreur_regex' => 'Неправильно сформированный regexp.',
	'erreur_siren' => 'Значение SIREN ошибочно.',
	'erreur_siret' => 'Значение SIRET ошибочно.',
	'erreur_taille_egal' => 'Значение должно состоять строго из  @egal@ знаков.', # MODIF
	'erreur_taille_entre' => 'Значение должно иметь от @min@ до @max@ знаков.', # MODIF
	'erreur_taille_max' => 'Значение должно иметь не больше чем @max@ знаков.', # MODIF
	'erreur_taille_min' => 'Значение должно иметь не меньше чем @min@ знаков.', # MODIF
	'erreur_telephone' => 'Неверный номер телефона.',
	'erreur_url' => 'Неверный URL адрес <em>@url@</em>',
	'erreur_url_protocole' => 'Адрес <em>(@url@)</em> должен начинаться с @protocole@',
	'erreur_url_protocole_exact' => 'Адрес <em>(@url@)</em> должен начинаться с протокола  (например http:// )',

	// N
	'normaliser_option_date' => 'Упорядочить дату?',
	'normaliser_option_date_aucune' => 'Нет',
	'normaliser_option_date_en_datetime' => 'Формат даты и времени (для SQL)',

	// O
	'option_couleur_normaliser_label' => 'Normaliser le code couleur ?', # NEW
	'option_couleur_type_hexa' => 'Code couleur au format héxadécimal', # NEW
	'option_couleur_type_label' => 'Type de vérification à effectuer', # NEW
	'option_decimal_nb_decimales_label' => 'Количество символов после запятой.',
	'option_email_disponible_label' => 'Доступный адрес',
	'option_email_disponible_label_case' => 'Проверить использовался ли адрес другим пользователем.',
	'option_email_mode_5322' => 'Проверить по строгим стандартам.',
	'option_email_mode_label' => 'Режим проверки электронной почты.',
	'option_email_mode_normal' => 'Стандартная проверка SPIP',
	'option_email_mode_strict' => 'Не строгая проверка.',
	'option_entier_max_label' => 'Максимальное значение',
	'option_entier_min_label' => 'Минимальное значение',
	'option_regex_modele_label' => 'Значение должно соответствовать следующему выражению',
	'option_siren_siret_mode_label' => 'Что вы будете проверять?',
	'option_siren_siret_mode_siren' => 'SIREN номер',
	'option_siren_siret_mode_siret' => 'SIRET номер',
	'option_taille_max_label' => 'Максимальный размер ',
	'option_taille_min_label' => 'Минимальный размер',
	'option_url_mode_complet' => 'Полная проверка URL',
	'option_url_mode_label' => 'Режим проверки URL',
	'option_url_mode_php_filter' => 'Полная проверка валидации URL  с помощью PHP фильтра FILTER_VALIDATE_URL',
	'option_url_mode_protocole_seul' => 'Проверка на существование протокола',
	'option_url_protocole_label' => 'Название протокола, который нужно проверить',
	'option_url_type_protocole_exact' => 'Введите названия протокола:',
	'option_url_type_protocole_ftp' => 'Протоколы передачи файлов: FTP or SFTP',
	'option_url_type_protocole_label' => 'Тип протокола для проверки',
	'option_url_type_protocole_mail' => 'Почтовые протоколы : imap, pop3 ou smtp',
	'option_url_type_protocole_tous' => 'Все доступные протоколы',
	'option_url_type_protocole_web' => 'Интернет протоколы : http или https',

	// T
	'type_couleur' => 'Couleur', # NEW
	'type_couleur_description' => 'Vérifie que la valeur est un code couleur.', # NEW
	'type_date' => 'Дата',
	'type_date_description' => 'Проверить является ли формат даты ДД/ММ/ГГГГ. Разделитель может быть произвольным (".", "/", и т.д.).',
	'type_decimal' => 'Десятичное число',
	'type_decimal_description' => 'Проверить является ли значение десятичным числом, с целью определить количество знаков после запятой.',
	'type_email' => 'Электронная почта',
	'type_email_description' => 'Проверить корректность формата электронной почты.',
	'type_email_disponible' => 'Валидность электронной почты',
	'type_email_disponible_description' => 'Проверить не использовалась ли электронная почта другим пользователем.',
	'type_entier' => 'Целое число',
	'type_entier_description' => 'Проверить является ли число целым.',
	'type_regex' => 'Регулярное выражение',
	'type_regex_description' => 'Проверить совместимость значения и выражения. Для подробной информации о  регулярных выражениях обратитесь по адресу <a href="http://fr2.php.net/manual/en/reference.pcre.pattern.syntax.php">the online PHP help</a>.',
	'type_siren_siret' => 'SIREN или SIRET',
	'type_siren_siret_description' => 'Проверить валидность с французского языка <a href="http://fr.wikipedia.org/wiki/SIREN">Système d’Identification du Répertoire des ENtreprises</a> (Company Registry ID System).',
	'type_taille' => 'Размер',
	'type_taille_description' => 'Проверить лежит ли значение параметра в диапазоне минимального и максимального значения.',
	'type_telephone' => 'Номер телефона',
	'type_telephone_description' => 'Проверить соответствует ли номер телефона формату ввода.',
	'type_url' => 'URL',
	'type_url_description' => 'Проверить соответствие ли URL  формат ввода.'
);

?>
