<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => '&nbsp;:&nbsp;non',
	'2pts_oui' => '&nbsp;:&nbsp;si',

	// S
	'SPIP_liens:description' => '@puce@ Todas as ligaz&oacute;ns do web se abren predeterminadamente na mesma vent&aacute; de navegaci&oacute;n en curso. Mais pode ser &uacute;til abril ligaz&oacute;ns externas ao web nunha nova vent&aacute; exterior -- iso implica engadir {target="_blank"} a todas as balizas &lt;a&gt; dotadas por  SPIP de clases {spip_out}, {spip_url} ou {spip_glossaire}. Se cadra &eacute; necesario engadir unha destas clases nas ligaz&oacute;ns do esqueleto do web (ficheiros html) co fin de estender ao m&aacute;ximo esta funcionalidade.[[%radio_target_blank3%]]

@puce@ SPIP permite ligar palabras &aacute; s&uacute;a definici&oacute;n merc&eacute; ao atallo tipogr&aacute;fico <code>[?mot]</code>. Predeterminadamente (ou se vostede  deixa baleira a caixa seguinte), o glosario externo reenv&iacute;a sobre a enciclopedia libre wikipedia.org. Pode escoller o enderezo que se vaia utilizar. <br />Ligaz&oacute;n de test : [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP prev&eacute; un estilo CSS para as ligaz&oacute;ns &laquo;~mailto:~&raquo; : un pequeno cadro deber&iacute;a aparecer para cada ligaz&oacute;n relacionada cun enderezo de correo; mais para que todos os navegadores non o poidan mostrar (nomeadamente IE6, IE7 e SAF3), decida se c&oacute;mpre conservar este engadido.
_ Ligaz&oacute;n de test : [->test@test.com] (vexa a p&aacute;xina completamente).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP e as ligaz&oacute;ns externas',
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
	'acces_admin' => 'Acceso de administraci&oacute;n :',
	'action_rapide' => 'Acci&oacute;n r&aacute;pida, unicamente se sabe do que fai!',
	'action_rapide_non' => 'Acci&oacute;n r&aacute;pida, dispo&ntilde;ible tras a activaci&oacute;n desta utilidade :',
	'admins_seuls' => 'S&oacute; para administradores/as',
	'attente' => 'En espera...',
	'auteur_forum:description' => 'Invite a todos os autores de mensaxes p&uacute;blicas a fornecer (cando menos cunha letra!) un nome e/ou un correo co fin de evitar as colaboraci&oacute;ns totalmente an&oacute;nimas. Esta utilidade procede a facer unha verificaci&oacute;n JavaScript sobre a caixa de correo do visitante.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Atenci&oacute;n : Escoller a terceira opci&oacute;n anula as d&uacute;as primeiras. C&oacute;mpre verificar que os formularios do seu esqueleto sexan compatibles con esta ferramenta.}', # MODIF
	'auteur_forum:nom' => 'Non haber&aacute; foros an&oacute;nimos',
	'auteur_forum_deux' => 'Ou, cando menos un dos dous campos seguintes',
	'auteur_forum_email' => 'O campo &laquo;@_CS_FORUM_EMAIL@&raquo;',
	'auteur_forum_nom' => 'O campo &laquo;@_CS_FORUM_NOM@&raquo;',
	'auteurs:description' => 'Esta utilidade configura a apariencia da [p&aacute;xina de autores->./?exec=auteurs], na s&uacute;a parte privada.

@puce@ Defina aqu&iacute; o n&uacute;mero m&aacute;ximo de autores que se mostrar&aacute;n no cadro central da p&aacute;xina de autores. A partir de a&iacute;, os autores ser&aacute;n mostrados mediante unha paxinaci&oacute;n.[[%max_auteurs_page%]]

@puce@ Que estados de autores poden ser listados nesta p&aacute;xina?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]', # MODIF
	'auteurs:nom' => 'P&aacute;xina de autores',

	// B
	'balise_set:description' => 'Afin d\'all&eacute;ger les &eacute;critures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqu&eacute; &agrave; une variable passe donc dans le nom de la balise.



Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'Balise #SET &eacute;tendue', # NEW
	'barres_typo_edition' => 'Edition des contenus', # NEW
	'barres_typo_forum' => 'Messages de Forum', # NEW
	'barres_typo_intro' => 'Le plugin &laquo;Porte-Plume&raquo; a &eacute;t&eacute; d&eacute;tect&eacute;. Veuillez choisir ici les barres typographiques o&ugrave; certains boutons seront ins&eacute;r&eacute;s.', # NEW
	'basique' => 'B&aacute;sica',
	'blocs:aide' => 'Bloques despregables : <b>&lt;bloque&gt;&lt;/bloque&gt;</b> (alias : <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) e <b>&lt;visible&gt;&lt;/visible&gt;</b>',
	'blocs:description' => 'Perm&iacute;telle crear bloques nos que o t&iacute;tulo &eacute; activo e pode facelos visibles ou invisibles.

@puce@ {{Dentro dos textos SPIP}} : os redactores te&ntilde;en a disposici&oacute;n as novas balizas &lt;bloque&gt; (ou &lt;invisible&gt;) e &lt;visible&gt; para utilizar nos seus textos, coma no caso : 

<quote><code>
<bloc>
 Un t&iacute;tulo que se far&aacute; activo,  clicable
 
 O texto para ocultar/mostrar, despois de dous saltos de li&ntilde;a...
 </bloc>
</code></quote>

@puce@ {{Dentro dos esqueletos}} : ten &aacute; s&uacute;a disposici&oacute;n as novas balizas #BLOC_TITRE, #BLOC_DEBUT e #BLOC_FIN para utilizar coma no caso : 
<quote><code> #BLOC_TITRE ou #BLOC_TITRE{mon_URL}
 O meu t&iacute;tulo
 #BLOC_RESUME    (facultativo)
 unha versi&oacute;n resumida do bloque seguinte
 #BLOC_DEBUT
 O meu bloque despregable (que conter&aacute; o enderezo URL punteado se for necesario)
 #BLOC_FIN</code></quote>
 
@puce@ Marcando &laquo;si&raquo;, a apertura dun bloque provocar&aacute; o cerre de todos os outros bloques da p&aacute;xina, co fin de non ter m&aacute;is ca un aberto &aacute; vez.[[%bloc_unique%]]

@puce@ Marcando &laquo;si&raquo;, o estado dos bloques numerados gardarase nunha cookie durante o tempo da sesi&oacute;n, co fin de conservar o aspecto da p&aacute;xina en caso de retorno.[[%blocs_cookie%]]

@puce@ A Navalla Su&iacute;za utiliza de modo predeterminado a baliza HTML &lt;h4&gt; para o t&iacute;tulo dos bloques despregables. Escolla aqu&iacute; outra baliza &lt;hN&gt;&nbsp;:[[%bloc_h4%]]
@puce@ Co fin de obter un efecto m&aacute;is doce no momento do clic, os bloques despregables poden animarse &aacute; maneira dun "esvaramento".[[%blocs_slide%]][[->%blocs_millisec% millisecondes]]', # MODIF
	'blocs:nom' => 'Bloques despregables',
	'boites_privees:description' => 'Todas as funcionalidades abaixo descritas aparecen aqu&iacute; ou na parte privada.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%bp_urls_propres%]]
[[->%bp_tri_auteurs%]]
- {{As revisi&oacute;ns da Navalla Su&iacute;za}} : un cadro sobre a presente p&aacute;xina de configuraci&oacute;n que indica as &uacute;ltimas modificaci&oacute;ns achegadas ao c&oacute;digo do m&oacute;dulo ([Source->@_CS_RSS_SOURCE@]).
- {{Os artigos en formato SPIP}} : un cadro despregable suplementario para os seus artigos co fin de co&ntilde;ecer o  c&oacute;digo fonte usado polos seus autores.
- {{Estado de autores}} : un cadro suplementario en [p&aacute;xina de autores->./?exec=auteurs] que indica os &uacute;ltimos 10 conectados e as inscrici&oacute;ns non confirmadas. S&oacute; os administradores ven esta informaci&oacute;n.
- {{Os webm&aacute;ster SPIP}} : un cadro despregable sobre [a p&aacute;xina dos autores->./?exec=auteurs] uqe indica os administradores elevados ao rango de webmaster SPIP. S&oacute; os administradores ven esta informaci&oacute;n. Se vostede &eacute; webm&aacute;ster, vexa tam&eacute;n a ferramenta &laquo;&nbsp;[.->webmestres]&nbsp;&raquo;.
- {{Os URL propios}} : un cadro despregable para cada obxecto de contido (artigo, secci&oacute;n, autor, ...) que indica o URL propio asociado as&iacute; como os seus alias eventuais. A ferramenta &laquo;&nbsp;[.->type_urls]&nbsp;&raquo; permite a configuraci&oacute;n fina dos URL do web.
- {{As ordenaci&oacute;ns de autores}} : un cadro despregable para os artigos que cont&eacute;n m&aacute;is dun autor e permite simplemente axustar a orde de presentaci&oacute;n.', # MODIF
	'boites_privees:nom' => 'Funcionalidades privadas',
	'bp_tri_auteurs' => 'As ordenaci&oacute;ns de autores',
	'bp_urls_propres' => 'Os URL propios',
	'brouteur:description' => 'Utilizar o selector de secci&oacute;n en AJAX a partir da %rubrique_brouteur% secci&oacute;n(s)', # MODIF
	'brouteur:nom' => 'Reglaxe do selector da secci&oacute;n', # MODIF

	// C
	'cache_controle' => 'Control da cach&eacute;',
	'cache_nornal' => 'Uso normal',
	'cache_permanent' => 'Cach&eacute; permanente',
	'cache_sans' => 'Non hai cach&eacute;',
	'categ:admin' => '1. Administraci&oacute;n',
	'categ:divers' => '60. Varios',
	'categ:interface' => '10. Interface privada',
	'categ:public' => '40. Exposici&oacute;n p&uacute;blica',
	'categ:securite' => '5. S&eacute;curit&eacute;', # NEW
	'categ:spip' => '50. Balizas, filtros, criterios',
	'categ:typo-corr' => '20. Melloramento de textos',
	'categ:typo-racc' => '30. Atallos tipogr&aacute;ficos',
	'certaines_couleurs' => 'S&oacute; as balizas definidas aqu&iacute; abaixo ci-dessous@_CS_ASTER@ :',
	'chatons:aide' => 'Chatons : @liste@',
	'chatons:description' => 'Introduce imaxes (ou chatons para os {tchats}) en todos os textos ou aparece unha cadea do tipo {{<code>:nom</code>}}.
