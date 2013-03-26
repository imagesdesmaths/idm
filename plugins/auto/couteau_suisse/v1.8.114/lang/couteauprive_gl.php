<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=gl
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ' : non',
	'2pts_oui' => ' : si',

	// S
	'SPIP_liens:description' => '@puce@ Todas as ligazóns do web se abren predeterminadamente na mesma ventá de navegación en curso. Mais pode ser útil abril ligazóns externas ao web nunha nova ventá exterior -- iso implica engadir {target=\\"_blank\\"} a todas as balizas &lt;a&gt; dotadas por  SPIP de clases {spip_out}, {spip_url} ou {spip_glossaire}. Se cadra é necesario engadir unha destas clases nas ligazóns do esqueleto do web (ficheiros html) co fin de estender ao máximo esta funcionalidade.[[%radio_target_blank3%]]

@puce@ SPIP permite ligar palabras á súa definición mercé ao atallo tipográfico <code>[?mot]</code>. Predeterminadamente (ou se vostede  deixa baleira a caixa seguinte), o glosario externo reenvía sobre a enciclopedia libre wikipedia.org. Pode escoller o enderezo que se vaia utilizar. <br />Ligazón de test : [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP prevé un estilo CSS para as ligazóns «~mailto:~» : un pequeno cadro debería aparecer para cada ligazón relacionada cun enderezo de correo; mais para que todos os navegadores non o poidan mostrar (nomeadamente IE6, IE7 e SAF3), decida se cómpre conservar este engadido.
_ Ligazón de test : [->test@test.com] (vexa a páxina completamente).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP e as ligazóns externas',
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
	'acces_admin' => 'Acceso de administración :',
	'action_rapide' => 'Acción rápida, unicamente se sabe do que fai!',
	'action_rapide_non' => 'Acción rápida, dispoñible tras a activación desta utilidade :',
	'admins_seuls' => 'Só para administradores/as',
	'aff_tout:description' => 'Il parfois utile d\'afficher toutes les rubriques ou tous les auteurs de ton site sans tenir compte de leur statut (pendant la période de développement par exemple). Par défaut, SPIP n\'affiche en public que les auteurs et les rubriques ayant au moins un élément publié.

Bien qu\'il soit possible de contourner ce comportement à l\'aide du critère [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], cet outil automatise le processus et t\'évite d\'ajouter ce critère à toutes les boucles RUBRIQUES et/ou AUTEURS de tes squelettes.',
	'aff_tout:nom' => 'Affiche tout',
	'alerte_urgence:description' => 'Affiche en tête de toutes les pages publiques un bandeau d\'alerte pour diffuser le message d\'urgence défini ci-dessous.
_ Les balises <code><multi/></code> sont recommandées en cas de site multilingue.[[%alerte_message%]]', # NEW
	'alerte_urgence:nom' => 'Message d\'alerte', # NEW
	'attente' => 'En espera...',
	'auteur_forum:description' => 'Invite a todos os autores de mensaxes públicas a fornecer (cando menos cunha letra!) un nome e/ou un correo co fin de evitar as colaboracións totalmente anónimas. Esta utilidade procede a facer unha verificación JavaScript sobre a caixa de correo do visitante.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Atención : Escoller a terceira opción anula as dúas primeiras. Cómpre verificar que os formularios do seu esqueleto sexan compatibles con esta ferramenta.}', # MODIF
	'auteur_forum:nom' => 'Non haberá foros anónimos',
	'auteur_forum_deux' => 'Ou, cando menos un dos dous campos seguintes',
	'auteur_forum_email' => 'O campo «@_CS_FORUM_EMAIL@»',
	'auteur_forum_nom' => 'O campo «@_CS_FORUM_NOM@»',
	'auteurs:description' => 'Esta utilidade configura a apariencia da [páxina de autores->./?exec=auteurs], na súa parte privada.

@puce@ Defina aquí o número máximo de autores que se mostrarán no cadro central da páxina de autores. A partir de aí, os autores serán mostrados mediante unha paxinación.[[%max_auteurs_page%]]

@puce@ Que estados de autores poden ser listados nesta páxina?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]', # MODIF
	'auteurs:nom' => 'Páxina de autores',
	'autobr:description' => 'Applique sur certains contenus SPIP le filtre {|post_autobr} qui remplace tous les sauts de ligne simples par un saut de ligne HTML <br />.[[%alinea%]][[->%alinea2%]]', # MODIF
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
	'blocs:aide' => 'Bloques despregables : <b><bloque></bloque></b> (alias : <b><invisible></invisible></b>) e <b><visible></visible></b>',
	'blocs:description' => 'Permítelle crear bloques nos que o título é activo e pode facelos visibles ou invisibles.

@puce@ {{Dentro dos textos SPIP}} : os redactores teñen a disposición as novas balizas &lt;bloque&gt; (ou &lt;invisible&gt;) e &lt;visible&gt; para utilizar nos seus textos, coma no caso : 

<quote><code>
<bloc>
 Un título que se fará activo,  clicable
 
 O texto para ocultar/mostrar, despois de dous saltos de liña...
 </bloc>
</code></quote>

@puce@ {{Dentro dos esqueletos}} : ten á súa disposición as novas balizas #BLOC_TITRE, #BLOC_DEBUT e #BLOC_FIN para utilizar coma no caso : 
<quote><code> #BLOC_TITRE ou #BLOC_TITRE{mon_URL}
 O meu título
 #BLOC_RESUME    (facultativo)
 unha versión resumida do bloque seguinte
 #BLOC_DEBUT
 O meu bloque despregable (que conterá o enderezo URL punteado se for necesario)
 #BLOC_FIN</code></quote>
 
@puce@ Marcando «si», a apertura dun bloque provocará o cerre de todos os outros bloques da páxina, co fin de non ter máis ca un aberto á vez.[[%bloc_unique%]]

@puce@ Marcando «si», o estado dos bloques numerados gardarase nunha cookie durante o tempo da sesión, co fin de conservar o aspecto da páxina en caso de retorno.[[%blocs_cookie%]]

@puce@ A Navalla Suíza utiliza de modo predeterminado a baliza HTML &lt;h4&gt; para o título dos bloques despregables. Escolla aquí outra baliza &lt;hN&gt; :[[%bloc_h4%]]
@puce@ Co fin de obter un efecto máis doce no momento do clic, os bloques despregables poden animarse á maneira dun \\"esvaramento\\".[[%blocs_slide%]][[->%blocs_millisec% millisecondes]]', # MODIF
	'blocs:nom' => 'Bloques despregables',
	'boites_privees:description' => 'Todas as funcionalidades abaixo descritas aparecen aquí ou na parte privada.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%bp_urls_propres%]]
[[->%bp_tri_auteurs%]]
- {{As revisións da Navalla Suíza}} : un cadro sobre a presente páxina de configuración que indica as últimas modificacións achegadas ao código do módulo ([Source->@_CS_RSS_SOURCE@]).
- {{Os artigos en formato SPIP}} : un cadro despregable suplementario para os seus artigos co fin de coñecer o  código fonte usado polos seus autores.
- {{Estado de autores}} : un cadro suplementario en [páxina de autores->./?exec=auteurs] que indica os últimos 10 conectados e as inscricións non confirmadas. Só os administradores ven esta información.
- {{Os webmáster SPIP}} : un cadro despregable sobre [a páxina dos autores->./?exec=auteurs] uqe indica os administradores elevados ao rango de webmaster SPIP. Só os administradores ven esta información. Se vostede é webmáster, vexa tamén a ferramenta « [.->webmestres] ».
- {{Os URL propios}} : un cadro despregable para cada obxecto de contido (artigo, sección, autor, ...) que indica o URL propio asociado así como os seus alias eventuais. A ferramenta « [.->type_urls] » permite a configuración fina dos URL do web.
- {{As ordenacións de autores}} : un cadro despregable para os artigos que contén máis dun autor e permite simplemente axustar a orde de presentación.', # MODIF
	'boites_privees:nom' => 'Funcionalidades privadas',
	'bp_tri_auteurs' => 'As ordenacións de autores',
	'bp_urls_propres' => 'Os URL propios',
	'brouteur:description' => 'Utilizar o selector de sección en AJAX a partir da %rubrique_brouteur% sección(s)', # MODIF
	'brouteur:nom' => 'Reglaxe do selector da sección', # MODIF

	// C
	'cache_controle' => 'Control da caché',
	'cache_nornal' => 'Uso normal',
	'cache_permanent' => 'Caché permanente',
	'cache_sans' => 'Non hai caché',
	'categ:admin' => '1. Administración',
	'categ:devel' => '55. Développement', # NEW
	'categ:divers' => '60. Varios',
	'categ:interface' => '10. Interface privada',
	'categ:public' => '40. Exposición pública',
	'categ:securite' => '5. Sécurité', # NEW
	'categ:spip' => '50. Balizas, filtros, criterios',
	'categ:typo-corr' => '20. Melloramento de textos',
	'categ:typo-racc' => '30. Atallos tipográficos',
	'certaines_couleurs' => 'Só as balizas definidas aquí abaixo ci-dessous@_CS_ASTER@ :',
	'chatons:aide' => 'Chatons : @liste@',
	'chatons:description' => 'Introduce imaxes (ou chatons para os {tchats}) en todos os textos ou aparece unha cadea do tipo {{<code>:nom</code>}}.
