<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=es
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ' : no',
	'2pts_oui' => ' : sí',

	// S
	'SPIP_liens:description' => '@puce@ Todos los enlaces del sitio se abren, por omisión, en la ventana actual del navegador. Pero puede ser útil abrir los enlaces externos en una nueva ventana de navegación -- esto se reduce a añadir {target=\\"_blank\\"} en todas las balizas &lt;a&gt; a las que SPIP asigna las clases {spip_out}, {spip_url} o {spip_glossaire}. A veces hace falta añadir una de estas clases a los enlaces del esqueleto del sitio (archivos html) para extender al máximo esta característica.[[%radio_target_blank3%]]

@puce@ SPIP permite enlazar palabras con su definición gracias al atajo tipográfico <code>[?palabra]</code>. Por omisión (o si dejas en blanco este cuadro), el glosario externo reenvía hacia la enciclopedia libre wikipedia.org. Aquí puedes elegir la dirección que se utilizará. <br />Enlace de prueba: [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP a prévu un style CSS pour les liens «~mailto:~» : une petite enveloppe devrait apparaître devant chaque lien lié à un courriel; mais puisque tous les navigateurs ne peuvent pas l\'afficher (notamment IE6, IE7 et SAF3), à vous de voir s\'il faut conserver cet ajout.
_ Lien de test : [->test@test.com] (rechargez la page entièrement).[[%enveloppe_mails%]]', # NEW
	'SPIP_liens:nom' => 'SPIP y los enlaces… externos',
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
	'acces_admin' => 'Acceso de administradores:',
	'action_rapide' => 'Acción rápida, ¡sólo si sabes lo que haces!',
	'action_rapide_non' => 'Acción rápida, disponible una vez activada esta herramienta:',
	'admins_seuls' => 'Los administradores solamente',
	'aff_tout:description' => 'Il parfois utile d\'afficher toutes les rubriques ou tous les auteurs de votre site sans tenir compte de leur statut (pendant la période de développement par exemple). Par défaut, SPIP n\'affiche en public que les auteurs et les rubriques ayant au moins un élément publié.

Bien qu\'il soit possible de contourner ce comportement à l\'aide du critère [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], cet outil automatise le processus et vous évite d\'ajouter ce critère à toutes les boucles RUBRIQUES et/ou AUTEURS de vos squelettes.', # NEW
	'aff_tout:nom' => 'Affiche tout', # NEW
	'alerte_urgence:description' => 'Affiche en tête de toutes les pages publiques un bandeau d\'alerte pour diffuser le message d\'urgence défini ci-dessous.
_ Les balises <code><multi/></code> sont recommandées en cas de site multilingue.[[%alerte_message%]]', # NEW
	'alerte_urgence:nom' => 'Message d\'alerte', # NEW
	'attente' => 'Espera...',
	'auteur_forum:description' => 'Pide a todos los autores de mensajes públicos que rellenen (¡al menos con una letra!) el campo «@_CS_FORUM_NOM@» para evitar las contribuciones completamente anónimas.

Notez que cet outil procède à une vérification JavaScript sur le poste du visiteur.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Attention : Choisir la troisième option annule les 2 premières. Il est important de vérifier que les formulaires de votre squelette sont bien compatibles avec cet outil.}', # MODIF
	'auteur_forum:nom' => 'Sin foros anónimos',
	'auteur_forum_deux' => 'Ou, au moins l\'un des deux champs précédents', # NEW
	'auteur_forum_email' => 'Le champ «@_CS_FORUM_EMAIL@»', # NEW
	'auteur_forum_nom' => 'Le champ «@_CS_FORUM_NOM@»', # NEW
	'auteurs:description' => 'Esta herramienta configura la apariencia de [la página de los autores->./?exec=auteurs], en el espacio privado.

@puce@ Define aquí el número máximo de autores que se verán en el cuadro central de la página de autores. A partir de ahí, se realiza la compaginación.[[%max_auteurs_page%]]

@puce@ ¿Que estatutos de autores pueden listarse en esta página?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]', # MODIF
	'auteurs:nom' => 'Página de los autores',
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
	'basique' => 'Básico',
	'blocs:aide' => '<Bloques Desplegables : <b><bloc></bloc></b> (alias : <b><invisible></invisible></b>) et <b><visible></visible></b>',
	'blocs:description' => 'Permite crear bloques que pueden hacerse visibles o invisibles al pulsar en su título.

@puce@ {{En los textos de SPIP}}: los redactores disponen de las  nuevas balizas &lt;bloc&gt; (o &lt;invisible&gt;) y &lt;visible&gt; para utilizarlas en sus textos así: 

<quote><code>
<bloc>
 Un título que se puede pulsar
 
 El texto que se esconde/muestra, tras dos saltos de línea...
 </bloc>
</code></quote>

@puce@ {{En los esqueletos}}: dispones de las  nuevas balizas #BLOC_TITRE, #BLOC_DEBUT y #BLOC_FIN que se utilizan así: 
<quote><code> #BLOC_TITRE o #BLOC_TITRE{mi_URL}
 Mi título
 #BLOC_RESUME    (opcional)
 versión resumida del bloque siguiente
 #BLOC_DEBUT
 Mi bloque desplegable (que contendrá la URL a la que apunta el título si es necesario)
 #BLOC_FIN</code></quote>
 
@puce@ Marcando «si» más abajo, la apertura de un bloque causará el cierre de los demás bloques de la página, para tener solamente uno abierto cada vez.[[%bloc_unique%]]', # MODIF
	'blocs:nom' => 'Bloques Desplegables',
	'boites_privees:description' => 'Todas las cajas descritas a continuación aparecen en varios lugares de la parte privada.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Las revisiones de la Navaja Suiza}}: un cuadro sobre esta página de configuración, que indica las últimas modificaciones efectuadas en el código del plugin ([Fuente->@_CS_RSS_SOURCE@]).
- {{Los artículos en formato SPIP}} : un cuadro desplegable suplementario para tus artículos con el fin de ver el código fuente utilizado por sus autores.
- {{Los autores en cifras}} : un cuadro suplementario en [la página de los autores->./?exec=auteurs] que indica los 10 últimos conectados y las inscripciones no confirmadas. Sólo los administradores ven esta información.
- {{Ver las URLs propias}} : un cuadro desplegable para cada objeto de contenido (artículo, sección, autor, ...) que indica la URL propia asociada, así como sus alias eventuales. La herramienta « [.->type_urls] » te permite ajustar la configuración de las URLs de tu sitio web.
- {{La ordenación de autores}}: un cuadro desplegable para los artículos que contengan más de un autor y que permite ajustar facilmente el orden en que se muestran.', # MODIF
	'boites_privees:nom' => 'Cajas privadas',
	'bp_tri_auteurs' => 'El orden de autores',
	'bp_urls_propres' => 'Las URLs propias',
	'brouteur:description' => '@puce@ {{Sélecteur de rubrique (brouteur)}}. Utilisez le sélecteur de rubrique en AJAX à partir de %rubrique_brouteur% rubrique(s).

@puce@ {{Sélection de mots-clefs}}. Utilisez un champ de recherche au lieu d\'une liste de sélection à partir de %select_mots_clefs% mot(s)-clef(s).

