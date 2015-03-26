<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/verifier?lang_cible=fa
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// E
	'erreur_code_postal' => 'اين كد پستي درست نيست.',
	'erreur_comparaison_egal' => 'اين مقدار بايد با ميدان"@nom_champ@"  مساوي باشد',
	'erreur_comparaison_egal_type' => 'اين مقدار بايد با نوع مقدار ميدان  "@nom_champ@" مساوي و يكي باشد',
	'erreur_comparaison_grand' => 'اين مقدار بايد از ميدان"@nom_champ@" بالاتر باشد',
	'erreur_comparaison_grand_egal' => 'اين مقدار بايد از مقدار ميدانِ "@nom_champ@"بالاتر يا مساوي باشد',
	'erreur_comparaison_petit' => 'اين مقدار بايد از مقدار ميدان"@nom_champ@"  پائين‌تر باشد',
	'erreur_comparaison_petit_egal' => 'اين مقدار بايد از مقدار ميدان "@nom_champ@"پائين‌تر يا با آن مساوي باشد',
	'erreur_couleur' => 'كد رنگ معتبر نيست.',
	'erreur_date' => 'تاريخ معتبر نيست.',
	'erreur_date_format' => 'فرمت تاريخ قبول نيست.',
	'erreur_decimal' => 'مقدار بايد يك عدد اعشاري باشد.',
	'erreur_decimal_nb_decimales' => 'رقم نمي‌تواند بيش از @nb_decimales@ اعشار داشته باشد.',
	'erreur_email' => 'نشاني ايميل <em>@email@</em> درست فرمت‌ بندي نشده. ',
	'erreur_email_nondispo' => 'نشاني ايميل <em>@email@</em> پيشتر استفاده شده.',
	'erreur_entier' => 'مقدار بايد يك عدد صحيح باشد.',
	'erreur_entier_entre' => 'مقدار بايد بين @min@ و @max@.',
	'erreur_entier_max' => 'مقدار بايد كم‌تر از @max@ باشد.',
	'erreur_entier_min' => 'مقدار بايد بيشتر از @min@ باشد.',
	'erreur_id_document' => 'اين شناسه‌ي سند معتبر نيست.',
	'erreur_inconnue_generique' => 'فرمت صحيح نيست',
	'erreur_numerique' => 'فرمت عدد معتبر نيست.',
	'erreur_regex' => 'فرمت رشته معتبر نيست.',
	'erreur_siren' => 'فرمت SIREN معتبر نيست.',
	'erreur_siret' => 'شماره SIRET معتبر نيست. ',
	'erreur_taille_egal' => 'مقدار بايد دقيقاً كاراكتر‌هاي @egal@ داشته باشد.', # MODIF
	'erreur_taille_entre' => 'مقدار بايد بين @min@ و @max@ كاراكتر داشته باشد. ', # MODIF
	'erreur_taille_max' => 'مقدار نبايد بيش از @max@ كاراكتر داشته باشد.', # MODIF
	'erreur_taille_min' => 'اين مقدار نبايد كم‌تر از @min@ كارآكتر داشته باشد.', # MODIF
	'erreur_telephone' => 'اين شماره معتبر نيست.',
	'erreur_url' => 'نشاني <em>@url@</em> معتبر نيست',
	'erreur_url_protocole' => 'نشاني وارد شده <em>(@url@)</em> doit بايد با @protocole@ آغاز شود. ',
	'erreur_url_protocole_exact' => 'نشاني وارد شده <em>(@url@)</em> با يك پروتكل معتبر (http:// مانند)شروع نمي‌شود',

	// N
	'normaliser_option_date' => 'عادي‌سازي داده‌؟',
	'normaliser_option_date_aucune' => 'خير',
	'normaliser_option_date_en_datetime' => 'با فرمت «تاريخ‌زمان» (براي اس‌كيو‌ال)',

	// O
	'option_couleur_normaliser_label' => 'عادي سازي كد رنگ؟',
	'option_couleur_type_hexa' => 'كد رنگ با فرمت هگزادسيمال',
	'option_couleur_type_label' => 'نوع تأييد براي اجرا',
	'option_decimal_nb_decimales_label' => 'تعداد اعشارها بعد از مميز',
	'option_email_disponible_label' => 'نشاني در دسترس',
	'option_email_disponible_label_case' => 'چك كنيد كه كاربر ديگر اين نشاني را استفاده نكرده باشد',
	'option_email_mode_5322' => 'چك كنيد كه معتبرترين استانداردها در دسترس باشد',
	'option_email_mode_label' => 'حالت چك كردن ايميل‌ها',
	'option_email_mode_normal' => 'چك كردن معمولي اسپيپ ',
	'option_email_mode_strict' => 'چك كردن آسان‌گيرانه‌تر',
	'option_entier_max_label' => 'بيشترين مقدار',
	'option_entier_min_label' => 'كمر‌ترين مقدار ',
	'option_regex_modele_label' => 'مقدار بايد با عبارت بعدي جور باشد',
	'option_siren_siret_mode_label' => 'مي‌خواهيد تأييد كنيد؟ ',
	'option_siren_siret_mode_siren' => 'شماره «نظام ملي اطلاعات فهرست بنگاه‌ها» (به فرانسه SIREN)',
	'option_siren_siret_mode_siret' => 'شماره «نظام ملي فهرست بنگاه‌ها و مؤسسات» (سرواژه‌ي فرانسه آن: SIRET)',
	'option_taille_max_label' => 'بيشترين اندازه',
	'option_taille_min_label' => 'كم‌ترين اندازه',
	'option_url_mode_complet' => 'چك كامل يو.آر.ال',
	'option_url_mode_label' => 'حالت چك كردن يو.آر.ال ها',
	'option_url_mode_php_filter' => 'چك كامل يو.آر.ال از طريق فيلتر FILTER_VALIDATE_URL  پي.اچ.پي',
	'option_url_mode_protocole_seul' => 'چك كردن انحصاري وجود يك پروتكل ',
	'option_url_protocole_label' => 'نام پروتكل براي چك كردن',
	'option_url_type_protocole_exact' => 'يك پروتكل در زير وارد كنيد:',
	'option_url_type_protocole_ftp' => 'پروتكل‌هاي انتقال پرونده: ftp  يا sftp ',
	'option_url_type_protocole_label' => 'نوع پروتكل براي چك كردن',
	'option_url_type_protocole_mail' => 'پروتكل‌هاي نامه‌ الكترونيكي: imap, pop3  يا smtp',
	'option_url_type_protocole_tous' => 'تمام پروتكل‌هاي مورد قبول ',
	'option_url_type_protocole_web' => 'پروتكل‌هاي وب: http يا https',

	// T
	'type_couleur' => 'رنگ',
	'type_couleur_description' => 'تأييد مقداري كه يك كد رنگ است ',
	'type_date' => 'تاريخ',
	'type_date_description' => 'چك كنيد كه فرمت تاريخ اين باشد: س‌س‌س‌س/م‌م/رر. مميز آزاد است («.»، «/»، و غيره).',
	'type_decimal' => 'شماره‌ي اعشاري',
	'type_decimal_description' => 'چك كنيد كه مقدار يك رغم اعشاري باشد، با امكان محدود كردن دو مقدار و تعيين اعشار بعد از مميز.',
	'type_email' => 'نشاني ايميل ',
	'type_email_description' => 'چك كنيد كه نشاني ايميل فرمت درست داشته باشد.',
	'type_email_disponible' => 'دسترس‌‌بودگي نشاني ايميل',
	'type_email_disponible_description' => 'چك كنيد كه نشاني ايميل از سوي كاربر ديگر سامانه استفاده نشده باشد.',
	'type_entier' => 'عدد صحيح',
	'type_entier_description' => 'چك كنيد كه مقدار يك عدد صحيح باشد،‌ با گزينه‌ي محدوديت بين دو مقدار.',
	'type_regex' => 'عبارت عادي',
	'type_regex_description' => '<چك كنيد كه مقدار با عبارت خواسته شد جور باشد. براي اطلاعات بيشتر در مورد استفاده از عبارت درخواست شده به اينجا رجوع كنيد: <a href="http://fr2.php.net/manual/fr/reference.pcre.pattern.syntax.php">l’aide en ligne de PHP</a>.',
	'type_siren_siret' => 'شماره‌ي نظام ملي اطلاعات فهرست بنگاه‌ها يا شماره‌ي ملي فهرست بنگاه‌ها و تأسيسات (سرواژه به فرانسه:SIREN ياSIRET)',
	'type_siren_siret_description' => 'چك كنيد كه مقدار يك شماره‌ي معتبر است <a href="http://fr.wikipedia.org/wiki/SIREN">نظامل اطلاعات بنگاه‌ها به فرانسه s</a> .',
	'type_taille' => 'اندازه',
	'type_taille_description' => 'چك كنيد كه اندازه‌ي مقدار با بيشترين و/يا كم‌ترين مقدار درخواستي جور باشد.',
	'type_telephone' => 'شماره تلفن',
	'type_telephone_description' => 'چك كنيد كه شماره‌ي تلفن با فرمت شماره‌ي تلفن جور باشد.',
	'type_url' => 'يو.آر.ال ',
	'type_url_description' => 'چك كنيد كه يو.آر.ال با يك فرمت شناخته شده جور باشد. '
);

?>
