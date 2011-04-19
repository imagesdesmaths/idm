<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => '&nbsp;:&nbsp;no',
	'2pts_oui' => '&nbsp;:&nbsp;s&iacute;',

	// S
	'SPIP_liens:description' => '@puce@ Todos los enlaces del sitio se abren, por omisi&oacute;n, en la ventana actual del navegador. Pero puede ser &uacute;til abrir los enlaces externos en una nueva ventana de navegaci&oacute;n -- esto se reduce a a&ntilde;adir {target="_blank"} en todas las balizas &lt;a&gt; a las que SPIP asigna las clases {spip_out}, {spip_url} o {spip_glossaire}. A veces hace falta a&ntilde;adir una de estas clases a los enlaces del esqueleto del sitio (archivos html) para extender al m&aacute;ximo esta caracter&iacute;stica.[[%radio_target_blank3%]]

@puce@ SPIP permite enlazar palabras con su definici&oacute;n gracias al atajo tipogr&aacute;fico <code>[?palabra]</code>. Por omisi&oacute;n (o si dejas en blanco este cuadro), el glosario externo reenv&iacute;a hacia la enciclopedia libre wikipedia.org. Aqu&iacute; puedes elegir la direcci&oacute;n que se utilizar&aacute;. <br />Enlace de prueba: [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP a pr&eacute;vu un style CSS pour les liens &laquo;~mailto:~&raquo; : une petite enveloppe devrait appara&icirc;tre devant chaque lien li&eacute; &agrave; un courriel; mais puisque tous les navigateurs ne peuvent pas l\'afficher (notamment IE6, IE7 et SAF3), &agrave; vous de voir s\'il faut conserver cet ajout.

_ Lien de test : [->test@test.com] (rechargez la page enti&egrave;rement).[[%enveloppe_mails%]]', # NEW
	'SPIP_liens:nom' => 'SPIP y los enlaces… externos',
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
	'acces_admin' => 'Acceso de administradores:',
	'action_rapide' => 'Acci&oacute;n r&aacute;pida, &iexcl;s&oacute;lo si sabes lo que haces!',
	'action_rapide_non' => 'Acci&oacute;n r&aacute;pida, disponible una vez activada esta herramienta:',
	'admins_seuls' => 'Los administradores solamente',
	'attente' => 'Espera...',
	'auteur_forum:description' => 'Pide a todos los autores de mensajes p&uacute;blicos que rellenen (&iexcl;al menos con una letra!) el campo &laquo;@_CS_FORUM_NOM@&raquo; para evitar las contribuciones completamente an&oacute;nimas.', # MODIF
	'auteur_forum:nom' => 'Sin foros an&oacute;nimos',
	'auteur_forum_deux' => 'Ou, au moins l\'un des deux champs pr&eacute;c&eacute;dents', # NEW
	'auteur_forum_email' => 'Le champ &laquo;@_CS_FORUM_EMAIL@&raquo;', # NEW
	'auteur_forum_nom' => 'Le champ &laquo;@_CS_FORUM_NOM@&raquo;', # NEW
	'auteurs:description' => 'Esta herramienta configura la apariencia de [la p&aacute;gina de los autores->./?exec=auteurs], en el espacio privado.

@puce@ Define aqu&iacute; el n&uacute;mero m&aacute;ximo de autores que se ver&aacute;n en el cuadro central de la p&aacute;gina de autores. A partir de ah&iacute;, se realiza la compaginaci&oacute;n.[[%max_auteurs_page%]]

@puce@ &iquest;Que estatutos de autores pueden listarse en esta p&aacute;gina?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]', # MODIF
	'auteurs:nom' => 'P&aacute;gina de los autores',

	// B
	'balise_set:description' => 'Afin d\'all&eacute;ger les &eacute;critures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqu&eacute; &agrave; une variable passe donc dans le nom de la balise.



Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'Balise #SET &eacute;tendue', # NEW
	'barres_typo_edition' => 'Edition des contenus', # NEW
	'barres_typo_forum' => 'Messages de Forum', # NEW
	'barres_typo_intro' => 'Le plugin &laquo;Porte-Plume&raquo; a &eacute;t&eacute; d&eacute;tect&eacute;. Veuillez choisir ici les barres typographiques o&ugrave; certains boutons seront ins&eacute;r&eacute;s.', # NEW
	'basique' => 'B&aacute;sico',
	'blocs:aide' => '<Bloques Desplegables : <b>&lt;bloc&gt;&lt;/bloc&gt;</b> (alias : <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) et <b>&lt;visible&gt;&lt;/visible&gt;</b>',
	'blocs:description' => 'Permite crear bloques que pueden hacerse visibles o invisibles al pulsar en su t&iacute;tulo.

@puce@ {{En los textos de SPIP}}: los redactores disponen de las  nuevas balizas &lt;bloc&gt; (o &lt;invisible&gt;) y &lt;visible&gt; para utilizarlas en sus textos as&iacute;: 

<quote><code>
<bloc>
 Un t&iacute;tulo que se puede pulsar
 
 El texto que se esconde/muestra, tras dos saltos de l&iacute;nea...
 </bloc>
</code></quote>

@puce@ {{En los esqueletos}}: dispones de las  nuevas balizas #BLOC_TITRE, #BLOC_DEBUT y #BLOC_FIN que se utilizan as&iacute;: 
<quote><code> #BLOC_TITRE o #BLOC_TITRE{mi_URL}
 Mi t&iacute;tulo
 #BLOC_RESUME    (opcional)
 versi&oacute;n resumida del bloque siguiente
 #BLOC_DEBUT
 Mi bloque desplegable (que contendr&aacute; la URL a la que apunta el t&iacute;tulo si es necesario)
 #BLOC_FIN</code></quote>
 
@puce@ Marcando &laquo;si&raquo; m&aacute;s abajo, la apertura de un bloque causar&aacute; el cierre de los dem&aacute;s bloques de la p&aacute;gina, para tener solamente uno abierto cada vez.[[%bloc_unique%]]', # MODIF
	'blocs:nom' => 'Bloques Desplegables',
	'boites_privees:description' => 'Todas las cajas descritas a continuaci&oacute;n aparecen en varios lugares de la parte privada.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Las revisiones de la Navaja Suiza}}: un cuadro sobre esta p&aacute;gina de configuraci&oacute;n, que indica las &uacute;ltimas modificaciones efectuadas en el c&oacute;digo del plugin ([Fuente->@_CS_RSS_SOURCE@]).
- {{Los art&iacute;culos en formato SPIP}} : un cuadro desplegable suplementario para tus art&iacute;culos con el fin de ver el c&oacute;digo fuente utilizado por sus autores.
- {{Los autores en cifras}} : un cuadro suplementario en [la p&aacute;gina de los autores->./?exec=auteurs] que indica los 10 &uacute;ltimos conectados y las inscripciones no confirmadas. S&oacute;lo los administradores ven esta informaci&oacute;n.
- {{Ver las URLs propias}} : un cuadro desplegable para cada objeto de contenido (art&iacute;culo, secci&oacute;n, autor, ...) que indica la URL propia asociada, as&iacute; como sus alias eventuales. La herramienta &laquo;&nbsp;[.->type_urls]&nbsp;&raquo; te permite ajustar la configuraci&oacute;n de las URLs de tu sitio web.
- {{La ordenaci&oacute;n de autores}}: un cuadro desplegable para los art&iacute;culos que contengan m&aacute;s de un autor y que permite ajustar facilmente el orden en que se muestran.', # MODIF
	'boites_privees:nom' => 'Cajas privadas',
	'bp_tri_auteurs' => 'El orden de autores',
	'bp_urls_propres' => 'Las URLs propias',
	'brouteur:description' => '@puce@ {{S&eacute;lecteur de rubrique (brouteur)}}. Utilisez le s&eacute;lecteur de rubrique en AJAX &agrave; partir de %rubrique_brouteur% rubrique(s).

@puce@ {{S&eacute;lection de mots-clefs}}. Utilisez un champ de recherche au lieu d\'une liste de s&eacute;lection &agrave; partir de %select_mots_clefs% mot(s)-clef(s).

