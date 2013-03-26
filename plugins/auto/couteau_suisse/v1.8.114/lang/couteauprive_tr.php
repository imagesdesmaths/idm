<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=tr
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ' : hayır',
	'2pts_oui' => ' : evet',

	// S
	'SPIP_liens:description' => '@puce@ Sitedeki tüm bağlar aktüel sayfada açılır. Ama dış bağları yeni pencerede açmak kullanışlı olabilir -- cela revient à ajouter {target=\\"_blank\\"} à toutes les balises &lt;a&gt; dotées par SPIP des classes {spip_out}, {spip_url} ou {spip_glossaire}. Il est parfois nécessaire d\'ajouter l\'une de ces classes aux liens du squelette du site (fichiers html) afin d\'étendre au maximum cette fonctionnalité.[[%radio_target_blank3%]]

@puce@ SPIP permet de relier des mots à leur définition grâce au raccourci typographique <code>[?mot]</code>. Par défaut (ou si vous laissez vide la case ci-dessous), le glossaire externe renvoie vers l’encyclopédie libre wikipedia.org. À vous de choisir l\'adresse à utiliser. <br />Lien de test : [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP «~mailto:~» bağlantıları için bir CSS stil öngördü : e-posta bağlantılarının önünde küçük bir zarf görünecek; ama tüm gezginler bunu görüntüleyemeyeceği için (bjğllşmlğ IE6, IE7 et SAF3) bunu kullanıp kullanmamak size kalmış.
_ test bağlantısı : [->test@test.com] (sayfayı baştan yükleyin).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP ve dış bağlantılar',
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
	'SPIP_tailles:nom' => 'Limites mémoire', # NEW

	// A
	'acces_admin' => 'Yönetici erişimi :',
	'action_rapide' => 'Hızlı işlem, sadece ne yaptığınızdan eminseniz !',
	'action_rapide_non' => 'Hızlı işlem, bu alet etkinleştirildikten sonra :',
	'admins_seuls' => 'Sadece yöneticiler',
	'aff_tout:description' => 'Il parfois utile d\'afficher toutes les rubriques ou tous les auteurs de votre site sans tenir compte de leur statut (pendant la période de développement par exemple). Par défaut, SPIP n\'affiche en public que les auteurs et les rubriques ayant au moins un élément publié.

Bien qu\'il soit possible de contourner ce comportement à l\'aide du critère [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], cet outil automatise le processus et vous évite d\'ajouter ce critère à toutes les boucles RUBRIQUES et/ou AUTEURS de vos squelettes.', # NEW
	'aff_tout:nom' => 'Affiche tout', # NEW
	'alerte_urgence:description' => 'Affiche en tête de toutes les pages publiques un bandeau d\'alerte pour diffuser le message d\'urgence défini ci-dessous.
_ Les balises <code><multi/></code> sont recommandées en cas de site multilingue.[[%alerte_message%]]', # NEW
	'alerte_urgence:nom' => 'Message d\'alerte', # NEW
	'attente' => 'Beklemede...',
	'auteur_forum:description' => 'En azından bir mektup yazmış olan kamusal ileti yazarlarını, tüm katılımların isimsiz olmaması için «@_CS_FORUM_NOM@» alanını doldurmaya teşvik eder.', # MODIF
	'auteur_forum:nom' => 'Anonim (isimsiz) forum yok',
	'auteur_forum_deux' => 'Ou, au moins l\'un des deux champs précédents', # NEW
	'auteur_forum_email' => 'Le champ «@_CS_FORUM_EMAIL@»', # NEW
	'auteur_forum_nom' => 'Le champ «@_CS_FORUM_NOM@»', # NEW
	'auteurs:description' => 'Bu gereç[yazarlar sayfası->./?exec=auteurs]\'nın özel alandaki görünüşünü konfigüre eder.

@puce@ Yazarlar sayfasının ortasındaki ana çerçevede gösterilecek maksimum yazar sayısını belirtiniz. Bu sayıdan fazlası sayfalama ile gösterilir.[[%max_auteurs_page%]]

@puce@ Bu sayfada hangi yazar statüleri listelenecek  ?
[[%auteurs_tout_voir%]][[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]', # MODIF
	'auteurs:nom' => 'Yazarlar sayfası',
	'autobr:description' => 'Applique sur certains contenus SPIP le filtre {|post_autobr} qui remplace tous les sauts de ligne simples par un saut de ligne HTML <br />.[[%alinea%]][[->%alinea2%]]', # NEW
	'autobr:description1' => 'Rompant avec une tradition historique, SPIP 3 tient désormais compte par défaut des alinéas (retours de ligne simples) dans ses contenus. Vous pouvez ici désactiver ce comportement et revenir à l\'ancien système où le retour de ligne simple n\'est pas reconnu -- à l\'instar du langage HTML.', # NEW
	'autobr:description2' => 'Objets contenant cette balise (non exhaustif) :
- Articles : @ARTICLES@.
- Rubriques : @RUBRIQUES@.
- Forums : @FORUMS@.', # NEW
	'autobr:nom' => 'Retours de ligne automatiques', # NEW
	'autobr_non' => 'À l\'intérieur des balises &lt;alinea>&lt;/alinea>', # NEW
	'autobr_oui' => 'Articles et messages publics (balises @BALISES@)', # NEW
	'autobr_racc' => 'Retours de ligne : <b><alinea></alinea></b>', # NEW

	// B
	'balise_set:description' => 'Afin d\'alléger les écritures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqué à une variable passe donc dans le nom de la balise.

Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'Balise #SET étendue', # NEW
	'barres_typo_edition' => 'Edition des contenus', # NEW
	'barres_typo_forum' => 'Messages de Forum', # NEW
	'barres_typo_intro' => 'Le plugin «Porte-Plume» a été détecté. Veuillez choisir ici les barres typographiques où certains boutons seront insérés.', # NEW
	'basique' => 'Temel',
	'blocs:aide' => 'Katlanabilir bloklar : <b><bloc></bloc></b> (alias : <b><invisible></invisible></b>) et <b><visible></visible></b>',
	'blocs:description' => 'Tıklanabilir başlıklar sayesinde görünür veya görünmez olabilen bloklar oluşturmanıza olanak tanır.
@puce@ {{SPIP metinlerinde}} : yazarlar için yeni komutlar sunulmuştur &lt;bloc&gt; (ou &lt;invisible&gt;) ve &lt;visible&gt; bu komutlar metinlerde şu biçimde kullanılabilir : 

<quote><code>
<bloc>
 Tıklanabilir başlık
 
 Gösterilecek/gizlenecek metin, 2 satır boşluk...
 </bloc>
</code></quote>

@puce@ {{İskeletlerde}} : yeni komutlar şunlardır #BLOC_TITRE, #BLOC_DEBUT ve #BLOC_FIN , şu biçimde kullanabilirsiniz : 
<quote><code> #BLOC_TITRE veya #BLOC_TITRE{bana_ait_URL}
 Bana ait başlık
 #BLOC_RESUME    (seçimlik)
 takip eden bloğun bir özeti
 #BLOC_DEBUT
 Katlanabilir bloğum (istenirse hedef URL\'yi gösterecektir)
 #BLOC_FIN</code></quote>
', # MODIF
	'blocs:nom' => 'Katlanabilir Bloklar (Dépliables)',
	'boites_privees:description' => 'Aşağıda tanımlanan tüm kutular özel alanda görünürler. [[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]]
- {{İsviçre Çakısı gözden geçirmeleri}} : ([Source->@_CS_RSS_SOURCE@]) eklentisinin kodlarında yapılan son değişiklikler aktüel konfigürasyon sayfasında bir çerçeve içinde gösterilirler.
- {{SPIP formatındaki makaleler}} : yazarları tarafından kullanılan kaynak kodları görebilmeniz için katlanabilir ek bir çerçeve.
- {{stat durumundaki yazarlar}} : [yazarlar sayfasında->./?exec=auteurs] bağlanan son 10 kullanıcıyı ve onaylanmamış kayıtları gösteren ğm bir çerçeve. Bu bilgileri sadece yöneticiler görebilir.', # MODIF
	'boites_privees:nom' => 'Özel kutular',
	'bp_tri_auteurs' => 'Yazar sıralamaları',
	'bp_urls_propres' => 'Kişisel URL\'ler',
	'brouteur:description' => 'AJAX\'ta %rubrique_brouteur% başlıklarından yola çıkarak başlık seçicisini kullanmak', # MODIF
	'brouteur:nom' => 'Başlık seçisinin ayarlanması', # MODIF

	// C
	'cache_controle' => 'Önbellek kontrolü',
	'cache_nornal' => 'Normal kullanım',
	'cache_permanent' => 'Kalıcı önbellek',
	'cache_sans' => 'Önbellek yok',
	'categ:admin' => '1. Yönetim',
	'categ:devel' => '55. Développement', # NEW
	'categ:divers' => '6. Diğer',
	'categ:interface' => '10. Özel arayüz',
	'categ:public' => '4. Kamusal gösterim',
	'categ:securite' => '5. Sécurité', # NEW
	'categ:spip' => '5. Komutlar, filtreler, kriterler',
	'categ:typo-corr' => '2. Metin geliştirmeleri',
	'categ:typo-racc' => '3. Tipografik Kısaltmalar',
	'certaines_couleurs' => 'Sadece aşağıda tanımlanan komutlar @_CS_ASTER@ :',
	'chatons:aide' => '"Chaton"lar : @liste@',
	'chatons:description' => '<code>:nom</code> tipinden zincirler bulunan tüm metinlere resim veya ({chat} için "chaton") ekler.
_ Bu alet kısayolları plugins/couteau_suisse/img/chatons dizininde bulacağı aynı isimdeki resimlerle değiştirir.', # MODIF
	'chatons:nom' => '"Chaton"lar',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de votre site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour à la ligne. En effet, les citations courtes doivent être entourées par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.', # NEW
	'citations_bb:nom' => 'Citations bien balisées', # NEW
	'class_spip:description1' => 'Burada bazı SPIP kısayollarını tanımlayabilirsiniz. Boş bir değer "Varsayılanı kullan" anlamındadır.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{SPIP kısayolları}}.

Burada bazı SPIP kısayollarını tanımlayabilirsiniz. Boş değer varsayılan değerin kullanılması demektir.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

SPIP normalde ara başlıklar için &lt;h3&gt; komutunu kullanır. Burada başka bir komut seçiniz :[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP koyuluk için &lt;strong> komutunu kullanmayı tercih etmiştir. Ama &lt;b> komutu da gayet uygun olur. Bu size kalmış :[[%racc_g1%]][[->%racc_g2%]]

SPIP italik için &lt;i> komutunu kullanmayı tercih etmiştir. Ama &lt;em> komutu da gayet uygun olur. . Bu size kalmış :[[%racc_i1%]][[->%racc_i2%]]

 Dipnotlar için komut açan ve kapatan kodları da siz belirleyebilirsiniz. (Dikkat ! Değişiklikler yalnız kamusal alanda görünür.) : [[%ouvre_ref%]][[->%ferme_ref%]]
 
@puce@ {{Varsayılan SPIP stilleri}}. 1.92 sürümüne kadar, tipografik kısayollar hep \\"spip\\" tipinde komutlar üretiyordu. Örneğin: <code><p class=\\"spip\\"></code>. Burada komut stillerini stil sayfalarınıza göre tanımlayabilirsiniz. Boş bir kutu hiçbir stil uygulanmayacağını gösterir.

{Dikkat : eğer yukarıda (yatay çizgi, ara başlık, italik, koyu) gibi kısayollar değiştirilirse aşağıda stiller uygulanmayacaktır.}

<q1>
_ {{1.}} &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]] komutları
_ {{2.}} &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; et les listes (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]] komutları
 
