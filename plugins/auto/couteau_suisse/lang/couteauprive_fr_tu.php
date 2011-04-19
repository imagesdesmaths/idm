<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => '&nbsp;:&nbsp;non',
	'2pts_oui' => '&nbsp;:&nbsp;oui',

	// S
	'SPIP_liens:description' => '@puce@ Tous les liens du site s\'ouvrent par d&eacute;faut dans la fen&ecirc;tre de navigation en cours. Mais il peut &ecirc;tre utile d\'ouvrir les liens externes au site dans une nouvelle fen&ecirc;tre ext&eacute;rieure -- cela revient &agrave; ajouter {target="_blank"} &agrave; toutes les balises &lt;a&gt; dot&eacute;es par SPIP des classes {spip_out}, {spip_url} ou {spip_glossaire}. Il est parfois n&eacute;cessaire d\'ajouter l\'une de ces classes aux liens du squelette du site (fichiers html) afin d\'&eacute;tendre au maximum cette fonctionnalit&eacute;.[[%radio_target_blank3%]]

@puce@ SPIP permet de relier des mots &agrave; leur d&eacute;finition gr&acirc;ce au raccourci typographique <code>[?mot]</code>. Par d&eacute;faut (ou si tu laisses vide la case ci-dessous), le glossaire externe renvoie vers l’encyclop&eacute;die libre wikipedia.org. &Agrave; toi de choisir l\'adresse &agrave; utiliser. <br />Lien de test : [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP a pr&eacute;vu un style CSS pour les liens &laquo;~mailto:~&raquo; : une petite enveloppe devrait appara&icirc;tre devant chaque lien li&eacute; &agrave; un courriel; mais puisque tous les navigateurs ne peuvent pas l\'afficher (notamment IE6, IE7 et SAF3), &agrave; toi de voir s\'il faut conserver cet ajout.
_ Lien de test : [->test@test.com] (rechargez la page enti&egrave;rement).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP et les liens… externes',
	'SPIP_tailles:description' => '@puce@ Afin d\'all&eacute;ger la m&eacute;moire de ton serveur, SPIP te permet de limiter les dimensions (hauteur et largeur) et la taille du fichier des images, logos ou documents joints aux divers contenus de ton site. Si un fichier d&eacute;passe la taille indiqu&eacute;e, le formulaire enverra bien les donn&eacute;es mais elles seront d&eacute;truites et SPIP n\'en tiendra pas compte, ni dans le r&eacute;pertoire IMG/, ni en base de donn&eacute;es. Un message d\'avertissement sera alors envoy&eacute; &agrave; l\'utilisateur.

Une valeur nulle ou non renseign&eacute;e correspond &agrave; une valeur illimit&eacute;e.
[[Hauteur : %img_Hmax% pixels]][[->Largeur : %img_Wmax% pixels]][[->Poids du fichier : %img_Smax% Ko]]
[[Hauteur : %logo_Hmax% pixels]][[->Largeur : %logo_Wmax% pixels]][[->Poids du fichier : %logo_Smax% Ko]]
[[Poids du fichier : %doc_Smax% Ko]]

@puce@ D&eacute;finissez ici l\'espace maximal r&eacute;serv&eacute; aux fichiers distants que SPIP pourrait t&eacute;l&eacute;charger (de serveur &agrave; serveur) et stocker sur votre site. La valeur par d&eacute;faut est ici de 16 Mo.[[%copie_Smax% Mo]]

@puce@ Afin d\'&eacute;viter un d&eacute;passement de m&eacute;moire PHP dans le traitement des grandes images par la librairie GD2, SPIP teste les capacit&eacute;s du serveur et peut donc refuser de traiter les trop grandes images. Il est possible de d&eacute;sactiver ce test en d&eacute;finissant manuellement le nombre maximal de pixels support&eacute;s pour les calculs.

La valeur de 1~000~000 pixels semble correcte pour une configuration avec peu de m&eacute;moire. Une valeur nulle ou non renseign&eacute;e entra&icirc;nera le test du serveur.
[[%img_GDmax% pixels au maximum]]

@puce@ La librairie GD2 permet d\'ajuster la qualit&eacute; de compression des images JPG. Un pourcentage &eacute;lev&eacute; correspond &agrave; une qualit&eacute; &eacute;lev&eacute;e.
[[%img_GDqual% %]]', # MODIF
	'SPIP_tailles:nom' => 'Limites m&eacute;moire',

	// A
	'acces_admin' => 'Acc&egrave;s administrateurs :',
	'action_rapide' => 'Action rapide, uniquement si tu sais ce que tu fais !',
	'action_rapide_non' => 'Action rapide, disponible une fois cet outil activ&eacute; :',
	'admins_seuls' => 'Les administrateurs seulement',
	'attente' => 'Attente...',
	'auteur_forum:description' => 'Incite tous les auteurs de messages publics &agrave; fournir (d\'au moins d\'une lettre !) un nom et/ou un courriel afin d\'&eacute;viter les contributions totalement anonymes. Note que cet outil proc&egrave;de &agrave; une v&eacute;rification JavaScript sur le poste du visiteur.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Attention : Choisir la troisi&egrave;me option annule les 2 premi&egrave;res. Il est important de v&eacute;rifier que les formulaires de ton squelette sont bien compatibles avec cet outil.}', # MODIF
	'auteur_forum:nom' => 'Pas de forums anonymes',
	'auteur_forum_deux' => 'Ou, au moins l\'un des deux champs pr&eacute;c&eacute;dents',
	'auteur_forum_email' => 'Le champ &laquo;@_CS_FORUM_EMAIL@&raquo;',
	'auteur_forum_nom' => 'Le champ &laquo;@_CS_FORUM_NOM@&raquo;',
	'auteurs:description' => 'Cet outil configure l\'apparence de [la page des auteurs->./?exec=auteurs], en partie priv&eacute;e.

@puce@ D&eacute;finis ici le nombre maximal d\'auteurs &agrave; afficher sur le cadre central de la page des auteurs. Au-del&agrave;, une pagination est mise en place.[[%max_auteurs_page%]]

