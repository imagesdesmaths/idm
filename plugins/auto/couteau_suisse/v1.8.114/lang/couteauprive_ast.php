<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=ast
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ': non',
	'2pts_oui' => ': sí',

	// S
	'SPIP_liens:description' => '@puce@ Tolos enllaces del sitiu abrense por omisión nel ventanu de ñavegación actual. Pero pue ser amañoso abrir los enllaces esternos al sitiu nun ventanu esterior nuevu -- lo que lleva a amesta-yos {target=\\"_blank\\"} a toles balices &lt;a&gt; a les que SPIP conseña les clases {spip_out}, {spip_url} o {spip_glossaire}. Pue ser necesario amesta-yos una d\'estes clases a los enllaces de la cadarma del sitiu (archivos html) pa estender al másimu esta carauterística.[[%radio_target_blank3%]]

@puce@ SPIP permite enllazar les pallabres cola so definición gracies a l\'atayu tipográficu <code>[?pallabra]</code>. Por omisión (o si dexes vacía la caxina d\'embaxo), el glosariu esternu empobina pa la enciclopedia llibre wikipedia.org. A to eleición l\'enllaz a utilizar. <br />Enllaz de preba: [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP tien previstu un estilu CSS pa los enllaces «~mailto:»: un sobre pequeñu tendría que apaecer delantre de cada enllaz lligau a un corréu; pero como hai ñavegadores que nun puen amosalo (notablemente IE6, IE7 y SAF3), tú decides si quies mantener esta carauterística.
_ Enllaz de preba: [->test@test.com] (recarga la páxina pa prebar).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP y los enllaces… esternos',
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
	'acces_admin' => 'Accesu alministraores:',
	'action_rapide' => 'Aición rápida, ¡únicamente si sabes lo que tas faciendo!',
	'action_rapide_non' => 'Aición rápida, disponible de magar que actives esta ferramienta:',
	'admins_seuls' => 'Namái los alministradores',
	'aff_tout:description' => 'Il parfois utile d\'afficher toutes les rubriques ou tous les auteurs de votre site sans tenir compte de leur statut (pendant la période de développement par exemple). Par défaut, SPIP n\'affiche en public que les auteurs et les rubriques ayant au moins un élément publié.

Bien qu\'il soit possible de contourner ce comportement à l\'aide du critère [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], cet outil automatise le processus et vous évite d\'ajouter ce critère à toutes les boucles RUBRIQUES et/ou AUTEURS de vos squelettes.', # NEW
	'aff_tout:nom' => 'Affiche tout', # NEW
	'alerte_urgence:description' => 'Affiche en tête de toutes les pages publiques un bandeau d\'alerte pour diffuser le message d\'urgence défini ci-dessous.
_ Les balises <code><multi/></code> sont recommandées en cas de site multilingue.[[%alerte_message%]]', # NEW
	'alerte_urgence:nom' => 'Message d\'alerte', # NEW
	'attente' => 'N\'espera...',
	'auteur_forum:description' => 'Encamienta a tolos autores de mensaxes públicos escribir (¡polo menos una lletra!) nel campu «@_CS_FORUM_NOM@» col fin d\'evitar los mensaxes totalmente anónimos.', # MODIF
	'auteur_forum:nom' => 'Ensin foros anónimos',
	'auteur_forum_deux' => 'Ou, au moins l\'un des deux champs précédents', # NEW
	'auteur_forum_email' => 'Le champ «@_CS_FORUM_EMAIL@»', # NEW
	'auteur_forum_nom' => 'Le champ «@_CS_FORUM_NOM@»', # NEW
	'auteurs:description' => 'Esta ferramienta configura l\'aspeutu de [la páxina de los autores->./?exec=auteurs], na parte privada.

@puce@ Define equí el númberu másimu d\'autores a amosar nel cuadru central de la páxina d\'autores. Darréu, afítarase una compaxinación.[[%max_auteurs_page%]]