_ Esta utilidade substitúe os atallos polas imaxes que co mesmo nome encontre no seu cartafol <code>mon_squelette_toto/img/chatons/</code>, ou de modo predefinido, o cartafo <code>couteau_suisse/img/chatons/</code>.', # MODIF
	'chatons:nom' => 'Chatóns',
	'citations_bb:description' => 'Co fin de respectar os usos en HTML nos contidos SPIP do seu web (artigos, seccións, etc.), esta utilidade substitúe as balizas &lt;quote&gt; polas balizas &lt;q&gt; cando non hai retorno á liña. De feito, as citas curtas deben ser rodeadas por &lt;q&gt; e as citas que conteñen parágrafos por &lt;blockquote&gt;.', # MODIF
	'citations_bb:nom' => 'Citas ben balizadas',
	'class_spip:description1' => 'Pode definir aquí certos recursos de SPIP. Un valor baleiro equivale a usar o valor predeterminado.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Os atallos de SPIP}}.

Pode definir aquí certos atallos de SPIP. Un valor baleiro equivale a usar o valor predeterminado.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{Aviso : se a utilidade « [.->pucesli] » está activada, o reemprazamento da « - » xa non será efectuado ; unha lista &lt;ul>&lt;li> sera utilizada no seu lugar.}

SPIP adoita usar a baliza &lt;h3&gt; para os intertítulos. Escolla aquí se quixer, outra cadea de substitución :[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP escolleu usar a baliza &lt;strong> para transcribir as grosas. Pero &lt;b> podería tamén ter escollido con ou sen estilo. Vexa e valore :[[%racc_g1%]][[->%racc_g2%]]

SPIP elixiu usar a baliza &lt;i> para transcribir as cursiva. Mais &lt;em> podería ser igualmente adecuado, con ou sen estilo. Vexa e valore:[[%racc_i1%]][[->%racc_i2%]]

Tamén pode definir o código de apertura e cerre para as chamadas á notas a pé de páxina (Atención ! As modificación non será visibles máis ca no espazo público.) : [[%ouvre_ref%]][[->%ferme_ref%]]
 
Tamén pode definir o código de apertura e cerre para as notas a pe de páxina : [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{Os estilos de SPIP predeterminados}}. Ata a versión 1.92 de SPIP, os atallos tipográficos producían balizas sistematicamente  nomeadas co patrón \\"spip\\". Por exemplo: <code><p class=\\"spip\\"></code>. Pode definir o estilo destas balizas en función das súas follas de estilo. Un caso baleiro significa que ningún estilo en particular lle será aplicado.

{Ollo : se algúns recursos (liña horizontal, intertítulo, cursiva, grosa) se modificaren, os estilos seguintes xa non se poderán aplicar.}

<q1>
_ {{1.}} Balizas &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]]
_ {{2.}} Balizas &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; e as listas (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Ollo : modificando este segundo parámetro, pérdense os estilos estándares de SPIP asociados a estas balizas.</blockquote>', # MODIF
	'class_spip:nom' => 'SPIP e os seus atallos',
	'code_css' => 'CSS',
	'code_fonctions' => 'Funcións',
	'code_jq' => 'jQuery',
	'code_js' => 'Javascript',
	'code_options' => 'Opcións',
	'code_spip_options' => 'Opcións de SPIP',
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie privée', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options précédentes)', # NEW
	'contrib' => 'Máis información: @url@',
	'copie_vers' => 'Copie vers : @dir@', # NEW
	'corbeille:description' => 'SPIP suprime automaticamente os obxectos rexeitados logo de 24 horas, en xeral a iso das 4 horas da mañá, grazas a unha tarefa «CRON» (lanzemento periódico e/ou automático de procesos preprogramados). Pode impedir desde aquí ese proceso co fin de xestionar mellor a súa papeleira.[[%arret_optimisation%]]',
	'corbeille:nom' => 'A papeleira',
	'corbeille_objets' => '@nb@ obxeto(s) na papeleira.',
	'corbeille_objets_lies' => '@nb_lies@ ligazón(s) detectada(s).',
	'corbeille_objets_vide' => 'Non hai ningún obxecto na papeleira', # MODIF
	'corbeille_objets_vider' => 'Suprimir os obxectos seleccionados',
	'corbeille_vider' => 'Baleirar a papeleira :',
	'couleurs:aide' => 'Colorear : <b>[coul]texte[/coul]</b>@fond@ con <b>coul</b> = @liste@',
	'couleurs:description' => 'Permite aplicar doadamente cores a todos os textos do web (artigos, breves, títulos, foro, …) usando balizas en atallos.

Dous exemplos idénticos para trocar a cor do texto :@_CS_EXEMPLE_COULEURS2@

Idem para trocar o fondo, se a opción seguinte o permite :@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@ O formato destas balizas personalizadas debe listar as cores existentes ou definir parellas «balise=couleur», sempre separadas por vírgulas. Exemplos : «gris, rouge», «faible=jaune, fort=rouge», «bas=#99CC11, haut=brown» ou mesmo «gris=#DDDDCC, rouge=#EE3300». Para o primeiro e o derradeiro exemplo, as balizas autorizadas son : <code>[gris]</code> et <code>[rouge]</code> (<code>[fond gris]</code> e <code>[fond rouge]</code> se os fondos son permitidos).', # MODIF
	'couleurs:nom' => 'Todo en cores',
	'couleurs_fonds' => ', <b>[fond coul]texte[/coul]</b>, <b>[bg coul]texte[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Obter moita información a propósito do funcionamento da Navalla Suíza nos ficheiros {spip.log} que se poden consultar no cartafol : {@_CS_DIR_TMP@}[[%log_couteau_suisse%]]

@puce@ {{Opcións SPIP.}} SPIP ordena os plugins nunha orde específica. Co fin de estar seguro de que A Navalla Suíza está na cabeceira e xera certas opcións de SPIP, escolla a opción seguinte. Se os dereitos do seu servidor o permiten, o ficheiro {@_CS_FILE_OPTIONS@} será automaticamente modificado para incluír o ficheiro {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php}.
[[%spip_options_on%]]

@puce@ {{Consultas externas.}} A Navalla Suíza verifica regularmente a existencia dunha versión máis recente do seu código e informa na súa páxina de configuración dunha actualización eventualmente dispoñible. Se as consultas externas do seu servidor dan problemas, escolla a caixa seguinte.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'Comportamentos da Navalla Suíza',
	'cs_comportement_ko' => '{{Note :}} ce paramètre requiert un filtre de gravité réglé à plus de @gr2@ au lieu de @gr1@ actuellement.', # NEW
	'cs_distant_off' => 'Comprobación de versións distantes',
	'cs_distant_outils_off' => 'Les outils du Couteau Suisse ayant des fichiers distants', # NEW
	'cs_log_couteau_suisse' => 'Os logs detallados da Navalla Suíza',
	'cs_reset' => 'Está seguro de querer reiniciar totalmente a Navalla Suíza?',
	'cs_reset2' => 'Desactivaranse todas as utilidades activasactualmente e reinicializaranse os seus parámetros.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher «<html>@_CS_FILE_OPTIONS@</html>» a échoué !', # NEW
	'cs_spip_options_on' => 'As opcións SPIP en «@_CS_FILE_OPTIONS@»', # MODIF

	// D
	'decoration:aide' => 'Decoración : <b>&lt;balise&gt;test&lt;/balise&gt;</b>, con <b>balise</b> = @liste@',
	'decoration:description' => 'Novos estilos parametrables nos seus textos e accesíbeis mercé ás balizas con comas angulares. Exemplo : 
&lt;mabalise&gt;texte&lt;/mabalise&gt; ou : &lt;mabalise/&gt;.<br /> Defina seguidamente os estilos CSS dos que teña necesidade, unha baliza por liña, consonte as expresións seguintes :
- {type.mabalise = meu estilo CSS}
- {type.mabalise.class = miña clase CSS}
- {type.mabalise.lang = miña lingua (ex : fr)}
- {unalias = minhabaliza}

O parámetro {type} seguinte pode ter tres valores:
- {span} : baliza para o interior dun parágrafo (tipo Inline)
- {div} : baliza asociada a un novo parágrafo (tipo Block)
- {auto} : baliza determinada automaticamente polo plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Decoración',
	'decoupe:aide' => 'Bloque de pestanas : <b>&lt;onglets>&lt;/onglets></b><br/>Separador de páxinas ou pestanas : @sep@', # MODIF
	'decoupe:aide2' => 'Alias : @sep@',
	'decoupe:description' => '@puce@ Parte a presentación pública dun artigo en varias páxinas mediante unha paxinación automática. Sitúe simplemente no seu artigo catro signos de máis consecutivos (<code>++++</code>) no lugar que debe recibir o corte.

En principio, A Navalla Suíza insire a paxinación automaticamente na cabeceira e no rodapé do artigo mais vostede ten a posibilidade de situar esta paxinación en calquera outro sitio do seu esqueleto mercé a unha baliza #CS_DECOUPE que pode activar aquí:
[[%balise_decoupe%]]

@puce@ De utilizar este separador no interior das balizas &lt;pestanas&gt; e &lt;/pestanas&gt; obterá un xogo de pestanas.

_ Nos esqueletos : ten á súa disposición as novas balizas #ONGLETS_DEBUT, #ONGLETS_TITRE e #ONGLETS_FIN.

_ Esta utilidade pode ser emparellada con « [.->sommaire] ».', # MODIF
	'decoupe:nom' => 'Partición en páxinas e pestanas',
	'desactiver_flash:description' => 'Suprime os obxectos flash das páxinas do seu web e substitúeas polo contido alternativo asociado.',
	'desactiver_flash:nom' => 'Desactiva os obxectos flash',
	'detail_balise_etoilee' => '{{Aviso}} : Comprobe a utilización feita polos seus esqueletos das balizas estreladas. O tratamento desta ferramenta non se aplicarán sobre : @bal@.',
	'detail_disabled' => 'Paramètres non modifiables :', # NEW
	'detail_fichiers' => 'Ficheiros :',
	'detail_fichiers_distant' => 'Fichiers distants :', # NEW
	'detail_inline' => 'Código inline :',
	'detail_jquery2' => 'Esta ferramenta necesita a biblioteca {jQuery}.',
	'detail_jquery3' => '{{Aviso}} : esta utilidade necesita o plugin [jQuery para SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] para funcionar correctamente con esta versión de  SPIP.',
	'detail_pipelines' => 'Tubarías (pipelines) :',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_spip_options2' => 'Il est recommandé de placer les options SPIP en amont grâce à l\'outil «[.->cs_comportement]».', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_surcharge' => 'Outil surchargé :', # NEW
	'detail_traitements' => 'Tratamentos :',
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
	'dossier_squelettes:description' => 'Modifica o cartafol do esqueleto usado. Por exemplo : "squelettes/monsquelette". Pode rexistrar varios cartafoles separándoos polos dous puntos <html>« : »</html>. Deixando baleira caixa seguinte (ou escribindo "dist"), vai ser o esqueleto orixinal "dist" fornecido por SPIP o que será usado.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Cartafol do esqueleto',

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
	'en_travaux:description' => 'Permite mostrar unha mensaxe personalizable durante unha fase de mantemento sobre todo o web público, e mesmo sobre a parte privada.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Web en obras',
	'erreur:bt' => '<span style=\\"color:red;\\">Aviso:</span> a barra tipográfica (version @version@) parece antiga.<br />A Navalla Suíza é  compatible cunha versión superior ou igual a @mini@.', # MODIF
	'erreur:description' => 'Falta o id na definición da ferramenta!',
	'erreur:distant' => 'O servidor remoto',
	'erreur:jquery' => '{{Nota}} : a libraría {jQuery} parece inactiva nesta páxina. Consulte [aquí->http://www.spip-contrib.net/?article2166] o parágrafo verbo das dependencias do plugin ou recargar esta páxina.',
	'erreur:js' => 'Un erro de JavaScript parece terse producido nesta páxina e impide o seu funcionamento correcto. Active JavaScript no seu navegador ou desactive algúns módulos do seu web.',
	'erreur:nojs' => 'O JavaScript está desactivado nesta páxina.',
	'erreur:nom' => 'Erro !',
	'erreur:probleme' => 'Problema en : @pb@',
	'erreur:traitements' => 'A Navalla Suíza - Erro de compilation dos tratamentos : mestura \'typo\' e \'propre\' prohibida !',
	'erreur:version' => 'Esta ferramenta non está dispoñíbel nesta versión de SPIP.',
	'erreur_groupe' => 'Attention : le groupe «@groupe@» n\'est pas défini !', # NEW
	'erreur_mot' => 'Attention : le mot-clé «@mot@» n\'est pas défini !', # NEW
	'etendu' => 'Estendido',

	// F
	'f_jQuery:description' => 'Impide a instalación de {jQuery} na parte pública co fin de economizar un pouco de «tempo máquina». Esta libraría ([->http://jquery.com/]) achega numerosas comodidades na programación de Javascript e pode ser usada por certos módulos. SPIP usa dela na área privada.

Aviso : algúnhas ferramentas de A Navalla Suíza necesitan as funcións de {jQuery}. ', # MODIF
	'f_jQuery:nom' => 'Desactiva jQuery',
	'filets_sep:aide' => 'Filetes de separación : <b>__i__</b> ou <b>i</b> é un número.<br />Outros filetes dipoñíbeis : @liste@', # MODIF
	'filets_sep:description' => 'Insire filetes de separación, personalizables mediante as follas de estilo, en todos os textos de SPIP.
_ A sintaxe é : "__code__", ou "code" representa ben o número de identificación (de 0 à 7) do filete inserible en relación directa cos estilos correspondentes, ben o nome dunha imaxe situada no cartafol plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Filetes de separación',
	'filtrer_javascript:description' => 'Para xerar a inserción de Javascript nos artigos, son tres os modos :
- <i>nunca</i> : o Javascript é rexeitado en todas partes
- <i>predeterminado</i> : o Javascript márcase en vermello na zona privada
- <i>sempre</i> : o Javascript é aceptado en todas as partes.

Aviso : nos foros, pedimentos, fluxos afiliados, etc., a xestión do Javascript está <b>sempre</b> securizada.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Xestión do Javascript',
	'flock:description' => 'Desactiva o bloqueo de ficheiros neutralizando a función PHP {flock()}. Algús aloxadores dan de feito problemas graves sexa por un sistema de ficheiros inadaptados ou sexa por unha falta de sincronización. Non active esta utilidade  se este funciona normalmente.',
	'flock:nom' => 'Non bloquear os ficheiros',
	'fonds' => 'Fondos :',
	'forcer_langue:description' => 'Forza o contexto de lingua para os xogos de esqueletos multilingües que dispoñen dun formulario ou dun menú de linguas que saiban xerar a cookie de linguas.

Tecnicamente, esta utilidade ten como efecto:
- desactivar a busca do esqueleto en función da lingua do obxecto,
- desactivar o criterio <code> {lang_select}</code> automático sobre os obxectos clásicos (artigos, breves, seccións, etc.)
Os bloques multi móstranse entón sempre na lingua demandada polo visitante.', # MODIF
	'forcer_langue:nom' => 'Forzar a lingua',
	'format_spip' => 'Artigos en formato SPIP',
	'forum_lgrmaxi:description' => 'De modo predeterminado as mensaxes de foros non se limitan en tamaño. De activar esta ferramenta, unha mensaxe de erro mostrarase cando alguén queira introducir unha mensaxe de tamaño superior ao especificado, e a mensaxe será rexeitada. Un valor baleiro ou igual a  0 significa no entanto que non se lle aplica ningún límite.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Tamaño dos foros',

	// G
	'glossaire:aide' => 'Un texto sen glosario : <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Xestión dun glosario interno ligado a un ou varios grupos de palabras clave. Rexistre aquí o nome dos grupos, separados por dous puntos « : ». Deixando a caixa baleira, o que se crea (ou ao escribir "Glosario") é o grupo "Glosario" para ser usado.[[%glossaire_groupes%]]

@puce@ Para cada palabra, pode escoller o número máximo de ligazóns creadas nos seus textos. Calquera valor nulo ou negativo implica que todas as palabras recoñecidas serán tratadas. [[%%glossaire_limite por palavra-clave]]

@puce@ Dúas solucións se ofrecen para xerar a pequena xanela automática que aparece cando se sobrevoa á ocorrencia. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Glosario interno',
	'glossaire_abbr' => 'Ignorer les balises <code><abbr></code> et <code><acronym></code>', # NEW
	'glossaire_css' => 'Solución CSS',
	'glossaire_erreur' => 'Le mot «@mot1@» rend indétectable le mot «@mot2@»', # NEW
	'glossaire_inverser' => 'Correction proposée : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Solución Javascript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) étudié(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Substitución automática das comas dereitas (") polas tipográficas da lingua de composición. A substitución, transparente para o usuario, non modifica o texto orixinal senón que soamente cambia a presentación final.',
	'guillemets:nom' => 'Vírgulas tipográficas',

	// H
	'help' => '{{Esta páxina só é accesible para o responsable do web.}}<p>Dá acceso ás diferentes funcións suplementarias achegadas polo módulo «{{Le Couteau Suisse}}».',
	'help2' => 'Versión local: @version@',
	'help3' => '<p>Ligazóns de documentación:<br/>• [A Navalla Suiza->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Reinicios:
_ • [Ferramentas cacheadas|Volver á apariencia inicial desta páxina->@hide@]
_ • [De todo o módulo|Volver ao estado inicial do módulo->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Utilidade en desenvolvemento. Ofrece un Javascript horloge. Baliza:<code>#HORLOGE{format,utc,id}</code>. Modelo : <code><horloge></code>', # MODIF
	'horloge:nom' => 'Horloge',

	// I
	'icone_visiter:description' => 'Substitúa a imaxe do botón estándar « Visitar » (arriba á dereita desta páxina) polo logo do web, se existe.

Para definir o logo, vaia á páxina « Configuración do web » premendo sobre o botón « Configuración ».', # MODIF
	'icone_visiter:nom' => 'Botón « Visitar »', # MODIF
	'insert_head:description' => 'Activa automaticamente a baliza [#INSERT_HEAD->http://www.spip.net/fr_article1902.html] en todos os esqueletos, que teñan ou non esta baliza entre &lt;head&gt; e &lt;/head&gt;. Mercé a esta opción, os plugins poderán inserir javascript (.js) ou follas de estilo (.css).',
	'insert_head:nom' => 'Baliza #INSERT_HEAD',
	'insertions:description' => 'AVISO : ferramenta en proceso de desenvolvemento !! [[%insertions%]]',
	'insertions:nom' => 'Correccións automáticas',
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
	'jcorner:description' => '« Jolis Coins » é unha ferramenta que permite modificar doadamente o aspecto das esquinas dos {{cadros coloreados}} na parte pública do seu web. Todo é posible ou case!
_ Vexa o resultado nestá páxina: [->http://www.malsup.com/jquery/corner/].

Liste aquí abaixo os obxectos do seu esqueleto a redondear usando a sintaxe CSS (.class, #id, etc. ). Utilice o signo « = » para especificar o comando jQuery a usar e unha dobre barra (« // ») para o comentarios. En ausencia do signo igual, as esquinas redondeadas serán aplicadas (equivalent e : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Atención, esta ferramenta, precisa para funcionar do módulo {jQuery} : {Round Corners}. A Navalla Suíza pódea instalar directamente se marca a caixa seguinte. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Jolis Coins',
	'jcorner_plugin' => '«Módulo Round Corners »',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Predeterminado',
	'js_jamais' => 'Nunca',
	'js_toujours' => 'Sempre',
	'jslide_aucun' => 'Sen animación',
	'jslide_fast' => 'Pasaxe rápida',
	'jslide_lent' => 'Pasaxe lenta',
	'jslide_millisec' => 'Pasaxe durante:',
	'jslide_normal' => 'Pasaxe normal',

	// L
	'label:admin_travaux' => 'Pechar o web para :',
	'label:alinea' => 'Champ d\'application :', # NEW
	'label:alinea2' => 'Sauf :', # NEW
	'label:alinea3' => 'Désactiver la prise en compte des alinéas :', # NEW
	'label:arret_optimisation' => 'Impedir que SPIP baleire a papeleira automaticamente :',
	'label:auteur_forum_nom' => 'O visitante debe especificar:',
	'label:auto_sommaire' => 'Creación sistemática de sumario :',
	'label:balise_decoupe' => 'Activar a baliza #CS_DECOUPE :',
	'label:balise_sommaire' => 'Activar a baliza #CS_SOMMAIRE :',
	'label:bloc_h4' => 'Baliza para os títulos :',
	'label:bloc_unique' => 'Un só bloque aberto na páxina:',
	'label:blocs_cookie' => 'Utulización das cookies',
	'label:blocs_slide' => 'Tipo de animación:',
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Espace maximal réservé aux copies locales :', # NEW
	'label:couleurs_fonds' => 'Permitir os fondos :',
	'label:cs_rss' => 'Activar :',
	'label:debut_urls_propres' => 'Comezo dos URL :',
	'label:decoration_styles' => 'As súas balizas de estilo pesonalizado :',
	'label:derniere_modif_invalide' => 'Recalcular só despois dunha modificación :',
	'label:devdebug_espace' => 'Filtrage de l\'espace concerné :', # NEW
	'label:devdebug_mode' => 'Activer le débogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoyé :', # NEW
	'label:distant_off' => 'Desactivar :',
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Cartafol para utilizar :',
	'label:duree_cache' => 'Duración da caché local :',
	'label:duree_cache_mutu' => 'Duración da caché en mutualización :',
	'label:enveloppe_mails' => 'Pequeno cadro diante dos enderezos de correo:',
	'label:expo_bofbof' => 'Mostrar en superíndice cando : <html>St(e)(s), Bx, Bd(s) e Fb(s)</html>',
	'label:filtre_gravite' => 'Gravité maximale acceptée :', # NEW
	'label:forum_lgrmaxi' => 'Valor (en caracteres) :',
	'label:glossaire_groupes' => 'Grupo(s) usado(s) :',
	'label:glossaire_js' => 'Técnica usada :',
	'label:glossaire_limite' => 'Número máximo de ligazóns creadas :',
	'label:i_align' => 'Alignement du texte :', # NEW
	'label:i_couleur' => 'Couleur de la police :', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (éq. à {line-height}) :', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte :', # NEW
	'label:i_padding' => 'Espacement autour du texte (éq. à {padding}) :', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/}) :', # NEW
	'label:i_taille' => 'Taille de la police :', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Correccións automáticas :',
	'label:jcorner_classes' => 'Mellorar as esquinas dos selectores seguintes:',
	'label:jcorner_plugin' => 'Instalar o módulo {jQuery} seguinte:',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'Lonxitude do resumo :',
	'label:lgr_sommaire' => 'Lonxitude do sumario (9 a 99) :',
	'label:lien_introduction' => 'Puntos suspensivos de continuidade activos :',
	'label:liens_interrogation' => 'Protexer os URL :',
	'label:liens_orphelins' => 'Ligazóns activas :',
	'label:log_couteau_suisse' => 'Activar :',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:long_url' => 'Longueur du libellé cliquable :', # NEW
	'label:marqueurs_urls_propres' => 'Engadir os marcadores disociando os obxectos (SPIP>=2.0) :<br/>(ex. : « - » para -Miña-seccion-, « @ » para @Meu-web@) ', # MODIF
	'label:max_auteurs_page' => 'Autors por páxina :',
	'label:message_travaux' => 'A súa mensaxe de mantemento :',
	'label:moderation_admin' => 'Validar automaticamente as mensaxes desde: ',
	'label:mot_masquer' => 'Mot-clé masquant les contenus :', # NEW
	'label:nombre_de_logs' => 'Rotation des fichiers :', # NEW
	'label:ouvre_note' => 'Abrir e cerrar as notas a rodapé',
	'label:ouvre_ref' => 'Abrir e cerrar as chamadas de notas a rodapé',
	'label:paragrapher' => 'Paragrafar sempre :',
	'label:prive_travaux' => 'Accesibilidade do espazo privado para:',
	'label:prof_sommaire' => 'Profondeur retenue (1 à 4) :', # NEW
	'label:puce' => 'Viñeta pública «<html>-</html>» :',
	'label:quota_cache' => 'Valor de quota :',
	'label:racc_g1' => 'Entrada e saída da presentación en «<html>{{negra}}</html>» :',
	'label:racc_h1' => 'Entrada e saída dun «<html>{{{intertítulo}}}</html>» :',
	'label:racc_hr' => 'Liña horizontal «<html>----</html>» :',
	'label:racc_i1' => 'Entrada e saída dunha «<html>{itálica}</html>» :',
	'label:radio_desactive_cache3' => 'Uso da caché:',
	'label:radio_desactive_cache4' => 'Uso da caché:',
	'label:radio_target_blank3' => 'Nova xanela para as ligazóns externas :',
	'label:radio_type_urls3' => 'Formato dos URL :',
	'label:scrollTo' => 'Instalar os módulos {jQuery} seguintes :',
	'label:separateur_urls_page' => 'Carácter de separación \'type-id\'<br/>(ex. : ?article-123) :', # MODIF
	'label:set_couleurs' => 'Conxunto para usar :',
	'label:spam_ips' => 'Adresses IP à bloquer :', # NEW
	'label:spam_mots' => 'Secuencias prohibidas :',
	'label:spip_options_on' => 'Incluír :',
	'label:spip_script' => 'Script de chamada :',
	'label:style_h' => 'O seu estilo :',
	'label:style_p' => 'O seu estilo :',
	'label:suite_introduction' => 'Puntos de continuidade :',
	'label:terminaison_urls_page' => 'Terminación dos URL (ex : « .html ») :',
	'label:titre_travaux' => 'Título da mensaxe :',
	'label:titres_etendus' => 'Activr a utilización estendida das balizas #TITRE_XXX :',
	'label:tout_rub' => 'Afficher en public tous les objets suivants :', # NEW
	'label:url_arbo_minuscules' => 'Conservar a altura tipográfica dos títulos nos URL :',
	'label:url_arbo_sep_id' => 'Carácter de separación \'titulo-id\' para o caso de repetición (doublon) :<br/>(non empregue \'/\')', # MODIF
	'label:url_glossaire_externe2' => 'Ligazón sobre o glosario externo :',
	'label:url_max_propres' => 'Longueur maximale des URLs (caractères) :', # NEW
	'label:urls_arbo_sans_type' => 'Mostrar o tipo de obxecto SPIP nos URL :',
	'label:urls_avec_id' => 'Un id sistemáticos, mais...',
	'label:webmestres' => 'Lista de webmásters do web:',
	'liens_en_clair:description' => 'Pon á súa disposición o filtro : \'liens_en_clair\'. O seu texto contén probablemente ligazóns de hipertexto que non son visibles tras unha impresión. Este filtro engade entre corchetes o destino de cada ligazón activa (ligazóns externas ou correos). Atención : en modo de impresión (parámetro \'cs=print\' ou \'page=print\' no url da páxina), esta funcionalidade aplícase automaticamente.',
	'liens_en_clair:nom' => 'Ligazóns en claro',
	'liens_orphelins:description' => 'Esta ferramenta ten dúas funcións :

@puce@ {{Ligazóns correctas}}.

SPIP ten por hábito inserir un espazo diante dos puntos de interrogación ou de exclamación, tipografía francesa obriga. Velaquí unha ferramenta que protexe o punto de interrogación nos url dos seus textos.[[%liens_interrogation%]]

@puce@ {{Ligazóns orfas}}.

Substitúe sistematicamente todos os url deixados en texto polos usuarios (nomeadamente nos foros) e que non son clicables, polas ligazóns de hipertexto en formato  SPIP. Por exemplo : {<html>www.spip.net</html>} substitúese por [->www.spip.net].

Podedes escoller o tipo de substitución :
_ • {Basique} : se substitúen as ligazóns do tipo {<html>http://spip.net</html>} (calquera protocolo) ou {<html>www.spip.net</html>}.
_ • {Estendido} : substitúense ademais as ligazóns do tipo {<html>moi@spip.net</html>}, {<html>mailto:meucorreo</html>} ou {<html>news:miñasnovas</html>}.
_ • {Predefinido} : substitución automática de orixe (a partir da version 2.0 de SPIP).
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:description1' => '[[Si l\'URL rencontrée dépasse les %long_url% caractères, alors SPIP la réduit à %coupe_url% caractères]].', # NEW
	'liens_orphelins:nom' => 'URL fermosas',
	'local_ko' => 'La mise à jour automatique du fichier local «@file@» a échoué. Si l\'outil dysfonctionne, tentez une mise à jour manuelle.', # NEW
	'log_brut' => 'Données écrites en format brut (non HTML)', # NEW
	'log_fileline' => 'Informations supplémentaires de débogage', # NEW

	// M
	'mailcrypt:description' => 'Oculta todas as ligazóns de correo presentes nos seus textos e substitúeos por unha ligazón Javascript que permite activar o programa de correo do lector. Esta ferramenta antispam tenta impedir os robots de colleita de enderezos electrónicos deixados en claro nos foros ou nas balizas dos seus esqueletos.',
	'mailcrypt:nom' => 'MailCrypt',
	'mailcrypt_balise_email' => 'Traiter également la balise #EMAIL de vos squelettes', # NEW
	'mailcrypt_fonds' => 'Ne pas protéger les fonds suivants :<br /><q4>{Séparez-les par les deux points «~:~» et vérifiez bien que ces fonds restent totalement inaccessibles aux robots du Net.}</q4>', # NEW
	'maj_actualise_ok' => 'Le plugin « @plugin@ » n\'a pas officiellement changé de version, mais ses fichiers ont quand même été actualisés afin de bénéficier de la dernière révision de code.', # NEW
	'maj_auto:description' => 'Esta ferramenta permítelle xestionarfacilmente a actualización dos seus diferentes módulos, recuperando especialmente o número de revisión contido no ficheiro <code>svn.revision</code> e comparando aquel encontrado en <code>zone.spip.org</code>.

A lista seguinte ofrece a posibilidade de lanzar o proceso de actualización automática de SPIP sobre cada un dos módulos previamente instalados no cartafol <code>plugins/auto/</code>. Os outros códulos encóntranse no cartafol <code>plugins/</code> e lístanse simplemente a título informativo. Se a revisión remota non se pode encontrar, intente proceder manualmente coa actualización do módulo.

Nota : os paquetes <code>.zip</code> non son reconstruídos instantaneamente, pode ser que teña que esperar un certo atraso antes de poder efectuar a total actualización dun complemento que fose recentemente modificado.', # MODIF
	'maj_auto:nom' => 'Actualizacións automáticas',
	'maj_fichier_ko' => 'Le fichier « @file@ » est introuvable !', # NEW
	'maj_librairies_ko' => 'Librairies introuvables !', # NEW
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particulière de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-clé défini ci-dessous. Si une rubrique est masquée, toute sa branche l\'est aussi.[[%mot_masquer%]]

Pour forcer l\'affichage des contenus masqués, il suffit d\'ajouter le critère <code>{tout_voir}</code> aux boucles de votre squelette.', # NEW
	'masquer:nom' => 'Masquer du contenu', # NEW
	'meme_rubrique:description' => 'Définissez ici le nombre d\'objets listés dans le cadre nommé «<:info_meme_rubrique:>» et présent sur certaines pages de l\'espace privé.[[%meme_rubrique%]]', # NEW
	'message_perso' => 'Un profundo recoñecemento para os tradutores que pasaran por aquí. Pat ;-)',
	'moderation_admins' => 'administradores autenticados',
	'moderation_message' => 'Este foro está moderado a priori : o seu comentario non aparecerá ata que sexa validada por un administrador do web, salvante o caso de que vostede xa estea identificado e autorizado para publicar comentarios directamente.',
	'moderation_moderee:description' => 'Permite moderar a moderación dos foros públicos <b>configurados a priori</b> para os usuarios inscritos.<br/> Exemplo: Eu son o webmáster do meu web, e respondo a unha mensaxe dunha persoa, por qué debo validar a miña propia mensaxe ?Moderación moderada faino por min. [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Moderación moderada',
	'moderation_redacs' => 'redactores autenticados',
	'moderation_visits' => 'visitantes autenticados',
	'modifier_vars' => 'Modificar os parámetros @nb@',
	'modifier_vars_0' => 'Modificar estes parámetros',

	// N
	'no_IP:description' => 'Desactiva o mecanismo de rexistro automático de enderezos IP dos visitantes do seu web por razóns de confidencialidade : SPIP non conservará daquela ningún número IP, nin temporalmente logo das visitas (para xerar as estatísticas ou alimentar o spip.log), nin nos foros (responsabilidade).',
	'no_IP:nom' => 'Non conservar IP',
	'nouveaux' => 'Novos',

	// O
	'orientation:description' => '3 criterios novos para os seus esqueletos : <code>{portrait}</code>, <code>{carre}</code> e <code>{paysage}</code>. Ideal para a ordenación de fotos en función da súa forma.',
	'orientation:nom' => 'Orientación das imaxes',
	'outil_actif' => 'Utilidade activa',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activar',
	'outil_activer_le' => 'Activar a ferramenta',
	'outil_actualiser' => 'Actualiser l\'outil', # NEW
	'outil_cacher' => 'Non volver a mostrar',
	'outil_desactiver' => 'Desactivar',
	'outil_desactiver_le' => 'Desactivar a ferramenta',
	'outil_inactif' => 'Utilidade inactiva',
	'outil_intro' => 'Esta páxina lista as características do módulo postas á súa disposición. <br /> <br /> Ao premer sobre o nome das ferramentas que aparecen a seguir, seleccione, as que pode cambiar o estado usando o botón central: as ferramentas activadas serán desactivadas e <i> viceversa </ i>. Con cada clic, a descrición aparece a seguir das listas. As categorías son pregables e as ferramentas pódense ocultar. O dobre clic permite trocar rapidamente unha ferramenta. <br /> <br /> Nun primeiro uso, recoméndase activar as ferramentas unha por unha, no caso de apareceren certas incompatibilidades co seu esqueleto, con SPIP ou con outros módulos. <br /> <br /> Nota: a simple carga desta páxina compila o conxunto das ferramentas da Navalla Suíza .',
	'outil_intro_old' => 'Esta interface é antiga.<br /><br />Se vostede encontra problema coa utilización da <a href=\'./?exec=admin_couteau_suisse\'>nova     interface</a>, non dubide en facérnolo saber no foro <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@ : @nb@ ferramenta', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ ferramentas', # MODIF
	'outil_permuter' => 'Cambiar a ferramenta : « @text@ » ?',
	'outils_actifs' => 'Ferramentas activas :',
	'outils_caches' => 'Ferramentas ocultas :',
	'outils_cliquez' => 'Prema sobre o nome das ferramentas seguintes para mostrar aquí a súa descrición.',
	'outils_concernes' => 'Sont concernés : ', # NEW
	'outils_desactives' => 'Sont désactivés : ', # NEW
	'outils_inactifs' => 'Ferramentas inactivas :',
	'outils_liste' => 'Lista de ferramentas da Navalla Suíza',
	'outils_non_parametrables' => 'Non parametrables:',
	'outils_permuter_gras1' => 'Trocar as ferramentas en negra',
	'outils_permuter_gras2' => 'Trocar as @nb@ ferramentas en negra ?',
	'outils_resetselection' => 'Reinicializar a selección',
	'outils_selectionactifs' => 'Seleccionar todas as ferramentas activas',
	'outils_selectiontous' => 'TODOS',

	// P
	'pack_actuel' => 'Paquete @date@',
	'pack_actuel_avert' => 'Aviso, as sobreescrituras sobre os define() ou as globais non están especificadas aquí', # MODIF
	'pack_actuel_titre' => 'PAQUETE ACTUAL DE CONFIGURACIÓN DA NAVALLA SUÍZA',
	'pack_alt' => 'Ver os parámetros de configuración en curso',
	'pack_delete' => 'Supresión dun paquete de configuración',
	'pack_descrip' => 'O seu « Paquete de configuración actual" » recolle o conxunto dos parámetros de configuración presentes relativos á Navalla Suíza: a activación de ferramentas e o valor das súas eventuais variables.

Se os permisos de escritura o permiten, ocódigo PHP seguinte poderá poñerse no ficheiro {{/config/mes_options.php}} e engadirá unha ligazón de reiniciación sobre esta páxina "do paquete « {@pack@} ». Desde logo pódelle cambiar ese nome.

De reiniciar o módulo premendo sobre un paquete, a Navalla Suíza reconfigurarase automaticamente en función dos parámetros predeterminados no paquete.', # MODIF
	'pack_du' => '• do paquete @pack@', # MODIF
	'pack_installe' => 'Actualización dun paquete de configuración',
	'pack_installer' => 'Está seguro de querer reiniciar a Navalla Suíza e instalar o paquete « @pack@ » ?',
	'pack_nb_plrs' => 'Hai actualmente @nb@ « paquetes de configuración » dispoñíbeis:',
	'pack_nb_un' => 'Hai actualmente un « paquete de configuración » dispoñible:',
	'pack_nb_zero' => 'Non hai ningún « paquete de configuración » dispoñible actualmente.',
	'pack_outils_defaut' => 'Instalacións das ferramentas predeterminadas',
	'pack_sauver' => 'Gardar a configuración actual',
	'pack_sauver_descrip' => 'O botón seguinte permítelle inserir directamente no seu ficheiro <b>@file@</b> os parámetros necesarios para engadir un « paquete de configuración » no menú da esquerda. Isto permitiravos ulteriormente reconfigurar nun clic A Navalla Suíza no estado en que está actualmente.',
	'pack_supprimer' => 'Está vostede seguro de querer suprimir o paquete « @pack@ » ?',
	'pack_titre' => 'Configuración actual',
	'pack_variables_defaut' => 'Instalación das variables predeterminadas',
	'par_defaut' => 'Predeterminado',
	'paragrapher2:description' => 'A función SPIP <code>paragrapher()</code> insere balizas &lt;p&gt; e &lt;/p&gt; en todos os textos que son que están desprovistos de parágrafos. Co fin de xerar máis finamente os seus estilos e os deseños, ten a posibilidade de uniformizar o aspecto dos textos do seu  web.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Paragrafar',
	'pipelines' => 'Tubarías (pipelines usadas) :',
	'previsualisation:description' => 'Par défaut, SPIP permet de prévisualiser un article dans sa version publique et stylée, mais uniquement lorsque celui-ci a été « proposé à l’évaluation ». Hors cet outil permet aux auteurs de prévisualiser également les articles pendant leur rédaction. Chacun peut alors prévisualiser et modifier son texte à sa guise.

@puce@ Attention : cette fonctionnalité ne modifie pas les droits de prévisualisation. Pour que vos rédacteurs aient effectivement le droit de prévisualiser leurs articles « en cours de rédaction », vous devez l’autoriser (dans le menu {[Configuration&gt;Fonctions avancées->./?exec=config_fonctions]} de l’espace privé).', # NEW
	'previsualisation:nom' => 'Prévisualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci «*»', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Substitúa as viñetas «-» (guión simple) dos artigos por listas les par des listes nominadas «-*» (traducidas en  HTML por : &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) e nas que o estilo pode ser personalizado por css.', # MODIF
	'pucesli:nom' => 'Viñetas fermosas',

	// Q
	'qui_webmestres' => 'Os webmáster de SPIP',

	// R
	'raccourcis' => 'Atallos tipográficos activos da Navalla Suíza :',
	'raccourcis_barre' => 'Os atallo tipográficos da Navalla Suíza',
	'rafraichir' => 'Afin de terminer la configuration du plugin, merci d\'actualiser la page courante.', # NEW
	'reserve_admin' => 'Acceso reservado aos administradores.',
	'rss_actualiser' => 'Actualizar',
	'rss_attente' => 'Espera RSS...',
	'rss_desactiver' => 'Desactivar as « Revisións da Navalla Suíza »',
	'rss_edition' => 'Flux RSS actualizado o :',
	'rss_source' => 'Fonte RSS',
	'rss_titre' => '« A Navalla Suíza » en desenvolvemento :',
	'rss_var' => 'As revisión da Navalla Suíza',

	// S
	'sauf_admin' => 'Todos, agás os administradores',
	'sauf_admin_redac' => 'Todos, salvo os administradores e redactores',
	'sauf_identifies' => 'Todos, agás os autores identificados',
	'sessions_anonymes:description' => 'Chaque semaine, cet outil vérifie les sessions anonymes et supprime les fichiers qui sont trop anciens (plus de @_NB_SESSIONS3@ jours) afin de ne pas surcharger le serveur, notamment en cas de SPAM sur le forum.

Dossier stockant les sessions : @_DIR_SESSIONS@

Votre site stocke actuellement @_NB_SESSIONS1@ fichier(s) de session, @_NB_SESSIONS2@ correspondant à des sessions anonymes.', # NEW
	'sessions_anonymes:nom' => 'Sessions anonymes', # NEW
	'set_options:description' => 'Seleccione o tipo de interface privada predeterminada (simplificada ou avanzada) para todos os redactores xa existentes ou futuros e suprima o botón correspondente da barra de iconas.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Tipo de interface privada',
	'sf_amont' => 'Fluxo ascendente',
	'sf_tous' => 'Todos',
	'simpl_interface:description' => 'Desactive o cambio rápido de estado dun artigo sobrevoando a súa viñeta de cor. Iso é útil se vostede procura obter unha  interface privada o máis limpa co fin de optimizar o rendemento do lado do cliente.',
	'simpl_interface:nom' => 'Alixeiramento da interfacer privada',
	'smileys:aide' => 'Risoños : @liste@',
	'smileys:description' => 'Inserir risoños en todos os textos onde aparece un atallo do tipo <acronym>:-)</acronym>. Ideal para os foros.
_ Está dispoñible unha baliza para mostrar unha táboa de risoños nos seus esqueletos : #SMILEYS.
_ Deseños : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Risoños',
	'soft_scroller:description' => 'Ofrece na parte pública do seu web un esvaramento suavizado da páxina logo de que o visitante prema sobre unha ligazón que apunte sobre unha áncora: resulta moi útil para evitar perderse nunha páxina complexa ou un texto moi longo...

Aviso, esta utilidade precisa para funcionar páxinas con «DOCTYPE XHTML» (non HTML !) e que haxa dous módulos instalados {jQuery} : {ScrollTo} e {LocalScroll}. A Navalla Suíza pódeos instalar directamente se vostede selecciona as opcións seguintes. [[%scrollTo%]][[-->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Áncoras suaves',
	'sommaire:description' => 'Constrúe un sumario para o texto dos seus artigos e das súas seccións co fin de acceder rapidamente  a títulos de alto tamaño (balizas HTML &lt;h3>Un intertítulo&lt;/h3> ou a atallos de SPIP : intertítulos do estilo :<code>{{{Un título grande}}}</code>).

@puce@ Pode definir aquí o número máximo de caracteres retidos dos intertítulos para construír o sumario:[[%lgr_sommaire% caractères]]

@puce@ Pode fixar tamén o comportamento do módulo concerninte á creación do sumario: 
_ • Sistematicamente para cada artigo (unha baliza <code>@_CS_SANS_SOMMAIRE@</code> situada en calquera lugar ou no interior do texto do artigo creará unha excepción).
_ • Unicamente para os artigos que conteñan a baliza <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ De modo predeterminado, A Navalla Suíza insire o sumario na cabeceira do artigo automaticamente. Vostede ten a posibilidade de situar este sumario no seu esqueleto grazas a unha baliza #CS_SOMMAIRE que pode activar aquí :
[[%balise_sommaire%]]

Este sumario pode ser aparellado con : « [.->decoupe] ».', # MODIF
	'sommaire:nom' => 'Un sumario automático', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre<mon_ancre>}}}</html></b>', # NEW
	'sommaire_avec' => 'Un artigo con sumario : <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un artigo sen sumario : <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hiérarchisés : <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Tenta loitar contra os envíos de mensaxes automáticas e impertinentes na parte pública. Algunhas palabras e as balizas en claro &lt;a>&lt;/a> están prohibidas.Anime os seus redactores a empregar os atallos de SPIP

Liste aquí, separándoas por espazos, as secuencias prohibidas [[%spam_mots%]]
• Para unha expresión con espazos, sitúea entre parénteses. Exemplo:~{(asses)}.
_ • Para especificar unha palabra enteira, situéa ente parénteses. Exemplo~:~{(asses)}.
_ • Para unha expresión regular, comprobe ben a sintaxe e sitúea entre barras e comas. Exemplos:~{<html>\\"/@test\\.(com|fr)/\\"</html>}.', # MODIF
	'spam:nom' => 'Loita contra o SPAM',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Esta mensaxe será bloqueada polo filtro antispam!',
	'spam_test_ok' => 'Esta mensaxe será aceptada polo filtro antispam.',
	'spam_tester_bd' => 'Testez également votre votre base de données et listez les messages qui auraient été bloqués par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Teste aquí a súa lista de secuencias prohibidas:', # MODIF
	'spip_cache:description' => '@puce@ A caché ocupa un certo espazo de disco e SPIP pode limitalo. Un valor baleiro ou igual a 0 significa que non se lle aplica ningunha cota.[[%quota_cache% Mo]]

@puce@ Tras unha modificación do contido do web, SPIP invalida inmediatamente a caché sen agardar ao cálculo periódico establecido. Se o seu web ten problemas de rendemento por unha carga moi elevada, pode establecer como « non » esta opción.[[%derniere_modif_invalide%]]

@puce@Se a baliza #CACHE non se encontra nos seus esqueletos locais, SPIP considera de modo predeterminado que a caché dunha páxina ten unha duración de vida de 24 horas antes de a recalcular. Co fin de xestionar mellor a carga do seu servidor, pode modificar aquí este valor.[[%duree_cache% heures]]

@puce@ Se vostede ten varios webs en mutualización, pode especificar aquí o valor predeterminado tomado en conta por todos os web locais (SPIP 2.0 mínimo).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ De modo predeterminado, SPIP calcula todas as páxinas públicas e colócaas na caché co fin de acelerar a consulta. Desactivar temporariamente a caché pode axudar ao desenvolvemento do web. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ Catro opcións para orientar o funcionamento da caché de SPIP : <q1>
_ • {Uso normal} : SPIP calcula todas as páxinas públicas e colócaas na caché co fin de acelerar con iso a consulta. Tras un certo período, a caché recalcúlasae e almacénase.
_ • {Caché permanente} : os períodos de invalidación da caché son ignorados.
_ • {Sen caché} : desactivar temporariamente a caché pode axudar ao desenvolvemento do web. Aquí, nada é gardado no disco.
_ • {Control da caché} : opción idéntica á precedente, con unha escritura sobre o disco de todos os resultados co fin de poder controlalos eventualmente.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension « Compresseur » présente dans SPIP permet de compacter les différents éléments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela accélère l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers à obtenir.', # NEW
	'spip_cache:nom' => 'SPIP e a memoria caché…',
	'spip_ecran:description' => 'Détermine la largeur d\'écran imposée à tous en partie privée. Un écran étroit présentera deux colonnes et un écran large en présentera trois. Le réglage par défaut laisse l\'utilisateur choisir, son choix étant stocké dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'écran', # NEW
	'spip_log:description' => '@puce@ Gérez ici les différents paramètres pris en compte par SPIP pour mettre en logs les évènements particuliers du site. Fonction PHP à utiliser : <code>spip_log()</code>.@SPIP_OPTIONS@
[[Ne conserver que %nombre_de_logs% fichier(s), chacun ayant pour taille maximale %taille_des_logs% Ko.<br /><q3>{Mettre à zéro l\'une de ces deux cases désactive la mise en log.}</q3>]][[@puce@ Dossier où sont stockés les logs (laissez vide par défaut) :<q1>%dir_log%{Actuellement :} @DIR_LOG@</q1>]][[->@puce@ Fichier par défaut : %file_log%]][[->@puce@ Extension : %file_log_suffix%]][[->@puce@ Pour chaque hit : %max_log% accès par fichier maximum]]', # NEW
	'spip_log:description2' => '@puce@ Le filtre de gravité de SPIP permet de sélectionner le niveau d\'importance maximal à prendre en compte avant la mise en log d\'une donnée. Un niveau 8 permet par exemple de stocker tous les messages émis par SPIP.[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]', # NEW
	'spip_log:description3' => '@puce@ Les logs spécifiques au Couteau Suisse s\'activent ici : «[.->cs_comportement]».', # NEW
	'spip_log:nom' => 'SPIP et les logs', # NEW
	'stat_auteurs' => 'Os estado dos autores',
	'statuts_spip' => 'Unicamente os estados SPIP seguintes :',
	'statuts_tous' => 'Todos os estados',
	'suivi_forums:description' => 'Un autor de artigo será sempre informado cando apareza unha mensaxe no foro público asociado. Tamén é posible adverter ademais : todoso os participantes no foro ou soamente os autores de mensaxes en fluxo ascendente.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Seguimento dos foros públicos',
	'supprimer_cadre' => 'Suprimir este cadro',
	'supprimer_numero:description' => 'Aplica a función SPIP supprimer_numero() ao conxunto dos {{títulos}} e dos {{nomes}} do web público, sen que o filtro supprimer_numero estea presente nos esqueletos.<br />Velaquí a sintaxe que se vai usar no cadro dun web multilingüe : <code>1. <multi>O Meu Título[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Suprime o número',

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
	'titre' => 'A Navalla Suíza',
	'titre_parent:description' => 'No interior dun bucle, é frecuente querer mostrar o título do pai do obxecto en curso. Tradicionalmente, cumpría utilizar un segundo bucle, mais esta nova baliza #TITRE_PARENT alixeirará a escrita dos seus esqueletes. O resultado devolto é este : o título dun grupo de palabras clave ou o da sección pai (de existir) de calquera outro obxecto (artigo, sección, breve, etc.).

Note que : para as palabras clave, un alias de #TITRE_PARENT é  #TITRE_GROUPE. O tratamento de SPIP destas novas balizas é semellante a aquel de #TITRE.

@puce@ De estar con SPIP 2.0, tamén ten á súa disposición todo un conxunto de balizas #TITRE_XXX que poderán darlle o título do obxecto \'xxx\', coa condición de que o campo \'id_xxx\' estea presente na táboa en curso (#ID_XXX utilizable no bucle en curso).

Por exemplo, nun bucle sobre  (ARTICLES), #TITRE_SECTEUR devolverá o título da sección na que estea situado o artigo en curso, xa que o identificador #ID_SECTEUR (de aí o campo \'id_secteur\') está dispoñible neste caso.[[%titres_etendus%]]
A sintaxe <html>#TITRE_XXX{yy}</html> é igualmente aceptada. Exemplo : <html>#TITRE_ARTICLE{10}</html> reenviará ao título do artigo #10.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Baliza #TITRE_PARENT',
	'titre_tests' => 'A Navalla Suíza - Páxina de tests…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>« {{{Mon intertitre}}} »</html> en image typographique paramétrable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : « [.->sommaire] ».', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'titres_typographies:description' => 'Par défaut, les raccourcis typographiques de SPIP <html>({, {{, etc.)</html> ne s\'appliquent pas aux titres d\'objets dans vos squelettes.
_ Cet outil active donc l\'application automatique des raccourcis typographiques de SPIP sur toutes les balises #TITRE et apparentées (#NOM pour un auteur, etc.).

Exemple d\'utilisation : le titre d\'un livre cité dans le titre d\'un article, à mettre en italique.', # NEW
	'titres_typographies:nom' => 'Titres typographiés', # NEW
	'tous' => 'Todos',
	'toutes_couleurs' => 'As 36 cores dos estilos css :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Bloques multilingües : <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'Ao instar isto, pode facelo xa nos seus esqueletos, esta utilidade permítelle usar librementemente as cadeas de linguas de SPIP ou dos seus esqueletos: nos contidos do seu web (artigos, títulos, mensaxes, etc.) coa axuda co atallo <code><:chaine:></code>.

Consulte [aqui->http://www.spip.net/fr_article2128.html] a documentación de SPIP sobre este asunto.

Esta ferramenta acepta igualmente os argumentos introducidos por SPIP 2.0. Por exemplo, o atallo <code><:miña_cadea{nome=Carlos Martín, idade=37}:>/code> permite pasar dous parámetros á cadea seguinte: <code>\'miña_cadea\'=>"Bos días, eu son @nome@ e teño @idade@ anos\\"</code>.

A función SPIP usada en PHP é : <code>_T(\'chaine\')</code>. sen argumento, e <code>_T(\'chaine\', array(\'arg1\'=>\'un texto\', \'arg2\'=>\'un outro texto\'))</code> con argumentos.

Non esqueza verificar que a clave <code>\'cadea\'</code> está ben definida nos ficheiros de lingua.', # MODIF
	'toutmulti:nom' => 'Bloques multilingües',
	'trad_help' => '{{Le Couteau Suisse est bénévolement traduit en plusieurs langues et sa langue mère est le français.}}

N\'hésitez pas à offrir votre contribution si vous décelez quelques soucis dans les textes du plugin. Toute l\'équipe vous en remercie d\'avance.

Pour vous inscrire à l\'espace de traduction : @url@

Pour accéder directement aux traductions des modules du Couteau Suisse, cliquez ci-dessous sur la langue cible de votre choix. Une fois identifié, repérez ensuite le petit crayon qui apparait en survolant le texte traduit puis cliquez dessus.

Vos modifications seront prises en compte quelques jours plus tard sous forme d\'une mise à jour disponible pour le Couteau Suisse. Si votre langue n\'est pas dans la liste, alors le site de traduction vous permettra facilement de la créer.

{{Traductions actuellement disponibles}} :@trad@

{{Merci aux traducteurs actuels}} : @contrib@.', # NEW
	'trad_mod' => 'Module « @mod@ » : ', # NEW
	'travaux_masquer_avert' => 'Ocultar o cadro que indica no web público que unha operación de mantemento está en curso',
	'travaux_nocache' => 'Désactiver également le cache de SPIP', # NEW
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Este web será restablecido axiña.
_ Grazas pola súa comprensión.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'En navegando o web na zona privada([->./?exec=auteurs]), escolla aquí a ordenación que usará para mostrar os artigos no interior das seccións.

As propostas que seguen están baseadas na funcionalidade SQL \'ORDER BY\' : non empregue unha ordenación personalizada se non está seguro do que está a facer (campos dispoñíbeis : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Ordenación de artigos', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'Ordenación coa data de modificación (ORDER BY date_modif DESC)',
	'tri_perso' => 'Ordenación SQL personalizada, ORDER BY segundo a estrutura :',
	'tri_publi' => 'Ordenación sobre a data de publicación (ORDER BY date DESC)',
	'tri_titre' => 'Ordenación sobre o título (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Utilidade en desenvolvemento. Ofrece algunhas balizas moi simples e moi prácticas para mellorar a lexibilidade dos seus esqueletos.

@puce@ {{#BOLO}} : xera un falso texto de 3000 caracteres ("bolo" ou "[?lorem ipsum]") nos esqueletos durante a súa preparación. O argumentos opcional desta función especifica a lonxitude do texto querido. Exemplo : <code>#BOLO{300}</code>. Esta baliza acepta todos os filtros de  SPIP. Exemplo : <code>[(#BOLO|majuscules)]</code>.
_ Está dispoñible igualmente un argumento para os seus contidos: sitúe <code><bolo300></code> en calquera zona de texto (entrada, descrición, texto, etc.) para obter 300 caracteres de texto falso.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : reenvíe simplemente a data do momento, do seguinte xeito: <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. O argumento opcional desta función especifica a formato. Exemplo : <code>#MAINTENANT{Y-m-d}</code>. Como con #DATE, personalice a presentación grazas aos filtros de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}} : baliza equivalente a <code>#EVAL{"chr(XX)"}</code> e práctica para codificar os caracteres especiais (o retorno de liña por exemplo) ou dos caracteres reservados polo compilador de SPIP (parénteses ou comiñas).

@puce@ {{#LESMOTS}} :', # MODIF
	'trousse_balises:nom' => 'Caixa de balizas',
	'type_urls:description' => '@puce@ SPIP ofrece unha elección entre varios xogos de URL para facer as ligazóns de acceso ás páxinas do seu web :

Máis info : [->http://www.spip.net/fr_article765.html].
A ferramenta « [.->boites_privees] » permite ver na páxina de cada obxecto SPIP o URL propio asociado.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@para usar os formatos {html}, {proprias} ou {proprias2}, {libres} ou {arborescentes} copie o ficheiro "htaccess.txt" do cartafol raíz de SPIP co nome ".htaccess" (preste atención a non borrar outras regraxes que vostede teña posto nese ficheiro); se o seu web está nun subcartafol, deberá tamén editar a liña "RewriteBase" neste ficheiro. Os URL definidos serán logo redirixidos cara aos ficheiros de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@{{URL «páxina»}} : estas son as ligazóns predeterminadas, utilizadas por SPIP desde a súa version 1.9x.
_ Exemplo : <code>/spip.php?article123</code>.
[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valor="html">@puce@ {{URL «html»}} : as ligazóns teñen a forma de páxinas html clásicas.
_ Exemplo : <code>/article123.html</code>.</radio_type_urls3>

<radio_type_urls3 valor="propias">@puce@ {{URL «propias»}} : as ligazóns son calculadas conforme o título dos obxectos demandados. Os marcadores (_, -, +, etc.) encadran os títulos en función do tipo de obxecto.
_ Exemplos : <code>/Meu-titulo-de-artigo</code> ou <code>/-Miña-seccion-</code> ou <code>/@Meu-web@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valor="propres2">@puce@ {{URLs «propres2»}} : a extensión \'.html\' engádese ás ligazóns {«propias»}.
_ Exemplo : <code>/Meu-titulo-de-artigo.html</code> ou <code>/-Miña-seccion-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valor="libres">@puce@ {{URL «libres»}} : as ligazóns son {«propias»}, mais sen marcadores (_, -, +, etc.).
_ Exemplo : <code>/Meu-titulo-de-artigo</code> ou <code>/Miña-sección</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valor="arbo">@puce@ {{URLs «arborescentes»}} : as ligazóns {«propias»}, mais de tipo arborescente.
_ Exemplo : <code>/sectour/seccion/seccion2/Meu-titulo-de-artigo</code>[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URL «propres-qs»}} : este sistema funciona en "Query-String", é dicir sen utilización .htaccess ; as ligazóns son {«propias»}.
_ Exemplo : <code>/?Meu-titulo-de-artigo</code>[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valor="propres_qs">@puce@ {{URL «propias_qs»}} : este sistema funciona en "Query-String", é dicir sen utilización de .htaccess ; as ligazóns son {«propias»}.
_ Exemplo : <code>/?Meu-titulo-de-artigo</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valor="standard">@puce@ {{URL «estandar»}} : estas ligazóns desde agora obsoletas eran empregadas por  SPIP ata a versión 1.8.
_ Exemplo : <code>article.php3?id_article=123</code></radio_type_urls3>

@puce@ Se vostede emprega o formato {páxina} seguinte ou se o obxecto demandado non é recoñecido, é posible escoller {{o script de chamada }} a SPIP. De modo predeterminado, SPIP escolle {spip.php}, mais {index.php} (exemplo de formato: <code>/index.php?article123</code>) ou un valor baleiro (formato : <code>/?article123</code>) funcionan tamén. Para calquera outro valor, cómpre crear necesariamente o ficheiro correspondente na raiz de SPIP, a imaxe daquel que xa existe: {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ De utilizar un formato con base en URL «propres»  ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), a Navalla Suíza pode :
<q1>• Asegurarse que o URL producido sexa totalmente en {{en minúsculas}}.
</ql>[[%urls_minuscules%]]
 <ql> Provocar o engadido sistemático do{{id do obxecto}} ao seu URL (en sufixo ou en prefixo, etc.).
_(exemplos : <code>/Meu-titulo-de-artigo,457</code> ou <code>/457-Meu-titulo-de-artigo</code>)</q1>[[%urls_minuscules%]][[->%urls_avec_id%]][[->%urls_avec_id2%]]</ql>', # MODIF
	'type_urls:description2' => '{Note} : un changement dans ce paragraphe peut nécessiter de vider la table des URLs afin de permettre à SPIP de tenir compte des nouveaux paramètres.', # NEW
	'type_urls:nom' => 'Formato das URL',
	'typo_exposants:description' => 'Textos franceses : mellora o rendemento tipográfico das abreviacións correntes, metendo en superíndice os elementos necesarios (así, {<acronym>Mme</acronym>} produce {M<sup>me</sup>}) e corrixindo os erros correntes ({<acronym>2ème</acronym>} ou  {<acronym>2me</acronym>}, por exemplo, produce {2<sup>e</sup>}, só abreviatura correcta).

As abreviacións obtidas están conformes con aquelas da Imprenta nacional como constan en {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (artigo « Abréviations », imprentas da Imprimerie nationale, Paris, 2002).
Tamén son tratadas as expresións seguintes: <html>Dr, Pr, Mgr, m2, m3, Mn, Md, Sté, Éts, Vve, Cie, 1o, 2o, etc.</html> 

Escolla aquí se quere poñer en superíndice certos atallos suplementarios, malia que sexa desaconsellado pola Imprimerie nationale :[[%expo_bofbof%]]

{{Textos ingleses}} : en superíndice os números ordinaux : <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Superíndices tipográficos',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'páxina',
	'url_propres' => 'propias@_CS_ASTER@',
	'url_propres-qs' => 'propias-qs',
	'url_propres2' => 'propias2@_CS_ASTER@',
	'url_propres_qs' => 'propias_qs',
	'url_standard' => 'estándar',
	'url_verouillee' => 'URL verrouillée', # NEW
	'urls_3_chiffres' => 'Impoñer un mínimo de 3 cifras',
	'urls_avec_id' => 'Poñelo en sufixo',
	'urls_avec_id2' => 'Poñer o Id en prefixo',
	'urls_base_total' => 'Hai actualmente @nb@ URL na base',
	'urls_base_vide' => 'A base dos URL está baleira',
	'urls_choix_objet' => 'Edición con base no URL dun obxecto específico :',
	'urls_edit_erreur' => 'O formato actual dos URL (« @type@ ») non permite a edición.',
	'urls_enregistrer' => 'Rexistrar esta URL na base',
	'urls_id_sauf_rubriques' => 'Excluír as seccións', # MODIF
	'urls_minuscules' => 'Letras minúsculas',
	'urls_nouvelle' => 'Editar o URL « propias » :', # MODIF
	'urls_num_objet' => 'Número :',
	'urls_purger' => 'Baleirar todo',
	'urls_purger_tables' => 'Baleirar as táboas seleccionadas',
	'urls_purger_tout' => 'Reiniciar os URL gardados na base :',
	'urls_rechercher' => 'Procurar este obxecto na base',
	'urls_titre_objet' => 'Título rexistrado :',
	'urls_type_objet' => 'Obxecto :',
	'urls_url_calculee' => 'URL público « @type@ » :',
	'urls_url_objet' => 'URL « propias » rexistrado :', # MODIF
	'urls_valeur_vide' => '(Un valor baleiro provoca o recálculo do URL)', # MODIF
	'urls_verrouiller' => '{{Verrouiller}} cette URL afin que SPIP ne la modifie plus, notamment lors d\'un clic sur « @voir@ » ou d\'un changement du titre de l\'objet.', # NEW

	// V
	'validez_page' => 'Para acceder ás modificacións :',
	'variable_vide' => '(Baleiro)',
	'vars_modifiees' => 'Os datos foron correctamente modificados',
	'version_a_jour' => 'A súa versión está actualizada.',
	'version_distante' => 'Versión remota...',
	'version_distante_off' => 'Comprobación distante desactivada',
	'version_nouvelle' => 'Nova versión : @version@',
	'version_revision' => 'Revisiónn : @revision@',
	'version_update' => 'Actualización automática',
	'version_update_chargeur' => 'Descarga automática',
	'version_update_chargeur_title' => 'Descarga a última versión do plugin grazas ao «Téléchargeur»',
	'version_update_title' => 'Descarga a última versión do módulo e lanza a súa posta ao día automática',
	'verstexte:description' => 'Dous filtros para os seus esqueletos que permiten producir páxinas máis lixeiras.
_ version_texte : extrae o contido de texto dunha páxina html tras  excluír algunhas balizas elementares.
_ version_plein_texte : extrae o contido de texto dunha páxina html para manter o texto pleno.', # MODIF
	'verstexte:nom' => 'Versión de texto',
	'visiteurs_connectes:description' => 'Ofrece un elemento para o seu esqueleto que mostra o número de visitantes conectados ao web público.

Engada simplemente<code><INCLURE{fond=fonds/visiteurs_connectes}></code> nas súas páxinas.', # MODIF
	'visiteurs_connectes:inactif' => 'Attention : les statistiques du site ne sont pas activées.', # NEW
	'visiteurs_connectes:nom' => 'Visitantes conectados',
	'voir' => 'Ver: @voir@',
	'votre_choix' => 'A súa elección :',

	// W
	'webmestres:description' => 'Un/unha {{webmaster}} no senso de SPIP é un {{administrador}} que ten acceso ao espazo FTP. De modo predefinido e a partir de SPIP 2.0, é o administrador <code>id_auteur=1</code> do web. Os webmásters aquí definidos teñen o privilexio de non estaren obrigados a pasar polo FTP para validar as operacións sensibles do web, como a actualización da base de datos ou a restauración dun volcado (dump).

Webmáster(es) actual(is) : {@_CS_LISTE_WEBMESTRES@}.
_ Administrador(es) elixible(s) : {@_CS_LISTE_ADMINS@}.

En tanto que webmáster, ten dereito a modificar esta lista de id -- separados por dous puntos « : » de seren varios. Exemplo : «1:5:6».[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Lista de webmásters',

	// X
	'xml:description' => 'Activa o validador xml para o espazo público tal como se describe na [documentación->http://www.spip.net/fr_article3541.html]. Un botón titulado « Analise XML » foi engadido aos outros botóns de administración.', # MODIF
	'xml:nom' => 'Validador XML'
);

?>