Önemli : 2. stili değiştirirseniz SPIP\'in bu komutlara bağlı stillerini kaybedersiniz.</q1>', # MODIF
	'class_spip:nom' => 'SPIP ve kısayolları…',
	'code_css' => 'CSS',
	'code_fonctions' => 'İşlevler',
	'code_jq' => 'jQuery',
	'code_js' => 'Javascript',
	'code_options' => 'Seçenekler',
	'code_spip_options' => 'SPIP seçenekleri',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie privée', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options précédentes)', # NEW
	'contrib' => 'Daha fazla bilgi : @url@',
	'copie_vers' => 'Copie vers : @dir@', # NEW
	'corbeille:description' => 'SPIP supprime automatiquement les objets mis au rebuts au bout de 24 heures, en général vers 4 heures du matin, grâce à une tâche «CRON» (lancement périodique et/ou automatique de processus préprogrammés). Vous pouvez ici empêcher ce processus afin de mieux gérer votre corbeille.[[%arret_optimisation%]]',
	'corbeille:nom' => 'Çöp kutusu',
	'corbeille_objets' => 'Çöp kutusunda @nb@ nesne var.',
	'corbeille_objets_lies' => '@nb_lies@ bağ görüldü.',
	'corbeille_objets_vide' => 'Çöp kutusunda hiç nesne yok', # MODIF
	'corbeille_objets_vider' => 'Seçilen nesneleri sil',
	'corbeille_vider' => 'Çöp kutusunu boşalt :',
	'couleurs:aide' => 'Renklendirme : <b>[coul]metin[/coul]</b>@fond@ ile <b>coul</b> = @liste@',
	'couleurs:description' => 'Kısayolların içinde komutlar kullanarak sitedeki tüm metinlere renk uygulanmasına olanak tanır (makaleler, kısa haberler, başlıklar, forum, ...).

Metin rengini değiştirmek için 2 eşdeğer örnek:@_CS_EXEMPLE_COULEURS2@

Fon rengini değiştirmek için (eğer yukarıdaki seçenek izin veriyorsa) :@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@Bu kişiselleştirilmiş komutların formatı mevcut renkleri listelemeli veya «komut=renk» ikililerini virgülle ayrılmış biçimde tanımlamalıdır. Örnek : «gris, rouge», «faible=jaune, fort=rouge», «bas=#99CC11, haut=brown» veya «gris=#DDDDCC, rouge=#EE3300». İlk ve son örnekler için izin verilen komutlar şunlardır : <code>[gris]</code> ve <code>[rouge]</code> (<code>[fond gris]</code> ve <code>[fond rouge]</code> - eğer fona izin verilmişse -).', # MODIF
	'couleurs:nom' => 'Hepsi renkli',
	'couleurs_fonds' => ', <b>[fond coul]metin[/coul]</b>, <b>[bg coul]metin[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Log\'lar.}} {@_CS_DIR_TMP@} [[%log_couteau_suisse%]] dizininde  bulabileceğiniz {spip.log} dosyalarında İsviçre Çakısı\'nın işleyişi hakkında çok sayıda bilgi edinebilirsiniz.

@puce@ {{SPIP seçenekleri.}} SPIP eklentileri belirli bir sırada düzenler. İsviçre Çakısı\'nın en başta  olmasını bazı SPIP seçeneklerini idare etmesini sağlamak için şu seçeneği işaretleyiniz. Eğer hizmet biriminiz izin veriyorsa {@_CS_FILE_OPTIONS@} dosyası otomatik olarak değiştirilecek ve {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php} dosyasının eklenmesine izin verecektir.
[[%spip_options_on%]]

@puce@ {{Dış sorgular.}} İsviçre Çakısı yeni bir sürümünün olup olmadığını düzenli olarak kontrol eder ve yapılandırma sayfasında olası güncellemeleri bildirir. Eğer hizmet biriminizin dış sorguları problem yaratıyorsa o zaman şu kutucuğu işaretleyin.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'İsviçre Çakısı davranışları',
	'cs_comportement_ko' => '{{Note :}} ce paramètre requiert un filtre de gravité réglé à plus de @gr2@ au lieu de @gr1@ actuellement.', # NEW
	'cs_distant_off' => 'Uzaktan sürümlerin doğrulanması',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => 'İsviçre Çakısının detaylı kayıtları',
	'cs_reset' => 'İsviçre Çakısı\'nı baştan başlatmak istediğinizden emin misiniz ?',
	'cs_reset2' => 'Şu anda aktif olan tüm gereçler pasif hale getirilecek ve parametreleri sıfırlanacaktır.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher «<html>@_CS_FILE_OPTIONS@</html>» a échoué !', # NEW
	'cs_spip_options_on' => '«@_CS_FILE_OPTIONS@» içindeki SPIP seçenekleri', # MODIF

	// D
	'decoration:aide' => 'Dekorasyon : <b>&lt;balise&gt;test&lt;/balise&gt;</b> ile <b>balise</b> = @liste@',
	'decoration:description' => 'De nouveaux styles paramétrables dans vos textes et accessibles grâce à des balises à chevrons. Exemple : 
&lt;mabalise&gt;texte&lt;/mabalise&gt; ou : &lt;mabalise/&gt;.<br />Définissez ci-dessous les styles CSS dont vous avez besoin, une balise par ligne, selon les syntaxes suivantes :
- {type.mabalise = mon style CSS}
- {type.mabalise.class = ma classe CSS}
- {type.mabalise.lang = ma langue (ex : fr)}
- {unalias = mabalise}

Le paramètre {type} ci-dessus peut prendre trois valeurs :
- {span} : balise à l\'intérieur d\'un paragraphe (type Inline)
- {div} : balise créant un nouveau paragraphe (type Block)
- {auto} : balise déterminée automatiquement par le plugin

[[%decoration_styles%]]', # NEW
	'decoration:nom' => 'Dekorasyon',
	'decoupe:aide' => 'Tırnak bloğu : <b>&lt;onglets>&lt;/onglets></b><br/>Sayfa veya tırnak ayracı : @sep@', # MODIF
	'decoupe:aide2' => 'Alias : @sep@',
	'decoupe:description' => 'Bir makalenin, otomatik bir sayfalama ile kamusal alanda bir kaç sayfaya bölünerek gösterilmesini sağlar. Makalenizde sadece peşpeşe artı işaretlerini(<code>++++</code>) kesinti yapılacak yerde kullanın.