_ Esta utilidade substit&uacute;e os atallos polas imaxes que co mesmo nome encontre no seu cartafol <code>mon_squelette_toto/img/chatons/</code>, ou de modo predefinido, o cartafo <code>couteau_suisse/img/chatons/</code>.', # MODIF
	'chatons:nom' => 'Chat&oacute;ns',
	'citations_bb:description' => 'Co fin de respectar os usos en HTML nos contidos SPIP do seu web (artigos, secci&oacute;ns, etc.), esta utilidade substit&uacute;e as balizas &lt;quote&gt; polas balizas &lt;q&gt; cando non hai retorno &aacute; li&ntilde;a. De feito, as citas curtas deben ser rodeadas por &lt;q&gt; e as citas que conte&ntilde;en par&aacute;grafos por &lt;blockquote&gt;.', # MODIF
	'citations_bb:nom' => 'Citas ben balizadas',
	'class_spip:description1' => 'Pode definir aqu&iacute; certos recursos de SPIP. Un valor baleiro equivale a usar o valor predeterminado.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Os atallos de SPIP}}.

Pode definir aqu&iacute; certos atallos de SPIP. Un valor baleiro equivale a usar o valor predeterminado.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{Aviso : se a utilidade &laquo;&nbsp;[.->pucesli]&nbsp;&raquo; est&aacute; activada, o reemprazamento da &laquo;&nbsp;-&nbsp;&raquo; xa non ser&aacute; efectuado&nbsp;; unha lista &lt;ul>&lt;li> sera utilizada no seu lugar.}

