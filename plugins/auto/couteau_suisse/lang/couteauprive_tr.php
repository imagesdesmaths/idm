<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => '&nbsp;:&nbsp;hay&#305;r',
	'2pts_oui' => '&nbsp;:&nbsp;evet',

	// S
	'SPIP_liens:description' => '@puce@ Sitedeki t&uuml;m ba&#287;lar akt&uuml;el sayfada a&ccedil;&#305;l&#305;r. Ama d&#305;&#351; ba&#287;lar&#305; yeni pencerede a&ccedil;mak kullan&#305;&#351;l&#305; olabilir -- cela revient &agrave; ajouter {target="_blank"} &agrave; toutes les balises &lt;a&gt; dot&eacute;es par SPIP des classes {spip_out}, {spip_url} ou {spip_glossaire}. Il est parfois n&eacute;cessaire d\'ajouter l\'une de ces classes aux liens du squelette du site (fichiers html) afin d\'&eacute;tendre au maximum cette fonctionnalit&eacute;.[[%radio_target_blank3%]]

@puce@ SPIP permet de relier des mots &agrave; leur d&eacute;finition gr&acirc;ce au raccourci typographique <code>[?mot]</code>. Par d&eacute;faut (ou si vous laissez vide la case ci-dessous), le glossaire externe renvoie vers l’encyclop&eacute;die libre wikipedia.org. &Agrave; vous de choisir l\'adresse &agrave; utiliser. <br />Lien de test : [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP &laquo;~mailto:~&raquo; ba&#287;lant&#305;lar&#305; i&ccedil;in bir CSS stil &ouml;ng&ouml;rd&uuml; : e-posta ba&#287;lant&#305;lar&#305;n&#305;n &ouml;n&uuml;nde k&uuml;&ccedil;&uuml;k bir zarf g&ouml;r&uuml;necek; ama t&uuml;m gezginler bunu g&ouml;r&uuml;nt&uuml;leyemeyece&#287;i i&ccedil;in (bj&#287;ll&#351;ml&#287; IE6, IE7 et SAF3) bunu kullan&#305;p kullanmamak size kalm&#305;&#351;.
_ test ba&#287;lant&#305;s&#305; : [->test@test.com] (sayfay&#305; ba&#351;tan y&uuml;kleyin).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP ve d&#305;&#351; ba&#287;lant&#305;lar',
	'SPIP_tailles:description' => '@puce@ Afin d\'all&eacute;ger la m&eacute;moire de votre serveur, SPIP vous permet de limiter les dimensions (hauteur et largeur) et la taille du fichier des images, logos ou documents joints aux divers contenus de votre site. Si un fichier d&eacute;passe la taille indiqu&eacute;e, le formulaire enverra bien les donn&eacute;es mais elles seront d&eacute;truites et SPIP n\'en tiendra pas compte, ni dans le r&eacute;pertoire IMG/, ni en base de donn&eacute;es. Un message d\'avertissement sera alors envoy&eacute; &agrave; l\'utilisateur.



Une valeur nulle ou non renseign&eacute;e correspond &agrave; une valeur illimit&eacute;e.

[[Hauteur : %img_Hmax% pixels]][[->Largeur : %img_Wmax% pixels]][[->Poids du fichier : %img_Smax% Ko]]

[[Hauteur : %logo_Hmax% pixels]][[->Largeur : %logo_Wmax% pixels]][[->Poids du fichier : %logo_Smax% Ko]]

[[Poids du fichier : %doc_Smax% Ko]]



@puce@ D&eacute;finissez ici l\'espace maximal r&eacute;serv&eacute; aux fichiers distants que SPIP pourrait t&eacute;l&eacute;charger (de serveur &agrave; serveur) et stocker sur votre site. La valeur par d&eacute;faut est ici de 16 Mo.[[%copie_Smax% Mo]]



@puce@ Afin d\'&eacute;viter un d&eacute;passement de m&eacute;moire PHP dans le traitement des grandes images par la librairie GD2, SPIP teste les capacit&eacute;s du serveur et peut donc refuser de traiter les trop grandes images. Il est possible de d&eacute;sactiver ce test en d&eacute;finissant manuellement le nombre maximal de pixels support&eacute;s pour les calculs.



La valeur de 1~000~000 pixels semble correcte pour une configuration avec peu de m&eacute;moire. Une valeur nulle ou non renseign&eacute;e entra&icirc;nera le test du serveur.

[[%img_GDmax% pixels au maximum]]



@puce@ La librairie GD2 permet d\'ajuster la qualit&eacute; de compression des images JPG. Un pourcentage &eacute;lev&eacute; correspond &agrave; une qualit&eacute; &eacute;lev&eacute;e.

[[%img_GDqual% %]]', # NEW
	'SPIP_tailles:nom' => 'Limites m&eacute;moire', # NEW

	// A
	'acces_admin' => 'Y&ouml;netici eri&#351;imi :',
	'action_rapide' => 'H&#305;zl&#305; i&#351;lem, sadece ne yapt&#305;&#287;&#305;n&#305;zdan eminseniz !',
	'action_rapide_non' => 'H&#305;zl&#305; i&#351;lem, bu alet etkinle&#351;tirildikten sonra :',
	'admins_seuls' => 'Sadece y&ouml;neticiler',
	'attente' => 'Beklemede...',
	'auteur_forum:description' => 'En az&#305;ndan bir mektup yazm&#305;&#351; olan kamusal ileti yazarlar&#305;n&#305;, t&uuml;m kat&#305;l&#305;mlar&#305;n isimsiz olmamas&#305; i&ccedil;in &laquo;@_CS_FORUM_NOM@&raquo; alan&#305;n&#305; doldurmaya te&#351;vik eder.', # MODIF
	'auteur_forum:nom' => 'Anonim (isimsiz) forum yok',
	'auteur_forum_deux' => 'Ou, au moins l\'un des deux champs pr&eacute;c&eacute;dents', # NEW
	'auteur_forum_email' => 'Le champ &laquo;@_CS_FORUM_EMAIL@&raquo;', # NEW
	'auteur_forum_nom' => 'Le champ &laquo;@_CS_FORUM_NOM@&raquo;', # NEW
	'auteurs:description' => 'Bu gere&ccedil;[yazarlar sayfas&#305;->./?exec=auteurs]\'n&#305;n &ouml;zel alandaki g&ouml;r&uuml;n&uuml;&#351;&uuml;n&uuml; konfig&uuml;re eder.

@puce@ Yazarlar sayfas&#305;n&#305;n ortas&#305;ndaki ana &ccedil;er&ccedil;evede g&ouml;sterilecek maksimum yazar say&#305;s&#305;n&#305; belirtiniz. Bu say&#305;dan fazlas&#305; sayfalama ile g&ouml;sterilir.[[%max_auteurs_page%]]