_ Eğer bu ayracı &lt;onglets&gt; ve &lt;/onglets&gt; komutlarıyla kullanırsanız bir çift tırnak elde edersiniz.
_ İskeletlerde : şu yeni komutlara sahipsiniz #ONGLETS_DEBUT, #ONGLETS_TITRE ve #ONGLETS_FIN.
_ Bu gereç {makaleleriniz için bir özet} ile birlikte kullanılabilir.', # MODIF
	'decoupe:nom' => 'Sayfalara ve başlıklara ayır',
	'desactiver_flash:description' => 'Sitenizin web sayfalarındaki flash nesneleri siler ve ilintili alternatif içerikler değiştiri.',
	'desactiver_flash:nom' => 'Flash nesnelerini deaktive eder',
	'detail_balise_etoilee' => '{{Dikkat}} : Vérifiez bien l\'utilisation faite par vos squelettes des balises étoilées. Les traitements de cet outil ne s\'appliqueront pas sur : @bal@.',
	'detail_disabled' => 'Paramètres non modifiables :', # NEW
	'detail_fichiers' => 'Dosyalar :',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'Inline kod :',
	'detail_jquery2' => 'Bu alet {jQuery} kütüphanesini gerektirir.', # MODIF
	'detail_jquery3' => '{{Dikkat}} : bu gereç sorunsuz çalışabilmek için [SPIP 1.92-için jQuery>http://files.spip.org/spip-zone/jquery_192.zip] eklentisi gerektirir.',
	'detail_pipelines' => 'Boru hatları (pipeline) :',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_spip_options2' => 'Il est recommandé de placer les options SPIP en amont grâce à l\'outil «[.->cs_comportement]».', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_surcharge' => 'Outil surchargé :', # NEW
	'detail_traitements' => 'İşlemler :',
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
	'docgen' => 'Documentation générale', # NEW
	'docwiki' => 'Carnet d\'idées', # NEW
	'dossier_squelettes:description' => 'Kullanılan iskelet dizinini değiştirir. Örneğin : "squelettes/iskeletim". Dizinleri iki nokta ile ayırarak bir çok dizin belirtebilirsiniz  <html>« : »</html>. İzleyen kutuyu boş bırakarak (veya "dist" yazarak) SPIP tarafından sunulan orijinal "dist" iskeletini kullanabilirsiniz. [[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'İskelet dosyası',

	// E
	'ecran_activer' => 'Activer l\'écran de sécurité', # NEW
	'ecran_conflit' => 'Attention : le fichier statique «@file@» peut entrer en conflit. Choisissez votre méthode de protection !', # NEW
	'ecran_conflit2' => 'Note : un fichier statique «@file@» a été détecté et activé. Le Couteau Suisse ne pourra peut-être pas le mettre à jour ou le configurer.', # NEW
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
	'effaces' => 'Silinmiş',
	'en_travaux:description' => 'Tüm kamusal sitede bakım yapılırken kişiselleştirilebilir bir mesaj yayınlanmasını sağlar.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]]', # MODIF
	'en_travaux:nom' => 'Sitede çalışma var',
	'erreur:bt' => '<span style="color:red;">Dikkat :</span> tipografik çizgi (sürüm @version@) artık eskidi.<br />İsviçre Çakısı @mini@ veya daha yeni bi rsürüm ile uyumludur.', # MODIF
	'erreur:description' => 'Alet tanımında id eksik !',
	'erreur:distant' => 'uzak sunucu',
	'erreur:jquery' => '{{Not}} : {jQuery} kütüphanesi bu sayfada pasif durumda görülüyor. Eklentinin bağımlılıkları paragrafına bakınız [->http://www.spip-contrib.net/?article2166].',
	'erreur:js' => 'bu sayfada bir JavaScript hatası oluştu ve sayfanın doğru çalışmasını engelliyor. Lütfen gezgininizde JavaScript\'i aktive edin veyasitenizdeki bazı SPIP eklentilerini deaktive edin.',
	'erreur:nojs' => 'JavaScript bu sayfada deaktive edilmiş.',
	'erreur:nom' => 'Hata !',
	'erreur:probleme' => 'Sorun var : @pb@',
	'erreur:traitements' => 'İsviçre Çakısı - Derleme hatası : \'typo\' ve \'propre\' karışımı yasaktır !',
	'erreur:version' => 'Bu gereç SPIP\'in bu sürümünde mevcut değil.',
	'erreur_groupe' => 'Attention : le groupe «@groupe@» n\'est pas défini !', # NEW
	'erreur_mot' => 'Attention : le mot-clé «@mot@» n\'est pas défini !', # NEW
	'etendu' => 'Kapsam',

	// F
	'f_jQuery:description' => '{jQuery}\'nin kamusal alana kurulmasını engeller, böylece «makine zamanı»ndan biraz ekonomi yapar. Bu ([->http://jquery.com/]) kitaplığı Javascript programlamada bir çok kolaylık getirir ve bazı eklentilerde kullanılabilir. SPIP, Jquery\'yi özel alanda kullanır.

Dikkat : bazı İsviçre Çakısı gereçleri {jQuery} fonksiyonlarına ihtiyaç duyar. ', # MODIF
	'f_jQuery:nom' => 'jQuery\'yi deaktive eder',
	'filets_sep:aide' => 'Ayırma Fileleri (Filet) : <b>__i__</b>  <b>i</b> burada bir sayıyı temsil eder.<br />Diğer fileler : @liste@', # MODIF
	'filets_sep:description' => 'Tüm SPIP etinlerine, stil sayfaları ile kişiselleştirilebilen ayırma filet\'leri ekler.
_ Cümle yapısı şöyledir : "__code__", burada "code" ya eklenecek filet\'nin (0\'dan 7\'ye kadar) kimlik sayısını ya da plugins/couteau_suisse /img/filets dizinine yerleştirilen resmin ismini belirtir.', # MODIF
	'filets_sep:nom' => 'Ayırma Filesi (Filet)',
	'filtrer_javascript:description' => 'Makalelerde javascript kullanımı için 3 metod vardır :
- <i>jamais</i> : javascript her yerde reddedilir
- <i>défaut</i> : javascript özel alanda kırmızı ile belirtilir 
- <i>toujours</i> : javascript her yerde kabûl edilir.

Dikkat : forumlarda, dilekçelerde, paylaşılan akılarda ve benzerlerinde javascript\'in yönetimi <b>daima</b> güvenlidir.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Javascript yönetimi',
	'flock:description' => 'PHP fonksiyonunu nötralize ederek {flock()} dosya kilitleme sistemini deaktive eder. Bazı barındırma firmaları uyumsuz dosya sistemi veya senkronizasyon eksikliği yüzünden büyük sorunlara yol açmaktadır. Eğer siteniz normal çalışıyorsa bunu aktive etmeyin.',
	'flock:nom' => 'Dosya kilitleme yok',
	'fonds' => 'Arka alanlar :',
	'forcer_langue:description' => 'Dil cookie\'sini yönetmeyi bilen bir dil menüsü veya bir form içeren çok dilli iskelet takımına sahip dile zorla', # MODIF
	'forcer_langue:nom' => 'Bu dile zorla',
	'format_spip' => 'SPIP formatında makaleler',
	'forum_lgrmaxi:description' => 'Varsayılan olarak, forum mesajlarının boyu sınırlanmamıştır. Bu gereç aktive edildiğinde, bir kullanıcı belirtilen boydan daha uzun bir mesaj göndermek istediğinde bir hata mesajı görülecektir ve mesaj reddedilecektir. Boş bir değer veya Sıfır değeri hiçbir sınır uygulanmadığını belirtir. [[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Forumların boyutu',

	// G
	'glossaire:aide' => 'Özetsiz metin : <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Gestion d’un glossaire interne lié à un ou plusieurs groupes de mots-clés. Inscrivez ici le nom des groupes en  les séparant par les deux points « : ». En laissant vide la case qui  suit (ou en tapant "Glossaire"), c’est le groupe "Glossaire" qui sera utilisé.[[%glossaire_groupes%]]

@puce@ Pour chaque mot, vous avez la possibilité de choisir le nombre maximal de liens créés dans vos textes. Toute valeur nulle ou négative implique que tous les mots reconnus seront traités. [[%glossaire_limite% par mot-clé]]

@puce@ Deux solutions vous sont offertes pour générer la petite fenêtre automatique qui apparaît lors du survol de la souris. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'İç endeks',
	'glossaire_abbr' => 'Ignorer les balises <code><abbr></code> et <code><acronym></code>', # NEW
	'glossaire_css' => 'CSS çözümü',
	'glossaire_erreur' => 'Le mot «@mot1@» rend indétectable le mot «@mot2@»', # NEW
	'glossaire_inverser' => 'Correction proposée : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Javascript çözümü',
	'glossaire_ok' => 'La liste des @nb@ mot(s) étudié(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Normal tırnak işaretlerini (") tipografik tırnak işaretleriyle değiştirir. Değiştirme kullanıcı tarafından görülmez ve orijinal metni etkilemez sadece gösterilen metni etkiler.',
	'guillemets:nom' => 'Tipografik tırnaklar',

	// H
	'help' => '{{Bu sayfa yalnız site sorumlularının erişimine açıktır.}} «{{İsviçre Çakısı}}» eklentisinin getirdiği farklı bir çok ek işlevin düzenlenmesine izin verir .',
	'help2' => 'Yerel sürüm : @version@',
	'help3' => 'Belgelendirme bağlantıları :<br/>• [İsviçre Çakısı->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Yeniden başlatılması :
