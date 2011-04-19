<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ' : non',
	'2pts_oui' => ' : oui',

	// S
	'SPIP_liens:description' => '@puce@ Tous les liens du site s\'ouvrent par défaut dans la fenêtre de navigation en cours. Mais il peut être utile d\'ouvrir les liens externes au site dans une nouvelle fenêtre extérieure -- cela revient à ajouter {target=\\"_blank\\"} à toutes les balises &lt;a&gt; dotées par SPIP des classes {spip_out}, {spip_url} ou {spip_glossaire}. Il est parfois nécessaire d\'ajouter l\'une de ces classes aux liens du squelette du site (fichiers html) afin d\'étendre au maximum cette fonctionnalité.[[%radio_target_blank3%]]

@puce@ SPIP permet de relier des mots à leur définition grâce au raccourci typographique <code>[?mot]</code>. Par défaut (ou si tu laisses vide la case ci-dessous), le glossaire externe renvoie vers l’encyclopédie libre wikipedia.org. À toi de choisir l\'adresse à utiliser. <br />Lien de test : [?SPIP][[%url_glossaire_externe2%]]',
	'SPIP_liens:description1' => '@puce@ SPIP a prévu un style CSS pour les liens «~mailto:~» : une petite enveloppe devrait apparaître devant chaque lien lié à un courriel; mais puisque tous les navigateurs ne peuvent pas l\'afficher (notamment IE6, IE7 et SAF3), à toi de voir s\'il faut conserver cet ajout.
_ Lien de test : [->test@test.com] (recharge la page entièrement).[[%enveloppe_mails%]]',
	'SPIP_liens:nom' => 'SPIP et les liens… externes',
	'SPIP_tailles:description' => '@puce@ Afin d\'alléger la mémoire de votre serveur, SPIP te permet de limiter les dimensions (hauteur et largeur) et la taille du fichier des images, logos ou documents joints aux divers contenus de ton site. Si un fichier dépasse la taille indiquée, le formulaire enverra bien les données mais elles seront détruites et SPIP n\'en tiendra pas compte, ni dans le répertoire IMG/, ni en base de données. Un message d\'avertissement sera alors envoyé à l\'utilisateur.

Une valeur nulle ou non renseignée correspond à une valeur illimitée.
[[Hauteur : %img_Hmax% pixels]][[->Largeur : %img_Wmax% pixels]][[->Poids du fichier : %img_Smax% Ko]]
[[Hauteur : %logo_Hmax% pixels]][[->Largeur : %logo_Wmax% pixels]][[->Poids du fichier : %logo_Smax% Ko]]
[[Poids du fichier : %doc_Smax% Ko]]

@puce@ Définis ici l\'espace maximal réservé aux fichiers distants que SPIP pourrait télécharger (de serveur à serveur) et stocker sur ton site. La valeur par défaut est ici de 16 Mo.[[%copie_Smax% Mo]]

@puce@ Afin d\'éviter un dépassement de mémoire PHP dans le traitement des grandes images par la librairie GD2, SPIP teste les capacités du serveur et peut donc refuser de traiter les trop grandes images. Il est possible de désactiver ce test en définissant manuellement le nombre maximal de pixels supportés pour les calculs.

La valeur de 1~000~000 pixels semble correcte pour une configuration avec peu de mémoire. Une valeur nulle ou non renseignée entraînera le test du serveur.
[[%img_GDmax% pixels au maximum]]

@puce@ La librairie GD2 permet d\'ajuster la qualité de compression des images JPG. Un pourcentage élevé correspond à une qualité élevée.
[[%img_GDqual% %]]',
	'SPIP_tailles:nom' => 'Limites mémoire',

	// A
	'acces_admin' => 'Accès administrateurs :',
	'action_rapide' => 'Action rapide, uniquement si tu sais ce que tu fais !',
	'action_rapide_non' => 'Action rapide, disponible une fois cet outil activé :',
	'admins_seuls' => 'Les administrateurs seulement',
	'attente' => 'Attente...',
	'auteur_forum:description' => 'Incite tous les auteurs de messages publics à fournir (d\'au moins d\'une lettre !) un nom et/ou un courriel afin d\'éviter les contributions totalement anonymes. Note que cet outil procède à une vérification JavaScript sur le poste du visiteur.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Attention : Choisir la troisième option annule les 2 premières. Il est important de vérifier que les formulaires de ton squelette sont bien compatibles avec cet outil.}',
	'auteur_forum:nom' => 'Pas de forums anonymes',
	'auteur_forum_deux' => 'Ou, au moins l\'un des deux champs précédents',
	'auteur_forum_email' => 'Le champ «@_CS_FORUM_EMAIL@»',
	'auteur_forum_nom' => 'Le champ «@_CS_FORUM_NOM@»',
	'auteurs:description' => 'Cet outil configure l\'apparence de [la page des auteurs->./?exec=auteurs], en partie privée.

@puce@ Définis ici le nombre maximal d\'auteurs à afficher sur le cadre central de la page des auteurs. Au-delà, une pagination est mise en place.[[%max_auteurs_page%]]

@puce@ Quels statuts d\'auteurs peuvent être listés sur cette page ?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]',
	'auteurs:nom' => 'Page des auteurs',
	'autobr:description' => 'Applique sur certains contenus SPIP le filtre {|post_autobr} qui remplace tous les sauts de ligne simples par un saut de ligne HTML <br />.[[%alinea%]][[->%alinea2%]]',
	'autobr:nom' => 'Retours de ligne automatiques',
	'autobr_non' => 'À l\'intérieur des balises &lt;alinea>&lt;/alinea>',
	'autobr_oui' => 'Articles et messages publics (balises @BALISES@)',
	'autobr_racc' => 'Retours de ligne : <b><alinea></alinea></b>',

	// B
	'balise_set:description' => 'Afin d\'alléger les écritures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil t\'offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqué à une variable passe donc dans le nom de la balise.

Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.',
	'balise_set:nom' => 'Balise #SET étendue',
	'barres_typo_edition' => 'Edition des contenus',
	'barres_typo_forum' => 'Messages de Forum',
	'barres_typo_intro' => 'Le plugin «Porte-Plume» a été détecté. Choisi ici les barres typographiques où certains boutons seront insérés.',
	'basique' => 'Basique',
	'blocs:aide' => 'Blocs Dépliables : <b>&lt;bloc&gt;&lt;/bloc&gt;</b> (alias : <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) et <b>&lt;visible&gt;&lt;/visible&gt;</b>',
	'blocs:description' => 'Te permet  de créer des blocs dont le titre cliquable peut les rendre visibles ou invisibles.

@puce@ {{Dans les textes SPIP}} : les rédacteurs ont à disposition les  nouvelles balises &lt;bloc&gt; (ou &lt;invisible&gt;) et &lt;visible&gt; à utiliser dans leurs textes comme ceci : 

<quote><code>
<bloc>
 Un titre qui deviendra cliquable

 Le texte a` cacher/montrer, apre`s deux sauts de ligne...
 </bloc>
</code></quote>

@puce@ {{Dans les squelettes}} : tu as à ta disposition les  nouvelles balises #BLOC_TITRE, #BLOC_DEBUT et #BLOC_FIN à utiliser comme ceci : 

<quote><code> #BLOC_TITRE ou #BLOC_TITRE{mon_URL}
 Mon titre
 #BLOC_RESUME    (facultatif)
 une version re\'sume\'e du bloc suivant
 #BLOC_DEBUT
 Mon bloc de\'pliable (qui contiendra l\'URL pointe\'e si ne\'ce\'ssaire)
 #BLOC_FIN</code></quote>

@puce@ En cochant «oui» ci-dessous, l\'ouverture d\'un bloc provoquera la fermeture de tous les autres blocs de la page, afin d\'en avoir qu\'un seul ouvert à la fois.[[%bloc_unique%]]

@puce@ En cochant «oui» ci-dessous, l\'état des blocs numérotés sera stocké dans un cookie le temps de la session, afin de conserver l\'aspect de la page en cas de retour.[[%blocs_cookie%]]

@puce@ Le Couteau Suisse utilise par défaut la balise HTML &lt;h4&gt; pour le titre des blocs dépliables. Choisis ici une autre balise &lt;hN&gt; :[[%bloc_h4%]]

@puce@ Afin d\'obtenir un effet plus doux au moment du clic, tes blocs dépliables peuvent s\'animer à la manière d\'un \\"glissement\\".[[%blocs_slide%]][[->%blocs_millisec% millisecondes]]',
	'blocs:nom' => 'Blocs Dépliables',
	'boites_privees:description' => 'Toutes les boîtes décrites ci-dessous apparaissent ici ou là dans la partie privée.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Les révisions du Couteau Suisse}} : un cadre sur la présente page de configuration, indiquant les dernières modifications apportées au code du plugin ([Source->@_CS_RSS_SOURCE@]).