@puce@ {{Sélection d\'auteurs}}. L\'ajout d\'un auteur se fait par mini-navigateur dans la fourchette suivante :
<q1>• Une liste de sélection pour moins de %select_min_auteurs% auteurs(s).
_ • Un champ de recherche à partir de %select_max_auteurs% auteurs(s).</q1>', # NEW
	'brouteur:nom' => 'Réglage des sélecteurs', # NEW

	// C
	'cache_controle' => 'Control de la caché',
	'cache_nornal' => 'Uso normal',
	'cache_permanent' => 'Caché permanente',
	'cache_sans' => 'Sin caché',
	'categ:admin' => '1. Administración',
	'categ:devel' => '55. Développement', # NEW
	'categ:divers' => '60. Varios',
	'categ:interface' => '10. Interfaz privada',
	'categ:public' => '40. Publicación',
	'categ:securite' => '5. Sécurité', # NEW
	'categ:spip' => '50. Balizas, filtros, criterios',
	'categ:typo-corr' => '20. Mejoras en los textos',
	'categ:typo-racc' => '30. Atajos tipográficos',
	'certaines_couleurs' => 'Sólo las balizas definidas aquí@_CS_ASTER@ :',
	'chatons:aide' => 'Caritas: @liste@',
	'chatons:description' => 'Inserta imágenes (o caritas para los {chats}) en todos los textos donde aparezca una cadena de tipo <code>:nombre</code>.
_ Esta herramienta reemplaza estos atajos con las imágenes con el mismo nombre que encuentre en la carpeta plugins/couteau_suisse/img/chatons.', # MODIF
	'chatons:nom' => 'Caritas',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de votre site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour à la ligne. En effet, les citations courtes doivent être entourées par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.', # NEW
	'citations_bb:nom' => 'Citations bien balisées', # NEW
	'class_spip:description1' => 'Aquí puedes definir ciertos atajos de SPIP. Un valor vacío equivale a utilizar el valor por omisión.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Los atajos de SPIP}}.

Aquí puedes definir ciertos atajos de SPIP. Un valor vacío equivale a utilizar el valor por omisión.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{Atención: si la herramienta « [.->pucesli] » está activada, el reemplazo del guión « - » ya no se efectuará; en su lugar se usará una lista &lt;ul>&lt;li>.}

SPIP utiliza habitualmente la baliza &lt;h3&gt; para los intertítulos. Elige aquí otra alternativa: [[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP ha elegido usar la baliza &lt;strong> para transcribir las negritas. Pero &lt;b> también podría ser conveniente, con o sin estilo. A tu elección:[[%racc_g1%]][[->%racc_g2%]]

SPIP ha elegido usar la baliza &lt;i> para transcribir las itálicas. Pero &lt;em> también podría ser conveniente, con o sin estilo. A tu elección:[[%racc_i1%]][[->%racc_i2%]]

@puce@ {{Los estilos por omisión de SPIP}}. Hasta la versión 1.92 de SPIP, los atajos tipográficos producían balizas con el estilo \\"spip\\" asignado siempre. Por ejemplo: <code><p class=\\"spip\\"></code>. Aquí puedes definir el estilo de estas balizas en función de tus hojas de estilo. Un cuadro vacío significa que no se aplica ningún estilo en particular.
{Atención: si ciertos atajos (linea horizontal, intertítulo, itálica, negrita) se han modificado más abajo, los estilos siguientes no se aplicarán.}

<q1>
_ {{1.}} Balizas &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]]
_ {{2.}} Balizas &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; y las listas (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Nota: al modificar este segundo estilo, también pierdes los estilos estándar de SPIP asociados con estas balizas.</blockquote>', # MODIF
	'class_spip:nom' => 'SPIP y sus atajos…',
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
	'contrib' => 'Más información: @url@',
	'copie_vers' => 'Copie vers : @dir@', # NEW
	'corbeille:description' => 'SPIP suprime automáticamente los objetos tirados a la basura en un plazo de 24 horas, en general hacia las 4 de la madrugada, gracias a una tarea «CRON» (lanzamiento periódico y/o automático de procesos preprogramados). Aquí puedes impedir ese proceso para gestionar mejor la papelera.[[%arret_optimisation%]]',
	'corbeille:nom' => 'La papelera',
	'corbeille_objets' => '@nb@ objeto(s) en la papelera.',
	'corbeille_objets_lies' => '@nb_lies@ enlace(s) detectado(s).',
	'corbeille_objets_vide' => 'No hay objetos en la papelera', # MODIF
	'corbeille_objets_vider' => 'Suprimir los objetos seleccionados',
	'corbeille_vider' => 'Vaciar la papelera:',
	'couleurs:aide' => 'Asignar colores: <b>[coul]texto[/coul]</b>@fond@ en <b>color</b>= @liste@',
	'couleurs:description' => 'Permite aplicar facilmente des colores a todos los textos del sitio (artículos, breves, títulos, foro, …) utilizando balizas de atajo.

Dos ejemplos idénticos para cambiar el color del texto:@_CS_EXEMPLE_COULEURS2@

Lo mismo para cambiar el fondo, si la opción de abajo lo permite:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@El formato de estas balizas personalizadas debe listar colores existentes o definir parejas «baliza=color», todo ello separado por comas. Ejemplos: «gris, rouge», «suave=jaune, fuerte=rouge», «bajo=#99CC11, alto=brown» o incluso «gris=#DDDDCC, rouge=#EE3300». Para el primer y el último ejemplo, las balizas autorizadas son: <code>[gris]</code> y <code>[rouge]</code> (<code>[fond gris]</code> y <code>[fond rouge]</code> si se permiten los fondos).', # MODIF
	'couleurs:nom' => 'Todo en colores',
	'couleurs_fonds' => ', <b>[fond coul]texto[/coul]</b>, <b>[bg coul]texto[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Obtener abundante información sobre el funcionamiento de la Navaja Suiza en los archivos {spip.log} que se pueden encontrar en el directorio: {@_CS_DIR_TMP@}[[%log_couteau_suisse%]]

@puce@ {{Opciones de SPIP.}} SPIP ordena los plugins en un orden determinado. Para asegurarse de que la Navaja Suiza sea el primero y gestione desde el principio ciertas opciones de SPIP, marca la opción siguiente. Si los permisos de tu servidor lo permiten, se modificará automáticamente el archivo {@_CS_FILE_OPTIONS@} para incluir el archivo {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php}.
[[%spip_options_on%]]

@puce@ {{Consultas externas.}} La Navaja Suiza verifica regularmente la existencia de una versión más reciente de su código e informa en su página de configuración de una actualización que esté disponible. Si las consultas externas de tu servidor causan problemas, marca la casilla siguiente.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'Comportamiento de la Navaja Suiza',
	'cs_comportement_ko' => '{{Note :}} ce paramètre requiert un filtre de gravité réglé à plus de @gr2@ au lieu de @gr1@ actuellement.', # NEW
	'cs_distant_off' => 'Las comprobaciones de versiones externas',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => 'Los registros detallados de la Navaja Suiza',
	'cs_reset' => '¿Confirmas que deseas reinicializar totalmente la Navaja Suiza?',
	'cs_reset2' => 'Tous les outils actuellement actifs seront désactivés et leurs paramètres réinitialisés.', # NEW
	'cs_spip_options_erreur' => 'Attention : la modification du ficher «<html>@_CS_FILE_OPTIONS@</html>» a échoué !', # NEW
	'cs_spip_options_on' => 'Las opciones de SPIP en «@_CS_FILE_OPTIONS@»', # MODIF

	// D
	'decoration:aide' => 'Decoración: <b>&lt;balise&gt;prueba&lt;/balise&gt;</b>, con <b>balise</b> = @liste@',
	'decoration:description' => 'Nuevos estilos paramétricos en tus textos, accesibles mediante balizas entre angulares. Ejemplo:
&lt;mibaliza&gt;texto&lt;/mibaliza&gt; o: &lt;mibaliza/&gt;.<br />Define debajo los estilos CSS que necesites, una baliza por línea, según las sintaxis siguientes:
- {type.mibaliza = mi estilo CSS}
- {type.mibaliza.class = mi clase CSS}
- {type.mibaliza.lang = mi idioma (p. ej: es)}
- {unalias = mibaliza}

El parámetro {type} puede tomar tres valores:
- {span} : baliza dentro de un párrafo (tipo Inline)
- {div} : baliza que crea un párrafo nuevo (tipo Block)
- {auto} : baliza determinada automáticamente por el plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Decoración',
	'decoupe:aide' => 'Bloque de pestañas: <b>&lt;onglets>&lt;/onglets></b><br/>Separador de páginas o de pestañas: @sep@', # MODIF
	'decoupe:aide2' => 'Alias: @sep@',
	'decoupe:description' => '@puce@ Divide la presentación pública de un artículo en varias páginas mediante una compaginación automática. Simplemente sitúa en tu artículo cuatro signos de suma consecutivos (<code>++++</code>) en el lugar donde haya que cortar.

Por omisión, la Navaja Suiza inserta la numeración de página en el encabezado y en el pie del artículo automáticamente. Pero tienes la posibilidad de situar esta numeración en otro lugar del esqueleto gracias a la baliza #CS_DECOUPE que puedes activar aquí:
[[%balise_decoupe%]]

@puce@ Si utilizas este separador entre las balizas &lt;onglets&gt; y &lt;/onglets&gt; lo que obtienes es un conjunto de pestañas.

En los esqueletos: tienes a tu disposición las nuevas balizas #ONGLETS_DEBUT, #ONGLETS_TITRE y #ONGLETS_FIN.

Esta herramienta puede acoplarse con « [.->sommaire] ».', # MODIF
	'decoupe:nom' => 'Dividir en páginas y pestañas',
	'desactiver_flash:description' => 'Suprime los objetos flash de las páginas de tu sitio y las reemplaza por el contenido alternativo asociado.',
	'desactiver_flash:nom' => 'Desactiva los objetos flash',
	'detail_balise_etoilee' => '{{Atención}} : Revisa bien el uso que tus esqueletos hacen de las balizas con asteriscos. El procesado con esta herramienta no se aplicará sobre: @bal@.',
	'detail_disabled' => 'Paramètres non modifiables :', # NEW
	'detail_fichiers' => 'Ficheros:',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'Código en línea:',
	'detail_jquery2' => 'Esta herramienta necesita la biblioteca {jQuery}.', # MODIF
	'detail_jquery3' => '{{Atención}}: esta herramienta necesita el plugin [jQuery para SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] para funcionar correctamente con esta versión de SPIP.',
	'detail_pipelines' => 'Pipelines:',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_spip_options2' => 'Il est recommandé de placer les options SPIP en amont grâce à l\'outil «[.->cs_comportement]».', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_surcharge' => 'Outil surchargé :', # NEW
	'detail_traitements' => 'Procesado:',
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
	'dossier_squelettes:description' => 'Modifica la carpeta de esqueleto utilizada. Por ejemplo: "esqueletos/miesqueleto". Puedes registrar varias carpetas separándolas con dos puntos <html>« : »</html>. Si se deja vacío el siguiente cuadro (o escribiendo "dist"), se usará el esqueleto original "dist" proporcionado por SPIP.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Carpeta del esqueleto',

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
	'effaces' => 'Borrados',
	'en_travaux:description' => 'Permite mostrar un mensaje personalizable durante una fase de mantenimiento en todas las páginas públicas y, eventualmente, en el espacio privado.', # MODIF
	'en_travaux:nom' => 'Sitio en mantenimiento',
	'erreur:bt' => '<span style=\\"color:red;\\">Atención:</span> la barra de tipografías (version @version@) parece antigua.<br />La Navaja Suiza es compatible con una versión superior o igual a @mini@.', # MODIF
	'erreur:description' => '¡falta la id en la definición de la herramienta!',
	'erreur:distant' => 'el servidor externo',
	'erreur:jquery' => '{{Nota}}: la biblioteca {jQuery} parece estar inactiva para esta página. Consulta [aquí->http://www.spip-contrib.net//La-navaja-suiza] el párrafo sobre las dependencias del plugin, o recarga esta página.',
	'erreur:js' => 'Parece que ha ocurrido un error de JavaScript en esta página que impide su buen funcionamiento. Intenta activar JavaScript en tu navegador o desactivar ciertos plugins de SPIP de tu sitio web.',
	'erreur:nojs' => 'JavaScript está desactivado en esta página.',
	'erreur:nom' => '¡Error!',
	'erreur:probleme' => 'Problema en: @pb@',
	'erreur:traitements' => 'La Navaja Suiza - Error de compilación en el procesado: ¡mezclar \'typo\' y \'propre\' está prohibido!',
	'erreur:version' => 'Esta herramienta no está disponible en esta versión de SPIP.',
	'erreur_groupe' => 'Attention : le groupe «@groupe@» n\'est pas défini !', # NEW
	'erreur_mot' => 'Attention : le mot-clé «@mot@» n\'est pas défini !', # NEW
	'etendu' => 'Extendido',

	// F
	'f_jQuery:description' => 'Impide la instalación de {jQuery} en el espacio público para economizar un poco de «tiempo de máquina». Esta biblioteca ([->http://jquery.com/]) aporta numerosas facilidades en la programación con JavaScript y puede utilizarse por ciertos plugins. SPIP la utiliza en su espacio privado.

Atención: algunas herramientas de la Navaja Suiza necesitan las funciones de {jQuery}. ', # MODIF
	'f_jQuery:nom' => 'Desactivar jQuery',
	'filets_sep:aide' => 'Filetes de Separación: <b>__i__</b> o <b>i</b> es un número.<br />Otros filetes disponibles: @liste@', # MODIF
	'filets_sep:description' => 'Inserta filetes de separación, personalizables con hojas de estilo, en todos los textos de SPIP.
_ La sintaxis es: "__código__", donde "código" representa o bien el número de identificación (de 0 a 7) del filete a insertar, relativo al estilo correspondiente, o el nombre de una imagen situada en la carpeta plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Filetes de Separación',
	'filtrer_javascript:description' => 'Hay tres modos disponibles Para gestionar la inserción de JavaScript en los artículos:
- <i>jamais</i>: el JavaScript se rechaza en todo lugar
- <i>défaut</i>: el JavaScript se marca en rojo en el espacio privado
- <i>toujours</i>: el JavaScript se acepta siempre.

Atención: en los foros, peticiones, flujos sindicados, etc., la gestión de JavaScript es <b>siempre</b> en modo seguro.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Gestión de JavaScript',
	'flock:description' => 'Desactiva el sistema de bloqueo de ficheros neutralizando la función PHP {flock()}. Ciertos alojamientos web producen problemas graves por causa de un sistema de ficheros inadaptado por falta de sincronización. No actives esta herramienta si tu sitio funciona normalmente.',
	'flock:nom' => 'Sin bloqueo de ficheros',
	'fonds' => 'Fondos:',
	'forcer_langue:description' => 'Fuerza el contexto de idioma en los juegos de esqueletos multilingües que dispongan de un formulario o de un menú de idiomas que sepan manejar la cookie de idioma.

Técnicamente, esta herramienta tiene estos efectos:
- desactivar la búsqueda de un esqueleto en función del idioma del objeto,
- desactivar el criterio <code>{lang_select}</code> automático para los objetos clásicos (artículos, breves, secciones, etc ... ).

Los bloques multi se muestran siempre en el idioma solicitado por el visitante.', # MODIF
	'forcer_langue:nom' => 'Forzar un idioma',
	'format_spip' => 'Artículos en formato SPIP',
	'forum_lgrmaxi:description' => 'Por omisión no se limita el tamaño de los mensajes del foro. Si se activa esta herramienta, se mostrará un mensaje de error cuando alguien quiera publicar un mensaje de tamaño superior al valor especificado, y se rechazará el mensaje. Un valor en blanco o igual a 0 significa que no se aplica ningún límite.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Tamaño de los foros',

	// G
	'glossaire:aide' => 'Un texto sin glosario: <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Gestión de un glosario interno ligado a uno o más grupos de palabras-clave. Escribe aquí el nombre de los grupos separándolos mediante dos puntos « : ». Si se deja vacío el cuadro siguiente (o escribiendo "Glossaire"), se utilizará el grupo "Glossaire".[[%glossaire_groupes%]]

@puce@ Para cada palabra, tendrás la posibilidad de elegir el número máximo de enlaces creados en los textos. Cualquier valor nulo o negativo implica que se procesarán todas las palabras reconocidas. [[%glossaire_limite% par mot-clé]]

@puce@ Se ofrecerán dos soluciones para generar la pequeña ventana automática que aparece al pasar el ratón por encima. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Glosario interno',
	'glossaire_abbr' => 'Ignorer les balises <code><abbr></code> et <code><acronym></code>', # NEW
	'glossaire_css' => 'Solución CSS',
	'glossaire_erreur' => 'Le mot «@mot1@» rend indétectable le mot «@mot2@»', # NEW
	'glossaire_inverser' => 'Correction proposée : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Solución JavaScript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) étudié(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Reemplaza automáticamente las comillas rectas (") por las comillas tipográficas en el idioma de composición. El reemplazo, transparente para el usuario, no modifica el texto original sino sólo su presentación final.',
	'guillemets:nom' => 'Comillas tipográficas',

	// H
	'help' => '{{Esta página sólo es accesible para los responsables del sitio.}} Permite la configuración de las diversas funciones suplementarias aportadas por el plugin «{{La Navaja Suiza}}».',
	'help2' => 'Version local: @version@',
	'help3' => '<p>Enlaces a documentación:<br/>• [La Navaja Suisza->http://www.spip-contrib.net/La-navaja-suiza]@contribs@</p><p>Reinicializaciones:
_ • [De las herramientas ocultas|Volver al aspecto inicial de esta página->@hide@]
_ • [De todo el plugin|Volver al estado inicial del plugin->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Outil en cours de développement. Vous offre une horloge JavaScript . Balise : <code>#HORLOGE</code>. Modèle : <code><horloge></code>

Arguments disponibles : {zone}, {format} et/ou {id}.', # NEW
	'horloge:nom' => 'Horloge', # NEW

	// I
	'icone_visiter:description' => 'Reemplaza la imagen del botón estándar «Visitar» (en la esquina superior derecha de esta página)  por el logo del sitio, si existe.

Para definir el logo, entra en la página de «Configuración de sitio» pulsando el botón «Configuración».', # MODIF
	'icone_visiter:nom' => 'Botón «Visitar»', # MODIF
	'insert_head:description' => 'Activa automáticamente la baliza [#INSERT_HEAD->http://www.spip.net/es_article2132.html] en todos los esqueletos, tengan o no esta baliza entre &lt;head&gt; y &lt;/head&gt;. Gracias a esta opción, los plugins podrán insertar JavaScript (.js) u hojas de estilo (.css).',
	'insert_head:nom' => 'Baliza #INSERT_HEAD',
	'insertions:description' => 'ATENCIÓN : ¡¡herramienta en fase de desarrollo!! [[%insertions%]]',
	'insertions:nom' => 'Correcciones automáticas',
	'introduction:description' => 'Esta baliza situada en los esqueletos se usa, en general, en portada o en las secciones para producir un resumen de los art&iacute;culos, las breves, etc.</p>
<p>{{Atenci&oacute;n}} : Antes de activar esta funci&oacute;n, comprueba bien que no exista ninguna otra funci&oacute;n {balise_INTRODUCTION()} en tu esqueleto o en tus plugins, porque entonces la sobrecarga producir&aacute; un error de compilaci&oacute;n.</p>
@puce@ Puedes precisar (en porcentaje respecto al valor utilizado por omisi&oacute;n) la longitud del texto devuelto por la baliza #INTRODUCTION. Un valor nulo o igual a 100 no modifica el aspecto de la introducci&oacute;n utilizando en este caso los siguientes valores por omisi&oacute;n: 500 caracteres para los art&iacute;culos, 300 para las breves y 600 para los foros o las secciones.
[[%lgr_introduction%&nbsp;%]]
@puce@ Por omisi&oacute;n, los puntos de seguir a&ntilde;adidos al resultado de la baliza #INTRODUCTION si el texto es m&aacute;s largo son: <html>&laquo;&amp;nbsp;(…)&raquo;</html>. Puedes precisar aqu&iacute; tu propia cadena de caracteres para indicar al lector que el texto truncado contin&uacute;a.
[[%suite_introduction%]]
@puce@ Si se usa la baliza #INTRODUCTION para resumir un art&iacute;culo, la Navaja Suiza puede fabricar un enlace de hipertexto en los puntos de seguir definidos anteriormente para dirigir al lector hacia el texto original. Por ejemplo: &laquo;Leer el resto del art&iacute;culo…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'Baliza #INTRODUCTION',

	// J
	'jcorner:description' => '«Esquinas Bonitas» es una herramienta que permite modificar fácilmente el aspecto de las esquinas de los {{recuadros coloreados}} en la parte pública del sitio web. ¡Todo es posible, o casi!
_ Comprueba el resultado en esta página: [->http://www.malsup.com/jquery/corner/].

Pon en la lista de más abajo los objetos de tu esqueleto a redondear, utilizando la sintaxis CSS (.class, #id, etc. ). Utiliza el signo « = » para especificar la orden jQuery a utilizar y una doble barra (« // ») para los comentarios. En ausencia del signo igual, se aplicarán esquinas redondeadas (equivalente a: <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Atención, esta herramienta necesita el plugin {jQuery} : {Round Corners} para funcionar. La Navaja Suiza puede instalarlo directamente si marcas la casilla siguiente. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Esquinas Bonitas',
	'jcorner_plugin' => '« Plugin Round Corners »',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Por omisión',
	'js_jamais' => 'Nunca',
	'js_toujours' => 'Siempre',
	'jslide_aucun' => 'Aucune animation', # NEW
	'jslide_fast' => 'Glissement rapide', # NEW
	'jslide_lent' => 'Glissement lent', # NEW
	'jslide_millisec' => 'Glissement durant :', # NEW
	'jslide_normal' => 'Glissement normal', # NEW

	// L
	'label:admin_travaux' => 'Cerrar el sitio público por:',
	'label:alinea' => 'Champ d\'application :', # NEW
	'label:alinea2' => 'Sauf :', # NEW
	'label:alinea3' => 'Désactiver la prise en compte des alinéas :', # NEW
	'label:arret_optimisation' => 'Impedir que SPIP vacíe la papelera automáticamente:',
	'label:auteur_forum_nom' => 'Le visiteur doit spécifier :', # NEW
	'label:auto_sommaire' => 'Crear un sumario automáticamente:',
	'label:balise_decoupe' => 'Activar la baliza #CS_DECOUPE :',
	'label:balise_sommaire' => 'Activar la baliza #CS_SOMMAIRE:',
	'label:bloc_h4' => 'Balise pour les titres :', # NEW
	'label:bloc_unique' => 'Un solo bloque abierto en la página:',
	'label:blocs_cookie' => 'Utilisation des cookies :', # NEW
	'label:blocs_slide' => 'Type d\'animation :', # NEW
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal réservé aux copies locales :', # NEW
	'label:couleurs_fonds' => 'Permitir los fondos:',
	'label:cs_rss' => 'Activar:',
	'label:debut_urls_propres' => 'Comienzo de las URLs:',
	'label:decoration_styles' => 'Tus balizas de estilo personalizado:',
	'label:derniere_modif_invalide' => 'Recalcular inmediatamente después de una modificación:',
	'label:devdebug_espace' => 'Filtrage de l\'espace concerné :', # NEW
	'label:devdebug_mode' => 'Activer le débogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoyé :', # NEW
	'label:distant_off' => 'Desactivar:',
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Carpeta(s) a utilizar:',
	'label:duree_cache' => 'Duración de la caché local:',
	'label:duree_cache_mutu' => 'Duración de la caché en mutualización:',
	'label:enveloppe_mails' => 'Petite enveloppe devant les mails :', # NEW
	'label:expo_bofbof' => 'Escritura como exponentes para: <html>St(e)(s), Bx, Bd(s) y Fb(s)</html>',
	'label:filtre_gravite' => 'Gravité maximale acceptée :', # NEW
	'label:forum_lgrmaxi' => 'Valor (en caracteres):',
	'label:glossaire_groupes' => 'Grupo(s) utilizado(s):',
	'label:glossaire_js' => 'Técnica utilizada:',
	'label:glossaire_limite' => 'Número máximo de enlaces creados:',
	'label:i_align' => 'Alignement du texte :', # NEW
	'label:i_couleur' => 'Couleur de la police :', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (éq. à {line-height}) :', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte :', # NEW
	'label:i_padding' => 'Espacement autour du texte (éq. à {padding}) :', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/}) :', # NEW
	'label:i_taille' => 'Taille de la police :', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Correcciones automáticas:',
	'label:jcorner_classes' => 'Mejorar las esquinas de las selecciones siguientes:', # MODIF
	'label:jcorner_plugin' => 'Instalar el siguiente plugin {jQuery}:',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'Tamaño del resumen:',
	'label:lgr_sommaire' => 'Tamaño del sumario (9 a 99):',
	'label:lien_introduction' => 'Puntos de seguir pulsables:',
	'label:liens_interrogation' => 'Proteger las URLs:',
	'label:liens_orphelins' => 'Enlaces pulsables:',
	'label:log_couteau_suisse' => 'Activar:',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:long_url' => 'Longueur du libellé cliquable :', # NEW
	'label:marqueurs_urls_propres' => 'Añadir los marcadores que separan los objetos (SPIP>=2.0) :<br/>(ej. : « - » para -Mi-sección-, « @ » para @Mi-sitio@) ', # MODIF
	'label:max_auteurs_page' => 'Autores por página:',
	'label:message_travaux' => 'Tu mensaje de mantenimiento:',
	'label:moderation_admin' => 'Validar automáticamente los mensajes de los: ',
	'label:mot_masquer' => 'Mot-clé masquant les contenus :', # NEW
	'label:nombre_de_logs' => 'Rotation des fichiers :', # NEW
	'label:ouvre_note' => 'Ouverture et fermeture des notes de bas de page', # NEW
	'label:ouvre_ref' => 'Ouverture et fermeture des appels de notes de bas de page', # NEW
	'label:paragrapher' => 'Siempre hacer párrafos:',
	'label:prive_travaux' => 'Accesibilidad del espacio privado por:',
	'label:prof_sommaire' => 'Profondeur retenue (1 à 4) :', # NEW
	'label:puce' => 'Viñeta gráfica pública «<html>-</html>»:',
	'label:quota_cache' => 'Valor de la cuota de caché:',
	'label:racc_g1' => 'Entrada y salida del cambio a «<html>{{negrita}}</html>»:',
	'label:racc_h1' => 'Entrada y salida de un «<html>{{{intertítulo}}}</html>»:',
	'label:racc_hr' => 'Línea horizontal «<html>----</html>»:',
	'label:racc_i1' => 'Entrada y salida del cambio a «<html>{itálica}</html>»:',
	'label:radio_desactive_cache3' => 'Uso de la caché:',
	'label:radio_desactive_cache4' => 'Uso de la caché:',
	'label:radio_target_blank3' => 'Enlaces externos en ventana nueva:',
	'label:radio_type_urls3' => 'Formato de las URLs:',
	'label:scrollTo' => 'Instalar los plugins {jQuery} siguientes:',
	'label:separateur_urls_page' => 'Carácter de separación \'type-id\'<br/>(ej.: ?article-123):', # MODIF
	'label:set_couleurs' => 'Esquema a utilizar:',
	'label:spam_ips' => 'Adresses IP à bloquer :', # NEW
	'label:spam_mots' => 'Secuencias prohibidas:',
	'label:spip_options_on' => 'Incluir:',
	'label:spip_script' => 'Script de llamada:',
	'label:style_h' => 'Tu estilo:',
	'label:style_p' => 'Tu estilo:',
	'label:suite_introduction' => 'Puntos de seguir:',
	'label:terminaison_urls_page' => 'Terminación de las URLs (ej.: «.html»):',
	'label:titre_travaux' => 'Título del mensaje:',
	'label:titres_etendus' => 'Activar el uso extendido de las balizas #TITRE_XXX:',
	'label:tout_rub' => 'Afficher en public tous les objets suivants :', # NEW
	'label:url_arbo_minuscules' => 'Conservar los espacios de los títulos en las URLs:',
	'label:url_arbo_sep_id' => 'Carácter de separación \'titre-id\' en caso de duplicidad:<br/>(no utilizar \'/\')', # MODIF
	'label:url_glossaire_externe2' => 'Enlace al glosario externo:',
	'label:url_max_propres' => 'Longueur maximale des URLs (caractères) :', # NEW
	'label:urls_arbo_sans_type' => 'Mostrar el tipo de objeto SPIP en las URLs:',
	'label:urls_avec_id' => 'Un id systématique, mais...', # NEW
	'label:webmestres' => 'Lista de los y las webmasters del sitio:',
	'liens_en_clair:description' => 'Pone a tu disposición el filtro: \'liens_en_clair\'. Probablemente tu texto contiene enlaces de hipertexto que no son visibles al imprimir. Este filtro añade entre corchetes el destino de cada enlace pulsable (enlaces externos o de correo). Atención: en el modo de impresión (parámetro \'cs=print\' o \'page=print\' en la url de la página), esta característica se aplica automáticamente.',
	'liens_en_clair:nom' => 'Ver enlaces',
	'liens_orphelins:description' => 'Esta herramienta tiene dos aplicaciones:

@puce@ {{Enlaces correctos}}.

SPIP habitualmente inserta un espacio antes de los signos de interrogación o de exclamación, según la ortografía francesa. Esta herramienta protege el signo de interrogación en las URLs de tus textos.[[%liens_interrogation%]]

@puce@ {{Enlaces huérfanos}}.

Reemplaza automáticamente todas las URLs escritas como texto por los usuarios (sobre todo en los foros) y que, por lo tanto, no son pulsables, por enlaces de hipertexto en formato SPIP. Por ejemplo: {<html>www.spip.net</html>} se reemplaza por [->www.spip.net].

Puedes elegir el tipo de reemplazo:
_ • {Básico}: se reemplazan los enlaces del tipo {<html>http://spip.net</html>} (todos los protocolos) o {<html>www.spip.net</html>}.
_ • {Extendido}: se reemplazan además los enlaces del tipo {<html>yo@spip.net</html>}, {<html>mailto:micorreo</html>} o {<html>news:misnews</html>}.
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:description1' => '[[Si l\'URL rencontrée dépasse les %long_url% caractères, alors SPIP la réduit à %coupe_url% caractères]].', # NEW
	'liens_orphelins:nom' => 'Buenas URLs',
	'local_ko' => 'La mise à jour automatique du fichier local «@file@» a échoué. Si l\'outil dysfonctionne, tentez une mise à jour manuelle.', # NEW
	'log_brut' => 'Données écrites en format brut (non HTML)', # NEW
	'log_fileline' => 'Informations supplémentaires de débogage', # NEW

	// M
	'mailcrypt:description' => 'Enmascara todos los enlaces de correo presentes en los textos y los reemplaza por un enlace JavaScript que permite activar igual la aplicación de correo del lector. Esta herramienta antispam intenta impedir que los robots recojan las direcciones electrónicas escritas en claro en los foros o en las balizas de tus esqueletos.',
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
	'message_perso' => 'Muchas gracias a los traductores que pasaron por aquí. Pat ;-)',
	'moderation_admins' => 'administradores autentificados',
	'moderation_message' => 'Este foro está moderado a priori: tu contribución no aparecerá hasta que haya sido validada por un administrador del sitio, salvo si te has identificado y estás autorizado a escribir directamente.',
	'moderation_moderee:description' => 'Permite moderar la moderación de los foros públicos <b>configurados a priori</b> por los usuarios inscritos.<br />Por ejemplo: Si soy el webmaster de mi sitio, y respondo al mensaje de un usuario, ¿por qué debo validar mi propio mensaje? ¡Moderación moderada lo hace para mí!  [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Moderación moderada',
	'moderation_redacs' => 'redactores autentificados',
	'moderation_visits' => 'visitantes autentificados',
	'modifier_vars' => 'Modificar estos @nb@ parámetros',
	'modifier_vars_0' => 'Modificar estos parámetros',

	// N
	'no_IP:description' => 'Desactiva el mecanismo de registro automático de las direcciones IP de los visitantes de tu sitio para mantener la confidencialidad: SPIP ya no guardará ningún número IP, ni temporalmente durante las visitas (para gestionar las estadísticas o alimentar spip.log), ni en los foros (responsabilidad).',
	'no_IP:nom' => 'No almacenar IP',
	'nouveaux' => 'Nuevos',

	// O
	'orientation:description' => '3 nuevos criterios para tus esqueletos : <code>{portrait}</code> (retrato), <code>{carre}</code> (cuadrado) y <code>{paysage}</code> (paisaje). Ideal para la clasificación de las fotos en función de su forma.',
	'orientation:nom' => 'Orientación de las imágenes',
	'outil_actif' => 'Herramienta activa',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activar',
	'outil_activer_le' => 'Activar la herramienta',
	'outil_actualiser' => 'Actualiser l\'outil', # NEW
	'outil_cacher' => 'No volver a mostrar',
	'outil_desactiver' => 'Desactivar',
	'outil_desactiver_le' => 'Desactivar la herramienta',
	'outil_inactif' => 'Herramienta inactiva',
	'outil_intro' => 'Esta página lista las funciones que el plugin pone a tu disposición.<br /><br />Pulsando sobre el nombre de los útiles de más abajo, los seleccionas y podrás cambiar su estado con ayuda del botón central: los útiles activados se desactivarán y <i>viceversa</i>. Con cada pulsación, aparece la descripción bajo las listas. Las categorías son desplegables y los útiles se pueden ocultar. El doble-clic permite cambiar rápidamente de herramienta.<br /><br />En la primera utilización, se recomienda activar las herramientas una a una, por si acaso apareciese alguna incompatibilidad con tu esqueleto, con SPIP o con otros plugins.<br /><br />Nota: la simple carga de esta página recompila el conjunto de herramientas de la Navaja Suiza.',
	'outil_intro_old' => 'Esta interfaz está anticuada.<br /><br />Si encuentras problemas para utilizar la <a href=\'./?exec=admin_couteau_suisse\'>nueva interfaz</a>, no dudes en avisarnos en el foro de <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@: @nb@ útil', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ útiles', # MODIF
	'outil_permuter' => '¿Cambiar la herramienta: « @text@ »?',
	'outils_actifs' => 'Herramientas activadas:',
	'outils_caches' => 'Herramientas ocultas:',
	'outils_cliquez' => 'Pulsa sobre el nombre de los útiles de arriba para ver aquí su descripción.',
	'outils_concernes' => 'Sont concernés : ', # NEW
	'outils_desactives' => 'Sont désactivés : ', # NEW
	'outils_inactifs' => 'Herramientas inactivas:',
	'outils_liste' => 'Lista de herramientas de La Navaja Suiza',
	'outils_non_parametrables' => 'Non paramétrables :', # NEW
	'outils_permuter_gras1' => 'Cambiar los útiles en negrita',
	'outils_permuter_gras2' => '¿Cambiar los @nb@ útiles en negrita?',
	'outils_resetselection' => 'Reinicializar la selección',
	'outils_selectionactifs' => 'Seleccionar todos los útiles activos',
	'outils_selectiontous' => 'TODOS',

	// P
	'pack_actuel' => 'Paquete @date@',
	'pack_actuel_avert' => 'Atención, las sobrecargas para los define() o los globales no se especifican aquí', # MODIF
	'pack_actuel_titre' => 'PAQUETE ACTUAL DE CONFIGURACIÓN DE LA NAVAJA SUIZA',
	'pack_alt' => 'Ver los parámetros de configuración actual',
	'pack_delete' => 'Supression d\'un pack de configuration', # NEW
	'pack_descrip' => 'Tu «Paquete de configuración actual» reúne el conjunto de parámetros de configuración actuales relativos a la Navaja Suiza: la activación de los útiles y el valor de sus eventuales variables.

Si los permisos de escritura lo permiten, este código PHP puede situarse en el archivo {{/config/mes_options.php}} y añadir un enlace de reinicialización en esta página del paquete «{@pack@}». Por supuesto puedes cambiarle el nombre.

Si reinicializas el plugin pulsando en un paquete, la Navaja Suiza volverá a configurarse automáticamente en función de los parámetros predefinidos en ese paquete.', # MODIF
	'pack_du' => '• del pack @pack@', # MODIF
	'pack_installe' => 'Colocación de un pack de configuración',
	'pack_installer' => '¿Confirmas que deseas reinicializar la Navaja Suiza e instalar el paquete « @pack@ »?',
	'pack_nb_plrs' => 'Actualmente hay @nb@ «paquetes de configuración» disponibles.', # MODIF
	'pack_nb_un' => 'Actualmente hay un «paquete de configuración» disponible', # MODIF
	'pack_nb_zero' => 'No hay ningún «paquete de configuración» disponible actualmente.',
	'pack_outils_defaut' => 'Herramientas de instalación por default ',
	'pack_sauver' => 'Guardar la configuración actual',
	'pack_sauver_descrip' => 'El botón de más abajo permite insertar directamente en el archivo <b>@file@</b> los parámetros necesarios para añadir un «paquete de configuración » en el menú de la izquierda. Esto te permitirá después devolver con un clic la Navaja Suiza al estado de configuración en que está actualmente.',
	'pack_supprimer' => 'Êtes-vous sûr de vouloir supprimer le pack « @pack@ » ?', # NEW
	'pack_titre' => 'Configuración Actual',
	'pack_variables_defaut' => 'Instalación de variables por defecto',
	'par_defaut' => 'Por omisión',
	'paragrapher2:description' => 'La función SPIP <code>paragrapher()</code> inserta balizas &lt;p&gt; y &lt;/p&gt; en todos los textos desprovistos de párrafo. Para de un ajuste más fino de tus estilos y compaginaciones, tienes la posibilidad de uniformizar el aspecto de los textos de tu sitio.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Párrafos',
	'pipelines' => 'Pipelines utilizadas:',
	'previsualisation:description' => 'Par défaut, SPIP permet de prévisualiser un article dans sa version publique et stylée, mais uniquement lorsque celui-ci a été « proposé à l’évaluation ». Hors cet outil permet aux auteurs de prévisualiser également les articles pendant leur rédaction. Chacun peut alors prévisualiser et modifier son texte à sa guise.

@puce@ Attention : cette fonctionnalité ne modifie pas les droits de prévisualisation. Pour que vos rédacteurs aient effectivement le droit de prévisualiser leurs articles « en cours de rédaction », vous devez l’autoriser (dans le menu {[Configuration&gt;Fonctions avancées->./?exec=config_fonctions]} de l’espace privé).', # NEW
	'previsualisation:nom' => 'Prévisualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci «*»', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Reemplaza las viñetas «-» (guión simple) de los artículos por listas anotadas «-*» (traducidas en HTML como: &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) cuyo estilo puede personalizars mediante css.', # MODIF
	'pucesli:nom' => 'Viñetas mejoradas',

	// Q
	'qui_webmestres' => 'Les webmestres SPIP', # NEW

	// R
	'raccourcis' => 'Atajos tipográficos activos de la Navaja Suiza:',
	'raccourcis_barre' => 'Los atajos tipográficos de la Navaja Suiza',
	'rafraichir' => 'Afin de terminer la configuration du plugin, merci d\'actualiser la page courante.', # NEW
	'reserve_admin' => 'Acceso reservado a los administradores.',
	'rss_actualiser' => 'Actualizar',
	'rss_attente' => 'Esperando RSS...',
	'rss_desactiver' => 'Desactivar las « Revisiones de la Navaja Suiza »',
	'rss_edition' => 'Flujo RSS actualizado el:',
	'rss_source' => 'Origen RSS',
	'rss_titre' => '« La Navaja Suiza » en desarrollo:',
	'rss_var' => 'Las revisiones de La Navaja Suiza',

	// S
	'sauf_admin' => 'Todos, salvo los administradores',
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et rédacteurs', # NEW
	'sauf_identifies' => 'Tous, sauf les auteurs identifiés', # NEW
	'sessions_anonymes:description' => 'Chaque semaine, cet outil vérifie les sessions anonymes et supprime les fichiers qui sont trop anciens (plus de @_NB_SESSIONS3@ jours) afin de ne pas surcharger le serveur, notamment en cas de SPAM sur le forum.

Dossier stockant les sessions : @_DIR_SESSIONS@

Votre site stocke actuellement @_NB_SESSIONS1@ fichier(s) de session, @_NB_SESSIONS2@ correspondant à des sessions anonymes.', # NEW
	'sessions_anonymes:nom' => 'Sessions anonymes', # NEW
	'set_options:description' => 'Selecciona automáticamente el tipo de interfaz privada (simplificada o avanzada) para todos los redactores existentes o futuros y suprime el botón correspondiente de la banda de pequeños iconos.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Tipo de interfaz privada',
	'sf_amont' => 'Anterior',
	'sf_tous' => 'Todos',
	'simpl_interface:description' => 'Desactiva el menú de cambio rápido del estado de un artículo al pasar sobre su icono de color. Esto resulta útil si buscas obtener una interfaz privada lo más sencilla posible para optimizar el rendimiento del cliente.',
	'simpl_interface:nom' => 'Aligerar la interfaz privada',
	'smileys:aide' => 'Smileys: @liste@',
	'smileys:description' => 'Inserta «smileys» en todos los textos donde aparezca un atajo de tipo <acronym>:-)</acronym>. Ideal para los foros.
_ Hay una baliza disponible para mostrar una tabla de smileys en tus esqueletos: #SMILEYS.
_ Dibujos: [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'Añade al sitio público un desplazamiento suave de la página cuando el visitante hace clic en un enlace que apunta a un ancla: muy útil para evitar perderse en una página compleja u en un texto muy largo...

Atención, para que funcione esta herramienta se necesitan páginas con «DOCTYPE XHTML» (¡no HTML!) y dos plugins {jQuery}: {ScrollTo} y {LocalScroll}. La Navaja Suiza puede instalarlos directamente si marcas las casillas siguientes. [[%scrollTo%]][[->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Anclas suaves',
	'sommaire:description' => 'Construye un sumario para el texto de tus artículos y secciones con el fin de acceder rápidamente a los intertítulos (etiquetas HTML &lt;h3>Un intertítulo&lt;/h3> o atajos de SPIP: intertítulos de la forma: <code>{{{Un intertítulo}}}</code>).

@puce@ Aquí puedes definir el número máximo de caracteres tomados de los intertítulos para construir el sumario: [[%lgr_sommaire% caracteres]]

@puce@ También puedes regular el comportamiento del plugin respecto a la creación de sumario: 
_ • Por sistema para cada artículo (una baliza <code>>@_CS_SANS_SOMMAIRE@</code> situada en cualquier lugar del texto del artículo creará una excepción).
_ • Únicamente para los artículos que contengan la baliza <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Por omisión, la Navaja Suiza inserta el sumario automáticamente en el encabezamiento del artículo. Pero tienes la posibilidad situar este sumario en otro lugar de tu esqueleto gracias a una baliza #CS_SOMMAIRE que puedes activar aquí:
[[%balise_sommaire%]]

Este sumario puede combinarse con: « [.->decoupe] ».', # MODIF
	'sommaire:nom' => 'Un sumario automático', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre<mon_ancre>}}}</html></b>', # NEW
	'sommaire_avec' => 'Un texto con sumario: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un texto sin sumario: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hiérarchisés : <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Intenta luchar contra los envíos de mensajes automáticos y malintencionados en la parte pública. Ciertas palabras y las etiquetas &lt;a>&lt;/a> están prohibidas.

Lista aquí las secuencias prohibidas@_CS_ASTER@ separándolas por espacios. [[%spam_mots%]]
@_CS_ASTER@Para especificar una palabra completa, ponla entre paréntesis. Para una expresión con espacios, ponla entre comillas.', # MODIF
	'spam:nom' => 'Lucha contra el SPAM',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Ce message serait bloqué par le filtre anti-SPAM !', # NEW
	'spam_test_ok' => 'Ce message serait accepté par le filtre anti-SPAM.', # NEW
	'spam_tester_bd' => 'Testez également votre votre base de données et listez les messages qui auraient été bloqués par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Afin de tester votre liste de séquences interdites ou d\'adresses IP, utilisez le cadre suivant :', # NEW
	'spip_cache:description' => '@puce@ La caché ocupa un cierto espacio en disco y SPIP puede limitar su extensión. Un valor vacío o igual a 0 significa que no se aplica ninguna cuota.[[%quota_cache% Mo]]

@puce@ Cuando se hace una modificación del contenido del sitio, SPIP invalida inmediatamente la caché sin esperar el siguiente cálculo periódico. Si tu sitio tiene problemas de rendimiento debidos a una carga muy alta, puedes marcar « no » en esta opción.[[%derniere_modif_invalide%]

@puce@ Si la baliza #CACHE no se encuentra en tus esqueletos locales, SPIP considera por omisión que la caché de una página tiene un tiempo de vida de 24 horas antes de recalcularla. Para gestionar mejor la carga en tu servidor, puedes modificar este valor aquí.[[%duree_cache% heures]]

@puce@ Si tienes varios sitios mutualizados, puedes especificar aquí el valor por omisión que se toma para todos los sitios locales (SPIP 2.0 mini).[[%duree_cache_mutu% horas]]', # MODIF
	'spip_cache:description1' => '@puce@ Por omisión, SPIP calcula todas las páginas públicas y las sitúa en la caché para acelerar la consulta. Desactivar temporalmente la caché puede ayudar durante el desarrollo del sitio. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ Cuatro opciones para orientar el funcionamiento de la caché de SPIP: <q1>
_ • {Uso normal}: SPIP calcula todas las páginas públicas y las pone en la caché para acelerar la consulta. Tras un cierto intervalo, la caché se recalcula y se guarda.
_ • {Caché permanente}: los intervalos de invalidación de la caché se ignoran.
_ • {Sin caché}: desactivar temporalmente la caché puede ayudar mientras se desarrolla el sitio. Aquí, no se guarda nada en el disco.
_ • {Control de la caché}: opción idéntica a la anterior, con escritura en el disco de todos los resultados para poder controlarlos si hace falta.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension « Compresseur » présente dans SPIP permet de compacter les différents éléments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela accélère l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers à obtenir.', # NEW
	'spip_cache:nom' => 'SPIP y la caché…',
	'spip_ecran:description' => 'Détermine la largeur d\'écran imposée à tous en partie privée. Un écran étroit présentera deux colonnes et un écran large en présentera trois. Le réglage par défaut laisse l\'utilisateur choisir, son choix étant stocké dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'écran', # NEW
	'spip_log:description' => '@puce@ Gérez ici les différents paramètres pris en compte par SPIP pour mettre en logs les évènements particuliers du site. Fonction PHP à utiliser : <code>spip_log()</code>.@SPIP_OPTIONS@
[[Ne conserver que %nombre_de_logs% fichier(s), chacun ayant pour taille maximale %taille_des_logs% Ko.<br /><q3>{Mettre à zéro l\'une de ces deux cases désactive la mise en log.}</q3>]][[@puce@ Dossier où sont stockés les logs (laissez vide par défaut) :<q1>%dir_log%{Actuellement :} @DIR_LOG@</q1>]][[->@puce@ Fichier par défaut : %file_log%]][[->@puce@ Extension : %file_log_suffix%]][[->@puce@ Pour chaque hit : %max_log% accès par fichier maximum]]', # NEW
	'spip_log:description2' => '@puce@ Le filtre de gravité de SPIP permet de sélectionner le niveau d\'importance maximal à prendre en compte avant la mise en log d\'une donnée. Un niveau 8 permet par exemple de stocker tous les messages émis par SPIP.[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]', # NEW
	'spip_log:description3' => '@puce@ Les logs spécifiques au Couteau Suisse s\'activent ici : «[.->cs_comportement]».', # NEW
	'spip_log:nom' => 'SPIP et les logs', # NEW
	'stat_auteurs' => 'Estado de los autores',
	'statuts_spip' => 'Únicamente los siguientes estados SPIP:',
	'statuts_tous' => 'Todos los estados',
	'suivi_forums:description' => 'El autor de un artículo siempre es informado cuando se publique un mensaje en el foro público asociado. Pero es posible avisar además: a todos los participantes en el foro, o solamente a los autores de los mensajes previos del hilo.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Seguimiento de los foros públicos',
	'supprimer_cadre' => 'Suprimir este cuadro',
	'supprimer_numero:description' => 'Aplica la función SPIP supprimer_numero() al conjunto de {{títulos}}, de {{nombres}} y de {{tipos}} (de palabras-clave) del sitio público, sin que el filtro supprimer_numero esté presente en los esqueletos.<br />Esta es la sintaxis a utilizar en el caso de un sitio multilingüe: <code>1. <multi>Mi Título[en]My Title[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Suprime el número',

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
	'titre' => 'La Navaja Suiza',
	'titre_parent:description' => 'En el interior de un bucle, es habitual que se quiera mostrar el título del padre del objeto en curso. Tradicionalmente, bastaba utilizar un segundo bucle, pero esta nueva baliza #TITRE_PARENT aligerará la escritura de tus esqueletos. El resultado devuelto es: el título del grupo de una palabra-clave o el de la sección padre (si existe) de cualquier otro objeto (artículo, sección, breve, etc.).

Nota: Para las palabras-clave, un alias de #TITRE_PARENT es #TITRE_GROUPE. El tratamiento por SPIP de estas balizas nuevas es similar al de #TITRE.

@puce@ Si utilizas SPIP 2.0, aquí tienes disponible todo un conjunto de balizas #TITRE_XXX que podrán devolver el título del objeto \'xxx\', a condición de que el campo \'id_xxx\' esté presente en la tabla en curso (#ID_XXX utilizable en el bucle en curso).

Por ejemplo, en un bucle sobre (ARTICLES), #TITRE_SECTEUR devolverá el título del sector en el que está situado el artículo en curso, pues el identificador #ID_SECTEUR (o el campo \'id_secteur\') está disponible en ese caso.

Igualmente está soportada la sintaxis <html>#TITRE_XXX{yy}</html>. Ejemplo: <html>#TITRE_ARTICLE{10}</html> devolverá el título del artículo #10.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Balizas #TITRE_PARENT/OBJET',
	'titre_tests' => 'La Navaja Suiza - Página de pruebas…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>« {{{Mon intertitre}}} »</html> en image typographique paramétrable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : « [.->sommaire] ».', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'titres_typographies:description' => 'Par défaut, les raccourcis typographiques de SPIP <html>({, {{, etc.)</html> ne s\'appliquent pas aux titres d\'objets dans vos squelettes.
_ Cet outil active donc l\'application automatique des raccourcis typographiques de SPIP sur toutes les balises #TITRE et apparentées (#NOM pour un auteur, etc.).

Exemple d\'utilisation : le titre d\'un livre cité dans le titre d\'un article, à mettre en italique.', # NEW
	'titres_typographies:nom' => 'Titres typographiés', # NEW
	'tous' => 'Todos',
	'toutes_couleurs' => 'Los 36 colores de los estilos css: @_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Bloques multilingües: <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'Del mismo modo que puedes hacer en los esqueletos, esta herramienta te permite utilizar libremente las cadenas de idioma (de SPIP o de tus esqueletos) en todos los contenidos del sitio (artículos, títulos, mensajes, etc.) con ayuda del atajo <code><:cadena:></code>.

Consulta [aquí ->http://www.spip.net/es_article2247.html] la documentación de SPIP sobre el tema.

Esta herramienta también acepta argumentos introducidos por SPIP 2.0. Por ejemplo, el atajo <code><:cadena{nombre=José García, edad=37}:></code> permite pasar dos parámetros en la cadena siguiente: <code>\'cadena\'=>"Hola, soy @nombre@ y tengo @edad@ años\\"</code>.

La función de SPIP utilizada en PHP es  <code>_T(\'cadena\')</code> sin argumentos, y <code>_T(\'cadena, array(\'arg1\'=>\'un texto\', \'arg2\'=>\'otro texto\'))</code> con argumentos.

No te olvides de verificar que la clave <code>\'cadena\'</code> esté bien definida en los ficheros de idiomas. ', # MODIF
	'toutmulti:nom' => 'Bloques multilingües',
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
	'travaux_prochainement' => 'Este sitio se reactivará en breve.
_ Gracias por la comprensión.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Elige aquí la ordenación que se usará para mostrar tus artículos dentro de las secciones cuando navegues por la parte privada del sitio ([->./?exec=auteurs]).

Las propuestas siguientes se basan en la función SQL \'ORDER BY\': utiliza la ordenación personalizada sólo si sabes muy bien lo que haces (campos disponibles: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Ordenación de los artículos', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'Ordenar por fecha de modificación (ORDER BY date_modif DESC)',
	'tri_perso' => 'Ordenación SQL personalizada, ORDER BY seguido por:',
	'tri_publi' => 'Ordenar por fecha de publicación (ORDER BY date DESC)',
	'tri_titre' => 'Ordenar por título (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Outil en cours de développement. Vous offre quelques balises très simples et bien pratiques pour améliorer la lisibilité de vos squelettes.

@puce@ {{#BOLO}} : génère un faux texte d\'environ 3000 caractères ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction spécifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ Un modèle est également disponible pour vos contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caractères de faux texte.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction spécifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalisez l\'affichage grâce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

@puce@ {{#CHR<html>{XX}</html>}} : balise équivalente à <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caractères spéciaux (le retour à la ligne par exemple) ou des caractères réservés par le compilateur de SPIP (les crochets ou les accolades).

@puce@ {{#LESMOTS}} : ', # NEW
	'trousse_balises:nom' => 'Trousse à balises', # NEW
	'type_urls:description' => '@puce@ SPIP te permite elegir entre varios tipos de URLs para crear los enlaces de acceso a las páginas de tu sitio:

Más información: [->http://www.spip.net/es_article2024.html]. La utilidad « [.->boites_privees] » te permite ver en la página de cada objeto SPIP la URL propia asociada.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@para utilizar los formatos {html}, {propre}, {propre2}, {libres} o {arborescentes}, copia el archivo "htaccess.txt" de la carpeta base del sitio SPIP y ponle el nombre ".htaccess" (primero haz una copia de seguridad, y ten cuidado para no borrar otros ajustes que podrías haber puesto en ese archivo); si tu sitio está como "subdirectorio", tendrás que editar también la línea "RewriteBase" de ese fichero. Las URLs definidas ahora se redirigirán hacia los ficheros de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs «page»}}: son los enlaces por omisión, utilizados por SPIP desde su versión 1.9x.
_ Ejemplo: <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs «html»}}: los enlaces tienen forma de páginas html clásicas.
_ Ejemplo: <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs «propres» (propias)}}: los enlaces se calculan mediante el título de los objetos solicitados. Los títulos se rodean con marcadores (_, -, +, @, etc.) en función del tipo de objeto.
_ Ejemplos: <code>/Mi-titulo-de-articulo</code> o <code>/-Mi-seccion-</code> o <code>/@Mi-sitio@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs «propres2» (propias 2)}}: se añade la extension \'.html\' a los enlaces {«propios»}.
_ Ejemplo: <code>/Mi-titulo-de-articulo.html</code> o <code>/-Mi-seccion-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs «libres»}}: los enlaces son {«propios»}, pero sin marcadores separando los objetos (_, -, +, @, etc.).
_ Ejemplo: <code>/Mi-titulo-de-articulo</code> o <code>/Mi-seccion</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs «arborescentes»}}: los enlaces son {«propios»}, pero de tipo ramificado.
_ Ejemplo: <code>/sector/seccion1/seccion2/Mi-titulo-de-articulo</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs «propres-qs»}}: este sistema funciona en "Query-String", es decir, sin utilizar .htaccess ; los enlaces son {«propios»}.
_ Ejemplo: <code>/?Mi-titulo-de-articulo</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs «propres-qs»}}: este sistema funciona en "Query-String", es decir, sin utilizar .htaccess ; los enlaces son {«propios»}.
_ Ejemplo: <code>/?Mi-titulo-de-articulo</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs «standard»}}: estos enlaces, que ya son obsoletos, se utilizaron por SPIP hasta su versión 1.8.
_ Ejemplo: <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Si utilizas el formato {page} de más arriba o si no se reconoce el objeto solicitado, te será posible elegir {{el script de llamada}} a SPIP. Por omisión, SPIP usa {spip.php}; pero {index.php} (ejemplo de formato: <code>/index.php?article123</code>) o un valor nulo (formato: <code>/?article123</code>) también funcionan. Para cualquier otro valor, te será absolutamente necesario crear el fichero correspondiente en la raíz de SPIP, a imagen del que ya existe: {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ Si utilizas un formato basado en URLs «propias» ({propres}, {propres2}, {libres}, {arborescentes} o {propres_qs}), la Navaja Suiza puede:
<q1>• Asegurar que la URL producida esté totalmente {{en minúsculas}}.
_ • Hacer que se añada sistemáticamente {{la id del objeto}} a su URL (como sufijo o prefijo).
_ (ejemplos: <code>/Mi-titulo-de-articulo,457</code> o <code>/457-Mi-titulo-de-articulo</code>)</q1>[[%urls_minuscules%]][[->%urls_avec_id%]][[->%urls_avec_id2%]]', # MODIF
	'type_urls:description2' => '{Note} : un changement dans ce paragraphe peut nécessiter de vider la table des URLs afin de permettre à SPIP de tenir compte des nouveaux paramètres.', # NEW
	'type_urls:nom' => 'Formato de las URLs',
	'typo_exposants:description' => '{{Textos en francés}}: mejora la presentación tipográfica de las abreviaturas corrientes, poniendo como superíndices los elementos necesarios (así, {<acronym>Mme</acronym>} se transforma en {M<sup>me</sup>}) y corrigiendo los errores comunes ({<acronym>2ème</acronym>} o  {<acronym>2me</acronym>}, por ejemplo, se transforman en {2<sup>e</sup>}, única abreviatura correcta).

Las abreviaturas obtenidas son conformes con las de la Imprenta nacional francesa, tal como se indican en el {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (artículo « Abréviations », presses de l\'Imprimerie nationale, Paris, 2002).

También se procesan las expresiones siguientes: <html>Dr, Pr, Mgr, m2, m3, Mn, Md, Sté, Éts, Vve, Cie, 1o, 2o, etc.</html>

Aquí puedes escoger escribir como superíndices otras abreviaturas suplementarias, que se desaconsejan por l\'Imprimerie nationale :[[%expo_bofbof%]]

{{Textos en inglés}}: paso a superíndice de los números ordinales: <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Abreviaturas tipográficas',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'página',
	'url_propres' => 'propres@_CS_ASTER@',
	'url_propres-qs' => 'propres-qs',
	'url_propres2' => 'propres2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'standard',
	'url_verouillee' => 'URL verrouillée', # NEW
	'urls_3_chiffres' => 'Imposer un minimum de 3 chiffres', # NEW
	'urls_avec_id' => 'Id sistematicamente como sufijo', # MODIF
	'urls_avec_id2' => 'Id sistemáticamente como prefijo', # MODIF
	'urls_base_total' => 'Actualmente hay @nb@ URL(s) en la base',
	'urls_base_vide' => 'La base de datos de URLs está vacía',
	'urls_choix_objet' => 'Edición basada en la URL de un objeto específico:',
	'urls_edit_erreur' => 'El formato actual de las URLs (« @type@ ») no permite la edición.',
	'urls_enregistrer' => 'Grabar esta URL en la base',
	'urls_id_sauf_rubriques' => 'Exclure les objets suivants (séparés par « : ») :', # NEW
	'urls_minuscules' => 'Letras minúsculas',
	'urls_nouvelle' => 'Editar la URL «propres» (propia):', # MODIF
	'urls_num_objet' => 'Número:',
	'urls_purger' => 'Vaciar todo',
	'urls_purger_tables' => 'Vaciar las tablas seleccionadas',
	'urls_purger_tout' => 'Reinicializar las URLs guardadas en la base:',
	'urls_rechercher' => 'Buscar este objeto en la base',
	'urls_titre_objet' => 'Título grabado:',
	'urls_type_objet' => 'Objeto:',
	'urls_url_calculee' => 'URL pública « @type@ »:',
	'urls_url_objet' => 'URL «propres» (propia) grabada:', # MODIF
	'urls_valeur_vide' => '(Un valor vacío implica recalcular la URL)', # MODIF
	'urls_verrouiller' => '{{Verrouiller}} cette URL afin que SPIP ne la modifie plus, notamment lors d\'un clic sur « @voir@ » ou d\'un changement du titre de l\'objet.', # NEW

	// V
	'validez_page' => 'Para acceder a las modificaciones:',
	'variable_vide' => '(Vacío)',
	'vars_modifiees' => 'Los datos se han modificado correctamente',
	'version_a_jour' => 'Tu versión está actualizada.',
	'version_distante' => 'Versión distante...',
	'version_distante_off' => 'Comprobación externa desactivada',
	'version_nouvelle' => 'Nueva versión: @version@',
	'version_revision' => 'Revisión: @revision@',
	'version_update' => 'Actualización automática',
	'version_update_chargeur' => 'Descarga automática',
	'version_update_chargeur_title' => 'Descargar la última versión del plugin mediante el plugin «Descargador»',
	'version_update_title' => 'Descarga la última versión del plugin y efectúa su actualización automática',
	'verstexte:description' => '2 filtros para tus esqueletos, que permiten producir páginas más ligeras.
_ version_texte : extrae el texto contenido en una página html excluyendo algunas balizas elementales.
_ version_plein_texte : extrae el texto contenido en una página html para mostrarlo como texto puro.', # MODIF
	'verstexte:nom' => 'Versión texto',
	'visiteurs_connectes:description' => 'Añade un fragmento a tu esqueleto que muestra el número de visitantes conectados en el sitio público.

Añade sencillamente <code><INCLURE{fond=fonds/visiteurs_connectes}></code> en tus páginas.', # MODIF
	'visiteurs_connectes:inactif' => 'Attention : les statistiques du site ne sont pas activées.', # NEW
	'visiteurs_connectes:nom' => 'Visitantes conectados',
	'voir' => 'Ver: @voir@',
	'votre_choix' => 'Tu elección:',

	// W
	'webmestres:description' => 'Un {{webmaster}} en el sentido de SPIP es un {{administrador}} que tiene acceso al espacio FTP. Por omisión, y a partir de SPIP 2.0, el administrador es el <code>id_auteur=1</code> del sitio. Los webmasters definidos aquí tienen el privilegio de no estar obligados a pasar por el FTP para validar las operaciones delicadas del sitio, como la actualización de la base de datos o la restauración de un volcado.

Webmaster(s) actual(es): {@_CS_LISTE_WEBMESTRES@}.
_ Administrador(es) elegible(s): {@_CS_LISTE_ADMINS@}.

Al ser webmaster tu mismo, aquí tienes permisos para modificar esta lista de ids -- separadas por dos puntos « : » si son varias. Ejemplo: «1:5:6».[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Lista de webmasters',

	// X
	'xml:description' => 'Activa el validador de xml para el espacio público como se describe en la [documentación->http://www.spip.net/fr_article3541.html]. Se añade un botón titulado « Análisis XML » a los botones de administración.', # MODIF
	'xml:nom' => 'Validador de XML'
);

?>