_ • [Gizli gereçlerin|Bu sayfanın ilk görünümüne dönülmesi->@hide@]
_ • [Tüm eklentinin|Eklentini ilk durumuna dönülmesi->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Geliştirilmekte olan gereç. Size JavaScript bir saat sunuyor. Komut: <code>#HORLOGE{format,utc,id}</code>. Model : <code><horloge></code>', # MODIF
	'horloge:nom' => 'Saat',

	// I
	'icone_visiter:description' => 'Standart « Ziyaret Et » düğmesini (bu sayfanın sağ üstündeki) eğer varsa site logosu ile değiştirir.

Bu logoyu tanımlamak için « Konfigürasyon » düğmesine tıklayarak « Site konfigürasyonu » sayfasına gidiniz.', # MODIF
	'icone_visiter:nom' => '« Ziyaret Et » düğmesi', # MODIF
	'insert_head:description' => '[#INSERT_HEAD->http://www.spip.net/fr_article1902.html] komutunu (bu komutu &lt;head&gt; ve &lt;/head&gt; arasında içerseler de içermeseler de) tüm iskeletlerde etkinleştirir . Bu seçenek sayesinde eklentiler javascript (.js) veya stil sayfası (.css) ekleyebilirler.',
	'insert_head:nom' => '#INSERT_HEAD komutu',
	'insertions:description' => 'DiKKAT : geliştirilmekte olan gereç !! [[%insertions%]]',
	'insertions:nom' => 'Otomatik düzeltmeler',
	'introduction:description' => 'İskeletlere yerleştirilecek bu komut genelde ana sayfaya veya başlıklarda makalelerin veya kısa haberlerin bir &ouml;zetini oluşturmaya yarar.</p>
<p>{{Dikkat}} : Bu işlevi aktive etmeden &ouml;nce iskeletinizde veya eklentilerinizde hi&ccedil;bir {balise_INTRODUCTION()} fonksiyonunun  olmadığından emin olun, aksi halde derleme hatası oluşacaktır.</p>
@puce@ #INTRODUCTION komutu tarafından g&ouml;nderilen metnin uzunluğunu (varsayılan değere g&ouml;re y&uuml;zde olarak) belirtebilirsiniz. Boş bir değer veya 100 değeri metni değiştirmeyecektir ve şu varsayılan değerleri kullanacaktır : makaleler i&ccedil;in 500 karakter, kısa haberler i&ccedil;in 300karakter, forumlar veya başlıklar i&ccedil;in 600 karakter.
[[%lgr_introduction%&nbsp;%]]
@puce@ Eğer metin &ccedil;ok uzunsa, #INTRODUCTION komutuna eklenen varsayılan &uuml;&ccedil; nokta ş&ouml;yledir : <html>&laquo;&amp;nbsp;(…)&raquo;</html>. Burada, metnin kesildiğini ve devamı olduğunu siz kendi &ouml;zel karakter zincirinizi kullanarak okuyucularınıza belirtebilirsiniz.
[[%suite_introduction%]]
@puce@ #INTRODUCTION komutu bir makaleyi &ouml;zetlemek i&ccedil;in kulanılmışsa İsvi&ccedil;re &Ccedil;akısı &uuml;&ccedil; noktaların &uuml;zerine bir hipermetin oluşturarak okuru orijinal metne y&ouml;nlendirir. &Ouml;rneğin : &laquo;Makalenin devamı i&ccedil;in…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => '#INTRODUCTION komutu',

	// J
	'jcorner:description' => '« Jolis Coins »  {{renkli çerçevelerinizin}} köşelerinin biçimini kolayca değiştirebileceğiniz bir kamusal alan gerecidir. Her şey mümkündür en azından bir çok şeymümkündür!
_ Şu sayfada sonuçları  : [->http://www.malsup.com/jquery/corner/].

CSS cümle yapısını kullanarak iskeletinizdeki nesneleri aşağıda listeleyiniz (.class, #id, vs. ). Kullanılacak jQuery komutunu belirtmek için « = » işaretini kullanınız ve açıklamalar için çift kesme (« // ») kullanınız. Eşit işareti olmazsa yuvarlak köşeler uygulanır (yani şuna denk olur : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Dikkat, bu gereç çalışmak için {Round Corners} {jQuery} eklentisine gereksinim duyar. İsviçre Çakısı [[%jcorner_plugin%]] kutusu işaretlendiğinde bu eklentiyi otomatik olarak yükler.', # MODIF
	'jcorner:nom' => 'Jolis Coins',
	'jcorner_plugin' => '« Round Corners plugin »',
	'jq_localScroll' => 'jQuery.LocalScroll ([démo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([démo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Varsayılan',
	'js_jamais' => 'Asla',
	'js_toujours' => 'Daima',
	'jslide_aucun' => 'Aucune animation', # NEW
	'jslide_fast' => 'Glissement rapide', # NEW
	'jslide_lent' => 'Glissement lent', # NEW
	'jslide_millisec' => 'Glissement durant :', # NEW
	'jslide_normal' => 'Glissement normal', # NEW

	// L
	'label:admin_travaux' => 'Kamusal alanı şuna kapat :',
	'label:alinea' => 'Champ d\'application :', # NEW
	'label:alinea2' => 'Sauf :', # NEW
	'label:alinea3' => 'Désactiver la prise en compte des alinéas :', # NEW
	'label:arret_optimisation' => 'SPIP\'in çöp kutusunu otomatik olarak boşaltmasını engelle :',
	'label:auteur_forum_nom' => 'Le visiteur doit spécifier :', # NEW
	'label:auto_sommaire' => 'Özet\'in sistemli biçimde oluşturulması :',
	'label:balise_decoupe' => '#CS_DECOUPE komutunu aktive et :',
	'label:balise_sommaire' => '#CS_SOMMAIRE komutunu aktive et :',
	'label:bloc_h4' => 'Başlıklar için komut :',
	'label:bloc_unique' => 'Sayfada sadece bir blok açık :',
	'label:blocs_cookie' => 'Kurabiye kullanımı :',
	'label:blocs_slide' => 'Type d\'animation :', # NEW
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal réservé aux copies locales :', # NEW
	'label:couleurs_fonds' => 'Arka alanlara izin ver :',
	'label:cs_rss' => 'Aktive et :',
	'label:debut_urls_propres' => 'URL\'lerin başlangıcı :',
	'label:decoration_styles' => 'Kişiselleştirilmiş stil komutlarınız :',
	'label:derniere_modif_invalide' => 'Bir değişiklikten sonra yeniden hesapla :',
	'label:devdebug_espace' => 'Filtrage de l\'espace concerné :', # NEW
	'label:devdebug_mode' => 'Activer le débogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoyé :', # NEW
	'label:distant_off' => 'Pasif kıl :',
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Kullanılacak dizinler :',
	'label:duree_cache' => 'Yerel önbelleğin süresi :',
	'label:duree_cache_mutu' => 'Ön bellek süresi :',
	'label:enveloppe_mails' => 'E-postaların önündeki küçük zarf :',
	'label:expo_bofbof' => 'Şu karakterleri üssel hale getirir : <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:filtre_gravite' => 'Gravité maximale acceptée :', # NEW
	'label:forum_lgrmaxi' => 'Değer (karakter cinsinden) :',
	'label:glossaire_groupes' => 'Kullanılan gruplar :',
	'label:glossaire_js' => 'Kullanılan teknik :',
	'label:glossaire_limite' => 'Oluşturulan maksimum bağ :',
	'label:i_align' => 'Alignement du texte :', # NEW
	'label:i_couleur' => 'Couleur de la police :', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (éq. à {line-height}) :', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte :', # NEW
	'label:i_padding' => 'Espacement autour du texte (éq. à {padding}) :', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/}) :', # NEW
	'label:i_taille' => 'Taille de la police :', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Otomatik düzeltmeler :',
	'label:jcorner_classes' => 'Şu seçicilerin köşelerini geliştirir :',
	'label:jcorner_plugin' => 'Şu {jQuery} eklentisini yükle :',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'Özet\'in uzunluğu :',
	'label:lgr_sommaire' => 'Özet\'in büyüklüğü (9 à 99) :',
	'label:lien_introduction' => 'Tıklanabilir üç nokta :',
	'label:liens_interrogation' => 'Şu URL\'leri koru :',
	'label:liens_orphelins' => 'Tıklanabilir bağlar :',
	'label:log_couteau_suisse' => 'Aktive et :',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:long_url' => 'Longueur du libellé cliquable :', # NEW
	'label:marqueurs_urls_propres' => 'Nesneleri ayıran ayraçları ekle (SPIP>=2.0) :<br/>(ör. : « - » -Benim-başlığım- için, « @ » @Benim-sitem@ için) ', # MODIF
	'label:max_auteurs_page' => 'Bir sayfadaki yazar adedi :',
	'label:message_travaux' => 'Bakım mesajınız :',
	'label:moderation_admin' => 'Mesajları otomatik olarak onaylanacaklar : ',
	'label:mot_masquer' => 'Mot-clé masquant les contenus :', # NEW
	'label:nombre_de_logs' => 'Rotation des fichiers :', # NEW
	'label:ouvre_note' => 'Dipnotların açılıp kapatılması',
	'label:ouvre_ref' => 'Dipnot çağrılarının açılıp kapatılması',
	'label:paragrapher' => 'Daima paragraflanmalı :',
	'label:prive_travaux' => 'Özel alana erişim :',
	'label:prof_sommaire' => 'Profondeur retenue (1 à 4) :', # NEW
	'label:puce' => 'Kamusal ikon «<html>-</html>» :',
	'label:quota_cache' => 'Kota değeri :',
	'label:racc_g1' => '«<html>{{koyu}}</html>» giriş çıkışı :',
	'label:racc_h1' => ' «<html>{{{intertitre}}}</html>» giriş çıkışı :',
	'label:racc_hr' => 'Yatay çizgi «<html>----</html>» :',
	'label:racc_i1' => '«<html>{italik}</html>» giriş çıkışı:',
	'label:radio_desactive_cache3' => 'Önbellek kullanımı :',
	'label:radio_desactive_cache4' => 'Önbellek kullanımı :',
	'label:radio_target_blank3' => 'Dış bağlar için yeni pencere:',
	'label:radio_type_urls3' => 'URL\'lerin formatı :',
	'label:scrollTo' => 'Eklentileri {jQuery} kur :',
	'label:separateur_urls_page' => 'Ayraç \'type-id\'<br/>(ör. : ?article-123) :', # MODIF
	'label:set_couleurs' => 'Kullanılacak set :',
	'label:spam_ips' => 'Adresses IP à bloquer :', # NEW
	'label:spam_mots' => 'Yasaklanan diziler :',
	'label:spip_options_on' => 'Ekle :',
	'label:spip_script' => 'Çağrı script\'i :',
	'label:style_h' => 'Stiliniz :',
	'label:style_p' => 'Stiliniz :',
	'label:suite_introduction' => 'Üç nokta  :',
	'label:terminaison_urls_page' => 'URL soyadları (ör : « .html ») :',
	'label:titre_travaux' => 'Mesajın başlığı :',
	'label:titres_etendus' => '#TITRE_XXX komutlarının geniş kullanımını etkinleştir  :',
	'label:tout_rub' => 'Afficher en public tous les objets suivants :', # NEW
	'label:url_arbo_minuscules' => 'URL\'lerde küçük büyük harfleri koru :',
	'label:url_arbo_sep_id' => 'Tekrarlama durumunda kullanılacak ayraç \'titre-id\' :<br/>(\'/\' kullanmayın)', # MODIF
	'label:url_glossaire_externe2' => 'Dış sözlüğe bağ :',
	'label:url_max_propres' => 'Longueur maximale des URLs (caractères) :', # NEW
	'label:urls_arbo_sans_type' => 'URL\'lerde SPIP nesnesinin tipini göster :',
	'label:urls_avec_id' => 'Sistematik bir kimlik, ama ...',
	'label:webmestres' => 'Site yöneticilerinin listesi :',
	'liens_en_clair:description' => 'Met à votre disposition le filtre : \'liens_en_clair\'. Votre texte contient probablement des liens hypertexte qui ne sont pas visibles lors d\'une impression. Ce filtre ajoute entre crochets la destination de chaque lien cliquable (liens externes ou mails). Attention : en mode impression (parametre \'cs=print\' ou \'page=print\' dans l\'url de la page), cette fonctionnalité est appliquée automatiquement.', # NEW
	'liens_en_clair:nom' => 'Açıkta bırakılmış bağlar',
	'liens_orphelins:description' => 'Bu gerecin 2 işlevi vardır:

@puce@ {{Doğru bağlar}}.

SPIP, fransız gramerine bağlı olarak soru ve ünlem işaretlerinden önce bir boşluk bırakır. İşte size metinlerinizde bulunan URL\'lerdeki soru işaretlerini koruyan bir gereç.[[%liens_interrogation%]]

@puce@ {{Yetim bağlar}}.

Kullanıcılar tarafından metin olarak bırakılmış \'tıklanamayan\' tüm URL\'leri sistemli biçimde SPIP formatında hipermetin bağlarıyla değiştirir (özellikle forumlarda). Örneğin : {<html>www.spip.net</html>} [->www.spip.net] ile değiştirilir.

Değiştirme tipini siz seçebilirsiniz :
_ • {Temel} : {<html>http://spip.net</html>} (tüm  protokoller) veya  {<html>www.spip.net</html>} değiştirilir.
_ • {Yaygın} : şu tipteki bağlar da değiştirilir {<html>moi@spip.net</html>}, {<html>mailto:monmail</html>} veya {<html>news:mesnews</html>}.
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:description1' => '[[Si l\'URL rencontrée dépasse les %long_url% caractères, alors SPIP la réduit à %coupe_url% caractères]].', # NEW
	'liens_orphelins:nom' => 'Güzel URL\'ler',
	'local_ko' => 'La mise à jour automatique du fichier local «@file@» a échoué. Si l\'outil dysfonctionne, tentez une mise à jour manuelle.', # NEW
	'log_brut' => 'Données écrites en format brut (non HTML)', # NEW
	'log_fileline' => 'Informations supplémentaires de débogage', # NEW

	// M
	'mailcrypt:description' => 'Metinlerinizde bulunan tüm bağları maskeler ve bir Javascript bağ yardımıyla okuyucunun mesajlaşmasını aktive etme olanağı tanır. Bu anti-spam gereci robotların, forumlarda veya iskeletlerde kullanılan komutlarda açıkta bırakılan elektronik adresleri toplamasını engellemeye çalışır.',
	'mailcrypt:nom' => 'MailCrypt',
	'mailcrypt_balise_email' => 'Traiter également la balise #EMAIL de vos squelettes', # NEW
	'mailcrypt_fonds' => 'Ne pas protéger les fonds suivants :<br /><q4>{Séparez-les par les deux points «~:~» et vérifiez bien que ces fonds restent totalement inaccessibles aux robots du Net.}</q4>', # NEW
	'maj_actualise_ok' => 'Le plugin « @plugin@ » n\'a pas officiellement changé de version, mais ses fichiers ont quand même été actualisés afin de bénéficier de la dernière révision de code.', # NEW
	'maj_auto:description' => 'Cet outil vous permet de gérer facilement la mise à jour de vos différents plugins, récupérant notamment le numéro de révision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouvé sur <code>zone.spip.org</code>.

La liste ci-dessus offre la possibilité de lancer le processus de mise à jour automatique de SPIP sur chacun des plugins préalablement installés dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> ou <code>extensions/</code> sont simplement listés à titre d\'information. Si la révision distante n\'a pas pu être trouvée, alors tentez de procéder manuellement à la mise à jour du plugin.

Note : les paquets <code>.zip</code> n\'étant pas reconstruits instantanément, il se peut que vous soyez obligé d\'attendre un certain délai avant de pouvoir effectuer la totale mise à jour d\'un plugin tout récemment modifié.', # NEW
	'maj_auto:nom' => 'Mises à jour automatiques', # NEW
	'maj_fichier_ko' => 'Le fichier « @file@ » est introuvable !', # NEW
	'maj_librairies_ko' => 'Librairies introuvables !', # NEW
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particulière de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-clé défini ci-dessous. Si une rubrique est masquée, toute sa branche l\'est aussi.[[%mot_masquer%]]

Pour forcer l\'affichage des contenus masqués, il suffit d\'ajouter le critère <code>{tout_voir}</code> aux boucles de votre squelette.', # NEW
	'masquer:nom' => 'Masquer du contenu', # NEW
	'meme_rubrique:description' => 'Définissez ici le nombre d\'objets listés dans le cadre nommé «<:info_meme_rubrique:>» et présent sur certaines pages de l\'espace privé.[[%meme_rubrique%]]', # NEW
	'message_perso' => 'Buraya uğrayacak çevirmenlere çok çok teşekkürler. Pat ;-)',
	'moderation_admins' => 'onaylı yöneticiler',
	'moderation_message' => 'Bu forum ön tanımlı olarak yönetilmektedir  : katkınız, eğer direkt yayınlama hakkınız yoksa, bir site yöneticisi tarafından onaylandıktan sonra görünecektir.',
	'moderation_moderee:description' => 'Kayıtlı kullanıcıların yönetimini yönetmeyi sağlar. [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Yönetimin yönetimi',
	'moderation_redacs' => 'onaylı redaktörler',
	'moderation_visits' => 'onaylı ziyaretçiler',
	'modifier_vars' => '@nb@ parametreyi değiştir',
	'modifier_vars_0' => 'Bu parametreleri değiştir',

	// N
	'no_IP:description' => 'Özel bilgilerin korunması endişesiyle sitenizi ziyaret edenlerin IP adreslerinin otomatik olarak kaydeilmesi işlemini durdurur : SPIP artık istatistikler için veya spip.log dosyası için forumlarda bile ziyaretler esnasında geçici olarak hiçbir IP numarasını saklamayacaktır.',
	'no_IP:nom' => 'IP kaydı yapma',
	'nouveaux' => 'Yeni',

	// O
	'orientation:description' => 'İskeletleriniz için 3 yeni kriter : <code>{portrait}</code>, <code>{carre}</code> ve <code>{paysage}</code>. Fotoğrafların şekilleri bakımından sınıflandırılması için ideal.',
	'orientation:nom' => 'Resimlerin yönü',
	'outil_actif' => 'Aktif alet',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Aktive et',
	'outil_activer_le' => 'Aleti aktive et',
	'outil_actualiser' => 'Actualiser l\'outil', # NEW
	'outil_cacher' => 'Artık gösterme',
	'outil_desactiver' => 'Deaktive et',
	'outil_desactiver_le' => 'Aleti deaktive et',
	'outil_inactif' => 'İnaktif aktif',
	'outil_intro' => 'Bu sayfa size sunulan eklenti işlevlerini listeler. <br /><br />Aşağıdaki gereç isimlerine tıklayarak merkezî düğme ile durumlarını değiştirebileceğiniz gereçleri seçebilirsiniz : etkinleştirilen gereçler pasifleştirilecektir veya <i>tam tersi</i>. Her tıklamada tanımlama listenin altında görülür. Kategoriler katlanabilir ve gereçler saklanabilir. Çift tıklama bir gerecin durumunu hızlıca değiştirmeye olanak tanır. <br /><br />İlk kullanım için, SPIP iskeletinizle veya diğer eklentilerle çakışma olabileceği sebebiyle gereçleri birer birer etkinleştirmeniz önerilir.<br /><br />Not : bu sayfanın tekrar yüklenmesi İsviçre Çakısı\'nı tekrardan derler.',
	'outil_intro_old' => 'Bu arayüz eski.<br /><br />Eğer <a href=\'./?exec=admin_couteau_suisse\'>yeni arayüz</a>\'ün kullanımında sorunla karşılaşırsanız, bizle <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a> forumunda paylaşmaktan çekinmeyin.',
	'outil_nb' => '@pipe@ : @nb@ alet', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ alet', # MODIF
	'outil_permuter' => '« @text@ » gereci değiştirilsin mi ?',
	'outils_actifs' => 'Aktif aletler :',
	'outils_caches' => 'Saklı aletler :',
	'outils_cliquez' => 'Yukarıdaki gereçlerin açıklamalarını görmek için isimlerine tıklayınız.',
	'outils_concernes' => 'Sont concernés : ', # NEW
	'outils_desactives' => 'Sont désactivés : ', # NEW
	'outils_inactifs' => 'İnaktif aletler :',
	'outils_liste' => 'İsviçre Çakısı aletleri listesi ',
	'outils_non_parametrables' => 'Ayarlanamaz :',
	'outils_permuter_gras1' => 'Koyu yazılı aletleri çaprazla (Permuter)',
	'outils_permuter_gras2' => 'Koyu @nb@ gereçleri değiştirilsin mi?',
	'outils_resetselection' => 'Seçimleri baştan al',
	'outils_selectionactifs' => 'Tüm aktif aletleri seç',
	'outils_selectiontous' => 'HEPSİ',

	// P
	'pack_actuel' => '@date@ paketi',
	'pack_actuel_avert' => 'Dikkat, define()\'lar ve global\'ler üzerindeki yük burada belirtilmez', # MODIF
	'pack_actuel_titre' => 'İSVİÇRE ÇAKISI\'NIN GÜNCEL KONFİGÜRASYON PAKETİ',
	'pack_alt' => 'Aktif konfigürasyonun parametrelerini göster',
	'pack_delete' => 'Supression d\'un pack de configuration', # NEW
	'pack_descrip' => '"Güncel konfigürasyon paketiniz" İsviçre Çakısı\'nın parametrelerini içerir : gereçlerin etkinleştirilmesi ve olası değişkenlerin değerleri.

Bu PHP kodu /config/mes_options.php dosyasında yer alır ve bu sayfaya "{Güncel Paket} paketinin". sıfırlanmsını sağlayan bağlantıyı ekler. Tabii aşağıdaki ismi değiştirebilirsiniz.

Eğer eklentiyi bir pakete tıklayarak sıfırlarsanız İsviçre Çakısı kendisini paketteki önceden tanımlı parametreleri kullanarak yeniden konfigüre edecektir.', # MODIF
	'pack_du' => '• @pack@ paketinin', # MODIF
	'pack_installe' => 'Bir konfigürasyon paketini yükle',
	'pack_installer' => 'İsviçre Çakısı\'nı yeniden başlatmak ve « @pack@ » paketini kurmak istediğinizden emin misiniz ?',
	'pack_nb_plrs' => 'Şu anda güncel @nb@ « konfigürasyon paketi » var.', # MODIF
	'pack_nb_un' => 'Şu anda güncel bir « konfigürasyon paketi » var', # MODIF
	'pack_nb_zero' => 'Şu anda güncel bir « konfigürasyon paketi » yok.',
	'pack_outils_defaut' => 'Varsayılan gereçlerin kurulumu',
	'pack_sauver' => 'Güncel konfigürasyonu kaydet',
	'pack_sauver_descrip' => 'Aşağıdaki düğme soldaki menüye « konfigürasyon paketi » eklemek için <b>@file@</b> dosyanıza gerekli parametreleri direkt olarak ekleme olanağı tanır. Böylece ileride tek tıkla İsviçre Çakısı\'nı şu andaki konfigürasyonuna geri, döndürebilirsiniz.',
	'pack_supprimer' => 'Êtes-vous sûr de vouloir supprimer le pack « @pack@ » ?', # NEW
	'pack_titre' => 'Aktüel Konfigürasyon',
	'pack_variables_defaut' => 'Varsayılan değişkenlerin kurulumu',
	'par_defaut' => 'Varsayılan',
	'paragrapher2:description' => '<code>paragrapher()</code> SPIP fonksiyonu &lt;p&gt; ve &lt;/p&gt; komutlarını paragraf içermeyen tüm metinlere ekler. Stillerinizi ve sayfa düzenlemelerinizi daha zarif biçimde yönetmek için sitenizdeki metinleri tektip hale getirme olanağı tanır.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Paragrafla',
	'pipelines' => 'Kullanılan boru hatları :',
	'previsualisation:description' => 'Par défaut, SPIP permet de prévisualiser un article dans sa version publique et stylée, mais uniquement lorsque celui-ci a été « proposé à l’évaluation ». Hors cet outil permet aux auteurs de prévisualiser également les articles pendant leur rédaction. Chacun peut alors prévisualiser et modifier son texte à sa guise.

@puce@ Attention : cette fonctionnalité ne modifie pas les droits de prévisualisation. Pour que vos rédacteurs aient effectivement le droit de prévisualiser leurs articles « en cours de rédaction », vous devez l’autoriser (dans le menu {[Configuration&gt;Fonctions avancées->./?exec=config_fonctions]} de l’espace privé).', # NEW
	'previsualisation:nom' => 'Prévisualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci «*»', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Makalelerdeki «-» (basit tire) işaretlerini «-*» ile değiştirir (HTML\'e : &lt;ul>&lt;li>…&lt;/li>&lt;/ul> olarak çevrilir). Bunların biçimi css ile kişiselleştirilebilir.', # MODIF
	'pucesli:nom' => 'Güzel simgeler',

	// Q
	'qui_webmestres' => 'SPIP web yöneticileri',

	// R
	'raccourcis' => 'İsviçre Çakısı\'nın aktif tipografik kısayolları :',
	'raccourcis_barre' => 'İsviçre Çakısı\'nın tipografik kısayolları',
	'rafraichir' => 'Afin de terminer la configuration du plugin, merci d\'actualiser la page courante.', # NEW
	'reserve_admin' => 'Yöneticilere ayrılmış erişim.',
	'rss_actualiser' => 'Güncelle',
	'rss_attente' => 'RSS bekleniyor...',
	'rss_desactiver' => 'İsviçre Çakısı\'nın "Gözden Geçirmeleri"ni deaktive et',
	'rss_edition' => 'RSS akışının güncellenme tarihi :',
	'rss_source' => 'RSS kaynağı',
	'rss_titre' => '« İsviçre Çakısı » geliştirilmekte :',
	'rss_var' => 'İsviçre Çakısı\'nın "Gözden Geçirmeleri"',

	// S
	'sauf_admin' => 'Yöneticiler dışında herkes',
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et rédacteurs', # NEW
	'sauf_identifies' => 'Tous, sauf les auteurs identifiés', # NEW
	'sessions_anonymes:description' => 'Chaque semaine, cet outil vérifie les sessions anonymes et supprime les fichiers qui sont trop anciens (plus de @_NB_SESSIONS3@ jours) afin de ne pas surcharger le serveur, notamment en cas de SPAM sur le forum.

Dossier stockant les sessions : @_DIR_SESSIONS@

Votre site stocke actuellement @_NB_SESSIONS1@ fichier(s) de session, @_NB_SESSIONS2@ correspondant à des sessions anonymes.', # NEW
	'sessions_anonymes:nom' => 'Sessions anonymes', # NEW
	'set_options:description' => 'Mevcut veya gelecek tüm redaktörler veya özel arayüzü seçer (basit veya gelişmiş) ve küçük ikonlar bandına ait düğmeyi siler.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Özel arayüz tipi',
	'sf_amont' => 'En amont', # NEW
	'sf_tous' => 'Hepsi',
	'simpl_interface:description' => 'Renkli ikonun üzerinden geçerken bir makalenin statüsünü hızlı yükleme menüsünü dezaktive eder. Eğer \'client\' performasını arttırmak için özel bir arayüz istiyorsanız idealdir.',
	'simpl_interface:nom' => 'Özel arayüzün hafifletilmesi',
	'smileys:aide' => 'Gülen yüzler : @liste@',
	'smileys:description' => '<acronym>:-)</acronym> tipinde kısayol içeren tüm metinlere gülen yüz ekler. Forumlar için ideal. 
_ İskeletlerinizde gülen suratları bir tabloda göstermek için bir komut mevcuttur : #SMILEYS.
_ Dessins : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Gülen yüzler (smileys)',
	'soft_scroller:description' => 'Kamusal sitenizdeki sayfanın, ziyaretçi başka bir sayfaya yönlendiren bir çapaya tıkladığında yumuşak bir biçimde kaymasını sağlar : karmaşık bir sayfada veya çok uzun bir metinde kaybolmayı önlemek için çok kullanışlıdır...

Attention, cet outil a besoin pour fonctionner de pages au «DOCTYPE XHTML» (non HTML !) et de deux plugins {jQuery} : {ScrollTo} et {LocalScroll}. Le Couteau Suisse peut les installer directement si vous cochez les cases suivantes. [[%scrollTo%]][[-->%LocalScroll%]]
 @_CS_PLUGIN_JQUERY192@ Dikkat, bu gereç çalışmak için «DOCTYPE XHTML» tipinden sayfalara (HTML değil!) ve iki {jQuery} eklentisine gereksinim duyar : {ScrollTo} ve {LocalScroll}. İsviçre Çakısı, eğer şu kutucukları işaratlerseniz bunları direkt olarak kurabilir. [[%scrollTo%]][[->%LocalScroll%]]', # MODIF
	'soft_scroller:nom' => 'Yumuşak çapalar',
	'sommaire:description' => 'Construit un sommaire pour le texte de vos articles et de vos rubriques afin d’accéder rapidement aux gros titres (balises HTML &lt;h3>Un intertitre&lt;/h3> ou raccourcis SPIP : intertitres de la forme :<code>{{{Un gros titre}}}</code>).

@puce@ Vous pouvez définir ici le nombre maximal de caractères retenus des intertitres pour construire le sommaire :[[%lgr_sommaire% caractères]]

@puce@ Vous pouvez aussi fixer le comportement du plugin concernant la création du sommaire: 
_ • Systématique pour chaque article (une balise <code>@_CS_SANS_SOMMAIRE@</code> placée n’importe où à l’intérieur du texte de l’article créera une exception).
_ • Uniquement pour les articles contenant la balise <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Par défaut, le Couteau Suisse insère le sommaire en tête d\'article automatiquement. Mais vous avez la possibilité de placer ce sommaire ailleurs dans votre squelette grâce à une balise #CS_SOMMAIRE que vous pouvez activer ici :
[[%balise_sommaire%]]

Ce sommaire peut être couplé avec : « [.->decoupe] ».', # MODIF
	'sommaire:nom' => 'Makaleleriniz için bir özet', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre<mon_ancre>}}}</html></b>', # NEW
	'sommaire_avec' => 'Özet içeren bir makale : <b>@racc@</b>',
	'sommaire_sans' => 'Özetsiz bir makale : <b>@racc@</b>',
	'sommaire_titres' => 'Intertitres hiérarchisés : <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Kamusal bölümde otomatik veya kötü niyetli mesaj gönderilmesine karşı savaşır. Bazı sözcükler ve &lt;a>&lt;/a> komutları yasaktır.

Burada yasaklanacak serileri @_CS_ASTER@ aralarında bir boşluk bırakarak listeleyiniz. [[%spam_mots%]]
@_CS_ASTER@Tek bir sözcüğü parantez içine alınız. Boşluklar içeren bir deyimi tırnak içine alınız.', # MODIF
	'spam:nom' => 'SPAM\'a karşı savaş',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Bu mesaj anti-SPAM filtresi tarafından bloke edilecekti !',
	'spam_test_ok' => 'Bu mesaj anti-SPAM filtresi tarafından kabûl edilecekti !',
	'spam_tester_bd' => 'Testez également votre votre base de données et listez les messages qui auraient été bloqués par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Burada yasak serileri listenizi test edebilirsiniz :', # MODIF
	'spip_cache:description' => '@puce@ Le cache occupe un certain espace disque et SPIP peut en limiter l\'importance. Une valeur vide ou égale à 0 signifie qu\'aucun quota ne s\'applique.[[%quota_cache% Mo]]

@puce@ Lorsqu\'une modification du contenu du site est faite, SPIP invalide immédiatement le cache sans attendre le calcul périodique suivant. Si votre site a des problèmes de performance face à une charge très élevée, vous pouvez cocher « non » à cette option.[[%derniere_modif_invalide%]]

@puce@ Si la balise #CACHE n\'est pas trouvée dans vos squelettes locaux, SPIP considère par défaut que le cache d\'une page a une durée de vie de 24 heures avant de la recalculer. Afin de mieux gérer la charge de votre serveur, vous pouvez ici modifier cette valeur.[[%duree_cache% heures]]

@puce@ Si vous avez plusieurs sites en mutualisation, vous pouvez spécifier ici la valeur par défaut prise en compte par tous les sites locaux (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ SPIP, varsayılan durumda incelemeyi hızlandırmak için tüm kamusal sayfaları ve önbellekteki yerlerini tekrar hesaplar. Önbelleği geçici olarak kapatmak sitenin gelişimine yardımcı olabilir. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ SPIP önbelleğinin işleyişini yönlendirmek için 4 seçenek vardır : <q1>
_ • {Normal kullanım} : SPIP, varsayılan durumda incelemeyi hızlandırmak için tüm kamusal sayfaları ve önbellekteki yerlerini tekrar hesaplar. Belirli bir süre geçtiğinde önbellek yeniden saklanır ve kaydedidlir..
_ • {Kalıcı önbellek} : önbelleği geçersiz kılan süre iptal edilir..
_ • {Önbellek yok} : Önbelleği geçici olarak kapatmak sitenin gelişimine yardımcı olabilir. Diske hiçbir şey kaydedilmez.
_ • {Önbelleğin kontrolü} : bu seçenek bir öncekiyle aynıdır ama tüm sonuçlar ileride kontrol edilebilmeleri için diske yazılır. </q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension « Compresseur » présente dans SPIP permet de compacter les différents éléments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela accélère l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers à obtenir.', # NEW
	'spip_cache:nom' => 'SPIP ve önbellek…',
	'spip_ecran:description' => 'Détermine la largeur d\'écran imposée à tous en partie privée. Un écran étroit présentera deux colonnes et un écran large en présentera trois. Le réglage par défaut laisse l\'utilisateur choisir, son choix étant stocké dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'écran', # NEW
	'spip_log:description' => '@puce@ Gérez ici les différents paramètres pris en compte par SPIP pour mettre en logs les évènements particuliers du site. Fonction PHP à utiliser : <code>spip_log()</code>.@SPIP_OPTIONS@
[[Ne conserver que %nombre_de_logs% fichier(s), chacun ayant pour taille maximale %taille_des_logs% Ko.<br /><q3>{Mettre à zéro l\'une de ces deux cases désactive la mise en log.}</q3>]][[@puce@ Dossier où sont stockés les logs (laissez vide par défaut) :<q1>%dir_log%{Actuellement :} @DIR_LOG@</q1>]][[->@puce@ Fichier par défaut : %file_log%]][[->@puce@ Extension : %file_log_suffix%]][[->@puce@ Pour chaque hit : %max_log% accès par fichier maximum]]', # NEW
	'spip_log:description2' => '@puce@ Le filtre de gravité de SPIP permet de sélectionner le niveau d\'importance maximal à prendre en compte avant la mise en log d\'une donnée. Un niveau 8 permet par exemple de stocker tous les messages émis par SPIP.[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]', # NEW
	'spip_log:description3' => '@puce@ Les logs spécifiques au Couteau Suisse s\'activent ici : «[.->cs_comportement]».', # NEW
	'spip_log:nom' => 'SPIP et les logs', # NEW
	'stat_auteurs' => 'Stat durumundaki yazarlar',
	'statuts_spip' => 'Sadece şu SPIP statüsü :',
	'statuts_tous' => 'Tüm statüler',
	'suivi_forums:description' => 'Bir makale yazarı, ilintili kamusal forumda bir mesaj yayınlandığında her zaman bilgilendirilir. Ama ayrıca şunlar da bilgilendirilebilir : tüm forum katılımcıları veya mesajların yazarları.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Kamusal forumların izlenmesi',
	'supprimer_cadre' => 'Bu çerçeveyi kaldır',
	'supprimer_numero:description' => 'Supprimer_numero() SPIP işlevini iskeletlerde supprimer_numero filtresi olmasa da kamusal alandaki tüm {{başlıklara}} ve {{isimlere}} uygular.<br /> Çok dilli bir sitede kullanılacak cümle yapısı şöyledir : <code>1. <multi>My Title[fr]Mon Titre[tr]Başlığım</multi></code>',
	'supprimer_numero:nom' => 'Numarayı sil',

	// T
	'test_i18n:description' => 'Toutes les chaînes de langue qui ne sont pas internationalisées (donc présentes dans les fichiers lang/*_XX.php) vont apparaitre en rouge.
_ Utile pour n\'en oublier aucune !

@puce@ Un test : ', # NEW
	'test_i18n:nom' => 'Traductions manquantes', # NEW
	'timezone:description' => 'Depuis PHP 5.1.0, chaque appel à une fonction date/heure génère une alerte de niveau E_NOTICE si le décalage horaire n\'est pas valide et/ou une alerte de niveau E_WARNING si vous utilisez des configurations système, ou la variable d\'environnement TZ.
_ Depuis PHP 5.4.0, la variable d\'environnement TZ et les informations disponibles via le système d\'exploitation ne sont plus utilisées pour deviner le décalage horaire.

Réglage actuellement détecté : @_CS_TZ@.

@puce@ {{Définissez ci-dessous le décalage horaire à utiliser sur ce site.}}
[[%timezone%<q3>Liste complète des fuseaux horaires : [->http://www.php.net/manual/fr/timezones.php].</q3>]].', # NEW
	'timezone:nom' => 'Décalage horaire', # NEW
	'titre' => 'İsviçre Çakısı',
	'titre_parent:description' => 'Bir döngünün ortasında o anki nesnenin "ebeveyninin" başlığını göstermek çok olağandır. Geleneksel biçimde ikinci bir döngü kullanılırdı ama yeni #TITRE_PARENT komutu iskeletlerinizin yazılma yükünü hafifletiyor. Geri döndürülen sonuç : bir anahtar-sözcüğün grubun veya diğer nesnelerin (makale, bölüm, kısa haber vb.) bir üst bölümün (eğer mevcutsa) başlığıdır.

Not : Anahtar-sözcükler için, #TITRE_PARENT\'ın eşdeğeri #TITRE_GROUPE\'tur. Bu yeni komutların SPIP tarafından işletilmesi #TITRE gibidir.

@puce@ Eğer SPIP 2.0 kullanıyorsanız hizmetinizde \'xxx\' nesnesinin başlığını verecek bir grup #TITRE_XXX komutu vardır, yeter ki o anki tabloda \'id_xxx\' mevcut olsun (#ID_XXX o anki döngüde kullanılabilir).

Örneğin bir (ARTICLES) döngüsünde, #TITRE_SECTEUR komutu, makalenin içinde bulunduğu bölümün başlığını verecektir çünkü #ID_SECTEUR tanımlayıcısı (veya \'id_secteur\') bu durumda kullanılabilir haldedir.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => '#TITRE_PARENT/OBJET komutları',
	'titre_tests' => 'İsviçre Çakısı - Test sayfaları',
	'titres_typo:description' => 'Transforme tous les intertitres <html>« {{{Mon intertitre}}} »</html> en image typographique paramétrable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : « [.->sommaire] ».', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'titres_typographies:description' => 'Par défaut, les raccourcis typographiques de SPIP <html>({, {{, etc.)</html> ne s\'appliquent pas aux titres d\'objets dans vos squelettes.
_ Cet outil active donc l\'application automatique des raccourcis typographiques de SPIP sur toutes les balises #TITRE et apparentées (#NOM pour un auteur, etc.).

Exemple d\'utilisation : le titre d\'un livre cité dans le titre d\'un article, à mettre en italique.', # NEW
	'titres_typographies:nom' => 'Titres typographiés', # NEW
	'tous' => 'Hepsi',
	'toutes_couleurs' => 'Css stillerinin 36 rengi :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Çok dilli bloklar : <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'SPIP\'in dil zincirlerinin (çoklu blokların) makalelerde, başlıklarda ve mesajlarda serbestçe kullanılabilmesi için <code><:chaine:></code> kısayolunu sunar. 
_ Kullanılan SPIP fonksiyonu şudur : <code>_T(\'zincir\')</code>.

Bu gereç argüman da kabûl eder. Örneğin <code><:chaine{arg1=bir metin, arg2=bir başka metin}:></code> kısaltması 2 argümanın şu zincire geçirilmesine izin verir : <code>\'chaine\'=>\'İşte benim argümanlarım : @arg1@ et @arg2@\'</code>.

<code>\'zincir\'</code> anahtarının dil dosyalarında düzgün biçimde tanımlandığından emin olun. [Bu konuyla ilgili şu adresteki ->http://www.spip.net/fr_article2128.html] SPIP belgelerine göz atınız.', # MODIF
	'toutmulti:nom' => 'Çok dilli bloklar',
	'trad_help' => '{{Le Couteau Suisse est bénévolement traduit en plusieurs langues et sa langue mère est le français.}}

N\'hésitez pas à offrir votre contribution si vous décelez quelques soucis dans les textes du plugin. Toute l\'équipe vous en remercie d\'avance.

Pour vous inscrire à l\'espace de traduction : @url@

Pour accéder directement aux traductions des modules du Couteau Suisse, cliquez ci-dessous sur la langue cible de votre choix. Une fois identifié, repérez ensuite le petit crayon qui apparait en survolant le texte traduit puis cliquez dessus.

Vos modifications seront prises en compte quelques jours plus tard sous forme d\'une mise à jour disponible pour le Couteau Suisse. Si votre langue n\'est pas dans la liste, alors le site de traduction vous permettra facilement de la créer.

{{Traductions actuellement disponibles}} :@trad@

{{Merci aux traducteurs actuels}} : @contrib@.', # NEW
	'trad_mod' => 'Module « @mod@ » : ', # NEW
	'travaux_masquer_avert' => 'Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours', # NEW
	'travaux_nocache' => 'Désactiver également le cache de SPIP', # NEW
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Bu site çok yakında tekrar yayına başlayacak.
_ Anlayışınız için teşekkürler.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Sitenin özel alanında gezinirken ([->./?exec=auteurs]) başlıkların içinde makalelerinizi sıralamak için kullanılacak yönetmi burada seçin.

Aşağıdaki öneriler SQL \'ORDER BY\' fonksiyonuna dayanmaktadır: bu kişisel sıralamayı yalnızca ne yaptığğınızı biliyorsanız kullanın (olası alanlar : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Makalelerin sıralanması', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'Değişiklik tarihine göre sıralama (ORDER BY date_modif DESC)',
	'tri_perso' => 'Kişiselleştirilmiş SQL sıralaması ORDER BY :',
	'tri_publi' => 'Yayın tarihine göre sıralama (ORDER BY date DESC)',
	'tri_titre' => 'Başlığa göre sıralama (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Outil en cours de développement. Vous offre quelques balises très simples et bien pratiques pour améliorer la lisibilité de vos squelettes.

@puce@ {{#BOLO}} : génère un faux texte d\'environ 3000 caractères ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction spécifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ Un modèle est également disponible pour vos contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caractères de faux texte.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction spécifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalisez l\'affichage grâce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}} : balise équivalente à <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caractères spéciaux (le retour à la ligne par exemple) ou des caractères réservés par le compilateur de SPIP (les crochets ou les accolades).

@puce@ {{#LESMOTS}} : ', # NEW
	'trousse_balises:nom' => 'Komut kutusu',
	'type_urls:description' => '@puce@ SPIP, sitenizin sayfalarına erişime izin veren bağlantılar üretmek için için  bir takım URL\'ler sunar. 

Daha fazla bilgi için : [->http://www.spip.net/fr_article765.html]. « [.->boites_privees] » gereci size her SPIP nesnesinin sayfasında ona bağlı özel URL\'yi görme olanağı tanır.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@{html}, {propre}, {propre2}, {libres} veya {arborescentes} formatlarını kullanabilmek için SPIP sitesinin kök dizininin "htaccess.txt" dosyasını ".htaccess" ismiyle kopyalayın (bu dosyaya koymuş olabileceğiniz başka ayarları ezmemeye dikkat edin); eğer siteniz bir "alt-dizinde" ise bu dosyada ayrıca "RewriteBase" satırını da düzenlemelisiniz. Bu şekilde tanımlanan URL\'ler SPIP dosyalarına yönlendirilecektir.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs «page»}} : bunlar SPIP 1.9x sürümünden itibaren kullanılan  varsayılan bağlantılardır .
_ Örnek : <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs «html»}} : bağlantılar klasik HTML sayfaları biçimindedir.
_ Örnek : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{«propres» URL\'ler}} : bağlantılar istenen nesnelerin başlığı yardımıyla hesaplanmaktadır. (_, -, +, @, vb.) işaretleri nesneye bağlı olarak başlıkları çevreler.
_ Örnekler : <code>/Mon-titre-d-article</code> veya <code>/-Ma-rubrique-</code> veya <code>/@Mon-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs «propres2»}} : \'.html\' soyadı {«propres»} bağlantılara eklenir.
_ Exemple : <code>/Mon-titre-d-article.html</code> veya <code>/-Ma-rubrique-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs «libres»}} : bağlantılar {«propres»}\'dur ama nesneleri ayıran işaretler yoktur (_, -, +, @, vb.).
_ Örnek : <code>/Mon-titre-d-article</code> veya <code>/Ma-rubrique</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs «arborescentes»}} : bağlantılar {«propre»dur} ama ağaç yapısındadır.
_ Örnek : <code>/secteur/rubrique1/rubrique2/Mon-titre-d-article</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{«propres-qs» URL\'ler}} : bu sistem "Query-String"de çalışır yani .htaccess kullanmaz ; bağlantılar {«propres»}dur.
_ Örnek : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres_qs">@puce@ {{URLs «propres_qs»}} : bu sistem "Query-String"de çalışır yani .htaccess kullanmaz ; bağlantılar {«propres»}dur.
_ Örnek : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs «standard»}} : artık âtıl olan bu bağlantılar 1.8 sürümüne kadar kullanılıyordu.
_ Örnek : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Eğer yukarıda {page} formatını kullanıyorsanız veya istenen nesne tanınmıyorsa o zaman {{çağrı skripti}}ni seçmeniz mümkündür. Varsayılan değer olarak SPIP {spip.php}\'yi seçer ama {index.php}  (format örneği : <code>/index.php?article123</code>) veya boş bir değer de (format : <code>/?article123</code>) iş görür. Diğer dğerler için SPIP\'in kök dizininde karşı düşen dosyayı oluşturmanız gerekir : {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ URL tabanlı bir format kullanıyorsanız «propres»  ({propres}, {propres2}, {libres}, {arborescentes} veya {propres_qs}) İsviçre Çakısı şunu yapabilir :
<q1>• URL\'nin tamamen {{küçük harf olması}}.</q1>[[%urls_minuscules%]]
<q1>• Sistematik olarak {{nesne id\'sinin}} URL\'ye eklenmesi (ön ek, son ek vb.).
_ (örnekler : <code>/Mon-titre-d-article,457</code> veya <code>/457-Mon-titre-d-article</code>)</q1>', # MODIF
	'type_urls:description2' => '{Note} : un changement dans ce paragraphe peut nécessiter de vider la table des URLs afin de permettre à SPIP de tenir compte des nouveaux paramètres.', # NEW
	'type_urls:nom' => 'URL\'lerin formatları',
	'typo_exposants:description' => '{{Fransızca metinler}} : güncel kısaltmaların tipografik görünümünü gerekli elemanları üs\'e koyarak  (böylece, {<acronym>Mme</acronym>} şu hale gelir {M<sup>me</sup>}) ve sıkça yapılan hataları düzelterek ({<acronym>2ème</acronym>} veya {<acronym>2me</acronym>} şu hale gelir {2<sup>e</sup>}) geliştirir,.
_ Burada elde edilen kısaltmalar 2002 yılında yayınlanan Paris Ulusal Basımevi 2002 standartlarına uygundur. 
Böylece Fransızca\'da: <html>Dr, Pr, Mgr, St, Bx, m2, m3, Mn, Md, Sté, Éts, Vve, bd, Cie, 1o, 2o, etc.</html> kısaltmaları halledilmiş olur

{{İngilizce metinler}} : sıralamaların üs\'e konması : <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Tipografik üs\'ler',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'sayfa',
	'url_propres' => 'propres@_CS_ASTER@',
	'url_propres-qs' => 'propres-qs',
	'url_propres2' => 'propres2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'standart',
	'url_verouillee' => 'URL verrouillée', # NEW
	'urls_3_chiffres' => 'Minimum 3 rakam iste',
	'urls_avec_id' => 'Son ek olarak ekle',
	'urls_avec_id2' => 'Ön ek olarak ekle',
	'urls_base_total' => 'Şu anda veritabanında @nb@ URL var',
	'urls_base_vide' => 'URL veritabanı boş',
	'urls_choix_objet' => 'Belirgin bir nesnenin URL\'sinin veritabanında düzenlenmesi :',
	'urls_edit_erreur' => 'URL\'lerin şu anki biçemleri (« @type@ ») düzenlemeye izin vermiyor.',
	'urls_enregistrer' => 'Bu URL\'yi veritabanına ekle',
	'urls_id_sauf_rubriques' => 'Başlıkları çıkart', # MODIF
	'urls_minuscules' => 'Küçük harfler',
	'urls_nouvelle' => 'URL « propre »\'u düzenle :', # MODIF
	'urls_num_objet' => 'Numara :',
	'urls_purger' => 'Hepsini boşalt',
	'urls_purger_tables' => 'Seçilen tabloları boşalt',
	'urls_purger_tout' => 'Veritabanındaki URL\'Leri sıfırla :',
	'urls_rechercher' => 'Bu nesneyi veritabanında ara',
	'urls_titre_objet' => 'Kayıtlı başlık  :',
	'urls_type_objet' => 'Nesne :',
	'urls_url_calculee' => 'Kamusal URL « @type@ » :',
	'urls_url_objet' => 'Kaydedilmiş « kişisel » URLler :', # MODIF
	'urls_valeur_vide' => '(Boş bir değer URL\'nin yeniden hesaplanmasına yol açar)', # MODIF
	'urls_verrouiller' => '{{Verrouiller}} cette URL afin que SPIP ne la modifie plus, notamment lors d\'un clic sur « @voir@ » ou d\'un changement du titre de l\'objet.', # NEW

	// V
	'validez_page' => 'Değişikliklere erişmek için :',
	'variable_vide' => '(Boş)',
	'vars_modifiees' => 'Veriler sorunsuz değiştirildi',
	'version_a_jour' => 'Sürümünüz güncel.',
	'version_distante' => 'En eski sürüm...',
	'version_distante_off' => 'Uzaktan onaylama pasif hale getirildi',
	'version_nouvelle' => 'Yeni sürüm : @version@',
	'version_revision' => 'Gözden geçirme : @revision@',
	'version_update' => 'Otomatik güncelleme',
	'version_update_chargeur' => 'Otomatik dosya indirme',
	'version_update_chargeur_title' => '«Téléchargeur» eklentisi sayesinde eklentinin son sürümünü indirir',
	'version_update_title' => 'Eklentinin son sürümünü indirir ve otomatik güncellemeyi başlatır',
	'verstexte:description' => 'İskeletleriniz için, daha hafif sayfalar oluşturmanızı sağlayacak 2 filtre.
_ version_texte : birkaç önemli komut dışında bir html sayfanın metin içeriğini alır.
_ version_plein_texte : bir html sayfanın tüm metin içeriğini alır.', # MODIF
	'verstexte:nom' => 'Metin sürümü',
	'visiteurs_connectes:description' => 'İskeletiniz için, kamusal sitedeki ziyaretçi sayısını gösteren bir programcık sunar.

Sayfalarınıza yalnızca şunu ekleyin  <code><INCLURE{fond=fonds/visiteurs_connectes}></code>.', # MODIF
	'visiteurs_connectes:inactif' => 'Attention : les statistiques du site ne sont pas activées.', # NEW
	'visiteurs_connectes:nom' => 'Bağlı ziyaretçiler',
	'voir' => 'Bkz : @voir@',
	'votre_choix' => 'Seçiminiz :',

	// W
	'webmestres:description' => 'Bir {{site yöneticisi}} SPIP\'te FTP alanındaki bir {{idareci}}ye karşı düşer. SPIP 2.0\'dan itibaren ve varsayılan değer olarak <code>id_auteur=1</code> site\'nin idarecisidir. Burada tanımlanan site yöneticileri, veritabanının güncellenmesi veya bir "dump"ın geri alınması gibi hassas site işlemlerini onaylamak için FTP\'den geçmek zorunda değildirler.

Şu anki site yöneticileri : {@_CS_LISTE_WEBMESTRES@}.
_ Site yöneticileri : {@_CS_LISTE_ADMINS@}.

Site yöneticisi olarak siz de burada -- eğer birden fazlaysa iki noktayla birbirinden ayrılmış « : » bu kimlik listelerini değiştirme yetkisine sahipsiniz. Örnek : «1:5:6».[[%site yöneticisi%]]', # MODIF
	'webmestres:nom' => 'Webmaster listesi',

	// X
	'xml:description' => 'Xml onaylayıcısını, kamusal alan için [şu belgede->http://www.spip.net/fr_article3541.html] belirtildiği gibi aktive eder. « Analyse XML » başlıklı bir düğme diğer yönetim düğmelerine eklenecektir.', # MODIF
	'xml:nom' => 'XML onaylayıcısı'
);

?>