SPIP adoita usar a baliza &lt;h3&gt; para os intert&iacute;tulos. Escolla aqu&iacute; se quixer, outra cadea de substituci&oacute;n :[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP escolleu usar a baliza &lt;strong> para transcribir as grosas. Pero &lt;b> poder&iacute;a tam&eacute;n ter escollido con ou sen estilo. Vexa e valore :[[%racc_g1%]][[->%racc_g2%]]

SPIP elixiu usar a baliza &lt;i> para transcribir as cursiva. Mais &lt;em> poder&iacute;a ser igualmente adecuado, con ou sen estilo. Vexa e valore:[[%racc_i1%]][[->%racc_i2%]]

Tam&eacute;n pode definir o c&oacute;digo de apertura e cerre para as chamadas &aacute; notas a p&eacute; de p&aacute;xina (Atenci&oacute;n ! As modificaci&oacute;n non ser&aacute; visibles m&aacute;is ca no espazo p&uacute;blico.) : [[%ouvre_ref%]][[->%ferme_ref%]]
 
Tam&eacute;n pode definir o c&oacute;digo de apertura e cerre para as notas a pe de p&aacute;xina : [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{Os estilos de SPIP predeterminados}}. Ata a versi&oacute;n 1.92 de SPIP, os atallos tipogr&aacute;ficos produc&iacute;an balizas sistematicamente  nomeadas co patr&oacute;n "spip". Por exemplo: <code><p class="spip"></code>. Pode definir o estilo destas balizas en funci&oacute;n das s&uacute;as follas de estilo. Un caso baleiro significa que ning&uacute;n estilo en particular lle ser&aacute; aplicado.

{Ollo : se alg&uacute;ns recursos (li&ntilde;a horizontal, intert&iacute;tulo, cursiva, grosa) se modificaren, os estilos seguintes xa non se poder&aacute;n aplicar.}

<q1>
_ {{1.}} Balizas &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]]
_ {{2.}} Balizas &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; e as listas (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Ollo : modificando este segundo par&aacute;metro, p&eacute;rdense os estilos est&aacute;ndares de SPIP asociados a estas balizas.</blockquote>', # MODIF
	'class_spip:nom' => 'SPIP e os seus atallos',
	'code_css' => 'CSS',
	'code_fonctions' => 'Funci&oacute;ns',
	'code_jq' => 'jQuery',
	'code_js' => 'Javascript',
	'code_options' => 'Opci&oacute;ns',
	'code_spip_options' => 'Opci&oacute;ns de SPIP',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie priv&eacute;e', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options pr&eacute;c&eacute;dentes)', # NEW
	'contrib' => 'M&aacute;is informaci&oacute;n: @url@',
	'corbeille:description' => 'SPIP suprime automaticamente os obxectos rexeitados logo de 24 horas, en xeral a iso das 4 horas da ma&ntilde;&aacute;, grazas a unha tarefa &laquo;CRON&raquo; (lanzemento peri&oacute;dico e/ou autom&aacute;tico de procesos preprogramados). Pode impedir desde aqu&iacute; ese proceso co fin de xestionar mellor a s&uacute;a papeleira.[[%arret_optimisation%]]',
	'corbeille:nom' => 'A papeleira',
	'corbeille_objets' => '@nb@ obxeto(s) na papeleira.',
	'corbeille_objets_lies' => '@nb_lies@ ligaz&oacute;n(s) detectada(s).',
	'corbeille_objets_vide' => 'Non hai ning&uacute;n obxecto na papeleira', # MODIF
	'corbeille_objets_vider' => 'Suprimir os obxectos seleccionados',
	'corbeille_vider' => 'Baleirar a papeleira&nbsp;:',
	'couleurs:aide' => 'Colorear : <b>[coul]texte[/coul]</b>@fond@ con <b>coul</b> = @liste@',
	'couleurs:description' => 'Permite aplicar doadamente cores a todos os textos do web (artigos, breves, t&iacute;tulos, foro, …) usando balizas en atallos.

Dous exemplos id&eacute;nticos para trocar a cor do texto :@_CS_EXEMPLE_COULEURS2@

Idem para trocar o fondo, se a opci&oacute;n seguinte o permite :@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@ O formato destas balizas personalizadas debe listar as cores existentes ou definir parellas &laquo;balise=couleur&raquo;, sempre separadas por v&iacute;rgulas. Exemplos : &laquo;gris, rouge&raquo;, &laquo;faible=jaune, fort=rouge&raquo;, &laquo;bas=#99CC11, haut=brown&raquo; ou mesmo &laquo;gris=#DDDDCC, rouge=#EE3300&raquo;. Para o primeiro e o derradeiro exemplo, as balizas autorizadas son : <code>[gris]</code> et <code>[rouge]</code> (<code>[fond gris]</code> e <code>[fond rouge]</code> se os fondos son permitidos).', # MODIF
	'couleurs:nom' => 'Todo en cores',
	'couleurs_fonds' => ', <b>[fond&nbsp;coul]texte[/coul]</b>, <b>[bg&nbsp;coul]texte[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Obter moita informaci&oacute;n a prop&oacute;sito do funcionamento da Navalla Su&iacute;za nos ficheiros {spip.log} que se poden consultar no cartafol : {@_CS_DIR_TMP@}[[%log_couteau_suisse%]]

@puce@ {{Opci&oacute;ns SPIP.}} SPIP ordena os plugins nunha orde espec&iacute;fica. Co fin de estar seguro de que A Navalla Su&iacute;za est&aacute; na cabeceira e xera certas opci&oacute;ns de SPIP, escolla a opci&oacute;n seguinte. Se os dereitos do seu servidor o permiten, o ficheiro {@_CS_FILE_OPTIONS@} ser&aacute; automaticamente modificado para inclu&iacute;r o ficheiro {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php}.
[[%spip_options_on%]]

@puce@ {{Consultas externas.}} A Navalla Su&iacute;za verifica regularmente a existencia dunha versi&oacute;n m&aacute;is recente do seu c&oacute;digo e informa na s&uacute;a p&aacute;xina de configuraci&oacute;n dunha actualizaci&oacute;n eventualmente dispo&ntilde;ible. Se as consultas externas do seu servidor dan problemas, escolla a caixa seguinte.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'Comportamentos da Navalla Su&iacute;za',
	'cs_distant_off' => 'Comprobaci&oacute;n de versi&oacute;ns distantes',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => 'Os logs detallados da Navalla Su&iacute;za',
	'cs_reset' => 'Est&aacute; seguro de querer reiniciar totalmente a Navalla Su&iacute;za?',
	'cs_reset2' => 'Desactivaranse todas as utilidades activasactualmente e reinicializaranse os seus par&aacute;metros.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher &laquo;<html>@_CS_FILE_OPTIONS@</html>&raquo; a &eacute;chou&eacute; !', # NEW
	'cs_spip_options_on' => 'As opci&oacute;ns SPIP en &laquo;@_CS_FILE_OPTIONS@&raquo;', # MODIF

	// D
	'decoration:aide' => 'Decoraci&oacute;n&nbsp;: <b>&lt;balise&gt;test&lt;/balise&gt;</b>, con <b>balise</b> = @liste@',
	'decoration:description' => 'Novos estilos parametrables nos seus textos e acces&iacute;beis merc&eacute; &aacute;s balizas con comas angulares. Exemplo : 
&lt;mabalise&gt;texte&lt;/mabalise&gt; ou : &lt;mabalise/&gt;.<br /> Defina seguidamente os estilos CSS dos que te&ntilde;a necesidade, unha baliza por li&ntilde;a, consonte as expresi&oacute;ns seguintes :
- {type.mabalise = meu estilo CSS}
- {type.mabalise.class = mi&ntilde;a clase CSS}
- {type.mabalise.lang = mi&ntilde;a lingua (ex : fr)}
- {unalias = minhabaliza}

O par&aacute;metro {type} seguinte pode ter tres valores:
- {span} : baliza para o interior dun par&aacute;grafo (tipo Inline)
- {div} : baliza asociada a un novo par&aacute;grafo (tipo Block)
- {auto} : baliza determinada automaticamente polo plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Decoraci&oacute;n',
	'decoupe:aide' => 'Bloque de pestanas : <b>&lt;onglets>&lt;/onglets></b><br/>Separador de p&aacute;xinas ou pestanas&nbsp;: @sep@', # MODIF
	'decoupe:aide2' => 'Alias&nbsp;:&nbsp;@sep@',
	'decoupe:description' => '@puce@ Parte a presentaci&oacute;n p&uacute;blica dun artigo en varias p&aacute;xinas mediante unha paxinaci&oacute;n autom&aacute;tica. Sit&uacute;e simplemente no seu artigo catro signos de m&aacute;is consecutivos (<code>++++</code>) no lugar que debe recibir o corte.

En principio, A Navalla Su&iacute;za insire a paxinaci&oacute;n automaticamente na cabeceira e no rodap&eacute; do artigo mais vostede ten a posibilidade de situar esta paxinaci&oacute;n en calquera outro sitio do seu esqueleto merc&eacute; a unha baliza #CS_DECOUPE que pode activar aqu&iacute;:
[[%balise_decoupe%]]

@puce@ De utilizar este separador no interior das balizas &lt;pestanas&gt; e &lt;/pestanas&gt; obter&aacute; un xogo de pestanas.

_ Nos esqueletos : ten &aacute; s&uacute;a disposici&oacute;n as novas balizas #ONGLETS_DEBUT, #ONGLETS_TITRE e #ONGLETS_FIN.

_ Esta utilidade pode ser emparellada con &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # MODIF
	'decoupe:nom' => 'Partici&oacute;n en p&aacute;xinas e pestanas',
	'desactiver_flash:description' => 'Suprime os obxectos flash das p&aacute;xinas do seu web e substit&uacute;eas polo contido alternativo asociado.',
	'desactiver_flash:nom' => 'Desactiva os obxectos flash',
	'detail_balise_etoilee' => '{{Aviso}} : Comprobe a utilizaci&oacute;n feita polos seus esqueletos das balizas estreladas. O tratamento desta ferramenta non se aplicar&aacute;n sobre : @bal@.',
	'detail_disabled' => 'Param&egrave;tres non modifiables :', # NEW
	'detail_fichiers' => 'Ficheiros :',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'C&oacute;digo inline :',
	'detail_jquery2' => 'Esta ferramenta necesita a biblioteca {jQuery}.',
	'detail_jquery3' => '{{Aviso}} : esta utilidade necesita o plugin [jQuery para SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] para funcionar correctamente con esta versi&oacute;n de  SPIP.',
	'detail_pipelines' => 'Tubar&iacute;as (pipelines) :',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_spip_options2' => 'Il est recommand&eacute; de placer les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;[.->cs_comportement]&raquo;.', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_traitements' => 'Tratamentos :',
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
	'dossier_squelettes:description' => 'Modifica o cartafol do esqueleto usado. Por exemplo : "squelettes/monsquelette". Pode rexistrar varios cartafoles separ&aacute;ndoos polos dous puntos <html>&laquo;&nbsp;:&nbsp;&raquo;</html>. Deixando baleira caixa seguinte (ou escribindo "dist"), vai ser o esqueleto orixinal "dist" fornecido por SPIP o que ser&aacute; usado.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Cartafol do esqueleto',

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
	'en_travaux:description' => 'Permite mostrar unha mensaxe personalizable durante unha fase de mantemento sobre todo o web p&uacute;blico, e mesmo sobre a parte privada.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Web en obras',
	'erreur:bt' => '<span style=\\"color:red;\\">Aviso:</span> a barra tipogr&aacute;fica (version @version@) parece antiga.<br />A Navalla Su&iacute;za &eacute;  compatible cunha versi&oacute;n superior ou igual a @mini@.',
	'erreur:description' => 'Falta o id na definici&oacute;n da ferramenta!',
	'erreur:distant' => 'O servidor remoto',
	'erreur:jquery' => '{{Nota}} : a librar&iacute;a {jQuery} parece inactiva nesta p&aacute;xina. Consulte [aqu&iacute;->http://www.spip-contrib.net/?article2166] o par&aacute;grafo verbo das dependencias do plugin ou recargar esta p&aacute;xina.',
	'erreur:js' => 'Un erro de JavaScript parece terse producido nesta p&aacute;xina e impide o seu funcionamento correcto. Active JavaScript no seu navegador ou desactive alg&uacute;ns m&oacute;dulos do seu web.',
	'erreur:nojs' => 'O JavaScript est&aacute; desactivado nesta p&aacute;xina.',
	'erreur:nom' => 'Erro !',
	'erreur:probleme' => 'Problema en : @pb@',
	'erreur:traitements' => 'A Navalla Su&iacute;za - Erro de compilation dos tratamentos : mestura \'typo\' e \'propre\' prohibida !',
	'erreur:version' => 'Esta ferramenta non est&aacute; dispo&ntilde;&iacute;bel nesta versi&oacute;n de SPIP.',
	'erreur_groupe' => 'Attention : le groupe &laquo;@groupe@&raquo; n\'est pas d&#233;fini !', # NEW
	'erreur_mot' => 'Attention : le mot-cl&#233; &laquo;@mot@&raquo; n\'est pas d&#233;fini !', # NEW
	'etendu' => 'Estendido',

	// F
	'f_jQuery:description' => 'Impide a instalaci&oacute;n de {jQuery} na parte p&uacute;blica co fin de economizar un pouco de &laquo;tempo m&aacute;quina&raquo;. Esta librar&iacute;a ([->http://jquery.com/]) achega numerosas comodidades na programaci&oacute;n de Javascript e pode ser usada por certos m&oacute;dulos. SPIP usa dela na &aacute;rea privada.

Aviso : alg&uacute;nhas ferramentas de A Navalla Su&iacute;za necesitan as funci&oacute;ns de {jQuery}. ', # MODIF
	'f_jQuery:nom' => 'Desactiva jQuery',
	'filets_sep:aide' => 'Filetes de separaci&oacute;n&nbsp;: <b>__i__</b> ou <b>i</b> &eacute; un n&uacute;mero.<br />Outros filetes dipo&ntilde;&iacute;beis : @liste@', # MODIF
	'filets_sep:description' => 'Insire filetes de separaci&oacute;n, personalizables mediante as follas de estilo, en todos os textos de SPIP.
_ A sintaxe &eacute; : "__code__", ou "code" representa ben o n&uacute;mero de identificaci&oacute;n (de 0 &agrave; 7) do filete inserible en relaci&oacute;n directa cos estilos correspondentes, ben o nome dunha imaxe situada no cartafol plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Filetes de separaci&oacute;n',
	'filtrer_javascript:description' => 'Para xerar a inserci&oacute;n de Javascript nos artigos, son tres os modos :
- <i>nunca</i> : o Javascript &eacute; rexeitado en todas partes
- <i>predeterminado</i> : o Javascript m&aacute;rcase en vermello na zona privada
- <i>sempre</i> : o Javascript &eacute; aceptado en todas as partes.

Aviso : nos foros, pedimentos, fluxos afiliados, etc., a xesti&oacute;n do Javascript est&aacute; <b>sempre</b> securizada.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Xesti&oacute;n do Javascript',
	'flock:description' => 'Desactiva o bloqueo de ficheiros neutralizando a funci&oacute;n PHP {flock()}. Alg&uacute;s aloxadores dan de feito problemas graves sexa por un sistema de ficheiros inadaptados ou sexa por unha falta de sincronizaci&oacute;n. Non active esta utilidade  se este funciona normalmente.',
	'flock:nom' => 'Non bloquear os ficheiros',
	'fonds' => 'Fondos :',
	'forcer_langue:description' => 'Forza o contexto de lingua para os xogos de esqueletos multiling&uuml;es que dispo&ntilde;en dun formulario ou dun men&uacute; de linguas que saiban xerar a cookie de linguas.

Tecnicamente, esta utilidade ten como efecto:
- desactivar a busca do esqueleto en funci&oacute;n da lingua do obxecto,
- desactivar o criterio <code> {lang_select}</code> autom&aacute;tico sobre os obxectos cl&aacute;sicos (artigos, breves, secci&oacute;ns, etc.)
Os bloques multi m&oacute;stranse ent&oacute;n sempre na lingua demandada polo visitante.', # MODIF
	'forcer_langue:nom' => 'Forzar a lingua',
	'format_spip' => 'Artigos en formato SPIP',
	'forum_lgrmaxi:description' => 'De modo predeterminado as mensaxes de foros non se limitan en tama&ntilde;o. De activar esta ferramenta, unha mensaxe de erro mostrarase cando algu&eacute;n queira introducir unha mensaxe de tama&ntilde;o superior ao especificado, e a mensaxe ser&aacute; rexeitada. Un valor baleiro ou igual a  0 significa no entanto que non se lle aplica ning&uacute;n l&iacute;mite.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Tama&ntilde;o dos foros',

	// G
	'glossaire:aide' => 'Un texto sen glosario : <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Xesti&oacute;n dun glosario interno ligado a un ou varios grupos de palabras clave. Rexistre aqu&iacute; o nome dos grupos, separados por dous puntos &laquo;&nbsp;:&nbsp;&raquo;. Deixando a caixa baleira, o que se crea (ou ao escribir "Glosario") &eacute; o grupo "Glosario" para ser usado.[[%glossaire_groupes%]]

@puce@ Para cada palabra, pode escoller o n&uacute;mero m&aacute;ximo de ligaz&oacute;ns creadas nos seus textos. Calquera valor nulo ou negativo implica que todas as palabras reco&ntilde;ecidas ser&aacute;n tratadas. [[%%glossaire_limite por palavra-clave]]

@puce@ D&uacute;as soluci&oacute;ns se ofrecen para xerar a pequena xanela autom&aacute;tica que aparece cando se sobrevoa &aacute; ocorrencia. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Glosario interno',
	'glossaire_css' => 'Soluci&oacute;n CSS',
	'glossaire_erreur' => 'Le mot &laquo;@mot1@&raquo; rend ind&#233;tectable le mot &laquo;@mot2@&raquo;', # NEW
	'glossaire_inverser' => 'Correction propos&#233;e : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Soluci&oacute;n Javascript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) &#233;tudi&#233;(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Substituci&oacute;n autom&aacute;tica das comas dereitas (") polas tipogr&aacute;ficas da lingua de composici&oacute;n. A substituci&oacute;n, transparente para o usuario, non modifica o texto orixinal sen&oacute;n que soamente cambia a presentaci&oacute;n final.',
	'guillemets:nom' => 'V&iacute;rgulas tipogr&aacute;ficas',

	// H
	'help' => '{{Esta p&aacute;xina s&oacute; &eacute; accesible para o responsable do web.}}<p>D&aacute; acceso &aacute;s diferentes funci&oacute;ns suplementarias achegadas polo m&oacute;dulo &laquo;{{Le&nbsp;Couteau&nbsp;Suisse}}&raquo;.',
	'help2' => 'Versi&oacute;n local: @version@',
	'help3' => '<p>Ligaz&oacute;ns de documentaci&oacute;n:<br/>• [A&nbsp;Navalla&nbsp;Suiza->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Reinicios:
_ • [Ferramentas cacheadas|Volver &aacute; apariencia inicial desta p&aacute;xina->@hide@]
_ • [De todo o m&oacute;dulo|Volver ao estado inicial do m&oacute;dulo->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Utilidade en desenvolvemento. Ofrece un Javascript horloge. Baliza:<code>#HORLOGE{format,utc,id}</code>. Modelo : <code><horloge></code>', # MODIF
	'horloge:nom' => 'Horloge',

	// I
	'icone_visiter:description' => 'Substit&uacute;a a imaxe do bot&oacute;n est&aacute;ndar &laquo;&nbsp;Visitar&nbsp;&raquo; (arriba &aacute; dereita desta p&aacute;xina) polo logo do web, se existe.

Para definir o logo, vaia &aacute; p&aacute;xina &laquo;&nbsp;Configuraci&oacute;n do web&nbsp;&raquo; premendo sobre o bot&oacute;n &laquo;&nbsp;Configuraci&oacute;n&nbsp;&raquo;.', # MODIF
	'icone_visiter:nom' => 'Bot&oacute;n &laquo;&nbsp;Visitar&nbsp;&raquo;', # MODIF
	'insert_head:description' => 'Activa automaticamente a baliza [#INSERT_HEAD->http://www.spip.net/fr_article1902.html] en todos os esqueletos, que te&ntilde;an ou non esta baliza entre &lt;head&gt; e &lt;/head&gt;. Merc&eacute; a esta opci&oacute;n, os plugins poder&aacute;n inserir javascript (.js) ou follas de estilo (.css).',
	'insert_head:nom' => 'Baliza #INSERT_HEAD',
	'insertions:description' => 'AVISO : ferramenta en proceso de desenvolvemento !! [[%insertions%]]',
	'insertions:nom' => 'Correcci&oacute;ns autom&aacute;ticas',
	'introduction:description' => 'Esta baliza situable nos esqueletos serve xeralmente para unha &uacute;ltima hora ou nas secci&oacute;ns co fin de producir un resumo de artigos, de breves, etc.</p>
<p>{{Aviso}} : Antes de activar esta funcionalidade, comprobe ben que ningunha funci&oacute;n {balise_INTRODUCTION()} exista xa no seu esqueleto ou nos m&oacute;dulos, a sobrecarga producir&iacute;a un erro de compilaci&oacute;n.</p>
@puce@ Pode precisar (porcentualmente en relaci&oacute;n co valor usado de modo predeterminado) a lonxitude do texto reeenviado pola baliza #INTRODUCTION. Un valor nulo ou igual a 100 non modifica o aspecto da introduci&oacute;n e usa daquela os valores predeterminados seguintes : 500 caracteres para os artigos, 300 para as breves e 600 para os foros ou as secci&oacute;ns.
[[%lgr_introduction%&nbsp;%]]
@puce@ De modo predeterminado, os puntos suspensivos engadidos ao resultado da baliza #INTRODUCTION se o texto &eacute; demasiado longo son : <html>&laquo;&amp;nbsp;(…)&raquo;</html>. Pode precisar aqu&iacute; a s&uacute;a propia cadea de caracteres que indiquen ao lector que o texto truncado ten unha continuidade.
[[%suite_introduction%]]
@puce@ Se a baliza #INTRODUCTION se emprega para resumir un artigo, ent&oacute;n A Navalla Su&iacute;za pode crear unha ligaz&oacute;n sobre eses puntos suspensivos definidos co fin de levar o lector ao texto orixinal. Por exemplo : &laquo;Ler a continuidade deste artigo…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'Baliza #INTRODUCTION',

	// J
	'jcorner:description' => '&laquo;&nbsp;Jolis Coins&nbsp;&raquo; &eacute; unha ferramenta que permite modificar doadamente o aspecto das esquinas dos {{cadros coloreados}} na parte p&uacute;blica do seu web. Todo &eacute; posible ou case!
_ Vexa o resultado nest&aacute; p&aacute;xina: [->http://www.malsup.com/jquery/corner/].

Liste aqu&iacute; abaixo os obxectos do seu esqueleto a redondear usando a sintaxe CSS (.class, #id, etc. ). Utilice o signo &laquo;&nbsp;=&nbsp;&raquo; para especificar o comando jQuery a usar e unha dobre barra (&laquo;&nbsp;//&nbsp;&raquo;) para o comentarios. En ausencia do signo igual, as esquinas redondeadas ser&aacute;n aplicadas (equivalent e : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Atenci&oacute;n, esta ferramenta, precisa para funcionar do m&oacute;dulo {jQuery} : {Round Corners}. A Navalla Su&iacute;za p&oacute;dea instalar directamente se marca a caixa seguinte. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Jolis Coins',
	'jcorner_plugin' => '&laquo;M&oacute;dulo&nbsp;Round Corners&nbsp;&raquo;',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Predeterminado',
	'js_jamais' => 'Nunca',
	'js_toujours' => 'Sempre',
	'jslide_aucun' => 'Sen animaci&oacute;n',
	'jslide_fast' => 'Pasaxe r&aacute;pida',
	'jslide_lent' => 'Pasaxe lenta',
	'jslide_millisec' => 'Pasaxe durante:',
	'jslide_normal' => 'Pasaxe normal',

	// L
	'label:admin_travaux' => 'Pechar o web para :',
	'label:arret_optimisation' => 'Impedir que SPIP baleire a papeleira automaticamente&nbsp;:',
	'label:auteur_forum_nom' => 'O visitante debe especificar:',
	'label:auto_sommaire' => 'Creaci&oacute;n sistem&aacute;tica de sumario :',
	'label:balise_decoupe' => 'Activar a baliza #CS_DECOUPE :',
	'label:balise_sommaire' => 'Activar a baliza #CS_SOMMAIRE :',
	'label:bloc_h4' => 'Baliza para os t&iacute;tulos&nbsp;:',
	'label:bloc_unique' => 'Un s&oacute; bloque aberto na p&aacute;xina:',
	'label:blocs_cookie' => 'Utulizaci&oacute;n das cookies',
	'label:blocs_slide' => 'Tipo de animaci&oacute;n:',
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal r&eacute;serv&eacute; aux copies locales :', # NEW
	'label:couleurs_fonds' => 'Permitir os fondos :',
	'label:cs_rss' => 'Activar :',
	'label:debut_urls_propres' => 'Comezo dos URL :',
	'label:decoration_styles' => 'As s&uacute;as balizas de estilo pesonalizado :',
	'label:derniere_modif_invalide' => 'Recalcular s&oacute; despois dunha modificaci&oacute;n :',
	'label:devdebug_espace' => 'Filtrage de l\'espace concern&#233; :', # NEW
	'label:devdebug_mode' => 'Activer le d&eacute;bogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoy&eacute; :', # NEW
	'label:distant_off' => 'Desactivar :',
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Cartafol para utilizar :',
	'label:duree_cache' => 'Duraci&oacute;n da cach&eacute; local :',
	'label:duree_cache_mutu' => 'Duraci&oacute;n da cach&eacute; en mutualizaci&oacute;n :',
	'label:ecran_actif' => '@_CS_CHOIX@', # NEW
	'label:enveloppe_mails' => 'Pequeno cadro diante dos enderezos de correo:',
	'label:expo_bofbof' => 'Mostrar en super&iacute;ndice cando : <html>St(e)(s), Bx, Bd(s) e Fb(s)</html>',
	'label:forum_lgrmaxi' => 'Valor (en caracteres) :',
	'label:glossaire_groupes' => 'Grupo(s) usado(s) :',
	'label:glossaire_js' => 'T&eacute;cnica usada :',
	'label:glossaire_limite' => 'N&uacute;mero m&aacute;ximo de ligaz&oacute;ns creadas :',
	'label:i_align' => 'Alignement du texte&nbsp;:', # NEW
	'label:i_couleur' => 'Couleur de la police&nbsp;:', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (&eacute;q. &agrave; {line-height})&nbsp;:', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte&nbsp;:', # NEW
	'label:i_padding' => 'Espacement autour du texte (&eacute;q. &agrave; {padding})&nbsp;:', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/})&nbsp;:', # NEW
	'label:i_taille' => 'Taille de la police&nbsp;:', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Correcci&oacute;ns autom&aacute;ticas :',
	'label:jcorner_classes' => 'Mellorar as esquinas dos selectores seguintes:',
	'label:jcorner_plugin' => 'Instalar o m&oacute;dulo {jQuery} seguinte:',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'Lonxitude do resumo :',
	'label:lgr_sommaire' => 'Lonxitude do sumario (9 a 99) :',
	'label:lien_introduction' => 'Puntos suspensivos de continuidade activos :',
	'label:liens_interrogation' => 'Protexer os URL :',
	'label:liens_orphelins' => 'Ligaz&oacute;ns activas :',
	'label:log_couteau_suisse' => 'Activar :',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:marqueurs_urls_propres' => 'Engadir os marcadores disociando os obxectos (SPIP>=2.0) :<br/>(ex. : &laquo;&nbsp;-&nbsp;&raquo; para -Mi&ntilde;a-seccion-, &laquo;&nbsp;@&nbsp;&raquo; para @Meu-web@) ', # MODIF
	'label:max_auteurs_page' => 'Autors por p&aacute;xina :',
	'label:message_travaux' => 'A s&uacute;a mensaxe de mantemento :',
	'label:moderation_admin' => 'Validar automaticamente as mensaxes desde: ',
	'label:mot_masquer' => 'Mot-cl&#233; masquant les contenus :', # NEW
	'label:ouvre_note' => 'Abrir e cerrar as notas a rodap&eacute;',
	'label:ouvre_ref' => 'Abrir e cerrar as chamadas de notas a rodap&eacute;',
	'label:paragrapher' => 'Paragrafar sempre :',
	'label:prive_travaux' => 'Accesibilidade do espazo privado para:',
	'label:prof_sommaire' => 'Profondeur retenue (1 &agrave; 4) :', # NEW
	'label:puce' => 'Vi&ntilde;eta p&uacute;blica &laquo;<html>-</html>&raquo; :',
	'label:quota_cache' => 'Valor de quota :',
	'label:racc_g1' => 'Entrada e sa&iacute;da da presentaci&oacute;n en &laquo;<html>{{negra}}</html>&raquo; :',
	'label:racc_h1' => 'Entrada e sa&iacute;da dun &laquo;<html>{{{intert&iacute;tulo}}}</html>&raquo; :',
	'label:racc_hr' => 'Li&ntilde;a horizontal &laquo;<html>----</html>&raquo; :',
	'label:racc_i1' => 'Entrada e sa&iacute;da dunha &laquo;<html>{it&aacute;lica}</html>&raquo; :',
	'label:radio_desactive_cache3' => 'Uso da cach&eacute;:',
	'label:radio_desactive_cache4' => 'Uso da cach&eacute;:',
	'label:radio_target_blank3' => 'Nova xanela para as ligaz&oacute;ns externas :',
	'label:radio_type_urls3' => 'Formato dos URL :',
	'label:scrollTo' => 'Instalar os m&oacute;dulos {jQuery} seguintes :',
	'label:separateur_urls_page' => 'Car&aacute;cter de separaci&oacute;n \'type-id\'<br/>(ex. : ?article-123) :', # MODIF
	'label:set_couleurs' => 'Conxunto para usar :',
	'label:spam_ips' => 'Adresses IP &agrave; bloquer :', # NEW
	'label:spam_mots' => 'Secuencias prohibidas :',
	'label:spip_options_on' => 'Inclu&iacute;r :',
	'label:spip_script' => 'Script de chamada :',
	'label:style_h' => 'O seu estilo :',
	'label:style_p' => 'O seu estilo :',
	'label:suite_introduction' => 'Puntos de continuidade :',
	'label:terminaison_urls_page' => 'Terminaci&oacute;n dos URL (ex : &laquo;&nbsp;.html&nbsp;&raquo;) :',
	'label:titre_travaux' => 'T&iacute;tulo da mensaxe :',
	'label:titres_etendus' => 'Activr a utilizaci&oacute;n estendida das balizas #TITRE_XXX&nbsp;:',
	'label:url_arbo_minuscules' => 'Conservar a altura tipogr&aacute;fica dos t&iacute;tulos nos URL :',
	'label:url_arbo_sep_id' => 'Car&aacute;cter de separaci&oacute;n \'titulo-id\' para o caso de repetici&oacute;n (doublon) :<br/>(non empregue \'/\')', # MODIF
	'label:url_glossaire_externe2' => 'Ligaz&oacute;n sobre o glosario externo :',
	'label:url_max_propres' => 'Longueur maximale des URLs (caract&egrave;res) :', # NEW
	'label:urls_arbo_sans_type' => 'Mostrar o tipo de obxecto SPIP nos URL :',
	'label:urls_avec_id' => 'Un id sistem&aacute;ticos, mais...',
	'label:webmestres' => 'Lista de webm&aacute;sters do web:',
	'liens_en_clair:description' => 'Pon &aacute; s&uacute;a disposici&oacute;n o filtro : \'liens_en_clair\'. O seu texto cont&eacute;n probablemente ligaz&oacute;ns de hipertexto que non son visibles tras unha impresi&oacute;n. Este filtro engade entre corchetes o destino de cada ligaz&oacute;n activa (ligaz&oacute;ns externas ou correos). Atenci&oacute;n : en modo de impresi&oacute;n (par&aacute;metro \'cs=print\' ou \'page=print\' no url da p&aacute;xina), esta funcionalidade apl&iacute;case automaticamente.',
	'liens_en_clair:nom' => 'Ligaz&oacute;ns en claro',
	'liens_orphelins:description' => 'Esta ferramenta ten d&uacute;as funci&oacute;ns :

@puce@ {{Ligaz&oacute;ns correctas}}.

SPIP ten por h&aacute;bito inserir un espazo diante dos puntos de interrogaci&oacute;n ou de exclamaci&oacute;n, tipograf&iacute;a francesa obriga. Velaqu&iacute; unha ferramenta que protexe o punto de interrogaci&oacute;n nos url dos seus textos.[[%liens_interrogation%]]

@puce@ {{Ligaz&oacute;ns orfas}}.

Substit&uacute;e sistematicamente todos os url deixados en texto polos usuarios (nomeadamente nos foros) e que non son clicables, polas ligaz&oacute;ns de hipertexto en formato  SPIP. Por exemplo : {<html>www.spip.net</html>} substit&uacute;ese por [->www.spip.net].

Podedes escoller o tipo de substituci&oacute;n :
_ • {Basique} : se substit&uacute;en as ligaz&oacute;ns do tipo {<html>http://spip.net</html>} (calquera protocolo) ou {<html>www.spip.net</html>}.
_ • {Estendido} : substit&uacute;ense ademais as ligaz&oacute;ns do tipo {<html>moi@spip.net</html>}, {<html>mailto:meucorreo</html>} ou {<html>news:mi&ntilde;asnovas</html>}.
_ • {Predefinido} : substituci&oacute;n autom&aacute;tica de orixe (a partir da version 2.0 de SPIP).
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:nom' => 'URL fermosas',

	// M
	'mailcrypt:description' => 'Oculta todas as ligaz&oacute;ns de correo presentes nos seus textos e substit&uacute;eos por unha ligaz&oacute;n Javascript que permite activar o programa de correo do lector. Esta ferramenta antispam tenta impedir os robots de colleita de enderezos electr&oacute;nicos deixados en claro nos foros ou nas balizas dos seus esqueletos.',
	'mailcrypt:nom' => 'MailCrypt',
	'maj_auto:description' => 'Esta ferramenta perm&iacute;telle xestionarfacilmente a actualizaci&oacute;n dos seus diferentes m&oacute;dulos, recuperando especialmente o n&uacute;mero de revisi&oacute;n contido no ficheiro <code>svn.revision</code> e comparando aquel encontrado en <code>zone.spip.org</code>.

A lista seguinte ofrece a posibilidade de lanzar o proceso de actualizaci&oacute;n autom&aacute;tica de SPIP sobre cada un dos m&oacute;dulos previamente instalados no cartafol <code>plugins/auto/</code>. Os outros c&oacute;dulos enc&oacute;ntranse no cartafol <code>plugins/</code> e l&iacute;stanse simplemente a t&iacute;tulo informativo. Se a revisi&oacute;n remota non se pode encontrar, intente proceder manualmente coa actualizaci&oacute;n do m&oacute;dulo.

Nota : os paquetes <code>.zip</code> non son reconstru&iacute;dos instantaneamente, pode ser que te&ntilde;a que esperar un certo atraso antes de poder efectuar a total actualizaci&oacute;n dun complemento que fose recentemente modificado.', # MODIF
	'maj_auto:nom' => 'Actualizaci&oacute;ns autom&aacute;ticas',
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particuli&egrave;re de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-cl&#233; d&eacute;fini ci-dessous. Si une rubrique est masqu&eacute;e, toute sa branche l\'est aussi.[[%mot_masquer%]]



Pour forcer l\'affichage des contenus masqu&eacute;s, il suffit d\'ajouter le crit&egrave;re <code>{tout_voir}</code> aux boucles de votre squelette.', # NEW
	'masquer:nom' => 'Masquer du contenu', # NEW
	'meme_rubrique:description' => 'D&eacute;finissez ici le nombre d\'objets list&eacute;s dans le cadre nomm&eacute; &laquo;<:info_meme_rubrique:>&raquo; et pr&eacute;sent sur certaines pages de l\'espace priv&eacute;.[[%meme_rubrique%]]', # NEW
	'message_perso' => 'Un profundo reco&ntilde;ecemento para os tradutores que pasaran por aqu&iacute;. Pat ;-)',
	'moderation_admins' => 'administradores autenticados',
	'moderation_message' => 'Este foro est&aacute; moderado a priori&nbsp;: o seu comentario non aparecer&aacute; ata que sexa validada por un administrador do web, salvante o caso de que vostede xa estea identificado e autorizado para publicar comentarios directamente.',
	'moderation_moderee:description' => 'Permite moderar a moderaci&oacute;n dos foros p&uacute;blicos <b>configurados a priori</b> para os usuarios inscritos.<br/> Exemplo: Eu son o webm&aacute;ster do meu web, e respondo a unha mensaxe dunha persoa, por qu&eacute; debo validar a mi&ntilde;a propia mensaxe ?Moderaci&oacute;n moderada faino por min. [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Moderaci&oacute;n moderada',
	'moderation_redacs' => 'redactores autenticados',
	'moderation_visits' => 'visitantes autenticados',
	'modifier_vars' => 'Modificar os par&aacute;metros @nb@',
	'modifier_vars_0' => 'Modificar estes par&aacute;metros',

	// N
	'no_IP:description' => 'Desactiva o mecanismo de rexistro autom&aacute;tico de enderezos IP dos visitantes do seu web por raz&oacute;ns de confidencialidade : SPIP non conservar&aacute; daquela ning&uacute;n n&uacute;mero IP, nin temporalmente logo das visitas (para xerar as estat&iacute;sticas ou alimentar o spip.log), nin nos foros (responsabilidade).',
	'no_IP:nom' => 'Non conservar IP',
	'nouveaux' => 'Novos',

	// O
	'orientation:description' => '3 criterios novos para os seus esqueletos : <code>{portrait}</code>, <code>{carre}</code> e <code>{paysage}</code>. Ideal para a ordenaci&oacute;n de fotos en funci&oacute;n da s&uacute;a forma.',
	'orientation:nom' => 'Orientaci&oacute;n das imaxes',
	'outil_actif' => 'Utilidade activa',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activar',
	'outil_activer_le' => 'Activar a ferramenta',
	'outil_cacher' => 'Non volver a mostrar',
	'outil_desactiver' => 'Desactivar',
	'outil_desactiver_le' => 'Desactivar a ferramenta',
	'outil_inactif' => 'Utilidade inactiva',
	'outil_intro' => 'Esta p&aacute;xina lista as caracter&iacute;sticas do m&oacute;dulo postas &aacute; s&uacute;a disposici&oacute;n. <br /> <br /> Ao premer sobre o nome das ferramentas que aparecen a seguir, seleccione, as que pode cambiar o estado usando o bot&oacute;n central: as ferramentas activadas ser&aacute;n desactivadas e <i> viceversa </ i>. Con cada clic, a descrici&oacute;n aparece a seguir das listas. As categor&iacute;as son pregables e as ferramentas p&oacute;dense ocultar. O dobre clic permite trocar rapidamente unha ferramenta. <br /> <br /> Nun primeiro uso, recom&eacute;ndase activar as ferramentas unha por unha, no caso de apareceren certas incompatibilidades co seu esqueleto, con SPIP ou con outros m&oacute;dulos. <br /> <br /> Nota: a simple carga desta p&aacute;xina compila o conxunto das ferramentas da Navalla Su&iacute;za .',
	'outil_intro_old' => 'Esta interface &eacute; antiga.<br /><br />Se vostede encontra problema coa utilizaci&oacute;n da <a href=\'./?exec=admin_couteau_suisse\'>nova     interface</a>, non dubide en fac&eacute;rnolo saber no foro <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@ : @nb@ ferramenta', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ ferramentas', # MODIF
	'outil_permuter' => 'Cambiar a ferramenta : &laquo; @text@ &raquo; ?',
	'outils_actifs' => 'Ferramentas activas :',
	'outils_caches' => 'Ferramentas ocultas :',
	'outils_cliquez' => 'Prema sobre o nome das ferramentas seguintes para mostrar aqu&iacute; a s&uacute;a descrici&oacute;n.',
	'outils_concernes' => 'Sont concern&eacute;s : ', # NEW
	'outils_desactives' => 'Sont d&eacute;sactiv&eacute;s : ', # NEW
	'outils_inactifs' => 'Ferramentas inactivas :',
	'outils_liste' => 'Lista de ferramentas da Navalla Su&iacute;za',
	'outils_non_parametrables' => 'Non parametrables:',
	'outils_permuter_gras1' => 'Trocar as ferramentas en negra',
	'outils_permuter_gras2' => 'Trocar as @nb@ ferramentas en negra ?',
	'outils_resetselection' => 'Reinicializar a selecci&oacute;n',
	'outils_selectionactifs' => 'Seleccionar todas as ferramentas activas',
	'outils_selectiontous' => 'TODOS',

	// P
	'pack_actuel' => 'Paquete @date@',
	'pack_actuel_avert' => 'Aviso, as sobreescrituras sobre os define() ou as globais non est&aacute;n especificadas aqu&iacute;', # MODIF
	'pack_actuel_titre' => 'PAQUETE ACTUAL DE CONFIGURACI&Oacute;N DA NAVALLA SU&Iacute;ZA',
	'pack_alt' => 'Ver os par&aacute;metros de configuraci&oacute;n en curso',
	'pack_delete' => 'Supresi&oacute;n dun paquete de configuraci&oacute;n',
	'pack_descrip' => 'O seu &laquo;&nbsp;Paquete de configuraci&oacute;n actual"&nbsp;&raquo; recolle o conxunto dos par&aacute;metros de configuraci&oacute;n presentes relativos &aacute; Navalla Su&iacute;za: a activaci&oacute;n de ferramentas e o valor das s&uacute;as eventuais variables.

Se os permisos de escritura o permiten, oc&oacute;digo PHP seguinte poder&aacute; po&ntilde;erse no ficheiro {{/config/mes_options.php}} e engadir&aacute; unha ligaz&oacute;n de reiniciaci&oacute;n sobre esta p&aacute;xina "do paquete &laquo;&nbsp;{@pack@}&nbsp;&raquo;. Desde logo p&oacute;delle cambiar ese nome.

De reiniciar o m&oacute;dulo premendo sobre un paquete, a Navalla Su&iacute;za reconfigurarase automaticamente en funci&oacute;n dos par&aacute;metros predeterminados no paquete.', # MODIF
	'pack_du' => '• do paquete @pack@',
	'pack_installe' => 'Actualizaci&oacute;n dun paquete de configuraci&oacute;n',
	'pack_installer' => 'Est&aacute; seguro de querer reiniciar a Navalla Su&iacute;za e instalar o paquete &laquo;&nbsp;@pack@&nbsp;&raquo; ?',
	'pack_nb_plrs' => 'Hai actualmente @nb@ &laquo;&nbsp;paquetes de configuraci&oacute;n&nbsp;&raquo; dispo&ntilde;&iacute;beis:',
	'pack_nb_un' => 'Hai actualmente un &laquo;&nbsp;paquete de configuraci&oacute;n&nbsp;&raquo; dispo&ntilde;ible:',
	'pack_nb_zero' => 'Non hai ning&uacute;n &laquo;&nbsp;paquete de configuraci&oacute;n&nbsp;&raquo; dispo&ntilde;ible actualmente.',
	'pack_outils_defaut' => 'Instalaci&oacute;ns das ferramentas predeterminadas',
	'pack_sauver' => 'Gardar a configuraci&oacute;n actual',
	'pack_sauver_descrip' => 'O bot&oacute;n seguinte perm&iacute;telle inserir directamente no seu ficheiro <b>@file@</b> os par&aacute;metros necesarios para engadir un &laquo;&nbsp;paquete de configuraci&oacute;n&nbsp;&raquo; no men&uacute; da esquerda. Isto permitiravos ulteriormente reconfigurar nun clic A Navalla Su&iacute;za no estado en que est&aacute; actualmente.',
	'pack_supprimer' => 'Est&aacute; vostede seguro de querer suprimir o paquete &laquo;&nbsp;@pack@&nbsp;&raquo; ?',
	'pack_titre' => 'Configuraci&oacute;n actual',
	'pack_variables_defaut' => 'Instalaci&oacute;n das variables predeterminadas',
	'par_defaut' => 'Predeterminado',
	'paragrapher2:description' => 'A funci&oacute;n SPIP <code>paragrapher()</code> insere balizas &lt;p&gt; e &lt;/p&gt; en todos os textos que son que est&aacute;n desprovistos de par&aacute;grafos. Co fin de xerar m&aacute;is finamente os seus estilos e os dese&ntilde;os, ten a posibilidade de uniformizar o aspecto dos textos do seu  web.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Paragrafar',
	'pipelines' => 'Tubar&iacute;as (pipelines usadas)&nbsp;:',
	'previsualisation:description' => 'Par d&eacute;faut, SPIP permet de pr&eacute;visualiser un article dans sa version publique et styl&eacute;e, mais uniquement lorsque celui-ci a &eacute;t&eacute; &laquo; propos&eacute; &agrave; l&rsquo;&eacute;valuation &raquo;. Hors cet outil permet aux auteurs de pr&eacute;visualiser &eacute;galement les articles pendant leur r&eacute;daction. Chacun peut alors pr&eacute;visualiser et modifier son texte &agrave; sa guise.



@puce@ Attention : cette fonctionnalit&eacute; ne modifie pas les droits de pr&eacute;visualisation. Pour que vos r&eacute;dacteurs aient effectivement le droit de pr&eacute;visualiser leurs articles &laquo; en cours de r&eacute;daction &raquo;, vous devez l&rsquo;autoriser (dans le menu {[Configuration&gt;Fonctions avanc&eacute;es->./?exec=config_fonctions]} de l&rsquo;espace priv&eacute;).', # NEW
	'previsualisation:nom' => 'Pr&eacute;visualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci &laquo;*&raquo;', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Substit&uacute;a as vi&ntilde;etas &laquo;-&raquo; (gui&oacute;n simple) dos artigos por listas les par des listes nominadas &laquo;-*&raquo; (traducidas en  HTML por : &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) e nas que o estilo pode ser personalizado por css.', # MODIF
	'pucesli:nom' => 'Vi&ntilde;etas fermosas',

	// Q
	'qui_webmestres' => 'Os webm&aacute;ster de SPIP',

	// R
	'raccourcis' => 'Atallos tipogr&aacute;ficos activos da Navalla Su&iacute;za&nbsp;:',
	'raccourcis_barre' => 'Os atallo tipogr&aacute;ficos da Navalla Su&iacute;za',
	'reserve_admin' => 'Acceso reservado aos administradores.',
	'rss_actualiser' => 'Actualizar',
	'rss_attente' => 'Espera RSS...',
	'rss_desactiver' => 'Desactivar as &laquo; Revisi&oacute;ns da Navalla Su&iacute;za &raquo;',
	'rss_edition' => 'Flux RSS actualizado o :',
	'rss_source' => 'Fonte RSS',
	'rss_titre' => '&laquo;&nbsp;A Navalla Su&iacute;za&nbsp;&raquo; en desenvolvemento :',
	'rss_var' => 'As revisi&oacute;n da Navalla Su&iacute;za',

	// S
	'sauf_admin' => 'Todos, ag&aacute;s os administradores',
	'sauf_admin_redac' => 'Todos, salvo os administradores e redactores',
	'sauf_identifies' => 'Todos, ag&aacute;s os autores identificados',
	'set_options:description' => 'Seleccione o tipo de interface privada predeterminada (simplificada ou avanzada) para todos os redactores xa existentes ou futuros e suprima o bot&oacute;n correspondente da barra de iconas.[[%radio_set_options4%]]',
	'set_options:nom' => 'Tipo de interface privada',
	'sf_amont' => 'Fluxo ascendente',
	'sf_tous' => 'Todos',
	'simpl_interface:description' => 'Desactive o cambio r&aacute;pido de estado dun artigo sobrevoando a s&uacute;a vi&ntilde;eta de cor. Iso &eacute; &uacute;til se vostede procura obter unha  interface privada o m&aacute;is limpa co fin de optimizar o rendemento do lado do cliente.',
	'simpl_interface:nom' => 'Alixeiramento da interfacer privada',
	'smileys:aide' => 'Riso&ntilde;os : @liste@',
	'smileys:description' => 'Inserir riso&ntilde;os en todos os textos onde aparece un atallo do tipo <acronym>:-)</acronym>. Ideal para os foros.
_ Est&aacute; dispo&ntilde;ible unha baliza para mostrar unha t&aacute;boa de riso&ntilde;os nos seus esqueletos : #SMILEYS.
_ Dese&ntilde;os : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Riso&ntilde;os',
	'soft_scroller:description' => 'Ofrece na parte p&uacute;blica do seu web un esvaramento suavizado da p&aacute;xina logo de que o visitante prema sobre unha ligaz&oacute;n que apunte sobre unha &aacute;ncora: resulta moi &uacute;til para evitar perderse nunha p&aacute;xina complexa ou un texto moi longo...

Aviso, esta utilidade precisa para funcionar p&aacute;xinas con &laquo;DOCTYPE XHTML&raquo; (non HTML !) e que haxa dous m&oacute;dulos instalados {jQuery} : {ScrollTo} e {LocalScroll}. A Navalla Su&iacute;za p&oacute;deos instalar directamente se vostede selecciona as opci&oacute;ns seguintes. [[%scrollTo%]][[-->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => '&Aacute;ncoras suaves',
	'sommaire:description' => 'Constr&uacute;e un sumario para o texto dos seus artigos e das s&uacute;as secci&oacute;ns co fin de acceder rapidamente  a t&iacute;tulos de alto tama&ntilde;o (balizas HTML &lt;h3>Un intert&iacute;tulo&lt;/h3> ou a atallos de SPIP : intert&iacute;tulos do estilo :<code>{{{Un t&iacute;tulo grande}}}</code>).

@puce@ Pode definir aqu&iacute; o n&uacute;mero m&aacute;ximo de caracteres retidos dos intert&iacute;tulos para constru&iacute;r o sumario:[[%lgr_sommaire% caract&egrave;res]]

@puce@ Pode fixar tam&eacute;n o comportamento do m&oacute;dulo concerninte &aacute; creaci&oacute;n do sumario: 
_ • Sistematicamente para cada artigo (unha baliza <code>@_CS_SANS_SOMMAIRE@</code> situada en calquera lugar ou no interior do texto do artigo crear&aacute; unha excepci&oacute;n).
_ • Unicamente para os artigos que conte&ntilde;an a baliza <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ De modo predeterminado, A Navalla Su&iacute;za insire o sumario na cabeceira do artigo automaticamente. Vostede ten a posibilidade de situar este sumario no seu esqueleto grazas a unha baliza #CS_SOMMAIRE que pode activar aqu&iacute; :
[[%balise_sommaire%]]

Este sumario pode ser aparellado con : &laquo;&nbsp;[.->decoupe]&nbsp;&raquo;.', # MODIF
	'sommaire:nom' => 'Un sumario autom&aacute;tico', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre&lt;mon_ancre&gt;}}}</html></b>', # NEW
	'sommaire_avec' => 'Un artigo con sumario&nbsp;: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un artigo sen sumario&nbsp;: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hi&eacute;rarchis&eacute;s&nbsp;: <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Tenta loitar contra os env&iacute;os de mensaxes autom&aacute;ticas e impertinentes na parte p&uacute;blica. Algunhas palabras e as balizas en claro &lt;a>&lt;/a> est&aacute;n prohibidas.Anime os seus redactores a empregar os atallos de SPIP

Liste aqu&iacute;, separ&aacute;ndoas por espazos, as secuencias prohibidas [[%spam_mots%]]
• Para unha expresi&oacute;n con espazos, sit&uacute;ea entre par&eacute;nteses. Exemplo:~{(asses)}.
_ • Para especificar unha palabra enteira, situ&eacute;a ente par&eacute;nteses. Exemplo~:~{(asses)}.
_ • Para unha expresi&oacute;n regular, comprobe ben a sintaxe e sit&uacute;ea entre barras e comas. Exemplos:~{<html>"/@test\\.(com|fr)/"</html>}.', # MODIF
	'spam:nom' => 'Loita contra o SPAM',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Esta mensaxe ser&aacute; bloqueada polo filtro antispam!',
	'spam_test_ok' => 'Esta mensaxe ser&aacute; aceptada polo filtro antispam.',
	'spam_tester_bd' => 'Testez &eacute;galement votre votre base de donn&eacute;es et listez les messages qui auraient &eacute;t&eacute; bloqu&eacute;s par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Teste aqu&iacute; a s&uacute;a lista de secuencias prohibidas:', # MODIF
	'spip_cache:description' => '@puce@ A cach&eacute; ocupa un certo espazo de disco e SPIP pode limitalo. Un valor baleiro ou igual a 0 significa que non se lle aplica ningunha cota.[[%quota_cache% Mo]]

@puce@ Tras unha modificaci&oacute;n do contido do web, SPIP invalida inmediatamente a cach&eacute; sen agardar ao c&aacute;lculo peri&oacute;dico establecido. Se o seu web ten problemas de rendemento por unha carga moi elevada, pode establecer como &laquo;&nbsp;non&nbsp;&raquo; esta opci&oacute;n.[[%derniere_modif_invalide%]]

@puce@Se a baliza #CACHE non se encontra nos seus esqueletos locais, SPIP considera de modo predeterminado que a cach&eacute; dunha p&aacute;xina ten unha duraci&oacute;n de vida de 24 horas antes de a recalcular. Co fin de xestionar mellor a carga do seu servidor, pode modificar aqu&iacute; este valor.[[%duree_cache% heures]]

@puce@ Se vostede ten varios webs en mutualizaci&oacute;n, pode especificar aqu&iacute; o valor predeterminado tomado en conta por todos os web locais (SPIP 2.0 m&iacute;nimo).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ De modo predeterminado, SPIP calcula todas as p&aacute;xinas p&uacute;blicas e col&oacute;caas na cach&eacute; co fin de acelerar a consulta. Desactivar temporariamente a cach&eacute; pode axudar ao desenvolvemento do web. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ Catro opci&oacute;ns para orientar o funcionamento da cach&eacute; de SPIP : <q1>
_ • {Uso normal} : SPIP calcula todas as p&aacute;xinas p&uacute;blicas e col&oacute;caas na cach&eacute; co fin de acelerar con iso a consulta. Tras un certo per&iacute;odo, a cach&eacute; recalc&uacute;lasae e almac&eacute;nase.
_ • {Cach&eacute; permanente} : os per&iacute;odos de invalidaci&oacute;n da cach&eacute; son ignorados.
_ • {Sen cach&eacute;} : desactivar temporariamente a cach&eacute; pode axudar ao desenvolvemento do web. Aqu&iacute;, nada &eacute; gardado no disco.
_ • {Control da cach&eacute;} : opci&oacute;n id&eacute;ntica &aacute; precedente, con unha escritura sobre o disco de todos os resultados co fin de poder controlalos eventualmente.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension &laquo; Compresseur &raquo; pr&eacute;sente dans SPIP permet de compacter les diff&eacute;rents &eacute;l&eacute;ments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela acc&eacute;l&egrave;re l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers &agrave; obtenir.', # NEW
	'spip_cache:nom' => 'SPIP e a memoria cach&eacute;…',
	'spip_ecran:description' => 'D&eacute;termine la largeur d\'&eacute;cran impos&eacute;e &agrave; tous en partie priv&eacute;e. Un &eacute;cran &eacute;troit pr&eacute;sentera deux colonnes et un &eacute;cran large en pr&eacute;sentera trois. Le r&eacute;glage par d&eacute;faut laisse l\'utilisateur choisir, son choix &eacute;tant stock&eacute; dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'&eacute;cran', # NEW
	'stat_auteurs' => 'Os estado dos autores',
	'statuts_spip' => 'Unicamente os estados SPIP seguintes :',
	'statuts_tous' => 'Todos os estados',
	'suivi_forums:description' => 'Un autor de artigo ser&aacute; sempre informado cando apareza unha mensaxe no foro p&uacute;blico asociado. Tam&eacute;n &eacute; posible adverter ademais : todoso os participantes no foro ou soamente os autores de mensaxes en fluxo ascendente.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Seguimento dos foros p&uacute;blicos',
	'supprimer_cadre' => 'Suprimir este cadro',
	'supprimer_numero:description' => 'Aplica a funci&oacute;n SPIP supprimer_numero() ao conxunto dos {{t&iacute;tulos}} e dos {{nomes}} do web p&uacute;blico, sen que o filtro supprimer_numero estea presente nos esqueletos.<br />Velaqu&iacute; a sintaxe que se vai usar no cadro dun web multiling&uuml;e : <code>1. <multi>O Meu T&iacute;tulo[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Suprime o n&uacute;mero',

	// T
	'titre' => 'A Navalla Su&iacute;za',
	'titre_parent:description' => 'No interior dun bucle, &eacute; frecuente querer mostrar o t&iacute;tulo do pai do obxecto en curso. Tradicionalmente, cumpr&iacute;a utilizar un segundo bucle, mais esta nova baliza #TITRE_PARENT alixeirar&aacute; a escrita dos seus esqueletes. O resultado devolto &eacute; este : o t&iacute;tulo dun grupo de palabras clave ou o da secci&oacute;n pai (de existir) de calquera outro obxecto (artigo, secci&oacute;n, breve, etc.).

Note que : para as palabras clave, un alias de #TITRE_PARENT &eacute;  #TITRE_GROUPE. O tratamento de SPIP destas novas balizas &eacute; semellante a aquel de #TITRE.

@puce@ De estar con SPIP 2.0, tam&eacute;n ten &aacute; s&uacute;a disposici&oacute;n todo un conxunto de balizas #TITRE_XXX que poder&aacute;n darlle o t&iacute;tulo do obxecto \'xxx\', coa condici&oacute;n de que o campo \'id_xxx\' estea presente na t&aacute;boa en curso (#ID_XXX utilizable no bucle en curso).

Por exemplo, nun bucle sobre  (ARTICLES), #TITRE_SECTEUR devolver&aacute; o t&iacute;tulo da secci&oacute;n na que estea situado o artigo en curso, xa que o identificador #ID_SECTEUR (de a&iacute; o campo \'id_secteur\') est&aacute; dispo&ntilde;ible neste caso.[[%titres_etendus%]]
A sintaxe <html>#TITRE_XXX{yy}</html> &eacute; igualmente aceptada. Exemplo : <html>#TITRE_ARTICLE{10}</html> reenviar&aacute; ao t&iacute;tulo do artigo #10.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Baliza #TITRE_PARENT',
	'titre_tests' => 'A Navalla Su&iacute;za - P&aacute;xina de tests…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>&laquo; {{{Mon intertitre}}} &raquo;</html> en image typographique param&eacute;trable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%



Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]



Cet outil est compatible avec : &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'tous' => 'Todos',
	'toutes_couleurs' => 'As 36 cores dos estilos css :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Bloques multiling&uuml;es&nbsp;: <b><:trad:></b>',
	'toutmulti:description' => 'Ao instar isto, pode facelo xa nos seus esqueletos, esta utilidade perm&iacute;telle usar librementemente as cadeas de linguas de SPIP ou dos seus esqueletos: nos contidos do seu web (artigos, t&iacute;tulos, mensaxes, etc.) coa axuda co atallo <code><:chaine:></code>.

Consulte [aqui->http://www.spip.net/fr_article2128.html] a documentaci&oacute;n de SPIP sobre este asunto.

Esta ferramenta acepta igualmente os argumentos introducidos por SPIP 2.0. Por exemplo, o atallo <code><:mi&ntilde;a_cadea{nome=Carlos Mart&iacute;n, idade=37}:>/code> permite pasar dous par&aacute;metros &aacute; cadea seguinte: <code>\'mi&ntilde;a_cadea\'=>"Bos d&iacute;as, eu son @nome@ e te&ntilde;o @idade@ anos\\"</code>.

A funci&oacute;n SPIP usada en PHP &eacute; : <code>_T(\'chaine\')</code>. sen argumento, e <code>_T(\'chaine\', array(\'arg1\'=>\'un texto\', \'arg2\'=>\'un outro texto\'))</code> con argumentos.

Non esqueza verificar que a clave <code>\'cadea\'</code> est&aacute; ben definida nos ficheiros de lingua.', # MODIF
	'toutmulti:nom' => 'Bloques multiling&uuml;es',
	'travaux_masquer_avert' => 'Ocultar o cadro que indica no web p&uacute;blico que unha operaci&oacute;n de mantemento est&aacute; en curso',
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Este web ser&aacute; restablecido axi&ntilde;a.
_ Grazas pola s&uacute;a comprensi&oacute;n.', # MODIF
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'En navegando o web na zona privada([->./?exec=auteurs]), escolla aqu&iacute; a ordenaci&oacute;n que usar&aacute; para mostrar os artigos no interior das secci&oacute;ns.

As propostas que seguen est&aacute;n baseadas na funcionalidade SQL \'ORDER BY\' : non empregue unha ordenaci&oacute;n personalizada se non est&aacute; seguro do que est&aacute; a facer (campos dispo&ntilde;&iacute;beis : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Ordenaci&oacute;n de artigos', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'Ordenaci&oacute;n coa data de modificaci&oacute;n (ORDER BY date_modif DESC)',
	'tri_perso' => 'Ordenaci&oacute;n SQL personalizada, ORDER BY segundo a estrutura :',
	'tri_publi' => 'Ordenaci&oacute;n sobre a data de publicaci&oacute;n (ORDER BY date DESC)',
	'tri_titre' => 'Ordenaci&oacute;n sobre o t&iacute;tulo (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Utilidade en desenvolvemento. Ofrece algunhas balizas moi simples e moi pr&aacute;cticas para mellorar a lexibilidade dos seus esqueletos.

@puce@ {{#BOLO}} : xera un falso texto de 3000 caracteres ("bolo" ou "[?lorem ipsum]") nos esqueletos durante a s&uacute;a preparaci&oacute;n. O argumentos opcional desta funci&oacute;n especifica a lonxitude do texto querido. Exemplo : <code>#BOLO{300}</code>. Esta baliza acepta todos os filtros de  SPIP. Exemplo : <code>[(#BOLO|majuscules)]</code>.
_ Est&aacute; dispo&ntilde;ible igualmente un argumento para os seus contidos: sit&uacute;e <code><bolo300></code> en calquera zona de texto (entrada, descrici&oacute;n, texto, etc.) para obter 300 caracteres de texto falso.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : reenv&iacute;e simplemente a data do momento, do seguinte xeito: <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. O argumento opcional desta funci&oacute;n especifica a formato. Exemplo : <code>#MAINTENANT{Y-m-d}</code>. Como con #DATE, personalice a presentaci&oacute;n grazas aos filtros de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}} : baliza equivalente a <code>#EVAL{"chr(XX)"}</code> e pr&aacute;ctica para codificar os caracteres especiais (o retorno de li&ntilde;a por exemplo) ou dos caracteres reservados polo compilador de SPIP (par&eacute;nteses ou comi&ntilde;as).

@puce@ {{#LESMOTS}} :', # MODIF
	'trousse_balises:nom' => 'Caixa de balizas',
	'type_urls:description' => '@puce@ SPIP ofrece unha elecci&oacute;n entre varios xogos de URL para facer as ligaz&oacute;ns de acceso &aacute;s p&aacute;xinas do seu web :

M&aacute;is info : [->http://www.spip.net/fr_article765.html].
A ferramenta &laquo;&nbsp;[.->boites_privees]&nbsp;&raquo; permite ver na p&aacute;xina de cada obxecto SPIP o URL propio asociado.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@para usar os formatos {html}, {proprias} ou {proprias2}, {libres} ou {arborescentes} copie o ficheiro "htaccess.txt" do cartafol ra&iacute;z de SPIP co nome ".htaccess" (preste atenci&oacute;n a non borrar outras regraxes que vostede te&ntilde;a posto nese ficheiro); se o seu web est&aacute; nun subcartafol, deber&aacute; tam&eacute;n editar a li&ntilde;a "RewriteBase" neste ficheiro. Os URL definidos ser&aacute;n logo redirixidos cara aos ficheiros de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@{{URL &laquo;p&aacute;xina&raquo;}} : estas son as ligaz&oacute;ns predeterminadas, utilizadas por SPIP desde a s&uacute;a version 1.9x.
_ Exemplo : <code>/spip.php?article123</code>.
[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valor="html">@puce@ {{URL &laquo;html&raquo;}} : as ligaz&oacute;ns te&ntilde;en a forma de p&aacute;xinas html cl&aacute;sicas.
_ Exemplo : <code>/article123.html</code>.</radio_type_urls3>

<radio_type_urls3 valor="propias">@puce@ {{URL &laquo;propias&raquo;}} : as ligaz&oacute;ns son calculadas conforme o t&iacute;tulo dos obxectos demandados. Os marcadores (_, -, +, etc.) encadran os t&iacute;tulos en funci&oacute;n do tipo de obxecto.
_ Exemplos : <code>/Meu-titulo-de-artigo</code> ou <code>/-Mi&ntilde;a-seccion-</code> ou <code>/@Meu-web@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valor="propres2">@puce@ {{URLs &laquo;propres2&raquo;}} : a extensi&oacute;n \'.html\' eng&aacute;dese &aacute;s ligaz&oacute;ns {&laquo;propias&raquo;}.
_ Exemplo : <code>/Meu-titulo-de-artigo.html</code> ou <code>/-Mi&ntilde;a-seccion-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valor="libres">@puce@ {{URL &laquo;libres&raquo;}} : as ligaz&oacute;ns son {&laquo;propias&raquo;}, mais sen marcadores (_, -, +, etc.).
_ Exemplo : <code>/Meu-titulo-de-artigo</code> ou <code>/Mi&ntilde;a-secci&oacute;n</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valor="arbo">@puce@ {{URLs &laquo;arborescentes&raquo;}} : as ligaz&oacute;ns {&laquo;propias&raquo;}, mais de tipo arborescente.
_ Exemplo : <code>/sectour/seccion/seccion2/Meu-titulo-de-artigo</code>[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URL &laquo;propres-qs&raquo;}} : este sistema funciona en "Query-String", &eacute; dicir sen utilizaci&oacute;n .htaccess ; as ligaz&oacute;ns son {&laquo;propias&raquo;}.
_ Exemplo : <code>/?Meu-titulo-de-artigo</code>[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valor="propres_qs">@puce@ {{URL &laquo;propias_qs&raquo;}} : este sistema funciona en "Query-String", &eacute; dicir sen utilizaci&oacute;n de .htaccess ; as ligaz&oacute;ns son {&laquo;propias&raquo;}.
_ Exemplo : <code>/?Meu-titulo-de-artigo</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valor="standard">@puce@ {{URL &laquo;estandar&raquo;}} : estas ligaz&oacute;ns desde agora obsoletas eran empregadas por  SPIP ata a versi&oacute;n 1.8.
_ Exemplo : <code>article.php3?id_article=123</code></radio_type_urls3>

@puce@ Se vostede emprega o formato {p&aacute;xina} seguinte ou se o obxecto demandado non &eacute; reco&ntilde;ecido, &eacute; posible escoller {{o script de chamada }} a SPIP. De modo predeterminado, SPIP escolle {spip.php}, mais {index.php} (exemplo de formato: <code>/index.php?article123</code>) ou un valor baleiro (formato : <code>/?article123</code>) funcionan tam&eacute;n. Para calquera outro valor, c&oacute;mpre crear necesariamente o ficheiro correspondente na raiz de SPIP, a imaxe daquel que xa existe: {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ De utilizar un formato con base en URL &laquo;propres&raquo;  ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), a Navalla Su&iacute;za pode :
<q1>• Asegurarse que o URL producido sexa totalmente en {{en min&uacute;sculas}}.
</ql>[[%urls_minuscules%]]
 <ql> Provocar o engadido sistem&aacute;tico do{{id do obxecto}} ao seu URL (en sufixo ou en prefixo, etc.).
_(exemplos : <code>/Meu-titulo-de-artigo,457</code> ou <code>/457-Meu-titulo-de-artigo</code>)</q1>[[%urls_minuscules%]][[->%urls_avec_id%]][[->%urls_avec_id2%]]</ql>', # MODIF
	'type_urls:nom' => 'Formato das URL',
	'typo_exposants:description' => 'Textos franceses : mellora o rendemento tipogr&aacute;fico das abreviaci&oacute;ns correntes, metendo en super&iacute;ndice os elementos necesarios (as&iacute;, {<acronym>Mme</acronym>} produce {M<sup>me</sup>}) e corrixindo os erros correntes ({<acronym>2&egrave;me</acronym>} ou  {<acronym>2me</acronym>}, por exemplo, produce {2<sup>e</sup>}, s&oacute; abreviatura correcta).

As abreviaci&oacute;ns obtidas est&aacute;n conformes con aquelas da Imprenta nacional como constan en {Lexique des r&egrave;gles typographiques en usage &agrave; l\'Imprimerie nationale} (artigo &laquo;&nbsp;Abr&eacute;viations&nbsp;&raquo;, imprentas da Imprimerie nationale, Paris, 2002).
Tam&eacute;n son tratadas as expresi&oacute;ns seguintes: <html>Dr, Pr, Mgr, m2, m3, Mn, Md, St&eacute;, &Eacute;ts, Vve, Cie, 1o, 2o, etc.</html> 

Escolla aqu&iacute; se quere po&ntilde;er en super&iacute;ndice certos atallos suplementarios, malia que sexa desaconsellado pola Imprimerie nationale :[[%expo_bofbof%]]

{{Textos ingleses}} : en super&iacute;ndice os n&uacute;meros ordinaux : <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Super&iacute;ndices tipogr&aacute;ficos',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'p&aacute;xina',
	'url_propres' => 'propias@_CS_ASTER@',
	'url_propres-qs' => 'propias-qs',
	'url_propres2' => 'propias2@_CS_ASTER@',
	'url_propres_qs' => 'propias_qs',
	'url_standard' => 'est&aacute;ndar',
	'urls_3_chiffres' => 'Impo&ntilde;er un m&iacute;nimo de 3 cifras',
	'urls_avec_id' => 'Po&ntilde;elo en sufixo',
	'urls_avec_id2' => 'Po&ntilde;er o Id en prefixo',
	'urls_base_total' => 'Hai actualmente @nb@ URL na base',
	'urls_base_vide' => 'A base dos URL est&aacute; baleira',
	'urls_choix_objet' => 'Edici&oacute;n con base no URL dun obxecto espec&iacute;fico&nbsp;:',
	'urls_edit_erreur' => 'O formato actual dos URL (&laquo;&nbsp;@type@&nbsp;&raquo;) non permite a edici&oacute;n.',
	'urls_enregistrer' => 'Rexistrar esta URL na base',
	'urls_id_sauf_rubriques' => 'Exclu&iacute;r as secci&oacute;ns', # MODIF
	'urls_minuscules' => 'Letras min&uacute;sculas',
	'urls_nouvelle' => 'Editar o URL &laquo;&nbsp;propias&nbsp;&raquo;&nbsp;:',
	'urls_num_objet' => 'N&uacute;mero&nbsp;:',
	'urls_purger' => 'Baleirar todo',
	'urls_purger_tables' => 'Baleirar as t&aacute;boas seleccionadas',
	'urls_purger_tout' => 'Reiniciar os URL gardados na base&nbsp;:',
	'urls_rechercher' => 'Procurar este obxecto na base',
	'urls_titre_objet' => 'T&iacute;tulo rexistrado&nbsp;:',
	'urls_type_objet' => 'Obxecto&nbsp;:',
	'urls_url_calculee' => 'URL p&uacute;blico &laquo;&nbsp;@type@&nbsp;&raquo;&nbsp;:',
	'urls_url_objet' => 'URL &laquo;&nbsp;propias&nbsp;&raquo; rexistrado&nbsp;:',
	'urls_valeur_vide' => '(Un valor baleiro provoca o rec&aacute;lculo do URL)',

	// V
	'validez_page' => 'Para acceder &aacute;s modificaci&oacute;ns :',
	'variable_vide' => '(Baleiro)',
	'vars_modifiees' => 'Os datos foron correctamente modificados',
	'version_a_jour' => 'A s&uacute;a versi&oacute;n est&aacute; actualizada.',
	'version_distante' => 'Versi&oacute;n remota...',
	'version_distante_off' => 'Comprobaci&oacute;n distante desactivada',
	'version_nouvelle' => 'Nova versi&oacute;n : @version@',
	'version_revision' => 'Revisi&oacute;nn : @revision@',
	'version_update' => 'Actualizaci&oacute;n autom&aacute;tica',
	'version_update_chargeur' => 'Descarga autom&aacute;tica',
	'version_update_chargeur_title' => 'Descarga a &uacute;ltima versi&oacute;n do plugin grazas ao &laquo;T&eacute;l&eacute;chargeur&raquo;',
	'version_update_title' => 'Descarga a &uacute;ltima versi&oacute;n do m&oacute;dulo e lanza a s&uacute;a posta ao d&iacute;a autom&aacute;tica',
	'verstexte:description' => 'Dous filtros para os seus esqueletos que permiten producir p&aacute;xinas m&aacute;is lixeiras.
_ version_texte : extrae o contido de texto dunha p&aacute;xina html tras  exclu&iacute;r algunhas balizas elementares.
_ version_plein_texte : extrae o contido de texto dunha p&aacute;xina html para manter o texto pleno.', # MODIF
	'verstexte:nom' => 'Versi&oacute;n de texto',
	'visiteurs_connectes:description' => 'Ofrece un elemento para o seu esqueleto que mostra o n&uacute;mero de visitantes conectados ao web p&uacute;blico.

Engada simplemente<code><INCLURE{fond=fonds/visiteurs_connectes}></code> nas s&uacute;as p&aacute;xinas.', # MODIF
	'visiteurs_connectes:nom' => 'Visitantes conectados',
	'voir' => 'Ver: @voir@',
	'votre_choix' => 'A s&uacute;a elecci&oacute;n :',

	// W
	'webmestres:description' => 'Un/unha {{webmaster}} no senso de SPIP &eacute; un {{administrador}} que ten acceso ao espazo FTP. De modo predefinido e a partir de SPIP 2.0, &eacute; o administrador <code>id_auteur=1</code> do web. Os webm&aacute;sters aqu&iacute; definidos te&ntilde;en o privilexio de non estaren obrigados a pasar polo FTP para validar as operaci&oacute;ns sensibles do web, como a actualizaci&oacute;n da base de datos ou a restauraci&oacute;n dun volcado (dump).

Webm&aacute;ster(es) actual(is) : {@_CS_LISTE_WEBMESTRES@}.
_ Administrador(es) elixible(s) : {@_CS_LISTE_ADMINS@}.

En tanto que webm&aacute;ster, ten dereito a modificar esta lista de id -- separados por dous puntos &laquo;&nbsp;:&nbsp;&raquo; de seren varios. Exemplo : &laquo;1:5:6&raquo;.[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Lista de webm&aacute;sters',

	// X
	'xml:description' => 'Activa o validador xml para o espazo p&uacute;blico tal como se describe na [documentaci&oacute;n->http://www.spip.net/fr_article3541.html]. Un bot&oacute;n titulado &laquo;&nbsp;Analise XML&nbsp;&raquo; foi engadido aos outros bot&oacute;ns de administraci&oacute;n.',
	'xml:nom' => 'Validador XML'
);

?>