@puce@ ¿Qué estatutos d\'autor puen llistase nesta páxina?
[[%auteurs_tout_voir%]][[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]', # MODIF
	'auteurs:nom' => 'Páxina d\'autores',
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
	'basique' => 'Básica',
	'blocs:aide' => 'Bloques Desplegables: <b><bloc></bloc></b> (alias: <b><invisible></invisible></b>) y <b><visible></visible></b>',
	'blocs:description' => 'Te permite crear bloques que puen facese visibles o invisibles al calcar nel so títulu.

@puce@ {{Nos testos SPIP}}: los redactores disponen de les nueves balices &lt;bloc&gt; (o &lt;invisible&gt;) y &lt;visible&gt; pa utilizar nos testos así: 

<quote><code>
<bloc>
 Un títulu nel que podrá calcase
 
 El testu a anubrir/amosar, tres dos saltos de llinia...
 </bloc>
</code></quote>

@puce@ {{Nes cadarmes}}: dispones de les nueves balices #BLOC_TITRE, #BLOC_DEBUT y #BLOC_FIN pa utilizar así: 
<quote><code> #BLOC_TITRE o #BLOC_TITRE{mio_URL}
 Mio títulu
 #BLOC_RESUME    (opcional)
 una versión en resume del bloque siguiente
 #BLOC_DEBUT
 El mio bloque estenderexable (que contendrá la URL a la que apunta si fai falta)
 #BLOC_FIN</code></quote>

@puce@ Si marques «si» embaxo, l\'apertura d\'un bloque provocará que se zarren tolos demás bloques de la páxina, col envís de nun tener más qu\'un solu abiertu a la vez.[[%bloc_unique%]]

@puce@ si marques «sí» embaxo, l\'estáu de los bloques numberaos atroxarase nuna cookie demientres la sesion, pa conservar l\'aspeutu de la páxina en casu de volver.[[%blocs_cookie%]]

@puce@ La Navaya Suiza utiliza por omisión la etiqueta HTML &lt;h4&gt; pal títulu de los bloques estenderexables. Equí pue escoyese otra etiqueta &lt;hN&gt;: [[%bloc_h4%]]', # MODIF
	'blocs:nom' => 'Bloques Desplegables',
	'boites_privees:description' => 'Toes les caxes descrites embaxo apaecen per dayuri na parte privada.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Les revisiones de La Navaya Suiza}}: un cuadru na presente páxina de configuración, que indica les caberes modificaciones amestáes al códigu del plugin ([Source->@_CS_RSS_SOURCE@]).
- {{Los artículos en formatu SPIP}}: un cuadru estenderexable suplementariu pa los artículos, col envís de saber el códigu fonte utilizao polos autores.
- {{Estadístiques de los autores}}: un cuadru estenderexable suplementariu na [páxina de los autores->./?exec=auteurs] que amuesa los caberos 10 coneutaos y les inscripciones nun confirmáes. Sólo los alministradores ven esta información.
- {{Los webmasters SPIP}}: un cuadru estenderexable na [páxina de los autores->./?exec=auteurs] que amuesa los alministradores elevaos al rangu de webmaster SPIP. Sólo los alministradores puen ver etas información. Si yes webmaster tú mesmu, mira también la ferramienta «[.->webmasters]».
- {{Les URLs propies}}: un cuadru estenderexable pa cada oxetu de conteníu (artículu, estaya, autor, ...) que indica la URL propia asociada igual que los eventuales nomatos. La ferramienta «[.->type_urls]» te permite l\'axuste finu de les URLs del to sitiu.
- {{L\'orde d\'autores}}: un cuadru estenderexable pa los artículos que tengan más d\'un autor y que permite axustar facilmente l\'orde en que s\'amuesen.', # MODIF
	'boites_privees:nom' => 'Caxes privaes',
	'bp_tri_auteurs' => 'Ordenaciones d\'autores',
	'bp_urls_propres' => 'Les URLs propies',
	'brouteur:description' => 'Utilizar el selector d\'estaya n\'AJAX a partir de %rubrique_brouteur% estaya(es)', # MODIF
	'brouteur:nom' => 'Axuste del selector d\'estaya', # MODIF

	// C
	'cache_controle' => 'Control de la caché',
	'cache_nornal' => 'Usu normal',
	'cache_permanent' => 'Caché permanente',
	'cache_sans' => 'Ensin caché',
	'categ:admin' => '1. Alministración',
	'categ:devel' => '55. Développement', # NEW
	'categ:divers' => '60. Diversos',
	'categ:interface' => '10. Interfaz privada',
	'categ:public' => '40. Asoleyamientu públicu',
	'categ:securite' => '5. Sécurité', # NEW
	'categ:spip' => '50. Balices, filtros, criterios',
	'categ:typo-corr' => '20. Meyores de los testos',
	'categ:typo-racc' => '30. Atayos tipográficos',
	'certaines_couleurs' => 'Sólo les balices definies embaxo@_CS_ASTER@ :',
	'chatons:aide' => 'Emoticonos: @liste@',
	'chatons:description' => 'Inxerta imaxes (o emoticonos pa los {chats}) en tolos testos nos que apaeza una cadena de tipu <code>:nome</code>.
_ Esta ferramienta camuda esos atayos poles imaxes del mesmu nome qu\'alcuentre nel direutoriu <code>mon_squelette_toto/img/chatons/</code> o, por omisión, nel direutoriu <code>couteau_suisse/img/chatons/</code>.', # MODIF
	'chatons:nom' => 'Emoticonos',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de votre site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour à la ligne. En effet, les citations courtes doivent être entourées par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.', # NEW
	'citations_bb:nom' => 'Citations bien balisées', # NEW
	'class_spip:description1' => 'Equí vas poder definir dellos atayos de SPIP. Un valor vacíu ye lo mesmo que utilizar el valor por omisión.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Los atayos de SPIP}}.

Equí vas poder definir dellos atayos de SPIP. Un valor vacíu ye igual que utilizar el valor por omisión.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{Atención: si la ferramienta «[.->pucesli]» ta activada, el remplazu del guión « - » nun s\'efeutua; nel so llugar se utilizará una llista &lt;ul>&lt;li>.}

SPIP utiliza habitualmente la etiqueta &lt;h3&gt; pa los intertítulos. Escueye equí otra si quiés cambeala:[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP escueye utilizar la marca&lt;strong> pa trescribir les negrines. Pero &lt;b> podría convenir lo mesmo, con o ensin estilu. Como tú lo veas: [[%racc_g1%]][[->%racc_g2%]]

SPIP escueye utilizar la marca &lt;i> pa trescribir les itáliques. Pero &lt;em> podría convenir lo mesmo, con o ensin estilu. Como tú lo veas: [[%racc_i1%]][[->%racc_i2%]]

 Lo mesmo puedes definir el códigu d\'apertura y zarre pa les llamáes a notes de pie de páxina (¡Atención! Les modificaciones nun van vese más que nel espaciu públicu.): [[%ouvre_ref%]][[->%ferme_ref%]]
 
 Puedes definir el códigu d\'apertura y zarre pa les notes de pie de páxina: [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{Los estilos por omisión de SPIP}}. Hasta la versión 1.92 de SPIP, los atayos tipográficos producíen balices col estilu \\"spip\\" conseñáu por sistema. Por exemplu: <code><p class=\\"spip\\"></code>. Equí pues definir l\'estilu d\'estes balices en función de les tos fueyes d\'estilu. Una caxa vacía significa que nun va aplicase dengún estilu en particular.

{Atención: si se cambearon más enriba dellos atayos (llinia horizontal, intertítulu, itálica, negrina), los estilos d\'embaxo nun s\'aplicarán.}

<q1>
_ {{1.}} Balices &lt;p&gt;, &lt;i&gt;, &lt;strong&gt;:[[%style_p%]]
_ {{2.}} Balices &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; y les llistes (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Decátate: al modificar esti segundu estilu, pierdes los estilos estándar de SPIP asociaos con eses balices.</q1>', # MODIF
	'class_spip:nom' => 'SPIP y los sos atayos…',
	'code_css' => 'CSS',
	'code_fonctions' => 'Funciones',
	'code_jq' => 'jQuery',
	'code_js' => 'JavaScript',
	'code_options' => 'Opciones',
	'code_spip_options' => 'Opciones de SPIP',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie privée', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options précédentes)', # NEW
	'contrib' => 'Más info: @url@',
	'copie_vers' => 'Copie vers : @dir@', # NEW
	'corbeille:description' => 'SPIP desanicia automáticamente los oxetos tiraos a la basoria en pasando 24 hores, en xeneral hacia les 4 de la mañana, gracies a un trabayu «CRON» (llanzamientu periódicu y/o automáticu de procesos preprogramaos). Equí pues encaboxar esi procesu col fin de xestionar meyor la papelera.[[%arret_optimisation%]]',
	'corbeille:nom' => 'La papelera',
	'corbeille_objets' => '@nb@ oxeto(s) na papelera.',
	'corbeille_objets_lies' => '@nb_lies@ enllaz(es) detectao(s).',
	'corbeille_objets_vide' => 'Nun hai oxetos na papelera', # MODIF
	'corbeille_objets_vider' => 'Desaniciar los oxetos seleicionaos',
	'corbeille_vider' => 'Vaciar la papelera:',
	'couleurs:aide' => 'Poner de colores: <b>[coul]testu[/coul]</b>@fond@ siendo <b>coul</b> = @liste@',
	'couleurs:description' => 'Permite aplica-yos facilmente colores a tolos testos del sitiu (artículos, breves, títulos, foru, …) utilizando balices en atayos.

Dos exemplos idénticos pa camudar la color del testu:@_CS_EXEMPLE_COULEURS2@

Idem pa camudar el fondu, si la opción d\'embaxo lo permite:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@El formatu d\'estes balices personalizaes tien que llistar les colores esistentes o definir pareyes «baliza=color», too separtao por comes. Exemplos : «gris, bermeyo», «suave=mariello, fuerte=bermeyo», «baxu=#99CC11, altu=brown» o también «gris=#DDDDCC, bermeyo=#EE3300». Pal primer y l\'últimu exemplu, les balices autorizaes son: <code>[gris]</code> y <code>[bermeyo]</code> (<code>[fond gris]</code> y <code>[fond bermeyo]</code> si los fondos tan permitíos).', # MODIF
	'couleurs:nom' => 'Too en collores',
	'couleurs_fonds' => ', <b>[fond coul]testu[/coul]</b>, <b>[bg coul]testu[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Atopa bayurosa información tocante al funcionamentu de la Navaya Suiza nos archivos {spip.log} que puen alcontrase nel direutoriu: {@_CS_DIR_TMP@}[[%log_couteau_suisse%]]

@puce@ {{Opciones SPIP.}} SPIP ordena los plugins siguiendo un orde específicu. A la fin de tar seguru que la Navaya Suiza sea el primeru pa remanar dende ehí delles opciones de SPIP, marca la opción siguiente. Si los permisos del sirvidor lo permiten, l\'archivu {@_CS_FILE_OPTIONS@} camudarase automáticamente pa amesta-y l\'archivu {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php}.
[[%spip_options_on%]]

@puce@ {{Peticiones esternes.}} La Navaya Suiza compreba davezu la esistencia d\'una versión más reciente del so códigu e informa na páxina de configuración si hubiera una actualización disponible. Si les peticiones esternes del to sirvidor dan problemes, marca la caxa siguiente.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'Comportamientu de la Navaya Suiza',
	'cs_comportement_ko' => '{{Note :}} ce paramètre requiert un filtre de gravité réglé à plus de @gr2@ au lieu de @gr1@ actuellement.', # NEW
	'cs_distant_off' => 'Les comprebaciones de versiones distintes',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => 'Los rexistros detallaos de la Navaya Suiza',
	'cs_reset' => '¿Confirmes que quiés reaniciar dafechu la Navaya Suiza?',
	'cs_reset2' => 'Toles ferramientes actualmente actives van desactivase y van reaniciase sos parámetros.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher «<html>@_CS_FILE_OPTIONS@</html>» a échoué !', # NEW
	'cs_spip_options_on' => 'Les opciones de SPIP en «@_CS_FILE_OPTIONS@»', # MODIF

	// D
	'decoration:aide' => 'Decoración: <b>&lt;baliza&gt;test&lt;/baliza&gt;</b>, con <b>baliza</b> = @liste@',
	'decoration:description' => 'Nuevos estilos paramétricos nos testos que son accesibles gracies a balices ente signos angulares. Exemplu: 
&lt;miobaliza&gt;testu&lt;/miobaliza&gt; o: &lt;miobaliza/&gt;.<br />Define embaxo los estilos CSS que necesites, una baliza per llinia, según les sintaxis siguientes :
- {type.miobaliza = mio estilu CSS}
- {type.miobaliza.class = mio clase CSS}
- {type.miobaliza.lang = mio llingua (p.ex: ast)}
- {unalias = miobaliza}

El parámetru {type} d\'enriba pue tener tres valores:
- {span}: baliza nel interior d\'un párrafu (type Inline)
- {div} : baliza que crea un párrafu nuevu (type Block)
- {auto} : baliza determinada automáticamente pol plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Decoración',
	'decoupe:aide' => 'Bloque de llingüetes : <b>&lt;onglets>&lt;/onglets></b><br/>Separtador de páxines o de llingüetes: @sep@', # MODIF
	'decoupe:aide2' => 'Alias: @sep@',
	'decoupe:description' => '@puce@ Divide la presentación pública d\'un artículu en delles páxines gracies a una paxinación automática. Namái pon nel artículu cuatro signos más consecutivos (<code>++++</code>) nel llugar u vaya tar el corte.

Por omisión, la Navaya Suiza enxerta los númberos de páxina na cabecera y el pie de l\'artículu automáticamente. Pero tienes la posibilidá de poner esti númberu n\'otru llugar de la to cadarma gracies a una baliza #CS_DECOUPE que puedes activar equí:
[[%balise_decoupe%]]

@puce@ Si utilices esti separtaor dientro de les balices &lt;onglets&gt; y &lt;/onglets&gt; vas tener un xueu de llingüetes.

Nes cadarmes: tienes a to disposición les nueves balices #ONGLETS_DEBUT, #ONGLETS_TITRE y #ONGLETS_FIN.

Esta ferramienta puede acoplase con «[.->sommaire]».', # MODIF
	'decoupe:nom' => 'Cortar en páxines y llingüetes',
	'desactiver_flash:description' => 'Desanicia los oxetos flash de les páxines del sitiu web y les camuda pol conteníu alternativu asociau.',
	'desactiver_flash:nom' => 'Desactiva los oxetos flash',
	'detail_balise_etoilee' => '{{Attention}}: Compreba bien l\'usu que faen les cadarmes de les balices con asteriscu. Los procesos d\'esta ferramienta nun s\'aplicarán a: @bal@.',
	'detail_disabled' => 'Paramètres non modifiables :', # NEW
	'detail_fichiers' => 'Archivos:',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'Códigu en llinia:',
	'detail_jquery2' => 'Esta ferramienta necesita la llibrería {jQuery}.', # MODIF
	'detail_jquery3' => '{{Atención}}: esta ferramienta necesita el plugin [jQuery pa SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] pa funcionar correutamente con esta versión de SPIP.',
	'detail_pipelines' => 'Tuberíes:',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_spip_options2' => 'Il est recommandé de placer les options SPIP en amont grâce à l\'outil «[.->cs_comportement]».', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_surcharge' => 'Outil surchargé :', # NEW
	'detail_traitements' => 'Tratamientos:',
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
	'dossier_squelettes:description' => 'Modifica la carpeta de cadarma utilizada. Por exemplu: "squelettes/miocadarma". Pues escribir dellos direutorios separtaos por dos puntos <html>« : »</html>. Si dexes vacíu el cuadru siguiente (o escribiendo "dist"), sedrá la cadarma orixinal "dist" que ufre SPIP la que se use.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Direutoriu de la cadarma',

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
	'effaces' => 'Desaniciaos',
	'en_travaux:description' => 'Permite amosar un mensaxe personalizable, demientres una fase de mantenimientu, en tou el sitiu públicu y, eventualmente na parte privada.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Sitiu n\'obres',
	'erreur:bt' => '<span style=\\"color:red;\\">Atención :</span> la barra tipográfica (versión @version@) paez antigua.<br />La Navaya Suiza ye compatible con una versión mayor o igual a @mini@.', # MODIF
	'erreur:description' => '¡falta la id na definición de la ferramienta!',
	'erreur:distant' => 'el sirvidor remotu',
	'erreur:jquery' => '{{Nota}}: la biblioteca {jQuery} paez inactiva nesta páxina. Has de consultar [equí->http://www.spip-contrib.net/?article2166] el párrafu so les dependencies del plugin o recargar esta páxina.',
	'erreur:js' => 'Paez que hubo un error de JavaScript nesta páxina que torga el so bon funcionamientu. Has de activar JavaScript nel to ñavegador o desactivar dellos plugins SPIP del to sitiu.',
	'erreur:nojs' => 'El JavaScript ta desactiváu nesta páxina.',
	'erreur:nom' => '¡Fallu!',
	'erreur:probleme' => 'Problema en: @pb@',
	'erreur:traitements' => 'La Navaya Suiza - Error de compilación de los tratamientos: ¡la mestura de \'typo\' y \'propre\' ta torgada!',
	'erreur:version' => 'Esta ferramienta nun ta disponible pa esta versión de SPIP.',
	'erreur_groupe' => 'Attention : le groupe «@groupe@» n\'est pas défini !', # NEW
	'erreur_mot' => 'Attention : le mot-clé «@mot@» n\'est pas défini !', # NEW
	'etendu' => 'Estendíu',

	// F
	'f_jQuery:description' => 'Torga l\'instalación de {jQuery} na parte pública col envís d\'aforrar un poco de «tiempu de máquina». Esta biblioteca ([->http://jquery.com/]) aporta enforma de comodidá na programación de JavaScript y pue utilizase por ciertos plugins. SPIP lo utiliza na so parte privada.

Atención: delles ferramientes de la Navaya Suiza necesiten les funciones de {jQuery}. ', # MODIF
	'f_jQuery:nom' => 'Desactiva jQuery',
	'filets_sep:aide' => 'Moldures de Dixebra: <b>__i__</b> onde <b>i</b> ye un númberu.<br />Otres moldures disponibles: @liste@', # MODIF
	'filets_sep:description' => 'Amesta moldures de dixebra, personalizables con les fueyes d\'estilu, en tolos testos de SPIP.
_ La sintaxis ye: "__code__", onde "code" representa o el númberu d’identificación (de 0 à 7) de la moldura a amestar en relación direuta colos estilos correspondientes, o el nome d\'una imaxe allugada nel direutoriu plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Moldures de Dixebra',
	'filtrer_javascript:description' => 'Pa xestionar l\'enxertu de JavaScript nos artículos, hai tres modos disponibles:
- <i>enxamás</i>: el JavaScript refugase siempre
- <i>omisión</i>: el JavaScript márcase en roxu nel espaciu priváu
- <i>siempre</i>: el JavaScript aceptase siempre.

Atención: nos foros, solicitudes, fluxos sindicaos, etc., la xestión del JavaScript ye <b>siempre</b> en mou seguru.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Xestión del JavaScript',
	'flock:description' => 'Desactiva el sistema de bloquéu d\'archivos neutralizando la función PHP {flock()}. Dellos agospiamientos causen problemes graves por cuenta d\'un sistema d\'archivos inadautáu que carez de perda de sincronización. Nun actives esta ferramienta si el sitiu funciona normalmente.',
	'flock:nom' => 'Ensin bloquéu d\'archivos',
	'fonds' => 'Fondos:',
	'forcer_langue:description' => 'Fuerza el contestu de llingua pa los xuegos de cadarmes multillingües que tengan un formulariu o un menu de llingües que sepa xestionar la cookie de llingües.

Téunicamente, l\'efeutu d\'esta ferramienta ye:
- desactivar la gueta d\'una cadarma en función de la llingua de l\'oxetu,
- desactivar el criteriu <code>{lang_select}</code> automáticu pa los oxetos clásicos (artículos, breves, estayes, etc... ).

Los bloques multi s\'amuesen siempre na llingua pidía pol visitante.', # MODIF
	'forcer_langue:nom' => 'Forzar llingua',
	'format_spip' => 'Los artículos en formatu SPIP',
	'forum_lgrmaxi:description' => 'Por omisión, los mensaxes del foru nun tienen llendes de tamañu. Si se activa esta ferramienta, va amosase un mensaxe d\'error cuando daquién quiera mandar un mensaxe de tamañu superior al valor conseñáu, y el mensaxe refugarase. Un valor vacíu o igual a 0 significa que nun s\'aplica llende dala.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Tamañu de los foros',

	// G
	'glossaire:aide' => 'Testu ensin glosariu: <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Xestión d’un glosariu internu enllazáu con un o más groupes de pallabres-clave. Escribe equí el nome de los grupos separtándolos con dos puntos «:». Si se dexa vacía la caxa siguiente (o escribiendo "Glossaire"),sedrá el grupu "Glossaire" el que va utilizase.[[%glossaire_groupes%]]

@puce@ Pa cada pallabra, ties la posibilidá d\'escoyer el númberu másimu d\'enllaces creaos nos testos. Tou valor nulu o negativu implica que toes les pallabres reconocíes van tratase. [[%glossaire_limite% par mot-clé]]

@puce@ Ufrense dos soluciones pa xenerar el ventanucu automáticu que apaez cuando pases el mur enriba la pallabra. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Glosariu internu',
	'glossaire_abbr' => 'Ignorer les balises <code><abbr></code> et <code><acronym></code>', # NEW
	'glossaire_css' => 'Solución CSS',
	'glossaire_erreur' => 'Le mot «@mot1@» rend indétectable le mot «@mot2@»', # NEW
	'glossaire_inverser' => 'Correction proposée : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Solución JavaScript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) étudié(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Camuda automáticamente les comines dereches (") por les comines tipográfiques de la llingua de composición. El cambéu, tresparente pa l\'usuariu, nun camuda el testu orixinal sinon sólo l\'aspeutu final.',
	'guillemets:nom' => 'Comines tipográfiques',

	// H
	'help' => '{{Esta páxina únicamente ye accesible pa los responsables del sitiu.}}<p>Da accesu a les diferentes funciones suplementaries aportáes pol plugin «{{La Navaya Suiza}}».',
	'help2' => 'Versión local: @version@',
	'help3' => '<p>Enllaces de documentación :<br/>• [La Navaya Suiza->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Reentamos:
_ • [De les ferramientes tapecíes|Tornar a l\'apariencia inicial d\'esta páxina->@hide@]
_ • [De tol plugin|Tornar a l\'estáu inicial del plugin->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Ferramienta en cursu de desendolcu. Ufre un reló JavaScript . Baliza: <code>#HORLOGE{format,utc,id}</code>. Modelu: <code><horloge></code>', # MODIF
	'horloge:nom' => 'Reló',

	// I
	'icone_visiter:description' => 'Cambéa la imaxe del botón estándar «Visitar» (enriba a la derecha d\'esta páxina) pol logo del sitiu, si esiste.

Pa definir esti logo, vete a la páxina de «Configuración del sitiu» calcando nel botón «Configuración».', # MODIF
	'icone_visiter:nom' => 'Botón «Visitar»', # MODIF
	'insert_head:description' => 'Activa automáticamente la baliza [#INSERT_HEAD->http://www.spip.net/fr_article1902.html] en toes les cadarmes, da igual que tengan o non esta baliza ente &lt;head&gt; y &lt;/head&gt;. Gracies a esta opción, los plugins podrán enxertar JavaScript (.js) o fueyes d\'estilu (.css).',
	'insert_head:nom' => 'Baliza #INSERT_HEAD',
	'insertions:description' => 'ATENCIÓN: ¡¡ferramienta en cursu de desendolcu!! [[%insertions%]]',
	'insertions:nom' => 'Correiciones automátiques',
	'introduction:description' => 'Esta baliza pa amestar nes cadarmes sirve en xeneral pa la portada o pa les estayes col env&iacute;s de producir un resume de art&iacute;culos, de breves, etc...</p>
<p>{{Atenci&oacute;n}}: Enantes d\'activar esta funci&oacute;n, compreba bien que denguna funci&oacute;n {balise_INTRODUCTION()} nun esista ya na cadarma o nos plugins, la sobrecarga producir&iacute;a un error de compilaci&oacute;n.</p>
@puce@ Puedes precisar (en porcentaxe relativu del valor utiliz&aacute;u por omisi&oacute;n) el llargu del testu devueltu pela baliza #INTRODUCTION. Un valor nulu o igual a 100 nun modifica l\'aspeutu de la introducci&oacute;n utilizando ent&oacute;s los valores por omisi&oacute;n siguientes: 500 carauteres pa los art&iacute;culos, 300 pa les breves y 600 pa los foros o les estayes.
[[%lgr_introduction%&nbsp;%]]
@puce@ Por omisi&oacute;n, los puntos de siguir amestaos al resultau de la baliza #INTRODUCTION si el testu ye enforma llargu son: <html>&laquo;&amp;nbsp;(…)&raquo;</html>. Equ&iacute; pues conse&ntilde;ar una cadena de carauteres propia que indique al llector que el testu cort&aacute;u tien una continuaci&oacute;n.
[[%suite_introduction%]]
@puce@ Si la baliza #INTRODUCTION util&iacute;zase pa resumir un art&iacute;culu, la Navaya Suiza pue fabricar un enllaz d\'hipertestu pa amestar a los puntos de siguir definios enriba, col fin de llevar al llector al testu orixinal. Por exemplu: &laquo;Lleer el restu de l\'art&iacute;culu…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'Baliza #INTRODUCTION',

	// J
	'jcorner:description' => '«Esquines guapes» ye una ferramienta que permite cambear facilmente l\'aspeutu de les esquines de los {{cuadros coloreaos}} na parte pública del to sitiu. ¡Too ye posible, o cuasique!
_ Mira el resultáu nesta páxina: [->http://www.malsup.com/jquery/corner/].

Llista embaxo los oxetos de la cadarma a redondiar utilizando la sintaxis CSS (.class, #id, etc. ). Utiliza el signu «=» pa especificar la orde jQuery a utilizar y una barra doble («//») pa los comentarios. Si nun hai signu igual, aplicaranse esquines redondes (equivalente a: <code>.mio_clase = .corner()</code>).[[%jcorner_classes%]]

Atención, esta ferramienta necesita pa funcionar el plugin {jQuery} : {Round Corners}. La Navaya Suiza pue instalalu direutamente si marques el cuadru siguiente. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Esquines Guapes',
	'jcorner_plugin' => '«plugin Round Corners»',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Por omisión',
	'js_jamais' => 'Enxamás',
	'js_toujours' => 'Siempre',
	'jslide_aucun' => 'Aucune animation', # NEW
	'jslide_fast' => 'Glissement rapide', # NEW
	'jslide_lent' => 'Glissement lent', # NEW
	'jslide_millisec' => 'Glissement durant :', # NEW
	'jslide_normal' => 'Glissement normal', # NEW

	// L
	'label:admin_travaux' => 'Zarrar el sitiu públicu por:',
	'label:alinea' => 'Champ d\'application :', # NEW
	'label:alinea2' => 'Sauf :', # NEW
	'label:alinea3' => 'Désactiver la prise en compte des alinéas :', # NEW
	'label:arret_optimisation' => 'Torgar que SPIP vacíe la papelera automáticamente:',
	'label:auteur_forum_nom' => 'Le visiteur doit spécifier :', # NEW
	'label:auto_sommaire' => 'Creación sistemática del sumariu:',
	'label:balise_decoupe' => 'Activar la baliza #CS_DECOUPE:',
	'label:balise_sommaire' => 'Activar la baliza #CS_SOMMAIRE:',
	'label:bloc_h4' => 'Etiqueta HTML pa los títulos:',
	'label:bloc_unique' => 'Solo un bloque abiertu na páxina:',
	'label:blocs_cookie' => 'Utilización de cookies:',
	'label:blocs_slide' => 'Type d\'animation :', # NEW
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal réservé aux copies locales :', # NEW
	'label:couleurs_fonds' => 'Permitir los fondos:',
	'label:cs_rss' => 'Activar:',
	'label:debut_urls_propres' => 'Entamu de les URLs:',
	'label:decoration_styles' => 'Les tos balices d\'estilu personalizáu:',
	'label:derniere_modif_invalide' => 'Recalcular xusto dempués d\'un cambéu:',
	'label:devdebug_espace' => 'Filtrage de l\'espace concerné :', # NEW
	'label:devdebug_mode' => 'Activer le débogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoyé :', # NEW
	'label:distant_off' => 'Desactivar:',
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Direutoriu(os) a utilizar:',
	'label:duree_cache' => 'Duración de la caché local:',
	'label:duree_cache_mutu' => 'Duración de la caché en mutualización:',
	'label:enveloppe_mails' => 'Sobre pequeñu delantre los correos:',
	'label:expo_bofbof' => 'Escribir como exponentes: <html>St(e)(s), Bx, Bd(s) y Fb(s)</html>',
	'label:filtre_gravite' => 'Gravité maximale acceptée :', # NEW
	'label:forum_lgrmaxi' => 'Valor (en carauteres):',
	'label:glossaire_groupes' => 'Grupu(os) utilizao(s):',
	'label:glossaire_js' => 'Téunica utilizada:',
	'label:glossaire_limite' => 'Númberu másimu d\'enllaces creaos:',
	'label:i_align' => 'Alignement du texte :', # NEW
	'label:i_couleur' => 'Couleur de la police :', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (éq. à {line-height}) :', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte :', # NEW
	'label:i_padding' => 'Espacement autour du texte (éq. à {padding}) :', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/}) :', # NEW
	'label:i_taille' => 'Taille de la police :', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Correiciones automátiques:',
	'label:jcorner_classes' => 'Meyorar los requexos de les seleiciones siguientes:',
	'label:jcorner_plugin' => 'Instalar el plugin {jQuery} siguiente:',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'Estensión del resume:',
	'label:lgr_sommaire' => 'Estensión del sumariu (9 a 99):',
	'label:lien_introduction' => 'Puntos suspensivos calcables:',
	'label:liens_interrogation' => 'Protexer les URLs:',
	'label:liens_orphelins' => 'Enllaces calcables:',
	'label:log_couteau_suisse' => 'Activar:',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:long_url' => 'Longueur du libellé cliquable :', # NEW
	'label:marqueurs_urls_propres' => 'Amestar los marcadores que dixebren los oxetos (SPIP>=2.0) :<br/>(ex. : « - » pa -Mio-estaya-, « @ » pa @Mio-sitiu@) ', # MODIF
	'label:max_auteurs_page' => 'Autores por páxina:',
	'label:message_travaux' => 'El mensaxe de mantenimientu:',
	'label:moderation_admin' => 'Validar automáticamente los mensaxes de los: ',
	'label:mot_masquer' => 'Mot-clé masquant les contenus :', # NEW
	'label:nombre_de_logs' => 'Rotation des fichiers :', # NEW
	'label:ouvre_note' => 'Apertura y zarre de les notes de pie de páxina',
	'label:ouvre_ref' => 'Apertura y zarre de les llamáes a notes de pie de páxina',
	'label:paragrapher' => 'Facer párrafos siempre:',
	'label:prive_travaux' => 'Accesibilidá de l\'espaciu priváu por:',
	'label:prof_sommaire' => 'Profondeur retenue (1 à 4) :', # NEW
	'label:puce' => 'Marca pública «<html>-</html>»:',
	'label:quota_cache' => 'Valor de la cuota:',
	'label:racc_g1' => 'Entrada y salida pa poner en «<html>{{negrina}}</html>»:',
	'label:racc_h1' => 'Entrada y salida pa un «<html>{{{intertítulu}}}</html>»:',
	'label:racc_hr' => 'Llinia horizontal «<html>----</html>»:',
	'label:racc_i1' => 'Entrada y salida pa conseñar escritura en «<html>{itáliques}</html>»:',
	'label:radio_desactive_cache3' => 'Usu de la caché:',
	'label:radio_desactive_cache4' => 'Usu de la caché:',
	'label:radio_target_blank3' => 'Ventanu nuevu pa los enllaces esternos:',
	'label:radio_type_urls3' => 'Formatu de les URLs:',
	'label:scrollTo' => 'Instalar los plugins {jQuery} siguientes:',
	'label:separateur_urls_page' => 'Carauter de separación \'type-id\'<br/>(p.ex.: ?article-123):', # MODIF
	'label:set_couleurs' => 'Xuegu a utilizar:',
	'label:spam_ips' => 'Adresses IP à bloquer :', # NEW
	'label:spam_mots' => 'Secuencies torgáes:',
	'label:spip_options_on' => 'Incluir:',
	'label:spip_script' => 'Script de llamada:',
	'label:style_h' => 'El to estilu:',
	'label:style_p' => 'El to estilu:',
	'label:suite_introduction' => 'Puntos de siguir:',
	'label:terminaison_urls_page' => 'Terminación de les URLs (p.ex.: «.html»):',
	'label:titre_travaux' => 'Títulu del mensaxe:',
	'label:titres_etendus' => 'Activar l\'usu estendíu de les balices #TITRE_XXX:',
	'label:tout_rub' => 'Afficher en public tous les objets suivants :', # NEW
	'label:url_arbo_minuscules' => 'Conservar les mayúscules de los títulos nes URLs:',
	'label:url_arbo_sep_id' => 'Carauter de separación \'titre-id\' en casu de duplicaos :<br/>(nun uses \'/\')', # MODIF
	'label:url_glossaire_externe2' => 'Enllaz al glosariu esternu:',
	'label:url_max_propres' => 'Longueur maximale des URLs (caractères) :', # NEW
	'label:urls_arbo_sans_type' => 'Amosar el tipu d\'oxetu SPIP nes URLs:',
	'label:urls_avec_id' => 'Una id sistemática, sicasí...',
	'label:webmestres' => 'Llista de los webmasters del sitiu:',
	'liens_en_clair:description' => 'Ponte a disposición el filtru: \'liens_en_clair\'. El testu probablemente tien enllaces d\'hipertestu que nun son visibles al imprentar. Esti filtru amesta ente corchetes el destín de cada enllaz calcable (enllaces esternos o mails). Atención: nel mou impresión (parámetru \'cs=print\' o \'page=print\' na URL de la páxina), esti funcionamientu aplícase automáticamente.',
	'liens_en_clair:nom' => 'Enllaces en claro',
	'liens_orphelins:description' => 'Esta ferramienta tien dos funciones:

@puce@ {{Enllaces correutos}}.

SPIP tien el vezu d\'inxertar un espaciu enantes de los signos d\'interrogación o d\'esclamación y camudar el guión doble en cuadráu, como manda la tipografía francesa. Pero esto afeuta a les URL de los testos. Esta ferramienta permite protexeles.[[%liens_interrogation%]]

@puce@ {{Enllaces güérfanos}}.

Camuda sistemáticamente toles URLs puestes como testu polos usuarios (especialmente nos foros) y que nun son poro calcables, por enllaces d\'hipertestu en formatu SPIP. Por exemplu: {<html>www.spip.net</html>} reemplázase por [->www.spip.net].

Pues escoyer el tipu de reemplazu:
_ • {Básicu}: camúdense los enllaces del tipu {<html>http://spip.net</html>} (tolos protocolos) o {<html>www.spip.net</html>}.
_ • {Estendíu} : camúdense amás los enllaces del tipu {<html>usuariu@spip.net</html>}, {<html>mailto:miomail</html>} o {<html>news:miosnews</html>}.
_ • {Predetermináu}: reemplazu automáticu d\'orixe (a partir de la versión 2.0 de SPIP).
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:description1' => '[[Si l\'URL rencontrée dépasse les %long_url% caractères, alors SPIP la réduit à %coupe_url% caractères]].', # NEW
	'liens_orphelins:nom' => 'URLs guapes',
	'local_ko' => 'La mise à jour automatique du fichier local «@file@» a échoué. Si l\'outil dysfonctionne, tentez une mise à jour manuelle.', # NEW
	'log_brut' => 'Données écrites en format brut (non HTML)', # NEW
	'log_fileline' => 'Informations supplémentaires de débogage', # NEW

	// M
	'mailcrypt:description' => 'Mazcarita toos los enllaces de corréu presentes nos testos y los camuda por un enllaz JavaScript que permite lo mesmo activar la mensaxería del llector. Esta ferramienta escontra\'l corréu puxarra tenta torgar que los robots collechen les señes electróniques escrites en claro nos foros o nes balices de les tos cadarmes.',
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
	'message_perso' => 'Candiales gracies a los traductores que pasaren per equí. Pat ;-)',
	'moderation_admins' => 'alministradores autentificaos',
	'moderation_message' => 'Esti foru ta llendáu a priori: lo que vienes de mandar nun apaecerá hasta que tea validáu por un alministrador del sitiu, a menos que teas identificáu y autorizáu a escribir direutamente.',
	'moderation_moderee:description' => 'Permite llendar el llendáu de los foros públicos <b>configuraos a priori</b> polos usuarios inscritos.<br />Exemplu: Si yo soy el webmaster del mio sitiu, y respondo a un mensaxe d\'un usuariu, ¿por qué tengo que validame el mio propiu mensaxe? ¡El llendamientu llendáu failo pa mí! [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Llendamientu llendáu',
	'moderation_redacs' => 'redactores autentificaos',
	'moderation_visits' => 'visitantes autentificaos',
	'modifier_vars' => 'Camudar estos @nb@ parámetros',
	'modifier_vars_0' => 'Camudar esto parámetros',

	// N
	'no_IP:description' => 'Desactiva el mecanismu de grabación automática de les señes IP de los visitantes del sitiu pa mantener la confidencialidá: SPIP ya nun conservará dengún númberu IP, nin temporalmente durante les visites (pa remanar les estadístiques o alimentar spip.log), nin pa los foros (responsabilidá).',
	'no_IP:nom' => 'Ensin guardar la IP',
	'nouveaux' => 'Nuevos',

	// O
	'orientation:description' => '3 nuevos criterios pa les cadarmes: <code>{portrait}</code> (retratu), <code>{carre}</code> (cuadráu) y <code>{paysage}</code> (paisaxe). Ideal pa la clasificación de les fotos en función de la so forma.',
	'orientation:nom' => 'Orientación de les imaxes',
	'outil_actif' => 'Ferramienta activa',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activar',
	'outil_activer_le' => 'Activar la ferramienta',
	'outil_actualiser' => 'Actualiser l\'outil', # NEW
	'outil_cacher' => 'Nun amosar más',
	'outil_desactiver' => 'Desactivar',
	'outil_desactiver_le' => 'Desactivar la ferramienta',
	'outil_inactif' => 'Ferramienta inactiva',
	'outil_intro' => 'Esta páxina llista les carauterístiques que ufre\'l plugin.<br /><br />Calcando nel nome de les ferramientes d\'embaxo, seleiciones los que vas poder camuda-yos l\'estau con l\'aida del botòn central: les ferramientes actives desactívense y <i>viceversa</i>. A cada clic, apaez la descripción embaxo de les llistes. Les categoríes son desplegables y les ferramientes puen tapecese. El doble-clic permite cambear rápidamente de ferramienta.<br /><br />Pal primer usu, encamiéntase activar les ferramientes una a una, por si acasu apaecen incompatibilidaes cola to cadarma, con SPIP o con otros plugins.<br /><br />Nota: la simple carga d\'esta páxina recompila dafechu toes les ferramientes de La Navaya Suiza.',
	'outil_intro_old' => 'Esta interfaz ye antigua.<br /><br />Si alcuentres problemes cola utilización de la <a href=\'./?exec=admin_couteau_suisse\'>interfaz nueva</a>, afalámoste a comentánoslo nel foru de <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@ : @nb@ ferramienta', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ ferramientes', # MODIF
	'outil_permuter' => '¿Camudar la ferramienta: «@text@»?',
	'outils_actifs' => 'Ferramientes actives:',
	'outils_caches' => 'Ferramientes tapecíes:',
	'outils_cliquez' => 'Calca nel nome de les ferramientes d\'embaxo pa amosar equí la descripción.',
	'outils_concernes' => 'Sont concernés : ', # NEW
	'outils_desactives' => 'Sont désactivés : ', # NEW
	'outils_inactifs' => 'Ferramientes inactives:',
	'outils_liste' => 'Llista de ferramientes de la Navaya Suiza',
	'outils_non_parametrables' => 'Ensin variables:',
	'outils_permuter_gras1' => 'Camudar les ferramientes en negrines',
	'outils_permuter_gras2' => '¿Camudar les @nb@ ferramientes en negrines?',
	'outils_resetselection' => 'Reaniciar la seleición',
	'outils_selectionactifs' => 'Seleicionar toles ferramientes actives',
	'outils_selectiontous' => 'TOES',

	// P
	'pack_actuel' => 'Paquete @date@',
	'pack_actuel_avert' => 'Atención, les sobrecargues nos define() o les globales nun se conseñen equí', # MODIF
	'pack_actuel_titre' => 'PAQUETE DE CONFIGURACIÓN ACTUAL DE LA NAVAYA SUIZA',
	'pack_alt' => 'Ver los parámetros de configuración en cursu',
	'pack_delete' => 'Supression d\'un pack de configuration', # NEW
	'pack_descrip' => 'El «Paquete de configuración actual» axunta el conxuntu de parámetros de configuración en cursu de La Navaya Suiza: l\'activación de les ferramientes y el valor de les variables, si ye\'l casu.

Si los permisos d\'escritura lo autoricen, el códigu PHP d\'embaxo podrá amestase nel archivu {{/config/mes_options.php}} apaecerá nesta páxina un enllaz pal reaniciu del paquete «{@pack@}». Y ye dafechu posible camuda-y el nome.

Si reanicies el plugin calcando nun paquete, la Navaya Suiza reconfigurarase automáticamente en función de los parámetros predefinios nesti paquete.', # MODIF
	'pack_du' => '• del paquete @pack@', # MODIF
	'pack_installe' => 'Afitamientu d\'un paquete de configuración',
	'pack_installer' => '¿Tas seguru de que quies reinicializar la Navaya Suiza e instalar el paquete « @pack@ »?',
	'pack_nb_plrs' => 'Actualmente hai @nb@ « paquetes de configuración » disponibles.', # MODIF
	'pack_nb_un' => 'Actualmente hai un « paquete de configuración » disponible', # MODIF
	'pack_nb_zero' => 'Nun hai dengún « paquete de configuración » disponible actualmente.',
	'pack_outils_defaut' => 'Instalación de les ferramientes por omisión',
	'pack_sauver' => 'Guardar la configuración actual',
	'pack_sauver_descrip' => 'El botón démbaxo te permite enxertar direutamente nel archivu <b>@file@</b> los parámetros necesarios pa amesta-y un « paquete de configuración » al menú de la izquierda. Esto va permitite posteriormente tornar nun clic la Navaya Suiza a l\'estáu nel que ta actualmente.',
	'pack_supprimer' => 'Êtes-vous sûr de vouloir supprimer le pack « @pack@ » ?', # NEW
	'pack_titre' => 'Configuración Actual',
	'pack_variables_defaut' => 'Instalación de les variables por omisión',
	'par_defaut' => 'Por omisión',
	'paragrapher2:description' => 'La función de SPIP <code>paragrapher()</code> amesta-yos balices &lt;p&gt; y &lt;/p&gt; a tolos testos que nun tengan párrafos. A la fin d\'iguar más finamente los estilos y les paxinaciones, tienes la posibilidá d\'uniformizar l\'aspeutu de los testos del sitiu Web.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Amestar párrafos',
	'pipelines' => 'Tuberíes (pipelines) utilizáes:',
	'previsualisation:description' => 'Par défaut, SPIP permet de prévisualiser un article dans sa version publique et stylée, mais uniquement lorsque celui-ci a été « proposé à l’évaluation ». Hors cet outil permet aux auteurs de prévisualiser également les articles pendant leur rédaction. Chacun peut alors prévisualiser et modifier son texte à sa guise.

@puce@ Attention : cette fonctionnalité ne modifie pas les droits de prévisualisation. Pour que vos rédacteurs aient effectivement le droit de prévisualiser leurs articles « en cours de rédaction », vous devez l’autoriser (dans le menu {[Configuration&gt;Fonctions avancées->./?exec=config_fonctions]} de l’espace privé).', # NEW
	'previsualisation:nom' => 'Prévisualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci «*»', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Reemplaza les marques «-» (guión simple) de los artículos por llistes anotáes «-*» (traducíes en HTML como: &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) nes que l\'estilu pue personalizase con css.', # MODIF
	'pucesli:nom' => 'Marques guapes',

	// Q
	'qui_webmestres' => 'Los webmasters SPIP',

	// R
	'raccourcis' => 'Atayos tipográficos activos de la Navaya Suiza:',
	'raccourcis_barre' => 'Los atayos tipográficos de la Navaya Suiza',
	'rafraichir' => 'Afin de terminer la configuration du plugin, merci d\'actualiser la page courante.', # NEW
	'reserve_admin' => 'Accesu acutao pa los alministradores.',
	'rss_actualiser' => 'Actualizar',
	'rss_attente' => 'Esperando RSS...',
	'rss_desactiver' => 'Desactivar les «Revisiones de la Navaya Suiza»',
	'rss_edition' => 'Fluxu RSS puestu al día el:',
	'rss_source' => 'Fonte RSS',
	'rss_titre' => '«La Navaya Suiza» en desarrollu:',
	'rss_var' => 'Les revisiones de la Navaya Suiza',

	// S
	'sauf_admin' => 'Toos, sacante los alministradores',
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et rédacteurs', # NEW
	'sauf_identifies' => 'Tous, sauf les auteurs identifiés', # NEW
	'sessions_anonymes:description' => 'Chaque semaine, cet outil vérifie les sessions anonymes et supprime les fichiers qui sont trop anciens (plus de @_NB_SESSIONS3@ jours) afin de ne pas surcharger le serveur, notamment en cas de SPAM sur le forum.

Dossier stockant les sessions : @_DIR_SESSIONS@

Votre site stocke actuellement @_NB_SESSIONS1@ fichier(s) de session, @_NB_SESSIONS2@ correspondant à des sessions anonymes.', # NEW
	'sessions_anonymes:nom' => 'Sessions anonymes', # NEW
	'set_options:description' => 'Seleiciona d\'oficiu el tipu d’interfaz privada (simplificada o avanzada) pa tolos redactores esistentes o futuros y desanicia el botón correspondiente na barra d\'iconos amenorgaos.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Tipu d\'interfaz privada',
	'sf_amont' => 'Enriba',
	'sf_tous' => 'Toos',
	'simpl_interface:description' => 'Desactiva el menú de cambéu rápidu d\'estatutu d\'un artículu al pasar pola so marca de color. Esto ye afayadizo si busques tener una interfaz privada lo más austera posible col envís d\'optimizar les prestaciones nel cliente.',
	'simpl_interface:nom' => 'Allixeramientu de la interfaz privada',
	'smileys:aide' => 'Smileys: @liste@',
	'smileys:description' => 'Enxerta smileys en toos los testos nos que apaeza un atayu de tipu <acronym>:-)</acronym>. Ideal pa los  foros.
_ Ta disponible una baliza pa amosar una tabla de smileys nes cadarmes : #SMILEYS.
_ Diseñu d\'iconos: [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'Ufre-y al sitiu públicu un desplazamientu sele de la páxina cuando un visitante calca nun enllaz que apunta pa un ancla: mui afayadizo pa evitar perdese nuna páxina complexa o nun testu mui llargu...

Atención, pa que esta ferramienta funcione necesita páxines en «DOCTYPE XHTML» (¡non HTML!) dos plugins {jQuery}: {ScrollTo} y {LocalScroll}. La Navaya Suiza pue instalalos direutamente si marques los cuadros siguientes. [[%scrollTo%]][[-->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Ancles seles',
	'sommaire:description' => 'Construi un sumariu pal testu de los artículos y de les estayes a la fin d’acceder rápidamente a los títulos destacáos (etiquetes HTML &lt;h3>Un intertítulu&lt;/h3> o atayos SPIP: intertítulos na forma: <code>{{{Un titular}}}</code>).

@puce@ Equí vas poder conseñar el númberu másimu de carautères tomáos de los intertítulos pa construir el sumariu:[[%lgr_sommaire% carautères]]

@puce@ Tamién pues axustar el comportamientu del plugin tocante a la creación del sumariu: 
_ • Sistemáticu pa cada artículu (una baliza <code>@_CS_SANS_SOMMAIRE@</code> puesta n’ayuri dientro\'l testu de l’artículu creará una esceición).
_ • Únicamente pa los artículos que tengan la baliza <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Por omisión, la Navaya Suiza enxerta el sumariu en cabeza de l\'artículu automáticamente. Pero tienes la posibilida d\'allugar esti sumariu ayuri na cadarma gracies a una baliza #CS_SOMMAIRE que pues activar equí:
[[%balise_sommaire%]]

Esti sumariu pue acoplase con: « [.->decoupe] ».', # MODIF
	'sommaire:nom' => 'Un sumariu automáticu', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre<mon_ancre>}}}</html></b>', # NEW
	'sommaire_avec' => 'Un testu con sumariu: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un testu ensin sumariu: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hiérarchisés : <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Tenta lluchar escontra los unvíos de mensaxes automáticos y gafientos na parte pública. Delles pallabres, igual que les balices en claro &lt;a>&lt;/a>, tan torgáes: encamienta a los redactores a usar los atayos pa enllaces de SPIP.

Llista equí les secuencies torgáes separtandoles con espacios. [[%spam_mots%]]
• Pa una espresión con espacios, ponla ente comines.
_ • Pa especificar una pallabra entera, métela ente paréntesis. Exemplu:~{(premiu)}.
_ • Pa una espresión regular, verifica bien la sintaxis y ponla dientro de barres y comines. Exemplu:~{<html>\\"/@test\\.(com|org|ast)/\\"</html>}.', # MODIF
	'spam:nom' => 'Llucha escontra la puxarra',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => '¡Esti mensaxe bloquiarase pol filtru anti-SPAM!',
	'spam_test_ok' => 'Esti mensaxe aceutarase pol filtru anti-SPAM.',
	'spam_tester_bd' => 'Testez également votre votre base de données et listez les messages qui auraient été bloqués par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Preba equí la llista de secuencies torgáes:', # MODIF
	'spip_cache:description' => '@puce@ La caché ocupa ciertu espaciu en discu y SPIP puede limitar la cantidá. Un valor vacíu o igual a 0 significa que nun s\'aplica cuota denguna.[[%quota_cache% Mb]]

@puce@ Cuando se fai una modificación del conteníu del sitiu, SPIP invalida inmediatamente la caché ensin esperar al siguiente cálculu periódicu. Si el sitiu tien problemes de rendimientu por cuenta d\'una gran carga, puedes marcar « non » n\'esta opción.[[%derniere_modif_invalide%]]

@puce@ Si la baliza #CACHE nun s\'alcuentra nes tos cadarmes llocales, SPIP considera por omisión que la caché d\'una páxina tien una vida másima de 24 hores enantes de volver a calculala. A la fin de xestionar meyor la carga del to sirvidor, puedes cambear equí esti valor.[[%duree_cache% hores]]

@puce@ Si tienes dellos sitios en mutualización, puedes especificar equí el valor por omisión que se toma pa toos los sitios llocales (SPIP 2.0 mini).[[%duree_cache_mutu% hores]]', # MODIF
	'spip_cache:description1' => '@puce@ Por omisión, SPIP calcula toles páxines públiques y ponles na caché a la fin d\'acelerar la consulta. Desactivar temporalmente la caché pue aidar mientres se desarrolla el sitiu. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ Cuatro opciones pa tresnar el funcionamientu de la caché de SPIP: <q1>
_ • {Usu normal}: SPIP calcula toles páxines públiques y les pon na caché a la fin d\'acelerar la consulta. Tres d\'un ciertu plazu, la caché vuelve a calculase y guárdase.
_ • {Caché permanente}: los plazos d\'anovación de la caché inorense.
_ • {Ensin caché}: desactivar temporalmente la caché pue aidar nel desarrollo del sitiu. Equí, nada nun se guarda nel discu.
_ • {Control de caché}: opción identica a la precedente, con escritura nel discu de tolos resultaos a la fin de podelos controlar si fai falta.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension « Compresseur » présente dans SPIP permet de compacter les différents éléments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela accélère l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers à obtenir.', # NEW
	'spip_cache:nom' => 'SPIP y la caché…',
	'spip_ecran:description' => 'Détermine la largeur d\'écran imposée à tous en partie privée. Un écran étroit présentera deux colonnes et un écran large en présentera trois. Le réglage par défaut laisse l\'utilisateur choisir, son choix étant stocké dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'écran', # NEW
	'spip_log:description' => '@puce@ Gérez ici les différents paramètres pris en compte par SPIP pour mettre en logs les évènements particuliers du site. Fonction PHP à utiliser : <code>spip_log()</code>.@SPIP_OPTIONS@
[[Ne conserver que %nombre_de_logs% fichier(s), chacun ayant pour taille maximale %taille_des_logs% Ko.<br /><q3>{Mettre à zéro l\'une de ces deux cases désactive la mise en log.}</q3>]][[@puce@ Dossier où sont stockés les logs (laissez vide par défaut) :<q1>%dir_log%{Actuellement :} @DIR_LOG@</q1>]][[->@puce@ Fichier par défaut : %file_log%]][[->@puce@ Extension : %file_log_suffix%]][[->@puce@ Pour chaque hit : %max_log% accès par fichier maximum]]', # NEW
	'spip_log:description2' => '@puce@ Le filtre de gravité de SPIP permet de sélectionner le niveau d\'importance maximal à prendre en compte avant la mise en log d\'une donnée. Un niveau 8 permet par exemple de stocker tous les messages émis par SPIP.[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]', # NEW
	'spip_log:description3' => '@puce@ Les logs spécifiques au Couteau Suisse s\'activent ici : «[.->cs_comportement]».', # NEW
	'spip_log:nom' => 'SPIP et les logs', # NEW
	'stat_auteurs' => 'Autores por estatutu',
	'statuts_spip' => 'Únicamente los estatutos SPIP siguientes:',
	'statuts_tous' => 'Tolos estatutos',
	'suivi_forums:description' => 'Al autor d\'un artículu siempre se-y informa al espublizase un mensaxe nel foru públicu asociáu. Pero amás ye posible avisar dafechu: a tolos participantes del foru o sólo a los autores de mensaxes d\'enriba.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Siguir foros públicos',
	'supprimer_cadre' => 'Desaniciar esti cuadru',
	'supprimer_numero:description' => 'Aplica la función de SPIP supprimer_numero() al conxuntu de {{títulos}}, de {{nomes}} y de {{tipos}} (de pallabres-clave) del sitiu públicu, ensin que\'l filtru supprimer_numero tea presente nes cadarmes.<br />Esta ye la sintaxis a utilizar nel contestu d\'un sitiu multillíngüe: <code>1. <multi>My Title[fr]Mon Titre[ast]Mio Títulu</multi></code>',
	'supprimer_numero:nom' => 'Suprime\'l númberu',

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
	'titre' => 'La Navaya Suiza',
	'titre_parent:description' => 'Dientro d\'un bucle, ye corriente que se quiera amosar el títulu del padre de l\'oxetu en cursu. Tradicionalmente, había que utilizar un segundu bucle, pero esta nueva baliza #TITRE_PARENT va allixerar la escritura de les cadarmes. El resultáu devueltu ye: el títulu del grupu d\'una pallabra-clave o el de la estaya padre (si esiste) de los demás oxetos (artículu, estaya, breve, etc.).

Nota: Pa les pallabres-clave, un alias de #TITRE_PARENT ye #TITRE_GROUPE. El tratamientu por SPIP d\'estes nueves balices ye asemeyáu al de #TITRE.

@puce@ Si tas con SPIP 2.0, dispones equí de tou un conxuntu de balices #TITRE_XXX que pueden date\'l títulu de l\'oxetu \'xxx\', cola condición que\'l campu \'id_xxx\' tea presente na tabla en cursu (#ID_XXX utilizable nel bucle en cursu).

Por exemplu, nun bucle pa (ARTICLES), #TITRE_SECTEUR dará el títulu del sector nel que ta allugáu l\'artículu en cursu, porque l\'identificador #ID_SECTEUR (o el campu \'id_secteur\') ta disponible nesti casu.

La sintaxis <html>#TITRE_XXX{yy}</html> sopórtase igualmente. Exemplu: <html>#TITRE_ARTICLE{10}</html> devolverá el títulu de l\'artículu #10.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Balices #TITRE_PARENT/OBJET',
	'titre_tests' => 'La Navaya Suiza - Páxina de prebes…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>« {{{Mon intertitre}}} »</html> en image typographique paramétrable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : « [.->sommaire] ».', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'titres_typographies:description' => 'Par défaut, les raccourcis typographiques de SPIP <html>({, {{, etc.)</html> ne s\'appliquent pas aux titres d\'objets dans vos squelettes.
_ Cet outil active donc l\'application automatique des raccourcis typographiques de SPIP sur toutes les balises #TITRE et apparentées (#NOM pour un auteur, etc.).

Exemple d\'utilisation : le titre d\'un livre cité dans le titre d\'un article, à mettre en italique.', # NEW
	'titres_typographies:nom' => 'Titres typographiés', # NEW
	'tous' => 'Toos',
	'toutes_couleurs' => 'Los 36 colores de los estilos css :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Bloques multillingües: <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'Del mesmu mou que ya podíes facelo nes tos cadarmes, esta ferramienta te permite utilizar llibremente les cadenes de llingües (de SPIP o de les cadarmes) nel conteníu ensembre del sitiu (artículos, títulos, mensaxes, etc.) con l\'aida de l\'atayu <code><:cadena:></code>.

Consulta [equí ->http://www.spip.net/fr_article2128.html] la documentación de SPIP pa esti asuntu.

Esta ferramienta acepta igualmente los argumentos que apaecieron con SPIP 2.0. Por exemplu, l\'atayu <code><:mio_cadena{nome=Charles Martin, eda=37}:></code> permite pasa-y dos parámetros a la siguiente cadena: <code>\'mio_cadena\'=>"Bones, soi @nome@ y tengo @eda@ años\\"</code>.

La función SPIP usada en PHP ye <code>_T(\'cadena\')</code> ensin argumentu, y <code>_T(\'cadena\', array(\'arg1\'=>\'un testu\', \'arg2\'=>\'otru testu\'))</code> con argumentos.

 Nun t\'escaezas de verificar que la clave <code>\'cadena\'</code> tea bien definida nos archivos de les llingües.', # MODIF
	'toutmulti:nom' => 'Bloques multillingües',
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
	'travaux_prochainement' => 'Esti sitiu volverá a tar en llinia pronto.
_ Agradecémoste la comprensión.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Al ñavegar pola parte privada del sitiu ([->./?exec=auteurs]), equí escueyes la ordenación a utilizar pa amosar los artículos dientro de les estayes.

Les propuestes d\'embaxo básense na función SQL \'ORDER BY\': nun utilices l\'orde personalizáu más que si sabes lo que tas faciendo (campos disponibles: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Orde de los artículos', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'Guetar pola fecha d\'igua (ORDER BY date_modif DESC)',
	'tri_perso' => 'Gueta SQL personalizada, ORDER BY siguío por:',
	'tri_publi' => 'Guetar pola fecha d\'espublizamientu (ORDER BY date DESC)',
	'tri_titre' => 'Guetar pol títulu (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Ferramienta en cursu de desendolcu. Ufre delles balices mui cencielles y enforma práctiques pa les cadarmes.

@puce@ {{#BOLO}}: xenera un testu falsu d\'unos 3000 carauteres ("bolo" o "[?lorem ipsum]") nes cadarmes enantes de poneles nel so llugar. L\'argumentu opcional d\'esta función conseña el llargor que se quier pal testu. Exemplu: <code>#BOLO{300}</code>. Esta baliza acepta toles peñeres de SPIP. Exemplu: <code>[(#BOLO|majuscules)]</code>.
_ Tamién hai disponible un modelu pa los conteníos: pon <code><bolo300></code> en cualquier zona de testu (cabecera, descripción, testu, etc.) pa tener 300 carauteres de testu falsu.

@puce@ {{#MAINTENANT}} (o {{#NOW}}): devuelve simplemente la data del momentu, igual que: <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argumentu opcional d\'esta función afita\'l formatu. Exemplu: <code>#MAINTENANT{Y-m-d}</code>. Como con #DATE, personaliza l\'aspeutu gracies a les peñeres de SPIP. Exemplu: <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}}: baliza equivalente a <code>#EVAL{"chr(XX)"}</code> ye afayadiza pa conseñar carauteres especiales (el saltu de llinia por exemplu) o carauteres reservaoss pol compilador de SPIP (los corchetes o les llaves).

@puce@ {{#LESMOTS}}: ', # MODIF
	'trousse_balises:nom' => 'Caxón de balices',
	'type_urls:description' => '@puce@ SPIP ufre una esbilla de xuegos d\'URLs pa fabricar los enllaces d\'accesu a les páxines del sitiu Web.

Más info: [->http://www.spip.net/fr_article765.html]. La ferramienta « [.->boites_privees] » te permite ver na páxina de cada oxetu SPIP la URL propia asociada.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@pa utilizar los formatos {html}, {propies}, {propies2}, {llibres} o {arborescentes}, copia l\'archivu "htaccess.txt" del direutoriu base del sitiu SPIP col nome ".htaccess" (atención pa nun esborrar otros axustes que pudieras tener conseñaos nesti archivu); si el to sitiu ta nun "sub-direutoriu", has d\'iguar también la llinia "RewriteBase" nel archivu. Les URLs definies van redirixise agora a los archivos de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs «páxina»}}: son los enllaces predetermináos, que usa SPIP dende la so versión 1.9x.
_ Exemplu: <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs «html»}}: los enllaces tienen forma de páxines html clásiques.
_ Exemplu: <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs «propies»}}: los enllaces calcúlense graciee al títulu de los oxetos pidíos. Les marques (_, -, +, @, etc.) cuadren los títulos en función del tipu d\'oxetu.
_ Exemplos : <code>/Mio-titulu-d-artículu</code> o <code>/-Mio-estaya-</code> o <code>/@Mio-sitiu@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs «propies2»}}: la\'estensión \'.html\' améstase a los enllaces {«propios»}.
_ Exemplu: <code>/Mio-titulu-d-artículu.html</code> o <code>/-Mio-estaya-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs «llibres»}}: los enllaces son {«propios»}, pero ensin marcadores pa dixebrar los oxetos (_, -, +, @, etc.).
_ Exemplu: <code>/Mio-titulu-d-artículu</code> o <code>/Mio-estaya</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs «arborescentes»}}: los enllaces son {«propios»}, pero de tipu arborescente.
_ Exemplu: <code>/sector/estaya1/estaya2/Mio-titulu-d-artículu</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs «propies-qs»}}: esti sistema funciona en "Query-String", ye dicir, ensin utilizar .htaccess ; los enllaces son {«propios»}.
_ Exemplu: <code>/?Mio-títulu-d-artículu</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres_qs">@puce@ {{URLs «propies_qs»}}: esti sistèma funciona en "Query-String", esto ye, ensin utilización de .htaccess; los enllaces son {«propios»}.
_ Exemplu: <code>/?Mio-títulu-d-artículu</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs «estandar»}}: estos enllaces agora obsoletos utilizábense por SPIP hasta la so versión 1.8.
_ Exemplu: <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Si utilizes el formatu {page} d\'embaxo o si l\'oxetu solicitáu nun se reconocerá, pero ye posible escoyer {{el script de llamada}} a SPIP. Por omisión, SPIP escueye {spip.php}, pero {index.php} (exemplu de formatu: <code>/index.php?article123</code>) donde un valor vacíu (formatu: <code>/?article123</code>) funciona tamién. Pa cualquier otru valor, necesites crear dafechu l\'archivu correspondiente na raiz de SPIP, a imaxe del que ya esiste: {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ Si utilices un formatu basáu en URLs «propies» ({propres}, {propres2}, {libres}, {arborescentes} o {propres_qs}), la Navaya Suiza pue:
<q1>• Asegurase que la URL producida tea totalmente {{en minúscules}}.</q1>[[%urls_minuscules%]]
<q1>• Provocar l\'amestamientu sistemáticu de {{la id de l\'oxetu}} a la URL (como sufixu, prefixu, etc.).
_ (exemplos: <code>/Mio-titulu-d-artículu,457</code> o <code>/457-Mio-títulu-d-artículu</code>)</q1>', # MODIF
	'type_urls:description2' => '{Note} : un changement dans ce paragraphe peut nécessiter de vider la table des URLs afin de permettre à SPIP de tenir compte des nouveaux paramètres.', # NEW
	'type_urls:nom' => 'Formatu de les URLs',
	'typo_exposants:description' => '{{Testos en francés}}: meyora la presentación tipográfica de les abreviatures corrientes, escribiendo como esponente los elementos necesarios (así, {<acronym>Mme</acronym>} tresfórmase en {M<sup>me</sup>}) y corrixendo los fallos comunes ({<acronym>2ème</acronym>} o  {<acronym>2me</acronym>}, por exemplu, camúdense en {2<sup>e</sup>}, única abreviatura correuta).

Les abreviatures obteníes son conformes coles de l\'Imprimerie nationale como les que s\'indiquen en el {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (article « Abréviations », presses de l\'Imprimerie nationale, Paris, 2002).

Igüense también les siguientes espresiones: <html>Dr, Pr, Mgr, m2, m3, Mn, Md, Sté, Éts, Vve, Cie, 1o, 2o, etc.</html>

Escueye equí escribir como esponentes dellos atayos suplementarios, magar que l\'Imprimerie nationale lo tenga desaconseyao:[[%expo_bofbof%]]

{{Testos n\'inglés}}: escríbense como esponente los númberos ordinales: <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Esponentes tipográficos',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'llibres@_CS_ASTER@',
	'url_page' => 'páxina',
	'url_propres' => 'propies@_CS_ASTER@',
	'url_propres-qs' => 'propies-qs',
	'url_propres2' => 'propies2@_CS_ASTER@',
	'url_propres_qs' => 'propies_qs',
	'url_standard' => 'estándar',
	'url_verouillee' => 'URL verrouillée', # NEW
	'urls_3_chiffres' => 'Imponer un mínimu de 3 cifres',
	'urls_avec_id' => 'Ponela como sufixu',
	'urls_avec_id2' => 'Ponela como prefixu',
	'urls_base_total' => 'Actualmente hai @nb@ URL(s) na base',
	'urls_base_vide' => 'La base de les URLs ta vacía',
	'urls_choix_objet' => 'Edición de la base de la URL d\'un oxetu específicu:',
	'urls_edit_erreur' => 'El formatu actual de les URLs (« @type@ ») nun permite la edición.',
	'urls_enregistrer' => 'Grabar esta URL na base',
	'urls_id_sauf_rubriques' => 'Encaboxar les estayes', # MODIF
	'urls_minuscules' => 'Letres minúscules',
	'urls_nouvelle' => 'Editar la URL «propia»:', # MODIF
	'urls_num_objet' => 'Númberu:',
	'urls_purger' => 'Vacialo ensembre',
	'urls_purger_tables' => 'Vaciar les tables seleicionáes',
	'urls_purger_tout' => 'Reaniciar les URLs guardáes na base:',
	'urls_rechercher' => 'Restolar esti oxetu na base',
	'urls_titre_objet' => 'Títulu grabáu:',
	'urls_type_objet' => 'Oxetu:',
	'urls_url_calculee' => 'URL pública « @type@ »:',
	'urls_url_objet' => 'URL «propia» grabada:', # MODIF
	'urls_valeur_vide' => '(Un valor vacíu produz el recálculu de la URL)', # MODIF
	'urls_verrouiller' => '{{Verrouiller}} cette URL afin que SPIP ne la modifie plus, notamment lors d\'un clic sur « @voir@ » ou d\'un changement du titre de l\'objet.', # NEW

	// V
	'validez_page' => 'Pa acceder a les modificaciones:',
	'variable_vide' => '(Vacío)',
	'vars_modifiees' => 'Los datos modificáronse bien',
	'version_a_jour' => 'Esta versión ta actualizada.',
	'version_distante' => 'Versión esterna...',
	'version_distante_off' => 'Verificación esterna desactivada',
	'version_nouvelle' => 'Versión nueva: @version@',
	'version_revision' => 'Revisión: @revision@',
	'version_update' => 'Actualización automática',
	'version_update_chargeur' => 'Descarga automática',
	'version_update_chargeur_title' => 'Descarga la cabera versión del plugin gracies al plugin «Descargador»',
	'version_update_title' => 'Descarga la cabera versión del plugin y llanza la actualización automática',
	'verstexte:description' => '2 filtros pa les tos cadarmes, que permiten de producir páxines más lixeres.
_ version_texte : estrái el conteníu de testu d\'una páxina html escluyendo delles etiquetes elementales.
_ version_plein_texte : estrái el conteníu de testu d\'una páxina html pa amosar el testu en bruto.', # MODIF
	'verstexte:nom' => 'Versión testu',
	'visiteurs_connectes:description' => 'Ufre una plizquina de códigu pa la cadarma que amuesa el númberu de visites coneutáes col sitiu públicu.

Amesta-yos simplemente <code><INCLURE{fond=fonds/visiteurs_connectes}></code> a les tos páxines.', # MODIF
	'visiteurs_connectes:inactif' => 'Attention : les statistiques du site ne sont pas activées.', # NEW
	'visiteurs_connectes:nom' => 'Visites coneutáes',
	'voir' => 'Ver: @voir@',
	'votre_choix' => 'Seleición:',

	// W
	'webmestres:description' => 'Un {{webmaster}} nel sen SPIP ye un {{alministrador}} que tien accesu a l\'espaciu FTP. Por omisión y dende SPIP 2.0, ye l’alministrador <code>id_auteur=1</code> del sitiu. Los webmasters conseñáos equí, tienen el privilexu de nun tar obligáos a pasar pol FTP pa validar les operaciones sensibles del sitiu, como poner al día la base de datos o la restauración d’un volcáu.

Webmaster(s) actual(es): {@_CS_LISTE_WEBMESTRES@}.
_ Alministrador(es) elexible(s): {@_CS_LISTE_ADMINS@}.

Por ser webmaster tú mesmu, equi tienes permisos pa iguar esta llista de ids -- separtáes por dos puntos « : » si son más d\'un. Exemplu: «1:5:6».[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Llista de webmasters',

	// X
	'xml:description' => 'Activa el validador xml pa l\'espaciu públicu como ta esplicao na [documentación->http://www.spip.net/fr_article3541.html]. Améstase un botón tituláu «Análisis XML» a los otros botones d\'alministración.', # MODIF
	'xml:nom' => 'Validador XML'
);

?>