- {{Les articles au format SPIP}} : un cadre dépliable pour tes articles permettant de connaître le code source utilisé par leurs auteurs.
- {{Les auteurs en stat}} : un cadre dépliable sur [la page des auteurs->./?exec=auteurs] indiquant les 10 derniers connectés et les inscriptions non confirmées. Seuls les administrateurs voient ces informations.
- {{Les webmestres SPIP}} : un cadre dépliable sur [la page des auteurs->./?exec=auteurs] indiquant les administrateurs élevés au rang de webmestre SPIP. Seuls les administrateurs voient ces informations. Si tu es toi-même webmestre, regarde aussi l\'outil « [.->webmestres] ».
- {{Les URLs propres}} : un cadre dépliable pour chaque objet de contenu (article, rubrique, auteur, ...) indiquant l\'URL propre associée ainsi que leurs alias éventuels. L\'outil « [.->type_urls] » te permet une configuration fine des URLs de ton site.
- {{Les tris d\'auteurs}} : un cadre dépliable pour les articles contenant plus d\'un auteur et permettant simplement d\'en ajuster l\'ordre d\'affichage.',
	'boites_privees:nom' => 'Boîtes privées',
	'bp_tri_auteurs' => 'Les tris d\'auteurs',
	'bp_urls_propres' => 'Les URLs propres',
	'brouteur:description' => '@puce@ {{S&eacute;lecteur de rubrique (brouteur)}}. Utilise le s&eacute;lecteur de rubrique en AJAX &agrave; partir de %rubrique_brouteur% rubrique(s).

@puce@ {{S&eacute;lection de mots-clefs}}. Utilise un champ de recherche au lieu d\'une liste de s&eacute;lection &agrave; partir de %select_mots_clefs% mot(s)-clef(s).

@puce@ {{S&eacute;lection d\'auteurs}}. L\'ajout d\'un auteur se fait par mini-navigateur dans la fourchette suivante :
<q1>• Une liste de s&eacute;lection pour moins de %select_min_auteurs% auteurs(s).
_ • Un champ de recherche &agrave; partir de %select_max_auteurs% auteurs(s).</q1>',
	'brouteur:nom' => 'Réglage des sélecteurs',

	// C
	'cache_controle' => 'Contrôle du cache',
	'cache_nornal' => 'Usage normal',
	'cache_permanent' => 'Cache permanent',
	'cache_sans' => 'Pas de cache',
	'categ:admin' => '1. Administration',
	'categ:divers' => '60. Divers',
	'categ:interface' => '10. Interface privée',
	'categ:public' => '40. Affichage public',
	'categ:securite' => '5. Sécurité',
	'categ:spip' => '50. Balises, filtres, critères',
	'categ:typo-corr' => '20. Améliorations des textes',
	'categ:typo-racc' => '30. Raccourcis typographiques',
	'certaines_couleurs' => 'Seules les balises définies ci-dessous@_CS_ASTER@ :',
	'chatons:aide' => 'Chatons : @liste@',
	'chatons:description' => 'Insère des images (ou chatons pour les {tchats}) dans tous les textes où apparaît une chaîne du genre {{<code>:nom</code>}}.
_ Cet outil remplace ces raccourcis par les images du même nom qu\'il trouve dans ton dossier <code>mon_squelette_toto/img/chatons/</code>, ou par défaut, le dossier <code>couteau_suisse/img/chatons/</code>.',
	'chatons:nom' => 'Chatons',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de ton site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour à la ligne. En effet, les citations courtes doivent être entourées par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.',
	'citations_bb:nom' => 'Citations bien balisées',
	'class_spip:description1' => 'Tu peux ici définir certains raccourcis de SPIP. Une valeur vide équivaut à utiliser la valeur par défaut.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Les raccourcis de SPIP}}.

Tu peux ici définir certains raccourcis de SPIP. Une valeur vide équivaut à utiliser la valeur par défaut.[[%racc_hr%]][[%puce%]]',
	'class_spip:description3' => '

{Attention : si l\'outil « [.->pucesli] » est activé, le remplacement du tiret « - » ne sera plus effectué ; une liste &lt;ul>&lt;li> sera utilisée à la place.}

SPIP utilise habituellement la balise &lt;h3&gt; pour les intertitres. Choisis ici un autre remplacement :[[%racc_h1%]][[->%racc_h2%]]',
	'class_spip:description4' => '

SPIP a choisi d\'utiliser la balise &lt;strong> pour transcrire les gras. Mais &lt;b> aurait pu également convenir, avec ou sans style. À toi de voir :[[%racc_g1%]][[->%racc_g2%]]

SPIP a choisi d\'utiliser la balise &lt;i> pour transcrire les italiques. Mais &lt;em> aurait pu également convenir, avec ou sans style. À toi de voir :[[%racc_i1%]][[->%racc_i2%]]

 Tu peux aussi définir le code ouvrant et fermant pour les appels de notes de bas de pages (Attention ! Les modifications ne seront visibles que sur l\'espace public.) : [[%ouvre_ref%]][[->%ferme_ref%]]

 Tu peux définir le code ouvrant et fermant pour les notes de bas de pages : [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{Les styles de SPIP par défaut}}. Jusqu\'à la version 1.92 de SPIP, les raccourcis typographiques produisaient des balises systématiquement affublés du style \\"spip\\". Par exemple : <code><p class=\\"spip\\"></code>. Tu peux ici définir le style de ces balises en fonction de tes feuilles de style. Une case vide signifie qu\'aucun style particulier ne sera appliqué.

{Attention : si certains raccourcis (ligne horizontale, intertitre, italique, gras) ont été modifiés ci-dessus, alors les styles ci-dessous ne seront pas appliqués.}

<q1>
_ {{1.}} Balises &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]]
_ {{2.}} Balises &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; et les listes (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Note bien : en modifiant ce deuxième style, tu perds alors les styles standards de SPIP associés à ces balises.</q1>',
	'class_spip:nom' => 'SPIP et ses raccourcis…',
	'code_css' => 'CSS',
	'code_fonctions' => 'Fonctions',
	'code_jq' => 'jQuery',
	'code_js' => 'JavaScript',
	'code_options' => 'Options',
	'code_spip_options' => 'Options SPIP',
	'compacte_css' => 'Compacter les CSS',
	'compacte_js' => 'Compacter le Javacript',
	'compacte_prive' => 'Ne rien compacter en partie privée',
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options précédentes)',
	'contrib' => 'Plus d\'infos : @url@',
	'copie_vers' => 'Copie vers : @dir@',
	'corbeille:description' => 'SPIP supprime automatiquement les objets mis au rebuts au bout de 24 heures, en général vers 4 heures du matin, grâce à une tâche «CRON» (lancement périodique et/ou automatique de processus préprogrammés). Tu peux ici empêcher ce processus afin de mieux gérer ta corbeille.[[%arret_optimisation%]]',
	'corbeille:nom' => 'La corbeille',
	'corbeille_objets' => '@nb@ objet(s) dans la corbeille.',
	'corbeille_objets_lies' => '@nb_lies@ liaison(s) detectée(s).',
	'corbeille_objets_vide' => 'Aucun objet dans la corbeille.',
	'corbeille_objets_vider' => 'Supprimer les objets sélectionnés',
	'corbeille_vider' => 'Vider la corbeille :',
	'couleurs:aide' => 'Mise en couleurs : <b>[coul]texte[/coul]</b>@fond@ avec <b>coul</b> = @liste@',
	'couleurs:description' => 'Permet d\'appliquer facilement des couleurs &agrave; tous les textes du site (articles, br&egrave;ves, titres, forum, …) en utilisant des balises &agrave; crochets en raccourcis : <code>[couleur]texte[/couleur]</code>.

Deux exemples identiques pour changer la couleur du texte :@_CS_EXEMPLE_COULEURS2@

Idem pour changer le fond, si l\'option ci-dessous le permet :@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@Le format de ces balises personnalis&eacute;es doit lister des couleurs existantes ou d&eacute;finir des couples &laquo;balise=couleur&raquo;, le tout s&eacute;par&eacute; par des virgules. Exemples : &laquo;gris, rouge&raquo;, &laquo;faible=jaune, fort=rouge&raquo;, &laquo;bas=#99CC11, haut=brown&raquo; ou encore &laquo;gris=#DDDDCC, rouge=#EE3300&raquo;. Pour le premier et le dernier exemple, les balises autoris&eacute;es sont : <code>[gris]</code> et <code>[rouge]</code> (<code>[fond gris]</code> et <code>[fond rouge]</code> si les fonds sont permis).',
	'couleurs:nom' => 'Tout en couleurs',
	'couleurs_fonds' => ', <b>[fond coul]texte[/coul]</b>, <b>[bg coul]texte[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Obtiens de nombreux renseignements à propos du fonctionnement du Couteau Suisse dans les fichiers {spip.log} que l\'on peut trouver dans le répertoire : {<html>@_CS_DIR_TMP@</html>}[[%log_couteau_suisse%]]

@puce@ {{Options SPIP.}} SPIP ordonne les plugins dans un ordre spécifique. Afin d\'être sûr que le Couteau Suisse soit en tête et gère en amont certaines options de SPIP, alors coche l\'option suivante. Si les droits de ton serveur le permettent, le fichier {<html>@_CS_FILE_OPTIONS@</html>} sera automatiquement modifié pour inclure le fichier {<html>@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php</html>}.

[[%spip_options_on%]]@_CS_FILE_OPTIONS_ERR@

@puce@ {{Requêtes externes.}} D\'une part, le Couteau Suisse vérifie régulièrement l\'existence d\'une version plus récente de son code et informe sur sa page de configuration d\'une mise à jour éventuellement disponible. D\'autre part, ce plugin comporte certains outils qui peuvent nécessiter d\'importer des librairies distantes.

Si les requêtes externes de ton serveur posent des problèmes ou par souci d\'une meilleure sécurité, coche les cases suivantes.[[%distant_off%]][[->%distant_outils_off%]]',
	'cs_comportement:nom' => 'Comportements du Couteau Suisse',
	'cs_distant_off' => 'Les vérifications de versions distantes',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants',
	'cs_log_couteau_suisse' => 'Les logs détaillés du Couteau Suisse',
	'cs_reset' => 'Es-tu sûr de vouloir réinitialiser totalement le Couteau Suisse ?',
	'cs_reset2' => 'Tous les outils actuellement actifs seront désactivés et leurs paramètres réinitialisés.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher «<html>@_CS_FILE_OPTIONS@</html>» a échoué !',
	'cs_spip_options_on' => 'Les options SPIP dans «<html>@_CS_FILE_OPTIONS@</html>@»',

	// D
	'decoration:aide' => 'Décoration : <b>&lt;balise&gt;test&lt;/balise&gt;</b>, avec <b>balise</b> = @liste@',
	'decoration:description' => 'De nouveaux styles paramétrables dans tes textes et accessibles grâce à des balises à chevrons. Exemple : 
&lt;mabalise&gt;texte&lt;/mabalise&gt; ou : &lt;mabalise/&gt;.<br />Définis ci-dessous les styles CSS dont tu as besoin, une balise par ligne, selon les syntaxes suivantes :
- {type.mabalise = mon style CSS}
- {type.mabalise.class = ma classe CSS}
- {type.mabalise.lang = ma langue (ex : fr)}
- {unalias = mabalise}

Le paramètre {type} ci-dessus peut prendre trois valeurs :
- {span} : balise à l\'intérieur d\'un paragraphe (type Inline)
- {div} : balise créant un nouveau paragraphe (type Block)
- {auto} : balise déterminée automatiquement par le plugin

[[%decoration_styles%]]',
	'decoration:nom' => 'Décoration',
	'decoupe:aide' => 'Bloc d\'onglets : <b>&lt;onglets>&lt;/onglets></b><br />Séparateur de pages ou d\'onglets : @sep@',
	'decoupe:aide2' => 'Alias : @sep@',
	'decoupe:description' => '@puce@ Découpe l\'affichage public d\'un article en plusieurs pages grâce à une pagination automatique. Place simplement dans votre article quatre signes plus consécutifs (<code>++++</code>) à l\'endroit qui doit recevoir la coupure.

Par défaut, le Couteau Suisse insère la pagination en tête et en pied d\'article automatiquement. Mais tu as la possibilité de placer cette pagination ailleurs dans ton squelette grâce à une balise #CS_DECOUPE que tu peux activer ici :
[[%balise_decoupe%]]

@puce@ Si tu utilises ce séparateur à l\'intérieur des balises &lt;onglets&gt; et &lt;/onglets&gt; alors tu obtiendras un jeu d\'onglets.

Dans les squelettes : tu as à ta disposition les nouvelles balises #ONGLETS_DEBUT, #ONGLETS_TITRE et #ONGLETS_FIN.

Cet outil peut être couplé avec « [.->sommaire] ».',
	'decoupe:nom' => 'Découpe en pages et onglets',
	'desactiver_flash:description' => 'Supprime les objets flash des pages de ton site et les remplace par le contenu alternatif associé.',
	'desactiver_flash:nom' => 'Désactive les objets flash',
	'detail_balise_etoilee' => '{{Attention}} : Vérifie bien l\'utilisation faite par tes squelettes des balises étoilées. Les traitements de cet outil ne s\'appliqueront pas sur : @bal@.',
	'detail_disabled' => 'Paramètres non modifiables :',
	'detail_fichiers' => 'Fichiers :',
	'detail_fichiers_distant' => 'Fichiers distants :',
	'detail_inline' => 'Code inline :',
	'detail_jquery2' => 'Cet outil nécessite la librairie {jQuery}.',
	'detail_jquery3' => '{{Attention}} : cet outil nécessite le plugin [jQuery pour SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] pour fonctionner correctement avec cette version de SPIP.',
	'detail_pipelines' => 'Pipelines :',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.',
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, place les options SPIP en amont grâce à l\'outil «@lien@».',
	'detail_spip_options2' => 'Il est recommandé de placer les options SPIP en amont grâce à l\'outil «[.->cs_comportement]».',
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont grâce à l\'outil «@lien@».',
	'detail_surcharge' => 'Outil surchargé :',
	'detail_traitements' => 'Traitements :',
	'devdebug:description' => '{{Cet outil te permet de voir les erreurs PHP à l\'écran.}}<br />Tu peux choisir le niveau d\'erreurs d\'exécution PHP qui sera affiché si le débogueur est actif, ainsi que l\'espace SPIP sur lequel ces réglages s\'appliqueront.',
	'devdebug:item_e_all' => 'Tous les messages d\'erreur (all)',
	'devdebug:item_e_error' => 'Erreurs graves ou fatales (error)',
	'devdebug:item_e_notice' => 'Notes d\'exécution (notice)',
	'devdebug:item_e_strict' => 'Tous les messages + les conseils PHP (strict)',
	'devdebug:item_e_warning' => 'Avertissements (warning)',
	'devdebug:item_espace_prive' => 'Espace privé',
	'devdebug:item_espace_public' => 'Espace public',
	'devdebug:item_tout' => 'Tout SPIP',
	'devdebug:nom' => 'Débogueur de développement',
	'distant_aide' => 'Cet outil requiert des fichiers distants qui doivent tous être correctement installés en librairie. Avant d\'activer cet outil ou d\'actualiser ce cadre, assure-toi que les fichiers requis sont bien présents sur le serveur distant.',
	'distant_charge' => 'Fichier correctement téléchargé et installé en librairie.',
	'distant_charger' => 'Lancer le téléchargement',
	'distant_echoue' => 'Erreur sur le chargement distant, cet outil risque de ne pas fonctionner !',
	'distant_inactif' => 'Fichier introuvable (outil inactif).',
	'distant_present' => 'Fichier présent en librairie depuis le @date@.',
	'dossier_squelettes:description' => 'Modifie le dossier du squelette utilisé. Par exemple : "squelettes/monsquelette". Tu peux inscrire plusieurs dossiers en les séparant par les deux points <html>« : »</html>. En laissant vide la case qui suit (ou en tapant "dist"), c\'est le squelette original "dist" fourni par SPIP qui sera utilisé.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Dossier du squelette',

	// E
	'ecran_activer' => 'Activer l\'écran de sécurité',
	'ecran_conflit' => 'Attention : le fichier statique «@file@» peut entrer en conflit. Choisis ta méthode de protection !',
	'ecran_conflit2' => 'Note : un fichier statique «@file@» a été détecté et activé. Le Couteau Suisse ne pourra le mettre à jour ou le configurer.',
	'ecran_ko' => 'Ecran inactif !',
	'ecran_maj_ko' => 'La version {{@n@}} de l\'écran de sécurité est disponible. Actualise le fichier distant de cet outil.',
	'ecran_maj_ko2' => 'La version @n@ de l\'écran de sécurité est disponible. Vous pouvez actualiser le fichier distant de l\'outil « [.->ecran_securite] ».', # NEW
	'ecran_maj_ok' => '(semble à jour).',
	'ecran_securite:description' => 'L\'écran de sécurité est un fichier PHP directement téléchargé du site officiel de SPIP, qui protège tes sites en bloquant certaines attaques liées à des trous de sécurité. Ce système permet de réagir très rapidement lorsqu\'un problème est découvert, en colmatant le trou sans pour autant devoir mettre à niveau tout son site ni appliquer un « patch » complexe.

A savoir : l\'écran verrouille certaines variables. Ainsi, par exemple, les  variables nommées <code>id_xxx</code> sont toutes  contrôlées comme étant obligatoirement des valeurs numériques entières, afin d\'éviter toute injection de code SQL via ce genre de variable très courante. Certains plugins ne sont pas compatibles avec toutes les règles de l\'écran, utilisant par exemple <code>&amp;id_x=new</code> pour créer un objet {x}.

Outre la sécurité, cet écran a la capacité réglable de moduler les accès des robots  d\'indexation aux scripts PHP, de manière à leur dire de « revenir plus tard »  lorsque le serveur est saturé.[[ %ecran_actif%]][[->
@puce@ Régler la protection anti-robots quand la charge du serveur (load)  excède la valeur : %ecran_load%
_ {La valeur par défaut est 4. Mettre 0 pour désactiver ce processus.}@_ECRAN_CONFLIT@]]

En cas de mise à jour officielle, actualise le fichier distant associé (cliquez ci-dessus sur [actualiser]) afin de bénéficier de la protection la plus récente.

- Version du fichier local : ',
	'ecran_securite:nom' => 'Ecran de sécurité',
	'effaces' => 'Effacés',
	'en_travaux:description' => 'Pendant une phase de maintenance, permet d\'afficher un message personalisable sur tout le site public, éventuellement la partie privée.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]',
	'en_travaux:nom' => 'Site en travaux',
	'erreur:bt' => '<span style=\\"color:red;\\">Attention :</span> la barre typographique (version @version@) semble ancienne.<br />Le Couteau Suisse est compatible avec une version supérieure ou égale à @mini@.',
	'erreur:description' => 'id manquant dans la définition de l\'outil !',
	'erreur:distant' => 'le serveur distant',
	'erreur:jquery' => '{{Note}} : la librairie {jQuery} semble inactive sur cette page. Consulte [ici->http://www.spip-contrib.net/?article2166] le paragraphe sur les dépendances du plugin ou recharger cette page.',
	'erreur:js' => 'Une erreur JavaScript semble être survenue sur cette page et empêche son bon fonctionnement. Active le JavaScript sur ton navigateur ou désactive certains plugins SPIP de ton site.',
	'erreur:nojs' => 'Le JavaScript est désactivé sur cette page.',
	'erreur:nom' => 'Erreur !',
	'erreur:probleme' => 'Problème sur : @pb@',
	'erreur:traitements' => 'Le Couteau Suisse - Erreur de compilation des traitements : mélange \'typo\' et \'propre\' interdit !',
	'erreur:version' => 'Cet outil est indisponible dans cette version de SPIP.',
	'erreur_groupe' => 'Attention : le groupe «@groupe@» n\'est pas défini !',
	'erreur_mot' => 'Attention : le mot-clé «@mot@» n\'est pas défini !',
	'etendu' => 'Étendu',

	// F
	'f_jQuery:description' => 'Empêche l\'installation de {jQuery} dans la partie publique afin d\'économiser un peu de «temps machine». Cette librairie ([->http://jquery.com/]) apporte de nombreuses commodités dans la programmation de JavaScript et peut être utilisée par certains plugins. SPIP l\'utilise dans sa partie privée.

Attention : certains outils du Couteau Suisse nécessitent les fonctions de {jQuery}. ',
	'f_jQuery:nom' => 'Désactive jQuery',
	'filets_sep:aide' => 'Filets de Séparation : <b>__i__</b> où <b>i</b> est un nombre de <b>0</b> à <b>@max@</b>.<br />Autres filets disponibles : @liste@',
	'filets_sep:description' => 'Ins&egrave;re des filets de s&eacute;paration, personnalisables par des feuilles de style, dans tous les textes de SPIP.
_ La syntaxe est : "__code__", o&ugrave; "code" repr&eacute;sente soit le num&eacute;ro d’identification (de 0 &agrave; 7) du filet &agrave; ins&eacute;rer en relation directe avec les styles correspondants, soit le nom d\'une image plac&eacute;e dans le dossier plugins/couteau_suisse/img/filets.',
	'filets_sep:nom' => 'Filets de Séparation',
	'filtrer_javascript:description' => 'Pour gérer l\'insertion de JavaScript dans les articles, trois modes sont disponibles :
- <i>jamais</i> : le JavaScript est refusé partout
- <i>défaut</i> : le JavaScript est signalé en rouge dans l\'espace privé
- <i>toujours</i> : le JavaScript est accepté partout.

Attention : dans les forums, pétitions, flux syndiqués, etc., la gestion du JavaScript est <b>toujours</b> sécurisée.[[%radio_filtrer_javascript3%]]',
	'filtrer_javascript:nom' => 'Gestion du JavaScript ',
	'flock:description' => 'Désactive le système de verrouillage de fichiers en neutralisant la fonction PHP {flock()}. Certains hébergements posent en effet des problèmes graves suite à un système de fichiers inadapté ou à un manque de synchronisation. N\'active pas cet outil si ton site fonctionne normalement.',
	'flock:nom' => 'Pas de verrouillage de fichiers',
	'fonds' => 'Fonds :',
	'forcer_langue:description' => 'Force le contexte de langue pour les jeux de squelettes multilingues disposant d\'un formulaire ou d\'un menu de langues sachant gérer le cookie de langues.

Techniquement, cet outil a pour effet :
- de désactiver la recherche du squelette en fonction de la langue de l\'objet,
- de désactiver le critère <code>{lang_select}</code> automatique sur les objets classiques (articles, brèves, rubriques etc ... ).

Les blocs multi s\'affichent alors toujours dans la langue demandée par le visiteur.',
	'forcer_langue:nom' => 'Force la langue',
	'format_spip' => 'Les articles au format SPIP',
	'forum_lgrmaxi:description' => 'Par défaut les messages de forum ne sont pas limités en taille. Si cet outil est activé, un message d\'erreur s\'affichera lorsque quelqu\'un voudra poster un message  d\'une taille supérieure à la valeur spécifiée, et le message sera refusé. Une valeur vide ou égale à 0 signifie néanmoins qu\'aucune limite ne s\'applique.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Taille des forums',

	// G
	'glossaire:aide' => 'Un texte sans glossaire : <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Gestion d’un glossaire interne li&eacute; &agrave; un ou plusieurs groupes de mots-cl&eacute;s. Inscrive ici le nom des groupes en  les s&eacute;parant par les deux points &laquo;&nbsp;:&nbsp;&raquo;. En laissant vide la case qui  suit (ou en tapant "Glossaire"), c’est le groupe "Glossaire" qui sera utilis&eacute;.[[%glossaire_groupes%]]

@puce@ Pour chaque mot, tu as la possibilit&eacute; de choisir le nombre maximal de liens cr&eacute;&eacute;s dans tes textes. Toute valeur nulle ou n&eacute;gative implique que tous les mots reconnus seront trait&eacute;s. [[%glossaire_limite% par mot-cl&eacute;]]

@puce@ Deux solutions te sont offertes pour g&eacute;n&eacute;rer la petite fen&ecirc;tre automatique qui appara&icirc;t lors du survol de la souris. [[%glossaire_js%]]',
	'glossaire:nom' => 'Glossaire interne',
	'glossaire_css' => 'Solution CSS',
	'glossaire_erreur' => 'Le mot «@mot1@» rend indétectable le mot «@mot2@»',
	'glossaire_inverser' => 'Correction proposée : inverser l\'ordre des mots en base.',
	'glossaire_js' => 'Solution JavaScript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) étudié(s) en base semble correcte.',
	'guillemets:description' => 'Remplace automatiquement les guillemets droits (") par les guillemets typographiques de la langue de composition. Le remplacement, transparent pour l\'utilisateur, ne modifie pas le texte original mais seulement l\'affichage final.',
	'guillemets:nom' => 'Guillemets typographiques',

	// H
	'help' => '{{Cette page est uniquement accessible aux responsables du site.}} Elle permet la configuration des différentes fonctions supplémentaires apportées par le plugin «{{Le Couteau Suisse}}».',
	'help2' => 'Version locale : @version@',
	'help3' => '<p>Liens de documentation :<br />• [{{Le&nbsp;Couteau&nbsp;Suisse}}->http://www.spip-contrib.net/?article2166]@contribs@</p><p>R&eacute;initialisations :
_ • [Des outils cach&eacute;s|Revenir &agrave; l\'apparence initiale de cette page->@hide@]
_ • [De tout le plugin|Revenir &agrave; l\'&eacute;tat initial du plugin->@reset@]@install@
</p>',
	'horloge:description' => 'Outil en cours de développement. T\'offre une horloge JavaScript . Balise : <code>#HORLOGE</code>. Modèle : <code><horloge></code>

Arguments disponibles : {zone}, {format} et/ou {id}.',
	'horloge:nom' => 'Horloge',

	// I
	'icone_visiter:description' => 'Remplace l\'image du bouton standard «<:icone_visiter_site:>» (en haut à droite sur cette page)  par le logo du site, s\'il existe.

Pour définir ce logo, va sur la page «<:titre_configuration:>» en cliquant sur le bouton «<:icone_configuration_site:>».',
	'icone_visiter:nom' => 'Bouton « <:icone_visiter_site:> »',
	'insert_head:description' => 'Active automatiquement la balise [#INSERT_HEAD->http://www.spip.net/fr_article1902.html] sur tous les squelettes, qu\'ils aient ou non cette balise entre &lt;head&gt; et &lt;/head&gt;. Grâce à cette option, les plugins pourront insérer du JavaScript (.js) ou des feuilles de style (.css).',
	'insert_head:nom' => 'Balise #INSERT_HEAD',
	'insertions:description' => 'ATTENTION : outil en cours de développement !! [[%insertions%]]',
	'insertions:nom' => 'Corrections automatiques',
	'introduction:description' => 'Cette balise &amp;agrave; placer dans les squelettes sert en g&amp;eacute;n&amp;eacute;ral &amp;agrave; la une ou dans les rubriques afin de produire un r&amp;eacute;sum&amp;eacute; des articles, des br&amp;egrave;ves, etc..</p>
<p>{{Attention}} : Avant d\'activer cette fonctionnalit&amp;eacute;, v&amp;eacute;rifie bien qu\'aucune fonction {balise_INTRODUCTION()} n\'existe d&amp;eacute;j&amp;agrave; dans ton squelette ou tes plugins, la surcharge produirait alors une erreur de compilation.</p>
@puce@ Tu peux pr&amp;eacute;ciser (en pourcentage par rapport &amp;agrave; la valeur utilis&amp;eacute;e par d&amp;eacute;faut) la longueur du texte renvoy&amp;eacute; par balise #INTRODUCTION. Une valeur nulle ou &amp;eacute;gale &amp;agrave; 100 ne modifie pas l\'aspect de l\'introduction et utilise donc les valeurs par d&amp;eacute;faut suivantes : 500 caract&amp;egrave;res pour les articles, 300 pour les br&amp;egrave;ves et 600 pour les forums ou les rubriques.
[[%lgr_introduction%&amp;nbsp;%]]
@puce@ Par d&amp;eacute;faut, les points de suite ajout&amp;eacute;s au r&amp;eacute;sultat de la balise #INTRODUCTION si le texte est trop long sont : <html>&amp;laquo;&amp;amp;nbsp;(…)&amp;raquo;</html>.Tu peux ici pr&amp;eacute;ciser ta propre cha&amp;icirc;ne de caract&amp;egrave;res indiquant au lecteur que le texte tronqu&amp;eacute; a bien une suite.
[[%suite_introduction%]]
@puce@ Si la balise #INTRODUCTION est utilis&amp;eacute;e pour r&amp;eacute;sumer un article, alors le Couteau Suisse peut fabriquer un lien hypertexte sur les points de suite d&amp;eacute;finis ci-dessus afin de mener le lecteur vers le texte original. Par exemple : &amp;laquo;Lire la suite de l\'article…&amp;raquo;
[[%lien_introduction%]]', # MODIF
	'introduction:nom' => 'Balise #INTRODUCTION',

	// J
	'jcorner:description' => '« Jolis Coins » est un outil permettant de modifier facilement l\'aspect des coins de tes {{cadres colorés}} en partie publique de ton site. Tout est possible, ou presque !
_ Regarde le résultat sur cette page : [->http://www.malsup.com/jquery/corner/].

Liste ci-dessous les objets de ton squelette à arrondir en utilisant la syntaxe CSS (.class, #id, etc. ). Utilise le le signe « = » pour spécifier la commande jQuery à utiliser et un double slash (« // ») pour les commentaires. En absence du signe égal, des coins ronds seront appliqués (équivalent à : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Attention, cet outil a besoin pour fonctionner du plugin {jQuery} : {Round Corners}. Le Couteau Suisse peut l\'installer directement si tu coches la case suivante. [[%jcorner_plugin%]]',
	'jcorner:nom' => 'Jolis Coins',
	'jcorner_plugin' => '« Round Corners plugin »',
	'jq_localScroll' => 'jQuery.LocalScroll ([démo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([démo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Défaut',
	'js_jamais' => 'Jamais',
	'js_toujours' => 'Toujours',
	'jslide_aucun' => 'Aucune animation',
	'jslide_fast' => 'Glissement rapide',
	'jslide_lent' => 'Glissement lent',
	'jslide_millisec' => 'Glissement durant :',
	'jslide_normal' => 'Glissement normal',

	// L
	'label:admin_travaux' => 'Fermer le site public pour :',
	'label:alinea' => 'Champ d\'application :',
	'label:arret_optimisation' => 'Empêcher SPIP de vider la corbeille automatiquement :',
	'label:auteur_forum_nom' => 'Le visiteur doit spécifier :',
	'label:auto_sommaire' => 'Création systématique du sommaire :',
	'label:balise_decoupe' => 'Activer la balise #CS_DECOUPE :',
	'label:balise_sommaire' => 'Activer la balise #CS_SOMMAIRE :',
	'label:bloc_h4' => 'Balise pour les titres :',
	'label:bloc_unique' => 'Un seul bloc ouvert sur la page :',
	'label:blocs_cookie' => 'Utilisation des cookies :',
	'label:blocs_slide' => 'Type d\'animation :',
	'label:compacte_css' => 'Compression du HEAD :',
	'label:copie_Smax' => 'Espace maximal réservé aux copies locales :',
	'label:couleurs_fonds' => 'Permettre les fonds :',
	'label:cs_rss' => 'Activer :',
	'label:debut_urls_propres' => 'Début des URLs :',
	'label:decoration_styles' => 'Tes balises de style personnalisé :',
	'label:derniere_modif_invalide' => 'Recalculer juste après une modification :',
	'label:devdebug_espace' => 'Filtrage de l\'espace concerné :',
	'label:devdebug_mode' => 'Activer le débogage',
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoyé :',
	'label:distant_off' => 'Désactiver :',
	'label:doc_Smax' => 'Taille maximale des documents :',
	'label:dossier_squelettes' => 'Dossier(s) à utiliser :',
	'label:duree_cache' => 'Durée du cache local :',
	'label:duree_cache_mutu' => 'Durée du cache en mutualisation :',
	'label:ecran_actif' => '@_CS_CHOIX@',
	'label:enveloppe_mails' => 'Petite enveloppe devant les mails :',
	'label:expo_bofbof' => 'Mise en exposants pour : <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:forum_lgrmaxi' => 'Valeur (en caractères) :',
	'label:glossaire_groupes' => 'Groupe(s) utilisé(s) :',
	'label:glossaire_js' => 'Technique utilisée :',
	'label:glossaire_limite' => 'Nombre maximal de liens créés :',
	'label:i_align' => 'Alignement du texte :',
	'label:i_couleur' => 'Couleur de la police :',
	'label:i_hauteur' => 'Hauteur de la ligne de texte (éq. à {line-height}) :',
	'label:i_largeur' => 'Largeur maximale de la ligne de texte :',
	'label:i_padding' => 'Espacement autour du texte (éq. à {padding}) :',
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/}) :',
	'label:i_taille' => 'Taille de la police :',
	'label:img_GDmax' => 'Calculs d\'images avec GD :',
	'label:img_Hmax' => 'Taille maximale des images :',
	'label:insertions' => 'Corrections automatiques :',
	'label:jcorner_classes' => 'Améliorer les coins des sélecteurs suivantes :',
	'label:jcorner_plugin' => 'Installer le plugin {jQuery} suivant :',
	'label:jolies_ancres' => 'Calculer de jolies ancres :',
	'label:lgr_introduction' => 'Longueur du résumé :',
	'label:lgr_sommaire' => 'Largeur du sommaire (9 à 99) :',
	'label:lien_introduction' => 'Points de suite cliquables :',
	'label:liens_interrogation' => 'Protéger les URLs :',
	'label:liens_orphelins' => 'Liens cliquables :',
	'label:log_couteau_suisse' => 'Activer :',
	'label:logo_Hmax' => 'Taille maximale des logos :',
	'label:long_url' => 'Longueur du libellé cliquable :', # NEW
	'label:marqueurs_urls_propres' => 'Ajouter les marqueurs dissociant les objets (SPIP>=2.0) :<br />(ex. : « - » pour -Ma-rubrique-, « @ » pour @Mon-site@) ',
	'label:max_auteurs_page' => 'Auteurs par page :',
	'label:message_travaux' => 'Ton message de maintenance :',
	'label:moderation_admin' => 'Valider automatiquement les messages des : ',
	'label:mot_masquer' => 'Mot-clé masquant les contenus :',
	'label:ouvre_note' => 'Ouverture et fermeture des notes de bas de page',
	'label:ouvre_ref' => 'Ouverture et fermeture des appels de notes de bas de page',
	'label:paragrapher' => 'Toujours paragrapher :',
	'label:prive_travaux' => 'Accessibilité de l\'espace privé pour :',
	'label:prof_sommaire' => 'Profondeur retenue (1 à 4) :',
	'label:puce' => 'Puce publique «<html>-</html>» :',
	'label:quota_cache' => 'Valeur du quota :',
	'label:racc_g1' => 'Entrée et sortie de la mise en «<html>{{gras}}</html>» :',
	'label:racc_h1' => 'Entrée et sortie d\'un «<html>{{{intertitre}}}</html>» :',
	'label:racc_hr' => 'Ligne horizontale «<html>----</html>» :',
	'label:racc_i1' => 'Entrée et sortie d\'un «<html>{italique}</html>» :',
	'label:radio_desactive_cache3' => 'Utilisation du cache :',
	'label:radio_desactive_cache4' => 'Utilisation du cache :',
	'label:radio_target_blank3' => 'Nouvelle fenêtre pour les liens externes :',
	'label:radio_type_urls3' => 'Format des URLs :',
	'label:scrollTo' => 'Installer les plugins {jQuery} suivants :',
	'label:separateur_urls_page' => 'Caractère de séparation \'type-id\'<br />(ex. : ?article-123) :',
	'label:set_couleurs' => 'Set à utiliser :',
	'label:spam_ips' => 'Adresses IP à bloquer :',
	'label:spam_mots' => 'Séquences interdites :',
	'label:spip_options_on' => 'Inclure :',
	'label:spip_script' => 'Script d\'appel :',
	'label:style_h' => 'Ton style :',
	'label:style_p' => 'Ton style :',
	'label:suite_introduction' => 'Points de suite :',
	'label:terminaison_urls_page' => 'Terminaison des URLs (ex : « .html ») :',
	'label:titre_travaux' => 'Titre du message :',
	'label:titres_etendus' => 'Activer l\'utilisation étendue des balises #TITRE_XXX :',
	'label:url_arbo_minuscules' => 'Conserver la casse des titres dans les URLs :',
	'label:url_arbo_sep_id' => 'Caractère de séparation \'titre-id\' en cas de doublon :<br />(ne pas utiliser \'/\')',
	'label:url_glossaire_externe2' => 'Lien vers le glossaire externe :',
	'label:url_max_propres' => 'Longueur maximale des URLs (caractères) :',
	'label:urls_arbo_sans_type' => 'Afficher le type d\'objet SPIP dans les URLs :',
	'label:urls_avec_id' => 'Un id systématique, mais...',
	'label:webmestres' => 'Liste des webmestres du site :',
	'liens_en_clair:description' => 'Met à ta disposition le filtre : \'liens_en_clair\'. Ton texte contient probablement des liens hypertexte qui ne sont pas visibles lors d\'une impression. Ce filtre ajoute entre crochets la destination de chaque lien cliquable (liens externes ou mails). Attention : en mode impression (parametre \'cs=print\' ou \'page=print\' dans l\'url de la page), cette fonctionnalité est appliquée automatiquement.',
	'liens_en_clair:nom' => 'Liens en clair',
	'liens_orphelins:description' => 'Cet outil a deux fonctions :

@puce@ {{Liens corrects}}.

SPIP a pour habitude d\'ins&eacute;rer un espace avant les points d\'interrogation ou d\'exclamation et de transformer le double tiret en tiret cadratin, typo fran&ccedil;aise oblige. Hors, les URLs de tes textes ne sont pas &eacute;pargn&eacute;es. Cet outil vous permet de les prot&eacute;ger.[[%liens_interrogation%]]

@puce@ {{Liens orphelins}}.

Remplace syst&eacute;matiquement toutes les URLs laiss&eacute;es en texte par les utilisateurs (notamment dans les forums) et qui ne sont donc pas cliquables, par des liens hypertextes au format SPIP. Par exemple : {<html>www.spip.net</html>} est remplac&eacute; par [->www.spip.net].

Tu peux choisir le type de remplacement :
_ • {Basique} : sont remplac&eacute;s les liens du type {<html>http://spip.net</html>} (tout protocole) ou {<html>www.spip.net</html>}.
_ • {&Eacute;tendu} : sont remplac&eacute;s en plus les liens du type {<html>moi@spip.net</html>}, {<html>mailto:monmail</html>} ou {<html>news:mesnews</html>}.
_ • {Par d&eacute;faut} : remplacement automatique d\'origine (&agrave; partir de la version 2.0 de SPIP).
[[%liens_orphelins%]]',
	'liens_orphelins:description1' => '[[Si l\'URL rencontrée dépasse les %long_url% caractères, alors SPIP la réduit à %coupe_url% caractères]].', # NEW
	'liens_orphelins:nom' => 'Belles URLs',

	// M
	'mailcrypt:description' => 'Masque tous les liens de courriels présents dans tes textes en les remplaçant par un lien JavaScript permettant quand même d\'activer la messagerie du lecteur. Cet outil antispam tente d\'empêcher les robots de collecter les adresses électroniques laissées en clair dans les forums ou dans les balises de tes squelettes.',
	'mailcrypt:nom' => 'MailCrypt',
	'maj_auto:description' => 'Cet outil te permet de gérer facilement la mise à jour de vos différents plugins, récupérant notamment le numéro de révision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouvé sur <code>zone.spip.org</code>.

La liste ci-dessus offre la possibilité de lancer le processus de mise à jour automatique de SPIP sur chacun des plugins préalablement installés dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> sont simplement listés à titre d\'information. Si la révision distante n\'a pas pu être trouvée, alors tentez de procéder manuellement à la mise à jour du plugin.

Note : les paquets <code>.zip</code> n\'étant pas reconstruits instantanément, il se peut que tu sois  obligé d\'attendre un certain délai avant de pouvoir effectuer la totale mise à jour d\'un plugin tout récemment modifié.',
	'maj_auto:nom' => 'Mises à jour automatiques',
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particulière de tes squelettes, les contenus (rubriques ou articles) qui ont le mot-clé défini ci-dessous. Si une rubrique est masquée, toute sa branche l\'est aussi.[[%mot_masquer%]]

Pour forcer l\'affichage des contenus masqués, il suffit d\'ajouter le critère <code>{tout_voir}</code> aux boucles de ton squelette.',
	'masquer:nom' => 'Masquer du contenu',
	'meme_rubrique:description' => 'Définis ici le nombre d\'objets listés dans le cadre nommé «<:info_meme_rubrique:>» et présent sur certaines pages de l\'espace privé.[[%meme_rubrique%]]',
	'message_perso' => 'Un grand merci aux traducteurs qui passeraient par ici. Pat ;-)',
	'moderation_admins' => 'administrateurs authentifiés',
	'moderation_message' => 'Ce forum est modéré à priori : ta contribution n\'apparaîtra qu\'après avoir été validée par un administrateur du site, sauf si tu es identifié et autorisé à poster directement.',
	'moderation_moderee:description' => 'Permet de modérer la modération des forums publics <b>configurés à priori</b> pour les utilisateurs inscrits.<br />Exemple : Je suis le webmestre de mon site, et je réponds à un message d\'un utilisateur, pourquoi devoir valider mon propre message ? Modération modérée le fait pour moi ! [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Modération modérée',
	'moderation_redacs' => 'rédacteurs authentifiés',
	'moderation_visits' => 'visiteurs authentifiés',
	'modifier_vars' => 'Modifier ces @nb@ paramètres',
	'modifier_vars_0' => 'Modifier ces paramètres',

	// N
	'no_IP:description' => 'Désactive le mécanisme d\'enregistrement automatique des adresses IP des visiteurs de ton site par soucis de confidentialité : SPIP ne conservera alors plus aucun numéro IP, ni temporairement lors des visites (pour gérer les statistiques ou alimenter spip.log), ni dans les forums (responsabilité).',
	'no_IP:nom' => 'Pas de stockage IP',
	'nouveaux' => 'Nouveaux',

	// O
	'orientation:description' => '3 nouveaux critères pour tes squelettes : <code>{portrait}</code>, <code>{carre}</code> et <code>{paysage}</code>. Idéal pour le classement des photos en fonction de leur forme.',
	'orientation:nom' => 'Orientation des images',
	'outil_actif' => 'Outil actif',
	'outil_actif_court' => 'actif',
	'outil_activer' => 'Activer',
	'outil_activer_le' => 'Activer l\'outil',
	'outil_cacher' => 'Ne plus afficher',
	'outil_desactiver' => 'Désactiver',
	'outil_desactiver_le' => 'Désactiver l\'outil',
	'outil_inactif' => 'Outil inactif',
	'outil_intro' => 'Cette page liste les fonctionnalités du plugin mises à ta disposition.<br /><br />En cliquant sur le nom des outils ci-dessous, tu sélectionnes ceux dont tu pourras permuter l\'état à l\'aide du bouton central : les outils activés seront désactivés et <i>vice versa</i>. À chaque clic, la description apparaît au-dessous des listes. Les catégories sont repliables et les outils peuvent être cachés. Le double-clic permet de permuter rapidement un outil.<br /><br />Pour une première utilisation, il est recommandé d\'activer les outils un par un, au cas où apparaîtraient certaines incompatibilités avec ton squelette, avec SPIP ou avec d\'autres plugins.<br /><br />Note : le simple chargement de cette page recompile l\'ensemble des outils du Couteau Suisse.',
	'outil_intro_old' => 'Cette interface est ancienne.<br /><br />Si tu rencontres des problèmes dans l\'utilisation de la <a href=\'./?exec=admin_couteau_suisse\'>nouvelle interface</a>, n\'hésite pas à nous en faire part sur le forum de <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@ : @nb@ outil',
	'outil_nbs' => '@pipe@ : @nb@ outils',
	'outil_permuter' => 'Permuter l\'outil : « @text@ » ?',
	'outils_actifs' => 'Outils actifs :',
	'outils_caches' => 'Outils cachés :',
	'outils_cliquez' => 'Clique sur le nom des outils ci-dessus pour afficher ici leur description.',
	'outils_concernes' => 'Sont concernés : ',
	'outils_desactives' => 'Sont désactivés : ',
	'outils_inactifs' => 'Outil inactifs :',
	'outils_liste' => 'Liste des outils du Couteau Suisse',
	'outils_non_parametrables' => 'Non paramétrables :',
	'outils_permuter_gras1' => 'Permuter les outils en gras',
	'outils_permuter_gras2' => 'Permuter les @nb@ outils en gras ?',
	'outils_resetselection' => 'Réinitialiser la sélection',
	'outils_selectionactifs' => 'Sélectionner tous les outils actifs',
	'outils_selectiontous' => 'TOUS',

	// P
	'pack_actuel' => 'Pack @date@',
	'pack_actuel_avert' => 'Attention, les surcharges sur les define(), les autorisations spécifiques ou les globales ne sont pas spécifiées ici',
	'pack_actuel_titre' => 'PACK ACTUEL DE CONFIGURATION DU COUTEAU SUISSE',
	'pack_alt' => 'Voir les paramètres de configuration en cours',
	'pack_delete' => 'Supression d\'un pack de configuration',
	'pack_descrip' => 'Ton « Pack de configuration actuelle » rassemble l\'ensemble des paramètres de configuration en cours concernant le Couteau Suisse : l\'activation des outils et la valeur de leurs éventuelles variables.

Si les droits d\'écriture le permettent, le code PHP ci-dessous pourra prendre place dans le fichier {{/config/mes_options.php}} et ajoutera un lien de réinitialisation sur cette page du pack « {@pack@} ». Bien sûr il t\'est possible de changer son nom.

Si tu réinitialises le plugin en cliquant sur un pack, le Couteau Suisse se reconfigurera automatiquement en fonction des paramètres prédéfinis dans ce pack.',
	'pack_du' => '• du pack @pack@',
	'pack_installe' => 'Mise en place d\'un pack de configuration',
	'pack_installer' => 'Es-tu sûr de vouloir réinitialiser le Couteau Suisse et installer le pack « @pack@ » ?',
	'pack_nb_plrs' => 'Il y a actuellement @nb@ « packs de configuration » disponibles.',
	'pack_nb_un' => 'Il y a actuellement un « pack de configuration » disponible',
	'pack_nb_zero' => 'Il n\'y a pas de « pack de configuration » disponible actuellement.',
	'pack_outils_defaut' => 'Installation des outils par défaut',
	'pack_sauver' => 'Sauver la configuration actuelle',
	'pack_sauver_descrip' => 'Le bouton ci-dessous te permet d\'insérer directement dans ton fichier <b>@file@</b> les paramètres nécessaires pour ajouter un « pack de configuration » dans le menu de gauche. Ceci te permettra ultérieurement de reconfigurer en un clic votre Couteau Suisse dans l\'état où il est actuellement.',
	'pack_supprimer' => 'Es-tu sûr de vouloir supprimer le pack « @pack@ » ?',
	'pack_titre' => 'Configuration Actuelle',
	'pack_variables_defaut' => 'Installation des variables par défaut',
	'par_defaut' => 'Par défaut',
	'paragrapher2:description' => 'La fonction SPIP <code>paragrapher()</code> insère des balises &lt;p&gt; et &lt;/p&gt; dans tous les textes qui sont dépourvus de paragraphes. Afin de gérer plus finement tes styles et vos mises en page, tu as la possibilité d\'uniformiser l\'aspect des textes de ton site.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Paragrapher',
	'pipelines' => 'Pipelines utilisés :',
	'previsualisation:description' => 'Par défaut, SPIP permet de prévisualiser un article dans sa version publique et stylée, mais uniquement lorsque celui-ci a été « proposé à l’évaluation ». Hors cet outil permet aux auteurs de prévisualiser également les articles pendant leur rédaction. Chacun peut alors prévisualiser et modifier son texte à sa guise.

@puce@ Attention : cette fonctionnalité ne modifie pas les droits de prévisualisation. Pour que tes rédacteurs aient effectivement le droit de prévisualiser leurs articles « en cours de rédaction », tu dois l’autoriser (dans le menu {[Configuration&gt;Fonctions avancées->./?exec=config_fonctions]} de l’espace privé).',
	'previsualisation:nom' => 'Prévisualisation des articles',
	'puceSPIP' => 'Autoriser le raccourci «*»',
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>',
	'pucesli:description' => 'Remplace les puces «-» (tiret simple) des différents contenus de ton site par des listes notées «-*» (traduites en HTML par : &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) et dont le style peut être facilement personnalisé par css.

Afin de conserver l\'accès à la puce image originale de SPIP (le petit triangle), un nouveau raccourci en début de ligne «*» peut être proposé à tes rédacteurs :[[%puceSPIP%]]',
	'pucesli:nom' => 'Belles puces',

	// Q
	'qui_webmestres' => 'Les webmestres SPIP',

	// R
	'raccourcis' => 'Raccourcis typographiques actifs du Couteau Suisse :',
	'raccourcis_barre' => 'Les raccourcis typographiques du Couteau Suisse',
	'reserve_admin' => 'Accès réservé aux administrateurs.',
	'rss_actualiser' => 'Actualiser',
	'rss_attente' => 'Attente RSS...',
	'rss_desactiver' => 'Désactiver les « Révisions du Couteau Suisse »',
	'rss_edition' => 'Flux RSS mis à jour le :',
	'rss_source' => 'Source RSS',
	'rss_titre' => '« Le Couteau Suisse » en développement :',
	'rss_var' => 'Les révisions du Couteau Suisse',

	// S
	'sauf_admin' => 'Tous, sauf les administrateurs',
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et rédacteurs',
	'sauf_identifies' => 'Tous, sauf les auteurs identifiés',
	'set_options:description' => 'S&eacute;lectionne d\'office le type d’interface priv&eacute;e (simplifi&eacute;e ou avanc&eacute;e) pour tous les r&eacute;dacteurs d&eacute;j&agrave; existant ou &agrave; venir et supprime le bouton correspondant du bandeau des petites ic&ocirc;nes.[[%radio_set_options4%]]',
	'set_options:nom' => 'Type d\'interface privée',
	'sf_amont' => 'En amont',
	'sf_tous' => 'Tous',
	'simpl_interface:description' => 'Désactive le menu de changement rapide de statut d\'un article au survol de sa puce colorée. Cela est utile si tu cherches à obtenir une interface privée la plus dépouillée possible afin d\'optimiser les performances client.',
	'simpl_interface:nom' => 'Allègement de l\'interface privée',
	'smileys:aide' => 'Smileys : @liste@',
	'smileys:description' => 'Insère des smileys dans tous les textes où apparaît un raccourci du genre <code>:-)</code>. Idéal pour les  forums.
_ Une balise est disponible pour afficher un tableau de smileys dans tes squelettes : #SMILEYS.
_ Dessins : [Sylvain Michel->http://www.guaph.net/]',
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'Offre à ton site public un défilement  adouci de la page lorsque le visiteur clique sur un lien pointant vers une ancre : très utile pour éviter de se perdre dans une page complexe ou un texte très long...

Attention, cet outil a besoin pour fonctionner de pages au «DOCTYPE XHTML» (non HTML !) et de deux plugins {jQuery} : {ScrollTo} et {LocalScroll}. Le Couteau Suisse peut les installer directement si tu coches les cases suivantes. [[%scrollTo%]][[-->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@',
	'soft_scroller:nom' => 'Ancres douces',
	'sommaire:description' => 'Construit un sommaire pour le texte de tes articles et de tes rubriques afin d’accéder rapidement aux gros titres (balises HTML &lt;@h3@>Un gros titre&lt;/@h3@>) ou aux intertitres SPIP (de syntaxe <code>{{{Un intertitre}}}</code>).

Pour information, l\'outil « [.->class_spip] » permet de choisir la balise &lt;hN> utilisée pour les intertitres de SPIP.

@puce@ Définis ici la profondeur retenue sur les intertitres pour construire le sommaire (1 = &lt;@h3@>, 2 = &lt;@h3@> et &lt;@h4@>, etc.) :[[%prof_sommaire%]]

@puce@ Définis ici le nombre maximal de caractères retenus par intertitre :[[%lgr_sommaire% caractères]]

@puce@ Les ancres du sommaire peuvent être calculées à partir du titre et non ressembler à : {outil_sommaire_NN}. Cette option donne également accès à la syntaxe <code>{{{Mon titre<mon_ancre>}}}</code> qui permet de choisir l\'ancre utilisée.[[%jolies_ancres%]]

@puce@ Fixe ici le comportement du plugin concernant la création du sommaire: 
_ • Systématique pour chaque article (une balise <code>@_CS_SANS_SOMMAIRE@</code> placée n’importe où à l’intérieur du texte de l’article créera une exception).
_ • Uniquement pour les articles contenant la balise <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Par défaut, le Couteau Suisse insère automatiquement le sommaire en tête d\'article. Mais tu as ce sommaire ailleurs dans ton squelette grâce à une balise #CS_SOMMAIRE.
[[%balise_sommaire%]]

Ce sommaire est compatible avec « [.->decoupe] » et « [.->titres_typo] ».',
	'sommaire:nom' => 'Sommaire automatique',
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre<mon_ancre>}}}</html></b>',
	'sommaire_avec' => 'Un texte avec sommaire : <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un texte sans sommaire : <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hiérarchisés : <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.',
	'spam:description' => 'Tente de lutter contre les envois de messages automatiques et malveillants en partie publique. Certains mots, tout comme les balises en clair &lt;a>&lt;/a>, sont interdits : incite tes rédacteurs à utiliser les raccourcis de liens au format SPIP.

@puce@ Liste ici les séquences interdites en les séparant par des espaces.[[%spam_mots%]]
<q1>• Pour une expression avec des espaces, place-la entre guillemets.
_ • Pour spécifier un mot entier, mets-le entre parenthèses. Exemple~:~{(asses)}.
_ • Pour une expression régulière, vérifie bien la syntaxe et place-la entre slashes puis entre guillemets.
_ Exemple~:~{<html>\\"/@test\\.(com|fr)/\\"</html>}.
_ • Pour une expression régulière devant agir sur des caractères HTML, place le test entre «&#» et «;».
_ Exemple~:~{<html>\\"/&#(?:1[4-9][0-9]{3}|[23][0-9]{4});/\\"</html>}.</q1>

@puce@ Certaines adresses IP peuvent également être bloquées à la source. Note toutefois que derrière ces adresses (souvent variables), il peut y avoir plusieurs utilisateurs, voire un réseau entier.[[%spam_ips%]]
<q1>• Utilise le caractère «*» pour plusieurs chiffres, «?» pour un seul et les crochets pour des classes de chiffres.</q1>',
	'spam:nom' => 'Lutte contre le SPAM',
	'spam_ip' => 'Blocage IP de @ip@ :',
	'spam_test_ko' => 'Ce message serait bloqué par le filtre anti-SPAM !',
	'spam_test_ok' => 'Ce message serait accepté par le filtre anti-SPAM.',
	'spam_tester_bd' => 'Teste également ta base de données et liste les messages qui auraient été bloquées par la configuration actuelle de l\'outil.',
	'spam_tester_label' => 'Teste ici ta liste de séquences interdites ou d\'adresses IP, utilise le cadre suivant :',
	'spip_cache:description' => '@puce@ Le cache occupe un certain espace disque et SPIP peut en limiter l\'importance. Une valeur vide ou égale à 0 signifie qu\'aucun quota ne s\'applique.[[%quota_cache% Mo]]

@puce@ Lorsqu\'une modification du contenu du site est faite, SPIP invalide immédiatement le cache sans attendre le calcul périodique suivant. Si ton site a des problèmes de performance face à une charge très élevée, tu peux cocher « non » à cette option.[[%derniere_modif_invalide%]]

@puce@ Si la balise #CACHE n\'est pas trouvée dans tes squelettes locaux, SPIP considère par défaut que le cache d\'une page a une durée de vie de 24 heures avant de la recalculer. Afin de mieux gérer la charge de ton serveur, tu peux ici modifier cette valeur.[[%duree_cache% heures]]

@puce@ Si tu as plusieurs sites en mutualisation, tu peux spécifier ici la valeur par défaut prise en compte par tous les sites locaux (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]',
	'spip_cache:description1' => '@puce@ Par défaut, SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en accélérer la consultation. Désactiver temporairement le cache peut aider au développement du site.[[%radio_desactive_cache3%]]',
	'spip_cache:description2' => '@puce@ Quatre options pour orienter le fonctionnement du cache de SPIP : <q1>
_ • {Usage normal} : SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en acc&eacute;l&eacute;rer la consultation. Apr&egrave;s un certain d&eacute;lai, le cache est recalcul&eacute; et stock&eacute;.
_ • {Cache permanent} : les d&eacute;lais d\'invalidation du cache sont ignor&eacute;s.
_ • {Pas de cache} : d&eacute;sactiver temporairement le cache peut aider au d&eacute;veloppement du site. Ici, rien n\'est stock&eacute; sur le disque.
_ • {Contr&ocirc;le du cache} : option identique &agrave; la pr&eacute;c&eacute;dente, avec une &eacute;criture sur le disque de tous les r&eacute;sultats afin de pouvoir &eacute;ventuellement les contr&ocirc;ler.</q1>[[%radio_desactive_cache4%]]',
	'spip_cache:description3' => '@puce@ L\'extension « Compresseur » présente dans SPIP permet de compacter les différents éléments CSS et Javascript de tes pages et de les placer dans un cache statique. Cela accélère l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers à obtenir.',
	'spip_cache:nom' => 'SPIP et le cache…',
	'spip_ecran:description' => 'Détermine la largeur d\'écran imposée à tous en partie privée. Un écran étroit présentera deux colonnes et un écran large en présentera trois. Le réglage par défaut laisse l\'utilisateur choisir, son choix étant stocké dans un cookie.[[%spip_ecran%]]',
	'spip_ecran:nom' => 'Largeur d\'écran',
	'stat_auteurs' => 'Les auteurs en stat',
	'statuts_spip' => 'Uniquement les statuts SPIP suivants :',
	'statuts_tous' => 'Tous les statuts',
	'suivi_forums:description' => 'Un auteur d\'article est toujours informé lorsqu\'un message est publié dans le forum public associé. Mais il est aussi possible d\'avertir en plus : tous les participants au forum ou seulement les auteurs de messages en amont.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Suivi des forums publics',
	'supprimer_cadre' => 'Supprimer ce cadre',
	'supprimer_numero:description' => 'Applique la fonction SPIP supprimer_numero() à l\'ensemble des {{titres}}, des {{noms}} et des {{types}} (de mots-clés) du site public, sans que le filtre supprimer_numero soit présent dans les squelettes.<br />Voici la syntaxe à utiliser dans le cadre d\'un site multilingue : <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Supprime le numéro',

	// T
	'titre' => 'Le Couteau Suisse',
	'titre_parent:description' => 'Au sein d\'une boucle, il est courant de vouloir afficher le titre du parent de l\'objet en cours. Traditionnellement, il suffirait d\'utiliser une seconde boucle, mais cette nouvelle balise #TITRE_PARENT allégera l\'écriture de tes squelettes. Le résultat renvoyé est : le titre du groupe d\'un mot-clé ou celui de la rubrique parente (si elle existe) de tout autre objet (article, rubrique, brève, etc.).

Note : Pour les mots-clés, un alias de #TITRE_PARENT est #TITRE_GROUPE. Le traitement SPIP de ces nouvelles balises est similaire à celui de #TITRE.

@puce@ Si tu es sous SPIP 2.0, alors tu as ici à ta disposition tout un ensemble de balises #TITRE_XXX qui pourront te donner le titre de l\'objet \'xxx\', à condition que le champ \'id_xxx\' soit présent dans la table en cours (#ID_XXX utilisable dans la boucle en cours).

Par exemple, dans une boucle sur (ARTICLES), #TITRE_SECTEUR donnera le titre du secteur dans lequel est placé l\'article en cours, puisque l\'identifiant #ID_SECTEUR (ou le champ \'id_secteur\') est disponible dans ce cas.

La syntaxe <html>#TITRE_XXX{yy}</html> est également supportée. Exemple : <html>#TITRE_ARTICLE{10}</html> renverra le titre de l\'article #10.[[%titres_etendus%]]',
	'titre_parent:nom' => 'Balises #TITRE_PARENT/OBJET',
	'titre_tests' => 'Le Couteau Suisse - Page de tests…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>« {{{Mon intertitre}}} »</html> en image typographique paramétrable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : « [.->sommaire] ».',
	'titres_typo:nom' => 'Intertitres en image',
	'tous' => 'Tous',
	'toutes_couleurs' => 'Les 36 couleurs des styles css :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Blocs multilingues : <b><:trad:></b>',
	'toutmulti:description' => 'À l\'instar de ce tu peux déjà faire dans tes squelettes, cet outil te permet d\'utiliser librement les chaînes de langues (de SPIP ou de tes squelettes) dans tous les contenus de ton site (articles, titres, messages, etc.) à l\'aide du raccourci <code><:chaine:></code>.

Consulte [ici ->http://www.spip.net/fr_article2128.html] la documentation de SPIP à ce sujet.

Cet outil accepte également les arguments introduits par SPIP 2.0. Par exemple, le raccourci <code><:ma_chaine{nom=Charles Martin, age=37}:></code> permet de passer deux paramètres à la chaîne suivante : <code>\'ma_chaine\'=>"Bonjour, je suis @nom@ et j\'ai @age@ ans"</code>.

La fonction SPIP utilisée en PHP est <code>_T(\'chaine\')</code> sans argument, et  <code>_T(\'chaine\', array(\'arg1\'=>\'un texte\', \'arg2\'=>\'un autre texte\'))</code> avec arguments.

 N\'oublie donc pas de vérifier que la clef <code>\'chaine\'</code> est bien définie dans les fichiers de langues.',
	'toutmulti:nom' => 'Blocs multilingues',
	'travaux_masquer_avert' => 'Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours',
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Ce site sera rétabli très prochainement.
_ Merci de ta compréhension.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Pour personnaliser la navigation en partie privée et lorsque SPIP le permet, choisis ici le tri à utiliser pour afficher certains types objets.

Les propositions ci-dessous sont basées sur la fonctionnalité SQL \'ORDER BY\' : n\'utilise le tri personnalisé que si tu sais ce que tu fais (champs disponibles par exemple pour les articles : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})

@puce@ {{Ordre des articles à l\'intérieur des rubriques}} [[%tri_articles%]][[->%tri_perso%]]

@puce@ {{Ordre des groupes dans le formulaire d\'ajout de mots-clés}} [[%tri_groupes%]][[->%tri_perso_groupes%]]',
	'tri_articles:nom' => 'Les tris de SPIP',
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)',
	'tri_modif' => 'Tri sur la date de modification (ORDER BY date_modif DESC)',
	'tri_perso' => 'Tri SQL personnalisé, ORDER BY suivi de :',
	'tri_publi' => 'Tri sur la date de publication (ORDER BY date DESC)',
	'tri_titre' => 'Tri sur le titre (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Outil en cours de développement. T\'offre quelques balises très simples et bien pratiques pour améliorer la lisibilité de tes squelettes.

@puce@ {{#BOLO}} : génère un faux texte d\'environ 3000 caractères ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction spécifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ Un modèle est également disponible pour tes contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caractères de faux texte.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction spécifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalise l\'affichage grâce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

@puce@ {{#CHR<html>{XX}</html>}} : balise équivalente à <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caractères spéciaux (le retour à la ligne par exemple) ou des caractères réservés par le compilateur de SPIP (les crochets ou les accolades).

@puce@ {{#LESMOTS}} : ',
	'trousse_balises:nom' => 'Trousse à balises',
	'type_urls:description' => '@puce@ SPIP offre un choix sur plusieurs jeux d\'URLs pour fabriquer les liens d\'accès aux pages de ton site.

Plus d\'infos : [->http://www.spip.net/fr_article765.html]. L\'outil « [.->boites_privees] » te permet de voir sur la page de chaque objet SPIP l\'URL propre associée.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@pour utiliser les formats {html}, {propres}, {propres2}, {libres} ou {arborescentes}, recopie le fichier "htaccess.txt" du répertoire de base du site SPIP sous le sous le nom ".htaccess" (attention à ne pas écraser d\'autres réglages que tu pourrais avoir mis dans ce fichier) ; si ton site est en "sous-répertoire", tu devras aussi éditer la ligne "RewriteBase" ce fichier. Les URLs définies seront alors redirigées vers les fichiers de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs «page»}} : ce sont les liens par défaut, utilisés par SPIP depuis sa version 1.9x.
_ Exemple : <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs «html»}} : les liens ont la forme des pages html classiques.
_ Exemple : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs «propres»}} : les liens sont calculés grâce au titre des objets demandés. Des marqueurs (_, -, +, @, etc.) encadrent les titres en fonction du type d\'objet.
_ Exemples : <code>/Mon-titre-d-article</code> ou <code>/-Ma-rubrique-</code> ou <code>/@Mon-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]][[%url_max_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs «propres2»}} : l\'extension \'.html\' est ajoutée aux liens {«propres»}.
_ Exemple : <code>/Mon-titre-d-article.html</code> ou <code>/-Ma-rubrique-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]][[%url_max_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs «libres»}} : les liens sont {«propres»}, mais sans marqueurs dissociant les objets (_, -, +, @, etc.).
_ Exemple : <code>/Mon-titre-d-article</code> ou <code>/Ma-rubrique</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]][[%url_max_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs «arborescentes»}} : les liens sont {«propres»}, mais de type arborescent.
_ Exemple : <code>/secteur/rubrique1/rubrique2/Mon-titre-d-article</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]][[%url_max_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs «propres-qs»}} : ce système fonctionne en "Query-String", c\'est-à-dire sans utilisation de .htaccess ; les liens sont {«propres»}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres_qs">@puce@ {{URLs «propres_qs»}} : ce système fonctionne en "Query-String", c\'est-à-dire sans utilisation de .htaccess ; les liens sont {«propres»}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs «standard»}} : ces liens désormais obsolètes étaient utilisés par SPIP jusqu\'à sa version 1.8.
_ Exemple : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Si tu utilises le format {page} ci-dessus ou si l\'objet demandé n\'est pas reconnu, alors il t\'est possible de choisir {{le script d\'appel}} à SPIP. Par défaut, SPIP choisit {spip.php}, mais {index.php} (exemple de format : <code>/index.php?article123</code>) ou une valeur vide (format : <code>/?article123</code>) fonctionnent aussi. Pour tout autre valeur, il te faut absolument créer le fichier correspondant dans la racine de SPIP, à l\'image de celui qui existe déjà : {index.php}.
[[%spip_script%]]',
	'type_urls:description1' => '@puce@ Si tu utilises un format &agrave; base d\'URLs &laquo;propres&raquo;  ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), le Couteau Suisse peut :
<q1>• S\'assurer que l\'URL produite soit totalement {{en minuscules}}.</q1>[[%urls_minuscules%]]
<q1>• Provoquer l\'ajout syst&eacute;matique de {{l\'id de l\'objet}} &agrave; son URL (en suffixe, en pr&eacute;fixe, etc.).
_ (exemples : <code>/Mon-titre-d-article,457</code> ou <code>/457-Mon-titre-d-article</code>)</q1>',
	'type_urls:nom' => 'Format des URLs',
	'typo_exposants:description' => '{{Textes français}} : améliore le rendu typographique des abréviations courantes, en mettant en exposant les éléments nécessaires (ainsi, {<acronym>Mme</acronym>} devient {M<sup>me</sup>}) et en corrigeant les erreurs courantes ({<acronym>2ème</acronym>} ou  {<acronym>2me</acronym>}, par exemple, deviennent {2<sup>e</sup>}, seule abréviation correcte).

Les abréviations obtenues sont conformes à celles de l\'Imprimerie nationale telles qu\'indiquées dans le {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (article « Abréviations », presses de l\'Imprimerie nationale, Paris, 2002).

Sont aussi traitées les expressions suivantes : <html>Dr, Pr, Mgr, m2, m3, Mn, Md, Sté, Éts, Vve, Cie, 1o, 2o, etc.</html> 

Choisis ici de mettre en exposant certains raccourcis supplémentaires, malgré un avis défavorable de l\'Imprimerie nationale :[[%expo_bofbof%]]

{{Textes anglais}} : mise en exposant des nombres ordinaux : <html>1st, 2nd</html>, etc.',
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
	'urls_avec_id2' => 'Le placer en préfixe',
	'urls_base_total' => 'Il y a actuellement @nb@ URL(s) en base',
	'urls_base_vide' => 'La base des URLs est vide',
	'urls_choix_objet' => 'Édition en base de l\'URL d\'un objet spécifique :',
	'urls_edit_erreur' => 'Le format actuel des URLs (« @type@ ») ne permet pas d\'édition.',
	'urls_enregistrer' => 'Enregistrer cette URL en base',
	'urls_id_sauf_rubriques' => 'Exclure les objets suivants (séparés par « : ») :',
	'urls_minuscules' => 'Lettres minuscules',
	'urls_nouvelle' => 'Éditer l\'URL « propres » :',
	'urls_num_objet' => 'Numéro :',
	'urls_purger' => 'Tout vider',
	'urls_purger_tables' => 'Vider les tables sélectionnées',
	'urls_purger_tout' => 'Réinitialiser les URLs stockées dans la base :',
	'urls_rechercher' => 'Rechercher cet objet en base',
	'urls_titre_objet' => 'Titre enregistré :',
	'urls_type_objet' => 'Objet :',
	'urls_url_calculee' => 'URL publique « @type@ » :',
	'urls_url_objet' => 'URL « propres » enregistrée :',
	'urls_valeur_vide' => '(Une valeur vide entraîne le recalcul de l\'URL)',

	// V
	'validez_page' => 'Pour accéder aux modifications :',
	'variable_vide' => '(Vide)',
	'vars_modifiees' => 'Les données ont bien été modifiées',
	'version_a_jour' => 'Ta version est à jour.',
	'version_distante' => 'Version distante...',
	'version_distante_off' => 'Vérification distante désactivée',
	'version_nouvelle' => 'Nouvelle version : @version@',
	'version_revision' => 'Révision : @revision@',
	'version_update' => 'Mise à jour automatique',
	'version_update_chargeur' => 'Téléchargement automatique',
	'version_update_chargeur_title' => 'Télécharge la dernière version du plugin grâce au plugin «Téléchargeur»',
	'version_update_title' => 'Télécharge la dernière version du plugin et lance sa mise à jour automatique',
	'verstexte:description' => '2 filtres pour tes squelettes, permettant de produire des pages plus légères.
_ version_texte : extrait le contenu texte d\'une page html à l\'exclusion de quelques balises élémentaires.
_ version_plein_texte : extrait le contenu texte d\'une page html pour rendre du texte brut.',
	'verstexte:nom' => 'Version texte',
	'visiteurs_connectes:description' => 'Offre une noisette pour ton squelette qui affiche le nombre de visiteurs connectés sur le site public.

Ajoute simplement <code><INCLURE{fond=fonds/visiteurs_connectes}></code> dans tes pages.',
	'visiteurs_connectes:nom' => 'Visiteurs connectés',
	'voir' => 'Voir : @voir@',
	'votre_choix' => 'Ton choix :',

	// W
	'webmestres:description' => 'Un {{webmestre}} au sens SPIP est un {{administrateur}} ayant acc&egrave;s &agrave; l\'espace FTP. Par d&eacute;faut et &agrave; partir de SPIP 2.0, il est l\'administrateur <code>id_auteur=1</code> du site. Les webmestres ici d&eacute;finis ont le privil&egrave;ge de ne plus &ecirc;tre oblig&eacute;s de passer par FTP pour valider les op&eacute;rations sensibles du site, comme la mise &agrave; jour de la base de donn&eacute;es ou la restauration d’un dump.

Webmestre(s) actuel(s) : {@_CS_LISTE_WEBMESTRES@}.
_ Administrateur(s) &eacute;ligible(s) : {@_CS_LISTE_ADMINS@}.

En tant que webmestre toi-m&ecirc;me, tu as ici les droits de modifier cette liste d\'ids -- s&eacute;par&eacute;s par les deux points &laquo;&nbsp;:&nbsp;&raquo; s\'ils sont plusieurs. Exemple : &laquo;1:5:6&raquo;.[[%webmestres%]]',
	'webmestres:nom' => 'Liste des webmestres',

	// X
	'xml:description' => 'Active le validateur xml pour l\'espace public tel qu\'il est décrit dans la [documentation->http://www.spip.net/fr_article3541.html]. Un bouton intitulé « Analyse XML » est ajouté aux autres boutons d\'administration.',
	'xml:nom' => 'Validateur XML'
);

?>