@puce@ Quels statuts d\'auteurs peuvent &ecirc;tre list&eacute;s sur cette page ?
[[%auteurs_tout_voir%]][[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]', # MODIF
	'auteurs:nom' => 'Page des auteurs',

	// B
	'balise_set:description' => 'Afin d\'all&eacute;ger les &eacute;critures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqu&eacute; &agrave; une variable passe donc dans le nom de la balise.



Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'Balise #SET &eacute;tendue', # NEW
	'barres_typo_edition' => 'Edition des contenus',
	'barres_typo_forum' => 'Messages de Forum',
	'barres_typo_intro' => 'Le plugin &laquo;Porte-Plume&raquo; a &eacute;t&eacute; d&eacute;tect&eacute;. Choisi ici les barres typographiques o&ugrave; certains boutons seront ins&eacute;r&eacute;s.',
	'basique' => 'Basique',
	'blocs:aide' => 'Blocs D&eacute;pliables : <b>&lt;bloc&gt;&lt;/bloc&gt;</b> (alias : <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) et <b>&lt;visible&gt;&lt;/visible&gt;</b>',
	'blocs:description' => 'Te permet  de cr&eacute;er des blocs dont le titre cliquable peut les rendre visibles ou invisibles.

@puce@ {{Dans les textes SPIP}} : les r&eacute;dacteurs ont &agrave; disposition les  nouvelles balises &lt;bloc&gt; (ou &lt;invisible&gt;) et &lt;visible&gt; &agrave; utiliser dans leurs textes comme ceci : 

<quote><code>
<bloc>
 Un titre qui deviendra cliquable
 
 Le texte a` cacher/montrer, apre`s deux sauts de ligne...
 </bloc>
</code></quote>

@puce@ {{Dans les squelettes}} : tu as &agrave; ta disposition les  nouvelles balises #BLOC_TITRE, #BLOC_DEBUT et #BLOC_FIN &agrave; utiliser comme ceci : 
<quote><code> #BLOC_TITRE ou #BLOC_TITRE{mon_URL}
 Mon titre
 #BLOC_RESUME    (facultatif)
 une version re\'sume\'e du bloc suivant
 #BLOC_DEBUT
 Mon bloc de\'pliable (qui contiendra l\'URL pointe\'e si ne\'ce\'ssaire)
 #BLOC_FIN</code></quote>

@puce@ En cochant &laquo;oui&raquo; ci-dessous, l\'ouverture d\'un bloc provoquera la fermeture de tous les autres blocs de la page, afin d\'en avoir qu\'un seul ouvert &agrave; la fois.[[%bloc_unique%]]

@puce@ En cochant &laquo;oui&raquo; ci-dessous, l\'&eacute;tat des blocs num&eacute;rot&eacute;s sera stock&eacute; dans un cookie le temps de la session, afin de conserver l\'aspect de la page en cas de retour.[[%blocs_cookie%]]

@puce@ Le Couteau Suisse utilise par d&eacute;faut la balise HTML &lt;h4&gt; pour le titre des blocs d&eacute;pliables. Choisis ici une autre balise &lt;hN&gt;&nbsp;:[[%bloc_h4%]]

@puce@ Afin d\'obtenir un effet plus doux au moment du clic, vos blocs d&eacute;pliables peuvent s\'animer &agrave; la mani&egrave;re d\'un "glissement".[[%blocs_slide%]][[->%blocs_millisec% millisecondes]]', # MODIF
	'blocs:nom' => 'Blocs D&eacute;pliables',
	'boites_privees:description' => 'Toutes les bo&icirc;tes d&eacute;crites ci-dessous apparaissent ici ou l&agrave; dans la partie priv&eacute;e.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Les r&eacute;visions du Couteau Suisse}} : un cadre sur la pr&eacute;sente page de configuration, indiquant les derni&egrave;res modifications apport&eacute;es au code du plugin ([Source->@_CS_RSS_SOURCE@]).
- {{Les articles au format SPIP}} : un cadre d&eacute;pliable suppl&eacute;mentaire pour tes articles permettant de conna&icirc;tre le code source utilis&eacute; par leurs auteurs.
- {{Les auteurs en stat}} : un cadre d&eacute;pliable sur [la page des auteurs->./?exec=auteurs] indiquant les 10 derniers connect&eacute;s et les inscriptions non confirm&eacute;es. Seuls les administrateurs voient ces informations.
- {{Les webmestres SPIP}} : un cadre d&eacute;pliable sur [la page des auteurs->./?exec=auteurs] indiquant les administrateurs &eacute;lev&eacute;s au rang de webmestre SPIP. Seuls les administrateurs voient ces informations. Si tu es webmestre toi-m&ecirc;me, voir aussi l\'outil &laquo;&nbsp;[.->webmestres]&nbsp;&raquo;.
- {{Les URLs propres}} : un cadre d&eacute;pliable pour chaque objet de contenu (article, rubrique, auteur, ...) indiquant l\'URL propre associ&eacute;e ainsi que leurs alias &eacute;ventuels. L\'outil &laquo;&nbsp;[.->type_urls]&nbsp;&raquo; te permet une configuration fine des URLs de ton site.
- {{Les tris d\'auteurs}} : un cadre d&eacute;pliable pour les articles contenant plus d\'un auteur et permettant simplement d\'en ajuster l\'ordre d\'affichage.', # MODIF
	'boites_privees:nom' => 'Bo&icirc;tes priv&eacute;es',
	'bp_tri_auteurs' => 'Les tris d\'auteurs',
	'bp_urls_propres' => 'Les URLs propres',
	'brouteur:description' => 'Utiliser le s&eacute;lecteur de rubrique en AJAX &agrave; partir de %rubrique_brouteur% rubrique(s)', # MODIF
	'brouteur:nom' => 'R&eacute;glage du s&eacute;lecteur de rubrique', # MODIF

	// C
	'cache_controle' => 'Contr&ocirc;le du cache',
	'cache_nornal' => 'Usage normal',
	'cache_permanent' => 'Cache permanent',
	'cache_sans' => 'Pas de cache',
	'categ:admin' => '1. Administration',
	'categ:divers' => '60. Divers',
	'categ:interface' => '10. Interface priv&eacute;e',
	'categ:public' => '40. Affichage public',
	'categ:securite' => '5. S&eacute;curit&eacute;', # NEW
	'categ:spip' => '50. Balises, filtres, crit&egrave;res',
	'categ:typo-corr' => '20. Am&eacute;liorations des textes',
	'categ:typo-racc' => '30. Raccourcis typographiques',
	'certaines_couleurs' => 'Seules les balises d&eacute;finies ci-dessous@_CS_ASTER@ :',
	'chatons:aide' => 'Chatons : @liste@',
	'chatons:description' => 'Ins&egrave;re des images (ou chatons pour les {tchats}) dans tous les textes o&ugrave; appara&icirc;t une cha&icirc;ne du genre <code>:nom</code>.
_ Cet outil remplace ces raccourcis par les images du m&ecirc;me nom qu\'il trouve dans ton dossier <code>mon_squelette_toto/img/chatons/</code>, ou par d&eacute;faut, le dossier <code>couteau_suisse/img/chatons/</code>.', # MODIF
	'chatons:nom' => 'Chatons',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de ton site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour &agrave; la ligne. En effet, les citations courtes doivent &ecirc;tre entour&eacute;es par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.',
	'citations_bb:nom' => 'Citations bien balis&eacute;es',
	'class_spip:description1' => 'Tu peux ici d&eacute;finir certains raccourcis de SPIP. Une valeur vide &eacute;quivaut &agrave; utiliser la valeur par d&eacute;faut.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Les raccourcis de SPIP}}.

Tu peux ici d&eacute;finir certains raccourcis de SPIP. Une valeur vide &eacute;quivaut &agrave; utiliser la valeur par d&eacute;faut.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{Attention : si l\'outil &laquo;&nbsp;[.->pucesli]&nbsp;&raquo; est activ&eacute;, le remplacement du tiret &laquo;&nbsp;-&nbsp;&raquo; ne sera plus effectu&eacute;&nbsp;; une liste &lt;ul>&lt;li> sera utilis&eacute;e &agrave; la place.}

SPIP utilise habituellement la balise &lt;h3&gt; pour les intertitres. Choisis ici un autre remplacement :[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP a choisi d\'utiliser la balise &lt;strong> pour transcrire les gras. Mais &lt;b> aurait pu &eacute;galement convenir, avec ou sans style. &Agrave; toi de voir :[[%racc_g1%]][[->%racc_g2%]]

SPIP a choisi d\'utiliser la balise &lt;i> pour transcrire les italiques. Mais &lt;em> aurait pu &eacute;galement convenir, avec ou sans style. &Agrave; toi de voir :[[%racc_i1%]][[->%racc_i2%]]

 Tu peux aussi d&eacute;finir le code ouvrant et fermant pour les appels de notes de bas de pages (Attention ! Les modifications ne seront visibles que sur l\'espace public.) : [[%ouvre_ref%]][[->%ferme_ref%]]
 
 Tu peux d&eacute;finir le code ouvrant et fermant pour les notes de bas de pages : [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{Les styles de SPIP par d&eacute;faut}}. Jusqu\'&agrave; la version 1.92 de SPIP, les raccourcis typographiques produisaient des balises syst&eacute;matiquement affubl&eacute;es du style "spip". Par exemple : <code><p class="spip"></code>. Tu peux ici d&eacute;finir le style de ces balises en fonction de vos feuilles de style. Une case vide signifie qu\'aucun style particulier ne sera appliqu&eacute;.

{Attention : si certains raccourcis (ligne horizontale, intertitre, italique, gras) ont &eacute;t&eacute; modifi&eacute;s ci-dessus, alors les styles ci-dessous ne seront pas appliqu&eacute;s.}

<q1>
_ {{1.}} Balises &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]]
_ {{2.}} Balises &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; et les listes (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Note bien : en modifiant ce deuxi&egrave;me style, tu perds alors les styles standards de SPIP associ&eacute;s &agrave; ces balises.</q1>', # MODIF
	'class_spip:nom' => 'SPIP et ses raccourcis…',
	'code_css' => 'CSS',
	'code_fonctions' => 'Fonctions',
	'code_jq' => 'jQuery',
	'code_js' => 'JavaScript',
	'code_options' => 'Options',
	'code_spip_options' => 'Options SPIP',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie priv&eacute;e', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options pr&eacute;c&eacute;dentes)', # NEW
	'contrib' => 'Plus d\'infos : @url@',
	'corbeille:description' => 'SPIP supprime automatiquement les objets mis au rebuts au bout de 24 heures, en g&eacute;n&eacute;ral vers 4 heures du matin, gr&acirc;ce &agrave; une t&acirc;che &laquo;CRON&raquo; (lancement p&eacute;riodique et/ou automatique de processus pr&eacute;programm&eacute;s). Tu peux ici emp&ecirc;cher ce processus afin de mieux g&eacute;rer ta corbeille.[[%arret_optimisation%]]',
	'corbeille:nom' => 'La corbeille',
	'corbeille_objets' => '@nb@ objet(s) dans la corbeille.',
	'corbeille_objets_lies' => '@nb_lies@ liaison(s) detect&eacute;e(s).',
	'corbeille_objets_vide' => 'Aucun objet dans la corbeille.',
	'corbeille_objets_vider' => 'Supprimer les objets s&eacute;lectionn&eacute;s',
	'corbeille_vider' => 'Vider la corbeille&nbsp;:',
	'couleurs:aide' => 'Mise en couleurs : <b>[coul]texte[/coul]</b>@fond@ avec <b>coul</b> = @liste@',
	'couleurs:description' => 'Permet d\'appliquer facilement des couleurs &agrave; tous les textes du site (articles, br&egrave;ves, titres, forum, …) en utilisant des balises &agrave; crochets en raccourcis : <code>[couleur]texte[/couleur]</code>.

Deux exemples identiques pour changer la couleur du texte :@_CS_EXEMPLE_COULEURS2@

Idem pour changer le fond, si l\'option ci-dessous le permet :@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@Le format de ces balises personnalis&eacute;es doit lister des couleurs existantes ou d&eacute;finir des couples &laquo;balise=couleur&raquo;, le tout s&eacute;par&eacute; par des virgules. Exemples : &laquo;gris, rouge&raquo;, &laquo;faible=jaune, fort=rouge&raquo;, &laquo;bas=#99CC11, haut=brown&raquo; ou encore &laquo;gris=#DDDDCC, rouge=#EE3300&raquo;. Pour le premier et le dernier exemple, les balises autoris&eacute;es sont : <code>[gris]</code> et <code>[rouge]</code> (<code>[fond gris]</code> et <code>[fond rouge]</code> si les fonds sont permis).', # MODIF
	'couleurs:nom' => 'Tout en couleurs',
	'couleurs_fonds' => ', <b>[fond&nbsp;coul]texte[/coul]</b>, <b>[bg&nbsp;coul]texte[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Obtiens de nombreux renseignements &agrave; propos du fonctionnement du Couteau Suisse dans les fichiers {spip.log} que l\'on peut trouver dans le r&eacute;pertoire : {<html>@_CS_DIR_TMP@</html>}[[%log_couteau_suisse%]]

@puce@ {{Options SPIP.}} SPIP ordonne les plugins dans un ordre sp&eacute;cifique. Afin d\'&ecirc;tre s&ucirc;r que le Couteau Suisse soit en t&ecirc;te et g&egrave;re en amont certaines options de SPIP, alors coche l\'option suivante. Si les droits de ton serveur le permettent, le fichier {<html>@_CS_FILE_OPTIONS@</html>} sera automatiquement modifi&eacute; pour inclure le fichier {<html>@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php</html>}.
[[%spip_options_on%]]
@_CS_FILE_OPTIONS_ERR@

@puce@ {{Requ&ecirc;tes externes.}} D\'une part, le Couteau Suisse v&eacute;rifie r&eacute;guli&egrave;rement l\'existence d\'une version plus r&eacute;cente de son code et informe sur sa page de configuration d\'une mise &agrave; jour &eacute;ventuellement disponible. D\'autre part, ce plugin comporte certains outils qui peuvent n&eacute;cessiter d\'importer des librairies distantes.

Si les requ&ecirc;tes externes de ton serveur posent des probl&egrave;mes ou par souci d\'une meilleure s&eacute;curit&eacute;, coche les cases suivantes.[[%distant_off%]][[->%distant_outils_off%]]', # MODIF
	'cs_comportement:nom' => 'Comportements du Couteau Suisse',
	'cs_distant_off' => 'Les v&eacute;rifications de versions distantes',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants',
	'cs_log_couteau_suisse' => 'Les logs d&eacute;taill&eacute;s du Couteau Suisse',
	'cs_reset' => 'Es-tu s&ucirc;r de vouloir r&eacute;initialiser totalement le Couteau Suisse ?',
	'cs_reset2' => 'Tous les outils actuellement actifs seront d&eacute;sactiv&eacute;s et leurs param&egrave;tres r&eacute;initialis&eacute;s.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher &laquo;<html>@_CS_FILE_OPTIONS@</html>&raquo; a &eacute;chou&eacute; !',
	'cs_spip_options_on' => 'Les options SPIP dans &laquo;<html>@_CS_FILE_OPTIONS@</html>@&raquo;',

	// D
	'decoration:aide' => 'D&eacute;coration&nbsp;: <b>&lt;balise&gt;test&lt;/balise&gt;</b>, avec <b>balise</b> = @liste@',
	'decoration:description' => 'De nouveaux styles param&eacute;trables dans tes textes et accessibles gr&acirc;ce &agrave; des balises &agrave; chevrons. Exemple : 
&lt;mabalise&gt;texte&lt;/mabalise&gt; ou : &lt;mabalise/&gt;.<br />D&eacute;finissez ci-dessous les styles CSS dont tu as besoin, une balise par ligne, selon les syntaxes suivantes :
- {type.mabalise = mon style CSS}
- {type.mabalise.class = ma classe CSS}
- {type.mabalise.lang = ma langue (ex : fr)}
- {unalias = mabalise}

Le param&egrave;tre {type} ci-dessus peut prendre trois valeurs :
- {span} : balise &agrave; l\'int&eacute;rieur d\'un paragraphe (type Inline)
- {div} : balise cr&eacute;ant un nouveau paragraphe (type Block)
- {auto} : balise d&eacute;termin&eacute;e automatiquement par le plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'D&eacute;coration',
	'decoupe:aide' => 'Bloc d\'onglets : <b>&lt;onglets>&lt;/onglets></b><br />S&eacute;parateur de pages ou d\'onglets&nbsp;: @sep@',
	'decoupe:aide2' => 'Alias&nbsp;:&nbsp;@sep@',
	'decoupe:description' => '@puce@ D&eacute;coupe l\'affichage public d\'un article en plusieurs pages gr&acirc;ce &agrave; une pagination automatique. Place simplement dans ton article quatre signes plus cons&eacute;cutifs (<code>++++</code>) &agrave; l\'endroit qui doit recevoir la coupure.

Par d&eacute;faut, le Couteau Suisse ins&egrave;re la pagination en t&ecirc;te et en pied d\'article automatiquement. Mais tu as la possibilit&eacute; de placer cette pagination ailleurs dans ton squelette gr&acirc;ce &agrave; une balise #CS_DECOUPE que tu peux activer ici :
[[%balise_decoupe%]]

@puce@ Si tu utilises ce s&eacute;parateur &agrave; l\'int&eacute;rieur des balises &lt;onglets&gt; et &lt;/onglets&gt; alors tu obtiendras un jeu d\'onglets.

Dans les squelettes : tu as &agrave; ta disposition les nouvelles balises #ONGLETS_DEBUT, #ONGLETS_TITRE et #ONGLETS_FIN.

Cet outil peut &ecirc;tre coupl&eacute; avec  &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # MODIF
	'decoupe:nom' => 'D&eacute;coupe en pages et onglets',
	'desactiver_flash:description' => 'Supprime les objets flash des pages de ton site et les remplace par le contenu alternatif associ&eacute;.',
	'desactiver_flash:nom' => 'D&eacute;sactive les objets flash',
	'detail_balise_etoilee' => '{{Attention}} : V&eacute;rifie bien l\'utilisation faite par tes squelettes des balises &eacute;toil&eacute;es. Les traitements de cet outil ne s\'appliqueront pas sur : @bal@.',
	'detail_disabled' => 'Param&egrave;tres non modifiables :',
	'detail_fichiers' => 'Fichiers :',
	'detail_fichiers_distant' => 'Fichiers distants :',
	'detail_inline' => 'Code inline :',
	'detail_jquery2' => 'Cet outil n&eacute;cessite la librairie {jQuery}.',
	'detail_jquery3' => '{{Attention}} : cet outil n&eacute;cessite le plugin [jQuery pour SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] pour fonctionner correctement avec cette version de SPIP.',
	'detail_pipelines' => 'Pipelines :',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.',
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_spip_options2' => 'Il est recommand&eacute; de placer les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;[.->cs_comportement]&raquo;.', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_traitements' => 'Traitements :',
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
	'distant_aide' => 'Cet outil requiert des fichiers distants qui doivent tous &ecirc;tre correctement install&eacute;s en librairie. Avant d\'activer cet outil ou d\'actualiser ce cadre, assure-toi que les fichiers requis sont bien pr&eacute;sents sur le serveur distant.',
	'distant_charge' => 'Fichier correctement t&eacute;l&eacute;charg&eacute; et install&eacute; en librairie.',
	'distant_charger' => 'Lancer le t&eacute;l&eacute;chargement',
	'distant_echoue' => 'Erreur sur le chargement distant, cet outil risque de ne pas fonctionner !',
	'distant_inactif' => 'Fichier introuvable (outil inactif).',
	'distant_present' => 'Fichier pr&eacute;sent en librairie depuis le @date@.',
	'dossier_squelettes:description' => 'Modifie le dossier du squelette utilis&eacute;. Par exemple : "squelettes/monsquelette". Tu peux inscrire plusieurs dossiers en les s&eacute;parant par les deux points <html>&laquo;&nbsp;:&nbsp;&raquo;</html>. En laissant vide la case qui suit (ou en tapant "dist"), c\'est le squelette original "dist" fourni par SPIP qui sera utilis&eacute;.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Dossier du squelette',

	// E
	'ecran_activer' => 'Activer l\'&eacute;cran de s&eacute;curit&eacute;', # NEW
	'ecran_conflit' => 'Attention : le fichier statique &laquo;@file@&raquo; peut entrer en conflit. Choisissez votre m&eacute;thode de protection !',
	'ecran_conflit2' => 'Note : un fichier statique &laquo;@file@&raquo; a &eacute;t&eacute; d&eacute;tect&eacute; et activ&eacute;. Le Couteau Suisse ne pourra le mettre &agrave; jour ou le configurer.',
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
	'effaces' => 'Effac&eacute;s',
	'en_travaux:description' => 'Pendant une phase de maintenance, permet d\'afficher un message personalisable sur tout le site public, &eacute;ventuellement la partie priv&eacute;e.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Site en travaux',
	'erreur:bt' => '<span style=\\"color:red;\\">Attention :</span> la barre typographique (version @version@) semble ancienne.<br />Le Couteau Suisse est compatible avec une version sup&eacute;rieure ou &eacute;gale &agrave; @mini@.',
	'erreur:description' => 'id manquant dans la d&eacute;finition de l\'outil !',
	'erreur:distant' => 'le serveur distant',
	'erreur:jquery' => '{{Note}} : la librairie {jQuery} semble inactive sur cette page. Consulte [ici->http://www.spip-contrib.net/?article2166] le paragraphe sur les d&eacute;pendances du plugin ou recharger cette page.',
	'erreur:js' => 'Une erreur JavaScript semble &ecirc;tre survenue sur cette page et emp&ecirc;che son bon fonctionnement. Active le JavaScript sur ton navigateur ou d&eacute;sactive certains plugins SPIP de ton site.',
	'erreur:nojs' => 'Le JavaScript est d&eacute;sactiv&eacute; sur cette page.',
	'erreur:nom' => 'Erreur !',
	'erreur:probleme' => 'Probl&egrave;me sur : @pb@',
	'erreur:traitements' => 'Le Couteau Suisse - Erreur de compilation des traitements : m&eacute;lange \'typo\' et \'propre\' interdit !',
	'erreur:version' => 'Cet outil est indisponible dans cette version de SPIP.',
	'erreur_groupe' => 'Attention : le groupe &laquo;@groupe@&raquo; n\'est pas d&eacute;fini !',
	'erreur_mot' => 'Attention : le mot-cl&eacute; &laquo;@mot@&raquo; n\'est pas d&eacute;fini !',
	'etendu' => '&Eacute;tendu',

	// F
	'f_jQuery:description' => 'Emp&ecirc;che l\'installation de {jQuery} dans la partie publique afin d\'&eacute;conomiser un peu de &laquo;temps machine&raquo;. Cette librairie ([->http://jquery.com/]) apporte de nombreuses commodit&eacute;s dans la programmation de JavaScript et peut &ecirc;tre utilis&eacute;e par certains plugins. SPIP l\'utilise dans sa partie priv&eacute;e.

Attention : certains outils du Couteau Suisse n&eacute;cessitent les fonctions de {jQuery}. ', # MODIF
	'f_jQuery:nom' => 'D&eacute;sactive jQuery',
	'filets_sep:aide' => 'Filets de S&eacute;paration&nbsp;: <b>__i__</b> o&ugrave; <b>i</b> est un nombre de <b>0</b> &agrave; <b>@max@</b>.<br />Autres filets disponibles : @liste@',
	'filets_sep:description' => 'Ins&egrave;re des filets de s&eacute;paration, personnalisables par des feuilles de style, dans tous les textes de SPIP.
_ La syntaxe est : "__code__", o&ugrave; "code" repr&eacute;sente soit le num&eacute;ro d’identification (de 0 &agrave; 7) du filet &agrave; ins&eacute;rer en relation directe avec les styles correspondants, soit le nom d\'une image plac&eacute;e dans le dossier plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Filets de S&eacute;paration',
	'filtrer_javascript:description' => 'Pour g&eacute;rer l\'insertion de JavaScript dans les articles, trois modes sont disponibles :
- <i>jamais</i> : le JavaScript est refus&eacute; partout
- <i>d&eacute;faut</i> : le JavaScript est signal&eacute; en rouge dans l\'espace priv&eacute;
- <i>toujours</i> : le JavaScript est accept&eacute; partout.

Attention : dans les forums, p&eacute;titions, flux syndiqu&eacute;s, etc., la gestion du JavaScript est <b>toujours</b> s&eacute;curis&eacute;e.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Gestion du JavaScript ',
	'flock:description' => 'D&eacute;sactive le syst&egrave;me de verrouillage de fichiers en neutralisant la fonction PHP {flock()}. Certains h&eacute;bergements posent en effet des probl&egrave;mes graves suite &agrave; un syst&egrave;me de fichiers inadapt&eacute; ou &agrave; un manque de synchronisation. N\'active pas cet outil si ton site fonctionne normalement.',
	'flock:nom' => 'Pas de verrouillage de fichiers',
	'fonds' => 'Fonds :',
	'forcer_langue:description' => 'Force le contexte de langue pour les jeux de squelettes multilingues disposant d\'un formulaire ou d\'un menu de langues sachant g&eacute;rer le cookie de langues.

Techniquement, cet outil a pour effet :
- de d&eacute;sactiver la recherche du squelette en fonction de la langue de l\'objet,
- de d&eacute;sactiver le crit&egrave;re <code>{lang_select}</code> automatique sur les objets classiques (articles, br&egrave;ves, rubriques etc ... ).

Les blocs multi s\'affichent alors toujours dans la langue demand&eacute;e par le visiteur.', # MODIF
	'forcer_langue:nom' => 'Force la langue',
	'format_spip' => 'Les articles au format SPIP',
	'forum_lgrmaxi:description' => 'Par d&eacute;faut les messages de forum ne sont pas limit&eacute;s en taille. Si cet outil est activ&eacute;, un message d\'erreur s\'affichera lorsque quelqu\'un voudra poster un message  d\'une taille sup&eacute;rieure &agrave; la valeur sp&eacute;cifi&eacute;e, et le message sera refus&eacute;. Une valeur vide ou &eacute;gale &agrave; 0 signifie n&eacute;anmoins qu\'aucune limite ne s\'applique.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Taille des forums',

	// G
	'glossaire:aide' => 'Un texte sans glossaire : <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Gestion d’un glossaire interne li&eacute; &agrave; un ou plusieurs groupes de mots-cl&eacute;s. Inscris ici le nom des groupes en les s&eacute;parant par les deux points &laquo;&nbsp;:&nbsp;&raquo;. En laissant vide la case qui  suit (ou en tapant "Glossaire"), c’est le groupe "Glossaire" qui sera utilis&eacute;.[[%glossaire_groupes%]]

@puce@ Pour chaque mot, tu as la possibilit&eacute; de choisir le nombre maximal de liens cr&eacute;&eacute;s dans tes textes. Toute valeur nulle ou n&eacute;gative implique que tous les mots reconnus seront trait&eacute;s.[[%glossaire_limite% par mot-cl&eacute;]]

@puce@ Deux solutions te sont offertes pour g&eacute;n&eacute;rer la petite fen&ecirc;tre automatique qui appara&icirc;t lors du survol de la souris. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Glossaire interne',
	'glossaire_css' => 'Solution CSS',
	'glossaire_erreur' => 'Le mot &laquo;@mot1@&raquo; rend ind&eacute;tectable le mot &laquo;@mot2@&raquo;',
	'glossaire_inverser' => 'Correction propos&eacute;e : inverser l\'ordre des mots en base.',
	'glossaire_js' => 'Solution JavaScript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) &eacute;tudi&eacute;(s) en base semble correcte.',
	'guillemets:description' => 'Remplace automatiquement les guillemets droits (") par les guillemets typographiques de la langue de composition. Le remplacement, transparent pour l\'utilisateur, ne modifie pas le texte original mais seulement l\'affichage final.',
	'guillemets:nom' => 'Guillemets typographiques',

	// H
	'help' => '{{Cette page est uniquement accessible aux responsables du site.}} Elle permet la configuration des diff&eacute;rentes fonctions suppl&eacute;mentaires apport&eacute;es par le plugin &laquo;{{Le&nbsp;Couteau&nbsp;Suisse}}&raquo;.',
	'help2' => 'Version locale : @version@',
	'help3' => '<p>Liens de documentation :<br />• [{{Le&nbsp;Couteau&nbsp;Suisse}}->http://www.spip-contrib.net/?article2166]@contribs@</p><p>R&eacute;initialisations :
_ • [Des outils cach&eacute;s|Revenir &agrave; l\'apparence initiale de cette page->@hide@]
_ • [De tout le plugin|Revenir &agrave; l\'&eacute;tat initial du plugin->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Outil en cours de d&eacute;veloppement. T\'offre une horloge JavaScript . Balise : <code>#HORLOGE{format,utc,id}</code>. Mod&egrave;le : <code><horloge></code>', # MODIF
	'horloge:nom' => 'Horloge',

	// I
	'icone_visiter:description' => 'Remplace l\'image du bouton standard &laquo;<:icone_visiter_site:>&raquo; (en haut &agrave; droite sur cette page)  par le logo du site, s\'il existe.

Pour d&eacute;finir ce logo, rends  toi sur la page &laquo;<:titre_configuration:>&raquo; en cliquant sur le bouton &laquo;<:icone_configuration_site:>&raquo;.', # MODIF
	'icone_visiter:nom' => 'Bouton &laquo;&nbsp;<:icone_visiter_site:>&nbsp;&raquo;',
	'insert_head:description' => 'Active automatiquement la balise [#INSERT_HEAD->http://www.spip.net/fr_article1902.html] sur tous les squelettes, qu\'ils aient ou non cette balise entre &lt;head&gt; et &lt;/head&gt;. Gr&acirc;ce &agrave; cette option, les plugins pourront ins&eacute;rer du JavaScript (.js) ou des feuilles de style (.css).',
	'insert_head:nom' => 'Balise #INSERT_HEAD',
	'insertions:description' => 'ATTENTION : outil en cours de d&eacute;veloppement !! [[%insertions%]]',
	'insertions:nom' => 'Corrections automatiques',
	'introduction:description' => 'Cette balise &agrave; placer dans les squelettes sert en g&eacute;n&eacute;ral &agrave; la une ou dans les rubriques afin de produire un r&eacute;sum&eacute; des articles, des br&egrave;ves, etc..</p>
<p>{{Attention}} : Avant d\'activer cette fonctionnalit&eacute;, v&eacute;rifie bien qu\'aucune fonction {balise_INTRODUCTION()} n\'existe d&eacute;j&agrave; dans ton squelette ou tes plugins, la surcharge produirait alors une erreur de compilation.</p>
@puce@ Tu peux pr&eacute;ciser (en pourcentage par rapport &agrave; la valeur utilis&eacute;e par d&eacute;faut) la longueur du texte renvoy&eacute; par balise #INTRODUCTION. Une valeur nulle ou &eacute;gale &agrave; 100 ne modifie pas l\'aspect de l\'introduction et utilise donc les valeurs par d&eacute;faut suivantes : 500 caract&egrave;res pour les articles, 300 pour les br&egrave;ves et 600 pour les forums ou les rubriques.
[[%lgr_introduction%&nbsp;%]]
@puce@ Par d&eacute;faut, les points de suite ajout&eacute;s au r&eacute;sultat de la balise #INTRODUCTION si le texte est trop long sont : <html>&laquo;&amp;nbsp;(…)&raquo;</html>. Tu peux ici pr&eacute;ciser ta propre cha&icirc;ne de caract&egrave;re indiquant au lecteur que le texte tronqu&eacute; a bien une suite.
[[%suite_introduction%]]
@puce@ Si la balise #INTRODUCTION est utilis&eacute;e pour r&eacute;sumer un article, alors le Couteau Suisse peut fabriquer un lien hypertexte sur les points de suite d&eacute;finis ci-dessus afin de mener le lecteur vers le texte original. Par exemple : &laquo;Lire la suite de l\'article…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'Balise #INTRODUCTION',

	// J
	'jcorner:description' => '&laquo;&nbsp;Jolis Coins&nbsp;&raquo; est un outil permettant de modifier facilement l\'aspect des coins de vos {{cadres color&eacute;s}} en partie publique de votre site. Tout est possible, ou presque !
_ Voir le r&eacute;sultat sur cette page : [->http://www.malsup.com/jquery/corner/].

Liste ci-dessous les objets de ton squelette &agrave; arrondir en utilisant la syntaxe CSS (.class, #id, etc. ). Utilise le le signe &laquo;&nbsp;=&nbsp;&raquo; pour sp&eacute;cifier la commande jQuery &agrave; utiliser et un double slash (&laquo;&nbsp;//&nbsp;&raquo;) pour les commentaires. En absence du signe &eacute;gal, des coins ronds seront appliqu&eacute;s (&eacute;quivalent &agrave; : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Attention, cet outil a besoin pour fonctionner du plugin {jQuery} : {Round Corners}. Le Couteau Suisse peut l\'installer directement si tu coches la case suivante. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Jolis Coins',
	'jcorner_plugin' => '&laquo;&nbsp;Round Corners plugin&nbsp;&raquo;',
	'jq_localScroll' => 'jQuery.LocalScroll ([d&eacute;mo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([d&eacute;mo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'D&eacute;faut',
	'js_jamais' => 'Jamais',
	'js_toujours' => 'Toujours',
	'jslide_aucun' => 'Aucune animation',
	'jslide_fast' => 'Glissement rapide',
	'jslide_lent' => 'Glissement lent',
	'jslide_millisec' => 'Glissement durant&nbsp;:',
	'jslide_normal' => 'Glissement normal',

	// L
	'label:admin_travaux' => 'Fermer le site public pour :',
	'label:arret_optimisation' => 'Emp&ecirc;cher SPIP de vider la corbeille automatiquement&nbsp;:',
	'label:auteur_forum_nom' => 'Le visiteur doit sp&eacute;cifier :',
	'label:auto_sommaire' => 'Cr&eacute;ation syst&eacute;matique du sommaire :',
	'label:balise_decoupe' => 'Activer la balise #CS_DECOUPE :',
	'label:balise_sommaire' => 'Activer la balise #CS_SOMMAIRE :',
	'label:bloc_h4' => 'Balise pour les titres&nbsp;:',
	'label:bloc_unique' => 'Un seul bloc ouvert sur la page :',
	'label:blocs_cookie' => 'Utilisation des cookies :',
	'label:blocs_slide' => 'Type d\'animation&nbsp;:',
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal r&eacute;serv&eacute; aux copies locales :',
	'label:couleurs_fonds' => 'Permettre les fonds :',
	'label:cs_rss' => 'Activer :',
	'label:debut_urls_propres' => 'D&eacute;but des URLs :',
	'label:decoration_styles' => 'Tes balises de style personnalis&eacute; :',
	'label:derniere_modif_invalide' => 'Recalculer juste apr&egrave;s une modification :',
	'label:devdebug_espace' => 'Filtrage de l\'espace concern&#233; :', # NEW
	'label:devdebug_mode' => 'Activer le d&eacute;bogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoy&eacute; :', # NEW
	'label:distant_off' => 'D&eacute;sactiver :',
	'label:doc_Smax' => 'Taille maximale des documents :',
	'label:dossier_squelettes' => 'Dossier(s) &agrave; utiliser :',
	'label:duree_cache' => 'Dur&eacute;e du cache local :',
	'label:duree_cache_mutu' => 'Dur&eacute;e du cache en mutualisation :',
	'label:ecran_actif' => '@_CS_CHOIX@', # NEW
	'label:enveloppe_mails' => 'Petite enveloppe devant les mails :',
	'label:expo_bofbof' => 'Mise en exposants pour : <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:forum_lgrmaxi' => 'Valeur (en caract&egrave;res) :',
	'label:glossaire_groupes' => 'Groupe(s) utilis&eacute;(s) :',
	'label:glossaire_js' => 'Technique utilis&eacute;e :',
	'label:glossaire_limite' => 'Nombre maximal de liens cr&eacute;&eacute;s :',
	'label:i_align' => 'Alignement du texte&nbsp;:',
	'label:i_couleur' => 'Couleur de la police&nbsp;:',
	'label:i_hauteur' => 'Hauteur de la ligne de texte (&eacute;q. &agrave; {line-height})&nbsp;:',
	'label:i_largeur' => 'Largeur maximale de la ligne de texte&nbsp;:',
	'label:i_padding' => 'Espacement autour du texte (&eacute;q. &agrave; {padding})&nbsp;:',
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/})&nbsp;:',
	'label:i_taille' => 'Taille de la police&nbsp;:',
	'label:img_GDmax' => 'Calculs d\'images avec GD :',
	'label:img_Hmax' => 'Taille maximale des images :',
	'label:insertions' => 'Corrections automatiques :',
	'label:jcorner_classes' => 'Am&eacute;liorer les coins des s&eacute;lecteurs suivantes :',
	'label:jcorner_plugin' => 'Installer le plugin {jQuery} suivant :',
	'label:jolies_ancres' => 'Calculer de jolies ancres :',
	'label:lgr_introduction' => 'Longueur du r&eacute;sum&eacute; :',
	'label:lgr_sommaire' => 'Largeur du sommaire (9 &agrave; 99) :',
	'label:lien_introduction' => 'Points de suite cliquables :',
	'label:liens_interrogation' => 'Prot&eacute;ger les URLs :',
	'label:liens_orphelins' => 'Liens cliquables :',
	'label:log_couteau_suisse' => 'Activer :',
	'label:logo_Hmax' => 'Taille maximale des logos :',
	'label:marqueurs_urls_propres' => 'Ajouter les marqueurs dissociant les objets (SPIP>=2.0) :<br />(ex. : &laquo;&nbsp;-&nbsp;&raquo; pour -Ma-rubrique-, &laquo;&nbsp;@&nbsp;&raquo; pour @Mon-site@) ',
	'label:max_auteurs_page' => 'Auteurs par page :',
	'label:message_travaux' => 'Ton message de maintenance :',
	'label:moderation_admin' => 'Valider automatiquement les messages des : ',
	'label:mot_masquer' => 'Mot-cl&eacute; masquant les contenus :',
	'label:ouvre_note' => 'Ouverture et fermeture des notes de bas de page',
	'label:ouvre_ref' => 'Ouverture et fermeture des appels de notes de bas de page',
	'label:paragrapher' => 'Toujours paragrapher :',
	'label:prive_travaux' => 'Accessibilit&eacute; de l\'espace priv&eacute; pour :',
	'label:prof_sommaire' => 'Profondeur retenue (1 &agrave; 4) :',
	'label:puce' => 'Puce publique &laquo;<html>-</html>&raquo; :',
	'label:quota_cache' => 'Valeur du quota :',
	'label:racc_g1' => 'Entr&eacute;e et sortie de la mise en &laquo;<html>{{gras}}</html>&raquo; :',
	'label:racc_h1' => 'Entr&eacute;e et sortie d\'un &laquo;<html>{{{intertitre}}}</html>&raquo; :',
	'label:racc_hr' => 'Ligne horizontale &laquo;<html>----</html>&raquo; :',
	'label:racc_i1' => 'Entr&eacute;e et sortie d\'un &laquo;<html>{italique}</html>&raquo; :',
	'label:radio_desactive_cache3' => 'Utilisation du cache :',
	'label:radio_desactive_cache4' => 'Utilisation du cache :',
	'label:radio_target_blank3' => 'Nouvelle fen&ecirc;tre pour les liens externes :',
	'label:radio_type_urls3' => 'Format des URLs :',
	'label:scrollTo' => 'Installer les plugins {jQuery} suivants :',
	'label:separateur_urls_page' => 'Caract&egrave;re de s&eacute;paration \'type-id\'<br />(ex. : ?article-123) :',
	'label:set_couleurs' => 'Set &agrave; utiliser :',
	'label:spam_ips' => 'Adresses IP &agrave; bloquer :',
	'label:spam_mots' => 'S&eacute;quences interdites :',
	'label:spip_options_on' => 'Inclure :',
	'label:spip_script' => 'Script d\'appel :',
	'label:style_h' => 'Ton style :',
	'label:style_p' => 'Ton style :',
	'label:suite_introduction' => 'Points de suite :',
	'label:terminaison_urls_page' => 'Terminaison des URLs (ex : &laquo;&nbsp;.html&nbsp;&raquo;) :',
	'label:titre_travaux' => 'Titre du message :',
	'label:titres_etendus' => 'Activer l\'utilisation &eacute;tendue des balises #TITRE_XXX&nbsp;:',
	'label:url_arbo_minuscules' => 'Conserver la casse des titres dans les URLs :',
	'label:url_arbo_sep_id' => 'Caract&egrave;re de s&eacute;paration \'titre-id\' en cas de doublon :<br />(ne pas utiliser \'/\')',
	'label:url_glossaire_externe2' => 'Lien vers le glossaire externe :',
	'label:url_max_propres' => 'Longueur maximale des URLs (caract&egrave;res) :',
	'label:urls_arbo_sans_type' => 'Afficher le type d\'objet SPIP dans les URLs :',
	'label:urls_avec_id' => 'Un id syst&eacute;matique, mais...',
	'label:webmestres' => 'Liste des webmestres du site :',
	'liens_en_clair:description' => 'Met &agrave; ta disposition le filtre : \'liens_en_clair\'. Ton texte contient probablement des liens hypertexte qui ne sont pas visibles lors d\'une impression. Ce filtre ajoute entre crochets la destination de chaque lien cliquable (liens externes ou mails). Attention : en mode impression (parametre \'cs=print\' ou \'page=print\' dans l\'url de la page), cette fonctionnalit&eacute; est appliqu&eacute;e automatiquement.',
	'liens_en_clair:nom' => 'Liens en clair',
	'liens_orphelins:description' => 'Cet outil a deux fonctions :

@puce@ {{Liens corrects}}.

SPIP a pour habitude d\'ins&eacute;rer un espace avant les points d\'interrogation ou d\'exclamation et de transformer le double tiret en tiret cadratin, typo fran&ccedil;aise oblige. Hors, les URLs de tes textes ne sont pas &eacute;pargn&eacute;es. Cet outil te permet de les prot&eacute;ger.[[%liens_interrogation%]]

@puce@ {{Liens orphelins}}.

Remplace syst&eacute;matiquement toutes les URLs laiss&eacute;es en texte par les utilisateurs (notamment dans les forums) et qui ne sont donc pas cliquables, par des liens hypertextes au format SPIP. Par exemple : {<html>www.spip.net</html>} est remplac&eacute; par [->www.spip.net].

Tu peux choisir le type de remplacement :
_ &#8226; {Basique} : sont remplac&eacute;s les liens du type {<html>http://spip.net</html>} (tout protocole) ou {<html>www.spip.net</html>}.
_ &#8226; {&Eacute;tendu} : sont remplac&eacute;s en plus les liens du type {<html>moi@spip.net</html>}, {<html>mailto:monmail</html>} ou {<html>news:mesnews</html>}.
_ &#8226; {Par d&eacute;faut} : remplacement automatique d\'origine (&agrave; partir de la version 2.0 de SPIP).
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:nom' => 'Belles URLs',

	// M
	'mailcrypt:description' => 'Masque tous les liens de courriels pr&eacute;sents dans tes textes en les rempla&ccedil;ant par un lien JavaScript permettant quand m&ecirc;me d\'activer la messagerie du lecteur. Cet outil antispam tente d\'emp&ecirc;cher les robots de collecter les adresses &eacute;lectroniques laiss&eacute;es en clair dans les forums ou dans les balises de tes squelettes.',
	'mailcrypt:nom' => 'MailCrypt',
	'maj_auto:description' => 'Cet outil te permet de g&eacute;rer facilement la mise &agrave; jour de tes diff&eacute;rents plugins, r&eacute;cup&eacute;rant notamment le num&eacute;ro de r&eacute;vision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouv&eacute; sur <code>zone.spip.org</code>.

La liste ci-dessus offre la possibilit&eacute; de lancer le processus de mise &agrave; jour automatique de SPIP sur chacun des plugins pr&eacute;alablement install&eacute;s dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> sont simplement list&eacute;s &agrave; titre d\'information. Si la r&eacute;vision distante n\'a pas pu &ecirc;tre trouv&eacute;e, alors tente de proc&eacute;der manuellement &agrave; la mise &agrave; jour du plugin.

Note : les paquets <code>.zip</code> n\'&eacute;tant pas reconstruits instantan&eacute;ment, il se peut que tu soies oblig&eacute; d\'attendre un certain d&eacute;lai avant de pouvoir effectuer la totale mise &agrave; jour d\'un plugin tout r&eacute;cemment modifi&eacute;.', # MODIF
	'maj_auto:nom' => 'Mises &agrave; jour automatiques',
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particuli&egrave;re de tes squelettes, les contenus (rubriques ou articles) qui ont le mot-cl&eacute; d&eacute;fini ci-dessous. Si une rubrique est masqu&eacute;e, toute sa branche l\'est aussi.[[%mot_masquer%]]

Pour forcer l\'affichage des contenus masqu&eacute;s, il suffit d\'ajouter le crit&egrave;re <code>{tout_voir}</code> aux boucles de ton squelette.', # MODIF
	'masquer:nom' => 'Masquer du contenu',
	'meme_rubrique:description' => 'D&eacute;finis ici le nombre d\'objets list&eacute;s dans le cadre nomm&eacute; &laquo;<:info_meme_rubrique:>&raquo; et pr&eacute;sent sur certaines pages de l\'espace priv&eacute;.[[%meme_rubrique%]]',
	'message_perso' => 'Un grand merci aux traducteurs qui passeraient par ici. Pat ;-)',
	'moderation_admins' => 'administrateurs authentifi&eacute;s',
	'moderation_message' => 'Ce forum est mod&eacute;r&eacute; &agrave; priori&nbsp;: ta contribution n\'appara&icirc;tra qu\'apr&egrave;s avoir &eacute;t&eacute; valid&eacute;e par un administrateur du site, sauf si tu es identifi&eacute; et autoris&eacute; &agrave; poster directement.',
	'moderation_moderee:description' => 'Permet de mod&eacute;rer la mod&eacute;ration des forums publics <b>configur&eacute;s &agrave; priori</b> pour les utilisateurs inscrits.<br />Exemple : Je suis le webmestre de mon site, et je r&eacute;ponds &agrave; un message d\'un utilisateur, pourquoi devoir valider mon propre message ? Mod&eacute;ration mod&eacute;r&eacute;e le fait pour moi ! [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Mod&eacute;ration mod&eacute;r&eacute;e',
	'moderation_redacs' => 'r&eacute;dacteurs authentifi&eacute;s',
	'moderation_visits' => 'visiteurs authentifi&eacute;s',
	'modifier_vars' => 'Modifier ces @nb@ param&egrave;tres',
	'modifier_vars_0' => 'Modifier ces param&egrave;tres',

	// N
	'no_IP:description' => 'D&eacute;sactive le m&eacute;canisme d\'enregistrement automatique des adresses IP des visiteurs de ton site par soucis de confidentialit&eacute; : SPIP ne conservera alors plus aucun num&eacute;ro IP, ni temporairement lors des visites (pour g&eacute;rer les statistiques ou alimenter spip.log), ni dans les forums (responsabilit&eacute;).',
	'no_IP:nom' => 'Pas de stockage IP',
	'nouveaux' => 'Nouveaux',

	// O
	'orientation:description' => '3 nouveaux crit&egrave;res pour tes squelettes : <code>{portrait}</code>, <code>{carre}</code> et <code>{paysage}</code>. Id&eacute;al pour le classement des photos en fonction de leur forme.',
	'orientation:nom' => 'Orientation des images',
	'outil_actif' => 'Outil actif',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activer',
	'outil_activer_le' => 'Activer l\'outil',
	'outil_cacher' => 'Ne plus afficher',
	'outil_desactiver' => 'D&eacute;sactiver',
	'outil_desactiver_le' => 'D&eacute;sactiver l\'outil',
	'outil_inactif' => 'Outil inactif',
	'outil_intro' => 'Cette page liste les fonctionnalit&eacute;s du plugin mises &agrave; ta disposition.<br /><br />En cliquant sur le nom des outils ci-dessous, tu s&eacute;lectionnes ceux dont tu pourras permuter l\'&eacute;tat &agrave; l\'aide du bouton central : les outils activ&eacute;s seront d&eacute;sactiv&eacute;s et <i>vice versa</i>. &Agrave; chaque clic, la description appara&icirc;t au-dessous des listes. Les cat&eacute;gories sont repliables et les outils peuvent &ecirc;tre cach&eacute;s. Le double-clic permet de permuter rapidement un outil.<br /><br />Pour une premi&egrave;re utilisation, il est recommand&eacute; d\'activer les outils un par un, au cas o&ugrave; appara&icirc;traient certaines incompatibilit&eacute;s avec ton squelette, avec SPIP ou avec d\'autres plugins.<br /><br />Note : le simple chargement de cette page recompile l\'ensemble des outils du Couteau Suisse.',
	'outil_intro_old' => 'Cette interface est ancienne.<br /><br />Si tu rencontres des probl&egrave;mes dans l\'utilisation de la <a href=\'./?exec=admin_couteau_suisse\'>nouvelle interface</a>, n\'h&eacute;site pas &agrave; nous en faire part sur le forum de <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@&nbsp;: @nb@&nbsp;outil',
	'outil_nbs' => '@pipe@&nbsp;: @nb@&nbsp;outils',
	'outil_permuter' => 'Permuter l\'outil : &laquo; @text@ &raquo; ?',
	'outils_actifs' => 'Outils actifs :',
	'outils_caches' => 'Outils cach&eacute;s :',
	'outils_cliquez' => 'Clique sur le nom des outils ci-dessus pour afficher ici leur description.',
	'outils_concernes' => 'Sont concern&eacute;s : ',
	'outils_desactives' => 'Sont d&eacute;sactiv&eacute;s : ',
	'outils_inactifs' => 'Outil inactifs :',
	'outils_liste' => 'Liste des outils du Couteau Suisse',
	'outils_non_parametrables' => 'Non param&eacute;trables&nbsp;:',
	'outils_permuter_gras1' => 'Permuter les outils en gras',
	'outils_permuter_gras2' => 'Permuter les @nb@ outils en gras ?',
	'outils_resetselection' => 'R&eacute;initialiser la s&eacute;lection',
	'outils_selectionactifs' => 'S&eacute;lectionner tous les outils actifs',
	'outils_selectiontous' => 'TOUS',

	// P
	'pack_actuel' => 'Pack @date@',
	'pack_actuel_avert' => 'Attention, les surcharges sur les define(), les autorisations sp&eacute;cifiques ou les globales ne sont pas sp&eacute;cifi&eacute;es ici',
	'pack_actuel_titre' => 'PACK ACTUEL DE CONFIGURATION DU COUTEAU SUISSE',
	'pack_alt' => 'Voir les param&egrave;tres de configuration en cours',
	'pack_delete' => 'Supression d\'un pack de configuration',
	'pack_descrip' => 'Ton &laquo;&nbsp;Pack de configuration actuelle&nbsp;&raquo; rassemble l\'ensemble des param&egrave;tres de configuration en cours concernant le Couteau Suisse : l\'activation des outils et la valeur de leurs &eacute;ventuelles variables.

Si les droits d\'&eacute;criture le permettent, le code PHP ci-dessous pourra prendre place dans le fichier /config/mes_options.php et ajoutera un lien de r&eacute;initialisation sur cette page "du pack &laquo;&nbsp;{@pack@}&nbsp;&raquo;.  Bien s&ucirc;r il t\'est possible de changer son nom.

Si tu r&eacute;initialises le plugin en cliquant sur un pack, le Couteau Suisse se reconfigurera automatiquement en fonction des param&egrave;tres pr&eacute;d&eacute;finis dans ce pack.', # MODIF
	'pack_du' => '• du pack @pack@',
	'pack_installe' => 'Mise en place d\'un pack de configuration',
	'pack_installer' => 'Es-tu s&ucirc;r de vouloir r&eacute;initialiser le Couteau Suisse et installer le pack &laquo;&nbsp;@pack@&nbsp;&raquo; ?',
	'pack_nb_plrs' => 'Il y a actuellement @nb@ &laquo;&nbsp;packs de configuration&nbsp;&raquo; disponibles.',
	'pack_nb_un' => 'Il y a actuellement un &laquo;&nbsp;pack de configuration&nbsp;&raquo; disponible',
	'pack_nb_zero' => 'Il n\'y a pas de &laquo;&nbsp;pack de configuration&nbsp;&raquo; disponible actuellement.',
	'pack_outils_defaut' => 'Installation des outils par d&eacute;faut',
	'pack_sauver' => 'Sauver la configuration actuelle',
	'pack_sauver_descrip' => 'Le bouton ci-dessous te permet d\'ins&eacute;rer directement dans ton fichier <b>@file@</b> les param&egrave;tres n&eacute;cessaires pour ajouter un &laquo;&nbsp;pack de configuration&nbsp;&raquo; dans le menu de gauche. Ceci te permettra ult&eacute;rieurement de reconfigurer en un clic votre Couteau Suisse dans l\'&eacute;tat o&ugrave; il est actuellement.',
	'pack_supprimer' => 'Es-tu s&ucirc;r de vouloir supprimer le pack &laquo;&nbsp;@pack@&nbsp;&raquo; ?',
	'pack_titre' => 'Configuration Actuelle',
	'pack_variables_defaut' => 'Installation des variables par d&eacute;faut',
	'par_defaut' => 'Par d&eacute;faut',
	'paragrapher2:description' => 'La fonction SPIP <code>paragrapher()</code> ins&egrave;re des balises &lt;p&gt; et &lt;/p&gt; dans tous les textes qui sont d&eacute;pourvus de paragraphes. Afin de g&eacute;rer plus finement tes styles et vos mises en page, tu as la possibilit&eacute; d\'uniformiser l\'aspect des textes de ton site.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Paragrapher',
	'pipelines' => 'Pipelines utilis&eacute;s&nbsp;:',
	'previsualisation:description' => 'Par d&eacute;faut, SPIP permet de pr&eacute;visualiser un article dans sa version publique et styl&eacute;e, mais uniquement lorsque celui-ci a &eacute;t&eacute; &laquo; propos&eacute; &agrave; l’&eacute;valuation &raquo;. Hors cet outil permet aux auteurs de pr&eacute;visualiser &eacute;galement les articles pendant leur r&eacute;daction. Chacun peut alors pr&eacute;visualiser et modifier son texte &agrave; sa guise.

@puce@ Attention : cette fonctionnalit&eacute; ne modifie pas les droits de pr&eacute;visualisation. Pour que tes r&eacute;dacteurs aient effectivement le droit de pr&eacute;visualiser leurs articles &laquo; en cours de r&eacute;daction &raquo;, tu dois l’autoriser (dans le menu {[Configuration&gt;Fonctions avanc&eacute;es->./?exec=config_fonctions]} de l’espace priv&eacute;).', # MODIF
	'previsualisation:nom' => 'Pr&eacute;visualisation des articles',
	'puceSPIP' => 'Autoriser le raccourci &laquo;*&raquo;',
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>',
	'pucesli:description' => 'Remplace les puces &laquo;-&raquo; (tiret simple) des diff&eacute;rents contenus de ton site par des listes not&eacute;es &laquo;-*&raquo; (traduites en HTML par : &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) et dont le style peut &ecirc;tre facilement personnalis&eacute; par css.

Afin de conserver l\'acc&egrave;s &agrave; la puce image originale de SPIP (le petit triangle), un nouveau raccourci en d&eacute;but de ligne &laquo;*&raquo; peut &ecirc;tre propos&eacute; &agrave; tes r&eacute;dacteurs :[[%puceSPIP%]]', # MODIF
	'pucesli:nom' => 'Belles puces',

	// Q
	'qui_webmestres' => 'Les webmestres SPIP',

	// R
	'raccourcis' => 'Raccourcis typographiques actifs du Couteau Suisse&nbsp;:',
	'raccourcis_barre' => 'Les raccourcis typographiques du Couteau Suisse',
	'reserve_admin' => 'Acc&egrave;s r&eacute;serv&eacute; aux administrateurs.',
	'rss_actualiser' => 'Actualiser',
	'rss_attente' => 'Attente RSS...',
	'rss_desactiver' => 'D&eacute;sactiver les &laquo; R&eacute;visions du Couteau Suisse &raquo;',
	'rss_edition' => 'Flux RSS mis &agrave; jour le :',
	'rss_source' => 'Source RSS',
	'rss_titre' => '&laquo;&nbsp;Le Couteau Suisse&nbsp;&raquo; en d&eacute;veloppement :',
	'rss_var' => 'Les r&eacute;visions du Couteau Suisse',

	// S
	'sauf_admin' => 'Tous, sauf les administrateurs',
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et r&eacute;dacteurs',
	'sauf_identifies' => 'Tous, sauf les auteurs identifi&eacute;s',
	'set_options:description' => 'S&eacute;lectionne d\'office le type d’interface priv&eacute;e (simplifi&eacute;e ou avanc&eacute;e) pour tous les r&eacute;dacteurs d&eacute;j&agrave; existant ou &agrave; venir et supprime le bouton correspondant du bandeau des petites ic&ocirc;nes.[[%radio_set_options4%]]',
	'set_options:nom' => 'Type d\'interface priv&eacute;e',
	'sf_amont' => 'En amont',
	'sf_tous' => 'Tous',
	'simpl_interface:description' => 'D&eacute;sactive le menu de changement rapide de statut d\'un article au survol de sa puce color&eacute;e. Cela est utile si tu cherches &agrave; obtenir une interface priv&eacute;e la plus d&eacute;pouill&eacute;e possible afin d\'optimiser les performances client.',
	'simpl_interface:nom' => 'All&egrave;gement de l\'interface priv&eacute;e',
	'smileys:aide' => 'Smileys : @liste@',
	'smileys:description' => 'Ins&egrave;re des smileys dans tous les textes o&ugrave; appara&icirc;t un raccourci du genre <code>:-)</code>. Id&eacute;al pour les  forums.
_ Une balise est disponible pour afficher un tableau de smileys dans tes squelettes : #SMILEYS.
_ Dessins : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'Offre &agrave; ton site public un d&eacute;filement  adouci de la page lorsque le visiteur clique sur un lien pointant vers une ancre : tr&egrave;s utile pour &eacute;viter de se perdre dans une page complexe ou un texte tr&egrave;s long...

Attention, cet outil a besoin pour fonctionner de pages au &laquo;DOCTYPE XHTML&raquo; (non HTML !) et de deux plugins {jQuery} : {ScrollTo} et {LocalScroll}. Le Couteau Suisse peut les installer directement si tu coches les cases suivantes. [[%scrollTo%]][[-->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Ancres douces',
	'sommaire:description' => 'Construit un sommaire pour le texte de tes articles et de tes rubriques afin d’acc&eacute;der rapidement aux gros titres (balises HTML &lt;@h3@>Un gros titre&lt;/@h3@>) ou aux intertitres SPIP (de syntaxe <code>{{{Un intertitre}}}</code>).

Pour information, l\'outil &laquo;&nbsp;[.->class_spip]&nbsp;&raquo; permet de choisir la balise &lt;hN> utilis&eacute;e pour les intertitres de SPIP.

@puce@ D&eacute;finis ici la profondeur retenue sur les intertitres pour construire le sommaire (1 = &lt;@h3@>, 2 = &lt;@h3@> et &lt;@h4@>, etc.) :[[%prof_sommaire%]]

@puce@ D&eacute;finis ici le nombre maximal de caract&egrave;res retenus par intertitre :[[%lgr_sommaire% caract&egrave;res]]

@puce@ Les ancres du sommaire peuvent &ecirc;tre calcul&eacute;es &agrave; partir du titre et non ressembler &agrave; : {outil_sommaire_NN}. Cette option donne &eacute;galement acc&egrave;s &agrave; la syntaxe <code>{{{Mon titre<mon_ancre>}}}</code> qui permet de choisir l\'ancre utilis&eacute;e.[[%jolies_ancres%]]

@puce@ Fixe ici le comportement du plugin concernant la cr&eacute;ation du sommaire: 
_ • Syst&eacute;matique pour chaque article (une balise <code>@_CS_SANS_SOMMAIRE@</code> plac&eacute;e n’importe o&ugrave; &agrave; l’int&eacute;rieur du texte de l’article cr&eacute;era une exception).
_ • Uniquement pour les articles contenant la balise <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Par d&eacute;faut, le Couteau Suisse ins&egrave;re automatiquement le sommaire en t&ecirc;te d\'article. Mais tu as la possibilit&eacute; de placer ce sommaire ailleurs dans votre squelette gr&acirc;ce &agrave; une balise #CS_SOMMAIRE.
[[%balise_sommaire%]]

Ce sommaire est compatible avec &laquo;&nbsp;[.->decoupe]&nbsp;&raquo; et &laquo;&nbsp;[.->titres_typo]&nbsp;&raquo;.', # MODIF
	'sommaire:nom' => 'Sommaire automatique',
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre&lt;mon_ancre&gt;}}}</html></b>',
	'sommaire_avec' => 'Un texte avec sommaire&nbsp;: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un texte sans sommaire&nbsp;: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hi&eacute;rarchis&eacute;s&nbsp;: <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.',
	'spam:description' => 'Tente de lutter contre les envois de messages automatiques et malveillants en partie publique. Certains mots tout comme les balises en clair &lt;a>&lt;/a> sont interdits :  incite tes r&eacute;dacteurs &agrave; utiliser les raccourcis de liens au format SPIP.

@puce@ Liste ici les s&eacute;quences interdites en les s&eacute;parant par des espaces. [[%spam_mots%]]
<ql>• Pour une expression avec des espaces, place-la entre guillemets.
_ • Pour sp&eacute;cifier un mot entier, mets-le entre parenth&egrave;ses. Exemple~:~{(asses)}.
_ • Pour une expression r&eacute;guli&egrave;re, v&eacute;rifie bien la syntaxe et place-la entre slashes et entre guillemets.
_Exemple~:~{<html>"/@test.(com|fr)/"</html>}.
_ • Pour une expression r&eacute;guli&egrave;re devant agir sur des caract&egrave;res HTML, place le test entre &laquo;&amp;#&raquo; et &laquo;;&raquo;.
_ Exemple~:~{<html>"/&amp;#(?:1[4-9][0-9]{3}|[23][0-9]{4});/"</html>}.</q1>

@puce@ Certaines adresses IP peuvent &eacute;galement &ecirc;tre bloqu&eacute;es &agrave; la source. Sache toutefois que derri&egrave;re ces adresses (souvent variables), il peut y avoir plusieurs utilisateurs, voire un r&eacute;seau entier.[[%spam_ips%]]
<q1>• Utilise le caract&egrave;re &laquo;*&raquo; pour plusieurs chiffres, &laquo;?&raquo; pour un seul et les crochets pour des classes de chiffres.</q1>', # MODIF
	'spam:nom' => 'Lutte contre le SPAM',
	'spam_ip' => 'Blocage IP de @ip@ :',
	'spam_test_ko' => 'Ce message serait bloqu&eacute; par le filtre anti-SPAM !',
	'spam_test_ok' => 'Ce message serait accept&eacute; par le filtre anti-SPAM.',
	'spam_tester_bd' => 'Teste &eacute;galement ta base de donn&eacute;es et liste les messages qui auraient &eacute;t&eacute; bloqu&eacute;es par la configuration actuelle de l\'outil.',
	'spam_tester_label' => 'Teste ici ta liste de s&eacute;quences interdites ou d\'adresses&nbsp;IP, utilise le cadre suivant :',
	'spip_cache:description' => '@puce@ Le cache occupe un certain espace disque et SPIP peut en limiter l\'importance. Une valeur vide ou &eacute;gale &agrave; 0 signifie qu\'aucun quota ne s\'applique.[[%quota_cache% Mo]]

@puce@ Lorsqu\'une modification du contenu du site est faite, SPIP invalide imm&eacute;diatement le cache sans attendre le calcul p&eacute;riodique suivant. Si ton site a des probl&egrave;mes de performance face &agrave; une charge tr&egrave;s &eacute;lev&eacute;e, tu peux cocher &laquo;&nbsp;non&nbsp;&raquo; &agrave; cette option.[[%derniere_modif_invalide%]]

@puce@ Si la balise #CACHE n\'est pas trouv&eacute;e dans tes squelettes locaux, SPIP consid&egrave;re par d&eacute;faut que le cache d\'une page a une dur&eacute;e de vie de 24 heures avant de la recalculer. Afin de mieux g&eacute;rer la charge de ton serveur, vous pouvez ici modifier cette valeur.[[%duree_cache% heures]]

@puce@ Si tu as plusieurs sites en mutualisation, tu peux sp&eacute;cifier ici la valeur par d&eacute;faut prise en compte par tous les sites locaux (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ Par d&eacute;faut, SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en acc&eacute;l&eacute;rer la consultation. D&eacute;sactiver temporairement le cache peut aider au d&eacute;veloppement du site.[[%radio_desactive_cache3%]]',
	'spip_cache:description2' => '@puce@ Quatre options pour orienter le fonctionnement du cache de SPIP : <q1>
_ • {Usage normal} : SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en acc&eacute;l&eacute;rer la consultation. Apr&egrave;s un certain d&eacute;lai, le cache est recalcul&eacute; et stock&eacute;.
_ • {Cache permanent} : les d&eacute;lais d\'invalidation du cache sont ignor&eacute;s.
_ • {Pas de cache} : d&eacute;sactiver temporairement le cache peut aider au d&eacute;veloppement du site. Ici, rien n\'est stock&eacute; sur le disque.
_ • {Contr&ocirc;le du cache} : option identique &agrave; la pr&eacute;c&eacute;dente, avec une &eacute;criture sur le disque de tous les r&eacute;sultats afin de pouvoir &eacute;ventuellement les contr&ocirc;ler.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension &laquo; Compresseur &raquo; pr&eacute;sente dans SPIP permet de compacter les diff&eacute;rents &eacute;l&eacute;ments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela acc&eacute;l&egrave;re l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers &agrave; obtenir.', # NEW
	'spip_cache:nom' => 'SPIP et le cache…',
	'spip_ecran:description' => 'D&eacute;termine la largeur d\'&eacute;cran impos&eacute;e &agrave; tous en partie priv&eacute;e. Un &eacute;cran &eacute;troit pr&eacute;sentera deux colonnes et un &eacute;cran large en pr&eacute;sentera trois. Le r&eacute;glage par d&eacute;faut laisse l\'utilisateur choisir, son choix &eacute;tant stock&eacute; dans un cookie.[[%spip_ecran%]]',
	'spip_ecran:nom' => 'Largeur d\'&eacute;cran',
	'stat_auteurs' => 'Les auteurs en stat',
	'statuts_spip' => 'Uniquement les statuts SPIP suivants :',
	'statuts_tous' => 'Tous les statuts',
	'suivi_forums:description' => 'Un auteur d\'article est toujours inform&eacute; lorsqu\'un message est publi&eacute; dans le forum public associ&eacute;. Mais il est aussi possible d\'avertir en plus : tous les participants au forum ou seulement les auteurs de messages en amont.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Suivi des forums publics',
	'supprimer_cadre' => 'Supprimer ce cadre',
	'supprimer_numero:description' => 'Applique la fonction SPIP supprimer_numero() &agrave; l\'ensemble des {{titres}}, des {{noms}} et des {{types}} (de mots-cl&eacute;s) du site public, sans que le filtre supprimer_numero soit pr&eacute;sent dans les squelettes.<br />Voici la syntaxe &agrave; utiliser dans le cadre d\'un site multilingue : <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Supprime le num&eacute;ro',

	// T
	'titre' => 'Le Couteau Suisse',
	'titre_parent:description' => 'Au sein d\'une boucle, il est courant de vouloir afficher le titre du parent de l\'objet en cours. Traditionnellement, il suffirait d\'utiliser une seconde boucle, mais cette nouvelle balise #TITRE_PARENT all&eacute;gera l\'&eacute;criture de tes squelettes. Le r&eacute;sultat renvoy&eacute; est : le titre du groupe d\'un mot-cl&eacute; ou celui de la rubrique parente (si elle existe) de tout autre objet (article, rubrique, br&egrave;ve, etc.).

Note : Pour les mots-cl&eacute;s, un alias de #TITRE_PARENT est #TITRE_GROUPE. Le traitement SPIP de ces nouvelles balises est similaire &agrave; celui de #TITRE.

@puce@ Si tu es sous SPIP 2.0, alors tu as  ici &agrave; ta disposition tout un ensemble de balises #TITRE_XXX qui pourront te donner le titre de l\'objet \'xxx\', &agrave; condition que le champ \'id_xxx\' soit pr&eacute;sent dans la table en cours (#ID_XXX utilisable dans la boucle en cours).

Par exemple, dans une boucle sur (ARTICLES), #TITRE_SECTEUR donnera le titre du secteur dans lequel est plac&eacute; l\'article en cours, puisque l\'identifiant #ID_SECTEUR (ou le champ \'id_secteur\') est disponible dans ce cas.

La syntaxe <html>#TITRE_XXX{yy}</html> est &eacute;galement support&eacute;e. Exemple : <html>#TITRE_ARTICLE{10}</html> renverra le titre de l\'article #10.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Balises #TITRE_PARENT/OBJET',
	'titre_tests' => 'Le Couteau Suisse - Page de tests…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>&laquo; {{{Mon intertitre}}} &raquo;</html> en image typographique param&eacute;trable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # MODIF
	'titres_typo:nom' => 'Intertitres en image',
	'tous' => 'Tous',
	'toutes_couleurs' => 'Les 36 couleurs des styles css :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Blocs multilingues&nbsp;: <b><:trad:></b>',
	'toutmulti:description' => '&Agrave; l\'instar de ce tu peux d&eacute;j&agrave; faire dans tes squelettes, cet outil te permet d\'utiliser librement les cha&icirc;nes de langues (de SPIP ou de tes squelettes) dans tous les contenus de ton site (articles, titres, messages, etc.) &agrave; l\'aide du raccourci <code><:chaine:></code>.
 
Consulte [ici ->http://www.spip.net/fr_article2128.html] la documentation de SPIP &agrave; ce sujet.

Cet outil accepte &eacute;galement les arguments introduits par SPIP 2.0. Par exemple, le raccourci <code><:ma_chaine{nom=Charles Martin, age=37}:></code> permet de passer deux param&egrave;tres &agrave; la cha&icirc;ne suivante : <code>\'ma_chaine\'=>"Bonjour, je suis @nom@ et j\'ai @age@ ans\\"</code>.

La fonction SPIP utilis&eacute;e en PHP est <code>_T(\'chaine\')</code> sans argument, et  <code>_T(\'chaine\', array(\'arg1\'=>\'un texte\', \'arg2\'=>\'un autre texte\'))</code> avec arguments.

 N\'oublie donc pas de v&eacute;rifier que la clef <code>\'chaine\'</code> est bien d&eacute;finie dans les fichiers de langues.', # MODIF
	'toutmulti:nom' => 'Blocs multilingues',
	'travaux_masquer_avert' => 'Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours',
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Ce site sera r&eacute;tabli tr&egrave;s prochainement.
_ Merci de votre compr&eacute;hension.', # MODIF
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Pour personnaliser la navigation en partie priv&eacute;e et lorsque SPIP le permet, choisissez ici le tri &agrave; utiliser pour afficher certains types objets.

Les propositions ci-dessous sont bas&eacute;es sur la fonctionnalit&eacute; SQL \'ORDER BY\' : n\'utilise le tri personnalis&eacute; que si tu sais ce que tu fais (champs disponibles par exemple pour les articles : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})

@puce@ {{Ordre des articles &agrave; l\'int&eacute;rieur des rubriques}} [[%tri_articles%]][[->%tri_perso%]]

@puce@ {{Ordre des groupes dans le formulaire d\'ajout de mots-cl&eacute;s}} [[%tri_groupes%]][[->%tri_perso_groupes%]]', # MODIF
	'tri_articles:nom' => 'Les tris de SPIP',
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)',
	'tri_modif' => 'Tri sur la date de modification (ORDER BY date_modif DESC)',
	'tri_perso' => 'Tri SQL personnalis&eacute;, ORDER BY suivi de :',
	'tri_publi' => 'Tri sur la date de publication (ORDER BY date DESC)',
	'tri_titre' => 'Tri sur le titre (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Outil en cours de d&eacute;veloppement. Vous offre quelques balises tr&egrave;s simples et bien pratiques pour am&eacute;liorer la lisibilit&eacute; de tes squelettes.

@puce@ {{#BOLO}} : g&eacute;n&egrave;re un faux texte d\'environ 3000 caract&egrave;res ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction sp&eacute;cifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ Un mod&egrave;le est &eacute;galement disponible pour vos contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caract&egrave;res de faux texte.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction sp&eacute;cifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalisez l\'affichage gr&acirc;ce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

@puce@ {{#CHR<html>{XX}</html>}} : balise &eacute;quivalente &agrave; <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caract&egrave;res sp&eacute;ciaux (le retour &agrave; la ligne par exemple) ou des caract&egrave;res r&eacute;serv&eacute;s par le compilateur de SPIP (les crochets ou les accolades).

@puce@ {{#LESMOTS}} : ', # MODIF
	'trousse_balises:nom' => 'Trousse &agrave; balises',
	'type_urls:description' => '@puce@ SPIP offre un choix sur plusieurs jeux d\'URLs pour fabriquer les liens d\'acc&egrave;s aux pages de votre site.

Plus d\'infos : [->http://www.spip.net/fr_article765.html]. L\'outil &laquo;&nbsp;[.->boites_privees]&nbsp;&raquo; te permet de voir sur la page de chaque objet SPIP l\'URL propre associ&eacute;e.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@pour utiliser les formats {html}, {propres}, {propres2}, {libres} ou {arborescentes}, recopiez le fichier "htaccess.txt" du r&eacute;pertoire de base du site SPIP sous le sous le nom ".htaccess" (attention &agrave; ne pas &eacute;craser d\'autres r&eacute;glages que tu pourrais avoir mis dans ce fichier) ; si ton site est en "sous-r&eacute;pertoire", ti devras aussi &eacute;diter la ligne "RewriteBase" ce fichier. Les URLs d&eacute;finies seront alors redirig&eacute;es vers les fichiers de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs &laquo;page&raquo;}} : ce sont les liens par d&eacute;faut, utilis&eacute;s par SPIP depuis sa version 1.9x.
_ Exemple : <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs &laquo;html&raquo;}} : les liens ont la forme des pages html classiques.
_ Exemple : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs &laquo;propres&raquo;}} : les liens sont calcul&eacute;s gr&acirc;ce au titre des objets demand&eacute;s. Des marqueurs (_, -, +, @, etc.) encadrent les titres en fonction du type d\'objet.
_ Exemples : <code>/Mon-titre-d-article</code> ou <code>/-Ma-rubrique-</code> ou <code>/@Mon-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]][[%url_max_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs &laquo;propres2&raquo;}} : l\'extension \'.html\' est ajout&eacute;e aux liens {&laquo;propres&raquo;}.
_ Exemple : <code>/Mon-titre-d-article.html</code> ou <code>/-Ma-rubrique-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]][[%url_max_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs &laquo;libres&raquo;}} : les liens sont {&laquo;propres&raquo;}, mais sans marqueurs dissociant les objets (_, -, +, @, etc.).
_ Exemple : <code>/Mon-titre-d-article</code> ou <code>/Ma-rubrique</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]][[%url_max_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs &laquo;arborescentes&raquo;}} : les liens sont {&laquo;propres&raquo;}, mais de type arborescent.
_ Exemple : <code>/secteur/rubrique1/rubrique2/Mon-titre-d-article</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]][[%url_max_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs &laquo;propres-qs&raquo;}} : ce syst&egrave;me fonctionne en "Query-String", c\'est-&agrave;-dire sans utilisation de .htaccess ; les liens sont {&laquo;propres&raquo;}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres_qs">@puce@ {{URLs &laquo;propres_qs&raquo;}} : ce syst&egrave;me fonctionne en "Query-String", c\'est-&agrave;-dire sans utilisation de .htaccess ; les liens sont {&laquo;propres&raquo;}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs &laquo;standard&raquo;}} : ces liens d&eacute;sormais obsol&egrave;tes &eacute;taient utilis&eacute;s par SPIP jusqu\'&agrave; sa version 1.8.
_ Exemple : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Si tu utilises le format {page} ci-dessus ou si l\'objet demand&eacute; n\'est pas reconnu, alors il t\'est possible de choisir {{le script d\'appel}} &agrave; SPIP. Par d&eacute;faut, SPIP choisit {spip.php}, mais {index.php} (exemple de format : <code>/index.php?article123</code>) ou une valeur vide (format : <code>/?article123</code>) fonctionnent aussi. Pour tout autre valeur, il te faut absolument cr&eacute;er le fichier correspondant dans la racine de SPIP, &agrave; l\'image de celui qui existe d&eacute;j&agrave; : {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ Si tu utilises un format &agrave; base d\'URLs &laquo;propres&raquo;  ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), le Couteau Suisse peut :
<q1>• S\'assurer que l\'URL produite soit totalement {{en minuscules}}.</q1>[[%urls_minuscules%]]
<q1>• Provoquer l\'ajout syst&eacute;matique de {{l\'id de l\'objet}} &agrave; son URL (en suffixe, en pr&eacute;fixe, etc.).
_ (exemples : <code>/Mon-titre-d-article,457</code> ou <code>/457-Mon-titre-d-article</code>)</q1>', # MODIF
	'type_urls:nom' => 'Format des URLs',
	'typo_exposants:description' => '{{Textes fran&ccedil;ais}} : am&eacute;liore le rendu typographique des abr&eacute;viations courantes, en mettant en exposant les &eacute;l&eacute;ments n&eacute;cessaires (ainsi, {<acronym>Mme</acronym>} devient {M<sup>me</sup>}) et en corrigeant les erreurs courantes ({<acronym>2&egrave;me</acronym>} ou  {<acronym>2me</acronym>}, par exemple, deviennent {2<sup>e</sup>}, seule abr&eacute;viation correcte).

Les abr&eacute;viations obtenues sont conformes &agrave; celles de l\'Imprimerie nationale telles qu\'indiqu&eacute;es dans le {Lexique des r&egrave;gles typographiques en usage &agrave; l\'Imprimerie nationale} (article &laquo;&nbsp;Abr&eacute;viations&nbsp;&raquo;, presses de l\'Imprimerie nationale, Paris, 2002).

Sont aussi trait&eacute;es les expressions suivantes : <html>Dr, Pr, Mgr, m2, m3, Mn, Md, St&eacute;, &Eacute;ts, Vve, Cie, 1o, 2o, etc.</html> 

Choisis ici de mettre en exposant certains raccourcis suppl&eacute;mentaires, malgr&eacute; un avis d&eacute;favorable de l\'Imprimerie nationale :[[%expo_bofbof%]]

{{Textes anglais}} : mise en exposant des nombres ordinaux : <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Exposants typographiques',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'page',
	'url_propres' => 'propres@_CS_ASTER@',
	'url_propres-qs' => 'propres-qs',
	'url_propres2' => 'propres2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'standard',
	'urls_3_chiffres' => 'Imposer un minimum de 3 chiffres',
	'urls_avec_id' => 'Le placer en suffixe',
	'urls_avec_id2' => 'Le placer en pr&eacute;fixe',
	'urls_base_total' => 'Il y a actuellement @nb@ URL(s) en base',
	'urls_base_vide' => 'La base des URLs est vide',
	'urls_choix_objet' => '&Eacute;dition en base de l\'URL d\'un objet sp&eacute;cifique&nbsp;:',
	'urls_edit_erreur' => 'Le format actuel des URLs (&laquo;&nbsp;@type@&nbsp;&raquo;) ne permet pas d\'&eacute;dition.',
	'urls_enregistrer' => 'Enregistrer cette URL en base',
	'urls_id_sauf_rubriques' => 'Exclure les objets suivants (s&eacute;par&eacute;s par &laquo;&nbsp;:&nbsp;&raquo;) :',
	'urls_minuscules' => 'Lettres minuscules',
	'urls_nouvelle' => '&Eacute;diter l\'URL &laquo;&nbsp;propres&nbsp;&raquo;&nbsp;:',
	'urls_num_objet' => 'Num&eacute;ro&nbsp;:',
	'urls_purger' => 'Tout vider',
	'urls_purger_tables' => 'Vider les tables s&eacute;lectionn&eacute;es',
	'urls_purger_tout' => 'R&eacute;initialiser les URLs stock&eacute;es dans la base&nbsp;:',
	'urls_rechercher' => 'Rechercher cet objet en base',
	'urls_titre_objet' => 'Titre enregistr&eacute;&nbsp;:',
	'urls_type_objet' => 'Objet&nbsp;:',
	'urls_url_calculee' => 'URL publique &laquo;&nbsp;@type@&nbsp;&raquo;&nbsp;:',
	'urls_url_objet' => 'URL &laquo;&nbsp;propres&nbsp;&raquo; enregistr&eacute;e&nbsp;:',
	'urls_valeur_vide' => '(Une valeur vide entra&icirc;ne le recalcul de l\'URL)',

	// V
	'validez_page' => 'Pour acc&eacute;der aux modifications :',
	'variable_vide' => '(Vide)',
	'vars_modifiees' => 'Les donn&eacute;es ont bien &eacute;t&eacute; modifi&eacute;es',
	'version_a_jour' => 'Ta version est &agrave; jour.',
	'version_distante' => 'Version distante...',
	'version_distante_off' => 'V&eacute;rification distante d&eacute;sactiv&eacute;e',
	'version_nouvelle' => 'Nouvelle version : @version@',
	'version_revision' => 'R&eacute;vision : @revision@',
	'version_update' => 'Mise &agrave; jour automatique',
	'version_update_chargeur' => 'T&eacute;l&eacute;chargement automatique',
	'version_update_chargeur_title' => 'T&eacute;l&eacute;charge la derni&egrave;re version du plugin gr&acirc;ce au plugin &laquo;T&eacute;l&eacute;chargeur&raquo;',
	'version_update_title' => 'T&eacute;l&eacute;charge la derni&egrave;re version du plugin et lance sa mise &agrave; jour automatique',
	'verstexte:description' => '2 filtres pour tes squelettes, permettant de produire des pages plus l&eacute;g&egrave;res.
_ version_texte : extrait le contenu texte d\'une page html &agrave; l\'exclusion de quelques balises &eacute;l&eacute;mentaires.
_ version_plein_texte : extrait le contenu texte d\'une page html pour rendre du texte brut.', # MODIF
	'verstexte:nom' => 'Version texte',
	'visiteurs_connectes:description' => 'Offre une noisette pour ton squelette qui affiche le nombre de visiteurs connect&eacute;s sur le site public.

Ajoute simplement <code><INCLURE{fond=fonds/visiteurs_connectes}></code> dans tes pages.', # MODIF
	'visiteurs_connectes:nom' => 'Visiteurs connect&eacute;s',
	'voir' => 'Voir : @voir@',
	'votre_choix' => 'Ton choix :',

	// W
	'webmestres:description' => 'Un {{webmestre}} au sens SPIP est un {{administrateur}} ayant acc&egrave;s &agrave; l\'espace FTP. Par d&eacute;faut et &agrave; partir de SPIP 2.0, il est l&#8217;administrateur <code>id_auteur=1</code> du site. Les webmestres ici d&eacute;finis ont le privil&egrave;ge de ne plus &ecirc;tre oblig&eacute;s de passer par FTP pour valider les op&eacute;rations sensibles du site, comme la mise &agrave; jour de la base de donn&eacute;es ou la restauration d&#8217;un dump.

Webmestre(s) actuel(s) : {@_CS_LISTE_WEBMESTRES@}.
_ Administrateur(s) &eacute;ligible(s) : {@_CS_LISTE_ADMINS@}.

En tant que webmestre toi-m&ecirc;me, tu as ici les droits de modifier cette liste d\'ids -- s&eacute;par&eacute;s par les deux points &laquo;&nbsp;:&nbsp;&raquo; s\'ils sont plusieurs. Exemple : &laquo;1:5:6&raquo;.[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Liste des webmestres',

	// X
	'xml:description' => 'Active le validateur xml pour l\'espace public tel qu\'il est d&eacute;crit dans la [documentation->http://www.spip.net/fr_article3541.html]. Un bouton intitul&eacute; &laquo;&nbsp;Analyse XML&nbsp;&raquo; est ajout&eacute; aux autres boutons d\'administration.',
	'xml:nom' => 'Validateur XML'
);

?>