@puce@ {{S&eacute;lection d\'auteurs}}. L\'ajout d\'un auteur se fait par mini-navigateur dans la fourchette suivante :
<q1>&bull; Une liste de s&eacute;lection pour moins de %select_min_auteurs% auteurs(s).
_ &bull; Un champ de recherche &agrave; partir de %select_max_auteurs% auteurs(s).</q1>', # NEW
	'brouteur:nom' => 'R&eacute;glage des s&eacute;lecteurs', # NEW

	// C
	'cache_controle' => 'Control de la cach&eacute;',
	'cache_nornal' => 'Uso normal',
	'cache_permanent' => 'Cach&eacute; permanente',
	'cache_sans' => 'Sin cach&eacute;',
	'categ:admin' => '1. Administraci&oacute;n',
	'categ:divers' => '60. Varios',
	'categ:interface' => '10. Interfaz privada',
	'categ:public' => '40. Publicaci&oacute;n',
	'categ:securite' => '5. S&eacute;curit&eacute;', # NEW
	'categ:spip' => '50. Balizas, filtros, criterios',
	'categ:typo-corr' => '20. Mejoras en los textos',
	'categ:typo-racc' => '30. Atajos tipogr&aacute;ficos',
	'certaines_couleurs' => 'S&oacute;lo las balizas definidas aqu&iacute;@_CS_ASTER@ :',
	'chatons:aide' => 'Caritas: @liste@',
	'chatons:description' => 'Inserta im&aacute;genes (o caritas para los {chats}) en todos los textos donde aparezca una cadena de tipo <code>:nombre</code>.
_ Esta herramienta reemplaza estos atajos con las im&aacute;genes con el mismo nombre que encuentre en la carpeta plugins/couteau_suisse/img/chatons.', # MODIF
	'chatons:nom' => 'Caritas',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de votre site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour &agrave; la ligne. En effet, les citations courtes doivent &ecirc;tre entour&eacute;es par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.', # NEW
	'citations_bb:nom' => 'Citations bien balis&eacute;es', # NEW
	'class_spip:description1' => 'Aqu&iacute; puedes definir ciertos atajos de SPIP. Un valor vac&iacute;o equivale a utilizar el valor por omisi&oacute;n.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Los atajos de SPIP}}.

Aqu&iacute; puedes definir ciertos atajos de SPIP. Un valor vac&iacute;o equivale a utilizar el valor por omisi&oacute;n.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{Atenci&oacute;n: si la herramienta &laquo;&nbsp;[.->pucesli]&nbsp;&raquo; est&aacute; activada, el reemplazo del gui&oacute;n &laquo;&nbsp;-&nbsp;&raquo; ya no se efectuar&aacute;; en su lugar se usar&aacute; una lista &lt;ul>&lt;li>.}

SPIP utiliza habitualmente la baliza &lt;h3&gt; para los intert&iacute;tulos. Elige aqu&iacute; otra alternativa: [[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP ha elegido usar la baliza &lt;strong> para transcribir las negritas. Pero &lt;b> tambi&eacute;n podr&iacute;a ser conveniente, con o sin estilo. A tu elecci&oacute;n:[[%racc_g1%]][[->%racc_g2%]]

SPIP ha elegido usar la baliza &lt;i> para transcribir las it&aacute;licas. Pero &lt;em> tambi&eacute;n podr&iacute;a ser conveniente, con o sin estilo. A tu elecci&oacute;n:[[%racc_i1%]][[->%racc_i2%]]

@puce@ {{Los estilos por omisi&oacute;n de SPIP}}. Hasta la versi&oacute;n 1.92 de SPIP, los atajos tipogr&aacute;ficos produc&iacute;an balizas con el estilo "spip" asignado siempre. Por ejemplo: <code><p class="spip"></code>. Aqu&iacute; puedes definir el estilo de estas balizas en funci&oacute;n de tus hojas de estilo. Un cuadro vac&iacute;o significa que no se aplica ning&uacute;n estilo en particular.
{Atenci&oacute;n: si ciertos atajos (linea horizontal, intert&iacute;tulo, it&aacute;lica, negrita) se han modificado m&aacute;s abajo, los estilos siguientes no se aplicar&aacute;n.}

<q1>
_ {{1.}} Balizas &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]]
_ {{2.}} Balizas &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; y las listas (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Nota: al modificar este segundo estilo, tambi&eacute;n pierdes los estilos est&aacute;ndar de SPIP asociados con estas balizas.</blockquote>', # MODIF
	'class_spip:nom' => 'SPIP y sus atajos…',
	'code_css' => 'CSS',
	'code_fonctions' => 'Funciones',
	'code_jq' => 'jQuery',
	'code_js' => 'JavaScript',
	'code_options' => 'Opciones',
	'code_spip_options' => 'Opciones de SPIP',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie priv&eacute;e', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options pr&eacute;c&eacute;dentes)', # NEW
	'contrib' => 'M&aacute;s informaci&oacute;n: @url@',
	'corbeille:description' => 'SPIP suprime autom&aacute;ticamente los objetos tirados a la basura en un plazo de 24 horas, en general hacia las 4 de la madrugada, gracias a una tarea &laquo;CRON&raquo; (lanzamiento peri&oacute;dico y/o autom&aacute;tico de procesos preprogramados). Aqu&iacute; puedes impedir ese proceso para gestionar mejor la papelera.[[%arret_optimisation%]]',
	'corbeille:nom' => 'La papelera',
	'corbeille_objets' => '@nb@ objeto(s) en la papelera.',
	'corbeille_objets_lies' => '@nb_lies@ enlace(s) detectado(s).',
	'corbeille_objets_vide' => 'No hay objetos en la papelera', # MODIF
	'corbeille_objets_vider' => 'Suprimir los objetos seleccionados',
	'corbeille_vider' => 'Vaciar la papelera:',
	'couleurs:aide' => 'Asignar colores: <b>[coul]texto[/coul]</b>@fond@ en <b>color</b>= @liste@',
	'couleurs:description' => 'Permite aplicar facilmente des colores a todos los textos del sitio (art&iacute;culos, breves, t&iacute;tulos, foro, …) utilizando balizas de atajo.

Dos ejemplos id&eacute;nticos para cambiar el color del texto:@_CS_EXEMPLE_COULEURS2@

Lo mismo para cambiar el fondo, si la opci&oacute;n de abajo lo permite:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@El formato de estas balizas personalizadas debe listar colores existentes o definir parejas &laquo;baliza=color&raquo;, todo ello separado por comas. Ejemplos: &laquo;gris, rouge&raquo;, &laquo;suave=jaune, fuerte=rouge&raquo;, &laquo;bajo=#99CC11, alto=brown&raquo; o incluso &laquo;gris=#DDDDCC, rouge=#EE3300&raquo;. Para el primer y el &uacute;ltimo ejemplo, las balizas autorizadas son: <code>[gris]</code> y <code>[rouge]</code> (<code>[fond gris]</code> y <code>[fond rouge]</code> si se permiten los fondos).', # MODIF
	'couleurs:nom' => 'Todo en colores',
	'couleurs_fonds' => ', <b>[fond&nbsp;coul]texto[/coul]</b>, <b>[bg&nbsp;coul]texto[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Obtener abundante informaci&oacute;n sobre el funcionamiento de la Navaja Suiza en los archivos {spip.log} que se pueden encontrar en el directorio: {@_CS_DIR_TMP@}[[%log_couteau_suisse%]]

@puce@ {{Opciones de SPIP.}} SPIP ordena los plugins en un orden determinado. Para asegurarse de que la Navaja Suiza sea el primero y gestione desde el principio ciertas opciones de SPIP, marca la opci&oacute;n siguiente. Si los permisos de tu servidor lo permiten, se modificar&aacute; autom&aacute;ticamente el archivo {@_CS_FILE_OPTIONS@} para incluir el archivo {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php}.
[[%spip_options_on%]]

@puce@ {{Consultas externas.}} La Navaja Suiza verifica regularmente la existencia de una versi&oacute;n m&aacute;s reciente de su c&oacute;digo e informa en su p&aacute;gina de configuraci&oacute;n de una actualizaci&oacute;n que est&eacute; disponible. Si las consultas externas de tu servidor causan problemas, marca la casilla siguiente.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'Comportamiento de la Navaja Suiza',
	'cs_distant_off' => 'Las comprobaciones de versiones externas',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => 'Los registros detallados de la Navaja Suiza',
	'cs_reset' => '&iquest;Confirmas que deseas reinicializar totalmente la Navaja Suiza?',
	'cs_reset2' => 'Tous les outils actuellement actifs seront d&eacute;sactiv&eacute;s et leurs param&egrave;tres r&eacute;initialis&eacute;s.', # NEW
	'cs_spip_options_erreur' => 'Attention : la modification du ficher &laquo;<html>@_CS_FILE_OPTIONS@</html>&raquo; a &eacute;chou&eacute; !', # NEW
	'cs_spip_options_on' => 'Las opciones de SPIP en &laquo;@_CS_FILE_OPTIONS@&raquo;', # MODIF

	// D
	'decoration:aide' => 'Decoraci&oacute;n: <b>&lt;balise&gt;prueba&lt;/balise&gt;</b>, con <b>balise</b> = @liste@',
	'decoration:description' => 'Nuevos estilos param&eacute;tricos en tus textos, accesibles mediante balizas entre angulares. Ejemplo:
&lt;mibaliza&gt;texto&lt;/mibaliza&gt; o: &lt;mibaliza/&gt;.<br />Define debajo los estilos CSS que necesites, una baliza por l&iacute;nea, seg&uacute;n las sintaxis siguientes:
- {type.mibaliza = mi estilo CSS}
- {type.mibaliza.class = mi clase CSS}
- {type.mibaliza.lang = mi idioma (p. ej: es)}
- {unalias = mibaliza}

El par&aacute;metro {type} puede tomar tres valores:
- {span} : baliza dentro de un p&aacute;rrafo (tipo Inline)
- {div} : baliza que crea un p&aacute;rrafo nuevo (tipo Block)
- {auto} : baliza determinada autom&aacute;ticamente por el plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Decoraci&oacute;n',
	'decoupe:aide' => 'Bloque de pesta&ntilde;as: <b>&lt;onglets>&lt;/onglets></b><br/>Separador de p&aacute;ginas o de pesta&ntilde;as: @sep@', # MODIF
	'decoupe:aide2' => 'Alias:&nbsp;@sep@',
	'decoupe:description' => '@puce@ Divide la presentaci&oacute;n p&uacute;blica de un art&iacute;culo en varias p&aacute;ginas mediante una compaginaci&oacute;n autom&aacute;tica. Simplemente sit&uacute;a en tu art&iacute;culo cuatro signos de suma consecutivos (<code>++++</code>) en el lugar donde haya que cortar.

Por omisi&oacute;n, la Navaja Suiza inserta la numeraci&oacute;n de p&aacute;gina en el encabezado y en el pie del art&iacute;culo autom&aacute;ticamente. Pero tienes la posibilidad de situar esta numeraci&oacute;n en otro lugar del esqueleto gracias a la baliza #CS_DECOUPE que puedes activar aqu&iacute;:
[[%balise_decoupe%]]

@puce@ Si utilizas este separador entre las balizas &lt;onglets&gt; y &lt;/onglets&gt; lo que obtienes es un conjunto de pesta&ntilde;as.

En los esqueletos: tienes a tu disposici&oacute;n las nuevas balizas #ONGLETS_DEBUT, #ONGLETS_TITRE y #ONGLETS_FIN.

Esta herramienta puede acoplarse con &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # MODIF
	'decoupe:nom' => 'Dividir en p&aacute;ginas y pesta&ntilde;as',
	'desactiver_flash:description' => 'Suprime los objetos flash de las p&aacute;ginas de tu sitio y las reemplaza por el contenido alternativo asociado.',
	'desactiver_flash:nom' => 'Desactiva los objetos flash',
	'detail_balise_etoilee' => '{{Atenci&oacute;n}} : Revisa bien el uso que tus esqueletos hacen de las balizas con asteriscos. El procesado con esta herramienta no se aplicar&aacute; sobre: @bal@.',
	'detail_disabled' => 'Param&egrave;tres non modifiables :', # NEW
	'detail_fichiers' => 'Ficheros:',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'C&oacute;digo en l&iacute;nea:',
	'detail_jquery2' => 'Esta herramienta necesita la biblioteca {jQuery}.', # MODIF
	'detail_jquery3' => '{{Atenci&oacute;n}}: esta herramienta necesita el plugin [jQuery para SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] para funcionar correctamente con esta versi&oacute;n de SPIP.',
	'detail_pipelines' => 'Pipelines:',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_spip_options2' => 'Il est recommand&eacute; de placer les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;[.->cs_comportement]&raquo;.', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_traitements' => 'Procesado:',
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
	'dossier_squelettes:description' => 'Modifica la carpeta de esqueleto utilizada. Por ejemplo: "esqueletos/miesqueleto". Puedes registrar varias carpetas separ&aacute;ndolas con dos puntos <html>&laquo;&nbsp;:&nbsp;&raquo;</html>. Si se deja vac&iacute;o el siguiente cuadro (o escribiendo "dist"), se usar&aacute; el esqueleto original "dist" proporcionado por SPIP.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Carpeta del esqueleto',

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
	'effaces' => 'Borrados',
	'en_travaux:description' => 'Permite mostrar un mensaje personalizable durante una fase de mantenimiento en todas las p&aacute;ginas p&uacute;blicas y, eventualmente, en el espacio privado.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Sitio en mantenimiento',
	'erreur:bt' => '<span style=\\"color:red;\\">Atenci&oacute;n:</span> la barra de tipograf&iacute;as (version @version@) parece antigua.<br />La Navaja Suiza es compatible con una versi&oacute;n superior o igual a @mini@.',
	'erreur:description' => '&iexcl;falta la id en la definici&oacute;n de la herramienta!',
	'erreur:distant' => 'el servidor externo',
	'erreur:jquery' => '{{Nota}}: la biblioteca {jQuery} parece estar inactiva para esta p&aacute;gina. Consulta [aqu&iacute;->http://www.spip-contrib.net//La-navaja-suiza] el p&aacute;rrafo sobre las dependencias del plugin, o recarga esta p&aacute;gina.',
	'erreur:js' => 'Parece que ha ocurrido un error de JavaScript en esta p&aacute;gina que impide su buen funcionamiento. Intenta activar JavaScript en tu navegador o desactivar ciertos plugins de SPIP de tu sitio web.',
	'erreur:nojs' => 'JavaScript est&aacute; desactivado en esta p&aacute;gina.',
	'erreur:nom' => '&iexcl;Error!',
	'erreur:probleme' => 'Problema en: @pb@',
	'erreur:traitements' => 'La Navaja Suiza - Error de compilaci&oacute;n en el procesado: &iexcl;mezclar \'typo\' y \'propre\' est&aacute; prohibido!',
	'erreur:version' => 'Esta herramienta no est&aacute; disponible en esta versi&oacute;n de SPIP.',
	'erreur_groupe' => 'Attention : le groupe &laquo;@groupe@&raquo; n\'est pas d&#233;fini !', # NEW
	'erreur_mot' => 'Attention : le mot-cl&#233; &laquo;@mot@&raquo; n\'est pas d&#233;fini !', # NEW
	'etendu' => 'Extendido',

	// F
	'f_jQuery:description' => 'Impide la instalaci&oacute;n de {jQuery} en el espacio p&uacute;blico para economizar un poco de &laquo;tiempo de m&aacute;quina&raquo;. Esta biblioteca ([->http://jquery.com/]) aporta numerosas facilidades en la programaci&oacute;n con JavaScript y puede utilizarse por ciertos plugins. SPIP la utiliza en su espacio privado.

Atenci&oacute;n: algunas herramientas de la Navaja Suiza necesitan las funciones de {jQuery}. ', # MODIF
	'f_jQuery:nom' => 'Desactivar jQuery',
	'filets_sep:aide' => 'Filetes de Separaci&oacute;n: <b>__i__</b> o <b>i</b> es un n&uacute;mero.<br />Otros filetes disponibles: @liste@', # MODIF
	'filets_sep:description' => 'Inserta filetes de separaci&oacute;n, personalizables con hojas de estilo, en todos los textos de SPIP.
_ La sintaxis es: "__c&oacute;digo__", donde "c&oacute;digo" representa o bien el n&uacute;mero de identificaci&oacute;n (de 0 a 7) del filete a insertar, relativo al estilo correspondiente, o el nombre de una imagen situada en la carpeta plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Filetes de Separaci&oacute;n',
	'filtrer_javascript:description' => 'Hay tres modos disponibles Para gestionar la inserci&oacute;n de JavaScript en los art&iacute;culos:
- <i>jamais</i>: el JavaScript se rechaza en todo lugar
- <i>d&eacute;faut</i>: el JavaScript se marca en rojo en el espacio privado
- <i>toujours</i>: el JavaScript se acepta siempre.

Atenci&oacute;n: en los foros, peticiones, flujos sindicados, etc., la gesti&oacute;n de JavaScript es <b>siempre</b> en modo seguro.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Gesti&oacute;n de JavaScript',
	'flock:description' => 'Desactiva el sistema de bloqueo de ficheros neutralizando la funci&oacute;n PHP {flock()}. Ciertos alojamientos web producen problemas graves por causa de un sistema de ficheros inadaptado por falta de sincronizaci&oacute;n. No actives esta herramienta si tu sitio funciona normalmente.',
	'flock:nom' => 'Sin bloqueo de ficheros',
	'fonds' => 'Fondos:',
	'forcer_langue:description' => 'Fuerza el contexto de idioma en los juegos de esqueletos multiling&uuml;es que dispongan de un formulario o de un men&uacute; de idiomas que sepan manejar la cookie de idioma.

T&eacute;cnicamente, esta herramienta tiene estos efectos:
- desactivar la b&uacute;squeda de un esqueleto en funci&oacute;n del idioma del objeto,
- desactivar el criterio <code>{lang_select}</code> autom&aacute;tico para los objetos cl&aacute;sicos (art&iacute;culos, breves, secciones, etc ... ).

Los bloques multi se muestran siempre en el idioma solicitado por el visitante.', # MODIF
	'forcer_langue:nom' => 'Forzar un idioma',
	'format_spip' => 'Art&iacute;culos en formato SPIP',
	'forum_lgrmaxi:description' => 'Por omisi&oacute;n no se limita el tama&ntilde;o de los mensajes del foro. Si se activa esta herramienta, se mostrar&aacute; un mensaje de error cuando alguien quiera publicar un mensaje de tama&ntilde;o superior al valor especificado, y se rechazar&aacute; el mensaje. Un valor en blanco o igual a 0 significa que no se aplica ning&uacute;n l&iacute;mite.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Tama&ntilde;o de los foros',

	// G
	'glossaire:aide' => 'Un texto sin glosario: <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Gesti&oacute;n de un glosario interno ligado a uno o m&aacute;s grupos de palabras-clave. Escribe aqu&iacute; el nombre de los grupos separ&aacute;ndolos mediante dos puntos &laquo;&nbsp;:&nbsp;&raquo;. Si se deja vac&iacute;o el cuadro siguiente (o escribiendo "Glossaire"), se utilizar&aacute; el grupo "Glossaire".[[%glossaire_groupes%]]

@puce@ Para cada palabra, tendr&aacute;s la posibilidad de elegir el n&uacute;mero m&aacute;ximo de enlaces creados en los textos. Cualquier valor nulo o negativo implica que se procesar&aacute;n todas las palabras reconocidas. [[%glossaire_limite% par mot-cl&eacute;]]

@puce@ Se ofrecer&aacute;n dos soluciones para generar la peque&ntilde;a ventana autom&aacute;tica que aparece al pasar el rat&oacute;n por encima. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Glosario interno',
	'glossaire_css' => 'Soluci&oacute;n CSS',
	'glossaire_erreur' => 'Le mot &laquo;@mot1@&raquo; rend ind&#233;tectable le mot &laquo;@mot2@&raquo;', # NEW
	'glossaire_inverser' => 'Correction propos&#233;e : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Soluci&oacute;n JavaScript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) &#233;tudi&#233;(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Reemplaza autom&aacute;ticamente las comillas rectas (") por las comillas tipogr&aacute;ficas en el idioma de composici&oacute;n. El reemplazo, transparente para el usuario, no modifica el texto original sino s&oacute;lo su presentaci&oacute;n final.',
	'guillemets:nom' => 'Comillas tipogr&aacute;ficas',

	// H
	'help' => '{{Esta p&aacute;gina s&oacute;lo es accesible para los responsables del sitio.}} Permite la configuraci&oacute;n de las diversas funciones suplementarias aportadas por el plugin &laquo;{{La&nbsp;Navaja&nbsp;Suiza}}&raquo;.',
	'help2' => 'Version local: @version@',
	'help3' => '<p>Enlaces a documentaci&oacute;n:<br/>• [La&nbsp;Navaja&nbsp;Suisza->http://www.spip-contrib.net/La-navaja-suiza]@contribs@</p><p>Reinicializaciones:
_ • [De las herramientas ocultas|Volver al aspecto inicial de esta p&aacute;gina->@hide@]
_ • [De todo el plugin|Volver al estado inicial del plugin->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Outil en cours de d&eacute;veloppement. Vous offre une horloge JavaScript . Balise : <code>#HORLOGE</code>. Mod&egrave;le : <code><horloge></code>



Arguments disponibles : {zone}, {format} et/ou {id}.', # NEW
	'horloge:nom' => 'Horloge', # NEW

	// I
	'icone_visiter:description' => 'Reemplaza la imagen del bot&oacute;n est&aacute;ndar &laquo;Visitar&raquo; (en la esquina superior derecha de esta p&aacute;gina)  por el logo del sitio, si existe.

Para definir el logo, entra en la p&aacute;gina de &laquo;Configuraci&oacute;n de sitio&raquo; pulsando el bot&oacute;n &laquo;Configuraci&oacute;n&raquo;.', # MODIF
	'icone_visiter:nom' => 'Bot&oacute;n &laquo;Visitar&raquo;', # MODIF
	'insert_head:description' => 'Activa autom&aacute;ticamente la baliza [#INSERT_HEAD->http://www.spip.net/es_article2132.html] en todos los esqueletos, tengan o no esta baliza entre &lt;head&gt; y &lt;/head&gt;. Gracias a esta opci&oacute;n, los plugins podr&aacute;n insertar JavaScript (.js) u hojas de estilo (.css).',
	'insert_head:nom' => 'Baliza #INSERT_HEAD',
	'insertions:description' => 'ATENCI&Oacute;N : &iexcl;&iexcl;herramienta en fase de desarrollo!! [[%insertions%]]',
	'insertions:nom' => 'Correcciones autom&aacute;ticas',
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
	'jcorner:description' => '&laquo;Esquinas Bonitas&raquo; es una herramienta que permite modificar f&aacute;cilmente el aspecto de las esquinas de los {{recuadros coloreados}} en la parte p&uacute;blica del sitio web. &iexcl;Todo es posible, o casi!
_ Comprueba el resultado en esta p&aacute;gina: [->http://www.malsup.com/jquery/corner/].

Pon en la lista de m&aacute;s abajo los objetos de tu esqueleto a redondear, utilizando la sintaxis CSS (.class, #id, etc. ). Utiliza el signo &laquo;&nbsp;=&nbsp;&raquo; para especificar la orden jQuery a utilizar y una doble barra (&laquo;&nbsp;//&nbsp;&raquo;) para los comentarios. En ausencia del signo igual, se aplicar&aacute;n esquinas redondeadas (equivalente a: <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Atenci&oacute;n, esta herramienta necesita el plugin {jQuery} : {Round Corners} para funcionar. La Navaja Suiza puede instalarlo directamente si marcas la casilla siguiente. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Esquinas Bonitas',
	'jcorner_plugin' => '&laquo;&nbsp;Plugin Round Corners&nbsp;&raquo;',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Por omisi&oacute;n',
	'js_jamais' => 'Nunca',
	'js_toujours' => 'Siempre',
	'jslide_aucun' => 'Aucune animation', # NEW
	'jslide_fast' => 'Glissement rapide', # NEW
	'jslide_lent' => 'Glissement lent', # NEW
	'jslide_millisec' => 'Glissement durant&nbsp;:', # NEW
	'jslide_normal' => 'Glissement normal', # NEW

	// L
	'label:admin_travaux' => 'Cerrar el sitio p&uacute;blico por:',
	'label:arret_optimisation' => 'Impedir que SPIP vac&iacute;e la papelera autom&aacute;ticamente:',
	'label:auteur_forum_nom' => 'Le visiteur doit sp&eacute;cifier :', # NEW
	'label:auto_sommaire' => 'Crear un sumario autom&aacute;ticamente:',
	'label:balise_decoupe' => 'Activar la baliza #CS_DECOUPE :',
	'label:balise_sommaire' => 'Activar la baliza #CS_SOMMAIRE:',
	'label:bloc_h4' => 'Balise pour les titres&nbsp;:', # NEW
	'label:bloc_unique' => 'Un solo bloque abierto en la p&aacute;gina:',
	'label:blocs_cookie' => 'Utilisation des cookies :', # NEW
	'label:blocs_slide' => 'Type d\'animation&nbsp;:', # NEW
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal r&eacute;serv&eacute; aux copies locales :', # NEW
	'label:couleurs_fonds' => 'Permitir los fondos:',
	'label:cs_rss' => 'Activar:',
	'label:debut_urls_propres' => 'Comienzo de las URLs:',
	'label:decoration_styles' => 'Tus balizas de estilo personalizado:',
	'label:derniere_modif_invalide' => 'Recalcular inmediatamente despu&eacute;s de una modificaci&oacute;n:',
	'label:devdebug_espace' => 'Filtrage de l\'espace concern&#233; :', # NEW
	'label:devdebug_mode' => 'Activer le d&eacute;bogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoy&eacute; :', # NEW
	'label:distant_off' => 'Desactivar:',
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Carpeta(s) a utilizar:',
	'label:duree_cache' => 'Duraci&oacute;n de la cach&eacute; local:',
	'label:duree_cache_mutu' => 'Duraci&oacute;n de la cach&eacute; en mutualizaci&oacute;n:',
	'label:ecran_actif' => '@_CS_CHOIX@', # NEW
	'label:enveloppe_mails' => 'Petite enveloppe devant les mails :', # NEW
	'label:expo_bofbof' => 'Escritura como exponentes para: <html>St(e)(s), Bx, Bd(s) y Fb(s)</html>',
	'label:forum_lgrmaxi' => 'Valor (en caracteres):',
	'label:glossaire_groupes' => 'Grupo(s) utilizado(s):',
	'label:glossaire_js' => 'T&eacute;cnica utilizada:',
	'label:glossaire_limite' => 'N&uacute;mero m&aacute;ximo de enlaces creados:',
	'label:i_align' => 'Alignement du texte&nbsp;:', # NEW
	'label:i_couleur' => 'Couleur de la police&nbsp;:', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (&eacute;q. &agrave; {line-height})&nbsp;:', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte&nbsp;:', # NEW
	'label:i_padding' => 'Espacement autour du texte (&eacute;q. &agrave; {padding})&nbsp;:', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/})&nbsp;:', # NEW
	'label:i_taille' => 'Taille de la police&nbsp;:', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Correcciones autom&aacute;ticas:',
	'label:jcorner_classes' => 'Mejorar las esquinas de las selecciones siguientes:', # MODIF
	'label:jcorner_plugin' => 'Instalar el siguiente plugin {jQuery}:',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'Tama&ntilde;o del resumen:',
	'label:lgr_sommaire' => 'Tama&ntilde;o del sumario (9 a 99):',
	'label:lien_introduction' => 'Puntos de seguir pulsables:',
	'label:liens_interrogation' => 'Proteger las URLs:',
	'label:liens_orphelins' => 'Enlaces pulsables:',
	'label:log_couteau_suisse' => 'Activar:',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:marqueurs_urls_propres' => 'A&ntilde;adir los marcadores que separan los objetos (SPIP>=2.0) :<br/>(ej. : &laquo;&nbsp;-&nbsp;&raquo; para -Mi-secci&oacute;n-, &laquo;&nbsp;@&nbsp;&raquo; para @Mi-sitio@) ', # MODIF
	'label:max_auteurs_page' => 'Autores por p&aacute;gina:',
	'label:message_travaux' => 'Tu mensaje de mantenimiento:',
	'label:moderation_admin' => 'Validar autom&aacute;ticamente los mensajes de los: ',
	'label:mot_masquer' => 'Mot-cl&#233; masquant les contenus :', # NEW
	'label:ouvre_note' => 'Ouverture et fermeture des notes de bas de page', # NEW
	'label:ouvre_ref' => 'Ouverture et fermeture des appels de notes de bas de page', # NEW
	'label:paragrapher' => 'Siempre hacer p&aacute;rrafos:',
	'label:prive_travaux' => 'Accesibilidad del espacio privado por:',
	'label:prof_sommaire' => 'Profondeur retenue (1 &agrave; 4) :', # NEW
	'label:puce' => 'Vi&ntilde;eta gr&aacute;fica p&uacute;blica &laquo;<html>-</html>&raquo;:',
	'label:quota_cache' => 'Valor de la cuota de cach&eacute;:',
	'label:racc_g1' => 'Entrada y salida del cambio a &laquo;<html>{{negrita}}</html>&raquo;:',
	'label:racc_h1' => 'Entrada y salida de un &laquo;<html>{{{intert&iacute;tulo}}}</html>&raquo;:',
	'label:racc_hr' => 'L&iacute;nea horizontal &laquo;<html>----</html>&raquo;:',
	'label:racc_i1' => 'Entrada y salida del cambio a &laquo;<html>{it&aacute;lica}</html>&raquo;:',
	'label:radio_desactive_cache3' => 'Uso de la cach&eacute;:',
	'label:radio_desactive_cache4' => 'Uso de la cach&eacute;:',
	'label:radio_target_blank3' => 'Enlaces externos en ventana nueva:',
	'label:radio_type_urls3' => 'Formato de las URLs:',
	'label:scrollTo' => 'Instalar los plugins {jQuery} siguientes:',
	'label:separateur_urls_page' => 'Car&aacute;cter de separaci&oacute;n \'type-id\'<br/>(ej.: ?article-123):', # MODIF
	'label:set_couleurs' => 'Esquema a utilizar:',
	'label:spam_ips' => 'Adresses IP &agrave; bloquer :', # NEW
	'label:spam_mots' => 'Secuencias prohibidas:',
	'label:spip_options_on' => 'Incluir:',
	'label:spip_script' => 'Script de llamada:',
	'label:style_h' => 'Tu estilo:',
	'label:style_p' => 'Tu estilo:',
	'label:suite_introduction' => 'Puntos de seguir:',
	'label:terminaison_urls_page' => 'Terminaci&oacute;n de las URLs (ej.: &laquo;.html&raquo;):',
	'label:titre_travaux' => 'T&iacute;tulo del mensaje:',
	'label:titres_etendus' => 'Activar el uso extendido de las balizas #TITRE_XXX:',
	'label:url_arbo_minuscules' => 'Conservar los espacios de los t&iacute;tulos en las URLs:',
	'label:url_arbo_sep_id' => 'Car&aacute;cter de separaci&oacute;n \'titre-id\' en caso de duplicidad:<br/>(no utilizar \'/\')', # MODIF
	'label:url_glossaire_externe2' => 'Enlace al glosario externo:',
	'label:url_max_propres' => 'Longueur maximale des URLs (caract&egrave;res) :', # NEW
	'label:urls_arbo_sans_type' => 'Mostrar el tipo de objeto SPIP en las URLs:',
	'label:urls_avec_id' => 'Un id syst&eacute;matique, mais...', # NEW
	'label:webmestres' => 'Lista de los y las webmasters del sitio:',
	'liens_en_clair:description' => 'Pone a tu disposici&oacute;n el filtro: \'liens_en_clair\'. Probablemente tu texto contiene enlaces de hipertexto que no son visibles al imprimir. Este filtro a&ntilde;ade entre corchetes el destino de cada enlace pulsable (enlaces externos o de correo). Atenci&oacute;n: en el modo de impresi&oacute;n (par&aacute;metro \'cs=print\' o \'page=print\' en la url de la p&aacute;gina), esta caracter&iacute;stica se aplica autom&aacute;ticamente.',
	'liens_en_clair:nom' => 'Ver enlaces',
	'liens_orphelins:description' => 'Esta herramienta tiene dos aplicaciones:

@puce@ {{Enlaces correctos}}.

SPIP habitualmente inserta un espacio antes de los signos de interrogaci&oacute;n o de exclamaci&oacute;n, seg&uacute;n la ortograf&iacute;a francesa. Esta herramienta protege el signo de interrogaci&oacute;n en las URLs de tus textos.[[%liens_interrogation%]]

@puce@ {{Enlaces hu&eacute;rfanos}}.

Reemplaza autom&aacute;ticamente todas las URLs escritas como texto por los usuarios (sobre todo en los foros) y que, por lo tanto, no son pulsables, por enlaces de hipertexto en formato SPIP. Por ejemplo: {<html>www.spip.net</html>} se reemplaza por [->www.spip.net].

Puedes elegir el tipo de reemplazo:
_ • {B&aacute;sico}: se reemplazan los enlaces del tipo {<html>http://spip.net</html>} (todos los protocolos) o {<html>www.spip.net</html>}.
_ • {Extendido}: se reemplazan adem&aacute;s los enlaces del tipo {<html>yo@spip.net</html>}, {<html>mailto:micorreo</html>} o {<html>news:misnews</html>}.
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:nom' => 'Buenas URLs',

	// M
	'mailcrypt:description' => 'Enmascara todos los enlaces de correo presentes en los textos y los reemplaza por un enlace JavaScript que permite activar igual la aplicaci&oacute;n de correo del lector. Esta herramienta antispam intenta impedir que los robots recojan las direcciones electr&oacute;nicas escritas en claro en los foros o en las balizas de tus esqueletos.',
	'mailcrypt:nom' => 'MailCrypt',
	'maj_auto:description' => 'Cet outil vous permet de g&eacute;rer facilement la mise &agrave; jour de vos diff&eacute;rents plugins, r&eacute;cup&eacute;rant notamment le num&eacute;ro de r&eacute;vision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouv&eacute; sur <code>zone.spip.org</code>.



La liste ci-dessus offre la possibilit&eacute; de lancer le processus de mise &agrave; jour automatique de SPIP sur chacun des plugins pr&eacute;alablement install&eacute;s dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> sont simplement list&eacute;s &agrave; titre d\'information. Si la r&eacute;vision distante n\'a pas pu &ecirc;tre trouv&eacute;e, alors tentez de proc&eacute;der manuellement &agrave; la mise &agrave; jour du plugin.



Note : les paquets <code>.zip</code> n\'&eacute;tant pas reconstruits instantan&eacute;ment, il se peut que vous soyez oblig&eacute; d\'attendre un certain d&eacute;lai avant de pouvoir effectuer la totale mise &agrave; jour d\'un plugin tout r&eacute;cemment modifi&eacute;.', # NEW
	'maj_auto:nom' => 'Mises &agrave; jour automatiques', # NEW
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particuli&egrave;re de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-cl&#233; d&eacute;fini ci-dessous. Si une rubrique est masqu&eacute;e, toute sa branche l\'est aussi.[[%mot_masquer%]]



Pour forcer l\'affichage des contenus masqu&eacute;s, il suffit d\'ajouter le crit&egrave;re <code>{tout_voir}</code> aux boucles de votre squelette.', # NEW
	'masquer:nom' => 'Masquer du contenu', # NEW
	'meme_rubrique:description' => 'D&eacute;finissez ici le nombre d\'objets list&eacute;s dans le cadre nomm&eacute; &laquo;<:info_meme_rubrique:>&raquo; et pr&eacute;sent sur certaines pages de l\'espace priv&eacute;.[[%meme_rubrique%]]', # NEW
	'message_perso' => 'Muchas gracias a los traductores que pasaron por aqu&iacute;. Pat ;-)',
	'moderation_admins' => 'administradores autentificados',
	'moderation_message' => 'Este foro est&aacute; moderado a priori: tu contribuci&oacute;n no aparecer&aacute; hasta que haya sido validada por un administrador del sitio, salvo si te has identificado y est&aacute;s autorizado a escribir directamente.',
	'moderation_moderee:description' => 'Permite moderar la moderaci&oacute;n de los foros p&uacute;blicos <b>configurados a priori</b> por los usuarios inscritos.<br />Por ejemplo: Si soy el webmaster de mi sitio, y respondo al mensaje de un usuario, &iquest;por qu&eacute; debo validar mi propio mensaje? &iexcl;Moderaci&oacute;n moderada lo hace para m&iacute;!  [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Moderaci&oacute;n moderada',
	'moderation_redacs' => 'redactores autentificados',
	'moderation_visits' => 'visitantes autentificados',
	'modifier_vars' => 'Modificar estos @nb@ par&aacute;metros',
	'modifier_vars_0' => 'Modificar estos par&aacute;metros',

	// N
	'no_IP:description' => 'Desactiva el mecanismo de registro autom&aacute;tico de las direcciones IP de los visitantes de tu sitio para mantener la confidencialidad: SPIP ya no guardar&aacute; ning&uacute;n n&uacute;mero IP, ni temporalmente durante las visitas (para gestionar las estad&iacute;sticas o alimentar spip.log), ni en los foros (responsabilidad).',
	'no_IP:nom' => 'No almacenar IP',
	'nouveaux' => 'Nuevos',

	// O
	'orientation:description' => '3 nuevos criterios para tus esqueletos : <code>{portrait}</code> (retrato), <code>{carre}</code> (cuadrado) y <code>{paysage}</code> (paisaje). Ideal para la clasificaci&oacute;n de las fotos en funci&oacute;n de su forma.',
	'orientation:nom' => 'Orientaci&oacute;n de las im&aacute;genes',
	'outil_actif' => 'Herramienta activa',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activar',
	'outil_activer_le' => 'Activar la herramienta',
	'outil_cacher' => 'No volver a mostrar',
	'outil_desactiver' => 'Desactivar',
	'outil_desactiver_le' => 'Desactivar la herramienta',
	'outil_inactif' => 'Herramienta inactiva',
	'outil_intro' => 'Esta p&aacute;gina lista las funciones que el plugin pone a tu disposici&oacute;n.<br /><br />Pulsando sobre el nombre de los &uacute;tiles de m&aacute;s abajo, los seleccionas y podr&aacute;s cambiar su estado con ayuda del bot&oacute;n central: los &uacute;tiles activados se desactivar&aacute;n y <i>viceversa</i>. Con cada pulsaci&oacute;n, aparece la descripci&oacute;n bajo las listas. Las categor&iacute;as son desplegables y los &uacute;tiles se pueden ocultar. El doble-clic permite cambiar r&aacute;pidamente de herramienta.<br /><br />En la primera utilizaci&oacute;n, se recomienda activar las herramientas una a una, por si acaso apareciese alguna incompatibilidad con tu esqueleto, con SPIP o con otros plugins.<br /><br />Nota: la simple carga de esta p&aacute;gina recompila el conjunto de herramientas de la Navaja Suiza.',
	'outil_intro_old' => 'Esta interfaz est&aacute; anticuada.<br /><br />Si encuentras problemas para utilizar la <a href=\'./?exec=admin_couteau_suisse\'>nueva interfaz</a>, no dudes en avisarnos en el foro de <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@: @nb@ &uacute;til', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ &uacute;tiles', # MODIF
	'outil_permuter' => '&iquest;Cambiar la herramienta: &laquo; @text@ &raquo;?',
	'outils_actifs' => 'Herramientas activadas:',
	'outils_caches' => 'Herramientas ocultas:',
	'outils_cliquez' => 'Pulsa sobre el nombre de los &uacute;tiles de arriba para ver aqu&iacute; su descripci&oacute;n.',
	'outils_concernes' => 'Sont concern&eacute;s : ', # NEW
	'outils_desactives' => 'Sont d&eacute;sactiv&eacute;s : ', # NEW
	'outils_inactifs' => 'Herramientas inactivas:',
	'outils_liste' => 'Lista de herramientas de La Navaja Suiza',
	'outils_non_parametrables' => 'Non param&eacute;trables&nbsp;:', # NEW
	'outils_permuter_gras1' => 'Cambiar los &uacute;tiles en negrita',
	'outils_permuter_gras2' => '&iquest;Cambiar los @nb@ &uacute;tiles en negrita?',
	'outils_resetselection' => 'Reinicializar la selecci&oacute;n',
	'outils_selectionactifs' => 'Seleccionar todos los &uacute;tiles activos',
	'outils_selectiontous' => 'TODOS',

	// P
	'pack_actuel' => 'Paquete @date@',
	'pack_actuel_avert' => 'Atenci&oacute;n, las sobrecargas para los define() o los globales no se especifican aqu&iacute;', # MODIF
	'pack_actuel_titre' => 'PAQUETE ACTUAL DE CONFIGURACI&Oacute;N DE LA NAVAJA SUIZA',
	'pack_alt' => 'Ver los par&aacute;metros de configuraci&oacute;n actual',
	'pack_delete' => 'Supression d\'un pack de configuration', # NEW
	'pack_descrip' => 'Tu &laquo;Paquete de configuraci&oacute;n actual&raquo; re&uacute;ne el conjunto de par&aacute;metros de configuraci&oacute;n actuales relativos a la Navaja Suiza: la activaci&oacute;n de los &uacute;tiles y el valor de sus eventuales variables.

Si los permisos de escritura lo permiten, este c&oacute;digo PHP puede situarse en el archivo {{/config/mes_options.php}} y a&ntilde;adir un enlace de reinicializaci&oacute;n en esta p&aacute;gina del paquete &laquo;{@pack@}&raquo;. Por supuesto puedes cambiarle el nombre.

Si reinicializas el plugin pulsando en un paquete, la Navaja Suiza volver&aacute; a configurarse autom&aacute;ticamente en funci&oacute;n de los par&aacute;metros predefinidos en ese paquete.', # MODIF
	'pack_du' => '• del pack @pack@',
	'pack_installe' => 'Colocaci&oacute;n de un pack de configuraci&oacute;n',
	'pack_installer' => '&iquest;Confirmas que deseas reinicializar la Navaja Suiza e instalar el paquete &laquo;&nbsp;@pack@&nbsp;&raquo;?',
	'pack_nb_plrs' => 'Actualmente hay @nb@ &laquo;paquetes de configuraci&oacute;n&raquo; disponibles.', # MODIF
	'pack_nb_un' => 'Actualmente hay un &laquo;paquete de configuraci&oacute;n&raquo; disponible', # MODIF
	'pack_nb_zero' => 'No hay ning&uacute;n &laquo;paquete de configuraci&oacute;n&raquo; disponible actualmente.',
	'pack_outils_defaut' => 'Herramientas de instalaci&oacute;n por default ',
	'pack_sauver' => 'Guardar la configuraci&oacute;n actual',
	'pack_sauver_descrip' => 'El bot&oacute;n de m&aacute;s abajo permite insertar directamente en el archivo <b>@file@</b> los par&aacute;metros necesarios para a&ntilde;adir un &laquo;paquete de configuraci&oacute;n&nbsp;&raquo; en el men&uacute; de la izquierda. Esto te permitir&aacute; despu&eacute;s devolver con un clic la Navaja Suiza al estado de configuraci&oacute;n en que est&aacute; actualmente.',
	'pack_supprimer' => '&Ecirc;tes-vous s&ucirc;r de vouloir supprimer le pack &laquo;&nbsp;@pack@&nbsp;&raquo; ?', # NEW
	'pack_titre' => 'Configuraci&oacute;n Actual',
	'pack_variables_defaut' => 'Instalaci&oacute;n de variables por defecto',
	'par_defaut' => 'Por omisi&oacute;n',
	'paragrapher2:description' => 'La funci&oacute;n SPIP <code>paragrapher()</code> inserta balizas &lt;p&gt; y &lt;/p&gt; en todos los textos desprovistos de p&aacute;rrafo. Para de un ajuste m&aacute;s fino de tus estilos y compaginaciones, tienes la posibilidad de uniformizar el aspecto de los textos de tu sitio.[[%paragrapher%]]',
	'paragrapher2:nom' => 'P&aacute;rrafos',
	'pipelines' => 'Pipelines utilizadas:',
	'previsualisation:description' => 'Par d&eacute;faut, SPIP permet de pr&eacute;visualiser un article dans sa version publique et styl&eacute;e, mais uniquement lorsque celui-ci a &eacute;t&eacute; &laquo; propos&eacute; &agrave; l&rsquo;&eacute;valuation &raquo;. Hors cet outil permet aux auteurs de pr&eacute;visualiser &eacute;galement les articles pendant leur r&eacute;daction. Chacun peut alors pr&eacute;visualiser et modifier son texte &agrave; sa guise.



@puce@ Attention : cette fonctionnalit&eacute; ne modifie pas les droits de pr&eacute;visualisation. Pour que vos r&eacute;dacteurs aient effectivement le droit de pr&eacute;visualiser leurs articles &laquo; en cours de r&eacute;daction &raquo;, vous devez l&rsquo;autoriser (dans le menu {[Configuration&gt;Fonctions avanc&eacute;es->./?exec=config_fonctions]} de l&rsquo;espace priv&eacute;).', # NEW
	'previsualisation:nom' => 'Pr&eacute;visualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci &laquo;*&raquo;', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Reemplaza las vi&ntilde;etas &laquo;-&raquo; (gui&oacute;n simple) de los art&iacute;culos por listas anotadas &laquo;-*&raquo; (traducidas en HTML como: &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) cuyo estilo puede personalizars mediante css.', # MODIF
	'pucesli:nom' => 'Vi&ntilde;etas mejoradas',

	// Q
	'qui_webmestres' => 'Les webmestres SPIP', # NEW

	// R
	'raccourcis' => 'Atajos tipogr&aacute;ficos activos de la Navaja Suiza:',
	'raccourcis_barre' => 'Los atajos tipogr&aacute;ficos de la Navaja Suiza',
	'reserve_admin' => 'Acceso reservado a los administradores.',
	'rss_actualiser' => 'Actualizar',
	'rss_attente' => 'Esperando RSS...',
	'rss_desactiver' => 'Desactivar las &laquo; Revisiones de la Navaja Suiza &raquo;',
	'rss_edition' => 'Flujo RSS actualizado el:',
	'rss_source' => 'Origen RSS',
	'rss_titre' => '&laquo;&nbsp;La Navaja Suiza&nbsp;&raquo; en desarrollo:',
	'rss_var' => 'Las revisiones de La Navaja Suiza',

	// S
	'sauf_admin' => 'Todos, salvo los administradores',
	'sauf_admin_redac' => 'Tous, sauf les administrateurs et r&eacute;dacteurs', # NEW
	'sauf_identifies' => 'Tous, sauf les auteurs identifi&eacute;s', # NEW
	'set_options:description' => 'Selecciona autom&aacute;ticamente el tipo de interfaz privada (simplificada o avanzada) para todos los redactores existentes o futuros y suprime el bot&oacute;n correspondiente de la banda de peque&ntilde;os iconos.[[%radio_set_options4%]]',
	'set_options:nom' => 'Tipo de interfaz privada',
	'sf_amont' => 'Anterior',
	'sf_tous' => 'Todos',
	'simpl_interface:description' => 'Desactiva el men&uacute; de cambio r&aacute;pido del estado de un art&iacute;culo al pasar sobre su icono de color. Esto resulta &uacute;til si buscas obtener una interfaz privada lo m&aacute;s sencilla posible para optimizar el rendimiento del cliente.',
	'simpl_interface:nom' => 'Aligerar la interfaz privada',
	'smileys:aide' => 'Smileys: @liste@',
	'smileys:description' => 'Inserta &laquo;smileys&raquo; en todos los textos donde aparezca un atajo de tipo <acronym>:-)</acronym>. Ideal para los foros.
_ Hay una baliza disponible para mostrar una tabla de smileys en tus esqueletos: #SMILEYS.
_ Dibujos: [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'A&ntilde;ade al sitio p&uacute;blico un desplazamiento suave de la p&aacute;gina cuando el visitante hace clic en un enlace que apunta a un ancla: muy &uacute;til para evitar perderse en una p&aacute;gina compleja u en un texto muy largo...

Atenci&oacute;n, para que funcione esta herramienta se necesitan p&aacute;ginas con &laquo;DOCTYPE XHTML&raquo; (&iexcl;no HTML!) y dos plugins {jQuery}: {ScrollTo} y {LocalScroll}. La Navaja Suiza puede instalarlos directamente si marcas las casillas siguientes. [[%scrollTo%]][[->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Anclas suaves',
	'sommaire:description' => 'Construye un sumario para el texto de tus art&iacute;culos y secciones con el fin de acceder r&aacute;pidamente a los intert&iacute;tulos (etiquetas HTML &lt;h3>Un intert&iacute;tulo&lt;/h3> o atajos de SPIP: intert&iacute;tulos de la forma: <code>{{{Un intert&iacute;tulo}}}</code>).

@puce@ Aqu&iacute; puedes definir el n&uacute;mero m&aacute;ximo de caracteres tomados de los intert&iacute;tulos para construir el sumario: [[%lgr_sommaire% caracteres]]

@puce@ Tambi&eacute;n puedes regular el comportamiento del plugin respecto a la creaci&oacute;n de sumario: 
_ • Por sistema para cada art&iacute;culo (una baliza <code>>@_CS_SANS_SOMMAIRE@</code> situada en cualquier lugar del texto del art&iacute;culo crear&aacute; una excepci&oacute;n).
_ • &Uacute;nicamente para los art&iacute;culos que contengan la baliza <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Por omisi&oacute;n, la Navaja Suiza inserta el sumario autom&aacute;ticamente en el encabezamiento del art&iacute;culo. Pero tienes la posibilidad situar este sumario en otro lugar de tu esqueleto gracias a una baliza #CS_SOMMAIRE que puedes activar aqu&iacute;:
[[%balise_sommaire%]]

Este sumario puede combinarse con: &laquo;&nbsp;[.->decoupe]&nbsp;&raquo;.', # MODIF
	'sommaire:nom' => 'Un sumario autom&aacute;tico', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre&lt;mon_ancre&gt;}}}</html></b>', # NEW
	'sommaire_avec' => 'Un texto con sumario: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un texto sin sumario: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hi&eacute;rarchis&eacute;s&nbsp;: <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Intenta luchar contra los env&iacute;os de mensajes autom&aacute;ticos y malintencionados en la parte p&uacute;blica. Ciertas palabras y las etiquetas &lt;a>&lt;/a> est&aacute;n prohibidas.

Lista aqu&iacute; las secuencias prohibidas@_CS_ASTER@ separ&aacute;ndolas por espacios. [[%spam_mots%]]
@_CS_ASTER@Para especificar una palabra completa, ponla entre par&eacute;ntesis. Para una expresi&oacute;n con espacios, ponla entre comillas.', # MODIF
	'spam:nom' => 'Lucha contra el SPAM',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Ce message serait bloqu&eacute; par le filtre anti-SPAM !', # NEW
	'spam_test_ok' => 'Ce message serait accept&eacute; par le filtre anti-SPAM.', # NEW
	'spam_tester_bd' => 'Testez &eacute;galement votre votre base de donn&eacute;es et listez les messages qui auraient &eacute;t&eacute; bloqu&eacute;s par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Afin de tester votre liste de s&eacute;quences interdites ou d\'adresses&nbsp;IP, utilisez le cadre suivant :', # NEW
	'spip_cache:description' => '@puce@ La cach&eacute; ocupa un cierto espacio en disco y SPIP puede limitar su extensi&oacute;n. Un valor vac&iacute;o o igual a 0 significa que no se aplica ninguna cuota.[[%quota_cache% Mo]]

@puce@ Cuando se hace una modificaci&oacute;n del contenido del sitio, SPIP invalida inmediatamente la cach&eacute; sin esperar el siguiente c&aacute;lculo peri&oacute;dico. Si tu sitio tiene problemas de rendimiento debidos a una carga muy alta, puedes marcar &laquo;&nbsp;no&nbsp;&raquo; en esta opci&oacute;n.[[%derniere_modif_invalide%]

@puce@ Si la baliza #CACHE no se encuentra en tus esqueletos locales, SPIP considera por omisi&oacute;n que la cach&eacute; de una p&aacute;gina tiene un tiempo de vida de 24 horas antes de recalcularla. Para gestionar mejor la carga en tu servidor, puedes modificar este valor aqu&iacute;.[[%duree_cache% heures]]

@puce@ Si tienes varios sitios mutualizados, puedes especificar aqu&iacute; el valor por omisi&oacute;n que se toma para todos los sitios locales (SPIP 2.0 mini).[[%duree_cache_mutu% horas]]', # MODIF
	'spip_cache:description1' => '@puce@ Por omisi&oacute;n, SPIP calcula todas las p&aacute;ginas p&uacute;blicas y las sit&uacute;a en la cach&eacute; para acelerar la consulta. Desactivar temporalmente la cach&eacute; puede ayudar durante el desarrollo del sitio. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ Cuatro opciones para orientar el funcionamiento de la cach&eacute; de SPIP: <q1>
_ • {Uso normal}: SPIP calcula todas las p&aacute;ginas p&uacute;blicas y las pone en la cach&eacute; para acelerar la consulta. Tras un cierto intervalo, la cach&eacute; se recalcula y se guarda.
_ • {Cach&eacute; permanente}: los intervalos de invalidaci&oacute;n de la cach&eacute; se ignoran.
_ • {Sin cach&eacute;}: desactivar temporalmente la cach&eacute; puede ayudar mientras se desarrolla el sitio. Aqu&iacute;, no se guarda nada en el disco.
_ • {Control de la cach&eacute;}: opci&oacute;n id&eacute;ntica a la anterior, con escritura en el disco de todos los resultados para poder controlarlos si hace falta.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension &laquo; Compresseur &raquo; pr&eacute;sente dans SPIP permet de compacter les diff&eacute;rents &eacute;l&eacute;ments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela acc&eacute;l&egrave;re l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers &agrave; obtenir.', # NEW
	'spip_cache:nom' => 'SPIP y la cach&eacute;…',
	'spip_ecran:description' => 'D&eacute;termine la largeur d\'&eacute;cran impos&eacute;e &agrave; tous en partie priv&eacute;e. Un &eacute;cran &eacute;troit pr&eacute;sentera deux colonnes et un &eacute;cran large en pr&eacute;sentera trois. Le r&eacute;glage par d&eacute;faut laisse l\'utilisateur choisir, son choix &eacute;tant stock&eacute; dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'&eacute;cran', # NEW
	'stat_auteurs' => 'Estado de los autores',
	'statuts_spip' => '&Uacute;nicamente los siguientes estados SPIP:',
	'statuts_tous' => 'Todos los estados',
	'suivi_forums:description' => 'El autor de un art&iacute;culo siempre es informado cuando se publique un mensaje en el foro p&uacute;blico asociado. Pero es posible avisar adem&aacute;s: a todos los participantes en el foro, o solamente a los autores de los mensajes previos del hilo.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Seguimiento de los foros p&uacute;blicos',
	'supprimer_cadre' => 'Suprimir este cuadro',
	'supprimer_numero:description' => 'Aplica la funci&oacute;n SPIP supprimer_numero() al conjunto de {{t&iacute;tulos}}, de {{nombres}} y de {{tipos}} (de palabras-clave) del sitio p&uacute;blico, sin que el filtro supprimer_numero est&eacute; presente en los esqueletos.<br />Esta es la sintaxis a utilizar en el caso de un sitio multiling&uuml;e: <code>1. <multi>Mi T&iacute;tulo[en]My Title[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Suprime el n&uacute;mero',

	// T
	'titre' => 'La Navaja Suiza',
	'titre_parent:description' => 'En el interior de un bucle, es habitual que se quiera mostrar el t&iacute;tulo del padre del objeto en curso. Tradicionalmente, bastaba utilizar un segundo bucle, pero esta nueva baliza #TITRE_PARENT aligerar&aacute; la escritura de tus esqueletos. El resultado devuelto es: el t&iacute;tulo del grupo de una palabra-clave o el de la secci&oacute;n padre (si existe) de cualquier otro objeto (art&iacute;culo, secci&oacute;n, breve, etc.).

Nota: Para las palabras-clave, un alias de #TITRE_PARENT es #TITRE_GROUPE. El tratamiento por SPIP de estas balizas nuevas es similar al de #TITRE.

@puce@ Si utilizas SPIP 2.0, aqu&iacute; tienes disponible todo un conjunto de balizas #TITRE_XXX que podr&aacute;n devolver el t&iacute;tulo del objeto \'xxx\', a condici&oacute;n de que el campo \'id_xxx\' est&eacute; presente en la tabla en curso (#ID_XXX utilizable en el bucle en curso).

Por ejemplo, en un bucle sobre (ARTICLES), #TITRE_SECTEUR devolver&aacute; el t&iacute;tulo del sector en el que est&aacute; situado el art&iacute;culo en curso, pues el identificador #ID_SECTEUR (o el campo \'id_secteur\') est&aacute; disponible en ese caso.

Igualmente est&aacute; soportada la sintaxis <html>#TITRE_XXX{yy}</html>. Ejemplo: <html>#TITRE_ARTICLE{10}</html> devolver&aacute; el t&iacute;tulo del art&iacute;culo #10.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Balizas #TITRE_PARENT/OBJET',
	'titre_tests' => 'La Navaja Suiza - P&aacute;gina de pruebas…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>&laquo; {{{Mon intertitre}}} &raquo;</html> en image typographique param&eacute;trable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%



Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]



Cet outil est compatible avec : &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'tous' => 'Todos',
	'toutes_couleurs' => 'Los 36 colores de los estilos css: @_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Bloques multiling&uuml;es: <b><:trad:></b>',
	'toutmulti:description' => 'Del mismo modo que puedes hacer en los esqueletos, esta herramienta te permite utilizar libremente las cadenas de idioma (de SPIP o de tus esqueletos) en todos los contenidos del sitio (art&iacute;culos, t&iacute;tulos, mensajes, etc.) con ayuda del atajo <code><:cadena:></code>.

Consulta [aqu&iacute; ->http://www.spip.net/es_article2247.html] la documentaci&oacute;n de SPIP sobre el tema.

Esta herramienta tambi&eacute;n acepta argumentos introducidos por SPIP 2.0. Por ejemplo, el atajo <code><:cadena{nombre=Jos&eacute; Garc&iacute;a, edad=37}:></code> permite pasar dos par&aacute;metros en la cadena siguiente: <code>\'cadena\'=>"Hola, soy @nombre@ y tengo @edad@ a&ntilde;os\\"</code>.

La funci&oacute;n de SPIP utilizada en PHP es  <code>_T(\'cadena\')</code> sin argumentos, y <code>_T(\'cadena, array(\'arg1\'=>\'un texto\', \'arg2\'=>\'otro texto\'))</code> con argumentos.

No te olvides de verificar que la clave <code>\'cadena\'</code> est&eacute; bien definida en los ficheros de idiomas. ', # MODIF
	'toutmulti:nom' => 'Bloques multiling&uuml;es',
	'travaux_masquer_avert' => 'Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours', # NEW
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Este sitio se reactivar&aacute; en breve.
_ Gracias por la comprensi&oacute;n.', # MODIF
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Elige aqu&iacute; la ordenaci&oacute;n que se usar&aacute; para mostrar tus art&iacute;culos dentro de las secciones cuando navegues por la parte privada del sitio ([->./?exec=auteurs]).

Las propuestas siguientes se basan en la funci&oacute;n SQL \'ORDER BY\': utiliza la ordenaci&oacute;n personalizada s&oacute;lo si sabes muy bien lo que haces (campos disponibles: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Ordenaci&oacute;n de los art&iacute;culos', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'Ordenar por fecha de modificaci&oacute;n (ORDER BY date_modif DESC)',
	'tri_perso' => 'Ordenaci&oacute;n SQL personalizada, ORDER BY seguido por:',
	'tri_publi' => 'Ordenar por fecha de publicaci&oacute;n (ORDER BY date DESC)',
	'tri_titre' => 'Ordenar por t&iacute;tulo (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Outil en cours de d&eacute;veloppement. Vous offre quelques balises tr&egrave;s simples et bien pratiques pour am&eacute;liorer la lisibilit&eacute; de vos squelettes.



@puce@ {{#BOLO}} : g&eacute;n&egrave;re un faux texte d\'environ 3000 caract&egrave;res ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction sp&eacute;cifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.

_ Un mod&egrave;le est &eacute;galement disponible pour vos contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caract&egrave;res de faux texte.



@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction sp&eacute;cifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalisez l\'affichage gr&acirc;ce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.



@puce@ {{#CHR<html>{XX}</html>}} : balise &eacute;quivalente &agrave; <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caract&egrave;res sp&eacute;ciaux (le retour &agrave; la ligne par exemple) ou des caract&egrave;res r&eacute;serv&eacute;s par le compilateur de SPIP (les crochets ou les accolades).



@puce@ {{#LESMOTS}} : ', # NEW
	'trousse_balises:nom' => 'Trousse &agrave; balises', # NEW
	'type_urls:description' => '@puce@ SPIP te permite elegir entre varios tipos de URLs para crear los enlaces de acceso a las p&aacute;ginas de tu sitio:

M&aacute;s informaci&oacute;n: [->http://www.spip.net/es_article2024.html]. La utilidad &laquo;&nbsp;[.->boites_privees]&nbsp;&raquo; te permite ver en la p&aacute;gina de cada objeto SPIP la URL propia asociada.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@para utilizar los formatos {html}, {propre}, {propre2}, {libres} o {arborescentes}, copia el archivo "htaccess.txt" de la carpeta base del sitio SPIP y ponle el nombre ".htaccess" (primero haz una copia de seguridad, y ten cuidado para no borrar otros ajustes que podr&iacute;as haber puesto en ese archivo); si tu sitio est&aacute; como "subdirectorio", tendr&aacute;s que editar tambi&eacute;n la l&iacute;nea "RewriteBase" de ese fichero. Las URLs definidas ahora se redirigir&aacute;n hacia los ficheros de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs &laquo;page&raquo;}}: son los enlaces por omisi&oacute;n, utilizados por SPIP desde su versi&oacute;n 1.9x.
_ Ejemplo: <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs &laquo;html&raquo;}}: los enlaces tienen forma de p&aacute;ginas html cl&aacute;sicas.
_ Ejemplo: <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs &laquo;propres&raquo; (propias)}}: los enlaces se calculan mediante el t&iacute;tulo de los objetos solicitados. Los t&iacute;tulos se rodean con marcadores (_, -, +, @, etc.) en funci&oacute;n del tipo de objeto.
_ Ejemplos: <code>/Mi-titulo-de-articulo</code> o <code>/-Mi-seccion-</code> o <code>/@Mi-sitio@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs &laquo;propres2&raquo; (propias 2)}}: se a&ntilde;ade la extension \'.html\' a los enlaces {&laquo;propios&raquo;}.
_ Ejemplo: <code>/Mi-titulo-de-articulo.html</code> o <code>/-Mi-seccion-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs &laquo;libres&raquo;}}: los enlaces son {&laquo;propios&raquo;}, pero sin marcadores separando los objetos (_, -, +, @, etc.).
_ Ejemplo: <code>/Mi-titulo-de-articulo</code> o <code>/Mi-seccion</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs &laquo;arborescentes&raquo;}}: los enlaces son {&laquo;propios&raquo;}, pero de tipo ramificado.
_ Ejemplo: <code>/sector/seccion1/seccion2/Mi-titulo-de-articulo</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs &laquo;propres-qs&raquo;}}: este sistema funciona en "Query-String", es decir, sin utilizar .htaccess ; los enlaces son {&laquo;propios&raquo;}.
_ Ejemplo: <code>/?Mi-titulo-de-articulo</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs &laquo;propres-qs&raquo;}}: este sistema funciona en "Query-String", es decir, sin utilizar .htaccess ; los enlaces son {&laquo;propios&raquo;}.
_ Ejemplo: <code>/?Mi-titulo-de-articulo</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs &laquo;standard&raquo;}}: estos enlaces, que ya son obsoletos, se utilizaron por SPIP hasta su versi&oacute;n 1.8.
_ Ejemplo: <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Si utilizas el formato {page} de m&aacute;s arriba o si no se reconoce el objeto solicitado, te ser&aacute; posible elegir {{el script de llamada}} a SPIP. Por omisi&oacute;n, SPIP usa {spip.php}; pero {index.php} (ejemplo de formato: <code>/index.php?article123</code>) o un valor nulo (formato: <code>/?article123</code>) tambi&eacute;n funcionan. Para cualquier otro valor, te ser&aacute; absolutamente necesario crear el fichero correspondiente en la ra&iacute;z de SPIP, a imagen del que ya existe: {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ Si utilizas un formato basado en URLs &laquo;propias&raquo; ({propres}, {propres2}, {libres}, {arborescentes} o {propres_qs}), la Navaja Suiza puede:
<q1>• Asegurar que la URL producida est&eacute; totalmente {{en min&uacute;sculas}}.
_ • Hacer que se a&ntilde;ada sistem&aacute;ticamente {{la id del objeto}} a su URL (como sufijo o prefijo).
_ (ejemplos: <code>/Mi-titulo-de-articulo,457</code> o <code>/457-Mi-titulo-de-articulo</code>)</q1>[[%urls_minuscules%]][[->%urls_avec_id%]][[->%urls_avec_id2%]]', # MODIF
	'type_urls:nom' => 'Formato de las URLs',
	'typo_exposants:description' => '{{Textos en franc&eacute;s}}: mejora la presentaci&oacute;n tipogr&aacute;fica de las abreviaturas corrientes, poniendo como super&iacute;ndices los elementos necesarios (as&iacute;, {<acronym>Mme</acronym>} se transforma en {M<sup>me</sup>}) y corrigiendo los errores comunes ({<acronym>2&egrave;me</acronym>} o  {<acronym>2me</acronym>}, por ejemplo, se transforman en {2<sup>e</sup>}, &uacute;nica abreviatura correcta).

Las abreviaturas obtenidas son conformes con las de la Imprenta nacional francesa, tal como se indican en el {Lexique des r&egrave;gles typographiques en usage &agrave; l\'Imprimerie nationale} (art&iacute;culo &laquo;&nbsp;Abr&eacute;viations&nbsp;&raquo;, presses de l\'Imprimerie nationale, Paris, 2002).

Tambi&eacute;n se procesan las expresiones siguientes: <html>Dr, Pr, Mgr, m2, m3, Mn, Md, St&eacute;, &Eacute;ts, Vve, Cie, 1o, 2o, etc.</html>

Aqu&iacute; puedes escoger escribir como super&iacute;ndices otras abreviaturas suplementarias, que se desaconsejan por l\'Imprimerie nationale :[[%expo_bofbof%]]

{{Textos en ingl&eacute;s}}: paso a super&iacute;ndice de los n&uacute;meros ordinales: <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Abreviaturas tipogr&aacute;ficas',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'p&aacute;gina',
	'url_propres' => 'propres@_CS_ASTER@',
	'url_propres-qs' => 'propres-qs',
	'url_propres2' => 'propres2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'standard',
	'urls_3_chiffres' => 'Imposer un minimum de 3 chiffres', # NEW
	'urls_avec_id' => 'Id sistematicamente como sufijo', # MODIF
	'urls_avec_id2' => 'Id sistem&aacute;ticamente como prefijo', # MODIF
	'urls_base_total' => 'Actualmente hay @nb@ URL(s) en la base',
	'urls_base_vide' => 'La base de datos de URLs est&aacute; vac&iacute;a',
	'urls_choix_objet' => 'Edici&oacute;n basada en la URL de un objeto espec&iacute;fico:',
	'urls_edit_erreur' => 'El formato actual de las URLs (&laquo;&nbsp;@type@&nbsp;&raquo;) no permite la edici&oacute;n.',
	'urls_enregistrer' => 'Grabar esta URL en la base',
	'urls_id_sauf_rubriques' => 'Exclure les objets suivants (s&eacute;par&eacute;s par &laquo;&nbsp;:&nbsp;&raquo;) :', # NEW
	'urls_minuscules' => 'Letras min&uacute;sculas',
	'urls_nouvelle' => 'Editar la URL &laquo;propres&raquo; (propia):',
	'urls_num_objet' => 'N&uacute;mero:',
	'urls_purger' => 'Vaciar todo',
	'urls_purger_tables' => 'Vaciar las tablas seleccionadas',
	'urls_purger_tout' => 'Reinicializar las URLs guardadas en la base:',
	'urls_rechercher' => 'Buscar este objeto en la base',
	'urls_titre_objet' => 'T&iacute;tulo grabado:',
	'urls_type_objet' => 'Objeto:',
	'urls_url_calculee' => 'URL p&uacute;blica &laquo;&nbsp;@type@&nbsp;&raquo;:',
	'urls_url_objet' => 'URL &laquo;propres&raquo; (propia) grabada:',
	'urls_valeur_vide' => '(Un valor vac&iacute;o implica recalcular la URL)',

	// V
	'validez_page' => 'Para acceder a las modificaciones:',
	'variable_vide' => '(Vac&iacute;o)',
	'vars_modifiees' => 'Los datos se han modificado correctamente',
	'version_a_jour' => 'Tu versi&oacute;n est&aacute; actualizada.',
	'version_distante' => 'Versi&oacute;n distante...',
	'version_distante_off' => 'Comprobaci&oacute;n externa desactivada',
	'version_nouvelle' => 'Nueva versi&oacute;n: @version@',
	'version_revision' => 'Revisi&oacute;n: @revision@',
	'version_update' => 'Actualizaci&oacute;n autom&aacute;tica',
	'version_update_chargeur' => 'Descarga autom&aacute;tica',
	'version_update_chargeur_title' => 'Descargar la &uacute;ltima versi&oacute;n del plugin mediante el plugin &laquo;Descargador&raquo;',
	'version_update_title' => 'Descarga la &uacute;ltima versi&oacute;n del plugin y efect&uacute;a su actualizaci&oacute;n autom&aacute;tica',
	'verstexte:description' => '2 filtros para tus esqueletos, que permiten producir p&aacute;ginas m&aacute;s ligeras.
_ version_texte : extrae el texto contenido en una p&aacute;gina html excluyendo algunas balizas elementales.
_ version_plein_texte : extrae el texto contenido en una p&aacute;gina html para mostrarlo como texto puro.', # MODIF
	'verstexte:nom' => 'Versi&oacute;n texto',
	'visiteurs_connectes:description' => 'A&ntilde;ade un fragmento a tu esqueleto que muestra el n&uacute;mero de visitantes conectados en el sitio p&uacute;blico.

A&ntilde;ade sencillamente <code><INCLURE{fond=fonds/visiteurs_connectes}></code> en tus p&aacute;ginas.', # MODIF
	'visiteurs_connectes:nom' => 'Visitantes conectados',
	'voir' => 'Ver: @voir@',
	'votre_choix' => 'Tu elecci&oacute;n:',

	// W
	'webmestres:description' => 'Un {{webmaster}} en el sentido de SPIP es un {{administrador}} que tiene acceso al espacio FTP. Por omisi&oacute;n, y a partir de SPIP 2.0, el administrador es el <code>id_auteur=1</code> del sitio. Los webmasters definidos aqu&iacute; tienen el privilegio de no estar obligados a pasar por el FTP para validar las operaciones delicadas del sitio, como la actualizaci&oacute;n de la base de datos o la restauraci&oacute;n de un volcado.

Webmaster(s) actual(es): {@_CS_LISTE_WEBMESTRES@}.
_ Administrador(es) elegible(s): {@_CS_LISTE_ADMINS@}.

Al ser webmaster tu mismo, aqu&iacute; tienes permisos para modificar esta lista de ids -- separadas por dos puntos &laquo;&nbsp;:&nbsp;&raquo; si son varias. Ejemplo: &laquo;1:5:6&raquo;.[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Lista de webmasters',

	// X
	'xml:description' => 'Activa el validador de xml para el espacio p&uacute;blico como se describe en la [documentaci&oacute;n->http://www.spip.net/fr_article3541.html]. Se a&ntilde;ade un bot&oacute;n titulado &laquo;&nbsp;An&aacute;lisis XML&nbsp;&raquo; a los botones de administraci&oacute;n.',
	'xml:nom' => 'Validador de XML'
);

?>