@puce@ Bu sayfada hangi yazar stat&uuml;leri listelenecek  ?
[[%auteurs_tout_voir%]][[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]', # MODIF
	'auteurs:nom' => 'Yazarlar sayfas&#305;',

	// B
	'balise_set:description' => 'Afin d\'all&eacute;ger les &eacute;critures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqu&eacute; &agrave; une variable passe donc dans le nom de la balise.



Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'Balise #SET &eacute;tendue', # NEW
	'barres_typo_edition' => 'Edition des contenus', # NEW
	'barres_typo_forum' => 'Messages de Forum', # NEW
	'barres_typo_intro' => 'Le plugin &laquo;Porte-Plume&raquo; a &eacute;t&eacute; d&eacute;tect&eacute;. Veuillez choisir ici les barres typographiques o&ugrave; certains boutons seront ins&eacute;r&eacute;s.', # NEW
	'basique' => 'Temel',
	'blocs:aide' => 'Katlanabilir bloklar : <b>&lt;bloc&gt;&lt;/bloc&gt;</b> (alias : <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) et <b>&lt;visible&gt;&lt;/visible&gt;</b>',
	'blocs:description' => 'T&#305;klanabilir ba&#351;l&#305;klar sayesinde g&ouml;r&uuml;n&uuml;r veya g&ouml;r&uuml;nmez olabilen bloklar olu&#351;turman&#305;za olanak tan&#305;r.
@puce@ {{SPIP metinlerinde}} : yazarlar i&ccedil;in yeni komutlar sunulmu&#351;tur &lt;bloc&gt; (ou &lt;invisible&gt;) ve &lt;visible&gt; bu komutlar metinlerde &#351;u bi&ccedil;imde kullan&#305;labilir : 

<quote><code>
<bloc>
 T&#305;klanabilir ba&#351;l&#305;k
 
 G&ouml;sterilecek/gizlenecek metin, 2 sat&#305;r bo&#351;luk...
 </bloc>
</code></quote>

@puce@ {{&#304;skeletlerde}} : yeni komutlar &#351;unlard&#305;r #BLOC_TITRE, #BLOC_DEBUT ve #BLOC_FIN , &#351;u bi&ccedil;imde kullanabilirsiniz : 
<quote><code> #BLOC_TITRE veya #BLOC_TITRE{bana_ait_URL}
 Bana ait ba&#351;l&#305;k
 #BLOC_RESUME    (se&ccedil;imlik)
 takip eden blo&#287;un bir &ouml;zeti
 #BLOC_DEBUT
 Katlanabilir blo&#287;um (istenirse hedef URL\'yi g&ouml;sterecektir)
 #BLOC_FIN</code></quote>
', # MODIF
	'blocs:nom' => 'Katlanabilir Bloklar (D&eacute;pliables)',
	'boites_privees:description' => 'A&#351;a&#287;&#305;da tan&#305;mlanan t&uuml;m kutular &ouml;zel alanda g&ouml;r&uuml;n&uuml;rler. [[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]]
- {{&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; g&ouml;zden ge&ccedil;irmeleri}} : ([Source->@_CS_RSS_SOURCE@]) eklentisinin kodlar&#305;nda yap&#305;lan son de&#287;i&#351;iklikler akt&uuml;el konfig&uuml;rasyon sayfas&#305;nda bir &ccedil;er&ccedil;eve i&ccedil;inde g&ouml;sterilirler.
- {{SPIP format&#305;ndaki makaleler}} : yazarlar&#305; taraf&#305;ndan kullan&#305;lan kaynak kodlar&#305; g&ouml;rebilmeniz i&ccedil;in katlanabilir ek bir &ccedil;er&ccedil;eve.
- {{stat durumundaki yazarlar}} : [yazarlar sayfas&#305;nda->./?exec=auteurs] ba&#287;lanan son 10 kullan&#305;c&#305;y&#305; ve onaylanmam&#305;&#351; kay&#305;tlar&#305; g&ouml;steren &#287;m bir &ccedil;er&ccedil;eve. Bu bilgileri sadece y&ouml;neticiler g&ouml;rebilir.', # MODIF
	'boites_privees:nom' => '&Ouml;zel kutular',
	'bp_tri_auteurs' => 'Yazar s&#305;ralamalar&#305;',
	'bp_urls_propres' => 'Ki&#351;isel URL\'ler',
	'brouteur:description' => 'AJAX\'ta %rubrique_brouteur% ba&#351;l&#305;klar&#305;ndan yola &ccedil;&#305;karak ba&#351;l&#305;k se&ccedil;icisini kullanmak', # MODIF
	'brouteur:nom' => 'Ba&#351;l&#305;k se&ccedil;isinin ayarlanmas&#305;', # MODIF

	// C
	'cache_controle' => '&Ouml;nbellek kontrol&uuml;',
	'cache_nornal' => 'Normal kullan&#305;m',
	'cache_permanent' => 'Kal&#305;c&#305; &ouml;nbellek',
	'cache_sans' => '&Ouml;nbellek yok',
	'categ:admin' => '1. Y&ouml;netim',
	'categ:divers' => '6. Di&#287;er',
	'categ:interface' => '10. &Ouml;zel aray&uuml;z',
	'categ:public' => '4. Kamusal g&ouml;sterim',
	'categ:securite' => '5. S&eacute;curit&eacute;', # NEW
	'categ:spip' => '5. Komutlar, filtreler, kriterler',
	'categ:typo-corr' => '2. Metin geli&#351;tirmeleri',
	'categ:typo-racc' => '3. Tipografik K&#305;saltmalar',
	'certaines_couleurs' => 'Sadece a&#351;a&#287;&#305;da tan&#305;mlanan komutlar @_CS_ASTER@ :',
	'chatons:aide' => '"Chaton"lar : @liste@',
	'chatons:description' => '<code>:nom</code> tipinden zincirler bulunan t&uuml;m metinlere resim veya ({chat} i&ccedil;in "chaton") ekler.
_ Bu alet k&#305;sayollar&#305; plugins/couteau_suisse/img/chatons dizininde bulaca&#287;&#305; ayn&#305; isimdeki resimlerle de&#287;i&#351;tirir.', # MODIF
	'chatons:nom' => '"Chaton"lar',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de votre site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour &agrave; la ligne. En effet, les citations courtes doivent &ecirc;tre entour&eacute;es par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.', # NEW
	'citations_bb:nom' => 'Citations bien balis&eacute;es', # NEW
	'class_spip:description1' => 'Burada baz&#305; SPIP k&#305;sayollar&#305;n&#305; tan&#305;mlayabilirsiniz. Bo&#351; bir de&#287;er "Varsay&#305;lan&#305; kullan" anlam&#305;ndad&#305;r.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{SPIP k&#305;sayollar&#305;}}.

Burada baz&#305; SPIP k&#305;sayollar&#305;n&#305; tan&#305;mlayabilirsiniz. Bo&#351; de&#287;er varsay&#305;lan de&#287;erin kullan&#305;lmas&#305; demektir.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

SPIP normalde ara ba&#351;l&#305;klar i&ccedil;in &lt;h3&gt; komutunu kullan&#305;r. Burada ba&#351;ka bir komut se&ccedil;iniz :[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP koyuluk i&ccedil;in &lt;strong> komutunu kullanmay&#305; tercih etmi&#351;tir. Ama &lt;b> komutu da gayet uygun olur. Bu size kalm&#305;&#351; :[[%racc_g1%]][[->%racc_g2%]]

SPIP italik i&ccedil;in &lt;i> komutunu kullanmay&#305; tercih etmi&#351;tir. Ama &lt;em> komutu da gayet uygun olur. . Bu size kalm&#305;&#351; :[[%racc_i1%]][[->%racc_i2%]]

 Dipnotlar i&ccedil;in komut a&ccedil;an ve kapatan kodlar&#305; da siz belirleyebilirsiniz. (Dikkat ! De&#287;i&#351;iklikler yaln&#305;z kamusal alanda g&ouml;r&uuml;n&uuml;r.) : [[%ouvre_ref%]][[->%ferme_ref%]]
 
@puce@ {{Varsay&#305;lan SPIP stilleri}}. 1.92 s&uuml;r&uuml;m&uuml;ne kadar, tipografik k&#305;sayollar hep "spip" tipinde komutlar &uuml;retiyordu. &Ouml;rne&#287;in: <code><p class="spip"></code>. Burada komut stillerini stil sayfalar&#305;n&#305;za g&ouml;re tan&#305;mlayabilirsiniz. Bo&#351; bir kutu hi&ccedil;bir stil uygulanmayaca&#287;&#305;n&#305; g&ouml;sterir.

{Dikkat : e&#287;er yukar&#305;da (yatay &ccedil;izgi, ara ba&#351;l&#305;k, italik, koyu) gibi k&#305;sayollar de&#287;i&#351;tirilirse a&#351;a&#287;&#305;da stiller uygulanmayacakt&#305;r.}

<q1>
_ {{1.}} &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]] komutlar&#305;
_ {{2.}} &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; et les listes (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]] komutlar&#305;
 
&Ouml;nemli : 2. stili de&#287;i&#351;tirirseniz SPIP\'in bu komutlara ba&#287;l&#305; stillerini kaybedersiniz.</q1>', # MODIF
	'class_spip:nom' => 'SPIP ve k&#305;sayollar&#305;…',
	'code_css' => 'CSS',
	'code_fonctions' => '&#304;&#351;levler',
	'code_jq' => 'jQuery',
	'code_js' => 'Javascript',
	'code_options' => 'Se&ccedil;enekler',
	'code_spip_options' => 'SPIP se&ccedil;enekleri',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie priv&eacute;e', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options pr&eacute;c&eacute;dentes)', # NEW
	'contrib' => 'Daha fazla bilgi : @url@',
	'corbeille:description' => 'SPIP supprime automatiquement les objets mis au rebuts au bout de 24 heures, en g&eacute;n&eacute;ral vers 4 heures du matin, gr&acirc;ce &agrave; une t&acirc;che &laquo;CRON&raquo; (lancement p&eacute;riodique et/ou automatique de processus pr&eacute;programm&eacute;s). Vous pouvez ici emp&ecirc;cher ce processus afin de mieux g&eacute;rer votre corbeille.[[%arret_optimisation%]]',
	'corbeille:nom' => '&Ccedil;&ouml;p kutusu',
	'corbeille_objets' => '&Ccedil;&ouml;p kutusunda @nb@ nesne var.',
	'corbeille_objets_lies' => '@nb_lies@ ba&#287; g&ouml;r&uuml;ld&uuml;.',
	'corbeille_objets_vide' => '&Ccedil;&ouml;p kutusunda hi&ccedil; nesne yok', # MODIF
	'corbeille_objets_vider' => 'Se&ccedil;ilen nesneleri sil',
	'corbeille_vider' => '&Ccedil;&ouml;p kutusunu bo&#351;alt&nbsp;:',
	'couleurs:aide' => 'Renklendirme : <b>[coul]metin[/coul]</b>@fond@ ile <b>coul</b> = @liste@',
	'couleurs:description' => 'K&#305;sayollar&#305;n i&ccedil;inde komutlar kullanarak sitedeki t&uuml;m metinlere renk uygulanmas&#305;na olanak tan&#305;r (makaleler, k&#305;sa haberler, ba&#351;l&#305;klar, forum, ...).

Metin rengini de&#287;i&#351;tirmek i&ccedil;in 2 e&#351;de&#287;er &ouml;rnek:@_CS_EXEMPLE_COULEURS2@

Fon rengini de&#287;i&#351;tirmek i&ccedil;in (e&#287;er yukar&#305;daki se&ccedil;enek izin veriyorsa) :@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@Bu ki&#351;iselle&#351;tirilmi&#351; komutlar&#305;n format&#305; mevcut renkleri listelemeli veya &laquo;komut=renk&raquo; ikililerini virg&uuml;lle ayr&#305;lm&#305;&#351; bi&ccedil;imde tan&#305;mlamal&#305;d&#305;r. &Ouml;rnek : &laquo;gris, rouge&raquo;, &laquo;faible=jaune, fort=rouge&raquo;, &laquo;bas=#99CC11, haut=brown&raquo; veya &laquo;gris=#DDDDCC, rouge=#EE3300&raquo;. &#304;lk ve son &ouml;rnekler i&ccedil;in izin verilen komutlar &#351;unlard&#305;r : <code>[gris]</code> ve <code>[rouge]</code> (<code>[fond gris]</code> ve <code>[fond rouge]</code> - e&#287;er fona izin verilmi&#351;se -).', # MODIF
	'couleurs:nom' => 'Hepsi renkli',
	'couleurs_fonds' => ', <b>[fond&nbsp;coul]metin[/coul]</b>, <b>[bg&nbsp;coul]metin[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Log\'lar.}} {@_CS_DIR_TMP@} [[%log_couteau_suisse%]] dizininde  bulabilece&#287;iniz {spip.log} dosyalar&#305;nda &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305;n i&#351;leyi&#351;i hakk&#305;nda &ccedil;ok say&#305;da bilgi edinebilirsiniz.

@puce@ {{SPIP se&ccedil;enekleri.}} SPIP eklentileri belirli bir s&#305;rada d&uuml;zenler. &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305;n en ba&#351;ta  olmas&#305;n&#305; baz&#305; SPIP se&ccedil;eneklerini idare etmesini sa&#287;lamak i&ccedil;in &#351;u se&ccedil;ene&#287;i i&#351;aretleyiniz. E&#287;er hizmet biriminiz izin veriyorsa {@_CS_FILE_OPTIONS@} dosyas&#305; otomatik olarak de&#287;i&#351;tirilecek ve {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php} dosyas&#305;n&#305;n eklenmesine izin verecektir.
[[%spip_options_on%]]

@puce@ {{D&#305;&#351; sorgular.}} &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; yeni bir s&uuml;r&uuml;m&uuml;n&uuml;n olup olmad&#305;&#287;&#305;n&#305; d&uuml;zenli olarak kontrol eder ve yap&#305;land&#305;rma sayfas&#305;nda olas&#305; g&uuml;ncellemeleri bildirir. E&#287;er hizmet biriminizin d&#305;&#351; sorgular&#305; problem yarat&#305;yorsa o zaman &#351;u kutucu&#287;u i&#351;aretleyin.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; davran&#305;&#351;lar&#305;',
	'cs_distant_off' => 'Uzaktan s&uuml;r&uuml;mlerin do&#287;rulanmas&#305;',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;n&#305;n detayl&#305; kay&#305;tlar&#305;',
	'cs_reset' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305; ba&#351;tan ba&#351;latmak istedi&#287;inizden emin misiniz ?',
	'cs_reset2' => '&#350;u anda aktif olan t&uuml;m gere&ccedil;ler pasif hale getirilecek ve parametreleri s&#305;f&#305;rlanacakt&#305;r.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher &laquo;<html>@_CS_FILE_OPTIONS@</html>&raquo; a &eacute;chou&eacute; !', # NEW
	'cs_spip_options_on' => '&laquo;@_CS_FILE_OPTIONS@&raquo; i&ccedil;indeki SPIP se&ccedil;enekleri', # MODIF

	// D
	'decoration:aide' => 'Dekorasyon&nbsp;: <b>&lt;balise&gt;test&lt;/balise&gt;</b> ile <b>balise</b> = @liste@',
	'decoration:description' => '<NEW>De nouveaux styles param&eacute;trables dans vos textes et accessibles gr&acirc;ce &agrave; des balises &agrave; chevrons. Exemple : 
&lt;mabalise&gt;texte&lt;/mabalise&gt; ou : &lt;mabalise/&gt;.<br />D&eacute;finissez ci-dessous les styles CSS dont vous avez besoin, une balise par ligne, selon les syntaxes suivantes :
- {type.mabalise = mon style CSS}
- {type.mabalise.class = ma classe CSS}
- {type.mabalise.lang = ma langue (ex : fr)}
- {unalias = mabalise}

Le param&egrave;tre {type} ci-dessus peut prendre trois valeurs :
- {span} : balise &agrave; l\'int&eacute;rieur d\'un paragraphe (type Inline)
- {div} : balise cr&eacute;ant un nouveau paragraphe (type Block)
- {auto} : balise d&eacute;termin&eacute;e automatiquement par le plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Dekorasyon',
	'decoupe:aide' => 'T&#305;rnak blo&#287;u : <b>&lt;onglets>&lt;/onglets></b><br/>Sayfa veya t&#305;rnak ayrac&#305;&nbsp;: @sep@', # MODIF
	'decoupe:aide2' => 'Alias&nbsp;:&nbsp;@sep@',
	'decoupe:description' => 'Bir makalenin, otomatik bir sayfalama ile kamusal alanda bir ka&ccedil; sayfaya b&ouml;l&uuml;nerek g&ouml;sterilmesini sa&#287;lar. Makalenizde sadece pe&#351;pe&#351;e art&#305; i&#351;aretlerini(<code>++++</code>) kesinti yap&#305;lacak yerde kullan&#305;n.
_ E&#287;er bu ayrac&#305; &lt;onglets&gt; ve &lt;/onglets&gt; komutlar&#305;yla kullan&#305;rsan&#305;z bir &ccedil;ift t&#305;rnak elde edersiniz.
_ &#304;skeletlerde : &#351;u yeni komutlara sahipsiniz #ONGLETS_DEBUT, #ONGLETS_TITRE ve #ONGLETS_FIN.
_ Bu gere&ccedil; {makaleleriniz i&ccedil;in bir &ouml;zet} ile birlikte kullan&#305;labilir.', # MODIF
	'decoupe:nom' => 'Sayfalara ve ba&#351;l&#305;klara ay&#305;r',
	'desactiver_flash:description' => 'Sitenizin web sayfalar&#305;ndaki flash nesneleri siler ve ilintili alternatif i&ccedil;erikler de&#287;i&#351;tiri.',
	'desactiver_flash:nom' => 'Flash nesnelerini deaktive eder',
	'detail_balise_etoilee' => '{{Dikkat}} : V&eacute;rifiez bien l\'utilisation faite par vos squelettes des balises &eacute;toil&eacute;es. Les traitements de cet outil ne s\'appliqueront pas sur : @bal@.',
	'detail_disabled' => 'Param&egrave;tres non modifiables :', # NEW
	'detail_fichiers' => 'Dosyalar :',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'Inline kod :',
	'detail_jquery2' => 'Bu alet {jQuery} k&uuml;t&uuml;phanesini gerektirir.', # MODIF
	'detail_jquery3' => '{{Dikkat}} : bu gere&ccedil; sorunsuz &ccedil;al&#305;&#351;abilmek i&ccedil;in [SPIP 1.92-i&ccedil;in jQuery>http://files.spip.org/spip-zone/jquery_192.zip] eklentisi gerektirir.',
	'detail_pipelines' => 'Boru hatlar&#305; (pipeline) :',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_spip_options2' => 'Il est recommand&eacute; de placer les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;[.->cs_comportement]&raquo;.', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_traitements' => '&#304;&#351;lemler :',
	'devdebug:description' => '{{Cet outil vous permet de voir les erreurs PHP &agrave; l\'&eacute;cran.}}<br />Vous pouvez choisir le niveau d\'erreurs d\'ex&eacute;cution PHP qui sera affich&eacute; si le d&eacute;bogueur est actif, ainsi que l\'espace SPIP sur lequel ces r&eacute;glages s\'appliqueront.', # NEW
	'devdebug:item_e_all' => 'Tous les messages d&#039;erreur (all)', # NEW
	'devdebug:item_e_error' => 'Erreurs graves ou fatales (error)', # NEW
	'devdebug:item_e_notice' => 'Notes d&#039;ex&#233;cution (notice)', # NEW
	'devdebug:item_e_strict' => 'Tous les messages + les conseils PHP (strict)', # NEW
	'devdebug:item_e_warning' => 'Avertissements (warning)', # NEW
	'devdebug:item_espace_prive' => 'Espace priv&eacute;', # NEW
	'devdebug:item_espace_public' => 'Espace public', # NEW
	'devdebug:item_tout' => 'Tout SPIP', # NEW
	'devdebug:nom' => 'D&eacute;bogueur de d&eacute;veloppement', # NEW
	'distant_aide' => 'Cet outil requiert des fichiers distants qui doivent tous &ecirc;tre correctement install&eacute;s en librairie. Avant d\'activer cet outil ou d\'actualiser ce cadre, assurez-vous que les fichiers requis sont bien pr&eacute;sents sur le serveur distant.', # NEW
	'distant_charge' => 'Fichier correctement t&eacute;l&eacute;charg&eacute; et install&eacute; en librairie.', # NEW
	'distant_charger' => 'Lancer le t&eacute;l&eacute;chargement', # NEW
	'distant_echoue' => 'Erreur sur le chargement distant, cet outil risque de ne pas fonctionner !', # NEW
	'distant_inactif' => 'Fichier introuvable (outil inactif).', # NEW
	'distant_present' => 'Fichier pr&eacute;sent en librairie depuis le @date@.', # NEW
	'dossier_squelettes:description' => 'Kullan&#305;lan iskelet dizinini de&#287;i&#351;tirir. &Ouml;rne&#287;in : "squelettes/iskeletim". Dizinleri iki nokta ile ay&#305;rarak bir &ccedil;ok dizin belirtebilirsiniz  <html>&laquo;&nbsp;:&nbsp;&raquo;</html>. &#304;zleyen kutuyu bo&#351; b&#305;rakarak (veya "dist" yazarak) SPIP taraf&#305;ndan sunulan orijinal "dist" iskeletini kullanabilirsiniz. [[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => '&#304;skelet dosyas&#305;',

	// E
	'ecran_activer' => 'Activer l\'&eacute;cran de s&eacute;curit&eacute;', # NEW
	'ecran_conflit' => 'Attention : le fichier &laquo;@file@&raquo; entre en conflit et doit &ecirc;tre supprim&eacute; !', # NEW
	'ecran_ko' => 'Ecran inactif !', # NEW
	'ecran_maj_ko' => 'La version {{@n@}} de l\'&eacute;cran de s&eacute;curit&eacute; est disponible. Veuillez actualiser le fichier distant de cet outil.', # NEW
	'ecran_maj_ok' => '(semble &agrave; jour).', # NEW
	'ecran_securite:description' => 'L\'&eacute;cran de s&eacute;curit&eacute; est un fichier PHP directement t&eacute;l&eacute;charg&eacute; du site officiel de SPIP, qui prot&egrave;ge vos sites en bloquant certaines attaques li&eacute;es &agrave; des trous de s&eacute;curit&eacute;. Ce syst&egrave;me permet de r&eacute;agir tr&egrave;s rapidement lorsqu\'un probl&egrave;me est d&eacute;couvert, en colmatant le trou sans pour autant devoir mettre &agrave; niveau tout son site ni appliquer un &laquo; patch &raquo; complexe.

A savoir : l\'&eacute;cran verrouille certaines variables. Ainsi, par exemple, les  variables nomm&eacute;es <code>id_xxx</code> sont toutes  contr&ocirc;l&eacute;es comme &eacute;tant obligatoirement des valeurs num&eacute;riques enti&egrave;res, afin d\'&eacute;viter toute injection de code SQL via ce genre de variable tr&egrave;s courante. Certains plugins ne sont pas compatibles avec toutes les r&egrave;gles de l\'&eacute;cran, utilisant par exemple <code>&id_x=new</code> pour cr&eacute;er un objet {x}.

Outre la s&eacute;curit&eacute;, cet &eacute;cran a la capacit&eacute; r&eacute;glable de moduler les acc&egrave;s des robots  d\'indexation aux scripts PHP, de mani&egrave;re &agrave; leur dire de &laquo;&nbsp;revenir plus tard&nbsp;&raquo;  lorsque le serveur est satur&eacute;.[[ %ecran_actif%]][[->
@puce@ R&eacute;gler la protection anti-robots quand la charge du serveur (load)  exc&egrave;de la valeur : %ecran_load%
_ {La valeur par d&eacute;faut est 4. Mettre 0 pour d&eacute;sactiver ce processus.}@_ECRAN_CONFLIT@]]

En cas de mise &agrave; jour officielle, actualisez le fichier distant associ&eacute; (cliquez ci-dessus sur [actualiser]) afin de b&eacute;n&eacute;ficier de la protection la plus r&eacute;cente.

- Version du fichier local : ', # NEW
	'ecran_securite:nom' => 'Ecran de s&eacute;curit&eacute;', # NEW
	'effaces' => 'Silinmi&#351;',
	'en_travaux:description' => 'T&uuml;m kamusal sitede bak&#305;m yap&#305;l&#305;rken ki&#351;iselle&#351;tirilebilir bir mesaj yay&#305;nlanmas&#305;n&#305; sa&#287;lar.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]]', # MODIF
	'en_travaux:nom' => 'Sitede &ccedil;al&#305;&#351;ma var',
	'erreur:bt' => '<span style="color:red;">Dikkat :</span> tipografik &ccedil;izgi (s&uuml;r&uuml;m @version@) art&#305;k eskidi.<br />&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; @mini@ veya daha yeni bi rs&uuml;r&uuml;m ile uyumludur.',
	'erreur:description' => 'Alet tan&#305;m&#305;nda id eksik !',
	'erreur:distant' => 'uzak sunucu',
	'erreur:jquery' => '{{Not}} : {jQuery} k&uuml;t&uuml;phanesi bu sayfada pasif durumda g&ouml;r&uuml;l&uuml;yor. Eklentinin ba&#287;&#305;ml&#305;l&#305;klar&#305; paragraf&#305;na bak&#305;n&#305;z [->http://www.spip-contrib.net/?article2166].',
	'erreur:js' => 'bu sayfada bir JavaScript hatas&#305; olu&#351;tu ve sayfan&#305;n do&#287;ru &ccedil;al&#305;&#351;mas&#305;n&#305; engelliyor. L&uuml;tfen gezgininizde JavaScript\'i aktive edin veyasitenizdeki baz&#305; SPIP eklentilerini deaktive edin.',
	'erreur:nojs' => 'JavaScript bu sayfada deaktive edilmi&#351;.',
	'erreur:nom' => 'Hata !',
	'erreur:probleme' => 'Sorun var : @pb@',
	'erreur:traitements' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; - Derleme hatas&#305; : \'typo\' ve \'propre\' kar&#305;&#351;&#305;m&#305; yasakt&#305;r !',
	'erreur:version' => 'Bu gere&ccedil; SPIP\'in bu s&uuml;r&uuml;m&uuml;nde mevcut de&#287;il.',
	'erreur_groupe' => 'Attention : le groupe &laquo;@groupe@&raquo; n\'est pas d&#233;fini !', # NEW
	'erreur_mot' => 'Attention : le mot-cl&#233; &laquo;@mot@&raquo; n\'est pas d&#233;fini !', # NEW
	'etendu' => 'Kapsam',

	// F
	'f_jQuery:description' => '{jQuery}\'nin kamusal alana kurulmas&#305;n&#305; engeller, b&ouml;ylece &laquo;makine zaman&#305;&raquo;ndan biraz ekonomi yapar. Bu ([->http://jquery.com/]) kitapl&#305;&#287;&#305; Javascript programlamada bir &ccedil;ok kolayl&#305;k getirir ve baz&#305; eklentilerde kullan&#305;labilir. SPIP, Jquery\'yi &ouml;zel alanda kullan&#305;r.

Dikkat : baz&#305; &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; gere&ccedil;leri {jQuery} fonksiyonlar&#305;na ihtiya&ccedil; duyar. ', # MODIF
	'f_jQuery:nom' => 'jQuery\'yi deaktive eder',
	'filets_sep:aide' => 'Ay&#305;rma Fileleri (Filet)&nbsp;: <b>__i__</b>  <b>i</b> burada bir say&#305;y&#305; temsil eder.<br />Di&#287;er fileler : @liste@', # MODIF
	'filets_sep:description' => 'T&uuml;m SPIP etinlerine, stil sayfalar&#305; ile ki&#351;iselle&#351;tirilebilen ay&#305;rma filet\'leri ekler.
_ C&uuml;mle yap&#305;s&#305; &#351;&ouml;yledir : "__code__", burada "code" ya eklenecek filet\'nin (0\'dan 7\'ye kadar) kimlik say&#305;s&#305;n&#305; ya da plugins/couteau_suisse /img/filets dizinine yerle&#351;tirilen resmin ismini belirtir.', # MODIF
	'filets_sep:nom' => 'Ay&#305;rma Filesi (Filet)',
	'filtrer_javascript:description' => 'Makalelerde javascript kullan&#305;m&#305; i&ccedil;in 3 metod vard&#305;r :
- <i>jamais</i> : javascript her yerde reddedilir
- <i>d&eacute;faut</i> : javascript &ouml;zel alanda k&#305;rm&#305;z&#305; ile belirtilir 
- <i>toujours</i> : javascript her yerde kab&ucirc;l edilir.

Dikkat : forumlarda, dilek&ccedil;elerde, payla&#351;&#305;lan ak&#305;larda ve benzerlerinde javascript\'in y&ouml;netimi <b>daima</b> g&uuml;venlidir.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Javascript y&ouml;netimi',
	'flock:description' => 'PHP fonksiyonunu n&ouml;tralize ederek {flock()} dosya kilitleme sistemini deaktive eder. Baz&#305; bar&#305;nd&#305;rma firmalar&#305; uyumsuz dosya sistemi veya senkronizasyon eksikli&#287;i y&uuml;z&uuml;nden b&uuml;y&uuml;k sorunlara yol a&ccedil;maktad&#305;r. E&#287;er siteniz normal &ccedil;al&#305;&#351;&#305;yorsa bunu aktive etmeyin.',
	'flock:nom' => 'Dosya kilitleme yok',
	'fonds' => 'Arka alanlar :',
	'forcer_langue:description' => 'Dil cookie\'sini y&ouml;netmeyi bilen bir dil men&uuml;s&uuml; veya bir form i&ccedil;eren &ccedil;ok dilli iskelet tak&#305;m&#305;na sahip dile zorla', # MODIF
	'forcer_langue:nom' => 'Bu dile zorla',
	'format_spip' => 'SPIP format&#305;nda makaleler',
	'forum_lgrmaxi:description' => 'Varsay&#305;lan olarak, forum mesajlar&#305;n&#305;n boyu s&#305;n&#305;rlanmam&#305;&#351;t&#305;r. Bu gere&ccedil; aktive edildi&#287;inde, bir kullan&#305;c&#305; belirtilen boydan daha uzun bir mesaj g&ouml;ndermek istedi&#287;inde bir hata mesaj&#305; g&ouml;r&uuml;lecektir ve mesaj reddedilecektir. Bo&#351; bir de&#287;er veya S&#305;f&#305;r de&#287;eri hi&ccedil;bir s&#305;n&#305;r uygulanmad&#305;&#287;&#305;n&#305; belirtir. [[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Forumlar&#305;n boyutu',

	// G
	'glossaire:aide' => '&Ouml;zetsiz metin : <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Gestion d’un glossaire interne li&eacute; &agrave; un ou plusieurs groupes de mots-cl&eacute;s. Inscrivez ici le nom des groupes en  les s&eacute;parant par les deux points &laquo;&nbsp;:&nbsp;&raquo;. En laissant vide la case qui  suit (ou en tapant "Glossaire"), c’est le groupe "Glossaire" qui sera utilis&eacute;.[[%glossaire_groupes%]]

@puce@ Pour chaque mot, vous avez la possibilit&eacute; de choisir le nombre maximal de liens cr&eacute;&eacute;s dans vos textes. Toute valeur nulle ou n&eacute;gative implique que tous les mots reconnus seront trait&eacute;s. [[%glossaire_limite% par mot-cl&eacute;]]

@puce@ Deux solutions vous sont offertes pour g&eacute;n&eacute;rer la petite fen&ecirc;tre automatique qui appara&icirc;t lors du survol de la souris. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => '&#304;&ccedil; endeks',
	'glossaire_css' => 'CSS &ccedil;&ouml;z&uuml;m&uuml;',
	'glossaire_erreur' => 'Le mot &laquo;@mot1@&raquo; rend ind&#233;tectable le mot &laquo;@mot2@&raquo;', # NEW
	'glossaire_inverser' => 'Correction propos&#233;e : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Javascript &ccedil;&ouml;z&uuml;m&uuml;',
	'glossaire_ok' => 'La liste des @nb@ mot(s) &#233;tudi&#233;(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Normal t&#305;rnak i&#351;aretlerini (") tipografik t&#305;rnak i&#351;aretleriyle de&#287;i&#351;tirir. De&#287;i&#351;tirme kullan&#305;c&#305; taraf&#305;ndan g&ouml;r&uuml;lmez ve orijinal metni etkilemez sadece g&ouml;sterilen metni etkiler.',
	'guillemets:nom' => 'Tipografik t&#305;rnaklar',

	// H
	'help' => '{{Bu sayfa yaln&#305;z site sorumlular&#305;n&#305;n eri&#351;imine a&ccedil;&#305;kt&#305;r.}} &laquo;{{&#304;svi&ccedil;re&nbsp;&Ccedil;ak&#305;s&#305;}}&raquo; eklentisinin getirdi&#287;i farkl&#305; bir &ccedil;ok ek i&#351;levin d&uuml;zenlenmesine izin verir .',
	'help2' => 'Yerel s&uuml;r&uuml;m : @version@',
	'help3' => 'Belgelendirme ba&#287;lant&#305;lar&#305; :<br/>• [&#304;svi&ccedil;re&nbsp;&Ccedil;ak&#305;s&#305;->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Yeniden ba&#351;lat&#305;lmas&#305; :
_ • [Gizli gere&ccedil;lerin|Bu sayfan&#305;n ilk g&ouml;r&uuml;n&uuml;m&uuml;ne d&ouml;n&uuml;lmesi->@hide@]
_ • [T&uuml;m eklentinin|Eklentini ilk durumuna d&ouml;n&uuml;lmesi->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Geli&#351;tirilmekte olan gere&ccedil;. Size JavaScript bir saat sunuyor. Komut: <code>#HORLOGE{format,utc,id}</code>. Model : <code><horloge></code>', # MODIF
	'horloge:nom' => 'Saat',

	// I
	'icone_visiter:description' => 'Standart &laquo;&nbsp;Ziyaret Et&nbsp;&raquo; d&uuml;&#287;mesini (bu sayfan&#305;n sa&#287; &uuml;st&uuml;ndeki) e&#287;er varsa site logosu ile de&#287;i&#351;tirir.

Bu logoyu tan&#305;mlamak i&ccedil;in &laquo;&nbsp;Konfig&uuml;rasyon&nbsp;&raquo; d&uuml;&#287;mesine t&#305;klayarak &laquo;&nbsp;Site konfig&uuml;rasyonu&nbsp;&raquo; sayfas&#305;na gidiniz.', # MODIF
	'icone_visiter:nom' => '&laquo;&nbsp;Ziyaret Et&nbsp;&raquo; d&uuml;&#287;mesi', # MODIF
	'insert_head:description' => '[#INSERT_HEAD->http://www.spip.net/fr_article1902.html] komutunu (bu komutu &lt;head&gt; ve &lt;/head&gt; aras&#305;nda i&ccedil;erseler de i&ccedil;ermeseler de) t&uuml;m iskeletlerde etkinle&#351;tirir . Bu se&ccedil;enek sayesinde eklentiler javascript (.js) veya stil sayfas&#305; (.css) ekleyebilirler.',
	'insert_head:nom' => '#INSERT_HEAD komutu',
	'insertions:description' => 'DiKKAT : geli&#351;tirilmekte olan gere&ccedil; !! [[%insertions%]]',
	'insertions:nom' => 'Otomatik d&uuml;zeltmeler',
	'introduction:description' => '&#304;skeletlere yerle&#351;tirilecek bu komut genelde ana sayfaya veya ba&#351;l&#305;klarda makalelerin veya k&#305;sa haberlerin bir &ouml;zetini olu&#351;turmaya yarar.</p>
<p>{{Dikkat}} : Bu i&#351;levi aktive etmeden &ouml;nce iskeletinizde veya eklentilerinizde hi&ccedil;bir {balise_INTRODUCTION()} fonksiyonunun  olmad&#305;&#287;&#305;ndan emin olun, aksi halde derleme hatas&#305; olu&#351;acakt&#305;r.</p>
@puce@ #INTRODUCTION komutu taraf&#305;ndan g&ouml;nderilen metnin uzunlu&#287;unu (varsay&#305;lan de&#287;ere g&ouml;re y&uuml;zde olarak) belirtebilirsiniz. Bo&#351; bir de&#287;er veya 100 de&#287;eri metni de&#287;i&#351;tirmeyecektir ve &#351;u varsay&#305;lan de&#287;erleri kullanacakt&#305;r : makaleler i&ccedil;in 500 karakter, k&#305;sa haberler i&ccedil;in 300karakter, forumlar veya ba&#351;l&#305;klar i&ccedil;in 600 karakter.
[[%lgr_introduction%&nbsp;%]]
@puce@ E&#287;er metin &ccedil;ok uzunsa, #INTRODUCTION komutuna eklenen varsay&#305;lan &uuml;&ccedil; nokta &#351;&ouml;yledir : <html>&laquo;&amp;nbsp;(…)&raquo;</html>. Burada, metnin kesildi&#287;ini ve devam&#305; oldu&#287;unu siz kendi &ouml;zel karakter zincirinizi kullanarak okuyucular&#305;n&#305;za belirtebilirsiniz.
[[%suite_introduction%]]
@puce@ #INTRODUCTION komutu bir makaleyi &ouml;zetlemek i&ccedil;in kulan&#305;lm&#305;&#351;sa &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; &uuml;&ccedil; noktalar&#305;n &uuml;zerine bir hipermetin olu&#351;turarak okuru orijinal metne y&ouml;nlendirir. &Ouml;rne&#287;in : &laquo;Makalenin devam&#305; i&ccedil;in…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => '#INTRODUCTION komutu',

	// J
	'jcorner:description' => '&laquo;&nbsp;Jolis Coins&nbsp;&raquo;  {{renkli &ccedil;er&ccedil;evelerinizin}} k&ouml;&#351;elerinin bi&ccedil;imini kolayca de&#287;i&#351;tirebilece&#287;iniz bir kamusal alan gerecidir. Her &#351;ey m&uuml;mk&uuml;nd&uuml;r en az&#305;ndan bir &ccedil;ok &#351;eym&uuml;mk&uuml;nd&uuml;r!
_ &#350;u sayfada sonu&ccedil;lar&#305;  : [->http://www.malsup.com/jquery/corner/].

CSS c&uuml;mle yap&#305;s&#305;n&#305; kullanarak iskeletinizdeki nesneleri a&#351;a&#287;&#305;da listeleyiniz (.class, #id, vs. ). Kullan&#305;lacak jQuery komutunu belirtmek i&ccedil;in &laquo;&nbsp;=&nbsp;&raquo; i&#351;aretini kullan&#305;n&#305;z ve a&ccedil;&#305;klamalar i&ccedil;in &ccedil;ift kesme (&laquo;&nbsp;//&nbsp;&raquo;) kullan&#305;n&#305;z. E&#351;it i&#351;areti olmazsa yuvarlak k&ouml;&#351;eler uygulan&#305;r (yani &#351;una denk olur : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Dikkat, bu gere&ccedil; &ccedil;al&#305;&#351;mak i&ccedil;in {Round Corners} {jQuery} eklentisine gereksinim duyar. &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; [[%jcorner_plugin%]] kutusu i&#351;aretlendi&#287;inde bu eklentiyi otomatik olarak y&uuml;kler.', # MODIF
	'jcorner:nom' => 'Jolis Coins',
	'jcorner_plugin' => '&laquo;&nbsp;Round Corners plugin&nbsp;&raquo;',
	'jq_localScroll' => 'jQuery.LocalScroll ([d&eacute;mo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([d&eacute;mo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Varsay&#305;lan',
	'js_jamais' => 'Asla',
	'js_toujours' => 'Daima',
	'jslide_aucun' => 'Aucune animation', # NEW
	'jslide_fast' => 'Glissement rapide', # NEW
	'jslide_lent' => 'Glissement lent', # NEW
	'jslide_millisec' => 'Glissement durant&nbsp;:', # NEW
	'jslide_normal' => 'Glissement normal', # NEW

	// L
	'label:admin_travaux' => 'Kamusal alan&#305; &#351;una kapat :',
	'label:arret_optimisation' => 'SPIP\'in &ccedil;&ouml;p kutusunu otomatik olarak bo&#351;altmas&#305;n&#305; engelle&nbsp;:',
	'label:auteur_forum_nom' => 'Le visiteur doit sp&eacute;cifier :', # NEW
	'label:auto_sommaire' => '&Ouml;zet\'in sistemli bi&ccedil;imde olu&#351;turulmas&#305; :',
	'label:balise_decoupe' => '#CS_DECOUPE komutunu aktive et :',
	'label:balise_sommaire' => '#CS_SOMMAIRE komutunu aktive et :',
	'label:bloc_h4' => 'Ba&#351;l&#305;klar i&ccedil;in komut&nbsp;:',
	'label:bloc_unique' => 'Sayfada sadece bir blok a&ccedil;&#305;k :',
	'label:blocs_cookie' => 'Kurabiye kullan&#305;m&#305; :',
	'label:blocs_slide' => 'Type d\'animation&nbsp;:', # NEW
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal r&eacute;serv&eacute; aux copies locales :', # NEW
	'label:couleurs_fonds' => 'Arka alanlara izin ver :',
	'label:cs_rss' => 'Aktive et :',
	'label:debut_urls_propres' => 'URL\'lerin ba&#351;lang&#305;c&#305; :',
	'label:decoration_styles' => 'Ki&#351;iselle&#351;tirilmi&#351; stil komutlar&#305;n&#305;z :',
	'label:derniere_modif_invalide' => 'Bir de&#287;i&#351;iklikten sonra yeniden hesapla :',
	'label:devdebug_espace' => 'Filtrage de l\'espace concern&#233; :', # NEW
	'label:devdebug_mode' => 'Activer le d&eacute;bogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoy&eacute; :', # NEW
	'label:distant_off' => 'Pasif k&#305;l :',
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Kullan&#305;lacak dizinler :',
	'label:duree_cache' => 'Yerel &ouml;nbelle&#287;in s&uuml;resi :',
	'label:duree_cache_mutu' => '&Ouml;n bellek s&uuml;resi :',
	'label:ecran_actif' => '@_CS_CHOIX@', # NEW
	'label:enveloppe_mails' => 'E-postalar&#305;n &ouml;n&uuml;ndeki k&uuml;&ccedil;&uuml;k zarf :',
	'label:expo_bofbof' => '&#350;u karakterleri &uuml;ssel hale getirir : <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:forum_lgrmaxi' => 'De&#287;er (karakter cinsinden) :',
	'label:glossaire_groupes' => 'Kullan&#305;lan gruplar :',
	'label:glossaire_js' => 'Kullan&#305;lan teknik :',
	'label:glossaire_limite' => 'Olu&#351;turulan maksimum ba&#287; :',
	'label:i_align' => 'Alignement du texte&nbsp;:', # NEW
	'label:i_couleur' => 'Couleur de la police&nbsp;:', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (&eacute;q. &agrave; {line-height})&nbsp;:', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte&nbsp;:', # NEW
	'label:i_padding' => 'Espacement autour du texte (&eacute;q. &agrave; {padding})&nbsp;:', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/})&nbsp;:', # NEW
	'label:i_taille' => 'Taille de la police&nbsp;:', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Otomatik d&uuml;zeltmeler :',
	'label:jcorner_classes' => '&#350;u se&ccedil;icilerin k&ouml;&#351;elerini geli&#351;tirir :',
	'label:jcorner_plugin' => '&#350;u {jQuery} eklentisini y&uuml;kle :',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => '&Ouml;zet\'in uzunlu&#287;u :',
	'label:lgr_sommaire' => '&Ouml;zet\'in b&uuml;y&uuml;kl&uuml;&#287;&uuml; (9 &agrave; 99) :',
	'label:lien_introduction' => 'T&#305;klanabilir &uuml;&ccedil; nokta :',
	'label:liens_interrogation' => '&#350;u URL\'leri koru :',
	'label:liens_orphelins' => 'T&#305;klanabilir ba&#287;lar :',
	'label:log_couteau_suisse' => 'Aktive et :',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:marqueurs_urls_propres' => 'Nesneleri ay&#305;ran ayra&ccedil;lar&#305; ekle (SPIP>=2.0) :<br/>(&ouml;r. : &laquo;&nbsp;-&nbsp;&raquo; -Benim-ba&#351;l&#305;&#287;&#305;m- i&ccedil;in, &laquo;&nbsp;@&nbsp;&raquo; @Benim-sitem@ i&ccedil;in) ', # MODIF
	'label:max_auteurs_page' => 'Bir sayfadaki yazar adedi :',
	'label:message_travaux' => 'Bak&#305;m mesaj&#305;n&#305;z :',
	'label:moderation_admin' => 'Mesajlar&#305; otomatik olarak onaylanacaklar : ',
	'label:mot_masquer' => 'Mot-cl&#233; masquant les contenus :', # NEW
	'label:ouvre_note' => 'Dipnotlar&#305;n a&ccedil;&#305;l&#305;p kapat&#305;lmas&#305;',
	'label:ouvre_ref' => 'Dipnot &ccedil;a&#287;r&#305;lar&#305;n&#305;n a&ccedil;&#305;l&#305;p kapat&#305;lmas&#305;',
	'label:paragrapher' => 'Daima paragraflanmal&#305; :',
	'label:prive_travaux' => '&Ouml;zel alana eri&#351;im :',
	'label:prof_sommaire' => 'Profondeur retenue (1 &agrave; 4) :', # NEW
	'label:puce' => 'Kamusal ikon &laquo;<html>-</html>&raquo; :',
	'label:quota_cache' => 'Kota de&#287;eri :',
	'label:racc_g1' => '&laquo;<html>{{koyu}}</html>&raquo; giri&#351; &ccedil;&#305;k&#305;&#351;&#305; :',
	'label:racc_h1' => ' &laquo;<html>{{{intertitre}}}</html>&raquo; giri&#351; &ccedil;&#305;k&#305;&#351;&#305; :',
	'label:racc_hr' => 'Yatay &ccedil;izgi &laquo;<html>----</html>&raquo; :',
	'label:racc_i1' => '&laquo;<html>{italik}</html>&raquo; giri&#351; &ccedil;&#305;k&#305;&#351;&#305;:',
	'label:radio_desactive_cache3' => '&Ouml;nbellek kullan&#305;m&#305; :',
	'label:radio_desactive_cache4' => '&Ouml;nbellek kullan&#305;m&#305; :',
	'label:radio_target_blank3' => 'D&#305;&#351; ba&#287;lar i&ccedil;in yeni pencere:',
	'label:radio_type_urls3' => 'URL\'lerin format&#305; :',
	'label:scrollTo' => 'Eklentileri {jQuery} kur :',
	'label:separateur_urls_page' => 'Ayra&ccedil; \'type-id\'<br/>(&ouml;r. : ?article-123) :', # MODIF
	'label:set_couleurs' => 'Kullan&#305;lacak set :',
	'label:spam_ips' => 'Adresses IP &agrave; bloquer :', # NEW
	'label:spam_mots' => 'Yasaklanan diziler :',
	'label:spip_options_on' => 'Ekle :',
	'label:spip_script' => '&Ccedil;a&#287;r&#305; script\'i :',
	'label:style_h' => 'Stiliniz :',
	'label:style_p' => 'Stiliniz :',
	'label:suite_introduction' => '&Uuml;&ccedil; nokta  :',
	'label:terminaison_urls_page' => 'URL soyadlar&#305; (&ouml;r : &laquo;&nbsp;.html&nbsp;&raquo;) :',
	'label:titre_travaux' => 'Mesaj&#305;n ba&#351;l&#305;&#287;&#305; :',
	'label:titres_etendus' => '#TITRE_XXX komutlar&#305;n&#305;n geni&#351; kullan&#305;m&#305;n&#305; etkinle&#351;tir&nbsp; :',
	'label:url_arbo_minuscules' => 'URL\'lerde k&uuml;&ccedil;&uuml;k b&uuml;y&uuml;k harfleri koru :',
	'label:url_arbo_sep_id' => 'Tekrarlama durumunda kullan&#305;lacak ayra&ccedil; \'titre-id\' :<br/>(\'/\' kullanmay&#305;n)', # MODIF
	'label:url_glossaire_externe2' => 'D&#305;&#351; s&ouml;zl&uuml;&#287;e ba&#287; :',
	'label:url_max_propres' => 'Longueur maximale des URLs (caract&egrave;res) :', # NEW
	'label:urls_arbo_sans_type' => 'URL\'lerde SPIP nesnesinin tipini g&ouml;ster :',
	'label:urls_avec_id' => 'Sistematik bir kimlik, ama ...',
	'label:webmestres' => 'Site y&ouml;neticilerinin listesi :',
	'liens_en_clair:description' => 'Met &agrave; votre disposition le filtre : \'liens_en_clair\'. Votre texte contient probablement des liens hypertexte qui ne sont pas visibles lors d\'une impression. Ce filtre ajoute entre crochets la destination de chaque lien cliquable (liens externes ou mails). Attention : en mode impression (parametre \'cs=print\' ou \'page=print\' dans l\'url de la page), cette fonctionnalit&eacute; est appliqu&eacute;e automatiquement.', # NEW
	'liens_en_clair:nom' => 'A&ccedil;&#305;kta b&#305;rak&#305;lm&#305;&#351; ba&#287;lar',
	'liens_orphelins:description' => 'Bu gerecin 2 i&#351;levi vard&#305;r:

@puce@ {{Do&#287;ru ba&#287;lar}}.

SPIP, frans&#305;z gramerine ba&#287;l&#305; olarak soru ve &uuml;nlem i&#351;aretlerinden &ouml;nce bir bo&#351;luk b&#305;rak&#305;r. &#304;&#351;te size metinlerinizde bulunan URL\'lerdeki soru i&#351;aretlerini koruyan bir gere&ccedil;.[[%liens_interrogation%]]

@puce@ {{Yetim ba&#287;lar}}.

Kullan&#305;c&#305;lar taraf&#305;ndan metin olarak b&#305;rak&#305;lm&#305;&#351; \'t&#305;klanamayan\' t&uuml;m URL\'leri sistemli bi&ccedil;imde SPIP format&#305;nda hipermetin ba&#287;lar&#305;yla de&#287;i&#351;tirir (&ouml;zellikle forumlarda). &Ouml;rne&#287;in : {<html>www.spip.net</html>} [->www.spip.net] ile de&#287;i&#351;tirilir.

De&#287;i&#351;tirme tipini siz se&ccedil;ebilirsiniz :
_ • {Temel} : {<html>http://spip.net</html>} (t&uuml;m  protokoller) veya  {<html>www.spip.net</html>} de&#287;i&#351;tirilir.
_ • {Yayg&#305;n} : &#351;u tipteki ba&#287;lar da de&#287;i&#351;tirilir {<html>moi@spip.net</html>}, {<html>mailto:monmail</html>} veya {<html>news:mesnews</html>}.
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:nom' => 'G&uuml;zel URL\'ler',

	// M
	'mailcrypt:description' => 'Metinlerinizde bulunan t&uuml;m ba&#287;lar&#305; maskeler ve bir Javascript ba&#287; yard&#305;m&#305;yla okuyucunun mesajla&#351;mas&#305;n&#305; aktive etme olana&#287;&#305; tan&#305;r. Bu anti-spam gereci robotlar&#305;n, forumlarda veya iskeletlerde kullan&#305;lan komutlarda a&ccedil;&#305;kta b&#305;rak&#305;lan elektronik adresleri toplamas&#305;n&#305; engellemeye &ccedil;al&#305;&#351;&#305;r.',
	'mailcrypt:nom' => 'MailCrypt',
	'maj_auto:description' => 'Cet outil vous permet de g&eacute;rer facilement la mise &agrave; jour de vos diff&eacute;rents plugins, r&eacute;cup&eacute;rant notamment le num&eacute;ro de r&eacute;vision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouv&eacute; sur <code>zone.spip.org</code>.



La liste ci-dessus offre la possibilit&eacute; de lancer le processus de mise &agrave; jour automatique de SPIP sur chacun des plugins pr&eacute;alablement install&eacute;s dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> sont simplement list&eacute;s &agrave; titre d\'information. Si la r&eacute;vision distante n\'a pas pu &ecirc;tre trouv&eacute;e, alors tentez de proc&eacute;der manuellement &agrave; la mise &agrave; jour du plugin.



Note : les paquets <code>.zip</code> n\'&eacute;tant pas reconstruits instantan&eacute;ment, il se peut que vous soyez oblig&eacute; d\'attendre un certain d&eacute;lai avant de pouvoir effectuer la totale mise &agrave; jour d\'un plugin tout r&eacute;cemment modifi&eacute;.', # NEW
	'maj_auto:nom' => 'Mises &agrave; jour automatiques', # NEW
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particuli&egrave;re de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-cl&#233; d&eacute;fini ci-dessous. Si une rubrique est masqu&eacute;e, toute sa branche l\'est aussi.[[%mot_masquer%]]



Pour forcer l\'affichage des contenus masqu&eacute;s, il suffit d\'ajouter le crit&egrave;re <code>{tout_voir}</code> aux boucles de votre squelette.', # NEW
	'masquer:nom' => 'Masquer du contenu', # NEW
	'meme_rubrique:description' => 'D&eacute;finissez ici le nombre d\'objets list&eacute;s dans le cadre nomm&eacute; &laquo;<:info_meme_rubrique:>&raquo; et pr&eacute;sent sur certaines pages de l\'espace priv&eacute;.[[%meme_rubrique%]]', # NEW
	'message_perso' => 'Buraya u&#287;rayacak &ccedil;evirmenlere &ccedil;ok &ccedil;ok te&#351;ekk&uuml;rler. Pat ;-)',
	'moderation_admins' => 'onayl&#305; y&ouml;neticiler',
	'moderation_message' => 'Bu forum &ouml;n tan&#305;ml&#305; olarak y&ouml;netilmektedir &nbsp;: katk&#305;n&#305;z, e&#287;er direkt yay&#305;nlama hakk&#305;n&#305;z yoksa, bir site y&ouml;neticisi taraf&#305;ndan onayland&#305;ktan sonra g&ouml;r&uuml;necektir.',
	'moderation_moderee:description' => 'Kay&#305;tl&#305; kullan&#305;c&#305;lar&#305;n y&ouml;netimini y&ouml;netmeyi sa&#287;lar. [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Y&ouml;netimin y&ouml;netimi',
	'moderation_redacs' => 'onayl&#305; redakt&ouml;rler',
	'moderation_visits' => 'onayl&#305; ziyaret&ccedil;iler',
	'modifier_vars' => '@nb@ parametreyi de&#287;i&#351;tir',
	'modifier_vars_0' => 'Bu parametreleri de&#287;i&#351;tir',

	// N
	'no_IP:description' => '&Ouml;zel bilgilerin korunmas&#305; endi&#351;esiyle sitenizi ziyaret edenlerin IP adreslerinin otomatik olarak kaydeilmesi i&#351;lemini durdurur : SPIP art&#305;k istatistikler i&ccedil;in veya spip.log dosyas&#305; i&ccedil;in forumlarda bile ziyaretler esnas&#305;nda ge&ccedil;ici olarak hi&ccedil;bir IP numaras&#305;n&#305; saklamayacakt&#305;r.',
	'no_IP:nom' => 'IP kayd&#305; yapma',
	'nouveaux' => 'Yeni',

	// O
	'orientation:description' => '&#304;skeletleriniz i&ccedil;in 3 yeni kriter : <code>{portrait}</code>, <code>{carre}</code> ve <code>{paysage}</code>. Foto&#287;raflar&#305;n &#351;ekilleri bak&#305;m&#305;ndan s&#305;n&#305;fland&#305;r&#305;lmas&#305; i&ccedil;in ideal.',
	'orientation:nom' => 'Resimlerin y&ouml;n&uuml;',
	'outil_actif' => 'Aktif alet',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Aktive et',
	'outil_activer_le' => 'Aleti aktive et',
	'outil_cacher' => 'Art&#305;k g&ouml;sterme',
	'outil_desactiver' => 'Deaktive et',
	'outil_desactiver_le' => 'Aleti deaktive et',
	'outil_inactif' => '&#304;naktif aktif',
	'outil_intro' => 'Bu sayfa size sunulan eklenti i&#351;levlerini listeler. <br /><br />A&#351;a&#287;&#305;daki gere&ccedil; isimlerine t&#305;klayarak merkez&icirc; d&uuml;&#287;me ile durumlar&#305;n&#305; de&#287;i&#351;tirebilece&#287;iniz gere&ccedil;leri se&ccedil;ebilirsiniz : etkinle&#351;tirilen gere&ccedil;ler pasifle&#351;tirilecektir veya <i>tam tersi</i>. Her t&#305;klamada tan&#305;mlama listenin alt&#305;nda g&ouml;r&uuml;l&uuml;r. Kategoriler katlanabilir ve gere&ccedil;ler saklanabilir. &Ccedil;ift t&#305;klama bir gerecin durumunu h&#305;zl&#305;ca de&#287;i&#351;tirmeye olanak tan&#305;r. <br /><br />&#304;lk kullan&#305;m i&ccedil;in, SPIP iskeletinizle veya di&#287;er eklentilerle &ccedil;ak&#305;&#351;ma olabilece&#287;i sebebiyle gere&ccedil;leri birer birer etkinle&#351;tirmeniz &ouml;nerilir.<br /><br />Not : bu sayfan&#305;n tekrar y&uuml;klenmesi &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305; tekrardan derler.',
	'outil_intro_old' => 'Bu aray&uuml;z eski.<br /><br />E&#287;er <a href=\'./?exec=admin_couteau_suisse\'>yeni aray&uuml;z</a>\'&uuml;n kullan&#305;m&#305;nda sorunla kar&#351;&#305;la&#351;&#305;rsan&#305;z, bizle <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a> forumunda payla&#351;maktan &ccedil;ekinmeyin.',
	'outil_nb' => '@pipe@ : @nb@ alet', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ alet', # MODIF
	'outil_permuter' => '&laquo; @text@ &raquo; gereci de&#287;i&#351;tirilsin mi ?',
	'outils_actifs' => 'Aktif aletler :',
	'outils_caches' => 'Sakl&#305; aletler :',
	'outils_cliquez' => 'Yukar&#305;daki gere&ccedil;lerin a&ccedil;&#305;klamalar&#305;n&#305; g&ouml;rmek i&ccedil;in isimlerine t&#305;klay&#305;n&#305;z.',
	'outils_concernes' => 'Sont concern&eacute;s : ', # NEW
	'outils_desactives' => 'Sont d&eacute;sactiv&eacute;s : ', # NEW
	'outils_inactifs' => '&#304;naktif aletler :',
	'outils_liste' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; aletleri listesi ',
	'outils_non_parametrables' => 'Ayarlanamaz&nbsp;:',
	'outils_permuter_gras1' => 'Koyu yaz&#305;l&#305; aletleri &ccedil;aprazla (Permuter)',
	'outils_permuter_gras2' => 'Koyu @nb@ gere&ccedil;leri de&#287;i&#351;tirilsin mi?',
	'outils_resetselection' => 'Se&ccedil;imleri ba&#351;tan al',
	'outils_selectionactifs' => 'T&uuml;m aktif aletleri se&ccedil;',
	'outils_selectiontous' => 'HEPS&#304;',

	// P
	'pack_actuel' => '@date@ paketi',
	'pack_actuel_avert' => 'Dikkat, define()\'lar ve global\'ler &uuml;zerindeki y&uuml;k burada belirtilmez', # MODIF
	'pack_actuel_titre' => '&#304;SV&#304;&Ccedil;RE &Ccedil;AKISI\'NIN G&Uuml;NCEL KONF&#304;G&Uuml;RASYON PAKET&#304;',
	'pack_alt' => 'Aktif konfig&uuml;rasyonun parametrelerini g&ouml;ster',
	'pack_delete' => 'Supression d\'un pack de configuration', # NEW
	'pack_descrip' => '"G&uuml;ncel konfig&uuml;rasyon paketiniz" &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305;n parametrelerini i&ccedil;erir : gere&ccedil;lerin etkinle&#351;tirilmesi ve olas&#305; de&#287;i&#351;kenlerin de&#287;erleri.

Bu PHP kodu /config/mes_options.php dosyas&#305;nda yer al&#305;r ve bu sayfaya "{G&uuml;ncel Paket} paketinin". s&#305;f&#305;rlanms&#305;n&#305; sa&#287;layan ba&#287;lant&#305;y&#305; ekler. Tabii a&#351;a&#287;&#305;daki ismi de&#287;i&#351;tirebilirsiniz.

E&#287;er eklentiyi bir pakete t&#305;klayarak s&#305;f&#305;rlarsan&#305;z &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; kendisini paketteki &ouml;nceden tan&#305;ml&#305; parametreleri kullanarak yeniden konfig&uuml;re edecektir.', # MODIF
	'pack_du' => '• @pack@ paketinin',
	'pack_installe' => 'Bir konfig&uuml;rasyon paketini y&uuml;kle',
	'pack_installer' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305; yeniden ba&#351;latmak ve &laquo;&nbsp;@pack@&nbsp;&raquo; paketini kurmak istedi&#287;inizden emin misiniz ?',
	'pack_nb_plrs' => '&#350;u anda g&uuml;ncel @nb@ &laquo;&nbsp;konfig&uuml;rasyon paketi&nbsp;&raquo; var.', # MODIF
	'pack_nb_un' => '&#350;u anda g&uuml;ncel bir &laquo;&nbsp;konfig&uuml;rasyon paketi&nbsp;&raquo; var', # MODIF
	'pack_nb_zero' => '&#350;u anda g&uuml;ncel bir &laquo;&nbsp;konfig&uuml;rasyon paketi&nbsp;&raquo; yok.',
	'pack_outils_defaut' => 'Varsay&#305;lan gere&ccedil;lerin kurulumu',
	'pack_sauver' => 'G&uuml;ncel konfig&uuml;rasyonu kaydet',
	'pack_sauver_descrip' => 'A&#351;a&#287;&#305;daki d&uuml;&#287;me soldaki men&uuml;ye &laquo;&nbsp;konfig&uuml;rasyon paketi&nbsp;&raquo; eklemek i&ccedil;in <b>@file@</b> dosyan&#305;za gerekli parametreleri direkt olarak ekleme olana&#287;&#305; tan&#305;r. B&ouml;ylece ileride tek t&#305;kla &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305; &#351;u andaki konfig&uuml;rasyonuna geri, d&ouml;nd&uuml;rebilirsiniz.',
	'pack_supprimer' => '&Ecirc;tes-vous s&ucirc;r de vouloir supprimer le pack &laquo;&nbsp;@pack@&nbsp;&raquo; ?', # NEW
	'pack_titre' => 'Akt&uuml;el Konfig&uuml;rasyon',
	'pack_variables_defaut' => 'Varsay&#305;lan de&#287;i&#351;kenlerin kurulumu',
	'par_defaut' => 'Varsay&#305;lan',
	'paragrapher2:description' => '<code>paragrapher()</code> SPIP fonksiyonu &lt;p&gt; ve &lt;/p&gt; komutlar&#305;n&#305; paragraf i&ccedil;ermeyen t&uuml;m metinlere ekler. Stillerinizi ve sayfa d&uuml;zenlemelerinizi daha zarif bi&ccedil;imde y&ouml;netmek i&ccedil;in sitenizdeki metinleri tektip hale getirme olana&#287;&#305; tan&#305;r.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Paragrafla',
	'pipelines' => 'Kullan&#305;lan boru hatlar&#305;&nbsp;:',
	'previsualisation:description' => 'Par d&eacute;faut, SPIP permet de pr&eacute;visualiser un article dans sa version publique et styl&eacute;e, mais uniquement lorsque celui-ci a &eacute;t&eacute; &laquo; propos&eacute; &agrave; l&rsquo;&eacute;valuation &raquo;. Hors cet outil permet aux auteurs de pr&eacute;visualiser &eacute;galement les articles pendant leur r&eacute;daction. Chacun peut alors pr&eacute;visualiser et modifier son texte &agrave; sa guise.



@puce@ Attention : cette fonctionnalit&eacute; ne modifie pas les droits de pr&eacute;visualisation. Pour que vos r&eacute;dacteurs aient effectivement le droit de pr&eacute;visualiser leurs articles &laquo; en cours de r&eacute;daction &raquo;, vous devez l&rsquo;autoriser (dans le menu {[Configuration&gt;Fonctions avanc&eacute;es->./?exec=config_fonctions]} de l&rsquo;espace priv&eacute;).', # NEW
	'previsualisation:nom' => 'Pr&eacute;visualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci &laquo;*&raquo;', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Makalelerdeki &laquo;-&raquo; (basit tire) i&#351;aretlerini &laquo;-*&raquo; ile de&#287;i&#351;tirir (HTML\'e : &lt;ul>&lt;li>…&lt;/li>&lt;/ul> olarak &ccedil;evrilir). Bunlar&#305;n bi&ccedil;imi css ile ki&#351;iselle&#351;tirilebilir.', # MODIF
	'pucesli:nom' => 'G&uuml;zel simgeler',

	// Q
	'qui_webmestres' => 'SPIP web y&ouml;neticileri',

	// R
	'raccourcis' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305;n aktif tipografik k&#305;sayollar&#305;&nbsp;:',
	'raccourcis_barre' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305;n tipografik k&#305;sayollar&#305;',
	'reserve_admin' => 'Y&ouml;neticilere ayr&#305;lm&#305;&#351; eri&#351;im.',
	'rss_actualiser' => 'G&uuml;ncelle',
	'rss_attente' => 'RSS bekleniyor...',
	'rss_desactiver' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305;n "G&ouml;zden Ge&ccedil;irmeleri"ni deaktive et',
	'rss_edition' => 'RSS ak&#305;&#351;&#305;n&#305;n g&uuml;ncellenme tarihi :',
	'rss_source' => 'RSS kayna&#287;&#305;',
	'rss_titre' => '&laquo;&nbsp;&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;&nbsp;&raquo; geli&#351;tirilmekte :',
	'rss_var' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;\'n&#305;n "G&ouml;zden Ge&ccedil;irmeleri"',

	// S
	'sauf_admin' => 'Y&ouml;neticiler d&#305;&#351;&#305;nda herkes',
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et r&eacute;dacteurs', # NEW
	'sauf_identifies' => 'Tous, sauf les auteurs identifi&eacute;s', # NEW
	'set_options:description' => 'Mevcut veya gelecek t&uuml;m redakt&ouml;rler veya &ouml;zel aray&uuml;z&uuml; se&ccedil;er (basit veya geli&#351;mi&#351;) ve k&uuml;&ccedil;&uuml;k ikonlar band&#305;na ait d&uuml;&#287;meyi siler.[[%radio_set_options4%]]',
	'set_options:nom' => '&Ouml;zel aray&uuml;z tipi',
	'sf_amont' => 'En amont', # NEW
	'sf_tous' => 'Hepsi',
	'simpl_interface:description' => 'Renkli ikonun &uuml;zerinden ge&ccedil;erken bir makalenin stat&uuml;s&uuml;n&uuml; h&#305;zl&#305; y&uuml;kleme men&uuml;s&uuml;n&uuml; dezaktive eder. E&#287;er \'client\' performas&#305;n&#305; artt&#305;rmak i&ccedil;in &ouml;zel bir aray&uuml;z istiyorsan&#305;z idealdir.',
	'simpl_interface:nom' => '&Ouml;zel aray&uuml;z&uuml;n hafifletilmesi',
	'smileys:aide' => 'G&uuml;len y&uuml;zler : @liste@',
	'smileys:description' => '<acronym>:-)</acronym> tipinde k&#305;sayol i&ccedil;eren t&uuml;m metinlere g&uuml;len y&uuml;z ekler. Forumlar i&ccedil;in ideal. 
_ &#304;skeletlerinizde g&uuml;len suratlar&#305; bir tabloda g&ouml;stermek i&ccedil;in bir komut mevcuttur : #SMILEYS.
_ Dessins : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'G&uuml;len y&uuml;zler (smileys)',
	'soft_scroller:description' => 'Kamusal sitenizdeki sayfan&#305;n, ziyaret&ccedil;i ba&#351;ka bir sayfaya y&ouml;nlendiren bir &ccedil;apaya t&#305;klad&#305;&#287;&#305;nda yumu&#351;ak bir bi&ccedil;imde kaymas&#305;n&#305; sa&#287;lar : karma&#351;&#305;k bir sayfada veya &ccedil;ok uzun bir metinde kaybolmay&#305; &ouml;nlemek i&ccedil;in &ccedil;ok kullan&#305;&#351;l&#305;d&#305;r...

Attention, cet outil a besoin pour fonctionner de pages au &laquo;DOCTYPE XHTML&raquo; (non HTML !) et de deux plugins {jQuery} : {ScrollTo} et {LocalScroll}. Le Couteau Suisse peut les installer directement si vous cochez les cases suivantes. [[%scrollTo%]][[-->%LocalScroll%]]
 @_CS_PLUGIN_JQUERY192@ Dikkat, bu gere&ccedil; &ccedil;al&#305;&#351;mak i&ccedil;in &laquo;DOCTYPE XHTML&raquo; tipinden sayfalara (HTML de&#287;il!) ve iki {jQuery} eklentisine gereksinim duyar : {ScrollTo} ve {LocalScroll}. &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;, e&#287;er &#351;u kutucuklar&#305; i&#351;aratlerseniz bunlar&#305; direkt olarak kurabilir. [[%scrollTo%]][[->%LocalScroll%]]', # MODIF
	'soft_scroller:nom' => 'Yumu&#351;ak &ccedil;apalar',
	'sommaire:description' => 'Construit un sommaire pour le texte de vos articles et de vos rubriques afin d’acc&eacute;der rapidement aux gros titres (balises HTML &lt;h3>Un intertitre&lt;/h3> ou raccourcis SPIP : intertitres de la forme :<code>{{{Un gros titre}}}</code>).

@puce@ Vous pouvez d&eacute;finir ici le nombre maximal de caract&egrave;res retenus des intertitres pour construire le sommaire :[[%lgr_sommaire% caract&egrave;res]]

@puce@ Vous pouvez aussi fixer le comportement du plugin concernant la cr&eacute;ation du sommaire: 
_ • Syst&eacute;matique pour chaque article (une balise <code>@_CS_SANS_SOMMAIRE@</code> plac&eacute;e n’importe o&ugrave; &agrave; l’int&eacute;rieur du texte de l’article cr&eacute;era une exception).
_ • Uniquement pour les articles contenant la balise <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Par d&eacute;faut, le Couteau Suisse ins&egrave;re le sommaire en t&ecirc;te d\'article automatiquement. Mais vous avez la possibilit&eacute; de placer ce sommaire ailleurs dans votre squelette gr&acirc;ce &agrave; une balise #CS_SOMMAIRE que vous pouvez activer ici :
[[%balise_sommaire%]]

Ce sommaire peut &ecirc;tre coupl&eacute; avec : &laquo;&nbsp;[.->decoupe]&nbsp;&raquo;.', # MODIF
	'sommaire:nom' => 'Makaleleriniz i&ccedil;in bir &ouml;zet', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre&lt;mon_ancre&gt;}}}</html></b>', # NEW
	'sommaire_avec' => '&Ouml;zet i&ccedil;eren bir makale&nbsp;: <b>@racc@</b>',
	'sommaire_sans' => '&Ouml;zetsiz bir makale&nbsp;: <b>@racc@</b>',
	'sommaire_titres' => 'Intertitres hi&eacute;rarchis&eacute;s&nbsp;: <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Kamusal b&ouml;l&uuml;mde otomatik veya k&ouml;t&uuml; niyetli mesaj g&ouml;nderilmesine kar&#351;&#305; sava&#351;&#305;r. Baz&#305; s&ouml;zc&uuml;kler ve &lt;a>&lt;/a> komutlar&#305; yasakt&#305;r.

Burada yasaklanacak serileri @_CS_ASTER@ aralar&#305;nda bir bo&#351;luk b&#305;rakarak listeleyiniz. [[%spam_mots%]]
@_CS_ASTER@Tek bir s&ouml;zc&uuml;&#287;&uuml; parantez i&ccedil;ine al&#305;n&#305;z. Bo&#351;luklar i&ccedil;eren bir deyimi t&#305;rnak i&ccedil;ine al&#305;n&#305;z.', # MODIF
	'spam:nom' => 'SPAM\'a kar&#351;&#305; sava&#351;',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Bu mesaj anti-SPAM filtresi taraf&#305;ndan bloke edilecekti !',
	'spam_test_ok' => 'Bu mesaj anti-SPAM filtresi taraf&#305;ndan kab&ucirc;l edilecekti !',
	'spam_tester_bd' => 'Testez &eacute;galement votre votre base de donn&eacute;es et listez les messages qui auraient &eacute;t&eacute; bloqu&eacute;s par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Burada yasak serileri listenizi test edebilirsiniz :', # MODIF
	'spip_cache:description' => '@puce@ Le cache occupe un certain espace disque et SPIP peut en limiter l\'importance. Une valeur vide ou &eacute;gale &agrave; 0 signifie qu\'aucun quota ne s\'applique.[[%quota_cache% Mo]]

@puce@ Lorsqu\'une modification du contenu du site est faite, SPIP invalide imm&eacute;diatement le cache sans attendre le calcul p&eacute;riodique suivant. Si votre site a des probl&egrave;mes de performance face &agrave; une charge tr&egrave;s &eacute;lev&eacute;e, vous pouvez cocher &laquo;&nbsp;non&nbsp;&raquo; &agrave; cette option.[[%derniere_modif_invalide%]]

@puce@ Si la balise #CACHE n\'est pas trouv&eacute;e dans vos squelettes locaux, SPIP consid&egrave;re par d&eacute;faut que le cache d\'une page a une dur&eacute;e de vie de 24 heures avant de la recalculer. Afin de mieux g&eacute;rer la charge de votre serveur, vous pouvez ici modifier cette valeur.[[%duree_cache% heures]]

@puce@ Si vous avez plusieurs sites en mutualisation, vous pouvez sp&eacute;cifier ici la valeur par d&eacute;faut prise en compte par tous les sites locaux (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ SPIP, varsay&#305;lan durumda incelemeyi h&#305;zland&#305;rmak i&ccedil;in t&uuml;m kamusal sayfalar&#305; ve &ouml;nbellekteki yerlerini tekrar hesaplar. &Ouml;nbelle&#287;i ge&ccedil;ici olarak kapatmak sitenin geli&#351;imine yard&#305;mc&#305; olabilir. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ SPIP &ouml;nbelle&#287;inin i&#351;leyi&#351;ini y&ouml;nlendirmek i&ccedil;in 4 se&ccedil;enek vard&#305;r : <q1>
_ • {Normal kullan&#305;m} : SPIP, varsay&#305;lan durumda incelemeyi h&#305;zland&#305;rmak i&ccedil;in t&uuml;m kamusal sayfalar&#305; ve &ouml;nbellekteki yerlerini tekrar hesaplar. Belirli bir s&uuml;re ge&ccedil;ti&#287;inde &ouml;nbellek yeniden saklan&#305;r ve kaydedidlir..
_ • {Kal&#305;c&#305; &ouml;nbellek} : &ouml;nbelle&#287;i ge&ccedil;ersiz k&#305;lan s&uuml;re iptal edilir..
_ • {&Ouml;nbellek yok} : &Ouml;nbelle&#287;i ge&ccedil;ici olarak kapatmak sitenin geli&#351;imine yard&#305;mc&#305; olabilir. Diske hi&ccedil;bir &#351;ey kaydedilmez.
_ • {&Ouml;nbelle&#287;in kontrol&uuml;} : bu se&ccedil;enek bir &ouml;ncekiyle ayn&#305;d&#305;r ama t&uuml;m sonu&ccedil;lar ileride kontrol edilebilmeleri i&ccedil;in diske yaz&#305;l&#305;r. </q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension &laquo; Compresseur &raquo; pr&eacute;sente dans SPIP permet de compacter les diff&eacute;rents &eacute;l&eacute;ments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela acc&eacute;l&egrave;re l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers &agrave; obtenir.', # NEW
	'spip_cache:nom' => 'SPIP ve &ouml;nbellek…',
	'spip_ecran:description' => 'D&eacute;termine la largeur d\'&eacute;cran impos&eacute;e &agrave; tous en partie priv&eacute;e. Un &eacute;cran &eacute;troit pr&eacute;sentera deux colonnes et un &eacute;cran large en pr&eacute;sentera trois. Le r&eacute;glage par d&eacute;faut laisse l\'utilisateur choisir, son choix &eacute;tant stock&eacute; dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'&eacute;cran', # NEW
	'stat_auteurs' => 'Stat durumundaki yazarlar',
	'statuts_spip' => 'Sadece &#351;u SPIP stat&uuml;s&uuml; :',
	'statuts_tous' => 'T&uuml;m stat&uuml;ler',
	'suivi_forums:description' => 'Bir makale yazar&#305;, ilintili kamusal forumda bir mesaj yay&#305;nland&#305;&#287;&#305;nda her zaman bilgilendirilir. Ama ayr&#305;ca &#351;unlar da bilgilendirilebilir : t&uuml;m forum kat&#305;l&#305;mc&#305;lar&#305; veya mesajlar&#305;n yazarlar&#305;.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Kamusal forumlar&#305;n izlenmesi',
	'supprimer_cadre' => 'Bu &ccedil;er&ccedil;eveyi kald&#305;r',
	'supprimer_numero:description' => 'Supprimer_numero() SPIP i&#351;levini iskeletlerde supprimer_numero filtresi olmasa da kamusal alandaki t&uuml;m {{ba&#351;l&#305;klara}} ve {{isimlere}} uygular.<br /> &Ccedil;ok dilli bir sitede kullan&#305;lacak c&uuml;mle yap&#305;s&#305; &#351;&ouml;yledir : <code>1. <multi>My Title[fr]Mon Titre[tr]Ba&#351;l&#305;&#287;&#305;m</multi></code>',
	'supprimer_numero:nom' => 'Numaray&#305; sil',

	// T
	'titre' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305;',
	'titre_parent:description' => 'Bir d&ouml;ng&uuml;n&uuml;n ortas&#305;nda o anki nesnenin "ebeveyninin" ba&#351;l&#305;&#287;&#305;n&#305; g&ouml;stermek &ccedil;ok ola&#287;and&#305;r. Geleneksel bi&ccedil;imde ikinci bir d&ouml;ng&uuml; kullan&#305;l&#305;rd&#305; ama yeni #TITRE_PARENT komutu iskeletlerinizin yaz&#305;lma y&uuml;k&uuml;n&uuml; hafifletiyor. Geri d&ouml;nd&uuml;r&uuml;len sonu&ccedil; : bir anahtar-s&ouml;zc&uuml;&#287;&uuml;n grubun veya di&#287;er nesnelerin (makale, b&ouml;l&uuml;m, k&#305;sa haber vb.) bir &uuml;st b&ouml;l&uuml;m&uuml;n (e&#287;er mevcutsa) ba&#351;l&#305;&#287;&#305;d&#305;r.

Not : Anahtar-s&ouml;zc&uuml;kler i&ccedil;in, #TITRE_PARENT\'&#305;n e&#351;de&#287;eri #TITRE_GROUPE\'tur. Bu yeni komutlar&#305;n SPIP taraf&#305;ndan i&#351;letilmesi #TITRE gibidir.

@puce@ E&#287;er SPIP 2.0 kullan&#305;yorsan&#305;z hizmetinizde \'xxx\' nesnesinin ba&#351;l&#305;&#287;&#305;n&#305; verecek bir grup #TITRE_XXX komutu vard&#305;r, yeter ki o anki tabloda \'id_xxx\' mevcut olsun (#ID_XXX o anki d&ouml;ng&uuml;de kullan&#305;labilir).

&Ouml;rne&#287;in bir (ARTICLES) d&ouml;ng&uuml;s&uuml;nde, #TITRE_SECTEUR komutu, makalenin i&ccedil;inde bulundu&#287;u b&ouml;l&uuml;m&uuml;n ba&#351;l&#305;&#287;&#305;n&#305; verecektir &ccedil;&uuml;nk&uuml; #ID_SECTEUR tan&#305;mlay&#305;c&#305;s&#305; (veya \'id_secteur\') bu durumda kullan&#305;labilir haldedir.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => '#TITRE_PARENT/OBJET komutlar&#305;',
	'titre_tests' => '&#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; - Test sayfalar&#305;',
	'titres_typo:description' => 'Transforme tous les intertitres <html>&laquo; {{{Mon intertitre}}} &raquo;</html> en image typographique param&eacute;trable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%



Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]



Cet outil est compatible avec : &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'tous' => 'Hepsi',
	'toutes_couleurs' => 'Css stillerinin 36 rengi :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => '&Ccedil;ok dilli bloklar&nbsp;: <b><:trad:></b>',
	'toutmulti:description' => 'SPIP\'in dil zincirlerinin (&ccedil;oklu bloklar&#305;n) makalelerde, ba&#351;l&#305;klarda ve mesajlarda serbest&ccedil;e kullan&#305;labilmesi i&ccedil;in <code><:chaine:></code> k&#305;sayolunu sunar. 
_ Kullan&#305;lan SPIP fonksiyonu &#351;udur : <code>_T(\'zincir\')</code>.

Bu gere&ccedil; arg&uuml;man da kab&ucirc;l eder. &Ouml;rne&#287;in <code><:chaine{arg1=bir metin, arg2=bir ba&#351;ka metin}:></code> k&#305;saltmas&#305; 2 arg&uuml;man&#305;n &#351;u zincire ge&ccedil;irilmesine izin verir : <code>\'chaine\'=>\'&#304;&#351;te benim arg&uuml;manlar&#305;m : @arg1@ et @arg2@\'</code>.

<code>\'zincir\'</code> anahtar&#305;n&#305;n dil dosyalar&#305;nda d&uuml;zg&uuml;n bi&ccedil;imde tan&#305;mland&#305;&#287;&#305;ndan emin olun. [Bu konuyla ilgili &#351;u adresteki ->http://www.spip.net/fr_article2128.html] SPIP belgelerine g&ouml;z at&#305;n&#305;z.', # MODIF
	'toutmulti:nom' => '&Ccedil;ok dilli bloklar',
	'travaux_masquer_avert' => 'Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours', # NEW
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Bu site &ccedil;ok yak&#305;nda tekrar yay&#305;na ba&#351;layacak.
_ Anlay&#305;&#351;&#305;n&#305;z i&ccedil;in te&#351;ekk&uuml;rler.', # MODIF
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Sitenin &ouml;zel alan&#305;nda gezinirken ([->./?exec=auteurs]) ba&#351;l&#305;klar&#305;n i&ccedil;inde makalelerinizi s&#305;ralamak i&ccedil;in kullan&#305;lacak y&ouml;netmi burada se&ccedil;in.

A&#351;a&#287;&#305;daki &ouml;neriler SQL \'ORDER BY\' fonksiyonuna dayanmaktad&#305;r: bu ki&#351;isel s&#305;ralamay&#305; yaln&#305;zca ne yapt&#305;&#287;&#287;&#305;n&#305;z&#305; biliyorsan&#305;z kullan&#305;n (olas&#305; alanlar : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Makalelerin s&#305;ralanmas&#305;', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'De&#287;i&#351;iklik tarihine g&ouml;re s&#305;ralama (ORDER BY date_modif DESC)',
	'tri_perso' => 'Ki&#351;iselle&#351;tirilmi&#351; SQL s&#305;ralamas&#305; ORDER BY :',
	'tri_publi' => 'Yay&#305;n tarihine g&ouml;re s&#305;ralama (ORDER BY date DESC)',
	'tri_titre' => 'Ba&#351;l&#305;&#287;a g&ouml;re s&#305;ralama (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => '<NEW>Outil en cours de d&eacute;veloppement. Vous offre quelques balises tr&egrave;s simples et bien pratiques pour am&eacute;liorer la lisibilit&eacute; de vos squelettes.

@puce@ {{#BOLO}} : g&eacute;n&egrave;re un faux texte d\'environ 3000 caract&egrave;res ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction sp&eacute;cifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ Un mod&egrave;le est &eacute;galement disponible pour vos contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caract&egrave;res de faux texte.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction sp&eacute;cifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalisez l\'affichage gr&acirc;ce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}} : balise &eacute;quivalente &agrave; <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caract&egrave;res sp&eacute;ciaux (le retour &agrave; la ligne par exemple) ou des caract&egrave;res r&eacute;serv&eacute;s par le compilateur de SPIP (les crochets ou les accolades).

@puce@ {{#LESMOTS}} : ', # MODIF
	'trousse_balises:nom' => 'Komut kutusu',
	'type_urls:description' => '@puce@ SPIP, sitenizin sayfalar&#305;na eri&#351;ime izin veren ba&#287;lant&#305;lar &uuml;retmek i&ccedil;in i&ccedil;in  bir tak&#305;m URL\'ler sunar. 

Daha fazla bilgi i&ccedil;in : [->http://www.spip.net/fr_article765.html]. &laquo;&nbsp;[.->boites_privees]&nbsp;&raquo; gereci size her SPIP nesnesinin sayfas&#305;nda ona ba&#287;l&#305; &ouml;zel URL\'yi g&ouml;rme olana&#287;&#305; tan&#305;r.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@{html}, {propre}, {propre2}, {libres} veya {arborescentes} formatlar&#305;n&#305; kullanabilmek i&ccedil;in SPIP sitesinin k&ouml;k dizininin "htaccess.txt" dosyas&#305;n&#305; ".htaccess" ismiyle kopyalay&#305;n (bu dosyaya koymu&#351; olabilece&#287;iniz ba&#351;ka ayarlar&#305; ezmemeye dikkat edin); e&#287;er siteniz bir "alt-dizinde" ise bu dosyada ayr&#305;ca "RewriteBase" sat&#305;r&#305;n&#305; da d&uuml;zenlemelisiniz. Bu &#351;ekilde tan&#305;mlanan URL\'ler SPIP dosyalar&#305;na y&ouml;nlendirilecektir.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs &laquo;page&raquo;}} : bunlar SPIP 1.9x s&uuml;r&uuml;m&uuml;nden itibaren kullan&#305;lan  varsay&#305;lan ba&#287;lant&#305;lard&#305;r .
_ &Ouml;rnek : <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs &laquo;html&raquo;}} : ba&#287;lant&#305;lar klasik HTML sayfalar&#305; bi&ccedil;imindedir.
_ &Ouml;rnek : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{&laquo;propres&raquo; URL\'ler}} : ba&#287;lant&#305;lar istenen nesnelerin ba&#351;l&#305;&#287;&#305; yard&#305;m&#305;yla hesaplanmaktad&#305;r. (_, -, +, @, vb.) i&#351;aretleri nesneye ba&#287;l&#305; olarak ba&#351;l&#305;klar&#305; &ccedil;evreler.
_ &Ouml;rnekler : <code>/Mon-titre-d-article</code> veya <code>/-Ma-rubrique-</code> veya <code>/@Mon-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs &laquo;propres2&raquo;}} : \'.html\' soyad&#305; {&laquo;propres&raquo;} ba&#287;lant&#305;lara eklenir.
_ Exemple : <code>/Mon-titre-d-article.html</code> veya <code>/-Ma-rubrique-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs &laquo;libres&raquo;}} : ba&#287;lant&#305;lar {&laquo;propres&raquo;}\'dur ama nesneleri ay&#305;ran i&#351;aretler yoktur (_, -, +, @, vb.).
_ &Ouml;rnek : <code>/Mon-titre-d-article</code> veya <code>/Ma-rubrique</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs &laquo;arborescentes&raquo;}} : ba&#287;lant&#305;lar {&laquo;propre&raquo;dur} ama a&#287;a&ccedil; yap&#305;s&#305;ndad&#305;r.
_ &Ouml;rnek : <code>/secteur/rubrique1/rubrique2/Mon-titre-d-article</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{&laquo;propres-qs&raquo; URL\'ler}} : bu sistem "Query-String"de &ccedil;al&#305;&#351;&#305;r yani .htaccess kullanmaz ; ba&#287;lant&#305;lar {&laquo;propres&raquo;}dur.
_ &Ouml;rnek : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres_qs">@puce@ {{URLs &laquo;propres_qs&raquo;}} : bu sistem "Query-String"de &ccedil;al&#305;&#351;&#305;r yani .htaccess kullanmaz ; ba&#287;lant&#305;lar {&laquo;propres&raquo;}dur.
_ &Ouml;rnek : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs &laquo;standard&raquo;}} : art&#305;k &acirc;t&#305;l olan bu ba&#287;lant&#305;lar 1.8 s&uuml;r&uuml;m&uuml;ne kadar kullan&#305;l&#305;yordu.
_ &Ouml;rnek : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ E&#287;er yukar&#305;da {page} format&#305;n&#305; kullan&#305;yorsan&#305;z veya istenen nesne tan&#305;nm&#305;yorsa o zaman {{&ccedil;a&#287;r&#305; skripti}}ni se&ccedil;meniz m&uuml;mk&uuml;nd&uuml;r. Varsay&#305;lan de&#287;er olarak SPIP {spip.php}\'yi se&ccedil;er ama {index.php}  (format &ouml;rne&#287;i : <code>/index.php?article123</code>) veya bo&#351; bir de&#287;er de (format : <code>/?article123</code>) i&#351; g&ouml;r&uuml;r. Di&#287;er d&#287;erler i&ccedil;in SPIP\'in k&ouml;k dizininde kar&#351;&#305; d&uuml;&#351;en dosyay&#305; olu&#351;turman&#305;z gerekir : {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ URL tabanl&#305; bir format kullan&#305;yorsan&#305;z &laquo;propres&raquo;  ({propres}, {propres2}, {libres}, {arborescentes} veya {propres_qs}) &#304;svi&ccedil;re &Ccedil;ak&#305;s&#305; &#351;unu yapabilir :
<q1>• URL\'nin tamamen {{k&uuml;&ccedil;&uuml;k harf olmas&#305;}}.</q1>[[%urls_minuscules%]]
<q1>• Sistematik olarak {{nesne id\'sinin}} URL\'ye eklenmesi (&ouml;n ek, son ek vb.).
_ (&ouml;rnekler : <code>/Mon-titre-d-article,457</code> veya <code>/457-Mon-titre-d-article</code>)</q1>', # MODIF
	'type_urls:nom' => 'URL\'lerin formatlar&#305;',
	'typo_exposants:description' => '{{Frans&#305;zca metinler}} : g&uuml;ncel k&#305;saltmalar&#305;n tipografik g&ouml;r&uuml;n&uuml;m&uuml;n&uuml; gerekli elemanlar&#305; &uuml;s\'e koyarak  (b&ouml;ylece, {<acronym>Mme</acronym>} &#351;u hale gelir {M<sup>me</sup>}) ve s&#305;k&ccedil;a yap&#305;lan hatalar&#305; d&uuml;zelterek ({<acronym>2&egrave;me</acronym>} veya {<acronym>2me</acronym>} &#351;u hale gelir {2<sup>e</sup>}) geli&#351;tirir,.
_ Burada elde edilen k&#305;saltmalar 2002 y&#305;l&#305;nda yay&#305;nlanan Paris Ulusal Bas&#305;mevi 2002 standartlar&#305;na uygundur. 
B&ouml;ylece Frans&#305;zca\'da: <html>Dr, Pr, Mgr, St, Bx, m2, m3, Mn, Md, St&eacute;, &Eacute;ts, Vve, bd, Cie, 1o, 2o, etc.</html> k&#305;saltmalar&#305; halledilmi&#351; olur

{{&#304;ngilizce metinler}} : s&#305;ralamalar&#305;n &uuml;s\'e konmas&#305; : <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Tipografik &uuml;s\'ler',

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
	'urls_3_chiffres' => 'Minimum 3 rakam iste',
	'urls_avec_id' => 'Son ek olarak ekle',
	'urls_avec_id2' => '&Ouml;n ek olarak ekle',
	'urls_base_total' => '&#350;u anda veritaban&#305;nda @nb@ URL var',
	'urls_base_vide' => 'URL veritaban&#305; bo&#351;',
	'urls_choix_objet' => 'Belirgin bir nesnenin URL\'sinin veritaban&#305;nda d&uuml;zenlenmesi&nbsp;:',
	'urls_edit_erreur' => 'URL\'lerin &#351;u anki bi&ccedil;emleri (&laquo;&nbsp;@type@&nbsp;&raquo;) d&uuml;zenlemeye izin vermiyor.',
	'urls_enregistrer' => 'Bu URL\'yi veritaban&#305;na ekle',
	'urls_id_sauf_rubriques' => 'Ba&#351;l&#305;klar&#305; &ccedil;&#305;kart', # MODIF
	'urls_minuscules' => 'K&uuml;&ccedil;&uuml;k harfler',
	'urls_nouvelle' => 'URL &laquo;&nbsp;propre&nbsp;&raquo;\'u d&uuml;zenle&nbsp;:',
	'urls_num_objet' => 'Numara&nbsp;:',
	'urls_purger' => 'Hepsini bo&#351;alt',
	'urls_purger_tables' => 'Se&ccedil;ilen tablolar&#305; bo&#351;alt',
	'urls_purger_tout' => 'Veritaban&#305;ndaki URL\'Leri s&#305;f&#305;rla&nbsp;:',
	'urls_rechercher' => 'Bu nesneyi veritaban&#305;nda ara',
	'urls_titre_objet' => 'Kay&#305;tl&#305; ba&#351;l&#305;k &nbsp;:',
	'urls_type_objet' => 'Nesne&nbsp;:',
	'urls_url_calculee' => 'Kamusal URL &laquo;&nbsp;@type@&nbsp;&raquo;&nbsp;:',
	'urls_url_objet' => 'Kaydedilmi&#351; &laquo;&nbsp;ki&#351;isel&nbsp;&raquo; URLler&nbsp;:',
	'urls_valeur_vide' => '(Bo&#351; bir de&#287;er URL\'nin yeniden hesaplanmas&#305;na yol a&ccedil;ar)',

	// V
	'validez_page' => 'De&#287;i&#351;ikliklere eri&#351;mek i&ccedil;in :',
	'variable_vide' => '(Bo&#351;)',
	'vars_modifiees' => 'Veriler sorunsuz de&#287;i&#351;tirildi',
	'version_a_jour' => 'S&uuml;r&uuml;m&uuml;n&uuml;z g&uuml;ncel.',
	'version_distante' => 'En eski s&uuml;r&uuml;m...',
	'version_distante_off' => 'Uzaktan onaylama pasif hale getirildi',
	'version_nouvelle' => 'Yeni s&uuml;r&uuml;m : @version@',
	'version_revision' => 'G&ouml;zden ge&ccedil;irme : @revision@',
	'version_update' => 'Otomatik g&uuml;ncelleme',
	'version_update_chargeur' => 'Otomatik dosya indirme',
	'version_update_chargeur_title' => '&laquo;T&eacute;l&eacute;chargeur&raquo; eklentisi sayesinde eklentinin son s&uuml;r&uuml;m&uuml;n&uuml; indirir',
	'version_update_title' => 'Eklentinin son s&uuml;r&uuml;m&uuml;n&uuml; indirir ve otomatik g&uuml;ncellemeyi ba&#351;lat&#305;r',
	'verstexte:description' => '&#304;skeletleriniz i&ccedil;in, daha hafif sayfalar olu&#351;turman&#305;z&#305; sa&#287;layacak 2 filtre.
_ version_texte : birka&ccedil; &ouml;nemli komut d&#305;&#351;&#305;nda bir html sayfan&#305;n metin i&ccedil;eri&#287;ini al&#305;r.
_ version_plein_texte : bir html sayfan&#305;n t&uuml;m metin i&ccedil;eri&#287;ini al&#305;r.', # MODIF
	'verstexte:nom' => 'Metin s&uuml;r&uuml;m&uuml;',
	'visiteurs_connectes:description' => '&#304;skeletiniz i&ccedil;in, kamusal sitedeki ziyaret&ccedil;i say&#305;s&#305;n&#305; g&ouml;steren bir programc&#305;k sunar.

Sayfalar&#305;n&#305;za yaln&#305;zca &#351;unu ekleyin  <code><INCLURE{fond=fonds/visiteurs_connectes}></code>.', # MODIF
	'visiteurs_connectes:nom' => 'Ba&#287;l&#305; ziyaret&ccedil;iler',
	'voir' => 'Bkz : @voir@',
	'votre_choix' => 'Se&ccedil;iminiz :',

	// W
	'webmestres:description' => 'Bir {{site y&ouml;neticisi}} SPIP\'te FTP alan&#305;ndaki bir {{idareci}}ye kar&#351;&#305; d&uuml;&#351;er. SPIP 2.0\'dan itibaren ve varsay&#305;lan de&#287;er olarak <code>id_auteur=1</code> site\'nin idarecisidir. Burada tan&#305;mlanan site y&ouml;neticileri, veritaban&#305;n&#305;n g&uuml;ncellenmesi veya bir "dump"&#305;n geri al&#305;nmas&#305; gibi hassas site i&#351;lemlerini onaylamak i&ccedil;in FTP\'den ge&ccedil;mek zorunda de&#287;ildirler.

&#350;u anki site y&ouml;neticileri : {@_CS_LISTE_WEBMESTRES@}.
_ Site y&ouml;neticileri : {@_CS_LISTE_ADMINS@}.

Site y&ouml;neticisi olarak siz de burada -- e&#287;er birden fazlaysa iki noktayla birbirinden ayr&#305;lm&#305;&#351; &laquo;&nbsp;:&nbsp;&raquo; bu kimlik listelerini de&#287;i&#351;tirme yetkisine sahipsiniz. &Ouml;rnek : &laquo;1:5:6&raquo;.[[%site y&ouml;neticisi%]]', # MODIF
	'webmestres:nom' => 'Webmaster listesi',

	// X
	'xml:description' => 'Xml onaylay&#305;c&#305;s&#305;n&#305;, kamusal alan i&ccedil;in [&#351;u belgede->http://www.spip.net/fr_article3541.html] belirtildi&#287;i gibi aktive eder. &laquo;&nbsp;Analyse XML&nbsp;&raquo; ba&#351;l&#305;kl&#305; bir d&uuml;&#287;me di&#287;er y&ouml;netim d&uuml;&#287;melerine eklenecektir.',
	'xml:nom' => 'XML onaylay&#305;c&#305;s&#305;'
);

?>
