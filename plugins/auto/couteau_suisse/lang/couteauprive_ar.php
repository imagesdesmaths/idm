<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ': كلا',
	'2pts_oui' => ': نعم',

	// S
	'SPIP_liens:description' => '@puce@ كل روابط الموقع تفتح افتراضياً في النافذة الحالية. ولكن قد نحتاج الى فتح الروابط الخارجية في نافذة جديدة مما يتطلب اضافة {target=\\"_blank\\"} الى كل علامات &lt;a&gt; المزودة بخصائص {spip_out} او {spip_url} او {spip_glossaire}. من الضروري احياناً اضافة احدى تلك الخصائص الى روابط صفحات الموقع النموذجية (اي ملفات html) للاستفادة الى اقصى حد من هذه الوظيفة.[[%radio_target_blank3%]]

@puce@ يتيح SPIP ربط كلمات بتفسيراتها بفضل اختصار <code>[?كلمة]</code>. افتراضياً (او اذا ابقيت على الخانة ادناه فارغة)، يأخذ الفهرس الخارجي الى موسوعة ويكيبيديا. ويعود اليك اختيار عنوان آخر.<br />رابط للاختبار:[?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ يوفر SPIP نمط في اوراق الأنماط للتعامل مع روابط من نوع «:mailto»: يظهر ظرف صغير أمام أي رابط يدل على عنوان بريد الكتروني. ولكن بما ان بعض برامج التصفح لا تتمكن من عرضه (خاصة انترنت اكسبلورر ٦ وانترنت اكسبلورر ٧ وسافاري ٣)، يعود الأمر اليك لتقرر اذا كنت تريد هذه الإضافة أم لا.
_ رابط للاختبار: [->test@test.com] (إعادة تحديث الصفحة بالكامل).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP والروابط... الخارجية',
	'SPIP_tailles:description' => '@puce@ Afin d\'alléger la mémoire de votre serveur, SPIP vous permet de limiter les dimensions (hauteur et largeur) et la taille du fichier des images, logos ou documents joints aux divers contenus de votre site. Si un fichier dépasse la taille indiquée, le formulaire enverra bien les données mais elles seront détruites et SPIP n\'en tiendra pas compte, ni dans le répertoire IMG/, ni en base de données. Un message d\'avertissement sera alors envoyé à l\'utilisateur.

Une valeur nulle ou non renseignée correspond à une valeur illimitée.
[[Hauteur : %img_Hmax% pixels]][[->Largeur : %img_Wmax% pixels]][[->Poids du fichier : %img_Smax% Ko]]
[[Hauteur : %logo_Hmax% pixels]][[->Largeur : %logo_Wmax% pixels]][[->Poids du fichier : %logo_Smax% Ko]]
[[Poids du fichier : %doc_Smax% Ko]]

@puce@ Définissez ici l\'espace maximal réservé aux fichiers distants que SPIP pourrait télécharger (de serveur à serveur) et stocker sur votre site. La valeur par défaut est ici de 16 Mo.[[%copie_Smax% Mo]]

@puce@ Afin d\'éviter un dépassement de mémoire PHP dans le traitement des grandes images par la librairie GD2, SPIP teste les capacités du serveur et peut donc refuser de traiter les trop grandes images. Il est possible de désactiver ce test en définissant manuellement le nombre maximal de pixels supportés pour les calculs.

La valeur de 1~000~000 pixels semble correcte pour une configuration avec peu de mémoire. Une valeur nulle ou non renseignée entraînera le test du serveur.
[[%img_GDmax% pixels au maximum]]

@puce@ La librairie GD2 permet d\'ajuster la qualité de compression des images JPG. Un pourcentage élevé correspond à une qualité élevée.
[[%img_GDqual% %]]', # NEW
	'SPIP_tailles:nom' => 'حدود الذاكرة',

	// A
	'acces_admin' => 'دخول المدراء',
	'action_rapide' => 'إجراء سريع، لا تستخدمه الا اذا كنت على علم واسع بما تفعل!',
	'action_rapide_non' => 'إجراء سريع، يتوافر لدى تفعيل هذه الأداة:',
	'admins_seuls' => 'المدراء فقط',
	'attente' => 'انتظار...',
	'auteur_forum:description' => 'يحفز جميع مؤلفي الرسائل العمومية لإدخال (ولو بحرف واحد) اسم و/اوعنوان بريد لتفادي المشاركات المغفلة. لاحظ ان هذه الأداة تقوم بتدقيق معين بواسطة جافاسكريبت في جهاز الزائر.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{{ننبيه: يؤدي تحديد الخيار الثالث الى الغاء الخيارين الاولينز من المهم التأكد من ان استمارات الصفحات النموذجية تتوافق مع هذه الأداة.}}', # MODIF
	'auteur_forum:nom' => 'المنتديات المغفلة غير مقبولة',
	'auteur_forum_deux' => 'او احد الحقلين السابقين على الاقل',
	'auteur_forum_email' => 'الحقل «@_CS_FORUM_EMAIL@»',
	'auteur_forum_nom' => 'تالحقل «@_CS_FORUM_NOM@»',
	'auteurs:description' => 'تحدد هذه الأداة واجهة [صفحة المؤلفين->?exec=auteurs]، في المجال الخاص.

@puce@ حدد هنا الحد الاقصى لعدد المؤلفين الذي ترغب في عرضه في الاطار الاوسط في صفحة المؤلفين. في حال تخطي هذا العدد يظهر نظام تصفح.[[%max_auteurs_page%]]

@puce@ اي فئة من المؤلفين يجب ان تظهر في هذه الصفحة؟
[[%auteurs_tout_voir%]][[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]', # MODIF
	'auteurs:nom' => 'صفحة المؤلفين',
	'autobr:description' => 'Applique sur certains contenus SPIP le filtre {|post_autobr} qui remplace tous les sauts de ligne simples par un saut de ligne HTML <br />.[[%alinea%]][[->%alinea2%]]', # NEW
	'autobr:nom' => 'Retours de ligne automatiques', # NEW
	'autobr_non' => 'À l\'intérieur des balises &lt;alinea>&lt;/alinea>', # NEW
	'autobr_oui' => 'Articles et messages publics (balises @BALISES@)', # NEW
	'autobr_racc' => 'Retours de ligne : <b><alinea></alinea></b>', # NEW

	// B
	'balise_set:description' => 'Afin d\'alléger les écritures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqué à une variable passe donc dans le nom de la balise.

Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'علامة SET# الموسعة',
	'barres_typo_edition' => 'تحرير المحتويات',
	'barres_typo_forum' => 'رسائل المنتدى',
	'barres_typo_intro' => 'تم العثور على ملحق الريشة. اختر هنا أشرطة أدوات الكتابة حيث سيتم إدخال بعض الأزرار.',
	'basique' => 'أساسي',
	'blocs:aide' => 'كتلة قابلة للبسط:<b>&lt;كتلة&gt;&lt;/كتلة&gt;</b> (كناية:<b>&lt;مخفية&gt;&lt;/مخفية&gt;</b>)او<b>&lt;ظاهرة&gt;&lt;/ظاهرة&gt;</b>',
	'blocs:description' => 'يتيح لك انشاء كتل يمكن النقر على عناوينها لتصبح ظاهرة او مخفية.

@puce@ {{في نصوص SPIP}}: هناك علامات جديدة تتواقر للمحررين هي &lt;bloc&gt; (او &lt;invisible&gt;) و&lt;visible&gt; ليستخدمونها في نصوصهم بالطريقة التالية:

<quote><code>
<bloc>
عنوان يصبح قابل للنقر عليه

النص المطلوب إخفاءهإظهاره، بعد سطرين فارغين...
</bloc>
</code></quote>

@puce@ {{في الصفحات النموذجية}}: يمكنك الاستفادة من علامات جديدة هي BLOC_TITRE# وBLOC_DEBUT# وBLOC_FIN# لاستخدامها هكذا: 
<quote><code> #BLOC_TITRE او #BLOC_TITRE{عنوان URL}
عنواني
 BLOC_RESUME# (اختياري)
ملخص من الكتلة التالية
BLOC_DEBUT#
كتلتي التي يمكن بسطها (والتي تحتوي عنوان URL اذا وجد)
BLOC_FIN#</code></quote>

@puce@ اذا اخترت «نعم» أدناه، سيتسبب فتح كتلة إغلاق سائر الكتل الاخرى في الصفحة لكي لا يوجد الا كتلة واحدة مفتوحة في وقت واحد.[[%bloc_unique%]]

@puce@ اذا اخترت «نعم» أدناه، سيتم تخزين وضعية الكتل المرقمة في كعكة مدتها تساوي مدة الزيارة وذلك للحفاظ على شكل الصفحة لدى العودة اليها.[[%blocs_cookie%]]

@puce@ يستخدم سكين الجيب افتراضياً علامة HTML للعناوين &lt;h4&gt; لعناوين الكتل التي يمكن بسطها. اختر من هنا علامة اخرى &lt;hN&gt;:[[%bloc_h4%]]
@puce@ للحصول على مؤثر ناعم عند النقر، يمكن للكتل التي تطوى ان تتحرك على شكل \\"انزلاق\\".[[%blocs_slide%]][[->%blocs_millisec% الف من الثانية]]', # MODIF
	'blocs:nom' => 'كتل قابلة للبسط',
	'boites_privees:description' => 'كل المربعات المذكورة ادناه تظهر في المجال الخاص.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{تعديلات سكين الجيب}}: اطار في الصفحة الحالية من الاعدادات، يعرض آخر التعديلات التي دخلت على برمجة الملحق ([المصدر->@_CS_RSS_SOURCE@]).
- {{المقالات بتنسيق SPIP}}: اطار يطوى اضافي لمقالاتك للاطلاع على مصدر البرمجة التي يستخدمها المؤلفون.
- {{احصاءات المؤلفين}}: اطار اضافي في [صفحة المؤلفين->./?exec=auteurs] يعرض آخر عشرة متصلين والتسجيلات التي لم يتم تصديقها بعد. لا يرى هذه المعلومات الا المدراء.
- {{مسؤولو الموقع حسب SPIP}}: اطار يطوى اضافي في [صفحة المؤلفين -> ./?exec=auteurs] ويحدد المدراء الذين تمت ترقيتهم الى مرتبة مسؤولي الموقع. لا يرى هذه المعلومات الا المدراء. اذا كنت انت احد مسؤولي الموقع، يمكنك التعرف على الأداة «[.->webmestres]».
- {{عناوين URL النظيفة}}: اطار يطوى اضافي لكل عنصر محتوى (مقال او قسم او مؤلف...) يظهر عنوان URL النظيف المناسب وتنوعاته اذا وجدت. وتتيح لك الأداة «[.->type_urls]» دقة أكبر في إعداد عناوين URL العائدة لموقعك.
- {{فرز المؤلفين}}: اطار يطوى اضافي للمقالات العائدة لأكثر من مؤلف واحد يتيح ترتيب عرض هؤلاء المؤلفين.', # MODIF
	'boites_privees:nom' => 'مربعات خاصة',
	'bp_tri_auteurs' => 'فرز المؤلفين',
	'bp_urls_propres' => 'عناوين URL النظيفة',
	'brouteur:description' => '@puce@ {{Sélecteur de rubrique (brouteur)}}. Utilisez le sélecteur de rubrique en AJAX à partir de %rubrique_brouteur% rubrique(s).

@puce@ {{Sélection de mots-clefs}}. Utilisez un champ de recherche au lieu d\'une liste de sélection à partir de %select_mots_clefs% mot(s)-clef(s).

@puce@ {{Sélection d\'auteurs}}. L\'ajout d\'un auteur se fait par mini-navigateur dans la fourchette suivante :
<q1>• Une liste de sélection pour moins de %select_min_auteurs% auteurs(s).
_ • Un champ de recherche à partir de %select_max_auteurs% auteurs(s).</q1>', # NEW
	'brouteur:nom' => 'Réglage des sélecteurs', # NEW

	// C
	'cache_controle' => 'التحكم بالذاكرة الخبأة',
	'cache_nornal' => 'استخدام عادي',
	'cache_permanent' => 'ذاكرة مخبأة دائمة',
	'cache_sans' => 'بدون ذاكرة مخبأة',
	'categ:admin' => '1. إدارة',
	'categ:divers' => '60. متنوع',
	'categ:interface' => '10. الواجهة الخاصة',
	'categ:public' => '40. عرض في الموقع عمومي',
	'categ:securite' => '5. Sécurité', # NEW
	'categ:spip' => '50. علامات، مرشحات، معايير',
	'categ:typo-corr' => '20. تحسين النصوص',
	'categ:typo-racc' => '30. اختصارات الكتابة',
	'certaines_couleurs' => 'العلامات المحددة ادناه فقط@_CS_ASTER@:',
	'chatons:aide' => 'الوجوه الضاحكة: @liste@',
	'chatons:description' => 'يدرج صوراً (او وجوه ضاحكة حسب مدمني الدردشة) في كل النصوص حيث تظهر سلسلة اسم من نوع <code>:nom</code>.
_ تستبدل هذه الاداة الاختصارات بالصور التي تحمل الاسم نفسه اذا وجدت في المجلد <code>my_template/img/chatons/</code>، او في المجلدplugins/couteau_suisse/img/chatons.', # MODIF
	'chatons:nom' => 'الوجوه الضاحكة',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de votre site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour à la ligne. En effet, les citations courtes doivent être entourées par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.', # NEW
	'citations_bb:nom' => 'اقتباسات مرقمة جيداً',
	'class_spip:description1' => 'هنا يمكنك تحديد بعض اختصارات SPIP. ادا تركت قيمة فارغة يتم استخدام القيمة الافراضية المناسبة.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{اختصارات SPIP}}.

يمكنك هنا تحديد بعض اختصارات SPIP. اذا تركت قيمة فارغة سيتم استخدام القيمة الافتراضية.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{{تنبيه: اذا كانت الأداة «[.->pucesli]» نشطة، لا يتم استبدال الخط «-». وسيتم استخدام لائحة &lt;ul>&lt;li> بدلاً منه.}}

يستخدم SPIP عادة علامة &lt;h3&gt; لعناوين الفقرات.اختر هنا بديلاً لها:[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

اختار SPIP استخدام علامة &lt;strong> لتحويل النص الى الأسود.لكن استخدام &lt;b> سليم ايضاً. الخيار لك: [[%racc_g1%]][[->%racc_g2%]]

اختار SPIP استخدام علامة &lt;i> لتحويل النص الى المائل. لكن استخدام &lt;em> سليم ايضاً. الخيار لك:[[%racc_i1%]][[->%racc_i2%]]

يمكن أيضاً تحديد علامتي الفتح والاقفال لنداء الحواشي (تنبيه! لا تظهر التغييرات الا في الموقع العمومي): [[%ouvre_ref%]][[->%ferme_ref%]]
 
يمكن تحديد علامتي الفتح والاقفال للحواشي: [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{أنماط SPIP الافتراضية}}. حتى الاصدار 1.9.2 من SPIP، كانت اختصارات الكتابة تنتج علامات تخضع دائماً لنمط \\"spip\\". مثلاً: <code><p class=\\"spip\\"></code>. يمكنك هنا تحديد نمط هذه العلامات بالاعتماد على اوراق انماطك. وترك خانة فارغة يعني انه لن يتم استخدام اي نمط معين.

{{تنبيه: اذا تم تعديل بعض العلامات (الخط الأفقي او عنوان الفقرة او المائل او الأسود) أعلاه، لن يتم تطبيق الأنماط أدناه.}}
<q1>
_ {{١.}} العلامات &lt;p&gt; و&lt;i&gt; و&lt;strong&gt;: [[%style_p%]]
_ {{٢.}} العلامات &lt;tables&gt; و&lt;hr&gt; و&lt;h3&gt; و&lt;blockquote&gt; واللوائح (&lt;ol&gt; و&lt;ul&gt; الخ.):[[%style_h%]]

ملاحظة: بتعديل هذا العامل الثاني، ستفقد الانماط القياسية المناسبة لهذه العلامات.</q1>', # MODIF
	'class_spip:nom' => 'SPIP واختصاراته',
	'code_css' => 'CSS',
	'code_fonctions' => 'الدوال',
	'code_jq' => 'jQuery',
	'code_js' => 'جافاسكريبت',
	'code_options' => 'الخيارات',
	'code_spip_options' => 'خيارات SPIP',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie privée', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options précédentes)', # NEW
	'contrib' => 'لمزيد من المعلومات: @url@',
	'copie_vers' => 'Copie vers : @dir@', # NEW
	'corbeille:description' => 'يحذف SPIP آلياً العناصر الموضوعة في سلة المهملات بعد ٢٤ ساعة، إجمالاً حوالي الساعة الرابعة فجراً، وذلك بفضل وظيفة «cron» (تنفيذ دوري او آلي لعمليات تمت برمجتها مسبقاً). يمكنك هناك إيقاف هذه الوظيفة للتحكم بشكل أفضل بسلة مهملاتك.[[%arret_optimisation%]]',
	'corbeille:nom' => 'سلة المهملات',
	'corbeille_objets' => '@nb@ عنصر في السلة.',
	'corbeille_objets_lies' => '@nb_lies@ رابط تم العثور عليه.',
	'corbeille_objets_vide' => 'لا يوجد اي عنصر في السلة.',
	'corbeille_objets_vider' => 'حذف العناصر المحددة',
	'corbeille_vider' => 'تفريغ سلة المهملات:',
	'couleurs:aide' => 'تلوين:<b>[coul]نص[/coul]</b>@fond@ مع <b>لون</b> = @liste@',
	'couleurs:description' => 'يتيح تطبيق الوان على كل نصوص الموقع بسهولة (على المقالات والاخبار والعناوين والمنتديات...) باستخدام علامات مختصرة.

واليك بمثالين متشابهين لتغيير لون النص:@_CS_EXEMPLE_COULEURS2@

وكذا لتغيير الخلفية، اذا سمح بذلك الخيار ادناه:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@يجب على تنسيق هذه العلامات عرض الوان موجودة فعلاً او تحديد أزواج «علامة=لون»، تفصل بينها فواصل. امثلة: «رمادي، أحمر»، «ضعيف=أصفر، قوي=أحمر» او «أسفل=99CC11#، أعلى=بني» او «رمادي=#DDDDCC، أحمر=#EE3300». للمثالان الاول والاخير، العلامتان المسموح بهما هما: <code>[رمادي]</code> و<code>[أحمر]</code> (<code>[خلفية رمادي]</code> و<code>[خلفية أحمر]</code> اذا كان مسموحاً باستخدام الخلفية).', # MODIF
	'couleurs:nom' => 'تلوين النصوص',
	'couleurs_fonds' => '، <b>[fond coul]نصوص[/coul]</b>، <b>[bg coul]نصوص[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{السجلات}}. يمكنك الحصول على الكثير من المعلومات حول أداء سكين الجيب في ملفات {spip.log} الموجودة في المجلد:{<html>@_CS_DIR_TMP@</html>}[[%log_couteau_suisse%]]

@puce@ {{خيارات SPIP.}} يقوم SPIP بفرز الملحقات حسب ترتيب معين. وللتأكد من وضع سكين الجيب في أعلى القائمة ليمكنه من التحكم مباشرة ببعض خيارات SPIP، يجب تحديد الخيار التالي. واذا كانت أذونات خادم موقعك تسمح بذلك، سيتم تعديل الملف {<html>@_CS_FILE_OPTIONS@</html>} آلياً لإدخال الملف {<html>@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php</html>} فيه.
[[%spip_options_on%]]@_CS_FILE_OPTIONS_ERR@

@puce@ {{الاستفسارات الخارجية.}} يقوم سكين الجيب دورياً بالتحقق من وجود إصدار أحدث لرموزه ويعرض في صفحة إعداده توافر إصدار جديد اذا وجده. من ناحية أخرى يحتوي هذا الملحق على لعض الأدوات التي قد تتطلب استيراد مكتبات بعيدة.

فإذا كانت هناك مشكلة في الاستفسارات الخارجية في خادم موقعك او لتحسين أمان الموقع يجب تحديد الخيارين التاليين.[[%distant_off%]][[->%distant_outils_off%]]', # MODIF
	'cs_comportement:nom' => 'أداء سكين الجيب',
	'cs_distant_off' => 'التدقيق في الإصدارات البعيدة',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => 'سجلات سكين الجيب المفصلة',
	'cs_reset' => 'هل تريد فعلاً إعادة تأصيل سكين الجيب بالكامل؟ ',
	'cs_reset2' => 'Tous les outils actuellement actifs seront désactivés et leurs paramètres réinitialisés.', # NEW
	'cs_spip_options_erreur' => 'Attention : la modification du ficher «<html>@_CS_FILE_OPTIONS@</html>» a échoué !', # NEW
	'cs_spip_options_on' => 'خيارات SPIP في «<html>@_CS_FILE_OPTIONS@</html>»',

	// D
	'decoration:aide' => 'زخرفة: <b>&lt;علامة&gt;اختبار&lt;/علامة&gt;</b>، مع <b>علامة</b> = @liste@',
	'decoration:description' => 'الأنماط الجديدة التي يمكن إعدادها في نصوصك والمتوافرة من خلال علامات يحيطها قوسان. مثال: 
&lt;mytag&gt;النص&lt;/mytag&gt;او: &lt;mytag/&gt;.<br />حدد أدناه الأنماط التي تحتاجها، علامة في كل سطر، حسب الكتابة التالية:
- {type.mytag = نمط CSS}
- {type.mytag.class = صنف CSS}
- {type.mytag.lang = اللغة (مثلاً: ar)}
- - {alias = mytag}

يمكن لمعامل {type} أعلاه ان يأخذ ثلاث قيم:
- {span}: علامة داخل فقرة (type Inline)
- {div}: علامة تنشئ فقرة جديدة (type Block)
- {auto}: علامة يحددها الملحق آلياً

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'زخرفة',
	'decoupe:aide' => 'كتلة الالسنة: <b>&lt;onglets>&lt;/onglets></b><br />فاصل بين الصفحات او الالسنة: @sep@',
	'decoupe:aide2' => 'اللقب: @sep@',
	'decoupe:description' => '@puce@ يعرض مقالاً في الموقع العمومي في عدة صفحات بفضل ترقيم الصفحات الآلي. يكفي وضع ارعة رموز زائد متتالية (<code>++++</code>) في المقال في الموقع الذي يجب قطع المقال فيه.

افتراضياً، يُدخل سكين الجيب ترقيم الصفحات في اعلى المقال واسفله آلياً. لكن يمكنك وضع هذا الترقيم في مكان آخر في الصفحة النموذجية بفضل علامة CS_DECOUPE# التي يمكن تفعيلها هنا:
[[%balise_decoupe%]]

@puce@ اذا كنت تستخدم هذا الفاصل داخل علامتي &lt;onglets&gt; و&lt;/onglets&gt; تحصل على مجموعة من التبويبات.

في الصفحات النموذجية: تتوافر لديك العلامات الجديدة ONGLETS_DEBUT# وONGLETS_TITRE# وONGLETS_FIN#.

يمكن استخدام هذه الأداة بالتزامن مع «[.->sommaire]».', # MODIF
	'decoupe:nom' => 'تقسيم الى صفحات او السنة',
	'desactiver_flash:description' => 'يحذف عناصر فلاش من صفحات موقعك ويستبدلها بالمحتوى البديل المناسب لها.',
	'desactiver_flash:nom' => 'إيقاف عناصر فلاش',
	'detail_balise_etoilee' => '{{تجذير}}: تأكد من كيفية استخدام صفحاتك النموذجية للعلامات النجمية. فمعالجات هذه الاداة لا تنطبق على:@bal@.',
	'detail_disabled' => 'Paramètres non modifiables :', # NEW
	'detail_fichiers' => 'الملفات:',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'الرموز البرمجية المدمجة:',
	'detail_jquery2' => 'هذه الاداة تستخدم الى مكتبة {jQuery}.',
	'detail_jquery3' => '{{تنبيه}}: هذه الأداة تتطلب ملحق [jQuery لـSPIP ١.٩٢->files.spip.org/spip-zone/jquery_192.zip] لكي تعمل بشكل سليم مع هذا الإصدار من SPIP.',
	'detail_pipelines' => 'خطوط المواسير:',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_spip_options2' => 'Il est recommandé de placer les options SPIP en amont grâce à l\'outil «[.->cs_comportement]».', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_surcharge' => 'Outil surchargé :', # NEW
	'detail_traitements' => 'المعالجات:',
	'devdebug:description' => '{{Cet outil vous permet de voir les erreurs PHP à l\'écran.}}<br />Vous pouvez choisir le niveau d\'erreurs d\'exécution PHP qui sera affiché si le débogueur est actif, ainsi que l\'espace SPIP sur lequel ces réglages s\'appliqueront.', # NEW
	'devdebug:item_e_all' => 'Tous les messages d\'erreur (all)', # NEW
	'devdebug:item_e_error' => 'Erreurs graves ou fatales (error)', # NEW
	'devdebug:item_e_notice' => 'Notes d\'exécution (notice)', # NEW
	'devdebug:item_e_strict' => 'Tous les messages + les conseils PHP (strict)', # NEW
	'devdebug:item_e_warning' => 'Avertissements (warning)', # NEW
	'devdebug:item_espace_prive' => 'Espace privé', # NEW
	'devdebug:item_espace_public' => 'Espace public', # NEW
	'devdebug:item_tout' => 'Tout SPIP', # NEW
	'devdebug:nom' => 'Débogueur de développement', # NEW
	'distant_aide' => 'Cet outil requiert des fichiers distants qui doivent tous être correctement installés en librairie. Avant d\'activer cet outil ou d\'actualiser ce cadre, assurez-vous que les fichiers requis sont bien présents sur le serveur distant.', # NEW
	'distant_charge' => 'Fichier correctement téléchargé et installé en librairie.', # NEW
	'distant_charger' => 'Lancer le téléchargement', # NEW
	'distant_echoue' => 'Erreur sur le chargement distant, cet outil risque de ne pas fonctionner !', # NEW
	'distant_inactif' => 'Fichier introuvable (outil inactif).', # NEW
	'distant_present' => 'Fichier présent en librairie depuis le @date@.', # NEW
	'dossier_squelettes:description' => 'يغيّر مجلد الصفحات النموذجية المستخدم. مثلاً: «squelettes/mytemplates». يمكنك إدخال عدة مجلدات تفصل بينها نقطتان <html>«:»</html>. اذا تركت الخانة أدناه فارغة (او اذا ادخلت «dist») سيتم استخدام الصفحات النموذجية القياسية في مجلد «dist» التي تأتي مع SPIP.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'مجلد الصفحات النموذجية',

	// E
	'ecran_activer' => 'Activer l\'écran de sécurité', # NEW
	'ecran_conflit' => 'Attention : le fichier statique «@file@» peut entrer en conflit. Choisissez votre méthode de protection !', # NEW
	'ecran_conflit2' => 'Note : un fichier statique «@file@» a été détecté et activé. Le Couteau Suisse ne pourra le mettre à jour ou le configurer.', # NEW
	'ecran_ko' => 'Ecran inactif !', # NEW
	'ecran_maj_ko' => 'La version {{@n@}} de l\'écran de sécurité est disponible. Veuillez actualiser le fichier distant de cet outil.', # NEW
	'ecran_maj_ko2' => 'La version @n@ de l\'écran de sécurité est disponible. Vous pouvez actualiser le fichier distant de l\'outil « [.->ecran_securite] ».', # NEW
	'ecran_maj_ok' => '(semble à jour).', # NEW
	'ecran_securite:description' => 'L\'écran de sécurité est un fichier PHP directement téléchargé du site officiel de SPIP, qui protège vos sites en bloquant certaines attaques liées à des trous de sécurité. Ce système permet de réagir très rapidement lorsqu\'un problème est découvert, en colmatant le trou sans pour autant devoir mettre à niveau tout son site ni appliquer un « patch » complexe.

A savoir : l\'écran verrouille certaines variables. Ainsi, par exemple, les  variables nommées <code>id_xxx</code> sont toutes  contrôlées comme étant obligatoirement des valeurs numériques entières, afin d\'éviter toute injection de code SQL via ce genre de variable très courante. Certains plugins ne sont pas compatibles avec toutes les règles de l\'écran, utilisant par exemple <code>&id_x=new</code> pour créer un objet {x}.

Outre la sécurité, cet écran a la capacité réglable de moduler les accès des robots  d\'indexation aux scripts PHP, de manière à leur dire de « revenir plus tard »  lorsque le serveur est saturé.[[ %ecran_actif%]][[->
@puce@ Régler la protection anti-robots quand la charge du serveur (load)  excède la valeur : %ecran_load%
_ {La valeur par défaut est 4. Mettre 0 pour désactiver ce processus.}@_ECRAN_CONFLIT@]]

En cas de mise à jour officielle, actualisez le fichier distant associé (cliquez ci-dessus sur [actualiser]) afin de bénéficier de la protection la plus récente.

- Version du fichier local : ', # NEW
	'ecran_securite:nom' => 'Ecran de sécurité', # NEW
	'effaces' => 'محذوف',
	'en_travaux:description' => 'خلال فترة الصيانة، تتيح عرض رسالة يمكن تخصيصها في كل صفحات الموقع واذا اقتضت الحاجة في المجال الخاص.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'موقع قيد التصميم',
	'erreur:bt' => '<span style=\\"color:red;\\">تنبيه:</span> يبدو ان شريط ادوات الكتابة (الإصدار @version@) قديم.<br />يتوافق سكين الجيب مع الإصدار @mini@ أو أحدث. ',
	'erreur:description' => 'رقم متسلسل غير موجود في تعريف الاداة!',
	'erreur:distant' => 'الخادم البعيد',
	'erreur:jquery' => '{{ملاحظة}}: يبدو ان مكتبة {jQuery} غير نشطة في هذه الصفحة. الرجاء مراجعة الفقرة حول علاقات الملحق [هنا->http://www.spip-contrib.net/?article2166] او اعادة تحديث الصفحة.',
	'erreur:js' => 'يبدو ان خطأ جافاسكريبت وقع في هذه الصفحة وحال دون تنفيذها. الرجاء تفعيل جافاسكريبت في متصفحك أو ايقاف عمل بعض ملحقات SPIP في موقعك.',
	'erreur:nojs' => 'جافاسكريبت معطل في هذه الصفحة.',
	'erreur:nom' => 'خطأ!',
	'erreur:probleme' => 'مشكلة في: @pb@',
	'erreur:traitements' => 'سكين الجيب - خطأ في تصنيف المعالجات: فالخلط بين \'typo\' و\'propre\' غير مسموح به!',
	'erreur:version' => 'هذه الاداة ضرورية في اصدار SPIP الحالي.',
	'erreur_groupe' => 'Attention : le groupe «@groupe@» n\'est pas défini !', # NEW
	'erreur_mot' => 'Attention : le mot-clé «@mot@» n\'est pas défini !', # NEW
	'etendu' => 'ممدد',

	// F
	'f_jQuery:description' => 'تمنع تثبيت {jQuery} في الموقع العمومي لتوفير العبء على خادم الموقع. تقدم هذه المكتبة ([->http://jquery.com/]) العديد من الوظائف في برمجة جافاسكريبت ويمكن ان تستخدمها بعض الملحقات. اما SPIP، فيستخدمها في الجمال الخاص.
  
تنبيه: بعض أدوات سكين الجيب تحتاج الى وظائف من {jQuery}.', # MODIF
	'f_jQuery:nom' => 'يعطل jQuery',
	'filets_sep:aide' => 'خط فصل: <b>__س__</b> حيث <b>س</b> هو رقم من <b>صفر</b> الى <b>@max@</b>. <br />هناك خطوط أخرى متاحة: @liste@',
	'filets_sep:description' => 'Insère des filets de séparation, personnalisables par des feuilles de style, dans tous les textes de SPIP.
_ La syntaxe est : &quot;__code__&quot;, où &quot;code&quot; représente soit le numéro d’identification (de 0 à 7) du filet à insérer en relation directe avec les styles correspondants, soit le nom d\'une image placée dans le dossier plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'خطوط فصل',
	'filtrer_javascript:description' => 'Pour gérer le javascript dans les articles, trois modes sont disponibles :
- <i>jamais</i> : le javascript est refusé partout
- <i>défaut</i> : le javascript est signalé en rouge dans l\'espace privé
- <i>toujours</i> : le javascript est accepté partout.

Attention : dans les forums, pétitions, flux syndiqués, etc., la gestion du javascript est <b>toujours</b> sécurisée.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'إدارة جافاسكريبت',
	'flock:description' => 'Désactive le système de verrouillage de fichiers en neutralisant la fonction PHP {flock()}. Certains hébergements posent en effet des problèmes graves suite à un système de fichiers inadapté ou à un manque de synchronisation. N\'activez pas cet outil si votre site fonctionne normalement.', # NEW
	'flock:nom' => 'عدم إقفال الملفات',
	'fonds' => 'الخلفية:',
	'forcer_langue:description' => 'يفرض سياق اللغة لمجموعة الصفحات النموذجية المتعددة اللغات التي تحتوي استمارة او قائمة لغات يمكنها التحكم بكعكة اللغة.

على صعيد تقني، تؤدي هذه الأداة الى:
- إيقاف البحث في الصفحة النموذجية اعتماداً على لغة العنصر
- إيقاف المعيار الآلي <code>{lang_select}</code> على العناصر التقليدية (المقالات، الأخبار، الأقسام...).

ولكن كتل تعدد اللغات (multi) تبقى ظاهرة في اللغة التي اختارها الزائر.', # MODIF
	'forcer_langue:nom' => 'تفرض اللغة',
	'format_spip' => 'المقالات بتنسيق SPIP',
	'forum_lgrmaxi:description' => 'Par défaut les messages de forum ne sont pas limités en taille. Si cet outil est activé, un message d\'erreur s\'affichera lorsque quelqu\'un voudra poster un message  d\'une taille supérieure à la valeur spécifiée, et le message sera refusé. Une valeur vide ou égale à 0 signifie néamoins qu\'aucune limite ne s\'applique.[[%forum_lgrmaxi%]]', # MODIF
	'forum_lgrmaxi:nom' => 'حجم المنتديات',

	// G
	'glossaire:aide' => 'نص بلا قاموس مصطلخات',
	'glossaire:description' => '@puce@ Gestion d’un glossaire interne lié à un ou plusieurs groupes de mots-clés. Inscrivez ici le nom des groupes en  les séparant par les deux points « : ». En laissant vide la case qui  suit (ou en tapant &quot;Glossaire&quot;), c’est le groupe &quot;Glossaire&quot; qui sera utilisé.[[%glossaire_groupes%]]@puce@ Pour chaque mot, vous avez la possibilité de choisir le nombre maximal de liens créés dans vos textes. Toute valeur nulle ou négative implique que tous les mots reconnus seront traités. [[%glossaire_limite% par mot-clé]]@puce@ Deux solutions vous sont offertes pour générer la petite fenêtre automatique qui apparait lors du survol de la souris. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'الفهرس الداخلي',
	'glossaire_css' => 'حلول أوراق الانماط',
	'glossaire_erreur' => 'Le mot «@mot1@» rend indétectable le mot «@mot2@»', # NEW
	'glossaire_inverser' => 'Correction proposée : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'حلول جافاسكريبت',
	'glossaire_ok' => 'La liste des @nb@ mot(s) étudié(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Remplace automatiquement les guillemets droits (") par les guillemets typographiques de la langue de composition. Le remplacement, transparent pour l\'utilisateur, ne modifie pas le texte original mais seulement l\'affichage final.', # NEW
	'guillemets:nom' => 'علامات الاقتباس',

	// H
	'help' => '{{Cette page est uniquement accessible aux responsables du site.}}<p>Elle donne accès aux différentes  fonctions supplémentaires apportées par le plugin «{{Le Couteau Suisse}}».</p><p>Version locale : @version@@distant@<br/>@pack@</p><p>Liens de documentation :<br/>• [Le Couteau Suisse->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Réinitialisations :
_ • [Des outils cachés|Revenir à l\'apparence initiale de cette page->@hide@]
_ • [De tout le plugin|Revenir à l\'état initial du plugin->@reset@]@install@
</p>', # MODIF
	'help2' => 'Version locale : @version@', # NEW
	'help3' => '<p>Liens de documentation :<br />• [{{Le Couteau Suisse}}->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Réinitialisations :
_ • [Des outils cachés|Revenir à l\'apparence initiale de cette page->@hide@]
_ • [De tout le plugin|Revenir à l\'état initial du plugin->@reset@]@install@
</p>', # NEW
	'horloge:description' => 'Outil en cours de développement. Vous offre une horloge JavaScript . Balise : <code>#HORLOGE</code>. Modèle : <code><horloge></code>

Arguments disponibles : {zone}, {format} et/ou {id}.', # NEW
	'horloge:nom' => 'Horloge', # NEW

	// I
	'icone_visiter:description' => 'Remplace l\'image du bouton standard «<:icone_visiter_site:>» (en haut à droite sur cette page)  par le logo du site, s\'il existe.

Pour définir ce logo, rendez-vous sur la page «<:titre_configuration:>» en cliquant sur le bouton «<:icone_configuration_site:>».', # NEW
	'icone_visiter:nom' => 'Bouton « <:icone_visiter_site:> »', # NEW
	'insert_head:description' => 'Active automatiquement la balise [#INSERT_HEAD->http://www.spip.net/fr_article1902.html] sur tous les squelettes, qu\'ils aient ou non cette balise entre &lt;head&gt; et &lt;/head&gt;. Grâce à cette option, les plugins pourront insérer du javascript (.js) ou des feuilles de style (.css).', # MODIF
	'insert_head:nom' => 'علامة #INSERT_HEAD',
	'insertions:description' => 'ATTENTION : outil en cours de développement !! [[%insertions%]]', # NEW
	'insertions:nom' => 'تدقيق آلي',
	'introduction:description' => 'Cette balise à placer dans les squelettes sert en général à la une ou dans les rubriques afin de produire un résumé des articles, des brèves, etc..</p>
<p>{{Attention}} : Avant d\'activer cette fonctionnalité, vérifiez bien qu\'aucune fonction {balise_INTRODUCTION()} n\'existe déjà dans votre squelette ou vos plugins, la surcharge produirait alors une erreur de compilation.</p>
@puce@ Vous pouvez préciser (en pourcentage par rapport à la valeur utilisée par défaut) la longueur du texte renvoyé par balise #INTRODUCTION. Une valeur nulle ou égale à 100 ne modifie pas l\'aspect de l\'introduction et utilise donc les valeurs par défaut suivantes : 500 caractères pour les articles, 300 pour les brèves et 600 pour les forums ou les rubriques.
[[%lgr_introduction% %]]
@puce@ Par défaut, les points de suite ajoutés au résultat de la balise #INTRODUCTION si le texte est trop long sont : <html>«&amp;nbsp;(…)»</html>. Vous pouvez ici préciser votre propre chaîne de caratère indiquant au lecteur que le texte tronqué a bien une suite.
[[%suite_introduction%]]
@puce@ Si la balise #INTRODUCTION est utilisée pour résumer un article, alors le Couteau Suisse peut fabriquer un lien hypertexte sur les points de suite définis ci-dessus afin de mener le lecteur vers le texte original. Par exemple : «Lire la suite de l\'article…»
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'علامة #INTRODUCTION',

	// J
	'jcorner:description' => '« Jolis Coins » est un outil permettant de modifier facilement l\'aspect des coins de vos {{cadres colorés}} en partie publique de votre site. Tout est possible, ou presque !
_ Voyez le résultat sur cette page : [->http://www.malsup.com/jquery/corner/].

Listez ci-dessous les objets de votre squelette à arrondir en utilisant la syntaxe CSS (.class, #id, etc. ). Utilisez le le signe « = » pour spécifier la commande jQuery à utiliser et un double slash (« // ») pour les commentaires. En absence du signe égal, des coins ronds seront appliqués (équivalent à : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Attention, cet outil a besoin pour fonctionner du plugin {jQuery} : {Round Corners}. Le Couteau Suisse peut l\'installer directement si vous cochez la case suivante. [[%jcorner_plugin%]]', # NEW
	'jcorner:nom' => 'Jolis Coins', # NEW
	'jcorner_plugin' => '« Round Corners plugin »', # NEW
	'jq_localScroll' => 'jQuery.LocalScroll ([démo->http://demos.flesler.com/jquery/localScroll/])', # NEW
	'jq_scrollTo' => 'jQuery.ScrollTo ([démo->http://demos.flesler.com/jquery/scrollTo/])', # NEW
	'js_defaut' => 'افتراضي',
	'js_jamais' => 'أبداً',
	'js_toujours' => 'دائماً',
	'jslide_aucun' => 'Aucune animation', # NEW
	'jslide_fast' => 'Glissement rapide', # NEW
	'jslide_lent' => 'Glissement lent', # NEW
	'jslide_millisec' => 'Glissement durant :', # NEW
	'jslide_normal' => 'Glissement normal', # NEW

	// L
	'label:admin_travaux' => 'اغلاق الموقع العمومي لـ:',
	'label:alinea' => 'Champ d\'application :', # NEW
	'label:arret_optimisation' => 'Empêcher SPIP de vider la corbeille automatiquement :', # NEW
	'label:auteur_forum_nom' => 'Le visiteur doit spécifier :', # NEW
	'label:auto_sommaire' => 'انشاء منتظم للمحتويات:',
	'label:balise_decoupe' => 'Activer la balise #CS_DECOUPE :', # NEW
	'label:balise_sommaire' => 'تفعيل علامة #CS_SOMMAIRE:',
	'label:bloc_h4' => 'Balise pour les titres :', # NEW
	'label:bloc_unique' => 'Un seul bloc ouvert sur la page :', # NEW
	'label:blocs_cookie' => 'Utilisation des cookies :', # NEW
	'label:blocs_slide' => 'Type d\'animation :', # NEW
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal réservé aux copies locales :', # NEW
	'label:couleurs_fonds' => 'اتاحة الخلفيات:',
	'label:cs_rss' => 'تفعيل:',
	'label:debut_urls_propres' => 'Début des URLs :', # NEW
	'label:decoration_styles' => 'علامات الانماط الشخصية:',
	'label:derniere_modif_invalide' => 'Recalculer juste après une modification :', # NEW
	'label:devdebug_espace' => 'Filtrage de l\'espace concerné :', # NEW
	'label:devdebug_mode' => 'Activer le débogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoyé :', # NEW
	'label:distant_off' => 'Désactiver :', # NEW
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'المجلد (المجلات) المطلوب استخدامها:',
	'label:duree_cache' => 'عمر الذاكرة المخبأة المحلية:',
	'label:duree_cache_mutu' => 'عمر الذاكرة المخبأة المشتركة:',
	'label:ecran_actif' => '@_CS_CHOIX@', # NEW
	'label:enveloppe_mails' => 'Petite enveloppe devant les mails :', # NEW
	'label:expo_bofbof' => 'Mise en exposants pour : <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>', # NEW
	'label:forum_lgrmaxi' => 'القيمة (بالاحرف):',
	'label:glossaire_groupes' => 'المجموعة (المجموعات) المستخدمة:',
	'label:glossaire_js' => 'التقنية المستخدمة:',
	'label:glossaire_limite' => 'الحد الاقصى للروابط المنشأة:',
	'label:i_align' => 'Alignement du texte :', # NEW
	'label:i_couleur' => 'Couleur de la police :', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (éq. à {line-height}) :', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte :', # NEW
	'label:i_padding' => 'Espacement autour du texte (éq. à {padding}) :', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/}) :', # NEW
	'label:i_taille' => 'Taille de la police :', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'التصحيحات الآلية:',
	'label:jcorner_classes' => 'Améliorer les coins des sélecteurs suivants :', # NEW
	'label:jcorner_plugin' => 'Installer le plugin {jQuery} suivant :', # NEW
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'طول الملخص:',
	'label:lgr_sommaire' => 'عرض المحتويات (9 الى 99):',
	'label:lien_introduction' => 'علامات التتمة القابلة للنقر:',
	'label:liens_interrogation' => 'حماية عناوين URL:',
	'label:liens_orphelins' => 'الروابط القابلة للنقر:',
	'label:log_couteau_suisse' => 'Activer :', # NEW
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:long_url' => 'Longueur du libellé cliquable :', # NEW
	'label:marqueurs_urls_propres' => 'Ajouter les marqueurs dissociant les objets (SPIP>=2.0) :<br />(ex. : « - » pour -Ma-rubrique-, « @ » pour @Mon-site@) ', # NEW
	'label:max_auteurs_page' => 'عدد المؤلفين في الصفحة:',
	'label:message_travaux' => 'رسالة الصيانة الشخصية:',
	'label:moderation_admin' => 'Valider automatiquement les messages des : ', # NEW
	'label:mot_masquer' => 'Mot-clé masquant les contenus :', # NEW
	'label:ouvre_note' => 'Ouverture et fermeture des notes de bas de page', # NEW
	'label:ouvre_ref' => 'Ouverture et fermeture des appels de notes de bas de page', # NEW
	'label:paragrapher' => 'انشاء الفقرات دائماً:',
	'label:prive_travaux' => 'Accessibilité de l\'espace privé pour :', # NEW
	'label:prof_sommaire' => 'Profondeur retenue (1 à 4) :', # NEW
	'label:puce' => 'علامة اللوائح العمومية «<html>-</html>»:',
	'label:quota_cache' => 'قيمة الحصة:',
	'label:racc_g1' => 'Entrée et sortie de la mise en «<html>{{gras}}</html>» :', # NEW
	'label:racc_h1' => 'Entrée et sortie d\'un «<html>{{{intertitre}}}</html>» :', # NEW
	'label:racc_hr' => 'Ligne horizontale «<html>----</html>» :', # NEW
	'label:racc_i1' => 'نقطتا الدخول والخروج للتحويل الى «<html>{مائل}</html>»:',
	'label:radio_desactive_cache3' => 'استخدام الذاكرة المخبأة:',
	'label:radio_desactive_cache4' => 'Utilisation du cache :', # NEW
	'label:radio_target_blank3' => 'Nouvelle fenêtre pour les liens externes :', # NEW
	'label:radio_type_urls3' => 'Format des URLs :', # NEW
	'label:scrollTo' => 'Installer les plugins {jQuery} suivants :', # NEW
	'label:separateur_urls_page' => 'Caractère de séparation \'type-id\'<br />(ex. : ?article-123) :', # NEW
	'label:set_couleurs' => 'Set à utiliser :', # NEW
	'label:spam_ips' => 'Adresses IP à bloquer :', # NEW
	'label:spam_mots' => 'Séquences interdites :', # NEW
	'label:spip_options_on' => 'Inclure :', # NEW
	'label:spip_script' => 'Script d\'appel :', # NEW
	'label:style_h' => 'Votre style :', # NEW
	'label:style_p' => 'Votre style :', # NEW
	'label:suite_introduction' => 'Points de suite :', # NEW
	'label:terminaison_urls_page' => 'Terminaison des URLs (ex : « .html ») :', # NEW
	'label:titre_travaux' => 'عنوان الرسالة',
	'label:titres_etendus' => 'Activer l\'utilisation étendue des balises #TITRE_XXX :', # NEW
	'label:url_arbo_minuscules' => 'Conserver la casse des titres dans les URLs :', # NEW
	'label:url_arbo_sep_id' => 'Caractère de séparation \'titre-id\' en cas de doublon :<br />(ne pas utiliser \'/\')', # NEW
	'label:url_glossaire_externe2' => 'Lien vers le glossaire externe :', # NEW
	'label:url_max_propres' => 'Longueur maximale des URLs (caractères) :', # NEW
	'label:urls_arbo_sans_type' => 'Afficher le type d\'objet SPIP dans les URLs :', # NEW
	'label:urls_avec_id' => 'Un id systématique, mais...', # NEW
	'label:webmestres' => 'Liste des webmestres du site :', # NEW
	'liens_en_clair:description' => 'Met à votre disposition le filtre : \'liens_en_clair\'. Votre texte contient probablement des liens hypertexte qui ne sont pas visibles lors d\'une impression. Ce filtre ajoute entre crochets la destination de chaque lien cliquable (liens externes ou mails). Attention : en mode impression (parametre \'cs=print\' ou \'page=print\' dans l\'url de la page), cette fonctionnalité est appliquée automatiquement.', # NEW
	'liens_en_clair:nom' => 'Liens en clair', # NEW
	'liens_orphelins:description' => 'Cet outil a deux fonctions :

@puce@ {{Liens corrects}}.

SPIP a pour habitude d\'insérer un espace avant les points d\'interrogation ou d\'exclamation, typo française oblige. Voici un outil qui protège le point d\'interrogation dans les URLs de vos textes.[[%liens_interrogation%]]

@puce@ {{Liens orphelins}}.

Remplace systématiquement toutes les URLs laissées en texte par les utilisateurs (notamment dans les forums) et qui ne sont donc pas cliquables, par des liens hypertextes au format SPIP. Par exemple : {<html>www.spip.net</html>} est remplacé par [->www.spip.net].

Vous pouvez choisir le type de remplacement :
_ • {Basique} : sont remplacés les liens du type {<html>http://spip.net</html>} (tout protocole) ou {<html>www.spip.net</html>}.
_ • {Étendu} : sont remplacés en plus les liens du type {<html>moi@spip.net</html>}, {<html>mailto:monmail</html>} ou {<html>news:mesnews</html>}.
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:description1' => '[[Si l\'URL rencontrée dépasse les %long_url% caractères, alors SPIP la réduit à %coupe_url% caractères]].', # NEW
	'liens_orphelins:nom' => 'Belles URLs', # NEW

	// M
	'mailcrypt:description' => 'Masque tous les liens de courriels présents dans vos textes en les remplaçant par un lien Javascript permettant quand même d\'activer la messagerie du lecteur. Cet outil antispam tente d\'empêcher les robots de collecter les adresses électroniques laissées en clair dans les forums ou dans les balises de vos squelettes.', # MODIF
	'mailcrypt:nom' => 'MailCrypt', # NEW
	'maj_auto:description' => 'Cet outil vous permet de gérer facilement la mise à jour de vos différents plugins, récupérant notamment le numéro de révision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouvé sur <code>zone.spip.org</code>.

La liste ci-dessus offre la possibilité de lancer le processus de mise à jour automatique de SPIP sur chacun des plugins préalablement installés dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> sont simplement listés à titre d\'information. Si la révision distante n\'a pas pu être trouvée, alors tentez de procéder manuellement à la mise à jour du plugin.

Note : les paquets <code>.zip</code> n\'étant pas reconstruits instantanément, il se peut que vous soyez obligé d\'attendre un certain délai avant de pouvoir effectuer la totale mise à jour d\'un plugin tout récemment modifié.', # NEW
	'maj_auto:nom' => 'Mises à jour automatiques', # NEW
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particulière de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-clé défini ci-dessous. Si une rubrique est masquée, toute sa branche l\'est aussi.[[%mot_masquer%]]

Pour forcer l\'affichage des contenus masqués, il suffit d\'ajouter le critère <code>{tout_voir}</code> aux boucles de votre squelette.', # NEW
	'masquer:nom' => 'Masquer du contenu', # NEW
	'meme_rubrique:description' => 'Définissez ici le nombre d\'objets listés dans le cadre nommé «<:info_meme_rubrique:>» et présent sur certaines pages de l\'espace privé.[[%meme_rubrique%]]', # NEW
	'message_perso' => 'Un grand merci aux traducteurs qui passeraient par ici. Pat ;-)', # NEW
	'moderation_admins' => 'administrateurs authentifiés', # NEW
	'moderation_message' => 'Ce forum est modéré à priori : votre contribution n\'apparaîtra qu\'après avoir été validée par un administrateur du site, sauf si vous êtes identifié et autorisé à poster directement.', # NEW
	'moderation_moderee:description' => 'Permet de modérer la modération des forums publics <b>configurés à priori</b> pour les utilisateurs inscrits.<br />Exemple : Je suis le webmestre de mon site, et je réponds à un message d\'un utilisateur, pourquoi devoir valider mon propre message ? Modération modérée le fait pour moi ! [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]', # NEW
	'moderation_moderee:nom' => 'Modération modérée', # NEW
	'moderation_redacs' => 'rédacteurs authentifiés', # NEW
	'moderation_visits' => 'visiteurs authentifiés', # NEW
	'modifier_vars' => 'Modifier ces @nb@ paramètres', # NEW
	'modifier_vars_0' => 'Modifier ces paramètres', # NEW

	// N
	'no_IP:description' => 'Désactive le mécanisme d\'enregistrement automatique des adresses IP des visiteurs de votre site par soucis de confidentialité : SPIP ne conservera alors plus aucun numéro IP, ni temporairement lors des visites (pour gérer les statistiques ou alimenter spip.log), ni dans les forums (responsabilité).', # NEW
	'no_IP:nom' => 'Pas de stockage IP', # NEW
	'nouveaux' => 'Nouveaux', # NEW

	// O
	'orientation:description' => '3 nouveaux critères pour vos squelettes : <code>{portrait}</code>, <code>{carre}</code> et <code>{paysage}</code>. Idéal pour le classement des photos en fonction de leur forme.', # NEW
	'orientation:nom' => 'اتجاه الصور',
	'outil_actif' => 'أداة نشطة',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'تفعيل',
	'outil_activer_le' => 'تفعيل الأداة',
	'outil_cacher' => 'إخفاء',
	'outil_desactiver' => 'إيقاف',
	'outil_desactiver_le' => 'إيقاف الأداة',
	'outil_inactif' => 'أداة غير نشطة',
	'outil_intro' => 'تعرض هذه الصفحة أدوات الملحق المتوافرة.<br /><br /> بالنقر على أسماء الأدوات أدناه، تتمكن من تحديد الأدوات التي سيتم تغيير حالتها بواسطة الزر الأوسط: فيتم تفعيل الأدوات المتوقفة وبالعكس. وتؤدي كل نقرة الى عرض وصف الأداة تحت اللائحة. كما يمكن إخفاء مكونات أصناف الأدوات بالنقر على عناوين هذه الأصناف. أما النقر المزدوج فيتيح تغيير حالة الأداة بسرعة. <br /><br />لدى أول استخدام، ننصح بتفعيل الأدوات واحدة تلو الأخرى لتعقب اي مشكلة توافق قد تظهر مع صفحاتك النموذجية او مع SPIP او مع ملحقات أخرى.<br /><br />ملاحظة: إعادة تحميل الصفحة يعيد تحديث مجمل أدوات سكين الجيب.',
	'outil_intro_old' => 'Cette interface est ancienne.<br /><br />Si vous rencontrez des problèmes dans l\'utilisation de la <a href=\'./?exec=admin_couteau_suisse\'>nouvelle interface</a>, n\'hésitez pas à nous en faire part sur le forum de <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.', # NEW
	'outil_nb' => '@pipe@ : @nb@ اداة',
	'outil_nbs' => '@pipe@ : @nb@ اداة',
	'outil_permuter' => 'Permuter l\'outil : « @text@ » ?', # NEW
	'outils_actifs' => 'Outils actifs :', # NEW
	'outils_caches' => 'Outils cachés :', # NEW
	'outils_cliquez' => 'Cliquez sur le nom des outils ci-dessus pour afficher ici leur description.', # NEW
	'outils_concernes' => 'Sont concernés : ', # NEW
	'outils_desactives' => 'Sont désactivés : ', # NEW
	'outils_inactifs' => 'Outil inactifs :', # NEW
	'outils_liste' => 'Liste des outils du Couteau Suisse', # NEW
	'outils_non_parametrables' => 'Non paramétrables :', # NEW
	'outils_permuter_gras1' => 'Permuter les outils en gras', # NEW
	'outils_permuter_gras2' => 'Permuter les @nb@ outils en gras ?', # NEW
	'outils_resetselection' => 'Réinitialiser la sélection', # NEW
	'outils_selectionactifs' => 'Sélectionner tous les outils actifs', # NEW
	'outils_selectiontous' => 'TOUS', # NEW

	// P
	'pack_actuel' => 'Pack @date@', # NEW
	'pack_actuel_avert' => 'Attention, les surcharges sur les define(), les autorisations spécifiques ou les globales ne sont pas spécifiées ici', # NEW
	'pack_actuel_titre' => 'PACK ACTUEL DE CONFIGURATION DU COUTEAU SUISSE', # NEW
	'pack_alt' => 'Voir les paramètres de configuration en cours', # NEW
	'pack_delete' => 'Supression d\'un pack de configuration', # NEW
	'pack_descrip' => 'Votre "Pack de configuration actuelle" rassemble l\'ensemble des paramètres de configuration en cours concernant le Couteau Suisse : l\'activation des outils et la valeur de leurs éventuelles variables.

Ce code PHP peut prendre place dans le fichier /config/mes_options.php et ajoutera un lien de réinitialisation sur cette page "du pack {Pack Actuel}". Bien sûr il vous est possible de changer son nom ci-dessous.

Si vous réinitialisez le plugin en cliquant sur un pack, le Couteau Suisse se reconfigurera automatiquement en fonction des paramètres prédéfinis dans le pack.',
	'pack_du' => '• du pack @pack@', # NEW
	'pack_installe' => 'Mise en place d\'un pack de configuration', # NEW
	'pack_installer' => 'Êtes-vous sûr de vouloir réinitialiser le Couteau Suisse et installer le pack « @pack@ » ?', # NEW
	'pack_nb_plrs' => 'Il y a actuellement @nb@ « packs de configuration » disponibles :', # NEW
	'pack_nb_un' => 'Il y a actuellement un « pack de configuration » disponible :', # NEW
	'pack_nb_zero' => 'Il n\'y a pas de « pack de configuration » disponible actuellement.', # NEW
	'pack_outils_defaut' => 'Installation des outils par défaut', # NEW
	'pack_sauver' => 'Sauver la configuration actuelle', # NEW
	'pack_sauver_descrip' => 'Le bouton ci-dessous vous permet d\'insérer directement dans votre fichier <b>@file@</b> les paramètres nécessaires pour ajouter un « pack de configuration » dans le menu de gauche. Ceci vous permettra ultérieurement de reconfigurer en un clic votre Couteau Suisse dans l\'état où il est actuellement.', # NEW
	'pack_supprimer' => 'Êtes-vous sûr de vouloir supprimer le pack « @pack@ » ?', # NEW
	'pack_titre' => 'Configuration Actuelle', # NEW
	'pack_variables_defaut' => 'Installation des variables par défaut', # NEW
	'par_defaut' => 'Par défaut', # NEW
	'paragrapher2:description' => 'La fonction SPIP <code>paragrapher()</code> insère des balises &lt;p&gt; et &lt;/p&gt; dans tous les textes qui sont dépourvus de paragraphes. Afin de gérer plus finement vos styles et vos mises en page, vous avez la possibilité d\'uniformiser l\'aspect des textes de votre site.[[%paragrapher%]]', # MODIF
	'paragrapher2:nom' => 'Paragrapher', # NEW
	'pipelines' => 'Pipelines utilisés :', # NEW
	'previsualisation:description' => 'Par défaut, SPIP permet de prévisualiser un article dans sa version publique et stylée, mais uniquement lorsque celui-ci a été « proposé à l’évaluation ». Hors cet outil permet aux auteurs de prévisualiser également les articles pendant leur rédaction. Chacun peut alors prévisualiser et modifier son texte à sa guise.

@puce@ Attention : cette fonctionnalité ne modifie pas les droits de prévisualisation. Pour que vos rédacteurs aient effectivement le droit de prévisualiser leurs articles « en cours de rédaction », vous devez l’autoriser (dans le menu {[Configuration&gt;Fonctions avancées->./?exec=config_fonctions]} de l’espace privé).', # NEW
	'previsualisation:nom' => 'Prévisualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci «*»', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Remplace les puces «-» (tiret simple) des articles par des listes notées «-*» (traduites en HTML par : &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) et dont le style peut être personnalisé par css.', # MODIF
	'pucesli:nom' => 'Belles puces', # NEW

	// Q
	'qui_webmestres' => 'Les webmestres SPIP', # NEW

	// R
	'raccourcis' => 'Raccourcis typographiques actifs du Couteau Suisse :', # NEW
	'raccourcis_barre' => 'Les raccourcis typographiques du Couteau Suisse', # NEW
	'reserve_admin' => 'Accès réservé aux administrateurs.', # NEW
	'rss_actualiser' => 'Actualiser', # NEW
	'rss_attente' => 'Attente RSS...', # NEW
	'rss_desactiver' => 'Désactiver les « Révisions du Couteau Suisse »', # NEW
	'rss_edition' => 'Flux RSS mis à jour le :', # NEW
	'rss_source' => 'Source RSS', # NEW
	'rss_titre' => '« Le Couteau Suisse » en développement :', # NEW
	'rss_var' => 'Les révisions du Couteau Suisse', # NEW

	// S
	'sauf_admin' => 'Tous, sauf les administrateurs', # NEW
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et rédacteurs', # NEW
	'sauf_identifies' => 'Tous, sauf les auteurs identifiés', # NEW
	'set_options:description' => 'Sélectionne d\'office le type d’interface privée (simplifiée ou avancée) pour tous les rédacteurs déjà existant ou à venir et supprime le bouton correspondant du bandeau des petites icônes.[[%radio_set_options4%]]', # NEW
	'set_options:nom' => 'Type d\'interface privée', # NEW
	'sf_amont' => 'En amont', # NEW
	'sf_tous' => 'Tous', # NEW
	'simpl_interface:description' => 'Désactive le menu de changement rapide de statut d\'un article au survol de sa puce colorée. Cela est utile si vous cherchez à obtenir une interface privée la plus dépouillée possible afin d\'optimiser les performances client.', # NEW
	'simpl_interface:nom' => 'Allègement de l\'interface privée', # NEW
	'smileys:aide' => 'Smileys : @liste@', # NEW
	'smileys:description' => 'Insère des smileys dans tous les textes où apparait un raccourci du genre <acronym>:-)</acronym>. Idéal pour les  forums.
_ Une balise est disponible pour aficher un tableau de smileys dans vos squelettes : #SMILEYS.
_ Dessins : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys', # NEW
	'soft_scroller:description' => 'Offre à votre site public un défilement  adouci de la page lorsque le visiteur clique sur un lien pointant vers une ancre : très utile pour éviter de se perdre dans une page complexe ou un texte très long...

Attention, cet outil a besoin pour fonctionner de pages au «DOCTYPE XHTML» (non HTML !) et de deux plugins {jQuery} : {ScrollTo} et {LocalScroll}. Le Couteau Suisse peut les installer directement si vous cochez les cases suivantes. [[%scrollTo%]][[-->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # NEW
	'soft_scroller:nom' => 'Ancres douces', # NEW
	'sommaire:description' => 'Construit un sommaire pour vos articles afin d’accéder rapidement aux gros titres (balises HTML &lt;h3>Un intertitre&lt;/h3> ou raccourcis SPIP : intertitres de la forme :<code>{{{Un gros titre}}}</code>).



@puce@ Vous pouvez définir ici le nombre maximal de caractères retenus des intertitres pour construire le sommaire :[[%lgr_sommaire% caractères]]



@puce@ Vous pouvez aussi fixer le comportement du plugin concernant la création du sommaire: 

_ • Systématique pour chaque article (une balise <code>[!sommaire]</code> placée n’importe où à l’intérieur du texte de l’article créera une exception).

_ • Uniquement pour les articles contenant la balise <code>[sommaire]</code>.



[[%auto_sommaire%]]



@puce@ Par défaut, le Couteau Suisse insère le sommaire en tête d\'article automatiquement. Mais vous avez la possibilté de placer ce sommaire ailleurs dans votre squelette grâce à une balise #CS_SOMMAIRE que vous pouvez activer ici :

[[%balise_sommaire%]]



Ce sommaire peut être couplé avec : {Découpe en pages et onglets}.', # MODIF
	'sommaire:nom' => 'صفحة محتويات آلية',
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre<mon_ancre>}}}</html></b>', # NEW
	'sommaire_avec' => 'نص مع محتويات:<b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'نص بدون محتويات:<b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hiérarchisés : <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Tente de lutter contre les envois de messages automatiques et malveillants en partie publique. Certains mots et les balises &lt;a>&lt;/a> sont interdits.



Listez ici les séquences interdites@_CS_ASTER@ en les séparant par des espaces. [[%spam_mots%]]

@_CS_ASTER@Pour spécifier un mot entier, mettez-le entre paranthèses. Pour une expression avec des espaces, placez-la entre guillemets.', # MODIF
	'spam:nom' => 'Lutte contre le SPAM', # NEW
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Ce message serait bloqué par le filtre anti-SPAM !', # NEW
	'spam_test_ok' => 'Ce message serait accepté par le filtre anti-SPAM.', # NEW
	'spam_tester_bd' => 'Testez également votre votre base de données et listez les messages qui auraient été bloqués par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Afin de tester votre liste de séquences interdites ou d\'adresses IP, utilisez le cadre suivant :', # NEW
	'spip_cache:description' => '@puce@ Par défaut, SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en accélérer la consultation. Désactiver temporairement le cache peut aider au développement du site.[[%radio_desactive_cache3%]]@puce@ Le cache occupe un certain espace disque et SPIP peut en limiter l\'importance. Une valeur vide ou égale à 0 signifie qu\'aucun quota ne s\'applique.[[%quota_cache% Mo]]@puce@ Si la balise #CACHE n\'est pas trouvée dans vos squelettes locaux, SPIP considère par défaut que le cache d\'une page a une durée de vie de 24 heures avant de la recalculer. Afin de mieux gérer la charge de votre serveur, vous pouvez ici modifier cette valeur.[[%duree_cache% heures]]@puce@ Si vous avez plusieurs sites en mutualisation, vous pouvez spécifier ici la valeur par défaut prise en compte par tous les sites locaux (SPIP 1.93).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ Par défaut, SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en accélérer la consultation. Désactiver temporairement le cache peut aider au développement du site.[[%radio_desactive_cache3%]]', # NEW
	'spip_cache:description2' => '@puce@ Quatre options pour orienter le fonctionnement du cache de SPIP : <q1>
_ • {Usage normal} : SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en accélérer la consultation. Après un certain délai, le cache est recalculé et stocké.
_ • {Cache permanent} : les délais d\'invalidation du cache sont ignorés.
_ • {Pas de cache} : désactiver temporairement le cache peut aider au développement du site. Ici, rien n\'est stocké sur le disque.
_ • {Contrôle du cache} : option identique à la précédente, avec une écriture sur le disque de tous les résultats afin de pouvoir éventuellement les contrôler.</q1>[[%radio_desactive_cache4%]]', # NEW
	'spip_cache:description3' => '@puce@ L\'extension « Compresseur » présente dans SPIP permet de compacter les différents éléments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela accélère l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers à obtenir.', # NEW
	'spip_cache:nom' => 'SPIP et le cache…', # NEW
	'spip_ecran:description' => 'Détermine la largeur d\'écran imposée à tous en partie privée. Un écran étroit présentera deux colonnes et un écran large en présentera trois. Le réglage par défaut laisse l\'utilisateur choisir, son choix étant stocké dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'écran', # NEW
	'stat_auteurs' => 'Les auteurs en stat', # NEW
	'statuts_spip' => 'Uniquement les statuts SPIP suivants :', # NEW
	'statuts_tous' => 'Tous les statuts', # NEW
	'suivi_forums:description' => 'Un auteur d\'article est toujours informé lorsqu\'un message est publié dans le forum public associé. Mais il est aussi possible d\'avertir en plus : tous les participants au forum ou seulement les auteurs de messages en amont.[[%radio_suivi_forums3%]]', # NEW
	'suivi_forums:nom' => 'Suivi des forums publics', # NEW
	'supprimer_cadre' => 'Supprimer ce cadre', # NEW
	'supprimer_numero:description' => 'Applique la fonction SPIP supprimer_numero() à l\'ensemble des {{titres}} et des {{noms}} du site public, sans que le filtre supprimer_numero soit présent dans les squelettes.<br />Voici la syntaxe à utiliser dans le cadre d\'un site multilingue : <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>', # MODIF
	'supprimer_numero:nom' => 'Supprime le numéro', # NEW

	// T
	'titre' => 'Le Couteau Suisse', # NEW
	'titre_parent:description' => 'Au sein d\'une boucle, il est courant de vouloir afficher le titre du parent de l\'objet en cours. Traditionnellement, il suffirait d\'utiliser une seconde boucle, mais cette nouvelle balise #TITRE_PARENT allégera l\'écriture de vos squelettes. Le résultat renvoyé est : le titre du groupe d\'un mot-clé ou celui de la rubrique parente (si elle existe) de tout autre objet (article, rubrique, brève, etc.).

Notez : Pour les mots-clés, un alias de #TITRE_PARENT est #TITRE_GROUPE. Le traitement SPIP de ces nouvelles balises est similaire à celui de #TITRE.

@puce@ Si vous êtes sous SPIP 2.0, alors vous avez ici à votre disposition tout un ensemble de balises #TITRE_XXX qui pourront vous donner le titre de l\'objet \'xxx\', à condition que le champ \'id_xxx\' soit présent dans la table en cours (#ID_XXX utilisable dans la boucle en cours).

Par exemple, dans une boucle sur (ARTICLES), #TITRE_SECTEUR donnera le titre du secteur dans lequel est placé l\'article en cours, puisque l\'identifiant #ID_SECTEUR (ou le champ \'id_secteur\') est disponible dans ce cas.

La syntaxe <html>#TITRE_XXX{yy}</html> est également supportée. Exemple : <html>#TITRE_ARTICLE{10}</html> renverra le titre de l\'article #10.[[%titres_etendus%]]', # NEW
	'titre_parent:nom' => 'Balises #TITRE_PARENT/OBJET', # NEW
	'titre_tests' => 'Le Couteau Suisse - Page de tests…', # NEW
	'titres_typo:description' => 'Transforme tous les intertitres <html>« {{{Mon intertitre}}} »</html> en image typographique paramétrable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : « [.->sommaire] ».', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'tous' => 'Tous', # NEW
	'toutes_couleurs' => 'Les 36 couleurs des styles css :@_CS_EXEMPLE_COULEURS@', # NEW
	'toutmulti:aide' => 'Blocs multilingues : <b><:trad:></b>', # NEW
	'toutmulti:description' => 'Introduit le raccourci <code><:un_texte:></code> pour introduire librement des blocs multi-langues dans un article.
_ La fonction SPIP utilisée est : <code>_T(\'un_texte\', $flux)</code>.
_ N\'oubliez pas de vérifier que \'un_texte\' est bien défini dans les fichiers de langue.', # MODIF
	'toutmulti:nom' => 'Blocs multilingues', # NEW
	'travaux_masquer_avert' => 'Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours', # NEW
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'هذا الموقع سيعود قريباً جداً.
_ شكراً لتفهّمكم.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'En naviguant sur le site en partie privée ([->./?exec=auteurs]), choisissez ici le tri à utiliser pour afficher vos articles à l\'intérieur de vos rubriques.

Les propositions ci-dessous sont basées sur la fonctionnalité SQL \'ORDER BY\' : n\'utilisez le tri personnalisé que si vous savez ce que vous faites (champs disponibles : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'فرز SPIP',
	'tri_groupe' => 'الفرز حسب رقم المجمعة التسلسلي (ORDER BY id_groupe)',
	'tri_modif' => 'الفرز حسب تاريخ التعديل (ORDER BY date_modif DESC)',
	'tri_perso' => 'فرز شخصي، ORDER BY يسبق:',
	'tri_publi' => 'قرز حسب تاريخ النشر (ORDER BY date DESC)',
	'tri_titre' => 'الفرز حسب العنوان (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Outil en cours de développement. Vous offre quelques balises très simples et bien pratiques pour améliorer la lisibilité de vos squelettes.

@puce@ {{#BOLO}} : génère un faux texte d\'environ 3000 caractères ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction spécifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ Un modèle est également disponible pour vos contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caractères de faux texte.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction spécifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalisez l\'affichage grâce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

@puce@ {{#CHR<html>{XX}</html>}} : balise équivalente à <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caractères spéciaux (le retour à la ligne par exemple) ou des caractères réservés par le compilateur de SPIP (les crochets ou les accolades).

@puce@ {{#LESMOTS}} : ', # NEW
	'trousse_balises:nom' => 'محفظة العلامات',
	'type_urls:description' => '@puce@ SPIP offre un choix sur plusieurs jeux d\'URLs pour fabriquer les liens d\'accès aux pages de votre site :
<div style="font-size:90%; margin:0 2em;">
- {{page}} : la valeur par défaut pour SPIP v1.9x : <code>/spip.php?article123</code>.
- {{html}} : les liens ont la forme des pages html classiques : <code>/article123.html</code>.
- {{propre}} : les liens sont calculés grâce au titre: <code>/Mon-titre-d-article</code>.
- {{propres2}} : l\'extension \'.html\' est ajoutée aux adresses générées : <code>/Mon-titre-d-article.html</code>.
- {{standard}} : URLs utilisées par SPIP v1.8 et précédentes : <code>article.php3?id_article=123</code>
- {{propres-qs}} : ce système fonctionne en &quot;Query-String&quot;, c\'est-à-dire sans utilisation de .htaccess ; les liens sont de la forme : <code>/?Mon-titre-d-article</code>.</div>

Plus d\'infos : [->http://www.spip.net/fr_article765.html]
[[%radio_type_urls3%]]
<p style=\'font-size:85%\'>@_CS_ASTER@pour utiliser les formats {html}, {propre} ou {propre2}, Recopiez le fichier &quot;htaccess.txt&quot; du répertoire de base du site SPIP sous le sous le nom &quot;.htaccess&quot; (attention à ne pas écraser d\'autres réglages que vous pourriez avoir mis dans ce fichier) ; si votre site est en &quot;sous-répertoire&quot;, vous devrez aussi éditer la ligne &quot;RewriteBase&quot; ce fichier. Les URLs définies seront alors redirigées vers les fichiers de SPIP.</p>

@puce@ {{Uniquement si vous utilisez le format {page} ci-dessus}}, alors il vous est possible de choisir le script d\'appel à SPIP. Par défaut, SPIP choisit {spip.php}, mais {index.php} (format : <code>/index.php?article123</code>) ou une valeur vide (format : <code>/?article123</code>) fonctionnent aussi. Pour tout autre valeur, il vous faut absolument créer le fichier correspondant dans la racine de SPIP, à l\'image de celui qui existe déjà : {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ Si vous utilisez un format à base d\'URLs «propres»  ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), le Couteau Suisse peut :
<q1>• S\'assurer que l\'URL produite soit totalement {{en minuscules}}.</q1>[[%urls_minuscules%]]
<q1>• Provoquer l\'ajout systématique de {{l\'id de l\'objet}} à son URL (en suffixe, en préfixe, etc.).
_ (exemples : <code>/Mon-titre-d-article,457</code> ou <code>/457-Mon-titre-d-article</code>)</q1>', # NEW
	'type_urls:nom' => 'شكل عناوين URL',
	'typo_exposants:description' => 'Textes français : améliore le rendu typographique des abréviations courantes, en mettant en exposant les éléments nécessaires (ainsi, {<acronym>Mme</acronym>} devient {M<sup>me</sup>}) et en corrigeant les erreurs courantes ({<acronym>2ème</acronym>} ou  {<acronym>2me</acronym>}, par exemple, deviennent {2<sup>e</sup>}, seule abréviation correcte).
_ Les abréviations obtenues sont conformes à celles de l\'Imprimerie nationale telles qu\'indiquées dans le {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (article « Abréviations », presses de l\'Imprimerie nationale, Paris, 2002).', # MODIF
	'typo_exposants:nom' => 'النص الفوقي',

	// U
	'url_arbo' => 'هرمية@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'حرة@_CS_ASTER@',
	'url_page' => 'صفحة',
	'url_propres' => 'نظيفة@_CS_ASTER@',
	'url_propres-qs' => 'نظيفة_qs',
	'url_propres2' => 'propres2@_CS_ASTER@', # NEW
	'url_propres_qs' => 'نظيفة_qs',
	'url_standard' => 'قياسية',
	'urls_3_chiffres' => 'فرض ثلاثة أرقام كحد أدنى',
	'urls_avec_id' => 'وضعه في اللاحقة',
	'urls_avec_id2' => 'وضعه في السابقة',
	'urls_base_total' => 'Il y a actuellement @nb@ URL(s) en base', # NEW
	'urls_base_vide' => 'La base des URLs est vide', # NEW
	'urls_choix_objet' => 'Édition en base de l\'URL d\'un objet spécifique :', # NEW
	'urls_edit_erreur' => 'Le format actuel des URLs (« @type@ ») ne permet pas d\'édition.', # NEW
	'urls_enregistrer' => 'Enregistrer cette URL en base', # NEW
	'urls_id_sauf_rubriques' => 'Exclure les objets suivants (séparés par « : ») :', # NEW
	'urls_minuscules' => 'Lettres minuscules', # NEW
	'urls_nouvelle' => 'Éditer l\'URL « propres » :', # NEW
	'urls_num_objet' => 'Numéro :', # NEW
	'urls_purger' => 'Tout vider', # NEW
	'urls_purger_tables' => 'Vider les tables sélectionnées', # NEW
	'urls_purger_tout' => 'Réinitialiser les URLs stockées dans la base :', # NEW
	'urls_rechercher' => 'Rechercher cet objet en base', # NEW
	'urls_titre_objet' => 'Titre enregistré  :', # NEW
	'urls_type_objet' => 'Objet :', # NEW
	'urls_url_calculee' => 'URL publique « @type@ » :', # NEW
	'urls_url_objet' => 'URL « propres » enregistrée :', # NEW
	'urls_valeur_vide' => '(Une valeur vide entraine le recalcul de l\'URL)', # NEW

	// V
	'validez_page' => 'Pour accéder aux modifications :', # NEW
	'variable_vide' => '(Vide)', # NEW
	'vars_modifiees' => 'Les données ont bien été modifiées', # NEW
	'version_a_jour' => 'Votre version est à jour.', # NEW
	'version_distante' => 'Version distante...', # NEW
	'version_distante_off' => 'Vérification distante désactivée', # NEW
	'version_nouvelle' => 'Nouvelle version : @version@', # NEW
	'version_revision' => 'Révision : @revision@', # NEW
	'version_update' => 'Mise à jour automatique', # NEW
	'version_update_chargeur' => 'Téléchargement automatique', # NEW
	'version_update_chargeur_title' => 'Télécharge la dernière version du plugin grâce au plugin «Téléchargeur»', # NEW
	'version_update_title' => 'Télécharge la dernière version du plugin et lance sa mise à jour automatique', # NEW
	'verstexte:description' => '2 filtres pour vos squelettes, permettant de produire des pages plus légères.
_ version_texte : extrait le contenu texte d\'une page html à l\'exclusion de quelques balises élémentaires.
_ version_plein_texte : extrait le contenu texte d\'une page html pour rendre du texte plein.', # MODIF
	'verstexte:nom' => 'Version texte', # NEW
	'visiteurs_connectes:description' => 'Offre une noisette pour votre squelette qui affiche le nombre de visiteurs connectés sur le site public.

Ajoutez simplement <code><INCLURE{fond=fonds/visiteurs_connectes}></code> dans vos pages.', # NEW
	'visiteurs_connectes:nom' => 'Visiteurs connectés', # NEW
	'voir' => 'Voir : @voir@', # NEW
	'votre_choix' => 'Votre choix :', # NEW

	// W
	'webmestres:description' => 'Un {{webmestre}} au sens SPIP est un {{administrateur}} ayant accès à l\'espace FTP. Par défaut et à partir de SPIP 2.0, il est l\'administrateur <code>id_auteur=1</code> du site. Les webmestres ici définis ont le privilège de ne plus être obligés de passer par FTP pour valider les opérations sensibles du site, comme la mise à jour de la base de données ou la restauration d’un dump.

Webmestre(s) actuel(s) : {@_CS_LISTE_WEBMESTRES@}.
_ Administrateur(s) éligible(s) : {@_CS_LISTE_ADMINS@}.

En tant que webmestre vous-même, vous avez ici les droits de modifier cette liste d\'ids -- séparés par les deux points « : » s\'ils sont plusieurs. Exemple : «1:5:6».[[%webmestres%]]', # NEW
	'webmestres:nom' => 'Liste des webmestres', # NEW

	// X
	'xml:description' => 'Active le validateur xml pour l\'espace public tel qu\'il est décrit dans la [documentation->http://www.spip.net/fr_article3541.html]. Un bouton intitulé « Analyse XML » est ajouté aux autres boutons d\'administration.', # NEW
	'xml:nom' => 'Validateur XML' # NEW
);

?>
